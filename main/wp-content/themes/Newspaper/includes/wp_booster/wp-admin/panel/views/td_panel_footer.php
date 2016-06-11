<!-- FOOTER SETTINGS -->
<?php echo td_panel_generator::box_start('页脚设置', true); ?>

<div class="td-box-row">
    <div class="td-box-description td-box-full">
        <span class="td-box-title">更多信息：</span>
        <p>页脚使用侧边栏显示信息。在这里可以自定义侧边栏数和布局。要添加内容到页脚，去小工具栏目并拖动小工具到页脚1, 页脚 2 和 页脚 3 侧边栏.</p>
        <p>有些页脚模板包含预定义的内容，像<strong>信息内容</strong>可以从<strong>页脚信息内容</strong>部分显示.</p>
    </div>
    <div class="td-box-row-margin-bottom"></div>
</div>


<!-- Enable footer -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">显示页脚</span>
        <p>显示或隐藏页脚</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::checkbox(array(
            'ds' => 'td_option',
            'option_id' => 'tds_footer',
            'true_value' => '',
            'false_value' => 'no'
        ));
        ?>
    </div>
</div>



<!-- LAYOUT -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">页脚模板</span>
        <p>设置页脚模板</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::visual_select_o(array(
            'ds' => 'td_option',
            'option_id' => 'tds_footer_template',
            'values' => td_api_footer_template::_helper_to_panel_values()
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end();?>




<!-- FOOTER PREDEFINED CONTENT -->
<?php echo td_panel_generator::box_start('页脚信息内容', false); ?>

    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <ul>
                <li>页脚logo - 来自页眉LOGO不同的一个。如果不指定页脚LOGO，网站将加载默认正常logo.</li>
                <li>页脚文字 - 通常它是关于你的网站话题的文本</li>
                <li>您的联系邮箱地址</li>
                <li>社交图标 - 自定义什么社交图标出现到页脚，去<strong>社交网络</strong>部分.</li>
            </ul>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

    <!-- logo -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">页脚LOGO</span>
            <p>上传你的logo</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::upload_image(array(
                'ds' => 'td_option',
                'option_id' => 'tds_footer_logo_upload'
            ));
            ?>
        </div>
    </div>

    <!-- logo retina -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">页脚视网膜LOGO</span>
            <p>上传你的视网膜logo (双倍大小)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::upload_image(array(
                'ds' => 'td_option',
                'option_id' => 'tds_footer_retina_logo_upload'
            ));
            ?>
        </div>
    </div>

    <!-- footer text -->
    <div class="td-box-row td-custom-css">
        <div class="td-box-description">
            <span class="td-box-title">页脚文字</span>
            <p>在这里写页脚文字</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::textarea(array(
                'ds' => 'td_option',
                'option_id' => 'tds_footer_text',
            ));
            ?>
        </div>
    </div>


    <!-- Footer contact email -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">您的邮箱地址</span>
            <p>你的邮箱地址</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::input(array(
                'ds' => 'td_option',
                'option_id' => 'tds_footer_email'
            ));
            ?>
        </div>
    </div>


    <!-- Enable social icons -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示社交图标</span>
            <p>显示或隐藏社交图标，要设置社交图标去<strong>社交网络</strong></p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_footer_social',
                'true_value' => '',
                'false_value' => 'no'
            ));
            ?>
        </div>
    </div>
<?php echo td_panel_generator::box_end();?>


<!-- FOOTER BACKGROUND -->
<?php echo td_panel_generator::box_start('页脚背景', false); ?>

    <!-- BACKGROUND UPLOAD -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">页脚背景</span>
            <p>Upload a footer background image</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::upload_image(array(
                'ds' => 'td_option',
                'option_id' => 'tds_footer_background_image'
            ));
            ?>
        </div>
    </div>

    <!-- Background Repeat -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">平铺</span>
            <p>背景图片如何显示</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::radio_button_control(array(
                'ds' => 'td_option',
                'option_id' => 'tds_footer_background_repeat',
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

    <!-- Background Size -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">大小</span>
            <p>设置背景图片大小</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::radio_button_control(array(
                'ds' => 'td_option',
                'option_id' => 'tds_footer_background_size',
                'values' => array(
                    array('text' => '自动', 'val' => ''),
                    array('text' => '全宽', 'val' => '100% auto'),
                    array('text' => '全高', 'val' => 'auto 100%'),
                    array('text' => '封面', 'val' => 'cover'),
                    array('text' => '包含', 'val' => 'contain')
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
                'option_id' => 'tds_footer_background_position',
                'values' => array(
                    array('text' => '下', 'val' => ''),
                    array('text' => '中', 'val' => 'center center'),
                    array('text' => '上', 'val' => 'center top')
                )
            ));
            ?>
        </div>
    </div>

    <!-- Background opacity -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">背景透明度</span>
            <p>设置背景图片透明度（例如：0.3）</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::input(array(
                'ds' => 'td_option',
                'option_id' => 'tds_footer_background_opacity'
            ));
            ?>
        </div>
    </div>

<?php echo td_panel_generator::box_end();?>


<!-- SUB-FOOTER SETTINGS -->
<?php echo td_panel_generator::box_start('子页脚设置', false); ?>


    <!-- text -->
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">更多信息：</span>
            <p>子页脚部分是主页脚下面的内容。它一般包含版权文字和右侧的菜单</p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

    <!-- Enable sub-footer -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示子页脚</span>
            <p>显示或隐藏子页脚</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_sub_footer',
                'true_value' => '',
                'false_value' => 'no'
            ));
            ?>
        </div>
    </div>

    <!-- Footer copyright text -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">页脚版权文字</span>
            <p>设置页脚版权文字</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::input(array(
                'ds' => 'td_option',
                'option_id' => 'tds_footer_copyright'
            ));
            ?>
        </div>
    </div>


    <!-- Copyright symbol -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">版权符号</span>
            <p>显示或隐藏页脚版权符号</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_footer_copy_symbol',
                'true_value' => '',
                'false_value' => 'no'
            ));
            ?>
        </div>
    </div>

    <!-- Footer menu -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">页脚菜单</span>
            <p>选择子页脚菜单</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::dropdown(array(
                'ds' => 'wp_theme_menu_spot',
                'option_id' => 'footer-menu',
                'values' => td_panel_generator::get_user_created_menus()
            ));
            ?>
        </div>
    </div>
<?php echo td_panel_generator::box_end();?>