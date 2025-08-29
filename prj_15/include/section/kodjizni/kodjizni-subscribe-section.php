<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>

<? $APPLICATION->IncludeComponent(
    "indexis:ajax.form",
    "subscribe_kodjizni",
    array(
        "IBLOCK_ID" => Indexis::getIblockId("subscribe_code_jizni", "forms", "s1"),
        "IBLOCK_TYPE" => "forms",
        "RETURN_FIELDS" => "Y",
        "MINDBOX_TYPE" => "JS",
        "MINDBOX" => "mindboxSubscriptionLifeCode",
        "FIELDS" => [
            "NAME" => ["CLEAR", "NOT_EMPTY", "EMAIL"],
        ],
    )
); ?>


