<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

use \Bitrix\Main\Page\Asset,
    \Bitrix\Main\Application,
    \Bitrix\Main\Context,
    \Bitrix\Main\Web\Uri;

$uri = new Uri(Application::getInstance()->getContext()->getRequest()->getRequestUri());
$dir = $APPLICATION->GetCurDir();

global $isHomePage;
$isHomePage = ($APPLICATION->GetCurPage(false) === SITE_DIR);

global $isSearchPage;
$isSearchPage = $dir == '/search/';

if (!defined('LIKE_HOME')) {
    define('LIKE_HOME', 'N');
}

?><!-- - var iconList = 'search,vk,telegram,whatsapp';-->
<!DOCTYPE html>
<html lang="ru">

<head>
    <title><? $APPLICATION->ShowTitle(); ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="MobileOptimized" content="320">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon-16x16.png">
    <link rel="manifest" crossorigin="use-credentials" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/safari-pinned-tab.svg" color="#c3cd7b">
    <link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#9ca751">
    <meta name="msapplication-config" content="<?= SITE_TEMPLATE_PATH ?>/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#9ca751">

    <? //Canonical
    $page = $APPLICATION->GetCurPage();
    echo '<link rel="canonical" href="https://' . Context::getCurrent()->getServer()->getHttpHost() . $page . '" />'; ?>

    <?
    $pagePath = $APPLICATION->GetCurPage(false);

    //js
    Asset::getInstance()->addJs("https://api-maps.yandex.ru/2.1/?apikey=7d5c6368-70f5-4e61-9fb1-b7e8c948f827&amp;lang=ru_RU");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery/jquery-3.6.0.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/inputmask/jquery.inputmask.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/selectric/public/jquery.selectric.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/lazysizes/lazysizes.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery.validate/jquery.validate.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery-ui-slider/jquery-ui-slider.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery-ui-slider/jquery.ui.touch-punch.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");

    //css
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/common.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/main.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/custom.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/custom_2.css");
    ?>

    <? $APPLICATION->ShowHead(); ?>
</head>

