<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<section class="wrapper wrapper--bg rs__subscribe--idea">
    <div class="container">
        <div class="rs__content">
            <div class="rs__subscribe--box">
                <div class="rs__subscribe--block">
                    <div class="rs__subscribe--title">Есть идея? Опиши ее и отправь нашим кураторам!</div>
                    <div class="rs__subscribe--info">
                        <div class="rs__subscribe--text">Мы всегда рады рассмотреть идеи наших пользователей! Мы
                            очень
                            ценим участие детей в нашей работе и всегда открыты ко всему новому!
                        </div>
                        <div class="rs__button__default rs__button--icon ico-arrow-main rs__button--icon-right rs__button__default--clear">
                            <a href="/contacts/">У меня есть идея!</a>
                        </div>
                    </div>
                </div>
                <picture class="rs__subscribe--pic">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/svg/p.svg" class="rs__subscribe--img">
                </picture>
            </div>
        </div>
    </div>
</section>

<?
if ($arResult["ID"] > 0) {
    global $detailNewsFilter;
    $detailNewsFilter = [
        "=PROPERTY_PROJECT" => $arResult["ID"],
    ];
    ?>
    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "programs_news_list",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "ALL_NAME" => "Все новости",
            "BLOCK_NAME" => "Новости проекта",
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
                "AUDIENCE_TYPE", "FAMILY_PROJECTS", "SPECIALIST_PROJECTS", "SHOW_TYPE", "PUBLICATION_TYPE",
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
}
?>

<?
if ($arResult["ID"] > 0) {
    global $detailNewsFilter;
    $detailNewsFilter = [
        "=PROPERTY_PROJECT" => $arResult["ID"],
    ];
    ?>
    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "programs_materials_list",
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
            "NEWS_COUNT" => "3",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "detailNewsFilter",
            "FIELD_CODE" => array("PREVIEW_PICTURE"),
            "PROPERTY_CODE" => array(
                "PROJECT", "PUBLICATION_TYPE"
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
}
?>


<? if (!empty($arResult["DISPLAY_PROPERTIES"]["PARTNERS"]["VALUE"])) {
    global $detailPartnersFilter;
    $detailPartnersFilter = [
        "ID" => $arResult["DISPLAY_PROPERTIES"]["PARTNERS"]["VALUE"]
    ];
    ?>
            <? $partners = $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "project_partners",
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
<? } ?>

<?php
if ($arResult["ID"] > 0) {
    global $teamFilter;
    $teamFilter = [
        "=PROPERTY_PROJECT_LINK" => $arResult["ID"]
    ];
    ?>
    <?php
    $members = $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "team",
        array(
            "CURRENT_PROJECT" => $arResult["ID"],
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
            "PROPERTY_CODE" => array("PHONE", "PROJECT_LINK", "PROJECT_POSITION", "POSITION", "EMAIL"),
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
?>

<?$APPLICATION->IncludeComponent(
    "indexis:ajax.form",
    "sucess_path_callback",
    Array(
        "CHECK_CAPTCHA" => "Y",
        "IBLOCK_ID" => Indexis::getIblockId("callback_path", "requests", "s2"),
        "IBLOCK_TYPE" => "requests",
        "FIELDS" => [
            "NAME" => ["CLEAR","NOT_EMPTY","TEXT"],
            "PROPERTY_PHONE" => ["CLEAR","NOT_EMPTY","PHONE"],
            "PROPERTY_EMAIL" => ["CLEAR","NOT_EMPTY","EMAIL"],
            "PREVIEW_TEXT" => ["CLEAR","NOT_EMPTY","TEXT"],
        ],
        "SEND_MESSAGE" => "CALLBACK_PATH",
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
);?>

<?//Хороший человек?>
<?$APPLICATION->IncludeComponent(
    "indexis:ajax.form",
    "sucess_path_good_man_callback",
    Array(
        "IBLOCK_ID" => Indexis::getIblockId("good_man_callback", "requests", "s1"),
        "IBLOCK_TYPE" => "requests",
        "FIELDS" => [
            "NAME" => ["CLEAR","NOT_EMPTY","EMAIL"],
        ],
        "HANDLERS" => [
            "SOURCE" => "Путь к успеху",
            "AGREEMENT" => [
                "method_name" => "check_value",
                "method_params" => [
                    "VALUE" => "y",
                    "TO" => "MAIN",
                    "ERROR" => "Необходимо принять условия политики конфидициальности",
                ]
            ]
        ],
        "CHECK_CAPTCHA" => "Y",
        "SEND_MESSAGE" => "GOOD_MAN_CALLBACK",
    )
);?>