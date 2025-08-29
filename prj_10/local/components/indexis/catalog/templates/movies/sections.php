<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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

define('ROOT_MOVIES', true);

preg_match("/\/movies\/filter\/(.*)\/apply\//i", $APPLICATION->GetCurDir(), $matches);
if (isset($matches[1]))
    $arResult["VARIABLES"]["SMART_FILTER_PATH"] = $matches[1];

$arResult["URL_TEMPLATES"]["smart_filter"] = 'filter/#SMART_FILTER_PATH#/apply/';

require ("section.php");