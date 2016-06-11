<!-- smart sidebar support -->
<?php echo td_panel_generator::box_start('智能侧边栏', false); ?>
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <p>从这里你可以启用和禁用所有模板智能侧边栏。智能侧边栏是一个前缀 (粘性) 侧边栏自动调整，且它随内容滚动。智能侧边栏在iOS（iPad）和手机设备恢复到正常侧边栏。以下小工具在智能侧边栏不支持：</p>
            <?php echo td_global::$td_wp_admin_text_list['text_smart_sidebar_widget_support'] ?>
        </div>



        <div class="td-box-row">
            <div class="td-box-description">
                <span class="td-box-title">智能侧边栏</span>
                <p>启用/禁用所有模板智能侧边栏</p>
            </div>
            <div class="td-box-control-full">
                <?php
                echo td_panel_generator::checkbox(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_smart_sidebar',
                    'true_value' => 'enabled',
                    'false_value' => ''
                ));
                ?>
            </div>
        </div>

        <div class="td-box-row-margin-bottom"></div>
    </div>
<?php echo td_panel_generator::box_end();?>



<!-- breadcrumbs -->
<?php echo td_panel_generator::box_start('面包屑导航', false); ?>

    <!-- text -->
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <p>你可以从这里更改出现在你网站的自定义面包屑导航。面包屑导航是非常有用的导航元素，它看起来像这样：'首页 > 我的分类 > 我的文章标题'.
            由于面包屑导航对于人类和搜索引擎如此的重要，所以<?php echo TD_THEME_NAME?>附带了他们的配置选项.
            </p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

    <div class="td-box-section-separator"></div>

    <!-- Show breadcrumbs on post -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示面包屑导航</span>
            <p>
                启用或禁用面包屑导航
                <?php td_util::tooltip_html('
                        <h3>启用/禁用面包屑导航：</h3>
                        <p>你可以从这里启用和禁用面包屑导航。此设置影响所有网站页面。</p>

                ', 'right')?>
            </p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_breadcrumbs_show',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>


    <div class="td-box-section-separator"></div>


    <!-- Show breadcrumbs home link -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示面包屑导航首页链接</span>
            <p>
                显示或隐藏面包屑导航中的首页链接
                <?php td_util::tooltip_html('
                        <h3>显示或隐藏面包屑导航首页链接：</h3>
                        <p>为了更好的符合SEO，我们推荐此项设置保留启用。面包屑导航中的\'首页\'链接提供了一个易于访问的方向到网站首页.</p>

                ', 'right')?>
            </p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_breadcrumbs_show_home',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>



    <!-- Show breadcrumbs parent category -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示父级分类</span>
            <p>
                显示或隐藏父级分类链接。例如：首页 > 父级分类 > 分类
                <?php td_util::tooltip_html('
                        <h3>显示父级分类：</h3>
                        <p>如果文章\'主分类\'有一个父级分类，如果此设置启用了，它将仅在面包屑导航显示</p>
                ', 'right')?>
            </p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_breadcrumbs_show_parent',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>


    <!-- show Breadcrumbs article title -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示文章标题</span>
            <p>
                在文章页显示或隐藏文章标题
                <?php td_util::tooltip_html('
                        <h3>在面包屑导航显示文章标题：</h3>
                        <p>如果你不需要这个特定的原因，可以禁用。此设置只影响面包屑。不是文章的文章标题</p>
                ', 'right')?>
            </p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_breadcrumbs_show_article',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>

<?php echo td_panel_generator::box_end();?>




<!-- Lazy loading animation -->
<?php echo td_panel_generator::box_start('图片加载 - 动画 (延迟)', false); ?>
    <!-- text -->
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <p>动画效果允许你动画你的主题图片为滚动，从上到下。
                它适用于下个和上个操作创建一个加载图片效果到右侧或左侧.</p>
	        <p>如果没有在2秒内加载所有必须图片，动画效果将被取消。如果启用动画，此规则也可在区块加载内容使用ajax。</p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

    <!-- use lazy loading animation -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">使用加载动画图片</span>
            <p>禁用或启用加载动画效果.</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_animation_stack',
                'true_value' => '',
                'false_value' => 'no'
            ));
            ?>
        </div>
    </div>

	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title">加载效果</span>
			<p>你可以选择以下效果中的一个，将用于第一个图片加载。</p>
		</div>
		<div class="td-box-control-full">
			<?php
			echo td_panel_generator::radio_button_control(array(
				'ds' => 'td_option',
				'option_id' => 'tds_animation_stack_effect',
				'values' => td_global::$td_animation_stack_effects
			));
			?>
		</div>
	</div>
<?php echo td_panel_generator::box_end();?>



<!-- smooth scroll -->
<?php echo td_panel_generator::box_start('平滑滚动', false); ?>
    <!-- text -->
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <p>启用或禁用浏览器平滑滚动，没有内置的平滑滚动（谷歌浏览器）</p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>
    <!-- Stretch background -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">平滑滚动</span>
            <p>禁用或启用平滑滚动</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_smooth_scroll',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
        </div>
    </div>
<?php echo td_panel_generator::box_end();?>





<hr>
<div class="td-section-separator">WordPress模板</div>


<!-- Theme information -->
<?php echo td_panel_generator::box_start('更多信息'); ?>
<!-- text -->
<div class="td-box-row">
    <div class="td-box-description td-box-full">
        <p>在此部分，你可以配置<a href="http://codex.wordpress.org/Template_Hierarchy" target="_blank">默认wordpress模板</a>。大多数模板支持以下配置：</p>
        <ul>
            <li>如何在默认wordpress循环显示文章</li>
            <li>侧边栏位置</li>
            <li>显示什么侧边栏</li>
        </ul>
    </div>

    <div class="td-box-row-margin-bottom"></div>
</div>
<?php echo td_panel_generator::box_end();?>


<!-- 404 template -->
    <?php echo td_panel_generator::box_start('404模板', false); ?>

    <div class="td-box-description td-box-full">
        <p>当用户请求页面或文章不存在，WordPress将使用此模板.</p>
        <ul>
            <li>此模板位于<strong>404.php</strong>文件。</li>
            <li>从你的网站显示最新6篇文章和 "哎呀... 错误404, 对不起，但你要找的页面不存在."信息</li>
            <li>从你的网站查看<a href="<?php echo get_home_url()?>/?p=9999999" target="_blank">示例404错误</a></li>
            <li>阅读更多：<a href="http://codex.wordpress.org/Creating_an_Error_404_Page" target="_blank">WordPress 404错误</a>, <a target="_blank" href="http://en.wikipedia.org/wiki/HTTP_404">HTTP 404</a></li>
        </ul>
    </div>


    <!-- Custom Sidebar + position -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">文章显示视图</span>
            <p>选择模块类型，这是你的文章列表如何显示</p>
        </div>
        <div class="td-box-control-full td-panel-module">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_option',
                'option_id' => 'tds_404_page_layout',
                'values' => td_panel_generator::helper_display_modules('enabled_on_loops')
            ));
            ?>
        </div>
    </div>
