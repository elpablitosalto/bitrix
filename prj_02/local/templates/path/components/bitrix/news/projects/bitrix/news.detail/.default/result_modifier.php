<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

if ($arResult["DETAIL_PICTURE"]["ID"] > 0) {
    $file = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width' => 642, 'height' => 540), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] = $file['src'];
}

foreach ($arResult["DISPLAY_PROPERTIES"]["DOCS"]["VALUE"] as $fileId) {
    $arResult["DISPLAY_PROPERTIES"]["DOCS"]["FULL_FILES"][] = CFile::GetFileArray($fileId);
}

$cp = $this->__component;
if (is_object($cp)) {
    $cacheKeys = [
        'ID',
        'NAME',
        'DISPLAY_PROPERTIES',
    ];
    foreach ($cacheKeys as $key) {
        $cp->arResult[$key] = $arResult[$key];
    }
    $cp->SetResultCacheKeys($cacheKeys);
}

if (!is_array($arResult["DISPLAY_PROPERTIES"]["FOR_WHOM"]["DISPLAY_VALUE"])) {
    $arResult["DISPLAY_PROPERTIES"]["FOR_WHOM"]["DISPLAY_VALUE"] = array($arResult["DISPLAY_PROPERTIES"]["FOR_WHOM"]["DISPLAY_VALUE"]);
}
if (!is_array($arResult["DISPLAY_PROPERTIES"]["HOW_WE_HELP"]["DISPLAY_VALUE"])) {
    $arResult["DISPLAY_PROPERTIES"]["HOW_WE_HELP"]["DISPLAY_VALUE"] = array($arResult["DISPLAY_PROPERTIES"]["HOW_WE_HELP"]["DISPLAY_VALUE"]);
}
