<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>


<?
$bShow = $arResult["ID"] != 25687 && $arResult["ID"] != 25771;
if ($arResult["DISPLAY_PROPERTIES"]["STATUS"]["VALUE_XML_ID"] == "closed") {
    $bShow = false;
}

if ($bShow) {
    $APPLICATION->IncludeComponent(
        "indexis:ajax.form",
        "cloudpayments_pay_form_objects",
        array(
            "IBLOCK_ID" => Indexis::getIblockId("pay_form", "requests", "s1"),
            "IBLOCK_TYPE" => "requests",
            "FIELDS" => [
                "PREVIEW_TEXT" => ["CLEAR"],
                //"PROPERTY_PHONE" => ["CLEAR", "NOT_EMPTY", "PHONE"],
                "PROPERTY_EMAIL" => ["CLEAR", "NOT_EMPTY", "EMAIL"],
                //"PROPERTY_CATEGORY" => ["NOT_EMPTY", "LIST"],
                "PROPERTY_TYPE" => ["NOT_EMPTY", "LIST"],
                "PROPERTY_SUM" => ["CLEAR", "NOT_EMPTY", "NUMBER"],
            ],
            "CHECK_CAPTCHA" => "Y",
            "RETURN_FIELDS" => [/*"PROPERTY_PHONE",*/"PROPERTY_EMAIL", "PROPERTY_TYPE", /*"PROPERTY_CATEGORY",*/ "PROPERTY_SUM"],
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
            'CUSTOM_NAME' => 'Поддержать акцию',
        )
    );
}
?>

<? if (!empty($arResult["DISPLAY_PROPERTIES"]["HOW_WE_HELP"]["DISPLAY_VALUE"])) {
    $count = intdiv(count($arResult["DISPLAY_PROPERTIES"]["HOW_WE_HELP"]["DISPLAY_VALUE"]), 2);
    $h3 = "Как мы помогаем";
    if ($arResult["ID"] == 25687) {
        $h3 = "Основные правила";
    }
    if ($arResult["ID"] == 25771) {
        $h3 = "Что мы делаем для специалистов";
    }
?>
    <section id="projects-detail-how-we-help" class="projects-detail-how-we-help">
        <div class="container">
            <h3 class="section__title"><?= $h3 ?></h3>
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-size-lg">
                        <ul>
                            <? for ($i = 0; $i < $count; $i++) { ?>
                                <li><?= $arResult["DISPLAY_PROPERTIES"]["HOW_WE_HELP"]["DISPLAY_VALUE"][$i]; ?>
                                </li>
                            <? } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-size-lg">
                        <ul>
                            <? for ($i = $count; $i < count($arResult["DISPLAY_PROPERTIES"]["HOW_WE_HELP"]["DISPLAY_VALUE"]); $i++) { ?>
                                <li><?= $arResult["DISPLAY_PROPERTIES"]["HOW_WE_HELP"]["DISPLAY_VALUE"][$i]; ?>
                                </li>
                            <? } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="section__nav">
                <?
                $text = "Обратиться за помощью";
                $href = "/contacts/";
                $data_scroll_to = "";
                if ($arResult["ID"] == 25687) {
                    $text = "Получить консультацию";
                }
                if ($arResult["ID"] == 25771) {
                    $text = "Связаться с нами";
                    $href = "#write_us_callback_form";
                    $data_scroll_to = 'data-scroll-to="#write_us_callback_form"';
                }
                ?>
                <? if ($arResult["ID"] != 25687) { ?>
                    <div class="buttons-line"><a href="<?= $href; ?>" <?= $data_scroll_to ?> class="btn"><?= $text; ?></a></div>
                <? } ?>
            </div>
        </div>
    </section>
<? } ?>

