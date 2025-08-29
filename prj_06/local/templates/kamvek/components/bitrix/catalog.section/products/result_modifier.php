<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

foreach ($arResult["ITEMS"] as &$arItem) {
    //$arFileCustom = CFile::GetFileArray($file_id);
    $arFileCustom = $arItem['PREVIEW_PICTURE'];
    $arPicture = array();
    $size = 'S';
    if ($arFileCustom['HEIGHT'] >= $arFileCustom['WIDTH'] && intval($arFileCustom['HEIGHT']) > 285) {
        $size = 'L';
    } else if ($arFileCustom['HEIGHT'] < $arFileCustom['WIDTH'] && intval($arFileCustom['WIDTH']) > 285) {
        $size = 'M';
    }
    $src = $arFileCustom['SRC'];
    $height = $arFileCustom['HEIGHT'];
    $width = $arFileCustom['WIDTH'];
    if (!is_file($_SERVER["DOCUMENT_ROOT"] . $arFileCustom["SRC"]))
    {
        $src = $this->GetFolder().'/images/tile-empty.png';
        $height = 285;
        $width = 285;
    }
    $arPicture = array(
        'SRC' => $arFileCustom['SRC'],
        'ALT' => ('' != $arFileCustom["ALT"]
            ? $arFileCustom["ALT"]
            : $arItem["NAME"]
        ),
        'TITLE' => ('' != $arFileCustom["TITLE"]
            ? $arFileCustom["TITLE"]
            : $arItem["NAME"]
        ),
        'SIZE' => $size,
        'HEIGHT' => $height,
        'WIDTH' => $width,
        'SOURCE_PICTURE' => $arFileCustom,
    );
    $arItem['PICTURE'] = $arPicture;
}