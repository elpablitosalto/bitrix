<?

use Bitrix\Location\Repository\Location\Capability\IFindByText;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->__component->SetResultCacheKeys(array("NAME"));
$this->__component->SetResultCacheKeys(array("DISPLAY_PROPERTIES"));

// Слайдер -->
if (!empty($arResult['DISPLAY_PROPERTIES']['PICTURES_SLIDER']['FILE_VALUE'])) {
    if (!is_array($arResult['DISPLAY_PROPERTIES']['PICTURES_SLIDER']['FILE_VALUE'])) {
        $arResult['DISPLAY_PROPERTIES']['PICTURES_SLIDER']['FILE_VALUE'] = array($arResult['DISPLAY_PROPERTIES']['PICTURES_SLIDER']['FILE_VALUE']);
    }

    foreach ($arResult['DISPLAY_PROPERTIES']['PICTURES_SLIDER']['FILE_VALUE'] as $arFile) {
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arFile,
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arResult['NAME']
        ));
        $arResult['PICTURES_SLIDER'][] = $arResultLocal['PICTURE'];
    }
}
$arResult['VIDEO_SLIDER'] = array();
$arResult['VIDEO_SLIDER_POSTER'] = array();
if (!empty($arResult['DISPLAY_PROPERTIES']['VIDEO_SLIDER']['FILE_VALUE'])) {
    $arResult['VIDEO_SLIDER'] = $arResult['DISPLAY_PROPERTIES']['VIDEO_SLIDER']['FILE_VALUE'];
}
if (!empty($arResult['DISPLAY_PROPERTIES']['VIDEO_SLIDER_POSTER']['FILE_VALUE'])) {
    $arResult['VIDEO_SLIDER_POSTER'] = $arResult['DISPLAY_PROPERTIES']['VIDEO_SLIDER_POSTER']['FILE_VALUE'];
}

$arResult['SHOW_SLIDER'] = 'N';
if (!empty($arResult['PICTURES_SLIDER']) || !empty($arResult['VIDEO_SLIDER'])) {
    $arResult['SHOW_SLIDER'] = 'Y';
}
// <-- Слайдер

// Дизайнеры -->
$arResult['DESIGNERS'] = array();
if (!empty($arResult["DISPLAY_PROPERTIES"]["DE_TEXT_B"]["VALUE"]) && !empty($arParams['DESIGNERS_IBLOCK_ID'])) {
    $arSelect = array("ID", "NAME", "DETAIL_PAGE_URL");
    $arFilter = array(
        "IBLOCK_ID" => $arParams['DESIGNERS_IBLOCK_ID'],
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        "ID" => $arResult["DISPLAY_PROPERTIES"]["DE_TEXT_B"]["VALUE"],
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        $arResult['DESIGNERS'][$arFields['ID']] = array(
            'NAME' => $arFields['NAME'],
            'DETAIL_PAGE_URL' => $arFields['DETAIL_PAGE_URL'],
        );
    }
}
// <-- Дизайнеры

// Производитель -->
$arResult['MANUFACTER'] = array();
if (!empty($arResult["DISPLAY_PROPERTIES"]["M_TEXT_B"]["VALUE"]) && !empty($arParams['MANUFACTERS_IBLOCK_ID'])) {
    $arSelect = array("ID", "NAME", "DETAIL_PAGE_URL", 'PREVIEW_PICTURE');
    $arFilter = array(
        "IBLOCK_ID" => $arParams['MANUFACTERS_IBLOCK_ID'],
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        "ID" => $arResult["DISPLAY_PROPERTIES"]["M_TEXT_B"]["VALUE"],
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        $arFile = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arFile,
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arFields['NAME']
        ));

        $arResult['MANUFACTER'] = array(
            'NAME' => $arFields['NAME'],
            'DETAIL_PAGE_URL' => $arFields['DETAIL_PAGE_URL'],
            'PICTURE' => $arResultLocal['PICTURE']
        );
    }
}
// <-- Производитель


