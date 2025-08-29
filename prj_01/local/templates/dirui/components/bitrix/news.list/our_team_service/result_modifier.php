<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

foreach ($arResult["ITEMS"] as &$item) {
    if ($item["PREVIEW_PICTURE"]["ID"] > 0) {
        //$file = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], array('width' => 425, 'height' => 563), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        //$item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] = $file['src'];

        $arFile = $item['PREVIEW_PICTURE'];
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'Y',
            'FILE_VALUE' => $arFile,
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            'WIDTH' => 425,
            'HEIGHT' => 563,
            'DEFAULT_ALT_TITLE' => $item['NAME']
        ));
        $item['PICTURE'] = $arResultLocal['PICTURE'];
    }
}
