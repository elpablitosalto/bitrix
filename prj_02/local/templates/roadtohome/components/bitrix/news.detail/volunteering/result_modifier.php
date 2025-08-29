<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if( intval( $arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"]["ID"] ) > 0 )
{
    $arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"] = array( $arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"] ); 
}
if( intval( $arResult["DISPLAY_PROPERTIES"]["PHOTOS_BLOCK_2"]["FILE_VALUE"]["ID"] ) > 0 )
{
    $arResult["DISPLAY_PROPERTIES"]["PHOTOS_BLOCK_2"]["FILE_VALUE"] = array( $arResult["DISPLAY_PROPERTIES"]["PHOTOS_BLOCK_2"]["FILE_VALUE"] ); 
}

\Bitrix\Main\Loader::includeModule('dev2fun.opengraph');
\Dev2fun\Module\OpenGraph::Show($arResult['ID'],'element');

foreach ($arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"] as $key => $val) {
    switch ($key) {
        case 0:
            $width = 368;
            $height = 281;
            break;
        case 1:
            $width = 370;
            $height = 573;
            break;
        case 2:
            $width = 779;
            $height = 559;
            break;
        case 3:
            $width = 782;
            $height = 782;
            break;
        case 4:
            $width = 437;
            $height = 533;
            break;
    }
    $arPicture = CFile::ResizeImageGet(
        $val['ID'],
        array('width' => $width, 'height' => $height),
        BX_RESIZE_IMAGE_EXACT,
        true
    );
    $arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"][$key]["RESIZE_SRC"] = $arPicture["src"];
}
