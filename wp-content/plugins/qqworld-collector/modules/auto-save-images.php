<?php
namespace QASI\modules\auto_save_images;

use PHPImageWorkshop\ImageWorkshop;
use GifCreator;
use GifFrameExtractor;

if (!class_exists("PHPImageWorkshop\ImageWorkshop")) {
    require_once(QQWORLD_COLLECTOR_DIR . 'lib/PHPImageWorkshop/Exception/ImageWorkshopBaseException.php');
    require_once(QQWORLD_COLLECTOR_DIR . 'lib/PHPImageWorkshop/Exception/ImageWorkshopException.php');
    require_once(QQWORLD_COLLECTOR_DIR . 'lib/PHPImageWorkshop/Core/Exception/ImageWorkshopLayerException.php');
    require_once(QQWORLD_COLLECTOR_DIR . 'lib/PHPImageWorkshop/Core/ImageWorkshopLib.php');
    require_once(QQWORLD_COLLECTOR_DIR . 'lib/PHPImageWorkshop/Core/ImageWorkshopLayer.php');
    require_once(QQWORLD_COLLECTOR_DIR . 'lib/PHPImageWorkshop/ImageWorkshop.php');
}
if (!class_exists("GifCreator\GifCreator")) include_once(QQWORLD_COLLECTOR_DIR . 'lib/GifCreator.php');
if (!class_exists("GifFrameExtractor\GifFrameExtractor")) include_once(QQWORLD_COLLECTOR_DIR . 'lib/GifFrameExtractor.php');

class auto_save_images extends \qqworld_collector_common
{
    const TOO_SMALL = "too small";
    const NEED_DELETED = 'need deleted';
    const NEED_IGNORED = 'need ignored';
    const NO_MEDIA_LIBRARY = 'no media library';
    const DEBUG = false;
    var $is_downloaded;
    var $temp;
    var $allowd_image_types = array('image/jpeg', 'image/png', 'image/gif');
    var $width;
    var $height;
    var $type;
    var $attr;
    var $plugin;
    var $mode;
    var $when;
    var $remote_publishing;
    var $schedule_publish;
    var $current_post_id;
    var $change_image_name;
    var $has_remote_image;
    var $has_missing_image;
    var $count;
    var $only_save_first;
    var $maximum_picture_size;
    var $minimum_picture_size;
    var $default_orderby;
    var $content;
    var $temp_content;
    var $exclude_domain;
    var $format;
    var $filename_structure;
    var $change_title_alt;
    var $custom_title_alt;
    var $save_outside_links;
    var $change_width_height;
    var $additional_content;
    var $auto_caption;
    var $format_align_to;
    var $format_link_to;
    var $attributes;
    var $optimize;
    var $optimize_enabled;
    var $optimize_mode;
    var $optimize_url;
    var $optimize_protocol;
    var $optimize_host;
    var $optimize_folder;
    var $webserver;
    var $speed_for_manual_mode;
    var $timeout;
    var $oss_sdk_service;
    var $aliyun_oss;
    var $access_key_id;
    var $access_key_secret;
    var $proxy;
    var $proxy_enabled;
    var $proxy_timeout;
    var $proxy_address;
    var $compression;
    var $compression_enabled;
    var $compression_level;
    var $smart;
    var $enabled_smart_grabbing;
    var $image;
    var $image_path;
    var $image_data;
    var $watermark;
    var $watermark_path;
    var $watermark_data;
    var $watermark_enabled;
    var $ignore_animated_gif;
    var $watermark_random_position;
    var $is_animated_gif;
    var $is_added_watermark;
    var $filter_size;
    var $align_to;
    var $offset;
    var $watermark_opacity;

    public function __construct($activation_code)
    {
        $this->product = $this->get_product();
        $this->activation_code = $activation_code;
        $this->is_activated = !empty($this->activation_code) && $this->check_activation_code($this->activation_code) ? true : false;
        $this->qqworld_org_login = get_option('qqworld-org-login', array('user' => '', 'password' => ''));
        $this->qqworld_org_user = isset($this->qqworld_org_login['user']) ? $this->qqworld_org_login['user'] : '';
        $this->qqworld_org_password = isset($this->qqworld_org_login['password']) ? $this->qqworld_org_login['password'] : '';
        $this->get_plugin_data();
        $this->mode = get_option('qqworld-auto-save-images-mode', 'auto');
        $this->when = get_option('qqworld-auto-save-images-when', array('publish'));
        if (!is_array($this->when)) $this->when = array('publish');
        $this->remote_publishing = get_option('qqworld-auto-save-images-remote-publishing', 'yes');
        $this->schedule_publish = get_option('qqworld-auto-save-images-schedule-publish', 'yes');
        $this->featured_image = get_option('qqworld-auto-save-images-set-featured-image', 'yes');
        $this->no_media_library = get_option('qqworld-auto-save-images-no-media-library', 'no');
        $this->change_image_name = get_option('qqworld-auto-save-images-auto-change-name', 'none');
        $this->filename_source = get_option('qqworld-auto-save-images-filename-source', array('postname', 'alt', 'title'));
        $this->only_save_first = get_option('qqworld-auto-save-images-only-save-first', 'all');
        $this->maximum_picture_size = get_option('qqworld-auto-save-images-maximum-picture-size', array('width' => 1280, 'height' => 1280));
        $this->minimum_picture_size = get_option('qqworld-auto-save-images-minimum-picture-size', array('width' => 32, 'height' => 32));
        $this->minimum_picture_size_auto_delete = isset($this->minimum_picture_size['auto-delete']) ? $this->minimum_picture_size['auto-delete'] : 'no';
        $this->exclude_domain = get_option('qqworld-auto-save-images-exclude-domain', array());
        $this->exclude_crc = get_option('qqworld-auto-save-images-exclude-crc', array());
        $this->delete_crc = get_option('qqworld-auto-save-images-delete-crc', array());
        $this->format = get_option('qqworld-auto-save-images-format', array('keep-outside-links' => 'no', 'size' => 'full', 'link-to' => 'none'));
        $this->change_title_alt = isset($this->format['title-alt']) ? $this->format['title-alt'] : 'no';
        $this->custom_title_alt = isset($this->format['custom-title-alt']) ? $this->format['custom-title-alt'] : '';
        $this->filename_structure = isset($this->format['filename-structure']) ? $this->format['filename-structure'] : '%filename%';
        $this->keep_outside_links = isset($this->format['keep-outside-links']) ? $this->format['keep-outside-links'] : 'no';
        $this->save_outside_links = isset($this->format['save-outside-links']) ? $this->format['save-outside-links'] : 'no';
        $this->change_width_height = isset($this->format['width-height']) ? $this->format['width-height'] : 'no';
        $this->additional_content = isset($this->format['additional-content']) ? $this->format['additional-content'] : array('before' => '', 'after' => '');
        $this->auto_caption = isset($this->format['auto-caption']) ? $this->format['auto-caption'] : 'no';
        $this->format_link_to = isset($this->format['link-to']) ? $this->format['link-to'] : 'none';
        $this->format_align_to_enabled = isset($this->format['align-to-enabled']) ? $this->format['align-to-enabled'] : 'no';
        $this->format_align_to = isset($this->format['align-to']) ? $this->format['align-to'] : 'none';
        $this->attributes = array('width' => '', 'height' => '', 'class' => '');
        $this->authorization = get_option('qqworld-collector-authorization', 'manage_options');
        $this->optimize = get_option('qqworld-auto-save-images-optimize', array('mode' => 'local'));
        $this->optimize_enabled = isset($this->optimize['enabled']) ? $this->optimize['enabled'] : '';
        $this->optimize_mode = isset($this->optimize['mode']) ? $this->optimize['mode'] : 'local';
        $this->optimize_url = get_option('qqworld-auto-save-images-optimize-url');
        $this->optimize_protocol = isset($this->optimize_url['protocol']) ? $this->optimize_url['protocol'] : 'http';
        $this->optimize_host = isset($this->optimize_url['host']) ? $this->optimize_url['host'] : '';
        $this->optimize_folder = isset($this->optimize_url['folder']) ? $this->optimize_url['folder'] : '/wp-content/uploads';
        $this->webserver = get_option('qqworld-collector-webserver');
        $this->speed_for_manual_mode = isset($this->webserver['speed']) ? $this->webserver['speed'] : 0;
        $this->timeout = isset($this->webserver['timeout']) ? $this->webserver['timeout'] : 30;
        $this->proxy = get_option('qqworld-auto-save-images-proxy', array("timeout" => 5, "address" => "127.0.0.1:8087"));
        $this->proxy_enabled = isset($this->proxy['enabled']) ? $this->proxy['enabled'] : '';
        $this->proxy_timeout = isset($this->proxy['timeout']) ? $this->proxy['timeout'] : '5';
        $this->proxy_address = isset($this->proxy['address']) ? $this->proxy['address'] : '127.0.0.1:8087';
        $this->compression = get_option('qqworld-auto-save-images-compression', array('quality' => 75));
        $this->compression_enabled = isset($this->compression['enabled']) ? $this->compression['enabled'] : '';
        $this->compression_level = isset($this->compression['quality']) ? $this->compression['quality'] : 75;
        $this->smart = get_option('qqworld-auto-save-images-smart', array());
        $this->enabled_smart_grabbing = isset($this->smart['enabled_smart_grabbing']) ? $this->smart['enabled_smart_grabbing'] : 'no';
        $this->watermark_enabled = get_option('qqworld-auto-save-images-watermark-enabled', 'no');
        $this->watermark_enabled_for = get_option('qqworld-auto-save-images-watermark-enabled-for', array('collection'));
        $this->ignore_animated_gif = get_option('qqworld-auto-save-images-watermark-ignore-animated-gif', 'yes');
        $this->filter_size = get_option('qqworld-auto-save-images-watermark-filter-size', array('width' => 300, 'height' => 300));
        $this->filter_url = get_option('qqworld-auto-save-images-watermark-filter-url');
        $this->watermark_random_position = get_option('qqworld-auto-save-images-watermark-random-position', 'no');
        $this->align_to = get_option('qqworld-auto-save-images-watermark-align-to', 'lt');
        $this->offset = get_option('qqworld-auto-save-images-watermark-offset', array('x' => 20, 'y' => 20));
        $this->watermark_opacity = get_option('qqworld-auto-save-images-watermark-opacity', 75);
        $this->watermark_image = get_option('qqworld-auto-save-images-watermark-image');
        $this->scon_scan_posts = get_option('qqworld-auto-save-images-cron-scan-posts');
        $this->get_watermark_filepath();
        add_filter('wp_handle_upload_prefilter', array($this, 'wp_handle_upload_prefilter'));
        add_filter('add_attachment', array($this, 'add_added_watermark_meta'));
        if ($this->compression_enabled == 'yes') {
            add_filter('qqworld_auto_save_images_file_bits', array($this, 'compress_image'));
        }
        switch ($this->mode) {
            case 'auto':
                $this->add_actions();
                break;
            case 'manual':
                add_action('media_buttons', array($this, 'media_buttons'), 11);
                add_action('wp_ajax_manual_save_remote_images', array($this, 'manual_save_remote_images'));
                add_action('wp_ajax_nopriv_manual_save_remote_images', array($this, 'manual_save_remote_images'));
                break;
        }
        if ($this->schedule_publish == 'yes') add_action('publish_future_post', array($this, 'fetch_images'));
        if ($this->remote_publishing) add_action('xmlrpc_publish_post', array($this, 'fetch_images'));
        add_action('wp_ajax_get_scan_list', array($this, 'get_scan_list'));
        add_action('wp_ajax_nopriv_get_scan_list', array($this, 'get_scan_list'));
        add_action('wp_ajax_auto_save_images_set_cron_scan_post', array($this, 'set_cron_scan_post'));
        add_action('wp_ajax_nopriv_auto_save_images_set_cron_scan_post', array($this, 'set_cron_scan_post'));
        add_action('wp_ajax_auto-save-images-delete-schedule', array($this, 'delete_schedule'));
        add_action('wp_ajax_nopriv_auto-save-images-delete-schedule', array($this, 'delete_schedule'));
        add_action('wp_ajax_auto-save-images-clear-all-crons', array($this, 'clear_all_schedule_crons'));
        add_action('wp_ajax_nopriv_auto-save-images-clear-all-crons', array($this, 'clear_all_schedule_crons'));
        add_action('wp_ajax_save_remote_images_get_categories_list', array($this, 'save_remote_images_get_categories_list'));
        add_action('wp_ajax_nopriv_save_remote_images_get_categories_list', array($this, 'save_remote_images_get_categories_list'));
        add_action('wp_ajax_save_remote_images_after_scan', array($this, 'save_remote_images_after_scan'));
        add_action('wp_ajax_nopriv_save_remote_images_after_scan', array($this, 'save_remote_images_after_scan'));
        add_action('wp_ajax_save_remote_images_list_all_posts', array($this, 'save_remote_images_list_all_posts'));
        add_action('wp_ajax_nopriv_save_remote_images_list_all_posts', array($this, 'save_remote_images_list_all_posts'));
        add_action('wp_ajax_save_remote_images_save_outside_links', array($this, 'save_remote_images_save_outside_links'));
        add_action('wp_ajax_nopriv_save_remote_images_save_outside_links', array($this, 'save_remote_images_save_outside_links'));
        add_action('wp_ajax_qqworld_auto_save_images_get_attachments_list', array($this, 'get_attachments_list'));
        add_action('wp_ajax_nopriv_qqworld_auto_save_images_get_attachments_list', array($this, 'get_attachments_list'));
        add_action('wp_ajax_qqworld_auto_save_images_compress_single_attachment', array($this, 'compress_single_attachment'));
        add_action('wp_ajax_nopriv_qqworld_auto_save_images_compress_single_attachment', array($this, 'compress_single_attachment'));
        add_action('wp_ajax_qqworld_auto_save_images_compress_attachment', array($this, 'compress_attachment'));
        add_action('wp_ajax_nopriv_qqworld_auto_save_images_compress_attachment', array($this, 'compress_attachment'));
        add_action('wp_ajax_auto_save_images_download_update_file', array($this, 'download_update_file'));
        add_action('wp_ajax_nopriv_auto_save_images_download_update_file', array($this, 'download_update_file'));
        add_action('wp_ajax_save_remote_images_preview_watermark', array($this, 'preview_watermark'));
        add_action('wp_ajax_nopriv_save_remote_images_preview_watermark', array($this, 'preview_watermark'));
        add_action('wp_ajax_auto_save_images_get_attachments_list_watermark', array($this, 'get_watermark_attachments_list'));
        add_action('wp_ajax_nopriv_auto_save_images_get_attachments_list_watermark', array($this, 'get_watermark_attachments_list'));
        add_action('wp_ajax_qqworld_auto_save_images_add_watermark_to_attachment', array($this, 'add_watermark_to_attachment'));
        add_action('wp_ajax_nopriv_qqworld_auto_save_images_add_watermark_to_attachment', array($this, 'add_watermark_to_attachment'));
        add_action('wp_ajax_auto_save_images_database_replacement', array($this, 'database_replacement'));
        add_action('wp_ajax_nopriv_auto_save_images_database_replacement', array($this, 'database_replacement'));
        add_action('wp_ajax_auto_save_images_update', array($this, 'update'));
        add_action('wp_ajax_nopriv_auto_save_images_update', array($this, 'update'));
        add_action('wp_ajax_qqworld-auto-save-images-add-to-black-list', array($this, 'add_to_black_list'));
        add_action('wp_ajax_nopriv_qqworld-auto-save-images-add-to-black-list', array($this, 'add_to_black_list'));
        add_filter('qqworld-auto-save-images-custom-filename-structure', array($this, 'custom_filename_structure'));
        add_filter('qqworld-auto-save-images-before-content-save-pre', array($this, 'content_optimization'), 10, 2);
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('admin_init', array($this, 'setup'));
        add_action('admin_init', array($this, 'register_settings'));
        add_filter('plugin_row_meta', array($this, 'registerPluginLinks'), 10, 2);
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
        add_filter('post_updated_messages', array($this, 'post_updated_messages'));
        add_action('admin_notices', array($this, 'admin_notices'));
        add_action('deleted_post', array($this, 'wipe_post_meta'));
        add_action('delete_attachment', array($this, 'wipe_attachment_meta'));
        if ($this->enabled_smart_grabbing == 'yes') add_filter('qqworld-auto-save-images-remote-images', array($this, 'smart_grabbing'), 10, 2);
        add_filter('manage_media_columns', array($this, 'manage_media_columns'));
        add_action('manage_media_custom_column', array($this, 'manage_media_custom_column'), 10, 2);
        add_filter('wp_generate_attachment_metadata', array($this, 'sync_oss'), 10, 2);
        add_filter('wp_generate_attachment_metadata', array($this, 'set_crc_of_attachment'), 10, 2);
        if ($this->optimize_enabled == 'yes' && $this->optimize_mode == 'local') ;
        if ($this->optimize_enabled == 'yes') {
            switch ($this->optimize_mode) {
                case 'local':
                    add_filter('upload_dir', array($this, 'change_upload_dir'));
                    break;
            }
            do_action('qqworld-auto-save-images-optimize-' . $this->optimize_mode);
        }
        add_action('qqworld-auto-save-images-cron-scan-post', array($this, 'do_cron_scan_post'), 10, 8);
        add_filter('qqworld-auto-save-images-string-compatible', array($this, 'string_compatible_vietnamese_to_english'));
    }

    public function string_compatible_vietnamese_to_english($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }

    public function add_to_black_list()
    {
        $post_id = $_POST['post_id'];
        $image_url = $_POST['image_url'];
        $mode = $_POST['mode'];
        $file = $this->download_image($image_url);
        if (!empty($file)) {
            $crc = $this->getCrc32($file);
            switch ($mode) {
                case 'exclude':
                    $exclude_list = get_option('qqworld-auto-save-images-exclude-crc');
                    if (!empty($exclude_list) && !in_array($crc, $exclude_list)) {
                        $exclude_list[] = $crc;
                    } else {
                        $exclude_list = array($crc);
                    }
                    update_option('qqworld-auto-save-images-exclude-crc', $exclude_list);
                    break;
                case 'delete':
                    $delete_list = get_option('qqworld-auto-save-images-delete-crc');
                    if (!empty($delete_list) && !in_array($crc, $delete_list)) {
                        $delete_list[] = $crc;
                    } else {
                        $delete_list = array($crc);
                    }
                    update_option('qqworld-auto-save-images-delete-crc', $delete_list);
                    break;
            }
            $result = array('success' => 1);
        } else {
            $result = array('success' => 0);
        }
        echo json_encode($result);
        exit;
    }

    public function new_interval($interval)
    {
        $interval['minutely'] = array(
            'interval' => 60,
            'display' => __('Minutely', $this->text_domain)
        );
        return $interval;
    }

    public function get_crons($hook)
    {
        $crons = _get_cron_array();
        $results = array();
        foreach ($crons as $timestamp => $cron) {
            if (is_numeric($timestamp)) {
                if (!empty($cron)) foreach ($cron as $cron_hook => $cr) {
                    if ($cron_hook == $hook) {
                        if (!empty($cr)) foreach ($cr as $args) {
                            $results[] = array(
                                'timestamp' => $timestamp,
                                'options' => $args
                            );
                        }
                    }
                }
            }
        }
        return $results;
    }

    public function setup()
    {
        $this->default_orderby = array(
            'ID' => __('ID'),
            'author' => __('Author'),
            'title' => __('Title'),
            'date' => __('Date'),
            'modified' => __('Last Modified'),
            'comment_count' => __('Comment Count', $this->text_domain)
        );
    }

    public function content_optimization($content, $post_id)
    {
        $pattern = '/&amp;/i';
        if (preg_match($pattern, $content, $match)) $content = preg_replace($pattern, '&', $content);
        $pattern = '/\?tp=webp&/i';
        if (preg_match($pattern, $content, $match)) $content = preg_replace($pattern, '?', $content);
        $pattern = '/\?tp=webp/i';
        if (preg_match($pattern, $content, $match)) $content = preg_replace($pattern, '', $content);
        $pattern = '/&tp=webp/i';
        if (preg_match($pattern, $content, $match)) $content = preg_replace($pattern, '', $content);
        $preg = preg_match_all('/(src|href)=\"((?!\").*?)\"/i', stripslashes($content), $matches);
        if ($preg) {
            foreach ($matches[2] as $match) {
                $new_str = urldecode($match);
                $new_str = str_replace(' ', '%20', $new_str);
                $content = str_replace($match, $new_str, $content);
            }
        }
        return $content;
    }

    public function delete_schedule()
    {
        $key = $_POST['timestamp'];
        $args = $_POST['qqworld-auto-save-images-cron-scan-posts'][$key];
        $post_type = $args['post_type'];
        $tax_query = isset($args['tax_query']) && !empty($args['tax_query']) ? $args['tax_query'] : '';
        $post__in = isset($args['post__in']) && !empty($args['post__in']) ? $args['post__in'] : '';
        $offset = isset($args['offset']) && !empty($args['offset']) ? $args['offset'] : '';
        $posts_per_page = $args['posts_per_page'];
        $post_status = $args['post_status'];
        $orderby = $args['orderby'];
        $order = $args['order'];
        $timestamp = wp_next_scheduled('qqworld-auto-save-images-cron-scan-post', array($post_type, $tax_query, $post__in, $offset, $posts_per_page, $post_status, $orderby, $order));
        if ($timestamp) {
            wp_unschedule_event($timestamp, 'qqworld-auto-save-images-cron-scan-post', array($post_type, $tax_query, $post__in, $offset, $posts_per_page, $post_status, $orderby, $order));
            $results = array('success' => 1, 'timestamp' => $timestamp, 'msg' => __('Successfully deleted schedule.', $this->text_domain), 'args' => $args);
        } else {
            $results = array('success' => 0, 'timestamp' => $timestamp, 'msg' => __('Deleted schedule faied.', $this->text_domain), 'args' => $args);
        }
        echo json_encode($results);
        exit;
    }

