<?
include $_SERVER['DOCUMENT_ROOT'].'/local/dev/redirection.php';
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Page\Asset;

global $isHomePage;
$isHomePage = ($APPLICATION->GetCurPage(false) === SITE_DIR);
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">

<head>
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="MobileOptimized" content="360">
    <meta name="format-detection" content="telephone=no">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/logo.svg" color="#ffffff">
    <link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="<?= SITE_TEMPLATE_PATH ?>/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta name="google-site-verification" content="4mSVzWiot5QTYF0_4qpRCiZgV-W9gSuVpizgH74n57w" />
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PM41G4CCJ4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-PM41G4CCJ4');
    </script>
    <?
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/common.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/main.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/custom.css");
	
    if(
        $APPLICATION->GetCurPage() == '/delivery/' ||
        $APPLICATION->GetCurPage() == '/contacts/'
    ){
        Asset::getInstance()->addJs("https://api-maps.yandex.ru/2.1/?apikey=114869d6-e5a4-4776-83db-ea2afde7e344&amp;suggest_apikey=cba022f4-7928-4974-a54a-da2279e9766e&amp;lang=ru_RU");
    }
    
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery/jquery-3.7.0.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/libs/jquery.cookie/jquery.cookie.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/inputmask/jquery.inputmask.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/lazysizes/lazysizes.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/selectric/public/jquery.selectric.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery.validate/jquery.validate.min.js");
    //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/jquery.validate/messages.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/fancybox/fancybox.umd.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/target.js");

    $APPLICATION->ShowHead();
    ?>
</head>

