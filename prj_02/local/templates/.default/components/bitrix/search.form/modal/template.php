<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->setFrameMode(true); ?>

<div id="search-modal">
    <div class="container">
        <div class="search-modal__header">
            <div class="h1 text-color-orange">Поиск по сайту</div>
            <button id="search-modal-close">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-close">
                    <use xlink:href="#close"></use>
                </svg>
            </button>
        </div>
        <div class="search-line">
            <form action="/search/">
                <input name="q" placeholder="Поиск" value="" class="search-line__input">
                <button class="search-line__loupe" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-loupe">
                        <use xlink:href="#loupe"></use>
                    </svg>
                </button>
                <button class="search-line__close">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-close">
                        <use xlink:href="#close"></use>
                    </svg>
                </button>
            </form>
        </div>
        <?/* $APPLICATION->IncludeComponent(
            "indexis:search.tags.cloud",
            "modal",
            array(
                "FONT_MAX" => "50",
                "FONT_MIN" => "10",
                "COLOR_NEW" => "3E74E6",
                "COLOR_OLD" => "C0C0C0",
                "PERIOD_NEW_TAGS" => "",
                "SHOW_CHAIN" => "Y",
                "COLOR_TYPE" => "Y",
                "WIDTH" => "100%",
                "SORT" => "NAME",
                "PAGE_ELEMENTS" => "150",
                "PERIOD" => "",
                //"URL_SEARCH" => "/search/index.php",
                //"URL_SEARCH" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],
                //"URL_SEARCH" => $arResult["FOLDER"],
                "URL_SEARCH" => $arParams["URL_SEARCH"],
                "TAGS_INHERIT" => "Y",
                "CHECK_DATES" => "Y",
                "FILTER_NAME" => "searchFilter",
                "arrFILTER" => array("no"),
                "CACHE_TYPE" => "N",
                "CACHE_TIME" => "3600",
                "TYPE_PAGE" => "section",
            ),
            $component
        ); */?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "popular_search_phrases",
            array(
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => "system",
                "IBLOCK_ID" => Indexis::getIblockId("popular_search_phrases"),
                "NEWS_COUNT" => "20",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "NAME",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array("ID"),
                "PROPERTY_CODE" => array(""),
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
                "DISPLAY_TOP_PAGER" => "Y",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "Y",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "Y",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "PAGER_BASE_LINK_ENABLE" => "Y",
                "SET_STATUS_404" => "Y",
                "SHOW_404" => "Y",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",

                "URL_SEARCH" => $arParams["URL_SEARCH"],
            )
        ); ?>
    </div>
</div>