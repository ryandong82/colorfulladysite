<!-- post settings -->
<?php echo td_panel_generator::box_start('文章和自定义文章类型', false); ?>

	<!-- Show categories -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title">显示分类标签</span>
			<p>启用或禁用分类标签 <br>(单个文章页)</p>
		</div>
		<div class="td-box-control-full">
			<?php
			echo td_panel_generator::checkbox(array(
				'ds' => 'td_option',
				'option_id' => 'tds_p_categories_tags',
				'true_value' => '',
				'false_value' => 'hide'
			));
			?>
		</div>
	</div>

    <!-- Show author name -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示作者名</span>
            <p>启用或禁用作者名 <br>(在区块, 模块和单个文章页)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_p_show_author_name',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>

    <!-- Show date -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示日期</span>
            <p>启用或禁用文章日期 <br>(在区块、模块和单个文章页)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_p_show_date',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>


    <!-- Show post views -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示文章查看</span>
            <p>启用或禁用文章查看<br>(在区块、模块和单个文章页)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_p_show_views',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>


    <!-- SHow comment count -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示评论数</span>
            <p>启用或禁用评论数 <br>(在区块、模块和单个文章页)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_p_show_comments',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>




    <!-- Show tags -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">在文章显示标签</span>
            <p>启用或禁用文章标签 <br>(文章页底部)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_show_tags',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>


    <!-- Show author box -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示作者框</span>
            <p>启用或禁用作者框 <br>(文章页底部)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_show_author_box',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>


    <!-- Show next and previous posts -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示下一个和上一个文章</span>
            <p>显示或隐藏`下一个` 和 `上一个` 文章 <br>(文章页底部)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_show_next_prev',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>


    <!-- Disable comments on post pages -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">在文章禁用评论</span>
            <p>在整个网站启用或禁用文章页评论。此选项默认是关闭的。</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_disable_comments_sidewide',
                'true_value' => '',
                'false_value' => 'disable'
            ));
            ?>
        </div>
    </div>



	<!-- set general modal image -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title">常规模态图片</span>
			<p>启用或禁用常规模态图片查看器所有文章图片，所以你不必为每个文章分别设置。</p>
			<p>一个单独的图片文章应用设置后，考虑禁用此功能。</p>
		</div>
		<div class="td-box-control-full">
			<?php
			echo td_panel_generator::checkbox(array(
				'ds' => 'td_option',
				'option_id' => 'tds_general_modal_image',
				'true_value' => 'yes',
				'false_value' => ''
			));
			?>
		</div>
	</div>



<?php echo td_panel_generator::box_end();?>



<!-- Default site post template -->
<?php echo td_panel_generator::box_start('默认文章模板 (站内)', false);?>

<!-- Default post template -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">默认网站文章模板</span>
        <p>设置此选项使所有文章页没有文章模板集，显示使用此模板。你可以在每个文章覆盖此设置。</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::visual_select_o(array(
            'ds' => 'td_option',
            'option_id' => 'td_default_site_post_template',
            'values' => td_api_single_template::_helper_td_global_list_to_panel_values()
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end();?>







<!-- featured images -->
<?php echo td_panel_generator::box_start('精选图片', false); ?>

    <!-- SHOW FEATURED IMAGE -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示精选图片</span>
            <p>显示或隐藏精选图片</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_show_featured_image',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>


    <!-- Featured image placeholder -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">精选图片占位符</span>
            <p>当文章没有设置精选图片时，将加载占位符图片。</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_hide_featured_image_placeholder',
                'true_value' => '',
                'false_value' => 'hide_placeholder'
            ));
            ?>
        </div>
    </div>


    <!-- Featured image lightbox -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">精选图片灯箱</span>
            <p>当点击文章内特色图像时怎么做。(文章页)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::radio_button_control(array(
                'ds' => 'td_option',
                'option_id' => 'tds_featured_image_view_setting',
                'values' => array(
                    array('text' => '使用灯箱', 'val' => ''),
                    array('text' => '无灯箱', 'val' => 'no_modal')
                )
            ));
            ?>
        </div>
    </div>

