<?

use \Bitrix\Main\Context;
use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

Asset::getInstance()->addString('<script data-skip-moving="true" src="https://widget.cloudpayments.ru/bundles/cloudpayments.js"></script>');

$APPLICATION->SetTitle("");

$request = Context::getCurrent()->getRequest();
?>

<div class="page-head">
	<div class="container">
		<? $APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			"",
			array(),
			false
		); ?>
		<h1 class="page-title"><? $APPLICATION->ShowTitle(false) ?></h1>
	</div>
</div>

<?
// Определим тип страницы и в зависимости от этого параметры -->
$dir = $APPLICATION->GetCurDir();
if (strpos($dir, "/news/") !== false) {
	$IBLOCK_ID = Indexis::getIblockId("news", "content", SITE_ID);
	$SEF_FOLDER = "/news/";
	$TYPE_IBLOCK = "news";
	$SEF_URL_TEMPLATES = array("detail" => "#ELEMENT_CODE#/", "news" => "", "section" => "#SECTION_CODE#/", "search" => "search/");
	$SHOW_TOP_SECTIONS = "N";
} else if (strpos($dir, "/media/") !== false) {
	$IBLOCK_ID = Indexis::getIblockId("materials", "content", SITE_ID);
	$SEF_FOLDER = "/media/";
	$TYPE_IBLOCK = "media";
	$SEF_URL_TEMPLATES = array("detail" => "#SECTION_CODE#/#ELEMENT_CODE#/", "news" => "", "section" => "#SECTION_CODE#/", "search" => "search/");
	$SHOW_TOP_SECTIONS = "Y";
	$ALL_SECTIONS_TITLE = "Все материалы";
}
// <--
?>

<? $APPLICATION->IncludeComponent(
	"bitrix:news",
	"news",
	array(
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "NAME",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array("ID", "CODE", "NAME", "TAGS", "DETAIL_PICTURE", "ACTIVE_FROM"),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array("PROGRAM", "PROJECT", "PUBLIC_DATE", "PUBLICATION_TYPE", "CONSTRUCTOR", "VIDEO_LINK", "VIDEO_PICTURE", "VIDEO_NAME"),
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => $IBLOCK_ID,
		"IBLOCK_TYPE" => "content",
		"INSTANT_RELOAD" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"FILTER_NAME" => "newsFilter",
		"PROJECTS_FILTER_NAME" => "projectsFilter",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array("PREVIEW_TEXT", ""),
		"LIST_PROPERTY_CODE" => array("PUBLIC_DATE", "PUBLICATION_TYPE", "BACKG_COLOR", "SHOW_TYPE"),
		"MEDIA_PROPERTY" => "",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "12",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "show_more_v2",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_FOLDER" => $SEF_FOLDER,
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => $SEF_URL_TEMPLATES,
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SET_FILTER" => ($request->get("set_filter") == "y") ? "Y" : "",
		"SHOW_404" => "Y",
		"SLIDER_PROPERTY" => "",
		"SORT_BY1" => "PROPERTY_PUBLIC_DATE",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "Y",
		"USE_SHARE" => "N",

		"TYPE_IBLOCK" => $TYPE_IBLOCK,
		"SHOW_TOP_SECTIONS" => $SHOW_TOP_SECTIONS,
		"ALL_SECTIONS_TITLE" => $ALL_SECTIONS_TITLE,
	)
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>