<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
?>
<?$APPLICATION->IncludeComponent("bitrix:system.auth.form",".default",Array(
     "REGISTER_URL" => "/personal/register/",
     "FORGOT_PASSWORD_URL" => "",
     "PROFILE_URL" => "/personal/profile/",
     "SHOW_ERRORS" => "Y" 
     )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>