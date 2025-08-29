<?
define('CUSTOM_LAYOUT_PAGE', true);
define('PAGE_TYPE', 1);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация в программе лояльности");
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'page-title-loyalty');
?>

Text here ...

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>