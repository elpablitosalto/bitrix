<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
?>
<div class="rs__news--detail-block">
    <div class="rs__news--detail-title"><? echo $item['DISPLAY_PROPERTIES']['NO_4_HEADER']['DISPLAY_VALUE']; ?>:</div>
    <ul class="rs__news--detail-list">
        <?
        foreach ($item['DISPLAY_PROPERTIES']['NO_4_ELEMENTS']['VALUE'] as $val) {
            ?>
            <li><?= $val; ?></li>
            <?
        }
        ?>
    </ul>
    <div class="rs__news--detail-text">
        <? echo $item['DISPLAY_PROPERTIES']['NO_4_TEXT']['DISPLAY_VALUE']; ?>
    </div>
</div>