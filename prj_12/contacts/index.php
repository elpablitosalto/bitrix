<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Контакты и адреса клиник «Белый кролик» в Москве. Предоставляем медицинские услуги в области стоматологии высочайшего качества.");
if($APPLICATION->GetCurPage(false) === "/contacts/ne-bolno-na-vyatskoy/") {
	$APPLICATION->SetTitle("«Белый кролик» на Нижней Масловке");
} else {
	$APPLICATION->SetTitle("Контакты и адреса клиник");
}

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
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/schema/contacts.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>