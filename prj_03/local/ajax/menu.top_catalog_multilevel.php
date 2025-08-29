<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
?>
<? $APPLICATION->IncludeComponent(
	"bitrix:menu",
	"horizontal_multilevel_smuzi",
	array(
		"ROOT_MENU_TYPE" => "top_catalog",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(),
		"MAX_LEVEL" => "4",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"IBLOCK_CATALOG_TYPE" => "aspro_mshop_catalog",
		"IBLOCK_CATALOG_ID" => "13",
		"COMPONENT_TEMPLATE" => "horizontal_multilevel_smuzi",
		"IBLOCK_CATALOG_DIR" => "/katalog/",
		"PRICE_CODE" => "",
		"CACHE_SELECTED_ITEMS" => "N"
	),
	false
); ?>
<?
require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
?>