<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$resultData = [];
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
if($request->isAjaxRequest() && !empty($request->get("productId")) && !empty($request->get("quantity"))){
    $arPackData = \packHandler::getPackData(intval($request->get("productId")), intval($request->get("quantity")));
    if(!empty($arPackData) && !empty($arPackData["MIN_QUANTITY_BUY"])){
        $resultData = $arPackData;
    }
}
echo \Bitrix\Main\Web\Json::encode($resultData);
exit(200);