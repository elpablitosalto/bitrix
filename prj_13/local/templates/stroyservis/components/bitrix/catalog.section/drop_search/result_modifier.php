<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arSectionIds = [];

// Основное изображение -->
if (!empty($arResult["ITEMS"])) {
    $width = $GLOBALS["arSiteConfig"]['CATALOG_LIST']['IMG_WIDTH'];
    $height = $GLOBALS["arSiteConfig"]['CATALOG_LIST']['IMG_HEIGHT'];

    foreach ($arResult["ITEMS"] as &$arItem) {

        $arSectionIds[$arItem['IBLOCK_SECTION_ID']] = $arItem['IBLOCK_SECTION_ID'];

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
            $file_path = $this->GetFolder() . '/images/no_photo.png';
            $arSourcePicture = array();
            if ($arItem["PREVIEW_PICTURE"]["ID"] > 0) {
                $arSourcePicture = $arItem["PREVIEW_PICTURE"];
                //$arSourcePicture = CFile::GetFileArray($arItem["PREVIEW_PICTURE"]["ID"]);
            } else if ($arItem["DETAIL_PICTURE"]["ID"] > 0) {
                $arSourcePicture = $arItem["DETAIL_PICTURE"];
                //$arSourcePicture = CFile::GetFileArray($arItem["DETAIL_PICTURE"]["ID"]);
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

        //$arItem['PICTURE']['SOURCE_PICTURE'] = 
    }
}
// <-- Основное изображение

// Обработка значений -->
if (!empty($arResult["ITEMS"])) {
    foreach ($arResult["ITEMS"] as &$arItem) {
        // Цены, скидки -->
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
    }
}
// <-- Обработка значений

$arResult['SECTION_LIST'] = [];
if (count($arSectionIds) > 0) {
    $rsSect = CIBlockSection::GetList(
        array('SORT' => 'ASC'),
        array(
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            'ID' => $arSectionIds
        ),
        false,
        array('ID', 'NAME', 'SECTION_PAGE_URL')
    );

    while ($arSect = $rsSect->GetNext()) {
        $arResult['SECTION_LIST'][] = $arSect;
    }
}
