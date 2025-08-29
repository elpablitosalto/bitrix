<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    array(
        "IS_SEF" => "N",
        "SEF_BASE_URL" => "/catalog/",
        "SECTION_PAGE_URL" => "",
        "DETAIL_PAGE_URL" => "",
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => Indexis::getIblockId('catalog', 'catalog'),
        "DEPTH_LEVEL" => "1",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000"
    ),
    false
);
$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
?>