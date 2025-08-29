<?
define('SHOW_COLUMNS_IN_HEADER', 'N');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Коллекция");
$APPLICATION->SetPageProperty("PAGE_H3", 'Коллекция');
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-collection');
$APPLICATION->AddViewContent('PAGE_CONTENT_BEFORE_H1', '<div class="dp-page__back"><a href="/collections/"><svg class="icon icon-drop-left "><use xlink:href="#drop-left"></use></svg><span>Коллекции</span></a></div>');
?>

<? $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"collection",
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"USE_SHARE" => "N",
		"SHARE_HIDE" => "Y",
		"SHARE_TEMPLATE" => "",
		"SHARE_HANDLERS" => array("delicious"),
		"SHARE_SHORTEN_URL_LOGIN" => "",
		"SHARE_SHORTEN_URL_KEY" => "",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => 'store',
		"IBLOCK_ID" => Indexis::getIblockId('collections', 'store'),
		"ELEMENT_ID" => "",
		"ELEMENT_CODE" => $_GET['ELEMENT_CODE'],
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array("ID", 'NAME', 'DETAIL_PICTURE', 'DETAIL_TEXT', 'IBLOCK_SECTION_ID'),
		"PROPERTY_CODE" => array('FILES', 'PICTURES_SLIDER', 'H_TEXT_B', 'D_TEXT_B', 'DE_TEXT_B', 'M_TEXT_B', 'MATERIALS', 'PRODUCTS', 'FILES_NAME', 'FILES_LINK', 'VIDEO_SLIDER_POSTER', 'VIDEO_SLIDER'),
		"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
		"DETAIL_URL" => "",
		"SET_TITLE" => "N",
		"SET_CANONICAL_URL" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_STATUS_404" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"USE_PERMISSIONS" => "N",
		"GROUP_PERMISSIONS" => array("1"),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Страница",
		"PAGER_TEMPLATE" => "",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"STRICT_SECTION_CHECK" => "Y",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",

		// Мои параметры -->
		'LIST_URL' => '/collections/',
		'DESIGNERS_IBLOCK_ID' => Indexis::getIblockId('designers', 'content'),
		'MANUFACTERS_IBLOCK_ID' => Indexis::getIblockId('manufacters', 'directory'),
		'MATERIALS_IBLOCK_ID' => Indexis::getIblockId('materials', 'content'),
		'PRODUCTS_IBLOCK_ID' => Indexis::getIblockId('1c_catalog', '1c_catalog'),
		// <-- Мои параметры
	)
); ?>

<br />
<br />

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>