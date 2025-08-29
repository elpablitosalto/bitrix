<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

?>
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
    <div class="section section_role_info-panels section_spacing_top-close section_text-style_grey">
        <div class="section__header">
            <div class="section__container page__container">
                <div class="section__title">
                    <!-- begin .title-->
                    <h1 class="title title_size_h4">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH."/include/catalog/title.php",
                                "AREA_FILE_RECURSIVE" => "N",
                                "EDIT_MODE" => "html",
                            ), false
                        );
                        ?>
                    </h1>
                    <!-- end .title-->
                </div>
                <div class="section__text">
                    <? $APPLICATION->IncludeComponent("bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH."/include/catalog/description.php",
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
                <div class="section__info-group">
                    <!-- begin .info-group-->
                    <?
                    global $arCatalogSectionsFilter;
                    $arCatalogSectionsFilter['UF_SHOW_IN_CATALOG'] = 1;
                    $sectionListParams = array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                        "SECTION_USER_FIELDS" => [
                            "UF_MAIN_BLOCK_SMALL_DESC"
                        ],
                        "FILTER_NAME" => 'arCatalogSectionsFilter',
                        "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
                        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                        "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                        "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                        "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                        "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
                    );
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section.list",
                        "sections.page",
                        $sectionListParams,
                        $component,
                        array("HIDE_ICONS" => "Y")
                    );
                    unset($sectionListParams);
                    ?>
                    <!-- end .info-group-->
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>
<div class="page__section">
    <!-- begin .section-->
    <div class="section section_role_products section_style_full-gradient">
        <div class="section__header">
            <div class="section__container page__container">
                <div class="section__title">
                    <!-- begin .title-->
                    <h2 class="title title_size_h4 title_style_dependent">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH."/include/catalog/products_title.php",
                                "AREA_FILE_RECURSIVE" => "N",
                                "EDIT_MODE" => "html",
                            ), false
                        );
                        ?>
                    </h2>
                    <!-- end .title-->
                </div>
                <div class="section__text">
                    <? $APPLICATION->IncludeComponent("bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH."/include/catalog/products_description.php",
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
                <div class="section__product-grid">
                    <!-- begin .product-grid-->
                    <div class="product-grid product-grid_size_mobile-s">
                        <div class="product-grid__filters">
                            <!-- begin .choice-group-->
                            <?
                            $APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "catalog.page.filter", array(
                                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                "SECTION_ID" => 0,
                                "SHOW_ALL_WO_SECTION" => "Y", // !!!
                                "FILTER_NAME" => $arParams["FILTER_NAME"],
                                "PRICE_CODE" => $arParams["~PRICE_CODE"],
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                "SAVE_IN_SESSION" => "N",
                                "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                                "XML_EXPORT" => "N",
                                "SECTION_TITLE" => "NAME",
                                "SECTION_DESCRIPTION" => "DESCRIPTION",
                                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                                "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                "SEF_MODE" => $arParams["SEF_MODE"],
                                "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
                                "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                                "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                            ),
                                $component,
                                array('HIDE_ICONS' => 'Y')
                            );
                            ?>
                            <!-- end .choice-group-->
                        </div>
                        <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:news.list",
                                "sectionPage.list",
                                array(
                                    "IBLOCK_TYPE" => "-",
                                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                    "NEWS_COUNT" => 20,
                                    "SORT_BY1" => $arParams["SORT_BY1"],
                                    "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                                    "SORT_BY2" => $arParams["SORT_BY2"],
                                    "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                                    "FILTER_NAME" => $arParams["FILTER_NAME"],
                                    "FIELD_CODE" => array(
                                        0 => "ID",
                                        1 => "CODE",
                                        2 => "PREVIEW_PICTURE",
                                        3 => "DETAIL_PICTURE",
                                        4 => "",
                                    ),
                                    "PROPERTY_CODE" => array(
                                        0 => "",
                                        1 => "PRODUCT_FEATURE",
                                        2 => "PRODUCT_PROPS",
                                        3 => "PRODUCT_COMPOSITION",
                                        4 => "PRODUCT_TYPE",
                                        5 => "",
                                    ),
                                    "CHECK_DATES" => "N",
                                    "STRICT_SECTION_CHECK" => "N",
                                    "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                                    "SEARCH_PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"],
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => "N",
                                    "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                                    "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                                    "SET_TITLE" => "Y",
                                    "SET_BROWSER_TITLE" => "Y",
                                    "SET_META_KEYWORDS" => "Y",
                                    "SET_META_DESCRIPTION" => "Y",
                                    "MESSAGE_404" => $arParams["MESSAGE_404"],
                                    "SET_STATUS_404" => "Y",
                                    "SHOW_404" => "Y",
                                    "FILE_404" => $arParams["FILE_404"],
                                    "SET_LAST_MODIFIED" => "N",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                    "PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
                                    "PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                                    "INCLUDE_SUBSECTIONS" => "Y",
                                    "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                                    "DISPLAY_NAME" => "Y",
                                    "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                                    "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                                    "MEDIA_PROPERTY" => $arParams["MEDIA_PROPERTY"],
                                    "SLIDER_PROPERTY" => $arParams["SLIDER_PROPERTY"],
                                    "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "DISPLAY_BOTTOM_PAGER" => "Y",
                                    "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                                    "PAGER_SHOW_ALL" => "N",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                                    "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                                    "USE_RATING" => $arParams["USE_RATING"],
                                    "DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
                                    "MAX_VOTE" => $arParams["MAX_VOTE"],
                                    "VOTE_NAMES" => $arParams["VOTE_NAMES"],
                                    "USE_SHARE" => $arParams["LIST_USE_SHARE"],
                                    "SHARE_HIDE" => $arParams["SHARE_HIDE"],
                                    "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
                                    "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
                                    "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                                    "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                                    "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                                    "COMPONENT_TEMPLATE" => "sectionPage.list",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "Y",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => ""
                                ),
                                false
                            );
                        ?>
                    </div>
                    <!-- end .product-grid-->
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>
<?$ibDescription = CIBlock::GetArrayByID(INFINITY_CATALOG_IB_ID, 'DESCRIPTION');?>
<?if(!empty($ibDescription)):?>
    <div class="page__section">
        <!-- begin .section-->
        <div class="section section_role_banner">
            <div class="section__content">
                <div class="page__container">
                    <?=$ibDescription;?>
                </div>
            </div>
        </div>
        <!-- end .section-->
    </div>
<?endif;?>
<div class="page__section">
    <!-- begin .section-->
    <div class="section section_role_banner">
        <div class="section__content">
            <div class="page__container">
                <div class="section__banner">
                    <!-- begin .banner-->
                    <div class="banner">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH."/include/catalog/bottom_banner.php",
                                "AREA_FILE_RECURSIVE" => "N",
                                "EDIT_MODE" => "html",
                            ), false
                        );
                        ?>
                    </div>
                    <!-- end .banner-->
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>
<div class="page__section">
    <!-- begin .section-->
    <div class="section section_role_attention-panel">
        <div class="section__content">
            <div class="page__container">
                <div class="section__banner">
                    <!-- begin .attention-panel-->
                    <? $APPLICATION->IncludeComponent("bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH."/include/bottom_form.php",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_MODE" => "html",
                        ), false
                    );
                    ?>
                    <!-- end .attention-panel-->
                </div>
            </div>
        </div>
    </div>
    <!-- end .section-->
</div>