<body class="<?$APPLICATION->ShowProperty('BODY_CLASS');?>">
    <? $APPLICATION->ShowPanel(); ?>
    <div class="wrapper">
        <header class="header">

            <div class="header__content-top">
                <div class="container">
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "top_address",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/common/address.php",
                        )
                    );
                    ?>
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "top_work_hours",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/common/work_hours.php",
                        )
                    );
                    ?>
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "top_email",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/common/email.php",
                        )
                    );
                    ?>
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "top_phone",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/common/phone.php",
                        )
                    );
                    ?>
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top_social",
                        array(
                            "ROOT_MENU_TYPE" => "top_social",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "top_social",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "86400",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );
                    ?>
                </div>
            </div>
            <div class="header__content-bottom">
                <div class="container">
                    <? if ($isHomePage) : ?>
                        <span class="header__logo">
                        <? else : ?>
                            <a class="header__logo" href="<?= SITE_DIR ?>">
                            <? endif; ?>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo.png" alt="Стройсервис">
                            <? if ($isHomePage) : ?>
                        </span>
                    <? else : ?>
                        </a>
                    <? endif; ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top",
                        array(
                            "ROOT_MENU_TYPE" => "top",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "",
                            "USE_EXT" => "N",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "Y",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    ); ?>
                    <div class="header__login">
                        <? if ($USER->IsAuthorized()) : ?>
                            <a href="<?= SITE_DIR ?>personal/">Личный кабинет</a>
                        <? else : ?>
                            <a class="header__enter" href="#">Вход</a>|<a href="#" class="header__registration">Регистрация</a>
                        <? endif; ?>
                    </div>
                    <div class="header__search">
                        <?/*<a class="header__search_searching" href="#">
                            <svg width="19" height="19">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#search"></use>
                            </svg>
                        </a>*/?>
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:sale.basket.basket.line",
                            ".default",
                            array(
                                "HIDE_ON_BASKET_PAGES" => "N",    // Не показывать на страницах корзины и оформления заказа
                                "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",    // Страница корзины
                                "PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",    // Страница оформления заказа
                                "PATH_TO_PERSONAL" => SITE_DIR . "personal/",    // Страница персонального раздела
                                "PATH_TO_PROFILE" => SITE_DIR . "personal/",    // Страница профиля
                                "PATH_TO_REGISTER" => SITE_DIR . "auth/",    // Страница регистрации
                                "POSITION_FIXED" => "N",    // Отображать корзину поверх шаблона
                                "POSITION_HORIZONTAL" => "right",
                                "POSITION_VERTICAL" => "top",
                                "SHOW_AUTHOR" => "N",    // Добавить возможность авторизации
                                "SHOW_DELAY" => "N",
                                "SHOW_EMPTY_VALUES" => "Y",    // Выводить нулевые значения в пустой корзине
                                "SHOW_IMAGE" => "N",
                                "SHOW_NOTAVAIL" => "N",
                                "SHOW_NUM_PRODUCTS" => "Y",    // Показывать количество товаров
                                "SHOW_PERSONAL_LINK" => "N",    // Отображать персональный раздел
                                "SHOW_PRICE" => "N",
                                "SHOW_PRODUCTS" => "N",    // Показывать список товаров
                                "SHOW_SUMMARY" => "N",
                                "SHOW_TOTAL_PRICE" => "N",    // Показывать общую сумму по товарам
                            ),
                            false
                        );
                        ?>
                        <div class="header__hamburger"><span></span></div>
                    </div>
                </div>

                <div class="container header__search-wrapper">
                    <button class="header__button-catalog">
                        <div class="button-hamburger"><span></span><span></span><span></span></div>
                        <div class="button-hamburger_text">Каталог товаров</div>
                    </button>
                    <?
                    $APPLICATION->IncludeComponent(
                        "indexis:search.title",
                        "catalog",
                        array(
                            "SHOW_INPUT" => "Y",
                            "INPUT_ID" => "title-search-input",
                            "CONTAINER_ID" => "title-search",
                            "PRICE_CODE" => array(
                                0 => "BASE",
                            ),
                            "PRICE_VAT_INCLUDE" => "Y",
                            "PREVIEW_TRUNCATE_LEN" => "150",
                            "SHOW_PREVIEW" => "Y",
                            "PREVIEW_WIDTH" => "75",
                            "PREVIEW_HEIGHT" => "75",
                            "CONVERT_CURRENCY" => "Y",
                            "CURRENCY_ID" => "RUB",
                            "PAGE" => "#SITE_DIR#search/",
                            "NUM_CATEGORIES" => "1",
                            "TOP_COUNT" => "100",
                            "ORDER" => "date",
                            "USE_LANGUAGE_GUESS" => "N",
                            "CHECK_DATES" => "Y",
                            "SHOW_OTHERS" => "N",
                            "CATEGORY_0_TITLE" => "Товары",
                            "CATEGORY_0" => array(
                                0 => "iblock_catalog",
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
                            "COMPONENT_TEMPLATE" => "visual",
                            "CATEGORY_0_iblock_catalog" => array(
                                0 => "7",
                            ),
                            "TEMPLATE_THEME" => "blue"
                        ),
                        false
                    ); ?>
                    <div class="search__wrapper"></div>
                    <div class="header__catalog header__catalog_none">
                        <button class="header__catalog-close"></button>
                        <p class="header__catalog-title">Каталог</p>
                        <?/*<label class="visually-hidden" for="header-search">Поиск по каталогу</label>
                        <input class="order__input order__input-city" id="header-search" type="text" name="search" placeholder="Поиск по каталогу">*/?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:catalog.section.list",
                            "top_menu_level_1",
                            array(
                                "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
                                "VIEW_MODE" => "TEXT",
                                "SHOW_PARENT_NAME" => "Y",
                                "IBLOCK_TYPE" => "",
                                "IBLOCK_ID" => Indexis::getIblockId("catalog"),
                                "SECTION_ID" => "",
                                "SECTION_CODE" => "",
                                "SECTION_URL" => "",
                                "COUNT_ELEMENTS" => "N",
                                "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                                "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "Y",
                                "TOP_DEPTH" => "1",
                                "SECTION_FIELDS" => "",
                                "SECTION_USER_FIELDS" => ['UF_MENU_ICON'],
                                "ADD_SECTIONS_CHAIN" => "N",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "36000000",
                                "CACHE_NOTES" => "",
                                "CACHE_GROUPS" => "Y"
                            )
                        ); ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:catalog.section.list",
                            "top_menu_level_2",
                            array(
                                "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
                                "VIEW_MODE" => "TEXT",
                                "SHOW_PARENT_NAME" => "Y",
                                "IBLOCK_TYPE" => "",
                                "IBLOCK_ID" => Indexis::getIblockId("catalog"),
                                "SECTION_ID" => "",
                                "SECTION_CODE" => "",
                                "SECTION_URL" => "",
                                "COUNT_ELEMENTS" => "N",
                                "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                                "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "Y",
                                "TOP_DEPTH" => "2",
                                "SECTION_FIELDS" => "",
                                "SECTION_USER_FIELDS" => "",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "36000000",
                                "CACHE_NOTES" => "",
                                "CACHE_GROUPS" => "Y"
                            )
                        ); ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "promos_top_menu",
                            array(
                                "DISPLAY_DATE" => "Y",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "AJAX_MODE" => "N",
                                "IBLOCK_TYPE" => "content",
                                "IBLOCK_ID" => Indexis::getIblockId("promos"),
                                "NEWS_COUNT" => "100",
                                "SORT_BY1" => "SORT",
                                "SORT_ORDER1" => "ASC",
                                "SORT_BY2" => "ACTIVE_FROM",
                                "SORT_ORDER2" => "DESC",
                                "FILTER_NAME" => "certFilter",
                                "FIELD_CODE" => array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "DETAIL_PAGE_URL"),
                                "PROPERTY_CODE" => array(""),
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "ACTIVE_DATE_FORMAT" => "d F Y",
                                "SET_TITLE" => "N",
                                "SET_BROWSER_TITLE" => "Y",
                                "SET_META_KEYWORDS" => "Y",
                                "SET_META_DESCRIPTION" => "Y",
                                "SET_LAST_MODIFIED" => "N",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "360000",
                                "CACHE_FILTER" => "Y",
                                "CACHE_GROUPS" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                "PAGER_TITLE" => "Сертификаты",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => "stroyservis",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_BASE_LINK_ENABLE" => "Y",
                                "SET_STATUS_404" => "N",
                                "SHOW_404" => "N",
                                "MESSAGE_404" => "",
                                "PAGER_BASE_LINK" => "",
                                "PAGER_PARAMS_NAME" => "",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                            )
                        ); ?>
                    </div>
                </div>

            </div>
            <div class="header-dropdown">
                <button class="header-dropdown__close"></button>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "top_dropdown",
                    array(
                        "ROOT_MENU_TYPE" => "top",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "",
                        "USE_EXT" => "N",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "Y",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => ""
                    )
                ); ?>
                <div class="header-dropdown__wrapper">
                    <? if ($USER->IsAuthorized()) : ?>
                        <a href="<?= SITE_DIR ?>personal/">Личный кабинет</a>
                        <a href="<?= SITE_DIR ?>?logout=yes&amp;<?= bitrix_sessid_get() ?>">Выход</a>
                    <? else : ?>
                        <a class="header__enter_mobile" href="#">Вход</a>
                        <a href="#" class="header__registration_mobile">Регистрация</a>
                    <? endif; ?>
                </div>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "mobile_address",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/common/address.php",
                    )
                );
                ?>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "mobile_phone",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/common/phone.php",
                    )
                );
                ?>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "mobile_social",
                    array(
                        "ROOT_MENU_TYPE" => "top_social",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "top_social",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "86400",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => ""
                    )
                );
                ?>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "mobile_work_hours",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/common/work_hours.php",
                    )
                );
                ?>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "mobile_email",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/common/email.php",
                    )
                );
                ?>
            </div>
            <div class="header__bottom">
                <ul class="header__dropdown-list">
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "dropdown_social",
                        array(
                            "ROOT_MENU_TYPE" => "top_social",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "top_social",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "86400",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );
                    ?>
                    <li class="header__dropdown-item">
                        <a href="<?= SITE_DIR ?>catalog/">
                            <svg width="17" height="12">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#hamburger"></use>
                            </svg>Каталог
                        </a>
                    </li>
                    <li class="header__dropdown-item">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "dropdown_phone",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/common/phone.php",
                            )
                        );
                        ?>
                    </li>
                </ul>
            </div>
        </header>
        <main class="container">
            <?
            if ($isHomePage != true) {
                if (!defined('PAGE_TYPE')) {
                    if (defined('CUSTOM_LAYOUT_PAGE')) {
                        define('PAGE_TYPE', 1);
                    } else {
                        define('PAGE_TYPE', 6);
                    }
                }
                //echo "GENERAL_PAGE = ".$APPLICATION->GetPageProperty("GENERAL_PAGE")."<br />";
                //echo 'PAGE_TYPE = '.PAGE_TYPE.'<br />';
                if (PAGE_TYPE == 1) { ?>
                    <section class="page-title <? $APPLICATION->ShowProperty("PAGE_SECTION_CLASS"); ?>">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:breadcrumb",
                            "stroyservis",
                            array(
                                "START_FROM" => "0",
                                "PATH" => "",
                                "SITE_ID" => SITE_ID
                            )
                        );
                        ?>
                        <h1><? $APPLICATION->ShowTitle(false); ?><? $APPLICATION->ShowProperty("H1_ADD"); ?></h1>
                    </section>
                <? } else if (PAGE_TYPE == 2) { ?>
                    <section class="<? $APPLICATION->ShowProperty("PAGE_SECTION_CLASS"); ?>" <? $APPLICATION->ShowProperty("MICROMARKING_PARAMS_PAGE_SECTION"); ?>>
                        <? $APPLICATION->ShowProperty("MICROMARKING_PARAMS_META_HEADLINE"); ?>
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:breadcrumb",
                            "stroyservis",
                            array(
                                "START_FROM" => "0",
                                "PATH" => "",
                                "SITE_ID" => SITE_ID
                            )
                        );
                        ?>
                        <div class="title-section">
                            <h1><? $APPLICATION->ShowTitle(false); ?></h1>
                            <? $APPLICATION->ShowProperty("MICROMARKING_PARAMS_META_URL"); ?>
                            <? $APPLICATION->ShowProperty("MICROMARKING_PARAMS_META_DESCRIPTION"); ?>
                        </div>
                    <? } else if (PAGE_TYPE == 3) { ?>
                        <section class="page-title <? $APPLICATION->ShowProperty("PAGE_SECTION_CLASS"); ?>">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:breadcrumb",
                                "stroyservis",
                                array(
                                    "START_FROM" => "0",
                                    "PATH" => "",
                                    "SITE_ID" => SITE_ID
                                )
                            );
                            ?>
                            <h1><? $APPLICATION->ShowTitle(false); ?></h1>
                        </section>
                        <section class="<? $APPLICATION->ShowProperty("PAGE_SECTION_CLASS_2"); ?>" <? $APPLICATION->ShowProperty("MICROMARKING_PARAMS_PAGE_SECTION"); ?>>
                            <?
                        } else if (PAGE_TYPE == 4) {
                            // Карточка товара 
                            ?><?
                            } else if (PAGE_TYPE == 5) {
                                // Карточка бренда 
                                ?>
                            <section class="<? $APPLICATION->ShowProperty("PAGE_SECTION_CLASS"); ?>">
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:breadcrumb",
                                    "stroyservis",
                                    array(
                                        "START_FROM" => "0",
                                        "PATH" => "",
                                        "SITE_ID" => SITE_ID
                                    )
                                );
                                ?>

                                <? $APPLICATION->ShowViewContent('BRAND_NAME_DESCRIPTION'); ?>

                                <? $APPLICATION->ShowViewContent('PROMO_BANNER'); ?>
                            </section>
                        <?
                            } else if (PAGE_TYPE == 6) {
                        ?>
                            <section class="<? $APPLICATION->ShowProperty("PAGE_SECTION_CLASS"); ?>">
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:breadcrumb",
                                    "stroyservis",
                                    array(
                                        "START_FROM" => "0",
                                        "PATH" => "",
                                        "SITE_ID" => SITE_ID
                                    )
                                );
                                ?>
                                <div class="title-section">
                                    <h1><? $APPLICATION->ShowTitle(false); ?></h1>
                                </div>

                                <?/*?>
                                <? $APPLICATION->ShowViewContent('PAGE_TEXT'); ?>
                                <?*/ ?>
                                <?/*?>    
                            </section>
                            <?*/ ?>
                        <?
                            }
                        }
                        ?>