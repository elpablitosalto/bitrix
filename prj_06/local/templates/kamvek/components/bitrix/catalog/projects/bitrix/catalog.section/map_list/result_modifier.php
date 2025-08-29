<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

foreach ($arResult['ITEMS'] as &$item) {
    $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(
        $item["IBLOCK_ID"],
        $item["ID"]
    );
    $arElMetaProp = $ipropValues->getValues();
    $item["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] = $arElMetaProp["ELEMENT_PREVIEW_PICTURE_FILE_ALT"];
    $item["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] = $arElMetaProp["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"];
}

$arResult['REGION'] = [
    'NAME' => 'Регионы',
    'VALUES' => []
];

$res = CIBlockElement::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], [
    'IBLOCK_ID' => Indexis::getIblockId('regions', 'directories'),
    'ACTIVE_DATE' => 'Y',
    'ACTIVE' => 'Y',
], false, false, [
    'ID',
    'PROPERTY_LATITUDE',
    'PROPERTY_LONGITUDE',
    'PROPERTY_MAP_ZOOM',
    'NAME',
]);

while($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arResult['REGION']['VALUES'][] = $arFields;
}
?>