<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');

$arResult = array();
if (!$USER->IsAuthorized()) {
    $arResult['RESULT'] = 'ERROR';
    $arResult['ERROR'] = 'Нужно авторизоваться';
} else {
    $ELEMENT_ID = $_REQUEST["ELEMENT_ID"];
    $IBLOCK_ID = Indexis::getIblockId('saved_materials', 'service');
    $USER_ID = $USER->GetID();
    $ACTIVE = $_REQUEST["ACTIVE"];
    $MATERIAL_IBLOCK_ID = $_REQUEST["MATERIAL_IBLOCK_ID"];

    if (intval($ELEMENT_ID) > 0 && intval($USER_ID) > 0 && intval($IBLOCK_ID) > 0) {
        //$arSelect = array("ID", "NAME", "PROPERTY_USERS");
        $arSelect = false;
        $arFilter = array(
            "IBLOCK_ID" => $IBLOCK_ID,
            //"ACTIVE_DATE" => "Y",
            //"ACTIVE" => "Y",
            'PROPERTY_ARTICLE' => $ELEMENT_ID,
            'PROPERTY_USER' => $USER_ID,
        );
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            //$arFields['PROPERTIES'] = $ob->GetProperties();
            //print_r($arFields);

            $bUpdate = false;
            //if ($arFields['ACTIVE'] == 'Y' && $ACTIVE == 'N') {
            if (($ACTIVE == 'N' || $ACTIVE == 'Y') && $arFields['ACTIVE'] != $ACTIVE) {
                $bUpdate = true;
            }
            if ($bUpdate) {
                $el = new CIBlockElement;
                $res = $el->Update($arFields['ID'], array('ACTIVE' => $ACTIVE));
                $arResult['RESULT'] = 'SUCCESS';
            }
        } else {
            $el = new CIBlockElement;
            $PROPERTY_VALUES = array(
                'USER' => $USER_ID,
                'ARTICLE' => $ELEMENT_ID,
                'MATERIAL_IBLOCK_ID' => $MATERIAL_IBLOCK_ID,
                //'COUNT' => 1,
                //'STATUS' => $arStatuses['NEW']['ID'],
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

echo json_encode($arResult);

require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
