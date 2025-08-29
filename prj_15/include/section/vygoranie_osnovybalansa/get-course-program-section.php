<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)	die();?>

<? $APPLICATION->IncludeComponent(
    "indexis:ajax.form",
    "get_materials_balance",
    array(
        "IBLOCK_ID" => Indexis::getIblockId("get_materials", "forms", "s1"),
        "IBLOCK_TYPE" => "forms",
        "RETURN_FIELDS" => "Y",
        "MINDBOX_TYPE" => "JS",
        "FORM_ID" => "materials_balance",
        "MINDBOX" => "mindboxGetMaterialsCourse",
        "FIELDS" => [
            "NAME" => ["CLEAR", "NOT_EMPTY"],
            "PROPERTY_EMAIL" => ["CLEAR", "NOT_EMPTY", "EMAIL"],
            //"PROPERTY_PHONE" => ["NOT_EMPTY", "PHONE"],
        ],
        "HANDLERS" => [
            "PROPERTY_COURSE" => "Эмоциональное выгорание. Основы баланса"
        ]
    )
); ?>
