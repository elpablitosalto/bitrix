<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
$APPLICATION->SetPageProperty(
    "MICROMARKING_PARAMS_META_HEADLINE",
    '<meta itemprop="headline" content="' . $arResult["NAME"] . '">'
);

$APPLICATION->SetPageProperty(
    "MICROMARKING_PARAMS_META_URL",
    '<meta itemprop="url" content="' . $arResult["DETAIL_PAGE_URL"] . '">'
);

$APPLICATION->SetPageProperty(
    "MICROMARKING_PARAMS_META_DESCRIPTION",
    '<meta itemprop="description" content="' . $arResult["PREVIEW_TEXT"] . '">'
);
?>