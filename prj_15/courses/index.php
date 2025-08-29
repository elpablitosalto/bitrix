<?
define('SET_OG_MARKING', 'Y');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Курсы для врачей и медицинских работников");
$APPLICATION->SetPageProperty("description", 'По материалам международных медицинских руководств создали онлайн-курсы совершенствования у врачей навыков структурирования медицинской консультации и профессионального общения с пациентом. Навыков саморегуляции, публичных выступлений. Удаленное обучение. Для врачей всех специальностей.');
$APPLICATION->SetPageProperty("keywords", 'курсы для врачей, бесплатные курсы для врачей, онлайн курсы для врачей, курсы для врачей дистанционно, курсы для медиков, курсы для терапевтов, курсы для урологов, курсы для неврологов, курсы для гинекологов, эндокринология курсы для врачей');
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-account');
$APPLICATION->SetPageProperty("PAGE_H1", 'Курсы для врачей и медицинских специалистов');
$APPLICATION->SetPageProperty("PAGE_H2", 'Cозданные по материалам ведущих международных медицинских руководств');
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "courses",
    array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => Indexis::getIblockId("courses", "content"),
        "NEWS_COUNT" => "100",
        "SORT_BY1" => "PROPERTY_DATE_START",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "arFilterMasterClasses",
        "FIELD_CODE" => array("PREVIEW_TEXT", "PREVIEW_PICTURE", "ACTIVE_FROM", "DETAIL_PAGE_URL"),
        "PROPERTY_CODE" => array('THEME', 'DATE_START', 'DATE_END', 'COUNT_MODULES', 'EXTERNAL_URL', 'BUY_LINK'),
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
            'LIST_ELEMENT_CODE' => 'courses',
            'SET' => 'Y',
        ),
        // <-- Мои параметры
    )
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>