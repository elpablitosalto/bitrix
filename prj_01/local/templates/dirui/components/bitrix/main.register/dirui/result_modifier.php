<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
// меняем порядок следования полей
$arResult['SHOW_FIELDS'] = array('NAME', 'LAST_NAME', 'WORK_COMPANY', "WORK_POSITION", 'PERSONAL_MOBILE', 'EMAIL', "PASSWORD", "CONFIRM_PASSWORD");

/*
// Ошибки -->
$arErrorsTmp = array();
foreach ($arResult["ERRORS"] as $key => $error) {
    $bAdd = true;

    if (strpos($error, 'Пользователь с логином') !== false) {
        $bAdd = false;
    }

    if ($bAdd == true) {
        $arErrorsTmp[] = $error;
    }
}
$arResult["ERRORS"] = $arErrorsTmp;
foreach ($arResult["ERRORS"] as $key => $error) {
    if (intval($key) == 0 && $key !== 0) {
    }
    $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);
}
// <-- Ошибки
*/