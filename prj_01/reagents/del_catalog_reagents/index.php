<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Реагенты для биохимических анализаторов Dirui");
?>

<section class="header-top-banner">
    <div class="header-top-banner__head">
        <h2 class="header-top-banner__title"><? $APPLICATION->ShowTitle(false) ?></h2>
        <div class="header-top-banner__btns"><a href="/catalog/" class="header-top-banner__btn btn btn--large btn--rose">Каталог</a>
        </div>
    </div>
    <div class="header-top-banner__content">
        <div class="header-top-banner__video">
            <div class="header-top-banner__pause"><img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/pause.svg"></div>
            <div class="header-top-banner__play"><img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/play.png"></div>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/catalog_reagents/video.php"
                )
            ); ?>
        </div>
    </div>
</section>
<section class="bookmarks-table">
    <? $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "reagents_sections",
        array(
            "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "",
            "VIEW_MODE" => "TEXT",
            "SHOW_PARENT_NAME" => "Y",
            "IBLOCK_TYPE" => "1c_catalog",
            "IBLOCK_ID" => Indexis::getIblockId("reagents", "1c_catalog", "s1"),
            "SECTION_ID" => "",
            "SECTION_CODE" => "",
            "SECTION_URL" => "",
            "COUNT_ELEMENTS" => "Y",
            "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
            "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
            "TOP_DEPTH" => "2",
            "SECTION_FIELDS" => "",
            "SECTION_USER_FIELDS" => "",
            "ADD_SECTIONS_CHAIN" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_NOTES" => "",
            "CACHE_GROUPS" => "Y",
            "CUSTOM_SECTION_SORT" => ["SORT" => "ASC", "ID" => "ASC"]
        )
    ); ?>

    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "reagents_elements",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "ALL_NAME" => "Все новости",
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => Indexis::getIblockId("reagents", "1c_catalog", "s1"),
            "NEWS_COUNT" => "99999",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_BY2" => "ID",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "",
            "FIELD_CODE" => array(""),
            "PROPERTY_CODE" => array("NUMBER", "CALIBRATOR", "CONTROL", "METHOD", "SIZE"),
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
</section>


<section class="care">
    <h2><span>Мы заботимся</span> о том, чтобы у&nbsp;вас было все необходимое
    </h2>
    <div class="care__registration">
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/reg_partner.php"
            )
        ); ?>
        <?/*?>
        <a class="underline-link" href="/registration/partner/">Зарегистрируйтесь,</a> чтобы открыть все возможности сайта
        <?*/ ?>
    </div>
    <div class="care__wrapper">
        <div class="care__block">
            <h3>Поддержка и документация</h3>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/main/bottom_docs.php"
                )
            ); ?>
        </div>
        <div class="care__block care__base">
            <div class="care__base-content">
                <h3>База знаний</h3>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/main/bottom_base.php"
                    )
                ); ?>
            </div>
            <div class="care__base-image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/care/base.jpg" alt="">
            </div>
        </div>
    </div>
</section>


<? $APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    "callback",
    array(
        "SEF_MODE" => "N",
        "WEB_FORM_ID" => 1,
        "LIST_URL" => "",
        "EDIT_URL" => "",
        "SUCCESS_URL" => "",
        "CHAIN_ITEM_TEXT" => "",
        "CHAIN_ITEM_LINK" => "",
        "IGNORE_CUSTOM_TEMPLATE" => "Y",
        "USE_EXTENDED_ERRORS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "VARIABLE_ALIASES" => array(),
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_SHADOW" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
    )
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>