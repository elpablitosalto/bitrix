<?
define('MENU_TYPE', 4);
define('SHOW_COLUMNS_IN_HEADER', 'N');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Портфолио");
$APPLICATION->SetPageProperty("PAGE_H3", 'Портфолио');
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-default');
?>

<? $APPLICATION->IncludeComponent(
  "indexis:block.filter",
  "",
  array('AJAX_MODE' => 'Y'),
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>