<body class="<? $APPLICATION->ShowProperty("PAGE_BODY_CLASS"); ?>" data-svg-sprite="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg" data-svg-icons="all">
    <div class="dp-wrapper">
        <header class="dp-header">
            <? $APPLICATION->ShowPanel(); ?>
            <div class="container">
                <div class="dp-header__inner"><a class="dp-header-logo" href="/"><img class="dp-header-logo__img" src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo.svg" alt="МАФ маркет" width="240" height="50"></a>
                    <?/*.dp-header-location
                    a.dp-header-location__current(href="#")
                        +icon('location', 'dp-header-location__current-icon')
                        span.dp-header-location__current-city Москва
                    */ ?>
                    <nav class="dp-header-menu">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "header_multilevel",
                            array(
                                "ROOT_MENU_TYPE" => "header_multilevel",
                                "MAX_LEVEL" => "2",
                                "CHILD_MENU_TYPE" => "header_multilevel_child",
                                "USE_EXT" => "Y",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => ""
                            )
                        ); ?>
                    </nav>

                    <div class="dp-header-personal-menu">
                        <ul class="dp-header-personal-menu__list">
                            <li class="dp-header-personal-menu__item">
                                <a class="dp-header-personal-menu__link dp-header-personal-menu__search" href="#">
                                    <svg class="icon icon-search ">
                                        <use xlink:href="#search"></use>
                                    </svg>
                                </a>
                            </li>
                            <li class="dp-header-personal-menu__item">
                                <a class="dp-header-personal-menu__link dp-header-personal-menu__account" href="/profile/">
                                    <svg class="icon icon-account ">
                                        <use xlink:href="#account"></use>
                                    </svg>
                                </a>
                            </li>
                            <li class="dp-header-personal-menu__item">
                                <button class="dp-header-toggle-btn dp-header-personal-menu__menu" type="button">
                                    <span></span></button>
                            </li>
                        </ul>
                    </div>
                    <? /*.dp-header-search
                    form.dp-header-search-form(action="#")
                        input.dp-header-search-form__input(type="text" placeholder="Поиск")
                        button.dp-header-search-form__submit(type="submit")
                            +icon('search', "dp-header-search-form__icon")
                    */ ?>
                    <?/*.dp-header-phones
                    a.dp-header-phone(href="tel:+74959409570") 8 495 940-95-70
                    br
                    a.dp-header-phone(href="tel:+78007074270") 8 800 707-42-70
                    */ ?>
                </div>
            </div>
        </header>
        <? if (!$isHomePage && !$isSearchPage && LIKE_HOME != 'Y') { ?>
            <?
            if (!defined('PAGE_TYPE')) {
                define('PAGE_TYPE', 1);
            }
            if (!defined('MENU_TYPE')) {
                define('MENU_TYPE', 1);
            }
            if (!defined('SHOW_CONTACT_US_BUTTON')) {
                define('SHOW_CONTACT_US_BUTTON', 'Y');
            }
            if (!defined('SHOW_TAGS_MENU')) {
                define('SHOW_TAGS_MENU', 'N');
            }
            if (!defined('PAGE_COLUMNS_COUNT')) {
                define('PAGE_COLUMNS_COUNT', 2);
            }
            if (!defined('SHOW_COLUMNS_IN_HEADER')) {
                define('SHOW_COLUMNS_IN_HEADER', 'Y');
            }
            if (!defined('LEFT_MENU_TYPE')) {
                define('LEFT_MENU_TYPE', 'leftside');
            }
            if (!defined('MATERIAL_DETAIL')) {
                define('MATERIAL_DETAIL', 'N');
            }
            ?>
            <? if (PAGE_COLUMNS_COUNT == 1) { ?>
                <section class="dp-section">
                    <div class="container">
                        <div class="dp-section__body">
                            <h1 class="dp-page__title"><? $APPLICATION->ShowTitle(false); ?></h1>
                        <? } else if (PAGE_COLUMNS_COUNT == 2) { ?>
                            <main class="dp-page dp-page-aside-content">

                                <div class="dp-section">
                                    <div class="container">
                                        <div class="dp-page__header">
                                            <? $APPLICATION->ShowViewContent('PAGE_CONTENT_BEFORE_H1'); ?>
                                            <? if (PAGE_TYPE == 1) { ?>
                                                <h1 class="dp-page__title"><? $APPLICATION->ShowTitle(false); ?></h1>
                                            <? } ?>
                                            <? $APPLICATION->ShowViewContent('PAGE_CONTENT_AFTER_H1'); ?>
                                        </div>

                                        <? if (SHOW_COLUMNS_IN_HEADER == 'Y') { ?>

                                            <div class="row">

                                                <div class="col-lg-5">
                                                    <aside class="dp-page__aside">
                                                        <? if (MENU_TYPE == 1) { ?>
                                                            <div class="dp-aside dp-sticky">
                                                                <div class="h3 dp-aside__title"><? $APPLICATION->ShowProperty("PAGE_H3"); ?></div>
                                                                <div class="dp-aside-menu">
                                                                    <? $APPLICATION->IncludeComponent(
                                                                        "bitrix:menu",
                                                                        "leftside",
                                                                        array(
                                                                            "ROOT_MENU_TYPE" => LEFT_MENU_TYPE,
                                                                            "MAX_LEVEL" => "1",
                                                                            "CHILD_MENU_TYPE" => "",
                                                                            "USE_EXT" => "N",
                                                                            "DELAY" => "N",
                                                                            "ALLOW_MULTI_SELECT" => "Y",
                                                                            "MENU_CACHE_TYPE" => "N",
                                                                            "MENU_CACHE_TIME" => "3600",
                                                                            "MENU_CACHE_USE_GROUPS" => "Y",
                                                                            "MENU_CACHE_GET_VARS" => ""
                                                                        )
                                                                    ); ?>
                                                                </div>
                                                                <? if (SHOW_CONTACT_US_BUTTON == 'Y') { ?>
                                                                    <a class="dp-btn aside-menu-button" href="/contacts/#contact_us"><span>Связаться с нами</span></a>
                                                                <? } ?>
                                                                <? if (SHOW_TAGS_MENU == 'Y') { ?>
                                                                    <div class="dp-tags">
                                                                        <? $APPLICATION->IncludeComponent(
                                                                            "bitrix:news.list",
                                                                            "services_menu",
                                                                            array(
                                                                                "DISPLAY_DATE" => "N",
                                                                                "DISPLAY_NAME" => "N",
                                                                                "DISPLAY_PICTURE" => "Y",
                                                                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                                                                "AJAX_MODE" => "N",
                                                                                "IBLOCK_TYPE" => "content",
                                                                                "IBLOCK_ID" => Indexis::getIblockId('services', 'content'),
                                                                                "NEWS_COUNT" => "200",
                                                                                "SORT_BY1" => 'SORT',
                                                                                "SORT_ORDER1" => 'ASC',
                                                                                "SORT_BY2" => "SORT",
                                                                                "SORT_ORDER2" => "ASC",
                                                                                "FILTER_NAME" => "arrFilterReviews",
                                                                                "FIELD_CODE" => array('DETAIL_PAGE_URL', "ID", 'NAME', 'CODE', 'DETAIL_TEXT', 'DETAIL_PICTURE', 'PREVIEW_TEXT', 'PREVIEW_PICTURE'),
                                                                                "PROPERTY_CODE" => array('HEADER', 'MENU_HEADER', 'BLOCK_TYPE'),
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
                                                                <? } ?>
                                                            </div>
                                                        <? } else if (MENU_TYPE == 2) { ?>
                                                            <div class="dp-sticky-materials dp-sticky">
                                                                <div class="h3 dp-aside__title"><? $APPLICATION->ShowProperty("PAGE_H3"); ?></div>
                                                                <div class="dp-aside-menu dp-aside-menu__title">
                                                                    <? $APPLICATION->IncludeComponent(
                                                                        "bitrix:catalog.section.list",
                                                                        "materials_menu",
                                                                        array(
                                                                            "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
                                                                            "VIEW_MODE" => "TEXT",
                                                                            "SHOW_PARENT_NAME" => "Y",
                                                                            "IBLOCK_TYPE" => "",
                                                                            "IBLOCK_ID" => Indexis::getIblockId("materials", "content"),
                                                                            "SECTION_ID" => '',
                                                                            "SECTION_CODE" => "",
                                                                            "SECTION_URL" => "",
                                                                            "COUNT_ELEMENTS" => "N",
                                                                            "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                                                                            "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
                                                                            "TOP_DEPTH" => "1",
                                                                            "SECTION_FIELDS" => array('ID', 'NAME', 'SECTION_PAGE_URL', 'PICTURE'),
                                                                            "SECTION_USER_FIELDS" => "",
                                                                            "ADD_SECTIONS_CHAIN" => "N",
                                                                            "CACHE_TYPE" => "A",
                                                                            "CACHE_TIME" => "36000000",
                                                                            "CACHE_NOTES" => "",
                                                                            "CACHE_GROUPS" => "Y",

                                                                            // Мои параметры -->
                                                                            'CUR_ELEMENT_CODE' => $_GET['ELEMENT_CODE'],
                                                                            'MATERIAL_DETAIL' => MATERIAL_DETAIL,
                                                                            // <-- Мои параметры
                                                                        )
                                                                    ); ?>
                                                                </div>
                                                                <button class="aside-menu-close" type="button"></button>
                                                            </div>
                                                        <? } else if (MENU_TYPE == 3) { ?>
                                                            <div class="dp-aside dp-sticky">
                                                                <div class="h3 dp-aside__title"><? $APPLICATION->ShowProperty("PAGE_H3"); ?></div>
                                                                <div class="aside__contact">
                                                                    <? $APPLICATION->IncludeComponent(
                                                                        "bitrix:news.list",
                                                                        "contacts_menu",
                                                                        array(
                                                                            "DISPLAY_DATE" => "N",
                                                                            "DISPLAY_NAME" => "N",
                                                                            "DISPLAY_PICTURE" => "Y",
                                                                            "DISPLAY_PREVIEW_TEXT" => "Y",
                                                                            "AJAX_MODE" => "N",
                                                                            "IBLOCK_TYPE" => "content",
                                                                            "IBLOCK_ID" => Indexis::getIblockId('contacts', 'content'),
                                                                            "NEWS_COUNT" => "200",
                                                                            "SORT_BY1" => 'SORT',
                                                                            "SORT_ORDER1" => 'ASC',
                                                                            "SORT_BY2" => "SORT",
                                                                            "SORT_ORDER2" => "ASC",
                                                                            "FILTER_NAME" => "arrFilterReviews",
                                                                            "FIELD_CODE" => array("ID", 'NAME', 'DETAIL_TEXT', 'DETAIL_PICTURE'),
                                                                            "PROPERTY_CODE" => array('PHONE', 'EMAIL', 'SHEDULE', 'ADDRESS', 'LATITUDE', 'LONGITUDE', 'HOW_TO_GET_TEXT', 'HOW_TO_GET_PICT_1', 'HOW_TO_GET_PICT_2', 'VK', 'INSTAGRAM', 'FACEBOOK', 'WHATSAPP'),
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

                                                                    <a class="dp-btn" href="/contacts/#contact_us"><span>Заявка на производство</span></a>
                                                                </div>
                                                            </div>
                                                        <? } else if (MENU_TYPE == 5) { ?>
                                                            <? $APPLICATION->ShowViewContent('PAGE_CONTENT_LEFT_SIDEBAR'); ?>
                                                        <? } elseif (MENU_TYPE == 6) { ?>
                                                            <div class="dp-aside dp-sticky">
                                                                <div class="h3 dp-aside__title">
                                                                    <? $APPLICATION->ShowProperty("PAGE_H3"); ?>
                                                                </div>
                                                                <?
                                                                $currentSection = "";
                                                                if (isset($_REQUEST["CATALOG_CODE"]) && mb_strlen($_REQUEST["CATALOG_CODE"])) {
                                                                    $currentSection = explode("/", $_REQUEST["CATALOG_CODE"]);
                                                                    $currentSection = $currentSection[0];
                                                                }
                                                                $APPLICATION->IncludeComponent(
                                                                    "bitrix:catalog.section.list",
                                                                    "catalog",
                                                                    array(
                                                                        "VIEW_MODE" => "TEXT",
                                                                        "SHOW_PARENT_NAME" => "Y",
                                                                        "IBLOCK_TYPE" => "1c_catalog",
                                                                        "IBLOCK_ID" => Indexis::getIblockId("1c_catalog", "1c_catalog"),
                                                                        "SECTION_ID" => '',
                                                                        "SECTION_CODE" => "",
                                                                        "SECTION_URL" => "",
                                                                        "CURRENT_ELEMENT" => $currentSection,
                                                                        "COUNT_ELEMENTS" => "Y",
                                                                        "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                                                                        "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
                                                                        "TOP_DEPTH" => "1",
                                                                        "SECTION_FIELDS" => array('ID', 'NAME', 'SECTION_PAGE_URL', 'PICTURE'),
                                                                        "SECTION_USER_FIELDS" => "",
                                                                        "ADD_SECTIONS_CHAIN" => "N",
                                                                        "CACHE_TYPE" => "A",
                                                                        "CACHE_TIME" => "36000000",
                                                                        "CACHE_NOTES" => "",
                                                                        "CACHE_GROUPS" => "Y",
                                                                    )
                                                                ); ?>
                                                            </div>
                                                            <div class="dp-catalog-menu-mobile" id="dp-catalog-menu-mobile">
                                                                <div class="dp-catalog-menu-mobile__close">
                                                                    <svg class="icon icon-close ">
                                                                        <use xlink:href="#close"></use>
                                                                    </svg>
                                                                </div>
                                                                <div class="container">
                                                                    <h2 class="dp-catalog-menu-mobile__title">Продукция</h2>
                                                                    <div class="dp-categories-buttons">
                                                                        <ul class="dp-categories-buttons__list">
                                                                            <li class="dp-categories-buttons__item"><a class="dp-categories-buttons__link" href="#"><img class="dp-categories-buttons__icon" src="img/content/catalog/3.png" alt="Скамьи">Скамьи</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="dp-catalog-menu-mobile-toggler">
                                                                <div class="container">
                                                                    <button class="dp-btn dp-btn_sm" type="button">Все категории</button>
                                                                </div>
                                                            </div>
                                                        <? } elseif (MENU_TYPE == 7) { ?>
                                                            <? $APPLICATION->ShowViewContent("sidebar_detail") ?>
                                                        <? } elseif (MENU_TYPE == 8) { ?>
                                                            <div class="dp-aside dp-sticky">
                                                                <div class="h3 dp-aside__title">
                                                                    <? $APPLICATION->ShowProperty("PAGE_H3"); ?>
                                                                </div>
                                                                <div class="dp-aside-menu">
                                                                    <ul class="dp-aside-menu__list">
                                                                        <li class="dp-aside-menu__item selected"><a class="dp-aside-menu__link" href="#"><span class="dp-aside-menu__text">Моя ведомость</span></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        <? } ?>
                                                    </aside>
                                                </div>
                                                <div class="col-lg-19">
                                                    <div class="dp-page__body">
                                                    <? } ?>
                                                <? } ?>
                                            <? } ?>