<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
    <section id="news-detail-hidden-nav" class="news-detail-hidden-nav">
        <div class="container">
            <div class="buttons-line"><a href="#news-help" data-scroll-to="#news-help" class="btn btn-help">Поддержать
                    фонд</a><a href="#news-detail-share" data-scroll-to="#news-detail-share" class="btn btn-share">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         class="icon icon-share">
                        <use xlink:href="#share"></use>
                    </svg>
                </a></div>
        </div>
    </section>

<?
$APPLICATION->IncludeComponent(
    "indexis:ajax.form",
    "cloudpayments_pay_form_news",
    array(
        "IBLOCK_ID" => Indexis::getIblockId("pay_form", "requests", "s1"),
        "IBLOCK_TYPE" => "requests",
        "FIELDS" => [
            "PROPERTY_SUM" => ["CLEAR", "NOT_EMPTY", "NUMBER"],
        ],
        "CHECK_CAPTCHA" => "Y",
        "RETURN_FIELDS" => ["PROPERTY_SUM", "PROPERTY_TYPE"],
        "HANDLERS" => [
            "ACTIVE" => "N",
            "NAME" => htmlspecialcharsbx($APPLICATION->GetCurPage()),
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
);
?>
<? /* $APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => "standard.php",
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/news_page/donation.php"
    ),
    false
); */ ?>
<?
// Текущий элемент -->
$arCurElement = array();
if (intval($arResult["ID"]) > 0) {
    $arSelect = false;
    $arFilter = array("ID" => $arResult["ID"]);
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arCurElement = $ob->GetFields();
        $arCurElement["PROPERTIES"] = $ob->GetProperties();
    }
}
// <-- Текущий элемент

// Блок “Другие новости” - в блоке выводятся ближайшие по дате публикации с таким же значением свойства “тема” -->
if (!empty($arCurElement)) {
    $days = 3;
    $GLOBALS["detailNewsFilter"]["!ID"] = $arCurElement["ID"];
    if (strlen($arCurElement["DATE_ACTIVE_FROM"]) > 0) {
        $GLOBALS["detailNewsFilter"][">=DATE_ACTIVE_FROM"] = date(
            $DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")),
            (strtotime($arCurElement["DATE_ACTIVE_FROM"]) - $days * 86400)
        );
        $GLOBALS["detailNewsFilter"]["<=DATE_ACTIVE_FROM"] = date(
            $DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")),
            (strtotime($arCurElement["DATE_ACTIVE_FROM"]) + $days * 86400)
        );
    }
    if (strlen($arCurElement["PROPERTIES"]["PUBLICATION_TYPE"]["VALUE_ENUM_ID"]) > 0) {
        $GLOBALS["detailNewsFilter"]["PROPERTY_PUBLICATION_TYPE"] =
            $arCurElement["PROPERTIES"]["PUBLICATION_TYPE"]["VALUE_ENUM_ID"];
    }
}
//vardump($GLOBALS["detailNewsFilter"]);
// <-- 
?>
<?
$HEADER = "Другие новости";
$MORE_LINK_TITLE = "Больше новостей";
$IBLOCK_ID = Indexis::getIblockId("news", "content", "s1");
if ($arParams["TYPE_IBLOCK"] == "media") {
    $HEADER = "Другие материалы";
    $MORE_LINK_TITLE = "Больше медиа";
    $IBLOCK_ID = Indexis::getIblockId("materials", "content", "s1");
}
?>
<?
$news = $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "news_slider",
    array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "ALL_NAME" => "Все новости",
        "BLOCK_NAME" => "Новости проекта",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => $IBLOCK_ID,
        "NEWS_COUNT" => "100",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "detailNewsFilter",
        "FIELD_CODE" => array("PREVIEW_PICTURE"),
        "PROPERTY_CODE" => array("PUBLIC_DATE", "PUBLICATION_TYPE", "SHOW_TYPE"),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d F Y",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_LAST_MODIFIED" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "360000",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "Y",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "HEADER" => $HEADER,
        "MORE_LINK_TITLE" => $MORE_LINK_TITLE,
        //"MORE_LINK_URL" => "/news/",
    )
);
?>
<?
// Сопоставляться должны значения свойства “Тип аудитории” у публикации и значения свойства “Тип благополучателей” у проекта. -->
if (!empty($arCurElement)) {
    //vardump($arCurElement["PROPERTIES"]["AUDIENCE_TYPE"]);

    if (!is_array($arCurElement["PROPERTIES"]["AUDIENCE_TYPE"]["VALUE"]))
        $arCurElement["PROPERTIES"]["AUDIENCE_TYPE"]["VALUE"] = [$arCurElement["PROPERTIES"]["AUDIENCE_TYPE"]["VALUE"]];
    if (!empty($arCurElement["PROPERTIES"]["AUDIENCE_TYPE"]["VALUE"])) {

        $obj = CIBlockPropertyEnum::GetList(
            array(),
            array(
                "IBLOCK_ID" => Indexis::getIblockId("projects", "content", "s1"),
                "XML_ID" => $arCurElement["PROPERTIES"]["AUDIENCE_TYPE"]["VALUE"]
            )
        );
        $ar = $obj->GetNext();
        $val = $ar["ID"];

        if (intval($val) > 0) {
            $GLOBALS["detailProjectsFilter"]["PROPERTY_BENEFICIARY_TYPE"] = $val;
        }
    }
}
// <--
//vardump($GLOBALS["detailProjectsFilter"]);
?>
    <section class="news-detail-projects">
        <?
        $news = $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "news_detail_projects",
            array(
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "ALL_NAME" => "Все новости",
                "BLOCK_NAME" => "Новости проекта",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => Indexis::getIblockId("projects", "content", "s1"),
                "NEWS_COUNT" => "3",
                "SORT_BY1" => "RAND",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "detailProjectsFilter",
                "FIELD_CODE" => array("PREVIEW_PICTURE"),
                "PROPERTY_CODE" => array("CITY", "BENEFICIARY_TYPE"),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d F Y",
                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_LAST_MODIFIED" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "360000",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "Y",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "Y",
                "SET_STATUS_404" => "N",
                "SHOW_404" => "N",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "URL_ALL_PROJECTS" => "/projects/",
            )
        );
        ?>
    </section>
