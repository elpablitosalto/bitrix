<?
global $APPLICATION;
$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    array(
        //"IS_SEF" => "Y",
        "IS_SEF" => "N",
        "SEF_BASE_URL" => "/catalog/",
        //"SECTION_PAGE_URL" => "#SECTION_ID#/",
        //"DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_ID#.html",
        "IBLOCK_TYPE" => "1c_catalog",
        "IBLOCK_ID" => Indexis::getIblockId("1c_catalog", "1c_catalog"),
        "DEPTH_LEVEL" => "1",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600"
    ),
    false
);


/*
// Обработка пунктов меню -->
foreach ($aMenuLinksExt as $key => &$arItem) {
    if ($arItem[3]['IS_PARENT'] == 1 && $arItem[3]['DEPTH_LEVEL'] == 1) {
        $arItem[3]['TYPE'] = "OUTSIDE";
        $arItem[3]['CLASS'] = "dp-header-menu__item_bold dp-header-menu__item_outside";
    } else if ($arItem[3]['IS_PARENT'] == 1 && $arItem[3]['DEPTH_LEVEL'] == 2) {
        $arItem[3]['TYPE'] = "OUTSIDE";
    }
}
// <-- 
*/

//vardump($aMenuLinksExt);

$aMenuLinks = array(
);

if (!empty($aMenuLinksExt) && is_array($aMenuLinksExt)) {
    $aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
}
