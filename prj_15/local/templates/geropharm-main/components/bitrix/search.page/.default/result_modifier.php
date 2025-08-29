<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Highloadblock as HL;

\Bitrix\Main\Loader::includeModule('highloadblock');
\Bitrix\Main\Loader::includeModule('iblock');

//vardump($arResult);

$obHighloadList = HL\HighloadBlockTable::getList(['filter' => ['=NAME' => 'Themes']])->fetch();
$obHighloadEntity = HL\HighloadBlockTable::compileEntity($obHighloadList);
$obHighloadClass = $obHighloadEntity->getDataClass();
$obHighloadClassList = $obHighloadClass::getList(array('select' => array('ID', 'UF_NAME', 'UF_XML_ID')));
while ($arHighloadList = $obHighloadClassList->Fetch()) {
    $arThemes[$arHighloadList["UF_XML_ID"]] = $arHighloadList["UF_NAME"];
}

$itemsByIb = $arResult["SHOW_BLOCKS"] = $arResult["ELEMENTS"] = [];
foreach ($arResult["SEARCH"] as $searchResult) {
    //echo 'ITEM_ID = '.$searchResult["ITEM_ID"].'<br />';
    $itemsByIb[$searchResult["PARAM2"]][$searchResult["ITEM_ID"]] = $searchResult["ITEM_ID"];
}

foreach($itemsByIb as $ib => $arItems){
    CIBlockElement::GetPropertyValuesArray($arItems, $ib, [], []);
    $arSelect = array("ID");
    $arFilter = array("IBLOCK_ID" => $ib, "ID" => array_keys($arItems));
    $res = CIBlockElement::GetList(array(), $arFilter, false, array("nTopCount" => count($arItems)));
    while ($rsElement = $res->GetNextElement()) {
        $arElement = $rsElement->GetFields();
        $arElement["PROPERTIES"] = $arItems[$arElement["ID"]];
        $arElement['PICTURE'] = array();
        if (!empty($arElement['PREVIEW_PICTURE'])) {
            $arResultLocal = Indexis::getImageFormatted(array(
                'RESIZE' => 'N',
                'FILE_VALUE' => CFile::GetFileArray($arElement['PREVIEW_PICTURE']),
                'DEFAULT_ALT_TITLE' => $arElement['NAME']
            ));
            $arElement['PICTURE'] = $arResultLocal['PICTURE'];
        }
        if(isset($arElement["PROPERTIES"]["THEME"]) && !empty($arElement["PROPERTIES"]["THEME"]["VALUE"])){
            foreach($arElement["PROPERTIES"]["THEME"]["VALUE"] as $val){
                $arElement["PROPERTIES"]["THEME"]["DISPLAY_VALUE"][] = $arThemes[$val];
            }
        }
        $arResult["ELEMENTS"][$arElement["IBLOCK_CODE"]][$arElement["ID"]] = $arElement;
    }
}

// Вебинары -->
$arResult['WEBINARS_IDS'] = [];
foreach ($arResult["ELEMENTS"]["webinars"] as $arItem) {
    $arResult['WEBINARS_IDS'][] = $arItem['ID'];
}
// <-- Вебинары