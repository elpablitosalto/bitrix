<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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

$this->setFrameMode(true);

use Bitrix\Main\Loader;
Loader::includeModule('iblock');

// Получаем код случайной акции, чтобы выводить ее на первом баннере
$res = CIBlockElement::GetList(['RAND' => 'ASC', 'RAND' => 'DESC'], [
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'ACTIVE_DATE' => 'Y',
    'ACTIVE' => 'Y',
], false, ['nPageSize' => 1], [
    'ID', 'CODE'
]);

$promoCode = '';
if ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $promoCode = $arFields['CODE'];
}

$APPLICATION->IncludeComponent(
    "indexis:page.constructor",
    "",
    Array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "SECTION_ID" => "57", // Разводящая акций
        "PROMO_CODE" => $promoCode,
        "HIDE_TOP_BANNER_ON_MOBILE" => "Y"
    )
);