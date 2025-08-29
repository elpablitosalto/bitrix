<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

// Доступность в component_epilog.php состояния товара для заказа -->
$this->__component->SetResultCacheKeys(array("CAN_BUY_CUSTOM"));
$this->__component->SetResultCacheKeys(array("CAN_ORDER_CUSTOM"));
$this->__component->SetResultCacheKeys(array("CAN_BUY_ORDER_CUSTOM"));
$this->__component->SetResultCacheKeys(array("OUT_OF_PRODUCTION"));
$this->__component->SetResultCacheKeys(array("NOT_AVAILABLE"));
// <--

// Цвета из справочника -->
$arColors = array();
if (CModule::IncludeModule('highloadblock')) {
    $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById($GLOBALS["arSiteConfig"]['HL']['COLORS']['ID'])->fetch();
    $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
    $strEntityDataClass = $obEntity->getDataClass();
    $resData = $strEntityDataClass::getList(array(
        'select' => array('ID', 'UF_NAME', 'UF_COLOR', 'UF_XML_ID', 'UF_NUM_COLOR_CATALOG'),
        //'filter' => array('ID' => $BRAND_ID),
        'filter' => array(),
        'order'  => array('ID' => 'ASC'),
        //'limit'  => 100,
    ));
    while ($arItem = $resData->Fetch()) {
        //$BRAND_NAME = $arItem['UF_NAME'];
        $arColors[$arItem['UF_XML_ID']] = array(
            'UF_XML_ID' => $arItem['UF_XML_ID'],
            'UF_NAME' => $arItem['UF_NAME'],
            'UF_COLOR' => $arItem['UF_COLOR'],
            'UF_NUM_COLOR_CATALOG' => $arItem['UF_NUM_COLOR_CATALOG'],
        );
    }
}
//vardump($arColors);
// <-- Цвета из справочника

// Свойства, которые показываются на детальной странице -->
$arResult['arDisplayPropertiesCodes'] = [];
/*
foreach ($arResult['DISPLAY_PROPERTIES'] as $key => $arProp) {
    $arResult['arDisplayPropertiesCodes'][] = $arProp['CODE'];
}
*/
if (intval($arParams['IBLOCK_ID']) > 0) {
    $arShowPropsIds = \Bitrix\Iblock\Model\PropertyFeature::getDetailPageShowProperties($arParams['IBLOCK_ID']);

    $properties = CIBlockProperty::GetList(
        array("sort" => "asc", "name" => "asc"),
        array("ACTIVE" => "Y", "IBLOCK_ID" => $arParams['IBLOCK_ID'])
    );
    while ($propFields = $properties->GetNext()) {
        //echo $propFields["ID"] . " - " . $propFields["NAME"] . "<br>";
        if (in_array($propFields["ID"], $arShowPropsIds)) {
            $arResult['arDisplayPropertiesCodes'][] = $propFields['CODE'];
        }
    }
}
//vardump($arResult['arDisplayPropertiesCodes']);
// <--

