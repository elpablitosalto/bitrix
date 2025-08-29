<?
// Автозагрузчик
include($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/autoload.php");

// Константы
require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/constants.php");

// Подключение общих функций
include($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/general_func.php");

// События
include($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/handlers.php");