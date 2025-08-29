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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" type="image/svg+xml" href="<?= SITE_TEMPLATE_PATH ?>/images/favicon.svg">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= SITE_TEMPLATE_PATH ?>/images/favicon_16_px.png">
    <link rel="icon" type="image/png" sizes="48x48" href="<?= SITE_TEMPLATE_PATH ?>/images/favicon_48_px.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= SITE_TEMPLATE_PATH ?>/images/favicon_96_px.png">
    <link rel="icon" type="image/png" sizes="144x144" href="<?= SITE_TEMPLATE_PATH ?>/images/favicon_144_px.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= SITE_TEMPLATE_PATH ?>/images/favicon_192_px.png">
    <link rel="icon" type="image/png" sizes="512x512" href="<?= SITE_TEMPLATE_PATH ?>/images/favicon_512_px.png">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    <? $APPLICATION->ShowHead(); ?>

    <title><? $APPLICATION->ShowTitle() ?></title>

    <? //Canonical
    $page = $APPLICATION->GetCurPage();
    echo '<link rel="canonical" href="https://' . Context::getCurrent()->getServer()->getHttpHost() . $page . '" />'; ?>

    <?
    $pagePath = $APPLICATION->GetCurPage(false);

    //js
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery/jquery.min.js");
    Asset::getInstance()->addJs("https://www.gstatic.com/charts/loader.js"); // TODO ВЫНЕСТИ В КОМПОНЕНТ
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/swiper/swiper.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/selectric/selectric.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/air-datepicker/js/datepicker.min.js");
    if ($pagePath == '/need_help/') {
        // квиз (и, возможно, другие страницы, где используется эта библиотека)
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/maskedinput/jquery.maskedinput.min.js");
    } else {
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/Inputmask-5.x/jquery.inputmask.min.js");
    }
    if ($pagePath == '/contacts/') {
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/contacts.js");
    }
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/search-modal.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/search.js");

	$ta = strpos($pagePath, '/how_to_help/');
	if(!($ta === false)) {
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/targeted-assistance.js");
	}

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/forms.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/components.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");



    //other
    //Asset::getInstance()->addString('<script src="//code-ya.jivosite.com/widget/yW9Fbo36FU" async></script>');
    Asset::getInstance()->addString('<script data-skip-moving="true" src="https://smartcaptcha.yandexcloud.net/captcha.js?render=onload&onload=showHiddenCaptcha" defer></script>');

    //css
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/reset.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/swiper/swiper.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/selectric/selectric.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/air-datepicker/css/datepicker.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/styles.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/cookies.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/fix.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/custom.css");

    global $USER; // для админа скорректируем расположение панели, чтобы не перекрывала заголовки
    if ($USER->IsAdmin()) echo '<style>.header {position:relative!important;} body {padding-top:0;!important}</style>';
    ?>
</head>

<body>
    <? $APPLICATION->ShowPanel(); ?>
    <?/*<div class="new-site-panel">
        <div class="container">
            <div class="new-site-panel__inner">
                <div class="new-site-panel__text">Новый сайт уже заработал. Архив новостей и материалов доступен по ссылке. <a href="https://old.dorogakdomu.ru/materials/" target="_blank">Перейти
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
                            <use xlink:href="#drop-light"></use>
                        </svg></a>
                </div>
            </div>
        </div>
    </div>*/?>
    <header id="header" class="header">
        <div class="header__top">
            <div class="container">
                <div class="header__inner">
                    <div class="header__item header__item--logo" itemscope itemtype="http://schema.org/Organization">
                        <? if ($uri->getPath() != "/") { ?>
                            <a itemprop="url" href="/" class="header__logo">
                                <picture>
                                    <img itemprop="logo" class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/logo-full-red.svg" loading="lazy" alt="Дорога к дому" title="Дорога к дому" />
                                </picture>
                            </a>
                        <? } else { ?>
                            <picture>
                                <img itemprop="logo" class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/logo-full-red.svg" loading="lazy" alt="Дорога к дому" title="Дорога к дому" />
                            </picture>
                        <? } ?>
                    </div>
                    <div class="header__item header__item--partner-logo"><a href="https://severstal.com/rus/" target="_blank" class="header__partner-logo">
                            <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/partner-logo.svg" loading="lazy" alt="Северсталь" title="Северсталь" />
                            </picture>
                        </a></div>

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

                    <div class="header__item header__item--search-toggler">
                        <button type="button" class="header__search-toggler" id="search-modal-open">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-loupe">
                                <use xlink:href="#loupe"></use>
                            </svg>
                        </button>
                    </div>
                    <div class="header__item header__item--help-me">
                        <a href="/contacts/#site-callback" target="_self">
                            <u>Мне нужна помощь</u>
                        </a>
                    </div>
                    <div class="header__item header__item--i-help"><a href="/how_to_help/" target="_self" class="btn">Пожертвовать</a></div>
                    <div class="header__item header__item--menu-toggler"><a href="#main-menu" data-toggle-activity="#main-menu" class="header__menu-toggler">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-hamburger">
                                <use xlink:href="#hamburger"></use>
                            </svg></a></div>
                </div>
            </div>
        </div>
        <a href="#main-menu" data-toggle-activity="#main-menu" class="header__menu-toggler fixed">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-hamburger">
                <use xlink:href="#hamburger"></use>
            </svg></a>
    </header>
    <div id="main-menu" class="main-menu">
        <div class="header">
            <div class="header__top">
                <div class="container">
                    <div class="header__inner">
                        <div class="header__item header__item--logo"><a href="https://dorogakdomu.ru/" class="header__logo">
                                <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/logo-full-red.svg" loading="lazy" alt="Дорога к дому" title="Дорога к дому" />
                                </picture>
                            </a></div>
                        <div class="header__item header__item--partner-logo"><a href="https://severstal.com/rus/" target="_blank" class="header__partner-logo">
                                <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/partner-logo.svg" loading="lazy" alt="Северсталь" title="Северсталь" />
                                </picture>
                            </a></div>
                        <div class="header__item header__item--i-help"><a href="/need-help/" target="_self" class="btn">Пожертвовать</a></div>
                        <div class="header__item header__item--menu-toggler"><a href="#main-menu" data-toggle-activity="#main-menu" class="header__menu-toggler">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-close">
                                    <use xlink:href="#close"></use>
                                </svg></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="main-menu__wrapper">
                <div class="row">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "main",
                        array(
                            "ROOT_MENU_TYPE" => "main",
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
                </div>
            </div>
        </div>
    </div>
    <main class="site-content">