<?
if ($arParams["TYPE_IBLOCK"] == "news") {
    $GLOBALS["detailMaterialsFilter"]["PROPERTY_PROJECT"] = $arCurElement["PROPERTIES"]["PROJECT"]["VALUE"];
    ?>
    <?
    $news = $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "news_slider",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "ALL_NAME" => "Все новости",
            "BLOCK_NAME" => "Новости проекта",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("materials", "content", "s1"),
            "NEWS_COUNT" => "10",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "detailMaterialsFilter",
            "FIELD_CODE" => array("PREVIEW_PICTURE"),
            "PROPERTY_CODE" => array("PUBLIC_DATE", "PUBLICATION_TYPE", "SHOW_TYPE", "BACKG_COLOR"),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "d F Y",
            "SET_TITLE" => "N",
            "SET_BROWSER_TITLE" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "360000",
            "CACHE_FILTER" => "Y",
            "CACHE_GROUPS" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => "Новости",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "",
            "PAGER_DESC_NUMBERING" => "Y",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_BASE_LINK_ENABLE" => "Y",
            "SET_STATUS_404" => "N",
            "SHOW_404" => "N",
            "MESSAGE_404" => "",
            "PAGER_BASE_LINK" => "",
            "PAGER_PARAMS_NAME" => "",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "HEADER" => "Материалы по теме",
            "MORE_LINK_TITLE" => "Больше медиа",
            //"MORE_LINK_URL" => "/media/",
        )
    );
    ?>
<? } ?>