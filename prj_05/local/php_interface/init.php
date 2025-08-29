<?
// Подключаем автозагрузчик
include($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/autoload.php');

// Подключение обработчиков событий
include($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/handlers.php");

// Подключение общих функций
include($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/general_funcs.php");

// Подключение общих классов
include($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/general_class.php");

// Подключение функций агентов
include($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/Agents.php");

// Константы
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/constants.php');

// Функции
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/functions.php');
