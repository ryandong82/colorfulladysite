<!-- CUSTOM CSS -->
<?php echo td_panel_generator::box_start('自定义CSS'); ?>

    <!-- YOUR CUSTOM CSS -->
    <div class="td-box-row td-custom-css">
        <div class="td-box-description">
            <span class="td-box-title">你的自定义CSS</span>
            <p>在这里粘贴你的自定义CSS</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::textarea(array(
                'ds' => 'td_option',
                'option_id' => 'tds_custom_css',
            ));
            ?>
        </div>
    </div>

<?php echo td_panel_generator::box_end();?>



<!-- ADVANCED CSS -->
<?php echo td_panel_generator::box_start('高级CSS', false); ?>

    <!-- Responsive css -->
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">自适应CSS</span>
            <p>在应用框粘贴你的自定义CSS，仅在特定设备运行
            </p>
        </div>
    </div>

    <?php
        /**
         * this part of the panel is generated from td_global::$theme_panel_custom_css_fields_list
         * td_global::$theme_panel_custom_css_fields_list is set via td_config.php on a per theme basis
         */
        foreach (td_global::$theme_panel_custom_css_fields_list as $option_id => $css_params) {
            ?>
            <!-- Css for each device type -->
            <div class="td-box-row">
                <div class="td-box-description">
                    <div class="td-display-inline-block">
                        <img src="<?php echo $css_params['img'];?>">
                    </div>
                    <div class="td-display-inline-block">
                        <span class="td-box-title"><?php echo $css_params['text'];?></span>
                        <p><?php echo $css_params['description'];?></p>
                    </div>
                </div>
                <div class="td-box-control-full">
                    <?php
                    echo td_panel_generator::textarea(array(
                        'ds' => 'td_option',
                        'option_id' => $option_id
                    ));
                    ?>
                </div>
            </div>
            <?php
        }
    ?>
<?php echo td_panel_generator::box_end();?>



<!-- Add custom body class -->
<?php echo td_panel_generator::box_start('自定义主体Class', false); ?>
    <!-- Add custom body class -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">自定义主体CLASS</span>
            <p>你可以在主题主体元素添加一个或更多class。如果你需要超过一个class，在它们之间使用空间添加。</p><p>例如：class-test-1 class-test-2 </p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::input(array(
                'ds' => 'td_option',
                'option_id' => 'td_body_classes'
            ));
            ?>
        </div>
    </div>
<?php echo td_panel_generator::box_end();