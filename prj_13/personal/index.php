<?
define('CUSTOM_LAYOUT_PAGE', true);
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
$APPLICATION->SetPageProperty("PAGE_SECTION_CLASS", "page-title__red");
?>

<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/personal/menu.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"",
	Array(
		"USER_PROPERTY_NAME" => "",
		"SET_TITLE" => "N",
		"AJAX_MODE" => "N",
		"USER_PROPERTY" => Array(),
		"SEND_INFO" => "N",
		"CHECK_RIGHTS" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	)
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>