// Группа товаров -->
//vardump($arResult['DISPLAY_PROPERTIES']);
if (intval($arResult['ID']) > 0) {
    $arResult["arProductsGroup"] = [];
    $arResult['curGroupProduct'] = [];
    $arResult['mainGroupProduct'] = [];
    if (intval($arParams['IBLOCK_ID']) > 0) {
        $group_id = $arResult['PROPERTIES']['PRODUCTS_GROUP']['VALUE_ENUM_ID'];
        //vardump($arResult['PROPERTIES']['PRODUCTS_GROUP']);
        if (intval($group_id) > 0) {
            $arSelect = array('ID', 'NAME', 'DETAIL_PAGE_URL', 'DETAIL_PICTURE', 'CATALOG_PRICE_1');
            $arFilter = array(
                "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                "ACTIVE_DATE" => "Y",
                "ACTIVE" => "Y",
                "PROPERTY_PRODUCTS_GROUP" => $group_id,
            );
            $res = CIBlockElement::GetList(array("NAME" => "ASC"), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arFields['PROPERTIES'] = $ob->GetProperties();

                // Главный товар в группе -->
                $MAIN = $arFields['PROPERTIES']['MAIN_PRODUCT_GROUP']['VALUE_XML_ID'];
                if (strlen($MAIN) <= 0) {
                    $MAIN = 'N';
                }
                // <-- Главный товар в группе

                // Текущий товар -->
                $ACTIVE = 'N';
                if ($arFields['ID'] == $arResult['ID']) {
                    $ACTIVE = 'Y';
                }
                // <--

                // Вес -->
                $WEIGHT = $arFields['PROPERTIES']['VES_ATTR_S']['VALUE'];
                $WEIGHT = str_replace('кг', '', $WEIGHT);
                $WEIGHT = trim($WEIGHT);
                // <-- Вес

                // Длина -->
                $LENGTH = preg_replace( '/[^0-9\.]/', '', $arFields['PROPERTIES']['DLINA']['VALUE']);
                // <-- Длина

                $ar = array(
                    'COLOR' => $arColors[$arFields['PROPERTIES']['COLOR_REF']['VALUE']],
                    'WEIGHT' => $WEIGHT,
                    'LENGTH' => $LENGTH,
                    'MAIN' => $MAIN,
                    'DETAIL_PAGE_URL' => $arFields['DETAIL_PAGE_URL'],
                    'ID' => $arFields['ID'],
                    'NAME' => $arFields['NAME'],
                    'PRICE' => ($arFields['CATALOG_PRICE_1'] > 0 ? number_format($arFields['CATALOG_PRICE_1'], 0, ',', ' ') : ''),
                    'BRAND' => $arFields['PROPERTIES']['PROIZVODITEL_EL']['VALUE'],
                    'ACTIVE' => $ACTIVE,
                    'DETAIL_PICTURE' => $arFields['DETAIL_PICTURE'],
                    'DETAIL_PICTURE_SRC' => (!empty($arFields['DETAIL_PICTURE']) ? CFile::GetPath($arFields['DETAIL_PICTURE']) : ''),
                    'MORE_PHOTO' => $arFields['PROPERTIES']['MORE_PHOTO']['VALUE'],
                    'FILES' => $arFields['PROPERTIES']['FILES']['VALUE'],
                    'VIDEO_1' => $arFields['PROPERTIES']['VIDEO_1']['VALUE'],
                    'VIDEO_2' => $arFields['PROPERTIES']['VIDEO_2']['VALUE'],
                );

                // Характеристики -->
                $arProps = [];
                if (!empty($arResult['arDisplayPropertiesCodes'])) {
                    foreach ($arResult['arDisplayPropertiesCodes'] as $propCode) {
                        $arProps[$propCode] = $arFields['PROPERTIES'][$propCode];
                    }
                    /*
                    foreach ($arFields['PROPERTIES'] as $key => $arProp) {
                        if (in_array($arProp['CODE'], $arResult['arDisplayPropertiesCodes'])) {
                            $arProps[$key] = $arProp;
                        }
                    }
                    */
                } else {
                    $arProps = $arFields['PROPERTIES'];
                }
                //$ar['arPropsForDisplay'] = $arProps;
                //$ar['arFieldsForDisplay'] = $arFields;
                $arParamsCustom = array(
                    'ITEM' => $arFields,
                    'PROPERTIES' => $arProps
                );
                $arResultCustom = getProductCharacters($arParamsCustom);
                $ar['arDisplayProperties'] = $arResultCustom['arDisplayProperties'];
                // <-- Характеристики

                $arResult["arProductsGroup"][$arFields['ID']] = $ar;

                if ($ACTIVE == 'Y') {
                    $arResult['curGroupProduct'] = $ar;
                }
                if ($MAIN == 'Y') {
                    $arResult['mainGroupProduct'] = $ar;
                }
            }
        } else {
        }
    }
    //vardump($arResult["arProductsGroup"]);
}
/*
// Характеристики -->
foreach ($arResult["arProductsGroup"] as $key => $arProduct) {
    $arFields = $arProduct['arFieldsForDisplay'];
    $arProps = $arProduct['arPropsForDisplay'];
    echo 'count = ' . count($arProduct['arPropsForDisplay']) . '<br />';
    $arParamsCustom = array(
        'ITEM' => $arFields,
        'PROPERTIES' => $arProps
    );
    $arResultCustom = getProductCharacters($arParamsCustom);
    $arResult["arProductsGroup"][$key]['arDisplayProperties'] = $arResultCustom['arDisplayProperties'];
}
// <-- Характеристики
*/
function getProductsGroup($arParams)
{
    $arResult = array();

    return $arResult;
}
// <-- Группа товаров

// Отзывы -->
if (intval($arResult['ID']) > 0) {
    $arReviewsIds = array();
    $arSelect = array("ID", "NAME");
    $arFilter = array(
        "IBLOCK_ID" => Indexis::getIblockId('reviews', 'content'),
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        "PROPERTY_PRODUCT" => $arResult['ID']
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arReviewsIds[] = $arFields['ID'];
    }
    $arResult['REVIEWS_COUNT'] = count($arReviewsIds);
}
// <-- Отзывы

//vardump($arResult['mainGroupProduct']);

