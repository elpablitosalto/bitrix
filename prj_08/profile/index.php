<?
//define("NEED_AUTH", true);
define('SHOW_TELEGRAM_SUBSCRIBE', 'N');
define('SHOW_CONTACT_US_BUTTON', 'N');
define('LEFT_MENU_TYPE', 'leftside_profile');
if ($_GET['account_successfully_deleted'] == 'Y') {
	define('LIKE_HOME', 'Y');
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Профиль");
$APPLICATION->SetPageProperty("PAGE_H3", 'Профиль');
if ($_GET['account_successfully_deleted'] == 'Y') {
	$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-account-delete');
} else {
	$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-account');
}
?>
<? if ($USER->IsAuthorized()) { ?>
	<?
	if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["PERSONAL_PHONE"])) {
		$filter = array(
			'PERSONAL_PHONE' => $_POST["PERSONAL_PHONE"],
			'!ID' =>  $USER->GetID()
		);
		$rsUsers = CUser::GetList(($by = "personal_country"), ($order = "desc"), $filter); // выбираем пользователей
		if ($arUser = $rsUsers->GetNext()) {
			LocalRedirect('/profile/?phone_present=Y&phone='.urlencode($_POST["PERSONAL_PHONE"]));
		}
	}
	?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:main.profile",
		"mafmarket",
		array(
			"CHECK_RIGHTS" => "N",
			"SEND_INFO" => "N",
			"SET_TITLE" => "N",
			"USER_PROPERTY" => array(),
			"USER_PROPERTY_NAME" => ""
		)
	); ?>
<? } else { ?>
	<? if ($_GET['account_successfully_deleted'] == 'Y') { ?>
		<main class="dp-page">
			<section class="dp-section dp-section-account-delete">
				<div class="container">
					<h1 class="dp-section-account-delete__title">Ваш аккаунт удален</h1>
					<a class="dp-btn dp-section-account-delete__btn" href="/">Вернуться на главную</a>
				</div>
			</section>
		</main>
		<?/*?>
		<div class="dp-account-profile">
			<div class="dp-account-profile-block">
				Аккаунт успешно удалён
				<br /><br />
				<button class="dp-btn dp-form__submit" type="button" onclick="window.location.href='/';">Вернуться на главную</button>
			</div>
		</div>
		<?*/ ?>
	<? } else { ?>
		<div class="dp-account-profile">
			<div class="dp-account-profile-block">
				Пожалуйста авторизуйтесь на сайте.
			</div>
		</div>
	<? } ?>
<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>