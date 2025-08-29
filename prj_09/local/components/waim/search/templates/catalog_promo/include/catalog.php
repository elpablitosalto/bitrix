<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="search__catalog">
    <div class="catalog">
        <div class="catalog__content">
            <div class="catalog__aside">
                <?
                // 41868
                $arRegionPrice = [];
                if (!empty($GLOBALS["arRegion"])) {
                    $arRegion = $GLOBALS["arRegion"];
                } else {
                    $arRegion = \Mirvendinga\Geo::getCurrentRegion();
                }
                if (!empty($arRegion["PRICE_ID"]) && \Bitrix\Main\Loader::includeModule("catalog")) {
                    $rsPrice = \Bitrix\Catalog\GroupTable::getById($arRegion["PRICE_ID"]);
                    if ($arPrice = $rsPrice->fetch()) {
                        $arRegionPrice = [
                            $arPrice["NAME"]
                        ];
                    }
                }
                //
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.smart.filter",
                    "",
                    array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "IBLOCK_TYPE" => "1c_goods",
                        "IBLOCK_ID" => CATALOG_IB_ID,
                        "SECTION_ID" => "",
                        "SECTION_CODE" => "",
                        "FILTER_NAME" => "searchFilter",
                        "HIDE_NOT_AVAILABLE" => "N",
                        "TEMPLATE_THEME" => "blue",
                        "FILTER_VIEW_MODE" => "horizontal",
                        "DISPLAY_ELEMENT_COUNT" => "Y",
                        "SEF_MODE" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_GROUPS" => "Y",
                        "SAVE_IN_SESSION" => "N",
                        "INSTANT_RELOAD" => "Y",
                        "PAGER_PARAMS_NAME" => "arrPager",
                        "PRICE_CODE" => $arRegionPrice,
                        "CONVERT_CURRENCY" => "Y",
                        "XML_EXPORT" => "N",
                        "SECTION_TITLE" => "-",
                        "SECTION_DESCRIPTION" => "-",
                        "POPUP_POSITION" => "left",
                        "SEF_RULE" => "/examples/books/#SECTION_ID#/filter/#SMART_FILTER_PATH#/apply/",
                        "SECTION_CODE_PATH" => "",
                        "SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
                        "CURRENCY_ID" => "RUB"
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );
                ?>
            </div>

            <div class="catalog__main">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/catalog/catalog_sort.php",
                        "AREA_FILE_RECURSIVE" => "N",
                        "EDIT_MODE" => "html",
                    ),
                    false
                );
                ?>
                <div class="catalog__products">
                    <?
                    $arSmartFilter = (array)$GLOBALS["searchFilter"];
                    unset($arSmartFilter["FACET_OPTIONS"]);
                    $GLOBALS['searchFilter'] = array_merge(['ID' => $arResult['CATALOG']['ITEMS']], $arSmartFilter);
                    //$GLOBALS['searchFilter']['!IBLOCK_SECTION_ID'] = false;
                    //vardump($GLOBALS['searchFilter']);
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "product-group",
                        array(
                            "ACTION_VARIABLE" => "action",
                            "ADD_PICT_PROP" => "MORE_PHOTO",
                            "ADD_PROPERTIES_TO_BASKET" => "Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "ADD_TO_BASKET_ACTION" => "ADD",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",
                            "BASKET_URL" => "/personal/basket.php",
                            "BRAND_PROPERTY" => "-",
                            "BROWSER_TITLE" => "-",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "COMPATIBLE_MODE" => "Y",
                            "CONVERT_CURRENCY" => "Y",
                            "CURRENCY_ID" => "RUB",
                            "DATA_LAYER_NAME" => "dataLayer",
                            "DETAIL_URL" => "",
                            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                            "DISCOUNT_PERCENT_POSITION" => "bottom-right",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_TOP_PAGER" => "N",
                            "ELEMENT_SORT_FIELD" => $GLOBALS["SORT_FIELD"],
                            "ELEMENT_SORT_ORDER" => $GLOBALS["SORT_ORDER"],
                            "ELEMENT_SORT_FIELD2" => "ID",
                            "ELEMENT_SORT_ORDER2" => "ASC",
                            "ENLARGE_PRODUCT" => "PROP",
                            "ENLARGE_PROP" => "-",
                            "FILTER_NAME" => "searchFilter",
                            "HIDE_NOT_AVAILABLE" => "N",
                            "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                            "IBLOCK_TYPE" => "1c_goods",
                            "IBLOCK_ID" => "36",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "LABEL_PROP" => array(),
                            "LABEL_PROP_MOBILE" => array(),
                            "LABEL_PROP_POSITION" => "top-left",
                            "LAZY_LOAD" => "Y",
                            "LINE_ELEMENT_COUNT" => "3",
                            "LOAD_ON_SCROLL" => "N",
                            "MESSAGE_404" => "",
                            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                            "MESS_BTN_BUY" => "Купить",
                            "MESS_BTN_DETAIL" => "Подробнее",
                            "MESS_BTN_LAZY_LOAD" => "Показать ещё",
                            "MESS_BTN_SUBSCRIBE" => "Подписаться",
                            "MESS_NOT_AVAILABLE" => "Нет в наличии",
                            "META_DESCRIPTION" => "-",
                            "META_KEYWORDS" => "-",
                            "OFFERS_CART_PROPERTIES" => array(),
                            "OFFERS_FIELD_CODE" => array(
                                0 => "ID",
                                1 => "CODE",
                                2 => "XML_ID",
                                3 => "NAME",
                                4 => "PREVIEW_TEXT",
                                5 => "PREVIEW_PICTURE",
                                6 => "DETAIL_PICTURE",
                                7 => "",
                            ),
                            "OFFERS_LIMIT" => "5",
                            "OFFERS_PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                                2 => "",
                                3 => "",
                                4 => "",
                            ),
                            "OFFERS_SORT_FIELD" => "sort",
                            "OFFERS_SORT_FIELD2" => "id",
                            "OFFERS_SORT_ORDER" => "asc",
                            "OFFERS_SORT_ORDER2" => "desc",
                            "OFFER_ADD_PICT_PROP" => "-",
                            "OFFER_TREE_PROPS" => array(),
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Товары",
                            "PAGE_ELEMENT_COUNT" => "9",
                            "PARTIAL_PRODUCT_PROPERTIES" => "N",
                            "PRICE_CODE" => array(
                                0 => "STANDARTPRICE",
                            ),
                            "PRICE_VAT_INCLUDE" => "Y",
                            "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                            "PRODUCT_DISPLAY_MODE" => "Y",
                            "PRODUCT_ID_VARIABLE" => "id",
                            "PRODUCT_PROPERTIES" => array(),
                            "PRODUCT_PROPS_VARIABLE" => "prop",
                            "PRODUCT_QUANTITY_VARIABLE" => "",
                            "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                            "PRODUCT_SUBSCRIPTION" => "Y",
                            "PROPERTY_CODE" => array(
                                0 => "",
                                1 => "CML2_ARTICLE",
                                2 => "CML2_BASE_UNIT",
                                3 => "NOVELTY",
                                4 => "CML2_MANUFACTURER",
                                5 => "CML2_TRAITS",
                                6 => "CML2_TAXES",
                                7 => "CML2_ATTRIBUTES",
                                8 => "CML2_BAR_CODE",
                                9 => "",
                            ),
                            "PROPERTY_CODE_MOBILE" => array(),
                            "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                            "RCM_TYPE" => "personal",
                            "SECTION_CODE" => "",
                            "SECTION_ID" => "",
                            "SECTION_ID_VARIABLE" => "",
                            "SECTION_URL" => "",
                            "SECTION_USER_FIELDS" => array(
                                0 => "",
                                1 => "",
                            ),
                            "SEF_MODE" => "N",
                            "SET_BROWSER_TITLE" => "Y",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "Y",
                            "SET_META_KEYWORDS" => "Y",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "Y",
                            "SHOW_404" => "N",
                            "SHOW_ALL_WO_SECTION" => "Y",
                            "SHOW_CLOSE_POPUP" => "N",
                            "SHOW_DISCOUNT_PERCENT" => "Y",
                            "SHOW_FROM_SECTION" => "N",
                            "SHOW_MAX_QUANTITY" => "N",
                            "SHOW_OLD_PRICE" => "N",
                            "SHOW_PRICE_COUNT" => "1",
                            "SHOW_SLIDER" => "Y",
                            "SLIDER_INTERVAL" => "3000",
                            "SLIDER_PROGRESS" => "N",
                            "TEMPLATE_THEME" => "blue",
                            "USE_ENHANCED_ECOMMERCE" => "Y",
                            "USE_MAIN_ELEMENT_SECTION" => "N",
                            "USE_PRICE_COUNT" => "N",
                            "USE_PRODUCT_QUANTITY" => "N",
                            "COMPONENT_TEMPLATE" => ".default",
                            "MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
                            "DISPLAY_COMPARE" => "N",
                            "LIST_SHORT_PROPERTIES" => \Mirvendinga\Catalog::getCatalogShortProperties(),

                            // Мои параметры -->
                            //"SHOW_MESS_NO_PRODUCTS" => "N",
                            // <-- Мои параметры
                        ),
                        false
                    ); ?>


                </div>

                <?
                $sectionResult = CIBlockSection::GetList(
                    false,
                    array(
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ID" => $arCurSection['ID']
                    ),
                    false,
                    array(
                        'NAME',
                        'DESCRIPTION',
                        'PICTURE',
                    )
                );
                while ($sectionProp = $sectionResult->GetNext()) {
                    $sectionDescription = $sectionProp['DESCRIPTION'];  // Описание раздела
                }
                ?>

                <? if (!empty($sectionDescription)) : ?>
                    <div class="catalog__text"><?= $sectionDescription ?></div>
                <? endif ?>
            </div>
        </div>
    </div>
</div>