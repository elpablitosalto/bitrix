<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>

<?
$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "marketplace_section",
    Array(
        "ROOT_MENU_TYPE" => "marketplace",
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "marketplace",
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
