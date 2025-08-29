<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */

/** @var CBitrixComponent $component */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->addExternalCss("/bitrix/css/main/bootstrap.css");

if (!isset($arParams['FILTER_VIEW_MODE']) || (string)$arParams['FILTER_VIEW_MODE'] == '')
    $arParams['FILTER_VIEW_MODE'] = 'VERTICAL';

$this->setFrameMode(true);
$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

$isVerticalFilter = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");
$isSidebar = ($arParams["SIDEBAR_SECTION_SHOW"] == "Y" && isset($arParams["SIDEBAR_PATH"]) && !empty($arParams["SIDEBAR_PATH"]));

$arFilter = array(
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "ACTIVE" => "Y",
    "GLOBAL_ACTIVE" => "Y",
);
if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
    $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
    $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

$obCache = new CPHPCache();
if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog")) {
    $arCurSection = $obCache->GetVars();
} elseif ($obCache->StartDataCache()) {
    $arCurSection = array();
    if (Loader::includeModule("iblock")) {
        $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID", "CODE", "DEPTH_LEVEL", "NAME", "IBLOCK_SECTION_ID"));

        if (defined("BX_COMP_MANAGED_CACHE")) {
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache("/iblock/catalog");

            if ($arCurSection = $dbRes->Fetch())
                $CACHE_MANAGER->RegisterTag("iblock_id_" . $arParams["IBLOCK_ID"]);

            $CACHE_MANAGER->EndTagCache();
        } else {
            if (!$arCurSection = $dbRes->Fetch())
                $arCurSection = array();
        }
    }
    $obCache->EndDataCache($arCurSection);
}
if (!isset($arCurSection))
    LocalRedirect("/catalog/");