// Материалы -->
$arResult['MATERIALS'] = array();
if (!empty($arResult["DISPLAY_PROPERTIES"]["MATERIALS"]["VALUE"]) && !empty($arParams['MATERIALS_IBLOCK_ID'])) {

    $arSections = array();
    $arSelect = array('ID', 'NAME', 'SECTION_PAGE_URL', 'UF_TITLE_COLLS', 'UF_HEADER_COLLS');
    $arFilter = array('IBLOCK_ID' => $arParams['MATERIALS_IBLOCK_ID']);
    $rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, true, $arSelect);
    while ($arSection = $rsSections->Fetch()) {

        $header = $arSection['UF_HEADER_COLLS'];
        if (empty($header)) {
            $header = $arSection['NAME'];
        }

        $title = $arSection['UF_TITLE_COLLS'];
        if (empty($title)) {
            $title = 'Доступные материалы';
        }

        $arSection['SECTION_PAGE_URL'] = str_replace('#SECTION_ID#', $arSection['ID'], $arSection['SECTION_PAGE_URL']);

        $arSections[$arSection['ID']] = array(
            'NAME' => $arSection['NAME'],
            'SECTION_PAGE_URL' => $arSection['SECTION_PAGE_URL'],
            'TITLE' => $title,
            'HEADER' => $header,
        );
    }

    //$arMaterials = array();
    $arSelect = array("ID", "NAME", "DETAIL_PAGE_URL", 'PREVIEW_PICTURE', 'IBLOCK_SECTION_ID');
    $arFilter = array(
        "IBLOCK_ID" => $arParams['MATERIALS_IBLOCK_ID'],
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        "ID" => $arResult["DISPLAY_PROPERTIES"]["MATERIALS"]["VALUE"],
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        $arFile = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arFile,
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arFields['NAME']
        ));

        if (!empty($arFields['IBLOCK_SECTION_ID']) && !empty($arSections[$arFields['IBLOCK_SECTION_ID']])) {

            $arResult['MATERIALS'][$arFields['IBLOCK_SECTION_ID']]['SECTION'] = $arSections[$arFields['IBLOCK_SECTION_ID']];

            $arResult['MATERIALS'][$arFields['IBLOCK_SECTION_ID']]['ITEMS'][$arFields['ID']] = array(
                'NAME' => $arFields['NAME'],
                'DETAIL_PAGE_URL' => $arFields['DETAIL_PAGE_URL'],
                'PICTURE' => $arResultLocal['PICTURE'],
                'IBLOCK_SECTION_ID' => $arFields['IBLOCK_SECTION_ID']
            );
        }
    }
}
// <-- Материалы

// Изделия -->
$arResult['PRODUCTS'] = array();
if (!empty($arResult["DISPLAY_PROPERTIES"]["PRODUCTS"]["VALUE"]) && !empty($arParams['PRODUCTS_IBLOCK_ID'])) {

    $arSections = array();
    $arSelect = array('ID', 'NAME', 'SECTION_PAGE_URL', 'DETAIL_PICTURE');
    $arFilter = array('IBLOCK_ID' => $arParams['PRODUCTS_IBLOCK_ID']);
    $rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, true, $arSelect);
    while ($arSection = $rsSections->Fetch()) {
        //$arSection['SECTION_PAGE_URL'] = str_replace( '#SECTION_ID#', $arSection['ID'], $arSection['SECTION_PAGE_URL'] );

        $arFile = CFile::GetFileArray($arSection["DETAIL_PICTURE"]);
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arFile,
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arSection['NAME']
        ));

        // SECTION_PAGE_URL -->
        $list = CIBlockSection::GetNavChain(false, $arSection['ID'], array(), true);
        $chain = '';
        $i = 0;
        foreach ($list as $arSectionPath) {
            if ($i > 0) {
                $chain .= '/';
            }
            $chain .= $arSectionPath['CODE'];
            $i++;
        }
        $arSection['SECTION_PAGE_URL'] = str_replace('#SECTION_CODE_PATH#', $chain, $arSection['SECTION_PAGE_URL']);
        // <-- SECTION_PAGE_URL

        $arSections[$arSection['ID']] = array(
            'NAME' => $arSection['NAME'],
            'SECTION_PAGE_URL' => $arSection['SECTION_PAGE_URL'],
            'PICTURE' => $arResultLocal['PICTURE'],
        );
    }

    //$arMaterials = array();
    $arSelect = array("ID", "NAME", "DETAIL_PAGE_URL", 'PREVIEW_PICTURE', 'IBLOCK_SECTION_ID');
    $arFilter = array(
        "IBLOCK_ID" => $arParams['PRODUCTS_IBLOCK_ID'],
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        "ID" => $arResult["DISPLAY_PROPERTIES"]["PRODUCTS"]["VALUE"],
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        if (!empty($arFields['IBLOCK_SECTION_ID']) && !empty($arSections[$arFields['IBLOCK_SECTION_ID']])) {

            $arResult['PRODUCTS'][$arFields['IBLOCK_SECTION_ID']]['SECTION'] = $arSections[$arFields['IBLOCK_SECTION_ID']];

            $arResult['PRODUCTS'][$arFields['IBLOCK_SECTION_ID']]['ITEMS'][$arFields['ID']] = array(
                'NAME' => $arFields['NAME'],
                'DETAIL_PAGE_URL' => $arFields['DETAIL_PAGE_URL'],
                //'PICTURE' => $arResultLocal['PICTURE'],
                'IBLOCK_SECTION_ID' => $arFields['IBLOCK_SECTION_ID']
            );
        }
    }
}
// <-- Изделия


