<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
//vardump($item);
if (strlen($item['DISPLAY_PROPERTIES']['NO_2_TEXT']['DISPLAY_VALUE'])) {
?><div class="text-size-lg news-detail-text">
    <?= $item['DISPLAY_PROPERTIES']['NO_2_TEXT']['DISPLAY_VALUE']; ?>
</div>
<?
}
?>