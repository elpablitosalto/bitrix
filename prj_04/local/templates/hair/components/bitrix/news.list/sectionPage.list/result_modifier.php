<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// Получение нужных данных из highload блока Color
$colorHLid = 6;
$colorHLdata = Bitrix\Highloadblock\HighloadBlockTable::getById($colorHLid)->fetch();
$colorHLentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($colorHLdata);
$colorHLDataClass = $colorHLdata['NAME'].'Table';
$colorHLresult = $colorHLDataClass::getList(array(
    'select' => array('ID', 'UF_NAME', 'UF_XML_ID', 'UF_COLOR_CODE'),
    'order' => array('UF_NAME' =>'ASC'),
));
$colorData = array();

while($res = $colorHLresult->fetch()) {
    $colorData[$res['ID']] = array(
        'ID' => $res['ID'],
        'VALUE' => $res['UF_NAME'],
        'CODE' => $res['UF_COLOR_CODE']
    );
}

// Получение цвета секции
if (isset($arResult['ITEMS'][0]['IBLOCK_SECTION_ID'])) {
    $arFilter = [
        'IBLOCK_ID' => 2,
        'ID' => $arResult['ITEMS'][0]['IBLOCK_SECTION_ID'],
        'ACTIVE' => 'Y'
    ];
    $obj = CIBlockSection::GetList(false,$arFilter,false,['UF_COLOR']);
    while($res = $obj->GetNext()) {
        if (!empty($colorData[$res['UF_COLOR']])) {
            $arResult['SECTION_COLOR'] = $colorData[$res['UF_COLOR']];
        }
    }
}


$arResult['TYPES'] = [];

foreach($arResult['ITEMS'] as $k => $arItem):
    if(!empty($arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE']['VALUE'])) {
        $type = $arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE']['VALUE'];
        $arResult['TYPES'][$type]['NAME'] = $arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE']['DISPLAY_VALUE'];
        $arResult['TYPES'][$type]['ITEMS'][] = $arItem;
    }
endforeach;

$this->__component->SetResultCacheKeys(array("SECTION_COLOR"));
?>