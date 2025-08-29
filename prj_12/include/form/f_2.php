<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?$APPLICATION->IncludeComponent(
    "indexis:iblock.form",
    "f_2",
    Array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "FORM_CODE" => $arParams['FORM_CODE'],
        "IBLOCK_ID" => Indexis::getIblockId('f_2', 'forms'),
        "IBLOCK_TYPE" => "forms",
        "PROPERTY_CODE" => array("NAME", "PHONE", "HIDDEN_PAGE"),
        "EDIT_AREA_ID" => $arParams['EDIT_AREA_ID'],
        "BLOCK_AREA_ID" => $arParams['BLOCK_AREA_ID'],
        "EVENT_NAME" => "FORM_F2",
        "DEFAULT_HIDDEN_PAGE" => (CMain::IsHTTPS() ? "https://" : "http://") . SITE_SERVER_NAME . $APPLICATION->GetCurDir()
    )
);?>