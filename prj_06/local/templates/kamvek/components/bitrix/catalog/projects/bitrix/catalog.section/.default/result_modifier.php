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
