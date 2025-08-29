<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
?>
<div class="content__wrapper" id="<?= $arParams['EDIT_AREA_ID'] ?>">
    <h3><?= $item['DISPLAY_PROPERTIES']['NO_3_H3']['DISPLAY_VALUE']; ?></h3>
    <ul class="content__list">
        <? foreach ($item['DISPLAY_PROPERTIES']['NO_3_MARK_LIST']['DISPLAY_VALUE'] as $key => $val) { ?>
            <li class="content__item"><?= $val; ?></li>
        <? } ?>
    </ul>
</div>