<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Акция");
?>
<?
$APPLICATION->IncludeComponent(
    "indexis:page.constructor",
    "",
    array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "SECTION_ID" => "58"
    )
);
?>
<? /* ?>
<section class="nb-top-banner-section nb-top-banner-section-promotions nb-top-banner-main">
    <div class="nb-breadcrumbs">
        <div class="container">
            <ul class="nb-breadcrumbs__list">
                <li class="nb-breadcrumbs__item"><a class="nb-breadcrumbs__link" href="/home.html">Главная</a></li>
                <li class="nb-breadcrumbs__item"><a class="nb-breadcrumbs__link" href="#">Услуги</a></li>
                <li class="nb-breadcrumbs__item"><a class="nb-breadcrumbs__link" href="#">Коронки для зубов</a></li>
                <li class="nb-breadcrumbs__item"><span class="nb-breadcrumbs__link">Керамические коронки e.max</span></li>
            </ul><a class="nb-breadcrumbs__back" href="#">На предыдущую страницу</a>
        </div>
    </div>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "promo",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "USE_SHARE" => "N",
            "SHARE_HIDE" => "N",
            "SHARE_TEMPLATE" => "",
            "SHARE_HANDLERS" => array("delicious"),
            "SHARE_SHORTEN_URL_LOGIN" => "",
            "SHARE_SHORTEN_URL_KEY" => "",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "services",
            "IBLOCK_ID" => Indexis::getIblockId("promotions"),
            "ELEMENT_ID" => "",
            "ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
            "CHECK_DATES" => "Y",
            "FIELD_CODE" => array(
                "ID", "NAME", "ACTIVE_TO", "PREVIEW_TEXT", "PREVIEW_TEXT_TYPE"
            ),
            "PROPERTY_CODE" => array(
                "NAME_PART_2"
            ),
            "IBLOCK_URL" => "/promos/",
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
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "ADD_ELEMENT_CHAIN" => "N",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "USE_PERMISSIONS" => "Y",
            "GROUP_PERMISSIONS" => array("1"),
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "CACHE_GROUPS" => "Y",
            "DISPLAY_TOP_PAGER" => "Y",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Акция",
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
    );
    ?>
</section>
<? /**/ ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>