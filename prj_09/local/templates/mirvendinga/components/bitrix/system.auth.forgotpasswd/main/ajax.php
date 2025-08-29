<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
use \Bitrix\Main\Web\Json;

// Подключаем модуль веб-форм
CModule::IncludeModule("form");

// Проверка валидности отправки формы
if (check_bitrix_sessid()) {
	$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

	// if(\Mirvendinga\General::recaptchaCheck()) {

		$userLogin = $request->getPost('USER_LOGIN');
		$userEmail = $request->getPost('USER_EMAIL');
		// $userField["PASSWORD"] = \Bitrix\Main\Authentication\ApplicationPasswordTable::generatePassword();
		// $userField["CONFIRM_PASSWORD"] = $userField["PASSWORD"];

		if(!empty($userLogin)) {
			$userEmail = $userLogin;
			global $USER;
			//$arResult = $USER->SendPassword($userLogin, $userEmail);
			//$arResult = $USER->Register($userField['LOGIN'], "", "", "", "", $userField['LOGIN']);
            $arResult = $GLOBALS["APPLICATION"]->arAuthResult;

			echo Json::encode($arResult);
		} else {
			echo Json::encode(['TYPE' => 'ERROR', 'MESSAGE' => 'E-mail не может быть пустым']);
		}
	// } else {
	// 	echo Json::encode(['TYPE' => 'ERROR', 'MESSAGE' => 'Не пройдена проверка reCAPTCHA']);
	// }

} else {
	// Предотвратили CSRF атаку
	echo Json::encode(['TYPE' => 'ERROR', 'MESSAGE' => ['Неверная сессия. Попробуйте обновить страницу']]);
}

// Файл ниже подключать обязательно, там закрытие соединения с базой данных
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
