<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Look Book");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_TEMPLATE_PATH."/include/seo/seo.php",
		"AREA_FILE_RECURSIVE" => "N",
		"EDIT_MODE" => "html",
		"SEO_ID" => "4642",
		"TARGET_URI" => "/lookbook/",
		"TARGET_ROOT" => INFINITY_ROOT,
		"PAGE_URI" => $_SERVER['REQUEST_URI'],
		"PAGE_QUERY" => $_SERVER['QUERY_STRING']
	),
	false,
);?>
<div class="page__breadcrumbs">
    <div class="page__container">
        <!-- begin .breadcrumbs-->
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","hair.crumbs",Array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1"
            )
        );?>
        <!-- end .breadcrumbs-->
    </div>
</div>
<div class="page__section">
    <!-- begin .section-->
    <div class="section section_role_lookbook-grid section_text-size_l section_text-style_grey section_spacing_top-close">
        <div class="section__header">
            <div class="section__container page__container">
                <div class="section__title">
                    <!-- begin .title-->
                    <h1 class="title title_size_h4">Look Book</h1>
                    <!-- end .title-->
                </div>
                <div class="section__text">
                    <? $APPLICATION->IncludeComponent("bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH."/include/lookbook/list_desc.php",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_MODE" => "html",
                        ), false
                    );
                    ?>
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="page__container">
                <div class="section__lookbook-grid">
                    <!-- begin .lookbook-grid-->
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        'lookbook.list',
                        Array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array("ID","CODE","PREVIEW_PICTURE","DETAIL_PICTURE",""),
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => INFINITY_LOOKBOOK_IB_ID,
                            "IBLOCK_TYPE" => "content",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "9",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Новости",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array("","WHAT_WE_USE","INSTRUCTION", "SECTION_PRODUCTS_NAMES"),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "DESC",
                            "SORT_ORDER2" => "ASC",
                            "STRICT_SECTION_CHECK" => "N",
                            "TOP_BANNER_DESKTOP" => "/upload/Look_Book/banner category_LookBook_pk.jpg",
                            "TOP_BANNER_MOBILE" => "/upload/Look_Book/banner category__LookBook_mob.jpg"
                        )
                    );?>
                    <!-- end .lookbook-grid-->
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>