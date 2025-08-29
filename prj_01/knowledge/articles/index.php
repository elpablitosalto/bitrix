<?
define('PAGE_TYPE', 2);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Статьи");
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'base');
$APPLICATION->SetPageProperty("PAGE_H1", 'Статьи');
?>
<?
if ($GLOBALS['arUser']['isPartner'] || $GLOBALS['arUser']['isAdmin']) {
?>
<? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "knowledge_articles",
        array(
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "knowledge",
            "IBLOCK_ID" => Indexis::getIblockId("articles", "knowledge"),
            "IBLOCK_CODE" => '',
            "NEWS_COUNT" => "100",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "FILTER_NAME" => 'arrFilterKnowledgeArticles',
            "FIELD_CODE" => array('ID', 'NAME', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL'),
            "PROPERTY_CODE" => array(),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "SET_TITLE" => "N",
            "SET_BROWSER_TITLE" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_META_DESCRIPTION" => "N",
            "SET_LAST_MODIFIED" => "Y",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "CACHE_FILTER" => "Y",
            "CACHE_GROUPS" => "Y",
            "DISPLAY_TOP_PAGER" => "Y",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Новости",
            "PAGER_SHOW_ALWAYS" => "Y",
            "PAGER_TEMPLATE" => "show_more_clinical",
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
            //'CUSTOM_SECTION_SORT' => $CUSTOM_SECTION_SORT,
            // <-- Мои параметры 
        )
    ); ?>

<? } else { ?>
    <? if (!$GLOBALS['arUser']['isAuthorized']) { ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "popup",
            array(
                "REGISTER_URL" => "register.php",
                "FORGOT_PASSWORD_URL" => "",
                "PROFILE_URL" => "profile.php",
                "SHOW_ERRORS" => "Y",
                "CHECK_AUTH" => "Y",
            )
        ); ?>
    <? } else {
    ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/reg_partner.php"
            )
        ); ?>
        <?
    } ?>
<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>