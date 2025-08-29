<?
// Восстановление пароля -->
if ($_SERVER["REQUEST_METHOD"] == "POST" && strlen($_POST['send_account_info']) > 0) {
    define('NEED_AUTH', true);
}
// <-- Восстановление пароля

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>

<?

?>

<? $APPLICATION->IncludeComponent(
    "bitrix:system.auth.forgotpasswd",
    "mafmarket",
    array("SHOW_ERRORS" => 'Y')
); ?>

<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>