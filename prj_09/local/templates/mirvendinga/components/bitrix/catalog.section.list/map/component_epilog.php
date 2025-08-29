<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$asset = \Bitrix\Main\Page\Asset::getInstance();
//$coordorder = 'longlat';
//$coordorder = 'latlong';
//$asset->addJs("https://api-maps.yandex.ru/2.1/?coordorder=" . $coordorder . "&apikey=e0711a3e-e4c8-4a95-9aea-f3ced170b65d&lang=ru_RU");
//$asset->addJs("https://api-maps.yandex.ru/2.1/?lang=ru_RU");
$asset->addJs(YA_MAPS_LINK);
?>
<?/*?>
<script
	src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"
	type="text/javascript"
></script>
<?*/?>