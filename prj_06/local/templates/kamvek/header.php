<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Page\Asset;

global $isHomePage;
$isHomePage = ($APPLICATION->GetCurPage(false) === SITE_DIR);
?>
<!DOCTYPE html>
<html dir="ltr" lang="ru">

<head>
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <? $APPLICATION->ShowHead(); ?>

    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5.0, minimum-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/favicon-16x16.png">
    <?/*?><link rel="manifest" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/site.webmanifest"><?*/ ?>
    <link rel="mask-icon" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/safari-pinned-tab.svg" color="#2f3639">
    <link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/favicon.ico">
    <link rel="icon" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/favicon.ico" type="image/x-icon">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="<?= SITE_TEMPLATE_PATH ?>/images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <link rel="preload" as="font" href="<?= SITE_TEMPLATE_PATH ?>/fonts/138ac4ce-45a9-4715-bf9f-38bbeebeee58.woff2" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" as="font" href="<?= SITE_TEMPLATE_PATH ?>/fonts/050663eb-e1cb-4e20-83bc-b6fbb0650136.woff2" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" as="font" href="<?= SITE_TEMPLATE_PATH ?>/fonts/40ae7f1f-757a-4df4-90bd-6c1ea77a6cc0.woff2" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" as="font" href="<?= SITE_TEMPLATE_PATH ?>/fonts/a771187c-188c-4888-bd4d-3b836a963432.woff2" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" as="font" href="<?= SITE_TEMPLATE_PATH ?>/fonts/d849a1c9-784e-4774-af52-86b6dc52cae6.woff2" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" as="font" href="<?= SITE_TEMPLATE_PATH ?>/fonts/d59c4451-caaf-4d17-96a8-47542a566ca5.woff2" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" as="font" href="<?= SITE_TEMPLATE_PATH ?>/fonts/b1726e10-1988-49fe-a8b7-bbe266f3760d.woff" type="font/woff" crossorigin="anonymous" />
    <link rel="preload" as="font" href="<?= SITE_TEMPLATE_PATH ?>/fonts/3c904513-944e-4a14-9492-e7bd0f1d77c0.woff" type="font/woff" crossorigin="anonymous" />
    <link rel="preload" as="font" href="<?= SITE_TEMPLATE_PATH ?>/fonts/0bd54cb1-cfb7-4292-9e99-861508a6df66.woff" type="font/woff" crossorigin="anonymous" />
    <link rel="preload" as="font" href="<?= SITE_TEMPLATE_PATH ?>/fonts/1a65ead8-b34f-438d-9735-a9bc57345d3c.woff" type="font/woff" crossorigin="anonymous" />
    <link rel="preload" as="font" href="<?= SITE_TEMPLATE_PATH ?>/fonts/6a0d5f5e-3ccd-4763-9f8b-e93735b722bc.woff" type="font/woff" crossorigin="anonymous" />
    <link rel="preload" as="font" href="<?= SITE_TEMPLATE_PATH ?>/fonts/6dc4e233-6538-43b2-8e95-0b1c454365a8.woff" type="font/woff" crossorigin="anonymous" />

    <?/*?>
    <link rel="stylesheet" type="text/css" href="<?= SITE_TEMPLATE_PATH ?>/css/plyr.css" />
    <link rel="stylesheet" type="text/css" href="<?= SITE_TEMPLATE_PATH ?>/css/shariff.min.css" media="screen" />
    <?*/ ?>

    <?
    /**/
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/plyr.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bigBlocks.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/productFilter.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/gallery.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/shariff.min.css", ' media="screen"');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/shariff.css", ' media="screen"');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/produkte.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/news.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/referenzen.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/homepage.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/aboveFold.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/layout.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/styles.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/custom.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap-icons.css");

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery-3.6.3.min.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/plyr.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/zwischenmenu.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/magnific-popup.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/magnificStart.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/merken.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/akk.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/masonry.pkgd.min.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/masonry-start.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/productFilter.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/scripts.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/printThis.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/mainMenuSection.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/menu.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/videolazy.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/sitesearch360Conf.min.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/sitesearch360.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/slider.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/shariff.min.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/referenzen.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/newsTeaserMasonry.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/productFilter.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/formateFilter.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.justifiedGallery.min.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/startJustifiedGallery.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/verlegebedarf.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/patternPrint.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/pdpAction.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.json.min.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/verlegemusterMagnific.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/geoPosition.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/map.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.min.js", true);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js", true);
    //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/leaflet.js", true);
    //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/partnerLeaflet.js", true);
    //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/esri-leaflet.js", true);
    //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/esri-leaflet-geocoder.js", true);
    //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/leaflet-routing-machine.min.js", true);

    // Разметка OG. https://ogp.me
    CMarkingOG::show();
    ?>
</head>

