<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "О стоматологической клинике «Белый кролик» в Москве. Медицинские услуги в области стоматологии высочайшего качества.");
$APPLICATION->SetTitle("О клинике"); ?>
<?
$APPLICATION->IncludeComponent(
	"indexis:page.constructor",
	"",
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"SECTION_ID" => "53",
		"PAGE_ELEMENT_COUNT" => '25',
	)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/schema/about.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>