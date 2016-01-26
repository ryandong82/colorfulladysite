<?php

/**
 * @todo modulele astea trebuie incarcate by default
 * module8 category label should be enabled by default
 * module_related
 * module_mega_menu
 * module_slide
 */

?>
<div class="td-box-row">
    <div class="td-box-description td-box-full">
        <span class="td-box-title">更多信息：</span>
        <p>在这里你可以启用缩略图将为模块和区块裁剪。如果没有为特定模块使用缩略图图片，模块将显示一个默认占位符事图片大小和如何启用模块缩略图的信息。</p>
        <p><strong style="color:red">如果你更改任何缩略图设置，请重新生成缩略图。</strong> - <a href="http://forum.tagdiv.com/existing-content/" target="_blank">阅读更多</a></p>
    </div>
    <div class="td-box-row-margin-bottom"></div>
</div>


<?php
foreach (td_api_thumb::get_all() as $thumb) {
    ?>
    <!-- THUMB -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title"><?php echo $thumb['width'] . ' x ' . $thumb['height']  ?></span>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_thumb_' . $thumb['name'],
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            <div class="td-help-checkbox-inline">
                <?php
                echo "<span>此缩略图大小用于：</span> <ul><li>" . implode("</li><li>", $thumb['used_on']) . "</li></ul>";
                ?>
            </div>
        </div>
    </div>
<?php
}