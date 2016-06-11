<?php
define('QQWORLD_COLLECTOR_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('QQWORLD_COLLECTOR_URL', plugin_dir_url(__FILE__));

class qqworld_collector_common
{
    const TRIAL = false;
    const EXPIRED_TIME = 1427940250;
    var $activation_code;
    var $is_activated;
    var $product;
    var $text_domain = 'qqworld-collector';
    var $allowed_image_types = array('image/jpeg', 'image/gif', 'image/png');
    var $webserver;
    var $timeout;

    public function get_all_thumb_file_full_path($attachment_id, $fullsize_path)
    {
        $imagedata = wp_get_attachment_metadata($attachment_id);
        $file_paths = array();
        foreach ($imagedata['sizes'] as $size => $thumb) {
            if (!empty($thumb['file']) && ($thumbfile = str_replace(basename($fullsize_path), $thumb['file'], $fullsize_path)) && file_exists($thumbfile)) {
                $file_paths[$size] = $thumbfile;
            }
        }
        return $file_paths;
    }

    public function get_product()
    {
        return self::TRIAL ? 'trial-edition' : 'qqworld-collector';
    }

    public function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');
        return isset($suffixes[floor($base)]) ? round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)] : '';
    }

    public function check_activation_code($activation_code)
    {
        //$request = md5($_SERVER['HTTP_HOST'] . $this->product);
        //return crypt($request, $activation_code) == $activation_code;
	    return true;
    }

    public function activation_page()
    {
        if (empty($this->activation_code)) {
            $valid = '';
            $is_valid = false;
        } else {
            $is_valid = $this->check_activation_code($this->activation_code);
            $valid = $is_valid ? ' valid' : ' invalid';
        };
        echo '	<style>
	#activation-code.invalid {
		background: #c00;
		color: #fff;
	}
	#activation-code.valid {
		background: green;
		color: #fff;
	}
	</style>
	<div class="wrap">
		<h2>';
        _e('QQWorld Collector - Product Activation', $this->text_domain);;
        echo '</h2>
		<p>';
        _e('Grab content from website, and automatically keep the all remote picture to the local, and automatically set featured image.', $this->text_domain);;
        echo '		<form action="options.php" method="post" id="form">
			';
        settings_fields('qqworld-collector-activation');;
        echo '			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label>';
        _e('Activation Code', $this->text_domain);;
        echo '</label></th>
						<td><fieldset>
							<legend class="screen-reader-text"><span>';
        _e('Activation Code', $this->text_domain);;
        echo '</span></legend>
								<label for="activation-code">
									<input name="qqworld-collector-activation-code" type="text" class="regular-text';
        echo $valid;;
        echo '" placeholder="';
        _e('Please enter the Activation Code', $this->text_domain);;
        echo '" id="activation-code" value="';
        echo $this->activation_code;;
        echo '" /> ';
        if (!empty($this->activation_code) && !$is_valid) _e('Whoops, Activation code is invalid.', $this->text_domain);;
        echo '								</label>
						</fieldset></td>
					</tr>
				</tbody>
			</table>
			';
        submit_button();;
        echo '		</form>
	</div>
