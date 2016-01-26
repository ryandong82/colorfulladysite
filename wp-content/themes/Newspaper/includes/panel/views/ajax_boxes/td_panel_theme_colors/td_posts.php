<!-- Article title -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">文章标题颜色</span>
        <p>选择文章标题颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_post_title_color',
            'default_color' => '#111111'
        ));
        ?>
    </div>
</div>

<!-- Author name -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">文章和区块作者名颜色</span>
        <p>选择作者名颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_post_author_name_color',
            'default_color' => '#000000'
        ));
        ?>
    </div>
</div>

<!-- Post content color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">文章文字颜色</span>
        <p>选择文章内容颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_post_content_color',
            'default_color' => '#444444'
        ));
        ?>
    </div>
</div>

<!-- Post h color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">文章H1, H2, H3, H4, H5, H6颜色</span>
        <p>选择文章 h 颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_post_h_color',
            'default_color' => '#222222'
        ));
        ?>
    </div>
</div>

<!-- Post blockquote color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">文章引用颜色</span>
        <p>选择文章引用颜色</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_post_blockquote_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>