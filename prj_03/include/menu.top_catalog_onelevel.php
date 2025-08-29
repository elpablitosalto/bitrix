<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"horizontal_multilevel_smuzi", 
	array(
		"ROOT_MENU_TYPE" => "top_catalog_onelevel",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left_onelevel",
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
);?>