<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


foreach ($arResult["ITEMS"] as &$arItem) {

    if (!empty($arItem["DISPLAY_PROPERTIES"]["BANNERS"]["VALUE"])) {

        foreach ($arItem["DISPLAY_PROPERTIES"]["BANNERS"]["VALUE"] as $key => $val) {

            $arFile = array();
            if (!empty($val['SUB_VALUES']['B_PICTURE']['VALUE'])) {
                $arFile = CFile::GetFileArray($val['SUB_VALUES']['B_PICTURE']['VALUE']);
            }

            $arResultLocal = Indexis::getImageFormatted(array(
                'RESIZE' => 'N',
                'FILE_VALUE' => $arFile,
                'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
                //'WIDTH' => 205,
                //'HEIGHT' => 116,
                'DEFAULT_ALT_TITLE' => $arItem['NAME']
            ));
            $arItem["DISPLAY_PROPERTIES"]["BANNERS"]["VALUE"][$key]['PICTURE'] = $arResultLocal['PICTURE'];
        }
    }
}
