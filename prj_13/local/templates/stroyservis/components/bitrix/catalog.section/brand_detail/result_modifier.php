<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

// Основное изображение -->
$width = $GLOBALS["arSiteConfig"]['CATALOG_LIST']['IMG_WIDTH'];
$height = $GLOBALS["arSiteConfig"]['CATALOG_LIST']['IMG_HEIGHT'];

foreach ($arResult["ITEMS"] as &$arItem) {
    if ($arItem["PREVIEW_PICTURE"]["ID"] > 0/* && is_file($_SERVER["DOCUMENT_ROOT"] . $arItem["PREVIEW_PICTURE"]["SRC"])*/) {
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
    } else if ($arItem["DETAIL_PICTURE"]["ID"] > 0/* && is_file($_SERVER["DOCUMENT_ROOT"] . $arItem["DETAIL_PICTURE"]["SRC"])*/) {
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
        $filePath = $this->GetFolder() . '/images/no_photo.png';
        $arSourcePicture = array();
        if ($arItem["PREVIEW_PICTURE"]["ID"] > 0) {
            $arSourcePicture = CFile::GetFileArray($arItem["PREVIEW_PICTURE"]["ID"]);
        } else if ($arItem["DETAIL_PICTURE"]["ID"] > 0) {
            $arSourcePicture = CFile::GetFileArray($arItem["DETAIL_PICTURE"]["ID"]);
        }

        $arItem['PICTURE'] = array(
            'SRC' => $filePath,
            'ALT' => $arItem["NAME"],
            'TITLE' => $arItem["NAME"],
            "WIDTH" => $width,
            "HEIGHT" => $height,
            'SOURCE_PICTURE' => $arSourcePicture,
        );
    }

    $arItem['PICTURES'][] = $arItem['PICTURE'];
}
// <-- Основное изображение