<? if (!empty($arResult["DISPLAY_PROPERTIES"]["GALERY"]["DISPLAY_VALUE"])) { ?>
    <section id="projects-detail-gallery" class="projects-detail-gallery">
        <div class="container">
            <div class="projects-detail-gallery-slider">
                <div class="section__head">
                    <h3 class="section__title">Галерея</h3>
                    <div class="section__nav">
                        <div class="swiper-nav lg">
                            <button type="button" class="swiper-button prev">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
                                    <use xlink:href="#drop-light"></use>
                                </svg>
                            </button>
                            <button type="button" class="swiper-button next">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
                                    <use xlink:href="#drop-light"></use>
                                </svg>
                            </button>
                        </div>
                        <div class="swiper-nav">
                            <button type="button" class="swiper-button prev">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop">
                                    <use xlink:href="#drop"></use>
                                </svg>
                            </button>
                            <button type="button" class="swiper-button next">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop">
                                    <use xlink:href="#drop"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="items-list swiper-container">
                    <div class="swiper-wrapper">
                        <? foreach ($arResult["DISPLAY_PROPERTIES"]["GALERY"]["VALUE"] as $fileID) {
                            $arFile = CFile::GetFileArray($fileID);
                        ?>
                            <? if (substr($arFile["CONTENT_TYPE"], 0, 6) != "image/") { ?>
                                <div class="swiper-slide">
                                    <a href="<?= $arFile["SRC"] ?>" data-fancybox="projects-detail-gallery" class="list-item projects-detail-gallery-item video">
                                        <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/play.png" loading="lazy" alt="<?= $arFile["FILE_NAME"] ?>" title="<?= $arFile["FILE_NAME"] ?>" />
                                        </picture>
                                        <div class="projects-detail-gallery-item__play">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-triangle">
                                                <use xlink:href="#triangle"></use>
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            <? } else { ?>
                                <div class="swiper-slide">
                                    <a href="<?= $arFile["SRC"] ?>" data-fancybox="projects-detail-gallery" class="list-item projects-detail-gallery-item">
                                        <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arFile["SRC"] ?>" loading="lazy" alt="<?= $arFile["FILE_NAME"] ?>" title="<?= $arFile["FILE_NAME"] ?>" />
                                        </picture>
                                    </a>
                                </div>
                            <? } ?>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? } ?>

<?
if ($arResult["ID"] > 0) {
    global $detailNewsFilter;
    $detailNewsFilter = [
        "=PROPERTY_EVENT" => $arResult["ID"],
        //"!PREVIEW_PICTURE" => false
    ];
    //vardump($detailNewsFilter);
?>
    <?php
    $news = $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "programs_news_list",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "ALL_NAME" => "Все новости",
            "BLOCK_NAME" => "Новости акции",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("news", "content", "s1"),
            "NEWS_COUNT" => "3",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "detailNewsFilter",
            "FIELD_CODE" => array("PREVIEW_PICTURE"),
            "PROPERTY_CODE" => array(
                "AUDIENCE_TYPE", "SHOW_TYPE", "PUBLICATION_TYPE",
                "PUBLIC_DATE", "BACKG_COLOR"
            ),
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
        )
    );
    ?>
    <?
}
if (is_array($news)) {
    if (count($news) == 0) {
    ?>
        <script>
            $(".news_link").hide();
        </script>
<?
    }
}
?>


<?php
if ($arResult["ID"] > 0) {
    global $detailMaterialFilter;
    $detailMaterialFilter = [
        "=PROPERTY_EVENT" => $arResult["ID"],
        //"!PROPERTY_PUBLICATION_TYPE" => $arResult["ID_ANNOUNCEMENTS"],
        //"!PREVIEW_PICTURE" => false
    ];
?>
    <?php
    $materials = $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "programs_material_list",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "BLOCK_NAME" => "Материалы",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("materials", "content", "s1"),
            "NEWS_COUNT" => "3",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "detailMaterialFilter",
            "FIELD_CODE" => array("PREVIEW_PICTURE"),
            "PROPERTY_CODE" => array("TYPE"),
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
        )
    );
    ?>
    <?
}
if (is_array($materials)) {
    if (count($materials) == 0) {
    ?>
        <script>
            $(".materials_link").hide();
        </script>
<?
    }
}
?>


