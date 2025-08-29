<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

CUtil::InitJSCore(array('window'));

$authServices = [];
global $USER;

if(!$USER->IsAuthorized() && CModule::IncludeModule("socialservices")) {
    $oAuthManager = new CSocServAuthManager();
    $authServices = $oAuthManager->GetActiveAuthServices(array());

    $authServices['VKontakte']['ICON'] = 'vk';

    $arServices = $authServices;
    $arResult["CURRENT_SERVICE"] = $_REQUEST["auth_service_id"];
    $arResult["AUTH_SERVICES"] = $arServices;

    if (isset($_REQUEST["auth_service_id"]) && $_REQUEST["auth_service_id"] != '' && isset($arResult["AUTH_SERVICES"][$_REQUEST["auth_service_id"]])) {
        if (isset($_REQUEST["auth_service_error"]) && $_REQUEST["auth_service_error"] != '') {
            $arResult['ERROR_MESSAGE'] = $oAuthManager->GetError($arResult["CURRENT_SERVICE"], $_REQUEST["auth_service_error"]);
        } elseif (!$oAuthManager->Authorize($_REQUEST["auth_service_id"])) {
            $ex = $APPLICATION->GetException();
            if ($ex)
                $arResult['ERROR_MESSAGE'] = $ex->GetString();
        } 
	if (strlen($arResult['ERROR_MESSAGE'])>0) $arResult['ERROR_MESSAGE'].="Ошибка авторизации!";
        echo '<div class="errortext">'.$arResult['ERROR_MESSAGE']."</div>";
	}
	

    if (!empty($authServices)) {
        $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "popup_modal_auth_social",
            array(
                "AUTH_SERVICES" => $authServices,
                "POST" => $arResult['POST'],
                "POPUP" => "N",
                "SUFFIX" => "form",
            ),
            $component,
            array("HIDE_ICONS" => "Y")
        );


        $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
            array(
                "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                "AUTH_URL"=>$arResult["AUTH_URL"],
                "POST"=>$arResult["POST"],
                "POPUP"=>"Y",
                "SUFFIX"=>"form",
            ),
            $component,
            array("HIDE_ICONS"=>"Y")
        );
    }
}

?>