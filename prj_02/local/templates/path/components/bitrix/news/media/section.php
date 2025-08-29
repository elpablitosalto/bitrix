<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Context;

$request = Application::getInstance()->getContext()->getRequest();
$APPLICATION->AddViewContent("page_class", "page-content projects-page");

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<section class="wrapper rs__medialLibrary">
<div class="container">
    <div class="rs__content">
        <div class="rs__content--top">
            <div class="rs__title">Медиатека</div>
        </div>
        <div class="rs__content--top"></div>

        <?

        $sectionListParams = array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
            "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
            "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
            "SEF_FOLDER" => $arParams["SEF_FOLDER"],
            "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
            "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
            "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
            "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
            "CURRENT_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
        );
        if ($sectionListParams["COUNT_ELEMENTS"] === "Y") {
            $sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
            if ($arParams["HIDE_NOT_AVAILABLE"] == "Y") {
                $sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
            }
        }
        ?>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list",
            "sections_menu",
            $sectionListParams,
            $component,
            ($arParams["SHOW_TOP_ELEMENTS"] !== "N" ? array("HIDE_ICONS" => "Y") : array())
        );
        ?>
        <?
        unset($sectionListParams);
        ?>

        <div class="rs__filter">
            <div class="rs__filter--block<? if ($arParams["SET_FILTER"] == "Y") echo " is-filter--active"; ?>">
                <div class="rs__filter--item rs__filter--item-button">
                    <button class="rs__button__default rs__button--icon ico-filter js--filter-media rs__button--icon-right">Фильтр</button>
                </div>
                <div class="rs__filter--item rs__filter--item-search">
                    <? if (mb_strlen($request->get("q")) > 0) { ?>
                        <?
                        $GLOBALS[$arParams["~FILTER_NAME"]]["=ID"] = $APPLICATION->IncludeComponent(
                            "bitrix:search.page",
                            "",
                            array(
                                "CHECK_DATES" => $arParams["CHECK_DATES"] !== "N" ? "Y" : "N",
                                "arrWHERE" => array("iblock_" . $arParams["IBLOCK_TYPE"]),
                                "arrFILTER" => array("iblock_" . $arParams["IBLOCK_TYPE"]),
                                "SHOW_WHERE" => "N",
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "SET_TITLE" => $arParams["SET_TITLE"],
                                "arrFILTER_iblock_" . $arParams["IBLOCK_TYPE"] => array($arParams["IBLOCK_ID"]),
                                "PAGE" => $_SERVER['REQUEST_URI'],
                            ),
                            $component
                        );?>
                    <? } else { ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:search.form",
                            "",
                            array(
                                "PAGE" => $_SERVER['REQUEST_URI'],
                            ),
                            $component
                        ); ?>
                    <? } ?>
                </div>
                <?
                $APPLICATION->IncludeComponent(
                    "indexis:catalog.smart.filter",
                    "news",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SECTION_ID" => $arCurSection['ID'],
                        "PREFILTER_NAME" => $PREFILTER_NAME,
                        //"FIRSTFILTER_NAME" => $FIRSTFILTER_NAME,
                        "FILTER_NAME" => $arParams["~FILTER_NAME"],
                        "PRICE_CODE" => $arParams["~PRICE_CODE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SAVE_IN_SESSION" => "N",
                        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                        "XML_EXPORT" => "N",
                        "SECTION_TITLE" => "NAME",
                        "SECTION_DESCRIPTION" => "DESCRIPTION",
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        "SEF_MODE" => "N",
                        //"SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
                        //"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                        //"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                        "SET_FILTER" => $arParams["SET_FILTER"],
                        "SHOW_TEMPLATE" => "N",
                        //"FIRST_CALL" => "Y",
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                ); ?>
                <?
                // Формирование выбранного фильтра -->
                //vardump($GLOBALS[$arParams["~FILTER_NAME"]]);
                $FIRSTFILTER_NAME = "";
                if (strlen($arParams["~FILTER_NAME"]) > 0) {
                    $FIRSTFILTER_NAME = "first_" . $arParams["~FILTER_NAME"];
                }
                if (strlen($FIRSTFILTER_NAME) > 0) {
                    $GLOBALS[$FIRSTFILTER_NAME] = false;
                    if (!empty($GLOBALS[$arParams["~FILTER_NAME"]])) {
                        $count = count($GLOBALS[$arParams["~FILTER_NAME"]]);
                        //if ($count == 1) {
                        if ($count > 0) {
                            $GLOBALS[$FIRSTFILTER_NAME]["arFilter"] = $GLOBALS[$arParams["~FILTER_NAME"]];
                            foreach ($GLOBALS[$arParams["~FILTER_NAME"]] as $key => $val) {
                                preg_match("/PROPERTY_([0-9]+)/", $key, $matches);
                                $prop_id = $matches[1];
                                if (intval($prop_id) > 0) {
                                    //$GLOBALS[$FIRSTFILTER_NAME]["PID"] = $prop_id;
                                    $GLOBALS[$FIRSTFILTER_NAME]["arPID"][] = $prop_id;
                                }
                                $GLOBALS[$FIRSTFILTER_NAME]["arrFilter"][$prop_id] = array($key => $val);
                                //vardump($matches);
                            }
                            $_SESSION[$FIRSTFILTER_NAME] = $GLOBALS[$FIRSTFILTER_NAME];
                        } else if ($count == 0) {
                            //$_SESSION[$FIRSTFILTER_NAME]["arFilter"] = array();
                            $GLOBALS[$FIRSTFILTER_NAME] = false;
                            $_SESSION[$FIRSTFILTER_NAME] = $GLOBALS[$FIRSTFILTER_NAME];
                        }
                        //$_SESSION[$FIRSTFILTER_NAME] = array();
                    } else {
                        $GLOBALS[$FIRSTFILTER_NAME] = false;
                        $_SESSION[$FIRSTFILTER_NAME] = $GLOBALS[$FIRSTFILTER_NAME];
                    }
                    if (!empty($_SESSION[$FIRSTFILTER_NAME]) && empty($GLOBALS[$FIRSTFILTER_NAME])) {
                        $GLOBALS[$FIRSTFILTER_NAME] = $_SESSION[$FIRSTFILTER_NAME];
                    }
                }
                //vardump($GLOBALS[$FIRSTFILTER_NAME]);
                // <-- Формирование выбранного фильтра
                ?>
                <?
                $APPLICATION->IncludeComponent(
                //"bitrix:catalog.smart.filter",
                    "indexis:catalog.smart.filter",
                    "news",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SECTION_ID" => $arCurSection['ID'],
                        "PREFILTER_NAME" => $PREFILTER_NAME,
                        "FIRSTFILTER_NAME" => $FIRSTFILTER_NAME,
                        "FILTER_NAME" => $arParams["~FILTER_NAME"],
                        "PRICE_CODE" => $arParams["~PRICE_CODE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SAVE_IN_SESSION" => "N",
                        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                        "XML_EXPORT" => "N",
                        "SECTION_TITLE" => "NAME",
                        "SECTION_DESCRIPTION" => "DESCRIPTION",
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        "SEF_MODE" => "N",
                        //"SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
                        //"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                        //"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                        "SET_FILTER" => $arParams["SET_FILTER"]
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );
                ?>
            </div>
        </div>

        <?
        global $NavNum;
        $curentAjaxBlock = $NavNum + 1;
        if ($request->get("AJAX_LOAD") == "Y" && $request->get("PAGEN_" . $curentAjaxBlock)) {
            //$GLOBALS['APPLICATION']->RestartBuffer();
        }
        ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "news",
            array(

                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "NEWS_COUNT" => $arParams["NEWS_COUNT"],
                "AJAX_LOAD" => ($request->get("AJAX_LOAD") == "Y" && $request->get("PAGEN_" . $curentAjaxBlock)) ? "Y" : "",

                "SORT_BY1" => $arParams["SORT_BY1"],
                "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                "SORT_BY2" => $arParams["SORT_BY2"],
                "SORT_ORDER2" => $arParams["SORT_ORDER2"],

                "FILTER_NAME" => $arParams["~FILTER_NAME"],
                "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                "CHECK_DATES" => $arParams["CHECK_DATES"],
                "STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],
                "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
                "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
                "SEARCH_PAGE" => ($arParams["USE_SEARCH"] == 'Y' ? $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"] : ''),

                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],

                "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                "SET_TITLE" => $arParams["SET_TITLE"],
                "SET_BROWSER_TITLE" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y",
                "MESSAGE_404" => $arParams["MESSAGE_404"],
                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                "SHOW_404" => $arParams["SHOW_404"],
                "FILE_404" => $arParams["FILE_404"],
                "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                "ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
                "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],

                "PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
                "PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                "INCLUDE_SUBSECTIONS" => "Y",

                "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                "MEDIA_PROPERTY" => $arParams["MEDIA_PROPERTY"],
                "SLIDER_PROPERTY" => $arParams["SLIDER_PROPERTY"],

                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

                "USE_RATING" => $arParams["USE_RATING"],
                "DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
                "MAX_VOTE" => $arParams["MAX_VOTE"],
                "VOTE_NAMES" => $arParams["VOTE_NAMES"],

                "USE_SHARE" => $arParams["LIST_USE_SHARE"],
                "SHARE_HIDE" => $arParams["SHARE_HIDE"],
                "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
                "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
                "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],

                "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
            ),
            $component
        ); ?>
        <?
        if ($request->get("AJAX_LOAD") == "Y" && $request->get("PAGEN_" . $curentAjaxBlock)) {
            die();
        }
        ?>
    </div>
</div>
</section>
