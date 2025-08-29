<?
define('PAGE_TYPE', 2);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use \Bitrix\Main\Data\Cache,
    \Bitrix\Main\Application,
    \Bitrix\Main\Loader;

$APPLICATION->SetTitle("Мои рекомендации");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-account dp-page-account-recommendations');
$APPLICATION->SetPageProperty("PAGE_H1", 'Мои рекомендации');
?>

<? if (!$USER->IsAuthorized()) { ?>
    <? ShowError('Необходимо авторизоваться'); ?>
<? } else { ?>
    <div class="dp-page__header">
        <h1 class="dp-page__title"><? $APPLICATION->ShowProperty('PAGE_H1'); ?></h1>

        <? $arFilterFromComponent = $APPLICATION->IncludeComponent(
            "indexis:filter.materials",
            "materials",
            array(
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "Y",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",

                //"PERSONAL" => "Y",
                "USER_ID" => $USER->GetID(),
                "HIBLOCK_ID" => $GLOBALS['arSiteConfig']['HIBLOCK']['THEMES']['ID'],
            )
        ); ?>
    </div>
    <div class="dp-page__body">
        <div class="row">
            <div class="col-lg-7 col-xxl-8">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "relevant_now",
                    array(
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "N",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_MODE" => "N",
                        "IBLOCK_TYPE" => "content",
                        "IBLOCK_ID" => Indexis::getIblockId("relevant_now", "content"),
                        "NEWS_COUNT" => "4",
                        "SORT_BY1" => "PROPERTY_DATE_TIME_START",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "arrFilterUpcomingWebinars",
                        "FIELD_CODE" => array("PREVIEW_TEXT", "PREVIEW_PICTURE"),
                        "PROPERTY_CODE" => array('TYPE', 'THEME', 'DATE', 'URL'),
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
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "PAGER_TITLE" => "Подразделы",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "geropharm",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
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
                        'HEADER' => 'Актуально сейчас',
                        'SHOW_H2' => 'Y',
                        //'USER_AUTHORIZED' => $USER->IsAuthorized() ? 'Y' : 'N',
                        // <-- Мои параметры
                    )
                ); ?>
            </div>
            <div class="col-lg-5 col-xxl-4">
                <? $APPLICATION->IncludeComponent(
                    "indexis:digits",
                    "",
                    array(
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "Y",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",

                        //"PERSONAL" => "Y",
                        "USER_ID" => $USER->GetID(),
                        //"HIBLOCK_ID" => $GLOBALS['arSiteConfig']['HIBLOCK']['THEMES']['ID'],
                    )
                ); ?>
            </div>
        </div>

        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "upcoming_webinars",
            array(
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "N",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => Indexis::getIblockId("upcoming_webinars", "content"),
                "NEWS_COUNT" => "4",
                "SORT_BY1" => "PROPERTY_DATE_TIME_START",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "arrFilterUpcomingWebinars",
                "FIELD_CODE" => array("PREVIEW_TEXT", "PREVIEW_PICTURE"),
                "PROPERTY_CODE" => array('THEME', 'DATE_TIME_START', 'FIO', 'URL'),
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
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "Подразделы",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "geropharm",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
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
                'HEADER' => 'Ближайшие вебинары для вас',
                'SHOW_H2' => 'Y',
                //'USER_AUTHORIZED' => $USER->IsAuthorized() ? 'Y' : 'N',
                // <-- Мои параметры
            )
        ); ?>
        <?
        $arResultFunc = CMaterials::getFilterMaterials(array(
            "arFilterFromComponent" => $arFilterFromComponent,
            "USER_ID" => $USER->GetID(),
            "IBLOCK_ID" => Indexis::getIblockId("webinars", "content")
        ));
        $GLOBALS['arrFilterPersonalNewWebinars'] = $arResultFunc['arFilterResult'];

        $GLOBALS['arrFilterPersonalNewWebinars']['!PROPERTY_FILE'] = false;
        //vardump($arFilterFromComponent);
        ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "webinars",
            array(
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "N",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => Indexis::getIblockId("webinars", "content"),
                "NEWS_COUNT" => "4",
                "SORT_BY1" => "PROPERTY_PAID",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "ACTIVE_FROM",
                "SORT_ORDER2" => "DESC",
                "FILTER_NAME" => "arrFilterPersonalNewWebinars",
                "FIELD_CODE" => array("PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PICTURE"),
                "PROPERTY_CODE" => array('THEME', 'PRICE', 'SHOW_PRICE', 'BUY_LINK', 'PAID', 'SPEAKER'),
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
                "CACHE_TYPE" => "N",
                "CACHE_TIME" => "3600",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "Подразделы",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "geropharm",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
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
                'HEADER' => 'Новые записи вебинаров',
                'SHOW_MORE_SHOW' => 'Y',
                'SHOW_H2' => 'Y',
                'USER_AUTHORIZED' => $USER->IsAuthorized() ? 'Y' : 'N',
                'SHOW_THREE_OR_FOUR' => 'Y',
                'USER_ORDERS' => $GLOBALS['USER_ORDERS'],
                // <-- Мои параметры
            )
        ); ?>
        <?
        $arResultFunc = CMaterials::getFilterMaterials(array(
            "arFilterFromComponent" => $arFilterFromComponent,
            "USER_ID" => $USER->GetID(),
            "IBLOCK_ID" => Indexis::getIblockId("articles", "content"),
        ));
        $GLOBALS['arrFilterPersonalArticles'] = $arResultFunc['arFilterResult'];
        //vardump($arFilterFromComponent);
        ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "articles",
            array(
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "N",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => Indexis::getIblockId("articles", "content"),
                "NEWS_COUNT" => "4",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "FILTER_NAME" => "arrFilterPersonalArticles",
                "FIELD_CODE" => array("PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PICTURE"),
                "PROPERTY_CODE" => array('THEME'),
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
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "Подразделы",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "geropharm",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
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
                'HEADER' => 'Новые статьи',
                'SHOW_MORE_SHOW' => 'Y',
                'SHOW_H2' => 'Y',
                'USER_AUTHORIZED' => $USER->IsAuthorized() ? 'Y' : 'N',
                //'HIDE_READED' => $arFilterFromComponent['arFilter']['hidelearned'],
                // <-- Мои параметры
            )
        ); ?>
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
                "NEWS_COUNT" => "4",
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
                // <-- Мои параметры
            )
        ); ?>

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
                "NEWS_COUNT" => "4",
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
                "CACHE_TYPE" => "N",
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
                // <-- Мои параметры
            )
        ); ?>
    </div>
<? } ?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>