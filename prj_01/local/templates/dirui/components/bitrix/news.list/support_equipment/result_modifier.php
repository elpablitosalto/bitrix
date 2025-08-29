<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

//$arItemsTmp = array();
foreach ($arResult["ITEMS"] as &$item) {
    // Обложка -->
    $arFile = $item['PREVIEW_PICTURE'];
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arFile,
        'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $item['NAME']
    ));
    $item['PICTURE'] = $arResultLocal['PICTURE'];
    // <-- Обложка
}
