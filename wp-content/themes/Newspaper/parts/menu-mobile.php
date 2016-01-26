<?php

/*  ----------------------------------------------------------------------------
    This is the mobile off canvas menu
 */

?>
<div id="td-mobile-nav">
    <!-- mobile menu close -->
    <div class="td-mobile-close">
        <a href="#"><?php _etd('CLOSE', TD_THEME_NAME); ?></a>
        <div class="td-nav-triangle"></div>
    </div>

    <div class="td-mobile-content">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'header-menu',
            'menu_class'=> '',
            'fallback_cb' => 'td_wp_no_mobile_menu'
        ));

        //if no menu
        function td_wp_no_mobile_menu() {
            //this is the default menu
            echo '<ul class="">';
            echo '<li class="menu-item-first"><a href="' . esc_url(home_url( '/' )) . 'wp-admin/nav-menus.php">点击这里 - 使用WP菜单生成器</a></li>';
            echo '</ul>';
        }

        ?>
    </div>
</div>