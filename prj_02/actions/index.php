<?

use \Bitrix\Main\Context;
use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Акции");
$request = Context::getCurrent()->getRequest();
Asset::getInstance()->addString('<script data-skip-moving="true" src="https://widget.cloudpayments.ru/bundles/cloudpayments.js"></script>');

//echo '!!!';
?>

<?/**/?>
<? $APPLICATION->IncludeComponent(
    "bitrix:news",
    "events",
    array(
        "ADD_ELEMENT_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "Y",
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
        "DETAIL_FIELD_CODE" => array("", ""),
        "DETAIL_PAGER_SHOW_ALL" => "Y",
        "DETAIL_PAGER_TEMPLATE" => "",
        "DETAIL_PAGER_TITLE" => "Страница",
        "DETAIL_PROPERTY_CODE" => array(
            "ABOUT","FOR_WHOM","DOCS", "EVENT_NUMBERS", "HOW_WE_HELP", "GALERY", 
            "PARTNERS", "IS_GRANT_EVENT", "EVENT_BUDGET", "LONG_HEADER",
            "STATUS",
        ),
        "DETAIL_SET_CANONICAL_URL" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => Indexis::getIblockId("events", "content", "s1"),
        "IBLOCK_TYPE" => "content",
        "INSTANT_RELOAD" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "FILTER_NAME" => "eventFilter",
        "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "LIST_FIELD_CODE" => array("PREVIEW_TEXT", ""),
        "LIST_PROPERTY_CODE" => array("CITY", "BENEFICIARY_TYPE"),
        "MEDIA_PROPERTY" => "",
        "MESSAGE_404" => "",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "NEWS_COUNT" => "6",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "show_more",
        "PAGER_TITLE" => "Новости",
        "PREVIEW_TRUNCATE_LEN" => "",
        "SEF_FOLDER" => "/actions/",
        "SEF_MODE" => "Y",
        "SEF_URL_TEMPLATES" => array(
            "detail" => "#SECTION_CODE#/#ELEMENT_CODE#/", 
            "news" => "", 
            "section" => "#SECTION_CODE#/", 
            "search" => "search/"
        ),
        "SET_LAST_MODIFIED" => "N",
        "SET_STATUS_404" => "Y",
        "SET_TITLE" => "N",
        "SET_FILTER" => ($request->get("set_filter") == "y") ? "Y" : "",
        "SHOW_404" => "N",
        "SLIDER_PROPERTY" => "",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "ID",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "DESC",
        "STRICT_SECTION_CHECK" => "N",
        "TEMPLATE_THEME" => "blue",
        "USE_CATEGORIES" => "N",
        "USE_FILTER" => "N",
        "USE_PERMISSIONS" => "N",
        "USE_RATING" => "N",
        "USE_RSS" => "N",
        "USE_SEARCH" => "Y",
        "USE_SHARE" => "N"
    )
);?>
<?/**/?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>