<body class="<? $APPLICATION->ShowProperty("PAGE_BODY_CLASS"); ?>">
    <? $APPLICATION->ShowPanel(); ?>
    <header id="HeaderWrapper">
        <div id="Header" class="respBlock">

            <a id="Logo" class="headerBlock" href="/" title="">
                <img class="logoImage" src="<?= SITE_TEMPLATE_PATH ?>/images/logo.svg" />
                <span class="logoTitle">«Каменный век» - завод тротуарной плитки</span>
            </a>

            <div id="HeadLeftMenu" class="headerBlock noprint typography">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "top",
                    array(
                        "ROOT_MENU_TYPE" => "top",
                        "MAX_LEVEL" => "3",
                        "CHILD_MENU_TYPE" => "top_sub",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "Y",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => ""
                    )
                ); ?>
            </div>

            <div id="HeadRightMenu" class="headerBlock noprint">
                <?/*?>
                <div id="LanguageMenu" class="nav headMenuItem">
                    <div id="LanguageMenuLink">DE <span class="icon-globe"> </span></div>
                    <div class="languageDropdown">
                        <a class="lang_item current" href="" title="NL | Home">NL</a>
                        <a class="lang_item current" href="" title="EN | Home">EN</a>
                        <a class="lang_item current" href="" title="AR | Home">AR</a>
                    </div>
                </div>
                <?*/ ?>

                <div id="SiteSearchSwitch" class="headMenuItem"> &#xe807;</div>
                <div id="SiteSearch360Wrapper">
                    <div id="SiteSearch360">
                        <form action="/search/">
                            <input id="searchBox" name="q" type="text" placeholder="Поиск" />
                        </form>
                        <div id="SiteSearchOffSwitch"> ×</div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div id="HeadImageBlock">
        <?
        if (!defined('SUB_MENU_PAGE_TYPE')) {
            define('SUB_MENU_PAGE_TYPE', 1);
        }
        ?>
        <div id="SubMenuBlock">
            <div id="LeftMenuButtons">
                <div id="MainMenuButton" class="menuButton icon-menu2 noprint" title="Menu"></div>
                <? if (SUB_MENU_PAGE_TYPE == 2) { ?>
                    <div id="RelationMenuButton" class="noprint menuButton icon-list2"></div>
                <? } ?>
            </div>
            <? if (SUB_MENU_PAGE_TYPE == 2) { ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "sub",
                    array(
                        "ROOT_MENU_TYPE" => "top_sub",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "Y",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => ""
                    )
                ); ?>
            <? } ?>
        </div>
        <?
        // Слайдер -->
        $bShowTopSlider = true;
        if (defined('SHOW_TOP_SLIDER')) {
            if (SHOW_TOP_SLIDER == 'N') {
                $bShowTopSlider = false;
            }
        }
        if ($bShowTopSlider == true) {
        ?>
            <div id="Slideshow" class="bigSlider noprint" data-base="/">
                <?
                $APPLICATION->ShowViewContent('slideShow');
                ?>
            </div>
        <? }
        // <-- Слайдер
        ?>

        <?
        // Карта -->
        $bShowTopMap = false;
        if (defined('SHOW_TOP_MAP')) {
            if (SHOW_TOP_MAP == 'Y') {
                $bShowTopMap = true;
            }
        }
        if ($bShowTopMap == true) {
        ?>
            <div id="objectsMapWrapper">
                <div id="objectsMap"></div>
            </div>
        <?
        }
        // <-- Карта
        ?>

        <?
        //$APPLICATION->ShowViewContent('homeTeaserSection');
        if ($isHomePage) {

        ?>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => '/include/home_teaser_section.php',
                    "AREA_FILE_RECURSIVE" => "N",
                    "EDIT_MODE" => "html",
                ),
                false,
                array('HIDE_ICONS' => 'Y')
            );
            ?>
        <?
        }
        ?>

    </div>

    <? if (!$isHomePage && !defined("ERROR_404")) { ?>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "kamvek",
            array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => SITE_ID
            )
        );
        ?>
        <?/*?>
        <div id="BreadcrumbTrails" class="noprint">
            <ol class="breadcrumbTrail " itemscope="" itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                    <a href="/" itemscope="" itemtype="https://schema.org/WebPage" itemprop="item" itemid="/"><span itemprop="name">Home</span></a>
                    <meta itemprop="position" content="1">
                    ›
                </li>
                <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                    <a href="/company/" itemscope="" itemtype="https://schema.org/WebPage" itemprop="item" itemid="/company/">
                        <span itemprop="name">Company</span>
                    </a>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
        <?*/ ?>
    <? } ?>

    <div id="Main" class="typography">
        <?
        if (!defined('FIRST_CONTENT_PAGE_TYPE')) {
            define('FIRST_CONTENT_PAGE_TYPE', 1);
        }
        ?>
        <? if (FIRST_CONTENT_PAGE_TYPE == 3) { ?>
            <div id="FirstContent">
                <div class="content centerMargin">
                    <h2><? $APPLICATION->ShowProperty("PAGE_H2"); ?></h2>
                    <h1><? $APPLICATION->ShowProperty("PAGE_H1"); ?></h1>
                    <? $APPLICATION->ShowViewContent('NEWS_DATE'); ?>
                    <p><? $APPLICATION->ShowProperty("PAGE_DESCRIPTION"); ?></p>
                </div>
            </div>
        <? } else if (FIRST_CONTENT_PAGE_TYPE == 4) { ?>
            <div id="FirstContent">
                <div class="content centerMargin">
                    <h2><? $APPLICATION->ShowProperty("PAGE_H2"); ?></h2>
                    <h1><? $APPLICATION->ShowProperty("PAGE_H1"); ?></h1>
                <? } ?>