<?php echo td_panel_generator::box_end();?>





<!-- Archive page -->
    <?php echo td_panel_generator::box_start('归档模板', false); ?>


    <?php
        // prepare the archive links
        $cur_archive_year = date('Y');
        $cur_archive_month = date('n');
        $cur_archive_day = date('j');
    ?>
    <div class="td-box-description td-box-full">
        <p>此模板通过WordPress生成归档。默认WordPress生成每日、每月和每年归档</p>
        <ul>
            <li>此模板位于<strong>archive.php</strong>文件。</li>
            <li>
                按日、月或年显示最新文章。你可以链接到任意年或月或日，不只是当前的一个
                <a href="http://codex.wordpress.org/Creating_an_Archive_Index">阅读更多</a>
            </li>
            <li>如果没有在所选时间内的文章发布，WordPress将发出一个404错误。这有利于SEO</li>
            <li>
                你的博客示例归档：
                <a href="<?php echo get_year_link($cur_archive_year) ?>" target="_blank">当年</a>,
                <a href="<?php echo get_month_link($cur_archive_year, $cur_archive_month) ?>" target="_blank">当月</a>,
                <a href="<?php echo  get_day_link($cur_archive_year, $cur_archive_month, $cur_archive_day) ?>" target="_blank">今天</a>
            </li>
        </ul>
    </div>


    <!-- DISPLAY VIEW -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">文章显示视图</span>
            <p>选择模板类型，这是文章列表如何显示</p>
        </div>
        <div class="td-box-control-full td-panel-module">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_option',
                'option_id' => 'tds_archive_page_layout',
                'values' => td_panel_generator::helper_display_modules('enabled_on_loops')
            ));
            ?>
        </div>
    </div>

    <!-- Custom Sidebar + position -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">自定义侧边栏 + 位置</span>
            <p>侧边栏位置和自定义侧边栏</p>
        </div>
        <div class="td-box-control-full td-panel-sidebar-pos">
            <div class="td-display-inline-block">
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_archive_sidebar_pos',
                    'values' => array(
                        array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                        array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                        array('text' => '', 'title' => '', 'val' => '', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                    )
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">选择侧边栏位置</div>
            </div>
            <div class="td-display-inline-block td_sidebars_pulldown_align">
                <?php
                echo td_panel_generator::sidebar_pulldown(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_archive_sidebar'
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">创建或选择一个现有的侧边栏</div>
            </div>
        </div>
    </div>
<?php echo td_panel_generator::box_end();?>





<!-- Attachment template -->
    <?php echo td_panel_generator::box_start('附件模板', false); ?>

    <div class="td-box-description td-box-full">
        <p>此模板用于显示一个附件（通常是图像）。一般WordPress默认不在前台使用，仅通过默认相册使用。</p>
        <ul>
            <li>此模板位于<strong>attachment.php</strong>文件</li>
            <li>要查看此模板，去媒体 ⇢ 库 ⇢ 打开一个图片 ⇢ 点击查看附件页面</li>
        </ul>
    </div>

    <!-- Custom Sidebar + position -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">自定义侧边栏 + 位置</span>
            <p>侧边栏位置和自定义侧边栏</p>
        </div>
        <div class="td-box-control-full td-panel-sidebar-pos">
            <div class="td-display-inline-block">
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_attachment_sidebar_pos',
                    'values' => array(
                        array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                        array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                        array('text' => '', 'title' => '', 'val' => '', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                    )
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">选择侧边栏位置</div>
            </div>
            <div class="td-display-inline-block td_sidebars_pulldown_align">
                <?php
                echo td_panel_generator::sidebar_pulldown(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_attachment_sidebar'
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">创建或选择现有侧边栏</div>
            </div>
        </div>
    </div>
<?php echo td_panel_generator::box_end();?>




<!-- AUTHOR page -->
    <?php echo td_panel_generator::box_start('作者模板', false); ?>

    <div class="td-box-description td-box-full">
        <p>当用户在网站前台点击作者时显示的作者模板.</p>
        <ul>
            <li>此模板位于<strong>author.php</strong>文件。</li>
            <li>在作者页眉下面，此模板有一个最新文章循环 (loop.php)</li>
            <li>为当前登录用户查看<a href="<?php echo get_author_posts_url(get_current_user_id())?>" target="_blank">作者页演示</a>.</li>
        </ul>
    </div>


    <!-- DISPLAY VIEW -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">文章显示视图</span>
            <p>选择模块类型，这是你的文章列表如何显示</p>
        </div>
        <div class="td-box-control-full td-panel-module">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_option',
                'option_id' => 'tds_author_page_layout',
                'values' => td_panel_generator::helper_display_modules('enabled_on_loops')
            ));
            ?>
        </div>
    </div>


    <!-- Custom Sidebar + position -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">自定义侧边栏 + 位置</span>
            <p>侧边栏位置和自定义侧边栏</p>
        </div>
        <div class="td-box-control-full td-panel-sidebar-pos">
            <div class="td-display-inline-block">
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_author_sidebar_pos',
                    'values' => array(
                        array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                        array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                        array('text' => '', 'title' => '', 'val' => '', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                    )
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">选择侧边栏位置</div>
            </div>
            <div class="td-display-inline-block td_sidebars_pulldown_align">
                <?php
                echo td_panel_generator::sidebar_pulldown(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_author_sidebar'
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">创建或选择现有侧边栏</div>
            </div>
        </div>
    </div>
<?php echo td_panel_generator::box_end();?>




<!-- Blog and posts template -->
    <?php echo td_panel_generator::box_start('博客和文章模板', false); ?>

    <div class="td-box-description td-box-full">
        <p>此设置用于两个模板：</p>
        <ul>
            <li><strong>single.php</strong> - 单个文章模板 (仅侧边栏位置和默认侧边栏在这里应用)</li>
            <li><strong>index.php</strong> - 默认博客索引 (所有文章在哪里一个在另一个之后列出页面) - 此框所有设置应用到此模板</li>
            <li><strong>Just a tip</strong> - 当设置一个侧边栏位置或另一个侧边栏同时编辑一个文章，一个将覆盖你在这里设置的一个。</li>
        </ul>
    </div>

    <!-- ARTICLE DISPLAY VIEW -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">文章显示视图</span>
            <p>选择一个模块类型，这是文章列表如何显示</p>
        </div>
        <div class="td-box-control-full td-panel-module">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_option',
                'option_id' => 'tds_home_page_layout',
                'values' => td_panel_generator::helper_display_modules('enabled_on_loops')
            ));
            ?>
        </div>
    </div>


    <!-- Custom Sidebar + position -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">自定义侧边栏 + 位置</span>
            <p>侧边栏位置和自定义侧边栏</p>
        </div>
        <div class="td-box-control-full td-panel-sidebar-pos">
            <div class="td-display-inline-block">
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_home_sidebar_pos',
                    'values' => array(
                        array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                        array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                        array('text' => '', 'title' => '', 'val' => '', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                    )
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">选择侧边栏位置</div>
            </div>
            <div class="td-display-inline-block td_sidebars_pulldown_align">
                <?php
                echo td_panel_generator::sidebar_pulldown(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_home_sidebar'
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">创建或选择现有侧边栏</div>
            </div>
        </div>
    </div>
<?php echo td_panel_generator::box_end();?>









<!-- Page template -->
<?php echo td_panel_generator::box_start('页面模板', false); ?>


    <div class="td-box-description td-box-full">
        <p>从这里选择侧边栏位置和侧边栏。这两个设置均可更改在每个页面的基础。</p>
        <ul>
            <li>此模板位于<strong>page.php</strong>文件。</li>
        </ul>
    </div>



    <!-- Custom Sidebar + position -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">自定义侧边栏 + 位置</span>
            <p>侧边栏位置和自定义侧边栏</p>
        </div>
        <div class="td-box-control-full td-panel-sidebar-pos">
            <div class="td-display-inline-block">
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_page_sidebar_pos',
                    'values' => array(
                        array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                        array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                        array('text' => '', 'title' => '', 'val' => '', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                    )
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">选择侧边栏位置</div>
            </div>
            <div class="td-display-inline-block td_sidebars_pulldown_align">
                <?php
                echo td_panel_generator::sidebar_pulldown(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_page_sidebar'
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">创建或选择现有侧边栏</div>
            </div>
        </div>
    </div>



    <!-- Disable comments on pages -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">禁用页面评论</span>
            <p>启用或禁用整站页面评论。此选项默认显示</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_disable_comments_pages',
                'true_value' => '',
                'false_value' => 'show_comments'
            ));
            ?>
        </div>
    </div>



<?php echo td_panel_generator::box_end();?>




<!-- Search page -->
    <?php echo td_panel_generator::box_start('搜索模板', false); ?>

    <div class="td-box-description td-box-full">
        <p>选择搜索页布局.</p>
        <ul>
            <li>从你的网站选择一个<a href="<?php echo esc_url(home_url('/?s=and')) /** @see page-search-box.php */?>" target="_blank">示例搜索页</a>.</li>
            <li>此模板位于<strong>search.php</strong>文件.</li>
        </ul>
    </div>


    <!-- DISPLAY VIEW -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">文章显示视图</span>
            <p>选择模块类型，这是你的文章列表如何显示</p>
        </div>
        <div class="td-box-control-full td-panel-module">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_option',
                'option_id' => 'tds_search_page_layout',
                'values' => td_panel_generator::helper_display_modules('enabled_on_loops')
            ));
            ?>
        </div>
    </div>


    <!-- Custom Sidebar + position -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">自定义侧边栏 + 位置</span>
            <p>侧边栏位置和自定义侧边栏</p>
        </div>
        <div class="td-box-control-full td-panel-sidebar-pos">
            <div class="td-display-inline-block">
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_search_sidebar_pos',
                    'values' => array(
                        array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                        array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                        array('text' => '', 'title' => '', 'val' => '', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                    )
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">选择侧边栏位置</div>
            </div>
            <div class="td-display-inline-block td_sidebars_pulldown_align">
                <?php
                echo td_panel_generator::sidebar_pulldown(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_search_sidebar'
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">创建或选择现有侧边栏</div>
            </div>
        </div>
    </div>
<?php echo td_panel_generator::box_end();?>




<!-- TAG page -->
<?php echo td_panel_generator::box_start('标签模板', false); ?>


    <div class="td-box-description td-box-full">
        <p>设置所有标签默认布局.</p>
        <ul>
            <li>你可以通过去 文章 ⇢ 标签 ⇢ 悬停标签 ⇢ 选择视图 查看每个标签页</li>
            <li>此模板位于<strong>tag.php</strong>文件.</li>
        </ul>
    </div>


    <!-- DISPLAY VIEW -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">文章显示视图</span>
            <p>选择模块类型，这是你的文章列表如何显示</p>
        </div>
        <div class="td-box-control-full td-panel-module">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_option',
                'option_id' => 'tds_tag_page_layout',
                'values' => td_panel_generator::helper_display_modules('enabled_on_loops')
            ));
            ?>
        </div>
    </div>


    <!-- Custom Sidebar + position -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">自定义侧边栏 + 位置</span>
            <p>侧边栏位置和自定义侧边栏</p>
        </div>
        <div class="td-box-control-full td-panel-sidebar-pos">
            <div class="td-display-inline-block">
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_tag_sidebar_pos',
                    'values' => array(
                        array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                        array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                        array('text' => '', 'title' => '', 'val' => '', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                    )
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">选择侧边栏位置</div>
            </div>
            <div class="td-display-inline-block td_sidebars_pulldown_align">
                <?php
                echo td_panel_generator::sidebar_pulldown(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_tag_sidebar'
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">创建或选择现有侧边栏</div>
            </div>
        </div>
    </div>

<?php echo td_panel_generator::box_end();?>




<!-- Woocommerce template -->
<?php echo td_panel_generator::box_start('Woocommerce模板', false); ?>
    <div class="td-box-description td-box-full">
        <p>设置woocommerce页面自定义侧边栏和位置。</p>
    </div>



    <!-- Shop homepage + archives - custom Sidebar + position -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">商店首页 + 归档</span>
            <p>侧边栏位置和自定义侧边栏</p>
        </div>
        <div class="td-box-control-full td-panel-sidebar-pos">
            <div class="td-display-inline-block">
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_woo_sidebar_pos',
                    'values' => array(
                        array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                        array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                        array('text' => '', 'title' => '', 'val' => '', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                    )
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">选择侧边栏位置</div>
            </div>
            <div class="td-display-inline-block td_sidebars_pulldown_align">
                <?php
                echo td_panel_generator::sidebar_pulldown(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_woo_sidebar'
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">创建或选择现有侧边栏</div>
            </div>
        </div>
    </div>


    <!-- Shop single product page - custom Sidebar + position -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">商店单个产品页</span>
            <p>侧边栏位置和自定义侧边栏</p>
        </div>
        <div class="td-box-control-full td-panel-sidebar-pos">
            <div class="td-display-inline-block">
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_woo-single_sidebar_pos',
                    'values' => array(
                        array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                        array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                        array('text' => '', 'title' => '', 'val' => '', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                    )
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">选择侧边栏位置</div>
            </div>
            <div class="td-display-inline-block td_sidebars_pulldown_align">
                <?php
                echo td_panel_generator::sidebar_pulldown(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_woo-single_sidebar'
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">创建或选择现有侧边栏</div>
            </div>
        </div>
    </div>



<?php echo td_panel_generator::box_end();?>




<!-- bbPress template -->
<?php echo td_panel_generator::box_start('bbPress模板', false); ?>

    <div class="td-box-description td-box-full">
        <p>从这里设置bbPress模板</p>
    </div>

    <!-- Custom Sidebar + position -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">自定义侧边栏 + 位置</span>
            <p>侧边栏位置和自定义侧边栏</p>
        </div>
        <div class="td-box-control-full td-panel-sidebar-pos">
            <div class="td-display-inline-block">
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_bbpress_sidebar_pos',
                    'values' => array(
                        array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                        array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                        array('text' => '', 'title' => '', 'val' => '', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                    )
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">选择侧边栏位置</div>
            </div>
            <div class="td-display-inline-block td_sidebars_pulldown_align">
                <?php
                echo td_panel_generator::sidebar_pulldown(array(
                    'ds' => 'td_option',
                    'option_id' => 'tds_bbpress_sidebar'
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">创建或选择现有侧边栏</div>
            </div>
        </div>
    </div>

<?php echo td_panel_generator::box_end();?>