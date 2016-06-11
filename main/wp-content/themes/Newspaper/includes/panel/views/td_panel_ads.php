<?php
//google ad list sizes
$td_google_ad_list_sizes = array(
    array('text' => '自动' , 'val' => ''),
    array('text' => '120 x 90' , 'val' => '120 x 90'),
    array('text' => '120 x 240' , 'val' => '120 x 240'),
    array('text' => '120 x 600' , 'val' => '120 x 600'),
    array('text' => '125 x 125' , 'val' => '125 x 125'),
    array('text' => '160 x 90' , 'val' => '160 x 90'),
    array('text' => '160 x 600' , 'val' => '160 x 600'),
    array('text' => '180 x 90' , 'val' => '180 x 90'),
    array('text' => '180 x 150' , 'val' => '180 x 150'),
    array('text' => '200 x 90' , 'val' => '200 x 90'),
    array('text' => '200 x 200' , 'val' => '200 x 200'),
    array('text' => '234 x 60' , 'val' => '234 x 60'),
    array('text' => '250 x 250' , 'val' => '250 x 250'),
    array('text' => '320 x 100' , 'val' => '320 x 100'),
    array('text' => '300 x 250' , 'val' => '300 x 250'),
    array('text' => '300 x 600' , 'val' => '300 x 600'),
    array('text' => '320 x 50' , 'val' => '320 x 50'),
    array('text' => '336 x 280' , 'val' => '336 x 280'),
    array('text' => '468 x 15' , 'val' => '468 x 15'),
    array('text' => '468 x 60' , 'val' => '468 x 60'),
    array('text' => '728 x 15' , 'val' => '728 x 15'),
    array('text' => '728 x 90' , 'val' => '728 x 90'),
    array('text' => '970 x 90' , 'val' => '970 x 90'),
    array('text' => '240 x 400 - 区域广告尺寸' , 'val' => '240 x 400'),
    array('text' => '250 x 360 - 区域广告尺寸' , 'val' => '250 x 360'),
    array('text' => '580 x 400 - 区域广告尺寸' , 'val' => '580 x 400'),
    array('text' => '750 x 100 - 区域广告尺寸' , 'val' => '750 x 100'),
    array('text' => '750 x 200 - 区域广告尺寸' , 'val' => '750 x 200'),
    array('text' => '750 x 300 - 区域广告尺寸' , 'val' => '750 x 300'),
    array('text' => '980 x 120 - 区域广告尺寸' , 'val' => '980 x 120'),
    array('text' => '930 x 180 - 区域广告尺寸' , 'val' => '930 x 180')
);









echo td_panel_generator::box_start('页眉广告', false);?>
    <!-- ad box code -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">您的页眉广告</span>
            <p>在这里粘贴你的广告代码。谷歌adsense将自动自适应。<br><br> 要添加非adsense自适应广告，<br> <a target="_blank" href="http://forum.tagdiv.com/article-ads/">点击这里</a></p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::textarea(array(
                'ds' => 'td_ads',
                'item_id' => 'header',
                'option_id' => 'ad_code',
            ));
            ?>
        </div>
    </div>


    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">高级用法：</span>
            <p>如果你留AdSense大小框为自动，主题将自动调整<strong>谷歌广告</strong>。更多信息关注此<a href="http://forum.tagdiv.com/article-ads/" target="_blank">链接</a></p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

    <!-- disable ad on monitor -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title td-title-on-row">在桌面禁用</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                    'ds' => 'td_ads',
                    'item_id' => 'header',
                    'option_id' => 'disable_m',
                    'true_value' => 'yes',
                    'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小：</span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                         'ds' => 'td_ads',
                         'item_id' => 'header',
                         'option_id' => 'm_size',
                         'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>
        </div>
    </div>


	<!-- disable ad on table landscape -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title td-title-on-row">在平板横向禁用</span>
			<p></p>
		</div>
		<div class="td-box-control-full">
	            <span>
	            <?php
	            echo td_panel_generator::checkbox(array(
		            'ds' => 'td_ads',
		            'item_id' => 'header',
		            'option_id' => 'disable_tl',
		            'true_value' => 'yes',
		            'false_value' => ''
	            ));
	            ?>
	            </span>
	            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
	                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小： </span>
	                <span class="td-content-float-right">
	                    <?php
	                    echo td_panel_generator::dropdown(array(
		                    'ds' => 'td_ads',
		                    'item_id' => 'header',
		                    'option_id' => 'tl_size',
		                    'values' => $td_google_ad_list_sizes
	                    ));
	                    ?>
	            </span>
		</div>
	</div>


    <!-- disable ad on tablet portrait -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title td-title-on-row">在平板竖向禁用</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'header',
                'option_id' => 'disable_tp',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小：</span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'header',
                        'option_id' => 'tp_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>


    <!-- disable ad on phones -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">在手机禁用</span>
            <p>谷歌adsense必须不要在手机上使用大页眉广告!</p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'header',
                'option_id' => 'disable_p',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小：</span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'header',
                        'option_id' => 'p_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>
