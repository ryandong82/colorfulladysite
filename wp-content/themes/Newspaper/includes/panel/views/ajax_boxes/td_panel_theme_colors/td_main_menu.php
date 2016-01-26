
<!-- Menu background color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">菜单背景颜色</span>
        <p>选择菜单背景颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_menu_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>

<!-- Submenu Hover color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">活动和悬停颜色</span>
        <p>选择菜单和子菜单活动和悬停颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_submenu_hover_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>

<!-- Menu text color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">菜单文字颜色</span>
        <p>选择菜单文字颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_menu_text_color',
            'default_color' => '#000000'
        ));
        ?>
    </div>
</div>