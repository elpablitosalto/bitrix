<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Клиника «Белый кролик» в Москве на Нижней Масловке. Предоставляем медицинские услуги в области стоматологии высочайшего качества.");
$APPLICATION->SetPageProperty("title", "Стоматологическая клиника «Белый кролик» на Нижней Масловке");
$APPLICATION->SetTitle("«Белый кролик» на Нижней Масловке");

?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/contact/list_locations.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?

$APPLICATION->IncludeComponent(
	"indexis:page.constructor",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"SECTION_ID" => "31",
		"SYNC_CONTENT_CLINIC" => "Y"
	)
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>