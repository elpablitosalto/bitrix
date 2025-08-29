<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$asset = \Bitrix\Main\Page\Asset::getInstance();
global $USER, $APPLICATION;

// Определение главной страницы -->
global $isHomePage;
$isHomePage = ($APPLICATION->GetCurPage(false) === SITE_DIR);
// <--
?>
<!DOCTYPE html>
<html class="page" lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="imagetoolbar" content="no" />
    <meta name="msthemecompatible" content="no" />
    <meta name="cleartype" content="on" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="format-detection" content="address=no" />
    <meta name="google" value="notranslate" />
    <meta name="theme-color" content="#ffffff" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <link sizes="57x57" href="apple-touch-icon-57x57.png" rel="apple-touch-icon" />
    <link sizes="114x114" href="apple-touch-icon-114x114.png" rel="apple-touch-icon" />
    <link sizes="72x72" href="apple-touch-icon-72x72.png" rel="apple-touch-icon" />
    <link sizes="144x144" href="apple-touch-icon-144x144.png" rel="apple-touch-icon" />
    <link sizes="60x60" href="apple-touch-icon-60x60.png" rel="apple-touch-icon" />
    <link sizes="120x120" href="apple-touch-icon-120x120.png" rel="apple-touch-icon" />
    <link sizes="76x76" href="apple-touch-icon-76x76.png" rel="apple-touch-icon" />
    <link sizes="152x152" href="apple-touch-icon-152x152.png" rel="apple-touch-icon" />
    <link sizes="180x180" href="apple-touch-icon-180x180.png" rel="apple-touch-icon" />
    <link sizes="192x192" href="favicon-192x192.png" rel="icon" type="image/png" />
    <link sizes="160x160" href="favicon-160x160.png" rel="icon" type="image/png" />
    <link sizes="96x96" href="favicon-96x96.png" rel="icon" type="image/png" />
    <link sizes="16x16" href="favicon-16x16.png" rel="icon" type="image/png" />
    <link sizes="32x32" href="favicon-32x32.png" rel="icon" type="image/png" />
    <link rel="manifest" href="manifest.json" />
    <meta name="application-name" content="" />
    <meta name="msapplication-tooltip" content="" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="mstile-large.png" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="msapplication-square70x70logo" content="mstile-small.png" />
    <meta name="msapplication-square150x150logo" content="mstile-medium.png" />
    <meta name="msapplication-wide310x150logo" content="mstile-wide.png" />
    <meta name="msapplication-square310x310logo" content="mstile-large.png" />

    <? $APPLICATION->ShowHead(); ?>
    <title><? $APPLICATION->ShowTitle(); ?></title>

    <?
    // Strings -->
    $asset->addString('<link rel="preconnect" href="https://fonts.googleapis.com" />', true);
    $asset->addString('<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />', true);
    $asset->addString('<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&amp;display=swap" rel="stylesheet" />', true);
    // <--

    // CSS -->
    $asset->addCss(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/swiper-7.2.0/css/swiper-bundle.min.css");
    $asset->addCss(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/fancybox-4.0.7/fancybox.css");
    $asset->addCss(SITE_TEMPLATE_PATH . "/mockup/dist/assets/styles/app.css?1727686756138");
    $asset->addCss(SITE_TEMPLATE_PATH . "/mockup/dist/assets/styles/custom.css?1727686756138");
    // <--

    // JS -->
    $asset->addJs(SITE_TEMPLATE_PATH . "/js/jquery-3.7.1.min.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/swiper-7.2.0/js/swiper-bundle.min.js?1730982817638");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/fancybox-4.0.7/fancybox.umd.js?1730982817638");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/just-validate-3.10.0/just-validate.production.min.js?1730982817638");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/Inputmask/inputmask.min.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/helpers.js?1727686756138");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/common.js?1727686756138");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/validate.js?1730982817638");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/form-validation-demo.js?1730982817638");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/components-init.js?1727686756138");
    $asset->addJs("/local/js/lib/jquery.serializejson/jquery.serializejson.min.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");
    $asset->addJs("/local/js/custom.js");
    // <--
    ?>
</head>

