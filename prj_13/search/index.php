<?
define('CUSTOM_LAYOUT_PAGE', true);
define('PAGE_TYPE', 4);
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Поиск по сайту');
?>

<? $APPLICATION->IncludeComponent(
	"bitrix:catalog.search", 
	".default", 
	array(
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "7",
		"USE_SUGGEST" => "Y",
		"FILTER_NAME" => "searchFilter",
		"PREFILTER_NAME" => "searchPreFilter",
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_ORDER" => "ASC",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"DISPLAY_COMPARE" => "Y",
		"PAGE_ELEMENT_COUNT" => "12",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_FIELD_CODE" => "",
		"OFFERS_PROPERTY_CODE" => "",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "0",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"USE_PRODUCT_QUANTITY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"RESTART" => "Y",
		"NO_WORD_LOGIC" => "Y",
		"USE_LANGUAGE_GUESS" => "N",
		"CHECK_DATES" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "stroyservis",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"HIDE_NOT_AVAILABLE" => "L",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"OFFERS_CART_PROPERTIES" => "",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "Y",
		"PRODUCT_ROW_VARIANTS" => "1",
		"FILTER_VIEW_MODE" => "HORIZONTAL",
		"COMPONENT_TEMPLATE" => ".default",
		"HIDE_NOT_AVAILABLE_OFFERS" => "L",
		"LINE_ELEMENT_COUNT" => "3",
		"AJAX_OPTION_ADDITIONAL" => "search",
		"PRODUCT_PROPERTIES" => array(
		),
		"USE_TITLE_RANK" => "N",
		"USE_SEARCH_RESULT_ORDER" => "N",
		"INSTANT_RELOAD" => "Y",
		"PAGE_RESULT_COUNT" => 1000
	),
	false
);
?>

<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>

