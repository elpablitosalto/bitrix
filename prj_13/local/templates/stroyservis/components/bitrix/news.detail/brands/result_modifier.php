<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// Детальная картинка -->
if ($arResult['ID']) {
    $width = 170;
    $height = 40;
    if ($arResult["DETAIL_PICTURE"]["ID"] > 0/* && is_file($_SERVER["DOCUMENT_ROOT"] . $arResult["DETAIL_PICTURE"]["SRC"])*/) {
        /*
        $file = CFile::ResizeImageGet(
            $arResult["DETAIL_PICTURE"]["ID"],
            array('width' => $width, 'height' => $height),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
        */
        $arResult['PICTURE'] = array(
            'SRC' => $arResult["DETAIL_PICTURE"]['SRC'],
            'ALT' => ('' != $arResult["DETAIL_PICTURE"]["ALT"]
                ? $arResult["DETAIL_PICTURE"]["ALT"]
                : $arResult["NAME"]
            ),
            'TITLE' => ('' != $arResult["DETAIL_PICTURE"]["TITLE"]
                ? $arResult["DETAIL_PICTURE"]["TITLE"]
                : $arResult["NAME"]
            ),
            'SOURCE_PICTURE' => $arResult["DETAIL_PICTURE"],
        );
    } else {
        $filePath = $this->GetFolder() . '/images/no_photo.png';
        $arSourcePicture = array();
        if ($arResult["DETAIL_PICTURE"]["ID"] > 0) {
            $arSourcePicture = CFile::GetFileArray($arResult["DETAIL_PICTURE"]["ID"]);
        }

        $arResult['PICTURE'] = array(
            'SRC' => $filePath,
            'ALT' => $arResult["NAME"],
            'TITLE' => $arResult["NAME"],
            "WIDTH" => $width,
            "HEIGHT" => $height,
            'SOURCE_PICTURE' => $arSourcePicture,
        );
    }
}
// <-- Детальная картинка


// Категории, содержащие бренд -->
if ($arResult['ID']) {
    $arResult['arSectionsCnt'] = [];
    $arResult['arSectionsIds'] = [];
    //$arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM");
    $arSelect = false;
    $arFilter = array(
        "IBLOCK_ID" => Indexis::getIblockId('catalog'),
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        'PROPERTY_PROIZVODITEL_EL' => $arResult['ID'],
    );
    $arGroupBy = array('IBLOCK_SECTION_ID');
    $res = CIBlockElement::GetList(array(), $arFilter, $arGroupBy, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        //vardump($arFields);
        $arResult['arSectionsCnt'][$arFields['IBLOCK_SECTION_ID']] = $arFields['CNT'];
        $arResult['arSectionsIds'][] = $arFields['IBLOCK_SECTION_ID'];
        //print_r($arFields);
    }
}
//vardump($arResult['arSectionsCnt']);
//vardump($arResult['arSectionsIds']);
// <-- Категории, содержащие бренд

/*
// Товары, содержащие бренд -->
if ($arResult['ID']) {
    $arResult['arProductsIds'] = [];
    //$arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM");
    $arSelect = false;
    $arFilter = array(
        "IBLOCK_ID" => Indexis::getIblockId('catalog'),
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        'PROPERTY_PROIZVODITEL_EL' => $arResult['ID'],
    );
    $arGroupBy = array('IBLOCK_SECTION_ID');
    //$arNavig = array("nPageSize" => 12);
    $arNavig = false;
    $res = CIBlockElement::GetList(array(), $arFilter, $arGroupBy, $arNavig, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arResult['arProductsIds'][] = $arFields['ID'];
    }
}
//echo 'count = '.count( $arResult['arProductsIds'] ).'<br />';
// <-- Товары, содержащие бренд
*/

// ID акции -->
if ($arResult['ID']) {
    $arResult['PROMO_ID'] = 0;
    $arSelect = array("ID");
    //$arSelect = false;
    $arFilter = array(
        "IBLOCK_ID" => Indexis::getIblockId('promos', 'catalog'),
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        'PROPERTY_BRAND' => $arResult['ID'],
    );
    //$arGroupBy = array('IBLOCK_SECTION_ID');
    $arGroupBy = false;
    //$arNavig = array("nPageSize" => 12);
    $arNavig = false;
    $res = CIBlockElement::GetList(array(), $arFilter, $arGroupBy, $arNavig, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arResult['PROMO_ID'] = $arFields['ID'];
    }
}
// <-- ID акции

// Сертификаты -->
if ($arResult['ID']) {
    $width = 160;
    $height = 220;
    $arResult['arCertificates'] = array();
    $fileValues = (
        isset($arResult['DISPLAY_PROPERTIES']['CERTIFICATE_BRAND_DETAIL']['FILE_VALUE']['ID']) ?
        array(0 => $arResult['DISPLAY_PROPERTIES']['CERTIFICATE_BRAND_DETAIL']['FILE_VALUE']) :
        $arResult['DISPLAY_PROPERTIES']['CERTIFICATE_BRAND_DETAIL']['FILE_VALUE']
    );
    //vardump($fileValues);

    foreach ($fileValues as $key => $photo) {
        //$photo = CFile::GetFileArray($photoId);
        $fileId = $photo['ID'];
        $file = CFile::ResizeImageGet(
            $fileId,
            array('width' => $width, 'height' => $height),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
        $arPicture = array();
        //$arFile = CFile::GetFileArray($fileId);
        if (/*is_file($_SERVER["DOCUMENT_ROOT"] . $file["src"])*/isset($file["src"])) {
            $arPicture = array(
                'SRC' => $file['src'],
                'ALT' => ('' != $photo["ALT"]
                    ? $photo["ALT"]
                    : $arResult["NAME"]
                ),
                'TITLE' => ('' != $photo["TITLE"]
                    ? $photo["TITLE"]
                    : $arResult["NAME"]
                ),
                'SOURCE_PICTURE' => $photo,
            );
            //$morePhotoTmp[$key] = $arPicture;
        } else {
            $filePath = $this->GetFolder() . '/images/no_photo.png';
            $arSourcePicture = $photo;
            if (/*!is_file($_SERVER["DOCUMENT_ROOT"] . $arSourcePicture["SRC"])*/!isset($arSourcePicture["SRC"])) {
                $arSourcePicture["SRC"] = $filePath;
            }

            $arPicture = array(
                'SRC' => $filePath,
                'ALT' => $arResult["NAME"],
                'TITLE' => $arResult["NAME"],
                "WIDTH" => $width,
                "HEIGHT" => $height,
                'SOURCE_PICTURE' => $arSourcePicture,
            );
        }
        //vardump($arPicture);
        $arResult['arCertificates'][] = $arPicture;
    }
}
// <-- Сертификаты