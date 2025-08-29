<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Context;

$context = Context::getCurrent();
$request = $context->getRequest();

LocalRedirect($APPLICATION->GetCurDir() . '?filter_id=' . intval($request->getQuery("ID")));
?>