<?php echo td_panel_generator::box_end();?>



<!-- related article -->
<?php echo td_panel_generator::box_start('相关文章', false); ?>

    <!-- text -->
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <p>在每个文章底部，主题在相关文章部分显示三个或五个相似的文章。</p>
            <ul>
                <li>在带侧边栏布局显示三个文章</li>
                <li>在全宽布局显示五个文章</li>
            </ul>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

    <!-- Show similar article -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示相关文章</span>
            <p>启用或禁用相关文章部分</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_similar_articles',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>


    <!-- Related article - Type -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">相关文章 - 类型</span>
            <p>如何选择相关文章：</p>
            <ul>
                <li>按分类 - 从当前文章共同点挑选至少一个分类的文章</li>
                <li>按标签 - 从当前文章共同点挑选至少一个标签的文章</li>
            </ul>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::radio_button_control(array(
                'ds' => 'td_option',
                'option_id' => 'tds_similar_articles_type',
                'values' => array(
                    array('text' => '按分类', 'val' => ''),
                    array('text' => '按标签', 'val' => 'by_tag')
                )
            ));
            ?>
        </div>
    </div>




    <!-- Related articles count -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">相关文章 - 计数</span>
            <p>显示多少相关文章：</p>
            <ul>
                <li>当布局带侧边栏时一行有3个文章</li>
                <li>当布局无侧边栏时一行有5个文章</li>
            </ul>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::radio_button_control(array(
                'ds' => 'td_option',
                'option_id' => 'tds_similar_articles_rows',
                'values' => array(
                    array('text' => '1行相关文章 (3/5)', 'val' => ''),
                    array('text' => '2行相关文章 (6/10)', 'val' => '2'),
                    array('text' => '3行相关文章 (9/15)', 'val' => '3'),
                    array('text' => '4行相关文章 (12/20)', 'val' => '4')
                )
            ));
            ?>
        </div>
    </div>

<?php echo td_panel_generator::box_end();?>



<!-- sharing -->
<?php echo td_panel_generator::box_start('分享', false); ?>


    <!-- text -->
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <p>所有<?php echo TD_THEME_NAME?>文章在文章开始（一般在标题下面）和文章结尾（标签之后）有分享按钮。每个文章分享部分来自分享按钮 + facebook喜欢 + tweeter tweet按钮.</p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>


<div class="td-box-section-separator"></div>


    <!-- ARTICLE sharing top -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">顶部文章分享</span>
            <p>显示或隐藏文章页顶部文章分享</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_top_social_show',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>

    <!-- ARTICLE top like -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">顶部文章中国大陆分享网站</span>
            <p>显示或隐藏文章顶部大陆分享网站</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_top_like_tweet_show',
                'true_value' => 'show',
                'false_value' => ''
            ));
            ?>
        </div>
    </div>


<div class="td-box-section-separator"></div>


    <!-- ARTICLE sharing bottom -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">底部文章分享</span>
            <p>显示或隐藏文章底部文章分享</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_bottom_social_show',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>


    <!-- ARTICLE bottom like -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">底部中国大陆分享网站</span>
            <p>显示或隐藏文章底部大陆分享网站</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_bottom_like_tweet_show',
                'true_value' => '',
                'false_value' => 'hide'
            ));
            ?>
        </div>
    </div>


<div class="td-box-section-separator"></div>


    <!-- Twitter name -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">TWITTER用户名</span>
            <p>这将通过参数在tweet使用。如果没提供twitter用户，将使用网站名。<br>不包含 @</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::input(array(
                'ds' => 'td_option',
                'option_id' => 'tds_tweeter_username'
            ));
            ?>
        </div>
    </div>

<?php echo td_panel_generator::box_end();?>



