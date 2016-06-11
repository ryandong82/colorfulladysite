<?php

require_once "td_view_header.php";
?>
<div class="about-wrap td-admin-wrap">
    <h1><?php echo TD_THEME_NAME ?>系统状态</h1>
    <div class="about-text" style="margin-bottom: 32px;">

        <p>
            在这里，您可以检查系统状态。黄色状态意味着网站将在前台作为预期工作，但它可能在wp-admin出现问题。
            <strong>内存通知：</strong> - 主题与40MB/请求限制测试，但插件可能需要更多，例如woocommerce需要64MB.
        </p>


    </div>




    <?php


    /*  ----------------------------------------------------------------------------
        Theme config
     */

    // Theme name
    td_system_status::add('主题配置', array(
        'check_name' => '主题名字',
        'tooltip' => '',
        'value' =>  TD_THEME_NAME,
        'status' => 'info'
    ));

    // Theme version
    td_system_status::add('主题配置', array(
        'check_name' => '主题版本',
        'tooltip' => '',
        'value' =>  TD_THEME_VERSION,
        'status' => 'info'
    ));

    // Theme database version
    td_system_status::add('主题配置', array(
        'check_name' => '主题数据库版本',
        'tooltip' => '',
        'value' =>  td_util::get_option('td_version'),
        'status' => 'info'
    ));

    // speed booster
    if (defined('TD_SPEED_BOOSTER')) {
        if (defined('TD_SPEED_BOOSTER_INCOMPATIBLE')) {
            td_system_status::add('主题配置', array(
                'check_name' => '加速器',
                'tooltip' => '',
                'value' =>  TD_SPEED_BOOSTER . ' - 禁用 - 不兼容的插件检测：<strong>' . TD_SPEED_BOOSTER_INCOMPATIBLE . '</strong>',
                'status' => 'yellow'
            ));
        } else {
            if (version_compare(TD_SPEED_BOOSTER, 'v4.0', '<')) {
                td_system_status::add('主题配置', array(
                    'check_name' => '加速器',
                    'tooltip' => '',
                    'value' =>  TD_SPEED_BOOSTER . ' - 检测到旧版本的加速器。请卸载它！',
                    'status' => 'red'
                ));
            } else {
                td_system_status::add('主题配置', array(
                    'check_name' => '加速器',
                    'tooltip' => '',
                    'value' =>  TD_SPEED_BOOSTER . ' - 激活',
                    'status' => 'info'
                ));
            }


        }


    }



    /*  ----------------------------------------------------------------------------
        Server status
     */

    // server info
    td_system_status::add('php.ini配置', array(
        'check_name' => '服务器软件',
        'tooltip' => '',
        'value' =>  esc_html( $_SERVER['SERVER_SOFTWARE'] ),
        'status' => 'info'
    ));

    // php version
    td_system_status::add('php.ini配置', array(
        'check_name' => 'PHP版本',
        'tooltip' => '',
        'value' => phpversion(),
        'status' => 'info'
    ));

    // post_max_size
    td_system_status::add('php.ini配置', array(
        'check_name' => 'post_max_size',
        'tooltip' => '',
        'value' =>  ini_get('post_max_size') . '<span class="td-status-small-text"> - 你不能上传图片，主题和插件大小大于此值。</span>',
        'status' => 'info'
    ));

    // php time limit
    $max_execution_time = ini_get('max_execution_time');
    if ($max_execution_time == 0 or $max_execution_time >= 60) {
        td_system_status::add('php.ini配置', array(
            'check_name' => 'max_execution_time',
            'tooltip' => '',
            'value' =>  $max_execution_time,
            'status' => 'green'
        ));
    } else {
        td_system_status::add('php.ini配置', array(
            'check_name' => 'max_execution_time',
            'tooltip' => '',
            'value' =>  $max_execution_time . '<span class="td-status-small-text"> - 如果你打算使用演示，执行时间应大于60</span>',
            'status' => 'yellow'
        ));
    }


    // php max input vars
    $max_input_vars = ini_get('max_input_vars');
    if ($max_input_vars == 0 or $max_input_vars >= 2000) {
        td_system_status::add('php.ini配置', array(
            'check_name' => 'max_input_vars',
            'tooltip' => '',
            'value' =>  $max_input_vars,
            'status' => 'green'
        ));
    } else {
        td_system_status::add('php.ini配置', array(
            'check_name' => 'max_input_vars',
            'tooltip' => '',
            'value' =>  $max_input_vars . '<span class="td-status-small-text"> - 该max_input_vars应大于2000，否则可能会导致WordPress菜单保存不完整</span>',
            'status' => 'yellow'
        ));
    }

    // suhosin
    if (extension_loaded('suhosin') !== true) {
        td_system_status::add('php.ini配置', array(
            'check_name' => 'SUHOSIN安装',
            'tooltip' => '',
            'value' => '否',
            'status' => 'green'
        ));
    } else {
        td_system_status::add('php.ini配置', array(
            'check_name' => 'SUHOSIN安装',
            'tooltip' => '',
            'value' =>  'SUHOSIN已安装<span class="td-status-small-text"> - 如果它没有配置正确，它可能导致保存主题面板出现问题。</span>',
            'status' => 'yellow'
        ));
    }







    /*  ----------------------------------------------------------------------------
        WordPress
    */
    // home url
    td_system_status::add('WordPress和插件', array(
        'check_name' => 'WP首页网址',
        'tooltip' => 'test tooltip',
        'value' => home_url(),
        'status' => 'info'
    ));

    // site url
    td_system_status::add('WordPress和插件', array(
        'check_name' => 'WP网站网址',
        'tooltip' => 'test tooltip',
        'value' => site_url(),
        'status' => 'info'
    ));

    // home_url == site_url
    if (home_url() != site_url()) {
        td_system_status::add('WordPress和插件', array(
            'check_name' => '首页网址 - 网站网址',
            'tooltip' => '主页网址不等于网站的URL，这可能表明你的WordPress配置有问题。',
            'value' => '首页网址 != 网站网址<span class="td-status-small-text">主页网址不等于网站的URL，这可能表明你的WordPress配置有问题。</span>',
            'status' => 'yellow'
        ));
    }

    // version
    td_system_status::add('WordPress和插件', array(
        'check_name' => 'WP版本',
        'tooltip' => '',
        'value' => get_bloginfo('version'),
        'status' => 'info'
    ));


    // is_multisite
    td_system_status::add('WordPress和插件', array(
        'check_name' => 'WP多站点启用',
        'tooltip' => '',
        'value' => is_multisite() ? '是' : '否',
        'status' => 'info'
    ));


    // language
    td_system_status::add('WordPress和插件', array(
        'check_name' => 'WP语言',
        'tooltip' => '',
        'value' => get_locale(),
        'status' => 'info'
    ));



    // memory limit
    $memory_limit = td_system_status::wp_memory_notation_to_number(WP_MEMORY_LIMIT);
    if ( $memory_limit < 67108864 ) {
        td_system_status::add('WordPress和插件', array(
            'check_name' => 'WP内存限制',
            'tooltip' => '',
            'value' => size_format( $memory_limit ) . '/需要 <span class="td-status-small-text">- 我们建议设置内存至少64MB。主题与40MB/请求限制测试良好。但如果你正在使用多个插件，可能是不够的。查看：<a href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank">分配给PHP增加内存</a></span>',
            'status' => 'yellow'
        ));
    } else {
        td_system_status::add('WordPress和插件', array(
            'check_name' => 'WP内存限制',
            'tooltip' => '',
            'value' => size_format( $memory_limit ) . '/request',
            'status' => 'green'
        ));
    }


    // wp debug
    if (defined('WP_DEBUG') and WP_DEBUG === true) {
        td_system_status::add('WordPress和插件', array(
            'check_name' => 'WP_DEBUG',
            'tooltip' => '',
            'value' => 'WP_DEBUG已启用',
            'status' => 'yellow'
        ));
    } else {
        td_system_status::add('WordPress和插件', array(
            'check_name' => 'WP_DEBUG',
            'tooltip' => '',
            'value' => '否',
            'status' => 'green'
        ));
    }






    // caching
    $caching_plugin_list = array(
        'wp-super-cache/wp-cache.php' => array(
            'name' => 'WP super cache',
            'status' => 'green',
        ),
        'w3-total-cache/w3-total-cache.php' => array(
            'name' => 'W3 total cache (我们推荐WP super cache)',
            'status' => 'yellow',
        ),
        'wp-fastest-cache/wpFastestCache.php' => array(
            'name' => 'WP Fastest Cache (我们推荐WP super cache)',
            'status' => 'yellow',
        ),
    );
    $active_plugins = get_option('active_plugins');
    $caching_plugin = '没有检测到缓存插件';
    $caching_plugin_status = 'yellow';
    foreach ($active_plugins as $active_plugin) {
        if (isset($caching_plugin_list[$active_plugin])) {
            $caching_plugin = $caching_plugin_list[$active_plugin]['name'];
            $caching_plugin_status = $caching_plugin_list[$active_plugin]['status'];
            break;
        }
    }
    td_system_status::add('WordPress和插件', array(
        'check_name' => '缓存插件',
        'tooltip' => '',
        'value' =>  $caching_plugin,
        'status' => $caching_plugin_status
    ));

    td_system_status::render_tables();



    // social counter cache
    $cache_content = get_option('td_social_api_v3_last_val', '');
    td_system_status::render_social_cache($cache_content);







    ?>




