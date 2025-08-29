<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
// меняем порядок следования полей
$arResult['SHOW_FIELDS'] = array(
    'NAME',
    'LAST_NAME',
    'EMAIL',
    'PERSONAL_MOBILE',
    'PASSWORD',
    'CONFIRM_PASSWORD',
);
