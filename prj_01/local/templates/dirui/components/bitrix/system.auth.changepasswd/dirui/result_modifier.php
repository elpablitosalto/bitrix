<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult['bError'] = false;
$arResult['bNoError'] = false;
if (!empty($APPLICATION->arAuthResult['MESSAGE'])) {
	if ($APPLICATION->arAuthResult['TYPE'] == 'ERROR') {
		$arResult['bError'] = true;
	}
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['TYPE'] == 'CHANGE_PWD') {
	if ($arResult['bError'] == false) {
		$arResult['bNoError'] = true;
	}
}
//vardump($arResult);

?>