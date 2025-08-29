<?php
 
namespace Disweb;
 
use \Bitrix\Main\EventManager;
 
class FormValidatorPhone
{
	public static function getDescription()
	{
		return [
			'NAME' => 'dw_phone', // идентификатор
			'DESCRIPTION' => 'Номер телефона', // наименование
			'TYPES' => [
				'text'
			], // типы полей
			'SETTINGS' => [__CLASS__, 'getSettings'], // метод, возвращающий массив настроек
			'CONVERT_TO_DB' => [__CLASS__, 'toDB'], // метод, конвертирующий массив настроек в строку
			'CONVERT_FROM_DB' => [__CLASS__, 'fromDB'], // метод, конвертирующий строку настроек в массив
			'HANDLER' => [__CLASS__, 'doValidate'], // валидатор
		];
	}
 
	public static function getSettings()
	{
		return [];
	}
 
	public static function toDB($arParams)
	{
		// возвращаем сериализованную строку
		return serialize($arParams);
	}
 
	public static function fromDB($strParams)
	{
		// никаких преобразований не требуется, просто вернем десериализованный массив
		return unserialize($strParams);
	}
 
	public static function doValidate($arParams, $arQuestion, $arAnswers, $arValues)
	{
		global $APPLICATION;
 
		foreach ($arValues as $value)
		{
			$value = preg_replace('/[^0-9]/', '', $value);
			// проверяем на пустоту
			if (strlen($value) < 10)
			{
				// вернем ошибку
				$APPLICATION->ThrowException('Номер телефона: не верно заполнен');
				
				return false;
			}
 
		}
 
		// все значения прошли валидацию, вернем true
		return true;
	}
}