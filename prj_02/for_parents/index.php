<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Для родителей");
?>
<? $APPLICATION->IncludeComponent(
    "bitrix:news.detail",
    "for_parents",
    array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "USE_SHARE" => "Y",
        "SHARE_HIDE" => "N",
        "SHARE_TEMPLATE" => "",
        "SHARE_HANDLERS" => array(""),
        "SHARE_SHORTEN_URL_LOGIN" => "",
        "SHARE_SHORTEN_URL_KEY" => "",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "pages",
        "IBLOCK_ID" => Indexis::getIblockId("for_parents", "pages"),
        "ELEMENT_ID" => "",
        "ELEMENT_CODE" => "dlya-roditeley",
        "CHECK_DATES" => "Y",
        "FIELD_CODE" => array("TAGS"),
        "PROPERTY_CODE" => array(
            "TEXT", "PICTURE", "HEADER_LEFT", "LIST_LEFT", "HEADER_RIGHT", "LIST_RIGHT", "PHOTOS", "TEXT_MEDIA"
        ),
        "IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
        "DETAIL_URL" => "",
        "SET_TITLE" => "Y",
        "SET_CANONICAL_URL" => "Y",
        "SET_BROWSER_TITLE" => "Y",
        "BROWSER_TITLE" => "-",
        "SET_META_KEYWORDS" => "Y",
        "META_KEYWORDS" => "-",
        "SET_META_DESCRIPTION" => "Y",
        "META_DESCRIPTION" => "-",
        "SET_STATUS_404" => "Y",
        "SET_LAST_MODIFIED" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "Y",
        "ADD_ELEMENT_CHAIN" => "N",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "USE_PERMISSIONS" => "N",
        "GROUP_PERMISSIONS" => array("1"),
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "Y",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Страница",
        "PAGER_TEMPLATE" => "",
        "PAGER_SHOW_ALL" => "Y",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "SHOW_404" => "Y",
        "MESSAGE_404" => "",
        "STRICT_SECTION_CHECK" => "Y",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "arrPager",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N"
    )
); ?>
<?/* ?>
<section class="search">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a id="search-modal-open">
                    <u>Открыть форму поиска</u>
                </a>
            </div>
        </div>
    </div>
</section>
<?*/ ?>
<?/*?>
<section class="search">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a id="search-modal-open">
                    <u>Показать</u>
                </a>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:search.form",
                    "modal",
                    array(
                        "URL_SEARCH" => "/search/",
                        //"PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],
                    ),
                    false
                ); ?>
            </div>
        </div>
    </div>
</section>
<?/**/ ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>