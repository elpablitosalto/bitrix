<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arResult['GROUPS'] = [];
$dbGroups = CIBlockElement::GetElementGroups($arResult['ID']);
while($arGroup = $dbGroups->GetNext()) {
    $arResult['GROUPS'][] = $arGroup;
}