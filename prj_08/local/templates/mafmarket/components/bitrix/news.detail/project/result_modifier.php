<?

use Bitrix\Location\Repository\Location\Capability\IFindByText;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->__component->SetResultCacheKeys(array("NAME"));
$this->__component->SetResultCacheKeys(array("DISPLAY_PROPERTIES"));

// Изображения -->
$arResultLocal = Indexis::getImageFormatted(array(
    'RESIZE' => 'N',
    'FILE_VALUE' => $arResult['DETAIL_PICTURE'],
    'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
    //'WIDTH' => 205,
    //'HEIGHT' => 116,
    'DEFAULT_ALT_TITLE' => $arResult['NAME']
));
$arResult['DETAIL_PICTURE'] = $arResultLocal['PICTURE'];

for ($i = 1; $i <= 7; $i++) {
    if (!empty($arResult['DISPLAY_PROPERTIES']['PICTURE_' . $i]['FILE_VALUE'])) {
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arResult['DISPLAY_PROPERTIES']['PICTURE_' . $i]['FILE_VALUE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arResult['NAME']
        ));
        $arResult['PICTURE_' . $i] = $arResultLocal['PICTURE'];
    }
}
// <-- Изображения

// Дизайнер -->
$IBLOCK_ID = Indexis::getIblockId('designers', 'content');
//echo 'IBLOCK_ID = '.$IBLOCK_ID.'<br />';
//echo 'DESIGNER = '.$arResult['DISPLAY_PROPERTIES']['DESIGNER']['VALUE'].'<br />';
if (!empty($arResult['DISPLAY_PROPERTIES']['DESIGNER']['VALUE']) && intval($IBLOCK_ID) > 0) {
    $arSelect = array("ID", "NAME", "PROPERTY_POSITION_COMPANY", "PREVIEW_PICTURE");
    $arFilter = array(
        "IBLOCK_ID" => $IBLOCK_ID,
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        "ID" => $arResult['DISPLAY_PROPERTIES']['DESIGNER']['VALUE'],
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        $arFile = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arFile,
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arFields['NAME']
        ));

        $arResult['arDesigner'] = array(
            "NAME" => $arFields['NAME'],
            "POSITION_COMPANY" => $arFields['PROPERTY_POSITION_COMPANY_VALUE'],
            "PICTURE" => $arResultLocal['PICTURE'],
            "DESIGNER_QUOTE" => $arResult['DISPLAY_PROPERTIES']['DESIGNER_QUOTE']['DISPLAY_VALUE'],
        );
    }
}
//vardump($arResult['arDesigner']);
// <-- Дизайнер