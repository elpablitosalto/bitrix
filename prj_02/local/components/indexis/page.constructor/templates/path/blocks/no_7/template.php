<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
//echo "!!!";
//vardump($item);

//$arFile = CFile::MakeFileArray($item['DISPLAY_PROPERTIES']['NO_7_FILE']['VALUE']);
$arFile = $item['DISPLAY_PROPERTIES']['NO_7_FILE']['FILE_VALUE'];
//vardump($arFile);

$link = "";
if (strlen($item['DISPLAY_PROPERTIES']['NO_7_LINK']['VALUE']) > 0) {
    $link = $item['DISPLAY_PROPERTIES']['NO_7_LINK']['VALUE'];
} else if (strlen($arFile["SRC"]) > 0) {
    $link = $arFile["SRC"];
}
$text = $item['DISPLAY_PROPERTIES']['NO_7_TEXT']['VALUE'];
?>
<? if (strlen($link) > 0 && strlen($text) > 0) { ?>
    <div class="rs__news--detail-block">
        <div class="rs__news--detail-footer">
            <div class="rs__button__default rs__button--icon ico-arrow-main rs__button--icon-right rs__button__default--clean"><a target="_self" href="<?= $link ?>" class=""><?= $text ?></a></div>
        </div>
    </div>
<? } ?>