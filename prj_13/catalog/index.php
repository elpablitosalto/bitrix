<?
define('CUSTOM_LAYOUT_PAGE', true);
define('PAGE_TYPE', 4);
/*
// Если карточка товара -->
$bCatalogDetail = false;
preg_match('/catalog\/([0-9a-zA-Z-]+)\/([0-9a-zA-Z-]+)\//', $_SERVER['REQUEST_URI'], $matches);
if 
(
    strlen($matches[0]) > 0 
    && strlen($matches[1]) > 0 
    && strlen($matches[2]) > 0
    && $matches[2] != 'filter'
) {
    //print_r($matches);
    $bCatalogDetail = true;
}
// <-- Если карточка товара

// Тип страницы -->
if ($bCatalogDetail) {
    //define('PAGE_TYPE', 4);
} else {
    //define('PAGE_TYPE', 1);
}
//echo 'PAGE_TYPE = ' . PAGE_TYPE . '<br />';
// <-- Тип страницы

/* 
// AJAX_MODE -->
$ajaxMode = 'Y';
if ($bCatalogDetail) {
    $ajaxMode = 'N';
}
// <-- AJAX_MODE
/**/
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Каталог строительных материалов в компании Стройсервис. Доставка по Москве и Московской области. Широкий ассортимент, выгодные цены. ☎ +7 (495) 229-30-20");
$APPLICATION->SetTitle("Каталог");
?><? $APPLICATION->IncludeComponent(
        "indexis:catalog",
        "",
        array(
            "TEMPLATE_THEME" => "blue",
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => Indexis::getIblockId('catalog', 'catalog'),
            "HIDE_NOT_AVAILABLE" => "L",
            "BASKET_URL" => "/personal/cart/",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "id",
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PARTIAL_PRODUCT_PROPERTIES" => "Y",
            "COMMON_SHOW_CLOSE_POPUP" => "N",
            "SEF_MODE" => "Y",
            "SEF_FOLDER" => "/catalog/",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "USE_MAIN_ELEMENT_SECTION" => "Y",
            "SET_LAST_MODIFIED" => "N",
            "SET_TITLE" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "ADD_ELEMENT_CHAIN" => "Y",
            "USE_ELEMENT_COUNTER" => "Y",
            "USE_SALE_BESTSELLERS" => "Y",
            "COMPARE_POSITION_FIXED" => "Y",
            "COMPARE_POSITION" => "top left",
            "USE_FILTER" => "Y",
            "FILTER_NAME" => "arrFilterCatalog",
            "FILTER_FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "FILTER_HIDE_ON_MOBILE" => "Y",
            "FILTER_PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "FILTER_PRICE_CODE" => array(
                0 => "BASE",
            ),
            "FILTER_OFFERS_FIELD_CODE" => array(
                0 => "PREVIEW_PICTURE",
                1 => "DETAIL_PICTURE",
                2 => "",
            ),
            "FILTER_OFFERS_PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
            "TOP_ADD_TO_BASKET_ACTION" => "ADD",
            "SECTION_ADD_TO_BASKET_ACTION" => "ADD",
            "DETAIL_ADD_TO_BASKET_ACTION" => array("ADD", "BUY"),
            "DETAIL_SHOW_BASIS_PRICE" => "Y",
            "FILTER_VIEW_MODE" => "VERTICAL",
            "USE_REVIEW" => "Y",
            "MESSAGES_PER_PAGE" => "10",
            "USE_CAPTCHA" => "Y",
            "REVIEW_AJAX_POST" => "Y",
            "PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
            "FORUM_ID" => "1",
            "URL_TEMPLATES_READ" => "",
            "SHOW_LINK_TO_FORUM" => "Y",
            "POST_FIRST_MESSAGE" => "N",
            "USE_COMPARE" => "N",
            "PRICE_CODE" => array(
                0 => "BASE",
            ),
            "USE_PRICE_COUNT" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "PRICE_VAT_INCLUDE" => "Y",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "PRODUCT_PROPERTIES" => array(
                "CML2_ARTICLE",
                "VES_ATTR_S",
                "MORE_PHOTO",
            ),
            "USE_PRODUCT_QUANTITY" => "N",
            "CONVERT_CURRENCY" => "Y",
            "CURRENCY_ID" => "RUB",
            "OFFERS_CART_PROPERTIES" => array(
                0 => "COLOR_REF",
                1 => "SIZES_SHOES",
                2 => "SIZES_CLOTHES",
            ),
            "SHOW_TOP_ELEMENTS" => "N",
            "SECTION_COUNT_ELEMENTS" => "Y",
            "SECTION_TOP_DEPTH" => "1",
            "SECTIONS_VIEW_MODE" => "TEXT",
            "SECTIONS_SHOW_PARENT_NAME" => "Y",
            "PAGE_ELEMENT_COUNT" => "30",
            "LINE_ELEMENT_COUNT" => "3",
            "ELEMENT_SORT_FIELD" => "SORT",
            "ELEMENT_SORT_ORDER" => "ASC",
            "ELEMENT_SORT_FIELD2" => "catalog_QUANTITY",
            "ELEMENT_SORT_ORDER2" => "desc",
            "LIST_PROPERTY_CODE" => array(
                //"NEWPRODUCT",
                //"SALELEADER",
                //"SPECIALOFFER",
                "RAITING_VAL",
                "RAITING_COUNT",
                "CML2_ARTICLE",
                "BESTSELLER",
                "MORE_PHOTO",
                "PRICE_HIDE",
            ),
            "INCLUDE_SUBSECTIONS" => "Y",
            "LIST_META_KEYWORDS" => "UF_KEYWORDS",
            "LIST_META_DESCRIPTION" => "UF_META_DESCRIPTION",
            "LIST_BROWSER_TITLE" => "UF_BROWSER_TITLE",
            "LIST_OFFERS_FIELD_CODE" => array(
                "NAME",
                "PREVIEW_PICTURE",
                "DETAIL_PICTURE",
            ),
            "LIST_OFFERS_PROPERTY_CODE" => array(
                "ARTNUMBER",
                "COLOR_REF",
                "SIZES_SHOES",
                "SIZES_CLOTHES",
                "MORE_PHOTO",
                "RAITING_VAL",
                "RAITING_COUNT",
            ),
            "LIST_OFFERS_LIMIT" => "0",
            "SECTION_BACKGROUND_IMAGE" => "-",
            "DETAIL_DETAIL_PICTURE_MODE" => "IMG",
            "DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
            "DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
            "DETAIL_PROPERTY_CODE" => array(
                "NEWPRODUCT",
                "MANUFACTURER",
                "MATERIAL",
                "RAITING_VAL",
                "RAITING_COUNT",
                "CML2_ARTICLE",
                "MORE_PHOTO",
                "BESTSELLER",
                "VIDEO_1",
                "VIDEO_2",
                "PRICE_HIDE",
            ),
            "DETAIL_META_KEYWORDS" => "KEYWORDS",
            "DETAIL_META_DESCRIPTION" => "META_DESCRIPTION",
            "DETAIL_BROWSER_TITLE" => "TITLE",
            "DETAIL_SET_CANONICAL_URL" => "N",
            "DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
            "SHOW_DEACTIVATED" => "N",
            "DETAIL_OFFERS_FIELD_CODE" => array(
                0 => "NAME",
                1 => "",
            ),
            "DETAIL_OFFERS_PROPERTY_CODE" => array(
                0 => "ARTNUMBER",
                1 => "COLOR_REF",
                2 => "SIZES_SHOES",
                3 => "SIZES_CLOTHES",
                4 => "MORE_PHOTO",
                5 => "",
            ),
            "DETAIL_BACKGROUND_IMAGE" => "-",
            "DETAIL_STRICT_SECTION_CHECK" => "Y",
            "LINK_IBLOCK_TYPE" => "",
            "LINK_IBLOCK_ID" => "",
            "LINK_PROPERTY_SID" => "",
            "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
            "USE_ALSO_BUY" => "Y",
            "ALSO_BUY_ELEMENT_COUNT" => "3",
            "ALSO_BUY_MIN_BUYES" => "2",
            "DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
            "USE_GIFTS_DETAIL" => "Y",
            "USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
            "USE_GIFTS_SECTION" => "Y",
            "GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
            "GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
            "GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
            "GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
            "GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
            "GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
            "GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
            "GIFTS_MESS_BTN_BUY" => "Выбрать",
            "GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
            "GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
            "GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "3",
            "GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
            "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
            "GIFTS_SHOW_IMAGE" => "Y",
            "GIFTS_SHOW_NAME" => "Y",
            "GIFTS_SHOW_OLD_PRICE" => "Y",
            "USE_STORE" => "Y",
            "STORES" => array("1"),
            "USE_MIN_AMOUNT" => "N",
            "USER_FIELDS" => array(""),
            "FIELDS" => array("ADDRESS", "PHONE"),
            "SHOW_EMPTY_STORE" => "Y",
            "SHOW_GENERAL_STORE_INFORMATION" => "N",
            "STORE_PATH" => "/store/#store_id#",
            "MAIN_TITLE" => "Наличие на складах",
            "USE_BIG_DATA" => "N",
            "BIG_DATA_RCM_TYPE" => "bestsell",
            "OFFERS_SORT_FIELD" => "sort",
            "OFFERS_SORT_ORDER" => "asc",
            "OFFERS_SORT_FIELD2" => "id",
            "OFFERS_SORT_ORDER2" => "desc",
            "PAGER_TEMPLATE" => "stroyservis",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Товары",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_BASE_LINK_ENABLE" => "Y",
            //"PAGER_BASE_LINK" => "",
            "PAGER_BASE_LINK" => "",
            "PAGER_PARAMS_NAME" => "arrPager",
            "SET_STATUS_404" => "Y",
            "SHOW_404" => "Y",
            "MESSAGE_404" => "",
            "ADD_PICT_PROP" => "-",
            "LABEL_PROP" => "NEWPRODUCT",
            "PRODUCT_DISPLAY_MODE" => "Y",
            "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
            "OFFER_TREE_PROPS" => array(
                0 => "COLOR_REF",
                1 => "SIZES_SHOES",
                2 => "SIZES_CLOTHES",
                3 => "",
            ),
            "DETAIL_DISPLAY_NAME" => "Y",
            "DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
            "SHOW_DISCOUNT_PERCENT" => "Y",
            "SHOW_OLD_PRICE" => "Y",
            "DETAIL_SHOW_MAX_QUANTITY" => "N",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_COMPARE" => "Сравнение",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "TOP_VIEW_MODE" => "SECTION",
            "DETAIL_USE_VOTE_RATING" => "Y",
            "DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
            "DETAIL_USE_COMMENTS" => "Y",
            "DETAIL_BLOG_USE" => "Y",
            "DETAIL_VK_USE" => "N",
            "DETAIL_FB_USE" => "Y",
            "DETAIL_FB_APP_ID" => "",
            "DETAIL_BRAND_USE" => "N",
            "SIDEBAR_SECTION_SHOW" => "Y",
            "SIDEBAR_DETAIL_SHOW" => "N",
            "SIDEBAR_PATH" => "/examples/index_inc.php",
            "AJAX_OPTION_ADDITIONAL" => "",
            "SEF_URL_TEMPLATES" => array(
                "sections" => "",
                "section" => "#SECTION_CODE#/",
                "element" => "/#ELEMENT_CODE#/",
                "compare" => "compare/",
                "smart_filter" => "#SECTION_CODE#/filter/#SMART_FILTER_PATH#/",
            ),

            //"AJAX_MODE" => $ajaxMode,
            "AJAX_MODE" => 'N',
            "AJAX_OPTION_ADDITIONAL" => "catalog",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "AJAX_OPTION_HISTORY" => "Y",

            "SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],

            "INSTANT_RELOAD" => "Y",

            // Мои параметры -->
            "BASKET_AJAX_URL" => "/local/ajax/basket.php",
            "ORDER_AJAX_URL" => "/local/ajax/order.php",
            "LAZY_LOAD" => "Y"
            // <--
        ),
        false
    ); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>