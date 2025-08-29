<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $APPLICATION;
$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "custom:menu.sections",
    "",
    array(
        "IBLOCK_TYPE" => "system",
        "IBLOCK_ID" => Indexis::getIblockId("menu", "system", "s1"),
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "FILTER" => [
            "=CODE" => "BOTTOM"
        ]
    )
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>