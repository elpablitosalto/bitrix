<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>    

<div class="recommendation-wrapper">
    <?
    $bShowComponent = true;
    ?>
    <? if (mb_strlen($_GET["q"]) > 0) { ?>
        <?
        $arSearchParams = array(
            '~FILTER_NAME' => $arParams['FILTER_NAME'],
            'CHECK_DATES' => 'N',
            'IBLOCK_TYPE' => 'knowledge',
            'CACHE_TYPE' => 'N',
            'CACHE_TIME' => '3600',
            'SET_TITLE' => 'N',
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        );
        $GLOBALS[$arSearchParams["~FILTER_NAME"]]["=ID"] = $APPLICATION->IncludeComponent(
            "bitrix:search.page",
            "reagents",
            array(
                "CHECK_DATES" => $arSearchParams["CHECK_DATES"] !== "N" ? "Y" : "N",
                "arrWHERE" => array("iblock_" . $arSearchParams["IBLOCK_TYPE"]),
                "arrFILTER" => array("iblock_" . $arSearchParams["IBLOCK_TYPE"]),
                "SHOW_WHERE" => "N",
                "CACHE_TYPE" => $arSearchParams["CACHE_TYPE"],
                "CACHE_TIME" => $arSearchParams["CACHE_TIME"],
                "SET_TITLE" => $arSearchParams["SET_TITLE"],
                "arrFILTER_iblock_" . $arSearchParams["IBLOCK_TYPE"] => array($arSearchParams["IBLOCK_ID"]),
                "PAGE" => $_SERVER['REQUEST_URI'],
                'USE_TITLE_RANK' => 'Y',
                'PAGE_RESULT_COUNT' => 5000,
            ),
            $component
        );
        if (empty($GLOBALS[$arSearchParams["~FILTER_NAME"]]["=ID"])) {
            $bShowComponent = false;
        }
        ?>
    <? } else { ?>

    <? } ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:search.form",
        "knowledge_clinical",
        array(
            //"PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],
            //"PAGE" => $arResult["FOLDER"],
            "PAGE" => $_SERVER['REQUEST_URI'],
        ),
        $component
    ); ?>
</div>
<? if ($bShowComponent == false) { ?>
    <? ShowError('Ничего не найдено'); ?>
<? } else { ?>
    <?
    $GLOBALS[$arParams['FILTER_NAME']]["!PROPERTY_FILE"] = false;
    //echo 'IBLOCK_ID = '.$arParams['IBLOCK_ID'].'<br />';
    ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "knowledge_clinical",
        array(
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "knowledge",
            "IBLOCK_ID" => $arParams['IBLOCK_ID'],
            "IBLOCK_CODE" => '',
            "NEWS_COUNT" => "10",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "FILTER_NAME" => $arParams['FILTER_NAME'],
            "FIELD_CODE" => array('ID', 'NAME', 'ACTIVE_FROM'),
            "PROPERTY_CODE" => array('FILE'),
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


<? } ?>