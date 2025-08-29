<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

$arComponentDescription = [
	'NAME' => 'Форма обратной связи',
	'DESCRIPTION' => 'Форма обратной связи',
	'ICON' => '/images/subscr_form.gif',
	'CACHE_PATH' => 'Y',
	'PATH' => [
		'ID' => 'content',
		"CHILD" => array(
			"ID" => "vate",
			"NAME" => 'Vate-tire',
			"SORT" => 1,
			"CHILD" => array(
				"ID" => "custom_feedback",
			),
		),
	],
];
