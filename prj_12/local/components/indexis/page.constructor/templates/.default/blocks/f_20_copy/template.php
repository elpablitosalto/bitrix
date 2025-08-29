<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/form/f_20_copy.php',
    array(
        "FORM_CODE" => "FORM_BLOCK_" . $arParams['ITEM']['ID'],
        "EDIT_AREA_ID" => $arParams['EDIT_AREA_ID'],
        "BLOCK_AREA_ID" => $arParams['BLOCK_AREA_ID'],
    ),
    array('SHOW_BORDER' => false)
);
?>