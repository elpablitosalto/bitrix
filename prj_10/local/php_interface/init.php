<?php
CModule::IncludeModule("iblock");

// Подключение файла с функциями Multilandia -->
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/multilandia.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/multilandia.php");
}

// Подключение файла с глобальными параметрами -->
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/globals.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/globals.php");
}

// Подключаем автозагрузчик
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/autoload.php")) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/autoload.php');
}

// Подключение обработчиков событий
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/handlers.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/handlers.php");
}

// Подключение агенты
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/agents.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/agents.php");
}

function getRightWord($count, $endingArray)
{
    $number = $count;
    $number = $number % 100;
    if ($number >= 11 && $number <= 19) {
        $ending = $endingArray[2];
    } else {
        $i = $number % 10;
        switch ($i) {
            case (1):
                $ending = $endingArray[0];
                break;
            case (2):
            case (3):
            case (4):
                $ending = $endingArray[1];
                break;
            default:
                $ending = $endingArray[2];
        }
    }
    return $ending;
}


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