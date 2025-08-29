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

echo \Bitrix\Main\Web\Json::encode(["code"=>0]);

die();

?>