// Изделия, вариант №2 -->

$arSectionsAll = [];
$arSectionsEquals = [];
$arResult['SECTIONS'] = [];
if (!empty($arParams['PRODUCTS_IBLOCK_ID'])) {
    $arFilter = array(
        'IBLOCK_ID' => $arParams['PRODUCTS_IBLOCK_ID'],
        'GLOBAL_ACTIVE' => 'Y',
        'CNT_ACTIVE' => 'Y',
    );
    $db_list = CIBlockSection::GetList(array($by => $order), $arFilter, true);
    while ($ar_result = $db_list->GetNext()) {

        $arFile = CFile::GetFileArray($ar_result["DETAIL_PICTURE"]);
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => $arFile,
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $ar_result['NAME']
        ));

        // SECTION_PAGE_URL -->
        $list = CIBlockSection::GetNavChain(false, $ar_result['ID'], array(), true);
        $chain = '';
        $i = 0;
        foreach ($list as $arSectionPath) {
            if ($i > 0) {
                $chain .= '/';
            }
            $chain .= $arSectionPath['CODE'];
            $i++;
        }
        $ar_result['SECTION_PAGE_URL'] = str_replace('#SECTION_CODE_PATH#', $chain, $ar_result['SECTION_PAGE_URL']);

        $ar = array(
            'ID' => $ar_result['ID'],
            'NAME' => $ar_result['NAME'],
            'ELEMENT_CNT' => $ar_result['ELEMENT_CNT'],
            'IBLOCK_SECTION_ID' => $ar_result['IBLOCK_SECTION_ID'],
            'PICTURE' => $arResultLocal['PICTURE'],
            'SECTION_PAGE_URL' => $ar_result['SECTION_PAGE_URL'],
            'CNT' => 0,
        );

        $arSectionsAll[$ar_result['ID']] = $ar;

        if ($ar_result['NAME'] == $arResult['NAME']) {
            if (intval($ar_result['ELEMENT_CNT']) > 0) {
                $arSectionsEquals[$ar_result['ID']] = $ar;
            }
        }
    }
}
//vardump($arSectionsAll);
if (!empty($arSectionsEquals)) {
    foreach ($arSectionsEquals as $sId => $arS) {
        $arResult['SECTIONS'][$arS['IBLOCK_SECTION_ID']] = $arSectionsAll[$arS['IBLOCK_SECTION_ID']];
        $arResult['SECTIONS'][$arS['IBLOCK_SECTION_ID']]['SECTION_PAGE_URL'] = $arS['SECTION_PAGE_URL'];
    }
    foreach ($arSectionsEquals as $sId => $arS) {
        $arResult['SECTIONS'][$arS['IBLOCK_SECTION_ID']]['CNT'] += $arSectionsAll[$arS['ID']]['ELEMENT_CNT'];
    }
}

// <-- Изделия, вариант №2
