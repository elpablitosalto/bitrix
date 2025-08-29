<?
define('SET_OG_MARKING', 'Y');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Дистанционные мастер-классы для врачей");
$APPLICATION->SetPageProperty("description", 'Мастер-классы направлены на совершенствование навыков общения с пациентами и навыков саморегуляции для профилактики эмоционального выгорания. В развитии навыков помогут медицинские эксперты по вербальному и невербальному общению, клинической психологии и гедонизма.');
$APPLICATION->SetPageProperty("keywords", 'мастер классы для врачей, мастер класс для врачей волгоград апрель 2024');
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-account');
$APPLICATION->SetPageProperty("PAGE_H1", 'Мастер-классы для врачей и медицинских специалистов');
$APPLICATION->SetPageProperty("PAGE_H2", 'Созданные по материалам ведущих международных медицинских руководств');
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "master_classes",
    array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => indexis::getIblockId("master-class", "content"),
        "NEWS_COUNT" => "100",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "arFilterMasterClasses",
        "FIELD_CODE" => array("PREVIEW_TEXT", "PREVIEW_PICTURE", "ACTIVE_FROM", "DETAIL_PAGE_URL"),
        "PROPERTY_CODE" => array('THEME', 'DATE_START', 'DATE_END', 'COUNT_MODULES', 'BUY_LINK'),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d F Y",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_LAST_MODIFIED" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "360000",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "Y",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "Y",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "PAGER_BASE_LINK_ENABLE" => "Y",
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
        'USER_AUTHORIZED' => $USER->IsAuthorized() ? 'Y' : 'N',
        'SHOW_H2' => 'N',
        'OG' => array(
            'LIST_ELEMENT_CODE' => 'master',
            'SET' => 'Y',
        ),
        // <-- Мои параметры
    )
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>