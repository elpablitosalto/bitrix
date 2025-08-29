<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$res = CIBlockElement::GetList(['SORT' => 'ASC'], [
    'IBLOCK_ID' => Indexis::getIblockId('addresses', 'contacts'),
    'ACTIVE_DATE' => 'Y',
    'ACTIVE' => 'Y',
], false, false, [
    'ID', 'PROPERTY_METRO'
]);

$arResult['METRO_LIST'] = [];
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arResult['METRO_LIST'][$arFields['ID']][] = 'м. ' . $arFields['PROPERTY_METRO_VALUE'];
}