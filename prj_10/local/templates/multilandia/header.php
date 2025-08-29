<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Page\Asset;

$isHomePage = ($APPLICATION->GetCurPage(false) === SITE_DIR);

// Подключение файла с глобальными параметрами -->
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/globals_header.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/globals_header.php");
}

?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">

<head>
    <title>
        <? $APPLICATION->ShowTitle(); ?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="MobileOptimized" content="320">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/v1/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/v1/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/v1/favicon-16x16.png">
    <link rel="manifest" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/v1/site.webmanifest">
    <link rel="mask-icon" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/v1/safari-pinned-tab.svg" color="#5772f7">
    <link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/v1/favicon.ico">
    <meta name="msapplication-TileColor" content="#5772f7">
    <meta name="msapplication-config" content="<?= SITE_TEMPLATE_PATH ?>/img/favicons/v1/browserconfig.xml">
    <meta name="theme-color" content="#5772f7">
    <?
    // CSS
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/common.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/main.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/custom.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/dev.css");

    // JS
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery/jquery-3.6.0.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/inputmask/5.0.9/jquery.inputmask.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/lazysizes/lazysizes.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/moment/moment.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/moment/moment-timezone-with-data.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/cookie/jquery.cookie.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/selectric/public/jquery.selectric.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/dropzone/dropzone.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");
    // Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/js.cookie.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.js");

    $APPLICATION->ShowHead();
    ?>
</head>

