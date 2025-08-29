<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$item = $arParams['ITEM'];
$DOCTOR_ID = $item['DISPLAY_PROPERTIES']['F_10_DOCTOR']['VALUE'];
//vardump($item);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/form/f_10.php',
    array(
        "FORM_CODE" => "FORM_BLOCK_" . $arParams['ITEM']['ID'],
        "EDIT_AREA_ID" => $arParams['EDIT_AREA_ID'],
        "BLOCK_AREA_ID" => $arParams['BLOCK_AREA_ID'],
        "DOCTOR_ID" => $DOCTOR_ID,
    ),
    array('SHOW_BORDER' => false)
);
?>