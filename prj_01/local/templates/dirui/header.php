<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

use \Bitrix\Main\Page\Asset,
    \Bitrix\Main\Application,
    \Bitrix\Main\Context,
    \Bitrix\Main\Web\Uri;

$uri = new Uri(Application::getInstance()->getContext()->getRequest()->getRequestUri());

// Пользователь -->
$arResultFunc = CPersonal::getUser();
$GLOBALS['arUser'] = $arResultFunc['arUser'];
$GLOBALS['isPartner'] = $arResultFunc['arUser']['isPartner'];

//$arResultFunc = CPersonal::isPartner();
//$GLOBALS['isPartner'] = $arResultFunc['isPartner'];
// <-- Пользователь


?>
<!DOCTYPE html>
<html lang="ru">

<head itemscope itemtype="https://schema.org/WPHeader">
    <meta charset="utf-8">
    <title><? $APPLICATION->ShowTitle() ?></title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="MobileOptimized" content="360">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/logo.svg" color="#ffffff">
    <link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="<?= SITE_TEMPLATE_PATH ?>/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <? /*
    <meta property="og:type" content="website">
    <meta property="og:title" content="{Dirui}">
    <meta property="og:url" content="#">
    <meta property="og:image" content="<?=SITE_TEMPLATE_PATH?>/img/favicons/logo.jpg">
    <meta property="og:description" content="{Dirui}">
    <meta property="og:site_name" content="Dirui">
    <meta property="og:locale" content="{ru_RU">
    <meta property="article:published_time" content="{2023-08-08T10:31:27+00:00}">
    <meta property="article:modified_time " content="{2023-08-09T11:31:27+00:00}">
    <meta property="article:author" content="{Dirui}">
    <meta property="article:section" content="{Dirui}">
    <meta property="article:tag" content="{dirui}">
    */ ?>
    <meta name="referrer" content="origin-when-crossorigin">

    <? $APPLICATION->ShowHead(); ?>

    <? //Canonical
    $page = $APPLICATION->GetCurPage();
    echo '<link rel="canonical" href="https://' . Context::getCurrent()->getServer()->getHttpHost() . $page . '" />'; 
    ?>
    <?
    $pagePath = $APPLICATION->GetCurPage(false);

    //js
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery/jquery-3.7.1.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/inputmask/jquery.inputmask.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/lazy-load/lazy-load-images.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/selectric/public/jquery.selectric.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery.validate/jquery.validate.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");
    //Asset::getInstance()->addJs("http://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/js/jquery.suggestions.min.js");

    //other
    //Asset::getInstance()->addString('<script data-skip-moving="true" src="https://smartcaptcha.yandexcloud.net/captcha.js?render=onload&onload=showHiddenCaptcha" defer></script>');

    //css
    //Asset::getInstance()->addCss("http://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/css/suggestions.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/selectric/public/selectric.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/common.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/main.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/custom.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.css");

    require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/metrics.php");

    ?>
</head>

