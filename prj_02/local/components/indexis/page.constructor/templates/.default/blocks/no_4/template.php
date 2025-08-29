<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
?>
<div class="text-size-lg news-detail-text">
    <h4><? echo $item['DISPLAY_PROPERTIES']['NO_4_HEADER']['DISPLAY_VALUE']; ?>:</h4>
    <ul>
        <?
        foreach ($item['DISPLAY_PROPERTIES']['NO_4_ELEMENTS']['VALUE'] as $val) {
        ?>
            <li><?= $val; ?></li>
        <?
        }
        ?>
    </ul>
    <? echo $item['DISPLAY_PROPERTIES']['NO_4_TEXT']['DISPLAY_VALUE']; ?>
</div>