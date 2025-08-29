<?php

#include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php");

// Подключаем автозагрузчик
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/autoload.php"))
    require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/autoload.php');

// Подключение обработчиков событий
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/handlers.php"))
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/handlers.php");

// Подключение агентов
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/IndexisAgents.php"))
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/IndexisAgents.php");


define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/log.txt");

/**
 * Функция выводит массив на экран
 * param  $arr  Array Массив данных
 * param  $var_dump Bool Если true, то выводит в массиве и типы данных
 * Void
 */
function vardump($arr = false, $var_dump = false)
{
    echo "<pre >";
    if ($var_dump) {
        var_dump($arr);
    } else {
        print_r($arr);
    }
    echo "</pre>";
}
