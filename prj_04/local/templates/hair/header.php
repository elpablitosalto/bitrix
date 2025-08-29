<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;
use Hair\Geo;
use Hair\General;
use Hair\HL;

$geo = new Geo();
$asset = Asset::getInstance();
$page = $APPLICATION->GetCurPage(false);

global $USER;

if (preg_match('/^\/cities\/(.*)$/', $_SERVER['REQUEST_URI'])) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /contacts/");
    die;
}

if (preg_match('/^\/company\/(.*)$/', $_SERVER['REQUEST_URI'])) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /about/");
    die;
}

if (preg_match('/^\/region\/(.*)$/', $_SERVER['REQUEST_URI'])) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /contacts/");
    die;
}

if ($_SERVER['REQUEST_URI'] == "/company/in-the-press/hairs-how-vypusk-207-dekabr-2016") {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /press-center/events/");
    die;
}

if ($_SERVER['REQUEST_URI'] == "/company/news/liniya-dlya-ochen-dlinnyh-volos-bamboo-extra-long-hair-care-uzhe-v-prodazhe") {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /press-center/events/");
    die;
}

if ($_SERVER['REQUEST_URI'] == "/company/in-the-press/your-hair-vypusk-no88-2017g") {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /press-center/events/");
    die;
}

if ($_SERVER['REQUEST_URI'] == "/company/in-the-press/galereya-krasoty-iyul-2017") {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /press-center/events/");
    die;
}

// Показывать JS -->
$arShowJS = array(
    "swiper" => "Y",
    "fancybox" => "Y",
);
if ($page == '/catalog/') {
    $arShowJS['swiper'] = 'N';
    $arShowJS['fancybox'] = 'N';
}
if ($page == '/distributors/') {
    $arShowJS['fancybox'] = 'N';
}
// <-- Показывать JS
?>
<!DOCTYPE html>
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
    $asset->addCss(MOCKUP . '/assets/css/bootstrap-grid.min.css');
    $asset->addCss(MOCKUP . '/assets/css/swiper.min.css');
    $asset->addCss(MOCKUP . '/assets/css/selectize.bootstrap4.css');
    $asset->addCss(MOCKUP . '/assets/css/magnific-popup.css');
    $asset->addCss(MOCKUP . '/assets/css/bootstrap-grid.min.css');
    $asset->addCss(MOCKUP . '/assets/css/aksFileUpload.min.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/css/suggestions.min.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/css/fancybox.css');
    $asset->addCss(MOCKUP . '/assets/css/main.css');

    $asset->addJs(MOCKUP . '/assets/js/jquery.min.js');
    if ($arShowJS['swiper'] != 'N') {
        $asset->addJs(MOCKUP . '/assets/js/swiper.min.js');
    }
    $asset->addJs(MOCKUP . '/assets/js/jquery.magnific-popup.min.js');
    $asset->addJs(MOCKUP . '/assets/js/selectize.min.js');
    $asset->addJs(MOCKUP . '/assets/js/main.js');
    $asset->addJs(MOCKUP . '/assets/js/map-data.js');
    $asset->addJs(MOCKUP . '/assets/js/aksFileUpload.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/personal.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/jquery.maskedinput.min.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/jquery.suggestions.min.js');
    //$asset->addJs(SITE_TEMPLATE_PATH.'/js/sweetalert.min.js'); // МОЖЕТ ДОБАВЛЯТЬ ГИМН УКРАИНЫ, НЕ ВКЛЮЧАТЬ !!!! Использовать fancybox
    if ($arShowJS['fancybox'] != 'N') {
        $asset->addJs(SITE_TEMPLATE_PATH . '/js/fancybox.umd.js');
    }
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/scripts.js');

    // Загружается через JS по событию скролла страницы
    //$asset->addJs("https://www.google.com/recaptcha/api.js?render=".Bitrix\Main\Config\Option::get("main", "recaptcha_code", CAPTCHA_SITE_KEY));

    $asset->addJs('/local/templates/.default' . "/js/jquery.lazy/1.7.10/jquery.lazy.js");
    $asset->addJs('/local/templates/.default' . "/js/custom.js");
    ?>
    <link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon">
    <meta name="yandex-verification" content="91738e544e29f9f2" />
    <meta name="ahrefs-site-verification" content="fbc915f67fd97fa64417765b6e64c728062814df5c25e7812354a533c0d2e609">

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

