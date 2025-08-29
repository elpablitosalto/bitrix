<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

$arComponentParameters = Array(
	"GROUPS" => Array(
	),
	"PARAMETERS" => Array(
		"TITLE" => Array(
			"PARENT" => "BASE",
			"NAME" => "Заголовок",
			"TYPE" => "TEXT",
			"DEFAULT" => "",
		),
		"COUNT" => Array(
			"PARENT" => "BASE",
			"NAME" => "Количество отображаемых шагов",
			"TYPE" => "TEXT",
			"DEFAULT" => "6",
		),
		"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => "ID инфоблока с шагами",
			"TYPE" => "TEXT",
			"DEFAULT" => "",
		),
	)
);
