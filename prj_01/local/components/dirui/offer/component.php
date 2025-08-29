<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CModule::IncludeModule('iblock');
CModule::IncludeModule('form');

$arResult['ERROR'] = array();
$FORM_ID = $GLOBALS['arSiteConfig']['WEB_FORM']['OFFERS'];

// Пользователь -->
$filter = array('ID' => $arParams['USER_ID']);
$rsUsers = CUser::GetList(($by = "personal_country"), ($order = "desc"), $filter);
while ($arUser = $rsUsers->Fetch()) {
    $arResult['USER'] = $arUser;
}
// <-- Пользователь

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['SEND'] == 'Y') {

    $arResultFunc = CPersonal::isPartner();
    $isPartner = $arResultFunc['isPartner'];

    if (!$USER->IsAuthorized() || !$isPartner) {
        $arResult['RESULT'] = 'ERROR';
        $arResult['ERROR'][] = 'Нужно зарегистрироваться в качестве партнёра';
    }

    // Валидация -->
    if (strlen($_POST['BUYER_LEGAL_ENTITY']) <= 0) {
        $arResult['ERROR'][] = 'Заполните название организации';
    }
    if (strlen($_POST['PRODUCT']) <= 0) {
        $arResult['ERROR'][] = 'Выберите оборудование';
    }
    // <-- Валидация 

    // Результат веб-формы -->
    if (empty($arResult['ERROR'])) {
        $arValues = array(
            "form_text_23" => $arResult['USER']['WORK_COMPANY'],
            "form_text_24" => $_POST['BUYER_LEGAL_ENTITY'],
            "form_text_25" => $_POST['PRODUCT'],
        );
        if ($WEBFORM_RESULT_ID = CFormResult::Add($FORM_ID, $arValues)) {
            //echo "Результат #" . $RESULT_ID . " успешно создан";
            //$arResult['RESULT'] = 'SUCCESS';
        } else {
            global $strError;
            $arResult['RESULT'] = 'ERROR';
            $arResult['ERROR'][] = $strError;
            $bError = true;
        }
    }
    // <-- Результат веб-формы

    // Письмо менеджеру -->
    if (empty($arResult['ERROR'])) {
        $arEventFields = array(
            'USER_LEGAL_ENTITY' => $arResult['USER']['WORK_COMPANY'],
            'BUYER_LEGAL_ENTITY' => $_POST['BUYER_LEGAL_ENTITY'],
            'DATE_SEND_FORM' => date('d.m.Y'),
            'NAME' => $arResult['USER']['NAME'],
            'LAST_NAME' => $arResult['USER']['LAST_NAME'],
            'TIME_SEND_FORM' => date('H:i'),
            'LINK_WEB_FORM_RESULT' => '/bitrix/admin/form_result_edit.php?lang=ru&WEB_FORM_ID=' . $FORM_ID . '&RESULT_ID=' . $WEBFORM_RESULT_ID . '&WEB_FORM_NAME=OFFERS',
        );
        $arFiles = array($arParams['FILE']);
        CEvent::Send('NEW_OFFER_MANAGER', SITE_ID, $arEventFields, 'Y', '', $arFiles);
    }
    // <-- Письмо менеджеру

    if (empty($arResult['ERROR'])) {
        $arResult['RESULT'] = 'SUCCESS';
    }
}

// Список оборудования -->
$arResult['PRODUCTS'] = array();
if (intval($arParams['IBLOCK_ID_PRODUCTS']) > 0) {
    $arSelect = false;
    $arFilter = array(
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        "IBLOCK_ID" => $arParams['IBLOCK_ID_PRODUCTS'],
    );
    $res = CIBlockElement::GetList(array('NAME' => 'ASC'), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        //$arFields['PROPERTIES'] = $ob->GetProperties();

        $arItem = array(
            'ID' => $arFields['ID'],
            'NAME' => $arFields['NAME'],
        );

        $arResult['PRODUCTS'][$arFields['ID']] = $arItem;
    }
}
// <-- Список оборудования




/*
$this->setResultCacheKeys(array(
    "ID",
    "IBLOCK_TYPE_ID",
    "LIST_PAGE_URL",
    "NAV_CACHED_DATA",
    "NAME",
    "SECTION",
    "ELEMENTS",
    "IPROPERTY_VALUES",
    "ITEMS_TIMESTAMP_X",
));
*/
$this->includeComponentTemplate();
