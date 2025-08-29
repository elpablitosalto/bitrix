<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Page\Asset;

global $APPLICATION, $TEMPLATE_OPTIONS, $arSite, $bIndexBot, $isHomePage, $isMobile,
	$isPageSpeedBot, $showTopMenuFirstLevel, $arDelayedLoading;

$page = $APPLICATION->GetCurPage(false);

$isHomePage = ($APPLICATION->GetCurPage(false) === SITE_DIR);

if ($GET["debug"] == "y") {
	error_reporting(E_ERROR | E_PARSE);
}
IncludeTemplateLangFile(__FILE__);

$arSite = CSite::GetByID(SITE_ID)->Fetch();
$htmlClass = ($_REQUEST && isset($_REQUEST['print']) ? 'print' : false);

$bIndexBot = (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') !== false);

// Показывать JS -->
$GLOBALS['SHOW'] = array(
	"bootstrap" => "Y",
	"modal_size_grid" => "Y",
);
if ($page == '/') {
	//$GLOBALS['SHOW']['bootstrap'] = 'N';
	//$GLOBALS['SHOW']['modal_size_grid'] = 'N';
}
// <-- Показывать JS

// Использовать или нет фильтр -->
$GLOBALS['CATALOG_USE_FILTER'] = \First\Catalog::useFilter();
// <-- Использовать или нет фильтр


// Добавить или удалить мелкооптовую упаковку -->
\First\Catalog::addOrDelSwpInBasket();
// <-- Добавить или удалить мелкооптовую упаковку

// Мобильное устройство?
$isMobile = isMobileDevice();
//echo 'isMobile = '.$isMobile.'<br />';
// <--

// Бот PageSpeed?
$isPageSpeedBot = isPageSpeedBot();
// <--

// Тестирование PageSpeed (после теста закомментировать) -->
$isPageSpeedTest = $_GET['pst'] == 'y' ? true : false;
// <-- 

// Если мобильное устройство или бот PageSpeed, то показываем один уровень меню, а остальные уровни грузим по Ajax -->
$showTopMenuFirstLevel = 'N';
if ($isMobile == true /*|| $isPageSpeedBot == true*/ || $isPageSpeedTest == true) {
	$showTopMenuFirstLevel = 'Y';
}
// <--

// Отложенная загрузка JS-скриптов и стилей -->
if (/*$isMobile == true || $isPageSpeedBot == true || */$isPageSpeedTest == true) {
	$arDelayedLoading['flags']['delayLoad'] = 'Y';
}
// <-- 
?>
<!DOCTYPE html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>" xmlns="http://www.w3.org/1999/xhtml" <?= ($htmlClass ? 'class="' . $htmlClass . '"' : '') ?>>

<head>
	<title><? $APPLICATION->ShowTitle() ?></title>
	<?
	$APPLICATION->ShowMeta("viewport");
	$APPLICATION->ShowMeta("HandheldFriendly");
	$APPLICATION->ShowMeta("apple-mobile-web-app-capable", "yes");
	$APPLICATION->ShowMeta("apple-mobile-web-app-status-bar-style");
	$APPLICATION->ShowMeta("SKYPE_TOOLBAR");

	// Разбивка вывода на несколько функций, вместо одной
	// ShowHead -->
	/*
	$APPLICATION->ShowMeta("keywords");      // Вывод мета - тега keywords
	$APPLICATION->ShowMeta("description");      // Вывод мета - тега description
	$APPLICATION->ShowCSS();         // Подключение файлов стилей CSS

	if ($USER->IsAdmin())
		$APPLICATION->ShowHeadStrings();   // Отображает специальные стили, JavaScript
	*/

	$APPLICATION->ShowHead();
	// <-- ShowHead


	if (CModule::IncludeModule("aspro.mshop")) {
		CMShopCustom::Start(SITE_ID);

		// Убрать стандартный метод и использовать вместо него кастомизированный
		// CMShop::Start(SITE_ID);
	}

	// JS -->
	//TemplateTools::showJS();
	//$APPLICATION->AddHeadString('<script>BX.message(' . CUtil::PhpToJSObject($MESS, false) . ')</script>', true);
	// <-- JS
	?>

	<?
	// CSS -->
	?>
	<? $APPLICATION->AddHeadString('
	<!--[if gte IE 9]>
	<style type="text/css">.basket_button, .button30, .icon {
		filter: none;
	}</style><![endif]-->', true); ?>
	<?/*?>
	<!--[if gte IE 9]>
	<style type="text/css">.basket_button, .button30, .icon {
		filter: none;
	}</style><![endif]-->
	<?*/ ?>

	<? if (!$bIndexBot) : ?>
		<?/*?>
		<link href='<?= CMain::IsHTTPS() ? 'https' : 'http' ?>://fonts.googleapis.com/css?family=Ubuntu:400,500,700,400italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
		<?*/ ?>
		<?
		/*
		$href = CMain::IsHTTPS() ? 'https' : 'http';
		$href .= '://fonts.googleapis.com/css?family=Ubuntu:400,500,700,400italic&subset=latin,cyrillic';
		$href .= '&display=swap';
		$str = '<link href="' . $href . '" rel="stylesheet" type="text/css">';
		$APPLICATION->AddHeadString($str);
		*/
		?>
		<?
		/*
		$str = "
			<style>
			@font-face {
				font-family: 'Pacifico';
				font-style: normal;
				font-weight: 400;
				src: local('Pacifico Regular'), local('Pacifico-Regular'),
					url(https://fonts.gstatic.com/s/pacifico/v12/FwZY7-Qmy14u9lezJ-6H6MmBp0u-.woff2)
					format('woff2');
				font-display: swap;
			}
			</style>
		";
		*/
		//$APPLICATION->AddHeadString($str);
		?>
	<? endif; ?>
	<?
	// <-- CSS
	?>

	<? if (!$bIndexBot) : ?>
		<?
		// CSS -->
		?>
		<?
		if ($GLOBALS['SHOW']['bootstrap'] != 'N') {
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/lib/bootstrap/4.3.1/css/bootstrap.min.css');
			// $APPLICATION->AddHeadString('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">');
			// Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap.min.css");
		?>
			<?/*?>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			<?*/ ?>
		<? } ?>
		<? if (!$isHomePage) { ?>
			<?
			if ($arDelayedLoading['flags']['delayLoad'] == 'Y') {
				$arDelayedLoading['css'][] = SITE_TEMPLATE_PATH . "/js/fancybox/5.0/dist/fancybox/fancybox.css";
				//Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/js/fancybox/5.0/dist/fancybox/fancybox.css");
			} else {
				Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/js/fancybox/5.0/dist/fancybox/fancybox.css");
			}
			//$APPLICATION->AddHeadString('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />');
			?>
			<?/*?>
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
			<?*/ ?>
		<? } ?>
		<?/*?>
		<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH;?>/lib/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH;?>/lib/fancybox/5.0/fancybox.css" />
		<?*/ ?>
		<?
		$APPLICATION->AddHeadString('
		<style>
			a.scroll-to-top {
				right: 100px;
			}
		</style>');
		?>
		<?/*?>
		<style>
			a.scroll-to-top {
				right: 100px;
			}
		</style>
		<?*/ ?>
		<?
		// <-- CSS
		?>

		<?
		// JS -->
		?>
		<?
		/*
		CJSCore::init(['jquery2']);
		$APPLICATION->AddHeadScript("https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.3.0/jquery-migrate.min.js");
		*/
		?>
		<?/*?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<?*/ ?>
		<?
		//TemplateTools::showJS();
		$APPLICATION->AddHeadString('<script>BX.message(' . CUtil::PhpToJSObject($MESS, false) . ')</script>', true);

		if ($arDelayedLoading['flags']['delayLoad'] == 'Y') {

			$arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . "/js_custom/jquery.flexloader/dist/jquery.flexloader.min.js";
			//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.flexloader/dist/jquery.flexloader.min.js");

			$arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . "/js_custom/jquery.lazy/1.7.10/jquery.lazy.js";
			//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.lazy/1.7.10/jquery.lazy.js");

			$arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . "/js_custom/custom_webaim.js";
			//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/custom_webaim.js", true);
		} else {
			Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.flexloader/dist/jquery.flexloader.min.js");
			Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.lazy/1.7.10/jquery.lazy.js");

			// Загружается через JS по событию скролла страницы
			//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/gonumbersMaskPhone.js");

			Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/custom_webaim.js", true);
		}
		?>

		<? if (!$isHomePage) { ?>
			<?
			// Загружается через JS по событию скролла страницы
			//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/fancybox/5.0/dist/fancybox/fancybox.umd.js");
			?>
			<?/*?>
			<script async src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
			<?*/ ?>
		<? } ?>
		<?
		// <-- JS
		?>
	<? endif; ?>
	<meta name="google-site-verification" content="8Y4blCVGnJjfPqfh-V6k_WXjiLGR5DG15Qa1rT_MgnA" />

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
		})(window, document, 'script', 'dataLayer', 'GTM-KJSC869X');
	</script>
	<!-- End Google Tag Manager -->

	<?
	// Загрузка GA через Google Tag Manager
	?>
	<?/*?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async data-skip-moving="true" src="https://www.googletagmanager.com/gtag/js?id=G-1GN1RPTZ72"></script>
	<script async data-skip-moving="true">
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'G-1GN1RPTZ72');
		gtag('config', 'AW-454705528');
	</script>
	<?*/ ?>

	<?
	// Старый Tag Manager
	?>
	<?/*?>
	<!-- Google Tag Manager -->
	<script async data-skip-moving="true">
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
			j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-PP9DN6N');
	</script>
	<!-- End Google Tag Manager -->
	<?*/ ?>
</head>

<body class='<?= ($bIndexBot ? "wbot" : ""); ?>' id="main">
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KJSC869X" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<?
	// Старый Tag Manager
	?>
	<?/*?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PP9DN6N" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?*/ ?>

	<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>

	<? if (!CModule::IncludeModule("aspro.mshop")) { ?>
		<center><? $APPLICATION->IncludeFile(SITE_DIR . "include/error_include_module.php"); ?></center>
		<?
		echo '</body></html>';
		die();
		?>
	<? } ?>

	<? $APPLICATION->IncludeComponent("aspro:theme.mshop", ".default", array("COMPONENT_TEMPLATE" => ".default"), false); ?>
	<?
	//CMShopCustom::SetJSOptions(); 
	CMShop::SetJSOptions();
	?>
	<? $isFrontPage = CSite::InDir(SITE_DIR . 'index.php'); ?>
	<? $isContactsPage = CSite::InDir(SITE_DIR . 'contacts/'); ?>
	<? $isBasketPage = CSite::InDir(SITE_DIR . 'basket/'); ?>
	<div class="wrapper <?= ($TEMPLATE_OPTIONS["HEAD"]["CURRENT_MENU_COLOR"] != "none" ? "has_menu" : ""); ?> <?= CMShop::getCurrentThemeClasses(); ?> h_color_<?= $TEMPLATE_OPTIONS["HEAD"]["CURRENT_HEAD_COLOR"]; ?> m_color_<?= $TEMPLATE_OPTIONS["HEAD"]["CURRENT_MENU_COLOR"]; ?> <?= ($isFrontPage ? "front_page" : ""); ?> basket_<?= strToLower($TEMPLATE_OPTIONS["BASKET"]["CURRENT_VALUE"]); ?> head_<?= strToLower($TEMPLATE_OPTIONS["HEAD"]["CURRENT_VALUE"]); ?> banner_<?= strToLower($TEMPLATE_OPTIONS["BANNER_WIDTH"]["CURRENT_VALUE"]); ?>">
		<div class="header_wrap <?= strtolower($TEMPLATE_OPTIONS["HEAD_COLOR"]["CURRENT_VALUE"]) ?>">
			<div class="top-h-row">
				<div class="wrapper_inner">
					<div class="content_menu">
						<? $APPLICATION->IncludeComponent(
							"bitrix:menu",
							"top_content_row",
							array(
								"ROOT_MENU_TYPE" => $TEMPLATE_OPTIONS["HEAD"]["CURRENT_MENU"],
								"MENU_CACHE_TYPE" => "Y",
								"MENU_CACHE_TIME" => "86400",
								"MENU_CACHE_USE_GROUPS" => "N",
								"MENU_CACHE_GET_VARS" => array(),
								"MAX_LEVEL" => "2",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "N",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "N",
								"COMPONENT_TEMPLATE" => "top_content_row",
								"COMPOSITE_FRAME_MODE" => "A",
								"COMPOSITE_FRAME_TYPE" => "AUTO",
								"CACHE_SELECTED_ITEMS" => "N"
							),
							false
						); ?>
					</div>
					<div class="phones">
						<span class="phone_wrap">
							<span class="icons"></span>
							<span class="phone_text">
								<? $APPLICATION->IncludeFile(SITE_DIR . "include/phone.php", array(), array("MODE" => "html", "NAME" => GetMessage("PHONE"))); ?>
							</span>
						</span>

					</div>
					<?/*<a class="topbar_mail" href="mailto:store@firstltd.ru">store@firstltd.ru</a>*/ ?>

				</div>
			</div>
			<header id="header">
				<div class="wrapper_inner">
					<div class="row header_row align-items-center">

						<div class="col-6 col-md-2">
							<div class="logo">
								<? CMShop::ShowLogo(); ?>
							</div>
						</div>
						<div class="col-12 order-2 order-md-1 col-md-6 col-lg-8">
							<div class="row align-items-center justify-content-center justify-content-lg-between">
								<div class="main-nav col">
									<? include($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/menu.top_general_multilevel.php'); ?>
								</div>

								<div class="middle_phone d-none d-md-block text-center col">
									<div class="header_actions">


										<div class="header_actions_item">
											<div class="phones">
												<span class="phone_wrap">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M6.67962 3.32038L7.29289 2.70711C7.68342 2.31658 8.31658 2.31658 8.70711 2.70711L11.2929 5.29289C11.6834 5.68342 11.6834 6.31658 11.2929 6.70711L9.50048 8.49952C9.2016 8.7984 9.1275 9.255 9.31653 9.63307C10.4093 11.8186 12.1814 13.5907 14.3669 14.6835C14.745 14.8725 15.2016 14.7984 15.5005 14.4995L17.2929 12.7071C17.6834 12.3166 18.3166 12.3166 18.7071 12.7071L21.2929 15.2929C21.6834 15.6834 21.6834 16.3166 21.2929 16.7071L20.6796 17.3204C18.5683 19.4317 15.2257 19.6693 12.837 17.8777L11.6286 16.9714C9.88504 15.6638 8.33622 14.115 7.02857 12.3714L6.12226 11.163C4.33072 8.7743 4.56827 5.43173 6.67962 3.32038Z" fill="#222222" />
													</svg>
													<span class="phone_text">
														<? $APPLICATION->IncludeFile(SITE_DIR . "include/phone.php", array(), array("MODE" => "html", "NAME" => GetMessage("PHONE"))); ?>
													</span>
												</span>
											</div>
											<div class="font-size-12 header-mail" style="color: #1e4a72;font-weight: bold;">
												только для ИП и юр.лиц<br>
												<a href="mailto:store@firstltd.ru">store@firstltd.ru</a>
											</div>
										</div>
									</div>
								</div>
								<div class="search d-none d-md-flex col">
									<? include($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/search.title.catalog.php'); ?>
								</div>
							</div>
						</div>
						<div class="col-6 col-md-4 col-lg-2 order-1 order-md-2 basket_wrapp custom_basket_class d-flex justify-content-end <?= CMShop::getCurrentPageClass() ?>">
							<div class="wrapp_all_icons row flex-nowrap">
								<? $APPLICATION->IncludeComponent(
									"bitrix:system.auth.form",
									"top_fixed",
									array(
										"REGISTER_URL" => SITE_DIR . "auth/registration/",
										"FORGOT_PASSWORD_URL" => SITE_DIR . "auth/forgot-password/",
										"PROFILE_URL" => SITE_DIR . "personal/",
										"SHOW_ERRORS" => "Y"
									)
								); ?>
								<div class="header-cart" id="basket_line">
									<? Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("header-cart"); ?>
									<? //CSaleBasket::UpdateBasketPrices(CSaleBasket::GetBasketUserID(), SITE_ID);
									?>
									<? if ($TEMPLATE_OPTIONS["BASKET"]["CURRENT_VALUE"] === "FLY" && !$isBasketPage && !CSite::InDir(SITE_DIR . "order/")) : ?>
										<script async type="text/javascript">
											$(document).ready(function() {
												$.ajax({
													url: arMShopOptions["SITE_DIR"] + "ajax/basket_fly.php",
													type: "post",
													success: function(html) {
														$("#basket_line").append(html);
													}
												});
											});
										</script>
									<? else : ?>
										<? $APPLICATION->IncludeFile(SITE_DIR . "include/basket_top.php", array(), array("MODE" => "html", "NAME" => GetMessage("BASKET_TOP"))); ?>
									<? endif; ?>
									<? Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("header-cart", ""); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="catalog_menu">
					<div class="wrapper_inner">
						<div class="wrapper_middle_menu js_catalog_top_menu">
							<?
							// Если мобильное устройство или бот PageSpeed, то показываем один уровень меню, а остальные уровни грузим по Ajax 							
							if ($showTopMenuFirstLevel == 'Y') {
								include($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/menu.top_catalog_onelevel.php');
							} else {
								include($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/menu.top_catalog_multilevel.php');
							}
							?>
							<input type="hidden" class="js_show_top_menu_first_level" value="<?= $showTopMenuFirstLevel; ?>" />
						</div>
					</div>
				</div>
			</header>
		</div>
		<? if ($TEMPLATE_OPTIONS["HEAD_FIXED_CHECK"]["CURRENT_VALUE"] == 'HEAD_FIXED_1') : ?>
			<div id="headerfixed" class="<?= $TEMPLATE_OPTIONS["HEAD"]["CURRENT_HEAD_COLOR"] ?>">
				<? CMShop::ShowPageType('header_fixed'); ?>
			</div>
		<? endif; ?>
		<? if ($TEMPLATE_OPTIONS["HEAD_MOBILE_CHECK"]["CURRENT_VALUE"] == 'Y') : ?>
			<div id="headerfixed_mobile" class="<?= $TEMPLATE_OPTIONS["HEAD"]["CURRENT_HEAD_COLOR"] ?>">
				<? CMShop::ShowPageType('header_fixed_mobile'); ?>
			</div>
		<? endif; ?>
		<? if (!\CSite::InGroup([12])) : ?>
			<div class="top-message">
				<?
				$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/include/top_message.php",
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
					),
					false
				);
				?>
			</div>
		<? endif; ?>
		<? if (!$isFrontPage) : ?>
			<div class="wrapper_inner">
				<section class="middle">
					<div class="container">
						<? $APPLICATION->IncludeComponent(
							"bitrix:breadcrumb",
							"mshop",
							array(
								"START_FROM" => "0",
								"PATH" => "",
								"SITE_ID" => "-",
								"SHOW_SUBSECTIONS" => "N"
							),
							false
						); ?>
						<? $APPLICATION->ShowViewContent('section_bnr_content'); ?>
						<? if ($APPLICATION->GetProperty("TITLE_IN_RIGHT_BLOCK") !== 'Y'): ?>
							<!--title_content-->
							<h1 id="pagetitle"><?= $APPLICATION->ShowTitle(false); ?></h1>
							<!--end-title_content-->
						<? endif; ?>
						<? if ($isContactsPage) : ?>
					</div>
				</section>
			</div>
		<? else : ?>
			<div id="content">
				<? if (CSite::InDir(SITE_DIR . 'help1/') || CSite::InDir(SITE_DIR . 'company/') || CSite::InDir(SITE_DIR . 'info1/') || CSite::InDir(SITE_DIR . 'poleznaya-informatsiya1/')) : ?>
					<? if (CSite::InDir(SITE_DIR . 'company/')) { ?>
						<? $APPLICATION->ShowViewContent('detail_filter'); ?>
						<div class="left_block">
							<? $APPLICATION->IncludeComponent(
										"bitrix:menu",
										"left_menu",
										array(
											"ROOT_MENU_TYPE" => "left",
											"MENU_CACHE_TYPE" => "A",
											"MENU_CACHE_TIME" => "3600000",
											"MENU_CACHE_USE_GROUPS" => "N",
											"MENU_CACHE_GET_VARS" => "",
											"MAX_LEVEL" => "1",
											"CHILD_MENU_TYPE" => "left",
											"USE_EXT" => "Y",
											"DELAY" => "N",
											"ALLOW_MULTI_SELECT" => "N",
											"CACHE_SELECTED_ITEMS" => "N"
										),
										false,
										array("ACTIVE_COMPONENT" => "Y")
									); ?>
						</div>
						<div class="right_block">
							<? if ($APPLICATION->GetProperty("TITLE_IN_RIGHT_BLOCK") === 'Y'): ?>
								<!--title_content-->
								<h1 id="pagetitle"><?= $APPLICATION->ShowTitle(false); ?></h1>
								<!--end-title_content-->
							<? endif; ?>
						<? } ?>
					<? endif; ?>
				<? endif; ?>
			<? endif; ?>
			<? if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") $APPLICATION->RestartBuffer(); ?>