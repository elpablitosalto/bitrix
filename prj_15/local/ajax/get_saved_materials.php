<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');

$arResult = array();
if (!$USER->IsAuthorized()) {
    $arResult['RESULT'] = 'ERROR';
    $arResult['ERROR'] = 'Нужно авторизоваться';
} else {
    $ELEMENT_IDS = $_REQUEST["IDS"];
    $IBLOCK_ID = Indexis::getIblockId('saved_materials', 'service');
    $USER_ID = $USER->GetID();
    $bGetData = false;
    if (intval($USER_ID) > 0 && intval($IBLOCK_ID) > 0) {
        if (is_array($ELEMENT_IDS)) {
            if (count($ELEMENT_IDS) > 0) {
                $bGetData = true;
            }
        }
    }

    if ($bGetData) {

        $arResult['RESULT'] = 'SUCCESS';

        foreach( $ELEMENT_IDS AS $elId )
        {
            $arResult['ARTICLES'][$elId]['SAVED'] = 'N';
        }

        $arSelect = array("ID", "NAME", "PROPERTY_ARTICLE");
        //$arSelect = false;
        $arFilter = array(
            "IBLOCK_ID" => $IBLOCK_ID,
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
            'PROPERTY_ARTICLE' => $ELEMENT_IDS,
            'PROPERTY_USER' => $USER_ID,
        );
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            //$arFields['PROPERTIES'] = $ob->GetProperties();
            //print_r($arFields);
            //$arResult['TEST'] = 'Y';
            $arResult['ARTICLES'][$arFields['PROPERTY_ARTICLE_VALUE']]['SAVED'] = 'Y';
        }
    }
}

echo json_encode($arResult);

require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
