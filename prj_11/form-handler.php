<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;

$request = Application::getInstance()->getContext()->getRequest();
$default_params = array(
	"WEB_FORM_ID" => "5",
	"BACKGROUND_COLOR" => "#E04D4D",
	"BUTTON_TEXT" => "Отправить",
	"DESCRIPTION" => "Введите email для подписки на рассылку",
	"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
	"ERROR_TITLE" => "Произошла ошибка :(",
	"IMAGE" => "",
	"PLACEHOLDER" => "Введите ваш E-mail",
	"POLICY_LINK" => "/policy/",
	"POLICY_LINK_TEXT" => "политикой конфиденциальности",
	"POLICY_LINK_CLASS" => "link link_style_light",
	"POLICY_TEXT" => "Нажимая на кнопку, вы соглашаетесь с %s",
	"SUCCESS_DESCRIPTION" => "Материал летит к вам на почту",
	"SUCCESS_TITLE" => "Спасибо! Мы получили вашу заявку!",
	"TITLE" => "Подписаться на email рассылку",
	"COMPONENT_TEMPLATE" => ".default",
	"FORM_TYPE" => "",
	"FORM_CALLBACK_ID" => ""
);
$form_params = $_POST;

if(empty($form_params)) {
	$default_params['PRESET'] = 'A';
}

$form_params = empty($form_params) ? $default_params : $form_params;
$form_params = array_merge($default_params, $form_params);
?>

<?if(!empty($form_params)):?>
<?$APPLICATION->IncludeComponent(
	"waim:subscribe.form",
	".default",
	$form_params,
	false
);?>
<?endif;?>