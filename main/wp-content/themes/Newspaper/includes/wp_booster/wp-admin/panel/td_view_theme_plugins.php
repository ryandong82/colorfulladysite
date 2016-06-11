<?php
/**
 * Created by ra on 5/15/2015.
 */

if (current_user_can( 'activate_plugins' )) {
    // deactivate a plugin from tgm
    if (isset($_GET['td_deactivate_plugin_slug'])) {
        $td_deactivate_plugin_slug = $_GET['td_deactivate_plugin_slug'];
        if (!empty($td_deactivate_plugin_slug)) {
            $plugins = TGM_Plugin_Activation::$instance->plugins;
            foreach ($plugins as $plugin) {
                if ($plugin['slug'] == $td_deactivate_plugin_slug) {
                    deactivate_plugins($plugin['file_path']);
                    ?>
                    <script type="text/javascript">
                        window.location = "admin.php?page=td_theme_plugins";
                    </script>
                    <?php
                    break;
                }
            }
        }
    }

    // Activate a plugin
    if (isset($_GET['td_activate_plugin_slug'])) {
        $td_activate_plugin_slug = $_GET['td_activate_plugin_slug'];
        if (!empty($td_activate_plugin_slug)) {
            $plugins = TGM_Plugin_Activation::$instance->plugins;

            foreach ($plugins as $plugin) {
                if ($plugin['slug'] == $td_activate_plugin_slug) {
                    activate_plugins($plugin['file_path']);
                    ?>
                    <script type="text/javascript">
                        window.location = "admin.php?page=td_theme_plugins";
                    </script>
                    <?php
                    break;
                }
            }
        }
    }
}



require_once "td_view_header.php";


//print_r(get_plugins());



$theme_plugins = TGM_Plugin_Activation::$instance->plugins;

?>



<div class="td-admin-wrap about-wrap theme-browser">
    <h1>安装高级插件</h1>
    <div class="about-text">
        <p>
            使用此面板安装包含插件。所有插件都与主题经过良好的测试。
            主题配备了以下高级插件：
        </p>
    </div>


   <div class="td-admin-columns">


<?php
$wp_plugin_list = get_plugins();


    //asort($theme_plugins);
    foreach ($theme_plugins as $theme_plugin) {

        $tmp_class = 'td-plugin-not-installed';
        $required_label = $theme_plugin['required_label'];

        if (is_plugin_active( $theme_plugin['file_path'])) {
            $tmp_class = 'td-plugin-active';
            $required_label = 'active';
        }
        else if (isset($wp_plugin_list[$theme_plugin['file_path']])) {
            $tmp_class = 'td-plugin-inactive';
        }


        //echo '<br>';
        //echo $theme_plugin['file_path'] . ' ' . is_plugin_inactive( $theme_plugin['file_path'] ) . '<br>';

        //print_r(is_plugin_inactive( $theme_plugin['file_path'] ));

        ?>

        <div class="td-wp-admin-plugin theme <?php echo $tmp_class ?>">

            <!-- Import content -->
            <div class="theme-screenshot">
                <span class="td-plugin-required td-<?php echo $required_label; ?>"><?php echo $required_label; ?></span>
                <img class="td-demo-thumb" src="<?php echo $theme_plugin['img'] ?>"/>
            </div>

            <div class="td-admin-title">
                <div class="td-progress-bar-wrap"><div class="td-progress-bar"></div></div>
                <h3 class="theme-name"><?php echo $theme_plugin['name'] ?></h3>
            </div>

            <div class="td-admin-checkbox td-small-checkbox">
                <p><?php echo $theme_plugin['text'] ?></p>
            </div>

            <div class="theme-actions">
                <a class="button button-primary td-button-install-plugin" href="<?php
                echo esc_url( wp_nonce_url(
                    add_query_arg(
                        array(
                            'page'		  	=> urlencode(TGM_Plugin_Activation::$instance->menu),
                            'plugin'		=> urlencode($theme_plugin['slug']),
                            'plugin_name'   => urlencode($theme_plugin['name']),
                            'plugin_source' => urlencode($theme_plugin['source']),
                            'tgmpa-install' => 'install-plugin',
                            'return_url' => 'td_theme_plugins'
                        ),
                        admin_url('themes.php')
                    ),
                    'tgmpa-install'
                ));
                ?>">安装</a>
                <a class="button button-secondary td-button-uninstall-plugin" href="<?php
                echo esc_url(
                    add_query_arg(
                        array(
                            'page'		  	            => urlencode('td_theme_plugins'),
                            'td_deactivate_plugin_slug'	=> urlencode($theme_plugin['slug']),
                        ),
                        admin_url('admin.php')
                    ));
                ?>"">停用</a>

                <a class="button button-primary td-button-activate-plugin" href="<?php
                echo esc_url(
                    add_query_arg(
                        array(
                            'page'		  	            => urlencode('td_theme_plugins'),
                            'td_activate_plugin_slug'	=> urlencode($theme_plugin['slug']),
                        ),
                        admin_url('admin.php')
                    ));
                ?>"">激活</a>
            </div>
        </div>






        <?php
    }
?>

    </div>
    <hr style="clear:left"/>
    <h3>测试插件：</h3>
    <div class="about-text">
        <p>随着每个主题版本，我们提供了完整的支持插件列表。为了使插件可见并正常工作，主题可以添加自定义样式表并挂钓自定义代码给他们。
            我们人工定期检查每一个插件。如果我们错过了什么，请随时与我们联系！</p>
    </div>

    <div class="td-supported-plugin-list">
        <div class="td-supported-plugin">WP Super Cache <span> - 缓存插件</span></div>
        <div class="td-supported-plugin">Contact form 7 <span>- 用于联系表</span></div>
        <div class="td-supported-plugin">bbPress <span>- 论坛插件</span></div>
        <div class="td-supported-plugin">BuddyPress<span>- 社交网络插件</span></div>
        <div class="td-supported-plugin">Font Awesome 4 Menus<span>- 图标包，在主题菜单支持</span></div>
        <div class="td-supported-plugin">Jetpack  <span>- 插件有很多的功能*它可能会减慢你的网站</span></div>
        <div class="td-supported-plugin">WooCommerce <span>- 电子商务解决方案</span></div>
        <div class="td-supported-plugin">WordPress SEO <span> - SEO插件</span></div>
        <div class="td-supported-plugin">Wp User Avatar <span> - 更改用户头像</span></div>
    </div>



</div>
