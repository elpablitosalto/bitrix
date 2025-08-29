<?php

// Подключение глобальный переменных и констант
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/globals.php"))
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/globals.php");

// Подключаем автозагрузчик
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/autoload.php"))
    require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/autoload.php');

// Подключение обработчиков событий
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/handlers.php"))
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/handlers.php");

// Подключение обработчиков событий
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/IndexisEvents.php"))
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/IndexisEvents.php");

// Подключение общих функций
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/general_func.php"))
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/general_func.php");

//подключение seo функций
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/seo.php"))
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/seo.php");

if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php"))
    include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php");