<?php echo td_panel_generator::box_end();?>




<?php echo td_panel_generator::box_start('侧边栏广告', false);?>

   <div class="td-box-row">
        <div class="td-box-description td-box-full">
             <span class="td-box-title">注意：</span>
             <p>要在侧边栏显示广告，请拖动 "[taDiv] 广告框" 小工具到侧边栏. </p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
   </div>

    <!-- ad box code -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">您的侧边栏广告</span>
            <p>在这里粘贴广告代码。谷歌adsense将自动自适应。<br><br>要添加adsense自适应广告，<br> <a target="_blank" href="http://forum.tagdiv.com/ads-system-full-guide/">点击这里</a> (最后一段)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::textarea(array(
                'ds' => 'td_ads',
                'item_id' => 'sidebar',
                'option_id' => 'ad_code',
            ));
            ?>
        </div>
    </div>


    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">高级用法：</span>
            <p>如果你留AdSense大小框为自动，主题将自动调整<strong>谷歌广告</strong>。更多信息关注此<a href="http://forum.tagdiv.com/article-ads/" target="_blank">链接</a></p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>


    <!-- disable ad on monitor -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title td-title-on-row">在桌面禁用</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'sidebar',
                'option_id' => 'disable_m',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小： </span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'sidebar',
                        'option_id' => 'm_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>



	<!-- disable ad on table landscape -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title td-title-on-row">在平板横向禁用</span>
			<p></p>
		</div>
		<div class="td-box-control-full">
	            <span>
	            <?php
	            echo td_panel_generator::checkbox(array(
		            'ds' => 'td_ads',
		            'item_id' => 'sidebar',
		            'option_id' => 'disable_tl',
		            'true_value' => 'yes',
		            'false_value' => ''
	            ));
	            ?>
	            </span>
	            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
	                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小：</span>
	                <span class="td-content-float-right">
	                    <?php
	                    echo td_panel_generator::dropdown(array(
		                    'ds' => 'td_ads',
		                    'item_id' => 'sidebar',
		                    'option_id' => 'tl_size',
		                    'values' => $td_google_ad_list_sizes
	                    ));
	                    ?>
	            </span>
		</div>
	</div>




    <!-- disable ad on tablet portrait -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title td-title-on-row">在平板竖向禁用</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'sidebar',
                'option_id' => 'disable_tp',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小： </span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'sidebar',
                        'option_id' => 'tp_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>


    <!-- disable ad on phones -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">在手机禁用</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'sidebar',
                'option_id' => 'disable_p',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小：</span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'sidebar',
                        'option_id' => 'p_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>
        </div>
    </div>

<?php echo td_panel_generator::box_end();?>



<?php echo td_panel_generator::box_start('文章顶部广告', false);?>

    <!-- ad box code -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">您的文章顶部广告</span>
            <p>在这里粘贴广告代码。谷歌adsense将自动自适应。<br><br>要添加adsense自适应广告，<br> <a target="_blank" href="http://forum.tagdiv.com/ads-system-full-guide/">点击这里</a> (最后一段)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::textarea(array(
                'ds' => 'td_ads',
                'item_id' => 'content_top',
                'option_id' => 'ad_code',
            ));
            ?>
        </div>
    </div>


    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">高级用法：</span>
            <p>如果你留AdSense大小框为自动，主题将自动调整<strong>谷歌广告</strong>。更多信息关注此<a href="http://forum.tagdiv.com/article-ads/" target="_blank">链接</a></p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>


    <!-- disable ad on monitor -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title td-title-on-row">在桌面禁用</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'content_top',
                'option_id' => 'disable_m',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小： </span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'content_top',
                        'option_id' => 'm_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>


	<!-- disable ad on table landscape -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title td-title-on-row">在平板横向禁用</span>
			<p></p>
		</div>
		<div class="td-box-control-full">
	            <span>
	            <?php
	            echo td_panel_generator::checkbox(array(
		            'ds' => 'td_ads',
		            'item_id' => 'content_top',
		            'option_id' => 'disable_tl',
		            'true_value' => 'yes',
		            'false_value' => ''
	            ));
	            ?>
	            </span>
	            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
	                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小： </span>
	                <span class="td-content-float-right">
	                    <?php
	                    echo td_panel_generator::dropdown(array(
		                    'ds' => 'td_ads',
		                    'item_id' => 'content_top',
		                    'option_id' => 'tl_size',
		                    'values' => $td_google_ad_list_sizes
	                    ));
	                    ?>
	            </span>
		</div>
	</div>




    <!-- disable ad on tablet portrait -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title td-title-on-row">在平板竖向禁用</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'content_top',
                'option_id' => 'disable_tp',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小： </span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'content_top',
                        'option_id' => 'tp_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>


    <!-- disable ad on phones -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">在手机禁用</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'content_top',
                'option_id' => 'disable_p',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小： </span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'content_top',
                        'option_id' => 'p_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>

