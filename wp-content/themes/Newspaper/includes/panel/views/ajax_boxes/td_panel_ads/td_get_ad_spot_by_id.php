<?php

$ad_spot_id = td_util::get_http_post_val('ad_spot_id');


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
?>

<!-- ad box code -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">您的广告代码</span>
            <p>在这里粘贴你的广告代码。谷歌adsense将自动自适应。<br><br> 要添加非adsense自适应广告，<br> <a target="_blank" href="http://forum.tagdiv.com/article-ads/">点击这里</a></p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::textarea(array(
            'ds' => 'td_ads',
            'item_id' => $ad_spot_id,
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
                'item_id' => $ad_spot_id,
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
                        'item_id' => $ad_spot_id,
                        'option_id' => 'm_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>

    </div>
</div>


<!-- disable ad on tablet landscape -->
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
	            'item_id' => $ad_spot_id,
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
	                    'item_id' => $ad_spot_id,
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
                'item_id' => $ad_spot_id,
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
                        'item_id' => $ad_spot_id,
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
                'item_id' => $ad_spot_id,
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
                        'item_id' => $ad_spot_id,
                        'option_id' => 'p_size',
                        'values' => $td_google_ad_list_sizes
                    ));
                    ?>
            </span>
    </div>
</div>