    public function get_cron_table_row($options)
    {
        ob_start();
        if (!empty($options)) foreach ($options as $timestamp => $option) {
            ;
            echo '		<tr>
    <td>
        ';
            $posttypes = get_post_types('', 'object');
            $types = array();
            foreach ($option['post_type'] as $post_type) :
                $types[] = $posttypes[$post_type]->label;;
                echo '<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[';
                echo $timestamp;;
                echo '][post_type][]" value="';
                echo $post_type;;
                echo '" />
        ';
            endforeach;
            echo implode(', ', $types);;
            echo '			</td>
    <td>
        ';
            $tax_html = array();
            $terms = array();
            if (isset($option['tax_query'])) {
                foreach ($option['tax_query'] as $id => $items) {
                    $taxonomy = get_taxonomy($items['taxonomy']);
                    $tax_html[] = $taxonomy->label . ': ' . implode(', ', $items['terms']);;
                    echo '					<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[';
                    echo $timestamp;;
                    echo '][tax_query][';
                    echo $id;;
                    echo '][taxonomy]" value="';
                    echo $items['taxonomy'];;
                    echo '" />
        ';
                    if (!empty($items['terms'])) foreach ($items['terms'] as $term) {
                        ;
                        echo '					<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[';
                        echo $timestamp;;
                        echo '][tax_query][';
                        echo $id;;
                        echo '][terms][]" value="';
                        echo $term;;
                        echo '" />
        ';
                    };
                    echo '					<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[';
                    echo $timestamp;;
                    echo '][tax_query][';
                    echo $id;;
                    echo '][field]" value="';
                    echo $items['field'];;
                    echo '" />
        ';
                }
            }
            echo !empty($tax_html) ? implode('<br />', $tax_html) : __('none');
            if (!empty($terms)) foreach ($terms as $term) {
                ;
                echo '
        ';
            };
            echo '			</td>
    <td>
        ';
            $post__in = isset($option['post__in']) ? $option['post__in'] : '';
            if (is_array($post__in) && !empty($post__in)) {
                if (count($post__in) == 1) echo $post__in[0];
                else echo $post__in[0] . '-' . $post__in[count($post__in) - 1];
                foreach ($post__in as $post) {
                    ;
                    echo '						<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[';
                    echo $timestamp;;
                    echo '][post__in][]" value="';
                    echo $post;;
                    echo '" />
        ';
                }
            } else _e('none');;
            echo '			</td>
    <td>
        ';
            printf(__('Start from %s to Scan', $this->text_domain), $option['offset']);;
            echo '				';
            echo $option['posts_per_page'] == -1 ? __('All', $this->text_domain) : $option['posts_per_page'];;
            echo '				';
            _e('Posts', $this->text_domain);;
            echo '				<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[';
            echo $timestamp;;
            echo '][offset]" value="';
            echo $option['offset'];;
            echo '" />
        <input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[';
            echo $timestamp;;
            echo '][posts_per_page]" value="';
            echo $option['posts_per_page'];;
            echo '" />
    </td>
    <td>
        ';
            $post_status = $option['post_status'];
            $post_statuses = get_post_statuses();
            echo $post_statuses[$post_status];;
            echo '				<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[';
            echo $timestamp;;
            echo '][post_status]" value="';
            echo $post_status;;
            echo '" />
    </td>
    <td>
        ';
            $orderby = $option['orderby'];
            echo $this->default_orderby[$orderby];;
            echo '				<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[';
            echo $timestamp;;
            echo '][orderby]" value="';
            echo $orderby;;
            echo '" />
    </td>
    <td>';
            echo $option['order'];;
            echo '<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[';
            echo $timestamp;;
            echo '][order]" value="';
            echo $option['order'];;
            echo '" /></td>
    <td>';
            $schedules = wp_get_schedules();
            echo $schedules[$option['schedule']]['display'];;
            echo '<input type="hidden" name="qqworld-auto-save-images-cron-scan-posts[';
            echo $timestamp;;
            echo '][schedule]" value="';
            echo $option['schedule'];;
            echo '" /></td>
    <td>
        ';
            echo date(__('H:i:s, d M Y', $this->text_domain), $timestamp);;
            echo '			</td>
    <td><input type="button" class="button button-primary" value="';
            echo __('Delete');;
            echo '" name="delete-schedule" timestamp="';
            echo $timestamp;;
            echo '" /></td>
</tr>
';
        }
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function do_cron_scan_post($post_type, $tax_query, $post__in, $offset, $posts_per_page, $post_status, $orderby, $order)
    {
        set_time_limit($this->timeout);
        $args = array();
        $args['post_type'] = $post_type;
        if (!empty($tax_query)) {
            $args['tax_query'] = array(
                'relation' => 'OR'
            );
            $args['tax_query'] = array_merge($args['tax_query'], $tax_query);
        }
        if ($post__in) $args['post__in'] = $post__in;
        if ($offset) $args['offset'] = $offset;
        $args['posts_per_page'] = $posts_per_page;
        $args['post_status'] = $post_status;
        $args['orderby'] = $orderby;
        $args['order'] = $order;
        $args['p'] = 4803;
        $posts = get_posts($args);
        foreach ($posts as $id => $post) {
            $content = $post->post_content;
            $content = $this->content_save_pre($content, $post->ID);
            wp_update_post(array('ID' => $post->ID, 'post_content' => $content));
        }
    }

    public function get_watermark_attachments_list()
    {
        if (!current_user_can($this->authorization)) return;
        $paged = $_REQUEST['paged'];
        $args = array(
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'meta_key' => '_added_watermark',
            'meta_value' => 1,
            'meta_compare' => 'NOT EXISTS',
            'posts_per_page' => 1000,
            'offset' => 1000 * $paged
        );
        $attachments = get_posts($args);
        if (!empty($attachments)) {
            $success_message = sprintf(_n('%d no watermark attachment found, processing...', '%d no watermark attachments found, processing...', count($attachments), $this->text_domain), number_format_i18n(count($attachments)));
            $array = array();
            foreach ($attachments as $attachment) $array[] = $attachment->ID;
            $results = array(
                'success' => 1,
                'msg' => $success_message,
                'attachments' => $array
            );
        } else {
            $failed_message = __('Congratulations, seems like all attachments had already processed.', $this->text_domain);
            $results = array(
                'success' => 0,
                'msg' => $failed_message
            );
        }
        echo json_encode($results);
        exit;
    }

    public function add_watermark_to_attachment()
    {
        if (!isset($_POST['attachment_id']) || empty($_POST['attachment_id'])) return;
        $attachment_id = $_POST['attachment_id'];
        $attachment = get_post($attachment_id);
        $type = $attachment->post_mime_type;
        $full_size = wp_get_attachment_image_src($attachment_id, 'full');
        $thumbnail_size = wp_get_attachment_image_src($attachment_id);
        $results = array(
            'type' => $type,
            'sizes' => array(
                'full' => $full_size,
                'thumbnail' => $thumbnail_size
            )
        );
        $file = $this->download_image($full_size[0]);
        $image_path = get_attached_file($attachment_id);
        $this->is_added_watermark = false;
        $this->is_animated_gif = $this->isAnimatedGif($image_path);
        $image_data = getimagesize($image_path);
        if (!$this->is_animated_gif && $image_data[0] >= $this->filter_size['width'] && $image_data[1] >= $this->filter_size['height']) {
            ob_start();
            $this->add_watermark($image_path, $this->watermark_path, 'save');
            $image = ob_get_contents();
            ob_end_clean();
            $fp = fopen($image_path, "wb");
            fwrite($fp, $image);
            fclose($fp);
        }
        if ($this->is_added_watermark) {
            update_post_meta($attachment_id, '_added_watermark', 1);
            $results['success'] = 1;
        }
        echo json_encode($results);
        exit;
    }

    public function clear_all_schedule_crons()
    {
        if (!current_user_can($this->authorization)) return;
        $this->clear_all_crons('qqworld-auto-save-images-cron-scan-post');
        $options = get_option('qqworld-auto-save-images-cron-scan-posts');
        if (!empty($options)) {
            update_option('qqworld-auto-save-images-cron-scan-posts', '');
            $results = array('success' => 1, 'msg' => __('Successfully cleared all Crons.', $this->text_domain));
        } else {
            $results = array('success' => 0, 'msg' => __('No Crons found.', $this->text_domain));
        }
        echo json_encode($results);
        exit;
    }

    public function clear_all_crons($hook)
    {
        $crons = _get_cron_array();
        if (empty($crons)) {
            return;
        }
        foreach ($crons as $timestamp => $cron) {
            if (!empty($cron[$hook])) {
                unset($crons[$timestamp][$hook]);
                if (empty($crons[$timestamp])) unset($crons[$timestamp]);
            }
        }
        _set_cron_array($crons);
    }

    public function set_cron_scan_post()
    {
        if (!current_user_can($this->authorization)) return;
        $args = $this->get_scan_args($_POST);
        if (isset($args['tax_query'])) unset($args['tax_query']['relation']);
        $schedule = $_POST['schedule'];
        $args['schedule'] = $schedule;
        $timestamp = current_time('timestamp', 1);
        $options = array(
            $timestamp => $args
        );
        if (!wp_next_scheduled('qqworld-auto-save-images-cron-scan-post')) {
            $post_type = $args['post_type'];
            $tax_query = isset($args['tax_query']) && !empty($args['tax_query']) ? $args['tax_query'] : '';
            $post__in = isset($args['post__in']) && !empty($args['post__in']) ? $args['post__in'] : '';
            $offset = isset($args['offset']) && !empty($args['offset']) ? $args['offset'] : '';
            $posts_per_page = $args['posts_per_page'];
            $post_status = $args['post_status'];
            $orderby = $args['orderby'];
            $order = $args['order'];
            wp_schedule_event($timestamp, $schedule, 'qqworld-auto-save-images-cron-scan-post', array($post_type, $tax_query, $post__in, $offset, $posts_per_page, $post_status, $orderby, $order));
        }
        $results = array(
            'success' => 1,
            'html' => $this->get_cron_table_row($options),
            'args' => $args
        );
        echo json_encode($results);
        exit;
    }

    public function wipe_post_meta($post_id)
    {
        delete_post_meta($post_id, 'Original Link');
        delete_post_meta($post_id, 'CRC of Original Image');
    }

    public function wipe_attachment_meta($post_id)
    {
        delete_post_meta($post_id, '_compressed');
        delete_post_meta($post_id, '_sync_aliyun_oss');
        delete_post_meta($post_id, '_sync_upyun');
    }

    public function database_replacement()
    {
        if (!current_user_can($this->authorization)) return;
        global $wpdb;
        $table = $_POST['table'];
        $field = $_POST['field'];
        $source = $_POST['source'];
        $replacement = $_POST['replacement'];
        if (!empty($source) && !empty($replacement)) {
            $sql = "UPDATE `{$table}` SET `{$field}`=REPLACE(`{$field}`, '{$source}', '{$replacement}')";
            $result = $wpdb->query($sql);
            $results = array(
                'success' => $result,
                'sql' => $sql,
                'msg' => $result ? sprintf(_n('%d data has been effected.', '%d data have been effected.', $result, $this->text_domain), number_format_i18n($result)) : __('Nothing Changed.', $this->text_domain)
            );
        } else {
            $results = array(
                'success' => 0,
                'msg' => __('Please enter Source Text & Replacement Text.', $this->text_domain)
            );
        }
        echo json_encode($results);
        exit;
    }

    public function delete_attachment($post_id)
    {
        do_action('qqworld-auto-save-images-delete-attachment-' . $this->optimize_mode, $post_id);
    }

    public function image_downsize($downsize, $id, $size)
    {
        return apply_filters('qqworld-auto-save-images-image-downsize-' . $this->optimize_mode, $downsize, $id, $size);
    }

    public function wp_get_attachment_url($url, $post_id)
    {
        return apply_filters('qqworld-auto-save-images-attachment-url-' . $this->optimize_mode, $url, $post_id);
    }

    public function set_crc_of_attachment($metadata, $attachment_id)
    {
        $upload_dir = wp_upload_dir();
        $file = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . $metadata['file'];
        $crc = $this->getCrc32($file);
        update_post_meta($attachment_id, 'CRC of Original Image', $crc);
        return $metadata;
    }

    public function sync_oss($metadata, $attachment_id)
    {
        if ($this->optimize_enabled == 'yes' && !in_array($this->optimize_mode, array('local', 'ftp'))) {
            do_action('qqworld-auto-save-images-sync-oss-' . $this->optimize_mode, $metadata, $attachment_id, $this->optimize_url);
        }
        return $metadata;
    }

    public function manage_media_columns($cols)
    {
        if ($this->compression_enabled == 'yes') {
            $cols["compression"] = __("Compression", $this->text_domain);
        }
        if ($this->optimize_enabled == 'yes') {
            $cols = apply_filters('qqworld-auto-save-images-manage-media-columns-' . $this->optimize_mode, $cols);
        }
        return $cols;
    }

    public function manage_media_custom_column($column_name, $id)
    {
        switch ($column_name) {
            case 'compression':
                $compressed = get_post_meta($id, '_compressed', true);
                $mime_type = get_post_mime_type($id);
                if (in_array($mime_type, array('image/jpeg'))) {
                    if ($compressed) {
                        echo '<input type="button" attachment-id="' . $id . '" class="button" name="compress-again" value="' . __('Compress Again', $this->text_domain) . '">';
                    } else {
                        echo '<input type="button" attachment-id="' . $id . '" class="button button-primary" name="compress-it" value="' . __('Compress It', $this->text_domain) . '">';
                    }
                } else {
                    echo '<p style="color: #ccc;">';
                    _e('Uncompressible', $this->text_domain);
                    echo '</p>';
                }
                break;
        }
        do_action('qqworld-auto-save-images-manage-media-custom-column', $column_name, $id);
    }

    public function admin_notices()
    {
        $screen = get_current_screen();
        if (strstr($screen->id, 'qqworld-auto-save-images')) {
            settings_errors();
            if (!function_exists('curl_init')) add_settings_error('qqworld-auto-save-images', esc_attr('needs_php_lib'), __("Your server PHP does not support cUrl, please remove ';' from in front of extension=php_curl.dll in the php.ini.", $this->text_domain), 'error');
            if (!function_exists('imagecreate')) add_settings_error('qqworld-auto-save-images', esc_attr('needs_php_lib'), __("Your server PHP does not support GD2, please remove ';' from in front of extension=php_gd2.dll in the <strong>php.ini</strong>.", $this->text_domain), 'error');
            if (!function_exists('file_get_contents')) add_settings_error('qqworld-auto-save-images', esc_attr('needs_php_lib'), __('Your server PHP does not support fopen, please set allow_url_fopen=1 in the php.ini.', $this->text_domain), 'error');
            settings_errors('qqworld-auto-save-images');
        }
    }

    public function get_attachments_list()
    {
        if (!current_user_can($this->authorization)) return;
        $mode = $_REQUEST['mode'];
        $paged = $_REQUEST['paged'];
        switch ($mode) {
            case 'compression':
                $args = array(
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image/jpeg',
                    'meta_key' => '_compressed',
                    'meta_value' => 1,
                    'meta_compare' => 'NOT EXISTS',
                    'posts_per_page' => 1000,
                    'offset' => 1000 * $paged
                );
                break;
        }
        $attachments = get_posts($args);
        switch ($mode) {
            case 'compression':
                $success_message = sprintf(_n('%d uncompressed image of attachments found, compressing...', '%d uncompressed images of attachments found, compressing...', count($attachments), $this->text_domain), number_format_i18n(count($attachments)));
                $failed_message = __('Congratulations, seems like all images attachments had already compressed.', $this->text_domain);
                break;
        }
        if (!empty($attachments)) {
            $array = array();
            foreach ($attachments as $attachment) $array[] = $attachment->ID;
            $results = array(
                'success' => 1,
                'msg' => $success_message,
                'attachments' => $array
            );
        } else {
            $results = array(
                'success' => 0,
                'msg' => $failed_message
            );
        }
        echo json_encode($results);
        exit;
    }

    public function compress_single_attachment()
    {
        if (!current_user_can($this->authorization)) return;
        $attachment_id = $_POST['attachment_id'];
        $attachment = get_post($attachment_id);
        $type = $attachment->post_mime_type;
        $fullsize_path = get_attached_file($attachment_id);
        $file_paths = $this->get_all_thumb_file_full_path($attachment_id, $fullsize_path);
        $file_paths['full'] = $fullsize_path;
        $size1 = 0;
        $size2 = 0;
        foreach ($file_paths as $size => $path) {
            $src = wp_get_attachment_image_src($attachment_id, $size);
            $filesize = @filesize($path);
            $size1 += $filesize;
            switch ($type) {
                case 'image/jpeg':
                    $img = @imagecreatefromjpeg($path);
                    if (@imagejpeg($img, $path, $this->compression_level)) {
                        $sizes[$size] = array(
                            'success' => 1,
                            'src' => $src[0],
                            'path' => $path,
                            'filesize1' => $filesize
                        );
                    }
                    break;
            }
        }
        if (!empty($sizes)) foreach ($sizes as $size => $result) {
            $filesize = @filesize($result['path']);
            $size2 += $filesize;
            $sizes[$size]['filesize2'] = $filesize;
        }
        update_post_meta($attachment_id, '_compressed', 1);
        $msg = sprintf(_n('%d image has been compressed, ', '%d images have been compressed, ', count($sizes), $this->text_domain), number_format_i18n(count($sizes)));
        $msg .= sprintf(__('Total space saving %s.', $this->text_domain), $this->formatBytes($size1 - $size2));
        $results = array(
            'msg' => $msg,
            'sizes' => $sizes
        );
        echo json_encode($results);
        exit;
    }

    public function compress_attachment()
    {
        if (!current_user_can($this->authorization)) return;
        $sizes = array();
        $attachment_id = $_POST['attachment_id'];
        $fullsize_path = get_attached_file($attachment_id);
        $file_paths = $this->get_all_thumb_file_full_path($attachment_id, $fullsize_path);
        $file_paths['full'] = $fullsize_path;
        $size1 = 0;
        $size2 = 0;
        foreach ($file_paths as $size => $path) {
            remove_filter('upload_dir', array($this, 'upload_dir'));
            $src = wp_get_attachment_image_src($attachment_id, $size);
            add_filter('upload_dir', array($this, 'upload_dir'));
            $filesize = @filesize($path);
            $size1 += $filesize;
            $img = @imagecreatefromjpeg($path);
            if (@imagejpeg($img, $path, $this->compression_level)) {
                $sizes[$size] = array(
                    'success' => 1,
                    'src' => $src[0],
                    'path' => $path,
                    'filesize1' => $filesize
                );
            }
        }
        foreach ($sizes as $size => $result) {
            $filesize = @filesize($result['path']);
            $size2 += $filesize;
            $sizes[$size]['filesize2'] = $filesize;
        }
        update_post_meta($attachment_id, '_compressed', 1);
        $msg = sprintf(_n('%d image has been compressed, ', '%d images have been compressed, ', count($sizes), $this->text_domain), number_format_i18n(count($sizes)));
        $msg .= sprintf(__('Total space saving %s.', $this->text_domain), $this->formatBytes($size1 - $size2));
        $results = array(
            'msg' => $msg,
            'sizes' => $sizes
        );
        echo json_encode($results);
        exit;
    }

    public function get_url_headers($url)
    {
        $headers = @get_headers($url);
        if ($headers) {
            $array = array();
            foreach ($headers as $header) {
                $parts = explode(':', $header);
                if (count($parts) == 2) $array[$parts[0]] = ltrim($parts[1]);
            }
            return $array;
        }
        return false;
    }

    public function smart_grabbing($remote_images, $content)
    {
        $pattern = '/<a[^<]+href=\"(.*?)\".*?><img.*?src=\"((?!\").*?)\".*?>?<[^>]+a>/i';
        $preg = preg_match_all($pattern, $content, $matches);
        if ($preg) {
            if (isset($matches[1]) && isset($matches[2])) {
                $images_1 = $matches[1];
                $images_2 = $matches[2];
                foreach ($images_1 as $i => $image_1) {
                    $image_2 = $images_2[$i];
                    $image_1_header = $this->get_url_headers($image_1);
                    $image_2_header = $this->get_url_headers($image_2);
                    if (in_array($image_1_header['Content-Type'], $this->allowed_image_types) && in_array($image_2_header['Content-Type'], $this->allowed_image_types)) {
                        if ($this->is_remote_image($image_1) && $this->is_remote_image($image_2)) {
                            $image_1_size = $image_1_header['Content-Length'];
                            $image_2_size = $image_2_header['Content-Length'];
                            $results[$i] = array();
                            if ($image_1_size > $image_2_size) {
                                $remote_images[] = array('target' => 'href', 'image_url' => $image_1);
                                $pattern_image_url = $this->encode_pattern($image_1);
                                $pattern = '/<a[^<]+href=\"' . $pattern_image_url . '\".*?><img.*?src=\"((?!\").*?)\".*?>?<[^>]+a>/i';
                            } else {
                                $remote_images[] = array('target' => 'src', 'image_url' => $image_2);
                                $pattern_image_url = $this->encode_pattern($image_2);
                                $pattern = '/<a[^<]+href=\"(.*?)\".*?><img.*?src=\"' . $pattern_image_url . '\".*?>?<[^>]+a>/i';
                            }
                            $this->temp_content = preg_replace($pattern, '', $this->temp_content);
                        }
                    }
                }
            }
        }
        return $remote_images;
    }

    public function save_remote_images_save_outside_links()
    {
        if (!current_user_can($this->authorization)) return;
        if (isset($_POST['id']) && isset($_POST['href'])) {
            $link = $_POST['href'];
            $content = '<a href="' . $link . '" target="_blank" rel="nofollow">' . __('Original Link', $this->text_domain) . '</a>';
            $content = apply_filters('qqworld-auto-save-images-save-outsite-link', $content, $link);
            $args = array(
                'ID' => $_POST['id'],
                'post_content' => $content
            );
            wp_update_post($args);
        }
        exit;
    }

    public function download_update_file()
    {
        $url = $_POST['url'];
        $ajaxurl = $_POST['ajaxurl'];
        $login_url = $_POST['login_url'];
        $action = $_POST['update_action'];
        $post_id = $_POST['post_id'];
        $attachment_id = $_POST['attachment_id'];
        $update_url = "{$ajaxurl}?action={$action}&post_id={$post_id}&attachment_id={$attachment_id}";
        $cookie_jar = tmpfile();
        $chcookie = curl_init();
        $postdata = "log={$this->qqworld_org_user}&pwd={$this->qqworld_org_password}&wp-submit=Log%20In&redirect_to={$url}/wp-admin/&testcookie=1";
        curl_setopt($chcookie, CURLOPT_URL, $login_url);
        curl_setopt($chcookie, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($chcookie, CURLOPT_TIMEOUT, 60);
        curl_setopt($chcookie, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($chcookie, CURLOPT_RETURNTRANSFER, 0);
        curl_setopt($chcookie, CURLOPT_COOKIEJAR, $cookie_jar);
        curl_setopt($chcookie, CURLOPT_COOKIEFILE, $cookie_jar);
        curl_setopt($chcookie, CURLOPT_REFERER, $login_url);
        curl_setopt($chcookie, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($chcookie, CURLOPT_POST, 1);
        ob_start();
        $result = curl_exec($chcookie);
        ob_end_clean();
        curl_close($chcookie);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $update_url);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
        $file = curl_exec($ch);
        $tmp_dir = ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir();
        $update_file = $tmp_dir . DIRECTORY_SEPARATOR . 'update.zip';
        file_put_contents($update_file, $file);
        curl_close($ch);
        if (!empty($file)) {
            $result = array(
                'success' => 1,
                'msg' => __('Successfully downloaded update file. updating now...', $this->text_domain),
                'file' => $update_file
            );
        } else {
            $result = array(
                'success' => 0,
                'msg' => __('Failed to download update file, perhaps your server does not support cUrl, or update server was down, or login password was not correct.', $this->text_domain)
            );
        }
        echo json_encode($result);
        exit;
    }

    public function removeDir($dir)
    {
        $it = new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new \RecursiveIteratorIterator($it, \RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        return rmdir($dir);
    }

    public function update()
    {
        $file = $_POST['file'];
        $plugin = plugin_basename(__FILE__);
        $zip = new \ZipArchive();
        $rs = $zip->open($file);
        $success = false;
        if ($rs) {
            $this->removeDir(QQWORLD_COLLECTOR_DIR);
            if ($zip->extractTo(WP_PLUGIN_DIR)) {
                if (is_plugin_active($plugin)) {
                    deactivate_plugins($plugin);
                }
                activate_plugin($plugin);
                $success = true;
            } else {
                $result = array(
                    'success' => 0,
                    'msg' => __('Extract zip file failed, please try again.', $this->text_domain)
                );
            }
            $zip->close();
            unlink($file);
        } else {
            $result = array(
                'success' => 0,
                'msg' => __('Open zip file failed, please try again.', $this->text_domain)
            );
        }
        if ($success) {
            $result = array(
                'success' => 1,
                'msg' => __('Successfully Updated.', $this->text_domain),
            );
        } else {
            $result = array(
                'success' => 0,
                'msg' => __('Failed to updated, please try again.', $this->text_domain)
            );
        }
        echo json_encode($result);
        exit;
    }

    public function change_upload_dir($args)
    {
        $url = parse_url($args['url']);
        $args['url'] = $url['scheme'] . '://' . $this->optimize_host . $url['path'];
        $baseurl = parse_url($args['baseurl']);
        $args['baseurl'] = $baseurl['scheme'] . '://' . $this->optimize_host . $baseurl['path'];
        return $args;
    }

    public function outside_languages()
    {
        __('Michael Wang', $this->text_domain);
        __('QQWorld Auto Save Images Pro', $this->text_domain);
        __(' (In Development)', $this->text_domain);
    }

    public function manual_save_remote_images()
    {
        set_time_limit($this->timeout);
        if (!current_user_can($this->authorization)) return;
        if (isset($_REQUEST['mode'])) switch ($_REQUEST['mode']) {
            case 'get-remote-images-list':
                $post_id = $_REQUEST['post_id'];
                $this->current_post_id = $post_id;
                $content = $this->utf8_urldecode($this->utf8_urldecode($_REQUEST['content']));
                $result = array();
                if ($remote_images = $this->content_save_pre($content, null, 'get-remote-images-list')) {
                    foreach ($remote_images as $remote_image) {
                        $target = $remote_image['target'];
                        $image_url = $remote_image['image_url'];
                        if ($this->only_save_first != 'all' && $this->count++ > $this->only_save_first) continue;
                        if ($this->is_remote_image($image_url)) {
                            $result[] = $remote_image;
                        }
                    }
                } elseif (!empty($post_id)) $this->automatic_set_featured_pic_from_media_library($post_id);
                echo json_encode($result);
                break;
            case 'print-remote-images-list':
                ;
                echo '				<ul id="remote-images-list"></ul>
<script>jQuery(\'#remote-images-list\').html(QASI.results);QQWorld_Auto_Save_Image.manual_obj.action.when_tb_show.init();</script>
';
                break;
            case 'save-remote-images-list':
                $post_id = $_REQUEST['post_id'];
                $this->current_post_id = $post_id;
                $image_url = $this->utf8_urldecode($_REQUEST['image_url']);
                $target = $_REQUEST['target'];
                $title = $_REQUEST['title'];
                $alt = $_REQUEST['alt'];
                $args = array('alt' => $alt, 'title' => $title);
                if ($res = $this->save_images($image_url, $post_id, $args)) {
                    if (isset($res['id'])) {
                        $attachment_id = $res['id'];
                        $status = 1;
                        if ($alt) {
                            update_post_meta($attachment_id, '_wp_attachment_image_alt', $alt);
                            $res['alt'] = $alt;
                        }
                        if ($title) {
                            $attachment = array(
                                'ID' => $attachment_id,
                                'post_title' => $title
                            );
                            wp_update_post($attachment);
                            $res['title'] = $title;
                        }
                        $res['permalink'] = get_permalink($attachment_id);
                        update_post_meta($attachment_id, 'Original Link', $image_url);
                        $res['status'] = 1;
                    } elseif (is_array($res) && $res['code'] == self::NEED_DELETED) {
                        $res['status'] = 2;
                    } elseif (is_array($res) && $res['code'] == self::NEED_IGNORED) {
                        $res['status'] = 3;
                    } elseif (is_array($res) && $res['code'] == self::NO_MEDIA_LIBRARY) {
                        $res['status'] = 1;
                    }
                } else {
                    $res['status'] = 0;
                }
                $res['image_url'] = $image_url;
                $res['target'] = $target;
                echo json_encode($res);
                break;
            case 'save-post-content':
                $post_id = $_POST['post_id'];
                $failed = $_POST['failed'];
                if ($failed == 0) update_post_meta($post_id, 'qqworld-auto-save-images-posts-scanned', 'yes');
                $content = $this->utf8_urldecode($this->utf8_urldecode($_POST['content']));
                $content = apply_filters('qqworld-auto-save-images-content-save-pre', $content, $post_id);
                $post = array(
                    'ID' => $post_id,
                    'post_content' => addslashes($content)
                );
                $result = array("content" => $content);
                $result['status'] = wp_update_post($post);
                echo json_encode($result);
                break;
        }
        exit;
    }

    public function is_allowed_watermark()
    {
        if ($this->watermark_enabled != 'yes') return false;
        if ((isset($_POST['post_id']) && $_POST['post_id'] == 0) || !isset($_POST['post_id'])) {
            return in_array('media-library', $this->watermark_enabled_for) ? true : false;
        } elseif (isset($_POST['post_id']) && $_POST['post_id'] != 0) {
            return in_array('edit-page', $this->watermark_enabled_for) ? true : false;
        } else return false;
    }

    public function wp_handle_upload_prefilter($file)
    {
        $image_path = $file['tmp_name'];
        $this->type = $file['type'];
        if ($this->compression_enabled == 'yes') {
            $fp = fopen($image_path, "r");
            $stream = fread($fp, filesize($image_path));
            fclose($fp);
            $image = $this->compress_image($stream);
            $fp = fopen($image_path, "wb");
            fwrite($fp, $image);
            fclose($fp);
        }
        if (in_array($file['type'], $this->allowd_image_types)) {
            if (preg_match('/(\w*)\.(jpg|jpeg|png|gif)/', $file['name'], $match)) {
                $name = $match[1];
                $extension = '.' . $match[2];
                $file['name'] = $this->change_images_filename($name, $extension);
            }
        }
        if ($this->is_allowed_watermark()) {
            $this->is_added_watermark = false;
            $this->is_animated_gif = $this->isAnimatedGif($image_path);
            $image_data = getimagesize($image_path);
            if (!$this->is_animated_gif && $image_data[0] >= $this->filter_size['width'] && $image_data[1] >= $this->filter_size['height']) {
                ob_start();
                $this->add_watermark($image_path, $this->watermark_path, 'save');
                $image = ob_get_contents();
                ob_end_clean();
                $fp = fopen($image_path, "wb");
                fwrite($fp, $image);
                fclose($fp);
            }
        }
        return $file;
    }

    public function add_added_watermark_meta($attachment_id)
    {
        if ($this->is_added_watermark) update_post_meta($attachment_id, '_added_watermark', 1);
    }

    public function save_remote_images_get_categories_list()
    {
        if (isset($_REQUEST['posttype']) && !empty($_REQUEST['posttype'])) {
            $posttype = $_REQUEST['posttype'];
            $taxonomies = get_object_taxonomies($posttype);
            if (!empty($taxonomies)) foreach ($taxonomies as $tax) {
                $taxonomy = get_taxonomy($tax);
                echo '<div id="' . $tax . 'div" post-type="' . $tax . '" class="postbox"><div class="hndle">' . $taxonomy->labels->name . '</div><div class="inside"><div id="' . $tax . '-all" class="tabs-panel"><ul>';
                wp_terms_checklist('', array(
                    'taxonomy' => $tax,
                    'walker' => new Walker_Category_Checklist
                ));
                echo '</ul></div></div></div>';
            } else _e('No taxonomies found.', $this->text_domain);
        }
        exit;
    }

    public function post_updated_messages($messages)
    {
        global $post, $post_ID;
        $post_type = get_post_type($post_ID);
        $messages[$post_type][21] = __('All remote images have been saved.', $this->text_domain) . sprintf(__(' <a href="%s">View</a>', $this->text_domain), esc_url(get_permalink($post_ID)));
        $messages[$post_type][22] = __('Has missing images or image which could not download.', $this->text_domain) . sprintf(__(' <a href="%s">View</a>', $this->text_domain), esc_url(get_permalink($post_ID)));
        return $messages;
    }

    public function redirect_post_location($location, $post_id)
    {
        if ($this->has_remote_image) {
            if ($this->has_missing_image) $location = add_query_arg('message', 22, get_edit_post_link($post_id, 'url'));
            else $location = add_query_arg('message', 21, get_edit_post_link($post_id, 'url'));
        }
        return $location;
    }

    public function admin_enqueue_scripts()
    {
        global $post;
        $default_translation_array = array(
            'yes' => __('Yes'),
            'no' => __('No'),
            'format' => $this->format,
            'keep_outside_links' => $this->keep_outside_links,
            'auto_caption' => $this->auto_caption,
            'align_to_enabled' => $this->format_align_to_enabled,
            'align_to' => $this->format_align_to,
            'width_height' => $this->change_width_height,
            'speed_for_manual_mode' => $this->speed_for_manual_mode
        );
        if ($this->mode == 'manual' && ($GLOBALS['hook_suffix'] == 'post.php' || $GLOBALS['hook_suffix'] == 'post-new.php')) {
            wp_enqueue_script('jquery-effects-core');
            wp_enqueue_script('jquery-effects-shake');
            wp_register_style('qqworld-auto-save-images-style', QQWORLD_COLLECTOR_URL . 'css/manual.css');
            wp_enqueue_style('qqworld-auto-save-images-style');
            wp_deregister_style('animate');
            wp_register_style('animate', QQWORLD_COLLECTOR_URL . 'css/animate-min.css');
            wp_enqueue_style('animate');
            wp_register_script('noty', QQWORLD_COLLECTOR_URL . 'js/jquery.noty.packaged.min.js', array('jquery'));
            wp_enqueue_script('noty');
            wp_register_script('qqworld-auto-save-images-script-post', QQWORLD_COLLECTOR_URL . 'js/manual.js', array('jquery'));
            wp_enqueue_script('qqworld-auto-save-images-script-post');
            wp_register_script('qqworld-md5', QQWORLD_COLLECTOR_URL . 'js/md5.js', array('qqworld-auto-save-images-script-post'));
            wp_enqueue_script('qqworld-md5');
            wp_register_script('qqworld-pwd', QQWORLD_COLLECTOR_URL . 'js/pwd.min.js', array('qqworld-auto-save-images-script-post'));
            wp_enqueue_script('qqworld-pwd');
            $translation_array = array(
                'qasiprocode' => $this->activation_code,
                'in_processing' => __('In processing.', $this->text_domain),
                'product' => $this->product,
                'timeout' => __('Download Timeout, please set the timeout option that in optimization settings page to a longger time.', $this->text_domain),
                'successfully_saved' => __('Successfully saved.', $this->text_domain),
                'successfully_deleted' => __('Successfully deleted.', $this->text_domain),
                'successfully_ignored' => __('Successfully ignored.', $this->text_domain),
                'failed_saved' => __('Failed saved.', $this->text_domain),
                'no_remote_images_found' => __('No remote images found.', $this->text_domain),
                'all_remote_images_saved' => __('All remote images have been saved.<br />And the post content has been updated, no need to update again.', $this->text_domain),
                'portion_of_remote_images_saved' => __('Portion of remote images have been saved.<br />And the post content has been updated, no need to update again.', $this->text_domain),
                'all_remote_images_saved_failed' => __('All remote images saved failed.', $this->text_domain),
                'all_remote_images_canceled' => __("All remote images have been canceled, what are you doing?", $this->text_domain),
                'save_remote_images_you_selected' => __("Save remote images you've selected", $this->text_domain),
                'please_check_remote_images' => __('Please Check Remote Images', $this->text_domain),
                'remote_images_not_checked' => __('Are you sure?<br />Remote images not checked will be deleted.', $this->text_domain),
                'error' => __('Something error, please check.', $this->text_domain),
                'additional_content_after' => $this->additional_content['after'],
                'minimum_picture_size' => $this->minimum_picture_size,
                'minimum_picture_size_auto_delete' => $this->minimum_picture_size_auto_delete,
                'edit' => __('Edit'),
                'exclude_image' => __('Add this image to list of Exclude-CRC.', $this->text_domain),
                'delete_image' => __('Add this image to list of Delete-CRC.', $this->text_domain),
                'close' => __('Close'),
                'manual_list_title' => __('Title (title)', $this->text_domain),
                'manual_list_alt' => __('Alternative Text (alt)', $this->text_domain),
                'your_sure_add_to_blacklist' => __('Are you sure to add this image to blacklist?', $this->text_domain),
                'successed_add_image_to_blacklist' => __('This image has been successfully added to the blacklist!', $this->text_domain),
                'failed_add_image_to_blacklist' => __('This image can not be added to the blacklist!<br />Undownloadable or not exists?', $this->text_domain)
            );
            $translation_array = array_merge($default_translation_array, $translation_array);
            $translation_array = apply_filters('qqworld-auto-save-images-manual-mode-translation-array', $translation_array);
            wp_localize_script('qqworld-auto-save-images-script-post', 'QASI', $translation_array, '3.0.0');
        }
        if (preg_match('/qqworld-(collector|auto-save-images|collector-watermark|collector-optimization|collector-database|collector-translation).*?$/i', $GLOBALS['hook_suffix'], $matche)) {
            wp_deregister_style('animate');
            wp_register_style('animate', QQWORLD_COLLECTOR_URL . 'css/animate-min.css');
            wp_enqueue_style('animate');
            wp_register_script('noty-4-save', QQWORLD_COLLECTOR_URL . 'js/jquery.noty.packaged.min.js', array('jquery'));
            wp_enqueue_script('noty-4-save');
            wp_register_style('qqworld-auto-save-images-style', QQWORLD_COLLECTOR_URL . 'css/admin.css');
            wp_enqueue_style('qqworld-auto-save-images-style');
            wp_enqueue_script('wp-pointer');
            wp_enqueue_style('wp-pointer');
            wp_enqueue_script('jquery-ui-draggable');
            wp_enqueue_script('jquery-effects-core');
            wp_enqueue_script('jquery-effects-shake');
            wp_register_script('qqworld-auto-save-images-script', QQWORLD_COLLECTOR_URL . 'js/admin.js', array('jquery'));
            wp_enqueue_script('qqworld-auto-save-images-script');
            wp_register_script('qqworld-md5', QQWORLD_COLLECTOR_URL . 'js/md5.js', array('qqworld-auto-save-images-script'));
            wp_enqueue_script('qqworld-md5');
            wp_register_script('qqworld-pwd', QQWORLD_COLLECTOR_URL . 'js/pwd.min.js', array('qqworld-auto-save-images-script'));
            wp_enqueue_script('qqworld-pwd');
            wp_enqueue_media();
            $translation_array = array(
                'domain' => $_SERVER['HTTP_HOST'],
                'activation_code' => $this->activation_code,
                'version' => $this->plugin['Version'],
                'product' => $this->product,
                'qasiprocode' => $this->activation_code,
                'trial' => self::TRIAL,
                'expired_time' => self::EXPIRED_TIME,
                'expired_in' => __('Trial expires in %D% days %H% hours %I% minutes %S% seconds.', $this->text_domain),
                'unable_access_update_server' => __('Unable to access update server, please contact plugin author.', $this->text_domain),
                'your_sure' => __('Are you sure?', $this->text_domain),
                'are_your_sure' => __('Are you sure?<br />Before you click the yes button, I recommend backup site database.', $this->text_domain),
                'pls_select_post_types' => __('Please select post types.', $this->text_domain),
                'maybe_problem' => __('May be a problem with some posts: ', $this->text_domain),
                'no_need_enter_' => __("No need enter \"%s\".", $this->text_domain),
                'n_post_has_been_scanned' => __('%d post has been scanned.', $this->text_domain),
                'n_posts_have_been_scanned' => __('%d posts have been scanned.', $this->text_domain),
                'n_post_included_remote_images_processed' => __('%d post included remote images processed.', $this->text_domain),
                'n_posts_included_remote_images_processed' => __('%d posts included remote images processed.', $this->text_domain),
                'n_post_has_missing_images_couldnt_be_processed' => __("%d post has missing images couldn't be processed.", $this->text_domain),
                'n_posts_have_missing_images_couldnt_be_processed' => __("%d posts have missing images couldn't be processed.", $this->text_domain),
                'found_n_post_including_remote_images' => __('found %d post including remote images.', $this->text_domain),
                'found_n_posts_including_remote_images' => __('found %d posts including remote images.', $this->text_domain),
                'and_with_n_post_has_missing_images' => __("And with %d post has missing images.", $this->text_domain),
                'and_with_n_posts_have_missing_images' => __("And with %d posts have missing images.", $this->text_domain),
                'no_posts_processed' => __("No posts processed.", $this->text_domain),
                'no_post_has_remote_images_found' => __('No post has remote images found.', $this->text_domain),
                'no_posts_found' => __('No posts found.', $this->text_domain),
                'all_done' => __('All done.', $this->text_domain),
                'scanning' => __('Scanning...', $this->text_domain),
                'listing' => __('Listing...', $this->text_domain),
                'id' => __('ID'),
                'post_type' => __('Post Type', $this->text_domain),
                'title' => __('Title'),
                'status' => __('Status'),
                'control' => __('Control', $this->text_domain),
                'done' => __('Done'),
                'delete' => __('Delete'),
                'error' => __('Something error, please check.', $this->text_domain),
                'congratulations_all_compressed' => __('Congratulations, seems like all images attachments had already compressed.', $this->text_domain),
                'successfull_scheduled_single_event' => __('Successfull Scheduled Event.', $this->text_domain),
                'successfully_accessed' => __('Successfully Accessed.', $this->text_domain),
                'access_failed' => __('Access Failed.', $this->text_domain),
                'successfully_created' => __('Successfully Created.', $this->text_domain),
                'successfully_deleted' => __('Successfully Deleted.', $this->text_domain),
                'length_out_of_range' => __('Length out of range.', $this->text_domain),
                'nonstandard_naming' => __('Nonstandard naming.', $this->text_domain),
                'please_enter_source_replacement' => __('Please enter Source Text & Replacement Text.', $this->text_domain),
                'watermark_offset' => $this->offset,
                'default_watermark' => array(
                    'src' => QQWORLD_COLLECTOR_URL . 'images/watermark.png',
                    'width' => 205,
                    'height' => 61
                )
            );
            $translation_array = apply_filters('qqworld-auto-save-images-admin-translation-array', $translation_array);
            $translation_array = array_merge($default_translation_array, $translation_array);
            wp_localize_script('qqworld-auto-save-images-script', 'QASI', $translation_array, '3.0.0');
        }
        $screen = get_current_screen();
        if ($screen->base == 'upload') {
            wp_register_script('noty-4-save', QQWORLD_COLLECTOR_URL . 'js/jquery.noty.packaged.min.js', array('jquery'));
            wp_enqueue_script('noty-4-save');
            wp_register_script('upload_php', QQWORLD_COLLECTOR_URL . 'js/upload.php.js', array('jquery'));
            wp_enqueue_script('upload_php');
            $translation_array = array(
                'error' => __('Something error, please check.', $this->text_domain)
            );
            $translation_array = array_merge($default_translation_array, $translation_array);
            wp_localize_script('upload_php', 'QASI', $translation_array, '3.0.0');
        }
    }

    public function get_scan_args($postdata = null)
    {
        if (!$postdata) $postdata = $_REQUEST;
        $args = array();
        $post_types = isset($_REQUEST['qqworld-auto-save-images-post-types']) ? $_REQUEST['qqworld-auto-save-images-post-types'] : 'post';
        $args['post_type'] = $post_types;
        if (isset($_REQUEST['terms']) && !empty($_REQUEST['terms'])) {
            $terms = $_REQUEST['terms'];
            $args['tax_query'] = array(
                'relation' => 'OR'
            );
            foreach ($terms as $taxonomy => $term_ids) {
                $args['tax_query'][] = array(
                    'taxonomy' => $taxonomy,
                    'terms' => $term_ids,
                    'field' => 'id'
                );
            }
        }
        $id_from = $_REQUEST['id_from'];
        $id_to = $_REQUEST['id_to'];
        $id_from = $id_from == '0' ? 1 : $id_from;
        $id_to = $id_to == '0' ? 1 : $id_to;
        $post__in = array();
        if (!empty($id_from) && is_numeric($id_from) && empty($id_to)) {
            $post__in[] = $id_from;
        } elseif (empty($id_from) && !empty($id_to) && is_numeric($id_to)) {
            $post__in[] = $id_to;
        } elseif (!empty($id_from) && is_numeric($id_from) && !empty($id_to) && is_numeric($id_to)) {
            if ($id_from == $id_to) $post__in[] = $id_from;
            elseif ($id_from < $id_to) for ($s = $id_from; $s <= $id_to; $s++) $post__in[] = $s;
            elseif ($id_from > $id_to) for ($s = $id_from; $s >= $id_to; $s--) $post__in[] = $s;
        }
        $args['post__in'] = $post__in;
        $offset = empty($_REQUEST['offset']) ? 0 : $_POST['offset'];
        $args['offset'] = $offset;
        $posts_per_page = $_REQUEST['posts_per_page'];
        $args['posts_per_page'] = $posts_per_page;
        $args['order'] = $_REQUEST['order'];
        $args['post_status'] = $_REQUEST['post_status'];
        $args['orderby'] = $_REQUEST['orderby'];
        $args['posts_per_page'] = $_REQUEST['speed'];
        $args['paged'] = $_REQUEST['page'];
        if (!isset($_REQUEST['force-scan'])) {
            $args['meta_key'] = 'qqworld-auto-save-images-posts-scanned';
            $args['meta_compare'] = 'NOT EXISTS';
        }
        return $args;
    }

    public function get_scan_list()
    {
        global $wp_query;
        if (!current_user_can($this->authorization)) return;
        $args = $this->get_scan_args($_REQUEST);
        query_posts($args);
        $result = array(
            'page' => $_REQUEST['page'],
            'max_num_pages' => $wp_query->max_num_pages,
            'ids' => array()
        );
        while (have_posts()) {
            the_post();
            array_push($result['ids'], get_the_ID());
        }
        echo json_encode($result);
        wp_reset_query();
        exit;
    }

    public function save_remote_images_after_scan()
    {
        set_time_limit($this->timeout);
        if (!current_user_can($this->authorization)) return;
        $post_ids = $_REQUEST['post_id'];
        if (!empty($post_ids)) foreach ($post_ids as $post_id) :
            if (self::DEBUG) error_log('Starting scan post with id: ' . $post_id . ".\n", 3, 'f:/log.txt');
            $this->has_remote_image = 0;
            $this->has_missing_image = 0;
            $post = get_post($post_id);
            $post_id = $post->ID;
            $post_type = $post->post_type;
            $content = $post->post_content;
            $title = $post->post_title;
            $content = $this->content_save_pre($content, $post_id);
            wp_update_post(array('ID' => $post_id, 'post_content' => $content));
            $post_type_object = get_post_type_object($post_type);
            if ($this->has_remote_image) :
                $class = 'has_remote_images';
                if ($this->has_missing_image) $class .= ' has_not_exits_remote_images';
                $class = ' class="' . $class . '"';;
                echo '			<tr';
                echo $class;;
                echo '>
<td>';
                echo $post_id;;
                echo '</td>
<td>';
                echo $post_type_object->labels->name;;
                echo '</td>
<td><a href="';
                echo get_edit_post_link($post_id);;
                echo '" target="_blank">';
                echo $title;;
                echo ' &#8667;</a></td>
<td>';
                echo $this->has_missing_image ? '<span class="red">' . __('Has missing images.', $this->text_domain) . '</span>' : '<span class="green">' . __('All remote images have been saved.', $this->text_domain) . '</span>';;
                echo '</td>
</tr>
';
            else: ;
                echo '			<tr>
    <td colspan="4" class="hr"></td>
</tr>
';endif;
        endforeach;
        exit;
    }

    public function save_remote_images_list_all_posts()
    {
        set_time_limit($this->timeout);
        if (!current_user_can($this->authorization)) return;
        $post_ids = $_REQUEST['post_id'];
        if (!empty($post_ids)) foreach ($post_ids as $post_id) :
            $this->has_remote_image = 0;
            $this->has_missing_image = 0;
            $post = get_post($post_id);
            $post_id = $post->ID;
            $post_type = $post->post_type;
            $content = $post->post_content;
            $title = $post->post_title;
            $content = $this->content_save_pre($content, $post_id, 'get-remote-images-list');
            if ($this->has_remote_image) :
                $post_type_object = get_post_type_object($post_type);
                $class = $this->has_missing_image ? ' has_not_exits_remote_images' : '';;
                echo '			<tr class="has_remote_images';
                echo $class;;
                echo '">
    <td>';
                echo $post_id;;
                echo '</td>
    <td>';
                echo $post_type_object->labels->name;;
                echo '</td>
    <td><a href="';
                echo get_edit_post_link($post_id);;
                echo '" target="_blank">';
                echo $title;;
                echo ' &#8667;</a></td>
    <td>';
                echo $this->has_missing_image ? '<span class="red">' . __('Has missing images.', $this->text_domain) . '</span>' : __('Normal', $this->text_domain);;
                echo '</a></td>
    <td id="list-';
                echo $post_id;;
                echo '"><input type="button" post-id="';
                echo $post_id;;
                echo '" class="fetch-remote-images button button-primary" value="&#9997; ';
                _e('Fetch', $this->text_domain);;
                echo '" /></td>
</tr>
';
            else: ;
                echo '			<tr>
    <td colspan="5" class="hr"></td>
</tr>
';endif;
        endforeach;
        exit;
    }

    public function media_buttons()
    {
        if ($GLOBALS['hook_suffix'] == 'post.php' || $GLOBALS['hook_suffix'] == 'post-new.php') {
            ;
            echo '		<a href="javascript:" id="save-remote-images-button" class="button save_remote_images" title="';
            _e('Save Remote Images', $this->text_domain);;
            echo '"><span class="wp-media-buttons-icon"></span>';
            _e('Save Remote Images', $this->text_domain);;
            echo '</a>
';
            do_action('qqworld-collector-add-media-buttons-for-menual-mode');
        }
    }

    function registerPluginLinks($links, $file)
    {
        $base = plugin_basename(__FILE__);
        if ($file == $base) {
            $links[] = '<a href="' . menu_page_url('qqworld-auto-save-images', 0) . '">' . __('Settings') . '</a>';
        }
        return $links;
    }

    function admin_menu()
    {
        $parent_slug = 'edit.php?post_type=qqworld-collections';
        $capability = 'administrator';
        $page_title = __('Auto Save Images', $this->text_domain);
        $menu_title = $page_title;
        $menu_slug = 'qqworld-auto-save-images';
        $function = $this->is_activated ? array($this, 'auto_save_images_page') : array($this, 'activation_page');
        $settings_page = add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
        $page_title = __('Watermark', $this->text_domain);
        $menu_title = $page_title;
        $menu_slug = 'qqworld-collector-watermark';
        $function = $this->is_activated ? array($this, 'watermark_page') : array($this, 'activation_page');
        $settings_page = add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
        add_action("load-{$settings_page}", array($this, 'help_tab'));
        $page_title = __('Optimization', $this->text_domain);
        $menu_title = $page_title;
        $menu_slug = 'qqworld-collector-optimization';
        $function = $this->is_activated ? array($this, 'optimization_page') : array($this, 'activation_page');
        $settings_page = add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
        add_action("load-{$settings_page}", array($this, 'help_tab'));
        $page_title = __('Database', $this->text_domain);
        $menu_title = $page_title;
        $menu_slug = 'qqworld-collector-database';
        $function = $this->is_activated ? array($this, 'database_page') : array($this, 'activation_page');
        $settings_page = add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
        add_action("load-{$settings_page}", array($this, 'help_tab'));
    }

    function auto_save_images_page()
    {
        ;
        echo '<div class="wrap">
    <h2 id="header-title">';
        _e("Auto Save Images", $this->text_domain);;
        echo '</h2>
    <p>';
        _e('Automatically keep the all remote picture to the local, and automatically set featured image.', $this->text_domain);;
        echo '</p>
    <form action="options.php" method="post" id="form">
        ';
        settings_fields('qqworld-auto-save-images-settings');;
        echo '		<img src="';
        echo QQWORLD_COLLECTOR_URL;;
        echo 'images/banner-772x250.jpg" width="772" height="250" id="banner" />
        <ul id="qqworld-auto-save-images-tabs">
            <li class="current">';
        _e('General', $this->text_domain);;
        echo '</li>
            <li>';
        _e('Filter', $this->text_domain);;
        echo '</li>
            <li>';
        _e('Format', $this->text_domain);;
        echo '</li>
            <li>';
        _e('Scan Posts', $this->text_domain);;
        echo '</li>
            <li id="cron-tab">';
        _e('Cron', $this->text_domain);;
        echo '</li>
        </ul>
        <div class="tab-content">
            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row"><label>';
        _e('Mode', $this->text_domain);;
        echo '</label></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Mode', $this->text_domain);;
        echo '</span></legend>
                            <label for="auto">
                                <input name="qqworld-auto-save-images-mode" type="radio" id="auto" value="auto" ';
        checked('auto', $this->mode);;
        echo ' />
                                ';
        _e('Automatic', $this->text_domain);;
        echo '								</label> <span class="icon help" data-header="';
        _e('Mode', $this->text_domain);;
        echo '" data-content="';
        _e('Automatically save all remote images to local media libary when you save or publish post.', $this->text_domain);;
        echo '"></span><br />
                            <label for="manual">
                                <input name="qqworld-auto-save-images-mode" type="radio" id="manual" value="manual" ';
        checked('manual', $this->mode);;
        echo ' />
                                ';
        _e('Manual', $this->text_domain);;
        echo '								</label> <span class="icon help" data-header="';
        _e('Mode', $this->text_domain);;
        echo '" data-content="';
        _e('Manually save all remote images to local media libary when you click the button on the top of editor.', $this->text_domain);;
        echo '"></span>
                        </fieldset></td>
                </tr>

                <tr id="second_level" valign="top"';
        if ($this->mode != 'auto') echo ' style="display: none;"';;
        echo '>
                <th scope="row"><label>';
        _e('When', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('When', $this->text_domain);;
        echo '" data-content="';
        _e('Select the post statuses you want to grab remote images.', $this->text_domain);;
        echo '"></span></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('When', $this->text_domain);;
        echo '</span></legend>
                        ';
        global $wp_post_statuses;
        $checkboxes = array();
        foreach ($wp_post_statuses as $slug => $status) {
            if (!in_array($slug, array('auto-draft', 'inherit', 'trash'))) {
                $checked = in_array($slug, $this->when) ? ' checked' : '';
                $checkboxes[] = '<label><input type="checkbox" name="qqworld-auto-save-images-when[]" value="' . $slug . '" ' . $checked . ' /> ' . $status->label . '</label>';
            }
        }
        echo implode('<br />', $checkboxes);;
        echo '						</fieldset></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label>';
        _e('Schedule Publish', $this->text_domain);;
        echo '</label> <span class="icon help"  data-header="';
        _e('Schedule Publish', $this->text_domain);;
        echo '" data-content="';
        _e("Save remote images via Schedule Publish.", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Schedule Publish', $this->text_domain);;
        echo '</span></legend>
                            <label for="qqworld-auto-save-images-schedule-publish">
                                <input name="qqworld-auto-save-images-schedule-publish" type="checkbox" id="qqworld-auto-save-images-schedule-publish" value="yes" ';
        checked('yes', $this->schedule_publish);;
        echo ' />
                            </label>
                        </fieldset></td>
                </tr>


                <tr valign="top">
                    <th scope="row"><label for="remote_publishing">';
        _e('Remote Publishing', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Remote Publishing', $this->text_domain);;
        echo '" data-content="';
        _e("Save remote images via remote publishing from IFTTT or other way using XMLRPC. Only supports publish post.", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Remote Publishing', $this->text_domain);;
        echo '</span></legend>
                            <label for="qqworld-auto-save-images-remote-publishing">
                                <input name="qqworld-auto-save-images-remote-publishing" type="checkbox" id="remote_publishing" value="yes" ';
        checked('yes', $this->remote_publishing);;
        echo ' />
                            </label>
                        </fieldset></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label for="set_featured_image">';
        _e('Set Featured Image', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Set Featured Image', $this->text_domain);;
        echo '" data-content="';
        _e("Set first one of the remote images as featured image.", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Set Featured Image', $this->text_domain);;
        echo '</span></legend>
                            <label for="qqworld-auto-save-images-set-featured-image-yes">
                                <input name="qqworld-auto-save-images-set-featured-image" type="checkbox" id="qqworld-auto-save-images-set-featured-image-yes" value="yes" ';
        checked('yes', $this->featured_image);;
        echo ' />
                            </label>
                        </fieldset></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label for="qqworld-auto-save-images-no-media-library-yes">';
        _e('No Media Library', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('No Media Library', $this->text_domain);;
        echo '" data-content="';
        _e("Remote images will no be saved into media library, it means would not generate thumbnail. but if you checked Set-Featured-Image, the first remote image will be saved into media library.", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('No Media Library', $this->text_domain);;
        echo '</span></legend>
                            <label for="qqworld-auto-save-images-no-media-library-yes">
                                <input name="qqworld-auto-save-images-no-media-library" type="checkbox" id="qqworld-auto-save-images-no-media-library-yes" value="yes" ';
        checked('yes', $this->no_media_library);;
        echo ' />
                            </label>
                        </fieldset></td>
                </tr>
                </tbody>
            </table>
            ';
        do_action('qqworld-auto-save-images-general-options-form');;
        echo '			';
        submit_button();;
        echo '		</div>
        <div class="tab-content hidden">
            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row"><label for="only_save_first">';
        _e('Grabbing from Each Posts', $this->text_domain);;
        echo '</label></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Grabbing from Each Posts', $this->text_domain);;
        echo '</span></legend>
                            <select id="only_save_first" name="qqworld-auto-save-images-only-save-first">
                                <option value="all" ';
        selected('all', $this->only_save_first);;
        echo '>';
        _e('All Images', $this->text_domain);;
        echo '</option>
                                ';
        for ($i = 1; $i <= 30; $i++) {
            $selected = selected($i, $this->only_save_first, false);
            echo '<option value="' . $i . '" ' . $selected . '>' . sprintf(_n('First %d image only', 'First %d images only', $i, $this->text_domain), number_format_i18n($i)) . '</option>';
        };
        echo '								</select>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>';
        _e('Minimum Picture Size', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Minimum Picture Size', $this->text_domain);;
        echo '" data-content="';
        _e("Ignore smaller than this size picture.", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Minimum Picture Size', $this->text_domain);;
        echo '</span></legend>
                            <label for="qqworld-auto-save-images-minimum-picture-size-width">
                                ';
        _e('Width:', $this->text_domain);;
        echo ' <input name="qqworld-auto-save-images-minimum-picture-size[width]" class="small-text" type="text" id="qqworld-auto-save-images-minimum-picture-size-width" value="';
        echo $this->minimum_picture_size['width'];;
        echo '" /> ';
        _e('(px)', $this->text_domain);;
        echo '								</label><br />
                            <label for="qqworld-auto-save-images-minimum-picture-size-height">
                                ';
        _e('Height:', $this->text_domain);;
        echo ' <input name="qqworld-auto-save-images-minimum-picture-size[height]" class="small-text" type="text" id="qqworld-auto-save-images-minimum-picture-size-height" value="';
        echo $this->minimum_picture_size['height'];;
        echo '" readonly /> ';
        _e('(px)', $this->text_domain);;
        echo '								</label><br />
                            <label for="qqworld-auto-save-images-minimum-picture-size-auto-delete">
                                <input name="qqworld-auto-save-images-minimum-picture-size[auto-delete]" type="checkbox" id="qqworld-auto-save-images-minimum-picture-size-auto-delete" ';
        checked($this->minimum_picture_size_auto_delete, 'yes');
        echo ' value="yes" /> ';
        _e('Automatically delete images smaller than minimum-picture-size.', $this->text_domain);;
        echo '								</label>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>';
        _e('Maximum Picture Size', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Maximum Picture Size', $this->text_domain);;
        echo '" data-content="';
        _e("Automatic reduction is greater than the size of the picture. if you want image width less than 800px with any size height, please set width 800 and leave height blank.", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Maximum Picture Size', $this->text_domain);;
        echo '</span></legend>
                            <label for="qqworld-auto-save-images-maximum-picture-size-width">
                                ';
        _e('Width:', $this->text_domain);;
        echo ' <input name="qqworld-auto-save-images-maximum-picture-size[width]" class="small-text" type="text" id="qqworld-auto-save-images-maximum-picture-size-width" value="';
        echo $this->maximum_picture_size['width'];;
        echo '" /> ';
        _e('(px)', $this->text_domain);;
        echo '								</label><br />
                            <label for="qqworld-auto-save-images-maximum-picture-size-height">
                                ';
        _e('Height:', $this->text_domain);;
        echo ' <input name="qqworld-auto-save-images-maximum-picture-size[height]" class="small-text" type="text" id="qqworld-auto-save-images-maximum-picture-size-height" value="';
        echo $this->maximum_picture_size['height'];;
        echo '" /> ';
        _e('(px)', $this->text_domain);;
        echo '								</label>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="add_exclude_domain">';
        _e('Exclude Domain/Keyword', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Exclude Domain/Keyword', $this->text_domain);;
        echo '" data-content="';
        _e("Images will not be saved, if that url contains Exclude-Domain/Keyword.", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Exclude Domain/Keyword', $this->text_domain);;
        echo '</span></legend>
                            <ul id="exclude_domain_list">
                                ';
        if (!empty($this->exclude_domain)) foreach ($this->exclude_domain as $domain) :
            if (!empty($domain)) :
                ;
                echo '								<li>http(s):// <input type="text" name="qqworld-auto-save-images-exclude-domain[]" class="regular-text" value="';
                echo $domain;;
                echo '" /><input type="button" class="button delete-exclude-domain" value="';
                _e('Delete');;
                echo '"></li>
                                ';endif;
        endforeach;;
        echo '								</ul>
                            <p><input type="button" id="add_exclude_domain" class="button" value="';
        _e('Add a Domain/Keyword', $this->text_domain);;
        echo '" /></p>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="add_exclude_crc">';
        _e('Exclude CRC', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Exclude CRC', $this->text_domain);;
        echo '" data-content="';
        _e("Remote images will not be saved, if the CRC of image in this list.", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Exclude CRC', $this->text_domain);;
        echo '</span></legend>
                            <ul id="exclude_crc_list">
                                ';
        if (!empty($this->exclude_crc)) foreach ($this->exclude_crc as $crc) :
            if (!empty($crc)) :
                ;
                echo '								<li><input type="text" name="qqworld-auto-save-images-exclude-crc[]" value="';
                echo $crc;;
                echo '" /><input type="button" class="button delete-exclude-crc" value="';
                _e('Delete');;
                echo '"></li>
                                ';endif;
        endforeach;;
        echo '								</ul>
                            <p><input type="button" id="add_exclude_crc" class="button" value="';
        _e('Add a CRC of Image', $this->text_domain);;
        echo '" /> <span class="icon help" data-header="';
        _e('How to get CRC of Image?', $this->text_domain);;
        echo '" data-content="';
        _e("Use 7-Zip, WinRAR or others compression tools.", $this->text_domain);;
        echo '"></span></p>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="add_delete_crc">';
        _e('Delete CRC', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Delete CRC', $this->text_domain);;
        echo '" data-content="';
        _e("Remote images html code will be deleted, if the CRC of image in this list. it's priority than Exclude-CRC", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Delete CRC', $this->text_domain);;
        echo '</span></legend>
                            <ul id="delete_crc_list">
                                ';
        if (!empty($this->delete_crc)) foreach ($this->delete_crc as $crc) :
            if (!empty($crc)) :
                ;
                echo '								<li><input type="text" name="qqworld-auto-save-images-delete-crc[]" value="';
                echo $crc;;
                echo '" /><input type="button" class="button delete-delete-crc" value="';
                _e('Delete');;
                echo '"></li>
                                ';endif;
        endforeach;;
        echo '								</ul>
                            <p><input type="button" id="add_delete_crc" class="button" value="';
        _e('Add a CRC of Image', $this->text_domain);;
        echo '" /> <span class="icon help" data-header="';
        _e('How to get CRC of Image?', $this->text_domain);;
        echo '" data-content="';
        _e("Use 7-Zip, WinRAR or others compression tools.", $this->text_domain);;
        echo '"></span></p>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>';
        _e('Excluded Keywords', $this->text_domain);
        echo '</label></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Excluded Keywords', $this->text_domain);;
        echo '</span></legend>
                            <ol>
                                ';
        $exclude_domain = $this->get_exclude_domain();
        foreach ($exclude_domain as $domain) : ;
            echo '									<li>';
            echo $domain;;
            echo '</li>
                                ';endforeach;;
        echo '								</ol>
                        </fieldset></td>
                </tr>
                </tbody>
            </table>
            ';
        submit_button();;
        echo '		</div>
        <div class="tab-content hidden">
            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row"><label for="auto_change_name">';
        _e('Change Image Filename', $this->text_domain);;
        echo '</label></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Change Image Filename', $this->text_domain);;
        echo '</span></legend>
                            <select id="auto_change_name" name="qqworld-auto-save-images-auto-change-name">
                                <option value="none" ';
        selected('none', $this->change_image_name);;
        echo '>1. ';
        _e('No');;
        echo '</option>
                                <option value="ascii" ';
        selected('ascii', $this->change_image_name);;
        echo '>2. ';
        _e('Only change remote images filename that have Non-ASCii characters (for Windows Server)', $this->text_domain);;
        echo '</option>
                                <option value="all" ';
        selected('all', $this->change_image_name);;
        echo '>3. ';
        _e('Change all remote images Filename (for Linux Server)', $this->text_domain);;
        echo '</option>
                            </select>
                        </fieldset></td>
                </tr>
                <tr valign="top" id="filename-source-field"';
        if ($this->change_image_name != 'all') echo ' style="display: none;"';
        echo '>
                <th scope="row"><label>';
        _e('Filename Source & Source Priority', $this->text_domain);;
        echo '</label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Filename Source & Source Priority', $this->text_domain);;
        echo '</span></legend>
                        ';
        $filename_sources = array(
            'postname' => __('Post Name', $this->text_domain),
            'alt' => __('Alternative Text of Image (alt)', $this->text_domain),
            'title' => __('Title of Image', $this->text_domain)
        );;
        echo '								<table class="qasi-drag-list" style="width: 270px;">
                            ';
        foreach ($this->filename_source as $value) :
            ;
            echo '									<tr>
                                <td style="width: 250px;"><label><input type="checkbox" name="qqworld-auto-save-images-filename-source[]" value="';
            echo $value;;
            echo '" checked="true" style="dispaly: none;" />';
            echo $filename_sources[$value];;
            echo '</label></td>
                                <td><span class="icon drag"></span></td>
                            </tr>
                            ';
        endforeach;;
        echo '								</table>
                    </fieldset></td>
                </tr>
                <tr valign="top" id="filename-structure-field"';
        if ($this->change_image_name != 'all') echo ' style="display: none;"';
        echo '>
                <th scope="row"><label for="filename-structure">';
        _e('Custom Filename Structure', $this->text_domain);;
        echo '</label></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Custom Filename Structure', $this->text_domain);;
        echo '</span></legend>
                        <label for="filename-structure">
                            <input name="qqworld-auto-save-images-format[filename-structure]" type="text" id="filename-structure" class="regular-text" value="';
        echo $this->filename_structure;;
        echo '" />
                        </label>
                        <p class="description">
                            <strong>%filename%</strong> : ';
        _e('Original filename or automatic changed filename.', $this->text_domain);;
        echo '<br />
                            <strong>%date%</strong> : ';
        _e('Full date, e.g. 20150209.', $this->text_domain);;
        echo '<br />
                            <strong>%year%</strong> - ';
        _e('YYYY, e.g. 2015.', $this->text_domain);;
        echo '<br />
                            <strong>%month%</strong> - ';
        _e('MM, e.g. 02.', $this->text_domain);;
        echo '<br />
                            <strong>%day%</strong> -  ';
        _e('DD, e.g. 15.', $this->text_domain);;
        echo '<br />
                            <strong>%time%</strong> - ';
        _e('HHMMSS, e.g. 182547.', $this->text_domain);;
        echo '<br />
                            <strong>%timestamp%</strong> - ';
        printf(__('Unix timestamp, e.g. %s.', $this->text_domain), time());;
        echo '								</p>
                    </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>';
        _e('Change Title & Alt', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Change Title & Alt', $this->text_domain);;
        echo '" data-content="';
        _e('Automatically add title & alt of image as post title or custom text.', $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Change Title & Alt', $this->text_domain);;
        echo '</span></legend>
                            <label for="format_title_alt">
                                <input name="qqworld-auto-save-images-format[title-alt]" type="checkbox" id="format_title_alt" value="yes" ';
        checked('yes', $this->change_title_alt);;
        echo ' />
                                <input name="qqworld-auto-save-images-format[custom-title-alt]" type="text" placeholder="';
        _e('Custom Text for Title & Alt', $this->text_domain);;
        echo '" class="regular-text" value="';
        echo $this->custom_title_alt;;
        echo '" />
                            </label>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="format_keep_outside_links">';
        _e('Keep Outside Links', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Keep Outside Links', $this->text_domain);;
        echo '" data-content="';
        _e("Keep the outside links of remote images if exist.", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Keep Outside Links', $this->text_domain);;
        echo '</span></legend>
                            <label for="format_keep_outside_links">
                                <input name="qqworld-auto-save-images-format[keep-outside-links]" type="checkbox" id="format_keep_outside_links" value="yes" ';
        checked('yes', $this->keep_outside_links);;
        echo ' />
                            </label>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="format_save_outside_links">';
        _e('Save Outside Links', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Save Outside Links', $this->text_domain);;
        echo '" data-content="';
        _e("Save the outside links to description of attachments.", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Save Outside Links', $this->text_domain);;
        echo '</span></legend>
                            <label for="format_save_outside_links">
                                <input name="qqworld-auto-save-images-format[save-outside-links]" type="checkbox" id="format_save_outside_links" value="yes" ';
        checked('yes', $this->save_outside_links);;
        echo ' />
                            </label>
                            <p>';
        _e('To custom the content, add codes into <strong>functions.php</strong> like this below:', $this->text_domain);;
        echo '</p>
								<pre>add_filter(\'qqworld-auto-save-images-save-outsite-link\', \'save_outside_link\', 10, 2);
function save_outside_link($content, $link) {
	$content = \'&lta href="\'.$link.\'" target="_blank" rel="nofollow"&gt;Original Link&lt;/a&gt;\';
	return $content;
}</pre>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="width_height">';
        _e('Width &amp; Height', $this->text_domain);;
        echo '</label></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Width &amp; Height', $this->text_domain);;
        echo '</span></legend>
                            <label for="width_height">
                                <input name="qqworld-auto-save-images-format[width-height]" type="checkbox" id="width_height" value="yes" ';
        checked('yes', $this->change_width_height);;
        echo ' />
                            </label>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="format-size">';
        _e('Image Size', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Image Size', $this->text_domain);;
        echo '" data-content="';
        _e("Replace images you want size to display.", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Image Size', $this->text_domain);;
        echo '</span></legend>
                            <label>
                                <select name="qqworld-auto-save-images-format[size]" id="format-size">
                                    ';
        $sizes = apply_filters('image_size_names_choose', array(
            'thumbnail' => __('Thumbnail'),
            'medium' => __('Medium'),
            'large' => __('Large'),
            'full' => __('Full Size')
        ));
        foreach ($sizes as $value => $title) echo '<option value="' . $value . '"' . selected($value, $this->format['size'], false) . '>' . $title . '</option>';;
        echo '									</select>
                            </label>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="format-link-to">';
        _e('Link To', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Link To', $this->text_domain);;
        echo '" data-content="';
        _e("If you checked Keep-Outside-Links, this option will not works.", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Link To', $this->text_domain);;
        echo '</span></legend>
                            <label>
                                <select name="qqworld-auto-save-images-format[link-to]" id="format-link-to">
                                    ';
        $linkTo = array(
            'file' => __('Media File'),
            'post' => __('Attachment Page'),
            'none' => __('None')
        );
        foreach ($linkTo as $value => $title) echo '<option value="' . $value . '"' . selected($value, $this->format_link_to, false) . '>' . $title . '</option>';;
        echo '									</select>
                            </label>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="format-align-to-enabled">';
        _e('Align To', $this->text_domain);;
        echo '</label></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Align To', $this->text_domain);;
        echo '</span></legend>
                            <input name="qqworld-auto-save-images-format[align-to-enabled]" type="checkbox" id="format-align-to-enabled" value="yes" ';
        checked('yes', $this->format_align_to_enabled);;
        echo ' />
                            <label>
                                <select name="qqworld-auto-save-images-format[align-to]" id="format-align-to"';
        if ($this->format_align_to_enabled == 'no') echo ' style="display: none;"';;
        echo '>
                                ';
        $linkTo = array(
            'left' => __('Left'),
            'center' => __('Center'),
            'right' => __('Right'),
            'none' => __('None')
        );
        foreach ($linkTo as $value => $title) echo '<option value="' . $value . '"' . selected($value, $this->format_align_to, false) . '>' . $title . '</option>';;
        echo '									</select>
                            </label>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="format_caption">';
        _e('Auto Caption', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Auto Caption', $this->text_domain);;
        echo '" data-content="';
        _e("Automatically add caption shortcode.", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Auto Caption', $this->text_domain);;
        echo '</span></legend>
                            <label for="format_caption">
                                <input name="qqworld-auto-save-images-format[auto-caption]" type="checkbox" id="format_caption" value="yes" ';
        checked('yes', $this->auto_caption);;
        echo ' />
                            </label>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="additional_content_after">';
        _e('Additional Content', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Additional Content', $this->text_domain);;
        echo '" data-content="';
        _e("This content will be displayed after the each remote images code. you can use [Attachment ID] indicate current attachment ID.", $this->text_domain);;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _e('Additional Content', $this->text_domain);;
        echo '</span></legend>
                            <label>
                                <textarea name="qqworld-auto-save-images-format[additional-content][after]" rows="3" cols="80" id="additional_content_after">';
        echo $this->additional_content['after'];;
        echo '</textarea>
                                <p class="discription">';
        _e("For example: [Gbuy id='[Attachment ID]']", $this->text_domain);;
        echo '</p>
                            </label>
                        </fieldset></td>
                </tr>
                </tbody>
            </table>
            ';
        submit_button();;
        echo '		</div>
    </form>
    <form action="" method="post" id="scan">
        <div class="tab-content hidden">
            <div id="scan-result"></div>
            <div id="scan-post-block">
                <table class="form-table">
                    <tbody>
                    <tr valign="top">
                        <th scope="row"><label>';
        _e('Select post types', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Select post types', $this->text_domain);;
        echo '" data-content="';
        _e("If you have too many posts to be scan, sometimes in process looks like stopping, but it may be fake. please be patient.", $this->text_domain);
        echo '"></span></th>
                        <td>
                            ';
        $post_types = get_post_types('', 'objects');;
        echo '								<ul id="post_types_list">
                                ';
        foreach ($post_types as $name => $post_type) :
            if (!in_array($name, array('attachment', 'revision', 'nav_menu_item'))) : ;
                echo '									<li><label><input name="qqworld-auto-save-images-post-types[]" type="checkbox" value="';
                echo $name;;
                echo '" /> ';
                echo $post_type->labels->name;;
                echo ' (';
                $count = wp_count_posts($name);
                echo $count->publish;;
                echo ')</label></li>
                                ';endif;
        endforeach;;
        echo '</ul>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label>';
        _e('Categories');;
        echo '</label> <span class="icon help" data-header="';
        _e('Categories');;
        echo '" data-content="';
        _e("Default empty to scan all categories.", $this->text_domain);
        echo '"></span></th>
                        <td id="categories_block">';
        _e('Please select post types.', $this->text_domain);;
        echo '</td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="id_from">';
        _e('Scope of Post ID', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Scope of Post ID', $this->text_domain);;
        echo '" data-content="';
        _e("Default empty for scan all posts ID. If you want to scan posts ID from 50 to 100. please type '50' and '100' or '100' and '50', The order in which two numbers can be reversed. If you only type one number, system would only scan that ID.", $this->text_domain);;
        echo '"></span></th>
                        <td>';
        printf(__('From %1$s to %2$s', $this->text_domain), '<input type="number" class="small-text" name="id_from" id="id_from" />', '<input type="number" class="small-text" name="id_to" />');;
        echo '</td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="offset">';
        _e('Offset', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Offset', $this->text_domain);;
        echo '" data-content="';
        _e("Default scan all posts. If you want to scan 50-150 posts, please type '50' in the textfield and select '100'.", $this->text_domain);;
        echo '"></span></th>
                        <td>
                            ';
        printf(__('Start from %s to Scan', $this->text_domain), '<input type="number" class="small-text" name="offset" id="offset" value="0" disabled />');;
        echo '								<select name="posts_per_page">
                                <option value="-1">';
        _e('All');;
        echo '</option>
                                ';
        for ($i = 1; $i <= 10; $i++) : ;
            echo '									<option value="';
            echo $i * 100;;
            echo '">';
            echo $i * 100;;
            echo '</option>
                                ';endfor;;
        echo '									<option value="2000">2000</option>
                                <option value="5000">5000</option>
                            </select> ';
        _e('Posts');;
        echo '							</td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="scan_post_status">';
        _e('Status');;
        echo '</label></th>
                        <td>
                            <select name="post_status" id="scan_post_status">
                                ';
        global $wp_post_statuses;
        echo '<option value="any" /> ' . __('Any', $this->text_domain) . '</option>';
        foreach ($wp_post_statuses as $slug => $status) {
            if (!in_array($slug, array('auto-draft', 'inherit', 'trash'))) echo '<option value="' . $slug . '" ' . selected('publish', $slug, false) . '> ' . $status->label . '</option>';
        };
        echo '								</select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="scan_orderby">';
        _e('Order By', $this->text_domain);;
        echo '</label></th>
                        <td>
                            <select name="orderby" id="scan_orderby">
                                ';
        foreach ($this->default_orderby as $key => $name) : ;
            echo '									<option value="';
            echo $key;;
            echo '"';
            selected('date', $key);;
            echo '>';
            echo $name;;
            echo '</option>
                                ';endforeach;;
        echo '								</select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="order">';
        _e('Order');;
        echo '</label></th>
                        <td id="categories_block"><fieldset>
                                <select name="order" id="order">
                                    <option value="DESC">DESC</option>
                                    <option value="ASC">ASC</option>
                                </select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="scan_speed">';
        _e('Speed', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Speed', $this->text_domain);;
        echo '" data-content="';
        _e('If the server is too much stress may be appropriately reduced speed.', $this->text_domain);;
        echo '"></span></th>
                        <td>
                            <select name="speed" id="scan_speed">
                                ';
        for ($i = 1; $i < 10; $i++) : ;
            echo '									<option value="';
            echo $i;;
            echo '">';
            echo $i;;
            echo '</option>
                                ';endfor;;
        echo '									<option value="10" selected>10</option>
                            </select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="force-scan">';
        _e('Force Scan', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Force Scan', $this->text_domain);;
        echo '" data-content="';
        _e("Successfully scanned posts will be marked, wouldn\'t be scanned again. if you check this, they will be scanned again.", $this->text_domain);;
        echo '"></span></th>
                        <td>
                            <label><input name="force-scan" id="force-scan" type="checkbox" value="yes" /></label>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p class="submit">
                    <input name="scan_old_posts" type="button" class="button-primary" id="scan_old_posts" value="';
        _e('Automatic', $this->text_domain);;
        echo ' &#8667;" /> <span class="icon help" data-header="';
        _e('Automatic', $this->text_domain);;
        echo '" data-content="';
        _e('Scan posts and keep remote images in all posts to local media library. Maybe take a long time.', $this->text_domain);;
        echo '"></span>
                    <input name="list_all_posts" type="button" class="button-primary" id="list_all_posts" value="';
        _e('Manual', $this->text_domain);;
        echo ' &#9776;" /> <span class="icon help" data-header="';
        _e('Manual', $this->text_domain);;
        echo '" data-content="';
        _e("The list displayed will show you which posts including remote images, then you can keep them to local manually via click \"Fetch\" button.", $this->text_domain);;
        echo '"></span>
                    &nbsp;&nbsp;
                    <select name="schedule" id="scan-schedules">
                        ';
        foreach (wp_get_schedules() as $recurrence => $detail) {
            echo '<option value="' . $recurrence . '">' . $detail['display'] . '</option>';
        };
        echo '					</select>
                    <input name="cron_scan_posts" type="button" class="button-primary" id="cron_scan_posts" value="';
        _e('Cron', $this->text_domain);;
        echo ' &#8667;" /> <span class="icon help" data-header="';
        _e('Cron', $this->text_domain);;
        echo '" data-content="';
        _e("Set cron for automatically scan posts.<br />I recommend set the option Offset from 0 to scan 100 posts.", $this->text_domain);;
        echo '"></span>
                </p>
                ';
        if ($this->timeout < 3600 && $this->timeout > 0) : ;
            echo '					<p style="vertical-align: middle;"><span class="icon warning"></span> ';
            printf(__("Setting <a href=\"%s\" target=\"_blank\">Timeout</a> is not enough, please set at least 1 hour.", $this->text_domain), admin_url('edit.php?post_type=qqworld-collections&page=qqworld-collector-optimization'));;
            echo '</p>
                ';endif;;
        echo '			</div>
        </div>
    </form>
    <form action="" method="post" id="scan-cron">
        <div class="tab-content hidden">
            <div id="cron-list-container">
                <h3>';
        _e('Cron of Scan Posts', $this->text_domain);;
        echo '</h3>
                <table id="cron-list-table" class="common-list-table">
                    <thead>
                    <th>';
        _e('Post Types', $this->text_domain);;
        echo '</th>
                    <th>';
        _e('Categories');;
        echo '</th>
                    <th>';
        _e('Scope of Post ID', $this->text_domain);;
        echo '</th>
                    <th>';
        _e('Offset', $this->text_domain);;
        echo '</th>
                    <th>';
        _e('Status');;
        echo '</th>
                    <th>';
        _e('Order By', $this->text_domain);;
        echo '</th>
                    <th>';
        _e('Order');;
        echo '</th>
                    <th>';
        _e('Recurrence', $this->text_domain);;
        echo '</th>
                    <th>';
        _e('Will Run On', $this->text_domain);;
        echo '</th>
                    <th>';
        _e('Delete');;
        echo '</th>
                    </thead>
                    ';
        $crons = $this->get_crons('qqworld-auto-save-images-cron-scan-post');;
        echo '					<tbody id="cron-list">
                    ';
        if (!empty($crons)) {
            $options = array();
            foreach ($crons as $cron) {
                $options[$cron['timestamp']] = array(
                    'post_type' => $cron['options']['args'][0],
                    'offset' => isset($cron['options']['args'][3]) && !empty($cron['options']['args'][3]) ? $cron['options']['args'][3] : 0,
                    'posts_per_page' => $cron['options']['args'][4],
                    'post_status' => $cron['options']['args'][5],
                    'orderby' => $cron['options']['args'][6],
                    'order' => $cron['options']['args'][7],
                    'schedule' => $cron['options']['schedule']
                );
                if (isset($cron['options']['args'][1]) && !empty($cron['options']['args'][1])) $options[$cron['timestamp']]['tax_query'] = $cron['options']['args'][1];
                if (isset($cron['options']['args'][2]) && !empty($cron['options']['args'][2])) $options[$cron['timestamp']]['post__in'] = $cron['options']['args'][2];
            }
            echo $this->get_cron_table_row($options);
        };
        echo '					</tbody>
                    <tfoot';
        if (!empty($crons)) echo ' style="display: none;"';;
        echo '>
                    <tr><td colspan="10" align="center">';
        _e('No Cron yet.', $this->text_domain);;
        echo '</td></tr>
                    </tfoot>
                </table>
                <p class="submit">
                    <input type="button" class="button button-primary" id="clear-all-crons" value="';
        _e('Clear All Crons', $this->text_domain);;
        echo '" />
                </p>
            </div>
        </div>
    </form>
</div>
';
    }

    public function watermark_page()
    {
        ;
        echo '<div class="wrap">
    <h2 id="header-title">';
        _e('Watermark', $this->text_domain);;
        echo '</h2>
    <form action="options.php" method="post" id="watermark-form">
        ';
        settings_fields('qqworld-auto-save-images-watermark');;
        echo '		<table class="form-table">
            <tbody>
            <tr valign="top">
                <th scope="row"><label for="watermark-enabled">';
        _e('Enabled Watermark', $this->text_domain);;
        echo '</label></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Enabled Watermark', $this->text_domain);;
        echo '</span></legend>
                        <label for="watermark-enabled">
                            <input name="qqworld-auto-save-images-watermark-enabled" type="checkbox" id="watermark-enabled" value="yes" ';
        checked('yes', $this->watermark_enabled);;
        echo ' />
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="enabled-for">';
        _e('Enabled For', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Enabled For', $this->text_domain);;
        echo '" data-content="';
        _e("Please select the method to using watermark.", $this->text_domain);;
        echo '"></span></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Enabled For', $this->text_domain);;
        echo '</span></legend>
                        <label for="watermark-enabled-for-collection">
                            <input name="qqworld-auto-save-images-watermark-enabled-for[]" type="checkbox" id="watermark-enabled-for-collection" value="collection"';
        if (in_array('collection', $this->watermark_enabled_for)) echo ' checked';;
        echo ' /> ';
        _e('Auto Save Images', $this->text_domain);;
        echo '							</label> <span class="icon help" data-header="';
        _e('Enabled For', $this->text_domain);;
        echo '" data-content="';
        _e("Enabled for Auto Save Image.", $this->text_domain);;
        echo '"></span><br />
                        <label for="watermark-enabled-for-edit-page">
                            <input name="qqworld-auto-save-images-watermark-enabled-for[]" type="checkbox" id="watermark-enabled-for-edit-page" value="edit-page"';
        if (in_array('edit-page', $this->watermark_enabled_for)) echo ' checked';;
        echo ' /> ';
        _e('Edit Page', $this->text_domain);;
        echo '							</label> <span class="icon help" data-header="';
        _e('Enabled For', $this->text_domain);;
        echo '" data-content="';
        _e("Enabled for Update image in Edit page.", $this->text_domain);;
        echo '"></span><br />
                        <label for="watermark-enabled-for-media-library">
                            <input name="qqworld-auto-save-images-watermark-enabled-for[]" type="checkbox" id="watermark-enabled-for-media-library" value="media-library"';
        if (in_array('media-library', $this->watermark_enabled_for)) echo ' checked';;
        echo ' /> ';
        _e('Media Library', $this->text_domain);;
        echo '							</label> <span class="icon help" data-header="';
        _e('Enabled For', $this->text_domain);;
        echo '" data-content="';
        _e("Enabled for Update image in Meida Labrary page.", $this->text_domain);;
        echo '"></span>
                    </fieldset>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="ignore-animated-gif">';
        _e('Ignore animated GIF', $this->text_domain);;
        echo '</label></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Ignore animated GIF', $this->text_domain);;
        echo '</span></legend>
                        <label for="ignore-animated-gif">
                            <input name="qqworld-auto-save-images-watermark-ignore-animated-gif" type="checkbox" id="ignore-animated-gif" value="yes" ';
        checked('yes', $this->ignore_animated_gif);;
        echo ' />
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>';
        _e('Filter by Sizes', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Filter by Sizes', $this->text_domain);;
        echo '" data-content="';
        _e("Skip images that smaller than this size.", $this->text_domain);;
        echo '"></span></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Filter by Sizes', $this->text_domain);;
        echo '</span></legend>
                        <label for="filter-size-width">
                            ';
        _e('Width:', $this->text_domain);;
        echo ' <input name="qqworld-auto-save-images-watermark-filter-size[width]" type="number" id="filter-size-width" value="';
        echo $this->filter_size['width'];;
        echo '" class="small-text" /> ';
        _e('(px)', $this->text_domain);;
        echo '							</label><br />
                        <label for="filter-size-height">
                            ';
        _e('Height:', $this->text_domain);;
        echo ' <input name="qqworld-auto-save-images-watermark-filter-size[height]" type="number" id="filter-size-height" value="';
        echo $this->filter_size['height'];;
        echo '" class="small-text" /> ';
        _e('(px)', $this->text_domain);;
        echo '							</label>
                    </fieldset>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>';
        _e('Filter by Url', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Filter by Url', $this->text_domain);;
        echo '" data-content="';
        _e("Skip images that url contains these keywords.", $this->text_domain);;
        echo '"></span></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Filter by Url', $this->text_domain);;
        echo '</span></legend>
                        <ul id="filter_url_list">
                            ';
        if (!empty($this->filter_url)) foreach ($this->filter_url as $url) :
            if (!empty($url)) :
                ;
                echo '								<li>http(s):// <input type="text" name="qqworld-auto-save-images-watermark-filter-url[]" class="regular-text" value="';
                echo $url;;
                echo '" /><input type="button" class="button delete-watermark-filter-url" value="';
                _e('Delete');;
                echo '"></li>
                            ';endif;
        endforeach;;
        echo '								</ul>
                        <p><input type="button" id="add-watermark-filter-url" class="button" value="';
        _e('Add a Domain/Keyword', $this->text_domain);;
        echo '" /></p>
                    </fieldset>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="watermark-random-position">';
        _e('Random Position', $this->text_domain);;
        echo '</label></th>
                <td>
                    <legend class="screen-reader-text"><span>';
        _e('Random Position', $this->text_domain);;
        echo '</span></legend>
                    <label for="watermark-random-position">
                        <input name="qqworld-auto-save-images-watermark-random-position" type="checkbox" id="watermark-random-position" value="yes" ';
        checked('yes', $this->watermark_random_position);;
        echo ' />
                    </label>
                    </fieldset>
                </td>
            </tr>
            <tr id="watermark-align-to-container" valign="top"';
        if ($this->watermark_random_position == 'yes') echo ' style="display: none;"';;
        echo '>
            <th scope="row"><label>';
        _e('Align To', $this->text_domain);;
        echo '</label></th>
            <td>
                <table id="watermark-align-to">
                    <tr>
                        <td><label><input type="radio" value="lt" id="lt" name="qqworld-auto-save-images-watermark-align-to" ';
        checked('lt', $this->align_to);
        echo ' /></label></td>
                        <td><label><input type="radio" value="ct" id="ct" name="qqworld-auto-save-images-watermark-align-to" ';
        checked('ct', $this->align_to);
        echo ' /></label></td>
                        <td><label><input type="radio" value="rt" id="rt" name="qqworld-auto-save-images-watermark-align-to" ';
        checked('rt', $this->align_to);
        echo ' /></label></td>
                    </tr>
                    <tr>
                        <td><label><input type="radio" value="lc" id="lc" name="qqworld-auto-save-images-watermark-align-to" ';
        checked('lc', $this->align_to);
        echo ' /></label></td>
                        <td><label><input type="radio" value="cc" id="cc" name="qqworld-auto-save-images-watermark-align-to" ';
        checked('cc', $this->align_to);
        echo ' /></label></td>
                        <td><label><input type="radio" value="rc" id="rc" name="qqworld-auto-save-images-watermark-align-to" ';
        checked('rc', $this->align_to);
        echo ' /></label></td>
                    </tr>
                    <tr>
                        <td><label><input type="radio" value="lb" id="lb" name="qqworld-auto-save-images-watermark-align-to" ';
        checked('lb', $this->align_to);
        echo ' /></label></td>
                        <td><label><input type="radio" value="cb" id="cb" name="qqworld-auto-save-images-watermark-align-to" ';
        checked('cb', $this->align_to);
        echo ' /></label></td>
                        <td><label><input type="radio" value="rb" id="rb" name="qqworld-auto-save-images-watermark-align-to" ';
        checked('rb', $this->align_to);
        echo ' /></label></td>
                    </tr>
                </table>
            </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>';
        _e('Position', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Position', $this->text_domain);;
        echo '" data-content="';
        _e("You can try to drag the watermark image.", $this->text_domain);;
        echo '"></span></th>
                <td>
                    <div id="watermark-position">
                        ';
        if ($this->watermark_image) :
            $attr = array(
                'id' => 'watermark-test'
            );
            echo wp_get_attachment_image($this->watermark_image, 'full', null, $attr);
        else : ;
            echo '								<img id="watermark-test" src="';
            echo QQWORLD_COLLECTOR_URL;;
            echo 'images/watermark.png" width="205" height="61" />
                        ';endif;;
        echo '							<img id="photo-test" src="';
        echo QQWORLD_COLLECTOR_URL;;
        echo 'images/photo.jpg" width="800" height="450" />
                    </div>
                    ';
        add_thickbox();;
        echo '						<p><a href="#TB_inline?height=472&width=800&inlineId=preview-watermark" class="button" id="button-preview-watermark" title="';
        _e('Preview Watermark Effect', $this->text_domain);;
        echo '">';
        _e('Preview Watermark Effect', $this->text_domain);;
        echo '</a></p>
                    <div id="preview-watermark" class="hidden"><img style="margin-top: 13px;" src="';
        echo admin_url('admin-ajax.php?action=save_remote_images_preview_watermark&mode=image');;
        echo '" width="800" height="450" /></div>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>';
        _e('Offset', $this->text_domain);;
        echo '</label></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Offset', $this->text_domain);;
        echo '</span></legend>
                        <label for="offset-x">
                            X: <input name="qqworld-auto-save-images-watermark-offset[x]" type="text" id="offset-x" value="';
        echo $this->offset['x'];;
        echo '" class="small-text" readonly />
                        </label>
                        <label for="offset-y">
                            Y: <input name="qqworld-auto-save-images-watermark-offset[y]" type="text" id="offset-y" value="';
        echo $this->offset['y'];;
        echo '" class="small-text" readonly />
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="watermark-opacity">';
        _e('Opacity', $this->text_domain);;
        echo '</label></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Opacity', $this->text_domain);;
        echo '</span></legend>
                        <label for="qqworld-auto-save-images-watermark-opacity">
                            <input name="qqworld-auto-save-images-watermark-opacity" type="number" id="watermark-opacity" value="';
        echo $this->watermark_opacity;;
        echo '" class="small-text" /> (0-100)
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label id="for-watermark-image" for="watermark-image">';
        _e('Upload Watermark Image', $this->text_domain);;
        echo '</label></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Upload Watermark Image', $this->text_domain);;
        echo '</span></legend>
                        <label for="watermark-image">
                            <a href="javascript:" id="upload-watermark-image" title="';
        _e('Insert a Watermark Image', $this->text_domain);;
        echo '">
                                ';
        if ($this->watermark_image) :
            echo wp_get_attachment_image($this->watermark_image, 'full');
        else : ;
            echo '									<img src="';
            echo QQWORLD_COLLECTOR_URL;;
            echo 'images/watermark.png" width="205" height="61" />
                                ';endif;;
        echo '								</a>
                            <input name="qqworld-auto-save-images-watermark-image" id="watermark-image" type="hidden" title="" value="';
        echo $this->watermark_image;;
        echo '" />
                        </label>
                    </fieldset>
                    <input type="button" class="button';
        if (!$this->watermark_image) echo ' hidden';;
        echo '" id="default-watermark" value="';
        _e('Default Watermark', $this->text_domain);;
        echo '">
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="scan-media-library-to-add-watermark">';
        _e('Scan', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Scan', $this->text_domain);;
        echo '" data-content="';
        _e("Scan media library to automatically add watermark to allowed images. Will not process to images that already added watermark. (Full size only)", $this->text_domain);;
        echo '"></span></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Scan', $this->text_domain);;
        echo '</span></legend>
                        <label for="scan-media-library-to-add-watermark">
                            <input type="button" class="button" id="scan-media-library-to-add-watermark" value="';
        _e('Scan', $this->text_domain);;
        echo ' &#8667;" />
                        </label>
                    </fieldset>
                </td>
            </tr>
            </tbody>
        </table>
        ';
        submit_button();;
        echo '	</form>
</div>
';
    }

    public function optimization_page()
    {
        ;
        echo '<div class="wrap">
    <form action="options.php" method="post" id="optimization-form">
        ';
        settings_fields('qqworld-auto-save-images-optimization');;
        echo '		<h2>';
        _e('Authorization Settings', $this->text_domain);;
        echo '</h2>
        <table class="form-table">
            <tbody>
            <tr valign="top">
                <th scope="row"><label for="who-can-use">';
        _e('Who Can Use?', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Who Can Use?', $this->text_domain);;
        echo '" data-content="';
        _e('Set roles who can use this plugin.', $this->text_domain);;
        echo '"></span></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Timeout', $this->text_domain);;
        echo '</span></legend>
                        <label>
                            <select id="who-can-use" name="qqworld-collector-authorization">
                                <option value="read"';
        selected('read', $this->authorization);;
        echo '>';
        _e('Subscriber+ (Read)', $this->text_domain);;
        echo '</option>
                                <option value="edit_posts"';
        selected('edit_posts', $this->authorization);;
        echo '>';
        _e('Contributor+ (Edit Posts)', $this->text_domain);;
        echo '</option>
                                <option value="publish_posts"';
        selected('publish_posts', $this->authorization);;
        echo '>';
        _e('Author+ (Publish Posts)', $this->text_domain);;
        echo '</option>
                                <option value="edit_others_posts"';
        selected('edit_others_posts', $this->authorization);;
        echo '>';
        _e('Editor+ (Edit Others Posts)', $this->text_domain);;
        echo '</option>
                                <option value="manage_options"';
        selected('manage_options', $this->authorization);;
        echo '>';
        _e('Administrator+ (Manage Options)', $this->text_domain);;
        echo '</option>
                            </select>
                        </label>
                    </fieldset></td>
            </tr>
            </tbody>
        </table>
        <h2>';
        _e('Webserver Stress', $this->text_domain);;
        echo '</h2>
        <table class="form-table">
            <tbody>
            <tr valign="top">
                <th scope="row"><label for="speed_for_manual_mode">';
        _e('Speed', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Speed', $this->text_domain);;
        echo '" data-content="';
        _e('For Manual Mode, if your server is not powerful. use a low speed will be better.', $this->text_domain);;
        echo '"></span></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Speed', $this->text_domain);;
        echo '</span></legend>
                        <label>
                            <select id="speed_for_manual_mode" name="qqworld-collector-webserver[speed]">
                                ';
        for ($i = 1; $i < 11; $i++) : ;
            echo '								<option value="';
            echo $i;;
            echo '"';
            selected($i, $this->speed_for_manual_mode);;
            echo '>';
            echo $i;;
            echo '</option>
                                ';endfor;;
        echo '								<option value="0"';
        selected(0, $this->speed_for_manual_mode);;
        echo '>';
        _e('Unlimited', $this->text_domain);;
        echo '</option>
                            </select>
                        </label>
                    </fieldset></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="timeout">';
        _e('Timeout', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Timeout', $this->text_domain);;
        echo '" data-content="';
        _e('PHP run time limit (Default: 30 seconds),<br /><strong>For Manual Mode</strong>: Most situation default 30 seconds is fine, but if you want download WeChat images i recommend 3 minutes.<br /><strong>For Automatic Mode</strong>: You need set a bigger number if you need grabbing many remote images at one time. Recommend set Half-a-Hour.<br /><strong>For Scan Mode</strong>: I recommend 10 times as long as the time required for automatic mode.', $this->text_domain);;
        echo '"></span></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Timeout', $this->text_domain);;
        echo '</span></legend>
                        <label>
                            <select id="timeout" name="qqworld-collector-webserver[timeout]">
                                <option value="30"';
        selected(30, $this->timeout);;
        echo '>';
        _e('30 Seconds (Default)', $this->text_domain);;
        echo '</option>
                                <option value="180"';
        selected(180, $this->timeout);;
        echo '>';
        _e('3 Minutes', $this->text_domain);;
        echo '</option>
                                <option value="300"';
        selected(300, $this->timeout);;
        echo '>';
        _e('5 Minutes', $this->text_domain);;
        echo '</option>
                                <option value="600"';
        selected(600, $this->timeout);;
        echo '>';
        _e('10 Minutes', $this->text_domain);;
        echo '</option>
                                <option value="900"';
        selected(900, $this->timeout);;
        echo '>';
        _e('15 Minutes', $this->text_domain);;
        echo '</option>
                                <option value="1800"';
        selected(1800, $this->timeout);;
        echo '>';
        _e('Half a Hour', $this->text_domain);;
        echo '</option>
                                <option value="3600"';
        selected(3600, $this->timeout);;
        echo '>';
        _e('1 Hour', $this->text_domain);;
        echo '</option>
                                <option value="7200"';
        selected(7200, $this->timeout);;
        echo '>';
        _e('2 Hours', $this->text_domain);;
        echo '</option>
                                <option value="18000"';
        selected(18000, $this->timeout);;
        echo '>';
        _e('5 Hours', $this->text_domain);;
        echo '</option>
                                <option value="36000"';
        selected(36000, $this->timeout);;
        echo '>';
        _e('10 Hours', $this->text_domain);;
        echo '</option>
                                <option value="0"';
        selected(0, $this->timeout);;
        echo '>';
        _e('For Ever', $this->text_domain);;
        echo '</option>
                            </select>
                        </label>
                    </fieldset></td>
            </tr>
            </tbody>
        </table>
        <h2>';
        _e('Cookie-Free Domain & External Storage', $this->text_domain);;
        echo '</h2>
        <p>';
        _e("A domain that serves no cookies. The idea here is that you use a cookie-free domain to serve images, CSS files, scripts and whatnot, so that your users don't waste time and bandwidth transmitting cookies for them.", $this->text_domain);;
        echo '		<table class="form-table">
            <tbody>
            <tr valign="top">
                <th scope="row"><label for="enabled_cookie_free_domain">';
        _e('Enabled', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Enabled', $this->text_domain);;
        echo '" data-content="';
        _e('Use Cookie-Free Domains to display images.', $this->text_domain);;
        echo '"></span></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Enabled', $this->text_domain);;
        echo '</span></legend>
                        <label>
                            <input name="qqworld-auto-save-images-optimize[enabled]" type="checkbox" id="enabled_cookie_free_domain" value="yes" ';
        checked('yes', $this->optimize_enabled);;
        echo ' />
                        </label>
                    </fieldset></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="optimize-mode">';
        _e('Mode', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Mode', $this->text_domain);;
        echo '" data-content="';
        _e("If you don't want using local media library, please select Use-FTP-Remote-Server.", $this->text_domain);;
        echo '"></span></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Mode', $this->text_domain);;
        echo '</span></legend>
                        <select name="qqworld-auto-save-images-optimize[mode]" id="optimize-mode">
                            ';
        $modes = array(
            'local' => __('Use local server', $this->text_domain)
        );
        $modes = apply_filters('qqworld-auto-save-images-media-library-mode', $modes);
        foreach ($modes as $value => $title) echo '<option value="' . $value . '"' . selected($value, $this->optimize_mode, false) . '>' . $title . '</option>';;
        echo '							</select>
                    </fieldset></td>
            </tr>
            </tbody>
        </table>
        <div class="optimize-table"';
        if ($this->optimize_mode != 'local') echo ' style="display: none;"';;
        echo '>
        <table class="form-table">
            <tbody>
            <tr valign="top" id="url-settings">
                <th scope="row"><label for="host">';
        _e('Domain & Folder', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Domain & Folder', $this->text_domain);;
        echo '" data-content="';
        _e("Set new url structure, Do not end with '/'. The folder string must front with '/'.", $this->text_domain);;
        echo '"></span></th>
                <td><fieldset>
                        <legend class="screen-reader-text"><span>';
        _e('Domain & Folder', $this->text_domain);;
        echo '</span></legend>
                        <label>
                            <span>http(s)://</span> <input type="text" name="qqworld-auto-save-images-optimize-url[host]" class="regular-text" placeholder="';
        _e('Host', $this->text_domain);;
        echo '" id="host" value="';
        echo $this->optimize_host;;
        echo '" /> <span>/wp-contents/uploads/2014/11/example.jpg</span>
                        </label>
                        ';
        if (!empty($this->optimize_host)) : ;
            echo '								<p><strong>';
            _e('You need add this code below into wp-config.php:', $this->text_domain);;
            echo '</strong></p>
                        <p>define( \'WP_CONTENT_URL\', "http://';
            echo $this->optimize_host;;
            echo '/wp-content" );<br />
                            define( \'COOKIE_DOMAIN\', \'';
            $url = parse_url(site_url());
            echo $url['host'];;
            echo '\' );
                        </p>';endif;;
        echo '						</fieldset></td>
            </tr>
            <tbody>
        </table>
</div>
';
        do_action('qqworld-auto-save-images-media-library-form', $this->optimize_mode);;
        echo '		<h2>';
        _e('Proxy Settings', $this->text_domain);;
        echo '</h2>
<p>';
        _e("I hope you have fast proxy server.", $this->text_domain);;
        echo '		<table class="form-table">
    <tbody>
    <tr valign="top">
        <th scope="row"><label for="enabled_proxy">';
        _e('Enabled', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Enabled', $this->text_domain);;
        echo '" data-content="';
        _e('Use proxy server to download images.', $this->text_domain);;
        echo '"></span></th>
        <td><fieldset>
                <legend class="screen-reader-text"><span>';
        _e('Enabled', $this->text_domain);;
        echo '</span></legend>
                <label>
                    <input name="qqworld-auto-save-images-proxy[enabled]" type="checkbox" id="enabled_proxy" value="yes" ';
        checked('yes', $this->proxy_enabled);;
        echo ' />
                </label>
            </fieldset></td>
    </tr>
    <tr valign="top">
        <th scope="row"><label for="proxy_timeout">';
        _e('Timeout', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Timeout', $this->text_domain);;
        echo '" data-content="';
        _e("Set timeout period on proxy.", $this->text_domain);;
        echo '"></span></th>
        <td><fieldset>
                <legend class="screen-reader-text"><span>';
        _e('Timeout', $this->text_domain);;
        echo '</span></legend>
                <label for="proxy_timeout">
                    <input name="qqworld-auto-save-images-proxy[timeout]" type="text" class="small-text" id="proxy_timeout" value="';
        echo $this->proxy_timeout;;
        echo '" /> ';
        _e("Second(s)", $this->text_domain);;
        echo '							</label>
            </fieldset></td>
    </tr>
    <tr valign="top">
        <th scope="row"><label for="proxy_address">';
        _e('Proxy Address', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Proxy Address', $this->text_domain);;
        echo '" data-content="';
        _e("For example: 127.0.0.1:8087", $this->text_domain);;
        echo '"></span></th>
        <td><fieldset>
                <legend class="screen-reader-text"><span>';
        _e('Proxy Address', $this->text_domain);;
        echo '</span></legend>
                <label for="proxy_address">
                    <input name="qqworld-auto-save-images-proxy[address]" type="text" id="proxy_address" value="';
        echo $this->proxy_address;;
        echo '" />
                </label>
            </fieldset></td>
    </tr>
    </tbody>
</table>
<h2>';
        _e('Images Compression Options', $this->text_domain);;
        echo '</h2>
<table class="form-table">
    <tbody>
    <tr valign="top">
        <th scope="row"><label for="enabled_compression">';
        _e('Enabled', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Enabled', $this->text_domain);;
        echo '" data-content="';
        _e('Enable compress images when uploading. (Only JPEG)', $this->text_domain);;
        echo '"></span></th>
        <td><fieldset>
                <legend class="screen-reader-text"><span>';
        _e('Enabled', $this->text_domain);;
        echo '</span></legend>
                <label>
                    <input name="qqworld-auto-save-images-compression[enabled]" type="checkbox" id="enabled_compression" value="yes" ';
        checked('yes', $this->compression_enabled);;
        echo ' />
                </label>
            </fieldset></td>
    </tr>
    <tr valign="top">
        <th scope="row"><label for="compression-quality">';
        _e('Quality', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Quality', $this->text_domain);;
        echo '" data-content="';
        _e('Compression level, ranges from 0 (worst quality, smaller file) to 100 (best quality, biggest file).', $this->text_domain);;
        echo '"></span></th>
        <td><fieldset>
                <legend class="screen-reader-text"><span>';
        _e('Quality', $this->text_domain);;
        echo '</span></legend>
                <select id="compression-quality" name="qqworld-auto-save-images-compression[quality]">
                    ';
        for ($q = 100; $q >= 0; $q -= 5) : ;
            echo '								<option value="';
            echo $q;;
            echo '"';
            selected($q, $this->compression_level);;
            echo '>';
            echo $q;;
            echo '';
            if ($q == 75) _e(' (Recommend)', $this->text_domain);;
            echo '</option>
                    ';endfor;;
        echo '							</select>
            </fieldset></td>
    </tr>
    <tr valign="top">
        <th scope="row"><label for="scan-all-attachments">';
        _e('Scan All Attachments', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Scan All Attachments', $this->text_domain);;
        echo '" data-content="';
        _e('Scan all attachments and automatically compression.', $this->text_domain);;
        echo '"></span></th>
        <td><fieldset>
                <legend class="screen-reader-text"><span>';
        _e('Scan All Attachments', $this->text_domain);;
        echo '</span></legend>
                <input type="button" class="button" id="scan-all-attachments" value="';
        _e('Scan', $this->text_domain);;
        echo ' &#8667;" />
            </fieldset></td>
    </tr>
    </tbody>
</table>
<h2>';
        _e('Smart Options', $this->text_domain);;
        echo '</h2>
<table class="form-table">
    <tbody>
    <tr valign="top">
        <th scope="row"><label for="enabled_smart_grabbing">';
        _e('Smart Grabbing', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _e('Smart Grabbing', $this->text_domain);;
        echo '" data-content="';
        _e('Automatically detect 2 images url from href/src of remote image with outside link, and grab the bigger one.', $this->text_domain);;
        echo '"></span></th>
        <td><fieldset>
                <legend class="screen-reader-text"><span>';
        _e('Smart Grabbing', $this->text_domain);;
        echo '</span></legend>
                <label>
                    <input name="qqworld-auto-save-images-smart[enabled_smart_grabbing]" type="checkbox" id="enabled_smart_grabbing" value="yes" ';
        checked('yes', $this->enabled_smart_grabbing);;
        echo ' />
                </label>
            </fieldset></td>
    </tr>
    </tbody>
</table>
';
        submit_button();;
        echo '	</form>
</div>
';
    }

    function database_page()
    {
        ;
        echo '<div class="wrap">
    <form id="database-form" action="" method="posst">
        <div class="tab-content">
            ';
        global $wpdb;;
        echo '			<h2>';
        _e('Content Replacement', $this->text_domain);;
        echo '</h2>
            <p>';
        _e("Help you to handle database content easily.", $this->text_domain);;
        echo '			<table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row"><label for="db-tables">';
        _ex('Table', 'database', $this->text_domain);;
        echo '</label></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _ex('Table', 'database', $this->text_domain);;
        echo '</span></legend>
                            <label>
                                <select name="db-table" id="db-tables">
                                    <option value="';
        echo $wpdb->posts;;
        echo '">';
        _e('Posts');;
        echo ' (';
        echo $wpdb->posts;;
        echo ')</option>
                                    <option value="';
        echo $wpdb->comments;;
        echo '" disabled="disabled">';
        _e('Comments');;
        echo ' (';
        echo $wpdb->comments;;
        echo ')</option>
                                </select>
                            </label>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="db-table-fields">';
        _ex('Field', 'database', $this->text_domain);;
        echo '</label></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _ex('Field', 'database', $this->text_domain);;
        echo '</span></legend>
                            <label>
                                <select name="db-table-field" id="db-table-fields">
                                    <option value="post_content">';
        _ex('Post Content', 'database', $this->text_domain);;
        echo ' (post_content)</option>
                                    <option value="post_title">';
        _ex('Post Title', 'database', $this->text_domain);;
        echo ' (post_title)</option>
                                    <option value="post_excerpt">';
        _ex('Post Excerpt', 'database', $this->text_domain);;
        echo ' (post_excerpt)</option>
                                </select>
                            </label>
                        </fieldset></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="db-table-field-source">';
        _ex('Source Text', 'database', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _ex('Source Text', 'database', $this->text_domain);;
        echo '" data-content="';
        _e('For example: ', $this->text_domain);;
        echo '';
        echo site_url('/wp-contents/uploads');;
        echo '"></span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _ex('Source Text', 'database', $this->text_domain);;
        echo '</span></legend>
                            <label for="offset-x">
                                <textarea name="db-table-field-source" placeholder="';
        _ex('Source Text', 'database', $this->text_domain);;
        echo '" rows="5" cols="100" class="large-text code" id="db-table-field-source"></textarea>
                            </label>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="db-table-field-replacement">';
        _ex('Replacement Text', 'database', $this->text_domain);;
        echo '</label> <span class="icon help" data-header="';
        _ex('Replacement Text', 'database', $this->text_domain);;
        echo '" data-content="';
        _e('For example: ', $this->text_domain);;
        echo 'http://www.example.com/uploads"</span></th>
                    <td><fieldset>
                            <legend class="screen-reader-text"><span>';
        _ex('Replacement Text', 'database', $this->text_domain);;
        echo '</span></legend>
                            <label for="offset-x">
                                <textarea name="db-table-field-replacement" placeholder="';
        _ex('Replacement Text', 'database', $this->text_domain);;
        echo '" rows="5" cols="100" class="large-text code" id="db-table-field-replacement"></textarea>
                            </label>
                        </fieldset>
                    </td>
                </tr>
                </tbody>
            </table>
            <p class="submit">';
        submit_button(__('Replace Now', $this->text_domain), 'primary', 'database-replace-now', false);;
        echo ' <span class="icon help" data-header="';
        _e('Content Replacement', $this->text_domain);;
        echo '" data-content="';
        _e('Be careful, before you click the Replace-Now button, i recommend backup the website database.', $this->text_domain);;
        echo '"></span></p>
        </div>
    </form>
</div>
';
    }

    public function register_settings()
    {
        $prefix = 'qqworld-auto-save-images-';
        $settings_fields = array(
            'settings' => array(
                'mode',
                'when',
                'remote-publishing',
                'schedule-publish',
                'set-featured-image',
                'no-media-library',
                'auto-change-name',
                'filename-source',
                'only-save-first',
                'minimum-picture-size',
                'maximum-picture-size',
                'exclude-domain',
                'format'
            ),
            'optimization' => array(
                'optimize',
                'proxy',
                'compression',
                'smart'
            ),
            'watermark' => array(
                'watermark-enabled',
                'watermark-enabled-for',
                'watermark-ignore-animated-gif',
                'watermark-random-position',
                'watermark-filter-size',
                'watermark-filter-url',
                'watermark-align-to',
                'watermark-offset',
                'watermark-opacity',
                'watermark-image'
            ),
            'cron' => array(
                'cron-scan-posts'
            )
        );
        foreach ($settings_fields as $field => $settings)
            foreach ($settings as $setting)
                register_setting("{$prefix}{$field}", $prefix . $setting);
        register_setting('qqworld-auto-save-images-settings', 'qqworld-auto-save-images-exclude-crc', array($this, 'check_strtoupper'));
        register_setting('qqworld-auto-save-images-settings', 'qqworld-auto-save-images-delete-crc', array($this, 'check_strtoupper'));
        $optimization_arrar = array('optimize-url', 'ftp', 'aliyun-oss', 'tencent-cos', 'upyun', 'qiniu');
        foreach ($optimization_arrar as $item) {
            register_setting('qqworld-auto-save-images-optimization', "qqworld-auto-save-images-{$item}", array($this, 'check_optimize_url'));
        }
        register_setting('qqworld-auto-save-images-optimization', 'qqworld-collector-webserver');
        register_setting("qqworld-auto-save-images-update", 'qqworld-org-login');
        register_setting("qqworld-auto-save-images-optimization", 'qqworld-collector-authorization');
    }

    public function check_strtoupper($input)
    {
        if (!empty($input)) foreach ($input as $i => $ipt) {
            $input[$i] = strtoupper($ipt);
        }
        return $input;
    }

    public function check_optimize_url($input)
    {
        if (isset($input['host'])) $input['host'] = preg_replace("/\/*$/", '', $input['host']);
        if (isset($input['folder'])) {
            if (!preg_match('/^\//', $input['folder'], $match)) {
                $input['folder'] = '/' . $input['folder'];
            } else {
                $input['folder'] = preg_replace("/^\/*/", '/', $input['folder']);
            }
            $input['folder'] = preg_replace("/\/*$/", '', $input['folder']);
        }
        return $input;
    }

    public function get_current_post_type()
    {
        global $post, $typenow, $current_screen;
        if (isset($_GET['post']) && $_GET['post']) {
            $post_type = get_post_type($_GET['post']);
            return $post_type;
        }
        if ($post && $post->post_type)
            return $post->post_type;
        elseif ($typenow)
            return $typenow;
        elseif ($current_screen && $current_screen->post_type)
            return $current_screen->post_type;
        elseif (isset($_REQUEST['post_type']))
            return sanitize_key($_REQUEST['post_type']);
        return null;
    }

    function add_actions()
    {
        add_action('save_post', array($this, 'fetch_images'), 10, 3);
    }

    function remove_actions()
    {
        remove_action('save_post', array($this, 'fetch_images'), 10);
    }

    function utf8_urldecode($str)
    {
        $str = preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\\\1;", urldecode($str));
        return html_entity_decode($str, null, 'UTF-8');
    }

    function fetch_images($post_id, $post, $update)
    {
        set_time_limit($this->timeout);
        if (empty($post)) $post = get_post($post_id);
        if (!in_array($post->post_status, $this->when)) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
        if (defined('DOING_AJAX') && DOING_AJAX)
            return;
        $this->current_post_id = $post_id;
        $this->has_remote_image = 0;
        $this->has_missing_image = 0;
        add_filter('redirect_post_location', array($this, 'redirect_post_location'), 10, 2);
        if ($this->mode == 'auto') $this->remove_actions();
        if ($this->remote_publishing) remove_action('xmlrpc_publish_post', array($this, 'fetch_images'));
        if ($this->schedule_publish == 'yes') remove_action('publish_future_post', array($this, 'fetch_images'));
        $post = get_post($post_id);
        $content = $this->content_save_pre($post->post_content, $post_id);
        remove_action('post_updated', 'wp_save_post_revision', 10);
        wp_update_post(array('ID' => $post_id, 'post_content' => addslashes($content)));
        add_action('post_updated', 'wp_save_post_revision', 10, 1);
        if ($this->mode == 'auto') $this->add_actions();
        if ($this->remote_publishing) add_action('xmlrpc_publish_post', array($this, 'fetch_images'));
        if ($this->schedule_publish == 'yes') add_action('publish_future_post', array($this, 'fetch_images'));
    }

    public function get_exclude_domain()
    {
        $exclude_domain = array(get_bloginfo('url'));
        if ($this->optimize_enabled == 'yes') {
            $exclude_domain = apply_filters('qqworld-auto-save-images-exclude-domain-' . $this->optimize_mode, $exclude_domain);
        }
        if (!empty($this->exclude_domain)) $exclude_domain = array_merge($exclude_domain, $this->exclude_domain);
        return $exclude_domain;
    }

    public function is_remote_image($image_url)
    {
        if (empty($image_url)) return false;
        $pos = false;
        $exclude_domain = $this->get_exclude_domain();
        foreach ($exclude_domain as $domain) {
            if ($pos === false) $pos = strpos($image_url, $domain);
        }
        return $pos === false;
    }

    public function check_missing_images($remote_images)
    {
        if (!empty($remote_images)) {
            foreach ($remote_images as $i => $remote_image) {
                $image_url = $remote_image['image_url'];
                if ($this->is_remote_image($image_url)) {
                    $this->has_remote_image = 1;
                    if (!@getimagesize($image_url)) {
                        unset($remote_images[$i]);
                        $this->has_missing_image = 1;
                        return;
                    }
                } else {
                    unset($remote_images[$i]);
                }
            }
        }
        return $remote_images;
    }

    public function automatic_set_featured_pic_from_media_library($post_id)
    {
        if ($this->featured_image == 'yes' && !has_post_thumbnail($post_id)) {
            $media = get_attached_media('image', $post_id);
            if (!empty($media)) foreach ($media as $attachment_id => $attachment) {
                set_post_thumbnail($post_id, $attachment_id);
                break;
            }
        }
    }

    public function content_save_pre($content, $post_id = null, $action = "save")
    {
        if ($post_id) {
            $post = get_post($post_id);
            if ($post->post_type == 'revision') return;
        }
        if (!empty($post_id)) $this->automatic_set_featured_pic_from_media_library($post_id);
        $content = apply_filters('qqworld-auto-save-images-before-content-save-pre', $content, $post_id);
        $this->temp_content = $content;
        $this->count = 1;
        $this->change_attachment_url_to_permalink($content);
        $remote_images = apply_filters('qqworld-auto-save-images-remote-images', array(), $this->temp_content);
        $preg = preg_match_all('/<img.*?src=\"((?!\").*?)\"/i', $this->temp_content, $matches);
        if ($preg) {
            if (isset($matches[1])) foreach ($matches[1] as $image_url) {
                $remote_images[] = array('target' => 'src', 'image_url' => $image_url);
            }
        }
        $preg = preg_match_all('/<img.*?src=\'((?!\').*?)\'/i', $this->temp_content, $matches);
        if ($preg) {
            if (isset($matches[1])) foreach ($matches[1] as $image_url) {
                $remote_images[] = array('target' => 'src', 'image_url' => $image_url);
            }
        }
        if (isset($_REQUEST['action']) && in_array($_REQUEST['action'], array('save_remote_images_after_scan', 'save_remote_images_list_all_posts'))) {
            $this->check_missing_images($remote_images);
        }
        if ($action == 'get-remote-images-list') {
            foreach ($remote_images as $i => $remote_image) {
                $image_url = $remote_image['image_url'];
                if ($this->only_save_first != 'all' && $this->count++ > $this->only_save_first) unset($remote_images[$i]);
                if (!$this->is_remote_image($image_url)) unset($remote_images[$i]);
                else $remote_images[$i] = $this->get_attributes_from_image_url($remote_images[$i], $content);
            }
            return !empty($remote_images) ? $remote_images : false;
        }
        if (!empty($remote_images)) {
            foreach ($remote_images as $remote_image) {
                $image_url = $remote_image['image_url'];
                if ($this->only_save_first != 'all' && $this->count++ > $this->only_save_first) continue;
                if ($this->is_remote_image($image_url)) {
                    $this->has_remote_image = 1;
                    $args = $this->get_args_from_content_by_image_url($image_url, $content);
                    if ($action == "save" && $res = $this->save_images($image_url, $post_id, $args)) {
                        if (is_array($res) && isset($res['code']) && $res['code'] == self::NEED_IGNORED) continue;
                        if (is_array($res) && isset($res['code']) && $res['code'] == self::NEED_DELETED) $content = $this->deleteImageFromContent($image_url, $content);
                        elseif ($res == self::TOO_SMALL && $this->minimum_picture_size_auto_delete == 'yes') $content = $this->deleteImageFromContent($image_url, $content);
                        elseif ($res != self::TOO_SMALL) $content = $this->format($remote_image, $res, $content);
                    }
                }
            }
        }
        if (!$this->has_missing_image) update_post_meta($post_id, 'qqworld-auto-save-images-posts-scanned', 'yes');
        return apply_filters('qqworld-auto-save-images-content-save-pre', $content, $post_id);
    }

    public function deleteImageFromContent($image_url, $content)
    {
        $pattern_image_url = $this->encode_pattern($image_url);
        $pattern = '/<a[^<]+><img\s[^>]*' . $pattern_image_url . '.*?>?<[^>]+a>/i';
        $preg = preg_match($pattern, $content, $matches);
        if ($preg) {
            $content = preg_replace($pattern, '', $content);
        }
        $pattern = '/<img\s[^>]*' . $pattern_image_url . '.*?>/i';
        $preg = preg_match($pattern, $content, $matches);
        if ($preg) {
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }

    public function get_attributes_from_image_url($remote_image, $content)
    {
        $target = $remote_image['target'];
        $image_url = $remote_image['image_url'];
        $pattern_image_url = $this->encode_pattern($image_url);
        $alt = '';
        $title = '';
        if ($this->change_title_alt == 'yes') {
            if (empty($this->custom_title_alt)) {
                $alt = $this->get_post_title() ? $this->get_post_title() : null;
                $title = $this->get_post_title() ? $this->get_post_title() : null;
            } else {
                $title = $this->custom_title_alt;
                $alt = $title;
            }
        } else {
            switch ($target) {
                case 'href':
                    $pattern = '/<a[^<]+' . $pattern_image_url . '.*?><img.*?>?<[^>]+a>/i';
                    if (preg_match($pattern, $content, $matches)) {
                        $img = $matches[0];
                    }
                    break;
                case 'src':
                    $pattern = '/<img.*?' . $pattern_image_url . '[^>]+>/i';
                    if (preg_match($pattern, $content, $matches)) {
                        $img = $matches[0];
                    }
                    break;
            }
            $pattern = '/<img\s[^>]*alt=[\"|\'](.*?)[\"|\'].*?>/i';
            if (preg_match($pattern, $img, $matches)) $alt = $matches[1];
            $pattern = '/<img\s[^>]*title=[\"|\'](.*?)[\"|\'].*?>/i';
            if (preg_match($pattern, $img, $matches)) $title = $matches[1];
            $remote_image['img'] = $img;
        }
        $remote_image['alt'] = $alt;
        $remote_image['title'] = $title;
        return $remote_image;
    }

    public function change_attachment_url_to_permalink(&$content)
    {
        $pattern = '/<a\s[^>]*href=\"' . $this->encode_pattern(home_url('?attachment_id=')) . '(.*?)\".*?>/i';
        if (preg_match_all($pattern, $content, $matches)) {
            foreach ($matches[1] as $attachment_id) {
                $attachment = get_post($attachment_id);
                $post = get_post($attachment->post_parent);
                if ($post->post_status != 'draft' && $post->post_status != 'pending') {
                    $url = get_permalink($attachment_id);
                    $content = preg_replace('/' . $this->encode_pattern(home_url('?attachment_id=' . $attachment_id)) . '/i', $url, $content);
                }
            }
        }
    }

    public function encode_pattern($str)
    {
        $str = str_replace('(', '\(', $str);
        $str = str_replace(')', '\)', $str);
        $str = str_replace('{', '\{', $str);
        $str = str_replace('}', '\}', $str);
        $str = str_replace('+', '\+', $str);
        $str = str_replace('.', '\.', $str);
        $str = str_replace('?', '\?', $str);
        $str = str_replace('*', '\*', $str);
        $str = str_replace('/', '\/', $str);
        $str = str_replace('^', '\^', $str);
        $str = str_replace('$', '\$', $str);
        $str = str_replace('|', '\|', $str);
        $str = str_replace('%', '\%', $str);
        return $str;
    }

    public function get_attributes_by_remote_url($remote_image, $content)
    {
        $image_url = $remote_image['image_url'];
        $pattern_image_url = $this->encode_pattern($image_url);
        $pattern = '/<img [^>]*' . $pattern_image_url . '.*?>/i';
        $this->attributes = array(
            'width' => '',
            'height' => '',
            'class' => ''
        );
        if (preg_match($pattern, $content, $matches)) {
            $image = $matches[0];
            $pattern = '/<img\s[^>]*width=[\"|\'](.*?)[\"|\'].*?>/i';
            if (preg_match($pattern, $image, $matches)) $this->attributes['width'] = $matches[1];
            $pattern = '/<img\s[^>]*height=[\"|\'](.*?)[\"|\'].*?>/i';
            if (preg_match($pattern, $image, $matches)) $this->attributes['height'] = $matches[1];
            $pattern = '/<img\s[^>]*class=[\"|\'](.*?)[\"|\'].*?>/i';
            if (preg_match($pattern, $image, $matches)) $this->attributes['class'] = $matches[1];
        }
    }

    public function format($remote_image, $res, $content)
    {
        $this->get_attributes_by_remote_url($remote_image, $content);
        $image_url = $remote_image['image_url'];
        $target = $remote_image['target'];
        $no_match = false;
        $pattern_image_url = $this->encode_pattern($image_url);
        if ($this->optimize_enabled == 'yes' && $this->optimize_mode == 'ftp') {
            $pattern = '/' . $pattern_image_url . '/i';
            $replace = $res['url'];
        } else {
            if (isset($res['id'])) $attachment_id = $res['id'];
            $url_path = str_replace(basename($res['file']), '', $res['url']);
            $size = isset($res['sizes'][$this->format['size']]) ? $this->format['size'] : 'full';
            if (!isset($res['id'])) $size = 'full';
            if ($size == 'full') {
                $src = $res['url'];
                $width = $res['width'];
                $height = $res['height'];
            } else {
                $src = $url_path . $res['sizes'][$size]['file'];
                $width = $res['sizes'][$size]['width'];
                $height = $res['sizes'][$size]['height'];
            }
            if ($this->change_width_height == 'no') {
                $width = $this->attributes['width'];
                $height = $this->attributes['height'];
            }
            $preg = false;
            if ($this->keep_outside_links == 'no') {
                switch ($target) {
                    case 'href':
                        $pattern = '/<a[^<]+href=\"' . $pattern_image_url . '\".*?><img\s[^>]*.*?>?<[^>]+a>/i';
                        break;
                    case 'src':
                        $pattern = '/<a[^<]+><img\s[^>]*' . $pattern_image_url . '.*?>?<[^>]+a>/i';
                        break;
                }
                $preg = preg_match($pattern, $content, $matches);
                if (isset($res['id']) && $preg) {
                    if ($this->save_outside_links == 'yes') {
                        if (preg_match('/<a[^>]*href=\"(.*?)\".*?>/i', $matches[0], $match)) {
                            $link = $match[1];
                            $description = '<a href="' . $link . '" target="_blank" rel="nofollow">' . __('Original Link', $this->text_domain) . '</a>';
                            $description = apply_filters('qqworld-auto-save-images-save-outsite-link', $description, $link);
                            $args = array(
                                'ID' => $attachment_id,
                                'post_content' => $description
                            );
                            wp_update_post($args);
                        }
                    }
                    $args = $this->set_img_metadata($matches[0], $attachment_id);
                }
            }
            if (!$preg) {
                $pattern = '/<img\s[^>]*' . $pattern_image_url . '.*?>/i';
                if (preg_match($pattern, $content, $matches)) {
                    if (isset($res['id'])) $args = $this->set_img_metadata($matches[0], $attachment_id);
                } else {
                    $pattern = '/' . $pattern_image_url . '/i';
                    $no_match = true;
                }
            }
            $alt = isset($args['alt']) ? ' alt="' . $args['alt'] . '"' : '';
            $title = isset($args['title']) ? ' title="' . $args['title'] . '"' : '';
            $align = $this->format_align_to_enabled == 'no' && preg_match('/align(none|left|center|right|justify)/i', $this->attributes['class'], $matches) ? $matches[0] : 'align' . $this->format_align_to;
            $align = $this->auto_caption == 'yes' ? '' : $align . ' ';
            $width = $width ? ' width="' . $width . '"' : '';
            $height = $height ? ' height="' . $height . '"' : '';
            $img = '<img class="' . $align . 'size-' . $size . ' wp-image-' . $attachment_id . '" src="' . $src . '"' . $width . $height . $alt . $title . ' />';
            $link_to = $this->keep_outside_links == 'no' ? $this->format['link-to'] : 'none';
            if (!isset($res['id'])) $link_to = 'none';
            switch ($link_to) {
                case 'none':
                    $replace = $img;
                    break;
                case 'file':
                    $replace = '<a href="' . $res['url'] . '">' . $img . '</a>';
                    break;
                case 'post':
                    $replace = '<a href="' . get_permalink($attachment_id) . '">' . $img . '</a>';
                    break;
            }
            if ($no_match) $replace = $res['url'];
            else if ($this->auto_caption == 'yes') $replace = '[caption id="attachment_' . $attachment_id . '" align="align' . $this->format_align_to . '" width="' . $width . '"]' . $replace . ' ' . (isset($args['alt']) ? $args['alt'] : '') . '[/caption]';
            if (isset($res['id'])) $replace .= str_replace('[Attachment ID]', $res['id'], $this->additional_content['after']);
            if ($this->keep_outside_links == 'yes') {
                $patt = '/<a[^<]+><img\s[^>]*' . $pattern_image_url . '.*?>?<[^>]+a>/i';
                if (preg_match($patt, $content, $match)) {
                    $string = $match[0];
                    $pos = strpos($string, '>');
                    $string = substr_replace($string, ' rel="nofollow">', $pos, 1);
                    $content = preg_replace($patt, $string, $content);
                }
            }
        }
        $content = preg_replace($pattern, $replace, $content);
        return $content;
    }

    public function get_args_from_content_by_image_url($image_url, $content)
    {
        $pattern_image_url = $this->encode_pattern($image_url);
        $pattern = '/<img\s[^>]*' . $pattern_image_url . '.*?>/i';
        $args = array();
        if (preg_match($pattern, $content, $matches)) {
            $pattern = '/<img\s[^>]*alt=[\"|\'](.*?)[\"|\'].*?>/i';
            if (preg_match($pattern, $matches[0], $alt)) $args['alt'] = $alt[1];
            else $args['alt'] = '';
            $pattern = '/<img\s[^>]*title=[\"|\'](.*?)[\"|\'].*?>/i';
            if (preg_match($pattern, $matches[0], $title)) $args['title'] = $title[1];
            else $args['title'] = '';
        }
        if (empty($args['title'])) {
            $pattern = '/<a[^<]+><img\s[^>]*' . $pattern_image_url . '.*?>?<[^>]+a>/i';
            if (preg_match($pattern, $content, $matches)) {
                $pattern = '/<a\s[^>]*title=[\"|\'](.*?)[\"|\'].*?><img\s[^>]*?>?<[^>]+a>/i';
                if (preg_match($pattern, $matches[0], $title)) $args['title'] = $title[1];
                else $args['title'] = '';
            }
        }
        return $args;
    }

    public function set_img_metadata($img, $attachment_id)
    {
        if ($this->change_title_alt == 'yes') {
            if (empty($this->custom_title_alt)) {
                $alt = $this->get_post_title() ? $this->get_post_title() : null;
                $title = $this->get_post_title() ? $this->get_post_title() : null;
            } else {
                $title = $this->custom_title_alt;
                $alt = $title;
            }
        } else {
            $pattern = '/<img\s[^>]*alt=\"(.*?)\".*?>/i';
            if (preg_match($pattern, $img, $matches)) $alt = $matches[1];
            else {
                $pattern = '/<img\s[^>]*alt=\'(.*?)\'.*?>/i';
                $alt = preg_match($pattern, $img, $matches) ? $matches[1] : null;
            }
            $pattern = '/<img\s[^>]*title=\"(.*?)\".*?>/i';
            if (preg_match($pattern, $img, $matches)) $title = $matches[1];
            else {
                $pattern = '/<img\s[^>]*alt=\'(.*?)\'.*?>/i';
                $title = preg_match($pattern, $img, $matches) ? $matches[1] : null;
            }
        }
        if ($alt) update_post_meta($attachment_id, '_wp_attachment_image_alt', $alt);
        if ($title) {
            $attachment = array(
                'ID' => $attachment_id,
                'post_title' => $title
            );
            wp_update_post($attachment);
        }
        return array(
            'alt' => $alt,
            'title' => $title
        );
    }

    public function get_post_title()
    {
        $post = get_post($this->current_post_id);
        return isset($post->post_title) ? $post->post_title : '';
    }

    public function get_post_name()
    {
        return sanitize_title_with_dashes($this->get_post_title());
    }

    public function custom_filename_structure($filename)
    {
        $blogtime = current_time('mysql');
        list($today_year, $today_month, $today_day, $hour, $minute, $second) = preg_split('([^0-9])', $blogtime);
        $date = $today_year . $today_month . $today_day;
        $year = $today_year;
        $month = $today_month;
        $day = $today_day;
        $time = $hour . $minute . $second;
        $timestamp = current_time('timestamp');
        $filename_structure = str_replace('%filename%', $filename, $this->filename_structure);
        $filename_structure = str_replace('%date%', $date, $filename_structure);
        $filename_structure = str_replace('%year%', $year, $filename_structure);
        $filename_structure = str_replace('%month%', $month, $filename_structure);
        $filename_structure = str_replace('%day%', $day, $filename_structure);
        $filename_structure = str_replace('%time%', $time, $filename_structure);
        $filename = str_replace('%timestamp%', $timestamp, $filename_structure);
        return $filename;
    }

    public function change_images_filename($name, $extension, $args = array('alt' => '', 'title' => ''))
    {
        switch ($this->change_image_name) {
            case 'none':
                break;
            case 'ascii':
                if (!preg_match('/^[\x20-\x7f]*$/', $name, $match)) $name = md5($name);
                break;
            case 'all':
                global $post;
                $postname = urldecode($this->get_post_name());
                $alt = isset($args['alt']) && !empty($args['alt']) ? $args['alt'] : '';
                $title = isset($args['title']) && !empty($args['title']) ? $args['title'] : '';
                foreach ($this->filename_source as $source) {
                    if (!empty($$source)) {
                        $name = $$source;
                        break;
                    }
                }
                $name = apply_filters('qqworld-auto-save-images-string-compatible', $name);
                break;
        }
        return apply_filters('qqworld-auto-save-images-custom-filename-structure', $name) . $extension;
    }

    public function get_filename_from_url($url)
    {
        $url = parse_url($url);
        $path = $url['path'];
        $filename = explode('/', $path);
        return urldecode($filename[count($filename) - 1]);
    }

    public function automatic_reduction($file, $image_url)
    {
        $filetype = $this->getFileType($file);
        if ((!empty($this->maximum_picture_size['width']) || !empty($this->maximum_picture_size['height'])) && ($this->width > $this->maximum_picture_size['width'] || $this->height > $this->maximum_picture_size['height'])) {
            if ($this->width > $this->height) {
                $maximum_picture_size_width = empty($this->maximum_picture_size['width']) ? $this->width * $this->maximum_picture_size['height'] / $this->height : $this->maximum_picture_size['width'];
                $new_width = intval($maximum_picture_size_width);
                $new_height = intval($this->height * $maximum_picture_size_width / $this->width);
            } else {
                $maximum_picture_size_height = empty($this->maximum_picture_size['height']) ? $this->height * $this->maximum_picture_size['width'] / $this->width : $this->maximum_picture_size['height'];
                $new_width = intval($this->width * $maximum_picture_size_height / $this->height);
                $new_height = intval($maximum_picture_size_height);
            }
            $layer = ImageWorkshop::initFromString($file);
            if ($filetype == 'gif' && GifFrameExtractor\GifFrameExtractor::isAnimatedGif($this->temp)) {
                $gfe = new GifFrameExtractor\GifFrameExtractor();
                $frames = $gfe->extract($this->temp, true);
                $retouchedFrames = array();
                foreach ($frames as $frame) {
                    $frameLayer = ImageWorkshop::initFromResourceVar($frame['image']);
                    $frameLayer->resizeInPixel($new_width, $new_height);
                    $retouchedFrames[] = $frameLayer->getResult();
                }
                $gc = new GifCreator\GifCreator();
                $gc->create($retouchedFrames, $gfe->getFrameDurations(), 0);
                $file = $gc->getGif();
            } else {
                $layer->resizeInPixel($new_width, $new_height, true);
                ob_start();
                switch ($filetype) {
                    case 'jpg':
                    case 'jpeg':
                        ImageJpeg($layer->getResult(), null, 75);
                        break;
                    case 'png':
                        imagealphablending($layer->getResult(), false);
                        imagesavealpha($layer->getResult(), true);
                        ImagePng($layer->getResult());
                        break;
                    case 'gif':
                        ImageGif($layer->getResult(), null, 75);
                        break;
                }
                $file = ob_get_contents();
                ob_end_clean();
            }
            imagedestroy($layer->getResult());
            $this->width = $new_width;
            $this->height = $new_height;
        }
        return $file;
    }

    function fsockopen_image_header($image_url, $mode = 'Content-Type')
    {
        $url = parse_url($image_url);
        $fp = fsockopen($url['host'], 80, $errno, $errstr, 30);
        if ($fp) {
            $out = "HEAD {$url['path']} HTTP/1.1\r\n";
            $out .= "Host: {$url['host']}\r\n";
            $out .= "Connection: Close\r\n\r\n";
            fwrite($fp, $out);
            while (!feof($fp)) {
                $header = fgets($fp);
                if (stripos($header, $mode) !== false) {
                    $value = trim(substr($header, strpos($header, ':') + 1));
                    return $value;
                }
            }
            fclose($fp);
        }
        return null;
    }

    public function get_header($image_url, $key = null)
    {
        $headers = @get_headers($image_url);
        $results = array();
        if (!empty($headers)) foreach ($headers as $header) {
            $header = explode(':', $header);
            if (isset($header[1])) $results[$header[0]] = trim($header[1]);
        }
        if ($key) {
            if (empty($headers)) return $this->fsockopen_image_header($image_url, $key);
            return isset($results[$key]) ? $results[$key] : null;
        }
        return $results;
    }

    public function get_image_size($image_url, $encoding = null)
    {
        $encoding = $encoding ? $encoding : $this->get_header($image_url, 'Content-Encoding');
        $params = @getimagesize($image_url);
        if (!empty($params)) {
            $this->width = $params[0];
            $this->height = $params[1];
            $this->type = $params['mime'];
        } else if ($this->proxy_enabled == "yes") {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $image_url);
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->proxy_timeout);
            curl_setopt($ch, CURLOPT_PROXY, $this->proxy_address);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $file = curl_exec($ch);
            if ($encoding == 'gzip' && function_exists('gzdecode')) $file = gzdecode($file);
            curl_close($ch);
            if (function_exists("getimagesizefromstring")) {
                $params = getimagesizefromstring($file);
                $this->width = $params[0];
                $this->height = $params[1];
                $this->type = $params['mime'];
            }
        } else {
            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false
                )
            );
            $file = @file_get_contents($image_url, null, stream_context_create($arrContextOptions));
            if ($file) {
                if ($encoding == 'gzip' && function_exists('gzdecode')) $file = gzdecode($file);
                if (function_exists("getimagesizefromstring")) {
                    $params = getimagesizefromstring($file);
                    $this->width = $params[0];
                    $this->height = $params[1];
                    $this->type = $params['mime'];
                }
                if (empty($this->type)) $this->type = $this->get_header($image_url, 'Content-Type');
            }
        }
    }

    public function download_image($image_url)
    {
        if (self::DEBUG) error_log('$image_url is ' . $image_url . "\n", 3, 'f:/debug.txt');
        $encoding = $this->get_header($image_url, 'Content-Encoding');
        $file = '';
        $this->get_image_size($image_url, $encoding);
        if ((!empty($this->width) && $this->width < $this->minimum_picture_size['width']) || (!empty($this->height) && $this->height < $this->minimum_picture_size['height'])) {
            return self::TOO_SMALL;
        }
        if (self::DEBUG) error_log('$image_url is ' . $image_url . "\n", 3, 'f:/debug.txt');
        if (function_exists('file_get_contents')) {
            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false
                )
            );
            if ($this->proxy_enabled == "yes") {
                $arrContextOptions['http'] = array(
                    'timout' => $this->proxy_timeout,
                    'proxy' => $this->proxy_address,
                    'request_fulluri' => True
                );
            }
            $context = stream_context_create($arrContextOptions);
            $file = @file_get_contents($image_url, null, $context);
            if ($encoding == 'gzip' && function_exists('gzdecode')) $file = gzdecode($file);
        }
        if (self::DEBUG) error_log('file_get_contents is ' . $file . "\n", 3, 'f:/debug.txt');
        if (!$file && function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $image_url);
            if ($this->proxy_enabled == "yes") {
                curl_setopt($ch, CURLOPT_TIMEOUT, $this->proxy_timeout);
                curl_setopt($ch, CURLOPT_PROXY, $this->proxy_address);
            }
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $file = curl_exec($ch);
            if ($encoding == 'gzip' && function_exists('gzdecode')) $file = gzdecode($file);
            if (self::DEBUG) error_log('curl_init is ' . $file . "\n", 3, 'f:/debug.txt');
        }
        if (in_array($this->type, $this->allowd_image_types)) {
            $img = @imagecreatefromstring($file);
            if (!$img && function_exists('fsockopen')) {
                $type = $this->get_header($image_url, 'Content-Type');
                if ($type && in_array($type, $this->allowed_image_types)) {
                    $type = substr($type, 6);
                    $img = call_user_func("imagecreatefrom{$type}", $image_url);
                    ob_start();
                    call_user_func("image{$type}", $img);
                    $file = ob_get_contents();
                    ob_end_clean();
                    imagedestroy($img);
                    if ($encoding == 'gzip' && function_exists('gzdecode')) $file = gzdecode($file);
                } else $file = '';
                if (self::DEBUG) error_log('fsockopen is' . $file . "\n", 3, 'f:/debug.txt');
            }
        }
        if (!empty($file) && $this->type == 'image/x-ms-bmp') {
            $this->temp = tempnam(sys_get_temp_dir(), 'QQWorld');
            $temp = fopen($this->temp, "w");
            fwrite($temp, $file);
            $img = imagecreatefrombmp($this->temp);
            if ($img) {
                ob_start();
                ImageJpeg($img, null);
                $file = ob_get_contents();
                ob_end_clean();
                $this->type = 'image/jpeg';
                fclose($temp);
                imagedestroy($img);
            } else $file = '';
            unlink($this->temp);
        }
        if (!empty($file) && $this->type == 'image/webp' && function_exists('imagecreatefromwebp')) {
            $img = imagecreatefromwebp($image_url);
            if ($img) {
                ob_start();
                ImageJpeg($img, null);
                $file = ob_get_contents();
                ob_end_clean();
                list($this->width, $this->height) = getimagesizefromstring($file);
                $this->type = 'image/jpeg';
                imagedestroy($img);
            } else $file = '';
        }
        return $file;
    }

    public function compress_image($file)
    {
        if ($this->type == 'image/gif' || !in_array($this->type, $this->allowed_image_types)) return $file;
        $img = @imagecreatefromstring($file);
        if ($img) {
            $result = '';
            ob_start();
            switch ($this->type) {
                case 'image/jpeg':
                    ImageJpeg($img, null, $this->compression_level);
                    break;
            }
            $result = ob_get_contents();
            ob_end_clean();
            imagedestroy($img);
            if ($result) $file = $result;
        }
        return $file;
    }

    public function is_downloaded($object, $type)
    {
        $this->is_downloaded = false;
        switch ($type) {
            case 'url':
                $args = array(
                    'post_type' => 'attachment',
                    'meta_key' => 'Original Link',
                    'meta_value' => $object,
                    'post_status' => 'inherit'
                );
                break;
            case 'crc':
                $args = array(
                    'post_type' => 'attachment',
                    'meta_key' => 'CRC of Original Image',
                    'meta_value' => $object,
                    'post_status' => 'inherit'
                );
                break;
        }
        $attachments = get_posts($args);
        if (!empty($attachments)) {
            $this->is_downloaded = true;
            $attachment = $attachments[0];
            $attachment_id = $attachment->ID;
            $src = wp_get_attachment_image_src($attachment_id, 'full');
            $meta_data = wp_get_attachment_metadata($attachment_id);
            $res = array(
                'id' => $attachment_id,
                'url' => $src[0]
            );
            $res = array_merge($res, $meta_data);
            return $res;
        }
        return false;
    }

    public function getCrc32($file)
    {
        $crc = strtoupper(dechex(crc32($file)));
        return $crc;
    }

    public function save_images($image_url, $post_id, $args)
    {
        set_time_limit($this->timeout);
        if ($res = $this->is_downloaded($image_url, 'url')) {
            return $res;
        }
        $remote_image = stripslashes(str_replace(' ', '%20', $image_url));
        if (preg_match('/^\/\//', $image_url, $match)) $image_url = 'http:' . $image_url;
        $file = $this->download_image($remote_image);
        if (!empty($file) && $file != self::TOO_SMALL) {
            $crc = $this->getCrc32($file);
            if (!empty($this->delete_crc) && in_array($crc, $this->delete_crc)) return array('code' => self::NEED_DELETED, 'image_url' => $image_url);
            if (!empty($this->exclude_crc) && in_array($crc, $this->exclude_crc)) return array('code' => self::NEED_IGNORED, 'image_url' => $image_url);
            if ($res = $this->is_downloaded($crc, 'crc')) return $res;
            $filename = $this->get_filename_from_url($image_url);
            preg_match('/(.*?)(\.(jpg|jpeg|png|gif|bmp))$/i', $filename, $match);
            if (empty($match)) {
                if ($filetype = $this->getFileType($file)) {
                    preg_match('/(.*?)$/i', $filename, $match);
                    if (!empty($match[0])) {
                        $pos = strpos($image_url, '?');
                        $img_name = $pos ? md5($match[0]) : $match[0];
                    } else {
                        $img_name = md5($image_url);
                    }
                    $img_name = $this->change_images_filename($img_name, '.' . $filetype, $args);
                } else return false;
            } else {
                $img_name = $match[1];
                $filetype = preg_replace('/^./', '', $match[2]);
                $img_name = $this->change_images_filename($match[1], $match[2], $args);
            }
            $img_name = preg_replace('/\.bmp$/i', '.jpg', $img_name);
            $this->temp = tempnam(sys_get_temp_dir(), 'QQWorld');
            $temp = fopen($this->temp, "w");
            fwrite($temp, $file);
            $file = $this->automatic_reduction($file, $image_url);
            fclose($temp);
            unlink($this->temp);
            if ($this->watermark_enabled == 'yes' && in_array('collection', $this->watermark_enabled_for)) {
                $this->is_added_watermark = false;
                $pos = false;
                if (!empty($this->filter_url)) foreach ($this->filter_url as $url) {
                    if ($pos === false) $pos = strpos($image_url, $url);
                }
                if ($pos === false) {
                    $this->is_animated_gif = $this->isAnimatedGif($file, 'stream');
                    if (!$this->is_animated_gif && $this->width >= $this->filter_size['width'] && $this->height >= $this->filter_size['height']) {
                        $file = $this->add_watermark($file, $this->watermark_path, 'return');
                    }
                }
            }
            $file = apply_filters('qqworld_auto_save_images_file_bits', $file);
            if ($this->optimize_enabled == 'yes' && $this->optimize_mode == 'ftp') {
                $res = apply_filters('qqworld-auto-save-images-saving-' . $this->optimize_mode, $file, $img_name, $this->width, $this->height);
            } else {
                if (function_exists('cud_custom_upload_dir')) {
                    global $cud_file_ext, $cud_file_type;
                    $cud_file_type = $this->type;
                    $cud_file_ext = $filetype;
                    add_filter('upload_dir', 'cud_custom_upload_dir', 1);
                }
                $res = wp_upload_bits($img_name, null, $file);
                if (isset($res['error']) && !empty($res['error'])) return false;
                if ($this->no_media_library == 'yes' && ($this->featured_image != 'yes' || has_post_thumbnail($post_id))) {
                    $res['width'] = $this->width;
                    $res['height'] = $this->height;
                    $res['code'] = self::NO_MEDIA_LIBRARY;
                    if ($this->optimize_enabled == 'yes' && !empty($this->optimize_mode)) $res = apply_filters('qqworld-auto-save-images-no-media-library-res-' . $this->optimize_mode, $res);
                } else {
                    $attachment_id = $this->insert_attachment($res['file'], $post_id);
                    $res['crc'] = $crc;
                    update_post_meta($attachment_id, 'CRC of Original Image', $crc);
                    update_post_meta($attachment_id, 'Original Link', $image_url);
                    if ($this->is_added_watermark) update_post_meta($attachment_id, '_added_watermark', 1);
                    if ($this->compression_enabled == 'yes' || ($this->watermark_enabled == 'yes' && in_array('collection', $this->watermark_enabled_for))) {
                        update_post_meta($attachment_id, '_compressed', '1');
                    }
                    $res['id'] = $attachment_id;
                    $meta_data = wp_get_attachment_metadata($attachment_id);
                    $res = array_merge($res, $meta_data);
                    if ($this->optimize_enabled == 'yes') {
                        $dirs = wp_upload_dir();
                        $url_path = $this->optimize_protocol . '://' . $this->optimize_host . $this->optimize_folder;
                        $url_path = apply_filters('qqworld-auto-save-images-url-path-' . $this->optimize_mode, $url_path, $this->optimize_protocol, $this->optimize_host, $this->optimize_folder);
                        $filename = explode('/', $res['url']);
                        $res['url'] = $url_path . $dirs['subdir'] . '/' . $filename[count($filename) - 1];
                    }
                    if (!has_post_thumbnail($post_id) && $this->featured_image == 'yes') set_post_thumbnail($post_id, $attachment_id);
                }
            }
            return $res;
        } else if ($file == self::TOO_SMALL) {
            return self::TOO_SMALL;
        } else if ($file != self::TOO_SMALL) {
            $this->has_missing_image = 1;
        }
        return false;
    }

    public function getFileType($file, $mode = 'filetype')
    {
        $bin = substr($file, 0, 2);
        $strInfo = @unpack("C2chars", $bin);
        $typeCode = intval($strInfo['chars1'] . $strInfo['chars2']);
        switch ($typeCode) {
            case 7790:
                $fileType = 'exe';
                return false;
            case 7784:
                $fileType = 'midi';
                return false;
            case 8297:
                $fileType = 'rar';
                return false;
            case 255216:
                $fileType = 'jpg';
                $mime = 'image/jpeg';
                return $mode == 'filetype' ? $fileType : $mime;
            case 7173:
                $fileType = 'gif';
                $mime = 'image/gif';
                return $mode == 'filetype' ? $fileType : $mime;
            case 6677:
                $fileType = 'bmp';
                $mime = 'image/bmp';
                return $mode == 'filetype' ? $fileType : $mime;
            case 13780:
                $fileType = 'png';
                $mime = 'image/png';
                return $mode == 'filetype' ? $fileType : $mime;
            default:
                return false;
        }
    }

    function preview_watermark()
    {
        if (isset($_GET['align_to'])) $this->align_to = $_GET['align_to'];
        if (isset($_GET['offset'])) $this->offset = array('x' => $_GET['offset']['x'], 'y' => $_GET['offset']['y']);
        if (isset($_GET['opacity'])) $this->watermark_opacity = $_GET['opacity'];
        if (isset($_GET['random-position'])) $this->watermark_random_position = $_GET['random-position'];
        $this->image_path = QQWORLD_COLLECTOR_DIR . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'photo.jpg';
        $this->add_watermark($this->image_path, $this->watermark_path);
        exit;
    }

    function get_watermark_filepath()
    {
        $this->watermark_path = $this->watermark_image ? get_attached_file($this->watermark_image) : QQWORLD_COLLECTOR_DIR . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'watermark.png';
    }

    public function isAnimatedGif($str, $type = 'filepath')
    {
        if ($type == 'filepath') {
            $fp = fopen($str, 'rb');
            $filecontent = fread($fp, filesize($str));
            fclose($fp);
        } else {
            $filecontent = $str;
        }
        return strpos($filecontent, chr(0x21) . chr(0xff) . chr(0x0b) . 'NETSCAPE2.0') === FALSE ? 0 : 1;
    }

    function add_watermark($image_path, $watermark_path, $type = 'show')
    {
        $this->image_data = $type == 'return' ? array('mime' => $this->getFileType($image_path, 'mime')) : getImageSize($image_path);
        $this->image = $type == 'return' ? imageCreateFromString($image_path) : $this->ImageCreateFromType($image_path, $this->image_data['mime']);
        ImageAlphaBlending($this->image, true);
        $this->watermark_data = getimagesize($watermark_path);
        $this->watermark = $this->ImageCreateFromType($watermark_path, $this->watermark_data['mime']);
        $image_width = ImageSX($this->image);
        $image_height = ImageSY($this->image);
        $watermark_width = ImageSX($this->watermark);
        $watermark_height = ImageSY($this->watermark);
        $full_offset_x = $image_width - $watermark_width;
        $full_offset_y = $image_height - $watermark_height;
        $half_offset_x = ($image_width - $watermark_width) / 2;
        $half_offset_y = ($image_height - $watermark_height) / 2;
        if ($this->watermark_random_position == 'yes') {
            $random_full_offset_x = $full_offset_x - 40;
            $random_full_offset_y = $full_offset_y - 40;
            $x = rand(20, $random_full_offset_x);
            $y = rand(20, $random_full_offset_y);
        } else {
            $offset = $this->offset;
            switch ($this->align_to) {
                case 'lt':
                    $x = $offset['x'];
                    $y = $offset['y'];
                    break;
                case 'ct':
                    $x = $half_offset_x + $offset['x'];
                    $y = $offset['y'];
                    break;
                case 'rt':
                    $x = $offset['x'] + $full_offset_x;
                    $y = $offset['y'];
                    break;
                case 'lc':
                    $x = $offset['x'];
                    $y = $offset['y'] + $half_offset_y;
                    break;
                case 'cc':
                    $x = $offset['x'] + $half_offset_x;
                    $y = $offset['y'] + $half_offset_y;
                    break;
                case 'rc':
                    $x = $offset['x'] + $full_offset_x;
                    $y = $offset['y'] + $half_offset_y;
                    break;
                case 'lb':
                    $x = $offset['x'];
                    $y = $offset['y'] + $full_offset_y;
                    break;
                case 'cb':
                    $x = $offset['x'] + $half_offset_x;
                    $y = $offset['y'] + $full_offset_y;
                    break;
                case 'rb':
                    $x = $offset['x'] + $full_offset_x;
                    $y = $offset['y'] + $full_offset_y;
                    break;
            }
        }
        $temp = imagecreatetruecolor($watermark_width, $watermark_height);
        imagecopy($temp, $this->image, 0, 0, $x, $y, $watermark_width, $watermark_height);
        imagecopy($temp, $this->watermark, 0, 0, 0, 0, $watermark_width, $watermark_height);
        imagecopymerge($this->image, $temp, $x, $y, 0, 0, $watermark_width, $watermark_height, $this->watermark_opacity);
        $this->is_added_watermark = true;
        switch ($type) {
            case 'show':
                $this->show_image();
                break;
            case 'save':
                $this->show_image('string');
                break;
            case 'return':
                return $this->return_image();
                break;
        }
    }

    public function ImageCreateFromType($image_path, $mime)
    {
        switch ($mime) {
            case 'image/png':
                return ImageCreateFromPng($image_path);
            case 'image/jpeg':
                return ImageCreateFromJpeg($image_path);
            case 'image/gif':
                return ImageCreateFromGif($image_path);
        }
    }

    public function return_image()
    {
        ob_start();
        $this->show_image('string');
        $image = ob_get_contents();
        ob_end_clean();
        return $image;
    }

    public function show_image($type = 'image')
    {
        if ($type == 'image') header("Content-type: " . $this->image_data["mime"]);
        switch ($this->image_data["mime"]) {
            case 'image/png':
                $level = ($this->compression_level - 100) / 11.111111;
                $level = round(abs($level));
                imagealphablending($this->image, false);
                imagesavealpha($this->image, true);
                ImagePng($this->image, null, $level, PNG_ALL_FILTERS);
                break;
            case 'image/jpeg':
                ImageJpeg($this->image, null, $this->compression_level);
                break;
            case 'image/gif':
                ImageGif($this->image);
                break;
        }
        ImageDestroy($this->image);
        ImageDestroy($this->watermark);
    }

    public function insert_attachment($file, $parent)
    {
        $dirs = wp_upload_dir();
        $filetype = wp_check_filetype($file);
        $attachment = array(
            'guid' => $dirs['baseurl'] . '/' . _wp_relative_upload_path($file),
            'post_mime_type' => $filetype['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', basename($file)),
            'post_content' => '',
            'post_status' => 'inherit'
        );
        $attach_id = wp_insert_attachment($attachment, $file, $parent);
        if (!function_exists('wp_generate_attachment_metadata')) include_once(ABSPATH . DIRECTORY_SEPARATOR . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'image.php');
        $attach_data = wp_generate_attachment_metadata($attach_id, $file);
        wp_update_attachment_metadata($attach_id, $attach_data);
        return $attach_id;
    }
}

class Walker_Category_Checklist extends \Walker
{
    public $tree_type = 'category';
    public $db_fields = array('parent' => 'parent', 'id' => 'term_id');

    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent<ul class='children'>\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    public function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0)
    {
        if (empty($args['taxonomy'])) {
            $taxonomy = 'category';
        } else {
            $taxonomy = $args['taxonomy'];
        }
        if ($taxonomy == 'category') {
            $name = 'post_category';
        } else {
            $name = 'tax_input[' . $taxonomy . ']';
        }
        $args['popular_cats'] = empty($args['popular_cats']) ? array() : $args['popular_cats'];
        $class = in_array($category->term_id, $args['popular_cats']) ? ' class="popular-category"' : '';
        $args['selected_cats'] = empty($args['selected_cats']) ? array() : $args['selected_cats'];
        $output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" .
            '<label class="selectit"><input value="' . $category->term_id . '" type="checkbox" name="terms[' . $taxonomy . '][]" id="in-' . $taxonomy . '-' . $category->term_id . '"' .
            checked(in_array($category->term_id, $args['selected_cats']), true, false) .
            disabled(empty($args['disabled']), false, false) . ' /> ' .
            esc_html(apply_filters('the_category', $category->name)) . '</label>';
    }

    public function end_el(&$output, $category, $depth = 0, $args = array())
    {
        $output .= "</li>\n";
    }
}

class BMP
{
    public static function imagebmp(&$img, $filename = false)
    {
        $wid = imagesx($img);
        $hei = imagesy($img);
        $wid_pad = str_pad('', $wid % 4, "\0");
        $size = 54 + ($wid + $wid_pad) * $hei * 3;
        $header['identifier'] = 'BM';
        $header['file_size'] = self::dword($size);
        $header['reserved'] = self::dword(0);
        $header['bitmap_data'] = self::dword(54);
        $header['header_size'] = self::dword(40);
        $header['width'] = self::dword($wid);
        $header['height'] = self::dword($hei);
        $header['planes'] = self::word(1);
        $header['bits_per_pixel'] = self::word(24);
        $header['compression'] = self::dword(0);
        $header['data_size'] = self::dword(0);
        $header['h_resolution'] = self::dword(0);
        $header['v_resolution'] = self::dword(0);
        $header['colors'] = self::dword(0);
        $header['important_colors'] = self::dword(0);
        if ($filename) {
            $f = fopen($filename, "wb");
            foreach ($header AS $h) {
                fwrite($f, $h);
            }
            for ($y = $hei - 1; $y >= 0; $y--) {
                for ($x = 0; $x < $wid; $x++) {
                    $rgb = imagecolorat($img, $x, $y);
                    fwrite($f, byte3($rgb));
                }
                fwrite($f, $wid_pad);
            }
            fclose($f);
        } else {
            foreach ($header AS $h) {
                echo $h;
            }
            for ($y = $hei - 1; $y >= 0; $y--) {
                for ($x = 0; $x < $wid; $x++) {
                    $rgb = imagecolorat($img, $x, $y);
                    echo self::byte3($rgb);
                }
                echo $wid_pad;
            }
        }
    }

    public static function imagecreatefrombmp($filename)
    {
        $f = fopen($filename, "rb");
        $header = fread($f, 54);
        $header = unpack('c2identifier/Vfile_size/Vreserved/Vbitmap_data/Vheader_size/' .
            'Vwidth/Vheight/vplanes/vbits_per_pixel/Vcompression/Vdata_size/' .
            'Vh_resolution/Vv_resolution/Vcolors/Vimportant_colors', $header);
        if ($header['identifier1'] != 66 or $header['identifier2'] != 77) {
            die('Not a valid bmp file');
        }
        if (!in_array($header['bits_per_pixel'], array(24, 32, 8, 4, 1))) {
            die('Only 1, 4, 8, 24 and 32 bit BMP images are supported');
        }
        $bps = $header['bits_per_pixel'];
        $wid2 = ceil(($bps / 8 * $header['width']) / 4) * 4;
        $colors = pow(2, $bps);
        $wid = $header['width'];
        $hei = $header['height'];
        $img = imagecreatetruecolor($header['width'], $header['height']);
        if ($bps < 9) {
            for ($i = 0; $i < $colors; $i++) {
                $palette[] = self::undword(fread($f, 4));
            }
        } else {
            if ($bps == 32) {
                imagealphablending($img, false);
                imagesavealpha($img, true);
            }
            $palette = array();
        }
        for ($y = $hei - 1; $y >= 0; $y--) {
            $row = fread($f, $wid2);
            $pixels = self::str_split2($row, $bps, $palette);
            for ($x = 0; $x < $wid; $x++) {
                self::makepixel($img, $x, $y, $pixels[$x], $bps);
            }
        }
        fclose($f);
        return $img;
    }

    private static function str_split2($row, $bps, $palette)
    {
        switch ($bps) {
            case 32:
            case 24:
                return str_split($row, $bps / 8);
            case  8:
                $out = array();
                $count = strlen($row);
                for ($i = 0; $i < $count; $i++) {
                    $out[] = $palette[ord($row[$i])];
                }
                return $out;
            case  4:
                $out = array();
                $count = strlen($row);
                for ($i = 0; $i < $count; $i++) {
                    $roww = ord($row[$i]);
                    $out[] = $palette[($roww & 240) >> 4];
                    $out[] = $palette[($roww & 15)];
                }
                return $out;
            case  1:
                $out = array();
                $count = strlen($row);
                for ($i = 0; $i < $count; $i++) {
                    $roww = ord($row[$i]);
                    $out[] = $palette[($roww & 128) >> 7];
                    $out[] = $palette[($roww & 64) >> 6];
                    $out[] = $palette[($roww & 32) >> 5];
                    $out[] = $palette[($roww & 16) >> 4];
                    $out[] = $palette[($roww & 8) >> 3];
                    $out[] = $palette[($roww & 4) >> 2];
                    $out[] = $palette[($roww & 2) >> 1];
                    $out[] = $palette[($roww & 1)];
                }
                return $out;
        }
    }

    private static function makepixel($img, $x, $y, $str, $bps)
    {
        switch ($bps) {
            case 32 :
                $a = ord($str[0]);
                $b = ord($str[1]);
                $c = ord($str[2]);
                $d = 256 - ord($str[3]);
                $pixel = $d * 256 * 256 * 256 + $c * 256 * 256 + $b * 256 + $a;
                imagesetpixel($img, $x, $y, $pixel);
                break;
            case 24 :
                $a = ord($str[0]);
                $b = ord($str[1]);
                $c = ord($str[2]);
                $pixel = $c * 256 * 256 + $b * 256 + $a;
                imagesetpixel($img, $x, $y, $pixel);
                break;
            case 8 :
            case 4 :
            case 1 :
                imagesetpixel($img, $x, $y, $str);
                break;
        }
    }

    private static function byte3($n)
    {
        return chr($n & 255) . chr(($n >> 8) & 255) . chr(($n >> 16) & 255);
    }

    private static function undword($n)
    {
        $r = unpack("V", $n);
        return $r[1];
    }

    private static function dword($n)
    {
        return pack("V", $n);
    }

    private static function word($n)
    {
        return pack("v", $n);
    }
}

function imagebmp(&$img, $filename = false)
{
    return BMP::imagebmp($img, $filename);
}

function imagecreatefrombmp($filename)
{
    return BMP::imagecreatefrombmp($filename);
}