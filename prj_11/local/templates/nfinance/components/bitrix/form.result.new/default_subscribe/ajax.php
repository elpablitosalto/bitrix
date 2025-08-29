<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \Bitrix\Main\Web\Json;

CModule::IncludeModule("form");

// Проверка валидности отправки формы
if (check_bitrix_sessid()) {
	$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

	if (\NoboringFinance\General::formValidate()) {
		if (\NoboringFinance\General::recaptchaCheck()) {
			$formErrors = CForm::Check($_POST['WEB_FORM_ID'], $_REQUEST, false, "Y", 'Y');

			// Если не все обязательные поля заполнены
			if (count($formErrors)) {
				echo Json::encode(['success' => false, 'errors' => $formErrors, 'typeError' => '1']);
			} elseif ($RESULT_ID = CFormResult::Add($_POST['WEB_FORM_ID'], $_REQUEST)) {

				CFormCRM::onResultAdded($_POST['WEB_FORM_ID'], $RESULT_ID);
				CFormResult::SetEvent($RESULT_ID);
				CFormResult::Mail($RESULT_ID);

				echo Json::encode(['success' => true, 'errors' => [], 'typeError' => '2']);
			} else {
				echo Json::encode(['success' => false, 'errors' => $GLOBALS["strError"], 'typeError' => '3']);
			}
		} else {
			echo Json::encode([
				'success' => false, 
				'errors' => ['Не пройдена проверка reCAPTCHA'], 
				'typeError' => '4',
				'RECAPTCHA_ANSWER' => $GLOBALS['RECAPTCHA_ANSWER'],
			]);
		}
	} else {
		echo Json::encode(['success' => false, 'errors' => ['Форма заполнена неверно'], 'typeError' => '5']);
	}
} else {
	// Предотвратили CSRF атаку
	echo Json::encode(['success' => false, 'errors' => ['sessid' => 'Не верная сессия. Попробуйте обновить страницу'], 'typeError' => '6']);
}

// Файл ниже подключать обязательно, там закрытие соединения с базой данных
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
