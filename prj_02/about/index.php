<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("О фонде");
?><div class="page-head">
	<div class="container">
		<div class="section__content">
			<? $APPLICATION->IncludeComponent(
				"bitrix:breadcrumb",
				"",
				array()
			); ?>
		</div>
		<h1 class="page-title"><? $APPLICATION->ShowTitle(false) ?></h1>
	</div>
</div>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"about",
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "about",
		"ELEMENT_ID" => "",
		"FIELD_CODE" => array("", ""),
		"FILE_404" => "",
		"IBLOCK_ID" => Indexis::getIblockId("about", "pages", "s1"),
		"IBLOCK_TYPE" => "pages",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array(
			"BLOCK_FIRST", "VIDEO_LINK", "MAIN_DIGITS", "WHAT_WE_DO_TITLE", "WHAT_WE_DO_BLOCK1", "WHAT_WE_DO_BLOCK2", "WHAT_WE_DO_BLOCK3", "WHAT_WE_DO_BLOCK4", "HISTORY", "OPEN_TEXT", "OPEN_LINKS", "PARTNERS_TEXT",
			"PHOTO1", "PHOTO2", "PHOTO3", "PHOTO4", "PHOTO5"
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N"
	)
); ?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>