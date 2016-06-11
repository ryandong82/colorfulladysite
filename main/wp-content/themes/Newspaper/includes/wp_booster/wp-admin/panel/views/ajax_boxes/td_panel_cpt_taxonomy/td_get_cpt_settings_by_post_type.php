<?php
/**
 * Created by ra on 7/9/2015.
 */


$custom_post_type = td_util::get_http_post_val('custom_post_type');



// get the registered taxonomies for this specific post type and prepare them for use in the panels dropdowns
// add empty
$td_registered_taxonomies[] = array(
    'val' => '',
    'text' => '-- None --'
);

// read the taxonomies and build the array
$registered_taxonomies_obj = get_object_taxonomies($custom_post_type, 'objects');
foreach ($registered_taxonomies_obj as $registered_taxonomy_obj) {
    $td_registered_taxonomies[] = array(
        'val' => $registered_taxonomy_obj->name,
        'text' => $registered_taxonomy_obj->labels->name . '  ' . '(' . $registered_taxonomy_obj->name . ')'
    );
}



?>





<!-- breadcrumbs: select taxonomy -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">面包屑分类法</span>
        <p>你需要在面包屑显示什么分类</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::dropdown(array(
            'ds' => 'td_cpt',
            'item_id' => $custom_post_type,
            'option_id' => 'tds_breadcrumbs_taxonomy',
            'values' => $td_registered_taxonomies
        ));
        ?>
    </div>
</div>

<div class="td-box-section-separator"></div>

<!-- category spot: select taxonomy -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">分类点分类法</span>
        <p>在分类点显示什么分类法</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::dropdown(array(
            'ds' => 'td_cpt',
            'item_id' => $custom_post_type,
            'option_id' => 'tds_category_spot_taxonomy',
            'values' => $td_registered_taxonomies
        ));
        ?>
    </div>
</div>


<div class="td-box-section-separator"></div>

<!-- tag spot: select taxonomy -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">标签点分类法</span>
        <p>在标签点显示什么分类法</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::dropdown(array(
            'ds' => 'td_cpt',
            'item_id' => $custom_post_type,
            'option_id' => 'tds_tag_spot_taxonomy',
            'values' => $td_registered_taxonomies
        ));
        ?>
    </div>
</div>

<!-- tag spot: text -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">标签点文字</span>
        <p>如果你使用自定义分类法，你可以替换默认标签</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_cpt',
            'item_id' => $custom_post_type,
            'option_id' => 'tds_tag_spot_text',
            'placeholder' => __td('TAGS')
        ));
        ?>
    </div>
</div>

