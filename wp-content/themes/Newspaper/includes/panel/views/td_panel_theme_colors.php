<!-- THEME COLORS -->
<?php
    echo td_panel_generator::ajax_box('常规主题颜色', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_general_theme_colors'
        )
    );
?>



<hr>
<div class="td-section-separator">页眉</div>




<!-- TOP MENU -->
<?php
echo td_panel_generator::ajax_box('顶部菜单', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_top_menu'
    )
);
?>


<!-- MAIN MENU -->
<?php
echo td_panel_generator::ajax_box('主菜单', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_main_menu'
    )
);
?>


<!-- MOBILE MENU -->
<?php
echo td_panel_generator::ajax_box('手机菜单', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_mobile_menu'
    )
);
?>



<!-- HEADER COLOR -->
<?php echo td_panel_generator::box_start('页眉', false); ?>

<!-- Header color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">页眉背景颜色</span>
        <p>这是指LOGO和广告背景颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_header_wrap_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end();?>


<hr>
<div class="td-section-separator">页脚</div>


<!-- FOOTER -->
<?php echo td_panel_generator::box_start('页脚', false); ?>

<!-- FOOTER color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">背景颜色</span>
        <p>选择页脚背景颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_footer_color',
            'default_color' => '#222222'
        ));
        ?>
    </div>
</div>

<!-- FOOTER text color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">文字颜色</span>
        <p>选择页脚文字颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_footer_text_color',
            'default_color' => '#ffffff'
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end();?>



<!-- SUB FOOTER -->
<?php echo td_panel_generator::box_start('子页脚', false); ?>

<!-- FOOTER bottom color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">背景颜色</span>
        <p>选择子页脚底部背景颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_footer_bottom_color',
            'default_color' => '#0d0d0d'
        ));
        ?>
    </div>
</div>


<!-- FOOTER bottom text color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">文字颜色</span>
        <p>选择子页脚底部文字颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_footer_bottom_text_color',
            'default_color' => '#cccccc'
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end();?>


<hr>
<div class="td-section-separator">内容</div>


<!-- POSTS PAGE -->
<?php
echo td_panel_generator::ajax_box('文章', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_posts'
    )
);
?>




<!-- PAGES COLORS -->
<?php
echo td_panel_generator::ajax_box('页面', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_pages'
    )
);
?>