<body class="<? $APPLICATION->ShowProperty("PAGE_BODY_CLASS"); ?>" itemscope itemtype="https://schema.org/WebPage">

    <? $APPLICATION->ShowPanel(); ?>

    <div class="wrapper">
        <? if (true) { ?>
            <header class="header">
                <div class="container">
                    <div class="header__hamburger">
                        <span></span>
                    </div>
                    <a class="header__btn" href="/catalog/">Подбор оборудования</a>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top",
                        array(
                            "ROOT_MENU_TYPE" => "top",
                            "MAX_LEVEL" => "1",
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
                    <div class="header__wrapper">
                        <div class="header__hamburger">
                            <span></span>
                        </div>
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/top_phone.php"
                            )
                        ); ?>
                        <? if (!($USER->IsAuthorized())) { ?>
                            <a class="header__login-btn js_auth_popup" href="#">Вход</a>
                        <? } else { ?>
                            <? if ($GLOBALS['isPartner'] == true) { ?>
                                <a class="header__basket-line  js_basket_line_1" href="/personal/order/">Заказ<? if (intval($GLOBALS['arUser']['countBasketItems']) > 0) { ?><span><?= $GLOBALS['arUser']['countBasketItemsStr']; ?></span><? } ?></a>
                            <? } ?>
                            <?
                            $str = $GLOBALS['arUser']['IO'];
                            if (empty($str)) {
                                $str = 'Личный кабинет';
                            }
                            ?>
                            <a class="header__login-line" href="/personal/"><?= $str; ?></a>
                        <? } ?>
                    </div>
                </div>
                <div class="container">
                    <div class="c-menu">
                        <div class="c-menu__wrapper">
                            <div class="c-menu__close"></div>
                            <div class="c-menu__category">
                                <div class="c-menu__box">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:catalog.section.list",
                                        "mega_menu",
                                        array(
                                            "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "",
                                            "VIEW_MODE" => "TEXT",
                                            "SHOW_PARENT_NAME" => "Y",
                                            "IBLOCK_TYPE" => "1c_catalog",
                                            "IBLOCK_ID" => Indexis::getIblockId("catalog", "1c_catalog", "s1"),
                                            "SECTION_ID" => "",
                                            "SECTION_CODE" => "",
                                            "SECTION_URL" => "",
                                            "COUNT_ELEMENTS" => "Y",
                                            "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                                            "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
                                            "TOP_DEPTH" => "1",
                                            "SECTION_FIELDS" => "",
                                            "SECTION_USER_FIELDS" => "",
                                            "ADD_SECTIONS_CHAIN" => "N",
                                            "CACHE_TYPE" => "A",
                                            "CACHE_TIME" => "36000000",
                                            "CACHE_NOTES" => "",
                                            "CACHE_GROUPS" => "Y",
                                            "CUSTOM_SECTION_SORT" => ["SORT" => "ASC", "ID" => "ASC"],

                                            // Мои параметры -->
                                            //"FOLDER_PATH" => "/support_doc/equipment/",
                                            //"CUR_SECTION_ID" => $_GET['s'],
                                            // <-- Мои параметры
                                        )
                                    ); ?>
                                </div>
                                <a class="link-button_rose" href="/catalog/">Подобрать оборудование</a>
                            </div>
                            <div class="c-menu__info">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "mega_right",
                                    array(
                                        "ROOT_MENU_TYPE" => "mega_right",
                                        "MAX_LEVEL" => "1",
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
                                <div class="c-menu__auth">
                                    <? if (!($USER->IsAuthorized())) { ?>
                                        <a class="c-menu__middle js_auth_popup">Вход</a>
                                    <? } else { ?>
                                        <?
                                        $str = 'Личный кабинет';
                                        ?>
                                        <a class="c-menu__middle" href="/personal/"><?= $str; ?></a>
                                        <? if ($GLOBALS['isPartner'] == true) { ?>
                                            <a class="header__basket-line js_basket_line_2" href="/personal/order/">Заказ<? if (intval($GLOBALS['arUser']['countBasketItems']) > 0) { ?><span><?= $GLOBALS['arUser']['countBasketItemsStr']; ?></span><? } ?></a>
                                        <? } ?>
                                    <? } ?>
                                </div>
                                <div class="c-menu__bottom">
                                    <?
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/mobile_phone.php"
                                        )
                                    ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        <? } else { ?>
            <header class="header">
                <div class="container">
                    <!--<div class="header__hamburger"><span></span></div>-->
                    <a class="header__btn" href="/catalog/">Подбор оборудования</a>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top",
                        array(
                            "ROOT_MENU_TYPE" => "top",
                            "MAX_LEVEL" => "1",
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

                    <div class="header__wrapper">
                        <div class="header__hamburger"><span></span></div>
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/top_phone.php"
                            )
                        ); ?>
                    </div>
                </div>
                <div class="container">
                    <div class="c-menu">
                        <div class="c-menu__wrapper">
                            <div class="c-menu__close"></div>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "top_mobile",
                                array(
                                    "ROOT_MENU_TYPE" => "top",
                                    "MAX_LEVEL" => "1",
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
                            <div class="c-menu__info">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "bottom_mobile",
                                    array(
                                        "ROOT_MENU_TYPE" => "top",
                                        "MAX_LEVEL" => "1",
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
                                <div class="c-menu__bottom">
                                    <?
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/mobile_phone.php"
                                        )
                                    ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        <? } ?>
        <?
        if (!defined('PAGE_TYPE')) {
            define('PAGE_TYPE', 1);
        }
        //$h1 = $APPLICATION->GetPageProperty("PAGE_H1");
        $h1 = $APPLICATION->GetProperty("PAGE_H1");
        //echo 'h1 = ' . $h1 . '<br />';
        ?>
        <main class="container">
            <? if (!defined("HIDE_TOP_BLOCK") || HIDE_TOP_BLOCK !== true) { ?>
                <section class="middle-logo section--default"><a class="middle-logo__img" href="/">
                        <picture>
                            <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/img/icons/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/img/favicons/logo.svg" loading="lazy" alt="оборудование для лабораторной диагностики" title="оборудование для лабораторной диагностики" />
                        </picture>
                    </a>
                    <div class="middle-logo__text">Оборудование для лабораторной диагностики</div>
                </section>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "",
                    array(),
                    false
                ); ?>
            <? } ?>

            <? if (PAGE_TYPE == 2) { ?>
                <section class="<? $APPLICATION->ShowProperty("PAGE_SECTION_CLASS"); ?>">
                    <? if (strlen($h1) > 0) { ?>
                        <h1 class="<? $APPLICATION->ShowProperty("PAGE_HEADER_CLASS"); ?>"><? echo $h1; ?></h1>
                    <? } else { ?>
                        <h1 class="<? $APPLICATION->ShowProperty("PAGE_HEADER_CLASS"); ?>"><? $APPLICATION->ShowTitle(false); ?></h1>
                    <? } ?>
                <? } ?>
                <? if (PAGE_TYPE == 3) { ?>
                    <section class="<? $APPLICATION->ShowProperty("PAGE_SECTION_CLASS"); ?>">
                        <? if (strlen($h1) > 0) { ?>
                            <h2 class="<? $APPLICATION->ShowProperty("PAGE_HEADER_CLASS"); ?>"><? echo $h1; ?></h2>
                        <? } else { ?>
                            <h2 class="<? $APPLICATION->ShowProperty("PAGE_HEADER_CLASS"); ?>"><? $APPLICATION->ShowTitle(false); ?></h2>
                        <? } ?>
                    <? } ?>
                    <? if (PAGE_TYPE == 4) { ?>
                    <? } ?>
                    <? if (PAGE_TYPE == 5) { ?>
                        <? if (strlen($h1) > 0) { ?>
                            <h1 class="<? $APPLICATION->ShowProperty("PAGE_HEADER_CLASS"); ?>"><? echo $h1; ?></h1>
                        <? } else { ?>
                            <h1 class="<? $APPLICATION->ShowProperty("PAGE_HEADER_CLASS"); ?>"><? $APPLICATION->ShowTitle(false); ?></h1>
                        <? } ?>
                    <? } ?>