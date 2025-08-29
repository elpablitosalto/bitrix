<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
?>

<div class="rs__news--detail-block">
    <div class="ico-quotes rs__quotes--box">
        <div class="rs__quotes">
            <p><?= $item['DISPLAY_PROPERTIES']['NO_6_TEXT']['DISPLAY_VALUE']; ?></p>
            <cite><?= $item['DISPLAY_PROPERTIES']['NO_6_AUTHOR']['VALUE']; ?></cite>
        </div>
    </div>
</div>