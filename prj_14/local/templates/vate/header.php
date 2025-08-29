<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

// Определение главной страницы -->
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
    <link rel="icon" type="image/png" sizes="32x32" href="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/components/choices/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/components/choices/images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/components/choices/images/apple-touch-icon.png">
    <link rel="manifest" href="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/manifest.json" />
    <meta name="msapplication-config" content="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/components/choices/images/browserconfig.xml">
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
    <title><? $APPLICATION->ShowTitle() ?></title>

    <script>
        let appResources = {
            choices: {
                initiated: false,
                delay: 2000,
                items: [{
                        name: 'choices-css',
                        type: 'css',
                        src: '<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/components/choices/styles/choices.min.css'
                    },
                    {
                        name: 'choices-js',
                        type: 'js',
                        src: 'assets/components/choices/scripts/choices.min.js'
                    },
                ],
            },
            fancybox: {
                initiated: false,
                delay: 0,
                items: [{
                        name: 'fancybox-css',
                        type: 'css',
                        src: '<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/components/fancybox-4.0.7/fancybox.css'
                    },
                    {
                        name: 'fancybox-js',
                        type: 'js',
                        src: '<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/components/fancybox-4.0.7/fancybox.umd.js'
                    },
                ],
            },
        };
    </script>

    <? Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/swiper-11.0.7/swiper-bundle.min.css"); ?>
    <? Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/mockup/dist/assets/styles/app.css"); ?>
    <? Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/custom.css"); ?>

    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery-3.7.1.min.js"); ?>
    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js"); ?>
    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/just-validate-3.10.0/just-validate.production.min.js"); ?>
    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/swiper-11.0.7/swiper-bundle.min.js"); ?>
    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/Inputmask/inputmask.min.js"); ?>
    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/resource-loader.js"); ?>
    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/helpers.js"); ?>
    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/common.js"); ?>
    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/custom.js"); ?>
    <? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/validate.js"); ?>
</head>