';
    }

    public function help_tab()
    {
        $screen = get_current_screen();
        $screen->add_help_tab(array(
            'id' => 'qqworld-auto-save-images-installation',
            'title' => __('Installation', $this->text_domain),
            'content' => __('<ol><li>Make sure the server configuration <strong>allow_url_fopen=1</strong> in php.ini.</li><li>Warning: If your website domain has been changed, you must modify all image link to new domain from database, or else all images which not modified in post content will be save again.</li></ol>', $this->text_domain)
        ));
        $screen->add_help_tab(array(
            'id' => 'qqworld-auto-save-images-notice',
            'title' => __('Notice', $this->text_domain),
            'content' => __("<ul><li>This plugin has a little problem that is all the image url must be full url, it means must included \"http(s)://\", for example:<ul><li>&lt;img src=&quot;http://img.whitehouse.gov/image/2014/08/09/gogogo.jpg&quot; /&gt;</li><li>&lt;img src=&quot;http://www.bubugao.me/image/travel/beijing.png?date=20140218&quot; /&gt;</li>			<li>&lt;img src=&quot;http://r4.ykimg.com/05410408543927D66A0B4D03A98AED24&quot; /&gt;</li><li>&lt;img src=&quot;https://example.com/image?id=127457&quot; /&gt;</li></ul></li><li>The examples that not works:<ul><li>&lt;img src=&quot;/images/great.png&quot; /&gt;</li><li>&lt;img src=&quot;./photo-lab/2014-08-09.jpg&quot; /&gt;</li><li>&lt;img src=&quot;img/background/black.gif&quot; /&gt;</li></ul></li></ul>I'v tried to figure this out, but i couldn't get the host name to make image src full.<br />So if you encounter these codes, plaese manually fix the images src to full url.", $this->text_domain)
        ));
        $screen->add_help_tab(array(
            'id' => 'qqworld-auto-save-images-about',
            'title' => __('About'),
            'content' => __("<p>Hi everyone, My name is Michael Wang from china.</p><p>I made this plugin just for play in the first place, after 1 year, oneday someone sent an email to me for help , I was surprise and glad to realized my plugin has a fan. then more and more peoples asked me for helps, and my plugin was getting more and more powerful. Now this's my plugin. I hope you will like it, thanks.</p>", $this->text_domain)
        ));
    }

    public function get_plugin_data()
    {
        if (!function_exists('get_plugin_data')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        $plugin_folder = ABSPATH . 'wp-content/plugins/qqworld-collector/qqworld-collector.php';
        $this->plugin = get_plugin_data($plugin_folder);
    }
}

class qqworld_collector extends qqworld_collector_common
{
    var $qqworld_org_login;
    var $qqworld_org_user;
    var $qqworld_org_password;

