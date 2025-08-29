<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); 

$APPLICATION->IncludeComponent(
    "indexis:iblock.form",
    "review",
    array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "FORM_CODE" => 'reviews',
        "IBLOCK_ID" => Indexis::getIblockId('reviews', 'forms'),
        "IBLOCK_TYPE" => "forms",
        "PROPERTY_CODE" => array("NAME", "EMAIL", 'RATING', 'HEADER', 'TEXT', 'IMAGES', "HIDDEN_PRODUCT"),
        "EVENT_NAME" => "REVIEW_ADD",
        "DEFAULT_HIDDEN_PRODUCT" => $arParams['PRODUCT_ID'],
        'AJAX_MODE' => 'N',
        //"EDIT_AREA_ID" => $arParams['EDIT_AREA_ID'],
        //"BLOCK_AREA_ID" => $arParams['BLOCK_AREA_ID'],
    )
); 

require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>