// Изображения -->
if (intval($arResult['ID']) > 0) {
    $arResult['PICTURES'] = [];
    $width = $GLOBALS["arSiteConfig"]['CATALOG_ELEMENT']['IMG_WIDTH'];
    $height = $GLOBALS["arSiteConfig"]['CATALOG_ELEMENT']['IMG_HEIGHT'];
    $width_slide = $GLOBALS["arSiteConfig"]['CATALOG_ELEMENT']['IMG_WIDTH_SLIDE'];
    $height_slide = $GLOBALS["arSiteConfig"]['CATALOG_ELEMENT']['IMG_HEIGHT_SLIDE'];

    $arPhotoIds = array();
    // Детальная картинка -->
    if (intval($arResult['DETAIL_PICTURE']['ID']) > 0) {
        $arPhotoIds[] = $arResult['DETAIL_PICTURE']['ID'];
    } else if (intval($arResult['DETAIL_PICTURE']) > 0) {
        $arPhotoIds[] = $arResult['DETAIL_PICTURE'];
    } else if (intval($arResult['mainGroupProduct']['DETAIL_PICTURE']) > 0) {
        $arPhotoIds[] = $arResult['mainGroupProduct']['DETAIL_PICTURE'];
    }
    // Дополнительные изображения -->
    if (!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])) {
        $arPhotoIds = array_merge($arPhotoIds, $arResult['PROPERTIES']['MORE_PHOTO']['VALUE']);
    } else if (!empty($arResult['mainGroupProduct']['MORE_PHOTO'])) {
        $arPhotoIds = array_merge($arPhotoIds, $arResult['mainGroupProduct']['MORE_PHOTO']);
    }

    foreach ($arPhotoIds as $key => $fileId) {
        $file = CFile::ResizeImageGet(
            $fileId,
            array('width' => $width, 'height' => $height),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
        $file_slide = CFile::ResizeImageGet(
            $fileId,
            array('width' => $width_slide, 'height' => $height_slide),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
        $ar_file = CFile::GetFileArray($fileId);
        $arPicture = array();
        if (/*is_file($_SERVER["DOCUMENT_ROOT"] . $file["src"])*/isset($file["src"])) {
            $arPicture = array(
                'SRC' => $file['src'],
                'SRC_SLIDE' => $file_slide['src'],
                'ALT' => ('' != $ar_file["ALT"]
                    ? $ar_file["ALT"]
                    : $arResult["NAME"]
                ),
                'TITLE' => ('' != $ar_file["TITLE"]
                    ? $ar_file["TITLE"]
                    : $arResult["NAME"]
                ),
                'SOURCE_PICTURE' => $ar_file,
            );
            //$morePhotoTmp[$key] = $arPicture;
        } else {
            $file_path = $this->GetFolder() . '/images/no_photo.png';

            $arPicture = array(
                'SRC' => $file_path,
                'SRC_SLIDE' => $file_path,
                'ALT' => $arResult["NAME"],
                'TITLE' => $arResult["NAME"],
                "WIDTH" => $width,
                "HEIGHT" => $height,
                "WIDTH_SLIDE" => $width_slide,
                "HEIGHT_SLIDE" => $height_slide,
                'SOURCE_PICTURE' => $ar_file,
            );
        }
        $arResult['PICTURES'][] = $arPicture;
    }
    if (count($arResult['PICTURES']) <= 0) {
        $file_path = $this->GetFolder() . '/images/no_photo.png';

        $arPicture = array(
            'SRC' => $file_path,
            'SRC_SLIDE' => $file_path,
            'ALT' => $arResult["NAME"],
            'TITLE' => $arResult["NAME"],
            "WIDTH" => $width,
            "HEIGHT" => $height,
            "WIDTH_SLIDE" => $width_slide,
            "HEIGHT_SLIDE" => $height_slide,
            'SOURCE_PICTURE' => $ar_file,
        );

        $arResult['PICTURES'][] = $arPicture;
    }
}
// <-- Изображения

// Видео -->
if (intval($arResult['ID']) > 0) {
    $arResult['arVideos'] = array();
    if (!empty($arResult['PROPERTIES']['VIDEO_1']['VALUE'])) {
        $arResult['arVideos'][] = $arResult['PROPERTIES']['VIDEO_1']['VALUE'];
    } else if (!empty($arResult['mainGroupProduct']['VIDEO_1'])) {
        $arResult['arVideos'][] = $arResult['mainGroupProduct']['VIDEO_1'];
    }
    if (!empty($arResult['PROPERTIES']['VIDEO_2']['VALUE'])) {
        $arResult['arVideos'][] = $arResult['PROPERTIES']['VIDEO_2']['VALUE'];
    } else if (!empty($arResult['mainGroupProduct']['VIDEO_2'])) {
        $arResult['arVideos'][] = $arResult['mainGroupProduct']['VIDEO_2'];
    }
}
// <-- Видео 

// Характеристики текущего товара -->
$arResult['arDisplayProperties'] = array();
if (!empty($arResult)) {
    /*
    $arProps = [];
    if (!empty($arResult['arDisplayPropertiesCodes'])) {
        foreach ($arResult['arDisplayPropertiesCodes'] as $propCode) {
            $arProps[$propCode] = $arResult['PROPERTIES'][$propCode];
        }
    } else {
        $arProps = $arResult['DISPLAY_PROPERTIES'];
    }
    /**/
    /*
    foreach ($arResult['DISPLAY_PROPERTIES'] as $key => $val) {
        echo 'key = ' . $key . '<br />';
    }
    */
    $arProps = $arResult['DISPLAY_PROPERTIES'];
    $arParamsCustom = array(
        'ITEM' => $arResult,
        'PROPERTIES' => $arProps
    );
    $arResultCustom = getProductCharacters($arParamsCustom);
    $arResult['arDisplayProperties'] = $arResultCustom['arDisplayProperties'];

    if (!empty($arResult['mainGroupProduct']) && $arResult['mainGroupProduct']['ID'] != $arResult['curGroupProduct']['ID']) {
        foreach ($arResult['arDisplayPropertiesCodes'] as $propCode) {
            if (!is_array($arResult['arDisplayProperties'][$propCode]['VALUE'])) {
                if (strlen($arResult['arDisplayProperties'][$propCode]['VALUE']) <= 0) {
                    if (strlen($arResult['mainGroupProduct']['arDisplayProperties'][$propCode]['VALUE']) > 0) {
                        $arResult['arDisplayProperties'][$propCode] = $arResult['mainGroupProduct']['arDisplayProperties'][$propCode];
                    }
                }
            }
        }
        /*
        //$arResult['arDisplayProperties'] = $arResult['mainGroupProduct']['arDisplayProperties'];
        foreach ($arResult['mainGroupProduct']['arDisplayProperties'] as $prop_code => $arProp) {
            echo 'VALUE = ' . $arResult['arDisplayProperties'][$prop_code]['VALUE'] . '<br />';
            if (!is_array($arResult['arDisplayProperties'][$prop_code]['VALUE'])) {
                if (strlen($arResult['arDisplayProperties'][$prop_code]['VALUE']) <= 0) {
                    $arResult['arDisplayProperties'][$prop_code] = $arProp;
                }
            }
            //vardump($arProp);
        }
        */
    }
    if (!empty($arResult['arDisplayProperties'])) {
        $arDisplayProperties = [];
        foreach ($arResult['arDisplayPropertiesCodes'] as $propCode) {
            if (is_string($arResult['arDisplayProperties'][$propCode]['VALUE'])) {
                if (strlen($arResult['arDisplayProperties'][$propCode]['VALUE']) > 0) {
                    $arDisplayProperties[$propCode] = $arResult['arDisplayProperties'][$propCode];
                }
            } else if (is_array($arResult['arDisplayProperties'][$propCode]['VALUE'])) {
                if (count($arResult['arDisplayProperties'][$propCode]['VALUE']) > 0) {
                    $arDisplayProperties[$propCode] = $arResult['arDisplayProperties'][$propCode];
                }
            }
        }
        $arResult['arDisplayProperties'] = $arDisplayProperties;
    }

    /*
    $arShowPropsIds = \Bitrix\Iblock\Model\PropertyFeature::getDetailPageShowProperties($arParams['IBLOCK_ID']);
    $arDisplayProperties = array();
    foreach ($arResult['arDisplayProperties'] as $prop_code => $ar_prop) {
        if (is_string($ar_prop['VALUE'])) {
            if (strlen($ar_prop['VALUE']) > 0 && in_array($ar_prop['ID'], $arShowPropsIds)) {
                $arDisplayProperties[$prop_code] = $ar_prop;
            }
        }
    }
    $arResult['arDisplayProperties'] = $arDisplayProperties;
    */
}
// <-- Характеристики текущего товара

// Если у текущего товара заполнены свойства, то выводим их, а не свойства у главного товара -->
if (!empty($arResult['mainGroupProduct']) && $arResult['mainGroupProduct']['ID'] != $arResult['curGroupProduct']['ID']) {
    foreach ($arResult['curGroupProduct']['arDisplayProperties'] as $prop_code => $ar_prop) {
        if (is_string($ar_prop['VALUE'])) {
            if (
                $arResult['arDisplayProperties'][$prop_code]['CODE'] == $ar_prop['CODE']
                && strlen($ar_prop['CODE']) > 0
                && strlen($ar_prop['VALUE']) > 0
                && $arResult['arDisplayProperties'][$prop_code]['VALUE'] != $ar_prop['VALUE']
            ) {
                $arResult['arDisplayProperties'][$prop_code] = $ar_prop;
            }
        }
    }
}
// <-- 

// Страны -->
$arResult['arCountries'] = [];
if (!empty($arResult)) {
    $arSelect = array("ID", "NAME");
    $arFilter = array(
        "IBLOCK_ID" => Indexis::getIblockId('countries'),
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        $arResult['arCountries'][$arFields['ID']] = array(
            'ID' => $arFields['ID'],
            'NAME' => $arFields['NAME'],
        );
    }
}
// <-- Страны

// Бренд -->
$arResult['arBrand'] = array();
if (!empty($arResult)) {
    $brandId = $arResult['PROPERTIES']['PROIZVODITEL_EL']['VALUE'];
    if (!empty($arResult['mainGroupProduct']) && intval($brandId) <= 0) {
        if (intval($arResult['mainGroupProduct']['BRAND']) > 0) {
            $brandId = $arResult['mainGroupProduct']['BRAND'];
        }
    }
    if (intval($brandId) > 0) {
        $arSelect = false;
        $arFilter = array(
            "IBLOCK_ID" => Indexis::getIblockId('brands'),
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
            "ID" => $brandId
        );
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arFields['PROPERTIES'] = $ob->GetProperties();

            // Картинка -->
            $PICTURE = array();
            $width = 112;
            $height = 51;
            $arFields["DETAIL_PICTURE"] = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
            $arFields["PREVIEW_PICTURE"] = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
            if ($arFields["DETAIL_PICTURE"]["ID"] > 0/* && is_file($_SERVER["DOCUMENT_ROOT"] . $arFields["DETAIL_PICTURE"]["SRC"])*/) {
                $file = CFile::ResizeImageGet(
                    $arFields["DETAIL_PICTURE"]["ID"],
                    array('width' => $width, 'height' => $height),
                    BX_RESIZE_IMAGE_PROPORTIONAL,
                    true
                );
                $PICTURE = array(
                    'SRC' => $file['src'],
                    'ALT' => ('' != $arFields["DETAIL_PICTURE"]["ALT"]
                        ? $arFields["DETAIL_PICTURE"]["ALT"]
                        : $arFields["NAME"]
                    ),
                    'TITLE' => ('' != $arFields["DETAIL_PICTURE"]["TITLE"]
                        ? $arFields["DETAIL_PICTURE"]["TITLE"]
                        : $arFields["NAME"]
                    ),
                );
            } else if ($arFields["PREVIEW_PICTURE"]["ID"] > 0/* && is_file($_SERVER["DOCUMENT_ROOT"] . $arFields["PREVIEW_PICTURE"]["SRC"])*/) {
                $file = CFile::ResizeImageGet(
                    $arFields["PREVIEW_PICTURE"]["ID"],
                    array('width' => $width, 'height' => $height),
                    BX_RESIZE_IMAGE_PROPORTIONAL,
                    true
                );
                $PICTURE = array(
                    'SRC' => $file['src'],
                    'ALT' => ('' != $arFields["DETAIL_PICTURE"]["ALT"]
                        ? $arFields["DETAIL_PICTURE"]["ALT"]
                        : $arFields["NAME"]
                    ),
                    'TITLE' => ('' != $arFields["DETAIL_PICTURE"]["TITLE"]
                        ? $arFields["DETAIL_PICTURE"]["TITLE"]
                        : $arFields["NAME"]
                    ),
                );
            } else {
                $file_path = $this->GetFolder() . '/images/no_photo.png';

                $PICTURE = array(
                    'SRC' => $file_path,
                    'ALT' => $arFields["NAME"],
                    'TITLE' => $arFields["NAME"],
                    "WIDTH" => $width,
                    "HEIGHT" => $height,
                );
            }
            // <-- Картинка

            // Сертификат -->
            $PICTURE_CERT = array();
            $width = 165;
            $height = 229;
            $fileId = $arFields['PROPERTIES']['CERTIFICATE']['VALUE'];
            if (intval($fileId) > 0) {
                $arPictureCert = CFile::GetFileArray($fileId);
                //vardump($arPictureCert);
                if (/*is_file($_SERVER["DOCUMENT_ROOT"] . $arPictureCert["SRC"])*/isset($arPictureCert["SRC"])) {
                    $file = CFile::ResizeImageGet(
                        $fileId,
                        array('width' => $width, 'height' => $height),
                        BX_RESIZE_IMAGE_PROPORTIONAL,
                        true
                    );
                    $PICTURE_CERT = array(
                        'SRC' => $file['src'],
                        'ALT' => ('' != $arPictureCert["ALT"]
                            ? $arPictureCert["ALT"]
                            : $arFields["NAME"]
                        ),
                        'TITLE' => ('' != $arPictureCert["TITLE"]
                            ? $arPictureCert["TITLE"]
                            : $arFields["NAME"]
                        ),
                        'SRC_ORIG' => $arPictureCert["SRC"],
                    );
                } else {
                    $file_path = $this->GetFolder() . '/images/no_photo.png';

                    $PICTURE_CERT = array(
                        'SRC' => $file_path,
                        'SRC_ORIG' => $file_path,
                        'ALT' => $arFields["NAME"],
                        'TITLE' => $arFields["NAME"],
                        "WIDTH" => $width,
                        "HEIGHT" => $height,
                    );
                }
            }
            // <-- Сертификат

            //vardump($PICTURE_CERT);

            $arResult['arBrand'] = array(
                "PICTURE" => $PICTURE,
                "COUNTRY_HOME" => $arResult['arCountries'][$arFields['PROPERTIES']['COUNTRY_HOME']['VALUE']],
                "COUNTRY_MADE" => $arResult['arCountries'][$arFields['PROPERTIES']['COUNTRY_MADE']['VALUE']],
                "PICTURE_CERT" => $PICTURE_CERT,
            );
            //vardump($PICTURE_CERT);
        }
    }
}
// <-- Бренд

