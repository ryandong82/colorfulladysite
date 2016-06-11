<!-- HEADER STYLE -->
<?php echo td_panel_generator::box_start('页眉风格'); ?>


    <!-- HEADER STYLE -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">页眉风格</span>
            <p>选择的顺序将安排页眉元素</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::radio_button_control(array(
                'ds' => 'td_option',
                'option_id' => 'tds_header_style',
                'values' => td_api_header_style::_helper_generate_tds_header_style()
            ));
            ?>
        </div>
    </div>


<?php echo td_panel_generator::box_end();?>




<!-- TOP BAR -->
<?php echo td_panel_generator::box_start('顶栏', false); ?>


    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <p>
            顶栏是黑色顶部菜单。当你想添加<i>登录选项、社交图标</i>和页面，像 <i>关于我们、联系我们等..</i>是非常有用的.
            如果你是高级用户，并希望对它进行定制或注册新的顶栏布局，看看我们的<a target="_blank" href="http://forum.tagdiv.com/api-top-bar-template-introduction/">顶栏模板API</a>
            </p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

    <!-- Top bar: enable disable -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">启用顶栏</span>
            <p>隐藏或显示顶栏</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_top_bar',
                'true_value' => '',
                'false_value' => 'hide_top_bar'
            ));
            ?>
        </div>
    </div>



    <?php if (count(td_api_top_bar_template::get_all()) >  0 ) { ?>
        <!-- Top bar template -->
        <div class="td-box-row">
            <div class="td-box-description">
                <span class="td-box-title">顶栏布局</span>
                <p>如何排序顶栏项目</p>
            </div>
            <div class="td-box-control-full">
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_top_bar_template',
                    'values' => td_api_top_bar_template::_helper_to_panel_values()
                ));
                ?>
            </div>
        </div>
    <?php } ?>



<div class="td-box-section-separator"></div>



    <!-- Top menu: enable disable -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示顶部菜单</span>
            <p>隐藏或显示顶部菜单。要隐藏社交图标：页眉 ⇢ 社交网络</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_top_menu',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>


    <!-- Top menu: select menu -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">选择顶部菜单</span>
            <p>选择顶部菜单</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::dropdown(array(
                'ds' => 'wp_theme_menu_spot',
                'option_id' => 'top-menu',
                'values' => td_panel_generator::get_user_created_menus()
            ));
            ?>
        </div>
    </div>



<div class="td-box-section-separator"></div>



    <!-- Social networks: enable disable -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示社交图标</span>
            <p>启用 / 禁用顶部菜单社交网络</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'td_social_networks_show',
                'true_value' => 'show',
                'false_value' => ''
            ));
            ?>
        </div>
    </div>



<div class="td-box-section-separator"></div>



    <!-- Sign In / Join: enable disable -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示登录 / 加入</span>
            <p>显示或隐藏登录 / 注册链接（默认隐藏）</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_login_sign_in_widget',
                'true_value' => 'show',
                'false_value' => ''
            ));
            ?>
        </div>
    </div>



<div class="td-box-section-separator"></div>


    <!-- Date: enable disable -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示日期</span>
            <p>隐藏或显示顶部菜单日期</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_data_top_menu',
                'true_value' => 'show',
                'false_value' => ''
            ));
            ?>
        </div>
    </div>



    <!-- Date: format -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">日期格式</span>
            <p>默认值：l, F j, Y. <a href="http://php.net/manual/en/function.date.php">阅读更多</a> 关于日期格式（它与php日期函数相同）</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::input(array(
                'ds' => 'td_option',
                'option_id' => 'tds_data_time_format'
            ));
            ?>
        </div>
    </div>


<?php echo td_panel_generator::box_end();?>


