<!-- Analitycs -->
<?php echo td_panel_generator::box_start('分析'); ?>

    <!-- GOOGLE ASYNCHRONOUS ADS -->
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">谷歌分析代码</span>
            <p>谷歌分析代码帮助你跟踪你的网站。四亩地注：也可以放百度统计、CNZZ或者其它需要的JS代码</p>
        </div>
    </div>


    <!-- paste your code here -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">在这里粘贴你的代码</span>
            <p>谷歌分析代码</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::textarea(array(
                'ds' => 'td_option',
                'option_id' => 'td_analytics',
            ));
            ?>
        </div>
    </div>

<?php echo td_panel_generator::box_end();?>