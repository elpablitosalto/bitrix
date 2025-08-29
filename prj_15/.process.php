<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Loader,
    \Bitrix\Main\Context,
    \Bitrix\Main\Data\Cache,
    \Bitrix\Main\Application;
use \Bitrix\Highloadblock as HL;

Loader::includeModule('highloadblock');
Loader::includeModule('iblock');
global $USER;


$cache = Cache::createInstance(); // Служба кеширования



// Фильтр по темам -->
/*
$filterIblocks = $GLOBALS['arSiteConfig']['FILTER']['IBLOCKS'];
$resultFunc = CFilter::getFilterThemes(array(
    'filterIblocks' => $filterIblocks
));
$arInput = $resultFunc['arInput'];
*/

//свойства тем
$filterIblocks = [
    "upcoming_webinars", "webinars", "articles", "courses", "master-class"
];
$cachePath = 'filter_theme';
$cacheTtl = 60 * 60 * 24;
$cacheKey = 'filter_theme';
$taggedCache = Application::getInstance()->getTaggedCache(); // Служба пометки кеша тегами

if ($cache->initCache($cacheTtl, $cacheKey, $cachePath)) {
    $arInput = $cache->getVars(); // Получаем переменные
} elseif ($cache->startDataCache()) {

    $arInput["VISIBLE_THEMES"] = [];

    //ib
    $arInput["IBLOCKS"] = [];
    $arInput["IBLOCKS_ID"] = [];
    $iblock = new CIBlock();
    $dbIblock = $iblock->GetList(array('sort' => 'asc'), ["CODE" => $filterIblocks], false);
    while ($arIblock = $dbIblock->Fetch()) {
        $arInput["IBLOCKS"][$arIblock["ID"]] = $arIblock;
        $arInput["IBLOCKS_ID"][$arIblock["CODE"]] = $arIblock["ID"];
    }

    //themes
    $rsData = HL\HighloadBlockTable::getList(['filter' => ['=NAME' => 'Themes']]);
    if ($hldata = $rsData->fetch()) {

        $arInput["THEMES"] = [];
        HL\HighloadBlockTable::compileEntity($hldata);
        $hlDataClass = $hldata['NAME'] . 'Table';
        $res = $hlDataClass::getList([
                'filter' => [
                    '!UF_SHOW_NEW_MATERIALS' => false
                ],
                'select' => [
                    "UF_XML_ID",
                    "UF_NAME",
                ],
                'order' => ['UF_SORT' => 'asc', 'UF_NAME' => 'asc']
            ]
        );
        while ($row = $res->fetch()) {
            $arInput["VISIBLE_THEMES"][] = $row['UF_XML_ID'];
            $arInput["THEMES"][$row['UF_XML_ID']] = $row;
        }

        $arInput["THEMES_SELECTION"] = [];
        HL\HighloadBlockTable::compileEntity($hldata);
        $hlDataClass = $hldata['NAME'] . 'Table';
        $res = $hlDataClass::getList([
                'filter' => [
                    'LOGIC' => 'OR',
                    ['!UF_SHOW_PERSONAL_SELECTION' => false],
                    ['!UF_THEMES_EFECTIVNESS' => false],
                    ['!UF_SHOW_PERSONAL_SELECTION' => false],
                ],
                'select' => [
                    "UF_XML_ID",
                    "UF_NAME",
                    "UF_SHOW_PERSONAL_SELECTION",
                    "UF_THEMES_EFECTIVNESS",
                    "UF_SHOW_PERSONAL_SELECTION"
                ],
                'order' => ['UF_SORT' => 'asc', 'UF_NAME' => 'asc']
            ]
        );
        while ($row = $res->fetch()) {
            if($row['UF_SHOW_PERSONAL_SELECTION'])
                $arInput["THEMES_SELECTION"][$row['UF_XML_ID']] = $row['UF_XML_ID'];
            if($row['UF_THEMES_EFECTIVNESS'])
                $arInput["THEMES_EFECTIVNESS"][$row['UF_XML_ID']] = $row['UF_XML_ID'];
            if($row['UF_SHOW_PERSONAL_SELECTION'])
                $arInput["PERSONAL_SELECTION"][$row['UF_XML_ID']] = $row['UF_XML_ID'];
        }
    }

    $cache->endDataCache($arInput);
}
/**/
// <-- Фильтр по темам


$request = Context::getCurrent()->getRequest();
$arInput["SELECTED_THEMES"] = [];
$arThemes = $request->get("theme");
if (is_array($arThemes)) {
    foreach ($arThemes as $theme) {
        if (isset($arInput["THEMES"][$theme])) {
            $arInput["SELECTED_THEMES"][] = $theme;
        }
    }
}

$cachePath = 'filter_blocks';
$cacheTtl = 60*60*24;
$cacheKey = 'filters_blocks_' . serialize($arInput["SELECTED_THEMES"])  . serialize($arInput["THEMES"]) . serialize($arInput["VISIBLE_THEMES"]) . serialize($arInput["IBLOCKS_ID"]);
$taggedCache = Application::getInstance()->getTaggedCache(); // Служба пометки кеша тегами

if ($cache->initCache($cacheTtl, $cacheKey, $cachePath)) {
    $arInput["VISIBLE_IBLOCKS"] = $cache->getVars(); // Получаем переменные
} elseif ($cache->startDataCache()) {

    $taggedCache->startTagCache($cachePath);
    $arInput["VISIBLE_IBLOCKS"] = [];
    $arSelect = array("IBLOCK_ID");
    $themeFilter = (!empty( $arInput["SELECTED_THEMES"]))? $arInput["SELECTED_THEMES"] : $arInput["VISIBLE_THEMES"];
    $arFilter = array(
        "IBLOCK_ID" => $arInput["IBLOCKS_ID"],
        "ACTIVE" => "Y",
        "PROPERTY_THEME" => $themeFilter,
    );
    $res = CIBlockElement::GetList(array(), $arFilter, ["IBLOCK_ID"], false, $arSelect);
    while ($element = $res->GetNext()) {
        $arInput["VISIBLE_IBLOCKS"][] = $element["IBLOCK_ID"];
    }

    foreach($arInput["IBLOCKS_ID"] as $iblockId){
        $taggedCache->registerTag('iblock_id_' . $iblockId);
    }

    $taggedCache->endTagCache();

    $cache->endDataCache($arInput["VISIBLE_IBLOCKS"]);
}


$sortedIblocks = [];
foreach($filterIblocks as $iblockCode){
    if(in_array($arInput["IBLOCKS_ID"][$iblockCode], $arInput["VISIBLE_IBLOCKS"]))
        $sortedIblocks[] = $arInput["IBLOCKS_ID"][$iblockCode];
}
$arInput["VISIBLE_IBLOCKS"] = $sortedIblocks;

$selectedIblock = $arInput["VISIBLE_IBLOCKS"][0];
$request = Context::getCurrent()->getRequest();
if (in_array($request->get("type"),  $arInput["VISIBLE_IBLOCKS"])) {
    $selectedIblock = $request->get("type");
}

$arInput["SELECTED_BLOCK"] = $arInput["IBLOCKS"][$selectedIblock]["CODE"];
$arInput["SELECTED_BLOCK_ID"] = $selectedIblock;