<body>
    <? $APPLICATION->ShowPanel(); ?>
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

    <header>
        <div class="top-header">
            <div class="container">
                <div class="col-lg-1" style="padding: 0px;">
                    <a href="#cityChoose" data-popup class="location"><?= $geo->getCity() ?></a>
                </div>
                <div class="col-lg-8">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top.menu",
                        array(
                            "ROOT_MENU_TYPE" => "top",
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
                </div>
                <div class="col-lg-3">
                    <? if ($USER->IsAuthorized()) : ?>
                        <? if (strpos($_SERVER['REQUEST_URI'], '/personal/') !== false) : ?>
                            <div class="login"><a class="login__link" href="/?logout=yes&<?= bitrix_sessid_get() ?>">Выйти</a></div>
                        <? else : ?>
                            <div class="login"><a class="login__link" href="/personal/">Кабинет</a></div>
                        <? endif; ?>
                    <? else : ?>
                        <div class="login"><a class="login__link" href="/personal/auth/">Войти</a></div>
                    <? endif; ?>
                </div>
            </div>
        </div>
        <div class="middle-header">
            <div class="container">
                <div class="col-6 col-lg-3 logo-container">
                    <a href="/" class="logo">
                        <?= file_get_contents($_SERVER["DOCUMENT_ROOT"] . MOCKUP . '/images/logo.svg'); ?>
                    </a>
                </div>
                <div class="col-lg-7 search-block_wrapper" itemscope itemtype="https://schema.org/WebSite">
                    <link itemprop="url" href="https://hair.ru<?= $_SERVER['REQUEST_URI'] ?>" />
                    <form class="search-block" action="/search/" method="get" itemprop="potentialAction" itemscope itemtype="https://schema.org/SearchAction">
                        <meta itemprop="target" content="https://hair.ru/search?q={query}" />
                        <input type="text" name="q" class="search-block__input" placeholder="Поиск" itemprop="query" />
                        <button class="search-block__button"></button>
                    </form>
                    <div class="search-block__mobile-activate"></div>
                </div>
                <div class="col-lg-2 middle-header__contacts">
                    <a class="middle-header__contacts__phone" href="tel:<?= General::formatPhone(General::getGeoPhone()) ?>"><?= General::getGeoPhone() ?></a>
                    <div class="middle-header__contacts__socials">
                        <div class="middle-header__contacts__socials-list">
                            <?
                            $hl = new HL();
                            $items = $hl->getList(SOCIALS, ['*'], [], ['UF_SORT_VALUE' => 'asc']);
                            foreach ($items as $item) :
                                $icon = CFile::GetPath($item['UF_ICON']);
                            ?>
                                <a href="<?= $item['UF_LINK'] ?>" class="middle-header__contacts__socials-item <?= $item['UF_CODE'] ?>" target="_blank"><?= file_get_contents($_SERVER["DOCUMENT_ROOT"] . $icon); ?></a>
                            <?
                            endforeach;
                            ?>
                        </div>
                        <? if (count($items) > 3) : ?>
                            <button class="middle-header__contacts__btn js-header-socials-trigger" type="button">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.49986 14.25C7.32462 14.2503 7.15479 14.1893 7.01986 14.0775C6.94391 14.0145 6.88113 13.9372 6.83512 13.85C6.78911 13.7627 6.76076 13.6672 6.7517 13.569C6.74265 13.4707 6.75306 13.3717 6.78234 13.2775C6.81162 13.1833 6.8592 13.0958 6.92235 13.02L10.2824 9L7.04236 4.9725C6.98006 4.89579 6.93353 4.80751 6.90546 4.71276C6.87738 4.618 6.86831 4.51864 6.87877 4.42036C6.88922 4.32209 6.919 4.22686 6.96638 4.14013C7.01376 4.0534 7.07781 3.97689 7.15486 3.915C7.23245 3.84672 7.32333 3.79522 7.42178 3.76373C7.52022 3.73224 7.62412 3.72144 7.72694 3.732C7.82976 3.74256 7.92928 3.77427 8.01927 3.82512C8.10926 3.87597 8.18776 3.94487 8.24986 4.0275L11.8724 8.5275C11.9827 8.6617 12.043 8.83003 12.043 9.00375C12.043 9.17747 11.9827 9.3458 11.8724 9.48L8.12236 13.98C8.04712 14.0708 7.95154 14.1425 7.84339 14.1894C7.73523 14.2363 7.61754 14.2571 7.49986 14.25Z" fill="#1B1A18" />
                                </svg>
                            </button>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-header">
            <div class="container">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "main.menu",
                    array(
                        "ROOT_MENU_TYPE" => "main",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MAX_LEVEL" => "2",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "ITEM_OVERFLOW_LIMIT" => 8
                    ),
                    false
                ); ?>
                <div class="header-referrer">
                    <!-- begin .logo-->
                    <a href="/infinity/" class="infinity-logo">
                        <span class="infinity-logo__label">Infinity</span>
                    </a>
                    <!-- end .logo-->
                </div>
            </div>
        </div>
        <div class="mobile-menu">
            <button class="mobile-menu__button"></button>
            <div class="mobile-menu__wrapper">
                <div class="login"><a class="login__link" href="/personal/auth/">Войти</a></div>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "main.menu",
                    array(
                        "ROOT_MENU_TYPE" => "main",
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
                <div class="mobile-referrer"><a href="/infinity" class="mobile-referrer__link">INFINITY</a></div>
                <ul class="top-menu">
                    <li class="top-menu__item">
                        <a class="top-menu__item-link" href="/about/">О компании</a>
                    </li>
                    <li class="top-menu__item">
                        <a class="top-menu__item-link" href="/about/our-team/">&nbsp;&nbsp;&nbsp;&nbsp;Наша команда</a>
                    </li>
                    <li class="top-menu__item">
                        <a class="top-menu__item-link" href="/about/vacancies/">&nbsp;&nbsp;&nbsp;&nbsp;Вакансии</a>
                    </li>
                    <li class="top-menu__item">
                        <a class="top-menu__item-link" href="/about/partnership/">&nbsp;&nbsp;&nbsp;&nbsp;Как начать сотрудничество</a>
                    </li>
                    <li class="top-menu__item">
                        <a class="top-menu__item-link" href="/distributors/">&nbsp;&nbsp;&nbsp;&nbsp;Дистрибьюторы</a>
                    </li>

                    <li class="top-menu__item">
                        <a class="top-menu__item-link" href="/catalog/">Каталог</a>
                    </li>
                    <li class="top-menu__item"><a class="top-menu__item-link" href="/downloads/">Скачать материалы</a></li>
                    <li class="top-menu__item"><a class="top-menu__item-link" href="/lookbook/">Look book</a></li>
                    <li class="top-menu__item"><a class="top-menu__item-link" href="/press-center/events/">Учитесь у нас</a></li>
                    <li class="top-menu__item">
                        <a class="top-menu__item-link" href="/press-center/videos/">&nbsp;&nbsp;&nbsp;&nbsp;Обучающее видео</a>
                    </li>
                    <li class="top-menu__item">
                        <a class="top-menu__item-link" href="/press-center/events/">&nbsp;&nbsp;&nbsp;&nbsp;Мероприятия</a>
                    </li>
                    <li class="top-menu__item"><a class="top-menu__item-link" href="/press-center/blog/">Блог</a></li>
                    <li class="top-menu__item"><a class="top-menu__item-link" href="/contacts/">Контакты</a></li>
                </ul>
                <a class="mobile-menu__wrapper-phone" href="tel:<?= General::formatPhone(General::getGeoPhone()) ?>"><?= General::getGeoPhone() ?></a>
                <div class="mobile-menu__wrapper-socials">
                    <?
                    $hl = new HL();
                    $items = $hl->getList(SOCIALS, ['*'], [], ['UF_SORT_VALUE' => 'asc']);
                    foreach ($items as $item) :
                        $icon = CFile::GetPath($item['UF_WHITE_ICON']);

                        $rsFile = CFile::GetByID($item['UF_WHITE_ICON']);
                        $arFile = $rsFile->Fetch();
                        //$width = $arFile['WIDTH'];
                        $width = 24;
                        //$height = $arFile['HEIGHT'];
                        $height = 24;
                    ?>
                        <a href="<?= $item['UF_LINK'] ?>" class="mobile-menu__wrapper-socials--item <?= $item['UF_CODE'] ?>" target="_blank"><img src="<?= $icon ?>" width="<?= $width; ?>" height="<?= $height; ?>" /></a>
                    <?
                    endforeach;
                    ?>
                    <!-- <a href="https://www.instagram.com/concept_professional/" target="_blank" class="mobile-menu__wrapper-socials--item"><img src="<?= MOCKUP ?>/images/footer/socials/ig.svg" /></a>
                    <a href="https://www.youtube.com/channel/UCCULEkOmxal2Spibgrlm0BQ" target="_blank" class="mobile-menu__wrapper-socials--item"><img src="<?= MOCKUP ?>/images/footer/socials/ytb.svg" /></a>
                    <a href="https://vk.com/concepthair" target="_blank" class="mobile-menu__wrapper-socials--item"><img src="<?= MOCKUP ?>/images/footer/socials/vk.svg" /></a> -->
                </div>
            </div>
        </div>
    </header>