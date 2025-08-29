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
			"DEFAULT" => '',
		),
		"SUBTITLE" => Array(
			"PARENT" => "BASE",
			"NAME" => "Подзаголовок",
			"TYPE" => "TEXT",
			"DEFAULT" => '',
		),
		"IMAGE" => Array(
			"PARENT" => "VISUAL",
			"NAME" => "Изображение. Будет использовано если не задать изображения для контрольных точек",
			"TYPE" => "FILE",
			"FD_TARGET" => "F",
			"FD_EXT" => "jpg,png",
			"FD_UPLOAD" => true,
			"FD_USE_MEDIALIB" => true,
			"FD_MEDIALIB_TYPES" => Array("image")
		),
		"IMAGE_XS" => Array(
			"PARENT" => "VISUAL",
			"NAME" => "Изображение для экранов до 479px",
			"TYPE" => "FILE",
			"FD_TARGET" => "F",
			"FD_EXT" => "jpg,png",
			"FD_UPLOAD" => true,
			"FD_USE_MEDIALIB" => true,
			"FD_MEDIALIB_TYPES" => Array("image")
		),
		"IMAGE_S" => Array(
			"PARENT" => "VISUAL",
			"NAME" => "Изображение для экратов от 480px до 767px",
			"TYPE" => "FILE",
			"FD_TARGET" => "F",
			"FD_EXT" => "jpg,png",
			"FD_UPLOAD" => true,
			"FD_USE_MEDIALIB" => true,
			"FD_MEDIALIB_TYPES" => Array("image")
		),
		"IMAGE_M" => Array(
			"PARENT" => "VISUAL",
			"NAME" => "Изображение для экратов от 1024px",
			"TYPE" => "FILE",
			"FD_TARGET" => "F",
			"FD_EXT" => "jpg,png",
			"FD_UPLOAD" => true,
			"FD_USE_MEDIALIB" => true,
			"FD_MEDIALIB_TYPES" => Array("image")
		),
	)
);
