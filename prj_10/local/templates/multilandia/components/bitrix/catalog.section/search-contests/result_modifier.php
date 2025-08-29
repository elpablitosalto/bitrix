<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arContestIds = [];
foreach ($arResult['ITEMS'] as $arItem)
    $arContestIds[] = $arItem['ID'];

$arResult['VOTED_COUNT'] = [];

if (count($arContestIds) > 0) {
    $res = CIBlockElement::GetList(['SORT' => 'ASC'], [
        'IBLOCK_ID' => Indexis::getIblockId('participants'),
        'ACTIVE_DATE' => 'Y',
        'ACTIVE' => 'Y',
        'PROPERTY_CONTEST' => $arContestIds,
    ], false, false, [
        'ID', 'PROPERTY_VOTED', 'PROPERTY_CONTEST', 'PROPERTY_SUM_VOTED'
    ]);

    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        if (!isset($arResult['VOTED_COUNT'][$arFields['PROPERTY_CONTEST_VALUE']]))
            $arResult['VOTED_COUNT'][$arFields['PROPERTY_CONTEST_VALUE']] = 0;

        $arResult['VOTED_COUNT'][$arFields['PROPERTY_CONTEST_VALUE']] += intval($arFields['PROPERTY_SUM_VOTED_VALUE']);
    }
}