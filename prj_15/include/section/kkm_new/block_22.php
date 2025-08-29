<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

            
<? $APPLICATION->IncludeComponent(
    "indexis:ajax.form",
    "get_consultation_kkm",
    array(
        "IBLOCK_ID" => Indexis::getIblockId("get_consultation_kkm", "forms", "s1"),
        "IBLOCK_TYPE" => "forms",
        "RETURN_FIELDS" => "Y",
        "MINDBOX_TYPE" => "JS",
        "FORM_ID" => "get_consultation_3",
        "MINDBOX" => "mindboxGetConsultKkm",
        "FIELDS" => [
            "NAME" => ["CLEAR", "NOT_EMPTY", "ONLY_CYRILLIC"],
            "PROPERTY_EMAIL" => ["CLEAR", "NOT_EMPTY", "EMAIL"],
            "PROPERTY_PHONE" => ["NOT_EMPTY", "PHONE"],
        ],
        "HANDLERS" => [
            //"PROPERTY_COURSE" => "Калгари-Кембриджская модель"
            "AGREE" => [
                "method_name" => "check_value",
                "method_params" => [
                    "VALUE" => "y",
                    "ERROR" => "Необходимо дать согласие на обработку персональных данных",
                ]
            ]
        ],
        "SEND_MESSAGE" => "Y",
        "MESSAGE_TEMPLATE" => "GET_CONSULTATION_KKM",
        'CHECK_PHONE' => 'N',
        'MODAL_ID' => 'consulting-application',
        'PHONE_MASK_INPUT_CLASS' => 'js_phone_country_kkm_1',
    )
); ?>
