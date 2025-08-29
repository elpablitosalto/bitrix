<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

// Пользователь - партнёр? -->
$arResult['SHOW_LINK_REG_PARTNER'] = 'N';
$arResult['SHOW_DETAIL_PAGE_URL'] = 'N';
if ($arParams['CHECK_PARTNER'] == 'Y') {
    if (!in_array($GLOBALS['arSiteConfig']['USER']['PARTNER_GROUP'], $arParams['USER_GROUPS'])) {
        $arResult['SHOW_LINK_REG_PARTNER'] = 'Y';
    } else {
        $arResult['SHOW_DETAIL_PAGE_URL'] = 'Y';
    }
}
// <-- 

//$arItemsTmp = array();
foreach ($arResult["ITEMS"] as &$item) {
    if (!empty($item["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"])) {
        $arFile = $item["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"];
        $src = $arFile['SRC'];
        if ($arParams['CHECK_PARTNER'] == 'Y') {
            if ($arResult['SHOW_DETAIL_PAGE_URL'] == 'N') {
                $src = $GLOBALS['arSiteConfig']['LINKS']['REG_PARTNER'];
            }
        }
        $item['FILE'] = array(
            'SRC' => $src,
            'NAME' => $item['NAME'],
            'DATE' => FormatDate("d.m.Y", MakeTimeStamp($item["ACTIVE_FROM"])),
            'SIZE_FORMAT' => Indexis::formatSizeUnits($arFile['FILE_SIZE']),
            'TYPE_FORMAT' => Indexis::getExtension($arFile['SRC'], false, true),
        );
        //$item["BANNER"] = CFile::GetPath($item["PROPERTIES"]["FILE"]["VALUE"]);
    }
}
