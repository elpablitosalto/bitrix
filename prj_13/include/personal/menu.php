<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

$APPLICATION->IncludeFile(
	SITE_DIR . 'include/personal/user_title.php',
	array(),
	array('SHOW_BORDER' => false)
);

$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "personal",
    Array(
		"ROOT_MENU_TYPE" => "personal",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "personal",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "86400",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => ""
	)
);
?>
