<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

foreach ($arResult["ITEMS"] as &$item) {
    if ($item["DETAIL_PICTURE"]["ID"] > 0) {
        
        $arFile = $item['DISPLAY_PROPERTIES']['PICTURE_576']['FILE_VALUE'];
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arFile,
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            'WIDTH' => 576,
            'HEIGHT' => 5000,
            'DEFAULT_ALT_TITLE' => $item['NAME']
        ));
        $item['PICTURE_1'] = $arResultLocal['PICTURE'];

        $arFile = $item['DISPLAY_PROPERTIES']['PICTURE_991']['FILE_VALUE'];
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arFile,
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            'WIDTH' => 991,
            'HEIGHT' => 5000,
            'DEFAULT_ALT_TITLE' => $item['NAME']
        ));
        $item['PICTURE_2'] = $arResultLocal['PICTURE'];

        $arFile = $item['DETAIL_PICTURE'];
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arFile,
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 991,
            //'HEIGHT' => 5000,
            'DEFAULT_ALT_TITLE' => $item['NAME']
        ));
        $item['PICTURE'] = $arResultLocal['PICTURE'];
    }
}
