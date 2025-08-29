<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

if (!empty($arParams["DEFAULT_SERVICE"])) {

    $arFilter = array(
        "IBLOCK_ID" => Indexis::getIblockId('services', 'services'),
        "ACTIVE" => "Y",
        "GLOBAL_ACTIVE" => "Y",
        "ID" => $arParams["DEFAULT_SERVICE"]
    );

    $obCache = new CPHPCache();
    if ($obCache->InitCache(36000, 'service_id_' . serialize($arFilter), "/iblock/catalog"))
    {
        $arCurSection = $obCache->GetVars();
    }
    elseif ($obCache->StartDataCache())
    {
        $arCurSection = array();
        if (Loader::includeModule("iblock"))
        {
            $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID", "XML_ID"));

            if(defined("BX_COMP_MANAGED_CACHE"))
            {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->StartTagCache("/iblock/catalog");

                if ($arCurSection = $dbRes->Fetch())
                    $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

                $CACHE_MANAGER->EndTagCache();
            }
            else
            {
                if(!$arCurSection = $dbRes->Fetch())
                    $arCurSection = array();
            }

            $arCurSection['SUB_ID'] = [];

            if (isset($arCurSection['ID'])) {
                $rsSect = CIBlockSection::GetList(array('ID' => 'asc'), array('IBLOCK_ID' => Indexis::getIblockId('services', 'services'), 'GLOBAL_ACTIVE'=>'Y', 'SECTION_ID' => $arCurSection['ID']), false, array('ID'));
                while ($arSect = $rsSect->GetNext()) {
                    $arCurSection['SUB_ID'][] = $arSect['ID'];
                }
            }
        }
        $obCache->EndDataCache($arCurSection);
    }
    if (!isset($arCurSection))
        $arCurSection = array();

    $arParams["DEFAULT_SERVICE"] = array_merge([$arCurSection['ID']], $arCurSection['SUB_ID']);
}

if (!empty($arParams['SERVICE_ID'])) {
    $GLOBALS[$arParams['PREFILTER_NAME']]['PROPERTY_SHOW_SERVICES'] = $arParams['SERVICE_ID'];
    $GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_SHOW_SERVICES'] = $arParams['SERVICE_ID'];
}
?>

<? if ($arParams['SHOW_FILTER'] == 'Y') : ?>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.smart.filter",
        "doctor_filter",
        array(
            "AJAX_MODE" => $arParams['AJAX_MODE'],
            "AJAX_OPTION_ADDITIONAL" => $arParams['AJAX_OPTION_ADDITIONAL'],
            "AJAX_OPTION_HISTORY" => $arParams['AJAX_OPTION_HISTORY'],
            "AJAX_OPTION_JUMP" => $arParams['AJAX_OPTION_JUMP'],
            "AJAX_OPTION_STYLE" => $arParams['AJAX_OPTION_STYLE'],
            "COMPONENT_TEMPLATE" => ".default",
            "IBLOCK_ID" => $arParams['IBLOCK_ID'],
            "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
            "SECTION_ID" => "",
            "SECTION_CODE" => "",
            "PREFILTER_NAME" => $arParams['PREFILTER_NAME'],
            "FILTER_NAME" => $arParams['FILTER_NAME'],
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
            "PRICE_CODE" => array(
                0 => "BASE",
            ),
            "CONVERT_CURRENCY" => "Y",
            "XML_EXPORT" => "N",
            "SECTION_TITLE" => "-",
            "SECTION_DESCRIPTION" => "-",
            "POPUP_POSITION" => "left",
            "SEF_RULE" => "",
            "SECTION_CODE_PATH" => "",
            "SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
            "CURRENCY_ID" => "RUB",
            "DEFAULT_SERVICE" => $arParams["DEFAULT_SERVICE"],
            "SYNC_CONTENT_CLINIC" => $arParams['SYNC_CONTENT_CLINIC']
        ),
        $component
    );

    if (empty($GLOBALS[$arParams['FILTER_NAME']]) && !empty($arParams["DEFAULT_SERVICE"])) {
        $GLOBALS[$arParams['FILTER_NAME']] = [
            'PROPERTY_SHOW_SERVICES' => $arParams["DEFAULT_SERVICE"]
        ];
    }
    ?>
<? else : ?>
    <?
    if (!empty($arParams["DEFAULT_SERVICE"])) {
        $GLOBALS[$arParams['FILTER_NAME']] = [
            'PROPERTY_SHOW_SERVICES' => $arParams["DEFAULT_SERVICE"]
        ];
    }
    ?>
