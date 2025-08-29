<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?
CModule::IncludeModule('iblock');
CModule::IncludeModule('form');
?>
<?
$arResult = array();
$arResultFunc = CPersonal::isPartner();
$isPartner = $arResultFunc['isPartner'];

$arResultFunc = CPersonal::getUser();
$arUser = $arResultFunc['arUser'];

$BUYER_LEGAL_ENTITY = $_REQUEST['BUYER_LEGAL_ENTITY'];
$BUYER_LEGAL_ENTITY = html_entity_decode($BUYER_LEGAL_ENTITY);

$FORM_ID = $GLOBALS['arSiteConfig']['WEB_FORM']['ORDERS'];

if (!$USER->IsAuthorized() || !$isPartner) {
    $arResult['RESULT'] = 'ERROR';
    $arResult['ERROR'] = 'Нужно зарегистрироваться в качестве партнёра';
    $arResult['ERROR_TYPE'] = 'NEED_PARTNER_REG';
} else {
    $bError = false;

    // Файл с заказом -->
    if (!$bError) {
        $arResultFunc = COrder::getOrderFile(array(
            'IBLOCK_ID_BASKET' => Indexis::getIblockId('orders_reagents', 'orders'),
            'USER_ID' => $arUser['ID'],
            'USER' => $arUser,
            'BUYER_LEGAL_ENTITY' => $BUYER_LEGAL_ENTITY,
        ));
        if ($arResultFunc['RESULT'] == 'SUCCESS') {
            $arOrderFile = CFile::MakeFileArray($arResultFunc['filePathFull']);
            $FILE_PATH_FULL = $arResultFunc['filePathFull'];
        } else {
            $bError = true;
            $arResult['RESULT'] = 'ERROR';
            $arResult['ERROR'] = $arResultFunc['ERROR'];
        }
    }
    // <-- Файл с заказом


    // Результат веб-формы -->
    if (!$bError) {
        $arValues = array(
            //"form_text_20" => 'КоМПАНИЯ',
            "form_text_20" => $arUser['WORK_COMPANY'],
            "form_text_21" => $BUYER_LEGAL_ENTITY,
            "form_file_22" => $arOrderFile,
        );
        if ($WEBFORM_RESULT_ID = CFormResult::Add($FORM_ID, $arValues)) {
            //echo "Результат #" . $RESULT_ID . " успешно создан";
            //$arResult['RESULT'] = 'SUCCESS';
        } else {
            global $strError;
            $arResult['RESULT'] = 'ERROR';
            $arResult['ERROR'] = $strError;
            $bError = true;
        }
    }
    // <-- Результат веб-формы

    // Сменим статус товаров в корзине -->
    if (!$bError) {
        $arResultFunc = COrder::changeStatusBasketItems(array(
            'IBLOCK_ID_BASKET' => Indexis::getIblockId('orders_reagents', 'orders'),
            'USER_ID' => $arUser['ID'],
            //'USER' => $arUser,
            //'BUYER_LEGAL_ENTITY' => $BUYER_LEGAL_ENTITY,
        ));
        if ($arResultFunc['RESULT'] == 'SUCCESS') {
            //$arOrderFile = CFile::MakeFileArray($arResultFunc['filePathFull']);
        } else {
            $bError = true;
            $arResult['RESULT'] = 'ERROR';
            $arResult['ERROR'] = $arResultFunc['ERROR'];
        }
    }
    // <-- Сменим статус товаров в корзине

    // Отправим письма -->
    if (!$bError) {
        $arResultFunc = COrder::sendMessages(array(
            'USER' => $arUser,
            'WEBFORM_RESULT_ID' => $WEBFORM_RESULT_ID,
            'FILE' => $FILE_PATH_FULL,
            'BUYER_LEGAL_ENTITY' => $BUYER_LEGAL_ENTITY,
            //'IBLOCK_ID_BASKET' => Indexis::getIblockId('orders_reagents', 'orders'),
            //'USER_ID' => $arUser['ID'],
            //'USER' => $arUser,
            //'BUYER_LEGAL_ENTITY' => $BUYER_LEGAL_ENTITY,
        ));
        if ($arResultFunc['RESULT'] == 'SUCCESS') {
            //$arOrderFile = CFile::MakeFileArray($arResultFunc['filePathFull']);
        } else {
            $bError = true;
            $arResult['RESULT'] = 'ERROR';
            $arResult['ERROR'] = $arResultFunc['ERROR'];
        }
    }
    // <-- Отправим письма

    if (!$bError) {
        $arResult['RESULT'] = 'SUCCESS';
    }
}

echo json_encode($arResult);
?>
<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>