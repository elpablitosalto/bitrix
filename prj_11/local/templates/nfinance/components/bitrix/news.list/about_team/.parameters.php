<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"TITLE" => Array(
		"PARENT" => "BASE",
		"NAME" => 'Заголовок',
		"TYPE" => "TEXT",
		"DEFAULT" => null,
	),
	"DESCRIPTION" => Array(
		"PARENT" => "BASE",
		"NAME" => 'Описание',
		"TYPE" => "TEXT",
		"DEFAULT" => null,
	),
	"BACKGROUND_IMAGE" => Array(
		"PARENT" => "BASE",
		"NAME" => 'Фоновое изображение',
		"TYPE" => "FILE",
		"FD_TARGET" => "F",
		"FD_EXT" => 'jpg,png',
		"FD_UPLOAD" => true,
		"FD_USE_MEDIALIB" => true,
		"FD_MEDIALIB_TYPES" => Array('image', 'sound')
	),
	"BACKGROUND_IMAGE_L" => Array(
		"PARENT" => "BASE",
		"NAME" => 'Фоновое изображение до 1024 пикселей',
		"TYPE" => "FILE",
		"FD_TARGET" => "F",
		"FD_EXT" => 'jpg,png',
		"FD_UPLOAD" => true,
		"FD_USE_MEDIALIB" => true,
		"FD_MEDIALIB_TYPES" => Array('image', 'sound')
	),
	"BACKGROUND_IMAGE_M" => Array(
		"PARENT" => "BASE",
		"NAME" => 'Фоновое изображение до 767 пикселей',
		"TYPE" => "FILE",
		"FD_TARGET" => "F",
		"FD_EXT" => 'jpg,png',
		"FD_UPLOAD" => true,
		"FD_USE_MEDIALIB" => true,
		"FD_MEDIALIB_TYPES" => Array('image', 'sound')
	),
);
?>
