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
function td_woocommerce_breadcrumbs()
{
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
    function woocommerce_pagination()
    {
        echo td_page_generator::get_pagination();
    }
}

// Override theme default specification for product 3 per row


// Number of product per page 8
add_filter('loop_shop_per_page', create_function('$cols', 'return 4;'));

if (!function_exists('woocommerce_output_related_products')) {
    // Number of related products
    function woocommerce_output_related_products()
    {
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
function td_bbp_change_avatar_size($author_avatar, $topic_id, $size)
{
    $author_avatar = '';
    if ($size == 14) {
        $size = 40;
    }
    $topic_id = bbp_get_topic_id($topic_id);
    if (!empty($topic_id)) {
        if (!bbp_is_topic_anonymous($topic_id)) {
            $author_avatar = get_avatar(bbp_get_topic_author_id($topic_id), $size);
        } else {
            $author_avatar = get_avatar(get_post_meta($topic_id, '_bbp_anonymous_email', true), $size);
        }
    }
    return $author_avatar;
}

add_filter('bbp_get_topic_author_avatar', 'td_bbp_change_avatar_size', 20, 3);
add_filter('bbp_get_reply_author_avatar', 'td_bbp_change_avatar_size', 20, 3);
add_filter('bbp_get_current_user_avatar', 'td_bbp_change_avatar_size', 20, 3);


//add_action('shutdown', 'test_td');

function test_td()
{
    if (!is_admin()) {
        td_api_base::_debug_get_used_on_page_components();
    }

}


/**
 * td_style_customizer.js is required
 */
if (TD_DEBUG_LIVE_THEME_STYLE) {
    add_action('wp_footer', 'td_theme_style_footer');
    function td_theme_style_footer()
    {
        ?>
        <div id="td-theme-settings" class="td-theme-settings-small">
            <div class="td-skin-header">一键演示</div>
            <div class="td-skin-content">
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper/"
                                                   class="td-set-theme-style-link">默认</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_fashion/"
                                                   class="td-set-theme-style-link">时尚</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_tech/"
                                                   class="td-set-theme-style-link" data-value="">科技</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_video/"
                                                   class="td-set-theme-style-link">视频</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_sport/"
                                                   class="td-set-theme-style-link">运动</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_classic_blog/"
                                                   class="td-set-theme-style-link">经典博客</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_travel/"
                                                   class="td-set-theme-style-link">旅游<span>新</span></a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_health/"
                                                   class="td-set-theme-style-link">健康<span>新</span></a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_cars/"
                                                   class="td-set-theme-style-link">汽车<span>新</span></a></div>
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
function auto_login_new_user($user_id)
{
    // 用户注册后自动登录
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);
    // 这里跳转到 http://域名/about 页面，请根据自己的需要修改
    wp_redirect(home_url());
    exit;
}

add_action('user_register', 'auto_login_new_user');
/**
 * 使用百度的 jquery-ui 文件
 * http://www.wpdaxue.com/wordpress-pie-register.html
 */
function cmp_add_frontend_jquery_ui()
{
    wp_enqueue_script('jquery');
    wp_deregister_script('jquery-ui-core');
    wp_register_script('jquery-ui-core', '//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js', array('jquery'), '1.10.4', false);
    wp_enqueue_script('jquery-ui-core');
}

add_action('wp_enqueue_scripts', 'cmp_add_frontend_jquery_ui', 9);

/**
 * WordPress 注册表单添加额外的字段
 * http://www.wpdaxue.com/require-additional-profile-fields-at-registration.html
 */
// 在注册界面添加额外的表单
add_action('register_form', 'additional_profile_fields');
function additional_profile_fields()
{ ?>
    <p>
        <label><?php _e('手机') ?><br/>
            <input type="text" name="phone_number" id="mobile" class="input" size="25" tabindex="20"/></label>
        <button id="btnSendVerifyCode" type="button">发送验证码</button>
        <script>
            function validate(str) {
                var reg = /^1\d{10}$/;
                return reg.test(str);
            }

            var sec = parseInt(30);
            var intervalId;
            function desTime() {
                var $btn = jQuery("#btnSendVerifyCode");
                if (sec <= 0) {
                    sec = parseInt(30);
                    $btn.text("发送验证码");
                    $btn.removeAttr("disabled");
                    clearInterval(intervalId);
                } else {
                    sec -= 1;
                    $btn.text("重新发送(" + sec + ")");
                }
            }
            jQuery(document).ready(
                function () {
                    jQuery("#btnSendVerifyCode").click(
                        function () {
                            var $btn = jQuery(this);
                            var m_number = jQuery("#first_name").val();
                            if (!validate(m_number)) {
                                alert("请入正确的手机号");
                                jQuery("#first_name")[0].focus();
                                return;
                            }
                            $btn.attr("disabled", true);
                            jQuery.ajax({
                                type: "post",
                                url: "/custom/mobile_verify.php",
                                async: true,
                                data: {
                                    phone_number: m_number
                                },
                                success: function (data) {
                                    intervalId = setInterval(desTime, 1000);
                                },
                                error: function () {
                                    alert("发送失败");
                                    $btn.removeAttr("disabled");
                                }
                            });
                        }
                    )
                }
            )
        </script>
    </p>
    <p>
        <label><?php _e('验证码') ?><br/>
            <input type="text" name="verify_code" id="edt_verify_code" class="input" size="25" tabindex="20"/></label>
    </p>
    <p>
        <label><?php _e('关于身心成长您希望在这里得到哪些帮助') ?><br/>
            <textarea name="description" id="description" class="input" size="25" tabindex="21"></textarea></label>
    </p>
<?php }


// 检查验证码是否有效
add_action('register_post', 'check_mobile_verify_code', 10, 3);
function check_mobile_verify_code($sanitized_user_login, $user_email, $errors)
{
    if ($_POST["phone_number"] != $_SESSION["mobile"])
        return $errors->add('verify_code_mob_error', '<strong>ERROR</strong>: 请输入刚刚接收验证码的手机号.');
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);
    session_start();
    if (!isset($_POST['verify_code']) || empty($_POST['verify_code'])) {
        return $errors->add('verify_code_empty', '<strong>ERROR</strong>: 请输验证码.');
    }
    if (!$redis->get(session_id() . '_verify_code')) {
        return $errors->add('verify_code_expired', '验证码已经过期');
    }else
    {
        if ($redis->get(session_id() . '_verify_code')!=$_POST['verify_code'])
        return $errors->add('verify_code_expired', '<strong>ERROR</strong>: 验证码错误.');
    }
}

// 将用户填写的字段内容保存到数据库中
add_action('user_register', 'insert_register_fields');
function insert_register_fields($user_id)
{

    $user_phone_number = apply_filters('pre_user_phone_number', $_POST['phone_number']);
    $description = apply_filters('pre_user_description', $_POST['description']);
    // 以下的 'first_name' 和 'last_name' 是“我的个人资料”中已有的字段
    update_user_meta($user_id, 'user_phone_number', $user_phone_number);
    update_user_meta($user_id, 'description', $description);
}
//add_action('init', 'check_login');

function check_login()
{
    if ( is_user_logged_in() ) {
        echo 'Welcome, registered user!';
      } else {
        echo 'Welcome, visitor!';
      }
    echo is_user_logged_in();
    //if (!is_user_logged_in())
    {
        //header("Location:../index.php");

        exit();
    }
}