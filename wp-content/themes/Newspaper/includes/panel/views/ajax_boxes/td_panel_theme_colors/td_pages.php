
<!-- Page title -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">页面标题颜色</span>
        <p>选择页面标题颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_page_title_color',
            'default_color' => '#111111'
        ));
        ?>
    </div>
</div>

<!-- Page content -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">页面文字颜色</span>
        <p>选择页面文字颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_page_content_color',
            'default_color' => '#444444'
        ));
        ?>
    </div>
</div>

<!-- Page content h -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">页面 H1, H2, H3, H4, H5, H6 颜色</span>
        <p>选择页面 h 颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_page_h_color',
            'default_color' => '#111111'
        ));
        ?>
    </div>
</div>