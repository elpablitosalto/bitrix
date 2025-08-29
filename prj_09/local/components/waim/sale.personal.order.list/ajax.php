<?php

define("STOP_STATISTICS", true);
define("NO_KEEP_STATISTIC", "Y");
define("NO_AGENT_STATISTIC","Y");
define("DisableEventsCheck", true);
define("BX_SECURITY_SHOW_MESSAGE", true);
define('NOT_CHECK_PERMISSIONS', true);

$siteId = isset($_REQUEST['SITE_ID']) && is_string($_REQUEST['SITE_ID']) ? $_REQUEST['SITE_ID'] : '';
$siteId = mb_substr(preg_replace('/[^a-z0-9_]/i', '', $siteId), 0, 2);
if (!empty($siteId) && is_string($siteId))
{
	define('SITE_ID', $siteId);
}
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$request->addFilter(new \Bitrix\Main\Web\PostDecodeFilter);

$params = $request->get('params');
if(empty($params)){
    $params = [
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "AJAX_OPTION_HISTORY" => "",
        "PATH_TO_CATALOG" => "/catalog/",
        "PATH_TO_BASKET" => "/personal/cart/",
        "ORDERS_PER_PAGE" => 10,
        "SAVE_IN_SESSION" => "Y",
        "NAV_TEMPLATE" => "main",
        "HISTORIC_STATUSES" => [
            0 => "P",
            1 => "F"
        ],
        "DEFAULT_SORT" => "ID"
    ];
}
$params['AJAX_CALL'] = "Y";

$APPLICATION->IncludeComponent(
    "waim:sale.personal.order.list",
    "main",
    $params,
    false
);

// Файл ниже подключать обязательно, там закрытие соединения с базой данных
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';