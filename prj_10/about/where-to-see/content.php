<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

<p><em><strong>Хотите смотреть «Мультиландию» в своем доме? Подключайтесь!</strong></em></p>
<p>Наши партнеры – крупнейшие операторы и платформы, и еще свыше 500 региональных операторов в России и странах СНГ. Подключите «Мультиланию» у своего оператора.</p>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "standard.php",
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "videoservices.php"
	),
	false
);?>