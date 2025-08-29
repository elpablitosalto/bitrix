<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

$arComponentParameters = Array(
	"GROUPS" => Array(
		"PRESET" => Array(
			"NAME" => "Стандартные типы",
			"SORT" => "1"
		),
		"FORM" => Array(
			"NAME" => "Форма",
			"SORT" => "100"
		),
		"CAPTCHA" => Array(
			"NAME" => "reCAPTCHA",
			"SORT" => "200"
		),
		"POLICY" => Array(
			"NAME" => "Политика конфиденциальности",
			"SORT" => "1000"
		)
	),
	"PARAMETERS" => Array(
		"FORM_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => "ID формы",
			"TYPE" => "TEXT",
			"DEFAULT" => null,
		),
		"TITLE" => Array(
			"PARENT" => "BASE",
			"NAME" => "Заголовок формы",
			"TYPE" => "TEXT",
			"DEFAULT" => null,
		),
		"DESCRIPTION" => Array(
			"PARENT" => "BASE",
			"NAME" => "Описание",
			"TYPE" => "TEXT",
			"DEFAULT" => null,
		),
		"USE_RECAPTCHA" => array(
			"PARENT" => "CAPTCHA",
			"NAME" => "Использовать reCAPTCHA",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N"
		),
		"RECAPTCHA_SITE_KEY" => array(
			"PARENT" => "CAPTCHA",
			"NAME" => "Публичный ключ",
			"TYPE" => "TEXT",
			"DEFAULT" => null,
		),
		"RECAPTCHA_SECRET_KEY" => array(
			"PARENT" => "CAPTCHA",
			"NAME" => "Приватный ключ",
			"TYPE" => "TEXT",
			"DEFAULT" => null,
		),
		"RECAPTCHA_SCORE" => array(
			"PARENT" => "CAPTCHA",
			"NAME" => "Оценка",
			"TYPE" => "TEXT",
			"DEFAULT" => '0.2',
		),
		"BUTTON_TEXT" => Array(
			"PARENT" => "FORM",
			"NAME" => "Текст кнопки",
			"TYPE" => "TEXT",
			"DEFAULT" => 'Отправить',
		),
		"SUCCESS_TITLE" => Array(
			"PARENT" => "FORM",
			"NAME" => "Заголовок сообщения успешной отправки",
			"TYPE" => "TEXT",
			"DEFAULT" => 'Ваше сообщенеи было отправлено',
		),
		"SUCCESS_DESCRIPTION" => Array(
			"PARENT" => "FORM",
			"NAME" => "Текст сообщения об успешной отправке",
			"TYPE" => "TEXT",
			"DEFAULT" => 'Наш менеджер свяжется с вами',
		),
		"ERROR_TITLE" => Array(
			"PARENT" => "FORM",
			"NAME" => "Заголовок сообщения об ошибке отправки",
			"TYPE" => "TEXT",
			"DEFAULT" => 'Произошла ошибка :(',
		),
		"ERROR_DESCRIPTION" => Array(
			"PARENT" => "FORM",
			"NAME" => "Текст собщения об ошибке отправки",
			"TYPE" => "TEXT",
			"DEFAULT" => 'Попробуйте повторить отправку позднее',
		),
		/*
		"POLICY_TEXT" => Array(
			"PARENT" => "POLICY",
			"NAME" => "Текст",
			"TYPE" => "TEXT",
			"DEFAULT" => "Нажимая на кнопку, вы соглашаетесь с %s",
		),
		"POLICY_LINK" => Array(
			"PARENT" => "POLICY",
			"NAME" => "Текст ссылки",
			"TYPE" => "TEXT",
			"DEFAULT" => "/policy/",
		),
		"POLICY_LINK_TEXT" => Array(
			"PARENT" => "POLICY",
			"NAME" => "Текст ссылки",
			"TYPE" => "TEXT",
			"DEFAULT" => "политикой конфиденциальности",
		),
		"POLICY_LINK_CLASS" => Array(
			"PARENT" => "POLICY",
			"NAME" => "Классы ссылки",
			"TYPE" => "TEXT",
			"DEFAULT" => null,
		)
		*/
	)
);
