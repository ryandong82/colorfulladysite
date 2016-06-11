<!-- theme_color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">主题强调颜色</span>
        <p>选择主题强调色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_theme_color',
            'default_color' => '#4db2ec'
        ));
        ?>
    </div>
</div>


<!-- BACKGROUND COLOR -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">背景颜色</span>
        <p>选择主题背景色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_site_background_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>


<!-- HEADERS BACKGROUND COLOR -->
<div class="td-box-row">
	<div class="td-box-description">
		<span class="td-box-title">页眉背景颜色</span>
		<p>选择全局页眉背景颜色</p>
	</div>
	<div class="td-box-control-full">
		<?php
		echo td_panel_generator::color_picker(array(
			'ds' => 'td_option',
			'option_id' => 'tds_header_color',
			'default_color' => ''
		));
		?>
	</div>
</div>


<!-- HEADERS TEXT COLOR -->
<div class="td-box-row">
	<div class="td-box-description">
		<span class="td-box-title">页眉文字颜色</span>
		<p>选择全局页眉文字颜色</p>
	</div>
	<div class="td-box-control-full">
		<?php
		echo td_panel_generator::color_picker(array(
			'ds' => 'td_option',
			'option_id' => 'tds_text_header_color',
			'default_color' => ''
		));
		?>
	</div>
</div>