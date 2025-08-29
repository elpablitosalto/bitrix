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

<div class="page__catalog">
    <div class="page__container">
        <!-- begin .catalog-->
        <div class="catalog">
            <div class="catalog__header">
                <?/* Убрал по просьбе клиента, возможно придется вернуть.?>
                <div class="catalog__title">
                    <!-- begin .title-->
                    <h1 class="title title_size_h1 title_weight_medium title_case_normal">
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
                <?*/ ?>
                <div class="catalog__control-group">
                    <div class="catalog__tabs">
                        <!-- begin .tabs-->
                        <div class="tabs">
                            <ul class="tabs__nav">
                                <li class="tabs__item">
                                    <button class="tabs__label tabs__label_state_active js-toggle" type="button" data-toggle-scope=".page__catalog, .tabs" data-toggle-target=".catalog, .tabs__label" data-toggle-class="catalog_tab_products, tabs__label_state_active">
                                        Product lines
                                    </button>
                                </li>
                                <li class="tabs__item">
                                    <button class="tabs__label js-toggle" type="button" data-toggle-scope=".page__catalog, .tabs" data-toggle-target=".catalog, .tabs__label" data-toggle-class="catalog_tab_products, tabs__label_state_active">
                                        Products
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <!-- end .tabs-->
                    </div>
                    <a class="catalog__filter-trigger js-modal" href="#catalogFilters"><svg class="catalog__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.39998 5C2.1878 5 1.98432 5.08429 1.83429 5.23431C1.68426 5.38434 1.59998 5.58783 1.59998 5.8C1.59998 6.01217 1.68426 6.21566 1.83429 6.36569C1.98432 6.51571 2.1878 6.6 2.39998 6.6H21.6C21.8121 6.6 22.0156 6.51571 22.1657 6.36569C22.3157 6.21566 22.4 6.01217 22.4 5.8C22.4 5.58783 22.3157 5.38434 22.1657 5.23431C22.0156 5.08429 21.8121 5 21.6 5H2.39998ZM1.59998 12.2C1.59998 11.9878 1.68426 11.7843 1.83429 11.6343C1.98432 11.4843 2.1878 11.4 2.39998 11.4H21.6C21.8121 11.4 22.0156 11.4843 22.1657 11.6343C22.3157 11.7843 22.4 11.9878 22.4 12.2C22.4 12.4122 22.3157 12.6157 22.1657 12.7657C22.0156 12.9157 21.8121 13 21.6 13H2.39998C2.1878 13 1.98432 12.9157 1.83429 12.7657C1.68426 12.6157 1.59998 12.4122 1.59998 12.2ZM1.59998 18.6C1.59998 18.3878 1.68426 18.1843 1.83429 18.0343C1.98432 17.8843 2.1878 17.8 2.39998 17.8H21.6C21.8121 17.8 22.0156 17.8843 22.1657 18.0343C22.3157 18.1843 22.4 18.3878 22.4 18.6C22.4 18.8122 22.3157 19.0157 22.1657 19.1657C22.0156 19.3157 21.8121 19.4 21.6 19.4H2.39998C2.1878 19.4 1.98432 19.3157 1.83429 19.1657C1.68426 19.0157 1.59998 18.8122 1.59998 18.6Z" />
                            <circle cx="6" cy="6" r="2" />
                            <circle cx="17" cy="12" r="2" />
                            <circle cx="11" cy="19" r="2" />
                        </svg>
                    </a>
                </div>
            </div>
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
            <div class="catalog__main">
                <?/* Убрал по просьбе клиента, возможно придется вернуть.?>
                <div class="catalog__text">
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
                <?*/ ?>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.smart.filter",
                    "catalog.page.filter",
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
                global $arrNoveltiesFilter;
                $arrNoveltiesFilter['!PROPERTY_NEW'] = false;

                // Фильтр -->
                $bShowListAfterFilter = true;

                if (isset($_REQUEST['AJAX_CALL']) && $_REQUEST['AJAX_CALL'] == 'Y') {
                    $arFilter['IBLOCK_ID'] = CONCEPT_CATALOG_EN_IB_ID;
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
                        "concept_catalog",
                        array(
                            "IBLOCK_ID" => CONCEPT_CATALOG_EN_IB_ID,
                            "IBLOCK_TYPE" => "catalog_en",
                            "COMPONENT_TEMPLATE" => "concept_catalog",
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
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "FIELD_CODE" => array(
                                0 => "ID",
                                1 => "CODE",
                                2 => "PREVIEW_PICTURE",
                                3 => "DETAIL_PICTURE",
                                4 => "",
                            ),
                            "FILTER_NAME" => $arParams["FILTER_NAME"],
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "MESSAGE_404" => "",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            //"NEWS_COUNT" => "20",
                            //"PAGER_TEMPLATE" => ".default",
                            "NEWS_COUNT" => 8,
                            "PAGER_TEMPLATE" => "auto_load",
                            "PAGER_TITLE" => "Новости",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(
                                0 => "PRODUCT_FEATURE",
                                1 => "PRODUCT_PROPS",
                                2 => "PRODUCT_COMPOSITION",
                                3 => "PRODUCT_TYPE",
                                4 => "",
                            ),
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
                        ),
                        false
                    ); ?>
                <? } ?>
            </div>
        </div>
        <!-- end .catalog-->
    </div>
</div>