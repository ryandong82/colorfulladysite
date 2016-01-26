<?php
/*
    Our portfolio:  http://themeforest.net/user/tagDiv/portfolio
    Thanks for using our theme !
    tagDiv - 2015
*/

/**
 * Load the speed booster framework + theme specific files
 */
if (!defined('TD_THEME_WP_BOOSTER')) {
    require_once('td_deploy_mode.php');
    require_once('includes/td_config.php');
    require_once('includes/wp_booster/td_wp_booster_functions.php');
}

require_once('includes/td_css_generator.php');
require_once('includes/shortcodes/td_misc_shortcodes.php');
require_once('includes/widgets/td_page_builder_widgets.php'); // widgets





/* ----------------------------------------------------------------------------
 * Woo Commerce
 */

// breadcrumb
add_filter('woocommerce_breadcrumb_defaults', 'td_woocommerce_breadcrumbs');
function td_woocommerce_breadcrumbs() {
	return array(
		'delimiter' => ' <i class="td-icon-right td-bread-sep"></i> ',
		'wrap_before' => '<div class="entry-crumbs" itemprop="breadcrumb">',
		'wrap_after' => '</div>',
		'before' => '',
		'after' => '',
		'home' => _x('Home', 'breadcrumb', 'woocommerce'),
	);
}

// use own pagination
if (!function_exists('woocommerce_pagination')) {
	// pagination
	function woocommerce_pagination() {
		echo td_page_generator::get_pagination();
	}
}

// Override theme default specification for product 3 per row


// Number of product per page 8
add_filter('loop_shop_per_page', create_function('$cols', 'return 4;'));

if (!function_exists('woocommerce_output_related_products')) {
	// Number of related products
	function woocommerce_output_related_products() {
		woocommerce_related_products(array(
			'posts_per_page' => 4,
			'columns' => 4,
			'orderby' => 'rand',
		)); // Display 4 products in rows of 1
	}
}




/* ----------------------------------------------------------------------------
 * bbPress
 */
// change avatar size to 40px
function td_bbp_change_avatar_size($author_avatar, $topic_id, $size) {
	$author_avatar = '';
	if ($size == 14) {
		$size = 40;
	}
	$topic_id = bbp_get_topic_id( $topic_id );
	if ( !empty( $topic_id ) ) {
		if ( !bbp_is_topic_anonymous( $topic_id ) ) {
			$author_avatar = get_avatar( bbp_get_topic_author_id( $topic_id ), $size );
		} else {
			$author_avatar = get_avatar( get_post_meta( $topic_id, '_bbp_anonymous_email', true ), $size );
		}
	}
	return $author_avatar;
}
add_filter('bbp_get_topic_author_avatar', 'td_bbp_change_avatar_size', 20, 3);
add_filter('bbp_get_reply_author_avatar', 'td_bbp_change_avatar_size', 20, 3);
add_filter('bbp_get_current_user_avatar', 'td_bbp_change_avatar_size', 20, 3);



//add_action('shutdown', 'test_td');

function test_td () {
    if (!is_admin()){
        td_api_base::_debug_get_used_on_page_components();
    }

}


/**
 * td_style_customizer.js is required
 */
if (TD_DEBUG_LIVE_THEME_STYLE) {
    add_action('wp_footer', 'td_theme_style_footer');
    function td_theme_style_footer() {
        ?>
        <div id="td-theme-settings" class="td-theme-settings-small">
            <div class="td-skin-header">一键演示</div>
            <div class="td-skin-content">
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper/" class="td-set-theme-style-link">默认</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_fashion/" class="td-set-theme-style-link">时尚</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_tech/" class="td-set-theme-style-link" data-value="">科技</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_video/" class="td-set-theme-style-link">视频</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_sport/" class="td-set-theme-style-link">运动</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_classic_blog/" class="td-set-theme-style-link">经典博客</a></div>
	            <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_travel/" class="td-set-theme-style-link">旅游<span>新</span></a></div>
	            <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_health/" class="td-set-theme-style-link">健康<span>新</span></a></div>
	            <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_cars/" class="td-set-theme-style-link">汽车<span>新</span></a></div>
            </div>
            <div class="clearfix"></div>
            <div class="td-set-hide-show"><a href="#" id="td-theme-set-hide">隐藏</a></div>
        </div>
    <?php
    }
}

/**
  * 用户注册成功后自动登录，并跳转到指定页面
  * http://www.wpdaxue.com/user-first-login-redirect.html
  */  
function auto_login_new_user( $user_id ) {
	// 用户注册后自动登录
	wp_set_current_user($user_id);
	wp_set_auth_cookie($user_id);
	// 这里跳转到 http://域名/about 页面，请根据自己的需要修改
	wp_redirect( home_url()); 
	exit;
}
add_action( 'user_register', 'auto_login_new_user');
/**
* 使用百度的 jquery-ui 文件
* http://www.wpdaxue.com/wordpress-pie-register.html
*/
function cmp_add_frontend_jquery_ui() {
	wp_enqueue_script('jquery');
	wp_deregister_script('jquery-ui-core');
	wp_register_script('jquery-ui-core', '//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js',array('jquery'),'1.10.4',false);
	wp_enqueue_script('jquery-ui-core');
}
add_action('wp_enqueue_scripts', 'cmp_add_frontend_jquery_ui',9);