<!-- MAIN MENU -->
<?php echo td_panel_generator::box_start('主菜单', false); ?>

    <!-- MAIN MENU -->
    <div class="td-box-row">
        <div class="td-box-description">
        <span class="td-box-title">页眉菜单 (主要)</span>
        <p>为主页眉部分选择菜单</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::dropdown(array(
                'ds' => 'wp_theme_menu_spot',
                'option_id' => 'header-menu',
                'values' => td_panel_generator::get_user_created_menus()
            ));
            ?>
        </div>
    </div>

    <!-- Mega menu preload -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">大菜单预载</span>
            <p>为所有大菜单预载内容。这提供了更好的用户体验，但有性能损失 - <a href="http://forum.tagdiv.com/what-is-ajax-preloading/" target="_blank">阅读更多</a></p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::radio_button_control(array(
                'ds' => 'td_option',
                'option_id' => 'tds_mega_menu_ajax_preloading',
                'values' => array (
                    array('text' => '<strong>不预载</strong> - 默认', 'val' => ''),
                    array('text' => '<strong>优化预载</strong>', 'val' => 'preload'),
                    array('text' => '<strong>预载所有 </strong>', 'val' => 'preload_all')
                )
            ));
            ?>
        </div>
    </div>

    <div class="td-box-section-separator"></div>

    <!-- STICKY MENU -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">粘性菜单</span>
            <p>如何在滚动显示页眉菜单</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::radio_button_control(array(
                'ds' => 'td_option',
                'option_id' => 'tds_snap_menu',
                'values' => array (
                    array('text' => '<strong>正常菜单</strong> - (无粘性)', 'val' => ''),
                    array('text' => '<strong>始终粘性</strong> - 停留在页面顶部', 'val' => 'snap'),
                    array('text' => '<strong>智能捕捉 </strong> - (手机)', 'val' => 'smart_snap_mobile'),
                    array('text' => '<strong>智能捕捉 </strong> - (始终)', 'val' => 'smart_snap_always'),
                )
            ));
            ?>
        </div>
    </div>

	<!-- SHOW THE MOBILE LOGO ON THE STICKY MENU -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title">粘性菜单LOGO</span>
			<p>显示/隐藏粘性菜单LOGO</p>
			<p><strong>注意：</strong>如果你选择<strong>手机logo</strong>，在手机logo部分上传logo</p>
		</div>
		<div class="td-box-control-full">
			<?php
			echo td_panel_generator::radio_button_control(array(
				'ds' => 'td_option',
				'option_id' => 'tds_logo_on_sticky',
				'values' => array (
					array('text' => '<strong>禁用</strong>', 'val' => ''),
					array('text' => '<strong>页眉 logo </strong> - 显示页眉 logo', 'val' => 'show_header_logo'),
					array('text' => '<strong>手机 logo </strong> - 显示手机 logo', 'val' => 'show'),
				)
			));
			?>
		</div>
	</div>

<?php echo td_panel_generator::box_end();?>


<!-- LOGO -->
<?php echo td_panel_generator::box_start('Logo 和收藏图标', false); ?>

    <!-- LOGO UPLOAD -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">LOGO上传</span>
            <p>上传您的logo (272 x 90px) .png 或 .jpg</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::upload_image(array(
                'ds' => 'td_option',
                'option_id' => 'tds_logo_upload'
            ));
            ?>
        </div>
    </div>

    <!-- RETINA LOGO UPLOAD -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">视网膜LOGO上传</span>
            <p>上传视网膜logo (544 x 180px) .png 或 .jpg. </p>
            <ul>
                <li>如果你不设置任何视网膜logo，网站将在视网膜屏幕加载正常logo</li>
                <li>视网膜logo与正常logo相同文件格式</li>
            </ul>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::upload_image(array(
                'ds' => 'td_option',
                'option_id' => 'tds_logo_upload_r'
            ));
            ?>
        </div>
    </div>


    <!-- FAVICON -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">收藏图标</span>
            <p>可选 - 上传收藏图标图片 <br>(16 x 16px) .png</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::upload_image(array(
                'ds' => 'td_option',
                'option_id' => 'tds_favicon_upload'
            ));
            ?>
        </div>
    </div>


    <!-- Logo ALT attribute -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">LOGO ALT属性</span>
            <p>LOGO <a href="http://www.w3schools.com/tags/att_img_alt.asp" target="_blank">Alt属性</a>。如果logo不能显示，这是代替文字。这对SEO是有用的，一般是网站的名称。</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::input(array(
                'ds' => 'td_option',
                'option_id' => 'tds_logo_alt'
            ));
            ?>
        </div>
    </div>


    <!-- Logo TITLE attribute -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">LOGO标题属性</span>
            <p>LOGO <a href="http://www.w3schools.com/tags/att_global_title.asp" target="_blank">标题属性</a>。此属性指定关于LOGO的额外信息。大多数浏览器将在悬停logo时显示此提示文字.</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::input(array(
                'ds' => 'td_option',
                'option_id' => 'tds_logo_title'
            ));
            ?>
        </div>
    </div>


    <div class="td-box-row" style="margin-top: 85px;">
        <div class="td-box-description td-box-full">
            <span class="td-box-title"><?php echo td_global::$td_wp_admin_text_list['text_header_logo'] ?></span>
            <p><?php echo td_global::$td_wp_admin_text_list['text_header_logo_description'] ?></p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

	<!-- Text LOGO -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title">文字LOGO</span>
			<p>写一个文字logo</p>
		</div>
		<div class="td-box-control-full">
			<?php
			echo td_panel_generator::input(array(
				'ds' => 'td_option',
				'option_id' => 'tds_logo_text',
				'placeholder' => strtoupper(TD_THEME_NAME)
			));
			?>
		</div>
	</div>


	<!-- Text LOGO Tagline -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title">文字LOGO标语</span>
			<p>写一个文字logo的标语</p>
		</div>
		<div class="td-box-control-full">
			<?php
			echo td_panel_generator::input(array(
				'ds' => 'td_option',
				'option_id' => 'tds_tagline_text',
				'placeholder' => '四亩地wordpress汉化主题'
			));
			?>
		</div>
	</div>
