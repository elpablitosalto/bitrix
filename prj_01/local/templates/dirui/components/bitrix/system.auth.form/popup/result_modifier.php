<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult["AUTH_URL"] = $_SERVER['REQUEST_URI'];
$arResult['SUCCESS_AUTH'] = 'N';

$arResult['bSendForm'] = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['AUTH_FORM'] == 'Y') {
    $arResult['bSendForm'] = true;
    $arResult['bError'] = $arResult['ERROR'] && !empty($arResult['ERROR_MESSAGE']);
    $arResult['$bShowError'] = $arResult['SHOW_ERRORS'] === 'Y' && $arResult['bError'];
}

if ($arResult['bSendForm'] && !$arResult['bError']) {
    $USER_ID = $USER->GetID();
    $PASSWORD = $_POST['USER_PASSWORD'];
    if (Indexis::isUserPassword($USER_ID, $PASSWORD)) {
        $arResultFunc = CPersonal::isPartner();
        if (!$arResultFunc['isPartner']) {
            $arResult['ERROR_MESSAGE'] = array('MESSAGE' => 'Необходимо зарегистрироваться в качестве партнёра.', 'TYPE' => 'ERROR');
            $arResult['bError'] = true;
            $arResult['$bShowError'] = true;
        }
    }

    if (!$arResult['$bShowError']) {
        $arResult['SUCCESS_AUTH'] = 'Y';
    }
} else {
    if( $arParams['CHECK_AUTH'] == 'Y' ){
        if( $USER->IsAuthorized() )
        {
            $arResult['SUCCESS_AUTH'] = 'Y';
        }
    }
}