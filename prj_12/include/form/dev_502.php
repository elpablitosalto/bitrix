<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?
$APPLICATION->IncludeComponent(
    "indexis:iblock.form",
    "dev_502",
    Array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "FORM_CODE" => $arParams['FORM_CODE'],
        "IBLOCK_ID" => Indexis::getIblockId('dev_502', 'forms'),
        "IBLOCK_TYPE" => "forms",
        //"PROPERTY_CODE" => array("NAME", "PHONE", "HIDDEN_PAGE"),
        "PROPERTY_CODE" => array("PHONE"),
        "EVENT_NAME" => "FORM_DEV_502",
        "DEFAULT_HIDDEN_PAGE" => (CMain::IsHTTPS() ? "https://" : "http://") . SITE_SERVER_NAME . $APPLICATION->GetCurDir(),
        "EDIT_AREA_ID" => $arParams['EDIT_AREA_ID'],
        "BLOCK_AREA_ID" => $arParams['BLOCK_AREA_ID'],
    )
);?>