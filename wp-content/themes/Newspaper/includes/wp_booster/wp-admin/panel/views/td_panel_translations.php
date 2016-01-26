<!-- Translations -->

<?php echo td_panel_generator::box_start('加载一个可用的翻译', false); ?>

<div class="td-box-row">
    <div class="td-box-description td-box-full">
        <span class="td-box-title">更多信息：</span>
        <p>可用的翻译：英语，荷兰语，芬兰语，德语，希腊语，印地文，印尼文，日文，马拉地语，波兰语，葡萄牙语，罗马尼亚语，俄语，西班牙语，泰米尔语，泰语，土耳其语和乌尔都语。其余的是通过谷歌翻译翻译。请注意，翻译是从我们的服务器加载。</p>
        <p><strong style="margin-right: 2px">注意：</strong>英语翻译是我们的主题的默认翻译，将为翻译输入字段设置默认值。</p>
    </div>
</div>

<div class="td-box-row">
    <div class="td-box-description">
            <div class="td-box-control-full">
                <?php

                td_util::update_option('tds_language', '');

                $languages[] = array(
                    'text' => '选择一种语言...',
                    'val' => ''
                );

                foreach (td_global::$translate_languages_list as $language_code => $language_name){
                    $languages[] = array(
                        'text' => $language_name,
                        'val' => $language_code
                    );
                }

                echo td_panel_generator::dropdown(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_language',
                    'values' => $languages
                ));
                ?>
            </div>
    </div>

    <a id="load_translation" class="td-big-button td-medium-button" href="">加载翻译</a>

</div>

<?php echo td_panel_generator::box_end();?>




<script>

    // namespace used just for translations
    var td_translation = {

        /**
         * this method is called just when the thickbok popup is shown and it's used to synchronize the two languages list [loaded languages, sent languages]
         */
        select_loaded_language: function() {
            // current selection of a possible loaded language
            var loaded_language_code = jQuery("#td-panel-translates").find('select[name="td_option[tds_language]"]:first option:selected').val();

            // if it's a valuable selection in the loaded language list, the same value is set in the modal popup
            if (loaded_language_code != undefined && loaded_language_code != '') {
                jQuery("#modal_window_send_tranlation_language").find('select[name="td_option[tds_language]"]:first').val(loaded_language_code);
            }

            // prepare the modal interface to be redrawn
            jQuery("#thanks_send_translation").hide();
        },


        /**
         * this method sends the user translation to our server
         */
        send_translation: function(td_theme_name, td_theme_version, td_cake_status) {

            // detect the modal thickbox popup. This jQuery object does not exist until the thickbox modal popup is built.
            var jqTBWindow = jQuery("#TB_window");

            if (jqTBWindow.length) {
                var selected_language_code  = jqTBWindow.find('select[name="td_option[tds_language]"] option:selected').val();

                if (selected_language_code == '') {
                    alert('Please choose a language!');
                    return;
                }

                if (selected_language_code != undefined && selected_language_code != '') {


                    // initialize data parameters adding selected language, td_cake_status, theme name, theme version
                    var data = {
                        language_code: selected_language_code,
                        td_product_name: '\'' + td_theme_name + '\'',
                        td_product_version: '\'' + td_theme_version + '\'',
                        td_cake_status: '\'' + td_cake_status + '\''
                    };

                    // create data parameters
                    jQuery('#td-panel-translates').find('input[name^="td_translate"]').each(function(index, element) {
                        data[this.name] = this.value;
                    });

                    jQuery.ajax({
                        crossDomain: true,

                        // jsonp parameter is used for crossdomain requests compatibility. It is now used in send_translation, because there's no response.
                        dataType: 'jsonp',
                        // jsonpCallback parameter is used for crossdomain requests compatibility. It is now used in send_translation, because there's no response.
                        jsonpCallback: 'jsonpCallback',

                        url: 'http://api.tagdiv.com/user_translations/add_full_user_translation',

                        data: data
                    });

                    jQuery("#thanks_send_translation").show();

                    setTimeout(function() {
                            jQuery('#TB_closeWindowButton').trigger('click');
                        },
                        1000
                    );
                }
            }
        },


        /**
         * this method populate translated input fields with values
         */
        completeTranslation: function(data) {
            for (var prop in data) {
                var jqObj = jQuery('input[name="td_translate[' + prop + ']"]');

                if(jqObj.length) {
                    jqObj.val(data[prop]);
                }
            }
        },


        /**
         * this method clear input translated field values
         */
        clear_translation: function() {
            jQuery('#td-panel-translates').find('input[name^="td_translate"]').each(function(index, element) {
                jQuery(element).val('');
            });
        }

    };


    jQuery().ready(function() {

        jQuery("#load_translation").click(function (event) {
            event.preventDefault();

            var selected_language_code = jQuery("#td-panel-translates").find('select[name="td_option[tds_language]"]:first option:selected').val();

            if (selected_language_code == '') {
                alert('请选择一种语言');
                return;
            }

            if (!confirm("你确定？\n\n加载语言设置将覆盖你在'翻译'面板的自定义翻译。\n你需要在你的主题保存主题来保持加载翻译。")) {
                return false;
            }

            // we clear the translation for english language, english being the default translation
            if (selected_language_code == 'en') {
                td_translation.clear_translation();
                return;
            }

            if (selected_language_code != undefined && selected_language_code != '') {
                jQuery.ajax({
                    crossDomain: true,

                    // jsonp parameter is used for crossdomain requests. It's used for response type. It must be jsonp and not json.
                    dataType: 'jsonp',
                    // jsonpCallback parameter is used for crossdomain requests. It's used for response type. (must be wrapped in 'jsonpCallback')
                    jsonpCallback: 'jsonpCallback',

                    url: 'http://api.tagdiv.com/user_translations/get_translation',

                    data: {
                        'language_code': selected_language_code
                    },
                    complete: function (jqXHR, textStatus) {
                        if (textStatus == 'success') {
                            if (jqXHR.responseJSON.constructor === Object) {

                                // show the content panel updated with response values
                                show_content_panel(

                                    // this is the jquery object to be loaded
                                    jQuery('#panel_translation_custom_id'),

                                    // this parameter keep the open position
                                    true,

                                    // this is callback function. It completes the fields
                                    function () {
                                        td_translation.completeTranslation(jqXHR.responseJSON)
                                    }
                                );
                            }
                        }
                    }
                });
            }
        });

    });


</script>

<?php

echo td_panel_generator::ajax_box('翻译', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_translations',
    ),
    'panel_translation_custom_id'
);
?>
