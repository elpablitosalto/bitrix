<?
//vardump( $arParams );
if (empty($arParams['SEF_FOLDER'])) {
    $arParams['SEF_FOLDER'] = "/blog/";
}
if (empty($arParams['SEF_MODE'])) {
    $arParams['SEF_MODE'] = "Y";
}
if (empty($arParams['CUSTOM_DETAIL_URL'])) {
    $arParams['CUSTOM_DETAIL_URL'] = "";
}
if (empty($arParams['SHOW_BACK_TO_RECOMMEND'])) {
    $arParams['SHOW_BACK_TO_RECOMMEND'] = "N";
}
if (empty($arParams['SHOW_FILTER'])) {
    $arParams['SHOW_FILTER'] = "Y";
}
if (empty($arParams['SHOW_SORT_PANEL'])) {
    $arParams['SHOW_SORT_PANEL'] = "Y";
}
if (empty($arParams['SHOW_TABS'])) {
    $arParams['SHOW_TABS'] = "N";
}
if (empty($arParams['SHOW_SAVED'])) {
    $arParams['SHOW_SAVED'] = "N";
}
if (empty($arParams['NEWS_COUNT'])) {
    $arParams['NEWS_COUNT'] = 20;
}
if (empty($arParams['SEF_URL_TEMPLATES'])) {
    $arParams['SEF_URL_TEMPLATES'] = array(
        //"detail" => "#SECTION_CODE#/#ELEMENT_CODE#/",
        "detail" => "#ELEMENT_CODE#/",
        "news" => "",
        "section" => "#SECTION_CODE#/",
        "search" => "search/"
    );
}
if (empty($arParams['OG'])) {
    $arParams['OG'] = array(
        'SET' => 'N'
    );
}
//vardump($arParams['OG']);
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:news",
    "materials",
    array(
        "ADD_ELEMENT_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "BROWSER_TITLE" => "-",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
        "DETAIL_DISPLAY_TOP_PAGER" => "N",
        "DETAIL_FIELD_CODE" => array("PREVIEW_PICTURE", "DETAIL_PICTURE", "DETAIL_TEXT", "ACTIVE_FROM"),
        "DETAIL_PAGER_SHOW_ALL" => "Y",
        "DETAIL_PAGER_TEMPLATE" => "",
        "DETAIL_PAGER_TITLE" => "Страница",
        "DETAIL_PROPERTY_CODE" => $arParams['DETAIL_PROPERTY_CODE'],
        "DETAIL_SET_CANONICAL_URL" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "IBLOCK_TYPE" => "content",
        "INSTANT_RELOAD" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "FILTER_NAME" => "arrFilterArticles",
        "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "LIST_FIELD_CODE" => array("PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PICTURE", "ACTIVE_FROM"),
        "LIST_PROPERTY_CODE" => $arParams['LIST_PROPERTY_CODE'],
        "MEDIA_PROPERTY" => "",
        "MESSAGE_404" => "",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "NEWS_COUNT" => $arParams['NEWS_COUNT'],
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "geropharm",
        "PAGER_TITLE" => "Новости",
        "PREVIEW_TRUNCATE_LEN" => "",
        //"SEF_FOLDER" => "/blog/",
        "SEF_FOLDER" => $arParams['SEF_FOLDER'],
        //"SEF_MODE" => "Y",
        "SEF_MODE" => $arParams['SEF_MODE'],
        "SEF_URL_TEMPLATES" => $arParams['SEF_URL_TEMPLATES'],
        "SET_LAST_MODIFIED" => "N",
        "SET_STATUS_404" => "Y",
        "SET_TITLE" => "N",
        "SHOW_404" => "Y",
        "SLIDER_PROPERTY" => "",
        "SORT_BY1" => "SHOW_COUNTER",
        "SORT_BY2" => "DESC",
        "SORT_ORDER1" => "ACTIVE_FROM",
        "SORT_ORDER2" => "DESC",
        "STRICT_SECTION_CHECK" => "N",
        "TEMPLATE_THEME" => "blue",
        "USE_CATEGORIES" => "N",
        "USE_FILTER" => "N",
        "USE_PERMISSIONS" => "N",
        "USE_RATING" => "N",
        "USE_RSS" => "N",
        "USE_SEARCH" => "Y",
        "USE_SHARE" => "N",

        // Мои параметры -->
        'CUSTOM_DETAIL_URL' => $arParams['CUSTOM_DETAIL_URL'],
        'SHOW_BACK_TO_RECOMMEND' => $arParams['SHOW_BACK_TO_RECOMMEND'],
        'SHOW_FILTER' => $arParams['SHOW_FILTER'],
        'SHOW_SORT_PANEL' => $arParams['SHOW_SORT_PANEL'],
        'SHOW_TABS' => $arParams['SHOW_TABS'],
        'SHOW_SAVED' => $arParams['SHOW_SAVED'],
        'USER_AUTHORIZED' => $USER->IsAuthorized() ? 'Y' : 'N',
        'DETAIL_TEMPLATE' => $arParams['DETAIL_TEMPLATE'],
        'LIST_TEMPLATE' => $arParams['LIST_TEMPLATE'],
        'MATERIAL_TYPE' => $arParams['MATERIAL_TYPE'],
        'DETAIL_SHOW_USER_AUTHORIZED' => $arParams['DETAIL_SHOW_USER_AUTHORIZED'],
        'SHOW_EMPTY_BLOCK' => $arParams['SHOW_EMPTY_BLOCK'] ? $arParams['SHOW_EMPTY_BLOCK'] : 'N',
        'OG' => $arParams['OG'],
        'USER_ORDERS' => $arParams['USER_ORDERS'],
        'PAYMENT' => $arParams['PAYMENT'],
        //'H1' => 'Статьи для врачей и медицинских специалистов',
        // <-- Мои параметры
    )
); ?>