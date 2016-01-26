<?php
/*
 * This is the config file for the theme.
 */

define("TD_THEME_NAME", "Newspaper");
define("TD_THEME_VERSION", "6.5");
define("TD_THEME_DOC_URL", "http://forum.tagdiv.com/whats-included/");
define("TD_THEME_DEMO_URL", "http://demo.tagdiv.com/" . strtolower(TD_THEME_NAME));
define("TD_THEME_DEMO_DOC_URL", 'http://forum.tagdiv.com/introduction/');  //the url to the demo documentation
define("TD_THEME_VIDEO_TUTORIALS_URL", "https://www.youtube.com/watch?v=8hAwUt8-G34&list=PL6CsDkMaejhrfEuAth6JVYLPmFwFzNFwY");
define("TD_FEATURED_CAT", "Featured"); //featured cat name
define("TD_FEATURED_CAT_SLUG", "featured"); //featured cat slug
define("TD_THEME_OPTIONS_NAME", "td_011"); //where to store our options

define("TD_AURORA_VERSION", "1.0");

define("TD_THEME_WP_BOOSTER", "3.0"); //prevents multiple instances of the framework

//if no deploy mode is selected, we use the final deploy built
if (!defined('TD_DEPLOY_MODE')) {
    define("TD_DEPLOY_MODE", 'deploy');
}






switch (TD_DEPLOY_MODE) {
    default:
        //deploy version - this is the version that we ship!
        define("TD_DEBUG_LIVE_THEME_STYLE", false);
        define("TD_DEBUG_IOS_REDIRECT", false);
        define("TD_DEBUG_USE_LESS", false);
        break;

    case 'dev':
        //dev version
        define("TD_DEBUG_LIVE_THEME_STYLE", true);
        define("TD_DEBUG_IOS_REDIRECT", true);
        define("TD_DEBUG_USE_LESS", true); //use less on dev
        break;

    case 'demo':
        //demo version
        define("TD_DEBUG_LIVE_THEME_STYLE", true);
        define("TD_DEBUG_IOS_REDIRECT", true); // remove themeforest iframe from ios devices on demo only!
        define("TD_DEBUG_USE_LESS", false);
        break;
}



/**
 * speed booster v 3.0 hooks - prepare the framework for the theme
 * is also used by td_deploy - that's why it's a static class
 * Class td_wp_booster_hooks
 */
class td_wp_booster_config {


    /**
     * setup the global theme specific variables
     * @depends td_global
     */
    static function td_global_after() {



        /**
         * js files list
         */
        td_global::$js_files = array(


	        'td_external' =>            '/includes/wp_booster/js_dev/td_external.js',
            'tdDetect' =>              '/includes/wp_booster/js_dev/tdDetect.js',

	        'td_viewport' =>            '/includes/wp_booster/js_dev/td_viewport.js',

            'td_menu' =>                '/includes/wp_booster/js_dev/td_menu.js',
            //'tdLocalCache' =>         '/includes/wp_booster/js_dev/tdLocalCache.js',
            'tdUtil' =>                '/includes/wp_booster/js_dev/tdUtil.js',
            'td_affix' =>               '/includes/wp_booster/js_dev/td_affix.js',
            //'td_scroll_animation' =>  '/includes/wp_booster/js_dev/td_scroll_animation.js',
            'td_site' =>                '/includes/wp_booster/js_dev/td_site.js',

            'tdLoadingBox' =>         '/includes/wp_booster/js_dev/tdLoadingBox.js',
            'td_ajax_search' =>          '/includes/wp_booster/js_dev/td_ajax_search.js',
            'td_post_images' =>         '/includes/wp_booster/js_dev/td_post_images.js',
            'tdBlocks' =>              '/includes/wp_booster/js_dev/tdBlocks.js',
            'td_login' =>               '/includes/wp_booster/js_dev/td_login.js',
            'td_style_customizer' =>    '/includes/wp_booster/js_dev/td_style_customizer.js',
            'td_trending_now' =>        '/includes/wp_booster/js_dev/td_trending_now.js',
            'td_history' =>             '/includes/wp_booster/js_dev/td_history.js',
            'td_smart_sidebar' =>       '/includes/wp_booster/js_dev/td_smart_sidebar.js',
            'tdInfiniteLoader' =>     '/includes/wp_booster/js_dev/tdInfiniteLoader.js',
	        'td_smooth_scroll' =>       '/includes/wp_booster/js_dev/td_smooth_scroll.js',
	        'vimeo_froogaloop' =>       '/includes/wp_booster/js_dev/vimeo_froogaloop.js',

	        'td_custom_events' =>       '/includes/js_files/td_custom_events.js',
	        'td_events' =>              '/includes/wp_booster/js_dev/td_events.js',

	        'td_ajax_count' =>          '/includes/wp_booster/js_dev/td_ajax_count.js',
            'td_video_playlist' =>      '/includes/wp_booster/js_dev/td_video_playlist.js',
	        'td_slide' =>               '/includes/wp_booster/js_dev/td_slide.js',
            'td_pulldown' =>            '/includes/wp_booster/js_dev/td_pulldown.js',

            //'td_main' =>                '/includes/js_files/td_main.js',
            'td_fps' =>                 '/includes/js_files/td_fps.js',
	        'td_animation_scroll' =>    '/includes/wp_booster/js_dev/td_animation_scroll.js',
	        'td_backstr' =>             '/includes/wp_booster/js_dev/td_backstr.js',

            //'td_scroll_effects.js' =>   '/includes/js_files/td_scroll_effects.js',

	        'td_animation_stack' =>     '/includes/wp_booster/js_dev/td_animation_stack.js',
	        'td_main' =>                '/includes/js_files/td_main.js',

            'td_loop_ajax' =>             '/includes/wp_booster/js_dev/tdLoopAjax.js',

            'td_last_init' =>           '/includes/wp_booster/js_dev/td_last_init.js',
        );


	    /**
	     * td_viewport intervals in crescendo order
	     */
	    td_global::$td_viewport_intervals = array(
		    array(
			    "limit_bottom" => 767,
			    "sidebar_width" => 228,
		    ),
		    array(
			    "limit_bottom" => 1018,
			    "sidebar_width" => 300,
		    ),
		    array(
			    "limit_bottom" => 1140,
			    "sidebar_width" => 324,
		    ),
	    );


	    /**
	     * - td animation stack effects used in the 'loading animation image' theme panel section
	     * - the first element is a special case, it representing the default type 'type0' @see animation-stack.less
	     * - the 'val' parameter is the type effect
	     * - the 'specific_selectors' parameter is the css selector used to look for new elements inside of some specific sections [ex. at ajax req]
	     * - the 'general_selectors' parameter is the css selector used to look for elements on extended sections [ex. entire page]
	     * - Important! the 'general_selectors' is not used by the default 'type0'
	     */
	    td_global::$td_animation_stack_effects = array(
		    array(
			    'text' => '淡入 [完整]',
			    'val' => '', // empty, as a default value
			    'specific_selectors' => '.entry-thumb, img',
			    'general_selectors' => '.td-animation-stack img, .post img',
		    ),

            array(
                'text' => '淡入并缩放',
                'val' => 'type1',
                'specific_selectors' => '.entry-thumb, img[class*="wp-image-"], a.td-sml-link-to-image > img',
                'general_selectors' => '.td-animation-stack .entry-thumb, .post .entry-thumb, .post img[class*="wp-image-"], .post a.td-sml-link-to-image > img',
            ),


            array(
                'text' => '向上淡入',
                'val' => 'type2',
                'specific_selectors' => '.entry-thumb, img[class*="wp-image-"], a.td-sml-link-to-image > img',
                'general_selectors' => '.td-animation-stack .entry-thumb, .post .entry-thumb, .post img[class*="wp-image-"], a.td-sml-link-to-image > img',
            ),


        );



        /**
         * single template list
         */
	    td_api_single_template::add('single_template',
		    array(
			    'file' => td_global::$get_template_directory . '/single.php',
			    'text' => 'Single template',
			    'img' => td_global::$get_template_directory_uri . '/images/panel/single_templates/single_template_0.png',
			    'show_featured_image_on_all_pages' => false,
			    'bg_disable_background' => false,          // disable the featured image
			    'bg_box_layout_config' => 'auto',                // auto | td-boxed-layout | td-full-layout
			    'bg_use_featured_image_as_background' => false   // uses the featured image as a background

		    )
	    );

        td_api_single_template::add('single_template_1',
            array(
                'file' => td_global::$get_template_directory . '/single_template_1.php',
                'text' => '单个模板 1',
                'img' => td_global::$get_template_directory_uri . '/images/panel/single_templates/single_template_1.png',
                'show_featured_image_on_all_pages' => false,
                'bg_disable_background' => false,          // disable the featured image
                'bg_box_layout_config' => 'auto',                // auto | td-boxed-layout | td-full-layout
                'bg_use_featured_image_as_background' => false   // uses the featured image as a background

            )
        );

        td_api_single_template::add('single_template_2',
            array(
                'file' => td_global::$get_template_directory . '/single_template_2.php',
                'text' => '单个模板 2',
                'img' => td_global::$get_template_directory_uri . '/images/panel/single_templates/single_template_2.png',
                'show_featured_image_on_all_pages' => false,
                'bg_disable_background' => false,          // disable the featured image
                'bg_box_layout_config' => 'auto',                // auto | td-boxed-layout | td-full-layout
                'bg_use_featured_image_as_background' => false   // uses the featured image as a background
            )
        );

        td_api_single_template::add('single_template_3',
            array(
                'file' => td_global::$get_template_directory . '/single_template_3.php',
                'text' => '单个模板 3',
                'img' => td_global::$get_template_directory_uri . '/images/panel/single_templates/single_template_3.png',
                'show_featured_image_on_all_pages' => true, //shows the featured image on all the pages
                'bg_disable_background' => false,          // disable the featured image
                'bg_box_layout_config' => 'auto',                // auto | td-boxed-layout | td-full-layout
                'bg_use_featured_image_as_background' => false   // uses the featured image as a background
            )
        );

        td_api_single_template::add('single_template_4',
            array(
                'file' => td_global::$get_template_directory . '/single_template_4.php',
                'text' => '单个模板 4',
                'img' => td_global::$get_template_directory_uri . '/images/panel/single_templates/single_template_4.png',
                'show_featured_image_on_all_pages' => true, //shows the featured image on all the pages
                'bg_disable_background' => false,          // disable the featured image
                'bg_box_layout_config' => 'auto',                // auto | td-boxed-layout | td-full-layout
                'bg_use_featured_image_as_background' => false   // uses the featured image as a background
            )
        );

        td_api_single_template::add('single_template_5',
            array(
                'file' => td_global::$get_template_directory . '/single_template_5.php',
                'text' => '单个模板 5',
                'img' => td_global::$get_template_directory_uri . '/images/panel/single_templates/single_template_5.png',
                'show_featured_image_on_all_pages' => false,
                'bg_disable_background' => false,          // disable the featured image
                'bg_box_layout_config' => 'auto',                // auto | td-boxed-layout | td-full-layout
                'bg_use_featured_image_as_background' => false   // uses the featured image as a background
            )
        );

        td_api_single_template::add('single_template_6',
            array(
                'file' => td_global::$get_template_directory . '/single_template_6.php',
                'text' => '单个模板 6',
                'img' => td_global::$get_template_directory_uri . '/images/panel/single_templates/single_template_6.png',
                'show_featured_image_on_all_pages' => true, //shows the featured image on all the pages
                'disable_background' => false,
                'use_featured_image_as_background' => true,
                'bg_disable_background' => false,          // disable the featured image
                'bg_box_layout_config' => 'auto',                // auto | td-boxed-layout | td-full-layout
                'bg_use_featured_image_as_background' => false   // uses the featured image as a background
            )
        );

        td_api_single_template::add('single_template_7',
            array(
                'file' => td_global::$get_template_directory . '/single_template_7.php',
                'text' => '单个模板 7',
                'img' => td_global::$get_template_directory_uri . '/images/panel/single_templates/single_template_7.png',
                'show_featured_image_on_all_pages' => true, //shows the featured image on all the pages
                'bg_disable_background' => false,          // disable the featured image
                'bg_box_layout_config' => 'auto',                // auto | td-boxed-layout | td-full-layout
                'bg_use_featured_image_as_background' => false   // uses the featured image as a background
            )
        );

        td_api_single_template::add('single_template_8',
            array(
                'file' => td_global::$get_template_directory . '/single_template_8.php',
                'text' => '单个模板 8',
                'img' => td_global::$get_template_directory_uri . '/images/panel/single_templates/single_template_8.png',
                'show_featured_image_on_all_pages' => true, //shows the featured image on all the pages
                'bg_disable_background' => false,          // disable the featured image
                'bg_box_layout_config' => 'td-boxed-layout',                // auto | td-boxed-layout | td-full-layout
                'bg_use_featured_image_as_background' => true,   // uses the featured image as a background
            )
        );

        td_api_single_template::add('single_template_9',
            array(
                'file' => td_global::$get_template_directory . '/single_template_9.php',
                'text' => '单个模板 9',
                'img' => td_global::$get_template_directory_uri . '/images/panel/single_templates/single_template_9.png',
                'show_featured_image_on_all_pages' => false,
                'bg_disable_background' => false,          // disable the featured image
                'bg_box_layout_config' => 'auto',                // auto | td-boxed-layout | td-full-layout
                'bg_use_featured_image_as_background' => false   // uses the featured image as a background
            )
        );
        td_api_single_template::add('single_template_10',
            array(
                'file' => td_global::$get_template_directory . '/single_template_10.php',
                'text' => '单个模板 10',
                'img' => td_global::$get_template_directory_uri . '/images/panel/single_templates/single_template_10.png',
                'show_featured_image_on_all_pages' => true, //shows the featured image on all the pages
                'bg_disable_background' => false,          // disable the featured image
                'bg_box_layout_config' => 'auto',                // auto | td-boxed-layout | td-full-layout
                'bg_use_featured_image_as_background' => false   // uses the featured image as a background
            )
        );
        td_api_single_template::add('single_template_11',
            array(
                'file' => td_global::$get_template_directory . '/single_template_11.php',
                'text' => '单个模板 11',
                'img' => td_global::$get_template_directory_uri . '/images/panel/single_templates/single_template_11.png',
                'show_featured_image_on_all_pages' => true, //shows the featured image on all the pages
                'bg_disable_background' => false,          // disable the featured image
                'bg_box_layout_config' => 'auto',                // auto | td-boxed-layout | td-full-layout
                'bg_use_featured_image_as_background' => false   // uses the featured image as a background
            )
        );
        td_api_single_template::add('single_template_12',
            array(
                'file' => td_global::$get_template_directory . '/single_template_12.php',
                'text' => 'Single template 12',
                'img' => td_global::$get_template_directory_uri . '/images/panel/single_templates/single_template_12.png',
                'show_featured_image_on_all_pages' => true, //shows the featured image on all the pages
                'bg_disable_background' => false,          // disable the featured image
                'bg_box_layout_config' => 'auto',                // auto | td-boxed-layout | td-full-layout
                'bg_use_featured_image_as_background' => false   // uses the featured image as a background
            )
        );
        td_api_single_template::add('single_template_13',
            array(
                'file' => td_global::$get_template_directory . '/single_template_13.php',
                'text' => 'Single template 13',
                'img' => td_global::$get_template_directory_uri . '/images/panel/single_templates/single_template_13.png',
                'show_featured_image_on_all_pages' => true, //shows the featured image on all the pages
                'bg_disable_background' => false,          // disable the featured image
                'bg_box_layout_config' => 'auto',                // auto | td-boxed-layout | td-full-layout
                'bg_use_featured_image_as_background' => false   // uses the featured image as a background
            )
        );



        /**
         * smart lists
         */
        td_api_smart_list::add('td_smart_list_1',
            array(
                'file' => td_global::$get_template_directory . '/includes/smart_lists/td_smart_list_1.php',
                'text' => '智能列表 1',
                'img' => td_global::$get_template_directory_uri . '/images/panel/smart_lists/td_smart_list_1.png',
	            'extract_first_image' => true
            )
        );
        td_api_smart_list::add('td_smart_list_2',
            array(
                'file' => td_global::$get_template_directory . '/includes/smart_lists/td_smart_list_2.php',
                'text' => '智能列表 2',
                'img' => td_global::$get_template_directory_uri . '/images/panel/smart_lists/td_smart_list_2.png',
                'extract_first_image' => true
            )
        );
        td_api_smart_list::add('td_smart_list_3',
            array(
                'file' => td_global::$get_template_directory . '/includes/smart_lists/td_smart_list_3.php',
                'text' => '智能列表 3',
                'img' => td_global::$get_template_directory_uri . '/images/panel/smart_lists/td_smart_list_3.png',
                'extract_first_image' => true
            )
        );
        td_api_smart_list::add('td_smart_list_4',
            array(
                'file' => td_global::$get_template_directory . '/includes/smart_lists/td_smart_list_4.php',
                'text' => '智能列表 4',
                'img' => td_global::$get_template_directory_uri . '/images/panel/smart_lists/td_smart_list_4.png',
                'extract_first_image' => true
            )
        );
        td_api_smart_list::add('td_smart_list_5',
            array(
                'file' => td_global::$get_template_directory . '/includes/smart_lists/td_smart_list_5.php',
                'text' => '智能列表 5',
                'img' => td_global::$get_template_directory_uri . '/images/panel/smart_lists/td_smart_list_5.png',
                'extract_first_image' => true
            )
        );
        td_api_smart_list::add('td_smart_list_6',
            array(
                'file' => td_global::$get_template_directory . '/includes/smart_lists/td_smart_list_6.php',
                'text' => '智能列表 6',
                'img' => td_global::$get_template_directory_uri . '/images/panel/smart_lists/td_smart_list_6.png',
                'extract_first_image' => true
            )
        );
        td_api_smart_list::add('td_smart_list_7',
            array(
                'file' => td_global::$get_template_directory . '/includes/smart_lists/td_smart_list_7.php',
                'text' => '智能列表 7',
                'img' => td_global::$get_template_directory_uri . '/images/panel/smart_lists/td_smart_list_7.png',
                'extract_first_image' => true
            )
        );
        td_api_smart_list::add('td_smart_list_8',
            array(
                'file' => td_global::$get_template_directory . '/includes/smart_lists/td_smart_list_8.php',
                'text' => '智能列表 8',
                'img' => td_global::$get_template_directory_uri . '/images/panel/smart_lists/td_smart_list_8.png',
                'extract_first_image' => false
            )
        );



        /**
         * modules list
         */
        td_api_module::add('td_module_1',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_1.php',
                'text' => '模块1',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_1.png',
                'used_on_blocks' => array('td_block_3'),
                'excerpt_title' => 12,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => true,
                'enabled_on_loops' => true,
                'uses_columns' => true,
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_2',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_2.php',
                'text' => '模块2',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_2.png',
                'used_on_blocks' => array('td_block_2', 'td_block_4'),
                'excerpt_title' => 12,
                'excerpt_content' => 25,
                'enabled_on_more_articles_box' => true,
                'enabled_on_loops' => true,
                'uses_columns' => true,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_3',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_3.php',
                'text' => '模块3',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_3.png',
                'used_on_blocks' => array('td_block_5'),
                'excerpt_title' => 12,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => true,
                'enabled_on_loops' => true,
                'uses_columns' => true,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_4',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_4.php',
                'text' => '模块4',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_4.png',
                'used_on_blocks' => array('td_block_1', 'td_block_17'),
                'excerpt_title' => 12,
                'excerpt_content' => 25,
                'enabled_on_more_articles_box' => true,
                'enabled_on_loops' => true,
                'uses_columns' => true,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_5',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_5.php',
                'text' => '模块5',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_5.png',
                'used_on_blocks' => array('td_block_6'),
                'excerpt_title' => 12,
                'excerpt_content' => 25,
                'enabled_on_more_articles_box' => true,
                'enabled_on_loops' => true,
                'uses_columns' => true,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_6',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_6.php',
                'text' => '模块6',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_6.png',
                'used_on_blocks' => array('td_block_1', 'td_block_2', 'td_block_7', 'td_block_16'),
                'excerpt_title' => 12,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => true,
                'enabled_on_loops' => true,
                'uses_columns' => true,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_7',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_7.php',
                'text' => '模块7',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_7.png',
                'used_on_blocks' => array('td_block_8'),
                'excerpt_title' => 12,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => true,
                'enabled_on_loops' => true,
                'uses_columns' => true,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_8',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_8.php',
                'text' => '模块8',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_8.png',
                'used_on_blocks' => array('td_block_9', 'td_block_17'),
                'excerpt_title' => 15,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => true,
                'enabled_on_loops' => true,
                'uses_columns' => true,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap'
            )
        );

