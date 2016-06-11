// JavaScript Document



( function() {
    tinymce.PluginManager.add( 'td_shortcode_plugin', function( editor, url ) {
        editor.addButton( 'td_button_key', {
            type: 'listbox',
            text: '简码',
            classes: 'td_tinymce_shortcode_dropdown widget btn td-tinymce-dropdown',
            icon: false,
            onselect: function(e) {
            },
            values: [

                {text: '视频播放列表', classes: 'td_tinymce_dropdown_title'},
                {text: 'Youtube播放列表', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[td_block_video_youtube playlist_title="" playlist_yt="" playlist_auto_play="0"]' + tinyMCE.activeEditor.selection.getContent());
                }},
                {text: 'Vimeo播放列表', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[td_block_video_vimeo playlist_title="" playlist_v="" playlist_auto_play="0"]' + tinyMCE.activeEditor.selection.getContent());
                }},


                {text: '智能列表', classes: 'td_tinymce_dropdown_title'},
                {text: '智能列表结束', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[td_smart_list_end]' + tinyMCE.activeEditor.selection.getContent());
                }},


                {text: '按钮', classes: 'td_tinymce_dropdown_title'},
                {text: '默认', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[button color="" size="" type="" target="" link=""]' + tinyMCE.activeEditor.selection.getContent() + '[/button]');
                }},
                {text: '方形', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[button color="" size="" type="square" target="" link=""]' + tinyMCE.activeEditor.selection.getContent() + '[/button]');
                }},
                {text: '圆形', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[button color="" size="" type="round" target="" link=""]' + tinyMCE.activeEditor.selection.getContent() + '[/button]');
                }},
                {text: '轮廓', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[button color="" size="" type="outlined" target="" link=""]' + tinyMCE.activeEditor.selection.getContent() + '[/button]');
                }},
                {text: '3d', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[button color="" size="" type="3d" target="" link=""]' + tinyMCE.activeEditor.selection.getContent() + '[/button]');
                }},
                {text: '方形轮廓', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[button color="" size="" type="square_outlined" target="" link=""]' + tinyMCE.activeEditor.selection.getContent() + '[/button]');
                }},

            ]

        });

    } );

} )();