<body class="page__body">
    <? $APPLICATION->ShowPanel(); ?>
    <div class="page__header js_page_header">
        <!-- begin .header-->
        <div class="header page__header-wrapper">
            <div class="header__top">
                <div class="header__container page__container">
                    <div class="header__lang-nav">
                        <!-- begin .lang-nav-->
                        <div class="lang-nav">
                            <ul class="lang-nav__list">
                                <li class="lang-nav__item"><a class="lang-nav__label" href="https://hair.ru/infinity/">RU</a>
                                </li>
                                <li class="lang-nav__item">
                                    <div class="lang-nav__label lang-nav__label_state_active">EN
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- end .lang-nav-->
                    </div>
                    <div class="header__simple-nav">
                        <!-- begin .nav-->
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "top",
                            array(
                                "ROOT_MENU_TYPE" => "top_sections",
                                "MAX_LEVEL" => "2",
                                "CHILD_MENU_TYPE" => "left",
                                "USE_EXT" => "Y",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "Y",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => ""
                            )
                        ); ?>
                        <!-- end .nav-->
                    </div>
                </div>
            </div>
            <div class="header__main">
                <div class="header__container page__container">
                    <div class="header__burger">
                        <!-- begin .burger-->
                        <button class="burger js-toggle" type="button" data-toggle-scope=".page__body, .header, .burger" data-toggle-class="page__body_menu_open, header_menu_open, burger_state_closed">
                            <div class="burger__bars">Открыть / закрыть меню
                            </div>
                        </button>
                        <!-- end .burger-->
                    </div>
                    <div class="header__logo">
                        <!-- begin .logo-->
                        <? if (!$isHomePage) { ?>
                            <a class="logo" href="<?= SITE_DIR ?>">
                            <? } ?>
                            <svg class="logo__figure" width="250" height="83" viewBox="0 0 250 83" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_2_520)">
                                    <path d="M245 2.00004L216.125 67L0 67L28.8754 2.00001L245 2.00004Z" />
                                </g>
                                <path d="M49.4 13.3H56.85V49H49.4V13.3ZM86.1109 49H79.1109V34.45C79.1109 32.65 78.6776 31.2667 77.8109 30.3C76.9776 29.3333 75.7443 28.85 74.1109 28.85C72.4109 28.85 71.0276 29.4833 69.9609 30.75C68.9276 32.0167 68.4109 33.55 68.4109 35.35V49H61.4109V23.3H68.1609V25.65H69.4609C71.0276 23.65 73.4109 22.65 76.6109 22.65C79.7776 22.65 82.1443 23.5667 83.7109 25.4C85.3109 27.2333 86.1109 29.8333 86.1109 33.2V49ZM104.349 29.15H97.8992V49H90.8992V29.15H87.1492V23.3H90.8992V21.45C90.8992 18.4167 91.8159 16.2 93.6492 14.8C95.4826 13.3667 97.9492 12.65 101.049 12.65H104.349V18.5H101.149C98.9826 18.5 97.8992 19.6 97.8992 21.8V23.3H104.349V29.15ZM116.199 18.9H109.099V12.65H116.199V18.9ZM116.149 23.3V49H109.149V23.3H116.149ZM144.785 49H137.785V34.45C137.785 32.65 137.351 31.2667 136.485 30.3C135.651 29.3333 134.418 28.85 132.785 28.85C131.085 28.85 129.701 29.4833 128.635 30.75C127.601 32.0167 127.085 33.55 127.085 35.35V49H120.085V23.3H126.835V25.65H128.135C129.701 23.65 132.085 22.65 135.285 22.65C138.451 22.65 140.818 23.5667 142.385 25.4C143.985 27.2333 144.785 29.8333 144.785 33.2V49ZM155.423 18.9H148.323V12.65H155.423V18.9ZM155.373 23.3V49H148.373V23.3H155.373ZM167.575 23.3H173.225V29.15H167.575V40.2C167.575 42.1 168.675 43.05 170.875 43.05H173.225V49H170.775C167.542 49 165.025 48.4167 163.225 47.25C161.458 46.05 160.575 43.9833 160.575 41.05V29.15H156.825V23.3H160.575V16.1H167.575V23.3ZM185.739 59H178.739L184.189 46.35L173.289 23.3H180.589L186.989 37H188.289L194.189 23.3H201.239L185.739 59Z" fill="white" />
                                <defs>
                                    <filter id="filter0_d_2_520" x="0" y="2" width="250" height="70" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                        <feOffset dx="5" dy="5" />
                                        <feComposite in2="hardAlpha" operator="out" />
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0" />
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_520" />
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_520" result="shape" />
                                    </filter>
                                </defs>
                            </svg>
                            <? if (!$isHomePage) { ?>
                            </a>
                        <? } ?>
                        <!-- end .logo-->
                    </div>
                    <div class="header__contacts">
                        <div class="header__links">
                            <div class="header__link">
                                <!-- begin .icon-link-->
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "/include/template/header_email.php",
                                        "AREA_FILE_RECURSIVE" => "N",
                                        "EDIT_MODE" => "html",
                                    ),
                                    false,
                                ); ?>

                                <!-- end .icon-link-->
                            </div>
                        </div>
                        <div class="header__social-nav">
                            <!-- begin .social-nav-->
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "/include/template/header_social.php",
                                    "AREA_FILE_RECURSIVE" => "N",
                                    "EDIT_MODE" => "html",
                                ),
                                false,
                            ); ?>
                            <!-- end .social-nav-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__panel">
                <div class="header__container page__container">
                    <div class="header__nav">
                        <!-- begin .nav-->
                        <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_ib", 
	array(
		"ROOT_MENU_TYPE" => "top_catalog",
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left_catalog",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "top_ib"
	),
	false
); ?>
                        <!-- end .nav-->
                    </div>
                    <div class="header__referrer">
                        <div class="header__referrer-text">Back to
                        </div>
                        <!-- begin .logo-->
                        <a class="logo header__referrer-logo" href="/">
                            <svg class="logo__figure" width="104" height="30" viewBox="0 0 104 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M50.8696 18.546C47.8533 18.546 46.1006 16.9563 46.1006 14.1438C46.1006 11.3313 47.8533 9.74166 50.8696 9.74166C53.2745 9.74166 54.8234 10.7199 55.3941 12.5134L57.4321 12.3911C56.7799 9.61937 54.4566 8.07046 50.8696 8.07046C46.5897 8.07046 44.1033 10.2715 44.1033 14.1438C44.1033 17.9754 46.5897 20.2172 50.8696 20.2172C54.5381 20.2172 56.8615 18.5868 57.4729 15.7335L55.4756 15.6112C54.9457 17.4862 53.3152 18.546 50.8696 18.546Z" />
                                <path d="M80.6262 8.07044C78.5066 8.07044 76.8762 8.72262 75.8164 9.94545V8.27425H73.9414V24.1303H75.8164V18.3422C76.8354 19.5243 78.4659 20.1764 80.6262 20.1764C84.9061 20.1764 87.1887 17.9754 87.1887 14.1031C87.148 10.2715 84.9061 8.07044 80.6262 8.07044ZM80.4224 18.546C77.4061 18.546 75.6534 16.9563 75.6534 14.1438C75.6534 11.3313 77.4061 9.74164 80.4224 9.74164C83.4387 9.74164 85.1914 11.3313 85.1914 14.1438C85.1914 16.9156 83.4387 18.546 80.4224 18.546Z" />
                                <path d="M36.3991 8.07046C34.2796 8.07046 32.6084 8.84492 31.5078 10.1085V8.27426H29.6328V20.0134H31.5078V16.2634V15.652C31.5078 15.2851 31.5078 14.8368 31.5078 14.5107C31.5078 11.9427 33.5459 9.86394 36.3991 9.86394C39.2524 9.86394 40.8013 11.5759 40.8013 14.1438C40.8013 14.796 40.8013 20.0542 40.8013 20.0542H42.7986C42.7986 20.0542 42.7986 14.796 42.7986 14.1438C42.7578 10.5161 40.4345 8.07046 36.3991 8.07046Z" />
                                <path d="M71.6573 16.9971L69.497 16.8341C68.7225 17.9346 67.3366 18.546 65.4616 18.546C62.6899 18.546 61.0187 17.2009 60.7334 14.8775H71.1274H72.1872C72.228 14.633 72.2279 14.3884 72.2279 14.1438C72.2279 10.3123 69.7415 8.07046 65.4616 8.07046C61.1817 8.07046 58.6953 10.2715 58.6953 14.1438C58.6953 17.9754 61.1817 20.2172 65.4616 20.2172C68.5187 20.1765 70.679 19.0352 71.6573 16.9971ZM65.4616 9.7009C68.1111 9.7009 69.7823 10.9645 70.1491 13.1656H60.7334C61.1002 10.9645 62.7714 9.7009 65.4616 9.7009Z" />
                                <path d="M65.4615 6.03248C66.3583 6.03248 66.9289 5.50258 66.9289 4.72812C66.9289 3.95367 66.3175 3.42377 65.4615 3.42377C64.6056 3.42377 63.9941 3.95367 63.9941 4.72812C63.9941 5.50258 64.5648 6.03248 65.4615 6.03248Z" />
                                <path d="M21.3584 8.07046C17.0785 8.07046 14.592 10.2715 14.592 14.1438C14.592 17.9754 17.0785 20.2172 21.3584 20.2172C25.6383 20.2172 28.1247 18.0161 28.1247 14.1438C28.1247 10.2715 25.6383 8.07046 21.3584 8.07046ZM21.3584 18.546C18.342 18.546 16.5893 16.9563 16.5893 14.1438C16.5893 11.3313 18.342 9.74166 21.3584 9.74166C24.3747 9.74166 26.1274 11.3313 26.1274 14.1438C26.1274 16.9156 24.3747 18.546 21.3584 18.546Z" />
                                <path d="M97.786 10.0678V8.35585H90.6121C90.6121 5.78791 90.6121 3.91291 90.6121 3.91291H88.7371C88.7371 3.91291 88.7371 12.8803 88.7371 14.1031C88.7371 17.9347 91.2235 20.1765 95.5034 20.1765C96.3186 20.1765 97.0931 20.095 97.786 19.932V18.1385C97.1338 18.383 96.3594 18.5461 95.5034 18.5461C92.4871 18.5461 90.6121 16.9564 90.6121 14.1439C90.6121 13.6955 90.6121 11.9836 90.6121 10.0678H97.786Z" />
                                <path d="M13.3696 15.6927L11.3723 15.5704C10.8424 17.4454 9.25274 18.5052 6.76632 18.5052C3.75001 18.5052 1.99729 16.9155 1.99729 14.103C1.99729 11.2905 3.75001 9.70085 6.76632 9.70085C9.17122 9.70085 10.7201 10.6791 11.2908 12.4726L13.3288 12.3503C12.6767 9.57856 10.3533 8.02965 6.76632 8.02965C2.48642 8.07041 0 10.2715 0 14.1438C0 17.9753 2.48642 20.2172 6.76632 20.2172C10.4348 20.1764 12.7582 18.5867 13.3696 15.6927Z" />
                                <path d="M26.1682 26.6575C24.9046 26.6575 24.2117 27.2689 24.2117 28.3287C24.2117 29.3885 24.9454 29.9999 26.1682 29.9999C27.4318 29.9999 28.1247 29.3885 28.1247 28.3287C28.1247 27.2689 27.391 26.6575 26.1682 26.6575ZM26.1682 29.2254C25.516 29.2254 25.1492 28.8994 25.1492 28.3287C25.1492 27.758 25.516 27.432 26.1682 27.432C26.8204 27.432 27.1872 27.758 27.1872 28.3287C27.1872 28.8994 26.8204 29.2254 26.1682 29.2254Z" />
                                <path d="M64.8911 26.6575C63.6275 26.6575 62.9346 27.2689 62.9346 28.3287C62.9346 29.3885 63.6683 29.9999 64.8911 29.9999C66.1547 29.9999 66.8476 29.3885 66.8476 28.3287C66.8476 27.2689 66.1139 26.6575 64.8911 26.6575ZM64.8911 29.2254C64.2389 29.2254 63.8721 28.8993 63.8721 28.3287C63.8721 27.758 64.2389 27.4319 64.8911 27.4319C65.5433 27.4319 65.9101 27.758 65.9101 28.3287C65.9101 28.8993 65.5433 29.2254 64.8911 29.2254Z" />
                                <path d="M72.7182 29.0217L71.0062 26.7391H70.5579H69.9057H69.6611V29.9184H70.5579V27.5951L72.2698 29.9184H72.7182H73.3704H73.615V26.7391H72.7182V29.0217Z" />
                                <path d="M59.6741 26.7391H58.7773V29.9184H59.6741V26.7391Z" />
                                <path d="M31.7926 26.7391H31.4258V29.9184H32.3225V28.8994H34.1975V28.2065H32.3225V27.4728H34.5236V26.7391H32.3225H31.7926Z" />
                                <path d="M39.3342 28.6549H41.4946V27.9619H39.3342V27.4728H41.7391V26.7391H39.3342H38.8043H38.4375V29.9185H38.8043H39.3342H41.8207V29.144H39.3342V28.6549Z" />
                                <path d="M83.9671 26.7391H83.0703V29.144V29.9185H83.9671H86.0866V29.144H83.9671V26.7391Z" />
                                <path d="M13.9809 26.7391H12.0651H11.6982V29.9184H12.595V28.8994H13.9809C14.6738 28.8994 15.0814 28.5326 15.0814 27.7989C15.0814 27.1059 14.6738 26.7391 13.9809 26.7391ZM13.7771 28.2065H12.595V27.5135H13.7771C13.9809 27.5135 14.1439 27.6766 14.1439 27.8804C14.1439 28.0434 13.9809 28.2065 13.7771 28.2065Z" />
                                <path d="M21.3578 27.7989C21.3578 27.1059 20.9909 26.6983 20.2572 26.6983H18.3415H17.9746V29.8777H18.8714V28.8994H19.442L20.2572 29.9184H21.3985L20.461 28.8994C21.0317 28.8179 21.3578 28.451 21.3578 27.7989ZM18.8714 27.4728H20.0534C20.2572 27.4728 20.4203 27.6358 20.4203 27.8396C20.4203 28.0434 20.2572 28.2065 20.0534 28.2065H18.8714V27.4728Z" />
                                <path d="M78.5468 26.7391H78.0169H77.65L76.1826 29.9184H77.0794L77.3647 29.2663H79.1582L79.4435 29.9184H80.3402L78.9136 26.7391H78.5468ZM77.7315 28.5326L78.3022 27.269L78.8728 28.5326H77.7315Z" />
                                <path d="M47.7289 27.9618L46.5468 27.8803C46.343 27.8803 46.2615 27.7988 46.2615 27.6765C46.2615 27.4727 46.7098 27.3912 47.0767 27.3912C47.4843 27.3912 47.8104 27.4727 47.8511 27.595L48.7479 27.5542C48.7071 27.1058 48.3403 26.6167 47.0767 26.6167C46.2207 26.6167 45.324 26.8613 45.324 27.6765C45.324 28.2064 45.7723 28.4917 46.4245 28.5732L47.6066 28.6548C47.8511 28.6955 47.9734 28.7363 47.9734 28.8993C47.9734 29.1031 47.6473 29.1846 47.1582 29.1846C46.6691 29.1846 46.3022 29.0624 46.2615 28.8178L45.2832 28.8586C45.3647 29.4292 45.7723 29.9183 47.1582 29.9183C48.218 29.9183 48.9109 29.5923 48.9109 28.8586C48.8702 28.3287 48.4626 28.0433 47.7289 27.9618Z" />
                                <path d="M54.4164 27.9618L53.2343 27.8803C53.0305 27.8803 52.949 27.7988 52.949 27.6765C52.949 27.4727 53.3973 27.3912 53.7642 27.3912C54.1718 27.3912 54.4979 27.4727 54.5386 27.595L55.4354 27.5542C55.3946 27.1058 55.0278 26.6167 53.7642 26.6167C52.9082 26.6167 52.0115 26.8613 52.0115 27.6765C52.0115 28.2064 52.4598 28.4917 53.112 28.5732L54.2941 28.6547C54.5386 28.6955 54.6609 28.7363 54.6609 28.8993C54.6609 29.1031 54.3348 29.1846 53.8457 29.1846C53.3566 29.1846 52.9897 29.0623 52.949 28.8178L51.9707 28.8585C52.0522 29.4292 52.4598 29.9183 53.8457 29.9183C54.9055 29.9183 55.5984 29.5922 55.5984 28.8585C55.5984 28.3287 55.1501 28.0433 54.4164 27.9618Z" />
                                <path d="M100.598 0.978294H101.78C102.066 0.978294 102.27 1.05982 102.433 1.1821C102.596 1.30438 102.677 1.50819 102.677 1.75275C102.677 2.07884 102.555 2.32341 102.27 2.44569L102.677 3.66852H102.31L101.903 2.52721C101.821 2.52721 101.78 2.52721 101.699 2.52721H100.924V3.62776H100.598V0.978294ZM100.965 2.24188H101.74C102.147 2.24188 102.31 2.07884 102.31 1.75275C102.31 1.58971 102.27 1.46743 102.188 1.3859C102.107 1.30438 101.944 1.26362 101.74 1.26362H100.965V2.24188Z" />
                                <path d="M101.658 4.64671C100.354 4.64671 99.3347 3.58693 99.3347 2.32334C99.3347 1.05975 100.395 -3.8147e-05 101.658 -3.8147e-05C102.962 -3.8147e-05 103.981 1.05975 103.981 2.32334C103.981 3.58693 102.922 4.64671 101.658 4.64671ZM101.658 0.285289C100.558 0.285289 99.62 1.18203 99.62 2.32334C99.62 3.46464 100.517 4.36138 101.658 4.36138C102.759 4.36138 103.696 3.46464 103.696 2.32334C103.696 1.18203 102.759 0.285289 101.658 0.285289Z" />
                            </svg>
                        </a>
                        <!-- end .logo-->
                    </div>
                </div>
            </div>
        </div>
        <!-- end .header-->
    </div>
    <div class="page__content">

        <? $APPLICATION->ShowViewContent('TOP_BIG_SLIDER'); ?>

        <? if (!$isHomePage) { ?>

            <? $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "infinity_en",
                array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => "s1"
                )
            ); ?>

        <? } ?>