        td_api_module::add('td_module_9',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_9.php',
                'text' => '模块9',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_9.png',
                'used_on_blocks' => array('td_block_10'),
                'excerpt_title' => 15,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => true,
                'enabled_on_loops' => true,
                'uses_columns' => true,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap'
            )
        );

        td_api_module::add('td_module_10',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_10.php',
                'text' => '模块10',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_10.png',
                'used_on_blocks' => array('td_block_11', 'td_block_18'),
                'excerpt_title' => 15,
                'excerpt_content' => 25,
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => true,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_11',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_11.php',
                'text' => '模块11',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_11.png',
                'used_on_blocks' => array('td_block_12'),
                'excerpt_title' => 15,
                'excerpt_content' => 35,
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => true,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_12',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_12.php',
                'text' => '模块12',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_12.png',
                'used_on_blocks' => '',
                'excerpt_title' => 30,
                'excerpt_content' => 60,
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => true,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_13',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_13.php',
                'text' => '模块13',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_13.png',
                'used_on_blocks' => '',
                'excerpt_title' => 30,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => true,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_14',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_14.php',
                'text' => '模块14',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_14.png',
                'used_on_blocks' => array('td_block_13', 'td_block_20'),
                'excerpt_title' => 30,
                'excerpt_content' => 40,
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => true,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_15',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_15.php',
                'text' => '模块15',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_15.png',
                'used_on_blocks' => '',
                'excerpt_title' => '',
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => true,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td-animation-stack'
            )
        );

        td_api_module::add('td_module_16',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_16.php',
                'text' => '模块16',
                'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_16.png',
                'used_on_blocks' =>  array('Search Page'),
                'excerpt_title' => 15,
                'excerpt_content' => 25,
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => true,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx1',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx1.php',
                'text' => '模块 MX1',
                'img' => '',
                'used_on_blocks' => array('td_block_14', 'td_block_19'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx2',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx2.php',
                'text' => '模块 MX2',
                'img' => '',
                'used_on_blocks' => array('td_block_18', 'td_block_19', 'Search live'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx3',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx3.php',
                'text' => '模块 MX3',
                'img' => '',
                'used_on_blocks' => array('td_block_13', 'td_block_20'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx4',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx4.php',
                'text' => '模块 MX4',
                'img' => '',
                'used_on_blocks' => array('td_block_15'),
                'excerpt_title' => 12,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx5',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx5.php',
                'text' => '模块 MX5',
                'img' => '',
                'used_on_blocks' => array('td_block_big_grid_1', 'td_block_big_grid_3', 'td_block_big_grid_4', 'td_block_big_grid_6'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,
                'category_label' => true,
                'class' => 'td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx6',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx6.php',
                'text' => '模块 MX6',
                'img' => '',
                'used_on_blocks' => array('td_block_big_grid_1', 'td_block_big_grid_3', 'td_block_big_grid_7'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,
                'category_label' => true,
                'class' => 'td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx7',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx7.php',
                'text' => '模块 MX7',
                'img' => '',
                'used_on_blocks' => array('td_block_16'),
                'excerpt_title' => 25,
                'excerpt_content' => 16,
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx8',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx8.php',
                'text' => '模块 MX8',
                'img' => '',
                'used_on_blocks' => array('td_block_18'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,
                'category_label' => true,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx9',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx9.php',
                'text' => '模块 MX9',
                'img' => '',
                'used_on_blocks' => array('td_block_big_grid_2'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,
                'category_label' => true,
                'class' => 'td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx10',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx10.php',
                'text' => '模块 MX10',
                'img' => '',
                'used_on_blocks' => array('td_block_big_grid_2'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,
                'category_label' => true,
                'class' => 'td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx11',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx11.php',
                'text' => '模块 MX11',
                'img' => '',
                'used_on_blocks' => array('td_block_big_grid_3'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,
                'category_label' => true,
                'class' => 'td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx12',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx12.php',
                'text' => '模块 MX12',
                'img' => '',
                'used_on_blocks' => array('td_block_big_grid_5', 'td_block_big_grid_7', 'td_block_big_grid_8'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,
                'category_label' => true,
                'class' => 'td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx13',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx13.php',
                'text' => '模块 MX13',
                'img' => '',
                'used_on_blocks' => array('td_block_big_grid_6'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,
                'category_label' => true,
                'class' => 'td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx14',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx14.php',
                'text' => '模块 MX14',
                'img' => '',
                'used_on_blocks' => array('td_block_big_grid_8'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,
                'category_label' => true,
                'class' => 'td-animation-stack'
            )
        );

        td_api_module::add('td_module_mx_empty',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mx_empty.php',
                'text' => '模块 MX 空',
                'img' => '',
                'used_on_blocks' => array('td_block_big_grid_1'),
                'excerpt_title' => '',
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,
                'category_label' => false,
                'class' => 'td-animation-stack'
            )
        );

        td_api_module::add('td_module_related_posts',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_related_posts.php',
                'text' => '相关文章模块',
                'img' => '',
                'used_on_blocks' => array('td_block_related_posts'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,
                'category_label' => true,
                'class' => 'td-animation-stack'
            )
        );

        td_api_module::add('td_module_mega_menu',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_mega_menu.php',
                'text' => '大菜单模块',
                'img' => '',
                'used_on_blocks' => array('td_block_mega_menu'),
                'excerpt_title' => '12',
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => ''
            )
        );

        td_api_module::add('td_module_slide',
            array(
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_slide.php',
                'text' => '幻灯片模块',
                'img' => '',
                'used_on_blocks' => array('td_block_slide'),
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => true,
                'class' => 'td-animation-stack'
            )
        );

        td_api_module::add('td_module_trending_now',
            array(  // this module is for internal use only
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_trending_now.php',
                'text' => '现在趋势模块',
                'img' => '',
                'used_on_blocks' => '',
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => false,
                'class' => ''
            )
        );

        td_api_module::add('td_module_single',
            array(  // this module is for internal use only
                'file' => td_global::$get_template_directory . '/includes/modules/td_module_single.php',
                'text' => '单个模块',
                'img' => '',
                'used_on_blocks' => '',
                'excerpt_title' => '',
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,                      // if the module uses columns on the page template + loop
                'category_label' => false,
                'class' => ''
            )
        );



        /**
         * the thumbs used by the theme
         * Thumb id => array parameters. Wp booster only cuts if the option is set from theme panel
         */


        td_api_thumb::add('td_80x60',
            array(
                'name' => 'td_80x60',
                'width' => 80,
                'height' => 60,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'small',
                'used_on' => array(
                    'MX2', '区块 18', '区块 19', '即时搜索'
                )
            )
        );

        td_api_thumb::add('td_100x70',
            array(
                'name' => 'td_100x70',
                'width' => 100,
                'height' => 70,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'small',
                'used_on' => array(
                    '模块 6, 7', '区块 1, 2, 7, 8, 16'
                )
            )
        );

        td_api_thumb::add('td_218x150',
            array(
                'name' => 'td_218x150',
                'width' => 218,
                'height' => 150,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    '模块 10, MX4, MX7, MX13, 大菜单, 相关文章',  '区块 11, 15, 16, 18, 大网格 6'
                )
            )
        );

        td_api_thumb::add('td_265x198',
            array(
                'name' => 'td_265x198',
                'width' => 265,
                'height' => 198,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    '大网格 1, 3, 7 - 小图片'
                )
            )
        );

        td_api_thumb::add('td_324x160',
            array(
                'name' => 'td_324x160',
                'width' => 324,
                'height' => 160,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    '模块 1, 2', '区块 2, 3, 4, 大网格 2'
                )
            )
        );

        td_api_thumb::add('td_324x235',
            array(
                'name' => 'td_324x235',
                'width' => 324,
                'height' => 235,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    '模块 3, 4, 5, 11, MX3', '区块 1, 5, 6, 13, 17, 20'
                )
            )
        );

        td_api_thumb::add('td_324x400',
            array(
                'name' => 'td_324x400',
                'width' => 324,
                'height' => 400,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    '幻灯片 - 1 列'
                )
            )
        );

        td_api_thumb::add('td_356x220',
            array(
                'name' => 'td_356x220',
                'width' => 356,
                'height' => 220,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    '模块 MX1, MX12', '区块 14, 19, 大网格 5, 7, 8'
                )
            )
        );

        td_api_thumb::add('td_356x364',
            array(
                'name' => 'td_356x364',
                'width' => 356,
                'height' => 364,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    '模块 MX14,', '大网格 8'
                )
            )
        );

        td_api_thumb::add('td_533x261',
            array(
                'name' => 'td_533x261',
                'width' => 533,
                'height' => 261,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    '模块 MX11,', '大网格 3'
                )
            )
        );

        td_api_thumb::add('td_534x462',
            array(
                'name' => 'td_534x462',
                'width' => 534,
                'height' => 462,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    '模块 MX5,', '网格 1, 3, 4, 6'
                )
            )
        );

        td_api_thumb::add('td_696x0',
            array(
                'name' => 'td_696x0',
                'width' => 696,
                'height' => 0,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    '默认文章模板, 文章模板 2, 文章模板 11', '模块 12, 13, 15', '智能列表风格 1, 2, 5, 6'
                )
            )
        );

        td_api_thumb::add('td_696x385',
            array(
                'name' => 'td_696x385',
                'width' => 696,
                'height' => 385,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    '模块 14, MX8', '区块 13, 18, 20', '幻灯片 - 2列'
                )
            )
        );

        td_api_thumb::add('td_741x486',
            array(
                'name' => 'td_741x486',
                'width' => 741,
                'height' => 486,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    'MX9', '大网格 2'
                )
            )
        );

        td_api_thumb::add('td_1068x580',
            array(
                'name' => 'td_1068x580',
                'width' => 1068,
                'height' => 580,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    '幻灯片 - 3列'
                )
            )
        );

        td_api_thumb::add('td_1068x0',
            array(
                'name' => 'td_1068x0',
                'width' => 1068,
                'height' => 0,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal',
                'used_on' => array(
                    '文章模板 3, 文章模板 4,  文章模板 9,  文章模板 10', '智能列表风格 1, 2, 5, 6'
                )
            )
        );

        td_api_thumb::add('td_0x420',
            array(
                'name' => 'td_0x420',
                'width' => 0,
                'height' => 420,
                'crop' => array('center', 'top'),
                'post_format_icon_size' => 'normal', //what play icon to load (small or normal)
                'used_on' => array(
                    'tagDiv图片相册'
                )
            )
        );


        /**
         * the headers
         */

        td_api_header_style::add('1',
            array(
                'text' => '<strong>风格 1 - </strong> 默认',
                'file' => td_global::$get_template_directory . '/parts/header/header-style-1.php'
            )
        );

        td_api_header_style::add('2',
            array(
                'text' => '<strong>风格 2 - </strong> 顶部菜单',
                'file' => td_global::$get_template_directory . '/parts/header/header-style-2.php'
            )
        );

        td_api_header_style::add('3',
            array(
                'text' => '<strong>风格 3 - </strong> 框式深色菜单',
                'file' => td_global::$get_template_directory . '/parts/header/header-style-3.php'
            )
        );

        td_api_header_style::add('4',
            array(
                'text' => '<strong>风格 4 - </strong> 框式深色菜单带 logo',
                'file' => td_global::$get_template_directory . '/parts/header/header-style-4.php'
            )
        );

        td_api_header_style::add('5',
            array(
                'text' => '<strong>风格 5 - </strong> 完整深色菜单带 logo',
                'file' => td_global::$get_template_directory . '/parts/header/header-style-5.php'
            )
        );

        td_api_header_style::add('6',
            array(
                'text' => '<strong>风格 6 - </strong> 完整深色菜单在右带 logo',
                'file' => td_global::$get_template_directory . '/parts/header/header-style-6.php'
            )
        );

        td_api_header_style::add('7',
            array(
                'text' => '<strong>风格 7 - </strong> 右菜单和LOGO混合',
                'file' => td_global::$get_template_directory . '/parts/header/header-style-7.php'
            )
        );

        td_api_header_style::add('8',
            array(
                'text' => '<strong>风格 8 - </strong> 混合菜单 2',
                'file' => td_global::$get_template_directory . '/parts/header/header-style-8.php'
            )
        );

        td_api_header_style::add('9',
            array(
                'text' => '<strong>风格 9 - </strong> 完整 logo 在顶部',
                'file' => td_global::$get_template_directory . '/parts/header/header-style-9.php'
            )
        );

        td_api_header_style::add('10',
            array(
                'text' => '<strong>风格 10 - </strong> 完整 logo 在顶部 + 中心菜单',
                'file' => td_global::$get_template_directory . '/parts/header/header-style-10.php'
            )
        );

        td_api_header_style::add('11',
            array(
                'text' => '<strong>风格 11 - </strong> 顶部菜单 + 底部完整 logo',
                'file' => td_global::$get_template_directory . '/parts/header/header-style-11.php'
            )
        );

        td_api_header_style::add('12',
            array(
                'text' => '<strong>风格 12 - </strong> 顶部彩色菜单带 logo',
                'file' => td_global::$get_template_directory . '/parts/header/header-style-12.php'
            )
        );


        /**
         * the styles for big grids. This styles will show up in the panel @see td_panel_categories.php and on each big grid block
         * This has to be before the blocks are added! The grids blocks are made with this
         */
        td_global::$big_grid_styles_list = array(
            'td-grid-style-1' => array(  // td-grid-style-1 - THIS HAS TO BE THE DEFAULT
                'text' => '网格风格 1'
            ),
            'td-grid-style-2' => array(
                'text' => '网格风格 2'
            ),
            'td-grid-style-3' => array(
                'text' => '网格风格 3'
            ),
            'td-grid-style-4' => array(
                'text' => '网格风格 4'
            ),
            'td-grid-style-5' => array(
                'text' => '网格风格 5'
            )
        );



        /**
         * the blocks
         */
        td_api_block::add('td_block_1',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 1',
                "base" => 'td_block_1',
                "class" => 'td_block_1',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_1',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_1.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_2',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 2',
                "base" => 'td_block_2',
                "class" => 'td_block_2',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_2',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_2.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_3',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 3',
                "base" => 'td_block_3',
                "class" => 'td_block_3',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_3',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_3.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_4',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 4',
                "base" => 'td_block_4',
                "class" => 'td_block_4',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_4',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_4.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_5',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 5',
                "base" => 'td_block_5',
                "class" => 'td_block_5',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_5',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_5.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_6',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 6',
                "base" => 'td_block_6',
                "class" => 'td_block_6',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_6',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_6.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_7',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 7',
                "base" => 'td_block_7',
                "class" => 'td_block_7',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_7',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_7.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_8',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 8',
                "base" => 'td_block_8',
                "class" => 'td_block_8',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_8',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_8.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_9',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 9',
                "base" => 'td_block_9',
                "class" => 'td_block_9',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_9',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_9.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_10',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 10',
                "base" => 'td_block_10',
                "class" => 'td_block_10',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_10',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_10.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_11',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 11',
                "base" => 'td_block_11',
                "class" => 'td_block_11',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_11',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_11.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_12',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 12',
                "base" => 'td_block_12',
                "class" => 'td_block_12',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_12',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_12.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_13',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 13',
                "base" => 'td_block_13',
                "class" => 'td_block_13',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_13',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_13.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_14',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 14',
                "base" => 'td_block_14',
                "class" => 'td_block_14',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_14',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_14.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_15',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 15',
                "base" => 'td_block_15',
                "class" => 'td_block_15',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_15',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_15.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_16',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 16',
                "base" => 'td_block_16',
                "class" => 'td_block_16',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_16',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_16.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_17',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 17',
                "base" => 'td_block_17',
                "class" => 'td_block_17',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_17',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_17.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_18',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 18',
                "base" => 'td_block_18',
                "class" => 'td_block_18',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_18',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_18.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_19',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 19',
                "base" => 'td_block_19',
                "class" => 'td_block_19',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_19',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_19.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_20',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 20',
                "base" => 'td_block_20',
                "class" => 'td_block_20',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_20',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_20.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_21',
            array(
                'map_in_visual_composer' => true,
                "name" => '区块 21',
                "base" => 'td_block_21',
                "class" => 'td_block_21',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_21',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_21.php',
                "params" => array_merge(
                    self::get_map_block_general_array(),
                    self::get_map_filter_array(),
                    self::get_map_block_ajax_filter_array(),
                    self::get_map_block_pagination_array()
                )
            )
        );

        td_api_block::add('td_block_big_grid_1',
            array(
                'map_in_visual_composer' => true,
                "name" => '大网格 1',
                "base" => 'td_block_big_grid_1',
                "class" => 'td_block_big_grid_1',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_big_grid_1',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_big_grid_1.php',
                "params" => self::td_block_big_grid_params(),
            )
        );

        td_api_block::add('td_block_big_grid_2',
            array(
                'map_in_visual_composer' => true,
                "name" => '大网格 2',
                "base" => 'td_block_big_grid_2',
                "class" => 'td_block_big_grid_2',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_big_grid_2',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_big_grid_2.php',
                "params" => self::td_block_big_grid_params(),
            )
        );

        td_api_block::add('td_block_big_grid_3',
            array(
                'map_in_visual_composer' => true,
                "name" => '大网格 3',
                "base" => 'td_block_big_grid_3',
                "class" => 'td_block_big_grid_3',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_big_grid_3',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_big_grid_3.php',
                "params" => self::td_block_big_grid_params(),
            )
        );

        td_api_block::add('td_block_big_grid_4',
            array(
                'map_in_visual_composer' => true,
                "name" => '大网格 4',
                "base" => 'td_block_big_grid_4',
                "class" => 'td_block_big_grid_4',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_big_grid_4',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_big_grid_4.php',
                "params" => self::td_block_big_grid_params(),
            )
        );

        td_api_block::add('td_block_big_grid_5',
            array(
                'map_in_visual_composer' => true,
                "name" => '大网格5',
                "base" => 'td_block_big_grid_5',
                "class" => 'td_block_big_grid_5',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_big_grid_5',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_big_grid_5.php',
                "params" => self::td_block_big_grid_params(),
            )
        );

        td_api_block::add('td_block_big_grid_6',
            array(
                'map_in_visual_composer' => true,
                "name" => '大网格 6',
                "base" => 'td_block_big_grid_6',
                "class" => 'td_block_big_grid_6',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_big_grid_6',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_big_grid_6.php',
                "params" => self::td_block_big_grid_params(),
            )
        );

        td_api_block::add('td_block_big_grid_7',
            array(
                'map_in_visual_composer' => true,
                "name" => '大网格 7',
                "base" => 'td_block_big_grid_7',
                "class" => 'td_block_big_grid_7',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_big_grid_7',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_big_grid_7.php',
                "params" => self::td_block_big_grid_params(),
            )
        );

        td_api_block::add('td_block_big_grid_8',
            array(
                'map_in_visual_composer' => true,
                "name" => '大网格 8',
                "base" => 'td_block_big_grid_8',
                "class" => 'td_block_big_grid_8',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_big_grid_8',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_big_grid_8.php',
                "params" => self::td_block_big_grid_params(),
            )
        );

	    td_api_block::add('td_block_big_grid_slide',
		    array(
			    'map_in_visual_composer' => true,
			    "name" => '大网格幻灯片',
			    "base" => 'td_block_big_grid_slide',
			    "class" => 'td_block_big_grid_slide',
			    "controls" => "full",
			    "category" => '区块',
			    'icon' => 'icon-pagebuilder-td_block_big_grid_slide',
			    'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_big_grid_slide.php',
			    "params" => self::td_block_big_grid_slide_params(),
		    )
	    );



        td_api_block::add('td_block_trending_now',
            array(
                'map_in_visual_composer' => true,
                "name" => '新闻速递',
                "base" => 'td_block_trending_now',
                "class" => 'td_block_trending_now',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_trending_now',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_trending_now.php',
                "params" => self::td_block_trending_now_params(),
            )
        );

        td_api_block::add('td_block_video_youtube',
            array(
                'map_in_visual_composer' => true,
                "name" => '视频播放列表',
                "base" => "td_block_video_youtube",
                "class" => "td_block_video_playlist_youtube",
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td-youtube',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_video_youtube.php',
                "params" => array(
                    array(
                        "param_name" => "playlist_title",
                        "type" => "textfield",
                        "value" => "",
                        //"heading" => __("Optional - custom title for this block:", TD_THEME_NAME),
                        "heading" => "可选 - 自定义此区块标题：",
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "playlist_yt",
                        "type" => "textfield",
                        "value" => "",
                        //"heading" => __("Optional - custom title for this block:", TD_THEME_NAME),
                        "heading" => "逗号分隔的youtube列表ID（例如：NRuE38Bl5Mo, 1ZgoluYjuZM, 0K-0vkFfUmY）:",
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "playlist_auto_play",
                        "type" => "dropdown",
                        "value" => array('关' => '0', '开' => '1'),
                        //"heading" => __("Select playlist type:", TD_THEME_NAME),
                        "heading" => "自动播放开/关：",
                        "description" => "自动播放不在移动设备工作（安卓、windows phone, iOS）",
                        "holder" => "div",
                        "class" => ""
                    )
                )
            )
        );

        td_api_block::add('td_block_video_vimeo',
            array(
                'map_in_visual_composer' => true,
                "name" => '视频播放列表',
                "base" => "td_block_video_vimeo",
                "class" => "td_block_video_playlist_vimeo",
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td-vimeo',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_video_vimeo.php',
                "params" => array(
                    array(
                        "param_name" => "playlist_title",
                        "type" => "textfield",
                        "value" => "",
                        //"heading" => __("Optional - custom title for this block:", TD_THEME_NAME),
                        "heading" => "可选 - 自定义此区块标题：",
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "playlist_v",
                        "type" => "textfield",
                        "value" => "",
                        //"heading" => __("Optional - custom title for this block:", TD_THEME_NAME),
                        "heading" => "用逗号分隔vimeo ID列表（例如：100888579,  84062802, 57863017）",
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "playlist_auto_play",
                        "type" => "dropdown",
                        "value" => array('关' => '0', '开' => '1'),
                        //"heading" => __("Select playlist type:", TD_THEME_NAME),
                        "heading" => "自动播放开/关:",
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    )
                )
            )
        );

        td_api_block::add('td_block_ad_box',
            array(
                'map_in_visual_composer' => true,
                "name" => '广告框',
                "base" => 'td_block_ad_box',
                "class" => "",
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-ads',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_ad_box.php',
                "params" => array(
                    array(
                        "param_name" => "spot_id",
                        "type" => "dropdown",
                        "value" => array(
                            '侧边栏' => 'sidebar',
                            '内容内嵌' => 'content_inline',
                            '内容顶部' => 'content_top',
                            '内容底部' => 'content_bottom',
                            '页眉' => 'header',
                            '自定义广告1' => 'custom_ad_1',
                            '自定义广告2' => 'custom_ad_2',
                            '自定义广告3' => 'custom_ad_3',
                            '自定义广告4' => 'custom_ad_4',
                            '自定义广告5' => 'custom_ad_5'
                        ),
                        "heading" => '使用位置 :',
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),

                    array(
                        "param_name" => "spot_title",
                        "type" => "textfield",
                        "value" => "",
                        "heading" => '广告标题：',
                        "description" => "可选 - 广告标题，比如 - 广告 - 如果留空，区块将没有标题",
                        "holder" => "div",
                        "class" => ""
                    )
                )
            )
        );

        td_api_block::add('td_block_authors',
            array(
                'map_in_visual_composer' => true,
                "name" => '作者框',
                "base" => "td_block_authors",
                "class" => "",
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_authors',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_authors.php',
                "params" => array(
                    array(
                        "param_name" => "custom_title",
                        "type" => "textfield",
                        "value" => '我们的作者',
                        "heading" => "区块标题",
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "custom_url",
                        "type" => "textfield",
                        "value" => "",
                        "heading" => '区块标题 - 自定义网址',
                        "description" => "可选 - (当选中模块标题)",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "sort",
                        "type" => "dropdown",
                        "value" => array('- 按名字排序 -' => '', '按文章数排序' => 'post_count'),
                        "heading" => '作者排序方式：',
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "exclude",
                        "type" => "textfield",
                        "value" => '',
                        "heading" => "排除作者ID (,分隔)",
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "include",
                        "type" => "textfield",
                        "value" => '',
                        "heading" => "包含作者ID (,分隔) - 不使用排除",
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => '标题文字颜色',
                        "param_name" => "header_text_color",
                        "value" => '', //Default Red color
                        "description" => '可选 - 为此区块选择自定义标题文字颜色'
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => '标题背景颜色',
                        "param_name" => "header_color",
                        "value" => '', //Default Red color
                        "description" => '可选 - 为此区块选择自定义标题背景颜色'
                    )
                )
            )
        );

        td_api_block::add('td_block_homepage_full_1',
            array(
                'map_in_visual_composer' => true,
                "name" => '首页文章',
                "base" => 'td_block_homepage_full_1',
                "class" => 'td_block_homepage_full_1',
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-td_block_homepage_full_1',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_homepage_full_1.php',
                "params" => self::td_homepage_full_1_params()
            )
        );

        td_api_block::add('td_block_popular_categories',
            array(
                'map_in_visual_composer' => true,
                "name" => '热门分类',
                "base" => "td_block_popular_categories",
                "class" => "td_block_popular_categories",
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-popular_categories',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_popular_categories.php',
                "params" => array(
                    array(
                        "param_name" => "custom_title",
                        "type" => "textfield",
                        "value" => "热门分类",
                        "heading" => '可选 - 自定义此区块标题：',
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "custom_url",
                        "type" => "textfield",
                        "value" => "",
                        "heading" => '可选 - 自定义此区块网址 (当选中模块标题):',
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => '标题文字颜色',
                        "param_name" => "header_text_color",
                        "value" => '',
                        "description" => '可选 - 为此区块选择自定义标题文字颜色'
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => '标题背景颜色',
                        "param_name" => "header_color",
                        "value" => '',
                        "description" => '可选 - 为此区块选择自定义标题背景颜色'
                    ),
                    array(
                        "param_name" => "limit",
                        "type" => "textfield",
                        "value" => "6",
                        "heading" => '限制显示分类数：',
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    )
                )
            )
        );

        td_api_block::add('td_block_slide',
            array(
                'map_in_visual_composer' => true,
                "name" => '幻灯片',
                "base" => "td_block_slide",
                "class" => "td_block_slide",
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-slide',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_slide.php',
                "params" => array_merge(
	                self::td_slide_params(),
	                self::get_map_block_ajax_filter_array()
                )
            )
        );

        td_api_block::add('td_block_text_with_title',
            array(
                'map_in_visual_composer' => true,
                "name" => '文字带标题',
                "base" => "td_block_text_with_title",
                "class" => "",
                "controls" => "full",
                "category" => '区块',
                'icon' => 'icon-pagebuilder-title',
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_text_with_title.php',
                "params" => array(
                    array(
                        "param_name" => "custom_title",
                        "type" => "textfield",
                        "value" => '',
                        "heading" => "区块标题",
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "content",
                        "type" => "textarea_html",
                        "holder" => "div",
                        "class" => "",
                        "heading" => '文字',
                        "value" => "",
                        "description" => '输入您的内容.'
                    ),

                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => '标题文字颜色',
                        "param_name" => "header_text_color",
                        "value" => '',
                        "description" => '可选 - 为此区块选择自定义文字颜色'
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => '标题背景颜色',
                        "param_name" => "header_color",
                        "value" => '',
                        "description" => '可选 - 为此区块选择自定义标题背景颜色'
                    )
                )
            )
        );

        td_api_block::add('td_block_related_posts',
            array(
                'map_in_visual_composer' => false,
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_related_posts.php',
            )
        );

        td_api_block::add('td_block_mega_menu',
            array(
                'map_in_visual_composer' => false,
                'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_mega_menu.php',

                // key added to supply 'show_child_cat' differently for each theme
                'render_atts' => array(
                    'show_child_cat' => 30,
                )
            )
        );



        /**
         * block templates
         */
        td_api_block_template::add('td_block_template_1',
            array (
                'file' => td_global::$get_template_directory . '/includes/block_templates/td_block_template_1.php',
            )
        );



        /**
         * category templates
         */
        td_api_category_template::add('td_category_template_1',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_templates/td_category_template_1.php',
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-1.png',
                'text' => '风格 1'
            )
        );

        td_api_category_template::add('td_category_template_2',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_templates/td_category_template_2.php',
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-2.png',
                'text' => '风格 2'
            )
        );

        td_api_category_template::add('td_category_template_3',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_templates/td_category_template_3.php',
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-3.png',
                'text' => '风格 3'
            )
        );

        td_api_category_template::add('td_category_template_4',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_templates/td_category_template_4.php',
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-4.png',
                'text' => '风格 4'
            )
        );

        td_api_category_template::add('td_category_template_5',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_templates/td_category_template_5.php',
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-5.png',
                'text' => '风格 5'
            )
        );

        td_api_category_template::add('td_category_template_6',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_templates/td_category_template_6.php',
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-6.png',
                'text' => '风格 6'
            )
        );

        td_api_category_template::add('td_category_template_7',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_templates/td_category_template_7.php',
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-7.png',
                'text' => '风格 7'
            )
        );

        td_api_category_template::add('td_category_template_8',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_templates/td_category_template_8.php',
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-8.png',
                'text' => '风格 8'
            )
        );





        /**
         * category top posts styles
         */
        td_api_category_top_posts_style::add('td_category_top_posts_style_1',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_top_posts_styles/td_category_top_posts_style_1.php',
                'posts_shown_in_the_loop' => 5,
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-top-1.png',
                'text' => '网格 1',
                'td_block_name' => 'td_block_big_grid_1'
            )
        );

        td_api_category_top_posts_style::add('td_category_top_posts_style_2',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_top_posts_styles/td_category_top_posts_style_2.php',
                'posts_shown_in_the_loop' => 4,
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-top-2.png',
                'text' => '网格 2',
                'td_block_name' => 'td_block_big_grid_2'
            )
        );

        td_api_category_top_posts_style::add('td_category_top_posts_style_3',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_top_posts_styles/td_category_top_posts_style_3.php',
                'posts_shown_in_the_loop' => 4,
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-top-3.png',
                'text' => '网格 3',
                'td_block_name' => 'td_block_big_grid_3'
            )
        );

        td_api_category_top_posts_style::add('td_category_top_posts_style_4',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_top_posts_styles/td_category_top_posts_style_4.php',
                'posts_shown_in_the_loop' => 2,
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-top-4.png',
                'text' => '网格 4',
                'td_block_name' => 'td_block_big_grid_4'
            )
        );

        td_api_category_top_posts_style::add('td_category_top_posts_style_5',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_top_posts_styles/td_category_top_posts_style_5.php',
                'posts_shown_in_the_loop' => 3,
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-top-5.png',
                'text' => '网格 5',
                'td_block_name' => 'td_block_big_grid_5'
            )
        );

        td_api_category_top_posts_style::add('td_category_top_posts_style_6',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_top_posts_styles/td_category_top_posts_style_6.php',
                'posts_shown_in_the_loop' => 7,
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-top-6.png',
                'text' => '网格 6',
                'td_block_name' => 'td_block_big_grid_6'
            )
        );

        td_api_category_top_posts_style::add('td_category_top_posts_style_7',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_top_posts_styles/td_category_top_posts_style_7.php',
                'posts_shown_in_the_loop' => 7,
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-top-7.png',
                'text' => '网格 7',
                'td_block_name' => 'td_block_big_grid_7'
            )
        );

        td_api_category_top_posts_style::add('td_category_top_posts_style_8',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_top_posts_styles/td_category_top_posts_style_8.php',
                'posts_shown_in_the_loop' => 7,
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-top-8.png',
                'text' => '网格 8',
                'td_block_name' => 'td_block_big_grid_8'
            )
        );

        td_api_category_top_posts_style::add('td_category_top_posts_style_disable',
            array (
                'file' => td_global::$get_template_directory . '/includes/category_top_posts_styles/td_category_top_posts_style_disable.php',
                'posts_shown_in_the_loop' => 0,
                'img' => td_global::$get_template_directory_uri . '/images/panel/category_templates/icon-category-top-disable.png',
                'text' => '禁用',
                'td_block_name' => ''
            )
        );



        /**
         * the td_api_top_bar_template
         */
        td_api_top_bar_template::add('td_top_bar_template_1',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/top_bar_templates/icon-top-bar-1.png',
                'file' => td_global::$get_template_directory . '/parts/header/td_top_bar_template_1.php'
            )
        );

        td_api_top_bar_template::add('td_top_bar_template_2',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/top_bar_templates/icon-top-bar-2.png',
                'file' => td_global::$get_template_directory . '/parts/header/td_top_bar_template_2.php'
            )
        );

        td_api_top_bar_template::add('td_top_bar_template_3',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/top_bar_templates/icon-top-bar-3.png',
                'file' => td_global::$get_template_directory . '/parts/header/td_top_bar_template_3.php'
            )
        );

        td_api_top_bar_template::add('td_top_bar_template_4',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/top_bar_templates/icon-top-bar-4.png',
                'file' => td_global::$get_template_directory . '/parts/header/td_top_bar_template_4.php'
            )
        );




        /**
         * the td_api_footer
         */
        td_api_footer_template::add('td_footer_template_1',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/footer_templates/icon-footer-1.png',
                'file' => td_global::$get_template_directory . '/parts/footer/td_footer_template_1.php',
                'text' => '风格 1'

            )
        );

        td_api_footer_template::add('td_footer_template_2',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/footer_templates/icon-footer-2.png',
                'file' => td_global::$get_template_directory . '/parts/footer/td_footer_template_2.php',
                'text' => '风格 2'

            )
        );

        td_api_footer_template::add('td_footer_template_3',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/footer_templates/icon-footer-3.png',
                'file' => td_global::$get_template_directory . '/parts/footer/td_footer_template_3.php',
                'text' => '风格 3'

            )
        );

        td_api_footer_template::add('td_footer_template_4',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/footer_templates/icon-footer-4.png',
                'file' => td_global::$get_template_directory . '/parts/footer/td_footer_template_4.php',
                'text' => '风格 4'

            )
        );

        td_api_footer_template::add('td_footer_template_5',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/footer_templates/icon-footer-5.png',
                'file' => td_global::$get_template_directory . '/parts/footer/td_footer_template_5.php',
                'text' => '风格 5'

            )
        );

        td_api_footer_template::add('td_footer_template_6',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/footer_templates/icon-footer-6.png',
                'file' => td_global::$get_template_directory . '/parts/footer/td_footer_template_6.php',
                'text' => '风格 6'

            )
        );


        td_api_footer_template::add('td_footer_template_7',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/footer_templates/icon-footer-7.png',
                'file' => td_global::$get_template_directory . '/parts/footer/td_footer_template_7.php',
                'text' => '风格 7'

            )
        );

        td_api_footer_template::add('td_footer_template_8',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/footer_templates/icon-footer-8.png',
                'file' => td_global::$get_template_directory . '/parts/footer/td_footer_template_8.php',
                'text' => '风格 8'

            )
        );

        td_api_footer_template::add('td_footer_template_9',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/footer_templates/icon-footer-9.png',
                'file' => td_global::$get_template_directory . '/parts/footer/td_footer_template_9.php',
                'text' => '风格 9'

            )
        );

        td_api_footer_template::add('td_footer_template_10',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/footer_templates/icon-footer-10.png',
                'file' => td_global::$get_template_directory . '/parts/footer/td_footer_template_10.php',
                'text' => '风格 10'

            )
        );

        td_api_footer_template::add('td_footer_template_11',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/footer_templates/icon-footer-11.png',
                'file' => td_global::$get_template_directory . '/parts/footer/td_footer_template_11.php',
                'text' => '风格 11'

            )
        );

        td_api_footer_template::add('td_footer_template_12',
            array(
                'img' => td_global::$get_template_directory_uri . '/images/panel/footer_templates/icon-footer-12.png',
                'file' => td_global::$get_template_directory . '/parts/footer/td_footer_template_12.php',
                'text' => '风格 12'
            )
        );


        /**
         * set the custom css fields for the panel @see td_panel_custom_css.php
         * and also for the wp_footer hook @see td_bottom_code()
         */
        td_global::$theme_panel_custom_css_fields_list = array(
            'tds_responsive_css_desktop' => array(
                'text' => '桌面',
                'description' => '1141px +',
                'media_query' => '@media (min-width: 1141px)',
                'img' => td_global::$get_template_directory_uri . '/includes/wp_booster/wp-admin/images/panel/resp-desktop.png'
            ),
            'tds_responsive_css_ipad_landscape' => array(
                'text' => 'IPAD横向',
                'description' => '1019px - 1140px',
                'media_query' => '@media (min-width: 1019px) and (max-width: 1140px)',
                'img' => td_global::$get_template_directory_uri . '/includes/wp_booster/wp-admin/images/panel/resp-ipado.png'
            ),
            'tds_responsive_css_ipad_portrait' => array(
                'text' => 'IPAD竖向',
                'description' => '768px - 1018px',
                'media_query' => '@media (min-width: 768px) and (max-width: 1018px)',
                'img' => td_global::$get_template_directory_uri . '/includes/wp_booster/wp-admin/images/panel/resp-ipadv.png'
            ),
            'tds_responsive_css_phone' => array(
                'text' => '手机',
                'description' => '0 - 767px',
                'media_query' => '@media (max-width: 767px)',
                'img' => td_global::$get_template_directory_uri . '/includes/wp_booster/wp-admin/images/panel/resp-phone.png'
            )
        );


	    /**
         * The typography settings for the panel and css compiler
         */
        td_global::$typography_settings_list = array (
            '页眉' => array (
                'top_menu' => array(
	                'text' => '顶部菜单',
	                'type' => 'default',
                ),
                'top_sub_menu' => array(
	                'text' => '顶部子菜单',
	                'type' => 'default',
                ),
                'main_menu' => array(
	                'text' => '主菜单',
	                'type' => 'default',
                ),
                'main_sub_menu' => array(
	                'text' => '主要子菜单',
	                'type' => 'default',
                ),
                'mega_menu' => array(
	                'text' => '大菜单',
	                'type' => 'default',
                ),
                'mega_menu_categ' => array(
	                'text' => '大菜单子分类',
	                'type' => 'default',
                ),
                'mobile_menu' => array(
	                'text' => '手机菜单',
	                'type' => 'default',
                ),
                'mobile_sub_menu' => array(
	                'text' => '手机子菜单',
	                'type' => 'default',
                )
            ),
            '模块和区块常规' => array (
                'blocks_title' => array(
	                'text' => '区块/小工具标题',
	                'type' => 'default',
                ),
                'blocks_author' => array(
	                'text' => '作者',
	                'type' => 'default',
                ),
                'blocks_date' => array(
	                'text' => '日期',
	                'type' => 'default',
                ),
                'blocks_comment' =>  array(
	                'text' => '评论',
	                'type' => 'default',
                ),
                'blocks_category' =>  array(
	                'text' => '分类标签',
	                'type' => 'default',
                ),
                'blocks_filter' =>  array(
	                'text' => '筛选下拉',
	                'type' => 'default',
                ),
                'blocks_excerpt' =>  array(
	                'text' => '摘要',
	                'type' => 'default',
                ),
            ),
            '模块和区块 - 文章标题' => array (
	            'modules_general' => array(
		            'text' => '常规字体',
		            'type' => 'general_setting',
	            ),
                'module_1' =>  array(
	                'text' => '模块 1',
	                'type' => 'default',
                ),
                'module_2' =>  array(
	                'text' => '模块 2',
	                'type' => 'default',
                ),
                'module_3' =>  array(
	                'text' => '模块 3',
	                'type' => 'default',
                ),
                'module_4' =>  array(
	                'text' => '模块 4',
	                'type' => 'default',
                ),
                'module_5' =>  array(
	                'text' => '模块 5',
	                'type' => 'default',
                ),
                'module_6' =>  array(
	                'text' => '模块 6',
	                'type' => 'default',
                ),
                'module_7' =>  array(
	                'text' => '模块 7',
	                'type' => 'default',
                ),
                'module_8' =>  array(
	                'text' => '模块 8',
	                'type' => 'default',
                ),
                'module_9' =>  array(
	                'text' => '模块 9',
	                'type' => 'default',
                ),
                'module_10' =>  array(
	                'text' => '模块 10',
	                'type' => 'default',
                ),
                'module_11' =>  array(
	                'text' => '模块 11',
	                'type' => 'default',
                ),
                'module_12' =>  array(
	                'text' => '模块 12',
	                'type' => 'default',
                ),
                'module_13' =>  array(
	                'text' => '模块 13',
	                'type' => 'default',
                ),
                'module_14' =>  array(
	                'text' => '模块 14',
	                'type' => 'default',
                ),
                'module_15' =>  array(
	                'text' => '模块 15',
	                'type' => 'default',
                ),
                'module_16' =>  array(
	                'text' => '模块 16',
	                'type' => 'default',
                ),
            ),
            '模块MX和其它区块 - 文章标题' => array (
	            'other_modules_general' => array(
		            'text' => '常规字体',
		            'type' => 'general_setting',
	            ),
                'module_mx1' =>  array(
	                'text' => '模块 MX1',
	                'type' => 'default',
                ),
                'module_mx2' =>  array(
	                'text' => '模块 MX2',
	                'type' => 'default',
                ),
	            'module_mx3' =>  array(
	                'text' => '模块 MX3',
	                'type' => 'default',
                ),
                'module_mx4' =>  array(
	                'text' => '模块 MX4',
	                'type' => 'default',
                ),
                'module_mx7' =>  array(
	                'text' => '模块 MX7',
	                'type' => 'default',
                ),
                'module_mx8' =>  array(
	                'text' => '模块 MX8',
	                'type' => 'default',
                ),
                'news_ticker' =>  array(
	                'text' => '新闻速递',
	                'type' => 'default',
                ),
                'slider_1columns' =>  array(
	                'text' => '1列幻灯片',
	                'type' => 'default',
                ),
                'slider_2columns' =>  array(
	                'text' => '2列幻灯片',
	                'type' => 'default',
                ),
                'slider_3columns' =>  array(
	                'text' => '3列幻灯片',
	                'type' => 'default',
                ),
                'big_grid_tiny' =>  array(
	                'text' => '大网格 - 微型图片',
	                'type' => 'default',
                ),
                'big_grid_small' =>  array(
	                'text' => '大网格 - 小图片',
	                'type' => 'default',
                ),
                'big_grid_medium' =>  array(
	                'text' => '大网格 - 中图片',
	                'type' => 'default',
                ),
                'big_grid_big' =>  array(
	                'text' => '大网格 - 大图片',
	                'type' => 'default',
                ),
                'homepage_post' =>  array(
	                'text' => '首页文章',
	                'type' => 'default',
                ),
            ),
            '文章标题' => array (
	            'post_general' => array(
		            'text' => '常规字体',
		            'type' => 'general_setting',
	            ),
	            'post_title' =>  array(
	                'text' => '默认模板',
	                'type' => 'default',
                ),
                'post_title_style1' =>  array(
	                'text' => '风格1模板',
	                'type' => 'default',
                ),
                'post_title_style2' =>  array(
	                'text' => '风格2模板',
	                'type' => 'default',
                ),
                'post_title_style3' =>  array(
	                'text' => '风格3模板',
	                'type' => 'default',
                ),
                'post_title_style4' =>  array(
	                'text' => '风格4模板',
	                'type' => 'default',
                ),
                'post_title_style5' =>  array(
	                'text' => '风格5模板',
	                'type' => 'default',
                ),
                'post_title_style6' =>  array(
	                'text' => '风格6模板',
	                'type' => 'default',
                ),
                'post_title_style7' =>  array(
	                'text' => '风格7模板',
	                'type' => 'default',
                ),
                'post_title_style8' => array(
	                'text' => '风格8模板',
	                'type' => 'default',
                ),
                'post_title_style9' =>  array(
	                'text' => '风格9模板',
	                'type' => 'default',
                ),
                'post_title_style10' =>  array(
	                'text' => '风格10模板',
	                'type' => 'default',
                ),
                'post_title_style11' =>  array(
	                'text' => '风格11模板',
	                'type' => 'default',
                ),
                'post_title_style12' =>  array(
                    'text' => '风格12模板',
                    'type' => 'default',
                ),
                'post_title_style13' =>  array(
                    'text' => '风格13模板',
                    'type' => 'default',
                ),
            ),
            '文章内容' => array (
	            'post_content' =>  array(
	                'text' => '文章内容',
	                'type' => 'default',
                ),
                'post_blockquote' =>  array(
	                'text' => '默认引用',
	                'type' => 'default',
                ),
                'post_box_quote' =>  array(
	                'text' => '框引用',
	                'type' => 'default',
                ),
                'post_pull_quote' =>  array(
	                'text' => '大段引用',
	                'type' => 'default',
                ),
	            'post_lists' =>  array(
		            'text' => '列表',
		            'type' => 'default',
	            ),
                'post_h1' =>  array(
	                'text' => 'H1',
	                'type' => 'default',
                ),
                'post_h2' =>  array(
	                'text' => 'H2',
	                'type' => 'default',
                ),
                'post_h3' =>  array(
	                'text' => 'H3',
	                'type' => 'default',
                ),
                'post_h4' =>  array(
	                'text' => 'H4',
	                'type' => 'default',
                ),
                'post_h5' =>  array(
	                'text' => 'H5',
	                'type' => 'default',
                ),
                'post_h6' =>  array(
	                'text' => 'H6',
	                'type' => 'default',
                ),
            ),
            '文章元素' => array (
	            'post_category' =>  array(
	                'text' => '分类标签',
	                'type' => 'default',
                ),
                'post_author' =>  array(
	                'text' => '作者',
	                'type' => 'default',
                ),
                'post_date' =>  array(
	                'text' => '日期',
	                'type' => 'default',
                ),
                'post_comment' =>  array(
	                'text' => '查看和评论',
	                'type' => 'default',
                ),
                'via_source_tag' =>  array(
	                'text' => '通过/来源/标签',
	                'type' => 'default',
                ),
                'post_next_prev_text' =>  array(
	                'text' => '下一个/上一个文字',
	                'type' => 'default',
                ),
                'post_next_prev' =>  array(
	                'text' => '下一个/上一个文章标题',
	                'type' => 'default',
                ),
                'box_author_name' =>  array(
	                'text' => '框作者名字',
	                'type' => 'default',
                ),
                'box_author_url' =>  array(
	                'text' => '框作者网址',
	                'type' => 'default',
                ),
                'box_author_description' =>  array(
	                'text' => '框作者描述',
	                'type' => 'default',
                ),
                'post_related' =>  array(
	                'text' => '相关文章标题',
	                'type' => 'default',
                ),
                'post_share' =>  array(
	                'text' => '选择文字',
	                'type' => 'default',
                ),
                'post_image_caption' =>  array(
	                'text' => '图片字幕',
	                'type' => 'default',
                ),
                'post_subtitle_small' =>  array(
	                'text' => '子标题文章风格默认, 1, 4, 5, 9, 10, 11',
	                'type' => 'default',
                ),
                'post_subtitle_large' =>  array(
	                'text' => '子标题文章风格 2, 3, 6, 7, 8',
	                'type' => 'default',
                ),
            ),
            '页面' => array (
	            'page_title' =>  array(
	                'text' => '页面标题',
	                'type' => 'default',
                ),
                'page_content' =>  array(
	                'text' => '页面内容',
	                'type' => 'default',
                ),
                'page_h1' =>  array(
	                'text' => 'H1',
	                'type' => 'default',
                ),
                'page_h2' =>  array(
	                'text' => 'H2',
	                'type' => 'default',
                ),
                'page_h3' =>  array(
	                'text' => 'H3',
	                'type' => 'default',
                ),
                'page_h4' =>  array(
	                'text' => 'H4',
	                'type' => 'default',
                ),
                'page_h5' =>  array(
	                'text' => 'H5',
	                'type' => 'default',
                ),
                'page_h6' =>  array(
	                'text' => 'H6',
	                'type' => 'default',
                ),
            ),
            '页脚' => array (
	            'footer_text_about' =>  array(
	                'text' => 'LOGO下文字',
	                'type' => 'default',
                ),
                'footer_copyright_text' =>  array(
	                'text' => '版权文字',
	                'type' => 'default',
                ),
                'footer_menu_text' =>  array(
	                'text' => '页脚菜单',
	                'type' => 'default',
                ),
            ),
            '其它' => array (
	            'breadcrumb' =>  array(
	                'text' => '面包屑导航',
	                'type' => 'default',
                ),
                'category_tag' =>  array(
	                'text' => '分类页子分类标签',
	                'type' => 'default',
                ),
                'news_ticker_title' =>  array(
	                'text' => '新闻速递标题',
	                'type' => 'default',
                ),
                'pagination' =>  array(
	                'text' => '页码',
	                'type' => 'default',
                ),
                'dropcap' =>  array(
	                'text' => '下沉',
	                'type' => 'default',
                ),
                'default_widgets' =>  array(
	                'text' => '默认小工具',
	                'type' => 'default',
                ),
                'default_buttons' =>  array(
	                'text' => '默认按钮',
	                'type' => 'default',
                ),
                'woocommerce_products' =>  array(
	                'text' => 'Woocommerce产品标题',
	                'type' => 'default',
                ),
                'woocommerce_product_title' =>  array(
	                'text' => '产品页产品标题',
	                'type' => 'default',
                ),
            ),
            '主体' => array (
	            'body_text' =>  array(
	                'text' => '主体 - 常规字体',
	                'type' => 'default',
                ),
            ),
            'bbPress - 论坛' => array (
	            'bbpress_header' =>  array(
	                'text' => '页眉',
	                'type' => 'default',
                ),
                'bbpress_titles' =>  array(
	                'text' => '论坛和话题标题',
	                'type' => 'default',
                ),
                'bbpress_subcategories' =>  array(
	                'text' => '子分类标题',
	                'type' => 'default',
                ),
                'bbpress_description' =>  array(
	                'text' => '分类描述',
	                'type' => 'default',
                ),
                'bbpress_author' =>  array(
	                'text' => '作者名',
	                'type' => 'default',
                ),
                'bbpress_replies' =>  array(
	                'text' => '回复内容',
	                'type' => 'default',
                ),
                'bbpress_notices' =>  array(
	                'text' => '通知/信息',
	                'type' => 'default',
                ),
                'bbpress_pagination' =>  array(
	                'text' => '页码文字',
	                'type' => 'default',
                ),
                'bbpress_topic' =>  array(
	                'text' => '话题详情',
	                'type' => 'default',
                ),
            ),
        ); // end td_global::$typography_settings_list



        /**
         * the default fonts used by the theme. For a list of fonts ids @see td_fonts::$font_names_google_list
         */
        td_global::$default_google_fonts_list = array (
            '438' => array(
                'css_style_id' => 'google_font_open_sans',
                'url' => td_global::$http_or_https . '://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,400,600,700'
            ),
            '521' => array(
                'css_style_id' => 'google_font_roboto',
                'url' => td_global::$http_or_https . '://fonts.useso.com/css?family=Roboto:500,400italic,700,500italic,400'
            ),
        );




	    /**
	     * the stacks are stored in /includes/stacks
	     * stack_filename (without .txt) => stack_name
	     * @var array
	     */
	    td_global::$demo_list = array (
		    'default' => array(
			    'text' => '默认演示',
			    'folder' => td_global::$get_template_directory . '/includes/demos/default/',
			    'img' => td_global::$get_template_directory_uri . '/includes/demos/default/screenshot.png',
			    'demo_url' => 'http://demo.tagdiv.com/newspaper/',
			    'td_css_generator_demo' => false
		    ),
            'cars' => array(
                'text' => '汽车演示 - <span style=\'color: #4db2ec;\'>新</span>',
                'folder' => td_global::$get_template_directory . '/includes/demos/cars/',
                'img' => td_global::$get_template_directory_uri . '/includes/demos/cars/screenshot.png',
                'demo_url' => 'http://demo.tagdiv.com/newspaper_cars/',
                'td_css_generator_demo' => true
            ),
		    'travel' => array(
			    'text' => '旅游演示 - <span style=\'color: #4db2ec;\'>新</span>',
			    'folder' => td_global::$get_template_directory . '/includes/demos/travel/',
			    'img' => td_global::$get_template_directory_uri . '/includes/demos/travel/screenshot.png',
			    'demo_url' => 'http://demo.tagdiv.com/newspaper_travel/',
			    'td_css_generator_demo' => true
		    ),
		    'health' => array(
			    'text' => '保健与健身演示 - <span style=\'color: #4db2ec;\'>新</span>',
			    'folder' => td_global::$get_template_directory . '/includes/demos/health/',
			    'img' => td_global::$get_template_directory_uri . '/includes/demos/health/screenshot.png',
			    'demo_url' => 'http://demo.tagdiv.com/newspaper_health/',
			    'td_css_generator_demo' => true
		    ),
		    'tech' => array(
			    'text' => '科技演示',
			    'folder' => td_global::$get_template_directory . '/includes/demos/tech/',
			    'img' => td_global::$get_template_directory_uri . '/includes/demos/tech/screenshot.png',
			    'demo_url' => 'http://demo.tagdiv.com/newspaper_tech/',
			    'td_css_generator_demo' => false
		    ),
		    'sport' => array(
			    'text' => '运动演示',
			    'folder' => td_global::$get_template_directory . '/includes/demos/sport/',
			    'img' => td_global::$get_template_directory_uri . '/includes/demos/sport/screenshot.png',
			    'demo_url' => 'http://demo.tagdiv.com/newspaper_sport/',
			    'td_css_generator_demo' => false
		    ),
		    'fashion' => array(
			    'text' => '时尚演示',
			    'folder' => td_global::$get_template_directory . '/includes/demos/fashion/',
			    'img' => td_global::$get_template_directory_uri . '/includes/demos/fashion/screenshot.png',
			    'demo_url' => 'http://demo.tagdiv.com/newspaper_fashion/',
			    'td_css_generator_demo' => false
		    ),
		    'video' => array(
			    'text' => '视频演示',
			    'folder' => td_global::$get_template_directory . '/includes/demos/video/',
			    'img' => td_global::$get_template_directory_uri . '/includes/demos/video/screenshot.png',
			    'demo_url' => 'http://demo.tagdiv.com/newspaper_video/',
			    'td_css_generator_demo' => false
		    ),
		    'blog' => array(
			    'text' => '经典博客演示',
			    'folder' => td_global::$get_template_directory . '/includes/demos/blog/',
			    'img' => td_global::$get_template_directory_uri . '/includes/demos/blog/screenshot.png',
			    'demo_url' => 'http://demo.tagdiv.com/newspaper_classic_blog/',
			    'td_css_generator_demo' => false
		    )
	    );






        if (is_admin()) {


            /**
             * generate the theme panel
             */

            td_global::$all_theme_panels_list =  array (
                'theme_panel' => array (
                    'title' => TD_THEME_NAME . ' - 主题面板',
                    'subtitle' => '版本： ' . TD_THEME_VERSION,
                    'panels' => array (
                        'td-panel-header' => array(
                            'text' => '页眉',
                            'ico_class' => 'td-ico-header',
                            'file' => td_global::$get_template_directory . '/includes/wp_booster/wp-admin/panel/views/td_panel_header.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-footer' => array(
                            'text' => '页脚',
                            'ico_class' => 'td-ico-footer',
                            'file' => td_global::$get_template_directory . '/includes/wp_booster/wp-admin/panel/views/td_panel_footer.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-ads' => array(
                            'text' => '广告',
                            'ico_class' => 'td-ico-ads',
                            'file' => td_global::$get_template_directory . '/includes/panel/views/td_panel_ads.php',
                            'type' => 'in_theme'
                        ),

                        /*  ----------------------------------------------------------------------------
                            layout settings
                         */
                        'td-panel-separator-1' => array(   // LAYOUT SETTINGS Separator
                            'text' => '布局设置',
                            'type' => 'separator'
                        ),
                        'td-panel-template-settings' => array(
                            'text' => '模板设置',
                            'ico_class' => 'td-ico-template',
                            'file' => td_global::$get_template_directory . '/includes/wp_booster/wp-admin/panel/views/td_panel_template_settings.php',
                            'type' => 'in_theme'
                        ),

                        'td-panel-categories' => array(
                            'text' => '分类',
                            'ico_class' => 'td-ico-categories',
                            'file' => td_global::$get_template_directory . '/includes/wp_booster/wp-admin/panel/views/td_panel_categories.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-post-settings' => array(
                            'text' => '文章设置',
                            'ico_class' => 'td-ico-post',
                            'file' => td_global::$get_template_directory . '/includes/wp_booster/wp-admin/panel/views/td_panel_post_settings.php',
                            'type' => 'in_theme'
                        ),


                        /*  ----------------------------------------------------------------------------
                            misc
                         */
                        'td-panel-separator-2' => array( // MISC Separator
                            'text' => '杂项',
                            'type' => 'separator'
                        ),
                        'td-panel-block-style' => array(
                            'text' => '区块设置',
                            'ico_class' => 'td-ico-block',
                            'file' => td_global::$get_template_directory . '/includes/panel/views/td_panel_block_settings.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-background' => array(
                            'text' => '背景',
                            'ico_class' => 'td-ico-background',
                            'file' => td_global::$get_template_directory . '/includes/wp_booster/wp-admin/panel/views/td_panel_background.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-excerpts' => array(
                            'text' => '摘要',
                            'ico_class' => 'td-ico-excerpts',
                            'file' => td_global::$get_template_directory . '/includes/wp_booster/wp-admin/panel/views/td_panel_excerpts.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-translates' => array(
                            'text' => '翻译',
                            'ico_class' => 'td-ico-translation',
                            'file' => td_global::$get_template_directory . '/includes/wp_booster/wp-admin/panel/views/td_panel_translations.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-theme-colors' => array(
                            'text' => '主题颜色',
                            'ico_class' => 'td-ico-color',
                            'file' => td_global::$get_template_directory . '/includes/panel/views/td_panel_theme_colors.php',
                            'type' => 'in_theme'
                        ),

                        'td-panel-theme-fonts' => array(
                            'text' => '主题字体',
                            'ico_class' => 'td-ico-typography',
                            'file' => td_global::$get_template_directory . '/includes/panel/views/td_panel_theme_fonts.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-custom-css' => array(
                            'text' => '自定义CSS',
                            'ico_class' => 'td-ico-css',
                            'file' => td_global::$get_template_directory . '/includes/wp_booster/wp-admin/panel/views/td_panel_custom_css.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-custom-javascript' => array(
                            'text' => '自定义JAVASCRIPT',
                            'ico_class' => 'td-ico-js',
                            'file' => td_global::$get_template_directory . '/includes/wp_booster/wp-admin/panel/views/td_panel_custom_javascript.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-analytics' => array(
                            'text' => '分析',
                            'ico_class' => 'td-ico-analytics',
                            'file' => td_global::$get_template_directory . '/includes/wp_booster/wp-admin/panel/views/td_panel_analytics.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-social-networks' => array(
                            'text' => '社交网络',
                            'ico_class' => 'td-ico-social',
                            'file' => td_global::$get_template_directory . '/includes/wp_booster/wp-admin/panel/views/td_panel_social_networks.php',
                            'type' => 'in_theme'
                        ),
                        'td-panel-cpt-taxonomy' => array(
                            'text' => 'CPT和分类法',
                            'ico_class' => 'td-ico-cpt',
                            'file' => td_global::$get_template_directory . '/includes/wp_booster/wp-admin/panel/views/td_panel_cpt_taxonomy.php',
                            'type' => 'in_theme'
                        ),
                        'td-link-1' => array( // MISC Separator
                            'text' => '导入/导出',
                            'url' => '?page=td_theme_panel&td_page=td_view_import_export_settings',
                            'type' => 'link'
                        )
                    )
                )
            );



	        /*
	         * the list with custom texts of the theme
	         */
            td_global::$td_wp_admin_text_list = array(

	            // the text for wp-admin -> new post -> featured video box. Usually is the text that tells what post templates support video
	            'text_featured_video' => '
	                <div class="td-wpa-info">从Vimeo或Youtube粘贴一个链接，它将嵌入到文章，且缩略用于此文章特色图像。<br/>你需要从上面使用精选视频选择<strong>视频格式</strong></div>
	                <div class="td-wpa-info"><strong>注意：</strong>仅用于这些文章模板：
	                    <ul>
	                        <li>文章风格模板</li>
	                        <li>文章风格 1</li>
	                        <li>文章风格 2</li>
	                        <li>文章风格 9</li>
	                        <li>文章风格 10</li>
	                        <li>文章风格 11</li>
	                    </ul>
	                </div>',

	            // admin panel - header
		        'text_header_logo' => '页眉风格9、风格10和风格11文字logo:',

		        'text_header_logo_description' => '文字LOGO仅用于风格9、风格10和风格11 - 完整菜单 + 文字LOGO。其它页眉风格仅使用图片',

		        'text_header_logo_mobile' => '风格 4, 风格 5, 风格 6, 风格 7, 风格 8 或 风格 12',

		        'text_header_logo_mobile_image' => '140 x 48px',

		        'text_header_logo_mobile_image_retina' => '280 x 96px',

                // what widgets do not work on the smart sidebar
                'text_smart_sidebar_widget_support' => '
                <ul>
                    <li>[tagDiv] 现在趋势</li>
                </ul>
                '
	        );

            /**
             * the tiny mce image style list
             */
            td_global::$tiny_mce_image_style_list = array(
//                'td_zoom_in_image_effect' => array(
//                    'text' => 'Zoom in image effect',
//                    'class' => 'td-scroll-e-image-zoom-in'
//                ),
//                'td_zoom_out_image_effect' => array(
//                    'text' => 'Zoom out image effect',
//                    'class' => 'td-scroll-e-image-zoom-out'
//                ),
//                'td_fixed_image_effect' => array(
//                    'text' => 'Fixed image effect',
//                    'class' => 'td-scroll-e-image-fixed'
//                )
            );



            /**
             * the tiny mce styles
             */

	        td_api_tinymce_formats::add('td_tinymce_item_1',
		        array(
			        'title' => '文字填充'
		        ));

		        td_api_tinymce_formats::add('td_tinymce_item_1_1',
			        array(
				        'parent_id' => 'td_tinymce_item_1',
				        'title' => '文字 ⇠',
				        'block' => 'div',
				        'classes' => 'td-paragraph-padding-0',
				        'wrapper' => true,
			        ));

		        td_api_tinymce_formats::add('td_tinymce_item_1_2',
			        array(
				        'parent_id' => 'td_tinymce_item_1',
				        'title' => '⇢ 文字',
				        'block' => 'div',
				        'classes' => 'td-paragraph-padding-4',
				        'wrapper' => true,
			        ));

		        td_api_tinymce_formats::add('td_tinymce_item_1_3',
			        array(
				        'parent_id' => 'td_tinymce_item_1',
				        'title' => '⇢ 文字 ⇠',
				        'block' => 'div',
				        'classes' => 'td-paragraph-padding-1',
				        'wrapper' => true,
			        ));

		        td_api_tinymce_formats::add('td_tinymce_item_1_4',
			        array(
				        'parent_id' => 'td_tinymce_item_1',
				        'title' => '⇢ 文字 ⇠⇠',
				        'block' => 'div',
				        'classes' => 'td-paragraph-padding-3',
				        'wrapper' => true,
			        ));

		        td_api_tinymce_formats::add('td_tinymce_item_1_5',
			        array(
				        'parent_id' => 'td_tinymce_item_1',
				        'title' => '⇢⇢ 文字 ⇠',
				        'block' => 'div',
				        'classes' => 'td-paragraph-padding-6',
				        'wrapper' => true,
			        ));

		        td_api_tinymce_formats::add('td_tinymce_item_1_6',
			        array(
				        'parent_id' => 'td_tinymce_item_1',
				        'title' => '⇢⇢ 文字 ⇠⇠',
				        'block' => 'div',
				        'classes' => 'td-paragraph-padding-2',
				        'wrapper' => true,
			        ));

		        td_api_tinymce_formats::add('td_tinymce_item_1_7',
			        array(
				        'parent_id' => 'td_tinymce_item_1',
				        'title' => '⇢⇢⇢ 文字 ⇠⇠⇠',
				        'block' => 'div',
				        'classes' => 'td-paragraph-padding-5',
				        'wrapper' => true,
		            ));


	        td_api_tinymce_formats::add('td_tinymce_item_2',
		        array(
			        'title' => '文字滚动效果'
		        ));

		        td_api_tinymce_formats::add('td_tinymce_item_2_1',
			        array(
				        'parent_id' => 'td_tinymce_item_2',
				        'title' => '淡入灰色背景',
				        'selector' => 'p, h3, blockquote',
				        'classes' => 'td-scroll-e-text-1 td-scroll-effect',
				        'icon' => 'td-test-icons'
			        ));

		        td_api_tinymce_formats::add('td_tinymce_item_2_2',
			        array(
				        'parent_id' => 'td_tinymce_item_2',
				        'title' => '淡入文字颜色边框',
				        'selector' => 'p, h3, blockquote',
				        'classes' => 'td-scroll-e-text-2 td-scroll-effect',
				        'icon' => 'td-test-icons'
			        ));

	        td_api_tinymce_formats::add('td_tinymce_item_3',
		        array(
			        'title' => '箭头列表',
			        'selector' => 'ul',
			        'classes' => 'td-arrow-list'
		        ));


	        td_api_tinymce_formats::add('td_blockquote',
		        array(
			        'title' => '引用'
		        ));

		        td_api_tinymce_formats::add('td_blockquote_1',
			        array(
				        'parent_id' => 'td_blockquote',
				        'title' => '左引用',
				        'block' => 'blockquote',
				        'classes' => 'td_quote td_quote_left',
				        'wrapper' => true,
			        ));

		        td_api_tinymce_formats::add('td_blockquote_2',
			        array(
				        'parent_id' => 'td_blockquote',
				        'title' => '右引用',
				        'block' => 'blockquote',
				        'classes' => 'td_quote td_quote_right',
				        'wrapper' => true,
			        ));

		        td_api_tinymce_formats::add('td_blockquote_3',
			        array(
				        'parent_id' => 'td_blockquote',
				        'title' => '中间框引用',
				        'block' => 'blockquote',
				        'classes' => 'td_quote_box td_box_center',
				        'wrapper' => true,
			        ));

		        td_api_tinymce_formats::add('td_blockquote_4',
			        array(
				        'parent_id' => 'td_blockquote',
				        'title' => '左框引用',
				        'block' => 'blockquote',
				        'classes' => 'td_quote_box td_box_left',
				        'wrapper' => true,
			        ));

		        td_api_tinymce_formats::add('td_blockquote_5',
			        array(
				        'parent_id' => 'td_blockquote',
				        'title' => '右框引用',
				        'block' => 'blockquote',
				        'classes' => 'td_quote_box td_box_right',
				        'wrapper' => true,
			        ));


		        td_api_tinymce_formats::add('td_blockquote_6',
			        array(
				        'parent_id' => 'td_blockquote',
				        'title' => '中间大段引用',
				        'block' => 'blockquote',
				        'classes' => 'td_pull_quote td_pull_center',
				        'wrapper' => true,
			        ));

		        td_api_tinymce_formats::add('td_blockquote_7',
			        array(
				        'parent_id' => 'td_blockquote',
				        'title' => '左侧大段引用',
				        'block' => 'blockquote',
				        'classes' => 'td_pull_quote td_pull_left',
				        'wrapper' => true,
			        ));

		        td_api_tinymce_formats::add('td_blockquote_8',
			        array(
				        'parent_id' => 'td_blockquote',
				        'title' => '左侧大段引用',
				        'block' => 'blockquote',
				        'classes' => 'td_pull_quote td_pull_right',
				        'wrapper' => true,
			        ));


            // two columns text
            td_api_tinymce_formats::add('td_text_columns',
                array(
                    'title' => '文字列'
                ));
                td_api_tinymce_formats::add('td_text_columns_0',
                    array(
                        'parent_id' => 'td_text_columns',
                        'title' => '二列',
                        'block' => 'div',
                        'classes' => 'td_text_columns_two_cols',
                        'wrapper' => true,
                    ));

	        // dropcap
	        td_api_tinymce_formats::add('td_dropcap',
		        array(
			        'title' => '下沉'
		        ));
		        td_api_tinymce_formats::add('td_dropcap_0',
			        array(
				        'parent_id' => 'td_dropcap',
				        'title' => '框',
				        'classes' => 'dropcap',
				        'inline' => 'span'
			        ));
		        td_api_tinymce_formats::add('td_dropcap_1',
			        array(
				        'parent_id' => 'td_dropcap',
				        'title' => '圈',
				        'classes' => 'dropcap dropcap1',
				        'inline' => 'span'
			        ));
		        td_api_tinymce_formats::add('td_dropcap_2',
			        array(
				        'parent_id' => 'td_dropcap',
				        'title' => '正常',
				        'classes' => 'dropcap dropcap2',
				        'inline' => 'span'
			        ));
		        td_api_tinymce_formats::add('td_dropcap_3',
			        array(
				        'parent_id' => 'td_dropcap',
				        'title' => '粗',
				        'classes' => 'dropcap dropcap3',
				        'inline' => 'span'
			        ));


            // highlighter
            td_api_tinymce_formats::add('td_text_highlight',
                array(
                    'title' => '文字高亮'
                ));
                td_api_tinymce_formats::add('td_text_highlight_0',
                    array(
                        'parent_id' => 'td_text_highlight',
                        'title' => '黑色谴责',
                        'classes' => 'td_text_highlight_0',
                        'inline' => 'span'
                    ));
                td_api_tinymce_formats::add('td_text_highlight_red',
                    array(
                        'parent_id' => 'td_text_highlight',
                        'title' => '红色标记',
                        'classes' => 'td_text_highlight_marker_red td_text_highlight_marker',
                        'inline' => 'span'
                    ));
                td_api_tinymce_formats::add('td_text_highlight_blue',
                    array(
                        'parent_id' => 'td_text_highlight',
                        'title' => '蓝色标记',
                        'classes' => 'td_text_highlight_marker_blue td_text_highlight_marker',
                        'inline' => 'span'
                    ));
            td_api_tinymce_formats::add('td_text_highlight_green',
                array(
                    'parent_id' => 'td_text_highlight',
                    'title' => '绿色标记',
                    'classes' => 'td_text_highlight_marker_green td_text_highlight_marker',
                    'inline' => 'span'
                ));
            td_api_tinymce_formats::add('td_text_highlight_yellow',
                array(
                    'parent_id' => 'td_text_highlight',
                    'title' => '黄色标记',
                    'classes' => 'td_text_highlight_marker_yellow td_text_highlight_marker',
                    'inline' => 'span'
                ));
            td_api_tinymce_formats::add('td_text_highlight_pink',
                array(
                    'parent_id' => 'td_text_highlight',
                    'title' => '粉红标记',
                    'classes' => 'td_text_highlight_marker_pink td_text_highlight_marker',
                    'inline' => 'span'
                ));

			// clear elements
	        td_api_tinymce_formats::add('td_clear_elements',
		        array(
			        'title' => '清除元素',
			        'selector' => 'a,p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img,code,blockquote',
			        'styles' => array(
				        'clear' => 'both'
			        )
		        ));



            td_global::$theme_plugins_list = array(
                array(
                    'name' => 'Visual Composer', // The plugin name
                    'slug' => 'js_composer', // The plugin slug (typically the folder name)
                    'source' => td_global::$get_template_directory_uri . '/includes/plugins/js_composer.zip', // The plugin source
                    'required' => true, // If false, the plugin is only 'recommended' instead of required
                    'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                    'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                    'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                    'external_url' => '', // If set, overrides default API URL and points to an external URL
                    'img' => td_global::$get_template_directory_uri . '/includes/wp_booster/wp-admin/images/plugins/visual-composer.png',
                    'text' => '必装插件',
                    'required_label' => 'required' //the text for required/recommended label - used also as a class for label bg color
                ),
                array(
                    'name' => 'tagDiv social counter', // The plugin name
                    'slug' => 'td-social-counter', // The plugin slug (typically the folder name)
                    'source' => td_global::$get_template_directory_uri . '/includes/plugins/td-social-counter.zip', // The plugin source
                    'required' => false, // If false, the plugin is only 'recommended' instead of required
                    'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                    'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                    'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                    'external_url' => '', // If set, overrides default API URL and points to an external URL
                    'img' => td_global::$get_template_directory_uri . '/includes/wp_booster/wp-admin/images/plugins/social.png',
                    'text' => '<a href="http://forum.tagdiv.com/tagdiv-social-counter-tutorial/" target="_blank">阅读更多</a>',
                    'required_label' => 'optional' //the text for required/recommended label - used also as a class for label bg color
                ),
                array(
                    'name' => 'Revolution slider v4.6', // The plugin name
                    'slug' => 'revslider', // The plugin slug (typically the folder name)
                    'source' => td_global::$get_template_directory_uri . '/includes/plugins/revslider.zip', // The plugin source
                    'required' => false, // If false, the plugin is only 'recommended' instead of required
                    'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                    'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                    'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                    'external_url' => '', // If set, overrides default API URL and points to an external URL
                    'img' => td_global::$get_template_directory_uri . '/includes/wp_booster/wp-admin/images/plugins/rev-slider.png',
                    'text' => '<a href="http://forum.tagdiv.com/how-to-install-revolution-slider-v5/" target="_blank">如何安装 v5</a>',
                    'required_label' => 'optional' //the text for required/recommended label - used also as a class for label bg color
                ),
	            array(
		            'name' => 'tagDiv Woo Invoice', // The plugin name
		            'slug' => 'td-woo-invoice', // The plugin slug (typically the folder name)
		            'source' => td_global::$get_template_directory_uri . '/includes/plugins/td-woo-invoice.zip', // The plugin source
		            'required' => false, // If false, the plugin is only 'recommended' instead of required
		            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		            'external_url' => '', // If set, overrides default API URL and points to an external URL
                    'img' => td_global::$get_template_directory_uri . '/includes/wp_booster/wp-admin/images/plugins/invoice.png',
                    'text' => '<a href="http://forum.tagdiv.com/tagdiv-woo-invoice-plugin/" target="_blank">阅读更多</a>',
		            'required_label' => 'optional' //the text for required/recommended label - used also as a class for label bg color
	            ),
	            array(
		            'name' => 'tagDiv Woo Label', // The plugin name
		            'slug' => 'td-woo-label', // The plugin slug (typically the folder name)
		            'source' => td_global::$get_template_directory_uri . '/includes/plugins/td-woo-label.zip', // The plugin source
		            'required' => false, // If false, the plugin is only 'recommended' instead of required
		            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		            'external_url' => '', // If set, overrides default API URL and points to an external URL
		            'img' => td_global::$get_template_directory_uri . '/includes/wp_booster/wp-admin/images/plugins/label.png',
                    'text' => '<a href="http://forum.tagdiv.com/tagdiv-woo-label-plugin/" target="_blank">阅读更多</a>',
		            'required_label' => 'optional' //the text for required/recommended label - used also as a class for label bg color
	            )
            );




        }
    }



	/**
	 * the filter array (used by blocks and by the loop filters)
	 * @return array
	 */
	static function get_map_filter_array ($group = '筛选') {
		return array(
			array(
				"param_name" => "category_id",
				"type" => "dropdown",
				"value" => td_util::get_category2id_array(),
				"heading" => '分类筛选：',
				"description" => "单个分类筛选。如果你想筛选多个分类，使用 '多个分类筛选' 并留此为默认",
				"holder" => "div",
				"class" => "",
                'group' => $group
			),
			array(
				"param_name" => "category_ids",
				"type" => "textfield",
				"value" => '',
				"heading" => '多分类筛选：',
				"description" => "按ID筛选多个分类。用逗号分隔分类ID（13,23,18）。要从此区块排除分类，使用 '-' 添加它们 (例如： -9, -10)",
				"holder" => "div",
				"class" => "",
                'group' => $group
			),
			array(
				"param_name" => "tag_slug",
				"type" => "textfield",
				"value" => '',
				"heading" => '按标签别名筛选：',
				"description" => "要筛选多个标签别名，用逗号分隔标签别名 (例如： tag1,tag2,tag3)",
				"holder" => "div",
				"class" => "",
                'group' => $group
			),
			array(
				"param_name" => "autors_id",
				"type" => "textfield",
				"value" => '',
				"heading" => "多个作者筛选：",
				"description" => "按ID筛选多个作者。用逗号分隔作者ID（例如：13,23,18）.",
				"holder" => "div",
				"class" => "",
                'group' => $group
			),
            array(
                "param_name" => "installed_post_types",
                "type" => "textfield",
                "value" =>  '',//tdUtil::create_array_installed_post_types(),
                "heading" => '文章类型：',
                "description" => "按文章类型筛选。用法：文章、作者、页面、事件 - 写1或更多文章类型用逗号分隔",
                "holder" => "div",
                "class" => "",
                'group' => $group
            ),
			array(
				"param_name" => "sort",
				"type" => "dropdown",
				"value" => array (
					'- 最新 -' => '',
					'随机文章今天' => 'random_today' ,
					'随机文章最新7天' => 'random_7_day' ,
					'字母 A -> Z' => 'alphabetical_order',
					'热门 (所有时间)' => 'popular',
					'热门 (整站) - jetpack + stats module required' => 'jetpack_popular_2',
					'热门 (最后7天) - theme counter (enable from panel)' => 'popular7',
					'精选' => 'featured',
					'评分最高 (点评)' => 'review_high',
					'随机文章' => 'random_posts',
					'最多评论' => 'comment_count'
				),
				"heading" => '排序顺序：',
				"description" => "如何排序文章。注意，热门（最后7天）选项受缓存插件和CDN的影响。热门文章推荐 jetpack (24-48小时) 方法",
				"holder" => "div",
				"class" => "",
                'group' => $group
			),
            array(
				"param_name" => "limit",
				"type" => "textfield",
				"value" => '5',
				"heading" => '限制文章数：',
				"description" => "如果字段为空，限制文章数将为Wordpress设置 -> 阅读 的数量",
				"holder" => "div",
				"class" => ""
			),
			array(
				"param_name" => "offset",
				"type" => "textfield",
				"value" => '',
				"heading" => '偏移文章：',
				"description" => "一个偏移数量开始。如果区块显示5个文章在这一个之前，你可以从第6个文章开始（使用偏移5）",
				"holder" => "div",
				"class" => ""
			)
		);//end generic array
	}//end get_map function


    static function get_map_block_pagination_array() {
        return array (
            array(
                "param_name" => "ajax_pagination",
                "type" => "dropdown",
                "value" => array('- 无页码 -' => '', '上一个下一个ajax' => 'next_prev', '加载更多按钮' => 'load_more', '无限加载' => 'infinite'),
                "heading" => '页码：',
                "description" => "我们的区块支持页码.",
                "holder" => "div",
                "class" => "",
                'group' => '页码'
            ),

            array(
                "param_name" => "ajax_pagination_infinite_stop",
                "type" => "textfield",
                "value" => '',
                "heading" => "无限加载在x页后显示'加载更多'：",
                "description" => "仅为无限加载页码：在x页后显示'加载更多'按钮。当无限加载为ajax页码设置时，此处留空将永远加载文章",
                "holder" => "div",
                "class" => "",
                'group' => '页码'
            )
        );
    }


    static function get_map_block_ajax_filter_array() {
        return array(
            //custom filter types
            array(
                "param_name" => "td_ajax_filter_type", //this is used to build the filter list (for example a list of categories from the id-s bellow)
                "type" => "dropdown",
                "value" => array('- 无下拉ajax筛选 -' => '', '按分类筛选' => 'td_category_ids_filter', '按作者筛选' => 'td_author_ids_filter', '按标签别名筛选' => 'td_tag_slug_filter', '按热门筛选（精选｜所有时间热门）' => 'td_popularity_filter_fa'),
                "heading" => 'Ajax下拉 - 筛选类型：',
                "description" => "显示ajax下拉筛选。ajax筛选（除了热门）需要一个额外的参数。如果没有在下面输入ID，筛选将显示所有可用项目（例如：所有作者、所有分类等。。。。）",
                "holder" => "div",
                "class" => "",
                "group" => "Ajax筛选"
            ),

            //filter by ids
            array(
                "param_name" => "td_ajax_filter_ids", //the ids that we will show in the list
                "type" => "textfield",
                "value" => '',
                "heading" => 'Ajax下拉 - 显示以下ID：',
                "description" => "ajax下拉仅显示在这里输入的逗号分隔的内容（作者ID、分类ID或标签别名）",
                "holder" => "div",
                "class" => "",
                "group" => "Ajax筛选"
            ),

            //default pull down text
            array(
                "param_name" => "td_filter_default_txt",
                "type" => "textfield",
                "value" => 'All',
                "heading" => 'Ajax下拉 - 筛选默认文字',
                "description" => "从下拉第一项目的默认文字。第一个项目显示默认区块设置（从第一个选项卡设置）",
                "holder" => "div",
                "class" => "",
                "group" => "Ajax筛选"
            ),

            array(
                "param_name" => "td_ajax_preloading",  //preloader settings
                "type" => "dropdown",
                "value" => array('- 无预载 -' => '', '优化预载' => 'preload', '预载所有' => 'preload_all'),
                "heading" => 'Ajax 下拉 - 内容预载：',
                "description" => "当用户从下拉点击ajax筛选时，显示内容在每个页面视图预载。警告：此功能会消耗服务器上更多的资源。",
                "holder" => "div",
                "class" => "",
                "group" => "Ajax筛选"
            ),

        );
    }



	/**
	 * This array is used only by blocks that have loops + title (it is merged with the array from get_map_filter_array)
	 * @return array
	 */
	static function get_map_block_general_array() {
		return array(
			// title settings
			array(
				"param_name" => "custom_title",
				"type" => "textfield",
				"value" => "区块标题",
				"heading" => '自定义此区块标题：',
				"description" => "可选 - 此区块标题，如果留空区块将没有标题",
				"holder" => "div",
				"class" => ""
			),
			array(
				"param_name" => "custom_url",
				"type" => "textfield",
				"value" => "",
				"heading" => '标题网址：',
				"description" => "可选 - 当选中区块标题时，这是自定义网址",
				"holder" => "div",
				"class" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => '标题文字颜色',
				"param_name" => "header_text_color",
				"value" => '',
				"description" => '可选 - 选择此区块自定义标题文字颜色'
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => '标题背景颜色',
				"param_name" => "header_color",
				"value" => '',
				"description" => '可选 - 选择此区块自定义标题颜色'
			)

		);//end generic array
	}




    /**
     * modify the blocks params for big grids
     * @return array
     */
    public static function td_block_big_grid_params() {
        $map_filter_array = self::get_map_filter_array();

        // make the grid styles drop down
        $td_grid_style_drop_down = array(
            "param_name" => "td_grid_style",
            "type" => "dropdown",
            "value" => array(),
            "heading" => "大网格风格：",
            "description" => "每个大网格有不同的风格。此选项将更改网格外观（包括悬停效果）",
            "holder" => "div",
            "class" => ""
        );
        foreach (td_global::$big_grid_styles_list as $big_grid_id => $params) {
            $td_grid_style_drop_down['value'][$big_grid_id] = $params['text'];
        }

        // add the grid styles drop down at the top
        array_unshift($map_filter_array, array(
            "param_name" => "td_grid_style",
            "type" => "dropdown",
            "value" => array(
                '网格风格 1' => 'td-grid-style-1',
                '网格风格 2' => 'td-grid-style-2',
                '网格风格 3' => 'td-grid-style-3',
                '网格风格 4' => 'td-grid-style-4',
                '网格风格 5' => 'td-grid-style-5'
            ),
            "heading" => "大网格风格：",
            "description" => "每个大网格有不同的风格。此选项将更改网格外观（包括悬停效果）",
            "holder" => "div",
            "class" => ""
        ));

        $map_filter_array = td_util::vc_array_remove_params($map_filter_array, array(
            'limit'
        ));

        return $map_filter_array;
    }


    /**
     * Map array for trending now
     * @return array VC_MAP params
     */
    private static function td_block_trending_now_params() {
        $map_block_array = self::get_map_filter_array();

        //move on the first position the new filter array - array_unshift is used to keep the 0 1 2 index. array_marge does not do that
        array_unshift(
            $map_block_array,
            array(
                "param_name" => "navigation",
                "type" => "dropdown",
                "value" => array('Auto' => '', 'Manual' => 'manual'),
                "heading" => '导航：',
                "description" => "如果设置为`自动`将设置`新闻速递`区块为自动开始旋转文章",
                "holder" => "div",
                "class" => ""
            ),

            array(
                "param_name" => "style",
                "type" => "dropdown",
                "value" => array('Default' => '', 'Style 2' => 'style2'),
                "heading" => '风格：',
                "description" => "`新闻速递`框风格",
                "holder" => "div",
                "class" => ""
            ),

	        array(
		        "type" => "colorpicker",
		        "holder" => "div",
		        "class" => "",
		        "heading" => '标题文字颜色',
		        "param_name" => "header_text_color",
		        "value" => '',
		        "description" => '可选 - 为此区块选择自定义标题文字颜色'
	        ),

	        array(
		        "type" => "colorpicker",
		        "holder" => "div",
		        "class" => "",
		        "heading" => '标题背景颜色',
		        "param_name" => "header_color",
		        "value" => '',
		        "description" => '可选 - 为此区块选择自定义标题背景颜色'
	        )
        );

        return $map_block_array;
    }


    /**
     * Map array for td_homepage_full_1_params
     * @return array VC_MAP params
     */
    private static function td_homepage_full_1_params() {
        $temp_array_filter = self::get_map_filter_array('');
        $temp_array_filter = td_util::vc_array_remove_params($temp_array_filter, array(
            'limit',
            'offset'
        ));

        return $temp_array_filter;
    }


    /**
     * Map array for sliders
     * @return array VC_MAP params
     */
    private static function td_slide_params() {
        $map_block_array = self::get_map_block_general_array();

        // remove some of the params that are not needed for the slide
        $map_block_array = td_util::vc_array_remove_params($map_block_array, array(
            'border_top',
            'ajax_pagination',
            'ajax_pagination_infinite_stop'
        ));

        // add some more
        $temp_array_merge = array_merge(
            array(
                array(
                    "param_name" => "autoplay",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => '自动播放幻灯片（X秒）',
                    "description" => "留空禁用自动播放",
                    "holder" => "div",
                    "class" => ""
                )
            ),
            self::get_map_filter_array(),
            $map_block_array
        );
        return $temp_array_merge;
    }


	private static function td_block_big_grid_slide_params() {
		$params = array_merge(self::td_block_big_grid_params(),
			array(
				array(
					"param_name" => "autoplay",
					"type" => "textfield",
					"value" => '',
					"heading" => '自动播放幻灯片（X秒）',
					"description" => "留空禁用自动播放",
					"holder" => "div",
					"class" => ""
				),
				array(
					"param_name" => "limit",
					"type" => "textfield",
					"value" => 4,
					"heading" => __("限制文章数：", TD_THEME_NAME),
					"description" => "",
					"holder" => "div",
					"class" => ""
				)));

//		array_shift($params);

//		array_unshift($params, array(
//			"param_name" => "td_grid_style",
//			"type" => "dropdown",
//			"value" => array(
//				'Grid style 4' => 'td-grid-style-4',
//			),
//			"heading" => "Available big grid style for this plugin:",
//			"description" => "",
//			"holder" => "div",
//			"class" => ""
//		));

		return $params;
	}



    /**
     * hook up, is called at EOF
     */
    static function hook() {
        add_action('td_global_after', array('td_wp_booster_config', 'td_global_after'), 9); //we run on 9 priority to allow plugins to updage_key our apis while using the default priority of 10
    }
}

td_wp_booster_config::hook();