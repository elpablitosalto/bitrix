<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem) {

    //vardump($arItem['DISPLAY_PROPERTIES']['THEME']);

    if (!empty($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'])) {
        if (is_string($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'])) {
            $arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE'] = array($arItem['DISPLAY_PROPERTIES']['THEME']['DISPLAY_VALUE']);
        }
    }

    // Картинки -->
    $arItem['PICTURE'] = array();
    if (!empty($arItem['PREVIEW_PICTURE'])) {
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arItem['PREVIEW_PICTURE'],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arItem['NAME']
        ));
        $arItem['PICTURE'] = $arResultLocal['PICTURE'];
    } else {
        $arItem['PICTURE'] = [
            'SRC' => SITE_TEMPLATE_PATH . '/img/content/webinar/webinar-default.jpg',
            'ALT' => $arItem['NAME'],
            'TITLE' => $arItem['NAME']
        ];
    }
    // <-- Картинки
}

// Если показываются сохраненные материалы -->
if (!empty($arParams['SAVED_IDS'])) {
    $arItemsTmp = array();
    foreach ($arResult["ITEMS"] as &$arItem) {
        $arItemsTmp[$arItem['ID']] = $arItem;
    }
    $arResult["ITEMS"] = $arItemsTmp;

    $arItemsTmp = array();
    foreach ($arParams['SAVED_IDS'] as $elId) {
        $arItemsTmp[$elId] = $arResult["ITEMS"][$elId];
    }
    $arResult["ITEMS"] = $arItemsTmp;
}
// <-- Если показываются сохраненные материалы

// Показывать три или четыре миниатюры вебинаров -->
$arResult['SHOW_COUNT'] = 0;
$arResult['PAID_PRESENT'] = 'N';
if ($arParams['SHOW_THREE_OR_FOUR'] == 'Y') {
    foreach ($arResult["ITEMS"] as &$arItem) {
        //if (!empty($arItem['DISPLAY_PROPERTIES']['PAID']['DISPLAY_VALUE'])) {
        if( $arItem['DISPLAY_PROPERTIES']['PAID']['VALUE_XML_ID'] == 'Y' ) {   
            $arResult['SHOW_COUNT'] = 3;
            $arResult['PAID_PRESENT'] = 'Y';
        }
    }
    if (intval($arResult['SHOW_COUNT']) <= 0) {
        $arResult['SHOW_COUNT'] = 4;
    }
    if ($arResult['SHOW_COUNT'] == 3 && $arResult['PAID_PRESENT'] == 'Y') {
        $arItemsTmp = array();
        $i = 0;
        foreach ($arResult["ITEMS"] as $key => $arItem) {
            if ($i == 3) {
                break;
            }
            $arItemsTmp[$key] = $arItem;
            $i++;
        }
        $arResult["ITEMS"] = $arItemsTmp;
    }
}
// <-- Показывать три или четыре миниатюры вебинаров

// Спикеры -->
$arIds = array();
$arElements = array();
foreach ($arResult["ITEMS"] as &$arItem) {
    $elId = $arItem['DISPLAY_PROPERTIES']['SPEAKER']['VALUE'];
    if (intval($elId) > 0) {
        $arIds[] = $elId;
    }
    //vardump( $arItem['DISPLAY_PROPERTIES']['SPEAKER'] );
}
if (!empty($arIds)) {
    $arSelect = false;
    $arFilter = array(
        "ID" => $arIds,
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arFields['PROPERTIES'] = $ob->GetProperties();
        //$item["URL"] = $item["DETAIL_PAGE_URL"];
        //$arResult["ITEMS"][$arFields['ID']]['URL'] = $arFields['PROPERTIES']['BUY_LINK']['VALUE'];

        $arElements[$arFields['ID']] = array(
            'NAME' => $arFields['NAME'],
            'RANK' => $arFields['PROPERTIES']['RANK']['VALUE'],
        );
    }
}
//vardump($arElements);
foreach ($arResult["ITEMS"] as &$arItem) {
    $elId = $arItem['DISPLAY_PROPERTIES']['SPEAKER']['VALUE'];
    //echo 'elId = '.$elId.'<br />';
    if (intval($elId) > 0) {
        if (!empty($arElements[$elId])) {
            $arItem['SPEAKER'] = $arElements[$elId];
        }
    }
}
// <-- Спикеры

if ($arParams['USER_AUTHORIZED'] == 'Y') {
    $deal = new Deal();
    $arResult['ORDERS'] = $deal->getMyOrderList('webinars');
}