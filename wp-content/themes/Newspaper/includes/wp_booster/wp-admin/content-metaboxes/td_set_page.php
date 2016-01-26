<div class="td-page-options-tab-wrap">
    <div class="td-page-options-tab td-page-options-tab-active" data-panel-class="td-page-option-general"><a href="#">常规</a></div>
    <div class="td-page-options-tab" data-panel-class="td-page-option-unique-articles-2"><a href="#">独特文章</a></div>
</div>
<div class="td-meta-box-inside">



    <!-- page option general -->
    <div class="td-page-option-panel td-page-option-panel-active td-page-option-general">
        <p><strong>注意：</strong>如果你不想在此模板使用可视化编辑器，仅此框设置工作。模板检查visual composer是否使用，如果这样的话，它删除标题和侧边栏 </p>


        <!-- sidebar position -->
        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">
                侧边栏位置：
                <?php
                td_util::tooltip_html('
                        <h3>侧边栏位置：</h3>
                        <p>从这里你可以只为此页面设置侧边栏位置。</p>
                        <ul>
                            <li><strong>此设置覆盖</strong>来自<i>模板设置 > 页面模板</i>的主题面板。</li>
                            <li><strong>默认</strong> - 文章将在主分类设置看到，且它将尝试从那里获取位置。如果主分类没有自定义侧边伴位置，文章将从<i>模板设置 > 博客和文章模板</i>加载设置</li>
                            <li>此设置的目的是在内容页使用，当此模板检查到Visual Composer使用时，它将切换到全宽布局（无侧边栏）</li>
                            <li>如果你想使用Visual Composer带侧边栏，请使用小工具化侧边栏区块</li>

                        </ul>
                    ', 'right')
                ?>
            </span>
            <div class="td-inline-block-wrap">
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_page',
                    'item_id' => '',
                    'option_id' => 'td_sidebar_position',
                    'values' => array(
                        array('text' => '', 'title' => '', 'val' => '', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-default.png'),
                        array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                        array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                        array('text' => '', 'title' => '', 'val' => 'sidebar_right', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                    ),
                    'selected_value' => $mb->get_the_value('td_sidebar_position')
                ));
                ?>
            </div>
        </div>


        <!-- custom sidebar -->
        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">
                自定义侧边栏：
                <?php
                td_util::tooltip_html('
                        <h3>自定义侧边栏：</h3>
                        <p>从这里你可以仅为此页面设置自定义侧边栏</p>
                        <ul>
                            <li><strong>此设置覆盖</strong>来自<i>模板设置 > 页面模板</i>的主题面板。</li>
                            <li><strong>默认</strong> - 文章将在主分类设置看到，且它将尝试从那里获取位置。如果主分类没有自定义侧边伴位置，文章将从<i>模板设置 > 博客和文章模板</i>加载设置</li>
                            <li>此设置的目的是在内容页使用，当此模板检查到Visual Composer使用时，它将切换到全宽布局（无侧边栏）</li>
                            <li>如果你想使用Visual Composer带侧边栏，请使用小工具化侧边栏区块</li>
                        </ul>
                    ', 'right')
                ?>
            </span>
            <?php
            echo td_panel_generator::sidebar_pulldown(array(
                'ds' => 'td_page',
                'item_id' => '',
                'option_id' => 'td_sidebar',
                'selected_value' => $mb->get_the_value('td_sidebar')
            ));
            ?>
        </div>
    </div> <!-- /page option general -->




    <!-- unique articles tab -->
    <div class="td-page-option-panel td-page-option-unique-articles-2">

        <p>
            <strong>注意：</strong>如果你计划使用ajax区块，没有子分类或页码，我们推荐不使用独特文章功能。此功能将确保在页面初始加载时只有唯一的文章.
        </p>

        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">
                独特文章：
            </span>
            <?php $mb->the_field('td_unique_articles'); ?>
            <div class="td-select-style-overwrite td-inline-block-wrap">
                <select name="<?php $mb->the_name(); ?>" class="td-panel-dropdown">
                    <option value=""> - 禁用 - </option>
                    <option value="enabled"<?php $mb->the_select_state('enabled'); ?>>启用</option>
                </select>
            </div>
        </div>
    </div><!-- /page option general -->
</div>



