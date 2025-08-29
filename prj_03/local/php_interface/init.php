<?php
define("PREFIX_PATH_404", "/404.php");

include_once(__DIR__ . "/include/cross_sales.php"); // 31559
include_once(__DIR__ . "/include/catalog_sort.php"); // 35705
include_once(__DIR__ . "/include/form_handlers.php"); // 41631
include_once(__DIR__ . "/include/pack_handler.php"); // 42017
//include_once(__DIR__ . "/lib/BitrixTools.php");
//include_once(__DIR__ . "/lib/TemplateTools.php");

// Подключаем автозагрузчик
include($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/autoload.php');

// Подключение обработчиков событий
include($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/handlers.php");

// Подключение общих функций
include($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/general_funcs.php");

// Подключение общих классов
include($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/lib/general_class.php");

// Константы
include($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/constants.php');
if (isset($_SERVER['HTTP_REFERER']))
{
    /*
    *   При просмотре сайта через Яндекс.Метрику
    *   не запрещать показывать сайт во фрейме
    */
     
    $metrikaHosts = [
        'webvisor.com',
        'metrika.yandex',
        'metrika.yandex.ru',
        'metrika.yandex.ua',
        'metrika.yandex.com',
        'metrika.yandex.by',
        'metrika.yandex.kz',
        $_SERVER['HTTP_HOST'],
    ];
     
    $refHost = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
 
    if (in_array($refHost, $metrikaHosts))
    {
        define('BX_SECURITY_SKIP_FRAMECHECK', true);
    }
}