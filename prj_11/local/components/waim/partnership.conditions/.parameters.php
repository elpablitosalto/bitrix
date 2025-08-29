<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

$arComponentParameters = Array(
	"GROUPS" => Array(
		"VALUES" => Array(
			"NAME" => "Условия",
			"SORT" => "1000"
		),
		"FORM" => Array(
			"NAME" => "Форма",
			"SORT" => "1100"
		)
	),
	"PARAMETERS" => Array(
		"TITLE" => Array(
			"PARENT" => "BASE",
			"NAME" => "Заголовок",
			"TYPE" => "TEXT",
			"DEFAULT" => '',
		),
		"VALUE_1" => Array(
			"PARENT" => "VALUES",
			"NAME" => "Условие 1",
			"TYPE" => "TEXT",
			"DEFAULT" => '',
		),
		"VALUE_2" => Array(
			"PARENT" => "VALUES",
			"NAME" => "Условие 2",
			"TYPE" => "TEXT",
			"DEFAULT" => '',
		),
		"VALUE_3" => Array(
			"PARENT" => "VALUES",
			"NAME" => "Условие 3",
			"TYPE" => "TEXT",
			"DEFAULT" => '',
		),
		"FORM_TITLE" => Array(
			"PARENT" => "FORM",
			"NAME" => "Заголовок формы",
			"TYPE" => "TEXT",
			"DEFAULT" => '',
		),
		"WEB_FORM_ID" => Array(
			"PARENT" => "FORM",
			"NAME" => "ID формы",
			"TYPE" => "TEXT",
			"DEFAULT" => '',
		),
	)
);
