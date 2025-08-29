<?php

include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php");

use \Bitrix\Main\Loader;

Loader::includeModule('iblock');
Loader::includeModule('highloadblock');

//CModule::IncludeModule('iblock');

// Подключаем автозагрузчик
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/autoload.php")) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/autoload.php');
}

//if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/handlers.php"))
//require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/handlers.php');

// Подключение глобальный переменных и констант
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/globals.php"))
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/globals.php");

// Подключение обработчиков событий
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/handlers.php"))
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/handlers.php");

// Подключение обработчиков событий
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/IndexisEvents.php"))
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/IndexisEvents.php");

// Подключение общих функций
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/general_func.php"))
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/general_func.php");

// Подключение функций для работы с хайлоад-блоками
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/hlb.php"))
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/hlb.php");
