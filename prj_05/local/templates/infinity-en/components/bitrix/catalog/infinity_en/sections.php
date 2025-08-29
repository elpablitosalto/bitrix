<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

define('SHOW_TEMPLATE_BOTTOM_BANNER', 'N');

use Bitrix\Main\Loader;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

?>


<div class="page__section">
    <!-- begin .section-->
    <div class="section section_role_info-panels section_spacing_top-none">
        <div class="section__main">
            <?/* Убрал по просьбе клиента, возможно придется вернуть.?>
            <div class="section__header">
                <div class="section__header-container page__container">
                    <div class="section__title">
                        <!-- begin .title-->
                        <h1 class="title title_size_h3-s title_style_primary title_case_normal">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "/include/catalog/sections_text_1.php",
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
                    <div class="section__text">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "/include/catalog/sections_text_2.php",
                                "AREA_FILE_RECURSIVE" => "N",
                                "EDIT_MODE" => "html",
                            ),
                            false,
                            array('HIDE_ICONS' => 'N')
                        );
                        ?>
                    </div>
                </div>
            </div>
            <?*/ ?>
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
                "FILTER_NAME" => 'arCatalogSectionsFilter',
                "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
                "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
            );
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "sections_page",
                $sectionListParams,
                $component,
                array("HIDE_ICONS" => "Y")
            );
            unset($sectionListParams);
            ?>
        </div>
    </div>
    <!-- end .section-->
</div>

<div class="page__section">
    <!-- begin .section-->
    <div class="section section_role_products section_style_full-gradient">
        <div class="section__main">
            <div class="section__header">
                <div class="section__header-container page__container">
                    <div class="section__title">
                        <!-- begin .title-->
                        <h2 class="title title_size_h3-s title_case_normal">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "/include/catalog/sections_text_3.php",
                                    "AREA_FILE_RECURSIVE" => "N",
                                    "EDIT_MODE" => "html",
                                ),
                                false,
                                array('HIDE_ICONS' => 'N')
                            );
                            ?>
                        </h2>
                        <!-- end .title-->
                    </div>
                </div>
            </div>
            <div class="section__content">
                <div class="page__container">
                    <div class="section__entry-grid">
                        <!-- begin .entry-grid-->
                        <div class="entry-grid js-entry-grid entry-grid_size_mobile-s">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:catalog.smart.filter",
                                "catalog_page_filter",
                                array(
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
                                    "SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
                                    "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                                    "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                                    "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                                ),
                                $component,
                                array('HIDE_ICONS' => 'Y')
                            );
                            ?>
                            <?
                            // Фильтр -->
                            $bShowListAfterFilter = true;
                            if (isset($_REQUEST['AJAX_CALL']) && $_REQUEST['AJAX_CALL'] == 'Y') {
                                $arFilter['IBLOCK_ID'] = INFINITY_CATALOG_EN_IB_ID;
                                foreach ($_REQUEST as $code => $value):
                                    if (strpos($code, 'arrFilter') !== false) {
                                        $fitlerExpl = explode('_', $code);
                                        $GLOBALS[$arParams["FILTER_NAME"]]['PROPERTY_' . $fitlerExpl[1]][] = $value;
                                    }
                                endforeach;

                                $ids = [];
                                $ob = CIBlockElement::GetList(false, $arFilter, false, false, ['ID']);
                                while ($res = $ob->GetNExt()) {
                                    $ids[] = $res['ID'];
                                }

                                $errors = [];
                                if (!empty($ids)) {
                                    $GLOBALS[$arParams["FILTER_NAME"]]['ID'] = $ids;
                                } else {
                                    $bShowListAfterFilter = false;
                                    $errors[] = '<h3 class="error">No elements were found for the specified filter</h3>';
                                }
                            }
                            // <-- Фильтр
                            if ($bShowListAfterFilter == false) {
                                if (!empty($errors)) {
                                    foreach ($errors as $error):
                                        echo $error;
                                    endforeach;
                                } else {
                                }
                            } else {
                            ?>
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:news.list",
                                    "sections_page_list",
                                    array(
                                        "IBLOCK_TYPE" => "-",
                                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
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
                                            4 => "DETAIL_PAGE_URL",
                                        ),
                                        "PROPERTY_CODE" => array(
                                            0 => "SECONDARY_IMAGE",
                                            1 => "PRODUCT_FEATURE",
                                            2 => "PRODUCT_PROPS",
                                            3 => "PRODUCT_COMPOSITION",
                                            4 => "PRODUCT_TYPE",
                                            5 => "ACTIVE_SUBSTANCE",
                                            6 => "PACK_VOLUME",
                                            7 => "FIXATION_STRENGTH",
                                        ),
                                        "CHECK_DATES" => "N",
                                        "STRICT_SECTION_CHECK" => "N",
                                        "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
                                        "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                                        "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
                                        "SEARCH_PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],
                                        "CACHE_TYPE" => "A",
                                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                                        "CACHE_FILTER" => "N",
                                        "CACHE_GROUPS" => "N",
                                        "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                                        "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                                        "SET_TITLE" => "N",
                                        "SET_BROWSER_TITLE" => "N",
                                        "SET_META_KEYWORDS" => "N",
                                        "SET_META_DESCRIPTION" => "N",
                                        "MESSAGE_404" => $arParams["MESSAGE_404"],
                                        "SET_STATUS_404" => "N",
                                        "SHOW_404" => "N",
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
                                        //"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                                        "NEWS_COUNT" => 3,
                                        "PAGER_TEMPLATE" => "auto_load",
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
                            <? } ?>
                        </div>
                        <!-- end .entry-grid-->
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    "PATH" => SITE_DIR . "/include/catalog/bottom_banner.php",
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