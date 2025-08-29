<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $APPLICATION;
//echo 'SITE_TEMPLATE_PATH = '.SITE_TEMPLATE_PATH.'<br />';
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"waim:menu.sections",
	"",
	array(
		"IBLOCK_TYPE" => "1c_goods",
		"IBLOCK_ID" => "36",
		"DEPTH_LEVEL" => "5",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"IS_SEF" => "N",
		"ID" => $_REQUEST["ID"],
		"SECTION_URL" => ""
	),
	false
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);

//vardump($aMenuLinks);