<!-- Excerpts -->
<?php echo td_panel_generator::box_start('摘要');?>

    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">只是个提示：</span>
            <p>在文章编辑页（摘要框）添加一个文字作为摘要，将覆盖主题摘要</p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

    <!-- BACKGROUND UPLOAD -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class=" td-box-title">摘要类型</span>
            <p>设置摘要类型</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::radio_button_control(array(
                'ds' => 'td_option',
                'option_id' => 'tds_excerpts_type',
                'values' => array(
                    array('text' => '词', 'val' => ''),
                    array('text' => '字', 'val' => 'letters')
                )
            ));
            ?>
        </div>
    </div>

<?php echo td_panel_generator::box_end();?>









<?php
foreach (td_api_module::get_all() as $td_module_class => $td_module_array) {

    if (!empty($td_module_array['excerpt_title']) or !empty($td_module_array['excerpt_content'])) {

        $td_box_title = $td_module_array['text'];
        if (!empty($td_module_array['used_on_blocks'])) {
            $td_box_title .= td_panel_generator::helper_generate_used_on_block_list($td_module_array['used_on_blocks']);
        }



        echo td_panel_generator::box_start($td_box_title, false);
        ?>

        <div class="td-box-row">
            <div class="td-box-description td-box-full">
                <span class="td-box-title">注意：</span>
                <p>你可以从<a href="http://forum.tagdiv.com/modules-and-blocks/" target="_blank">这里</a>找到如何从模块创建区块。</p>
            </div>
            <div class="td-box-row-margin-bottom"></div>
        </div>


        <?php if (!empty($td_module_array['excerpt_title'])) { ?>
            <!-- TITLE LENGTH -->
            <div class="td-box-row">
                <div class="td-box-description">
                    <span class=" td-box-title td-title-on-row">标题长度</span>
                    <p></p>
                </div>
                <div class="td-box-control-full">
                    <?php
                    echo td_panel_generator::input(array(
                        'ds' => 'td_option',
                        'option_id' => $td_module_class . '_title_excerpt',
                        'placeholder' => $td_module_array['excerpt_title']
                    ));
                    ?>
                </div>
            </div>
        <?php } ?>


        <?php if (!empty($td_module_array['excerpt_content'])) { ?>
            <!-- CONTENT LENGTH LENGTH -->
            <div class="td-box-row">
                <div class="td-box-description">
                    <span class=" td-box-title td-title-on-row">内容长度</span>
                    <p></p>
                </div>
                <div class="td-box-control-full">
                    <?php
                    echo td_panel_generator::input(array(
                        'ds' => 'td_option',
                        'option_id' => $td_module_class . '_content_excerpt',
                        'placeholder' => $td_module_array['excerpt_content']
                    ));
                    ?>
                </div>
            </div>
        <?php } ?>


        <?php
        echo td_panel_generator::box_end();
    }


}

?>


