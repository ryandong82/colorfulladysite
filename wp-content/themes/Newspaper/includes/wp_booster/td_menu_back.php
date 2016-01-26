<?php

class td_nav_menu_edit_walker extends Walker_Nav_Menu_Edit {
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {


        $control_buffy = '';

        //read the menu setting from post meta (menu id, key, single)
        $td_mega_menu_cat = get_post_meta($item->ID, 'td_mega_menu_cat', true);
        $td_mega_menu_page_id = get_post_meta($item->ID, 'td_mega_menu_page_id', true);

        //make the tree
        $td_category_tree = array_merge (array(' - 不是大菜单 - ' => ''), td_util::get_category2id_array(false));

        //make a new ui control ( dropdown )
        $control_buffy .= '<p class="description description-wide"><br><br>';
            $control_buffy .= '<label>';
                $control_buffy .= '使这个分类为大菜单';
            $control_buffy .= '</label>';
            $control_buffy .= '<select name="td_mega_menu_cat[' . $item->ID . ']" id="" class="widefat code edit-menu-item-url">';
                foreach ($td_category_tree as $category => $category_id) {
                    $control_buffy .= '<option value="' . $category_id . '"' . selected($td_mega_menu_cat, $category_id, false) . '>' . $category . '</option>';
                }
            $control_buffy .= ' </select>';
        $control_buffy .= '</p>';

        $control_buffy .= '<br>或<br>';




        //make a new ui control ( dropdown )
        $control_buffy .= '<p class="description description-wide">';

            $control_buffy .= '<label>';
                $control_buffy .= '在菜单加载页面（输入页面ID）';
            $control_buffy .= '</label><br>';
            $control_buffy .= '<input name="td_mega_menu_page_id[' . $item->ID . ']" type="text" value="' . $td_mega_menu_page_id . '" />';
            $control_buffy .= '<span class="td-wpa-info"><strong>提示：</strong>如果你选择加载一个大菜单或页面，请不要给此项目添加子菜单。大菜单和大页面菜单是顶级菜单项目。<a href="http://forum.tagdiv.com/menus-newsmag/" target="_blank">阅读更多</a></span>';


        $control_buffy .= '</p>';


        //run the parent and add in $buffy (byref) our code via regex
        $buffy = '';
        parent::start_el($buffy, $item, $depth, $args, $id);
        $buffy = preg_replace('/(?=<div.*submitbox)/', $control_buffy, $buffy);



        $output .= $buffy;
    }
}