<? endif; ?>

<?
// Фильтр по выбранной клинике в Контактах -->
if ($_REQUEST['set_filter'] != 'y' && $arParams['SYNC_CONTENT_CLINIC'] == 'Y') {
    if (intval($_COOKIE['chosenAddressId']) > 0) {
        $bSetChosenAddress = true;

        foreach ($GLOBALS["arSiteConfig"]['PROPERTY_IDS']['CLINICS'] as $key => $val) {
            foreach ($GLOBALS[$arParams['FILTER_NAME']] as $key_2 => $val_2) {
                if (intval($key_2 == '=PROPERTY_' . $val)) {
                    $bSetChosenAddress = false;
                }
            }
        }
        if ($bSetChosenAddress) {
            $GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_CLINICS'] = $_COOKIE['chosenAddressId'];
            if (isset($GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_SHOW_SERVICES'])) {
                unset($GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_SHOW_SERVICES']);
            }
        }
    }
}
// <-- Фильтр по выбранной клинике в Контактах
?>
<?
$pageElementCount = $arParams['PAGE_ELEMENT_COUNT'];
if (intval($pageElementCount) <= 0) {
    $pageElementCount = '1000';
}
?>
<? $APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "review_list",
    array(
        "ACTION_VARIABLE" => "action",
        "ADD_PICT_PROP" => "MORE_PHOTO",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "ADD_TO_BASKET_ACTION" => "ADD",
        "AJAX_MODE" => $arParams['AJAX_MODE'],
        "AJAX_OPTION_ADDITIONAL" => $arParams['AJAX_OPTION_ADDITIONAL'],
        "AJAX_OPTION_HISTORY" => $arParams['AJAX_OPTION_HISTORY'],
        "AJAX_OPTION_JUMP" => $arParams['AJAX_OPTION_JUMP'],
        "AJAX_OPTION_STYLE" => $arParams['AJAX_OPTION_STYLE'],
        "BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",
        "BASKET_URL" => "",
        "BRAND_PROPERTY" => "-",
        "BROWSER_TITLE" => "-",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPATIBLE_MODE" => "Y",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "CUSTOM_FILTER" => "",
        "DATA_LAYER_NAME" => "dataLayer",
        "DETAIL_URL" => "",
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_SORT_FIELD" => "RAND",
        "ELEMENT_SORT_FIELD2" => "RAND",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "ENLARGE_PRODUCT" => "PROP",
        "ENLARGE_PROP" => "NEWPRODUCT",
        "FILTER_NAME" => $arParams['FILTER_NAME'],
        "HIDE_NOT_AVAILABLE" => "N",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
        "INCLUDE_SUBSECTIONS" => "Y",
        "LABEL_PROP" => array(
            0 => "NEWPRODUCT",
        ),
        "LABEL_PROP_MOBILE" => "",
        "LABEL_PROP_POSITION" => "top-left",
        "LAZY_LOAD" => "N",
        "LINE_ELEMENT_COUNT" => "6",
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
            0 => "",
            1 => "",
        ),
        "OFFERS_LIMIT" => "5",
        "OFFERS_PROPERTY_CODE" => array(),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_ORDER2" => "desc",
        "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
        "OFFER_TREE_PROPS" => array(),
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "counter",
        "PAGER_TITLE" => "",
        "PAGE_ELEMENT_COUNT" => $pageElementCount,
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array(),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
        "PRODUCT_DISPLAY_MODE" => "Y",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array(),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "",
        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'6','BIG_DATA':false}]",
        "PRODUCT_SUBSCRIPTION" => "Y",
        "PROPERTY_CODE" => array(),
        "PROPERTY_CODE_MOBILE" => "",
        "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
        "RCM_TYPE" => "personal",
        "SECTION_CODE" => "",
        "SECTION_ID" => "",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "SECTION_URL" => "",
        "SECTION_USER_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "SEF_MODE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
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
        "SHOW_SLIDER" => "N",
        "SLIDER_INTERVAL" => "3000",
        "SLIDER_PROGRESS" => "N",
        "TEMPLATE_THEME" => "blue",
        "USE_ENHANCED_ECOMMERCE" => "Y",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "COMPONENT_TEMPLATE" => "doctor_list",
        "MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
        "DISPLAY_COMPARE" => "N"
    ),
    $component
);
?>
