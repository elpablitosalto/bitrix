<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $USER, $APPLICATION;

use Bitrix\Main\Page\Asset;
use Hair\Geo;
use Hair\General;
use Hair\HL;

$geo = new Geo();
$asset = Asset::getInstance();

global $USER;
?>

<!DOCTYPE html>
<html class="page" lang="ru">

<html>

<head>
    <meta charset="utf-8">
    <meta content="IE=9" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <?
    $APPLICATION->ShowMeta("robots");
    $APPLICATION->ShowMeta("keywords");
    $APPLICATION->ShowMeta("description");
    $APPLICATION->ShowLink("canonical", null);

    $APPLICATION->ShowCSS(true);
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    ?>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <?
    // Скрипты и стили основного шаблона
    $asset->addJs(MOCKUP . '/assets/js/jquery.min.js');
    $asset->addJs(MOCKUP . '/assets/js/jquery.magnific-popup.min.js');
    //$asset->addJs(MOCKUP . '/assets/js/selectize.min.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/mockup/dist/assets/scripts/main.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/mockup/dist/assets/scripts/personal.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/mockup/dist/assets/scripts/scripts.js');
    $asset->addCss(MOCKUP . '/assets/css/magnific-popup.css');
    //

    $asset->addCss(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/fancybox-4.0.7/fancybox.css");
    $asset->addCss(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/swiper-7.2.0/css/swiper-bundle.min.css");
    $asset->addCss(SITE_TEMPLATE_PATH . "/mockup/dist/assets/styles/app.css");
    $asset->addCss(SITE_TEMPLATE_PATH . "/mockup/dist/assets/styles/custom.css");
    $asset->addCss(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/suggestions.min.css");

    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/just-validate-3.10.0/just-validate.production.min.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/Inputmask/inputmask.min.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/fancybox-4.0.7/fancybox.umd.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/swiper-7.2.0/js/swiper-bundle.min.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/jquery.suggestions.min.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/jquery.maskedinput.min.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/svg4everybody.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/ymap.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/helpers.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/validate.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/common.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/custom.js");

    // Загружается через JS по событию скролла страницы
    //$asset->addJs("https://www.google.com/recaptcha/api.js?render=" . Bitrix\Main\Config\Option::get("main", "recaptcha_code", CAPTCHA_SITE_KEY));

    $asset->addJs('/local/templates/.default' . "/js/jquery.lazy/1.7.10/jquery.lazy.js");
    $asset->addJs('/local/templates/.default' . "/js/custom.js");
    ?>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PDWM9ZT');
    </script>
    <!-- End Google Tag Manager -->

    <?
    // Отключил второй Таг-менеджер
    ?>
    <? if (false) { ?>
        <!-- Google Tag Manager -->
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-PQGF9FP');
        </script>
        <!-- End Google Tag Manager -->
    <? } ?>
</head>
<body class="page__body">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PDWM9ZT" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <?
    // Отключил второй Таг-менеджер
    ?>
    <? if (true) { ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PQGF9FP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    <? } ?>

    <? $APPLICATION->ShowPanel(); ?>
    <div class="page__header <? $GLOBALS['APPLICATION']->ShowProperty("PAGE_HEADER_CLASS") ?> <? $GLOBALS['APPLICATION']->ShowProperty("SECTION_PAGE_WITH_COLOR_CHANGE_PAGE_HEADER_CLASS") ?>">
        <!-- begin .header-->
        <div class="header <? $GLOBALS['APPLICATION']->ShowProperty("HEADER_CLASS") ?> <? $GLOBALS['APPLICATION']->ShowProperty("SECTION_PAGE_WITH_COLOR_CHANGE_HEADER_CLASS") ?>">
            <div class="header__top">
                <div class="header__wrapper page__container">
                    <div class="header__geo-select">
                        <!-- begin .icon-link-->
                        <a class="icon-link icon-link_style_grey icon-link_icon-size_s" data-popup class="location" href="#cityChoose">
                            <span class="icon-link__icon-wrapper">
                                <svg class="icon-link__icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.7643 0.0451624C11.6434 -0.0153796 11.5011 -0.0153796 11.3803 0.0451624L0.237825 5.61641C0.0261665 5.72235 -0.0595366 5.97979 0.0463807 6.19144C0.106672 6.31193 0.220122 6.39705 0.352657 6.42123L4.77494 7.22563L5.57934 11.6479C5.61226 11.8292 5.7574 11.9692 5.93976 11.9955C5.95992 11.9984 5.98026 11.9998 6.0006 11.9998C6.16304 11.9998 6.31155 11.9081 6.38417 11.7628L11.9554 0.620274C12.0615 0.408666 11.9759 0.15118 11.7643 0.0451624Z" />
                                </svg>
                            </span>
                            <span class="icon-link__text"><?= $geo->getCity() ?></span>
                        </a>
                        <!-- end .icon-link-->
                    </div>
                    <div class="header__links">
                        <!-- begin .nav-->
                        <!-- There is a data-text attribute on links, as well as a .nav__link-text element-->
                        <!-- They are both necessary for the font-weight effect to not cause reflow-->
                        <!-- They should either both be present, or both removed-->
                        <!-- Otherwise the links will either have double text or no visible text at all-->
                        <!-- data-text should have the same value as the text in side the link-->
                        <nav class="nav nav_layout_horizontal">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "top.menu",
                                array(
                                    "ROOT_MENU_TYPE" => "top_infinity",
                                    "MENU_CACHE_TYPE" => "A",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => array(),
                                    "MAX_LEVEL" => "2",
                                    "CHILD_MENU_TYPE" => "left",
                                    "USE_EXT" => "Y",
                                    "DELAY" => "N",
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "COMPONENT_TEMPLATE" => "top.menu"
                                ),
                                false
                            ); ?>
                        </nav>
                        <!-- end .nav-->
                    </div>
                    <?/*
                    <div class="header__addresses">
                        <!-- begin .icon-link-->
                        <a class="icon-link" href="/find-salon/map/">
                            <span class="icon-link__icon-wrapper">
                                    <svg
                                            class="icon-link__icon"
                                            width="16"
                                            height="16"
                                            viewBox="0 0 16 16"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                    >
                                            <path
                                                    d="M12.6663 5.99998C12.6663 5.38714 12.5456 4.78031 12.3111 4.21412C12.0766 3.64794 11.7328 3.13349 11.2995 2.70015C10.8662 2.26681 10.3517 1.92306 9.78553 1.68854C9.21934 1.45402 8.61251 1.33331 7.99967 1.33331C7.38684 1.33331 6.78 1.45402 6.21382 1.68854C5.64763 1.92306 5.13318 2.26681 4.69984 2.70015C4.2665 3.13349 3.92276 3.64794 3.68824 4.21412C3.45371 4.78031 3.33301 5.38714 3.33301 5.99998C3.33301 6.92465 3.60634 7.78465 4.06967 8.50998H4.06434C5.63767 10.9733 7.99967 14.6666 7.99967 14.6666L11.935 8.50998H11.9303C12.4106 7.76089 12.666 6.88981 12.6663 5.99998ZM7.99967 7.99998C7.46924 7.99998 6.96053 7.78927 6.58546 7.41419C6.21039 7.03912 5.99967 6.53041 5.99967 5.99998C5.99967 5.46955 6.21039 4.96084 6.58546 4.58577C6.96053 4.21069 7.46924 3.99998 7.99967 3.99998C8.53011 3.99998 9.03882 4.21069 9.41389 4.58577C9.78896 4.96084 9.99967 5.46955 9.99967 5.99998C9.99967 6.53041 9.78896 7.03912 9.41389 7.41419C9.03882 7.78927 8.53011 7.99998 7.99967 7.99998Z"
                                            />
                                    </svg>
                            </span>
                            <span class="icon-link__text">Найти салон</span>
                        </a>
                        <!-- end .icon-link-->
                    </div>
                */ ?>
                    <div class="header__auth">
                        <!-- begin .icon-link-->
                        <? if ($USER->IsAuthorized()) : ?>
                            <? if (strpos($_SERVER['REQUEST_URI'], '/personal/') !== false) : ?>
                                <a class="icon-link" href="/?logout=yes&<?= bitrix_sessid_get() ?>">
                                <? else : ?>
                                    <a class="icon-link" href="/personal/">
                                    <? endif; ?>
                                <? else : ?>
                                    <a class="icon-link" href="/personal/auth/">
                                    <? endif; ?>
                                    <span class="icon-link__icon-wrapper">
                                        <svg class="icon-link__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.1274 2.12769C9.01343 2.12769 7.92925 2.44115 6.99199 3.03417C6.08057 3.61085 5.34549 4.42542 4.86621 5.38978L5.78076 5.84431C6.60704 4.18174 8.2726 3.14896 10.1274 3.14896C12.8023 3.14896 14.9785 5.32513 14.9785 8.00003C14.9785 10.6749 12.8023 12.8511 10.1274 12.8511C8.2726 12.8511 6.60704 11.8183 5.78076 10.1557L4.86621 10.6103C5.34549 11.5747 6.08057 12.3892 6.99199 12.9659C7.92925 13.5589 9.01343 13.8724 10.1274 13.8724C13.3654 13.8724 15.9997 11.2381 15.9997 8.00003C15.9997 4.762 13.3654 2.12769 10.1274 2.12769Z" />
                                            <path d="M7.72403 9.68155L8.44614 10.4037L10.8498 8.00005L8.44614 5.59644L7.72403 6.31855L8.89485 7.48941H0V8.51069H8.89485L7.72403 9.68155Z" />
                                        </svg>
                                    </span>
                                    <span class="icon-link__text">
                                        <? if ($USER->IsAuthorized()) : ?>
                                            <? if (strpos($_SERVER['REQUEST_URI'], '/personal/') !== false) : ?>
                                                Выйти
                                            <? else : ?>
                                                Кабинет
                                            <? endif; ?>
                                        <? else : ?>
                                            Войти
                                        <? endif; ?>
                                    </span>
                                    </a>
                                    <!-- end .icon-link-->
                    </div>
                </div>
            </div>
            <div class="header__main">
                <div class="header__wrapper page__container">
                    <div class="header__burger">
                        <!-- begin .burger-->
                        <button class="burger js-toggle" type="button" data-toggle-scope=".page, .page" data-toggle-target=".page__body, .burger" data-toggle-class="page__body_menu_open, burger_state_closed">
                            <div class="burger__bars">&nbsp;</div>
                            Открыть / закрыть меню
                        </button>
                        <!-- end .burger-->
                    </div>
                    <div class="header__logo">
                        <!-- begin .logo-->
                        <a href="<?= INFINITY_ROOT ?>/" class="logo">
                            <picture class="logo__picture">
                                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/mockup/dist/assets/blocks/logo/images/logo-primary.svg",    array(), array("MODE" => "html")); ?>
                            </picture>
                        </a>
                        <!-- end .logo-->
                    </div>
                    <button type="button" data-toggle-scope=".header" data-toggle-class="header_search_open" class="header__search-trigger js-toggle">
                        <svg class="header__search-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 18C11.775 17.9996 13.4988 17.4054 14.897 16.312L19.293 20.708L20.707 19.294L16.311 14.898C17.405 13.4997 17.9996 11.7754 18 10C18 5.589 14.411 2 10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18ZM10 4C13.309 4 16 6.691 16 10C16 13.309 13.309 16 10 16C6.691 16 4 13.309 4 10C4 6.691 6.691 4 10 4Z" />
                        </svg>
                    </button>
                    <div class="header__search">
                        <!-- begin .search-form-->
                        <form class="search-form" action="/search/" method="get" itemprop="potentialAction" itemscope itemtype="https://schema.org/SearchAction">
                            <div class="search-form__field">
                                <meta itemprop="target" content="https://hair.ru/search?q={query}" />
                                <input type="text" name="q" class="search-form__input" placeholder="Поиск по сайту" itemprop="query" />
                                <div class="search-form__control">
                                    <button type="submit" class="search-form__submit search-block__button">
                                        <svg class="search-form__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 18C11.775 17.9996 13.4988 17.4054 14.897 16.312L19.293 20.708L20.707 19.294L16.311 14.898C17.405 13.4997 17.9996 11.7754 18 10C18 5.589 14.411 2 10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18ZM10 4C13.309 4 16 6.691 16 10C16 13.309 13.309 16 10 16C6.691 16 4 13.309 4 10C4 6.691 6.691 4 10 4Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- end .search-form-->
                    </div>
                    <div class="header__contacts">
                        <div class="header__contact">
                            <!-- begin .icon-link-->
                            <a class="icon-link icon-link_text-size_l" href="tel:<?= General::formatPhone(General::getGeoPhone()) ?>">
                                <span class="icon-link__icon-wrapper">
                                    <svg class="icon-link__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.6582 11.4267L10.9482 8.96266C10.8201 8.84623 10.6518 8.78414 10.4787 8.78948C10.3057 8.79483 10.1415 8.86721 10.0209 8.99133L8.42552 10.632C8.04152 10.5587 7.26952 10.318 6.47485 9.52533C5.68019 8.73 5.43952 7.956 5.36819 7.57466L7.00752 5.97866C7.1318 5.85808 7.20428 5.69388 7.20963 5.5208C7.21498 5.34772 7.15278 5.17936 7.03619 5.05133L4.57285 2.342C4.45622 2.21357 4.29411 2.13567 4.12096 2.12484C3.94781 2.11401 3.77725 2.1711 3.64552 2.284L2.19885 3.52466C2.0836 3.64034 2.0148 3.7943 2.00552 3.95733C1.99552 4.124 1.80485 8.072 4.86619 11.1347C7.53685 13.8047 10.8822 14 11.8035 14C11.9382 14 12.0209 13.996 12.0429 13.9947C12.2059 13.9855 12.3597 13.9164 12.4749 13.8007L13.7149 12.3533C13.8282 12.222 13.8857 12.0516 13.8751 11.8785C13.8645 11.7053 13.7867 11.5432 13.6582 11.4267Z" />
                                    </svg>
                                </span>
                                <span class="icon-link__text"><?= General::getGeoPhone() ?></span>
                            </a>
                            <!-- end .icon-link-->
                        </div>
                        <div class="header__social-nav">
                            <!-- begin .social-nav-->
                            <div class="social-nav social-nav_state_closed">
                                <ul class="social-nav__list">
                                    <?
                                    $hl = new HL();
                                    $items = $hl->getList(SOCIALS, ['*'], [], ['UF_SORT_VALUE' => 'asc']);
                                    foreach ($items as $item) :
                                        $icon = CFile::GetPath($item['UF_ICON']);
                                    ?>
                                        <li class="social-nav__item">
                                            <a class="social-nav__link <?= $item['UF_CODE'] ?>" href="<?= $item['UF_LINK'] ?>" target="_blank">
                                                <?= file_get_contents($_SERVER["DOCUMENT_ROOT"] . $icon); ?>
                                            </a>
                                        </li>
                                    <?
                                    endforeach;
                                    ?>
                                </ul>
                                <? if (count($items) > 3) : ?>
                                    <button type="button" data-toggle-scope=".social-nav" data-toggle-class="social-nav_state_closed" class="social-nav__trigger js-toggle">
                                        Раскрыть / закрыть
                                    </button>
                                <? endif; ?>
                            </div>
                            <!-- end .social-nav-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__panel">
                <div class="header__wrapper page__container">
                    <div class="header__nav">
                        <!-- begin .nav-->
                        <!-- There is a data-text attribute on links, as well as a .nav__link-text element-->
                        <!-- They are both necessary for the font-weight effect to not cause reflow-->
                        <!-- They should either both be present, or both removed-->
                        <!-- Otherwise the links will either have double text or no visible text at all-->
                        <!-- data-text should have the same value as the text in side the link-->
                        <nav class="nav nav_layout_horizontal nav_type_primary">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "main.menu",
                                array(
                                    "ROOT_MENU_TYPE" => "main_infinity",
                                    "MENU_CACHE_TYPE" => "A",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => array(),
                                    "MAX_LEVEL" => "2",
                                    "CHILD_MENU_TYPE" => "left",
                                    "USE_EXT" => "Y",
                                    "DELAY" => "N",
                                    "ALLOW_MULTI_SELECT" => "N",
                                ),
                                false
                            ); ?>
                            <!-- end .nav-->
                    </div>
                    <div class="header__referrer">
                        <!-- begin .logo-->
                        <a href="/" class="logo logo_type_referrer">
                            <span class="logo__label">Вернуться в</span>
                            <picture class="logo__picture">
                                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/mockup/dist/assets/blocks/logo/images/logo-concept.svg", array(), array("MODE" => "html")); ?>
                            </picture>
                        </a>
                        <!-- end .logo-->
                    </div>
                </div>
            </div>
        </div>
        <!-- end .header-->
    </div>
    <div class="page__content">