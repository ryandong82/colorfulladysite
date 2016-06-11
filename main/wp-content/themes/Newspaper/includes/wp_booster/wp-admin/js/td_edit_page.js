/**
 * used in wp-admin -> edit page, not on posts
 * this class hides and shows the metaboxes acording to the selected template
 * @type {{init: Function, show_template_settings: Function, change_content: Function}}
 */
var td_edit_page = {

    init: function () {
        jQuery().ready(function() {
            td_edit_page.show_template_settings();

            jQuery('#page_template').change(function() {
                td_edit_page.show_template_settings();
            });
        });

    },


    show_template_settings: function () {
        if (jQuery('#post_type').val() == 'post') {
            return;
        }


        //text and image after template drop down
        td_edit_page.change_content();


        //hide all elements

        var cur_template = jQuery('#page_template option:selected').text();

        // the show only unique articles box is always visible
        switch (cur_template) {
            case '页面生成器 + 最新文章 + 页码':
                jQuery('#td_page_metabox').hide();
                jQuery('#td_homepage_loop_metabox').slideDown();
                td_edit_page.change_content('<span class="td-wpa-info"><strong>提示：</strong>从页面生成器部分和以下循环制作首页。<ul><li>循环支持可选侧边栏和高级筛选选项。</li> <li>如果向下滚动，你可以找到此模板所有选项。</li></ul></span>');
                break;

            case '页面生成器 + 页面标题':
                jQuery('#td_homepage_loop_metabox').hide();
                jQuery('#td_page_metabox').slideDown();
                td_edit_page.change_content('<span class="td-wpa-info"><strong>提示：</strong>当你使用visual composer创建页面并有一个标准标题时，这很有用。我们推荐你选择无侧边栏获取最佳效果。</span>');
                break;

            default: //default template
                jQuery('#td_homepage_loop_metabox').hide();
                jQuery('#td_page_metabox').slideDown();
                td_edit_page.change_content('<span class="td-wpa-info"><strong>提示：</strong>默认模板，完美适合visual composer或内容页面。<ul><li>如果使用visual composer，页面将不带标题。</li> <li>如果它是内容页面，模板将生成标题</li></ul></span>');
                break;
        }
    },


    change_content: function (the_text) {
        if(document.getElementById("td_after_template_container_id")) {
            var after_element = document.getElementById("td_after_template_container_id");
            after_element.innerHTML = "";
            if(typeof the_text != 'undefined') {
                after_element.innerHTML = the_text;
            }
        } else {
            if(document.getElementById("page_template")) {
                //create the container
                var after_element = document.createElement("div");
                after_element.setAttribute("id", "td_after_template_container_id");
                //insert the element in DOM, after template pull down
                document.getElementById("page_template").parentNode.insertBefore(after_element, document.getElementById("page_template").nextSibling);
            }
        }
    }
};

td_edit_page.init();