<? if (!empty($arResult["DISPLAY_PROPERTIES"]["PARTNERS"]["VALUE"])) {
    global $detailPartnersFilter;
    $detailPartnersFilter = [
        "ID" => $arResult["DISPLAY_PROPERTIES"]["PARTNERS"]["VALUE"]
    ];
?>
    <section id="main-partners" class="main-partners">
        <div class="container">
            <h2 class="h3 section__title">Партнеры акции</h2>
            <? $partners = $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "common_partner_reviews",
                array(
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => Indexis::getIblockId("partners", "content", "s1"),
                    "NEWS_COUNT" => "20",
                    "SORT_BY1" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "ACTIVE_FROM",
                    "SORT_ORDER2" => "DESC",
                    "FILTER_NAME" => "detailPartnersFilter",
                    "FIELD_CODE" => array("PREVIEW_PICTURE"),
                    "PROPERTY_CODE" => array("POSTION"),
                    "CHECK_DATES" => "Y",
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
                )
            ); ?>
        </div>
    </section>
<? } ?>
<?
if (is_array($partners)) {
    if (is_array($partners)) {
        if (count($partners) == 0) { ?>
            <script>
                $(".partners_link").hide();
            </script>
<? }
    }
} ?>


<?php
if ($arResult["ID"] > 0) {
    global $teamFilter;
    $teamFilter = [
        "=PROPERTY_EVENT_LINK" => $arResult["ID"]
    ];
    //vardump($teamFilter);
?>
    <?php
    $header = "Команда акции";
    if ($arResult["ID"] == 25771) {
        $header = "Команда";
    }
    $members = $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "team_event",
        array(
            "CURRENT_EVENT" => $arResult["ID"],
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("specialists", "content", "s1"),
            "NEWS_COUNT" => "999",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "teamFilter",
            "FIELD_CODE" => array("PREVIEW_PICTURE"),
            "PROPERTY_CODE" => array("PHONE", "EVENT_LINK", "EVENT_POSITION", "POSITION", "EMAIL"),
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
            "HEADER" => $header,
        )
    );
    ?>
    <?
}
if (is_array($members)) {
    if (count($members) == 0) {
    ?>
        <script>
            $(".team_link").hide();
        </script>
<?
    }
}
?>
<? $APPLICATION->IncludeComponent(
    "indexis:ajax.form",
    "write_us_callback",
    array(
        "IBLOCK_ID" => Indexis::getIblockId("write_us_callback", "requests", "s1"),
        "IBLOCK_TYPE" => "requests",
        "CREATE_LEAD" => "Написать нам",
        "FIELDS" => [
            "NAME" => ["CLEAR", "NOT_EMPTY", "TEXT"],
            "PROPERTY_EMAIL" => ["CLEAR", "NOT_EMPTY", "TEXT", "EMAIL"],
            "PROPERTY_PHONE" => ["CLEAR", "NOT_EMPTY", "PHONE"],
            "PREVIEW_TEXT" => ["CLEAR", "NOT_EMPTY", "TEXT"],
            "PROPERTY_TYPE" => ["NOT_EMPTY", "LIST"]
        ],
        "CHECK_CAPTCHA" => "Y",
        "SEND_MESSAGE" => "WRITE_US_CALLBACK",
        "HANDLERS" => [
            "PROPERTY_PROJECT" => $arResult["NAME"],
            "AGREEMENT" => [
                "method_name" => "check_value",
                "method_params" => [
                    "VALUE" => "y",
                    "TO" => "MAIN",
                    "ERROR" => "Необходимо принять условия политики конфидициальности",
                ]
            ]
        ],
        "ANCHOR" => "write_us_callback_form",
    )
); ?>