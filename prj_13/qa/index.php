<?
define('PAGE_TYPE', 3);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Вопрос-ответ. Компания Стройсервис в Москве. ☎ +7 (495) 229-30-20");
//$APPLICATION->SetTitle("Сертификаты");
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'page-title-orange');
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS_2", 'faq');
$APPLICATION->SetPageProperty("MICROMARKING_PARAMS_PAGE_SECTION", 'itemscope itemtype="https://schema.org/QAPage"');
?>

<? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "qa",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("qa", "content"),
            "NEWS_COUNT" => "10",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "certFilter",
            "FIELD_CODE" => array("ID", "NAME", "DETAIL_TEXT"),
            "PROPERTY_CODE" => array(""),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "d F Y",
            "SET_TITLE" => "Y",
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
            "PAGER_TEMPLATE" => "show_more",
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

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>