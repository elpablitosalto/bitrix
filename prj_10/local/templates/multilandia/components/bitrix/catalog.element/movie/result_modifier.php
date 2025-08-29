<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$arCookieData = \Bitrix\Main\Context::getCurrent()->getRequest()->getCookie('cookieName');
/*
vardump($arCookieData);

foreach ($_COOKIE as $keyCookie => $valueCookie) {
    $valueCookie = preg_replace('/\D/', '', $valueCookie);

    if(stristr($keyCookie, 'favorites_')) {
        $arIdsCatalogFavorites[$valueCookie] = preg_replace('/\D/', '', $valueCookie);
    }
}


$intFavorites = count($arIdsCatalogFavorites);

if (!empty($intFavorites)) {
    $showCountFav = 'display: block;';
} else {
    $showCountFav = 'display: none;';
}*/

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

// Картинки-постеры к видео -->
$val = $arResult['PROPERTIES']['VIDEO_POSTER']['VALUE'];
$arResult["arVideo"] = array();
if (intval($val) > 0 && !is_array($val)) {
    $arResult["arVideo"][] = array(
        "VIDEO_POSTER" => $val,
        "VIDEO_POSTER_SRC" => CFile::GetPath($val),
        "VIDEO_POSTER_DESC" => $arResult['PROPERTIES']['VIDEO_POSTER']['DESCRIPTION'],
        "VIDEO_LINK" => $arResult['PROPERTIES']['VIDEO_LINK']['VALUE'],
    );
} else if (!empty($val) && is_array($val)) {
    foreach ($val as $k => $v) {
        $arResult["arVideo"][] = array(
            "VIDEO_POSTER" => $val[$k],
            "VIDEO_POSTER_SRC" => CFile::GetPath($val[$k]),
            "VIDEO_POSTER_DESC" => $arResult['PROPERTIES']['VIDEO_POSTER']['DESCRIPTION'][$k],
            "VIDEO_LINK" => $arResult['PROPERTIES']['VIDEO_LINK']['VALUE'][$k],
        );
    }
}
$ar_sizes = array(
    "MEDIUM" => array(
        "width" => 480,
        "height" => 1920,
    ),
    "BIG" => array(
        "width" => 991,
        "height" => 1920,
    ),
    "SMALL" => array(
        "width" => 100,
        "height" => 1920,
    ),
);
foreach ($arResult["arVideo"] as $k => $v) {
    foreach ($ar_sizes as $k_2 => $v_2) {
        $arFileItemProp = CFile::GetFileArray($v["VIDEO_POSTER"]);
        $arResizeFileItem = CFile::ResizeImageGet(
            $arFileItemProp,
            ['width' => $v_2["width"], 'height' => $v_2["height"]],
            BX_RESIZE_IMAGE_PROPORTIONAL
        );
        $arResult["arVideo"][$k]["arPictSizes"][$k_2] = $arResizeFileItem;
    }
}
//vardump($arResult["arVideo"]);
// <-- 