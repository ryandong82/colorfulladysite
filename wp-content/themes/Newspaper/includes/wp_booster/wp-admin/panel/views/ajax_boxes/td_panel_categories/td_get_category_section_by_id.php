<?php
/**
 * Created by ra on 1/13/2015.
 */
$category_id = td_util::get_http_post_val('category_id');
?>


    <!-- Category template -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">分类模板</span>
            <p>这是分类页眉</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_category',
                'item_id' => $category_id,
                'option_id' => 'tdc_category_template',
                'values' => td_api_category_template::_helper_to_panel_values('default+get_all')
            ));
            ?>
        </div>
    </div>



<div class="td-box-section-separator"></div>
    <!-- Category top posts style -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">分类顶部文章风格</span>
            <p>设置页脚布局</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_category',
                'item_id' => $category_id,
                'option_id' => 'tdc_category_top_posts_style',
                'values' => td_api_category_top_posts_style::_helper_to_panel_values('default+get_all')
            ));
            ?>
        </div>
    </div>



    <?php
    // show the $big_grid_styles_list only if we have big grids
    // Newsmag as of 10 march is not using $big_grid_styles_list
    if (!empty(td_global::$big_grid_styles_list)) {
        ?>
        <div class="td-box-row">
            <div class="td-box-description">
                <span class="td-box-title">网格风格分类顶部文章</span>
                <p>每个分类网格支持多个风格</p>
            </div>
            <div class="td-box-control-full">
                <?php
                $td_grid_style_values = array(
                    array(
                        'text' => '从全局设置继承',
                        'val' => ''
                    )
                );
                foreach (td_global::$big_grid_styles_list as $big_grid_id => $params) {
                    $td_grid_style_values []= array(
                        'text' => $params['text'],
                        'val' => $big_grid_id
                    );
                }

                echo td_panel_generator::dropdown(array(
                    'ds' => 'td_category',
                    'item_id' => $category_id,
                    'option_id' => 'tdc_category_td_grid_style',
                    'values' => $td_grid_style_values
                ));
                ?>
            </div>
        </div>
    <?php } ?>


    <div class="td-box-section-separator"></div>

    <!-- DISPLAY VIEW -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">文章显示视图</span>
            <p>选择模块类型，这是你的文章列表如何显示</p>
        </div>
        <div class="td-box-control-full td-panel-module">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_category',
                'item_id' => $category_id,
                'option_id' => 'tdc_layout',
                'values' => td_panel_generator::helper_display_modules('default+enabled_on_loops')
            ));
            ?>
        </div>
    </div>


    <div class="td-box-section-separator"></div>


    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">分页风格</span>
            <p>设置此分类分页风格</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::dropdown(array(
                'ds' => 'td_category',
                'option_id' => 'tdc_category_pagination_style',
                'item_id' => $category_id,
                'values' => array(
                    array (
                        'val' => '',
                        'text' => '从全局设置继承',
                    ),

                    array (
                        'val' => 'normal',
                        'text' => '常规页码'
                    ),
                    array (
                        'val' => 'infinite',
                        'text' => '无限加载'
                    ),
                    array (
                        'val' => 'infinite_load_more',
                        'text' => '无限加载+加载更多'
                    )
                )
            ));
            ?>
        </div>
    </div>
    <div class="td-box-section-separator"></div>

    <!-- Custom Sidebar + position -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">自定义侧边栏 + 位置</span>
            <p>侧边栏位置和自定义侧边栏</p>
        </div>
        <div class="td-box-control-full td-panel-sidebar-pos">
            <div class="td-display-inline-block">
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_category',
                    'item_id' => $category_id,
                    'option_id' => 'tdc_sidebar_pos',
                    'values' => array(
                        array('text' => '', 'title' => '', 'val' => '', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-default.png'),
                        array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                        array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                        array('text' => '', 'title' => '', 'val' => 'sidebar_right', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                    )
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">选择侧边栏位置</div>
            </div>
            <div class="td-display-inline-block td_sidebars_pulldown_align">
                <?php
                echo td_panel_generator::sidebar_pulldown(array(
                    'ds' => 'td_category',
                    'item_id' => $category_id,
                    'option_id' => 'tdc_sidebar_name'
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">创建或选择现有侧边栏</div>
            </div>
        </div>
    </div>



    <!-- Category color -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">文章页分类标签颜色</span>
            <p>在文章页为此分类选择颜色</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::color_picker(array(
                'ds' => 'td_category',
                'item_id' => $category_id,
                'option_id' => 'tdc_color',
                'default_color' => ''
            ));
            ?>
        </div>
    </div>

    <!-- BACKGROUND UPLOAD -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">背景上传</span>
            <p>上传你的背景图片。</br>你可以使用：</p>
            <ul>
                <li>单张图片</li>
                <li>图案</li>
            </ul>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::upload_image(array(
                'ds' => 'td_category',
                'item_id' => $category_id,
                'option_id' => 'tdc_image'
            ));
            ?>
        </div>
    </div>

    <!-- BACKGROUND STYLE -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">背景风格</span>
            <p>背景如何显示</p>
            <ul>
                <li><b>伸展：</b> 当你为你的背景使用单张图片，且你想此图片填充整个背景时使用此选项</li>
                <li><b>切片：</b> 当你为你的背景使用图案时使用此选项.</li>
            </ul>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::radio_button_control(array(
                'ds' => 'td_category',
                'item_id' => $category_id,
                'option_id' => 'tdc_bg_repeat',
                'values' => array(
                    array('text' => '默认', 'val' => ''),
                    array('text' => '拉伸', 'val' => 'stretch'),
                    array('text' => '切片', 'val' => 'tile')
                )
            ));
            ?>
        </div>
    </div>

    <!-- Background color -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">背景颜色</span>
            <p>使用纯色代替图片</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::color_picker(array(
                'ds' => 'td_category',
                'item_id' => $category_id,
                'option_id' => 'tdc_bg_color',
                'default_color' => ''
            ));
            ?>
        </div>
    </div>

    <!-- Hide category tag on post -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">隐藏文章和分类页分类</span>
        <p>显示或隐藏单个文章页和分类页分类。如果你想隐藏分类排序理清，这是有用的。</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::checkbox(array(
            'ds' => 'td_category',
            'item_id' => $category_id,
            'option_id' => 'tdc_hide_on_post',
            'true_value' => 'hide',
            'false_value' => ''
        ));
        ?>
    </div>
</div>
