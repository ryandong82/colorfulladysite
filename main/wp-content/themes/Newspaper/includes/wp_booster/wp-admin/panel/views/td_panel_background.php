<!-- BACKGROUND SETTINGS -->
<?php echo td_panel_generator::box_start('背景设置'); ?>

    <!-- BACKGROUND UPLOAD -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">网站背景</span>
            <p>上传一个背景图片，网站将自动切换为框式版本</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::upload_image(array(
                'ds' => 'td_option',
                'option_id' => 'tds_site_background_image'
            ));
            ?>
        </div>
    </div>

    <!-- Background Repeat -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">平铺</span>
            <p>网站背景如何显示</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::radio_button_control(array(
                'ds' => 'td_option',
                'option_id' => 'tds_site_background_repeat',
                'values' => array(
                    array('text' => '不平铺', 'val' => ''),
                    array('text' => '平铺', 'val' => 'repeat'),
                    array('text' => '水平平铺', 'val' => 'repeat-x'),
                    array('text' => '垂直平铺', 'val' => 'repeat-y')
                )
            ));
            ?>
        </div>
    </div>


    <!-- Background position -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">位置</span>
            <p>背景图片位置</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::radio_button_control(array(
                'ds' => 'td_option',
                'option_id' => 'tds_site_background_position_x',
                'values' => array(
                    array('text' => '左', 'val' => ''),
                    array('text' => '中', 'val' => 'center'),
                    array('text' => '右', 'val' => 'right')
                )
            ));
            ?>
        </div>
    </div>


    <!-- Background attachment -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">背景附件</span>
            <p>背景附件</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::radio_button_control(array(
                'ds' => 'td_option',
                'option_id' => 'tds_site_background_attachment',
                'values' => array(
                    array('text' => '固定', 'val' => 'fixed'),
                    array('text' => '滚动', 'val' => '')
                )
            ));
            ?>
        </div>
    </div>


    <!-- Stretch background -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">弹力背景</span>
            <p>背景图片拉伸 <br>( 如果你使用背景点击广告，禁用此选项)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_stretch_background',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
        </div>
    </div>





<?php echo td_panel_generator::box_end();?>