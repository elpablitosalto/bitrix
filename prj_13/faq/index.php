<?
define('CUSTOM_LAYOUT_PAGE', true);
define('PAGE_TYPE', 6);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", 'about');
$APPLICATION->SetTitle("Вопросы и ответы");
?>

Text here ...

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>