<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
?>
<?$APPLICATION->IncludeComponent("bitrix:main.register","hair",Array(
        "USER_PROPERTY_NAME" => "", 
        "SEF_MODE" => "Y", 
        "SHOW_FIELDS" => Array(), 
        "REQUIRED_FIELDS" => Array(), 
        "AUTH" => "Y", 
        "USE_BACKURL" => "Y", 
        "SUCCESS_PAGE" => "", 
        "SET_TITLE" => "Y", 
        "USER_PROPERTY" => Array(), 
        "SEF_FOLDER" => "/", 
        "VARIABLE_ALIASES" => Array()
    )
);?> 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>