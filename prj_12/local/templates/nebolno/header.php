<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Page\Asset;

$isHome = ($APPLICATION->GetCurPage(false) === SITE_DIR);
?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
    <head>
        <title><?$APPLICATION->ShowTitle()?></title>
        <?
        Asset::getInstance()->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge" />');
        Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1" />');
        Asset::getInstance()->addString('<meta name="MobileOptimized" content="320" />');

        Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="180x180" href="' . SITE_TEMPLATE_PATH . '/img/favicons/apple-touch-icon.png" />');
        Asset::getInstance()->addString('<link rel="icon" type="image/png" sizes="32x32" href="' . SITE_TEMPLATE_PATH . '/img/favicons/favicon-32x32.png" />');
        Asset::getInstance()->addString('<link rel="icon" type="image/png" sizes="16x16" href="' . SITE_TEMPLATE_PATH . '/img/favicons/favicon-16x16.png" />');
		Asset::getInstance()->addString('<link rel="manifest" crossorigin="use-credentials" href="' . SITE_TEMPLATE_PATH . '/img/favicons/site.webmanifest" />');
		Asset::getInstance()->addString('<link rel="mask-icon" href="' . SITE_TEMPLATE_PATH . '/img/favicons/safari-pinned-tab.svg" color="#112236" />');
		Asset::getInstance()->addString('<link rel="shortcut icon" href="' . SITE_TEMPLATE_PATH . '/img/favicons/favicon.ico" />');
		Asset::getInstance()->addString('<meta name="msapplication-TileColor" content="#112236" />');
		Asset::getInstance()->addString('<meta name="msapplication-config" content="' . SITE_TEMPLATE_PATH . '/img/favicons/browserconfig.xml" />');
		Asset::getInstance()->addString('<meta name="theme-color" content="#112236" />');

		Asset::getInstance()->addString('<meta property="og:locale" content="ru_RU"/>');        
		Asset::getInstance()->addString('<meta property="og:type" content="website"/>');
		Asset::getInstance()->addString('<meta property="og:site_name" content="Стоматология Белый кролик"/>');
        ?>
        <meta property="og:title" content="<?$APPLICATION->ShowProperty("title")?>"/>
		<meta property="og:description" content="<?$APPLICATION->ShowProperty("description")?>"/> 
        <?
        $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        Asset::getInstance()->addString('<meta property="og:url" content= "'.$url.'" />');
		Asset::getInstance()->addString('<meta property="og:image" content="https://rabbitstom.ru/local/templates/nebolno/img/design/logo.png"/>');
		Asset::getInstance()->addString('<meta property="og:image:secure_url" content="https://rabbitstom.ru/local/templates/nebolno/img/design/logo.png"/>');   



		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/libs/fancybox/jquery.fancybox.min.css');
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/libs/OverlayScrollbars/css/OverlayScrollbars.css');
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/common.css');
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/main.css');
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/custom.css');

        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/libs/jquery/jquery-3.6.0.min.js');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/libs/jquery.cookie/jquery.cookie.js');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/libs/swiper/swiper-bundle.min.js');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/libs/inputmask/jquery.inputmask.min.js');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/libs/lazysizes/lazysizes.min.js');
        Asset::getInstance()->addJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=d17a64b8-651e-4ff2-ab5f-3a8dd4fb7ddc');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/libs/fancybox/jquery.fancybox.min.js');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/libs/OverlayScrollbars/js/jquery.overlayScrollbars.min.js');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/target.js');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/main.js');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/custom.js');

        $APPLICATION->ShowHead();
        ?>

		<?
		$APPLICATION->IncludeFile(
			SITE_DIR . 'include/common/metrics.php',
			array("TEMPLATE_NAME" => "metrics"),
			array('SHOW_BORDER' => false)
		);
		?>
        <?
		$APPLICATION->IncludeFile(
			SITE_DIR . 'include/common/meta_head.php',
			array(),
			array('SHOW_BORDER' => false)
		);
		?>
        
    </head>
    <body class="nb-home-page" data-svg-sprite="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg" data-svg-icons="all">
		<?
		$APPLICATION->IncludeFile(
			SITE_DIR . 'include/common/metrics_noscript.php',
			array("TEMPLATE_NAME" => "metrics_noscript"),
			array('SHOW_BORDER' => false)
		);
		?>
        <?$APPLICATION->ShowPanel()?>
        <div class="nb-wrapper">
            <header class="nb-header">
                <div class="nb-header-top">
                    <div class="container">
                        <div class="nb-header-top-inner">
                            <?if ($isHome):?>
                                <span class="nb-header-logo">
                            <?else:?>
                                <a class="nb-header-logo" href="<?=SITE_DIR?>">
                            <?endif;?>
                                <img class="nb-header-logo__img" src="<?=SITE_TEMPLATE_PATH?>/img/design/logo.png" alt="Белый кролик" width="245" height="64" />
                            <?if ($isHome):?>
                                </span>
                            <?else:?>
                                </a>
                            <?endif;?>
                            <?
                            $APPLICATION->IncludeFile(
                                SITE_DIR . 'include/common/list_locations.php',
                                array("TEMPLATE_NAME" => "metro_locations"),
                                array('SHOW_BORDER' => false)
                            );
                            ?>
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "top_phone",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/common/phone.php",
                                )
                            );
                            ?>
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:search.form",
                                "top_search",
                                Array(
                                    "USE_SUGGEST" => "N",
                                    "PAGE" => "#SITE_DIR#search/"
                                )
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <div class="nb-header-dropdown">
                    <div class="container">
                        <div class="nb-header-dropdown-inner">
                            <div class="nb-header-dropdown-left">
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "top_links",
                                    Array(
                                        "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                                        "MAX_LEVEL" => "1",	// Уровень вложенности меню
                                        "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                                        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                        "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                                        "MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                                        "MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
                                        "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                                    ),
                                    false
                                );
                                ?>
                            </div>
                            <div class="nb-header-dropdown-right">
                                <button class="nb-btn nb-btn-arrow nb-header-appointment-btn" type="button" data-modal="#modal-call-makeup">
                                    <svg class="icon icon-btn-arrow">
                                        <use xlink:href="#btn-arrow"></use>
                                    </svg>
                                    <span>Запись на прием</span>
                                </button>
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/common/shedule.php",
                                    )
                                );
                                ?>
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "social_links",
                                    Array(
                                        "ROOT_MENU_TYPE" => "social",	// Тип меню для первого уровня
                                        "MAX_LEVEL" => "1",	// Уровень вложенности меню
                                        "CHILD_MENU_TYPE" => "social",	// Тип меню для остальных уровней
                                        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                        "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                                        "MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                                        "MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
                                        "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                                        "MENU_CLASS" => "nb-header-social"
                                    ),
                                    false
                                );
                                ?>
								<?
								$APPLICATION->IncludeFile(
									SITE_DIR . 'include/common/list_locations.php',
									array("TEMPLATE_NAME" => "metro_locations"),
									array('SHOW_BORDER' => false)
								);
								?>
                                <?
                                $APPLICATION->IncludeFile(
                                    SITE_DIR . 'include/common/list_locations.php',
                                    array("TEMPLATE_NAME" => "top_locations"),
                                    array('SHOW_BORDER' => false)
                                );
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="nb-wrapper-right">
                <main class="nb-main">