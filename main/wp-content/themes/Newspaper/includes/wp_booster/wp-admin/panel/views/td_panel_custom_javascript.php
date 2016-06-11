<!-- CUSTOM Javascript -->
<?php echo td_panel_generator::box_start('自定义Javascript'); ?>

    <!-- YOUR CUSTOM Javascript -->
    <div class="td-box-row td-custom-javascript">
        <div class="td-box-description">
            <span class="td-box-title">你的自定义JAVASCRIPT</span>
            <p>请输入你的自定义Javascript</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::textarea(array(
                'ds' => 'td_option',
                'option_id' => 'tds_custom_javascript',
            ));
            ?>
        </div>
    </div>

<?php echo td_panel_generator::box_end();?>