// Цвета -->
$arResult['arColors'] = array();
$arResult['arColorsCount'] = array();
$arResult['curColor'] = false;
if (!empty($arResult["arProductsGroup"])) {
    foreach ($arResult["arProductsGroup"] as $el_id => $ar_el) {
        //$ind = $ar_el['COLOR']['UF_XML_ID'];
        if (empty($ar_el['COLOR']))
            continue;
        $ind = $ar_el['COLOR']['UF_NUM_COLOR_CATALOG'];
//        if (!array_key_exists($ind, $arResult['arColors']) && strlen($ind) > 0) {
//            $arResult['arColors'][$ind] = $ar_el;
//        }
        $arResult['arColors'][] = $ar_el;
        // Текущий цвет -->
        if ($ar_el['ACTIVE'] == 'Y') {
            $arResult['curColor'] = $ar_el['COLOR'];
        }
        // <-- Текущий цвет

        if (!isset($arResult['arColorsCount'][$ar_el['WEIGHT']]))
            $arResult['arColorsCount'][$ar_el['WEIGHT']] = 0;

        $arResult['arColorsCount'][$ar_el['WEIGHT']]++;
    }

    usort($arResult['arColors'], function ($a, $b) {
        if ($a['COLOR']['UF_NUM_COLOR_CATALOG'] == $b['COLOR']['UF_NUM_COLOR_CATALOG']) {
            return 0;
        }
        return ($a['COLOR']['UF_NUM_COLOR_CATALOG'] < $b['COLOR']['UF_NUM_COLOR_CATALOG']) ? -1 : 1;
    });
}
//vardump($arResult['arColors']);
// <-- Цвета

