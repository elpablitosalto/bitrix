<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$asset = \Bitrix\Main\Page\Asset::getInstance();
global $USER, $APPLICATION;

// for auth and register redirects
$CURRENT_PAGE .= $APPLICATION->GetCurPage(true);
$CURRENT_PAGE = preg_replace('/index\.php$/', '', $CURRENT_PAGE);
define('CURRENT_PAGE_URL', $CURRENT_PAGE);


$currentRegion = \Mirvendinga\Geo::getCurrentRegion(); // Нужeн для досказок в ордере
$GLOBALS["arRegion"] = $currentRegion;
//$GLOBALS["arRegion"] = \Mirvendinga\Geo::getCurrentRegion();
?>
<!DOCTYPE html>
<html class="page" lang="ru">
<head>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PF3SPRG');</script>
<!-- End Google Tag Manager -->

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="imagetoolbar" content="no"/>
    <meta name="msthemecompatible" content="no"/>
    <meta name="cleartype" content="on"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <meta name="google" value="notranslate"/>
    <meta name="theme-color" content="#ffffff"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <!-- <link sizes="57x57" href="apple-touch-icon-57x57.png" rel="apple-touch-icon"/>
    <link sizes="114x114" href="apple-touch-icon-114x114.png" rel="apple-touch-icon"/>
    <link sizes="72x72" href="apple-touch-icon-72x72.png" rel="apple-touch-icon"/>
    <link sizes="144x144" href="apple-touch-icon-144x144.png" rel="apple-touch-icon"/>
    <link sizes="60x60" href="apple-touch-icon-60x60.png" rel="apple-touch-icon"/>
    <link sizes="120x120" href="apple-touch-icon-120x120.png" rel="apple-touch-icon"/>
    <link sizes="76x76" href="apple-touch-icon-76x76.png" rel="apple-touch-icon"/>
    <link sizes="152x152" href="apple-touch-icon-152x152.png" rel="apple-touch-icon"/>
    <link sizes="180x180" href="apple-touch-icon-180x180.png" rel="apple-touch-icon"/>
    <link sizes="192x192" href="favicon-192x192.png" rel="icon" type="image/png"/>
    <link sizes="160x160" href="favicon-160x160.png" rel="icon" type="image/png"/>
    <link sizes="96x96" href="favicon-96x96.png" rel="icon" type="image/png"/>
    <link sizes="16x16" href="favicon-16x16.png" rel="icon" type="image/png"/>
    <link sizes="32x32" href="favicon-32x32.png" rel="icon" type="image/png"/>
    <link rel="manifest" href="manifest.json"/> -->
    <meta name="application-name" content=""/>
	<link rel="apple-touch-icon" href="/web-clip-icon-180х180.svg"/>
    <meta name="msapplication-tooltip" content=""/>
    <meta name="msapplication-TileColor" content="#ffffff"/>
    <!-- <meta name="msapplication-TileImage" content="mstile-large.png"/> -->
    <meta name="msapplication-tap-highlight" content="no"/>
    <!-- <meta name="msapplication-square70x70logo" content="mstile-small.png"/>
    <meta name="msapplication-square150x150logo" content="mstile-medium.png"/>
    <meta name="msapplication-wide310x150logo" content="mstile-wide.png"/>
    <meta name="msapplication-square310x310logo" content="mstile-large.png"/> -->
    <meta property="og:title" content="<?$APPLICATION->ShowTitle();?>" />
    <meta property="og:description" content="Более 600 наименований товаров для кофейных и снековых автоматов" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?=(CMain::IsHTTPS()) ? "https://" : "http://"?><?=$_SERVER["SERVER_NAME"]?><?=$APPLICATION->GetCurPage()?>" />
    <meta property="og:locale" content="ru-RU" />
    <?=$APPLICATION->ShowViewContent('og_image');?>
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <?
    $APPLICATION->ShowHead();
    // custom strings
    $asset->addString('<link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap"
            rel="stylesheet"
        />', true);

    $asset->addString('<link
            rel="stylesheet"
            href="' . SITE_TEMPLATE_PATH . '/mockup/dist/assets/components/swiper-7.2.0/css/swiper-bundle.min.css"
            media="none"
            onload="if(media!=\'all\')media=\'all\'"
        />', true);

    $asset->addString('<link
            rel="stylesheet"
            href="' . SITE_TEMPLATE_PATH . '/mockup/dist/assets/components/noUiSlider-master/nouislider.min.css"
            media="none"
            onload="if(media!=\'all\')media=\'all\'"
        />', true);

    $asset->addString('<link
            rel="stylesheet"
            href="' . SITE_TEMPLATE_PATH . '/mockup/dist/assets/components/fancybox-4.0.7/fancybox.css"
            media="none"
            onload="if(media!=\'all\')media=\'all\'"
        />', true);

    $asset->addString('
        <noscript>
            <link rel="stylesheet" href="' . SITE_TEMPLATE_PATH . '/mockup/dist/assets/components/swiper-7.2.0/css/swiper-bundle.min.css" />
            <link rel="stylesheet" href="' . SITE_TEMPLATE_PATH . '/mockup/dist/assets/components/noUiSlider-master/nouislider.min.css" />
            <link rel="stylesheet" href="' . SITE_TEMPLATE_PATH . '/mockup/dist/assets/components/fancybox-4.0.7/fancybox.css" />
        </noscript>', true);

    $asset->addString('<link rel="preconnect" href="https://fonts.googleapis.com" />', true);
    $asset->addString('<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />', true);

    // $asset->addString('<link
    //     rel="stylesheet"
    //     href="' . SITE_TEMPLATE_PATH . '/mockup/dist/assets/styles/app.css"
    //     media="none"
    //     onload="if(media!=\'all\')media=\'all\'"
    // />', true);

    // $asset->addString('<link
    //     rel="stylesheet"
    //     href="' . SITE_TEMPLATE_PATH . '/mockup/dist/assets/styles/custom.css"
    //     media="none"
    //     onload="if(media!=\'all\')media=\'all\'"
    // />', true);

    // css
    $asset->addCss(SITE_TEMPLATE_PATH . "/mockup/dist/assets/styles/app.css");
    $asset->addCss(SITE_TEMPLATE_PATH . "/mockup/dist/assets/styles/custom.css");

    // js
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/jquery-3.4.1/jquery.min.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/vanilla-lazyload-17.5.0/lazyload.min.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/swiper-7.2.0/js/swiper-bundle.min.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/wnumb-1.1.0/wNumb.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/just-validate-3.10.0/just-validate.production.min.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/noUiSlider-master/nouislider.min.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/Inputmask/inputmask.min.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/components/fancybox-4.0.7/fancybox.umd.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/svg4everybody.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/helpers.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/common.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/validate.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/ymap.js");
    //$asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/profile-forms.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/custom.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/mockup/dist/assets/scripts/search-form.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/template_scripts.js");
    $asset->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");




    $APPLICATION->AddHeadScript("https://www.google.com/recaptcha/api.js?render=".Bitrix\Main\Config\Option::get("main", "recaptcha_code", CAPTCHA_SITE_KEY));
    ?>
	<?
    $currentRegion = \Mirvendinga\Geo::getCurrentRegion(); // Нужeн для досказок в ордере
    $GLOBALS["arRegion"] = $currentRegion;
    //$GLOBALS["arRegion"] = \Mirvendinga\Geo::getCurrentRegion();
    ?>
    <script>
        window.currentRegion = <?=CUtil::PhpToJsObject($currentRegion)?>;
    </script>
</head>
<? $APPLICATION->ShowPanel(); ?>

<body class="page__body">
	<div class="page__tab-bar-panel">
            <div class="page__draggable-area"><div class="page__draggable-thumb"></div></div>
            <!-- begin .tab-bar-panel-->
            <div class="tab-bar-panel">
				<!-- begin .nav-->
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"tabs_menu",
					array(
						"ROOT_MENU_TYPE" => "bottom",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MAX_LEVEL" => "1",
						"CHILD_MENU_TYPE" => "",
						"USE_EXT" => "N",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N",
						"COMPONENT_TEMPLATE" => "tabs_menu"
					),
					false
				);?>
				<!-- end .nav-->

                <div class="tab-bar-panel__content">
                    <div class="tab-bar-panel__nav">
                       <? $APPLICATION->IncludeComponent(
							"bitrix:menu",
							"mobile_menu",
							array(
								"ROOT_MENU_TYPE" => "mobile",
								"MENU_CACHE_TYPE" => "N",
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_CACHE_GET_VARS" => array(),
								"MAX_LEVEL" => "1",
								"CHILD_MENU_TYPE" => "",
								"USE_EXT" => "N",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "N",
								"COMPONENT_TEMPLATE" => "mobile_menu"
							),
							false
						); ?>
                    </div>
                    <div class="tab-bar-panel__geo-selector">
                        <!-- begin .geo-selector-->
						<div class="geo-selector">
							<a href="#modalGeoSelect" class="geo-selector__trigger js-modal">
								<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="geo-selector__icon">
									<path d="M7.99984 7.99999C8.3665 7.99999 8.6805 7.86933 8.94184 7.60799C9.20273 7.34711 9.33317 7.03333 9.33317 6.66666C9.33317 6.29999 9.20273 5.98599 8.94184 5.72466C8.6805 5.46377 8.3665 5.33333 7.99984 5.33333C7.63317 5.33333 7.31939 5.46377 7.0585 5.72466C6.79717 5.98599 6.6665 6.29999 6.6665 6.66666C6.6665 7.03333 6.79717 7.34711 7.0585 7.60799C7.31939 7.86933 7.63317 7.99999 7.99984 7.99999ZM7.99984 14.6667C6.21095 13.1444 4.87495 11.7304 3.99184 10.4247C3.10828 9.11933 2.6665 7.91111 2.6665 6.79999C2.6665 5.13333 3.20273 3.80555 4.27517 2.81666C5.34717 1.82777 6.58873 1.33333 7.99984 1.33333C9.41095 1.33333 10.6525 1.82777 11.7245 2.81666C12.7969 3.80555 13.3332 5.13333 13.3332 6.79999C13.3332 7.91111 12.8916 9.11933 12.0085 10.4247C11.1249 11.7304 9.78873 13.1444 7.99984 14.6667Z"></path>
								</svg>
								<span class="geo-selector__label"><?= $GLOBALS["arRegion"]["NAME"] ?></span>
							</a>
						</div>
						<!-- end .geo-selector-->
                    </div>
                    <div class="tab-bar-panel__contacts">
                        <?
							$arFooterContactsFilter = array('PROPERTY_AREAS_VALUE' => 'Футер');
							if (!empty($GLOBALS["arRegion"]) && $GLOBALS["arRegion"]["NAME"] != "Москва") {
								$arFooterContactsFilter["!XML_ID"] = 'moscow';
							}
							$APPLICATION->IncludeComponent(
								"bitrix:news.list",
								"mobile-menu-contact",
								array(
									"ACTIVE_DATE_FORMAT" => "d.m.Y",
									"ADD_SECTIONS_CHAIN" => "N",
									"AJAX_MODE" => "N",
									"AJAX_OPTION_ADDITIONAL" => "",
									"AJAX_OPTION_HISTORY" => "N",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "N",
									"CACHE_FILTER" => "Y",
									"CACHE_GROUPS" => "N",
									"CACHE_TIME" => "3600",
									"CACHE_TYPE" => "A",
									"CHECK_DATES" => "Y",
									"COMPONENT_TEMPLATE" => "contact-list",
									"DETAIL_URL" => "",
									"DISPLAY_BOTTOM_PAGER" => "N",
									"DISPLAY_DATE" => "N",
									"DISPLAY_NAME" => "N",
									"DISPLAY_PICTURE" => "N",
									"DISPLAY_PREVIEW_TEXT" => "N",
									"DISPLAY_TOP_PAGER" => "N",
									"FIELD_CODE" => array(
										0 => "ID",
										1 => "NAME",
										2 => "PREVIEW_PICTURE",
										3 => "",
									),
									"FILTER_NAME" => "arFooterContactsFilter",
									"HIDE_LINK_WHEN_NO_DETAIL" => "N",
									"IBLOCK_ID" => CONTACTS_IB_ID,
									"IBLOCK_TYPE" => "info",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
									"INCLUDE_SUBSECTIONS" => "N",
									"MESSAGE_404" => "",
									"NEWS_COUNT" => "10",
									"PAGER_BASE_LINK" => "",
									"PAGER_BASE_LINK_ENABLE" => "N",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_PARAMS_NAME" => "arrPager",
									"PAGER_SHOW_ALL" => "N",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_TEMPLATE" => "",
									"PAGER_TITLE" => "Новости",
									"PARENT_SECTION" => "",
									"PARENT_SECTION_CODE" => "",
									"PREVIEW_TRUNCATE_LEN" => "",
									"PROPERTY_CODE" => array(
										0 => "ICON_HTML",
										1 => "LINK",
										2 => "LINK_TEXT",
										3 => "AREAS",
										4 => "TYPE",
										5 => "",
										6 => "",
										7 => "",
										8 => "",
										9 => "",
										10 => "",
									),
									"SET_BROWSER_TITLE" => "N",
									"SET_LAST_MODIFIED" => "N",
									"SET_META_DESCRIPTION" => "N",
									"SET_META_KEYWORDS" => "N",
									"SET_STATUS_404" => "N",
									"SET_TITLE" => "N",
									"SHOW_404" => "N",
									"SORT_BY1" => "SORT",
									"SORT_BY2" => "SORT",
									"SORT_ORDER1" => "ASC",
									"SORT_ORDER2" => "ASC",
									"STRICT_SECTION_CHECK" => "N",
									"TITLE" => ""
								),
								false
							);
							unset($arFooterContactsFilter);
							?>
                    </div>
                    <div class="tab-bar-panel__social-nav">
                        <!-- begin .social-nav-->
                        <? $APPLICATION->IncludeComponent(
								"bitrix:news.list",
								"social-nav",
								array(
									"ACTIVE_DATE_FORMAT" => "d.m.Y",
									"ADD_SECTIONS_CHAIN" => "N",
									"AJAX_MODE" => "N",
									"AJAX_OPTION_ADDITIONAL" => "",
									"AJAX_OPTION_HISTORY" => "N",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "N",
									"CACHE_FILTER" => "Y",
									"CACHE_GROUPS" => "N",
									"CACHE_TIME" => "3600",
									"CACHE_TYPE" => "A",
									"CHECK_DATES" => "Y",
									"COMPONENT_TEMPLATE" => "social-nav",
									"DETAIL_URL" => "",
									"DISPLAY_BOTTOM_PAGER" => "N",
									"DISPLAY_DATE" => "N",
									"DISPLAY_NAME" => "N",
									"DISPLAY_PICTURE" => "N",
									"DISPLAY_PREVIEW_TEXT" => "N",
									"DISPLAY_TOP_PAGER" => "N",
									"FIELD_CODE" => array(
										0 => "ID",
										1 => "NAME",
										2 => "PREVIEW_PICTURE",
										3 => "",
									),
									"FILTER_NAME" => "",
									"HIDE_LINK_WHEN_NO_DETAIL" => "N",
									"IBLOCK_ID" => SOCIAL_NAV_IB_ID,
									"IBLOCK_TYPE" => "info",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
									"INCLUDE_SUBSECTIONS" => "N",
									"MESSAGE_404" => "",
									"NEWS_COUNT" => "3",
									"PAGER_BASE_LINK" => "",
									"PAGER_BASE_LINK_ENABLE" => "N",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_PARAMS_NAME" => "arrPager",
									"PAGER_SHOW_ALL" => "N",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_TEMPLATE" => "",
									"PAGER_TITLE" => "Новости",
									"PARENT_SECTION" => "",
									"PARENT_SECTION_CODE" => "",
									"PREVIEW_TRUNCATE_LEN" => "",
									"PROPERTY_CODE" => array(
										0 => "",
										1 => "ICON",
										2 => "",
									),
									"SET_BROWSER_TITLE" => "N",
									"SET_LAST_MODIFIED" => "N",
									"SET_META_DESCRIPTION" => "N",
									"SET_META_KEYWORDS" => "N",
									"SET_STATUS_404" => "N",
									"SET_TITLE" => "N",
									"SHOW_404" => "N",
									"SORT_BY1" => "SORT",
									"SORT_BY2" => "SORT",
									"SORT_ORDER1" => "ASC",
									"SORT_ORDER2" => "ASC",
									"STRICT_SECTION_CHECK" => "N",
									"TITLE" => ""
								),
								false
							); ?>
                        <!-- end .social-nav-->
                    </div>
                </div>
            </div>
            <!-- end .tab-bar-panel-->
        </div>
        <div class="page__overlay"></div>
	<?
    //echo 'SITE_TEMPLATE_PATH = '.SITE_TEMPLATE_PATH.'<br />';
    ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PF3SPRG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div class="page__header">
        <!-- begin .header-->
        <div class="header">
            <div class="header__top">
                <div class="page__container">
                    <div class="header__top-wrapper">
                        <div class="header__geo-selector">
                            <!-- begin .geo-selector-->
                            <div class="geo-selector">
                                <a href="#modalGeoSelect" target="_blank" class="geo-selector__trigger js-modal">
                                    <svg
                                        width="16"
                                        height="16"
                                        viewBox="0 0 16 16"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="geo-selector__icon"
                                    >
                                        <path
                                            d="M7.99984 7.99999C8.3665 7.99999 8.6805 7.86933 8.94184 7.60799C9.20273 7.34711 9.33317 7.03333 9.33317 6.66666C9.33317 6.29999 9.20273 5.98599 8.94184 5.72466C8.6805 5.46377 8.3665 5.33333 7.99984 5.33333C7.63317 5.33333 7.31939 5.46377 7.0585 5.72466C6.79717 5.98599 6.6665 6.29999 6.6665 6.66666C6.6665 7.03333 6.79717 7.34711 7.0585 7.60799C7.31939 7.86933 7.63317 7.99999 7.99984 7.99999ZM7.99984 14.6667C6.21095 13.1444 4.87495 11.7304 3.99184 10.4247C3.10828 9.11933 2.6665 7.91111 2.6665 6.79999C2.6665 5.13333 3.20273 3.80555 4.27517 2.81666C5.34717 1.82777 6.58873 1.33333 7.99984 1.33333C9.41095 1.33333 10.6525 1.82777 11.7245 2.81666C12.7969 3.80555 13.3332 5.13333 13.3332 6.79999C13.3332 7.91111 12.8916 9.11933 12.0085 10.4247C11.1249 11.7304 9.78873 13.1444 7.99984 14.6667Z"
                                        ></path>
                                    </svg>
                                    <span class="geo-selector__label"><?=$GLOBALS["arRegion"]["NAME"]?></span>
                                </a>
                            </div>
                            <!-- end .geo-selector-->
                        </div>
                        <div class="header__nav">
                            <!-- begin .nav-->
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "top_menu",
                                array(
                                    "ROOT_MENU_TYPE" => "top",
                                    "MENU_CACHE_TYPE" => "N",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => array(
                                    ),
                                    "MAX_LEVEL" => "1",
                                    "CHILD_MENU_TYPE" => "",
                                    "USE_EXT" => "N",
                                    "DELAY" => "N",
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "COMPONENT_TEMPLATE" => "top_menu"
                                ),
                                false
                            );?>
                            <!-- end .nav-->
                        </div>
                        <div class="header__contact-group">
                            <?
                            $arHeaderContactsFilter = array('PROPERTY_AREAS_VALUE' => 'Шапка');
                            if(!empty($GLOBALS["arRegion"]) && $GLOBALS["arRegion"]["NAME"] != "Москва") {
                                $arHeaderContactsFilter["!XML_ID"] = 'moscow';
                            }
                            $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "header-contact",
                            array(
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "N",
                                "CACHE_FILTER" => "Y",
                                "CACHE_GROUPS" => "N",
                                "CACHE_TIME" => "3600",
                                "CACHE_TYPE" => "A",
                                "CHECK_DATES" => "Y",
                                "COMPONENT_TEMPLATE" => "contact-list",
                                "DETAIL_URL" => "",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_DATE" => "N",
                                "DISPLAY_NAME" => "N",
                                "DISPLAY_PICTURE" => "N",
                                "DISPLAY_PREVIEW_TEXT" => "N",
                                "DISPLAY_TOP_PAGER" => "N",
                                "FIELD_CODE" => array(
                                    0 => "ID",
                                    1 => "NAME",
                                    2 => "PREVIEW_PICTURE",
                                    3 => "",
                                ),
                                "FILTER_NAME" => "arHeaderContactsFilter",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_ID" => CONTACTS_IB_ID,
                                "IBLOCK_TYPE" => "info",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "INCLUDE_SUBSECTIONS" => "N",
                                "MESSAGE_404" => "",
                                "NEWS_COUNT" => "10",
                                "PAGER_BASE_LINK" => "",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_PARAMS_NAME" => "arrPager",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => "",
                                "PAGER_TITLE" => "Новости",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "PROPERTY_CODE" => array(
                                    0 => "ICON_HTML",
                                    1 => "LINK",
                                    2 => "LINK_TEXT",
                                    3 => "AREAS",
                                    4 => "TYPE",
                                    5 => "",
                                    6 => "",
                                    7 => "",
                                    8 => "",
                                    9 => "",
                                    10 => "",
                                ),
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "N",
                                "SORT_BY1" => "SORT",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER1" => "ASC",
                                "SORT_ORDER2" => "ASC",
                                "STRICT_SECTION_CHECK" => "N",
                                "TITLE" => ""
                                ),
                                false
                            );
                            unset($arHeaderContactsFilter);
                            ?>
                        </div>
                        <div class="header__auth-menu">
                            <!-- begin .auth-menu-->
                            <div class="auth-menu">
                                <a
                                    href="<?=($GLOBALS["USER"]->IsAuthorized() ? PROFILE_URL : AUTH_URL.'?actionurl='.CURRENT_PAGE_URL)?>"
                                    data-for-dropdown="authMenu"
                                    data-active-class="icon-control_state_active"
                                    class="auth-menu__trigger <?=($GLOBALS["USER"]->IsAuthorized() ? 'js-controlled-dropdown-trigger-hover' : '')?>"
                                >
                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="auth-menu__icon"
                                    >
                                        <path
                                            d="M21.5625 12C21.5625 10.4092 21.1657 8.84347 20.4079 7.44472C19.6502 6.04597 18.5554 4.85837 17.2228 3.9895C15.8903 3.12062 14.362 2.59793 12.7764 2.46877C11.1908 2.33961 9.5981 2.60805 8.14246 3.24979C6.68683 3.89154 5.41429 4.88629 4.44013 6.14396C3.46596 7.40162 2.82096 8.88245 2.56353 10.4523C2.30611 12.0222 2.4444 13.6314 2.96588 15.1343C3.48736 16.6373 4.37555 17.9863 5.55 19.0594L5.6625 19.1531C7.40911 20.7043 9.66399 21.5611 12 21.5611C14.336 21.5611 16.5909 20.7043 18.3375 19.1531L18.45 19.0594C19.4316 18.1641 20.2154 17.0738 20.7514 15.8582C21.2873 14.6426 21.5636 13.3285 21.5625 12ZM3.5625 12C3.56062 10.6225 3.896 9.26557 4.53936 8.0476C5.18272 6.82962 6.11448 5.78768 7.25329 5.01276C8.39209 4.23785 9.7033 3.75353 11.0724 3.60209C12.4415 3.45066 13.8269 3.63672 15.1075 4.14403C16.3881 4.65134 17.5251 5.46447 18.4191 6.51241C19.313 7.56034 19.9369 8.81121 20.2361 10.1558C20.5352 11.5003 20.5007 12.8977 20.1354 14.2259C19.7702 15.554 19.0853 16.7725 18.1406 17.775C17.2546 16.4044 15.934 15.371 14.3906 14.8406C15.1611 14.3274 15.746 13.58 16.0588 12.7087C16.3716 11.8374 16.3958 10.8886 16.1277 10.0026C15.8597 9.1165 15.3136 8.34022 14.5702 7.7885C13.8269 7.23677 12.9257 6.93889 12 6.93889C11.0743 6.93889 10.1731 7.23677 9.42978 7.7885C8.68643 8.34022 8.14035 9.1165 7.87228 10.0026C7.60421 10.8886 7.62837 11.8374 7.9412 12.7087C8.25402 13.58 8.83891 14.3274 9.60938 14.8406C8.06596 15.371 6.74537 16.4044 5.85938 17.775C4.38276 16.215 3.56069 14.148 3.5625 12ZM8.8125 11.25C8.8125 10.6196 8.99944 10.0033 9.34969 9.47911C9.69994 8.95493 10.1978 8.54638 10.7802 8.30512C11.3626 8.06387 12.0035 8.00075 12.6219 8.12374C13.2402 8.24673 13.8081 8.55031 14.2539 8.99609C14.6997 9.44187 15.0033 10.0098 15.1263 10.6281C15.2492 11.2465 15.1861 11.8874 14.9449 12.4698C14.7036 13.0522 14.2951 13.5501 13.7709 13.9003C13.2467 14.2505 12.6304 14.4375 12 14.4375C11.1554 14.435 10.3461 14.0984 9.74883 13.5012C9.15159 12.9039 8.81497 12.0946 8.8125 11.25ZM6.69375 18.5625C7.2452 17.6483 8.02349 16.8921 8.95316 16.3672C9.88284 15.8422 10.9324 15.5664 12 15.5664C13.0676 15.5664 14.1172 15.8422 15.0468 16.3672C15.9765 16.8921 16.7548 17.6483 17.3063 18.5625C15.8038 19.7756 13.931 20.4372 12 20.4372C10.069 20.4372 8.19622 19.7756 6.69375 18.5625Z"
                                        ></path>
                                    </svg>
                                    <span class="auth-menu__label"><?=($GLOBALS["USER"]->IsAuthorized() ? 'Личный кабинет' : 'Войти')?></span>
                                </a>
                                <?if($GLOBALS["USER"]->IsAuthorized()):?>
                                    <div class="auth-menu__dropdown">
                                        <!-- begin .controlled-dropdown-->
                                        <div class="controlled-dropdown" id="authMenu">
                                            <div class="controlled-dropdown__body">
                                                <!-- begin .nav-->
                                                <?$APPLICATION->IncludeComponent(
                                                    "bitrix:menu",
                                                    "personal_header_menu",
                                                    array(
                                                        "ROOT_MENU_TYPE" => "personal",
                                                        "MENU_CACHE_TYPE" => "A",
                                                        "MENU_CACHE_TIME" => "3600",
                                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                                        "MENU_CACHE_GET_VARS" => array(
                                                        ),
                                                        "MAX_LEVEL" => "1",
                                                        "DELAY" => "N",
                                                        "ALLOW_MULTI_SELECT" => "N",
                                                    ),
                                                    false
                                                );?>
                                                <!-- end .nav-->
                                            </div>
                                        </div>
                                        <!-- end .controlled-dropdown-->
                                    </div>
                                <?endif;?>
                            </div>
                            <!-- end .auth-menu-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__main">
                <div class="page__container">
                    <div class="header__main-wrapper">
                        <div class="header__burger">
                            <!-- begin .button-->
                            <button
                                class="button button_width_full button_size_xs js-toggle"
                                type="button"
                                data-toggle-scope=".page__body"
                                data-toggle-class="page__body_nav_open frozen-scroll"
                                aria-label="Открыть меню"
                            >
                                <span class="button__holder">
                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="button__icon"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M21 17C21.5523 17 22 17.4477 22 18C22 18.5523 21.5523 19 21 19H3C2.44772 19 2 18.5523 2 18C2 17.4477 2.44772 17 3 17H21ZM21 11C21.5523 11 22 11.4477 22 12C22 12.5523 21.5523 13 21 13H3C2.44772 13 2 12.5523 2 12C2 11.4477 2.44772 11 3 11H21ZM21 5C21.5523 5 22 5.44772 22 6C22 6.55228 21.5523 7 21 7H3C2.44772 7 2 6.55228 2 6C2 5.44772 2.44772 5 3 5H21Z"
                                        ></path>
                                    </svg>
                                </span>
                            </button>
                            <!-- end .button-->
                        </div>
                        <div class="header__logo">
                            <!-- begin .logo-->
                            <a href="/" class="logo">
                                <span class="logo__figure-wrapper">
                                    <?
                                        $APPLICATION->IncludeComponent("bitrix:main.include", "",
                                            array(
                                                "AREA_FILE_SHOW" => "file",
                                                "PATH" => SITE_TEMPLATE_PATH."/include/common/main_logo.php",
                                                "AREA_FILE_RECURSIVE" => "N",
                                                "EDIT_MODE" => "html"
                                            )
                                        );
                                    ?>
                                </span>
                            </a>
                            <!-- end .logo-->
                        </div>
                        <div class="header__catalog-trigger">
                            <!-- begin .button-->
                            <div
                                class="button button_width_full button_text-size_l button_type_caps js-catalog-menu-trigger"
                            >
                                <span class="button__holder">
                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="button__icon"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M21 17C21.5523 17 22 17.4477 22 18C22 18.5523 21.5523 19 21 19H3C2.44772 19 2 18.5523 2 18C2 17.4477 2.44772 17 3 17H21ZM21 11C21.5523 11 22 11.4477 22 12C22 12.5523 21.5523 13 21 13H3C2.44772 13 2 12.5523 2 12C2 11.4477 2.44772 11 3 11H21ZM21 5C21.5523 5 22 5.44772 22 6C22 6.55228 21.5523 7 21 7H3C2.44772 7 2 6.55228 2 6C2 5.44772 2.44772 5 3 5H21Z"
                                        ></path>
                                    </svg>
                                    <span class="button__text">Каталог</span>
                                </span>
                            </div>
                            <!-- end .button-->
                        </div>
                        <div class="header__search">
                            <?$APPLICATION->IncludeComponent(
                                "waim:search.form", "",
                                Array(
                                    'SEARCH_PAGE' => '/search/',
                                    'PLACEHOLDER' => 'Поиск по сайту'
                                )
                            );?>
                        </div>
                        <div class="header__icon-controls">
                            <!-- begin .icon-controls-->
                            <div class="icon-controls">
                                <ul class="icon-controls__list">
                                    <li class="icon-controls__item hide-l">
                                        <!-- begin .icon-control-->
                                        <?$APPLICATION->IncludeComponent(
                                            "waim:sale.favorites.ajax", "desktop",
                                            Array(
                                                'PATH_TO_FAVORITES' => FAVORITES_URL
                                            )
                                        );?>
                                        <!-- end .icon-control-->
                                    </li>
                                    <li class="icon-controls__item">
                                        <?$APPLICATION->IncludeComponent(
                                            "waim:sale.basket.ajax", "",
                                            Array(
                                                'PATH_TO_BASKET' => CART_URL
                                            )
                                        );?>
                                    </li>
                                </ul>
                            </div>
                            <!-- end .icon-controls-->
                        </div>
                        <div class="header__fixed-auth">
                            <!-- begin .icon-control-->
                            <a class="icon-control <?=($GLOBALS["USER"]->IsAuthorized() ? 'icon-control_style_primary' : '')?>" href="<?=($GLOBALS["USER"]->IsAuthorized() ? PROFILE_URL : AUTH_URL.'?actionurl='.CURRENT_PAGE_URL)?>">
                                <span class="icon-control__illustration">
                                    <svg
                                        class="icon-control__icon"
                                        width="33"
                                        height="32"
                                        viewBox="0 0 33 32"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M29 15.7504C29.0001 13.6293 28.471 11.5417 27.4606 9.6767C26.4502 7.8117 24.9906 6.22824 23.2138 5.06974C21.437 3.91124 19.3993 3.21432 17.2852 3.0421C15.1711 2.86988 13.0475 3.22781 11.1066 4.08347C9.16577 4.93912 7.46905 6.26546 6.17017 7.94235C4.87129 9.61923 4.01128 11.5937 3.66804 13.6868C3.32481 15.7799 3.5092 17.9256 4.20451 19.9295C4.89981 21.9334 6.08407 23.7322 7.65 25.1629L7.8 25.2879C10.1288 27.3562 13.1353 28.4985 16.25 28.4985C19.3647 28.4985 22.3712 27.3562 24.7 25.2879L24.85 25.1629C26.1588 23.9692 27.2039 22.5155 27.9185 20.8947C28.6331 19.2739 29.0015 17.5217 29 15.7504ZM5 15.7504C4.99749 13.9138 5.44467 12.1045 6.30248 10.4805C7.16029 8.85657 8.40264 7.46732 9.92105 6.43409C11.4395 5.40087 13.1877 4.75511 15.0132 4.5532C16.8387 4.35129 18.6858 4.59937 20.3933 5.27579C22.1008 5.9522 23.6168 7.03637 24.8087 8.43362C26.0007 9.83086 26.8325 11.4987 27.2314 13.2914C27.6303 15.0842 27.5843 16.9474 27.0972 18.7182C26.6102 20.4891 25.6971 22.1138 24.4375 23.4504C23.2562 21.6229 21.4954 20.2451 19.4375 19.5379C20.4648 18.8537 21.2446 17.857 21.6617 16.6953C22.0788 15.5336 22.1111 14.2686 21.7536 13.0872C21.3962 11.9057 20.6681 10.8707 19.677 10.1351C18.6858 9.39943 17.4843 9.00225 16.25 9.00225C15.0157 9.00225 13.8142 9.39943 12.823 10.1351C11.8319 10.8707 11.1038 11.9057 10.7464 13.0872C10.3889 14.2686 10.4212 15.5336 10.8383 16.6953C11.2554 17.857 12.0352 18.8537 13.0625 19.5379C11.0046 20.2451 9.24382 21.6229 8.0625 23.4504C6.09368 21.3704 4.99758 18.6144 5 15.7504ZM12 14.7504C12 13.9098 12.2493 13.0881 12.7163 12.3892C13.1833 11.6903 13.847 11.1456 14.6236 10.8239C15.4002 10.5022 16.2547 10.4181 17.0791 10.5821C17.9036 10.746 18.6608 11.1508 19.2552 11.7452C19.8496 12.3396 20.2544 13.0968 20.4183 13.9213C20.5823 14.7457 20.4982 15.6002 20.1765 16.3768C19.8548 17.1534 19.3101 17.8171 18.6112 18.2841C17.9123 18.7511 17.0906 19.0004 16.25 19.0004C15.1238 18.9971 14.0448 18.5483 13.2484 17.752C12.4521 16.9556 12.0033 15.8765 12 14.7504ZM9.175 24.5004C9.91027 23.2815 10.948 22.2732 12.1876 21.5733C13.4271 20.8734 14.8265 20.5056 16.25 20.5056C17.6735 20.5056 19.0729 20.8734 20.3125 21.5733C21.552 22.2732 22.5897 23.2815 23.325 24.5004C21.3217 26.1178 18.8247 27 16.25 27C13.6753 27 11.1783 26.1178 9.175 24.5004Z"
                                        />
                                    </svg>
                                </span>
                                <span class="icon-control__label"><?=($GLOBALS["USER"]->IsAuthorized() ? 'Личный кабинет' : 'Войти')?></span>
                            </a>
                            <!-- end .icon-control-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end .header-->
    </div>
	<?if($APPLICATION->GetCurPage() == "/promo/"):?>

	<? $APPLICATION->IncludeComponent("bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => SITE_TEMPLATE_PATH."/include/search/index.php",
			"AREA_FILE_RECURSIVE" => "N",
			"EDIT_MODE" => "html",
			"CLASS" => "section_space-block_half"
		), false
	);
	?>

	<?endif;?>
    <div class="page__content <?=(defined('REMOVE_CONTENT_OFFSET') ? 'page__content_offset-top_none' : '') ?>">
        <?if(!defined('REMOVE_BREADCRUMBS')):?>
            <div class="page__breadcrumbs">
                <div class="page__container" id="navigation">
                    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb",
                        "main",
                        Array(
                            "START_FROM" => "0",
                            "PATH" => "",
                            "SITE_ID" => "s1"
                        )
                    );?>
                </div>
            </div>
        <?endif?>
        <?if(!defined('REMOVE_CONTENT_WRAPPER')):?>
            <div class="page__section">
                <div class="page__container">
                    <!-- begin .section-->
                    <div class="section">
                        <?if(!defined('REMOVE_H1_TITLE')):?>
                            <div class="section__header">
                                <div class="section__title">
                                    <!-- begin .title-->
                                    <div class="title title_size_h1"><?$APPLICATION->ShowTitle(false)?></div>
                                    <!-- end .title-->
                                </div>
                            </div>
                        <?endif?>
                        <div class="section__content">
        <?endif?>