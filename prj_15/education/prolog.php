<?
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_CHECK', true);
require_once ($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$arOrders = [];
if ($USER->IsAuthorized()) {
    $deal = new Deal();
    $arOrders = $deal->getMyOrderList('courses');
}

define('PAGE_TYPE', (is_array($arOrders) && count($arOrders) > 0 ? 1: 2));