<?php echo td_panel_generator::box_end();?>



<?php echo td_panel_generator::box_start('文章内嵌广告', false);?>

    <!-- ad box code -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">您的文章内嵌广告</span>
            <p>在这里粘贴广告代码。谷歌adsense将自动自适应。<br><br>要添加adsense自适应广告，<br> <a target="_blank" href="http://forum.tagdiv.com/ads-system-full-guide/">点击这里</a> (最后一段)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::textarea(array(
                'ds' => 'td_ads',
                'item_id' => 'content_inline',
                'option_id' => 'ad_code',
            ));
            ?>
        </div>
    </div>

    <!-- After paragraph  //alignment & after paragraph settings only for inline ads-->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">段落之后：</span>
            <p>多少段落之后显示广告。主题将分析每个文章的内容，它将在选择段落数量之后注入</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::input(array(
                'ds' => 'td_option',
                'option_id' => 'tds_inline_ad_paragraph'
            ));
            ?>
        </div>
    </div>


    <!-- DISPLAY VIEW -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">内容广告位置</span>
            <p>内容广告位置。左浮动，完整文章宽度或右浮动.</p>
        </div>
        <div class="td-box-control-full td-panel-module">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_option',
                'option_id' => 'tds_inline_ad_align',
                'values' => array(
                    array('text' => '', 'title' => '', 'val' => 'left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/ad-left.png'),
                    array('text' => '', 'title' => '', 'val' => '', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/ad-center.png'),
                    array('text' => '', 'title' => '', 'val' => 'right', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/ad-right.png')
                )
            ));
            ?>
        </div>
    </div>


    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">高级用法：</span>
            <p>如果你留AdSense大小框为自动，主题将自动调整<strong>谷歌广告</strong>。更多信息关注此<a href="http://forum.tagdiv.com/article-ads/" target="_blank">链接</a></p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>


    <!-- disable ad on monitor -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title td-title-on-row">桌面禁用</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'content_inline',
                'option_id' => 'disable_m',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小：</span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'content_inline',
                        'option_id' => 'm_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>



	<!-- disable ad on table landscape -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title td-title-on-row">在平板横向禁用</span>
			<p></p>
		</div>
		<div class="td-box-control-full">
	            <span>
	            <?php
	            echo td_panel_generator::checkbox(array(
		            'ds' => 'td_ads',
		            'item_id' => 'content_inline',
		            'option_id' => 'disable_tl',
		            'true_value' => 'yes',
		            'false_value' => ''
	            ));
	            ?>
	            </span>
	            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
	                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小：</span>
	                <span class="td-content-float-right">
	                    <?php
	                    echo td_panel_generator::dropdown(array(
		                    'ds' => 'td_ads',
		                    'item_id' => 'content_inline',
		                    'option_id' => 'tl_size',
		                    'values' => $td_google_ad_list_sizes
	                    ));
	                    ?>
	            </span>
		</div>
	</div>




    <!-- disable ad on tablet portrait -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title td-title-on-row">在平板竖向禁用</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'content_inline',
                'option_id' => 'disable_tp',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小：</span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'content_inline',
                        'option_id' => 'tp_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>


    <!-- disable ad on phones -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">在手机禁用</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'content_inline',
                'option_id' => 'disable_p',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小：</span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'content_inline',
                        'option_id' => 'p_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>

<?php echo td_panel_generator::box_end();?>



