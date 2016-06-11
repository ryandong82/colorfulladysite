<?php echo td_panel_generator::box_start('如果使用自定义字体文档');?>



    <!-- info text -->
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <p>你可以在这里选择每个谷歌字体加载什么字体集。字符集仅在字体支持特殊字形时才加载。尝试只启用字体集，因为加载每个字体集将使网站加载变慢。</p>
            <p><a href="?page=td_theme_panel&td_page=td_view_custom_fonts" target="_blank" class="td-big-button">添加自定义字体 / 更改谷歌字体设置</a></p>
        </div>
    </div>



<?php echo td_panel_generator::box_end();?>

<?php
foreach (td_global::$typography_settings_list as $panel_section => $font_settings_array) {
    echo td_panel_generator::ajax_box($panel_section,
        array(
            'td_ajax_calling_file' => basename(__FILE__),
            'td_ajax_box_id' => 'td_get_font_section_by_section_id',
            'section_name' => $panel_section,
            'td_ajax_view' => 'td_theme_fonts'
        )
    );
}