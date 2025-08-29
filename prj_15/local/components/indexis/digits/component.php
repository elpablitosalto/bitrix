<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

// подключаем пространство имен класса HighloadBlockTable и даём ему псевдоним HLBT для удобной работы
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

CModule::IncludeModule('highloadblock');

$arResult['USER_ID'] = $arParams['USER_ID'];

$arResult['DIGITS'] = array(
    'ARTICLES' => array(
        'COUNT' => 0,
    ),
    'WEBINARS' => array(
        'COUNT' => 0,
    ),
    'SHOW' => false
);


// Статьи -->
$IBLOCK_ID = Indexis::getIblockId("articles", "content");
if (intval($arResult['USER_ID']) > 0 && intval($IBLOCK_ID) > 0) {
    $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM");
    $arFilter = array(
        "IBLOCK_ID" => $IBLOCK_ID, 
        "ACTIVE_DATE" => "Y", 
        "ACTIVE" => "Y",
        "PROPERTY_USERS" => $arResult['USER_ID']
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    $arResult['DIGITS']['ARTICLES']['COUNT'] = $res->SelectedRowsCount();
    /*while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        $arResult['DIGITS']['ARTICLES']['COUNT']++;
        $arResult['DIGITS']['SHOW'] = true;
    }*/
}
// <-- Статьи

// Вебинары -->
$IBLOCK_ID = Indexis::getIblockId("webinars", "content");
if (intval($arResult['USER_ID']) > 0 && intval($IBLOCK_ID) > 0) {
    $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM");
    $arFilter = array(
        "IBLOCK_ID" => $IBLOCK_ID, 
        "ACTIVE_DATE" => "Y", 
        "ACTIVE" => "Y",
        "PROPERTY_USERS" => $arResult['USER_ID']
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    $arResult['DIGITS']['WEBINARS']['COUNT'] = $res->SelectedRowsCount();
    /*while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        $arResult['DIGITS']['WEBINARS']['COUNT']++;
        $arResult['DIGITS']['SHOW'] = true;
    }*/
}
// <-- Вебинары

//vardump($arResult);

$this->setResultCacheKeys(array(
    "DIGITS",
));
$this->includeComponentTemplate();

return $arResult['arFilterResult'];
