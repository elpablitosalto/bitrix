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

<div class="page-head">
    <div class="container">
        <? $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "",
            array(),
            false
        ); ?>
        <h1 class="page-title"><? $APPLICATION->ShowTitle(false) ?></h1>
    </div>
</div>
<div class="page-content projects-page">

    <section class="projects-main">
        <div class="container">
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
                "events_menu",
                $sectionListParams,
                $component,
                ($arParams["SHOW_TOP_ELEMENTS"] !== "N" ? array("HIDE_ICONS" => "Y") : array())
            );
            ?>
            <?
            unset($sectionListParams);
            ?>

            <?
            if (intval($arResult["VARIABLES"]["SECTION_ID"]) > 0 || '' != $arResult["VARIABLES"]["SECTION_CODE"]) {
                $arFilter = array(
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "ACTIVE" => "Y",
                    "GLOBAL_ACTIVE" => "Y",
                );
                if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
                    $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
                elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
                    $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

                $obCache = new CPHPCache();
                if ($obCache->InitCache(360000, serialize($arFilter), "/iblock/catalog")) {
                    $arCurSection = $obCache->GetVars();
                } elseif ($obCache->StartDataCache()) {
                    $arCurSection = array();
                    if (Loader::includeModule("iblock")) {
                        $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID", "NAME"));

                        if (defined("BX_COMP_MANAGED_CACHE")) {
                            global $CACHE_MANAGER;
                            $CACHE_MANAGER->StartTagCache("/iblock/catalog");

                            if ($arCurSection = $dbRes->Fetch())
                                $CACHE_MANAGER->RegisterTag("iblock_id_" . $arParams["IBLOCK_ID"]);

                            $CACHE_MANAGER->EndTagCache();
                        } else {
                            if (!$arCurSection = $dbRes->Fetch())
                                $arCurSection = array();
                        }
                    }
                    $obCache->EndDataCache($arCurSection);
                }
            }
            if (!isset($arCurSection))
                $arSection = array();

            //добавляем ручками, т.к. на детальной нужно указывать раздел через который пришли, а не который главный у элемента
            if (mb_strlen($arCurSection["NAME"]))
                $APPLICATION->AddChainItem($arCurSection["NAME"],  "");
            ?>

            <div class="projects-controls">
                <div class="row">
                    <div class="col-sm-6 col-lg-8">
                        <button type="button" data-toggle-activity="#projects-filter" class="btn projects-filter__toggler<? if ($arParams["SET_FILTER"] == "Y") echo " active"; ?>"><span class="txt-show">Фильтры</span><span class="txt-hide">Скрыть фильтры</span>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-filter">
                                <use xlink:href="#filter"></use>
                            </svg>
                        </button>
                    </div>
                    <div class="col-sm-6 col-lg-4">
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
                                    "PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],
                                ),
                                $component
                            ); ?>
                        <? } else { ?>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:search.form",
                                "",
                                array(
                                    "PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],
                                ),
                                $component
                            ); ?>
                        <? } ?>
                    </div>
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.smart.filter",
                        "events_filter",
                        array(
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "SECTION_ID" => $arCurSection['ID'],
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
                $GLOBALS['APPLICATION']->RestartBuffer();
            }
            $NEWS_COUNT = $arParams["NEWS_COUNT"];
            if (
                $GLOBALS['SORT_BY_SEARCH_RESULT'] == 'Y'
                && !empty($GLOBALS[$arParams["~FILTER_NAME"]]["=ID"])
                && is_array($GLOBALS[$arParams["~FILTER_NAME"]]["=ID"])
            ) {
                $NEWS_COUNT = '25';
            }          ?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "events",
                array(

                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "NEWS_COUNT" => $NEWS_COUNT,
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


            <script>
                $(document).ready(function() {
                    LoadImagesLazy();
                });
            </script>

        </div>
    </section>

    <? $APPLICATION->IncludeComponent(
        "indexis:ajax.form",
        "good_man_callback",
        array(
            "CHECK_CAPTCHA" => "Y",
            "CREATE_LEAD" => "Как вырастить хорошего человека",
            "IBLOCK_ID" => Indexis::getIblockId("good_man_callback", "requests", "s1"),
            "IBLOCK_TYPE" => "requests",
            "FIELDS" => [
                "NAME" => ["CLEAR", "NOT_EMPTY", "EMAIL"],
            ],
            "SEND_MESSAGE" => "GOOD_MAN_CALLBACK",
            "HANDLERS" => [
                "AGREEMENT" => [
                    "method_name" => "check_value",
                    "method_params" => [
                        "VALUE" => "y",
                        "TO" => "MAIN",
                        "ERROR" => "Необходимо принять условия политики конфидициальности",
                    ]
                ]
            ],
        )
    ); ?>

</div>