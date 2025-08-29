<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Page\Asset,
    \Bitrix\Main\Application,
    \Bitrix\Main\Context,
    \Bitrix\Main\Web\Uri;

$uri = new Uri(Application::getInstance()->getContext()->getRequest()->getRequestUri());

global $isHomePage;
$isHomePage = ($APPLICATION->GetCurPage(false) === SITE_DIR);

// Заказы пользователя -->
$USER_ID = $USER->GetID();
$GLOBALS['USER_ORDERS'] = [];
if (!empty($USER_ID)) {
    //$deals = new Deal();
    $deal = new Deal();
    //$arOrders = $deal->getListByUserId($USER_ID);
    $GLOBALS['USER_ORDERS'] = $deal->getMyOrderList(false);

    //vardump($arOrders);
}
// <-- Заказы пользователя
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title><? $APPLICATION->ShowTitle() ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="MobileOptimized" content="320">

    <link rel="apple-touch-icon" sizes="180x180" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/safari-pinned-tab.svg" color="#5f22a6">
    <link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#5f22a6">
    <meta name="msapplication-config" content="<?= SITE_TEMPLATE_PATH ?>/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#e7e7ff">

    <? $APPLICATION->ShowHead(); ?>

    <? //Canonical
    $page = $APPLICATION->GetCurPage();
    echo '<link rel="canonical" href="https://' . Context::getCurrent()->getServer()->getHttpHost() . $page . '" />';
    ?>

    <?
    $pagePath = $APPLICATION->GetCurPage(false);

    //mindbox js
    $APPLICATION->IncludeComponent('indexis:mindbox', '', []);

    //js
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery/jquery-3.6.0.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/libs/jquery.cookie/jquery.cookie.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/inputmask/jquery.inputmask.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/selectric/public/jquery.selectric.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/lazysizes/lazysizes.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/ion.rangeSlider/js/ion.rangeSlider.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/typed.js/typed.umd.js");
    // Маска ввода телефона в зависимости от страны -->
    //Asset::getInstance()->addJs('/local/lib' . "/intl-tel-input-master/build/js/intlTelInput.js");
    Asset::getInstance()->addJs('/local/templates/geropharm-tilda' . "/libs/intl-tel-input/js/intlTelInput.min.js"); #
    Asset::getInstance()->addJs('/local/templates/geropharm-tilda' . "/js/indexis-phone.js"); #
    // <--
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");
    Asset::getInstance()->addJs('/local/lib' . "/js/custom.js");

    //other
    //Asset::getInstance()->addString('<script data-skip-moving="true" src="https://smartcaptcha.yandexcloud.net/captcha.js?render=onload&onload=showHiddenCaptcha" defer></script>');

    //css
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.min.css");
    // Маска ввода телефона в зависимости от страны -->
    Asset::getInstance()->addCss('/local/templates/geropharm-tilda' . "/libs/intl-tel-input/css/intlTelInput.min.css"); #
    // <--
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/common.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/main.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/custom.css");
    //Asset::getInstance()->addCss('/local/lib' . "/intl-tel-input-master/build/css/intlTelInput.css");

    global $USER;

    // Разметка OG. https://ogp.me
    if (!defined('SET_OG_MARKING')) {
        define('SET_OG_MARKING', 'N');
    }
    if (SET_OG_MARKING == 'Y') {
        CMarkingOG::show();
    }
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
        })(window, document, 'script', 'dataLayer', 'GTM-N5TTTH8Q');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body class="<? $APPLICATION->ShowProperty("PAGE_BODY_CLASS"); ?>" data-svg-sprite="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg" data-svg-icons="all">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N5TTTH8Q" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <? $APPLICATION->ShowPanel(); ?>
    <div class="dp-wrapper">
        <header class="dp-header<? if ($USER->IsAuthorized()) { ?> dp-header_auth<? } ?>">
            <div class="container">
                <div class="dp-header__inner">

                    <a class="dp-header-logo" href="/">
                        <img class="dp-header-logo__img" src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo.svg" alt="Герофарм" width="185" height="83">
                    </a>

                    <div class="dp-header-dropdown">
                        <div class="dp-header-dropdown__inner">

                            <? $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "top",
                                array(
                                    "ROOT_MENU_TYPE" => "top",
                                    "MAX_LEVEL" => "3",
                                    "CHILD_MENU_TYPE" => "sub",
                                    "USE_EXT" => "Y",
                                    "DELAY" => "N",
                                    "ALLOW_MULTI_SELECT" => "Y",
                                    "MENU_CACHE_TYPE" => "A",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => array(),
                                ),
                                false
                            ); ?>

                            <? if ($USER->IsAuthorized()) { ?>
                                <?
                                $curDir = $APPLICATION->GetCurDir();
                                ?>
                                <div class="dp-header-personal-menu">
                                    <ul class="dp-header-personal-menu__list">
                                        <li class="dp-header-personal-menu__item<? if ($curDir == '/education/') : ?> dp-header-personal-menu__item_active<? endif; ?>">
                                            <a class="dp-header-personal-menu__link" href="/education/">
                                                <svg class="icon icon-education ">
                                                    <use xlink:href="#education"></use>
                                                </svg><span>Мое обучение</span>
                                            </a>
                                        </li>
                                        <li class="dp-header-personal-menu__item<? if ($curDir == '/favorites/') : ?> dp-header-personal-menu__item_active<? endif; ?>">
                                            <a class="dp-header-personal-menu__link" href="/favorites/">
                                                <svg class="icon icon-favourites ">
                                                    <use xlink:href="#favourites"></use>
                                                </svg><span>Сохраненные</span>
                                            </a>
                                        </li>
                                        <li class="dp-header-personal-menu__item<? if ($curDir == '/personal/') : ?> dp-header-personal-menu__item_active<? endif; ?>">
                                            <a class="dp-header-personal-menu__link" href="/personal/">
                                                <svg class="icon icon-account ">
                                                    <use xlink:href="#account"></use>
                                                </svg><span>Профиль</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <? } ?>

                        </div>
                    </div>

                    <button class="dp-header-search-btn" type="button">
                        <svg class="icon icon-search dp-header-search-btn__icon">
                            <use xlink:href="#search"></use>
                        </svg>
                    </button>

                    <div class="dp-header-search">
                        <?/**/ ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:search.form",
                            "vrachbudushego",
                            array(
                                "USE_SUGGEST" => "N",
                                "PAGE" => "#SITE_DIR#search/index.php"
                            )
                        ); ?>
                        <?/**/ ?>
                        <?/*?>
                        <form class="dp-header-search-form" method="get" action="/search/">
                            <input id="title-search-input" class="dp-header-search-form__input" name="q" type="text" placeholder="Поиск" autocomplete="off">
                            <button class="dp-header-search-form__submit" type="submit"><span class="dp-header-search-form__submit-icon"></span><span class="dp-header-search-form__submit-desc">Найти</span></button>
                            <button class="dp-header-search-form__close" type="button">
                                <svg class="icon icon-search-close ">
                                    <use xlink:href="#search-close"></use>
                                </svg>
                            </button>
                        </form>
                        <?*/ ?>
                        <div id="title-search"></div>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:search.title",
                            ".default",
                            array(
                                "NUM_CATEGORIES" => "1",
                                "TOP_COUNT" => "10",
                                "CHECK_DATES" => "N",
                                "SHOW_OTHERS" => "Y",
                                "PAGE" => "/search/index.php",
                                "SHOW_INPUT" => "N",
                                "INPUT_ID" => "title-search-input",
                                "CONTAINER_ID" => "title-search",
                                "USE_LANGUAGE_GUESS" => "Y",
                                "CATEGORY_0_TITLE" => "Контент",
                                "CATEGORY_0" => array("iblock_content"),
                                "CATEGORY_0_iblock_content" => array("all"),
                            ),
                            false
                        ); ?>
                    </div>

                    <? if (!$USER->IsAuthorized()) { ?>
                        <button class="dp-btn dp-btn_m dp-btn_orange dp-header-auth-btn js_auth_button" data-modal="#modal-auth" data-mb-block="0"><span>Вход или регистрация</span>
                        </button>
                    <? } ?>

                    <button class="dp-header-toggle-btn" type="button"><span></span></button>

                </div>
            </div>
        </header>
        <?
        if (!defined('PAGE_TYPE')) {
            define('PAGE_TYPE', 1);
        }
        ?>
        <main class="dp-page">
            <div class="dp-page__bg">
                <div class="dp-page__inner">
                    <? if (!$isHomePage && !defined("ERROR_404")) { ?>
                        <div class="container">
                            <?
                            if ($USER->IsAuthorized()) {
                                $quizComplete = $USER->GetParam("QUIZ");
                                if ($quizComplete == false) {
                                    $arFilter = array(
                                        "IBLOCK_ID" => Indexis::getIblockId("quiz", "content", "s1"),
                                        "CREATED_BY" => $USER->GetID(),
                                        "ACTIVE" => "Y",
                                    );
                                    $count = CIBlockElement::GetList(array(), $arFilter, false, ["nTopCount" => 1], ["ID"])->SelectedRowsCount();
                                    if ($count == 0) {
                                        $USER->SetParam("QUIZ", "N");
                                    } else {
                                        $quizComplete = "Y";
                                        $USER->SetParam("QUIZ", "Y");
                                    }
                                }
                                if ($quizComplete != "Y") {
                            ?>
                                    <div class="dp-complete-questionnaire">
                                        <p class="dp-complete-questionnaire__desc">Пройдите квиз, чтобы точнее настроить
                                            рекомендации и открыть фильтры по темам</p>
                                        <a class="dp-btn dp-complete-questionnaire__btn" href="#modal-questionnaire" data-modal="">Начать</a>
                                    </div>
                                <?
                                }
                                $APPLICATION->IncludeComponent('indexis:mindbox.api', 'RetieveClientData', ["DATA" => ["customer" => ["ids" => ["websiteID" => $USER->GetID()]]]]);
                                ?>
                            <? } ?>

                            <? if (PAGE_TYPE == 1) { ?>
                                <div class="dp-page__header">
                                    <h1 class="dp-page__title"><? $APPLICATION->ShowProperty('PAGE_H1'); ?></h1>
                                    <h2><? $APPLICATION->ShowProperty('PAGE_H2'); ?></h2>
                                </div>
                                <div class="dp-page__body">
                                <? } else if (PAGE_TYPE == 2) {  ?>

                                <? } ?>

                            <? } ?>