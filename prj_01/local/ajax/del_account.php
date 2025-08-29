<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?
$arResult = array();
$arResult['ERROR'] = array();
if ($USER->IsAuthorized()) {
    $USER_ID = $USER->GetID();

    $user = new CUser;
    $fields = array('ACTIVE' => 'N');
    $user->Update($USER_ID, $fields);
    $arResult['RESULT'] = 'SUCCESS';
}

echo json_encode($arResult);
?>
<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>