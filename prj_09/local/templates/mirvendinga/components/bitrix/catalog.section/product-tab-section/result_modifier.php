<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Application;

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$tabProps = ['novelty', 'hit', 'discount'];

$arResult['GROUPS'] = [];
$arResult['FILTERED_ITEMS'] = 0;

foreach($tabProps as $tabCode) {
 $arResult['GROUPS'][$tabCode] = [
    'NAME' => '',
    'URL' => '',
    'ITEMS' => []
 ];
}
//echo 'count = '.count($arResult['ITEMS']).'<br />';
foreach($arResult['ITEMS'] as $arItem) {
    //echo 'ID = '.$arItem['ID'].'<br />';
    $saleActions = $arItem['PROPERTIES']['SALE_ACTIONS'];
    foreach($saleActions['VALUE_XML_ID'] as $tabIndex => $tabCode) {
        if(in_array($tabCode, $tabProps)) {
            $arResult['GROUPS'][$tabCode]['NAME'] = $saleActions['VALUE'][$tabIndex];
            $arResult['GROUPS'][$tabCode]['URL'] =  $saleActions['ID'];
            $arResult['GROUPS'][$tabCode]['ITEMS'][] = $arItem;
            $arResult['FILTERED_ITEMS']++;
        }
    }
}

foreach($arResult['GROUPS'] as $key => $arGroup) {
    if(empty($arGroup['ITEMS'])) {
        unset($arResult['GROUPS'][$key]);
    }
}