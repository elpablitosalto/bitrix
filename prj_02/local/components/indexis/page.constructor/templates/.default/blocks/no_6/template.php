<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
?>
<blockquote class="text-size-lg news-detail-text-blockquote">
    <p>«<?= $item['DISPLAY_PROPERTIES']['NO_6_TEXT']['DISPLAY_VALUE']; ?>»</p>
    <cite><?= $item['DISPLAY_PROPERTIES']['NO_6_AUTHOR']['VALUE']; ?></cite>
</blockquote>