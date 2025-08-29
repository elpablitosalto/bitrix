<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обучающие видео");
?>
<section class="content tutorial-videos">
	<div class="container _inside-page">
		<?$APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			"hair.crumbs",
			Array(
				"PATH" => "",
				"SITE_ID" => "s1",
				"START_FROM" => "0"
			)
		);?>
	</div>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "sect",
			"AREA_FILE_SUFFIX" => "banner",
			"EDIT_TEMPLATE" => ""
		)
	);?>
	<div class="container _column">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "sect",
				"AREA_FILE_SUFFIX" => "intro",
				"EDIT_TEMPLATE" => ""
			)
		);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"tutorial-videos-categories",
			Array(
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
				"ELEMENT_CODE" => $_REQUEST["CODE"],
				"ELEMENT_ID" => "",
				"FIELD_CODE" => array("",""),
				"IBLOCK_ID" => "39",
				"IBLOCK_TYPE" => "content",
				"IBLOCK_URL" => "",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"MESSAGE_404" => "",
				"META_DESCRIPTION" => "-",
				"META_KEYWORDS" => "-",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Страница",
				"PROPERTY_CODE" => array("","TOP_BANNER_DESKTOP","TOP_BANNER_MOBILE",""),
				"SET_BROWSER_TITLE" => "Y",
				"SET_CANONICAL_URL" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "Y",
				"SET_TITLE" => "Y",
				"SHOW_404" => "Y",
				"SORT_BY1" => "ID",
				"SORT_BY2" => "SORT",
				"SORT_ORDER1" => "DESC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N",
				"USE_PERMISSIONS" => "N",
				"USE_SHARE" => "N",
				"TOP_BANNER_DESKTOP" => "/upload/tutorial-banners/videos-banner.jpg",
				"TOP_BANNER_MOBILE" => "/upload/tutorial-banners/videos-banner_m.jpg"
			)
		);?>
	</div>
	<section class="ask-question">
		<div class="container">
			<div class="ask-question__text">
				<p>Вы всегда можете написать нам по любому интересующему Вас вопросу. Для этого необходимо заполнить форму и отправить её. Наши специалисты ответят Вам в течение 24 часов.</p>
			</div>
			<div class="ask-question__button"><a href="#askQuestion" data-popup="askQuestion" class="button _big">Задать вопрос</a></div>
		</div>
	</section>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>