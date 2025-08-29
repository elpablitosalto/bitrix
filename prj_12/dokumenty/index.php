<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Документы и правовая информация – стоматология «Белый кролик»");
$APPLICATION->SetPageProperty("description", "Документы стоматологической клиники «Белый кролик» в Москве. Медицинские услуги в области стоматологии высочайшего качества.");
$APPLICATION->SetTitle("Документы"); ?>
<?
$APPLICATION->IncludeComponent(
	"indexis:page.constructor",
	"",
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"SECTION_ID" => "576",
	)
);
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>