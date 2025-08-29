<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main;
use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;

define('NOT_CHECK_PERMISSIONS', true);
define("STOP_STATISTICS", true);
define('NO_AGENT_CHECK', true);

Bitrix\Main\Loader::includeModule("sale");
Bitrix\Main\Loader::includeModule("catalog");

$basket = new Mirvendinga\Basket();

$application = Application::getInstance();
$context = $application->getContext();

global $APPLICATION;
$APPLICATION->RestartBuffer();
$arElements = array();
$result = new stdClass();
$result->status = 0;
$request = Application::getInstance()->getContext()->getRequest();
$session = Application::getInstance()->getSession();
header('Content-Type: application/json');

print_r($basket->getBasketList());

$jsonData = json_encode($result);
echo $jsonData;

die();