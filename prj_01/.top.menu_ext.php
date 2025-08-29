<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $APPLICATION;
$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    array(
        "IBLOCK_TYPE" => "1c_catalog",
        "IBLOCK_ID" => Indexis::getIblockId("catalog", "1c_catalog", "s1"),
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
    )
);

//vardump($aMenuLinksExt);

/*
$aMenuLinks = array(
    array(
        "Поддержка и документация",
        "/support_doc/",
        array(),
        array(),
        ""
    ),
    array(
        "База знаний",
        "/knowledge/",
        array(),
        array(),
        ""
    ),
    array(
        "Новости",
        "/news/",
        array(),
        array(),
        ""
    ),
);
*/

$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
