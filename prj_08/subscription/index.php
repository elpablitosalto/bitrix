<?
//define("HIDE_SIDEBAR", true);
define('SHOW_TELEGRAM_SUBSCRIBE', 'N');
define('SHOW_CONTACT_US_BUTTON', 'N');
define('LEFT_MENU_TYPE', 'leftside_profile');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Рассылка");
$APPLICATION->SetPageProperty("PAGE_H1", "Рассылка");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-account');
//$APPLICATION->SetPageProperty("H1_ADD", '<br><span class="color_olive" style="font-size: 65%;">Новости, акции, рекомендации экспертов</span>');
//$APPLICATION->AddChainItem('Личный кабинет', '/personal/');
?>

<? if ($USER->IsAuthorized()) { ?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:subscribe.edit",
		"mafmarket",
		array(
			"AJAX_MODE" => "N",
			"SHOW_HIDDEN" => "Y",
			"ALLOW_ANONYMOUS" => "Y",
			"SHOW_AUTH_LINKS" => "N",
			"CACHE_TYPE" => "N",
			"CACHE_TIME" => "3600",
			"SET_TITLE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",

			// Мои параметры -->
			"H1_TITILE_IN_EPILOG" => "Подписка на рассылку",
			// <-- Мои параметры
		)
	); ?>
<? } else { ?>
	<div class="dp-account-profile">
		<div class="dp-account-profile-block">
			Пожалуйста авторизуйтесь на сайте.
		</div>
	</div>
<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>