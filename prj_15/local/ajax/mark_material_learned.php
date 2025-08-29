<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');

$arResult = array();
if (!$USER->IsAuthorized()) {
    $arResult['RESULT'] = 'ERROR';
    $arResult['ERROR'] = 'Нужно авторизоваться';
} else {
    $ELEMENT_ID = $_REQUEST["ELEMENT_ID"];
    //$IBLOCK_ID = Indexis::getIblockId('articles', 'content');
    $IBLOCK_ID = $_REQUEST["IBLOCK_ID"];
    $USER_ID = $USER->GetID();

    if (intval($ELEMENT_ID) > 0 && intval($USER_ID) > 0 && intval($IBLOCK_ID) > 0) {
        //$arSelect = array("ID", "NAME", "PROPERTY_USERS");
        $arSelect = false;
        $arFilter = array(
            "IBLOCK_ID" => $IBLOCK_ID,
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
            'ID' => $ELEMENT_ID,
        );
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arFields['PROPERTIES'] = $ob->GetProperties();
            //print_r($arFields);

            $arUsersIds = $arFields['PROPERTIES']['USERS']['VALUE'];
            if (!is_array($arUsersIds)) {
                $arUsersIds = array();
            }
            if (!in_array($USER_ID, $arUsersIds)) {
                $arUsersIds[] = $USER_ID;
                CIBlockElement::SetPropertyValueCode($arFields['ID'], "USERS", $arUsersIds);
                $arResult['RESULT'] = 'SUCCESS';
            }
        }
    }
}

echo json_encode($arResult);

require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
