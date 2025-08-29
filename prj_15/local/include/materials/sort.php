<?
// Сортировка -->
$ELEMENT_SORT_FIELD = $arParams["SORT_BY1"];
$ELEMENT_SORT_ORDER = $arParams["SORT_ORDER1"];
if (strlen($arFilterFromComponent['ORDER']['SORT_BY1']) > 0) {
    $ELEMENT_SORT_FIELD = $arFilterFromComponent['ORDER']['SORT_BY1'];
}
if (strlen($arFilterFromComponent['ORDER']['SORT_ORDER1']) > 0) {
    $ELEMENT_SORT_ORDER = $arFilterFromComponent['ORDER']['SORT_ORDER1'];
}
$arParams["SORT_BY1"] = $ELEMENT_SORT_FIELD;
$arParams["SORT_ORDER1"] = $ELEMENT_SORT_ORDER;
// <-- Сортировка
?>
<div class="dp-sort">
    <form id="sort-articles-form" class="dp-form dp-form-sort js_sort_articles_form" action="" method="post">
        <input type="hidden" value="Y" name="set_filter" />
        <input type="hidden" value="" class="js_filter_type" name="filter_type" />
        <div class="dp-field dp-field_m dp-field-select-sort">
            <select class="dp-form-select dp-select-sort" name="sort" id="js_sort_articles_select">
                <option value="SHOW_COUNTER:DESC" <? if ($arParams['SORT_BY1'] == 'SHOW_COUNTER') {
                                                        echo 'selected="selected"';
                                                    } ?>>По популярности</option>
                <option value="ACTIVE_FROM:DESC" <? if ($arParams['SORT_BY1'] == 'ACTIVE_FROM' && $arParams['SORT_ORDER1'] == 'DESC') {
                                                        echo 'selected="selected"';
                                                    } ?>>Сначала новые</option>
                <option value="ACTIVE_FROM:ASC" <? if ($arParams['SORT_BY1'] == 'ACTIVE_FROM' && $arParams['SORT_ORDER1'] == 'ASC') {
                                                    echo 'selected="selected"';
                                                } ?>>Сначала старые</option>
            </select>
        </div>
        <? if ($arParams['MATERIAL_TYPE'] == 'WEBINARS') { ?>
            <?
            //vardump($arFilterFromComponent['arSpeakers']);    
            ?>
            <? if (!empty($arFilterFromComponent['arSpeakers'])) { ?>
                <div class="dp-field dp-field_m dp-field-select-speaker">
                    <select class="dp-form-select dp-select-speaker js_select_speaker" name="speaker">
                        <?
                        $selected = '';
                        if (empty($arFilterFromComponent['arFilter']['speaker'])) {
                            $selected = 'selected="selected"';
                        }
                        ?>
                        <option value="0" <?= $selected; ?>>Выбрать лектора</option>
                        <? foreach ($arFilterFromComponent['arSpeakers'] as $key => $item) { ?>
                            <?
                            $selected = '';
                            if ($item['SELECTED'] == 'Y') {
                                $selected = 'selected="selected"';
                            }
                            ?>
                            <option value="<?= $key; ?>" <?= $selected; ?>><?= $item['NAME']; ?></option>
                        <? } ?>
                    </select>
                </div>
            <? } ?>
            <div class="dp-field dp-field-transcript">
                <input id="dfs-transcript" class="js_with_transcript" type="checkbox" name="with_transcript" value="Y" <? if ($arFilterFromComponent['arFilter']['with_transcript'] == 'Y') { ?> checked <? } ?> />
                <label for="dfs-transcript">Смотреть с расшифровкой</label>
            </div>
        <? } ?>
    </form>
</div>