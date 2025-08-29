<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?
CModule::IncludeModule('iblock');
?>
<?
$arResult = array();
$arResultFunc = CPersonal::isPartner();
$isPartner = $arResultFunc['isPartner'];

if (!$USER->IsAuthorized() || !$isPartner) {
    $arResult['RESULT'] = 'ERROR';
    $arResult['ERROR'] = 'Нужно зарегистрироваться в качестве партнёра';
    $arResult['ERROR_TYPE'] = 'NEED_PARTNER_REG';
} else {
    $ELEMENT_ID = $_REQUEST["ELEMENT_ID"];
    $IBLOCK_ID = Indexis::getIblockId('orders_reagents', 'orders');
    $USER_ID = $USER->GetID();

    if (intval($ELEMENT_ID) > 0 && intval($USER_ID) > 0 && intval($IBLOCK_ID) > 0) {
        $arSelect = array("ID", "NAME", "PROPERTY_USER", "PROPERTY_REAGENT", "PROPERTY_COUNT", "PROPERTY_STATUS");
        $arFilter = array(
            "IBLOCK_ID" => $IBLOCK_ID,
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
            'PROPERTY_REAGENT' => $ELEMENT_ID,
            'PROPERTY_USER' => $USER_ID,
            //'PROPERTY_STATUS' => $arStatuses['NEW']['ID'],
        );
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();

            $DB->StartTransaction();
            if (!CIBlockElement::Delete($arFields['ID'])) {
                $arResult['RESULT'] = 'ERROR';
                $arResult['ERROR'] = 'Error!';
                $DB->Rollback();
            } else {
                $DB->Commit();
                $arResult['RESULT'] = 'SUCCESS';
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