<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="row">
    <div class="col-lg-5">
        <aside class="dp-page__aside">
            <div class="dp-aside dp-sticky">
                <div class="h3 dp-aside__title"><? $APPLICATION->ShowProperty("PAGE_H3"); ?></div>
                <div class="dp-tags">
                    <?
                    $arFilterResult = $APPLICATION->IncludeComponent(
                        "bitrix:catalog.smart.filter",
                        "portfolio_tags",
                        //"bootstrap_v4",
                        array(
                            "COMPONENT_TEMPLATE" => "",
                            "IBLOCK_TYPE" => "content",
                            "IBLOCK_ID" => Indexis::getIblockId('portfolio', 'content'),
                            "SECTION_ID" => "",
                            "SECTION_CODE" => "",
                            "PREFILTER_NAME" => "",
                            "FILTER_NAME" => "arrFilterPortfolioTags",
                            "HIDE_NOT_AVAILABLE" => "N",
                            "TEMPLATE_THEME" => "blue",
                            "FILTER_VIEW_MODE" => "HORIZONTAL",
                            "DISPLAY_ELEMENT_COUNT" => "N",
                            "SEF_MODE" => "N",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "CACHE_GROUPS" => "Y",
                            "SAVE_IN_SESSION" => "N",
                            "INSTANT_RELOAD" => "Y",
                            "PAGER_PARAMS_NAME" => "arrPager",
                            "PRICE_CODE" => array(
                                0 => "BASE",
                            ),
                            "SHOW_ALL_WO_SECTION" => "Y",
                            "CONVERT_CURRENCY" => "N",
                            "XML_EXPORT" => "N",
                            "SECTION_TITLE" => "-",
                            "SECTION_DESCRIPTION" => "-",
                            "POPUP_POSITION" => "left",
                            "SEF_RULE" => "",
                            "SECTION_CODE_PATH" => "",

                            // Мои параметры -->
                            "SHOW_CODES" => array('OBJECT_TYPE'),
                            // <-- Мои параметры
                        ),
                        false
                    );
                    ?>
                </div>
            </div>
        </aside>
    </div>
    <div class="col-lg-19">
        <div class="dp-page__body">
            <?
            //vardump($GLOBALS['arrFilterPortfolioTags']);
            ?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "portfolio",
                array(
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "N",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => Indexis::getIblockId('portfolio', 'content'),
                    "NEWS_COUNT" => "9",
                    "SORT_BY1" => 'SORT',
                    "SORT_ORDER1" => 'ASC',
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "arrFilterPortfolioTags",
                    "FIELD_CODE" => array("ID", 'NAME', 'DETAIL_PAGE_URL', 'DETAIL_TEXT', 'DETAIL_PICTURE', 'PREVIEW_TEXT', 'PREVIEW_PICTURE'),
                    "PROPERTY_CODE" => array('PICTURE_CUSTOM_ORDER', 'YEAR', 'OBJECT_TYPE', 'CITY'),
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
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Подразделы",
                    "PAGER_SHOW_ALWAYS" => "Y",
                    "PAGER_TEMPLATE" => "show_more",
                    //"PAGER_TEMPLATE" => "",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
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
                    // <-- Мои параметры
                )
            ); ?>
        </div>
    </div>
</div>