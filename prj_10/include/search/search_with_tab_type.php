<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true); ?>

<?php
if(!empty($_GET['iblock_code']) ) {
    global $arFilterParamsByIblockCode;
    $arFilterParamsByIblockCode = [
        'iblock_'.$_GET['iblock_code'],
        'main'
    ];



$APPLICATION->IncludeComponent(
    "bitrix:search.page", "search-with-tab", array(
        "COMPONENT_TEMPLATE" => "search-with-tab",
        "arrFILTER" => $arFilterParamsByIblockCode,
        "arrFILTER_iblock_".$_GET['iblock_code'] => array(
            0 => Indexis::getIblockId($_GET['iblock_code']),
        ),
        "arrFILTER_main" => array("/about/","/partners/"),
        "arrWHERE" => $arFilterParamsByIblockCode,
        "TAGS_SORT" => "NAME",
        "TAGS_PAGE_ELEMENTS" => "3",
        "TAGS_PERIOD" => "3",
        "TAGS_URL_SEARCH" => "/search/index.php",
        "TAGS_INHERIT" => "Y",
        "FONT_MAX" => "50",
        "FONT_MIN" => "10",
        "COLOR_NEW" => "000000",
        "COLOR_OLD" => "C8C8C8",
        "PERIOD_NEW_TAGS" => "",
        "SHOW_CHAIN" => "Y",
        "COLOR_TYPE" => "Y",
        "WIDTH" => "100%",
        "USE_SUGGEST" => "Y",
        "SHOW_RATING" => "N",
        "PATH_TO_USER_PROFILE" => "",
        "AJAX_MODE" => "N",
        "RESTART" => "Y",
        "NO_WORD_LOGIC" => "N",
        "USE_LANGUAGE_GUESS" => "Y",
        "CHECK_DATES" => "Y",
        "USE_TITLE_RANK" => "Y",
        "DEFAULT_SORT" => "rank",
        "SHOW_WHERE" => "Y",
        "SHOW_WHEN" => "N",
        "PAGE_RESULT_COUNT" => "8",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Результаты поиска",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "",
        "AJAX_OPTION_SHADOW" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
    ), false);
} else {
    $APPLICATION->IncludeComponent(
        "bitrix:search.page", "search-with-tab", array(
        "COMPONENT_TEMPLATE" => "search-with-tab",
        "arrFILTER" => array(
            'main',
            'iblock_movies',
            'iblock_contests',
        ),
        "arrFILTER_iblock_movies" => array(
            0 => Indexis::getIblockId('movies'),
        ),
        "arrFILTER_iblock_contests" => array(
            0 => Indexis::getIblockId('contests'),
        ),
        "arrFILTER_main" => array("/about/","/partners/"),
        "arrWHERE" => $arFilterParamsByIblockCode,
        "TAGS_SORT" => "NAME",
        "TAGS_PAGE_ELEMENTS" => "3",
        "TAGS_PERIOD" => "3",
        "TAGS_URL_SEARCH" => "/search/index.php",
        "TAGS_INHERIT" => "Y",
        "FONT_MAX" => "50",
        "FONT_MIN" => "10",
        "COLOR_NEW" => "000000",
        "COLOR_OLD" => "C8C8C8",
        "PERIOD_NEW_TAGS" => "",
        "SHOW_CHAIN" => "Y",
        "COLOR_TYPE" => "Y",
        "WIDTH" => "100%",
        "USE_SUGGEST" => "Y",
        "SHOW_RATING" => "N",
        "PATH_TO_USER_PROFILE" => "",
        "AJAX_MODE" => "N",
        "RESTART" => "Y",
        "NO_WORD_LOGIC" => "N",
        "USE_LANGUAGE_GUESS" => "Y",
        "CHECK_DATES" => "Y",
        "USE_TITLE_RANK" => "Y",
        "DEFAULT_SORT" => "rank",
        "SHOW_WHERE" => "Y",
        "SHOW_WHEN" => "N",
        "PAGE_RESULT_COUNT" => "8",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Результаты поиска",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "",
        "AJAX_OPTION_SHADOW" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        ), false
    );
}