<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Page\Asset;
?>
<!-- begin .page--><!DOCTYPE html>
<html class="page" lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="imagetoolbar" content="no"/>
    <meta name="msthemecompatible" content="no"/>
    <meta name="cleartype" content="on"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <meta name="google" value="notranslate"/>
    <meta name="theme-color" content="#ffffff"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/manifest.json"/>
	<meta name="msapplication-config" content="/browserconfig.xml">
    <meta name="application-name" content=""/>
    <meta name="msapplication-tooltip" content=""/>
    <meta name="msapplication-TileColor" content="#ffffff"/>
    <meta name="msapplication-TileImage" content="mstile-large.png"/>
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="msapplication-square70x70logo" content="mstile-small.png"/>
    <meta name="msapplication-square150x150logo" content="mstile-medium.png"/>
    <meta name="msapplication-wide310x150logo" content="mstile-wide.png"/>
    <meta name="msapplication-square310x310logo" content="mstile-large.png"/>
    <?$APPLICATION->ShowHead();?>
    <title><?$APPLICATION->ShowTitle()?></title>
    <?=$APPLICATION->ShowViewContent('og');?>
    <script>
        <?/*
            Example usage:
            1. Add a new entry to the appResources object. This has to be done before your code attempts to use it, so adding it right here is preferable.
            1.1. The key of the entry would be the string that you would later pass as a parameter to load the resource;
            1.2. initiated should be left as false;
            1.3. delay is how many miliseconds should the script artificially wait after calling the load function;
            1.4. items is an array of resources;
            1.4.1. name is used for the event which would be dispatched on body once your resource is done loading;
            1.4.2. type is a string equal to either css or js;
            1.4.3. src is the path to your resource

            swiper: {
                initiated: false,
                delay: 0,
                items: [
                    {
                        name: 'swiper-bundle-css',
                        type: 'css',
                        src: 'path/to/swiper.css'
                    },
                    {
                        name: 'swiper-bundle-js',
                        type: 'js',
                        src: 'path/to/swiper.js'
                    },
                ],
            },

            2.You want to make some kind of check, to make sure that the resource you're trying to load hasn't already been loaded. If it is loaded, then just call your code without steps 3 and 4. Calling the load function more than once will not dispatch the load event.

            if (appResources.swiper.initiated) {}

            or

            if (typeof Swiper !== 'undefined') {}

            3. Add an event listener on document body for load of one of the resources. The event name will always be equal to ${nameOfTheResource}-load

            document.body.addEventListener('swiper-bundle-js-load', function () {
                // Code that uses swiper
            });

            4. Call the load function, giving it the name of your entry. This would initiate the loading of all associated resources and dispatch the load events

            window.resourceLoader.load('swiper');
        */?>
        let appResources = {
            swiper: {
                initiated: false,
                delay: 0,
                items: [
                    {
                        name: 'swiper-bundle-css',
                        type: 'css',
                        src: '<?=SITE_TEMPLATE_PATH?>/assets/components/swiper-11.0.7/swiper-bundle.min.css'
                    },
                    {
                        name: 'swiper-bundle-js',
                        type: 'js',
                        src: '<?=SITE_TEMPLATE_PATH?>/assets/components/swiper-11.0.7/swiper-bundle.min.js'
                    },
                ],
            },
            choices: {
                initiated: false,
                delay: 2000,
                items: [
                    {
                        name: 'choices-css',
                        type: 'css',
                        src: '<?=SITE_TEMPLATE_PATH?>/assets/components/choices/styles/choices.min.css'
                    },
                    {
                        name: 'choices-js',
                        type: 'js',
                        src: '<?=SITE_TEMPLATE_PATH?>/assets/components/choices/scripts/choices.min.js'
                    },
                ],
            },
            fancybox: {
                initiated: false,
                delay: 0,
                items: [
                    {
                        name: 'fancybox-css',
                        type: 'css',
                        src: '<?=SITE_TEMPLATE_PATH?>/assets/components/fancybox-4.0.7/fancybox.css'
                    },
                    {
                        name: 'fancybox-js',
                        type: 'js',
                        src: '<?=SITE_TEMPLATE_PATH?>/assets/components/fancybox-4.0.7/fancybox.umd.js'
                    },
                ],
            },
            recaptcha: {
                initiated: false,
                delay: 5000,
                items: [
                    {
                        name: 'recaptcha-js',
                        type: 'js',
                        src: '<?="https://www.google.com/recaptcha/api.js?render=".Bitrix\Main\Config\Option::get("main", "recaptcha_code", CAPTCHA_SITE_KEY)?>'
                    },
                ],
            },
        };
    </script>
    <?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/styles/app.css");?>
    <?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/styles/custom.css");?>

    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/components/jquery-3.7.1/jquery.min.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/components/just-validate-3.10.0/just-validate.production.min.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/components/Inputmask/inputmask.min.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/components/gsap/gsap.min.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/components/gsap/ScrollSmoother.min.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/components/gsap/ScrollTrigger.min.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/utm.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/resource-loader.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/helpers.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/common.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/custom.js");?>
    <?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/validate.js");?>

    <?
        $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH."/include/form/captcha/head.php",
            "AREA_FILE_RECURSIVE" => "N",
            "EDIT_MODE" => "html",
            ),
            false,
            array('HIDE_ICONS' => 'Y')
        );
    ?>
