<?php
/**
 * Created by ra on 5/15/2015.
 */

require_once "td_view_header.php";
?>



<div class="td-admin-wrap about-wrap">


    <div class="td-welcome-header">
        <h1>欢迎使用<?php echo TD_THEME_NAME?> <div class="td-welcome-version">V <?php echo TD_THEME_VERSION?></div></h1>
        <div class="about-text">
            感谢您使用我们的主题，我们非常努力的发布了伟大的产品，我们会尽我们最大的努力支持此主题，修复所有问题。
        </div>
    </div>


    <?php if (!is_plugin_active('js_composer/js_composer.php')) { ?>
        <div class="td-admin-box-text td-admin-required-plugins">
            <div class="td-admin-required-plugins-wrap">
                <p><strong>请安装Visual Composer</strong></p>
                <p>Visual Composer是此主题必装的插件，为了最好的工作。</p>
                <a class="button button-primary" href="admin.php?page=td_theme_plugins">去插件安装页</a>
            </div>
        </div>
    <?php } ?>

    <hr/>

    <div class="feature-section two-col">
        <div class="col">
            <h3>快速开始：</h3>
            <p>如果你想在你的侧边栏添加计数，安装visual composer插件也安装社交计数插件 - 从我们的<a href="admin.php?page=td_theme_plugins">插件面板</a></p>
            <p><a href="admin.php?page=td_theme_demos">尝试我们的演示</a>在你的测试网站。我们的演示系统支持完整的卸载+回滚到原始网站。</p>


            <h3>从Newspaper 4 升级:</h3>
            <p>要从版本4升级，请运行此<a href="admin.php?page=td_theme_panel&td_page=td_view_update_newspaper_6" onclick="return confirm('你确定？运行更新脚本前请备份你的网站！\n\n警告：此导入脚本会更改你的侧边栏、小工具、页面模板、文章模板和简码\n警告：运行导入脚本之后，它不能回滚，你不能返回版本4，仅能从数据库备份')">升级脚本</a>。注意：更新前请备份你的网站！</p>

        </div>


        <div class="col">
            <img src="<?php echo get_template_directory_uri()?>/images/panel/admin-panel/logo-panel.jpg">
        </div>
    </div>


    <hr style=" border:none !important;"/>

    <h3>一个简单的方法来使内容</h3>
    <p>我们在过去一年的主要目标是使主题更容易使用，更人性化。如果你有任何问题，或者您有任何意见，请让我们知道，当我们得到您的反馈和建议时，我们会很高兴。</p>

    <div style="margin-top: 26px;">
        <div class="td-admin-box-text td-admin-box-three">
            <h2>支持论坛</h2>
            <p>我们通过我们的论坛提供出色的支持。要获取支持，你首先需要注册（创建帐户）并在<?php echo TD_THEME_NAME?>部分打开一个线程。</p>
            <a class="button button-primary" href="http://forum.tagdiv.com" target="_blank">打开论坛</a>
        </div>
        <div class="td-admin-box-text td-admin-box-three">
            <h2>文档和学习</h2>
            <p>我们的在线文档将会给你关于主题的重要信息。这是一个特殊的资源，开始为主题探索真正潜力。</p>
            <a class="button button-primary" href="<?php echo TD_THEME_DOC_URL?>" target="_blank">打开文档</a>
        </div>
        <div class="td-admin-box-text td-admin-box-three td-admin-box-last">
            <h2>视频教程</h2>
            <p>我们认为，最简单的学习方式是观看视频教程。我们有越来越多的视频教程库帮助你。</p>
            <a class="button button-primary" href="<?php echo TD_THEME_VIDEO_TUTORIALS_URL?>" target="_blank">视频教程</a>
        </div>
    </div>




    <!--
    <div class="td-admin-box-text">
        <p>Thank you for choosing the best theme we have ever build!</p>
		<a class="button button-primary" href="http://demo.tagdiv.com/<?php echo strtolower(TD_THEME_NAME);?>" target="_blank">View demo</a>
		<a class="button button-primary" href="http://themeforest.net/user/tagDiv" target="_blank">Our portfolio</a>
	</div>
	-->
</div>