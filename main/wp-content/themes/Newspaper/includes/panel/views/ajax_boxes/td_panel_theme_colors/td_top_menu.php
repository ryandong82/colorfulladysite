<!-- BACKGROUND COLOR -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">背景颜色</span>
        <p>选择顶部菜单背景颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_top_menu_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>


<!-- TOP MENU TEXT COLOR -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title td-title-on-row">顶部菜单文字颜色</span>
        <p>选择顶部菜单文字颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_top_menu_text_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>


<!-- TOP MENU TEXT HOVER COLOR -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title td-title-on-row">顶部菜单文字悬停颜色</span>
        <p>选择顶部菜单文字颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_top_menu_text_hover_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>

<!-- SOCIAL ICONS COLOR -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">社交图标颜色</span>
        <p>选择社交图标颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_top_social_icons_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>

<!-- SOCIAL ICONS HOVER COLOR -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title td-title-on-row">社交图标悬停颜色</span>
        <p>选择社交图标悬停颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_top_social_icons_hover_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>