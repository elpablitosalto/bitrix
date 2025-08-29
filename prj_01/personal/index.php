<?
define('PAGE_TYPE', 3);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-lk');
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'lk');
$APPLICATION->SetPageProperty("PAGE_HEADER_CLASS", 'lk__title');
?>
<?
require($_SERVER["DOCUMENT_ROOT"] . "/personal/head.php");
?>
<? if (!($USER->IsAuthorized())) { ?>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/personal/need_auth.php"
        )
    );
    ?>
<? } else { ?>
    <div class="page-wrapper">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/personal/left.php"
            )
        );
        ?>
        <div class="page-body">
            <div class="page-body__wrapper">
                <h1 class="documentation__anchor" id="lkmain">Личный кабинет</h1>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "news_lk",
                    array(
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "N",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_MODE" => "N",
                        "IBLOCK_TYPE" => "content",
                        "IBLOCK_ID" => Indexis::getIblockId("news", "content"),
                        "NEWS_COUNT" => "5",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_ORDER1" => "DESC",
                        "FILTER_NAME" => "arrFilterPersonalArticles",
                        "FIELD_CODE" => array("PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PICTURE"),
                        "PROPERTY_CODE" => array('THEME'),
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
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "PAGER_TITLE" => "Подразделы",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "geropharm",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "Y",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => "",
                        "PAGER_BASE_LINK" => "",
                        "PAGER_PARAMS_NAME" => "arrPager",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",

                        /*
                        // Мои параметры -->
                        'HEADER' => 'Новые статьи',
                        'SHOW_MORE_SHOW' => 'Y',
                        'SHOW_H2' => 'Y',
                        'USER_AUTHORIZED' => $USER->IsAuthorized() ? 'Y' : 'N',
                        //'HIDE_READED' => $arFilterFromComponent['arFilter']['hidelearned'],
                        // <-- Мои параметры
                        */
                    )
                ); ?>
            </div>
            <div class="lk__wrapper">
                <div class="lk__section lk__profile documentation__anchor" id="lkprofile">
                    <h4>Профиль</h4>
                    <div class="lk__section-wrapper">
                        <div class="profile-name"><?= $GLOBALS['arUser']['NAME']; ?> <?= $GLOBALS['arUser']['LAST_NAME']; ?></div>
                        <div class="profile-company"><?= $GLOBALS['arUser']['WORK_COMPANY']; ?></div>
                    </div>
                    <div class="profile-contact__wrapper">
                        <? if (strlen($GLOBALS['arUser']['PERSONAL_MOBILE']) > 0) { ?>
                            <div class="profile-contact">
                                Телефон <a class="profile-contact__phone" href="tel:<?= Indexis::getCleanPhoneNumber($GLOBALS['arUser']['PERSONAL_MOBILE']); ?>"><?= $GLOBALS['arUser']['PERSONAL_MOBILE']; ?></a>
                            </div>
                        <? } ?>
                        <div class="profile-contact">
                            E-mail <a class="profile-contact__email" href="mailto:<?= $GLOBALS['arUser']['EMAIL']; ?>"><?= $GLOBALS['arUser']['EMAIL']; ?></a>
                        </div>
                    </div><a class="link-button_grey" href="/personal/profile/">Редактировать профиль</a>
                </div>
                <?
                $APPLICATION->IncludeComponent(
                    "dirui:basket.items",
                    "",
                    array(
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",

                        "IS_PARTNER" => $GLOBALS['isPartner'],
                        "USER_ID" => $USER->GetID(),
                        "IBLOCK_ID_BASKET" => Indexis::getIblockId('orders_reagents', 'orders'),
                        //"IBLOCK_ID_PRODUCTS" => Indexis::getIblockId('orders_reagents', 'orders'),
                        //"CUR_DIRECTION" => $_REQUEST['DIRECTION'],
                        //"CUR_PRODUCT_TYPE" => $_REQUEST['PRODUCT_TYPE'],
                    )
                );
                ?>
            </div>
            <div class="lk__wrapper">

                <? $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "price_lists",
                    array(
                        "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "",
                        "VIEW_MODE" => "TEXT",
                        "SHOW_PARENT_NAME" => "Y",
                        "IBLOCK_TYPE" => "content",
                        "IBLOCK_ID" => Indexis::getIblockId("price_lists", "content", "s1"),
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
                        "CUSTOM_SECTION_SORT" => ["SORT" => "ASC", "ID" => "ASC"],

                        // Мои параметры -->
                        "HEADER" => "Прайс-листы",
                        // <-- Мои параметры
                    )
                ); ?>

                <? $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "price_lists",
                    array(
                        "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "",
                        "VIEW_MODE" => "TEXT",
                        "SHOW_PARENT_NAME" => "Y",
                        "IBLOCK_TYPE" => "content",
                        "IBLOCK_ID" => Indexis::getIblockId("permits", "content", "s1"),
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
                        "CUSTOM_SECTION_SORT" => ["SORT" => "ASC", "ID" => "ASC"],

                        // Мои параметры -->
                        "HEADER" => "Разрешительная документация",
                        // <-- Мои параметры
                    )
                ); ?>
            </div>
            <div class="lk__wrapper">
                <div class="lk__section">
                    <h4 class="documentation__anchor" id="lkservice">Сервис</h4>
                    Заполняйте форму, чтобы проконсультироваться, получить поддержку от инженера, запросить ремонт
                    <a class="link-button_grey" href="/contacts/#callback">Оставить запрос</a>
                </div>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "compare_models_lk",
                    array(
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "AJAX_MODE" => "N",
                        "IBLOCK_TYPE" => "content",
                        "IBLOCK_ID" => Indexis::getIblockId("compare_models", "content"),
                        "IBLOCK_CODE" => '',
                        "NEWS_COUNT" => "5",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "FILTER_NAME" => 'arrFilterPriceLists',
                        "FIELD_CODE" => array('ID', 'NAME', 'ACTIVE_FROM', 'IBLOCK_SECTION_ID'),
                        "PROPERTY_CODE" => array('FILE'),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "Y",
                        "SET_META_KEYWORDS" => "Y",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "Y",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",
                        "CACHE_FILTER" => "Y",
                        "CACHE_GROUPS" => "Y",
                        "DISPLAY_TOP_PAGER" => "Y",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "PAGER_TITLE" => "Новости",
                        "PAGER_SHOW_ALWAYS" => "Y",
                        "PAGER_TEMPLATE" => "show_more_clinical",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "Y",
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
                        //'CUSTOM_SECTION_SORT' => $CUSTOM_SECTION_SORT,
                        // <-- Мои параметры 
                    )
                ); ?>
            </div>
            <div class="lk__wrapper">
                <div class="lk__section">
                    <h4>Остались вопросы?</h4>
                    <p>Заполняйте форму, чтобы проконсультироваться, получить поддержку от инженера, запросить ремонт</p>
                    <p><a href="/contacts/#callback">Задайте вопрос</a> напрямую в сотрудникам компании
                    </p>
                </div>
            </div>
        </div>
    </div>
<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>