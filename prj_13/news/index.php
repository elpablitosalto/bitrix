<?
// Если карточка бренда -->
$bBrandDetail = false;
preg_match('/brands\/([0-9a-zA-Z-]+)\//', $_SERVER['REQUEST_URI'], $matches);
if (
	is_array($matches)
	&& count($matches) == 2
	&& strlen($matches[0]) > 0
	&& strlen($matches[1]) > 0
) {
	$bBrandDetail = true;
}
// <-- Если карточка бренда

// Тип страницы -->
if ($bBrandDetail) {
	define('PAGE_TYPE', 5);
} else {
	define('PAGE_TYPE', 2);
}
// <-- Тип страницы

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?><?
	// Определим тип страницы и в зависимости от этого параметры -->
	$dir = $APPLICATION->GetCurDir();
	$LIST_PROPERTY_CODE = array();
	$DETAIL_PROPERTY_CODE = array();
	if (strpos($dir, "/news/") !== false) {
		$APPLICATION->SetTitle("Новости");
		$APPLICATION->SetPageProperty("description","Новости. Компания Стройсервис в Москве. ☎ +7 (495) 229-30-20");
		$IBLOCK_ID = Indexis::getIblockId("shop_news", "content");
		$SEF_FOLDER = "/news/";
		$PAGER_TITLE = "Новости";
		$TEMPLATE_LIST = "news";
		$TEMPLATE_DETAIL = "articles";
	} else if (strpos($dir, "/articles/") !== false) {
		$APPLICATION->SetTitle("Статьи");
		$IBLOCK_ID = Indexis::getIblockId("articles", "content");
		$SEF_FOLDER = "/articles/";
		$PAGER_TITLE = "Статьи";
		$TEMPLATE_LIST = "articles";
		$TEMPLATE_DETAIL = "articles";
	} else if (strpos($dir, "/brands/") !== false) {
		$APPLICATION->SetTitle("Бренды");
		$IBLOCK_ID = Indexis::getIblockId("brands");
		$SEF_FOLDER = "/brands/";
		$PAGER_TITLE = "Бренды";
		$TEMPLATE_LIST = "brands";
		$TEMPLATE_DETAIL = "brands";
		$LIST_PROPERTY_CODE = array("ORIGINAL_NAME", "PRODUCT_TYPE", "COUNTRY_HOME", "COUNTRY_MADE");
		$DETAIL_PROPERTY_CODE = array('ORIGINAL_NAME', 'CERTIFICATE_BRAND_DETAIL');
	} else if (strpos($dir, "/promos/") !== false) {
		$APPLICATION->SetTitle("Акции");
		$APPLICATION->SetPageProperty("description","Акции. Компания Стройсервис в Москве. ☎ +7 (495) 229-30-20");
		$IBLOCK_ID = Indexis::getIblockId("promos");
		$SEF_FOLDER = "/promos/";
		$PAGER_TITLE = "Акции";
		$TEMPLATE_LIST = "news";
		$TEMPLATE_DETAIL = "articles";
	}
	// <--
	?>
<? $APPLICATION->IncludeComponent(
	"bitrix:news",
	"news",
	array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => $IBLOCK_ID,
		"TEMPLATE_THEME" => "site",
		"NEWS_COUNT" => "9",
		"USE_SEARCH" => "N",
		"USE_RSS" => "Y",
		"NUM_NEWS" => "20",
		"NUM_DAYS" => "180",
		"YANDEX" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "N",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER2" => "DESC",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => $SEF_FOLDER,
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_PANEL" => "Y",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "Y",
		"USE_PERMISSIONS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "NAME",
			1 => "DETAIL_PICTURE",
			2 => "PREVIEW_PICTURE",
			3 => "PREVIEW_TEXT",
			4 => "DETAIL_PAGE_URL",
		),
		"LIST_PROPERTY_CODE" => $LIST_PROPERTY_CODE,
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "NAME",
			1 => "DETAIL_PICTURE",
			2 => "PREVIEW_PICTURE",
			3 => "PREVIEW_TEXT",
			4 => "DETAIL_PAGE_URL",
			5 => "DETAIL_TEXT",
		),
		"DETAIL_PROPERTY_CODE" => $DETAIL_PROPERTY_CODE,
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "stroyservis",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => $PAGER_TITLE,
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "stroyservis",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SLIDER_PROPERTY" => "PICS_NEWS",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
			"search" => "search/",
			"rss" => "rss/",
			"rss_section" => "#SECTION_ID#/rss/",
		),

		// Мои параметры -->
		//"SHOW_PREVIEW_TEXT_IN_LIST" => $SHOW_PREVIEW_TEXT_IN_LIST,
		"TEMPLATE_LIST" => $TEMPLATE_LIST,
		"TEMPLATE_DETAIL" => $TEMPLATE_DETAIL,
		"DETAIL_CACHE_TYPE" => "N",
		// <-- Мои параметры
	),
	false
); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>