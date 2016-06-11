<div class="td-page-options-tab-wrap">
    <div class="td-page-options-tab td-page-options-tab-active" data-panel-class="td-post-option-general"><a href="#">常规</a></div>
    <div class="td-page-options-tab" data-panel-class="td-page-option-post-smart-list"><a href="#">智能列表</a></div>
    <div class="td-page-options-tab" data-panel-class="td-page-option-post-review"><a href="#">点评</a></div>
</div>


<div class="td-meta-box-inside">


    <!-- post option general -->
    <div class="td-page-option-panel td-post-option-general td-page-option-panel-active">

        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">
                文章模板：
                <?php
                    td_util::tooltip_html('
                        <h3>文章模板：</h3>
                        <p>当默认文章模板设置时测试这个</p>
                        <ul>
                            <li><strong>此设置从</strong><i>文章设置 > 默认文章模板</i>覆盖主题面板设置</li>
                        </ul>
                    ', 'right')
                ?>
            </span>
            <div class="td-inline-block-wrap">
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_post_theme_settings',
                    'item_id' => '',
                    'option_id' => 'td_post_template',
                    'values' => td_api_single_template::_helper_td_global_list_to_metaboxes(),
                    'selected_value' => $mb->get_the_value('td_post_template')
                ));
                ?>
            </div>
        </div>


        <!-- primary category -->
        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">
                主要分类：
                <?php
                td_util::tooltip_html('
                        <h3>主要分类解释：</h3>
                        <p>在'. TD_THEME_NAME . '主题，每个文章都有一个<i>主分类</i>且所有来自分类的设置将转移到文章。主分类也用于分类标签，它适用于缩略图和分类面包屑导航</p>

                        <p>这里是一些从<i>主分类</i>继承的设置：自定义侧边栏、侧边栏位置和背景</p>
                        <p>如何从主分类挑选</p>
                        <ul>
                            <li><strong>手动</strong> - 如果你从此框选择，此文章将从<i>主分类</i>继承所有设置。</li>
                            <li><strong>如果文章只有一个分类</strong> - 它将为<i>主分类</i></li>
                            <li><strong>如果文章有多个分类且没有手动主分类</strong>，主题将从此文章字母顺序第一个分类选择。</li>

                        </ul>
                    ', 'right')
                ?>
            </span>
            <?php $mb->the_field('td_primary_cat'); ?>
            <div class="td-select-style-overwrite td-inline-block-wrap">
                <select name="<?php $mb->the_name(); ?>" class="td-panel-dropdown">
                    <option value="">自动选择分类</option>
                    <?php
                    $td_current_categories = td_util::get_category2id_array(false);

                    //print_r($td_current_categories);
                    //die;
                    foreach ($td_current_categories as $td_category => $td_category_id) {
                        ?>
                        <option value="<?php echo $td_category_id?>"<?php $mb->the_select_state($td_category_id); ?>><?php echo $td_category?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <span class="td-page-o-info">如果文章有多个分类，在这里选择的一个将用于设置，且它在分类标签出现。</span>
        </div>



        <!-- sidebar position -->
        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">
                侧边栏位置：
                <?php
                td_util::tooltip_html('
                        <h3>侧边栏位置：</h3>
                        <p>为了最佳效果和更容易维护网站，我们推荐从此文章<i>主分类</i>设置侧边栏。这样，如果你有多个文章，当你更改分类设置，所有文章将匹配分类</p>
                        <ul>
                            <li><strong>此设置从<i>文章设置 >默认文章模板</i>和<i>分类设置</i>覆盖</strong>主题面板设置</li>
                            <li><strong>默认</strong> - 文章将在主分类设置看到，且它将尝试从那里获取位置。如果主分类没有自定义侧边伴位置，文章将从<i>模板设置 > 博客和文章模板</i>加载设置</li>

                        </ul>
                    ', 'right')
                ?>
            </span>
                <?php
                echo td_panel_generator::visual_select_o(array(
                    'ds' => 'td_post_theme_settings',
                    'item_id' => '',
                    'option_id' => 'td_sidebar_position',
                    'values' => array(
                        array('text' => '', 'title' => '', 'val' => '', 'class' => 'td-sidebar-position-default', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-default.png'),
                        array('text' => '', 'title' => '', 'val' => 'sidebar_left', 'class' => 'td-sidebar-position-left', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-left.png'),
                        array('text' => '', 'title' => '', 'val' => 'no_sidebar', 'class' => 'td-no-sidebar', 'img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-full.png'),
                        array('text' => '', 'title' => '', 'val' => 'sidebar_right', 'class' => 'td-sidebar-position-right','img' => get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/sidebar-right.png')
                    ),
                    'selected_value' => $mb->get_the_value('td_sidebar_position')
                ));
                ?>
        </div>


        <!-- custom sidebar -->
        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">
                自定义侧边栏：
                <?php
                td_util::tooltip_html('
                        <h3>自定义侧边栏：</h3>
                        <p>为了最佳效果和更容易维护网站，我们推荐从此文章<i>主分类</i>设置侧边栏。这样，如果你有多个文章，当你更改分类设置，所有文章将匹配分类</p>
                        <ul>
                            <li><strong>此设置从<i>文章设置 >默认文章模板</i>和<i>分类设置</i>覆盖</strong>主题面板设置</li>
                            <li><strong>默认</strong> - 文章将在主分类设置看到，且它将尝试从那里获取位置。如果主分类没有自定义侧边伴位置，文章将从<i>模板设置 > 博客和文章模板</i>加载设置</li>
                        </ul>
                    ', 'right')
                ?>
            </span>
            <?php
            echo td_panel_generator::sidebar_pulldown(array(
                'ds' => 'td_post_theme_settings',
                'item_id' => '',
                'option_id' => 'td_sidebar',
                'selected_value' => $mb->get_the_value('td_sidebar')
            ));
            ?>
        </div>





        <div class="td-meta-box-row">
            <?php $mb->the_field('td_subtitle'); ?>
            <span class="td-page-o-custom-label td_text_area_label">子标题：</span>
            <textarea name="<?php $mb->the_name(); ?>" class="td-textarea-subtitle"><?php $mb->the_value(); ?></textarea>
            <span class="td-page-o-info">此文字将出现到标题下</span>
        </div>

        <div class="td-meta-box-row">
            <?php $mb->the_field('td_quote_on_blocks'); ?>
            <span class="td-page-o-custom-label">区块引用：</span>
            <input class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
            <span class="td-page-o-info">在显示一个引用（仅当此文章在区块显示，它支持引用且仅在一行区块）</span>
        </div>

        <div class="td-meta-box-row">
            <?php $mb->the_field('td_source'); ?>
            <span class="td-page-o-custom-label">来源名字：</span>
            <input class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
            <span class="td-page-o-info">原始名字</span>
        </div>

        <div class="td-meta-box-row">
            <?php $mb->the_field('td_source_url'); ?>
            <span class="td-page-o-custom-label">来源网址：</span>
            <input class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
            <span class="td-page-o-info">来源完整网址</span>
        </div>

        <div class="td-meta-box-row">
            <?php $mb->the_field('td_via'); ?>
            <span class="td-page-o-custom-label">通过名：</span>
            <input class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
            <span class="td-page-o-info">通过（你的来源）名字</span>

        </div>


        <div class="td-meta-box-row">
            <?php $mb->the_field('td_via_url'); ?>
            <span class="td-page-o-custom-label">通过网址：</span>
            <input class="td-input-text-post-settings" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
            <span class="td-page-o-info">通过完整网址</span>
        </div>

    </div> <!-- /post option general -->






    <!-- post option smart list -->
    <div class="td-page-option-panel td-page-option-post-smart-list">
            <!-- smart list -->
            <div class="td-meta-box-row">
                <span class="td-page-o-custom-label">
                    使用智能列表？
                    <?php
                    td_util::tooltip_html('
                        <h3>智能列表：</h3>
                        <p>使用<i>智能列表</i>你可以转换你的项目列表文章。每个项目必须有一个标题、一个图片和一个描述</p>
                        <p>如何操作一个项目：</p>
                        <ul>
                            <li><strong>在H3添加文字包裹</strong> - 这将为项目标题</li>
                            <li>从媒体库<strong>添加任何图片</strong></li>
                            <li>在图片下面新段落<strong>添加一些文字</strong></li>
                            <li><i>每个项目重复最后3步</i></li>
                        </ul>

                        <p>系统将使用H3从切片到分裂你的文章并使每个单独的幻灯片或数字项目</p>
                    ', 'right')
                    ?>
                </span>

                <div class="td-inline-block-wrap">
                    <?php
                    echo td_panel_generator::visual_select_o(array(
                        'ds' => 'td_post_theme_settings',
                        'item_id' => '',
                        'option_id' => 'smart_list_template',
                        'values' => td_api_smart_list::_helper_td_smart_list_api_to_panel_values(),
                        'selected_value' => $mb->get_the_value('smart_list_template')
                    ));
                    ?>
                </div>
            </div>


            <!-- title tag -->
            <div class="td-meta-box-row">
                <span class="td-page-o-custom-label">
                    标题标签：
                    <?php
                    td_util::tooltip_html('
                        <h3>智能列表标题标签：</h3>
                        <p>自定义什么标签用于<i>Title</i>查找。例如，你已有文章为项目使用H2，这是很有用的</p>
                    ', 'right')
                    ?>
                </span>
                <?php $mb->the_field('td_smart_list_h'); ?>
                <div class="td-select-style-overwrite td-inline-block-wrap">
                    <select name="<?php $mb->the_name(); ?>" class="td-panel-dropdown">
                        <option value="h1"<?php $mb->the_select_state('h1'); ?>>标题 1 ( H1 标签 )</option>
                        <option value="h2"<?php $mb->the_select_state('h2'); ?>>标题 2 ( H2 标签 )</option>
                        <option value="" <?php $mb->the_select_state(''); ?>>标题 3 ( H3 标签 )</option>
                        <option value="h4"<?php $mb->the_select_state('h4'); ?>>标题 4 ( H4 标签 )</option>
                        <option value="h5"<?php $mb->the_select_state('h5'); ?>>标题 5 ( H5 标签 )</option>
                        <option value="h6"<?php $mb->the_select_state('h6'); ?>>标题 6 ( H6 标签 )</option>
                    </select>
                </div>
                <span class="td-page-o-info">标签包裹每个智能列表项目标题.</span>
            </div>


            <!-- smart list numbering -->
            <div class="td-meta-box-row">
                <span class="td-page-o-custom-label">
                    智能列表数：
                    <?php
                    td_util::tooltip('更改项目排序顺序', 'right')
                    ?>
                </span>
                <?php $mb->the_field('td_smart_list_order'); ?>
                <div class="td-select-style-overwrite td-inline-block-wrap">
                    <select name="<?php $mb->the_name(); ?>" class="td-panel-dropdown">
                        <option value=""<?php $mb->the_select_state(''); ?>>降序（例如：3，2，1）</option>
                        <option value="asc_1" <?php $mb->the_select_state('asc_1'); ?>>升序（1，2，3）</option>
                    </select>
                </div>
                <span class="td-page-o-info">智能列表把数字放到每个项目，选择计数方法。</span>
            </div>
    </div> <!-- /post option smart list -->






    <!-- post option review -->
    <div class="td-page-option-panel td-page-option-post-review">

        <div class="td-meta-box-row">
            <span class="td-page-o-custom-label">是点评产品？</span>
            <?php $mb->the_field('has_review'); ?>
            <div class="td-select-style-overwrite td-inline-block-wrap">
                <select id="reviewSelector" name="<?php $mb->the_name(); ?>" class="td-panel-dropdown">
                    <option value="">否</option>
                    <option value="rate_stars"<?php $mb->the_select_state('rate_stars'); ?>>Stars</option>
                    <option value="rate_percent"<?php $mb->the_select_state('rate_percent'); ?>>Percentages</option>
                    <option value="rate_point"<?php $mb->the_select_state('rate_point'); ?>>Points</option>
                </select>
            </div>
        </div>


        <div class="rating_type rate_Stars">
            <p>
                <strong>为此文章添加星级：</strong><br>
            </p>

            <?php while($mb->have_fields_and_multi('p_review_stars')): ?>
                <div class="td-meta-box-row">
                    <?php $mb->the_group_open(); ?>

                    <?php $mb->the_field('desc'); ?>
                    <span class="td-page-o-custom-label">精选名：</span>
                    <input style="width: 200px;" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>

                    <?php $mb->the_field('rate'); ?>

                    <select name="<?php $mb->the_name(); ?>">
                        <option value="">选择评级</option>
                        <option value="5"<?php $mb->the_select_state('5'); ?>>5 星</option>
                        <option value="4.5"<?php $mb->the_select_state('4.5'); ?>>4.5 星</option>
                        <option value="4"<?php $mb->the_select_state('4'); ?>>4 星</option>
                        <option value="3.5"<?php $mb->the_select_state('3.5'); ?>>3.5 星</option>
                        <option value="3"<?php $mb->the_select_state('3'); ?>>3 星</option>
                        <option value="2.5"<?php $mb->the_select_state('2.5'); ?>>2.5 星</option>
                        <option value="2"<?php $mb->the_select_state('2'); ?>>2 星</option>
                        <option value="1.5"<?php $mb->the_select_state('1.5'); ?>>1.5 星</option>
                        <option value="1"<?php $mb->the_select_state('1'); ?>>1 星</option>
                        <option value="0.5"<?php $mb->the_select_state('0.5'); ?>>0.5 星</option>
                    </select>
                    <a href="#" class="dodelete button">删除</a>

                    <?php $mb->the_group_close(); ?>
                </div>
            <?php endwhile; ?>

            <p><a href="#" class="docopy-p_review_stars button">添加评级分类</a></p>
        </div>



        <div class="rating_type rate_Percentages">
            <p>
                <strong>为此产品添加百分比评分：</strong><br>
                <strong>注意：</strong>百分比范围在0和100之间（不添加%）
            </p>
            <?php while($mb->have_fields_and_multi('p_review_percents')): ?>
                <div class="td-meta-box-row">
                    <?php $mb->the_group_open(); ?>

                    <?php $mb->the_field('desc'); ?>
                    <span class="td-page-o-custom-label">精选名：</span><input style="width: 200px;" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>

                    <?php $mb->the_field('rate'); ?>
                    - 百分比：
                    <input style="width: 100px;" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>


                    <a href="#" class="dodelete button">删除</a>

                    <?php $mb->the_group_close(); ?>
                </div>
            <?php endwhile; ?>

            <p><a href="#" class="docopy-p_review_percents button">添加评分分类</a></p>
        </div>


        <div class="rating_type rate_Points">
            <p>
                <strong>为此产品添加点评分：</strong><br>
                <strong>注意：</strong>点范围在1和10之间
            </p>
            <?php while($mb->have_fields_and_multi('p_review_points')): ?>
                <div class="td-meta-box-row">
                    <?php $mb->the_group_open(); ?>

                    <?php $mb->the_field('desc'); ?>
                    <span class="td-page-o-custom-label">精选名字：</span><input style="width: 200px;" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>

                    <?php $mb->the_field('rate'); ?>
                    - 点：
                    <input style="width: 100px;" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>


                    <a href="#" class="dodelete button">删除</a>

                    <?php $mb->the_group_close(); ?>
                </div>
            <?php endwhile; ?>

            <p><a href="#" class="docopy-p_review_points button">添加评分分类</a></p>
        </div>

        <div class="review_desc">
            <div><strong>点评描述：</strong></div>
            <p class="td_help_section">
                <?php $mb->the_field('review'); ?>

                <textarea class="td-textarea-subtitle" type="text" name="<?php $mb->the_name(); ?>"><?php $mb->the_value(); ?></textarea>
            </p>
        </div>



        <script>
            jQuery().ready(function() {
                td_updateMetaboxes();

                jQuery('#reviewSelector').change(function() {
                    td_updateMetaboxes();
                });

                function td_updateMetaboxes() {
                    var cur_selection = jQuery('#reviewSelector option:selected').text();

                    if(cur_selection.indexOf("No") !== -1) {
                        //alert('ra');
                        jQuery('.rating_type').hide();
                        jQuery('.review_desc').hide();

                    } else {
                        jQuery('.rating_type').hide();
                        jQuery('.rate_' + cur_selection).show();
                        jQuery('.review_desc').show();
                        //alert(cur_selection);
                    }



                }
            }); //end on load
        </script>
    </div> <!-- /post option review -->





</div>









