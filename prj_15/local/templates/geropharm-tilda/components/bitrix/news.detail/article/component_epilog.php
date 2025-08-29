<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
$APPLICATION->SetPageProperty("PAGE_H1", $arResult['NAME']);
?>

<? if (!empty($arResult['arFilterResult'])) { ?>

    <?
    foreach ($arResult['arFilterResult'] as $key => $val) {
        $GLOBALS['arrFilterSeeAlso'][$key] = $arResult['arFilterResult'][$key];
    }
    $GLOBALS['arrFilterSeeAlso']['!ID'] = $arResult['ID'];
    ?>

    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "articles_see_also",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => indexis::getIblockId("articles", "content"),
            "NEWS_COUNT" => "25",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "arrFilterSeeAlso",
            "FIELD_CODE" => array("NAME", "PREVIEW_PICTURE", "ACTIVE_FROM", "DETAIL_PAGE_URL"),
            "PROPERTY_CODE" => array('THEME'),
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
            "CONTENT_TYPE" => "ARTICLE",
            // <-- Мои параметры
        )
    ); ?>

<? } ?>

<script>
    <?
    if(!is_array($arResult["DISPLAY_PROPERTIES"]["SPECIALITY"]["DISPLAY_VALUE"])){
        $arResult["DISPLAY_PROPERTIES"]["SPECIALITY"]["DISPLAY_VALUE"] = [$arResult["DISPLAY_PROPERTIES"]["SPECIALITY"]["DISPLAY_VALUE"]];
    }
    ?>
    $(function() {
        mindboxViewMaterial({'specialization':<?echo CUtil::PhpToJSObject($arResult["DISPLAY_PROPERTIES"]["SPECIALITY"]["DISPLAY_VALUE"]);?>,'link':'<?=SITE_SERVER_NAME.$arResult["DETAIL_PAGE_URL"]?>', 'name':'<?=$arResult["NAME"]?>'});
    });
</script>