</head>
<body class="page__body" id="body">
<?$APPLICATION->ShowPanel()?>
<button class="page__menu-close js-toggle" type="button" data-toggle-scope=".page__body" data-toggle-class="page__body_nav_open">Закрыть меню</button>
<div class="page__topline">
    <!-- begin .topline-->
    <div class="topline">
        <div class="topline__holder page__holder">
            <div class="topline__social-nav">
                <!-- begin .social-nav-->
                <div class="social-nav">
                    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/header/social.php",
                        Array(),
                        Array("MODE" => "html", "NAME" => "HEADER_SOCIAL")
                    );?>
                </div>
                <!-- end .social-nav-->
            </div>
            <div class="topline__extra">
                <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/header/top_phone.php",
                    Array(),
                    Array("MODE" => "html", "NAME" => "HEADER_PHONE")
                );?>
            </div>
        </div>
    </div>
    <!-- end .topline-->
</div>
<div class="page__header">
    <!-- begin .header-->
    <div class="header">
        <div class="page__holder page__holder_mobile-gutter_s">
            <div class="header__holder">
                <div class="header__logo">
                    <!-- begin .logo-->
                    <a class="logo" href="/">
                        <img class="logo__image" src="<?=SITE_TEMPLATE_PATH?>/assets/blocks/logo/images/main.svg" alt="SITE NAME" title=""/>
                    </a>
                    <!-- end .logo-->
                    <?if(\NoboringFinance\General::showSearch()):?>
                        <div class="header__postfix">Проводник в мир <br> разумного бизнеса</div>
                    <?endif;?>
                </div>
                <div class="header__nav">
                    <!-- begin .nav-->
                    <nav class="nav">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "top",
                            array(
                                "ROOT_MENU_TYPE" => "top",
                                "MENU_CACHE_TYPE" => "Y",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "USE_EXT" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO"
                            ),
                            false
                        );?>
                    </nav>
                    <!-- end .nav-->
                </div>
                <?if(\NoboringFinance\General::showSearch()):?>
                    <div class="header__search">
                        <div class="search-panel__field">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:search.title",
                                "header",
                                array(
                                    "SHOW_INPUT" => "Y",
                                    "SHOW_OTHERS" => "N",
                                    "INPUT_ID" => "gazeta-search-input",
                                    "CONTAINER_ID" => "gazeta-search",
                                    "PRICE_VAT_INCLUDE" => "Y",
                                    "PREVIEW_TRUNCATE_LEN" => "150",
                                    "SHOW_PREVIEW" => "Y",
                                    "PREVIEW_WIDTH" => "75",
                                    "PREVIEW_HEIGHT" => "75",
                                    "CONVERT_CURRENCY" => "Y",
                                    "CURRENCY_ID" => "RUB",
                                    "PAGE" => "#SITE_DIR#search/",
                                    "NUM_CATEGORIES" => "1",
                                    "TOP_COUNT" => "10",
                                    "ORDER" => "date",
                                    "USE_LANGUAGE_GUESS" => "Y",
                                    "CHECK_DATES" => "Y",
                                    "SHOW_OTHERS" => "Y",
                                    "CATEGORY_0_TITLE" => "Новости",
                                    "CATEGORY_0" => array(
                                        0 => "iblock_newspaper",
                                    ),
                                    "CATEGORY_0_iblock_news" => array(
                                        0 => "all",
                                    ),
                                    "CATEGORY_1_TITLE" => "Форумы",
                                    "CATEGORY_1" => array(
                                        0 => "forum",
                                    ),
                                    "CATEGORY_1_forum" => array(
                                        0 => "all",
                                    ),
                                    "CATEGORY_2_TITLE" => "Каталоги",
                                    "CATEGORY_2" => array(
                                        0 => "iblock_books",
                                    ),
                                    "CATEGORY_2_iblock_books" => "all",
                                    "CATEGORY_OTHERS_TITLE" => "Прочее",
                                    "COMPONENT_TEMPLATE" => "gazeta",
                                    "CATEGORY_0_iblock_content" => array(
                                        0 => "all",
                                    ),
                                    "CATEGORY_0_iblock_newspaper" => array(
                                        0 => "4",
                                        1 => "5",
                                        2 => "6",
                                    )
                                ),
                                false
                            );?>
                        </div>
                    </div>
                    <button class="header__search-trigger js-toggle" type="button" data-toggle-scope=".header" data-toggle-class="header_state_search" aria-label="Открыть поиск">
                        <svg class="header__icon" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M27.7437 26.5063L22.7522 21.5148C24.8238 19.1499 25.9556 16.151 25.9556 12.9778C25.9556 9.51136 24.6056 6.25237 22.1545 3.80116C19.7032 1.34996 16.4443 0 12.9778 0C9.5113 0 6.25226 1.34996 3.80105 3.80111C1.34991 6.25231 0 9.5113 0 12.9778C0 16.4443 1.34996 19.7032 3.80111 22.1545C6.25226 24.6057 9.5113 25.9556 12.9778 25.9556C16.151 25.9556 19.1498 24.8238 21.5148 22.7522L26.5063 27.7437C26.6772 27.9146 26.9011 28 27.125 28C27.3489 28 27.5728 27.9145 27.7437 27.7437C28.0855 27.402 28.0855 26.848 27.7437 26.5063ZM12.9778 24.2056C6.78672 24.2056 1.75 19.1688 1.75 12.9778C1.75 6.78672 6.78672 1.75 12.9778 1.75C19.1688 1.75 24.2056 6.78677 24.2056 12.9778C24.2056 19.1688 19.1688 24.2056 12.9778 24.2056Z" fill="#E31513"></path>
                        </svg>
                    </button>
                <?endif;?>
                <div class="header__trigger">
                    <!-- begin .nav-trigger-->
                    <button class="nav-trigger js-toggle" type="button" data-toggle-scope=".page__body" data-toggle-class="page__body_nav_open" aria-label="Открыть меню">
                        <div class="nav-trigger__content">
                            <div class="nav-trigger__icon-wrapper">
                                <svg class="nav-trigger__icon" width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-linecap="round"></path>
                                </svg>
                            </div>
                            <div class="nav-trigger__text">меню
                            </div>
                        </div>
                    </button>
                    <!-- end .nav-trigger-->
                </div>
            </div>
        </div>
    </div>
    <!-- end .header-->
    <!-- begin .fixed-header-->
    <div class="fixed-header">
        <div class="page__holder page__holder_mobile-gutter_s">
            <div class="fixed-header__holder">
                <div class="fixed-header__logo">
                    <!-- begin .logo-->
                    <a class="logo" href="/">
                        <img class="logo__image" src="<?=SITE_TEMPLATE_PATH?>/assets/blocks/logo/images/light.svg" alt="SITE NAME" title=""/>
                    </a>
                    <!-- end .logo-->
                </div>
                <div class="fixed-header__nav">
                    <!-- begin .nav-->
                    <nav class="nav nav_role_fixed-header">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "top",
                            array(
                                "ROOT_MENU_TYPE" => "top",
                                "MENU_CACHE_TYPE" => "Y",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "USE_EXT" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO"
                            ),
                            false
                        );?>
                    </nav>
                    <!-- end .nav-->
                </div>
                <div class="fixed-header__link-group">
                    <!-- begin .link-group-->
                    <div class="link-group">
                        <ul class="link-group__list">
                            <li class="link-group__item">
                                <div class="link-group__wrapper">
                                    <div class="link-group__sub">
                                        <!-- begin .link-item-->
                                        <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/header/fixed_phone.php",
                                            Array(),
                                            Array("MODE" => "html", "NAME" => "FIXED_PHONE")
                                        );?>
                                        <!-- end .link-item-->
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- end .link-group-->
                </div>
                <div class="fixed-header__control">
                    <!-- begin .button-->
                    <button class="button button_size_xs js-modal" href="#modalCounseling">
                        <span class="button__holder"><span class="button__text">Консультация</span></span>
                    </button>
                    <!-- end .button-->
                </div>

                <?if(\NoboringFinance\General::showSearch()):?>
                    <div class="fixed-header__search">
                        <!-- begin .search-panel-->
                            <div class="search-panel__field">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:search.title",
                                    "header",
                                    array(
                                        "CSS_CLASS" => "search-panel_style_secondary",
                                        "SHOW_INPUT" => "Y",
                                        "SHOW_OTHERS" => "N",
                                        "INPUT_ID" => "gazeta-fixed-search-input",
                                        "CONTAINER_ID" => "gazeta-fixed-search",
                                        "PRICE_VAT_INCLUDE" => "Y",
                                        "PREVIEW_TRUNCATE_LEN" => "150",
                                        "SHOW_PREVIEW" => "Y",
                                        "PREVIEW_WIDTH" => "75",
                                        "PREVIEW_HEIGHT" => "75",
                                        "CONVERT_CURRENCY" => "Y",
                                        "CURRENCY_ID" => "RUB",
                                        "PAGE" => "#SITE_DIR#search/",
                                        "NUM_CATEGORIES" => "1",
                                        "TOP_COUNT" => "10",
                                        "ORDER" => "date",
                                        "USE_LANGUAGE_GUESS" => "Y",
                                        "CHECK_DATES" => "Y",
                                        "SHOW_OTHERS" => "Y",
                                        "CATEGORY_0_TITLE" => "Новости",
                                        "CATEGORY_0" => array(
                                            0 => "iblock_newspaper",
                                        ),
                                        "CATEGORY_0_iblock_news" => array(
                                            0 => "all",
                                        ),
                                        "CATEGORY_1_TITLE" => "Форумы",
                                        "CATEGORY_1" => array(
                                            0 => "forum",
                                        ),
                                        "CATEGORY_1_forum" => array(
                                            0 => "all",
                                        ),
                                        "CATEGORY_2_TITLE" => "Каталоги",
                                        "CATEGORY_2" => array(
                                            0 => "iblock_books",
                                        ),
                                        "CATEGORY_2_iblock_books" => "all",
                                        "CATEGORY_OTHERS_TITLE" => "Прочее",
                                        "COMPONENT_TEMPLATE" => "gazeta",
                                        "CATEGORY_0_iblock_content" => array(
                                            0 => "all",
                                        ),
                                        "CATEGORY_0_iblock_newspaper" => array(
                                            0 => "4",
                                            1 => "5",
                                            2 => "6",
                                        )
                                    ),
                                    false
                                );?>
                            </div>
                        <!-- end .search-panel-->
                    </div>
                    <button class="fixed-header__search-trigger js-toggle" type="button" data-toggle-scope=".page__body, .fixed-header" data-toggle-class="page__body_state_fixed-search, fixed-header_state_search" data-toggle-focus=", .search-panel__input" aria-label="Открыть поиск">
                        <svg class="fixed-header__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.8169 18.9331L16.2515 15.3677C17.7312 13.6785 18.5397 11.5364 18.5397 9.26987C18.5397 6.79382 17.5754 4.46597 15.8246 2.71511C14.0737 0.964257 11.7459 0 9.26983 0C6.79378 0 4.46589 0.964257 2.71504 2.71507C0.964218 4.46593 0 6.79378 0 9.26983C0 11.7459 0.964257 14.0737 2.71507 15.8246C4.46589 17.5754 6.79378 18.5397 9.26983 18.5397C11.5364 18.5397 13.6784 17.7312 15.3677 16.2515L18.9331 19.8169C19.0551 19.939 19.2151 20 19.375 20C19.5349 20 19.6949 19.9389 19.8169 19.8169C20.061 19.5728 20.061 19.1771 19.8169 18.9331ZM9.26983 17.2897C4.84765 17.2897 1.25 13.692 1.25 9.26983C1.25 4.84765 4.84765 1.25 9.26983 1.25C13.692 1.25 17.2897 4.84769 17.2897 9.26983C17.2897 13.692 13.692 17.2897 9.26983 17.2897Z" fill="white"></path>
                        </svg>
                        <span class="fixed-header__text">Поиск</span>
                    </button>
                <?endif;?>
                <div class="fixed-header__trigger">
                    <!-- begin .nav-trigger-->
                    <button class="nav-trigger nav-trigger_type_simple nav-trigger_style_light js-toggle" type="button" data-toggle-scope=".page__body" data-toggle-class="page__body_nav_open" aria-label="Открыть меню">
                        <div class="nav-trigger__content">
                            <div class="nav-trigger__icon-wrapper">
                                <svg class="nav-trigger__icon" width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-linecap="round"></path>
                                </svg>
                            </div>
                            <div class="nav-trigger__text">меню
                            </div>
                        </div>
                    </button>
                    <!-- end .nav-trigger-->
                </div>
            </div>
        </div>
    </div>
    <!-- end .fixed-header-->
</div>
<div class="page__content">