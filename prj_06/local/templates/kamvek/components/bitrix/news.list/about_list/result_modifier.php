<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem) {
    //vardump($arItem);

    $newsId = $arItem['DISPLAY_PROPERTIES']['NEWS_ID']['VALUE'];
    $bShow = false;
    //vardump($arItem['DISPLAY_PROPERTIES']);
    if (intval($arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['ID']) > 0) {
        $arItem['TITLE'] = $arItem['NAME'];
        $arItem['TARGET'] = '_blank';
        $arItem['URL'] = $arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['SRC'];
        $bShow = true;
    } else if (strlen($arItem['DISPLAY_PROPERTIES']['URL']['VALUE']) > 0) {
        $arItem['TITLE'] = $arItem['NAME'];
        $arItem['TARGET'] = '_blank';
        $arItem['URL'] = $arItem['DISPLAY_PROPERTIES']['URL']['VALUE'];
        $bShow = true;
    } else if (intval($newsId)) {
        $arItem['TITLE'] = $arItem['DISPLAY_PROPERTIES']['NEWS_ID']['LINK_ELEMENT_VALUE'][$newsId]['NAME'];
        $arItem['TARGET'] = '_self';
        $arItem['URL'] = $arItem['DISPLAY_PROPERTIES']['NEWS_ID']['LINK_ELEMENT_VALUE'][$newsId]['DETAIL_PAGE_URL'];
        $bShow = true;
    }
    if ($bShow == false) {
        $arItem['SHOW'] = 'N';
    }
}

/*
foreach ($arResult["ITEMS"] as &$arItem) {
    //$arFileCustom = CFile::GetFileArray($file_id);
    $arFileCustom = $arItem['PREVIEW_PICTURE'];
    $arPicture = array();
    //if (is_file($_SERVER["DOCUMENT_ROOT"] . $file["src"]))
    {
        $size = 'M';
        if ($arFileCustom['HEIGHT'] >= $arFileCustom['WIDTH']) {
            $size = 'L';
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
            'HEIGHT' => $arFileCustom['HEIGHT'],
            'WIDTH' => $arFileCustom['WIDTH'],
            'SOURCE_PICTURE' => $arFileCustom,
        );
        //$morePhotoTmp[$key] = $arPicture;
    }

    $arItem['PICTURE'] = $arPicture;
}
*/