if ($arCurSection["DEPTH_LEVEL"] > 1) {

    $APPLICATION->IncludeComponent(
        "bitrix:catalog.smart.filter",
        "catalog_detail",
        array(
            "HIDDEN_FILTERS" => [
                "DLINA",
                "SHIRINA",
                "VES",
                "RADIUS_VNESHNIY"
            ],
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "SECTION_ID" => $arCurSection['ID'],
            "FILTER_NAME" => $arParams["~FILTER_NAME"],
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
            "SEF_MODE" => "N",
            "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
            "SET_FILTER" => $arParams["SET_FILTER"]
        ),
        $component,
        array('HIDE_ICONS' => 'Y')
    );

    $intSectionID = $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "catalog",
        array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "COLLECTION" => $arCurSection["NAME"],
            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
            "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
            "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
            "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
            "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
            "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
            "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
            "BASKET_URL" => $arParams["BASKET_URL"],
            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
            "FILTER_NAME" => $arParams["~FILTER_NAME"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "SET_TITLE" => $arParams["SET_TITLE"],
            "MESSAGE_404" => $arParams["~MESSAGE_404"],
            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
            "SHOW_404" => $arParams["SHOW_404"],
            "FILE_404" => $arParams["FILE_404"],
            "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
            "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
            "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
            "PRICE_CODE" => $arParams["~PRICE_CODE"],
            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
            "PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

            "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
            "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
            "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
            "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
            "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
            "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
            "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
            "LAZY_LOAD" => $arParams["LAZY_LOAD"],
            "MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
            "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

            "OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
            "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
            "OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
            "OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
            "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
            "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
            'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
            'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

            'LABEL_PROP' => $arParams['LABEL_PROP'],
            'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
            'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
            'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
            'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
            'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
            'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
            'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
            'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
            'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
            'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
            'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
            'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
            'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
            'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
            'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
            'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
            'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
            'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
            'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
            'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
            'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
            'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'] ?? '',
            'MESS_NOT_AVAILABLE_SERVICE' => $arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '',
            'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

            'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
            'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
            'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

            'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
            "ADD_SECTIONS_CHAIN" => "N",
            'ADD_TO_BASKET_ACTION' => $basketAction,
            'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
            'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
            'COMPARE_NAME' => $arParams['COMPARE_NAME'],
            'USE_COMPARE_LIST' => 'Y',
            'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
            'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
            'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
        ),
        $component
    );

    ?>


    <?php
    global $sectionFilter;
    $sectionFilter = ["!ID" => $arCurSection["ID"], "NAME" => $arCurSection["NAME"]];
    $sectionListParams = array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
        "FILTER_NAME" => "sectionFilter",
        "TOP_DEPTH" => 3,
        "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
        "SEF_FOLDER" => $arParams["SEF_FOLDER"],
        "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
        "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
        "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
        "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
        "COLLECTION" => $arCurSection["NAME"]
        //"SECTION_ID" => $arCurSection["IBLOCK_SECTION_ID"],
    );
    if ($sectionListParams["COUNT_ELEMENTS"] === "Y") {
        $sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
        if ($arParams["HIDE_NOT_AVAILABLE"] == "Y") {
            $sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
        }
    }
    ?>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "catalog_other",
        $sectionListParams,
        $component,
        ($arParams["SHOW_TOP_ELEMENTS"] !== "N" ? array("HIDE_ICONS" => "Y") : array())
    );
    ?>

    <!--
    <section class="dp-section dp-series-recommended">
        <div class="container">
            <div class="dp-section__header">
                <h3 class="dp-section__title">Дизайн-сет</h3><a class="dp-btn dp-btn_sm dp-btn_white dp-section__link"
                                                                href=""><span>Смотреть всю коллекцию BankLine</span>
                    <svg class="icon icon-drop-right ">
                        <use xlink:href="#drop-right"></use>
                    </svg>
                </a>
            </div>
            <div class="dp-section__body">
                <div class="dp-catalog-slider"><a class="dp-catalog-item" href="catalog-detail.html" id="">
                        <div class="dp-catalog-item__image">
                            <picture><img src="img/content/series/30.jpg" alt="Столы Bank Line"></picture>
                        </div>
                        <h4 class="dp-catalog-item__title">Столы Bank Line</h4>
                        <div class="dp-catalog-item__subtitle">6 моделей</div>
                    </a><a class="dp-catalog-item" href="catalog-detail.html" id="">
                        <div class="dp-catalog-item__image">
                            <picture><img src="img/content/series/31.jpg" alt="Пепельницы и урны Bank Line"></picture>
                        </div>
                        <h4 class="dp-catalog-item__title">Пепельницы и урны Bank Line</h4>
                        <div class="dp-catalog-item__subtitle">6 моделей</div>
                    </a>
                </div>
            </div>
            <a class="dp-btn dp-btn_sm dp-btn_white dp-section__link"
               href=""><span>Смотреть всю коллекцию BankLine</span>
                <svg class="icon icon-drop-right ">
                    <use xlink:href="#drop-right"></use>
                </svg>
            </a>
        </div>
    </section>
    -->
    <!--
    <section class="dp-section dp-series-materials" id="series-materials">
        <div class="container">
            <div class="dp-section__body">
                <div class="dp-section">
                    <div class="h5 dp-section__title">Дерево:</div>
                    <div class="dp-item-list">
                        <div class="row">
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/11.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/12.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/13.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/14.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/15.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/16.png"></div>
                            </div>
                        </div>
                    </div>
                    <a class="dp-btn dp-btn_xs dp-section__link" href="#" data-modal="#modal-series-wood-paint"><span>Варианты покрытия краской</span></a>
                </div>
                <div class="dp-section">
                    <div class="h5 dp-section__title">Металл:</div>
                    <div class="dp-item-list">
                        <div class="row">
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/17.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/18.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/19.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/20.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/21.png"></div>
                            </div>
                        </div>
                    </div>
                    <a class="dp-btn dp-btn_xs dp-section__link" href="#" data-modal="#modal-series-ral"><span>Доступные цвета RAL</span></a>
                </div>
                <div class="dp-section">
                    <div class="h5 dp-section__title">Бетон:</div>
                    <div class="dp-item-list">
                        <div class="row">
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/22.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/23.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/24.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/25.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/26.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/27.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/28.png"></div>
                            </div>
                            <div class="col-auto">
                                <div class="dp-series-materials__item"><img src="img/content/series/29.png"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    -->
    <?php
} else {

    $APPLICATION->IncludeComponent(
        "bitrix:catalog.smart.filter",
        "catalog_section",
        array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "SECTION_ID" => $arCurSection['ID'],
            "FILTER_NAME" => $arParams["~FILTER_NAME"],
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
            "SEF_MODE" => "N",
            "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
            "SET_FILTER" => $arParams["SET_FILTER"]
        ),
        $component,
        array('HIDE_ICONS' => 'Y')
    );

    global $arSectionsFilter;
    $arSectionsFilter = [];
    if (isset($GLOBALS[$arParams["~FILTER_NAME"]]) && !empty($GLOBALS[$arParams["~FILTER_NAME"]])) {
        $arSelect = array("IBLOCK_SECTION_ID");
        $arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(array(), array_merge($arFilter, $GLOBALS[$arParams["~FILTER_NAME"]]), ["IBLOCK_SECTION_ID"], false, $arSelect);
        while ($arElement = $res->GetNext()) {
            $arSectionsFilter["ID"] = $arElement["IBLOCK_SECTION_ID"];
        }
    }

	//if (!isset($arSectionsFilter["ID"]))
	//$arSectionsFilter["ID"] = 0;

    ?>

    <?php
    $sectionListParams = array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "FILTER_NAME" => "arSectionsFilter",
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
        "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
        "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
        "SEF_FOLDER" => $arParams["SEF_FOLDER"],
        "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
        "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
        "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
        "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
    );
    if ($sectionListParams["COUNT_ELEMENTS"] === "Y") {
        $sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
        if ($arParams["HIDE_NOT_AVAILABLE"] == "Y") {
            $sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
        }
    }
    ?>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "section_catalog",
        $sectionListParams,
        $component,
        ($arParams["SHOW_TOP_ELEMENTS"] !== "N" ? array("HIDE_ICONS" => "Y") : array())
    );
    ?>
    <?
    unset($sectionListParams);
}
?>

