<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Баннеры");
?><div class="page__content-top">
    <div class="page__holder">
        <div class="page__top-wrapper">
            <div class="page__breadcrumbs">
                 <?$APPLICATION->IncludeComponent(
    "bitrix:breadcrumb",
    "main",
    Array(
        "SITE_ID" => "s1",
        "START_FROM" => "0"
    )
);?>
            </div>
        </div>
    </div>
</div>
<div class="page__section">
    <!-- <div class="page__holder"> -->
        <div class="section section_space_much">
            <div class="section__header">
                <div class="page__holder">
                    <div class="section__title">
                        <h1 class="title title_size_h2">Баннеры</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="section__content">
            <?
            $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"banners-list", 
	array(
		"TITLE" => "Баннеры",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "27",
		"NEWS_COUNT" => "300",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "TITLE",
			1 => "YOUTUBE_LINK",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"ACTIVE_DATE_FORMAT" => "M j, Y",
		"DISPLAY_PANEL" => "N",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "News",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "banners-list",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);
            ?>
        </div>
    <!-- </div> -->
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>