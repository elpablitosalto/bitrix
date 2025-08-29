<?
define('MENU_TYPE', 5);
//define('SHOW_COLUMNS_IN_HEADER', 'N');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Проект");
$APPLICATION->SetPageProperty("PAGE_H3", 'Проект');
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-project');
$APPLICATION->AddViewContent('PAGE_CONTENT_BEFORE_H1', '<div class="dp-page__back"><a href="/portfolio/"><svg class="icon icon-drop-left "><use xlink:href="#drop-left"></use></svg><span>Портфолио</span></a></div>');
?>

<? $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"project",
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
		"IBLOCK_TYPE" => 'content',
		"IBLOCK_ID" => Indexis::getIblockId('portfolio', 'content'),
		"ELEMENT_ID" => "",
		"ELEMENT_CODE" => $_GET['ELEMENT_CODE'],
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array("ID", 'NAME', 'DETAIL_PICTURE', 'DETAIL_TEXT', 'IBLOCK_SECTION_ID'),
		"PROPERTY_CODE" => array('OBJECT_TYPE', 'PRODUCT_CATALOG', 'MONTH', 'YEAR', 'CITY', 'ADDRESS', 'PICTURE_CUSTOM_ORDER', 'OBJECT_NATURE', 'CUSTOM_SOLUTION', 'PICTURE_1', 'PICTURE_2', 'TEXT_2', 'PICTURE_3', 'PICTURE_4', 'PICTURE_5', 'TEXT_5', 'PICTURE_6', 'PICTURE_7', 'DIGITS', 'DESIGNER', 'DESIGNER_QUOTE'),
		"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
		"DETAIL_URL" => "",
		"SET_TITLE" => "Y",
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
		'LIST_URL' => '/portfolio/',
		// <-- Мои параметры
	)
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>