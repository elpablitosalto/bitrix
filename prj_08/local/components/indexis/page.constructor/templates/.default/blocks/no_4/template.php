<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];

if (!is_array($item['DISPLAY_PROPERTIES']['NO_4_TEXT']['DISPLAY_VALUE'])) {
    if (strlen($item['DISPLAY_PROPERTIES']['NO_4_TEXT']['DISPLAY_VALUE']) > 0) {
        $item['DISPLAY_PROPERTIES']['NO_4_TEXT']['DISPLAY_VALUE'] = array($item['DISPLAY_PROPERTIES']['NO_4_TEXT']['DISPLAY_VALUE']);
    }
}

?>
<div class="content__wrapper" id="<?= $arParams['EDIT_AREA_ID'] ?>">
    <h2><?= $item['DISPLAY_PROPERTIES']['NO_4_H2']['DISPLAY_VALUE']; ?></h2>
    <div class="content__texts">
        <div class="content__text-wrapper">
            <?
            $i = 0;
            foreach ($item['DISPLAY_PROPERTIES']['NO_4_TEXT']['DISPLAY_VALUE'] as $key => $val) { ?>
                <? if ($i == 2) { ?>
        </div>
        <div class="content__text-wrapper">
            <?
                    $i = 0;
            ?>
        <? } ?>
        <p><?= $val; ?></p>
    <?
                $i++;
            } ?>
        </div>
    </div>
</div>