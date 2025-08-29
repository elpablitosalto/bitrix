<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Мероприятия Concept | Профессиональная косметика для волос Concept");
$APPLICATION->SetPageProperty("description", "Узнайте первыми о семинарах и обучающих мероприятиях бренда Концепт на официальном сайте. Точная информация о датах проведения обучения у экспертов Concept, авторских мастер-классов, базовых семинаров с демонстрацией продукции.");
//$APPLICATION->SetTitle("Мероприятия");
?><section class="content">
	<div class="container _inside-page">
		<? $APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			"hair.crumbs",
			array(
				"PATH" => "",
				"SITE_ID" => "s1",
				"START_FROM" => "0"
			)
		); ?>
		<h1 class="_small"><?= $APPLICATION->ShowTitle(false) ?></h1>
		<div class="seminars-list">
			<div class="mobile-filter-button">
			</div>
			<div class="seminars-list__filter">
				<? $APPLICATION->IncludeComponent(
					"bitrix:catalog.smart.filter",
					"events.page.filter",
					array(
						"CACHE_GROUPS" => "Y",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"COMPONENT_TEMPLATE" => "events.page.filter",
						"DISPLAY_ELEMENT_COUNT" => "Y",
						"FILTER_NAME" => "arrFilter",
						"FILTER_VIEW_MODE" => "vertical",
						"IBLOCK_ID" => "6",
						"IBLOCK_TYPE" => "press_center",
						"PAGER_PARAMS_NAME" => "arrPager",
						"POPUP_POSITION" => "left",
						"PREFILTER_NAME" => "smartPreFilter",
						"SAVE_IN_SESSION" => "N",
						"SECTION_CODE" => "",
						"SECTION_CODE_PATH" => "",
						"SECTION_DESCRIPTION" => "-",
						"SECTION_ID" => $_REQUEST["SECTION_ID"],
						"SECTION_TITLE" => "-",
						"SEF_MODE" => "N",
						"SEF_RULE" => "",
						"SMART_FILTER_PATH" => "",
						"TEMPLATE_THEME" => "blue",
						"XML_EXPORT" => "N"
					)
				); ?>
			</div>
			<div class="seminars-list__wrapper">
				<? $APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"events.page",
					array(
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"ADD_SECTIONS_CHAIN" => "N",
						"AJAX_MODE" => "Y",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "Y",
						"CACHE_TIME" => "86400",
						"CACHE_TYPE" => "A",
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"DISPLAY_DATE" => "Y",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"FIELD_CODE" => array("", ""),
						"FILE_404" => "",
						"FILTER_NAME" => "",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"IBLOCK_ID" => "6",
						"IBLOCK_TYPE" => "press_center",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"INCLUDE_SUBSECTIONS" => "Y",
						"MESSAGE_404" => "",
						"NEWS_COUNT" => "0",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"PAGER_TITLE" => "Новости",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "#SECTION_CODE#",
						"PREVIEW_TRUNCATE_LEN" => "",
						"PROPERTY_CODE" => array("TITLE", "SUBTITLE", "START_DATE", "EVENT_TIME", "STATUS", "COST", "TYPE", ""),
						"SET_BROWSER_TITLE" => "Y",
						"SET_LAST_MODIFIED" => "N",
						"SET_META_DESCRIPTION" => "Y",
						"SET_META_KEYWORDS" => "Y",
						"SET_STATUS_404" => "Y",
						"SET_TITLE" => "Y",
						"SHOW_404" => "N",
						"SORT_BY1" => "SORT",
						"SORT_BY2" => "ACTIVE_FROM",
						"SORT_ORDER1" => "ASC",
						"SORT_ORDER2" => "DESC",
						"STRICT_SECTION_CHECK" => "N"
					)
				); ?>
			</div>
		</div>
	</div>
</section><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>