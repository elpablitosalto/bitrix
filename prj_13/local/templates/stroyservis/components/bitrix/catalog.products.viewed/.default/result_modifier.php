<?
// Скрывать цену -->
$arItemsIds = array();
$arItemsTmp = array();
foreach ($arResult["ITEMS"] as &$arItem) {
    if (intval($arItem['ID']) > 0) {
        $arItemsTmp[$arItem['ID']] = $arItem;
        $arItemsIds[] = $arItem['ID'];
    }
}
//vardump($arItemsIds);
if (!empty($arItemsIds)) {
    $arResult["ITEMS"] = $arItemsTmp;

    $arSelect = false;
    $arFilter = array("ID" => $arItemsIds);
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arFields['PROPERTIES'] = $ob->GetProperties();

        $arResult["ITEMS"][$arFields['ID']]['PROPERTIES']['PRICE_HIDE']['VALUE'] = $arFields['PROPERTIES']['PRICE_HIDE']['VALUE'];

        //echo ' = ' . $arFields['ID'] . '<br />';
        //echo ' = ' . $arFields['PROPERTIES']['PRICE_HIDE']['VALUE'] . '<br />';
    }
}
// <--


// Основное изображение -->
if (!empty($arResult["ITEMS"])) {
    $width = $GLOBALS["arSiteConfig"]['CATALOG_LIST']['IMG_WIDTH'];
    $height = $GLOBALS["arSiteConfig"]['CATALOG_LIST']['IMG_HEIGHT'];

    foreach ($arResult["ITEMS"] as &$arItem) {
        if ($arItem["PREVIEW_PICTURE"]["ID"] > 0 && is_file($_SERVER["DOCUMENT_ROOT"] . $arItem["PREVIEW_PICTURE"]["SRC"])) {
            $file = CFile::ResizeImageGet(
                $arItem["PREVIEW_PICTURE"]["ID"],
                array('width' => $width, 'height' => $height),
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true
            );
            //$arItem["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] = $file['src'];

            $arItem['PICTURE'] = array(
                'SRC' => $file['src'],
                'ALT' => ('' != $arItem["PREVIEW_PICTURE"]["ALT"]
                    ? $arItem["PREVIEW_PICTURE"]["ALT"]
                    : $arItem["NAME"]
                ),
                'TITLE' => ('' != $arItem["PREVIEW_PICTURE"]["TITLE"]
                    ? $arItem["PREVIEW_PICTURE"]["TITLE"]
                    : $arItem["NAME"]
                ),
                'SOURCE_PICTURE' => $arItem["PREVIEW_PICTURE"],
            );
        } else if ($arItem["DETAIL_PICTURE"]["ID"] > 0 && is_file($_SERVER["DOCUMENT_ROOT"] . $arItem["DETAIL_PICTURE"]["SRC"])) {
            $file = CFile::ResizeImageGet(
                $arItem["DETAIL_PICTURE"]["ID"],
                array('width' => $width, 'height' => $height),
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true
            );
            //$arItem["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] = $file['src'];

            $arItem['PICTURE'] = array(
                'SRC' => $file['src'],
                'ALT' => ('' != $arItem["DETAIL_PICTURE"]["ALT"]
                    ? $arItem["DETAIL_PICTURE"]["ALT"]
                    : $arItem["NAME"]
                ),
                'TITLE' => ('' != $arItem["DETAIL_PICTURE"]["TITLE"]
                    ? $arItem["DETAIL_PICTURE"]["TITLE"]
                    : $arItem["NAME"]
                ),
                'SOURCE_PICTURE' => $arItem["DETAIL_PICTURE"],
            );
        } else {
            $file_path = $this->GetFolder() . '/images/no_photo.png';
            $arSourcePicture = array();
            if ($arItem["PREVIEW_PICTURE"]["ID"] > 0) {
                $arSourcePicture = CFile::GetFileArray($arItem["PREVIEW_PICTURE"]["ID"]);
            } else if ($arItem["DETAIL_PICTURE"]["ID"] > 0) {
                $arSourcePicture = CFile::GetFileArray($arItem["DETAIL_PICTURE"]["ID"]);
            }

            $arItem['PICTURE'] = array(
                'SRC' => $file_path,
                'ALT' => $arItem["NAME"],
                'TITLE' => $arItem["NAME"],
                "WIDTH" => $width,
                "HEIGHT" => $height,
                'SOURCE_PICTURE' => $arSourcePicture,
            );
        }
    }
}
// <-- Основное изображение

// Разное -->
foreach ($arResult["ITEMS"] as &$arItem) {
    // Доступность товара для заказа -->
    if (!empty($arItem)) {
        if ($arItem['PROPERTIES']['PRICE_HIDE']['VALUE'] == 'Y' && ((float)$arItem['PRICE']) > 0) {
            $arItem['HIDE_PRICE'] = 'Y';
        }

        if (((float)$arItem['PRICE']) > 0 && intval($arItem['QUANTITY']) > 0) {
            $arItem['CAN_BUY_CUSTOM'] = 'Y';
        } else if (((float)$arItem['PRICE']) > 0 && intval($arItem['QUANTITY']) <= 0) {
            $arItem['CAN_ORDER_CUSTOM'] = 'Y';
        } else if (((float)$arItem['PRICE']) <= 0 && intval($arItem['QUANTITY']) <= 0) {
            $arItem['NOT_AVAILABLE'] = 'Y';
        }
        if ($arItem['CAN_BUY_CUSTOM'] == 'Y' || $arItem['CAN_ORDER_CUSTOM'] == 'Y') {
            $arItem['CAN_BUY_ORDER_CUSTOM'] = 'Y';
        }

        // Товар снят с производства -->
        $arItem['OUT_OF_PRODUCTION'] = $arItem['PROPERTIES']['OUT_OF_PRODUCTION']['VALUE_XML_ID'];
        // <--
    }
    // <-- Доступность товара для заказа
}
// <-- Разное
