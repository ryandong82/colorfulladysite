<!-- Background color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">手机菜单 - 背景颜色</span>
        <p>选择菜单背景颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_mobile_menu_color',
            'default_color' => '#222222'
        ));
        ?>
    </div>
</div>

<!-- Icons color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">手机菜单 - 图标颜色</span>
        <p>选择菜单图标颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_mobile_icons_color',
            'default_color' => '#ffffff'
        ));
        ?>
    </div>
</div>

<!-- Open menu background color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">打开菜单 - 背景颜色</span>
        <p>选择打开菜单背景颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_open_background_color',
            'default_color' => '#F5F5F5'
        ));
        ?>
    </div>
</div>

<!-- Open menu borders color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">打开菜单 - 边框颜色</span>
        <p>选择打开菜单边框颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_open_border_color',
            'default_color' => '#E8E8E8'
        ));
        ?>
    </div>
</div>

<!-- Open menu text color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">打开菜单 - 文字颜色</span>
        <p>选择打开菜单文字颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_open_text_color',
            'default_color' => '#1E1E1E'
        ));
        ?>
    </div>
</div>

<!-- Open menu text active and hover color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">打开菜单 - 活动/悬停文字颜色</span>
        <p>选择打开菜单文字悬停/活动颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_open_text_hover_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>