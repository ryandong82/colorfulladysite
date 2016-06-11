<div class="td-meta-box-inside">

    <!-- post option general -->
    <div class="td-page-option-panel td-post-option-general td-page-option-panel-active">


        <!-- sidebar position -->
        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">
                侧边栏位置
                <?php
                td_util::tooltip_html('
                        <h3>侧边栏位置：</h3>
                        <p>在这里可以为单独的产品设置WooCommerce侧边栏位置。</p>
                        <ul>
                            <li><strong>此设置覆盖</strong>来自<i>模板设置 > WooCommerce > 单个产品页</i>的主题面板设置</li>
                            <li><strong>默认</strong> - Woocommerce单个产品页全局设置将应用</li>

                        </ul>
                    ', 'right')
                ?>
            </span>
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_post_theme_settings',
                'item_id' => '',
                'option_id' => 'td_sidebar_position',
                'values' => array(
                    array('text' => '', 'title' => '', 'val' => '', 'class' => 'td-sidebar-position-default', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-default.png'),
                    array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'class' => 'td-sidebar-position-left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                    array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'class' => 'td-no-sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                    array('text' => '', 'title' => '', 'val' => 'sidebar_right', 'class' => 'td-sidebar-position-right','img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                ),
                'selected_value' => $mb->get_the_value('td_sidebar_position')
            ));
            ?>
        </div>


        <!-- custom sidebar -->
        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">
                自定义侧边栏：
                <?php
                td_util::tooltip_html('
                        <h3>自定义侧边栏：</h3>
                        <p>此设置允许只在此产品页加载自定义侧边栏</p>
                        <ul>
                            <li><strong>此设置覆盖</strong>来自<i>模板设置 > WooCommerce > 首页 + 归档</i>的主题面板设置</li>
                            <li><strong>默认</strong> - 来自WooCommerce 首页 + 归档的全局设置将应用</li>
                        </ul>
                    ', 'right')
                ?>
            </span>
            <?php
            echo td_panel_generator::sidebar_pulldown(array(
                'ds' => 'td_post_theme_settings',
                'item_id' => '',
                'option_id' => 'td_sidebar',
                'selected_value' => $mb->get_the_value('td_sidebar')
            ));
            ?>
        </div>






    </div> <!-- /post option general -->



</div>

