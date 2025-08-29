<?
define('PAGE_TYPE', 2);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require(".process.php");
$APPLICATION->SetPageProperty("description", "Отзывы. Компания Стройсервис в Москве. ☎ +7 (495) 229-30-20");
$APPLICATION->SetTitle("Отзывы");
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'reviews');
$APPLICATION->SetPageProperty("BODY_CLASS", 'page-reviews');
?>
<?if ($arResult['HAS_HISTORY']):?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "reviews_clients",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("reviews_clients", "content"),
            "NEWS_COUNT" => "4",
            //"NEWS_COUNT" => "3",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "arrFilterAboutCerts",
            "FIELD_CODE" => array("ID", "NAME", "DETAIL_PICTURE", "PREVIEW_PICTURE"),
            "PROPERTY_CODE" => array(''),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "d F Y",
            "SET_TITLE" => "N",
            "SET_BROWSER_TITLE" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_META_DESCRIPTION" => "Y",
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "360000",
            "CACHE_FILTER" => "Y",
            "CACHE_GROUPS" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => "Сертификаты",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "stroyservis",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_BASE_LINK_ENABLE" => "Y",
            "SET_STATUS_404" => "N",
            "SHOW_404" => "N",
            "MESSAGE_404" => "",
            "PAGER_BASE_LINK" => "",
            "PAGER_PARAMS_NAME" => "",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
        )
    ); ?>

    <?
    $APPLICATION->IncludeFile(
        SITE_DIR . 'include/review/history_our_clients.php',
        array(),
        array('SHOW_BORDER' => false)
    );
    ?>

    <?
    //vardump($GLOBALS['FIRST_SHOW_CLIENTS_REVIEWS']);
    if (!empty($GLOBALS['FIRST_SHOW_CLIENTS_REVIEWS'])) {
        $GLOBALS['arrFilterClientsReviews_2']['!ID'] = $GLOBALS['FIRST_SHOW_CLIENTS_REVIEWS'];
    }
    ?>

<?else:?>

    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "reviews_clients",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "Y",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("reviews_clients", "content"),
            "NEWS_COUNT" => "12",
            //"NEWS_COUNT" => "3",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "arrFilterClientsReviews_2",
            "FIELD_CODE" => array("ID", "NAME", "DETAIL_PICTURE", "PREVIEW_PICTURE"),
            "PROPERTY_CODE" => array(''),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "d F Y",
            "SET_TITLE" => "N",
            "SET_BROWSER_TITLE" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_META_DESCRIPTION" => "Y",
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "360000",
            "CACHE_FILTER" => "Y",
            "CACHE_GROUPS" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Сертификаты",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "stroyservis_ajax",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "SET_STATUS_404" => "N",
            "SHOW_404" => "N",
            "MESSAGE_404" => "",
            "PAGER_BASE_LINK" => "",
            "PAGER_PARAMS_NAME" => "",
            "AJAX_OPTION_JUMP" => "Y",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
        )
    ); ?>

<?endif;?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>