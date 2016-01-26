<!-- CATEGORY page -->
<?php echo td_panel_generator::box_start('分类全局设置', true); ?>


    <div class="td-box-description td-box-full">
        <p>设置所有分类默认布局。注意，你可以从主题面板 ⇢ 分类 每个分类更改布局和设置</p>
        <ul>
            <li>你可以通过去 文章 ⇢ 分类 ⇢ 分类悬停 ⇢ 选择视图 查看每个分类页面</li>
            <li>此WordPress模板位于 <strong>category.php</strong> 文件.</li>
        </ul>
    </div>


    <!-- Category template -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">分类模板</span>
            <p>
                这是分类页眉
                <?php td_util::tooltip_html('
                        <h3>分类模板：</h3>
                        <p>你可以从这里更改分类页眉</p>
                        <ul>
                            <li>此设置可以从以下框覆盖每个分类基础</li>
                            <li>一些页眉也显示分类描述</li>
                            <li>对于想自定义分类页眉的高级用户，这里是<a target="_blank" href="http://forum.tagdiv.com/api-category-top-section-template-introduction/">API文档</a></li>
                            <li>玩得开心找到你喜欢的页眉！</li>
                        </ul>
                ', 'right')?>
            </p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_option',
                'option_id' => 'tds_category_template',
                'values' => td_api_category_template::_helper_to_panel_values()
            ));
            ?>
        </div>
    </div>



<div class="td-box-section-separator"></div>

    <!-- Category top posts style -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">分类顶部文章风格</span>
            <p>
                设置顶部文章风格
                <?php td_util::tooltip_html('
                        <h3>分类顶部文章风格：</h3>
                        <p>高亮分类页最新文章</p>
                        <ul>
                            <li>此设置可以从以下框覆盖每个分类基础</li>
                            <li>使用此设置 + <i>网格风格</i> 设置获取你想要的结果</li>
                            <li>对于高级用户，这里是<a target="_blank" href="http://forum.tagdiv.com/api-category-top-section-style-introduction/">API文档</a></li>
                        </ul>
                ', 'right')?>
            </p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_option',
                'option_id' => 'tds_category_top_posts_style',
                'values' => td_api_category_top_posts_style::_helper_to_panel_values()
            ));
            ?>
        </div>
    </div>

    <div class="td-box-row">
        <div class="td-box-description">
                <span class="td-box-title">网格风格分类顶部文章</span>
                <p>每个分类网格支持多种风格</p>
        </div>
        <div class="td-box-control-full">
            <?php

            $td_grid_style_values = array();
            foreach (td_global::$big_grid_styles_list as $big_grid_id => $params) {
                $td_grid_style_values []= array(
                    'text' => $params['text'],
                    'val' => $big_grid_id
                );
            }
            echo td_panel_generator::dropdown(array(
                'ds' => 'td_option',
                'option_id' => 'tds_category_td_grid_style',
                'values' => $td_grid_style_values
            ));
            ?>
        </div>
    </div>

<div class="td-box-section-separator"></div>


    <!-- DISPLAY VIEW -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">文章显示视图</span>
            <p>选择模块类型，这是你的文章列表如何显示。对于自定义模块或开头，阅读<a target="_blank" href="http://forum.tagdiv.com/api-modules-introduction/">模块API</a></p>
        </div>
        <div class="td-box-control-full td-panel-module">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_option',
                'option_id' => 'tds_category_page_layout',
                'values' => td_panel_generator::helper_display_modules('enabled_on_loops')
            ));
            ?>
        </div>
    </div>


<div class="td-box-section-separator"></div>

<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">分页风格</span>
        <p>设置所有分类页码风格</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::dropdown(array(
            'ds' => 'td_option',
            'option_id' => 'tds_category_pagination_style',
            'values' => array(
                array (
                    'val' => '',
                    'text' => '正常分页'
                ),
                array (
                    'val' => 'infinite',
                    'text' => '无限加载'
                ),
                array (
                    'val' => 'infinite_load_more',
                    'text' => '无限加载 + 加载更多'
                )
            )
        ));
        ?>
    </div>
</div>


<div class="td-box-section-separator"></div>


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
                    'option_id' => 'tds_category_sidebar_pos',
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
                    'option_id' => 'tds_category_sidebar'
                ));
                ?>
                <div class="td-panel-control-comment td-text-align-right">创建或选择现有侧边栏</div>
            </div>
        </div>
    </div>
<?php echo td_panel_generator::box_end();?>






<hr>
<div class="td-section-separator">每个分类设置</div>




<?php













/**
 * custom walker - it's used only in this panel
 * Class td_category_walker_panel
 */
class td_category_walker_panel extends Walker {
    var $tree_type = 'category';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');


    var $td_category_hierarchy = array();  // we store them like so [0] Category 1 - [1] Category 2 - [2] Category 3


    var $td_category_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {

    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {

    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {

        if (!isset($td_last_category_objects[$depth])) {
            $this->td_category_hierarchy[$depth] = $category;
        }


        if ($depth == 0) {
            //reset the parrents
            $this->td_category_hierarchy = array();
            //put the
            $this->td_category_hierarchy[0] = $category;

            //add first parent
            $this->td_category_buffer['<a href="' . get_category_link($category->term_id) . '" target="_blank" data-is-category-link="yes">' . $category->name . '</a>'] = $category->term_id;
        } else {

            $td_tmp_buffer = '';
            $last_cat_id = 0;
            $contor_array = 0;
            //print_r($this->td_category_hierarchy);
            foreach ($this->td_category_hierarchy as $parent_cat_obj) {

                if ($td_tmp_buffer === '') {
                    $td_tmp_buffer = '<a href="' . get_category_link($parent_cat_obj->term_id) . '" target="_blank" data-is-category-link="yes">' . $parent_cat_obj->name . '</a>';
                    $last_cat_id = $parent_cat_obj->term_id;
                } else {
                    if($this->td_category_hierarchy[$contor_array-1]->term_id == $parent_cat_obj->parent) {
                        $td_tmp_buffer .=  '<img src="' . get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/panel/panel-breadcrumb.png" class="td-panel-breadcrumb"/>' . '<a href="' . get_category_link($parent_cat_obj->term_id) . '" target="_blank" data-is-category-link="yes">' . $parent_cat_obj->name . '</a>';
                        $last_cat_id = $parent_cat_obj->term_id;
                    }
                }

                $contor_array++;

            }


            //add child
            $this->td_category_buffer[$td_tmp_buffer] = $last_cat_id;

        }


    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {

    }

}



// get all the categories
$categories = get_categories(array(
	'hide_empty' => 0,
	'number' => 1000
));

// 'walk' all the categories
$td_category_walker_panel = new td_category_walker_panel;
$td_category_walker_panel->walk($categories, 4);

// add each category panel
foreach ($td_category_walker_panel->td_category_buffer as $display_category_name => $category_id) {
	?>
	<!-- LAYOUT SETTINGS -->
	<?php
	echo td_panel_generator::ajax_box($display_category_name, array(
			'td_ajax_calling_file' => basename(__FILE__),
			'td_ajax_box_id' => 'td_get_category_section_by_id',
			'category_id' => $category_id
		)
	);
}//end foreach