<?php echo td_panel_generator::box_start('文章底部广告', false);?>

    <!-- ad box code -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">您的文章底部广告</span>
            <p>在这里粘贴广告代码。谷歌adsense将自动自适应。<br><br>要添加adsense自适应广告，<br> <a target="_blank" href="http://forum.tagdiv.com/ads-system-full-guide/">点击这里</a> (最后一段)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::textarea(array(
                'ds' => 'td_ads',
                'item_id' => 'content_bottom',
                'option_id' => 'ad_code',
            ));
            ?>
        </div>
    </div>


    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">高级用法：</span>
            <p>如果你留AdSense大小框为自动，主题将自动调整<strong>谷歌广告</strong>。更多信息关注此<a href="http://forum.tagdiv.com/article-ads/" target="_blank">链接</a></p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>


    <!-- disable ad on monitor -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title td-title-on-row">在桌面禁用</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'content_bottom',
                'option_id' => 'disable_m',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小：</span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'content_bottom',
                        'option_id' => 'm_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>


	<!-- disable ad on table landscape -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title td-title-on-row">在平板横向禁用</span>
			<p></p>
		</div>
		<div class="td-box-control-full">
	            <span>
	            <?php
	            echo td_panel_generator::checkbox(array(
		            'ds' => 'td_ads',
		            'item_id' => 'content_bottom',
		            'option_id' => 'disable_tl',
		            'true_value' => 'yes',
		            'false_value' => ''
	            ));
	            ?>
	            </span>
	            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
	                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小：</span>
	                <span class="td-content-float-right">
	                    <?php
	                    echo td_panel_generator::dropdown(array(
		                    'ds' => 'td_ads',
		                    'item_id' => 'content_bottom',
		                    'option_id' => 'tl_size',
		                    'values' => $td_google_ad_list_sizes
	                    ));
	                    ?>
	            </span>
		</div>
	</div>



    <!-- disable ad on tablet portrait -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title td-title-on-row">在平板竖向禁用</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'content_bottom',
                'option_id' => 'disable_tp',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小：</span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'content_bottom',
                        'option_id' => 'tp_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>


    <!-- disable ad on phones -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">在手机禁用</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'content_bottom',
                'option_id' => 'disable_p',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense大小：</span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'content_bottom',
                        'option_id' => 'p_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>

<?php echo td_panel_generator::box_end();?>



<?php
//backround add
echo td_panel_generator::box_start('背景点击广告', false);?>

    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">注意：</span>
            <p>如果你也需要背景图片，请去<strong>背景</strong>选项卡</p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

    <!-- ad box code -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">URL</span>
            <p>粘贴你的链接到这里，像：http://www.4mudi.com</p>
        </div>
        <div class="td-box-control-full td-panel-input-wide">
            <?php
            echo td_panel_generator::input(array(
                'ds' => 'td_option',
                'option_id' => 'tds_background_click_url',
            ));
            ?>
        </div>
    </div>


    <!-- ad taget -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">在新窗口打开</span>
            <p>如果启用，此选项将在新窗口打开网址。禁用网址在当前页面加载</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_background_click_target',
                'true_value' => '_blank',
                'false_value' => ''
            ));
            ?>
        </div>
    </div>

<?php  echo td_panel_generator::box_end();?>

<?php
echo td_panel_generator::ajax_box('文章模板风格 1 ', array(
		'td_ajax_calling_file' => basename(__FILE__),
		'td_ajax_box_id' => 'td_get_ad_spot_by_id',
		'ad_spot_id' => 'post_style_1'
	)
);
?>

<?php
echo td_panel_generator::ajax_box('文章模板风格 11 ', array(
		'td_ajax_calling_file' => basename(__FILE__),
		'td_ajax_box_id' => 'td_get_ad_spot_by_id',
		'ad_spot_id' => 'post_style_11'
	)
);
?>

<?php
echo td_panel_generator::ajax_box('文章模板风格 12, 13 ', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_get_ad_spot_by_id',
        'ad_spot_id' => 'post_style_12'
    )
);
?>

<?php
echo td_panel_generator::ajax_box('智能列表6 ', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_get_ad_spot_by_id',
        'ad_spot_id' => 'smart_list_6'
    )
);
?>

<?php
echo td_panel_generator::ajax_box('智能列表7 ', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_get_ad_spot_by_id',
        'ad_spot_id' => 'smart_list_7'
    )
);
?>

<?php
echo td_panel_generator::ajax_box('智能列表8 ', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_get_ad_spot_by_id',
        'ad_spot_id' => 'smart_list_8'
    )
);
?>

<?php
echo td_panel_generator::ajax_box('页脚顶部 ', array(
		'td_ajax_calling_file' => basename(__FILE__),
		'td_ajax_box_id' => 'td_get_ad_spot_by_id',
		'ad_spot_id' => 'footer_top'
	)
);
?>

<!-- custom ads -->
<?php
    echo td_panel_generator::ajax_box('自定义广告 1', array(
            'td_ajax_calling_file' => basename(__FILE__),
            'td_ajax_box_id' => 'td_get_ad_spot_by_id',
            'ad_spot_id' => 'custom_ad_1'
        )
    );
?>


<?php
echo td_panel_generator::ajax_box('自定义广告 2', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_get_ad_spot_by_id',
        'ad_spot_id' => 'custom_ad_2'
    )
);
?>

<?php
echo td_panel_generator::ajax_box('自定义广告 3', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_get_ad_spot_by_id',
        'ad_spot_id' => 'custom_ad_3'
    )
);
?>


<?php
echo td_panel_generator::ajax_box('自定义广告 4', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_get_ad_spot_by_id',
        'ad_spot_id' => 'custom_ad_4'
    )
);
?>

<?php
echo td_panel_generator::ajax_box('自定义广告 5', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_get_ad_spot_by_id',
        'ad_spot_id' => 'custom_ad_5'
    )
);
?>