// Веса -->
$arResult['arWeights'] = array();
if (!empty($arResult["arProductsGroup"])) {
    foreach ($arResult["arProductsGroup"] as $el_id => $ar_el) {
        $bAdd = $arResult['curGroupProduct']['COLOR']['UF_XML_ID'] == $ar_el['COLOR']['UF_XML_ID']
            || empty($arResult['arColors']);

        if ($bAdd) {
            $ind = $ar_el['WEIGHT'];
            if (!array_key_exists($ind, $arResult['arWeights']) && strlen($ind) > 0) {
                $arResult['arWeights'][$ind] = $ar_el;
            }
            // Текущий вес -->
            if ($ar_el['ACTIVE'] == 'Y') {
                $arResult['curWeight'] = $ar_el['WEIGHT'];
            }
            // <-- Текущий вес
        }
    }
}
if (!empty($arResult['arWeights'])) {
    asort($arResult['arWeights']);
}
// <-- Веса

// Длина -->
$arResult['arLengths'] = array();
if (!empty($arResult["arProductsGroup"])) {
    foreach ($arResult["arProductsGroup"] as $el_id => $ar_el) {
        $bAdd = $arResult['curGroupProduct']['COLOR']['UF_XML_ID'] == $ar_el['COLOR']['UF_XML_ID']
            || empty($arResult['arColors']);

        if ($bAdd) {
            $ind = $ar_el['LENGTH'];
            if (!array_key_exists($ind, $arResult['arLengths']) && strlen($ind) > 0) {
                $arResult['arLengths'][$ind] = $ar_el;
            }
            // Текущая длина -->
            if ($ar_el['ACTIVE'] == 'Y') {
                $arResult['curLength'] = $ar_el['LENGTH'];
            }
            // <-- Текущая длина
        }
    }
}
if (!empty($arResult['arLengths'])) {
    asort($arResult['arLengths']);
}
// <-- Длина

