<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Sotbit\Seometa\SeometaUrlTable;

$this->setFrameMode(true);
//$this->addExternalCss("/bitrix/css/main/bootstrap.css");

// Сортировка -->
$ELEMENT_SORT_FIELD = $arParams['ELEMENT_SORT_FIELD'];
$ELEMENT_SORT_ORDER = $arParams['ELEMENT_SORT_ORDER'];
if (strlen($_COOKIE['ELEMENT_SORT_FIELD']) > 0) {
	$ELEMENT_SORT_FIELD = $_COOKIE['ELEMENT_SORT_FIELD'];
}
if (strlen($_COOKIE['ELEMENT_SORT_ORDER']) > 0) {
	$ELEMENT_SORT_ORDER = $_COOKIE['ELEMENT_SORT_ORDER'];
}
$arParams['ELEMENT_SORT_FIELD'] = $ELEMENT_SORT_FIELD;
$arParams['ELEMENT_SORT_ORDER'] = $ELEMENT_SORT_ORDER;
// <-- Сортировка

// Bitrix -->
if (!isset($arParams['FILTER_VIEW_MODE']) || (string)$arParams['FILTER_VIEW_MODE'] == '')
	$arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

$isVerticalFilter = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");
$isSidebar = ($arParams["SIDEBAR_SECTION_SHOW"] == "Y" && isset($arParams["SIDEBAR_PATH"]) && !empty($arParams["SIDEBAR_PATH"]));
$isFilter = ($arParams['USE_FILTER'] == 'Y');

if ($isFilter) {
	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
	);
	if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
		$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
	elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
		$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

	$obCache = new CPHPCache();
	if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog")) {
		$arCurSection = $obCache->GetVars();
	} elseif ($obCache->StartDataCache()) {
		$arCurSection = array();
		if (Loader::includeModule("iblock")) {
			$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

			if (defined("BX_COMP_MANAGED_CACHE")) {
				global $CACHE_MANAGER;
				$CACHE_MANAGER->StartTagCache("/iblock/catalog");

				if ($arCurSection = $dbRes->Fetch())
					$CACHE_MANAGER->RegisterTag("iblock_id_" . $arParams["IBLOCK_ID"]);

				$CACHE_MANAGER->EndTagCache();
			} else {
				if (!$arCurSection = $dbRes->Fetch())
					$arCurSection = array();
			}
		}
		$obCache->EndDataCache($arCurSection);
	}
	if (!isset($arCurSection))
		$arCurSection = array();
}
// <-- Bitrix

// Подразделы -->
if (intval($arParams["IBLOCK_ID"]) > 0) {
	$sectionListParams = array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
		"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
		"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
		"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
		"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
		"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
		"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
	);
	if ($sectionListParams["COUNT_ELEMENTS"] === "Y") {
		$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
		if ($arParams["HIDE_NOT_AVAILABLE"] == "Y") {
			$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
		}
	}
	$res = $APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"stroyservis",
		$sectionListParams,
		$component,
		array("HIDE_ICONS" => "Y")
	);
	//echo 'res = '.$res.'<br />';
	unset($sectionListParams);
}
// <-- Подразделы
?>

<?
// Быстрый фильтр -->
?>
<?/*?>
<ul class="goods-grouts__list">
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">Затирка MAPEI</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">Затирка плиточных швов</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">Затирка акриловая</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">Затирка металлическая</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">MAPEI 80 Lvl</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">Затирка гипсовая</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">Жасмин 5 кг</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">MAPEI 260</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">Краска для швов плитки</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">MAPEI 80 Lvl</a></li>
	<li class="goods-grouts__item"><a class="goods-grouts__link" href="#">MAPEI 80 Lvl</a></li>
	<li class="goods-grouts__item goods-grouts__item_show goods-grouts__item_hidden">Показать все</li>
</ul>
<?*/?>
<?
// <-- Быстрый фильтр
?>

<?
// Фильтр + список товаров в обертке с AJAX_MODE=Y -->
?>
<?
$arParams['AJAX_MODE'] = 'Y';
$arParams['CUR_SECTION_ID'] = $arCurSection['ID'];
$arParams['SEF_RULE'] = $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"];
$arParams['SMART_FILTER_PATH'] = $arResult["VARIABLES"]["SMART_FILTER_PATH"];
$arParams['SECTION_ID'] = $arResult["VARIABLES"]["SECTION_ID"];
$arParams['SECTION_CODE'] = $arResult["VARIABLES"]["SECTION_CODE"];
$arParams['SECTION_URL'] = $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"];
$arParams['DETAIL_URL'] = $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"];
$arParams['ADD_TO_BASKET_ACTION'] = $basketAction;
$arParams['COMPARE_PATH'] = $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'];
?>
<?/**/?>
<? $APPLICATION->IncludeComponent(
	"indexis:block.filter",
	"",
	$arParams
); ?>
<?/**/?>
<?
// <-- Фильтр + список товаров в обертке с AJAX_MODE=Y
?>

<?
// Описание раздела -->
?>
<? $APPLICATION->ShowViewContent("section_description"); ?>
<?
// <-- Описание раздела
?>

<?php
$APPLICATION->IncludeComponent(
	"sotbit:seo.meta",
	".default",
	array(
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"SECTION_ID" => $arCurSection['ID'],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
	)
);
?>