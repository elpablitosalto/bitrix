<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
use \Bitrix\Main\Web\Json;

// Подключаем модуль веб-форм
CModule::IncludeModule("form");

// Проверка валидности отправки формы
if (check_bitrix_sessid()) {
	$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

	// if(\Favorit\General::recaptchaCheck()) {
		$formField = $request->getPost('REGISTER');
		if(!empty($formField['EMAIL'])) {
			$fullName = '';
			$name = '';
			$lastName = '';
			$secondName = '';

			if(!empty($formField['FULL_NAME'])) {
				$arName = explode(' ', $formField['FULL_NAME']);

				if(!empty($arName[0])) $lastName = trim($arName[0]);
				if(!empty($arName[1])) $name = trim($arName[1]);
				if(!empty($arName[2])) $secondName = trim($arName[2]);
			}

			$password = \Bitrix\Main\Authentication\ApplicationPasswordTable::generatePassword();
			$userFields =  array(
				'LOGIN' => $formField['EMAIL'],
				'EMAIL' => $formField['EMAIL'],
				'NAME' => $name,
				'LAST_NAME' => $lastName,
				'SECOND_NAME' => $secondName,
				'PASSWORD' => $password,
				'CONFIRM_PASSWORD' => $password,
				'PERSONAL_PHONE' => $formField['PHONE_NUMBER']
			);

			$user = new CUser;
			$ID = $user->Add($userFields);
			if (intval($ID) > 0) {
                $GLOBALS["USER"]->Authorize($ID);
                // отсылаем письмо о регистрации
                $arLocalFields = array(
                    "EVENT_NAME" => "USER_REGISTER",
                    "C_FIELDS" => [
                        "NAME" => trim($formField['FULL_NAME']),
                        "EMAIL" => trim($userFields["EMAIL"]),
                        "PHONE" => trim($userFields["PERSONAL_PHONE"]),
                        "PASSWORD" => $password,
                    ],
                    "LID" => "s1",
                    "DUPLICATE" => "N",
                    "FILE" => [],
                    "LANGUAGE_ID" => "",
                );
                $result = \Bitrix\Main\Mail\Event::send($arLocalFields);
                if (!empty($result) && $result->isSuccess()) {
                    echo Json::encode(['TYPE' => 'OK', 'MESSAGE' => 'Вы успешно зарегестрировались!']);
                }else{
                    echo Json::encode(['TYPE' => 'ERROR', 'MESSAGE' => 'Не удалось отправить письмо!']);
                }
			}
			else {
				echo Json::encode(['TYPE' => 'ERROR', 'MESSAGE' => $user->LAST_ERROR]);
			}
		} else {
			echo Json::encode(['TYPE' => 'ERROR', 'MESSAGE' => 'E-mail не может быть пустым']);
		}
	// } else {
	// 	echo Json::encode(['TYPE' => 'ERROR', 'MESSAGE' => 'Не пройдена проверка reCAPTCHA']);
	// }

} else {
	// Предотвратили CSRF атаку
	echo Json::encode(['TYPE' => 'ERROR', 'MESSAGE' => 'Неверная сессия. Попробуйте обновить страницу']);
}

// Файл ниже подключать обязательно, там закрытие соединения с базой данных
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
