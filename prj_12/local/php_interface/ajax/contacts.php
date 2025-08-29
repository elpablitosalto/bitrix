<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>

<?
use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;
$cookie = new Cookie("TEST", 42);
$cookie->setDomain("example.com");
Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
?>

<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>