<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->SetPageProperty("description", strip_tags($arResult['DESCRIPTION_META']));
$APPLICATION->SetPageProperty("og:description", strip_tags($arResult['DESCRIPTION_META']));
