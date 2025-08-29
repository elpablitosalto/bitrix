<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arTopSlider = array();

// Изображения для верхнего баннера -->
$arResult['PICTURES'] = array();
foreach ($arResult['UF_TOP_BANNER'] as $key => $file_id) {
    $arFileCustom = CFile::GetFileArray($file_id);
    //vardump($arFileCustom);

    /*
    $rsFile = CFile::GetByID($file_id);
    $arFile = $rsFile->Fetch();
    vardump($arFile);
    */

    $arPicture = array(
        'SRC' => $arFileCustom['SRC'],
        'ALT' => ('' != $arFileCustom["ALT"]
            ? $arFileCustom["ALT"]
            : $arResult["NAME"]
        ),
        'TITLE' => ('' != $arFileCustom["TITLE"]
            ? $arFileCustom["TITLE"]
            : $arResult["NAME"]
        ),
        'HEIGHT' => $arFileCustom['HEIGHT'],
        'WIDTH' => $arFileCustom['WIDTH'],
        'SOURCE_PICTURE' => $arFileCustom,
        'DESCRIPTION' => $arFileCustom['DESCRIPTION'],
    );
    $arResult['PICTURES'][] = $arPicture;
}
// <-- Изображения для верхнего баннера

$this->__component->SetResultCacheKeys(array("UF_H2", 'DESCRIPTION'));
