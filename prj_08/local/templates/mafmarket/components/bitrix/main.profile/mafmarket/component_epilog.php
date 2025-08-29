<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if ($_SERVER["REQUEST_METHOD"] == "POST" && ($_REQUEST["delete"] <> '') && check_bitrix_sessid()) {
    if (intval($USER->GetID()) > 0 && $USER->IsAuthorized()) {
        if (CUser::Delete($USER->GetID())) {
            $USER->Logout();
            LocalRedirect('/profile/?account_successfully_deleted=Y');
        }
    }
}