// Изображения -->
$width = $GLOBALS["arSiteConfig"]['CATALOG_LIST']['IMG_WIDTH'];
$height = $GLOBALS["arSiteConfig"]['CATALOG_LIST']['IMG_HEIGHT'];
$morePhotoTmp = array();
foreach ($arResult["ITEMS"] as &$arItem) {

    //$morePhoto = $arItem['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE'];    
    $morePhoto = $arItem['PROPERTIES']['MORE_PHOTO']['VALUE'];    

    foreach ($morePhoto as $key => $photoId) {
        $photo = CFile::GetFileArray($photoId);
        $fileId = $photo['ID'];
        $file = CFile::ResizeImageGet(
            $fileId,
            array('width' => $width, 'height' => $height),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
        $arPicture = array();
        $arFile = CFile::GetFileArray($fileId);
        if (/*is_file($_SERVER["DOCUMENT_ROOT"] . $file["src"])*/isset($file["src"])) {
            $arPicture = array(
                'SRC' => $file['src'],
                'ALT' => ('' != $arFile["ALT"]
                    ? $arFile["ALT"]
                    : $arItem["NAME"]
                ),
                'TITLE' => ('' != $arFile["TITLE"]
                    ? $arFile["TITLE"]
                    : $arItem["NAME"]
                ),
                'SOURCE_PICTURE' => $arFile,
            );
            //$morePhotoTmp[$key] = $arPicture;
        } else {
            $filePath = $this->GetFolder() . '/images/no_photo.png';

            $arPicture = array(
                'SRC' => $filePath,
                'ALT' => $arItem["NAME"],
                'TITLE' => $arItem["NAME"],
                "WIDTH" => $width,
                "HEIGHT" => $height,
                'SOURCE_PICTURE' => $arFile,
            );
        }
        //vardump($arPicture);
        $arItem['PICTURES'][] = $arPicture;
    }
    //echo $arItem['ID'];
    //vardump($arItem['PROPERTIES']);
    //vardump($arItem['DISPLAY_PROPERTIES']);
    //vardump($arItem['PICTURES']);
}
// <-- Изображения

// Разное -->
$arItemsIds = array();
foreach ($arResult["ITEMS"] as &$arItem) {
    // Цены, скидки -->
    //vardump($arItem['ITEM_PRICES']);
    $arItem['PRICE'] = $arItem['ITEM_PRICES'][0]['PRICE'];
    $arItem['SHOW_PRICE_BEFORE_DISCOUNT'] = 'N';
    $arItem['BASE_PRICE'] = "";
    if (
        !empty($arItem['ITEM_PRICES'][0]['PRICE'])
        && !empty($arItem['ITEM_PRICES'][0]['BASE_PRICE'])
        && $arItem['ITEM_PRICES'][0]['PRICE'] != $arItem['ITEM_PRICES'][0]['BASE_PRICE']
        && strlen($arItem['ITEM_PRICES'][0]['PERCENT']) > 0
    ) {
        $arItem['SHOW_PRICE_BEFORE_DISCOUNT'] = 'Y';
        $arItem['BASE_PRICE'] = intval($arItem['ITEM_PRICES'][0]['BASE_PRICE']);
        $arItem['DISCOUNT_PERSENT'] = $arItem['ITEM_PRICES'][0]['PERCENT'];
    }
    // <-- Цены, скидки

    // Хит продаж -->
    if ($arItem['PROPERTIES']['BESTSELLER']['VALUE_XML_ID'] == 'Y') {
        $arItem['BESTSELLER'] = 'Y';
    }
    // <-- Хит продаж

    // Вес -->
    $arItem['WEIGHT'] = $arItem['PROPERTIES']['VES_ATTR_S']['VALUE'];
    if ($arItem['PRICE'] > 0 && $arItem['WEIGHT'] > 0) {
        $arItem['PRICE_FOR_KG'] = ceil($arItem['PRICE'] / $arItem['WEIGHT']);
    }
    // <-- Вес

    $arItem['QUANTITY'] = $arItem['PRODUCT']['QUANTITY'];
    //$arItem['CAN_BUY_CUSTOM'] = $arItem['PRICE'] > 0 && $arItem['QUANTITY'] > 0;
    $arItem['RATING_VALUE'] = $arItem['PROPERTIES']['RAITING_VAL']['VALUE'];
    $arItem['RATING_COUNT'] = $arItem['PROPERTIES']['RAITING_COUNT']['VALUE'];

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
    // <--

    $arItemsIds[] = $arItem['ID'];
}
// <-- Разное

// Отзывы -->
//vardump($arItemsIds);
$arResult['arReviews'] = [];
$arResult['arReitings'] = [];
if (!empty($arItemsIds)) {
    $arSelect = array("ID", "NAME", 'PROPERTY_RATING', 'PROPERTY_HIDDEN_PRODUCT');
    $arFilter = array(
        "IBLOCK_ID" => Indexis::getIblockId('reviews', 'forms'),
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        'PROPERTY_HIDDEN_PRODUCT' => $arItemsIds,
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        $arResult['arReviews'][$arFields['ID']] = array(
            'ID' => $arFields['ID'],
            'NAME' => $arFields['NAME'],
            'RATING' => $arFields['PROPERTY_RATING_VALUE'],
        );
        if (intval($arFields['PROPERTY_RATING_VALUE']) > 0) {
            $productId = $arFields['PROPERTY_HIDDEN_PRODUCT_VALUE'];
            $arResult['arReitings'][$productId]['arReitings'][] = $arFields['PROPERTY_RATING_VALUE'];
        }
    }
}
//vardump($arResult['arReitings']);
foreach ($arResult['arReitings'] as $elId => $ar) {
    //vardump($ar['arReitings']);
    $arResult['arReitings'][$elId]['AVERAGE_RAITING'] = round((array_sum($ar['arReitings']) / count($ar['arReitings'])), 1);
    $arResult['arReitings'][$elId]['RAITING_COUNT'] = count($ar['arReitings']);
}
// <-- Отзывы

// Количество товаров -->
$this->__component->SetResultCacheKeys(array("NAV_RESULT"));
// <-- 

// Дополнительные изображения -->
/*
foreach ($arResult["ITEMS"] as &$arItem) {
    $arMorePhoto = $arItem['PROPERTIES']['MORE_PHOTO']['VALUE'];
    foreach ($arMorePhoto as $key => $fileId) {
        $file = CFile::ResizeImageGet(
            $fileId,
            array('width' => $width, 'height' => $height),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
        $arPicture = array();
        if (is_file($_SERVER["DOCUMENT_ROOT"] . $file["SRC"])) {
            $arFile = CFile::GetFileArray($fileId);

            $arPicture = array(
                'SRC' => $file['src'],
                'ALT' => ('' != $arFile["ALT"]
                    ? $arFile["ALT"]
                    : $arItem["NAME"]
                ),
                'TITLE' => ('' != $arFile["TITLE"]
                    ? $arFile["TITLE"]
                    : $arItem["NAME"]
                ),
            );
        } else {
            $filePath = $this->GetFolder() . '/images/no_photo.png';

            $arPicture = array(
                'SRC' => $filePath,
                'ALT' => $arItem["NAME"],
                'TITLE' => $arItem["NAME"],
                "WIDTH" => $width,
                "HEIGHT" => $height,
            );
        }
        $arItem['MORE_PHOTO'][] = $arPicture;
    }
}
*/
// <-- Дополнительные изображения