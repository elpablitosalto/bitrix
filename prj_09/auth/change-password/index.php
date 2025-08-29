<?
define('REMOVE_H1_TITLE', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Восстановление пароля");
if($GLOBALS["USER"]->IsAuthorized()){
    LocalRedirect(PROFILE_URL);
}else{
    $APPLICATION->IncludeComponent( "bitrix:system.auth.changepasswd","main",false );
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>