<body class="page__body" id="body">
    <? $APPLICATION->ShowPanel() ?>
    <div class="page__header">
        <!-- begin .header-->
        <div class="header page__header-wrapper">
            <div class="header__top">
                <div class="header__top-wrapper">Интернет-магазин работает 24/7
                </div>
            </div>
            <div class="header__main">
                <div class="page__container">
                    <div class="header__main-wrapper">
                        <div class="header__burger">
                            <!-- begin .button-->
                            <button class="button button_style_transparent button_size_m js-toggle" type="button" data-toggle-scope=".page__body" data-toggle-class="page__body_nav_open" aria-label="Открыть меню">
                                <span class="button__holder"><svg class="button__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 18.1631V16.1631H21V18.1631H3ZM3 13.1631V11.1631H21V13.1631H3ZM3 8.16309V6.16309H21V8.16309H3Z" fill="url(#paint0_linear_2149_1884)" />
                                        <defs>
                                            <linearGradient id="paint0_linear_2149_1884" x1="12" y1="6.16309" x2="12" y2="18.1631" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#FFEAA6" />
                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                <stop offset="1" stop-color="#FFC737" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </span>
                            </button>
                            <!-- end .button-->
                        </div>
                        <div class="header__logo">
                            <!-- begin .logo-->
                            <a class="logo" href="/">
                                <picture class="logo__picture">
                                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets//blocks/logo/images/logo-s.svg" type="image/svg+xml" media="(max-width: 1439px)" class="logo__source" />
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets//blocks/logo/images/logo.svg" alt="image" class="logo__image" title="" />
                                </picture>
                            </a>
                            <!-- end .logo-->
                        </div>
                        <div class="header__contact-group">
                            <div class="header__contact">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/template/phone_header.php",
                                        "AREA_FILE_RECURSIVE" => "N",
                                        "EDIT_MODE" => "html",
                                    ),
                                    false,
                                    array('HIDE_ICONS' => 'N')
                                ); ?>
                            </div>
                            <div class="header__contact">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/template/email_header.php",
                                        "AREA_FILE_RECURSIVE" => "N",
                                        "EDIT_MODE" => "html",
                                    ),
                                    false,
                                    array('HIDE_ICONS' => 'N')
                                ); ?>
                            </div>
                            <div class="header__contact header__contact_type_control">
                                <!-- begin .button-->
                                <a class="button button_style_outline button_width_full button_size_s js-modal" href="#modalCallback">
                                    <span class="button__holder">Заказать звонок</span></a>
                                <!-- end .button-->
                            </div>
                        </div>
                        <div class="header__geo-selector disabled-element">
                            <!-- begin .geo-selector-->
                            <div class="geo-selector"><a class="geo-selector__trigger js-modal disabled-element" href="#modalStorageSelect"><svg class="geo-selector__icon" width="20" height="23" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.9112 14.375C13.7681 16.0436 12.0761 17.7799 9.83531 19.5838C7.59446 17.7799 5.90252 16.0436 4.75946 14.375C3.6164 12.7064 3.04488 11.1392 3.04488 9.67353C3.04488 8.41078 3.27688 7.33407 3.7409 6.44338C4.20491 5.5527 4.77644 4.83113 5.45548 4.27868C6.13452 3.72623 6.87015 3.32598 7.66237 3.07794C8.45459 2.8299 9.1789 2.70588 9.83531 2.70588C10.4917 2.70588 11.216 2.8299 12.0082 3.07794C12.8005 3.32598 13.5361 3.72623 14.2151 4.27868C14.8942 4.83113 15.4657 5.5527 15.9297 6.44338C16.3937 7.33407 16.6257 8.41078 16.6257 9.67353C16.6257 11.1392 16.0542 12.7064 14.9112 14.375ZM2.68838 16.1676C4.2615 18.3775 6.6438 20.6549 9.83531 23C13.0268 20.6549 15.4091 18.3775 16.9822 16.1676C18.5553 13.9578 19.3419 11.7931 19.3419 9.67353C19.3419 8.07255 19.0533 6.66887 18.4761 5.4625C17.8989 4.25613 17.1577 3.24706 16.2523 2.43529C15.3469 1.62353 14.3283 1.01471 13.1966 0.608824C12.0648 0.202941 10.9444 0 9.83531 0C8.7262 0 7.60578 0.202941 6.47404 0.608824C5.34231 1.01471 4.32374 1.62353 3.41835 2.43529C2.51296 3.24706 1.77167 4.25613 1.19448 5.4625C0.617298 6.66887 0.328705 8.07255 0.328705 9.67353C0.328705 11.7931 1.11526 13.9578 2.68838 16.1676ZM11.7536 11.3816C11.2217 11.9115 10.5823 12.1765 9.83531 12.1765C9.08836 12.1765 8.44893 11.9115 7.91701 11.3816C7.38509 10.8517 7.11913 10.2147 7.11913 9.47059C7.11913 8.72647 7.38509 8.08946 7.91701 7.55956C8.44893 7.02966 9.08836 6.76471 9.83531 6.76471C10.5823 6.76471 11.2217 7.02966 11.7536 7.55956C12.2855 8.08946 12.5515 8.72647 12.5515 9.47059C12.5515 10.2147 12.2855 10.8517 11.7536 11.3816Z" fill="url(#paint0_linear_2111_8621)" />
                                        <defs>
                                            <linearGradient id="paint0_linear_2111_8621" x1="9.83531" y1="0" x2="9.83531" y2="23" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#FFEAA6" />
                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                <stop offset="1" stop-color="#FFC737" />
                                            </linearGradient>
                                        </defs>
                                    </svg><span class="geo-selector__title">Склад</span><span class="geo-selector__label">г. Санкт-Петербург</span></a>
                            </div>
                            <!-- end .geo-selector-->
                        </div>
                        <div class="header__navigations disabled-element">
                            <div class="header__icon-controls">
                                <!-- begin .icon-controls-->
                                <div class="icon-controls">
                                    <ul class="icon-controls__list">
                                        <li class="icon-controls__item icon-controls__item icon-controls__item_hide-xxl">
                                            <!-- begin .icon-control--><a class="icon-control js-modal " href="#modalStorageSelect"><span class="icon-control__illustration"><svg class="icon-control__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 12.1631C12.55 12.1631 13.0208 11.9673 13.4125 11.5756C13.8042 11.1839 14 10.7131 14 10.1631C14 9.61309 13.8042 9.14225 13.4125 8.75059C13.0208 8.35892 12.55 8.16309 12 8.16309C11.45 8.16309 10.9792 8.35892 10.5875 8.75059C10.1958 9.14225 10 9.61309 10 10.1631C10 10.7131 10.1958 11.1839 10.5875 11.5756C10.9792 11.9673 11.45 12.1631 12 12.1631ZM12 19.5131C14.0333 17.6464 15.5417 15.9506 16.525 14.4256C17.5083 12.9006 18 11.5464 18 10.3631C18 8.54642 17.4208 7.05892 16.2625 5.90059C15.1042 4.74225 13.6833 4.16309 12 4.16309C10.3167 4.16309 8.89583 4.74225 7.7375 5.90059C6.57917 7.05892 6 8.54642 6 10.3631C6 11.5464 6.49167 12.9006 7.475 14.4256C8.45833 15.9506 9.96667 17.6464 12 19.5131ZM12 22.1631C9.31667 19.8798 7.3125 17.7589 5.9875 15.8006C4.6625 13.8423 4 12.0298 4 10.3631C4 7.86309 4.80417 5.87142 6.4125 4.38809C8.02083 2.90475 9.88333 2.16309 12 2.16309C14.1167 2.16309 15.9792 2.90475 17.5875 4.38809C19.1958 5.87142 20 7.86309 20 10.3631C20 12.0298 19.3375 13.8423 18.0125 15.8006C16.6875 17.7589 14.6833 19.8798 12 22.1631Z" fill="url(#paint0_linear_2149_1888)" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_2149_1888" x1="12" y1="2.16309" x2="12" y2="22.1631" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#FFEAA6" />
                                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                                <stop offset="1" stop-color="#FFC737" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg></span></a>
                                            <!-- end .icon-control-->
                                        </li>
                                        <li class="icon-controls__item icon-controls__item icon-controls__item_hide-m">
                                            <!-- begin .icon-control--><a class="icon-control js-modal " href="#modalSearch"><span class="icon-control__illustration"><svg class="icon-control__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M19.6 21.1631L13.3 14.8631C12.8 15.2631 12.225 15.5798 11.575 15.8131C10.925 16.0464 10.2333 16.1631 9.5 16.1631C7.68333 16.1631 6.14583 15.5339 4.8875 14.2756C3.62917 13.0173 3 11.4798 3 9.66309C3 7.84642 3.62917 6.30892 4.8875 5.05059C6.14583 3.79225 7.68333 3.16309 9.5 3.16309C11.3167 3.16309 12.8542 3.79225 14.1125 5.05059C15.3708 6.30892 16 7.84642 16 9.66309C16 10.3964 15.8833 11.0881 15.65 11.7381C15.4167 12.3881 15.1 12.9631 14.7 13.4631L21 19.7631L19.6 21.1631ZM9.5 14.1631C10.75 14.1631 11.8125 13.7256 12.6875 12.8506C13.5625 11.9756 14 10.9131 14 9.66309C14 8.41309 13.5625 7.35059 12.6875 6.47559C11.8125 5.60059 10.75 5.16309 9.5 5.16309C8.25 5.16309 7.1875 5.60059 6.3125 6.47559C5.4375 7.35059 5 8.41309 5 9.66309C5 10.9131 5.4375 11.9756 6.3125 12.8506C7.1875 13.7256 8.25 14.1631 9.5 14.1631Z" fill="url(#paint0_linear_2149_1890)" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_2149_1890" x1="12" y1="3.16309" x2="12" y2="21.1631" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#FFEAA6" />
                                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                                <stop offset="1" stop-color="#FFC737" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg></span></a>
                                            <!-- end .icon-control-->
                                        </li>
                                        <li class="icon-controls__item icon-controls__item icon-controls__item_show-m">
                                            <!-- begin .icon-control-->
                                             <a class="icon-control  " href="/lk/">
                                                <span class="icon-control__illustration"><svg class="icon-control__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 12.1631C10.9 12.1631 9.95833 11.7714 9.175 10.9881C8.39167 10.2048 8 9.26309 8 8.16309C8 7.06309 8.39167 6.12142 9.175 5.33809C9.95833 4.55475 10.9 4.16309 12 4.16309C13.1 4.16309 14.0417 4.55475 14.825 5.33809C15.6083 6.12142 16 7.06309 16 8.16309C16 9.26309 15.6083 10.2048 14.825 10.9881C14.0417 11.7714 13.1 12.1631 12 12.1631ZM4 20.1631V17.3631C4 16.7964 4.14583 16.2756 4.4375 15.8006C4.72917 15.3256 5.11667 14.9631 5.6 14.7131C6.63333 14.1964 7.68333 13.8089 8.75 13.5506C9.81667 13.2923 10.9 13.1631 12 13.1631C13.1 13.1631 14.1833 13.2923 15.25 13.5506C16.3167 13.8089 17.3667 14.1964 18.4 14.7131C18.8833 14.9631 19.2708 15.3256 19.5625 15.8006C19.8542 16.2756 20 16.7964 20 17.3631V20.1631H4ZM6 18.1631H18V17.3631C18 17.1798 17.9542 17.0131 17.8625 16.8631C17.7708 16.7131 17.65 16.5964 17.5 16.5131C16.6 16.0631 15.6917 15.7256 14.775 15.5006C13.8583 15.2756 12.9333 15.1631 12 15.1631C11.0667 15.1631 10.1417 15.2756 9.225 15.5006C8.30833 15.7256 7.4 16.0631 6.5 16.5131C6.35 16.5964 6.22917 16.7131 6.1375 16.8631C6.04583 17.0131 6 17.1798 6 17.3631V18.1631ZM12 10.1631C12.55 10.1631 13.0208 9.96725 13.4125 9.57559C13.8042 9.18392 14 8.71309 14 8.16309C14 7.61309 13.8042 7.14225 13.4125 6.75059C13.0208 6.35892 12.55 6.16309 12 6.16309C11.45 6.16309 10.9792 6.35892 10.5875 6.75059C10.1958 7.14225 10 7.61309 10 8.16309C10 8.71309 10.1958 9.18392 10.5875 9.57559C10.9792 9.96725 11.45 10.1631 12 10.1631Z" fill="url(#paint0_linear_2149_13552)" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_2149_13552" x1="12" y1="4.16309" x2="12" y2="20.1631" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#FFEAA6" />
                                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                                <stop offset="1" stop-color="#FFC737" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg></span><span class="icon-control__label">Кабинет</span></a>
                                            <!-- end .icon-control-->
                                        </li>
                                        <li class="icon-controls__item icon-controls__item icon-controls__item_show-m">
                                            <!-- begin .icon-control--><a class="icon-control " href="/lk/orders/"><span class="icon-control__illustration"><svg class="icon-control__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9 21.1631C7.33333 21.1631 5.91667 20.5798 4.75 19.4131C3.58333 18.2464 3 16.8298 3 15.1631V9.16309C3 7.49642 3.58333 6.07975 4.75 4.91309C5.91667 3.74642 7.33333 3.16309 9 3.16309H15C16.6667 3.16309 18.0833 3.74642 19.25 4.91309C20.4167 6.07975 21 7.49642 21 9.16309V15.1631C21 16.8298 20.4167 18.2464 19.25 19.4131C18.0833 20.5798 16.6667 21.1631 15 21.1631H9ZM11 16.1631L17 10.1631L15.6 8.76309L11 13.3631L8.8 11.1631L7.4 12.5631L11 16.1631ZM9 19.1631H15C16.1 19.1631 17.0417 18.7714 17.825 17.9881C18.6083 17.2048 19 16.2631 19 15.1631V9.16309C19 8.06309 18.6083 7.12142 17.825 6.33809C17.0417 5.55475 16.1 5.16309 15 5.16309H9C7.9 5.16309 6.95833 5.55475 6.175 6.33809C5.39167 7.12142 5 8.06309 5 9.16309V15.1631C5 16.2631 5.39167 17.2048 6.175 17.9881C6.95833 18.7714 7.9 19.1631 9 19.1631Z" fill="url(#paint0_linear_2149_13554)" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_2149_13554" x1="12" y1="3.16309" x2="12" y2="21.1631" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#FFEAA6" />
                                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                                <stop offset="1" stop-color="#FFC737" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg></span><span class="icon-control__label">Заказы</span></a>
                                            <!-- end .icon-control-->
                                        </li>
                                        <li class="icon-controls__item icon-controls__item icon-controls__item_show-m">
                                            <!-- begin .icon-control--><a class="icon-control " href="/lk/favourites/"><span class="icon-control__illustration"><svg class="icon-control__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 21.1635L10.55 19.8635C8.86667 18.3468 7.475 17.0385 6.375 15.9385C5.275 14.8385 4.4 13.851 3.75 12.976C3.1 12.101 2.64583 11.2968 2.3875 10.5635C2.12917 9.83014 2 9.08014 2 8.31348C2 6.74681 2.525 5.43848 3.575 4.38848C4.625 3.33848 5.93333 2.81348 7.5 2.81348C8.36667 2.81348 9.19167 2.99681 9.975 3.36348C10.7583 3.73014 11.4333 4.24681 12 4.91348C12.5667 4.24681 13.2417 3.73014 14.025 3.36348C14.8083 2.99681 15.6333 2.81348 16.5 2.81348C18.0667 2.81348 19.375 3.33848 20.425 4.38848C21.475 5.43848 22 6.74681 22 8.31348C22 9.08014 21.8708 9.83014 21.6125 10.5635C21.3542 11.2968 20.9 12.101 20.25 12.976C19.6 13.851 18.725 14.8385 17.625 15.9385C16.525 17.0385 15.1333 18.3468 13.45 19.8635L12 21.1635ZM12 18.4635C13.6 17.0301 14.9167 15.801 15.95 14.776C16.9833 13.751 17.8 12.8593 18.4 12.101C19 11.3426 19.4167 10.6676 19.65 10.076C19.8833 9.48431 20 8.89681 20 8.31348C20 7.31348 19.6667 6.48014 19 5.81348C18.3333 5.14681 17.5 4.81348 16.5 4.81348C15.7167 4.81348 14.9917 5.03431 14.325 5.47598C13.6583 5.91764 13.2 6.48014 12.95 7.16348H11.05C10.8 6.48014 10.3417 5.91764 9.675 5.47598C9.00833 5.03431 8.28333 4.81348 7.5 4.81348C6.5 4.81348 5.66667 5.14681 5 5.81348C4.33333 6.48014 4 7.31348 4 8.31348C4 8.89681 4.11667 9.48431 4.35 10.076C4.58333 10.6676 5 11.3426 5.6 12.101C6.2 12.8593 7.01667 13.751 8.05 14.776C9.08333 15.801 10.4 17.0301 12 18.4635Z" fill="url(#paint0_linear_2149_13556)" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_2149_13556" x1="12" y1="2.81348" x2="12" y2="21.1635" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#FFEAA6" />
                                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                                <stop offset="1" stop-color="#FFC737" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg></span><span class="icon-control__label">Избранное</span></a>
                                            <!-- end .icon-control-->
                                        </li>
                                        <li class="icon-controls__item icon-controls__item icon-controls__item_show-m">
                                            <!-- begin .icon-control--><a class="icon-control" href="/compare/"><span class="icon-control__illustration"><svg class="icon-control__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4 20.1631V12.1631H8V20.1631H4ZM10 20.1631V4.16309H14V20.1631H10ZM16 20.1631V9.16309H20V20.1631H16Z" fill="url(#paint0_linear_2149_13558)" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_2149_13558" x1="12" y1="4.16309" x2="12" y2="20.1631" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#FFEAA6" />
                                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                                <stop offset="1" stop-color="#FFC737" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg></span><span class="icon-control__label">Сравнение</span></a>
                                            <!-- end .icon-control-->
                                        </li>
                                        <li class="icon-controls__item">
                                            <!-- begin .icon-control-->
                                            <a class="icon-control " href="/basket/">
                                                <span class="icon-control__illustration">
                                                    <svg class="icon-control__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7 22.1631C6.45 22.1631 5.97917 21.9673 5.5875 21.5756C5.19583 21.1839 5 20.7131 5 20.1631C5 19.6131 5.19583 19.1423 5.5875 18.7506C5.97917 18.3589 6.45 18.1631 7 18.1631C7.55 18.1631 8.02083 18.3589 8.4125 18.7506C8.80417 19.1423 9 19.6131 9 20.1631C9 20.7131 8.80417 21.1839 8.4125 21.5756C8.02083 21.9673 7.55 22.1631 7 22.1631ZM17 22.1631C16.45 22.1631 15.9792 21.9673 15.5875 21.5756C15.1958 21.1839 15 20.7131 15 20.1631C15 19.6131 15.1958 19.1423 15.5875 18.7506C15.9792 18.3589 16.45 18.1631 17 18.1631C17.55 18.1631 18.0208 18.3589 18.4125 18.7506C18.8042 19.1423 19 19.6131 19 20.1631C19 20.7131 18.8042 21.1839 18.4125 21.5756C18.0208 21.9673 17.55 22.1631 17 22.1631ZM6.15 6.16309L8.55 11.1631H15.55L18.3 6.16309H6.15ZM5.2 4.16309H19.95C20.3333 4.16309 20.625 4.33392 20.825 4.67559C21.025 5.01725 21.0333 5.36309 20.85 5.71309L17.3 12.1131C17.1167 12.4464 16.8708 12.7048 16.5625 12.8881C16.2542 13.0714 15.9167 13.1631 15.55 13.1631H8.1L7 15.1631H19V17.1631H7C6.25 17.1631 5.68333 16.8339 5.3 16.1756C4.91667 15.5173 4.9 14.8631 5.25 14.2131L6.6 11.7631L3 4.16309H1V2.16309H4.25L5.2 4.16309Z" fill="url(#paint0_linear_2149_13561)" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_2149_13561" x1="10.9908" y1="2.16309" x2="10.9908" y2="22.1631" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#FFEAA6" />
                                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                                <stop offset="1" stop-color="#FFC737" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg>
                                                </span>
                                                <span class="icon-control__label">Корзина</span></a>
                                            <!-- end .icon-control-->
                                        </li>
                                    </ul>
                                </div>
                                <!-- end .icon-controls-->
                            </div>
                            <div class="header__search">
                                <!-- begin .search-panel-->
                                <form class="search-panel">
                                    <div class="search-panel__field">
                                        <!-- begin .form-control-->
                                        <div class="form-control">
                                            <label class="form-control__holder"><span class="form-control__field">
                                                    <!-- Modifiers-->
                                                    <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field--><input class="form-control__input form-control__input form-control__input_style_transparent form-control__input form-control__input_size_s search-panel__input js-search-with-results" type="text" placeholder="Например: крупногабаритная шина" />
                                                    <!-- Иконка показывается, когда поле прошло валидацию и инпут имеет класс form-control__input_state_success-->
                                                    <svg class="form-control__icon form-control__icon_success" width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1.91284 3.30769L5.72237 7L11.9128 1" stroke="black" stroke-width="2" stroke-linecap="round"></path>
                                                    </svg>
                                                    <!-- Иконка показывается, когда поле не прошло валидацию и инпут имеет класс form-control__input_state_error-->
                                                    <svg class="form-control__icon form-control__icon_error" width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1.91284 1L7.91284 7" stroke="#FF0000" stroke-width="2" stroke-linecap="round"></path>
                                                        <path d="M7.91284 1L1.91284 7" stroke="#FF0000" stroke-width="2" stroke-linecap="round"></path>
                                                    </svg></span><span class="form-control__messages"><span class="form-control__message form-control__message_style_error" style="display: none;">Ошибка поля</span></span>
                                            </label>
                                        </div>
                                        <!-- end .form-control-->
                                        <div class="search-panel__clear-control">
                                            <button class="search-panel__clear js-search-clear" type="button" data-toggle-scope=".page__header" data-toggle-class="header_search_open">
                                            </button>
                                        </div>
                                        <div class="search-panel__control">
                                            <!-- begin .button-->
                                            <button class="button button_size_s button_width_full button_rounded_m button_style_muted" type="submit"><span class="button__holder">Поиск</span>
                                            </button>
                                            <!-- end .button-->
                                        </div>
                                    </div>
                                    <div class="search-panel__results">
                                        <!-- begin .search-results-->
                                        <div class="search-results">
                                            <div class="search-results__message">Нет совпадений
                                            </div>
                                            <div class="search-results__matches">
                                                <ul class="search-results__list">
                                                    <li class="search-results__item"><a class="search-results__link disabled-element" href="#"><span class="search-results__image">
                                                                <picture class="search-results__picture"><img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets//blocks/search-results/images/1.png" alt="image" class="search-results__image" title="" />
                                                                </picture>
                                                            </span><span class="search-results__wrapper"><span class="search-results__name"><b>Крупногабаритная шина Advance</b> E-4J E-4 (58pr) TL</span><span class="search-results__price">100 500 ₽</span></span></a>
                                                    </li>
                                                    <li class="search-results__item"><a class="search-results__link disabled-element" href="#"><span class="search-results__image">
                                                                <picture class="search-results__picture"><img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets//blocks/search-results/images/2.png" alt="image" class="search-results__image" title="" />
                                                                </picture>
                                                            </span><span class="search-results__wrapper"><span class="search-results__name"><b>Крупногабаритная шина Advance</b> E-4J E-4 (58pr) TL</span><span class="search-results__price">85 000 ₽</span></span></a>
                                                    </li>
                                                    <li class="search-results__item"><a class="search-results__link disabled-element" href="#"><span class="search-results__image">
                                                                <picture class="search-results__picture"><img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets//blocks/search-results/images/3.png" alt="image" class="search-results__image" title="" />
                                                                </picture>
                                                            </span><span class="search-results__wrapper"><span class="search-results__name"><b>Крупногабаритная шина Advance</b> E-4J E-4 (58pr) TL</span><span class="search-results__price">60 000 ₽</span></span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="search-results__control">
                                                <!-- begin .button-->
                                                <button class="button button_style_dark button_width_full" type="button"><span class="button__holder">Все результаты</span>
                                                </button>
                                                <!-- end .button-->
                                            </div>
                                        </div>
                                        <!-- end .search-results-->
                                    </div>
                                </form>
                                <!-- end .search-form-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end .header-->
        <!-- begin .fixed-header-->
        <div class="fixed-header">
            <div class="fixed-header__main">
                <div class="page__container">
                    <div class="fixed-header__main-wrapper">
                        <div class="fixed-header__burger">
                            <!-- begin .button-->
                            <button class="button button_style_transparent button_size_m js-toggle" type="button" data-toggle-scope=".page__body" data-toggle-class="page__body_nav_open" aria-label="Открыть меню"><span class="button__holder"><svg class="button__icon" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 18.1631V16.1631H21V18.1631H3ZM3 13.1631V11.1631H21V13.1631H3ZM3 8.16309V6.16309H21V8.16309H3Z" fill="url(#paint0_linear_2149_1884)" />
                                        <defs>
                                            <linearGradient id="paint0_linear_2149_1884" x1="12" y1="6.16309" x2="12" y2="18.1631" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#FFEAA6" />
                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                <stop offset="1" stop-color="#FFC737" />
                                            </linearGradient>
                                        </defs>
                                    </svg></span>
                            </button>
                            <!-- end .button-->
                        </div>
                        <div class="fixed-header__logo">
                            <!-- begin .logo-->
                            <a class="logo" href="/">
                                <picture class="logo__picture"><img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets//blocks/logo/images/logo-s.svg" alt="image" class="logo__image" title="" />
                                </picture>
                            </a>
                            <!-- end .logo-->
                        </div>
                        <div class="fixed-header__navigations disabled-element">
                            <div class="fixed-header__icon-controls">
                                <!-- begin .icon-controls-->
                                <div class="icon-controls">
                                    <ul class="icon-controls__list">
                                        <li class="icon-controls__item icon-controls__item icon-controls__item_hide-xxl">
                                            <!-- begin .icon-control--><a class="icon-control js-modal disabled-element" href="#modalCallback"><span class="icon-control__illustration"><svg class="icon-control__icon" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 12.1631C12.55 12.1631 13.0208 11.9673 13.4125 11.5756C13.8042 11.1839 14 10.7131 14 10.1631C14 9.61309 13.8042 9.14225 13.4125 8.75059C13.0208 8.35892 12.55 8.16309 12 8.16309C11.45 8.16309 10.9792 8.35892 10.5875 8.75059C10.1958 9.14225 10 9.61309 10 10.1631C10 10.7131 10.1958 11.1839 10.5875 11.5756C10.9792 11.9673 11.45 12.1631 12 12.1631ZM12 19.5131C14.0333 17.6464 15.5417 15.9506 16.525 14.4256C17.5083 12.9006 18 11.5464 18 10.3631C18 8.54642 17.4208 7.05892 16.2625 5.90059C15.1042 4.74225 13.6833 4.16309 12 4.16309C10.3167 4.16309 8.89583 4.74225 7.7375 5.90059C6.57917 7.05892 6 8.54642 6 10.3631C6 11.5464 6.49167 12.9006 7.475 14.4256C8.45833 15.9506 9.96667 17.6464 12 19.5131ZM12 22.1631C9.31667 19.8798 7.3125 17.7589 5.9875 15.8006C4.6625 13.8423 4 12.0298 4 10.3631C4 7.86309 4.80417 5.87142 6.4125 4.38809C8.02083 2.90475 9.88333 2.16309 12 2.16309C14.1167 2.16309 15.9792 2.90475 17.5875 4.38809C19.1958 5.87142 20 7.86309 20 10.3631C20 12.0298 19.3375 13.8423 18.0125 15.8006C16.6875 17.7589 14.6833 19.8798 12 22.1631Z" fill="url(#paint0_linear_2149_1888)" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_2149_1888" x1="12" y1="2.16309" x2="12" y2="22.1631" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#FFEAA6" />
                                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                                <stop offset="1" stop-color="#FFC737" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg></span></a>
                                            <!-- end .icon-control-->
                                        </li>
                                        <li class="icon-controls__item icon-controls__item icon-controls__item_hide-m">
                                            <!-- begin .icon-control-->
                                            <div class="icon-control">
                                                <div class="icon-control__illustration"><svg class="icon-control__icon" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M19.6 21.1631L13.3 14.8631C12.8 15.2631 12.225 15.5798 11.575 15.8131C10.925 16.0464 10.2333 16.1631 9.5 16.1631C7.68333 16.1631 6.14583 15.5339 4.8875 14.2756C3.62917 13.0173 3 11.4798 3 9.66309C3 7.84642 3.62917 6.30892 4.8875 5.05059C6.14583 3.79225 7.68333 3.16309 9.5 3.16309C11.3167 3.16309 12.8542 3.79225 14.1125 5.05059C15.3708 6.30892 16 7.84642 16 9.66309C16 10.3964 15.8833 11.0881 15.65 11.7381C15.4167 12.3881 15.1 12.9631 14.7 13.4631L21 19.7631L19.6 21.1631ZM9.5 14.1631C10.75 14.1631 11.8125 13.7256 12.6875 12.8506C13.5625 11.9756 14 10.9131 14 9.66309C14 8.41309 13.5625 7.35059 12.6875 6.47559C11.8125 5.60059 10.75 5.16309 9.5 5.16309C8.25 5.16309 7.1875 5.60059 6.3125 6.47559C5.4375 7.35059 5 8.41309 5 9.66309C5 10.9131 5.4375 11.9756 6.3125 12.8506C7.1875 13.7256 8.25 14.1631 9.5 14.1631Z" fill="url(#paint0_linear_2149_1890)" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_2149_1890" x1="12" y1="3.16309" x2="12" y2="21.1631" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#FFEAA6" />
                                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                                <stop offset="1" stop-color="#FFC737" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg>
                                                </div>
                                            </div>
                                            <!-- end .icon-control-->
                                        </li>
                                        <li class="icon-controls__item icon-controls__item icon-controls__item_show-m">
                                            <!-- begin .icon-control--><a class="icon-control disabled-element" href="#"><span class="icon-control__illustration"><svg class="icon-control__icon" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 12.1631C10.9 12.1631 9.95833 11.7714 9.175 10.9881C8.39167 10.2048 8 9.26309 8 8.16309C8 7.06309 8.39167 6.12142 9.175 5.33809C9.95833 4.55475 10.9 4.16309 12 4.16309C13.1 4.16309 14.0417 4.55475 14.825 5.33809C15.6083 6.12142 16 7.06309 16 8.16309C16 9.26309 15.6083 10.2048 14.825 10.9881C14.0417 11.7714 13.1 12.1631 12 12.1631ZM4 20.1631V17.3631C4 16.7964 4.14583 16.2756 4.4375 15.8006C4.72917 15.3256 5.11667 14.9631 5.6 14.7131C6.63333 14.1964 7.68333 13.8089 8.75 13.5506C9.81667 13.2923 10.9 13.1631 12 13.1631C13.1 13.1631 14.1833 13.2923 15.25 13.5506C16.3167 13.8089 17.3667 14.1964 18.4 14.7131C18.8833 14.9631 19.2708 15.3256 19.5625 15.8006C19.8542 16.2756 20 16.7964 20 17.3631V20.1631H4ZM6 18.1631H18V17.3631C18 17.1798 17.9542 17.0131 17.8625 16.8631C17.7708 16.7131 17.65 16.5964 17.5 16.5131C16.6 16.0631 15.6917 15.7256 14.775 15.5006C13.8583 15.2756 12.9333 15.1631 12 15.1631C11.0667 15.1631 10.1417 15.2756 9.225 15.5006C8.30833 15.7256 7.4 16.0631 6.5 16.5131C6.35 16.5964 6.22917 16.7131 6.1375 16.8631C6.04583 17.0131 6 17.1798 6 17.3631V18.1631ZM12 10.1631C12.55 10.1631 13.0208 9.96725 13.4125 9.57559C13.8042 9.18392 14 8.71309 14 8.16309C14 7.61309 13.8042 7.14225 13.4125 6.75059C13.0208 6.35892 12.55 6.16309 12 6.16309C11.45 6.16309 10.9792 6.35892 10.5875 6.75059C10.1958 7.14225 10 7.61309 10 8.16309C10 8.71309 10.1958 9.18392 10.5875 9.57559C10.9792 9.96725 11.45 10.1631 12 10.1631Z" fill="url(#paint0_linear_2149_13552)" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_2149_13552" x1="12" y1="4.16309" x2="12" y2="20.1631" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#FFEAA6" />
                                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                                <stop offset="1" stop-color="#FFC737" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg></span><span class="icon-control__label">Кабинет</span></a>
                                            <!-- end .icon-control-->
                                        </li>
                                        <li class="icon-controls__item icon-controls__item icon-controls__item_show-m">
                                            <!-- begin .icon-control--><a class="icon-control disabled-element" href="#"><span class="icon-control__illustration"><svg class="icon-control__icon" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9 21.1631C7.33333 21.1631 5.91667 20.5798 4.75 19.4131C3.58333 18.2464 3 16.8298 3 15.1631V9.16309C3 7.49642 3.58333 6.07975 4.75 4.91309C5.91667 3.74642 7.33333 3.16309 9 3.16309H15C16.6667 3.16309 18.0833 3.74642 19.25 4.91309C20.4167 6.07975 21 7.49642 21 9.16309V15.1631C21 16.8298 20.4167 18.2464 19.25 19.4131C18.0833 20.5798 16.6667 21.1631 15 21.1631H9ZM11 16.1631L17 10.1631L15.6 8.76309L11 13.3631L8.8 11.1631L7.4 12.5631L11 16.1631ZM9 19.1631H15C16.1 19.1631 17.0417 18.7714 17.825 17.9881C18.6083 17.2048 19 16.2631 19 15.1631V9.16309C19 8.06309 18.6083 7.12142 17.825 6.33809C17.0417 5.55475 16.1 5.16309 15 5.16309H9C7.9 5.16309 6.95833 5.55475 6.175 6.33809C5.39167 7.12142 5 8.06309 5 9.16309V15.1631C5 16.2631 5.39167 17.2048 6.175 17.9881C6.95833 18.7714 7.9 19.1631 9 19.1631Z" fill="url(#paint0_linear_2149_13554)" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_2149_13554" x1="12" y1="3.16309" x2="12" y2="21.1631" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#FFEAA6" />
                                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                                <stop offset="1" stop-color="#FFC737" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg></span><span class="icon-control__label">Заказы</span></a>
                                            <!-- end .icon-control-->
                                        </li>
                                        <li class="icon-controls__item icon-controls__item icon-controls__item_show-m">
                                            <!-- begin .icon-control--><a class="icon-control disabled-element" href="#"><span class="icon-control__illustration"><svg class="icon-control__icon" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 21.1635L10.55 19.8635C8.86667 18.3468 7.475 17.0385 6.375 15.9385C5.275 14.8385 4.4 13.851 3.75 12.976C3.1 12.101 2.64583 11.2968 2.3875 10.5635C2.12917 9.83014 2 9.08014 2 8.31348C2 6.74681 2.525 5.43848 3.575 4.38848C4.625 3.33848 5.93333 2.81348 7.5 2.81348C8.36667 2.81348 9.19167 2.99681 9.975 3.36348C10.7583 3.73014 11.4333 4.24681 12 4.91348C12.5667 4.24681 13.2417 3.73014 14.025 3.36348C14.8083 2.99681 15.6333 2.81348 16.5 2.81348C18.0667 2.81348 19.375 3.33848 20.425 4.38848C21.475 5.43848 22 6.74681 22 8.31348C22 9.08014 21.8708 9.83014 21.6125 10.5635C21.3542 11.2968 20.9 12.101 20.25 12.976C19.6 13.851 18.725 14.8385 17.625 15.9385C16.525 17.0385 15.1333 18.3468 13.45 19.8635L12 21.1635ZM12 18.4635C13.6 17.0301 14.9167 15.801 15.95 14.776C16.9833 13.751 17.8 12.8593 18.4 12.101C19 11.3426 19.4167 10.6676 19.65 10.076C19.8833 9.48431 20 8.89681 20 8.31348C20 7.31348 19.6667 6.48014 19 5.81348C18.3333 5.14681 17.5 4.81348 16.5 4.81348C15.7167 4.81348 14.9917 5.03431 14.325 5.47598C13.6583 5.91764 13.2 6.48014 12.95 7.16348H11.05C10.8 6.48014 10.3417 5.91764 9.675 5.47598C9.00833 5.03431 8.28333 4.81348 7.5 4.81348C6.5 4.81348 5.66667 5.14681 5 5.81348C4.33333 6.48014 4 7.31348 4 8.31348C4 8.89681 4.11667 9.48431 4.35 10.076C4.58333 10.6676 5 11.3426 5.6 12.101C6.2 12.8593 7.01667 13.751 8.05 14.776C9.08333 15.801 10.4 17.0301 12 18.4635Z" fill="url(#paint0_linear_2149_13556)" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_2149_13556" x1="12" y1="2.81348" x2="12" y2="21.1635" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#FFEAA6" />
                                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                                <stop offset="1" stop-color="#FFC737" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg></span><span class="icon-control__label">Избранное</span></a>
                                            <!-- end .icon-control-->
                                        </li>
                                        <li class="icon-controls__item icon-controls__item icon-controls__item_show-m">
                                            <!-- begin .icon-control--><a class="icon-control disabled-element" href="#"><span class="icon-control__illustration"><svg class="icon-control__icon" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4 20.1631V12.1631H8V20.1631H4ZM10 20.1631V4.16309H14V20.1631H10ZM16 20.1631V9.16309H20V20.1631H16Z" fill="url(#paint0_linear_2149_13558)" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_2149_13558" x1="12" y1="4.16309" x2="12" y2="20.1631" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#FFEAA6" />
                                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                                <stop offset="1" stop-color="#FFC737" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg></span><span class="icon-control__label">Сравнение</span></a>
                                            <!-- end .icon-control-->
                                        </li>
                                        <li class="icon-controls__item">
                                            <!-- begin .icon-control--><a class="icon-control disabled-element" href="#"><span class="icon-control__illustration"><svg class="icon-control__icon" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7 22.1631C6.45 22.1631 5.97917 21.9673 5.5875 21.5756C5.19583 21.1839 5 20.7131 5 20.1631C5 19.6131 5.19583 19.1423 5.5875 18.7506C5.97917 18.3589 6.45 18.1631 7 18.1631C7.55 18.1631 8.02083 18.3589 8.4125 18.7506C8.80417 19.1423 9 19.6131 9 20.1631C9 20.7131 8.80417 21.1839 8.4125 21.5756C8.02083 21.9673 7.55 22.1631 7 22.1631ZM17 22.1631C16.45 22.1631 15.9792 21.9673 15.5875 21.5756C15.1958 21.1839 15 20.7131 15 20.1631C15 19.6131 15.1958 19.1423 15.5875 18.7506C15.9792 18.3589 16.45 18.1631 17 18.1631C17.55 18.1631 18.0208 18.3589 18.4125 18.7506C18.8042 19.1423 19 19.6131 19 20.1631C19 20.7131 18.8042 21.1839 18.4125 21.5756C18.0208 21.9673 17.55 22.1631 17 22.1631ZM6.15 6.16309L8.55 11.1631H15.55L18.3 6.16309H6.15ZM5.2 4.16309H19.95C20.3333 4.16309 20.625 4.33392 20.825 4.67559C21.025 5.01725 21.0333 5.36309 20.85 5.71309L17.3 12.1131C17.1167 12.4464 16.8708 12.7048 16.5625 12.8881C16.2542 13.0714 15.9167 13.1631 15.55 13.1631H8.1L7 15.1631H19V17.1631H7C6.25 17.1631 5.68333 16.8339 5.3 16.1756C4.91667 15.5173 4.9 14.8631 5.25 14.2131L6.6 11.7631L3 4.16309H1V2.16309H4.25L5.2 4.16309Z" fill="url(#paint0_linear_2149_13561)" />
                                                        <defs>
                                                            <linearGradient id="paint0_linear_2149_13561" x1="10.9908" y1="2.16309" x2="10.9908" y2="22.1631" gradientUnits="userSpaceOnUse">
                                                                <stop stop-color="#FFEAA6" />
                                                                <stop offset="0.35" stop-color="#EEDC7A" />
                                                                <stop offset="0.69" stop-color="#DAAF41" />
                                                                <stop offset="1" stop-color="#FFC737" />
                                                            </linearGradient>
                                                        </defs>
                                                    </svg></span><span class="icon-control__label">Корзина</span></a>
                                            <!-- end .icon-control-->
                                        </li>
                                    </ul>
                                </div>
                                <!-- end .icon-controls-->
                            </div>
                            <div class="fixed-header__search">
                                <!-- begin .search-panel-->
                                <form class="search-panel">
                                    <div class="search-panel__field">
                                        <!-- begin .form-control-->
                                        <div class="form-control">
                                            <label class="form-control__holder"><span class="form-control__field">
                                                    <!-- Modifiers-->
                                                    <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field--><input class="form-control__input form-control__input form-control__input_style_transparent form-control__input form-control__input_size_s search-panel__input js-search-with-results" type="text" placeholder="Например: крупногабаритная шина" />
                                                    <!-- Иконка показывается, когда поле прошло валидацию и инпут имеет класс form-control__input_state_success-->
                                                    <svg class="form-control__icon form-control__icon_success" width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1.91284 3.30769L5.72237 7L11.9128 1" stroke="black" stroke-width="2" stroke-linecap="round"></path>
                                                    </svg>
                                                    <!-- Иконка показывается, когда поле не прошло валидацию и инпут имеет класс form-control__input_state_error-->
                                                    <svg class="form-control__icon form-control__icon_error" width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1.91284 1L7.91284 7" stroke="#FF0000" stroke-width="2" stroke-linecap="round"></path>
                                                        <path d="M7.91284 1L1.91284 7" stroke="#FF0000" stroke-width="2" stroke-linecap="round"></path>
                                                    </svg></span><span class="form-control__messages"><span class="form-control__message form-control__message_style_error" style="display: none;">Ошибка поля</span></span>
                                            </label>
                                        </div>
                                        <!-- end .form-control-->
                                        <div class="search-panel__clear-control">
                                            <button class="search-panel__clear js-search-clear" type="button" data-toggle-scope=".page__header" data-toggle-class="header_search_open">
                                            </button>
                                        </div>
                                        <div class="search-panel__control">
                                            <!-- begin .button-->
                                            <button class="button button_size_s button_width_full button_rounded_m button_style_muted" type="submit"><span class="button__holder">Поиск</span>
                                            </button>
                                            <!-- end .button-->
                                        </div>
                                    </div>
                                    <div class="search-panel__results">
                                        <!-- begin .search-results-->
                                        <div class="search-results">
                                            <div class="search-results__message">Нет совпадений
                                            </div>
                                            <div class="search-results__matches">
                                                <ul class="search-results__list">
                                                    <li class="search-results__item"><a class="search-results__link disabled-element" href="#"><span class="search-results__image">
                                                                <picture class="search-results__picture"><img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets//blocks/search-results/images/1.png" alt="image" class="search-results__image" title="" />
                                                                </picture>
                                                            </span><span class="search-results__wrapper"><span class="search-results__name"><b>Крупногабаритная шина Advance</b> E-4J E-4 (58pr) TL</span><span class="search-results__price">100 500 ₽</span></span></a>
                                                    </li>
                                                    <li class="search-results__item"><a class="search-results__link disabled-element" href="#"><span class="search-results__image">
                                                                <picture class="search-results__picture"><img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets//blocks/search-results/images/2.png" alt="image" class="search-results__image" title="" />
                                                                </picture>
                                                            </span><span class="search-results__wrapper"><span class="search-results__name"><b>Крупногабаритная шина Advance</b> E-4J E-4 (58pr) TL</span><span class="search-results__price">85 000 ₽</span></span></a>
                                                    </li>
                                                    <li class="search-results__item"><a class="search-results__link disabled-element" href="#"><span class="search-results__image">
                                                                <picture class="search-results__picture"><img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets//blocks/search-results/images/3.png" alt="image" class="search-results__image" title="" />
                                                                </picture>
                                                            </span><span class="search-results__wrapper"><span class="search-results__name"><b>Крупногабаритная шина Advance</b> E-4J E-4 (58pr) TL</span><span class="search-results__price">60 000 ₽</span></span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="search-results__control">
                                                <!-- begin .button-->
                                                <button class="button button_style_dark button_width_full" type="button"><span class="button__holder">Все результаты</span>
                                                </button>
                                                <!-- end .button-->
                                            </div>
                                        </div>
                                        <!-- end .search-results-->
                                    </div>
                                </form>
                                <!-- end .search-form-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end .fixed-header-->
    </div>
    <div class="page__content">

        <? $APPLICATION->ShowViewContent('TOP_BIG_IMG'); ?>

        <? if (!$isHomePage) { ?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "vate",
                array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => SITE_ID
                )
            ); ?>            
        <? } ?>