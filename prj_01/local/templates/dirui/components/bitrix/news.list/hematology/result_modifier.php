<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

/*
$arResult["SECTIONS"] = [];
$SectList = CIBlockSection::GetList( ["SORT" => "ASC", "ID" => "ASC"], array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"ACTIVE"=>"Y") ,false, array("ID","NAME"));
while ($SectListGet = $SectList->GetNext())
{
    $arResult["SECTIONS"][$SectListGet["ID"]]=$SectListGet;
}

foreach($arResult["ITEMS"] as $item){
    if($item["IBLOCK_SECTION_ID"] > 0){
        $arResult["SECTIONS"][$item["IBLOCK_SECTION_ID"]]["ITEMS"][] = $item;
    }
}
unset($arResult["ITEMS"]);
*/

// Список разделов -->
if (intval($arParams['IBLOCK_ID']) > 0) {
    $arResult['SECTIONS'] = array();

    $arSectionsIds = array();
    foreach ($arResult["ITEMS"] as $item) {
        $arSectionsIds[] = $item['IBLOCK_SECTION_ID'];
    }

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
            );
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