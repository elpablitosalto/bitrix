<?
define('SHOW_TEMPLATE_BOTTOM_BANNER', 'N');
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty("description", "Infinity");
$APPLICATION->SetPageProperty("title", "Infinity");
$APPLICATION->SetTitle("Infinity");
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "slider_banners_main_page",
    array(
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
        "COMPONENT_TEMPLATE" => "mainPage.slider",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(0 => "ID", 1 => "CODE", 2 => "PREVIEW_PICTURE", 3 => "DETAIL_PICTURE", 4 => "",),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => INFINITY_MAIN_BANNERS_IB_ID,
        "IBLOCK_TYPE" => "banners",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "20",
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
        "PROPERTY_CODE" => array(0 => "VDEO_URL", 1 => "VIDEO_FILE",),
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
        "STRICT_SECTION_CHECK" => "N"
    )
); ?>

<div class="page__section">
    <!-- begin .section-->
    <div class="section section_style_decorated">
        <div class="section__main">
            <div class="section__header">
                <div class="section__header-container page__container">
                    <div class="section__title">
                        <!-- begin .title-->
                        <h1 class="title title_size_h4 title_style_primary">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "/include/main/h1.php",
                                    "AREA_FILE_RECURSIVE" => "N",
                                    "EDIT_MODE" => "html",
                                ),
                                false,
                                array('HIDE_ICONS' => 'N')
                            );
                            ?>
                        </h1>
                        <!-- end .title-->
                    </div>
                </div>
            </div>
            <div class="section__content">
                <div class="page__container">
                    <div class="section__text-columns">
                        <!-- begin .text-columns-->
                        <div class="text-columns">
                            <div class="text-columns__col">
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "/include/main/left_col.php",
                                        "AREA_FILE_RECURSIVE" => "N",
                                        "EDIT_MODE" => "html",
                                    ),
                                    false,
                                    array('HIDE_ICONS' => 'N')
                                );
                                ?>
                            </div>
                            <div class="text-columns__col">
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "/include/main/right_col.php",
                                        "AREA_FILE_RECURSIVE" => "N",
                                        "EDIT_MODE" => "html",
                                    ),
                                    false,
                                    array('HIDE_ICONS' => 'N')
                                );
                                ?>
                            </div>
                        </div>
                        <!-- end .text-columns-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>
<div class="page__section">
    <!-- begin .section-->
    <div class="section section_style_filled section_role_features">
        <div class="section__main">
            <div class="section__header">
                <div class="section__header-container page__container">
                    <div class="section__title">
                        <!-- begin .title-->
                        <h2 class="title title_size_h2">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "/include/main/features_title.php",
                                    "AREA_FILE_RECURSIVE" => "N",
                                    "EDIT_MODE" => "html",
                                ),
                                false
                            );
                            ?>
                            <svg class="title__icon title__icon_type_infinity">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/images/icon.svg#icon_infinity"></use>
                            </svg>
                        </h2>
                        <!-- end .title-->
                    </div>
                </div>
            </div>
            <div class="section__content">
                <div class="page__container">
                    <div class="section__icon-panel-group">
                        <!-- begin .icon-panel-group-->
                        <?
                        $GLOBALS["arMainPageFeaturesFilter"]["PROPERTY_SHOW_ON_MAIN_VALUE"] = "Y";
                        $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "features_main_page",
                            array(
                                "IBLOCK_ID" => INFINITY_MAIN_FEATURES_IB_ID,
                                "IBLOCK_TYPE" => "content_en",
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
                                "COMPONENT_TEMPLATE" => "features_main_page",
                                "DETAIL_URL" => "",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_DATE" => "Y",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array(0 => "ID", 1 => "CODE", 2 => "PREVIEW_PICTURE", 3 => "DETAIL_PICTURE", 4 => "",),
                                "FILTER_NAME" => "arMainPageFeaturesFilter",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "20",
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
                                "PROPERTY_CODE" => array(),
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
                                "STRICT_SECTION_CHECK" => "N"
                            )
                        ); ?>
                        <!-- end .icon-panel-group-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>

<div class="page__section">
    <!-- begin .section-->
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "accordion_sections_main_page",
        array(
            "VIEW_MODE" => "TEXT",
            "SHOW_PARENT_NAME" => "Y",
            "IBLOCK_TYPE" => "catalog_en",
            "IBLOCK_ID" => INFINITY_CATALOG_EN_IB_ID,
            "SECTION_ID" => "",
            "SECTION_CODE" => "",
            "SECTION_URL" => "",
            "COUNT_ELEMENTS" => "N",
            "TOP_DEPTH" => "1",
            "SECTION_FIELDS" => array(
                0 => "ID",
                1 => "CODE",
                2 => "NAME",
                3 => "DESCRIPTION",
                4 => "PICTURE",
                5 => "SORT",
            ),
            "SECTION_USER_FIELDS" => array(
                "UF_TO_MAIN",
                "UF_MAIN_BLOCK_SMALL_DESC",
                "UF_MAIN_SECTIONS_DESC",
            ),
            "ADD_SECTIONS_CHAIN" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_NOTES" => "",
            "CACHE_GROUPS" => "Y",
            "COMPONENT_TEMPLATE" => "accordion_sections_main_page",
            "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
            "FILTER_NAME" => "arrSectionListFilter",
            "CACHE_FILTER" => "N",
            "INCLUDE_EXTRA_SLIDES" => "Y",
        ),
        false
    );
    ?>
    <!-- end .section-->
</div>

<div class="page__banner">
    <div class="page__container">
        <!-- begin .banner-->
        <div class="banner">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . "/include/main/bottom_banner.php",
                    "AREA_FILE_RECURSIVE" => "N",
                    "EDIT_MODE" => "html",
                ),
                false
            );
            ?>            
        </div>
        <!-- end .banner-->
    </div>
</div>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>