<body <? if ($isHomePage): ?>class="home-page" <? endif; ?>data-svg-sprite="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg"
    data-svg-icons="search,close-simple,close,burger,live,collapseArrow,vk,vkontakte,ok,yandex,sber,rutube,youtube,telegram,dzen,souzmultfilm,souzmultpark,arrowLeft,arrowRight,arrowBottom,morning,day,evening,night,star">
    <? $APPLICATION->ShowPanel(); ?>
    <div class="ml-wrapper">
        <?
        $GLOBALS['arLiveFilter'] = [
            '>=PROPERTY_DATE_START' => FormatDate('Y-m-d H:i:s')
        ];
        ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "live-section",
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "N",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array("", ""),
                "FILTER_NAME" => "arLiveFilter",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => Indexis::getIblockId('guide'),
                "IBLOCK_TYPE" => "guide",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "4",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array("MOVIE_ID"),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "PROPERTY_DATE_START",
                "SORT_BY2" => "NAME",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N"
            )
        ); ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR."include/header/header_banner.php",
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <header class="ml-header">
            <div class="container">
                <div class="ml-header-inner">
                    <? if ($isHomePage) { ?>
                        <div class="ml-header-logo">
                        <? } else { ?>
                            <a class="ml-header-logo" href="<?= SITE_DIR ?>">
                            <? } ?>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo.svg" alt="Мультиландия" width="300"
                                height="59" />
                            <? if (!$isHomePage) { ?>
                            </a>
                        <? } else { ?>
                        </div>
                    <? } ?>
                    <div class="ml-header-content">
                        <div class="ml-header-content__inner">
                            <div class="ml-header-menu">
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "header-menu",
                                    array(
                                        "ROOT_MENU_TYPE" => "top",
                                        "MAX_LEVEL" => "1",
                                        "CHILD_MENU_TYPE" => "top",
                                        "USE_EXT" => "N",
                                        "DELAY" => "N",
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "MENU_CACHE_TYPE" => "Y",
                                        "MENU_CACHE_TIME" => "86400",
                                        "MENU_CACHE_USE_GROUPS" => "N",
                                        "MENU_CACHE_GET_VARS" => ""
                                    )
                                );
                                ?>
                            </div>

                            <? $APPLICATION->IncludeComponent(
                                "bitrix:search.title",
                                "search-title-header-indexis",
                                array(
                                    "SHOW_INPUT" => "Y",
                                    "INPUT_ID" => "title-search-input-indexis",
                                    "CONTAINER_ID" => "title-search-indexis",
                                    "PRICE_CODE" => array(
                                        0 => "BASE",
                                        1 => "RETAIL",
                                    ),
                                    "PRICE_VAT_INCLUDE" => "Y",
                                    "PREVIEW_TRUNCATE_LEN" => "150",
                                    "SHOW_PREVIEW" => "Y",
                                    "PREVIEW_WIDTH" => "75",
                                    "PREVIEW_HEIGHT" => "75",
                                    "CONVERT_CURRENCY" => "Y",
                                    "CURRENCY_ID" => "RUB",
                                    "PAGE" => "#SITE_DIR#search/",
                                    "NUM_CATEGORIES" => "3",
                                    "TOP_COUNT" => "10",
                                    "ORDER" => "rank",
                                    "USE_LANGUAGE_GUESS" => "Y",
                                    "CHECK_DATES" => "N",
                                    "SHOW_OTHERS" => "Y",
                                    "CATEGORY_0_TITLE" => "Мультфильмы",
                                    "CATEGORY_0" => array(
                                        0 => "iblock_movies",
                                    ),
                                    "CATEGORY_0_iblock_news" => array(
                                        0 => "all",
                                    ),
                                    "CATEGORY_1_TITLE" => "Конкурсы",
                                    "CATEGORY_1" => array(
                                        0 => "iblock_contests",
                                    ),
                                    "CATEGORY_1_forum" => array(
                                        0 => "all",
                                    ),
                                    "CATEGORY_2_TITLE" => "О канале",
                                    "CATEGORY_2" => array(
                                        0 => "main",
                                    ),
                                    "CATEGORY_2_iblock_books" => "all",
                                    "CATEGORY_OTHERS_TITLE" => "Прочее",
                                    "COMPONENT_TEMPLATE" => "search-title-header-indexis",
                                    "CATEGORY_0_iblock_guide" => array(
                                        0 => "2",
                                    ),
                                    "CATEGORY_1_iblock_movies" => array(
                                        0 => "1",
                                    ),
                                    "CATEGORY_2_iblock_rest_entity" => array(
                                        0 => "all",
                                    ),
                                    "CATEGORY_2_main" => array(
                                        0 => "/about/",
                                        1 => "/partners/",
                                        2 => "",
                                    ),
                                    "CATEGORY_0_iblock_movies" => array(
                                        0 => "1",
                                    ),
                                    "CATEGORY_1_iblock_contests" => array(
                                        0 => "4",
                                    )
                                ),
                                false
                            ); ?>
                        </div>
                        <?
                        global $USER;
                        if ($USER->IsAuthorized()):
                            $fullName = $USER->GetFullName();
                            if (mb_strlen($fullName) == 0)
                                $fullName = $USER->GetLogin();
                            ?>
                            <a class="ml-btn ml-btn_round ml-header-auth-btn" href="<?= SITE_DIR ?>personal/">
                                <?= TruncateText($fullName, 15) ?>
                            </a>
                        <? else: ?>
                            <button class="ml-btn ml-btn_round ml-header-auth-btn" type="button" data-modal="#modal-auth">
                                Вход
                            </button>
                        <? endif; ?>

                        <button class="ml-header-menu-close-btn" type="button">
                            <svg class="icon icon-close">
                                <use xlink:href="#close"></use>
                            </svg>
                        </button>
                    </div>
                    <button class="ml-header-menu-toggle-btn" type="button">
                        <svg class="icon icon-burger">
                            <use xlink:href="#burger"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </header>
        <main class="ml-main">
            <? if (!$isHomePage): ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "",
                    array(
                        "START_FROM" => "0",
                        "PATH" => "",
                        "SITE_ID" => SITE_ID
                    )
                ); ?>
                <div class="ml-page">
                    <div class="ml-page-header">
                        <div class="container">
                            <? $APPLICATION->ShowViewContent("content_wrapper_h1_before"); ?>
                            <?
                            $bShowH1 = stripos($APPLICATION->GetCurPage(false), '/search/') !== 0 && stripos($APPLICATION->GetCurPage(false), '/personal/') !== 0;
                            if (bShowH1 == true) { ?>
                                <h1 class="ml-page-title">
                                    <? $APPLICATION->ShowTitle(false); ?>
                                </h1>
                                <? $APPLICATION->ShowViewContent("content_after_h1"); ?>
                            <? }
                            /*
                            if(!defined('IS_ERROR_404') || IS_ERROR_404 != 'Y'): ?>
                            <? if(stripos($APPLICATION->GetCurPage(false), '/search/') !== 0 && stripos($APPLICATION->GetCurPage(false), '/personal/') !== 0): ?>
                            <h1 class="ml-page-title">
                            <? $APPLICATION->ShowTitle(false); ?>
                            </h1>
                            <? endif; ?>
                            <? 
                            endif;
                            */
                            ?>
                            <? $APPLICATION->ShowViewContent("content_wrapper_h1_after"); ?>
                        </div>
                    </div>
                    <div class="ml-page-body">
                        <? if (!defined('CUSTOM_LAYOUT_PAGE')): ?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                    <? endif; ?>
                                <? endif; ?>


                                <?php

                                ?>