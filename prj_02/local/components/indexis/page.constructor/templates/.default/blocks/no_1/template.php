<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
//vardump($item);
if (strlen($item['DISPLAY_PROPERTIES']['NO_1_TEXT']['DISPLAY_VALUE'])) {
?>
    <div class="text-size-lg news-detail-text" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
        <p class="h4 news-detail-annotation"><?= $item['DISPLAY_PROPERTIES']['NO_1_TEXT']['DISPLAY_VALUE']; ?></p>
    </div>
<?
}
?>