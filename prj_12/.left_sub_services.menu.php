<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$aMenuLinks = array();
global $APPLICATION;
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"indexis:menu.sections",
	"",
	array(
		"IS_SEF" => "N",
		"SEF_BASE_URL" => "/services/",
		"SECTION_PAGE_URL" => "#SECTION_CODE#/",
		"DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_ID#/",
		"IBLOCK_TYPE" => "services",
		"IBLOCK_ID" => Indexis::getIblockId('services', 'services'),
		"DEPTH_LEVEL" => "3",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000"
	),
	false
);
$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