<?php echo td_panel_generator::box_start('更多文章框', false); ?>

    <!-- text -->
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <p>当用户滚动文章至少400px时出现此框。该框显示在右下角，它可以显示当前文章相关的一个或更多文章。</p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>


    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">更多文章</span>
            <p>启用 / 禁用 - 更多文章选项</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_more_articles_on_post_pages_enable',
                'true_value' => 'show',
                'false_value' => ''
            ));
            ?>
        </div>
    </div>



    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">顶部距离</span>
            <p>这是顶部距离，即用户滚动，在窗口出现之前，默认400</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::input(array(
                'ds' => 'td_option',
                'option_id' => 'tds_more_articles_on_post_pages_distance_from_top'
            ));
            ?>
        </div>
    </div>



    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">显示文章</span>
            <p>需要显示什么文章</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::dropdown(array(
                'ds' => 'td_option',
                'option_id' => 'tds_more_articles_on_post_pages_display',
                'values' => array(
                    array('text' => '最新文章' , 'val' => ''),
                    array('text' => '从相同分类' , 'val' => 'same_category'),
                    array('text' => '从文章标签' , 'val' => 'same_tag'),
                    array('text' => '从相同作者' , 'val' => 'same_author'),
                    array('text' => '随机' , 'val' => 'random')
                )
            ));
            ?>
        </div>
    </div>


    <!-- DISPLAY VIEW -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">文章显示视图</span>
            <p>选择一个模块类型，这是文章列表如何显示</p>
        </div>
        <div class="td-box-control-full td-panel-module">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_option',
                'option_id' => 'tds_more_articles_on_post_pages_display_module',
                'values' => td_panel_generator::helper_display_modules('enabled_on_more_articles_box')
            ));
            ?>
        </div>
    </div>



    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">文章数</span>
            <p>显示文章数</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::dropdown(array(
                'ds' => 'td_option',
                'option_id' => 'tds_more_articles_on_post_pages_number',
                'values' => array(
                    array('text' => '1' , 'val' => ''),
                    array('text' => '2' , 'val' => 2),
                    array('text' => '3' , 'val' => 3),
                    array('text' => '4' , 'val' => 4),
                    array('text' => '5' , 'val' => 5),
                    array('text' => '6' , 'val' => 6)
                )
            ));
            ?>
        </div>
    </div>


    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">禁用时间</span>
            <p>如果用户关闭更多文章框，这是再次看到框之前等待的时间（天）。</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::dropdown(array(
                'ds' => 'td_option',
                'option_id' => 'tds_more_articles_on_post_pages_time_to_wait',
                'values' => array(
                    array('text' => 'never' , 'val' => ''),
                    array('text' => '1天' , 'val' => 1),
                    array('text' => '2天' , 'val' => 2),
                    array('text' => '3天' , 'val' => 3)
                )
            ));
            ?>
        </div>
    </div>

<?php echo td_panel_generator::box_end();?>




<!-- Advanced options -->
<?php echo td_panel_generator::box_start('Ajax查看数 (跟上缓存插件计数)', false); ?>


    <!-- text -->
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <p>启用此功能将在页面和文章使用ajax更新文章查看计数。如果你激活了缓存插件，最好使用此功能。在页面它会从服务器提取正确的文章查看计数。在文章页此功能也将递增文章查看计数。当启用此功能时，默认（经典）文章计数递增将禁用。启用或禁用此功能后，请务必清空所有缓存。</p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>





    <!-- Enable / Disabled Ajax post count -->
    <div class="td-box-row">
        <div class="td-box-description td-no-short-description">
            <span class="td-box-title">启用 / 禁用 AJAX 文章查看数</span>
            <p>如果你使用缓存插件，这是有用的</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_option',
                'option_id' => 'tds_ajax_post_view_count',
                'true_value' => 'enabled',
                'false_value' => ''
            ));
            ?>
        </div>

    </div>

<?php echo td_panel_generator::box_end();?>