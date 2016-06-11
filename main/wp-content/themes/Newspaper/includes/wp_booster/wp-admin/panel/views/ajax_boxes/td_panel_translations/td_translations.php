<?php
/**
 * Created by ra on 1/13/2015.
 */

global $td_translation_map;

?>

<!-- HELP THE COMMUNITY -->
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">帮助社区</span>
            <p>如果要修正一个词，或者你有更好的翻译，请分享到社区.</p>
            <p>
                <a id="send_translation" class="td-big-button thickbox"
                   href="#TB_inline?width=400&height=300&inlineId=modal_window_send_tranlation_language"
                   onclick="td_translation.select_loaded_language(); return false">分享您的翻译或更正</a>

                <div id="modal_window_send_tranlation_language" title="test" style="display: none;">

                    <h2>发送您的翻译或更正</h2>
                    <p>您的翻译将发送到我们的服务器并在审查后共享给所有成员。请确保你发送了正确的语言</p>

                        <?php

                        // 'tds_language' is the value of the 'option_id' parameter used for the next td_panel_generator::dropdown
                        // 'tds_language' option is cleared before usage, for not saving a language in the select input
                        td_util::update_option('tds_language', '');

                        $languages[] = array(
                            'text' => '翻译语言...',
                            'val' => ''
                        );

                        foreach (td_global::$translate_languages_list as $language_code => $language_name){
                            $languages[] = array(
                                'text' => $language_name,
                                'val' => $language_code
                            );
                        }

                        echo td_panel_generator::dropdown(array(
                            'ds' => 'td_option',
                            'option_id' => 'tds_language',
                            'values' => $languages
                        ));
                        ?>
                    <p>通过点击按钮，您授权我们 (tagDiv) 分享您的翻译给其它用户。谢谢您的信任和贡献，我们将尽我们最大的努力给予回复。</p>

                    <a id="send_translation" class="td-big-button" href="" onclick="td_translation.send_translation('<?php echo TD_THEME_NAME ?>', '<?php echo TD_THEME_VERSION ?>', '<?php echo td_util::get_option('td_cake_status') ?>'); return false;">发送翻译或更正</a>

                    <p id="thanks_send_translation" style="display: none">谢谢！</p>
                </div>
            </p>
        </div>
    </div>





<!-- THE TRANSLATION LIST -->
    <?php

    foreach($td_translation_map as $key_id => $value) {

        // for each word in the $key_id array, not starting with (%) percent (internal variables like %CURRENT_PAGE% ),
        // we need to replace '_' with (') apostrophe
        //
        // we can't use $value instead of $key_id, because $value is a translated value
        //
        $arr_words = explode(' ', $key_id);

        foreach ($arr_words as &$word) {
            if (preg_match('/^%/', $word))
                continue;

            $word = str_replace('_', '\'', $word);
        }

        $key = implode(' ', $arr_words);

        ?>
        <div class="td-box-row">
            <div class="td-box-description">
                <span class="td-box-title td-title-on-row"><?php echo $key;?></span>
                <p></p>
            </div>
            <div class="td-box-control-full">
                <?php
                echo td_panel_generator::input(array(
                    'ds' => 'td_translate',
                    'option_id' => $key_id,
                    'placeholder' => $value
                ));
                ?>
            </div>
        </div>
        <?php
    }
    ?>
