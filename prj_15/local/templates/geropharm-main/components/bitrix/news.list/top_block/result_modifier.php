<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Специальности -->
$arResult['arSpecs'] = array();
$hlbId = $GLOBALS['arSiteConfig']['HIBLOCK']['SPECS']['ID'];
if (intval($hlbId) > 0) {
    $entity_data_class = GetEntityDataClass($hlbId);
    $rsData = $entity_data_class::getList(array(
        'select' => array('*'),
        'order' => array('UF_FOR_WHOM' => 'ASC'),
    ));
    while ($el = $rsData->fetch()) {
        $arResult['arSpecs'][] = "'" . $el['UF_FOR_WHOM'] . "'";
    }
}
if (!empty($arResult['arSpecs'])) {
    $arResult['specsJs'] = "[" . implode(", ", $arResult['arSpecs']) . "]";
}
// <-- Специальности


$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], '=CODE' => $arParams["PARENT_SECTION_CODE"]);
$rsSections = CIBlockSection::GetList(array('ID' => 'ASC'), $arFilter, false, ["NAME", "DESCRIPTION", "UF_REFRESH_IMAGES"]);
$arResult["SECTION"] = $rsSections->Fetch();

$cp = $this->__component;
if (is_object($cp)) {
    $cp->arResult['SECTION'] = $arResult['SECTION'];
    $cp->SetResultCacheKeys(array('SECTION'));
}
