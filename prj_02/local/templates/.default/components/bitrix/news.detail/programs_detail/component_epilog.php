<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
$APPLICATION->IncludeComponent(
    "indexis:ajax.form",
    "cloudpayments_pay_form_objects",
    array(
        "IBLOCK_ID" => Indexis::getIblockId("pay_form", "requests", "s1"),
        "IBLOCK_TYPE" => "requests",
        "CUSTOM_NAME" => "Поддержать программу",
        "CHECK_CAPTCHA" => "Y",
        "FIELDS" => [
            "PREVIEW_TEXT" => ["CLEAR"],
            //"PROPERTY_PHONE" => ["CLEAR", "NOT_EMPTY", "PHONE"],
            "PROPERTY_EMAIL" => ["CLEAR", "NOT_EMPTY", "EMAIL"],
            //"PROPERTY_CATEGORY" => ["NOT_EMPTY", "LIST"],
            "PROPERTY_TYPE" => ["NOT_EMPTY", "LIST"],
            "PROPERTY_SUM" => ["CLEAR", "NOT_EMPTY", "NUMBER"],
        ],
        "RETURN_FIELDS" => [ /*"PROPERTY_PHONE",*/"PROPERTY_EMAIL", "PROPERTY_TYPE", /*"PROPERTY_CATEGORY",*/ "PROPERTY_SUM"],
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


<?
if ($arResult["ID_ANNOUNCEMENTS"] > 0 && $arResult["ID"] > 0) {
    global $detailNewsFilter;
    $detailNewsFilter = [
        "PROPERTY_PUBLICATION_TYPE" => $arResult["ID_ANNOUNCEMENTS"],
        "=PROPERTY_PROGRAM" => $arResult["ID"],
        "!PREVIEW_PICTURE" => false
    ];
?>
    <?php
    $announce = $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "programs_news_list_announce",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "ALL_NAME" => "Все мероприятия",
            "BLOCK_NAME" => "Анонсы мероприятий",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("news", "content", "s1"),
            "NEWS_COUNT" => "6",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "detailNewsFilter",
            "FIELD_CODE" => array("PREVIEW_PICTURE"),
            "PROPERTY_CODE" => array("AUDIENCE_TYPE", "FAMILY_PROJECTS", "SPECIALIST_PROJECTS"),
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
if (is_array($announce)) {
    if (count($announce) == 0) {
    ?>
        <script>
            $("#events_link").hide();
        </script>
<?
    }
}
?>

<? if (!empty($arResult["DISPLAY_PROPERTIES"]["FAMILY_PROJECTS"]["DISPLAY_VALUE"]) || !empty($arResult["DISPLAY_PROPERTIES"]["SPECIALIST_PROJECTS"]["DISPLAY_VALUE"])) { ?>
    <section id="projects-detail-who" class="projects-detail-who">
        <div class="container">
            <h3 class="section__title">Для кого работает программа</h3>
            <div class="items-list">

                <? if (!empty($arResult["DISPLAY_PROPERTIES"]["FAMILY_PROJECTS"]["DISPLAY_VALUE"])) { ?>
                    <div class="list-item projects-detail-who-item">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="projects-detail-who-item__content">
                                    <div class="h4 projects-detail-who-item__title">Проекты для семей</div>
                                    <ul class="text-size-lg projects-detail-who-item__list">
                                        <? foreach ($arResult["DISPLAY_PROPERTIES"]["FAMILY_PROJECTS"]["DISPLAY_VALUE"] as $num => $project) { ?>
                                            <li>
                                                <a href="<?= $arResult["DISPLAY_PROPERTIES"]["FAMILY_PROJECTS"]["DESCRIPTION"][$num] ?>">
                                                    <u><?= $project ?></u>
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
                                                        <use xlink:href="#drop-light"></use>
                                                    </svg>
                                                </a>
                                            </li>
                                        <? } ?>
                                    </ul>
                                    <div class="buttons-line">
                                        <a href="/projects/programma-doroga-k-domu/?pf-1=projectFilter_26_1330857165&set_filter=y&projectFilter_26_3596227959=Y&projectFilter_26_1330857165=Y" class="btn">Проекты для детей
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                                                <use xlink:href="#arrow"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="projects-detail-who-item__image-block">
                                    <picture class="projects-detail-who-item__image"><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/temp/99.jpg" loading="lazy" alt="Проекты для семей" title="Проекты для семей" />
                                    </picture>
                                    <picture class="projects-detail-who-item__pattern"><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/temp/101.png" loading="lazy" alt="" title="" />
                                    </picture>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>

                <? if (!empty($arResult["DISPLAY_PROPERTIES"]["SPECIALIST_PROJECTS"]["DISPLAY_VALUE"])) { ?>
                    <div class="list-item projects-detail-who-item">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="projects-detail-who-item__content">
                                    <div class="h4 projects-detail-who-item__title">Проекты, важные специалистам</div>
                                    <ul class="text-size-lg projects-detail-who-item__list">
                                        <? foreach ($arResult["DISPLAY_PROPERTIES"]["SPECIALIST_PROJECTS"]["DISPLAY_VALUE"] as $num => $project) { ?>
                                            <li>
                                                <a href="<?= $arResult["DISPLAY_PROPERTIES"]["SPECIALIST_PROJECTS"]["DESCRIPTION"][$num] ?>">
                                                    <u><?= $project ?></u>
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
                                                        <use xlink:href="#drop-light"></use>
                                                    </svg>
                                                </a>
                                            </li>
                                        <? } ?>
                                    </ul>
                                    <div class="buttons-line">
                                        <a href="/projects/programma-doroga-k-domu/?pf-1=projectFilter_26_3308380389&set_filter=y&projectFilter_26_3308380389=Y" class="btn">Проекты для специалистов
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                                                <use xlink:href="#arrow"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="projects-detail-who-item__image-block">
                                    <picture class="projects-detail-who-item__image"><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/temp/100.jpg" loading="lazy" alt="Проекты, важные специалистам" title="Проекты, важные специалистам" />
                                    </picture>
                                    <picture class="projects-detail-who-item__pattern"><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/temp/102.png" loading="lazy" alt="" title="" />
                                    </picture>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>

            </div>
        </div>
    </section>
<? } else { ?>
    <script>
        $("#who_link").hide();
    </script>
<? } ?>

<? if (!empty($arResult["DISPLAY_PROPERTIES"]["PROJECTS"]["VALUE"])) {
    global $detailProjectsFilter;
    $detailProjectsFilter = [
        "ID" => $arResult["DISPLAY_PROPERTIES"]["PROJECTS"]["VALUE"]
    ];
?>
    <?php
    $projects = $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "programs_projects_list",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("projects", "content", "s1"),
            "NEWS_COUNT" => "1000",
            "NEWS_COUNT_SHOW" => 4,
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "detailProjectsFilter",
            "FIELD_CODE" => array("PREVIEW_PICTURE", "PREVIEW_TEXT"),
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
        )
    );
    ?>
    <?
}
if (is_array($projects)) {
    if (count($projects) == 0) {
    ?>
        <script>
            $("#projects_link").hide();
        </script>
<? }
} ?>

<?
if ($arResult["ID_ANNOUNCEMENTS"] > 0 && $arResult["ID"] > 0) {
    global $detailNewsFilter;
    $detailNewsFilter = [
        "!PROPERTY_PUBLICATION_TYPE" => $arResult["ID_ANNOUNCEMENTS"],
        "=PROPERTY_PROGRAM" => $arResult["ID"],
        //"!PREVIEW_PICTURE" => false
    ];
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
            "BLOCK_NAME" => "Новости программы",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("news", "content", "s1"),
            "NEWS_COUNT" => "3",
            //"SORT_BY1" => "SORT",
            "SORT_BY1" => "PROPERTY_PUBLIC_DATE",
            "SORT_ORDER1" => "desc",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "detailNewsFilter",
            "FIELD_CODE" => array("PREVIEW_PICTURE"),
            "PROPERTY_CODE" => array("AUDIENCE_TYPE", "FAMILY_PROJECTS", "SPECIALIST_PROJECTS", "PUBLIC_DATE", "SHOW_TYPE", "BACKG_COLOR"),
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
            $("#news_link").hide();
        </script>
<?
    }
}
?>

<?php
if ($arResult["ID"] > 0) {
    global $detailMaterialFilter;
    $detailMaterialFilter = [
        "!PROPERTY_PUBLICATION_TYPE" => $arResult["ID_ANNOUNCEMENTS"],
        "=PROPERTY_PROGRAM" => $arResult["ID"],
        "!PREVIEW_PICTURE" => false
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
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("materials", "content", "s1"),
            "NEWS_COUNT" => "6",
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
            $("#materials_link").hide();
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
            <h2 class="h3 section__title">Партнеры программы</h2>
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
    if (count($partners) == 0) { ?>
        <script>
            $("#partners_link").hide();
        </script>
<? }
} ?>

<? $APPLICATION->IncludeComponent(
    "indexis:ajax.form",
    "good_man_callback",
    array(
        "IBLOCK_ID" => Indexis::getIblockId("good_man_callback", "requests", "s1"),
        "IBLOCK_TYPE" => "requests",
        "CREATE_LEAD" => "Как вырастить хорошего человека",
        "FIELDS" => [
            "NAME" => ["CLEAR", "NOT_EMPTY", "EMAIL"],
        ],
        "CHECK_CAPTCHA" => "Y",
        "SEND_MESSAGE" => "GOOD_MAN_CALLBACK",
    )
); ?>
<?
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/information_dissemination.php"
    )
); ?>