<?php echo td_panel_generator::box_end();?>



<!-- LOGO for MOBILE-->
<?php echo td_panel_generator::box_start('移动Logo', false); ?>


    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <p>你可以选择在移动手机和小屏幕加载不同的LOGO。一般的LOGO是小的，所以它适合智能菜单。iPhone, iPad, 三星S3 S4 S5 和很多手机使用视网膜LOGO。</p>
            <p>如果你不通过默认上传任何移动LOGO，将使用上面部分上传的LOGO。当你的LOGO不能在移动设备扩展完善，推荐此选项。</p>
	        <p><strong>注意：</strong>如果你使用<strong>页眉风格：</strong><?php echo td_global::$td_wp_admin_text_list['text_header_logo_mobile'] ?></strong>，不要为手机上传LOGO，这是没有必要的。</p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>



	<!-- LOGO MOBILE -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title">LOGO手机</span>
            <p>上传你的logo</p>
            <p><strong>注意：</strong>最佳移动logo效果大小：<?php echo td_global::$td_wp_admin_text_list['text_header_logo_mobile_image'] ?></p>
		</div>
		<div class="td-box-control-full">
			<?php
			echo td_panel_generator::upload_image(array(
				'ds' => 'td_option',
				'option_id' => 'tds_logo_menu_upload'
			));
			?>
		</div>
	</div>

	<!-- RETINA LOGO MOBILE IN MENU UPLOAD -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title">视网膜LOGO手机</span>
			<p>上传视网膜logo (双倍大小)</p>
            <p><strong>注意：</strong>手机LOGO最佳大小：<?php echo td_global::$td_wp_admin_text_list['text_header_logo_mobile_image_retina'] ?></p>
		</div>
		<div class="td-box-control-full">
			<?php
			echo td_panel_generator::upload_image(array(
				'ds' => 'td_option',
				'option_id' => 'tds_logo_menu_upload_r'
			));
			?>
		</div>
	</div>

<?php echo td_panel_generator::box_end();?>





<!-- iOS Bookmarklet -->
<?php echo td_panel_generator::box_start('iOS书签', false); ?>

    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <p>书签在iOS和安卓工作。当用户添加网站到首页屏幕，手机将从这里下载一个图标（基于屏幕大小和设备类型）且你的网站将在首页屏幕出现图标</p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>



    <!-- iOS bookmarklet 76x76 -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">图片 76 x 76</span>
            <p>上传您的图标 (76 x 76px) .png</p>
        </div>
        <div class="td-box-control-full">
            <?php // ipad mini non retina + ipad 2
            echo td_panel_generator::upload_image(array(
                'ds' => 'td_option',
                'option_id' => 'tds_ios_icon_76'
            ));
            ?>
        </div>
    </div>


    <!-- iOS bookmarklet 114x114 -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">图片 114 x 114</span>
            <p>上传您的图标 (114 x 114px) .png</p>
        </div>
        <div class="td-box-control-full">
            <?php  // iphone retina ios6
            echo td_panel_generator::upload_image(array(
                'ds' => 'td_option',
                'option_id' => 'tds_ios_icon_114'
            ));
            ?>
        </div>
    </div>


    <!-- iOS bookmarklet 120x120 -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">图片 120 x 120</span>
            <p>上传您的图标 (120 x 120px) .png</p>
        </div>
        <div class="td-box-control-full">
            <?php // iphone retina ioS7
            echo td_panel_generator::upload_image(array(
                'ds' => 'td_option',
                'option_id' => 'tds_ios_icon_120'
            ));
            ?>
        </div>
    </div>


    <!-- iOS bookmarklet 144x144 -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">图片 144 x 144</span>
            <p>上传您的图标 (144 x 144px) .png</p>
        </div>
        <div class="td-box-control-full">
            <?php // ipad retina ios6
            echo td_panel_generator::upload_image(array(
                'ds' => 'td_option',
                'option_id' => 'tds_ios_icon_144'
            ));
            ?>
        </div>
    </div>


    <!-- iOS bookmarklet 152x152 -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">图片 152 x 152</span>
            <p>上传您的图标 (152 x 152px) .png</p>
        </div>
        <div class="td-box-control-full">
            <?php // ipad retina ios7
            echo td_panel_generator::upload_image(array(
                'ds' => 'td_option',
                'option_id' => 'tds_ios_icon_152'
            ));
            ?>
        </div>
    </div>


<?php echo td_panel_generator::box_end();?>