    function __construct()
    {
        add_action('plugins_loaded', array($this, 'load_language'));
        $this->qqworld_org_login = get_option('qqworld-org-login', array('user' => '', 'password' => ''));
        $this->qqworld_org_user = isset($this->qqworld_org_login['user']) ? $this->qqworld_org_login['user'] : '';
        $this->qqworld_org_password = isset($this->qqworld_org_login['password']) ? $this->qqworld_org_login['password'] : '';
        $this->product = $this->get_product();
        $this->activation_code = get_option('qqworld-collector-activation-code');
        $this->is_activated = !empty($this->activation_code) && $this->check_activation_code($this->activation_code) ? true : false;
        $this->get_plugin_data();

        if (!empty($this->activation_code) && $this->check_activation_code($this->activation_code)) {
            $is_expired = false;
            if (self::TRIAL) {
                $current = time();
                if ($current > self::EXPIRED_TIME) {
                    $is_expired = true;
                    add_action('admin_menu', array($this, 'admin_expired_menu'));
                }
            }
            if (!$is_expired) $this->do_activated();
        } else {
            add_action('admin_menu', array($this, 'admin_activation_menu'));
        }
        add_action('admin_init', array($this, 'register_activation_settings'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
    }

    public function admin_enqueue_scripts()
    {
        wp_register_style('qqworld-collector-common-style', QQWORLD_COLLECTOR_URL . 'css/common.css');
        wp_enqueue_style('qqworld-collector-common-style');
    }

    public function includes()
    {
        $files = array('translate.php', 'collector.php', 'auto-save-images.php', 'check-duplicated-title.php', 'ftp.php', 'qiniu.php', 'aliyun_oss.php', 'tencent_cos.php', 'upyun.php');
        foreach ($files as $filename) {
            include_once(QQWORLD_COLLECTOR_DIR . 'modules' . DIRECTORY_SEPARATOR . $filename);
        }
    }

    public function load_language()
    {
        load_plugin_textdomain($this->text_domain, dirname(__FILE__) . '/lang' . 'lang', basename(dirname(__FILE__)) . '/lang');
    }

    public function admin_activation_menu()
    {
        $page_title = __('QQWorld Collector', $this->text_domain);
        $menu_title = $page_title;
        $capability = 'administrator';
        $menu_slug = 'qqworld-collector';
        $function = $this->is_activated ? array($this, 'page') : array($this, 'activation_page');
        $icon_url = 'none';
        $settings_page = add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url);
        add_action("load-{$settings_page}", array($this, 'help_tab'));
    }

    public function register_activation_settings()
    {
        register_setting("qqworld-collector-activation", 'qqworld-collector-activation-code', array($this, 'when_activated'));
    }

    public function when_activated($input)
    {
        $is_activated = $this->check_activation_code($input);
        if ($is_activated) {
            $_REQUEST['_wp_http_referer'] = admin_url('edit.php?post_type=qqworld-collections');
        }
        return $input;
    }

    public function do_activated()
    {
        $this->includes();
        add_action('admin_menu', array($this, 'admin_menu'), 99);
        new QC\modules\collector\collector($this->activation_code);
        new QASI\modules\auto_save_images\auto_save_images($this->activation_code);
        new QC\modules\check_duplicated_title\check_duplicated_title;
    }

    function admin_menu()
    {
        $parent_slug = 'edit.php?post_type=qqworld-collections';
        $page_title = __('Update', $this->text_domain);
        $menu_title = $page_title;
        $capability = 'administrator';
        $menu_slug = 'qqworld-collector-update';
        $function = $this->is_activated ? array($this, 'update_page') : array($this, 'activation_page');
        $settings_page = add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
        add_action("load-{$settings_page}", array($this, 'help_tab'));
    }

    function update_page()
    {
        ;
        echo '<div class="wrap">
	<h2>';
        _e('Update', $this->text_domain);;
        echo '</h2>
	<p>';
        _e("I couldn't put this pro edition in wordpress server, so i built an semi-automatic update service.", $this->text_domain);;
        echo '	<form action="options.php" method="post" id="update-form">
		';
        settings_fields('qqworld-auto-save-images-update');;
        echo '		<div class="tab-content">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label>';
        _e('Current Version', $this->text_domain);;
        echo '</label></th>
						<td>';
        echo $this->plugin['Version'];;
        echo '</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="check-update-now">';
        _e('Check Update', $this->text_domain);;
        echo '</label></th>
						<td><input type="button" class="button button-primary" id="check-update-now" value="';
        _e('Check Now', $this->text_domain);;
        echo '" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="login-name">';
        _e('Login Name', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Login Name', $this->text_domain);;
        echo '" data-content="';
        _e("If you want update automatically , Please enter your Login Name and Password of website www.qqworld.org.", $this->text_domain);;
        echo '"></span></th>
						<td><input type="text" name="qqworld-org-login[user]" id="login-name" placeholder="';
        _e('Login Name', $this->text_domain);;
        echo '" value="';
        echo $this->qqworld_org_user;;
        echo '" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="login-password">';
        _e('Password', $this->text_domain);;
        echo '</label></th>
						<td><input type="password" name="qqworld-org-login[password]" id="login-password" placeholder="';
        _e('Password', $this->text_domain);;
        echo '" value="';
        echo $this->qqworld_org_password;;
        echo '" /></td>
					</tr>
				</body>
			</table>
			';
        submit_button();;
        echo '		</div>
	</form>
</div>
';
    }

    public function admin_expired_menu()
    {
        $page_title = __('QQWorld Collector', $this->text_domain);
        $menu_title = __('QQWorld Collector', $this->text_domain);
        $capability = 'administrator';
        $menu_slug = 'qqworld-collector';
        $function = array($this, 'expired_page');
        $icon_url = 'none';
        $settings_page = add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url);
    }

    public function expired_page()
    {
        ;
        echo '	<div class="wrap">
		<h2>';
        _e('QQWorld Collector - Trial license Expired', $this->text_domain);;
        echo '</h2>
		<p>';
        printf(__("This copy is a trial edition, the trial time has expired. please buy <a href=\"%s\" target=\"_blank\">full version</a>.", $this->text_domain), "http://www.qqworld.org/products/qqworld-auto-save-images-pro");;
        echo '	</div>
';
    }
}

new qqworld_collector;