<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$item = $arParams['ITEM'];
//vardump($item);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/form/dev_535.php',
    array(
        "FORM_CODE" => "FORM_BLOCK_" . $arParams['ITEM']['ID'],
        "EDIT_AREA_ID" => $arParams['EDIT_AREA_ID'],
        "BLOCK_AREA_ID" => $arParams['BLOCK_AREA_ID'],
        "PICTURE" => CFile::GetFileArray( $item['DISPLAY_PROPERTIES']['DEV_535_PICTURE']['VALUE'] ),
        "ITEMS" => $item['DISPLAY_PROPERTIES']['DEV_535_ITEMS']['VALUE'],
        "CLINIC_PHONE" => "+7 (495) 783-66-06",
        "arHeaders" => array(
            "H_FST_PART_D" => $item["H_FST_PART_D"],
            "H_SEC_PART_D" => $item["H_SEC_PART_D"],
            "H_FST_PART_M" => $item["H_FST_PART_M"],
            "H_SEC_PART_M" => $item["H_SEC_PART_M"],
        ),
    ),
    array('SHOW_BORDER' => false)
);
?>