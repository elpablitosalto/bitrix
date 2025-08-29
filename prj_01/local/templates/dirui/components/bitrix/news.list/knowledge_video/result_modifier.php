<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

//$arItemsTmp = array();
foreach ($arResult["ITEMS"] as &$item) {
    /*
    if(!empty($item["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"])){
        $arFile = $item["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"];
        $item['FILE'] = array(
            'SRC' => $arFile['SRC'],
            'NAME' => $item['NAME'],
            'DATE' => FormatDate("d.m.Y", MakeTimeStamp($item["ACTIVE_FROM"])),
            'SIZE_FORMAT' => Indexis::formatSizeUnits($arFile['FILE_SIZE']),
            'TYPE_FORMAT' => Indexis::getExtension($arFile['SRC'], false, true),
        );
        //$item["BANNER"] = CFile::GetPath($item["PROPERTIES"]["FILE"]["VALUE"]);
    }
    */

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

    //vardump($item["DISPLAY_PROPERTIES"]["VIDEO"]);

    // Ссылка на видео-файл -->
    if (!empty($item["DISPLAY_PROPERTIES"]["VIDEO"]["FILE_VALUE"])) {
        $item['VIDEO_URL'] = $item["DISPLAY_PROPERTIES"]["VIDEO"]["FILE_VALUE"]['SRC'];
        $item['EXT'] = Indexis::getExtension($item['VIDEO_URL'], false, true);
    } else if (!empty($item["DISPLAY_PROPERTIES"]["URL"]["VALUE"])) {
        $item['VIDEO_URL'] = $item["DISPLAY_PROPERTIES"]["URL"]["VALUE"];
    }
    // <-- Ссылка на видео-файл
}