</div>



<?php
   class td_system_status {
       static $system_status = array();
       static function add($section, $status_array) {
           self::$system_status[$section] []= $status_array;
       }


       static function render_tables() {
           foreach (self::$system_status as $section_name => $section_statuses) {
                ?>
                <table class="widefat td-system-status-table" cellspacing="0">
                    <thead>
                        <tr>
                           <th colspan="4"><?php echo $section_name ?></th>
                        </tr>
                    </thead>
                    <tbody>
                <?php

                    foreach ($section_statuses as $status_params) {
                        ?>
                        <tr>
                            <td class="td-system-status-name"><?php echo $status_params['check_name'] ?></td>
                            <td class="td-system-status-help"><!--<a href="#" class="help_tip">[?]</a>--></td>
                            <td class="td-system-status-status">
                                <?php
                                    switch ($status_params['status']) {
                                        case 'green':
                                            echo '<div class="td-system-status-led td-system-status-green td-tooltip" data-position="right" title="绿色状态：此项通过我们系统状态测试！"></div>';
                                            break;
                                        case 'yellow':
                                            echo '<div class="td-system-status-led td-system-status-yellow td-tooltip" data-position="right" title="黄色状态：此设置可能会影响网站后台。前端还是应该按预期运行。我们建议您解决这个问题。"></div>';
                                            break;
                                        case 'red' :
                                            echo '<div class="td-system-status-led td-system-status-red td-tooltip" data-position="right" title="红色状态：预期与该选项的网站可能无法正常工作。"></div>';
                                            break;
                                        case 'info':
                                            echo '<div class="td-system-status-led td-system-status-info td-tooltip" data-position="right" title="信息状态：这只是信息用途，更容易调试，如果出现了问题">i</div>';
                                            break;

                                    }


                                ?>
                            </td>
                            <td class="td-system-status-value"><?php echo $status_params['value'] ?></td>
                        </tr>
                        <?php
                    }

                ?>
                    </tbody>
                </table>
                <?php
           }
       }


       static function render_social_cache($cache_entries) {
           if (!empty($cache_entries) and is_array($cache_entries)) {
                ?>
                <table class="widefat td-system-status-table" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Social network cache status:</th>
                            <th>Last request count:</th>
                            <th>Last good count:</th>
                            <th>Timestamp - (h:m:s) ago:</th>
                            <th>Expires:</th>
                            <th>SN User:</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($cache_entries as $social_network_id => $cache_params) {
                        if (empty($cache_params['count'])) {
                            $cache_params['count'] = '';
                        }

                        if (empty($cache_params['ok_count'])) {
                            $cache_params['ok_count'] = '';
                        }

                        if (empty($cache_params['timestamp'])) {
                            $cache_params['timestamp'] = '';
                        }

                        if (empty($cache_params['expires'])) {
                            $cache_params['expires'] = '';
                        }

                        if (empty($cache_params['uid'])) {
                            $cache_params['uid'] = '';
                        }
                        ?>
                        <tr>
                            <td class="td-system-status-name"><?php echo $social_network_id ?></td>
                            <td><?php echo $cache_params['count'] ?></td>
                            <td><?php echo $cache_params['ok_count'] ?></td>
                            <td><?php echo $cache_params['timestamp'] . ' - ' . gmdate("H:i:s", time() - $cache_params['timestamp'])?> ago</td>
                            <td><?php echo $cache_params['expires'] ?></td>
                            <td><?php echo $cache_params['uid'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>


                    </tbody>
                </table>
                <?php
           }
       }


       static function render_diagnostics() {

       }

       static function wp_memory_notation_to_number( $size ) {
           $l   = substr( $size, -1 );
           $ret = substr( $size, 0, -1 );
           switch ( strtoupper( $l ) ) {
               case 'P':
                   $ret *= 1024;
               case 'T':
                   $ret *= 1024;
               case 'G':
                   $ret *= 1024;
               case 'M':
                   $ret *= 1024;
               case 'K':
                   $ret *= 1024;
           }
           return $ret;
       }
   }
?>