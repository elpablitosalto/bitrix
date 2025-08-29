<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// Проверка на заполненость параметров
if (empty($arParams['SEO_ID']) || empty($arParams['TARGET_URI']) || empty($arParams['PAGE_URI'])) return;

// Проверка на точное совпадение страницы
$targetRoot = !empty($arParams['TARGET_ROOT']) ? $arParams['TARGET_ROOT'] : '';
$queryPresent = !empty($arParams['PAGE_QUERY']);
$cleanURI = $queryPresent ? str_replace('?'.$arParams['PAGE_QUERY'], '', $arParams['PAGE_URI']) : $arParams['PAGE_URI'];
$pageMatchesTarget = $targetRoot . $arParams['TARGET_URI'] === $cleanURI;

if (!$pageMatchesTarget) return;

// Получение нужных SEO данных
$dbSeo = CIBlockElement::GetList(
	array(),
	array(
		"ID" => $arParams['SEO_ID'],
		"IBLOCK_ID" => SEO_IB_ID,
	),
	false,
	false,
	array(
		"ID",
		"NAME",
		"PROPERTY_HIDDEN_TEXT",
		"PROPERTY_META_TITLE",
		"PROPERTY_META_DESCRIPTION"
	)
);

// Применение данных
if ($arSeo = $dbSeo->Fetch()) {
	if (!empty($arSeo['PROPERTY_META_TITLE_VALUE']['TEXT'])) {
		$APPLICATION->SetPageProperty('title', $arSeo['PROPERTY_META_TITLE_VALUE']['TEXT']);
	}

	if (!empty($arSeo['PROPERTY_META_DESCRIPTION_VALUE']['TEXT'])) {
		$APPLICATION->SetPageProperty('description', $arSeo['PROPERTY_META_DESCRIPTION_VALUE']['TEXT']);
	}

	if (!empty($arSeo['PROPERTY_HIDDEN_TEXT_VALUE']['TEXT'])) {
		echo '<div class="visually-hidden">';
		echo $arSeo['PROPERTY_HIDDEN_TEXT_VALUE']['TEXT'];
		echo '</div>';
	}
}
?>

