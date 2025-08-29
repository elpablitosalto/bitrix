<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Адрес -->
$city = $arResult['DISPLAY_PROPERTIES']['CITY']['DISPLAY_VALUE'];
$addressShort = $arResult['DISPLAY_PROPERTIES']['ADDRESS']['DISPLAY_VALUE'];
$address = $city;
if (strlen($city) > 0 && strlen($addressShort) > 0) {
    $address .= ', ';
}
$address .= $addressShort;
// <-- Адрес

// Месяц, год -->
$month = $arResult['DISPLAY_PROPERTIES']['MONTH']['DISPLAY_VALUE'];
$year = $arResult['DISPLAY_PROPERTIES']['YEAR']['DISPLAY_VALUE'];
$date = $month;
$datetime = $year;
if (strlen($month) > 0 && strlen($year) > 0) {
    $date .= ' ';
    $datetime .= '-' . $month;
}
$date .= $year;
// <-- Месяц, год

// Доп контент в левый сайдбар -->
$str = '<div class="dp-aside dp-sticky">
<div class="dp-page__back"><a href="/portfolio/">
        <svg class="icon icon-drop-left ">
            <use xlink:href="#drop-left"></use>
        </svg><span>Портфолио</span></a></div>
<div class="h3 dp-aside__title">' . $arResult['NAME'] . '</div>
<div class="dp-aside-address">' . $address . '</div>
<time class="dp-aside-date" datetime="' . $datetime . '">' . $date . '</time>
';
if (!empty($arResult['DISPLAY_PROPERTIES']['PRODUCT_CATALOG']['VALUE'])) {
    $str .= '<div class="dp-tags">
<ul class="dp-tags__list dp-tags__list_row">
    <li class="dp-tags__item">
        <a class="dp-btn dp-btn_used-in-project" href="#project-goods" data-anchor="#project-goods"> <span>Изделия в проекте</span></a>
    </li>
</ul>
</div>';
}
$str .= '</div>';
$APPLICATION->AddViewContent('PAGE_CONTENT_LEFT_SIDEBAR', $str);
// <-- Доп контент в левый сайдбар

// Доп контент рядом с h1 -->
$str = '<a class="dp-btn dp-btn_xs dp-btn_blue d-lg-none dp-btn_used-in-project" href="#project-goods" data-anchor="#project-goods"><span>Изделия в проекте</span></a>';
$APPLICATION->AddViewContent('PAGE_CONTENT_AFTER_H1', $str);
// <-- Доп контент рядом с h1
?>

<?
//vardump($arResult['DISPLAY_PROPERTIES']['PRODUCT_CATALOG']);
//echo 'IBLOCK_ID = '.Indexis::getIblockId('catalog', 'CRM_PRODUCT_CATALOG').'<br />';
//vardump($arResult['DISPLAY_PROPERTIES']['PRODUCT_CATALOG']['VALUE']);
?>

<? if (!empty($arResult['DISPLAY_PROPERTIES']['PRODUCT_CATALOG']['VALUE'])) { ?>
    <?
    $GLOBALS['arrFilterPortfolioProducts']['ID'] = $arResult['DISPLAY_PROPERTIES']['PRODUCT_CATALOG']['VALUE'];
    ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "products_portfolio",
        array(
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "N",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "CRM_PRODUCT_CATALOG",
            "IBLOCK_ID" => Indexis::getIblockId('catalog', 'CRM_PRODUCT_CATALOG'),
            "NEWS_COUNT" => "20",
            "SORT_BY1" => 'SORT',
            "SORT_ORDER1" => 'ASC',
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "arrFilterPortfolioProducts",
            "FIELD_CODE" => array("ID", 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL', 'DETAIL_PICTURE'),
            "PROPERTY_CODE" => array(''),
            "CHECK_DATES" => "N",
            "DETAIL_URL" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "SET_TITLE" => "N",
            "SET_BROWSER_TITLE" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "CACHE_FILTER" => "Y",
            "CACHE_GROUPS" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Подразделы",
            "PAGER_SHOW_ALWAYS" => "Y",
            //"PAGER_TEMPLATE" => "show_more_colors",
            "PAGER_TEMPLATE" => "",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "SET_STATUS_404" => "N",
            "SHOW_404" => "N",
            "MESSAGE_404" => "",
            "PAGER_BASE_LINK" => "",
            "PAGER_PARAMS_NAME" => "arrPager",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",

            // Мои параметры -->
            // <-- Мои параметры
        )
    ); ?>
<? } ?>