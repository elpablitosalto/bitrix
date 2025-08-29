<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem) {

    // Изображение -->
    //$arFileCustom = CFile::GetFileArray($file_id);
    //$arFileCustom = $arItem['PREVIEW_PICTURE'];
    $arFileCustom = $arItem['DISPLAY_PROPERTIES']['TILE_IMAGE']['FILE_VALUE'];
    $arPicture = array();
    //if (is_file($_SERVER["DOCUMENT_ROOT"] . $file["src"]))
    {
        //vardump($arFileCustom);
        $size = 'S';
        if ($arFileCustom['HEIGHT'] >= $arFileCustom['WIDTH'] && intval($arFileCustom['HEIGHT']) > 285) {
            $size = 'L';
        } else if ($arFileCustom['HEIGHT'] < $arFileCustom['WIDTH'] && intval($arFileCustom['WIDTH']) > 285) {
            $size = 'M';
        }

        if (isset($arItem['PROPERTIES']['SIZE']['VALUE_XML_ID']) && !empty($arItem['PROPERTIES']['SIZE']['VALUE_XML_ID']))
            $size = $arItem['PROPERTIES']['SIZE']['VALUE_XML_ID'];

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
            'HEIGHT' => $arFileCustom['HEIGHT'],
            'WIDTH' => $arFileCustom['WIDTH'],
            'SOURCE_PICTURE' => $arFileCustom,
        );
        //$morePhotoTmp[$key] = $arPicture;
    }

    $arItem['PICTURE'] = $arPicture;
    // <-- Изображение

    // Текст для анонса -->
    // $arItem['PREVIEW_TEXT_CUSTOM'] = TruncateText(strip_tags($arItem['PREVIEW_TEXT']), 35);
    // <-- Текст для анонса
}
