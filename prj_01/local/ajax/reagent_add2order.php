<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?
CModule::IncludeModule('iblock');
?>
<?
$arResult = array();
$arResultFunc = CPersonal::isPartner();
$isPartner = $arResultFunc['isPartner'];
$arResult['RESULT'] = '';

if (!$USER->IsAuthorized() || !$isPartner) {
    $arResult['RESULT'] = 'ERROR';
    $arResult['ERROR'] = 'Нужно зарегистрироваться в качестве партнёра';
    $arResult['ERROR_TYPE'] = 'NEED_PARTNER_REG';
} else {
    $ELEMENT_ID = $_REQUEST["ELEMENT_ID"];
    $QUANTITY = $_REQUEST["QUANTITY"];
    if (intval($QUANTITY) < 1) {
        $QUANTITY = 1;
    }
    $IBLOCK_ID = Indexis::getIblockId('orders_reagents', 'orders');
    $USER_ID = $USER->GetID();
    $ACTION = $_REQUEST["ACTION"];

    if (intval($ELEMENT_ID) > 0 && intval($USER_ID) > 0 && intval($IBLOCK_ID) > 0) {

        // Статусы заказа -->
        $arStatuses = array();
        $property_enums = CIBlockPropertyEnum::GetList(
            array("DEF" => "DESC", "SORT" => "ASC"),
            array("IBLOCK_ID" => $IBLOCK_ID, "CODE" => "STATUS")
        );
        while ($enum_fields = $property_enums->GetNext()) {
            $arStatuses[$enum_fields["XML_ID"]] = $enum_fields;
        }
        // <-- Статусы заказа

        $arSelect = array("ID", "NAME", "PROPERTY_USER", "PROPERTY_REAGENT", "PROPERTY_COUNT", "PROPERTY_STATUS");
        $arFilter = array(
            "IBLOCK_ID" => $IBLOCK_ID,
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
            'PROPERTY_REAGENT' => $ELEMENT_ID,
            'PROPERTY_USER' => $USER_ID,
            'PROPERTY_STATUS' => $arStatuses['NEW']['ID'],
        );
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            //print_r($arFields);

            if ($ACTION == 'CHANGE_QUANTITY') {
                $newCount = $QUANTITY;
            } else {
                $newCount = intval($arFields['PROPERTY_COUNT_VALUE']) + $QUANTITY;
            }

            CIBlockElement::SetPropertyValueCode($arFields['ID'], "COUNT", $newCount);
            $arResult['RESULT'] = 'SUCCESS';
        } else {
            $el = new CIBlockElement;
            $PROPERTY_VALUES = array(
                'USER' => $USER_ID,
                'REAGENT' => $ELEMENT_ID,
                'COUNT' => $QUANTITY,
                'STATUS' => $arStatuses['NEW']['ID'],
            );
            $arLoadProductArray = array(
                "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела  
                "IBLOCK_ID"      => $IBLOCK_ID,
                "PROPERTY_VALUES" => $PROPERTY_VALUES,
                "NAME"           => $USER_ID . '-' . $ELEMENT_ID,
                "ACTIVE"         => "Y",            // активен  
            );
            if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                //echo "New ID: " . $PRODUCT_ID;
                //$arStatus['page'] = $arVebinarAPI['page'];
                $arResult['RESULT'] = 'SUCCESS';
            } else {
                //echo "Error: " . $el->LAST_ERROR . '<br />';
                $arResult['RESULT'] = 'ERROR';
                $arResult['ERROR'] = $el->LAST_ERROR;
            }
        }
    }
}
if ($arResult['RESULT'] == 'SUCCESS') {
    unset($_SESSION['PARTNER']['BASKET']['COUNT_ITEMS']);
}

echo json_encode($arResult);
?>

<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>