<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

use \Bitrix\Main\Page\Asset,
    \Bitrix\Main\Application,
    \Bitrix\Main\Context,
    \Bitrix\Main\Web\Uri;

$uri = new Uri(Application::getInstance()->getContext()->getRequest()->getRequestUri());
?>

<!--include svg-icons-utility-->
<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="utf-8">
    <title><? $APPLICATION->ShowTitle() ?></title>
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="Путь к успеху" name="description">
    <meta name="keywords">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta content="on" http-equiv="x-dns-prefetch-control">
    <link href="<?= SITE_TEMPLATE_PATH ?>/favicon/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
    <link href="<?= SITE_TEMPLATE_PATH ?>/favicon/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png">
    <link href="<?= SITE_TEMPLATE_PATH ?>/favicon/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png">
    <link href="<?= SITE_TEMPLATE_PATH ?>/favicon/site.webmanifest" rel="manifest">
    <link href="<?= SITE_TEMPLATE_PATH ?>/favicon/safari-pinned-tab.svg" rel="mask-icon" color="#e5b169">
    <link href="<?= SITE_TEMPLATE_PATH ?>/favicon/favicon.ico" rel="shortcut icon">
    <meta content="#222745" name="msapplication-TileColor">
    <meta content="<?= SITE_TEMPLATE_PATH ?>/favicon/browserconfig.xml" name="msapplication-config">
    <meta content="#222745" name="theme-color">


    <? $APPLICATION->ShowHead(); ?>

    <? //Canonical
    $page = $APPLICATION->GetCurPage();
    echo '<link rel="canonical" href="https://' . Context::getCurrent()->getServer()->getHttpHost() . $page . '" />'; ?>

    <?

    //old css
    if(!defined("NEW_PAGE_STYLE") || NEW_PAGE_STYLE!==true){
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/reset.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/selectric/selectric.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/air-datepicker/css/datepicker.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/swiper/swiper.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/styles.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/fix.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/custom-new.css");
    } else {
        //css
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/swiper-bundle.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/module__reset.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/module__base.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/custom.css");
    }

    //old js from roadtohome
    if(!defined("NEW_PAGE_STYLE") || NEW_PAGE_STYLE!==true) {
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery/jquery.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/selectric/selectric.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/air-datepicker/js/datepicker.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/swiper/swiper.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/module__modal.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/forms.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/search-modal.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/search.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/components.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");

        if (substr($page,0,10) == '/contacts/') {
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/contacts.js");
        }

    } else {
        //new pages
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery-3.6.4.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/swiper-bundle.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/air-datepicker/js/datepicker.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/module__modal.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/module__phone-mask-country.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/module__select-and-multi.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/module__virific.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/scripts.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/scripts__swiper.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");
    }

    Asset::getInstance()->addString('<script data-skip-moving="true" src="https://smartcaptcha.yandexcloud.net/captcha.js?render=onload&onload=showHiddenCaptcha" defer></script>');


    ?>
</head>

<body>
<? $APPLICATION->ShowPanel(); ?>
<div class="preloader">
    <div class="icon"></div>
</div>
<input class="is-hidden rs__menu--mobile-checkbox" type="checkbox" id="MenuMobile">
<div class="page-wrapper">
    <header class="wrapper rs__header">
        <div class="container">
            <div class="rs__header--block">
                <div class="rs__header--logo-box">
                    <div class="rs__header--logo">
                        <a class="rs__header--logo-link"<? if ($uri->getPath() != "/") { ?> href="/"<? } ?>>
                            <img alt="Дорога к дому" src="<?= SITE_TEMPLATE_PATH ?>/img/logo-head.svg"
                                 class="rs__header--logo">
                        </a>
                    </div>
                    <div class="rs__header--logo-parthner">
                        <a href="https://severstal.com/rus/" target="_blank" class="rs__header--logo-link">
                            <img alt="Северсталь" src="<?= SITE_TEMPLATE_PATH ?>/img/logo-main.svg"
                                 class="rs__header--logo-parthner">
                        </a>
                    </div>
                </div>
                <nav class="rs__header--nav">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top",
                        array(
                            "ROOT_MENU_TYPE" => "top",
                            "MAX_LEVEL" => "2",
                            "CHILD_MENU_TYPE" => "",
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
                <div class="rs__header--dop">
                    <div class="rs__button__group">
                        <button class="rs__button__default rs__button--icon ico-search js--search-trigger rs__button--search rs__button__default--clean">
                            <div class="ico-search"></div>
                        </button>
                        <a class="rs__button__default rs__button__default--clean rs__button--forparents"
                           href="/for_parents/">Для родителей</a>
                        <a href="https://vk.com/programputkuspehu" target="_blank" class="rs__button__default rs__button--icon ico-soc-vk js--subscribe-button rs__button--circle rs__button--subscribe"></a>
                    </div>
                </div>
            </div>
            <div class="rs__header--mobile">
                <div class="rs__mobile--menu">
                    <div class="rs__search">
                        <form action="/search/" data-parsley-validate class="rs__search--block">
                            <label class="rs__input--label">
                                <div class="rs__input--block">
                                    <div class="rs__input--group">
                                        <input class="rs__input" name="q" type="text" placeholder="Что ищем?" required>
                                        <button class="rs__button__default rs__button__default--link ico-search"
                                                type="submit"></button>
                                    </div>
                                </div>
                            </label>
                        </form>
                    </div>
                    <div class="rs__mobile--menu-list"></div>
                    <div class="rs__button__group">
                        <a class="rs__button__default rs__button__default--clean no-padding" href="/for_parents/">Для
                            родителей</a>
                    </div>
                    <div class="rs__button__group">
                        <a href="https://vk.com/programputkuspehu" target="_blank" class="rs__button__default rs__button--icon ico-soc-vk js--subscribe-button rs__button--circle rs__button--subscribe"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="progress" id="progBar"></div>
    </header>
    <main class="<?= $APPLICATION->ShowViewContent('main_class') ?>">