<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


//CUser::SendPassword($_POST['USER_LOGIN'], $_POST['USER_LOGIN']);
/*
$arResult['bError'] = false;
if (!empty($APPLICATION->arAuthResult['MESSAGE'])) {
    if ($APPLICATION->arAuthResult['TYPE'] == 'ERROR') {
        $arResult['bError'] = true;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && strlen($_POST['send_account_info']) > 0 && strlen($_POST['USER_LOGIN']) > 0) {
    if ($arResult['bError'] == false) {
        CUser::SendPassword($_POST['USER_LOGIN'], $_POST['USER_LOGIN']);

        $arEventFields = array();
        CEvent::Send('USER_PASS_REQUEST', SITE_ID, $arEventFields);

        $f = fopen($_SERVER["DOCUMENT_ROOT"] . "/maillog.txt", "a+");
        fwrite($f, print_r(array('TO' => "1", 'SUBJECT' => '2', 'BODY' => '3', 'HEADERS' => '4'), 1) . "\n========\n");
        fclose($f);
    }
}
*/