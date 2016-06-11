/**
 * Created by ra on 5/14/2015.
 */


var td_wp_admin_demos = {



    init: function init() {

        jQuery().ready(function() {

            // install full
            jQuery('.td-wp-admin-demo .td-button-install-demo').click(function(event) {
                event.preventDefault();

                var include_demo_content_check = jQuery(this).parent().parent().find('input[type=hidden]');
                var demo_id = jQuery(this).data('demo-id');
                var td_confirm = '';



                if (include_demo_content_check.val() == 'no') {
                    // install no content
                    td_confirm = confirm('' +
                    '导入演示不带内容：\n' +
                    '-----------------------------------------\n' +
                    '你确定？这将导入我们预设的演示设置（背影、模板布局、字体、颜色等...） \n\n' +
                    '请备份您的设置，以确保您不会意外失去他们。\n\n\n');

                    if (td_confirm === true) {
                        td_wp_admin_demos._block_navigation();
                        td_wp_admin_demos._install_no_content(demo_id);
                    }
                } else {
                    // install with content
                    td_confirm = confirm('' +
                    '安装完整演示：\n' +
                    '-----------------------------------------\n' +
                    '你确定？这将导入我们的预设演示设置（背影、模板布局、文章、颜色等...）和我们的示例内容。 \n\n' +
                    '请备份您的设置，以确保您不会意外失去它们。\n\n\n' +
                    '-----------------------------------------\n' +
                    '卸载：演示可以完全卸载，系统将尝试回滚到以前的状态。通过演示创建的任何内容、菜单和附件都可以通过卸载按钮删除。');

                    if (td_confirm === true) {
                        td_wp_admin_demos._block_navigation();
                        td_wp_admin_demos._install_full(demo_id);
                    }
                }

            });

            // uninstall
            jQuery('.td-wp-admin-demo .td-button-uninstall-demo').click(function(event) {
                event.preventDefault();

                var td_confirm = confirm('' +
                '卸载演示：\n' +
                '-----------------------------------------\n' +
                '你确定？该主题将删除所有已安装的内容和设置，它会尝试扭转你的网站到以前的状态');
                if (td_confirm === true) {
                    var demo_id = jQuery(this).data('demo-id');
                    td_wp_admin_demos._uninstall(demo_id);
                }
            });


            //toggle between only settings and full demo
            jQuery('.td-wp-admin-demo .td-checkbox').click(function(event){
                event.preventDefault();

                if (jQuery(this).hasClass('td-checkbox-active')) {
                    // we are deactivating
                    jQuery(this).parent().find('p').text('Only settings');

                } else {
                    // we are activating
                    jQuery(this).parent().find('p').text('Include content');
                }

            });
        });
    },


    _uninstall: function(demo_id) {
        // disable the rest of the demos + remove the installed class form the other demo
        jQuery('.td-wp-admin-demo:not(.td-demo-' + demo_id + ')')
            .addClass('td-demo-disabled')
        ;

        //add the installing class
        jQuery('.td-demo-' + demo_id)
            .addClass('td-demo-uninstalling')
            .removeClass('td-demo-installed')
        ;

        // show the progressbar
        td_wp_progress_bar.progress_bar_wrapper_element = jQuery('.td-demo-' + demo_id + ' .td-progress-bar-wrap');
        td_wp_progress_bar.progress_bar_element = jQuery('.td-demo-' + demo_id + ' .td-progress-bar');
        td_wp_progress_bar.show();
        td_wp_progress_bar.change(2);

        td_wp_progress_bar.timer_change(98);

        var request_data = {
            action: 'td_ajax_demo_install',
            td_demo_action:'uninstall_demo',
            td_demo_id: demo_id
        };
        jQuery.ajax({
            type: 'POST',
            url: td_ajax_url,
            cache:false,
            data: request_data,
            dataType: 'json',
            success: function(data, textStatus, XMLHttpRequest){
                //tdAjaxBlockProcessResponse(data, td_user_action);

                td_wp_progress_bar.change(100);


                setTimeout(function() {
                    // hide and reset the progress bar
                    td_wp_progress_bar.hide();
                    td_wp_progress_bar.reset();

                    //remove the installing class and add the installed class
                    jQuery('.td-demo-' + demo_id)
                        .removeClass('td-demo-uninstalling');

                    // remove the disable class from the other demos
                    jQuery('.td-demo-disabled').removeClass('td-demo-disabled');

                }, 500);
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                td_wp_admin_demos._show_network_error('uninstall', MLHttpRequest, textStatus, errorThrown);
            }
        });


    },

    _install_no_content: function (demo_id) {
        td_wp_admin_demos._ui_install_start(demo_id);

        td_wp_progress_bar.timer_change(70);


        /* ---------------------------------------------------------------------------------------
         Remove content before install
         */
        var request_data = {
            action: 'td_ajax_demo_install',
            td_demo_action:'remove_content_before_install',
            td_demo_id: demo_id
        };
        jQuery.ajax({
            type: 'POST',
            url: td_ajax_url,
            cache:false,
            data: request_data,
            dataType: 'json',
            success: function(data, textStatus, XMLHttpRequest){


                /* ---------------------------------------------------------------------------------------
                   install_no_content_demo
                 */
                td_wp_progress_bar.timer_change(98);
                //tdAjaxBlockProcessResponse(data, td_user_action);
                var request_data = {
                    action: 'td_ajax_demo_install',
                    td_demo_action:'install_no_content_demo',
                    td_demo_id: demo_id
                };
                jQuery.ajax({
                    type: 'POST',
                    url: td_ajax_url,
                    cache:false,
                    data: request_data,
                    dataType: 'json',
                    success: function(data, textStatus, XMLHttpRequest){
                        //tdAjaxBlockProcessResponse(data, td_user_action);

                        td_wp_admin_demos._ui_install_end(demo_id);
                    },
                    error: function(MLHttpRequest, textStatus, errorThrown){
                        td_wp_admin_demos._show_network_error('no_content_install_demo', MLHttpRequest, textStatus, errorThrown);
                    }
                });



            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                td_wp_admin_demos._show_network_error('no_content_remove_content_before_install', MLHttpRequest, textStatus, errorThrown);
            }
        });




    },


    _install_full_td_import:function (demo_id) {

        /* ---------------------------------------------------------------------------------------
         td_import
         */
        td_wp_progress_bar.timer_change(98);
        var request_data = {
            action: 'td_ajax_demo_install',
            td_demo_action:'td_import',
            td_demo_id: demo_id
        };
        jQuery.ajax({
            type: 'POST',
            url: td_ajax_url,
            cache:false,
            data: request_data,
            dataType: 'json',
            success: function(data, textStatus, XMLHttpRequest){
                //tdAjaxBlockProcessResponse(data, td_user_action);

                td_wp_admin_demos._ui_install_end(demo_id);
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                td_wp_admin_demos._show_network_error('full_demo_install', MLHttpRequest, textStatus, errorThrown);
            }
        });


    },




    _install_full_td_media_6:function (demo_id) {
        /* ---------------------------------------------------------------------------------------
         td_media_6
         */
        td_wp_progress_bar.timer_change(82);
        var request_data = {
            action: 'td_ajax_demo_install',
            td_demo_action:'td_media_6',
            td_demo_id: demo_id
        };
        jQuery.ajax({
            type: 'POST',
            url: td_ajax_url,
            cache:false,
            data: request_data,
            dataType: 'json',
            success: function(data, textStatus, XMLHttpRequest){
                td_wp_admin_demos._install_full_td_import(demo_id);
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                td_wp_admin_demos._show_network_error('full_demo_media_6', MLHttpRequest, textStatus, errorThrown);
            }
        });
    },


    _install_full_td_media_5:function (demo_id) {
        /* ---------------------------------------------------------------------------------------
         td_media_5
         */
        td_wp_progress_bar.timer_change(70);
        var request_data = {
            action: 'td_ajax_demo_install',
            td_demo_action:'td_media_5',
            td_demo_id: demo_id
        };
        jQuery.ajax({
            type: 'POST',
            url: td_ajax_url,
            cache:false,
            data: request_data,
            dataType: 'json',
            success: function(data, textStatus, XMLHttpRequest){
                td_wp_admin_demos._install_full_td_media_6(demo_id);
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                td_wp_admin_demos._show_network_error('full_demo_media_5', MLHttpRequest, textStatus, errorThrown);
            }
        });
    },



    _install_full_td_media_4:function (demo_id) {
        /* ---------------------------------------------------------------------------------------
         td_media_4
         */
        td_wp_progress_bar.timer_change(58);
        var request_data = {
            action: 'td_ajax_demo_install',
            td_demo_action:'td_media_4',
            td_demo_id: demo_id
        };
        jQuery.ajax({
            type: 'POST',
            url: td_ajax_url,
            cache:false,
            data: request_data,
            dataType: 'json',
            success: function(data, textStatus, XMLHttpRequest){
                td_wp_admin_demos._install_full_td_media_5(demo_id);
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                td_wp_admin_demos._show_network_error('full_demo_media_4', MLHttpRequest, textStatus, errorThrown);
            }
        });
    },


    _install_full_td_media_3:function (demo_id) {
        /* ---------------------------------------------------------------------------------------
         td_media_3
         */
        td_wp_progress_bar.timer_change(46);
        var request_data = {
            action: 'td_ajax_demo_install',
            td_demo_action:'td_media_3',
            td_demo_id: demo_id
        };
        jQuery.ajax({
            type: 'POST',
            url: td_ajax_url,
            cache:false,
            data: request_data,
            dataType: 'json',
            success: function(data, textStatus, XMLHttpRequest){
                td_wp_admin_demos._install_full_td_media_4(demo_id);
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                td_wp_admin_demos._show_network_error('full_demo_media_3', MLHttpRequest, textStatus, errorThrown);
            }
        });
    },




    _install_full_td_media_2:function (demo_id) {
        /* ---------------------------------------------------------------------------------------
         td_media_2
         */
        td_wp_progress_bar.timer_change(34);
        var request_data = {
            action: 'td_ajax_demo_install',
            td_demo_action:'td_media_2',
            td_demo_id: demo_id
        };
        jQuery.ajax({
            type: 'POST',
            url: td_ajax_url,
            cache:false,
            data: request_data,
            dataType: 'json',
            success: function(data, textStatus, XMLHttpRequest){
                td_wp_admin_demos._install_full_td_media_3(demo_id);
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                td_wp_admin_demos._show_network_error('full_demo_media_2', MLHttpRequest, textStatus, errorThrown);
            }
        });
    },


    _install_full_td_media_1:function (demo_id) {
        /* ---------------------------------------------------------------------------------------
         td_media_1
         */
        td_wp_progress_bar.timer_change(22);
        var request_data = {
            action: 'td_ajax_demo_install',
            td_demo_action:'td_media_1',
            td_demo_id: demo_id
        };
        jQuery.ajax({
            type: 'POST',
            url: td_ajax_url,
            cache:false,
            data: request_data,
            dataType: 'json',
            success: function(data, textStatus, XMLHttpRequest){
                td_wp_admin_demos._install_full_td_media_2(demo_id);
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                td_wp_admin_demos._show_network_error('full_demo_media_1', MLHttpRequest, textStatus, errorThrown);
            }
        });

    },


    _install_full: function (demo_id) {
        td_wp_admin_demos._ui_install_start(demo_id);
        td_wp_progress_bar.timer_change(10);
        /* ---------------------------------------------------------------------------------------
           Remove content before install
         */
        var request_data = {
            action: 'td_ajax_demo_install',
            td_demo_action: 'remove_content_before_install',
            td_demo_id: ''
        };
        jQuery.ajax({
            type: 'POST',
            url: td_ajax_url,
            cache:false,
            data: request_data,
            dataType: 'json',
            success: function(data, textStatus, XMLHttpRequest) {
                td_wp_admin_demos._install_full_td_media_1(demo_id);
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                td_wp_admin_demos._show_network_error('full_demo_remove_content_before_install', MLHttpRequest, textStatus, errorThrown);
            }
        });






    },





    _show_network_error:function (td_ajax_request_name, MLHttpRequest, textStatus, errorThrown) {

        var responseText = MLHttpRequest.responseText.replace(/<br>/g, '\n');

        alert(
            'Ajax 错误。不能连接服务器， 这可能是由于在服务器上的错误配置。\n' +
            'textStatus: ' + textStatus + '\n' +
            'td_ajax_request_name: ' + td_ajax_request_name + '\n' +
            'errorThrown: ' + errorThrown + '\n' + '\n' +
            'responseText: ' + responseText
        );



        console.log(responseText);
    },



    _ui_install_start:function (demo_id) {
        // disable the rest of the demos + remove the installed class form the other demo
        jQuery('.td-wp-admin-demo:not(.td-demo-' + demo_id + ')')
            .addClass('td-demo-disabled')
            .removeClass('td-demo-installed')
        ;

        //add the installing class
        jQuery('.td-demo-' + demo_id).addClass('td-demo-installing');

        // show the progressbar
        td_wp_progress_bar.progress_bar_wrapper_element = jQuery('.td-demo-' + demo_id + ' .td-progress-bar-wrap');
        td_wp_progress_bar.progress_bar_element = jQuery('.td-demo-' + demo_id + ' .td-progress-bar');
        td_wp_progress_bar.show();
        td_wp_progress_bar.change(2);
    },

    _ui_install_end: function (demo_id) {
        td_wp_admin_demos._unblock_navigation();

        td_wp_progress_bar.change(100);


        setTimeout(function() {
            // hide and reset the progress bar
            td_wp_progress_bar.hide();
            td_wp_progress_bar.reset();

            //remove the installing class and add the installed class
            jQuery('.td-demo-' + demo_id)
                .removeClass('td-demo-installing')
                .addClass('td-demo-installed');

            // remove the disable class from the other demos
            jQuery('.td-demo-disabled').removeClass('td-demo-disabled');

        }, 500);

    },



    _block_navigation: function () {
        window.onbeforeunload = function() {
            return "你确定你要离开？该演示仍在安装。如果它被卡住，刷新此页面，并卸载演示，它应该能把你的网站恢复到以前的状态";
        }
    },
    _unblock_navigation: function() {
        window.onbeforeunload = '';
    }




};

