<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $APPLICATION;
$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    array(
        "IBLOCK_TYPE" => "system",
        "IBLOCK_ID" => Indexis::getIblockId("catalog", "1c_catalog", "s1"),
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
    )
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>