// Цена, количество -->
if (!empty($arResult)) {
    $arResult['PRICE'] = $arResult['ITEM_PRICES'][0]['PRICE'];
    $arResult['WEIGHT'] = $arResult['PROPERTIES']['VES_ATTR_S']['VALUE'];
    if ($arResult['WEIGHT'] > 0 && $arResult['PRICE'] > 0) {
        $arResult['PRICE_FOR_KG'] = ceil($arResult['PRICE'] / $arResult['WEIGHT']);
    }
    $arResult['QUANTITY'] = $arResult['PRODUCT']['QUANTITY'];
    $arResult['bAddToBasket'] = $arResult['PRICE'] > 0 && $arResult['QUANTITY'] > 0;
    //vardump($arResult);
}
// <-- Цена, количество

// Маркет-плейсы -->
if (!empty($arResult)) {
    $arResult['arMarketPlaces'] = array();
    if (strlen($arResult['PROPERTIES']['LINK_LEROY_MERLIN']['VALUE']) > 0) {
        $arResult['arMarketPlaces']['LINK_LEROY_MERLIN'] = $arResult['PROPERTIES']['LINK_LEROY_MERLIN']['VALUE'];
    }
    if (strlen($arResult['PROPERTIES']['LINK_WILDBERRIES']['VALUE']) > 0) {
        $arResult['arMarketPlaces']['LINK_WILDBERRIES'] = $arResult['PROPERTIES']['LINK_WILDBERRIES']['VALUE'];
    }
    if (strlen($arResult['PROPERTIES']['LINK_OZON']['VALUE']) > 0) {
        $arResult['arMarketPlaces']['LINK_OZON'] = $arResult['PROPERTIES']['LINK_OZON']['VALUE'];
    }
    if (strlen($arResult['PROPERTIES']['LINK_YANDEX_MARKET']['VALUE']) > 0) {
        $arResult['arMarketPlaces']['LINK_YANDEX_MARKET'] = $arResult['PROPERTIES']['LINK_YANDEX_MARKET']['VALUE'];
    }
    if (strlen($arResult['PROPERTIES']['LINK_SBERMEGAMARKET']['VALUE']) > 0) {
        $arResult['arMarketPlaces']['LINK_SBERMEGAMARKET'] = $arResult['PROPERTIES']['LINK_SBERMEGAMARKET']['VALUE'];
    }
}
// <-- Маркет-плейсы

