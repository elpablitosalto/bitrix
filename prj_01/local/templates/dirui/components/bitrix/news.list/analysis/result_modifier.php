<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

// Список разделов -->
if (intval($arParams['IBLOCK_ID']) > 0) {
    $arResult['SECTIONS'] = array();

    $arSectionsIds = array();
    foreach ($arResult["ITEMS"] as $item) {
        if (intval($item['IBLOCK_SECTION_ID']) > 0) {
            if (!in_array($item['IBLOCK_SECTION_ID'], $arSectionsIds)) {
                $arSectionsIds[] = $item['IBLOCK_SECTION_ID'];
            }

            $list = CIBlockSection::GetNavChain(false, $item['IBLOCK_SECTION_ID'], array(), true);
            foreach ($list as $arSectionPath) {
                //vardump($arSectionPath);
                if (!in_array($arSectionPath['ID'], $arSectionsIds)) {
                    $arSectionsIds[] = $arSectionPath['ID'];
                }
            }

            /*
            $nav = CIBlockSection::GetNavChain(false, $item['IBLOCK_SECTION_ID']);
            while ($nav->ExtractFields("nav_")) {
                $arSectionsIds[] = $nav_ID;
            }
            */
        }
    }

    //echo 'arSectionsIds = '.$arSectionsIds.'<br />';
    //vardump($arSectionsIds);

    if (!empty($arSectionsIds)) {
        $arFilter = array(
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            'ID' => $arSectionsIds,
        );
        $arSort = array("left_margin" => "asc");
        if (!empty($arParams['CUSTOM_SECTION_SORT'])) {
            $arSort = $arParams['CUSTOM_SECTION_SORT'];
        }
        $db_list = CIBlockSection::GetList($arSort, $arFilter, true);
        while ($ar_result = $db_list->GetNext()) {
            $arFile = CFile::GetFileArray($ar_result["PICTURE"]);
            $arResultLocal = Indexis::getImageFormatted(array(
                'RESIZE' => 'N',
                'FILE_VALUE' => $arFile,
                'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
                //'WIDTH' => 205,
                //'HEIGHT' => 116,
                'DEFAULT_ALT_TITLE' => $ar_result['NAME']
            ));

            $arResult['SECTIONS'][$ar_result['ID']] = array(
                'ID' => $ar_result['ID'],
                'NAME' => $ar_result['NAME'],
                'PICTURE' => $arResultLocal['PICTURE'],
                'DEPTH_LEVEL' => $ar_result['DEPTH_LEVEL'],
            );
            //echo 'DEPTH_LEVEL = '.$ar_result['DEPTH_LEVEL'].'<br />';
        }
    }
}
// <-- Список разделов

// Список товаров -->
if (intval($arParams['IBLOCK_ID']) > 0) {
    foreach ($arResult["ITEMS"] as $item) {
        //vardump($item['DISPLAY_PROPERTIES']);
        if ($item["IBLOCK_SECTION_ID"] > 0) {
            $arResult["SECTIONS"][$item["IBLOCK_SECTION_ID"]]["ITEMS"][] = $item;
        }
    }
    unset($arResult["ITEMS"]);
}
// <-- Список товаров

//vardump($arResult["SECTIONS"]);