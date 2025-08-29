<?
if(!defined("REMOVE_CONTENT_OFFSET")){
    define("REMOVE_CONTENT_OFFSET", "Y");
}
if(!defined("REMOVE_CONTENT_WRAPPER")){
    define("REMOVE_CONTENT_WRAPPER", "Y");
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Компания Мир Вендинга - Мы помогаем вести бизнес без лишних хлопот: продаем снеки и напитки оптом, привозим лучшие вендинговые аппараты Европы, осуществляем их техническое обслуживание и ремонт.");
$APPLICATION->SetPageProperty("title", "О компании");
$APPLICATION->SetTitle("О компании");
?>
<div class="page__section">
    <div class="page__container">
        <!-- begin .info-block-->
        <div class="about-top-banner">
            <div class="about-top-banner__content">
                <?php
                $APPLICATION->IncludeComponent("bitrix:main.include", "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH."/include/company/top_banner.php",
                        "AREA_FILE_RECURSIVE" => "N",
                        "EDIT_MODE" => "html",
                    )
                );
                ?>
            </div>
        </div>
        <!-- end .about-top-banner-->
    </div>
</div>
<?
$GLOBALS["advantagesFilter"] = ["PROPERTY_PAGE_VALUE" => "О компании"];
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "entry-group",
    array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "N",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "COMPONENT_TEMPLATE" => "entry-group",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "N",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(
            0 => "ID",
            1 => "NAME",
            2 => "PREVIEW_PICTURE",
            3 => "DETAIL_PICTURE",
            4 => "",
        ),
        "FILTER_NAME" => "advantagesFilter",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => ADVANTAGES_IB_ID,
        "IBLOCK_TYPE" => "data",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "5",
        "PAGER_BASE_LINK" => "",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_PARAMS_NAME" => "arrPager",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "NUMBER",
            2 => "",
        ),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N",
        "TITLE" => "Наши преимущества",
        "SECTION_CLASS" => "section_type_about"
    ),
    false
);?>
<div class="page__section">
    <div class="page__container">
        <!-- begin .info-block-->
        <div class="important-numbers important-numbers_type_about">
            <div class="important-numbers__content">
                <div class="important-numbers__main-number">
                    <?
                    $zeroYear = 2008;
                    $currentYear = intval((new \Bitrix\Main\Type\DateTime())->format("Y"));
                    ?>
                    <span class="important-numbers__main"><?=($currentYear - $zeroYear)?>+</span>
                    <span class="important-numbers__subtitle">
                        <?php
                        $APPLICATION->IncludeComponent("bitrix:main.include", "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH."/include/company/years_at_market.php",
                                "AREA_FILE_RECURSIVE" => "N",
                                "EDIT_MODE" => "html",
                            )
                        );
                        ?>
                    </span>
                </div>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "metrics",
                    array(
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "N",
                        "CACHE_FILTER" => "Y",
                        "CACHE_GROUPS" => "N",
                        "CACHE_TIME" => "3600",
                        "CACHE_TYPE" => "A",
                        "CHECK_DATES" => "Y",
                        "COMPONENT_TEMPLATE" => "metrics",
                        "DETAIL_URL" => "",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "N",
                        "DISPLAY_PICTURE" => "N",
                        "DISPLAY_PREVIEW_TEXT" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array(
                            0 => "ID",
                            1 => "NAME",
                            2 => "PREVIEW_PICTURE",
                            3 => "DETAIL_PICTURE",
                            4 => "",
                        ),
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => METRICS_IB_ID,
                        "IBLOCK_TYPE" => "info",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "5",
                        "PAGER_BASE_LINK" => "",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_PARAMS_NAME" => "arrPager",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "",
                        "PAGER_TITLE" => "Новости",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array(
                            0 => "",
                            1 => "NUMBER",
                            2 => "",
                        ),
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "SORT",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "SORT_ORDER2" => "ASC",
                        "STRICT_SECTION_CHECK" => "N",
                    ),
                    false
                );?>
            </div>
        </div>
        <!-- end .important-numbers-->
    </div>
