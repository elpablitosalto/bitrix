<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $USER;

use \Bitrix\Main\Page\Asset,
	\Bitrix\Main\Application,
	\Bitrix\Main\Context,
	\Bitrix\Main\Web\Uri;

$showH1 = true;

$uri = new Uri(Application::getInstance()->getContext()->getRequest()->getRequestUri());

global $isHomePage;
$isHomePage = ($APPLICATION->GetCurPage(false) === SITE_DIR);

$curDir = $APPLICATION->GetCurDir();
$page = $APPLICATION->GetCurPage();
$pagePath = $APPLICATION->GetCurPage(false);

switch ($curDir) {
	case '/kodjizni/';
		$headerType = 'kodjizni';
		break;
	case '/courses/vygoranie_osnovybalansa/';
		$headerType = 'vygoranie_osnovybalansa';
		break;
	case '/courses/trydnii_pacient/':
		$headerType = 'tp';
		break;
	case '/courses/kalgari_kembridgskaya_model/':
		$headerType = 'kkm';
		break;
	case '/courses/kalgari_kembridgskaya_model_new/':
		$headerType = 'kkm_new';
		break;
	case '/master-class/top_3_tehniki/':
	case '/master-class/goret_no_ne_vigorat/':
		$headerType = 'master-class';
		break;
	default:
		$headerType = 'default';
}

$bodyClass = "t-body";
if (mb_substr($curDir, 0, 14) == "/master-class/") {
	$bodyClass = "gc-user-guest";
}
if ($headerType == 'kkm_new') {
	$bodyClass = "";
}
if ($headerType == 'kkm_new' || $headerType == 'kkm' || $headerType == 'kodjizni' || $headerType == 'tp' || $headerType == 'vygoranie_osnovybalansa' || $headerType == 'master-class') {
	$showH1 = false;
}
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
	echo '<link rel="canonical" href="https://' . Context::getCurrent()->getServer()->getHttpHost() . $page . '" />';
	?>
	<?
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
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/intl-tel-input/js/intlTelInput.min.js"); #
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/RobinHerbots-Inputmask/jquery.inputmask.min.js"); #
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/indexis-phone.js"); #
	//Asset::getInstance()->addJs('/local/lib' . "/intl-tel-input-master/build/js/intlTelInput.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");
	Asset::getInstance()->addJs('/local/lib' . "/js/custom.js");

	//other
	//Asset::getInstance()->addString('<script data-skip-moving="true" src="https://smartcaptcha.yandexcloud.net/captcha.js?render=onload&onload=showHiddenCaptcha" defer></script>');

	//css
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/fancybox/jquery.fancybox.min.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/intl-tel-input/css/intlTelInput.min.css"); #
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/common.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/main.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/custom.css");
	//Asset::getInstance()->addCss('/local/lib' . "/intl-tel-input-master/build/css/intlTelInput.css");

	// Разметка OG. https://ogp.me
	if (!defined('SET_OG_MARKING')) {
		define('SET_OG_MARKING', 'N');
	}
	if (SET_OG_MARKING == 'Y') {
		CMarkingOG::show();
	}
	?>
	<? require_once($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/header/' . $headerType . '.php'); ?>
</head>

<body class="<?= $bodyClass ?> <? $APPLICATION->ShowProperty("PAGE_BODY_CLASS"); ?>" data-svg-sprite="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg" data-svg-icons="all">
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
						<? $APPLICATION->IncludeComponent(
							"bitrix:search.form",
							"vrachbudushego",
							array(
								"USE_SUGGEST" => "N",
								"PAGE" => "#SITE_DIR#search/index.php"
							)
						); ?>
						<?/*?>
						<form class="dp-header-search-form">
							<input id="title-search-input" class="dp-header-search-form__input" type="text" placeholder="Поиск">
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
						<button class="dp-btn dp-btn_m dp-btn_orange dp-header-auth-btn" data-modal="#modal-auth" data-mb-block="0"><span>Вход или регистрация</span></button>
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
					<? if ($showH1 == true) { ?>
						<h1 class="dp-page__title" style="height: 0; padding: 0;margin: 0;overflow: hidden;"><? $APPLICATION->ShowTitle() ?></h1>
					<? } ?>

					<?/*$arResult['NOTE_CODE'] = 'CONFIRM_EMAIL';?>
					<? if (!empty($arResult['NOTE_CODE'])) { ?>
						<?
						switch ($arResult['NOTE_CODE']) {
							case 'CONFIRM_EMAIL':
								?>
								<div class="dp-page__notes">
									<div class="container">
										<div class="dp-confirm-email">
											<a class="dp-confirm-email__link" href="#">
												<div class="dp-confirm-email__icon"></div>
												<div class="dp-confirm-email__caption">
													<p class="font-weight_medium">Подтвердите свой е-mail</p>
													<p>Чтобы не пропускать новые материалы</p>
												</div>
											</a>
										</div>
									</div>
								</div>
								<?
								break;
						}
						?>
					<? }*/ ?>