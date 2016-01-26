<!-- Thumbs on Modules/Blocks -->
<?php
    echo td_panel_generator::ajax_box('模块和区块缩略图', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_thumbs_on_modules_and_blocks',
        ), '', 'td_panel_box_thumb_on_modules'
    );
?>





<!-- Category label on modules -->
<?php echo td_panel_generator::box_start('模块/区块分类标签', false); ?>

    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">更多信息：</span>
            <p>在这里你可以显示或隐藏模块分类标签。<a target="_blank" href="http://forum.tagdiv.com/modules/" >阅读更多关于模块信息</a></p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>



    <?php
    foreach (td_api_module::get_all() as $td_module_class => $td_module_array) {
        if ($td_module_array['category_label'] === true) {
            ?>
            <!-- <?php echo $td_module_array['text'] ?> -->
            <div class="td-box-row">
                <div class="td-box-description">
                    <span class="td-box-title"><?php echo $td_module_array['text'] . td_panel_generator::helper_generate_used_on_block_list($td_module_array['used_on_blocks']) ?></span>
                    <p>隐藏或显示分类标签</p>
                </div>
                <div class="td-box-control-full">
                    <?php
                    echo td_panel_generator::checkbox(array(
                        'ds' => 'td_option',
                        'option_id' => 'tds_category_' . td_util::get_module_name_from_class($td_module_class),
                        'true_value' => 'yes',
                        'false_value' => ''
                    ));
                    ?>
                </div>
            </div>
            <?php
        }
    }

    ?>
<?php echo td_panel_generator::box_end();?>





<!-- 7 days post sorting -->
<?php echo td_panel_generator::box_start('7天文章排序', false); ?>


<!-- text -->
<div class="td-box-row">
	<div class="td-box-description td-box-full">
		<p>当你启用此选项，新的排序选项将工作，它将在每个区块可选择（7天热门）。此排序选项将挑选最后7天热门的文章，按页面查看排序。此选项有一个小缺陷，它不与缓存插件一起工作。当启用缓存插件时，排序将在最后7天成为估计热门。</p>
	</div>
	<div class="td-box-row-margin-bottom"></div>
</div>

<!-- use 7 days post sorting -->
<div class="td-box-row">
	<div class="td-box-description">
		<span class="td-box-title">使用7天文章排序</span>
		<p>启用或禁用最新7天热门</p>
	</div>
	<div class="td-box-control-full">
		<?php
		echo td_panel_generator::checkbox(array(
			'ds' => 'td_option',
			'option_id' => 'tds_p_enable_7_days_count',
			'true_value' => 'enabled',
			'false_value' => ''
		));
		?>
	</div>
</div>
<?php echo td_panel_generator::box_end();?>







<?php
    //@todo run only on Newsmag - HACK
    if (TD_THEME_NAME === 'Newsmag') { ?>
    <hr>
    <div class="td-section-separator">区块占位符风格</div>

    <!-- STYLE 1 CSS ------------------------------------------------------------------------->
    <?php
    echo td_panel_generator::ajax_box('Style 1 - Red', array(
            'td_ajax_calling_file' => basename(__FILE__),
            'td_ajax_box_id' => 'td_style_1_red'
        )
    );
    ?>



    <!-- STYLE 2 CSS ------------------------------------------------------------------------->
    <?php
    echo td_panel_generator::ajax_box('Style 2 - Black', array(
            'td_ajax_calling_file' => basename(__FILE__),
            'td_ajax_box_id' => 'td_style_2_black'
        )
    );
    ?>



    <!-- STYLE 3 CSS ------------------------------------------------------------------------->
    <?php
    echo td_panel_generator::ajax_box('Style 3 - Orange', array(
            'td_ajax_calling_file' => basename(__FILE__),
            'td_ajax_box_id' => 'td_style_3_orange'
        )
    );
    ?>



    <!-- STYLE 4 CSS ------------------------------------------------------------------------->
    <?php
    echo td_panel_generator::ajax_box('Style 4 - Yellow', array(
            'td_ajax_calling_file' => basename(__FILE__),
            'td_ajax_box_id' => 'td_style_4_yellow'
        )
    );
    ?>



    <!-- STYLE 5 CSS ------------------------------------------------------------------------->
    <?php
    echo td_panel_generator::ajax_box('Style 5 - Green', array(
            'td_ajax_calling_file' => basename(__FILE__),
            'td_ajax_box_id' => 'td_style_5_green'
        )
    );
    ?>



    <!-- STYLE 6 CSS ------------------------------------------------------------------------->
    <?php
    echo td_panel_generator::ajax_box('Style 6 - Pink', array(
            'td_ajax_calling_file' => basename(__FILE__),
            'td_ajax_box_id' => 'td_style_6_pink'
        )
    );

}