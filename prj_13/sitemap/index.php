<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Карта сайта  - Стройсервис | Москва");
$APPLICATION->SetPageProperty("description", "Карта сайта. Компания Стройсервис в Москве. ☎ +7 (495) 229-30-20");
$APPLICATION->SetTitle("Карта сайта");?><?/*$APPLICATION->IncludeComponent(
	"bitrix:main.map",
	".default",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COL_NUM" => "1",
		"LEVEL" => "3",
		"SET_TITLE" => "Y",
		"SHOW_DESCRIPTION" => "N"
	)
);*/?>

<?$APPLICATION->IncludeComponent(
	"orwo:sitemap.html", 
	".default", 
	array(
		"EXCLUDED_FOLDERS" => array(
			0 => "bitrix",
			1 => "upload",
			2 => ".git",
			3 => "b",
			4 => "bitrix24",
			5 => "include",
			6 => "images",
			7 => "map_new",
			8 => "local",
			9 => "log",
			10 => "products",
			11 => "sitemap",
			13 => "shop_catalog",
			14 => "search",
			15 => "site_it",
		),
		"EXCLUDED_PATH" => array(
			0 => "shop/personal",
			1 => "personal/order/make",
			2 => "personal/order/payment",
		),
		"IBLOCK_ID" => array(
			0 => "7",
			1 => "12",
			2 => "11",
			3 => "9",
			4 => "10",
		),
		"INCLUDE_ELEMENTS" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>