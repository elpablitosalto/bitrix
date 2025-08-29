<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem) {

    // Изображение -->
    //$arFileCustom = CFile::GetFileArray($file_id);
    $arFileCustom = $arItem['PREVIEW_PICTURE'];
    //$arFileCustom = $arItem['DISPLAY_PROPERTIES']['TILE_IMAGE']['FILE_VALUE'];
    $arPicture = array();
    //if (is_file($_SERVER["DOCUMENT_ROOT"] . $file["src"]))
    {
        $file = CFile::ResizeImageGet(
            $arItem["PREVIEW_PICTURE"]["ID"],
            array('width' => 305, 'height' => 200),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
        $arPicture = array(
            'SRC' => $file['src'],
            'ALT' => ('' != $arFileCustom["ALT"]
                ? $arFileCustom["ALT"]
                : $arItem["NAME"]
            ),
            'TITLE' => ('' != $arFileCustom["TITLE"]
                ? $arFileCustom["TITLE"]
                : $arItem["NAME"]
            ),
            'HEIGHT' => $file['height'],
            'WIDTH' => $file['width'],
            'SOURCE_PICTURE' => $arFileCustom,
        );
        //$morePhotoTmp[$key] = $arPicture;
    }

    $arItem['PICTURE'] = $arPicture;
    // Изображение -->

    // Дата публикации -->
    $arItem['DATE_CREATE_FORMAT'] = FormatDate("j F Y", MakeTimeStamp($arItem["DATE_CREATE"]));
    // <-- Дата публикации

    // Дата изменения -->
    $arItem['DATE_UPDATE_FORMAT_M'] = FormatDate("Y-m-d", MakeTimeStamp($arItem["TIMESTAMP_X"]));
    // <-- Дата изменения

    // Дата изменения -->
    $arItem['DATE_CREATE_FORMAT_M'] = FormatDate("Y-m-d", MakeTimeStamp($arItem["DATE_CREATE"]));
    // <-- Дата изменения


    //vardump($arItem);
}
