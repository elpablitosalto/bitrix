<?
define('CUSTOM_LAYOUT_PAGE', true);
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", "page-title__red");
?><?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/personal/menu.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order", 
	".default", 
	array(
		"STATUS_COLOR_N" => "green",
		"STATUS_COLOR_P" => "yellow",
		"STATUS_COLOR_F" => "gray",
		"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
		"SEF_MODE" => "N",
		"ORDERS_PER_PAGE" => "10",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PATH_TO_BASKET" => "/personal/cart/",
		"SET_TITLE" => "N",
		"SAVE_IN_SESSION" => "Y",
		"NAV_TEMPLATE" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"PROP_1" => array(
		),
		"PROP_2" => array(
		),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"CUSTOM_SELECT_PROPS" => array(
		),
		"HISTORIC_STATUSES" => array(
		),
		"SEF_FOLDER" => "/",
		"COMPONENT_TEMPLATE" => ".default",
		"DETAIL_HIDE_USER_INFO" => array(
			0 => "0",
		),
		"PATH_TO_CATALOG" => "/catalog/",
		"DISALLOW_CANCEL" => "N",
		"RESTRICT_CHANGE_PAYSYSTEM" => array(
			0 => "0",
		),
		"REFRESH_PRICES" => "N",
		"ORDER_DEFAULT_SORT" => "STATUS"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>