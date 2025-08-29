<?
use Bitrix\Main\Context;

define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define('PUBLIC_AJAX_MODE', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$_SESSION["SESS_SHOW_INCLUDE_TIME_EXEC"] = "N";
$APPLICATION->ShowIncludeStat = false;

global $USER;
if ($USER->IsAuthorized())
    die("auth");

$check = "N";

$request = Context::getCurrent()->getRequest();

$arResult = [
    "EMAIL" => trim(htmlspecialcharsEx($request->get("email"))),
];

if(mb_strlen($arResult["EMAIL"])){
    $userList = \Bitrix\Main\UserTable::getList(array(
        "select" => array("ID"),
        "filter" => array(
            "=EMAIL" => $arResult["EMAIL"],
        ),
        "limit" => 1
    ));
    if ($userList->fetch())
    {
        $check = "Y";
    }
}

echo $check;
die();


?>