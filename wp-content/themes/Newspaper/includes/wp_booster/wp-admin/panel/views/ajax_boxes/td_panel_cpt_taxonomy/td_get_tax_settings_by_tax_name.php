<?php
/**
 * Created by ra on 1/13/2015.
 */
$taxonomy_name = td_util::get_http_post_val('taxonomy_name');
?>





<!-- DISPLAY VIEW -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">文章显示视图</span>
        <p>选择模块类型，这是您的文章列表如何显示。对于自定义的模块或微调，阅读<a target="_blank" href="http://forum.tagdiv.com/api-modules-introduction/">模块API</a></p>
    </div>
    <div class="td-box-control-full td-panel-module">
        <?php
        echo td_panel_generator::visual_select_o(array(
            'ds' => 'td_taxonomy',
            'item_id' => $taxonomy_name,
            'option_id' => 'tds_taxonomy_page_layout',
            'values' => td_panel_generator::helper_display_modules('enabled_on_loops')
        ));
        ?>
    </div>
</div>



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
                'ds' => 'td_taxonomy',
                'item_id' => $taxonomy_name,
                'option_id' => 'tds_taxonomy_sidebar_pos',
                'values' => array(
                    array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                    array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                    array('text' => '', 'title' => '', 'val' => '', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                )
            ));
            ?>
            <div class="td-panel-control-comment td-text-align-right">选择侧边栏位置</div>
        </div>
        <div class="td-display-inline-block td_sidebars_pulldown_align">
            <?php
            echo td_panel_generator::sidebar_pulldown(array(
                'ds' => 'td_taxonomy',
                'item_id' => $taxonomy_name,
                'option_id' => 'tds_taxonomy_sidebar'
            ));
            ?>
            <div class="td-panel-control-comment td-text-align-right">创建或选择现有侧边栏</div>
        </div>
    </div>
</div>