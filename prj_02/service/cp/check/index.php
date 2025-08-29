<?

use  \Bitrix\Main\Context;
use \Bitrix\Main\Loader;

define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define('PUBLIC_AJAX_MODE', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$_SESSION["SESS_SHOW_INCLUDE_TIME_EXEC"] = "N";
$APPLICATION->ShowIncludeStat = false;
Loader::includeModule('iblock');

header('Content-Type: application/json; charset=utf-8');

$request = Context::getCurrent()->getRequest();

$data = $request->get("Data");
if(mb_strlen($data) > 0){
	$params = \Bitrix\Main\Web\Json::decode($request->get("Data"));
	if(
		$request->get("OperationType") == "Payment" && $params["payId"] > 0 && $request->get("Status") == "Completed"
	){
		$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
		$arFilter = Array(
			"IBLOCK_ID"=>Indexis::getIblockId("pay_form", "requests", "s1"),
			"ID"=> $params["Data"]["payId"],
		);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
		if($arElement = $res->GetNext())
		{
			echo \Bitrix\Main\Web\Json::encode(["code"=>0]);
			die();
		}
	}
}

//подписки, просто возвращаем подтверждение
$subsId = $request->get("AccountId");
if($request->get("OperationType") == "Payment" && mb_strlen($subsId) > 0){
	echo \Bitrix\Main\Web\Json::encode(["code"=>0]);
	die();
}

echo \Bitrix\Main\Web\Json::encode(["code"=>13]);
die();

?>

