<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');

$arResult = array();
if (!$USER->IsAuthorized()) {
    $arResult['RESULT'] = 'ERROR';
    $arResult['ERROR'] = 'Нужно авторизоваться';
} else {
    $ELEMENT_IDS = $_REQUEST["IDS"];
    //$IBLOCK_ID = Indexis::getIblockId('articles', 'content');
    //$IBLOCK_ID = $_REQUEST["IBLOCK_ID"];
    $USER_ID = $USER->GetID();
    $bGetData = false;
    //if (intval($USER_ID) > 0 && intval($IBLOCK_ID) > 0) {
    if (intval($USER_ID) > 0) {
        if (is_array($ELEMENT_IDS)) {
            if (count($ELEMENT_IDS) > 0) {
                $bGetData = true;
            }
        }
    }

    if ($bGetData) {
        //$arSelect = array("ID", "NAME", "PROPERTY_USERS");
        $arSelect = false;
        $arFilter = array(
            //"IBLOCK_ID" => $IBLOCK_ID,
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
            'ID' => $ELEMENT_IDS,
        );
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arFields['PROPERTIES'] = $ob->GetProperties();
            //print_r($arFields);
            $READ = 'N';

            $arUsersIds = $arFields['PROPERTIES']['USERS']['VALUE'];
            if (!is_array($arUsersIds)) {
                $arUsersIds = array();
            }
            if (in_array($USER_ID, $arUsersIds)) {
                $READ = 'Y';
            }

            $arResult['RESULT'] = 'SUCCESS';

            $arResult['ARTICLES'][$arFields['ID']]['READ'] = $READ;
        }
    }
}

echo json_encode($arResult);

require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
