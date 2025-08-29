<?php

namespace Disweb;

use \Bitrix\Main\EventManager;

class FormValidatorPhone
{
    static public function getDescription()
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

    static public function getSettings()
    {
        return [];
    }

    static public function toDB($arParams)
    {
        // возвращаем сериализованную строку
        return serialize($arParams);
    }

    static public function fromDB($strParams)
    {
        // никаких преобразований не требуется, просто вернем десериализованный массив
        return unserialize($strParams);
    }

    static public function doValidate($arParams, $arQuestion, $arAnswers, $arValues)
    {
        global $APPLICATION;

        foreach ($arValues as $value) {
            $value = preg_replace('/[^0-9]/', '', $value);
            // проверяем на пустоту
            /*
			if (strlen($value) < 10)
			{
				// вернем ошибку
				$APPLICATION->ThrowException('Не верно заполнен "Номер телефона"');
				
				return false;
			}
            */
            if (strlen($value) != 11) {
                // вернем ошибку
                $APPLICATION->ThrowException('Поле "Номер телефона" должно содержать 11 цифр');

                return false;
            }
        }

        // все значения прошли валидацию, вернем true
        return true;
    }
}
