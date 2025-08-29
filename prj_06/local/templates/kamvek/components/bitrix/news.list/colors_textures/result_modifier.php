<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$width = 360;
$height = 240;
foreach ($arResult["ITEMS"] as &$arItem) {
    //vardump($arItem["DETAIL_PICTURE"]);
    //echo 'is_file = '.is_file($_SERVER["DOCUMENT_ROOT"] . $arItem["DETAIL_PICTURE"]["SRC"]).'<br>';
    if ($arItem["DETAIL_PICTURE"]["ID"] > 0 /*&& is_file($_SERVER["DOCUMENT_ROOT"] . $arItem["DETAIL_PICTURE"]["SRC"])*/) {
        $file = CFile::ResizeImageGet(
            $arItem["DETAIL_PICTURE"]["ID"],
            array('width' => $width, 'height' => $height),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
        $arItem['PICTURE'] = array(
            'SRC' => $file['src'],
            'ALT' => ('' != $arItem["DETAIL_PICTURE"]["ALT"]
                ? $arItem["DETAIL_PICTURE"]["ALT"]
                : $arItem["NAME"]
            ),
            'TITLE' => ('' != $arItem["DETAIL_PICTURE"]["TITLE"]
                ? $arItem["DETAIL_PICTURE"]["TITLE"]
                : $arItem["NAME"]
            ),
            'SOURCE_PICTURE' => $arItem["DETAIL_PICTURE"],
        );
    } else {
        $file_path = $this->GetFolder() . '/images/no_photo.png';
        $arSourcePicture = array();
        if ($arItem["DETAIL_PICTURE"]["ID"] > 0) {
            $arSourcePicture = CFile::GetFileArray($arItem["DETAIL_PICTURE"]["ID"]);
        }

        $arItem['PICTURE'] = array(
            'SRC' => $file_path,
            'ALT' => $arItem["NAME"],
            'TITLE' => $arItem["NAME"],
            "WIDTH" => $width,
            "HEIGHT" => $height,
            'SOURCE_PICTURE' => $arSourcePicture,
        );
    }
}
