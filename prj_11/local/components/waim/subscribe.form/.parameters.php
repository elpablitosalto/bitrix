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
		"POLICY" => Array(
			"NAME" => "Политика конфиденциальности",
			"SORT" => "1000"
		)
	),
	"PARAMETERS" => Array(
		"PRESET" => Array(
			"PARENT" => "PRESET",
			"NAME" => "Тип блока",
			"TYPE" => "LIST",
			"VALUES" => Array(
				"NONE" => "Нет",
				"A" => "Статьи про финансы",
				"B" => "Управленка",
				"C" => "Шаблон ОПиУ",
				"D" => "План-капкан",
				"E" => "Шаблон ДДС",
				"F" => "Скачать шаблон баланса",
				"G" => "Мини-книга 'ДДС, ОПиУ и баланс'",
				"H" => "Барсетка шаблонов",
				"I" => "Шаблон финмодели",
				"J" => "Платежный календарь"
			)
		),
		"WEB_FORM_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => "ID формы",
			"TYPE" => "TEXT",
			"DEFAULT" => null,
		),
		"FORM_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => "Код формы, будет записан в результат",
			"TYPE" => "TEXT",
			"DEFAULT" => null,
		),
		"TITLE" => Array(
			"PARENT" => "BASE",
			"NAME" => "Заголовок",
			"TYPE" => "TEXT",
			"DEFAULT" => 'Подписаться',
		),
		"DESCRIPTION" => Array(
			"PARENT" => "BASE",
			"NAME" => "Описание",
			"TYPE" => "TEXT",
			"DEFAULT" => 'Введите email для подписки на рассылку',
		),
		"BUTTON_TEXT" => Array(
			"PARENT" => "FORM",
			"NAME" => "Текст кнопки",
			"TYPE" => "TEXT",
			"DEFAULT" => 'Получить',
		),
		"PLACEHOLDER" => Array(
			"PARENT" => "FORM",
			"NAME" => "Плейсхолдер",
			"TYPE" => "TEXT",
			"DEFAULT" => 'Введите ваш E-mail',
		),
		"SUCCESS_TITLE" => Array(
			"PARENT" => "FORM",
			"NAME" => "Заголовок сообщения успешной отправки",
			"TYPE" => "TEXT",
			"DEFAULT" => 'Спасибо! Мы получили вашу заявку!',
		),
		"SUCCESS_DESCRIPTION" => Array(
			"PARENT" => "FORM",
			"NAME" => "Текст сообщения об успешной отправки",
			"TYPE" => "TEXT",
			"DEFAULT" => 'Материал летит к вам на почту',
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
		"IMAGE" => Array(
			"PARENT" => "VISUAL",
			"NAME" => "Изображение",
			"TYPE" => "FILE",
			"FD_TARGET" => "F",
			"FD_EXT" => "jpg,png",
			"FD_UPLOAD" => true,
			"FD_USE_MEDIALIB" => true,
			"FD_MEDIALIB_TYPES" => Array("image")
		),
		"BACKGROUND_COLOR" => Array(
			"PARENT" => "VISUAL",
			"NAME" => "Фоновый цвет",
			"TYPE" => "COLORPICKER",
			"DEFAULT" => "#E04D4D"
		),
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
		),
		"FORM_CALLBACK_ID" => Array(
			"PARENT" => "FORM",
			"NAME" => "ID формы который будет передан в событии formSubmit после отправки формы",
			"TYPE" => "TEXT",
			"DEFAULT" => null,
		)
	)
);
