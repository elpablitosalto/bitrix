<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости");
?>

<? $APPLICATION->IncludeComponent(
	"bitrix:news",
	"news_page",
	array(
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "14",
		"NEWS_COUNT" => "30",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/news/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
		"USE_PERMISSIONS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "NAME",
			3 => "PREVIEW_PICTURE",
			4 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
			2 => "",
			3 => "",
			4 => "",
			5 => "",
			6 => "",
			7 => "",
			8 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "N",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "DATE_CREATE",
			3 => "ID",
			4 => "CODE",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "GALLERY",
			1 => "VIDEO_YOUTUBE_LINK",
			2 => "VIDEO_IMAGE",
			3 => "PRIMARY_BUTTON_DISPLAY",
			4 => "PRIMARY_BUTTON_TEXT",
			5 => "PRIMARY_BUTTON_LINK",
			6 => "SECONDARY_BUTTON_TEXT",
			7 => "SECONDARY_BUTTON_DISPLAY",
			8 => "SECONDARY_BUTTON_LINK",
			9 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"SHOW_TAGS" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "news_page",
		"USE_REVIEW" => "N",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"SEF_URL_TEMPLATES" => array(
			"news" => "index.php",
			"section" => "#SECTION_CODE_PATH#",
			"detail" => "#ELEMENT_CODE#",
		)
	),
	false
);?>


<div class="page__section page__section_decoration_bottom">
	<!-- begin .section-->
	<div class="section section_space_close">
		<div class="section__content">
			<div class="section__following">
				<!-- begin .following-->
				<div class="following">
					<div class="following__container swiper js-following-carousel">
						<div class="following__wrapper swiper-wrapper">
							<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/text_carousel/main.php",
								Array(),
								Array("MODE" => "html", "NAME" => "TEXT_CAROUSEL")
							);?>
						</div>
					</div>
				</div>
				<!-- end .following-->
			</div>
		</div>
	</div>
	<!-- end .section-->
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>