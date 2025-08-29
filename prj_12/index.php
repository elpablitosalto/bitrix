<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Стоматологическая клиника «Белый кролик» – это операции любой сложности, применение современной компьютерной диагностики при лечении зубов. В нашем центре фиксированная прозрачная цена на любые виды услуг стоматологии в Москве.");
$APPLICATION->SetTitle("Стоматология «Белый кролик» в Москве – платная стоматологическая клиника");?>

<?$APPLICATION->IncludeComponent(
	"indexis:page.constructor", 
	".default", 
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"SECTION_ID" => "1",
		"COMPONENT_TEMPLATE" => ".default",
		"CACHE_NOTES" => ""
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>