// Документация -->
if (!empty($arResult)) {
    $arResult['arDocs'] = [];
    $arFiles = $arResult['PROPERTIES']['FILES']['VALUE'];
    if (
        !empty($arResult['mainGroupProduct'])
        && $arResult['mainGroupProduct']['ID'] != $arResult['curGroupProduct']['ID']
        && empty($arFiles)
        && !empty($arResult['mainGroupProduct']['FILES'])
    ) {
        $arFiles = $arResult['mainGroupProduct']['FILES'];
    }
    if (!empty($arFiles)) {
        foreach ($arFiles as $key => $fileId) {
            $arFile = CFile::GetFileArray($fileId);

            $fileName = $arFile['DESCRIPTION'];
            if (strlen($fileName) <= 0) {
                $fileName = $arFile['ORIGINAL_NAME'];
            }

            $arResult['arDocs'][] = array(
                'SRC' => $arFile['SRC'],
                'NAME' => $fileName,
            );
        }
    }
}
// <-- Документация

// Инструкция -->
if (!empty($arResult)) {
    $arResult['INSTRUCTION'] = '';
    if (!empty($arResult['PROPERTIES']['INSTRUCTION']['~VALUE']['TEXT'])) {
        $arResult['INSTRUCTION'] = $arResult['PROPERTIES']['INSTRUCTION']['~VALUE']['TEXT'];
    }
}
// <-- Инструкция

// Доступность товара для заказа -->
if (!empty($arResult)) {
    if ($arResult['PROPERTIES']['PRICE_HIDE']['VALUE'] == 'Y' && ((float)$arResult['PRICE']) > 0) {
        $arResult['HIDE_PRICE'] = 'Y';
    } 
    
    if (((float)$arResult['PRICE']) > 0 && intval($arResult['QUANTITY']) > 0) {
        $arResult['CAN_BUY_CUSTOM'] = 'Y';
    } else if (((float)$arResult['PRICE']) > 0 && intval($arResult['QUANTITY']) <= 0) {
        $arResult['CAN_ORDER_CUSTOM'] = 'Y';
    } else if (((float)$arResult['PRICE']) <= 0 && intval($arResult['QUANTITY']) <= 0) {
        $arResult['NOT_AVAILABLE'] = 'Y';
    }
    
    if ($arResult['CAN_BUY_CUSTOM'] == 'Y' || $arResult['CAN_ORDER_CUSTOM'] == 'Y') {
        $arResult['CAN_BUY_ORDER_CUSTOM'] = 'Y';
    }

    // Товар снят с производства -->
    $arResult['OUT_OF_PRODUCTION'] = $arResult['PROPERTIES']['OUT_OF_PRODUCTION']['VALUE_XML_ID'];
    // <--
}
// <-- 

// Скидка -->
if (!empty($arResult)) {
    $arResult['SHOW_PRICE_BEFORE_DISCOUNT'] = 'N';
    $arResult['BASE_PRICE'] = "";
    if (
        !empty($arResult['ITEM_PRICES'][0]['PRICE'])
        && !empty($arResult['ITEM_PRICES'][0]['BASE_PRICE'])
        && $arResult['ITEM_PRICES'][0]['PRICE'] != $arResult['ITEM_PRICES'][0]['BASE_PRICE']
        && strlen($arResult['ITEM_PRICES'][0]['PERCENT']) > 0
    ) {
        $arResult['SHOW_PRICE_BEFORE_DISCOUNT'] = 'Y';
        $arResult['BASE_PRICE'] = intval($arResult['ITEM_PRICES'][0]['BASE_PRICE']);
        $arResult['DISCOUNT_PERSENT'] = $arResult['ITEM_PRICES'][0]['PERCENT'];
    }
}
// <-- Скидка

// Хит продаж -->
if ($arResult['PROPERTIES']['BESTSELLER']['VALUE_XML_ID'] == 'Y') {
    $arResult['BESTSELLER'] = 'Y';
}
// <--