td_wp_admin_demos.init();




var td_wp_progress_bar = {
    progress_bar_wrapper_element: '',
    progress_bar_element: '',
    current_value: 0,
    goto_value: 0,
    timer:'',
    last_goto_value:0,

    show: function show() {
        td_wp_progress_bar.progress_bar_wrapper_element.addClass('td-progress-bar-visible');
    },

    hide: function hide() {
        td_wp_progress_bar.progress_bar_wrapper_element.removeClass('td-progress-bar-visible');
    },

    reset:function reset() {
        clearInterval(td_wp_progress_bar.timer);
        td_wp_progress_bar.current_value = 0;
        td_wp_progress_bar.goto_value = 0;
        td_wp_progress_bar.timer = '';
        td_wp_progress_bar.last_goto_value = 0;
        td_wp_progress_bar.change(0);
    },




    change: function change(new_progress) {
        td_wp_progress_bar.progress_bar_element.css('width', new_progress + '%');
        td_wp_progress_bar.last_goto_value = new_progress;
        if (new_progress == 100) {
            clearInterval(td_wp_progress_bar.timer);
        }
    },

    timer_change: function timer_change(new_progress) {
        clearInterval(td_wp_progress_bar.timer);

        td_wp_progress_bar._ui_change(td_wp_progress_bar.last_goto_value);
        td_wp_progress_bar.current_value = td_wp_progress_bar.last_goto_value;


        clearInterval(td_wp_progress_bar.timer);
        td_wp_progress_bar.timer = setInterval(function(){
            if (Math.floor((Math.random() * 5) + 1) == 1) {
                tmp_value = Math.floor((Math.random() * 5) + 1) + td_wp_progress_bar.current_value;
                if (tmp_value <= new_progress) {
                    td_wp_progress_bar._ui_change(td_wp_progress_bar.current_value);
                    td_wp_progress_bar.current_value = tmp_value;
                } else {
                    td_wp_progress_bar._ui_change(new_progress);
                    clearInterval(td_wp_progress_bar.timer);
                }

                //console.log(tmp_value);
            }

        }, 1000);
        td_wp_progress_bar.last_goto_value = new_progress;
    },


    /**
     * change only the css
     * @param new_progress integer
     */
    _ui_change: function change(new_progress) {
        td_wp_progress_bar.progress_bar_element.css('width', new_progress + '%');
    }


};
