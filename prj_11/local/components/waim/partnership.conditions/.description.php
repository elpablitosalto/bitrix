<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

$arComponentDescription = [
	'NAME' => 'Компонент для вывода секции условий страницы партнерки',
	'DESCRIPTION' => '',
	'ICON' => '/images/subscr_form.gif',
	'CACHE_PATH' => 'Y',
	'PATH' => [
		'ID' => 'content',
		"CHILD" => array(
			"ID" => "nf",
			"NAME" => 'Нескучные финансы',
			"SORT" => 1,
			"CHILD" => array(
				"ID" => "custom_subscribe",
			),
		),
	],
];