// Отзывы -->
if (!empty($arResult)) {
    $arResult['REVIEWS_COUNT'] = 0;
    $arResult['REVIEWS_COUNT_SHOW'] = '';
    $arResult['arReviews'] = [];
    $arReitings = [];
    if (intval($arResult['ID']) > 0) {
        $arSelect = array("ID", "NAME", 'PROPERTY_RATING');
        $arFilter = array(
            "IBLOCK_ID" => Indexis::getIblockId('reviews', 'forms'),
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
            'PROPERTY_HIDDEN_PRODUCT' => $arResult['ID'],
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
                $arReitings[] = $arFields['PROPERTY_RATING_VALUE'];
            }
        }
        $arResult['REVIEWS_COUNT'] = count($arResult['arReviews']);
        if (intval($arResult['REVIEWS_COUNT']) > 0) {
            $arResult['REVIEWS_COUNT_SHOW'] = '(' . $arResult['REVIEWS_COUNT'] . ')';
        }
    }
}
// <-- Отзывы

// Рейтинг -->
if (!empty($arReitings)) {
    $arResult['AVERAGE_RATING'] = round((array_sum($arReitings) / count($arReitings)), 1);
}
// <-- Рейтинг

// Вопросы -->
if (!empty($arResult)) {
    $arResult['QUESTIONS_COUNT'] = 0;
    $arResult['QUESTIONS_COUNT_SHOW'] = '';
    $arResult['arQuestions'] = [];
    if (intval($arResult['ID']) > 0) {
        $arSelect = array("ID", "NAME");
        $arFilter = array(
            "IBLOCK_ID" => Indexis::getIblockId('questions', 'forms'),
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
            'PROPERTY_HIDDEN_PRODUCT' => $arResult['ID'],
        );
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();

            $arResult['arQuestions'][$arFields['ID']] = array(
                'ID' => $arFields['ID'],
                'NAME' => $arFields['NAME'],
            );
        }
        $arResult['QUESTIONS_COUNT'] = count($arResult['arQuestions']);
        if (intval($arResult['QUESTIONS_COUNT']) > 0) {
            $arResult['QUESTIONS_COUNT_SHOW'] = '(' . $arResult['QUESTIONS_COUNT'] . ')';
        }
    }
}
// <-- Вопросы

function getProductCharacters($arParams)
{
    $arResult = array();
    foreach ($arParams['PROPERTIES'] as $key => $arProp) {
        $arPropArr = CIBlockFormatProperties::GetDisplayValue(
            $arParams['ITEM'],
            //$arResult,
            $arProp
        );

        $bFlag = false;
        $bString = false;
        $bArray = false;
        if (is_string($arPropArr["DISPLAY_VALUE"])) {
            $bFlag = (is_string($arProp["DISPLAY_VALUE"]) && strlen($arProp["DISPLAY_VALUE"]) > 0);
            $bString = true;
        }
        if (is_array($arProp["DISPLAY_VALUE"])) {
            $bFlag = $bFlag || (is_array($arProp["DISPLAY_VALUE"]) && count($arProp["DISPLAY_VALUE"]) > 0);
            $bArray = true;
        }

        if ($bFlag) {
            if ($bString) {
                $arResult["arDisplayProperties"][$arProp['CODE']] = $arPropArr;
            } else if ($bArray) {
                //vardump($arResult["arDisplayProperties"][$arProp['CODE']]);
                $ar = array();
                foreach ($arPropArr["DISPLAY_VALUE"] as $val) {
                    $ar[] = $val;
                }
                $arResult["arDisplayProperties"][$arProp['CODE']]['DISPLAY_VALUE'] = implode(', ', $ar);
            }
        }
    }

    return $arResult;
}
//}

if (!empty($arResult['IBLOCK_SECTION_ID']) && !empty($arResult['IBLOCK_ID'])) {
    $arUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields(
        "IBLOCK_" . $arResult['IBLOCK_ID'] . "_SECTION",
        $arResult['IBLOCK_SECTION_ID'],
        LANGUAGE_ID
    );

    // Максимальное число характеристик в верхней части -->
    if (strlen($arUserFields['UF_MAX_SHORT_CHARACTERS']['VALUE']) > 0) {
        $arResult['UF_MAX_SHORT_CHARACTERS'] = $arUserFields['UF_MAX_SHORT_CHARACTERS']['VALUE'];
    }
    // <-- Максимальное число характеристик в верхней части

    // Показывать баннер -->
    //vardump($arUserFields['UF_SHOW_BANNER']);
    $arResult['SHOW_BANNER'] = $arUserFields['UF_SHOW_BANNER']['VALUE'] == 1 ? 'Y' : 'N';
    // <-- Показывать баннер
}

if (is_array($arResult["arProductsGroup"]) && count($arResult["arProductsGroup"]) > 0) {
    $this->__component->SetResultCacheKeys(array("arProductsGroup"));
}
