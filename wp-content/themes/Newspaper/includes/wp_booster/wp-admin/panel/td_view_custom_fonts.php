<?php
$td_fonts_user_inserted = 0;

if(!empty($_REQUEST['td_option']) and $_REQUEST['td_option'] == 'save_fonts') {
    if(td_panel_data_source::insert_in_system_fonts_user($_POST['td_fonts_user_insert'])) {
        $td_fonts_user_inserted = 1;
    }

}?>

<div class="wrap">
<form id="td_panel_import_export_settings" name="td_panel_import_export_settings" action="?page=td_theme_panel&td_page=td_view_custom_fonts&td_option=save_fonts" method="post">
    <div class="td-container-wrap">

	    <div class="td-panel-main-header">
		    <img src="<?php echo get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/panel-wrap/panel-logo.png'?>" alt=""/>
		    <span class="td-panel-header-name"><?php echo TD_THEME_NAME . ' - 主题面板'; ?></span>
		    <span class="td-panel-header-version">版本：<?php echo TD_THEME_VERSION; ?></span>
	    </div>


        <div id="td-container-left">
            <div id="td-container-right">
                <div id="td-col-left">
                    <ul class="td-panel-menu">
                        <li class="td-welcome-menu">
                            <a data-td-is-back="yes" class="td-panel-menu-active" href="?page=td_theme_panel">
                                <span class="td-sp-nav-icon td-ico-typography"></span>
                                自定义字体
                                <span class="td-no-arrow"></span>
                            </a>
                        </li>

                        <li>
                            <a data-td-is-back="yes" href="?page=td_theme_panel">
                                <span class="td-sp-nav-icon td-ico-back"></span>
                                返回
                                <span class="td-no-arrow"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div id="td-col-right" class="td-panel-content">


                    <!-- Custom fonts files -->
                    <div  class="td-panel-active td-panel">

                    <?php echo td_panel_generator::box_start('如何使用自定义字体文档', true); ?>

                        <!-- info text -->
                        <div class="td-box-row">
                            <div class="td-box-description td-box-full">
                                <p><?php echo TD_THEME_NAME ?>支持自定义字体文件，typekit字体和谷歌字体。看到字体后请刷新主面板!</p>
                                <p><a href="http://forum.tagdiv.com/custom-typography/" target="_blank">阅读更多</a>关于字体系统</p>
                            </div>
                        </div>

                    <?php echo td_panel_generator::box_end();?>
                    </div>


                    <!-- Custom fonts files -->
                    <div  class="td-panel-active td-panel">

                        <?php echo td_panel_generator::box_start('自定义字体文件', false); ?>


                        <!-- info text -->
                        <div class="td-box-row">
                            <div class="td-box-description td-box-full">
                                <p>使用自定义字体文件：</p>

                                <ul>
                                    <li>添加链接到字体文件.woff格式，添加font-face名到自定义字体文件部分并点击保存设置。</li>
                                    <li>您可以使用您的转换字体文件从任何格式转换成.woff格式使用<a href="http://www.fontsquirrel.com/tools/webfont-generator">fontsquirrel</a> (免费工具)</li>
                                    <li>一旦点击 '保存更改' 按钮，你瘵在自定义排版面板 ⇢ 字体系列 下拉中看到font-face</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Custom Font file 1 -->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">自定义字体文件 1</span>
                                <p>添加链接到文件 ( .woff 格式 )</p>
                            </div>
                            <div class="td-box-control-full td-panel-input-wide">
                                <?php
                                echo td_panel_generator::input(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'font_file_1'
                                ));
                                ?>
                            </div>
                        </div>


                        <!-- Custom Font name 1 -->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">自定义字体系列 1</span>
                                <p>输入此字体名字</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::input(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'font_family_1'
                                ));
                                ?>
                            </div>
                        </div>


                        <div class="td-box-row">
                            <div class="td-box-description"></div>
                            <div class="td-box-control-full"></div>
                        </div>



                        <!-- Custom Font file 2 -->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">自定义字体文件 2</span>
                                <p>添加链接到文件 ( .woff 格式 )</p>
                            </div>
                            <div class="td-box-control-full td-panel-input-wide">
                                <?php
                                echo td_panel_generator::input(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'font_file_2'
                                ));
                                ?>
                            </div>
                        </div>


                        <!-- Custom Font name 2 -->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">自定义字体系列 2</span>
                                <p>输入此字体名字</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::input(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'font_family_2'
                                ));
                                ?>
                            </div>
                        </div>


                        <div class="td-box-row">
                            <div class="td-box-description"></div>
                            <div class="td-box-control-full"></div>
                        </div>



                        <!-- Custom Font file 3 -->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">自定义字体文件 3</span>
                                <p>添加链接到文件 ( .woff 格式 )</p>
                            </div>
                            <div class="td-box-control-full td-panel-input-wide">
                                <?php
                                echo td_panel_generator::input(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'font_file_3'
                                ));
                                ?>
                            </div>
                        </div>


                        <!-- Custom Font name 3 -->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">自定义字体系列 3</span>
                                <p>输入此字体名字</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::input(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'font_family_3'
                                ));
                                ?>
                            </div>
                        </div>


                        <?php echo td_panel_generator::box_end();?>
                    </div>



                    <!-- typekit.com fonts -->
                    <div  class="td-panel-active td-panel">

                        <?php echo td_panel_generator::box_start('Typekit.com字体', false); ?>

                        <!-- javascript from typekit.com-->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">Javascript代码</span>
                                <p>从typekit.com复制javascript代码并粘贴到这里</p>
                            </div>
                            <div class="td-box-control-full td-panel-input-wide">
                                <?php
                                echo td_panel_generator::textarea(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'typekit_js',
                                ));
                                ?>
                            </div>
                        </div>


                        <!-- typekit.com Custom Font font family 1-->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">自定义字体系列 1</span>
                                <p>输入此字体名字</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::input(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'type_kit_font_family_1'
                                ));
                                ?>
                            </div>
                        </div>


                        <!-- typekit.com Custom Font font family 2-->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">自定义字体系列 2</span>
                                <p>输入此字体名字</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::input(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'type_kit_font_family_2'
                                ));
                                ?>
                            </div>
                        </div>


                        <!-- typekit.com Custom Font font family 3-->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">自定义字体系列 3</span>
                                <p>输入此字体名字</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::input(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'type_kit_font_family_3'
                                ));
                                ?>
                            </div>
                        </div>

                        <?php echo td_panel_generator::box_end();?>
                    </div>



                    <!-- google fonts settings-->
                    <div  class="td-panel-active td-panel">
                        <?php echo td_panel_generator::box_start('谷歌字体设置', false); ?>


                        <!-- info text -->
                        <div class="td-box-row">
                            <div class="td-box-description td-box-full">
                                <p>你可以在这里选择每个谷歌字体加载什么字符集。字符集仅在字体支持特殊字形时才加载。尝试只启用字体集，因为加载每个字体集将使网站加载变慢。</p>
                            </div>
                        </div>


                        <!-- google fonts settings-->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">拉丁支持</span>
                                <p>如果可能，支持拉丁字符，加载字体文件</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::checkbox(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'g_latin',
                                    'true_value' => 'latin',
                                    'false_value' => ''
                                ));
                                ?>
                            </div>
                        </div>


                        <!-- google fonts settings-->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">拉丁扩展支持</span>
                                <p>如果可能，支持拉丁扩展字符，加载字体文件</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::checkbox(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'g_latin-ext',
                                    'true_value' => 'latin-ext',
                                    'false_value' => ''
                                ));
                                ?>
                            </div>
                        </div>


                        <!-- google fonts settings-->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">西里尔支持</span>
                                <p>如果可能，支持西尔里字符，加载字体文件</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::checkbox(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'g_cyrillic',
                                    'true_value' => 'cyrillic',
                                    'false_value' => ''
                                ));
                                ?>
                            </div>
                        </div>


                        <!-- google fonts settings-->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">西里尔扩展支持</span>
                                <p>如果可能，支持西尔里扩展字符，加载字体文件</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::checkbox(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'g_cyrillic-ext',
                                    'true_value' => 'cyrillic-ext',
                                    'false_value' => ''
                                ));
                                ?>
                            </div>
                        </div>


                        <!-- google fonts settings-->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">希腊支持</span>
                                <p>如果可能，支持希腊字符，加载字体文件</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::checkbox(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'g_greek',
                                    'true_value' => 'greek',
                                    'false_value' => ''
                                ));
                                ?>
                            </div>
                        </div>


                        <!-- google fonts settings-->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">希腊扩展支持</span>
                                <p>如果可能，支持希腊扩展字符，加载字体文件</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::checkbox(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'g_greek-ext',
                                    'true_value' => 'greek-ext',
                                    'false_value' => ''
                                ));
                                ?>
                            </div>
                        </div>


                        <!-- google fonts settings-->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">梵文支持</span>
                                <p>如果可能，支持梵文字符，加载字体文件</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::checkbox(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'g_devanagari',
                                    'true_value' => 'devanagari',
                                    'false_value' => ''
                                ));
                                ?>
                            </div>
                        </div>


                        <!-- google fonts settings-->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">越南文支持</span>
                                <p>如果可能，支持越南文字符，加载字体文件</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::checkbox(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'g_vietnamese',
                                    'true_value' => 'vietnamese',
                                    'false_value' => ''
                                ));
                                ?>
                            </div>
                        </div>


                        <!-- google fonts settings-->
                        <div class="td-box-row">
                            <div class="td-box-description">
                                <span class="td-box-title">高棉支持</span>
                                <p>如果可能，支持高棉字符，加载字体文件</p>
                            </div>
                            <div class="td-box-control-full">
                                <?php
                                echo td_panel_generator::checkbox(array(
                                    'ds' => 'td_fonts_user_insert',
                                    'option_id' => 'g_khmer',
                                    'true_value' => 'khmer',
                                    'false_value' => ''
                                ));
                                ?>
                            </div>
                        </div>

                        <?php echo td_panel_generator::box_end();?>
                    </div>

                </div>

            </div>

        </div>


        <div class="td-clear"></div>

        <div class="td-panel-main-footer">
            <input type="submit" id="td_button_save_panel" class="td-panel-save-button" value="保存设置">
        </div>

    </div>

    <div class="td-clear"></div>


</form>
</div>
<?php if($td_fonts_user_inserted == 1){?><script type="text/javascript">alert('保存成功！');</script><?php }?>