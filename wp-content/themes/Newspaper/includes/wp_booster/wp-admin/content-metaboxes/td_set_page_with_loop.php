<div class="td-page-options-tab-wrap">
    <div class="td-page-options-tab td-page-options-tab-active" data-panel-class="td-page-option-general"><a href="#">常规</a></div>
    <div class="td-page-options-tab" data-panel-class="td-page-option-post-list"><a href="#">文章循环设置</a></div>
    <div class="td-page-options-tab" data-panel-class="td-page-option-unique-articles"><a href="#">独特的文章</a></div>
</div>


<div class="td-meta-box-inside">



    <!-- page option general -->
    <div class="td-page-option-panel td-page-option-panel-active td-page-option-general">


        <p><strong>注意：</strong>不同于默认模板，此面板的设置适用于页面底部（其循环+侧边栏） </p>



        <!-- sidebar position -->
        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">
                侧边栏位置：
                <?php
                td_util::tooltip_html('
                        <h3>侧边栏位置：</h3>
                        <p>从这里你可以设置页面底部侧边栏位置。</p>
                        <ul>
                            <li><strong>不选</strong> - 模板将在右侧加载侧边栏</li>
                        </ul>
                    ', 'right')
                ?>
            </span>
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_homepage_loop',
                'item_id' => '',
                'option_id' => 'td_sidebar_position',
                'values' => array(
                    array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                    array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                    array('text' => '', 'title' => '', 'val' => 'sidebar_right', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                ),
                'selected_value' => $mb->get_the_value('td_sidebar_position')
            ));
            ?>
        </div>


        <!-- sidebar -->
        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">
                侧边栏：
                <?php
                td_util::tooltip_html('
                        <h3>侧边栏：</h3>
                        <p>从这里可以从页面部分选择自定义侧边栏。</p>
                        <ul>
                            <li><strong>不选</strong> - 模板将加载<i>' . TD_THEME_NAME . '默认</i>侧边栏</li>
                        </ul>
                    ', 'right')
                ?>
            </span>
            <?php
            echo td_panel_generator::sidebar_pulldown(array(
                'ds' => 'td_homepage_loop',
                'item_id' => '',
                'option_id' => 'td_sidebar',
                'selected_value' => $mb->get_the_value('td_sidebar')
            ));
            ?>
        </div>



        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">模板布局：</span>
            <img class="td-doc-image-wp td-doc-image-homepage-loop" style="max-width: 100%" src="<?php echo get_template_directory_uri() ?>/includes/wp_booster/wp-admin/images/info-homepage-loop.jpg" />
        </div>
    </div>





    <!-- Posts loop settings -->
    <div class="td-page-option-panel td-page-option-post-list">
        <!-- Layout -->
        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">
                布局：
                <?php
                td_util::tooltip_html('
                        <h3>布局选择：</h3>
                        <p>选择自定义模块用于此页面循环。</p>
                        <ul>
                            <li>如果你想要自己的模块，请去我们的文档<a href="http://forum.tagdiv.com/api-modules-introduction/" target="_blank">API部分</a></li>
                        </ul>
                    ', 'right')
                ?>
            </span>
                <div class="td-page-o-visual-select-modules">
                    <?php
                    echo td_panel_generator::visual_select_o(array(
                        'ds' => 'td_homepage_loop',
                        'item_id' => '',
                        'option_id' => 'td_layout',
                        'values' => td_panel_generator::helper_display_modules('default+enabled_on_loops'),
                        'selected_value' => $mb->get_the_value('td_layout')
                    ));
                    ?>
                </div>
        </div>

        <!-- show or hide the title -->
        <div class="td-meta-box-row">
            <?php $mb->the_field('list_custom_title_show'); ?>
            <span class="td-page-o-custom-label">
                显示列表标题：
                <?php
                td_util::tooltip_html('
                        <h3>显示列表标题：</h3>
                        <p>隐藏或显示循环标题。它可以为某些东西，比如"最新文章" 等.</p>
                    ', 'right')
                ?>
            </span>
            <div class="td-select-style-overwrite">
                <select name="<?php $mb->the_name(); ?>" class="td-panel-dropdown">
                    <option value="">显示标题</option>
                    <option value="hide_title"<?php $mb->the_select_state('hide_title'); ?>>隐藏标题</option>
                </select>
            </div>
       </div>

        <!-- custom title for article list -->
        <div class="td-meta-box-row">
            <?php $mb->the_field('list_custom_title'); ?>
            <span class="td-page-o-custom-label">
                文章列表标题：
                <?php
                td_util::tooltip_html('
                        <h3>循环使用标题：</h3>
                        <p>它可以为某些东西，比如 "最新文章" 等.</p>
                    ', 'right')
                ?>
            </span>
            <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
            <span class="td-page-o-info">自定义文章列表部分标题</span>
        </div>


        <div class="td-meta-box-row td-meta-box-row-separator">
            <h3>循环筛选：</h3>
        </div>

        <?php
        class td_set_homepage_loop_filter {

            public function __construct()  { }

            /**
             *  setting the array that will be used for homepage filter
             * @return array
             */
            function homepage_filter_get_map () {

                //get the generic filter array
                $generic_filter_array = td_wp_booster_config::get_map_filter_array();

                //remove items from array
                $offset = 0;
                foreach ($generic_filter_array as $field_array) {
                    if ($field_array['param_name'] == "hide_title") {
                        array_splice($generic_filter_array, $offset, 1);
                    }
                    $offset++;
                }

                //change the default limit
                $generic_filter_array[6]['value'] = 10;

                //add the show featured posts in the loop setting
                array_push ($generic_filter_array,
                    array(
                        "param_name" => "show_featured_posts",
                        "type" => "dropdown",
                        "value" => array('- 显示精选文章 -' => '', '隐藏精选文章' => 'hide_featured'),
                        "heading" => '精选文章：',
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    )
                );

                return array(
                    "name" => 'Templates with articles',
                    "base" => "",
                    "class" => "",
                    "controls" => "full",
                    "category" => "",
                    'icon' => '',
                    "params" => $generic_filter_array
                );
            }

        }//end class

        $obj_td_homepage_filter_add = new td_set_homepage_loop_filter;
        //instantiates the filter render object, passing metabox object
        $td_metabox_generator = new td_metabox_generator($mb);

        //call to create the filter
        $td_metabox_generator->td_render_homepage_loop_filter($obj_td_homepage_filter_add->homepage_filter_get_map());

        ?>
    </div> <!-- end post loop filter -->




    <!-- page option general -->
    <div class="td-page-option-panel td-page-option-unique-articles">
        <p>
            <strong>注意：</strong>如果你计划使用ajax区块，没有子分类或页码，我们推荐不使用独特文章功能。此功能将确保在页面初始加载时只有唯一的文章.
        </p>

        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">独特文章：</span>
            <?php $mb->the_field('td_unique_articles'); ?>
            <div class="td-select-style-overwrite td-inline-block-wrap">
                <select name="<?php $mb->the_name(); ?>" class="td-panel-dropdown">
                    <option value=""> - 禁用 - </option>
                    <option value="enabled"<?php $mb->the_select_state('enabled'); ?>>启用</option>
                </select>
            </div>
        </div>
    </div><!-- /page option general -->



</div><!-- /.td-meta-box-inside -->


