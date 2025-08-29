<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?
$arResult = array();
$arResult['ERROR'] = array();
if ($USER->IsAuthorized()) {
    $OLD_PASSWORD = $_POST['OLD_PASSWORD'];
    $NEW_PASSWORD = $_POST['NEW_PASSWORD'];
    $NEW_PASSWORD_CONFIRM = $_POST['NEW_PASSWORD_CONFIRM'];

    $USER_ID = $USER->GetID();
    
    if ($NEW_PASSWORD != $NEW_PASSWORD_CONFIRM) {
        $arResult['ERROR'][] = 'Новый пароль и его подтверждение не совпадают.';
    } else {
        if (Indexis::isUserPassword($USER_ID, $OLD_PASSWORD)) {
            $user = new CUser;
            $fields = array('PASSWORD' => $NEW_PASSWORD, 'CONFIRM_PASSWORD' => $NEW_PASSWORD_CONFIRM);
            $user->Update($USER_ID, $fields);
            $arResult['RESULT'] = 'SUCCESS';
        }
    }
}
//vardump($arResult['RESULT']);
?>
<div id="js_profile_ch_pas_container">
    <?
    if ($arResult['RESULT'] != 'SUCCESS') {
        if (!empty($arResult['ERROR'])) {
            ShowError(implode('<br />', $arResult['ERROR']));
        } else {
            ShowError('Не удалось сменить пароль.');
        }
    } else if ($arResult['RESULT'] == 'SUCCESS') {
        ShowNote('Пароль успешно изменен.');
    }
    ?>
</div>
<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>