</div>
<div class="page__section">
    <!-- begin .about-banner-->
    <?php
    $APPLICATION->IncludeComponent("bitrix:main.include", "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH."/include/company/vasa_banner.php",
            "AREA_FILE_RECURSIVE" => "N",
            "EDIT_MODE" => "html"
        )
    );
    ?>
    <!-- end .about-banner-->
</div>
<div class="page__section">
    <div class="page__container">
        <!-- begin .section-->
        <?
        $GLOBALS["clientsFilter"] = ["PROPERTY_TYPE_VALUE" => "Клиент"];
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "clients_brands",
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "N",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "COMPONENT_TEMPLATE" => "clients_brands",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "N",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "ID",
                    1 => "NAME",
                    2 => "PREVIEW_PICTURE",
                    3 => "DETAIL_PICTURE",
                    4 => "",
                ),
                "FILTER_NAME" => "clientsFilter",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => CLIENTS_PARTNERS_IB_ID,
                "IBLOCK_TYPE" => "data",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "N",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "5",
                "PAGER_BASE_LINK" => "",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_PARAMS_NAME" => "arrPager",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "NUMBER",
                    2 => "",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "TITLE" => "Наши клиенты",
                "SLIDER_JS_CLASS" => "js-logo-carousel-about",
                "SLIDER_WRAP_CLASS" => "logo-carousel-about logo-carousel-about_about",
                "SLIDER_ABOUT_CLASS" => "Y"

            ),
            false
        );?>
        <!-- end .section-->
		<!-- js-logo-carousel-compact-->
    </div>
</div>
<div class="page__section">
    <div class="page__container">

        
        <!-- begin .section-->
        <div class="section section_type_about-l">
            <div class="section__header">
                <div class="section__title">
                    <!-- begin .title-->
                    <div class="title title_size_h1">Дистрибьюция и партнерство</div>
                    <!-- end .title-->
                </div>
            </div>
            <div class="section__content">
                <div class="section__info-block">
                    <?php
                    $APPLICATION->IncludeComponent("bitrix:main.include", "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH."/include/company/distribution.php",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_MODE" => "html",
                            "BACKGROUND_COLOR" => "#000"
                        )
                    );
                    ?>
                </div>
            </div>
        </div>
        <!-- end .section-->
    </div>
</div>
<div class="page__section">
    <div class="page__container">
        <!-- begin .section-->
        <?
        $GLOBALS["partnersFilter"] = ["PROPERTY_TYPE_VALUE" => "Партнер"];
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "clients_brands",
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "N",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "COMPONENT_TEMPLATE" => "clients_brands",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "N",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "ID",
                    1 => "NAME",
                    2 => "PREVIEW_PICTURE",
                    3 => "DETAIL_PICTURE",
                    4 => "",
                ),
                "FILTER_NAME" => "partnersFilter",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => CLIENTS_PARTNERS_IB_ID,
                "IBLOCK_TYPE" => "data",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "N",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "5",
                "PAGER_BASE_LINK" => "",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_PARAMS_NAME" => "arrPager",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "NUMBER",
                    2 => "",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "TITLE" => "Наши партнеры",
                "SECTION_CLASS" => "section_type_about",
				"SLIDER_WRAP_CLASS" => "logo-carousel logo-carousel_partners-about",
                "FORM" => [
                    "CODE" => "contactForm",
                    "NAME" => "Стать поставщиком"
                ]
            ),
            false
        );?>
        <!-- end .section-->
    </div>
</div>
<? $APPLICATION->IncludeComponent("bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_TEMPLATE_PATH."/include/common/map.php",
        "AREA_FILE_RECURSIVE" => "N",
        "EDIT_MODE" => "html",
        "SECTION_CLASS" => "section_type_about-s"
    ), false
)	;
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>