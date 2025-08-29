<?php

use Bitrix\Sale;
use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Context;

Loader::includeModule('iblock');
Loader::includeModule('sale');

class IndexisEvents
{
    public static function ElementUpdater($arFields)
    {
        $ar_result = IndexisEvents::CalcMainProductInGroup(
            array(
                "ID" => $arFields['ID'],
                "IBLOCK_ID" => $arFields['IBLOCK_ID'],
            )
        );
    }
    public static function CalcMainProductInGroup($arParams)
    {
        $arResult = array();

        if (
            $arParams['IBLOCK_ID'] == $GLOBALS["arSiteConfig"]['IBLOCK']['CATALOG']['ID']
            && intval($arParams['ID']) > 0
        ) {
            // Значения свойства "Главный товар" -->
            $arMainProductEnumValues = array();
            $property_enums = CIBlockPropertyEnum::GetList(
                array("DEF" => "DESC", "SORT" => "ASC"),
                array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "CODE" => "MAIN_PRODUCT_GROUP")
            );
            while ($enum_fields = $property_enums->GetNext()) {
                $arMainProductEnumValues[$enum_fields['XML_ID']] = $enum_fields;
            }
            // <-- Значения свойства "Главный товар"

            //die();
            $arSelect = false;
            $arFilter = array(
                "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                "ACTIVE_DATE" => "Y",
                "ACTIVE" => "Y",
                "ID" => $arParams['ID']
            );
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            if ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arFields['PROPERTIES'] = $ob->GetProperties();
                $MAIN = $arFields['PROPERTIES']['MAIN_PRODUCT_GROUP']['VALUE_XML_ID'];
                if (strlen($MAIN) <= 0) {
                    $MAIN = 'N';
                }

                // Товары группы -->
                $arProductsGroup = [];
                $group_id = $arFields['PROPERTIES']['PRODUCTS_GROUP']['VALUE_ENUM_ID'];
                if (intval($group_id) > 0) {
                    $arSelect_2 = false;
                    $arFilter_2 = array(
                        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                        "ACTIVE_DATE" => "Y",
                        "ACTIVE" => "Y",
                        "PROPERTY_PRODUCTS_GROUP" => $group_id,
                    );
                    $res_2 = CIBlockElement::GetList(array(), $arFilter_2, false, false, $arSelect_2);
                    while ($ob_2 = $res_2->GetNextElement()) {
                        $arFields_2 = $ob_2->GetFields();
                        $arFields_2['PROPERTIES'] = $ob_2->GetProperties();

                        // Главный товар в группе -->
                        $MAIN_2 = $arFields_2['PROPERTIES']['MAIN_PRODUCT_GROUP']['VALUE_XML_ID'];
                        if (strlen($MAIN_2) <= 0) {
                            $MAIN_2 = 'N';
                        }
                        // <-- Главный товар в группе
                        //vardump($arFields['PROPERTIES']['COLOR_REF']);

                        // Текущий товар -->
                        $ACTIVE = 'N';
                        if ($arFields['ID'] == $arFields_2['ID']) {
                            $ACTIVE = 'Y';
                        }
                        // <--

                        $ar = array(
                            'ID' => $arFields_2['ID'],
                            'IBLOCK_ID' => $arFields_2['IBLOCK_ID'],
                            'MAIN' => $MAIN_2,
                            'ACTIVE' => $ACTIVE,
                        );

                        $arProductsGroup[$arFields_2['ID']] = $ar;
                    }
                }
                // <-- Товары группы

                // Установка флага "Главный товар" только одному товару -->
                //echo 'MAIN = '.$MAIN.'<br />';

                if ($MAIN == 'Y') {
                    foreach ($arProductsGroup as $el_id => $ar_el) {
                        //vardump($ar_el);
                        //echo 'ID = '.$arFields['ID'].'<br />';
                        if ($ar_el['MAIN'] == 'Y' && $ar_el['ID'] != $arFields['ID']) {
                            CIBlockElement::SetPropertyValuesEx(
                                $ar_el['ID'],
                                $ar_el['IBLOCK_ID'],
                                array('MAIN_PRODUCT_GROUP' => false)
                            );
                        }
                    }
                } else {
                    $bSetMainToCurProduct = true;
                    //vardump($arProductsGroup);
                    //echo 'ID = '.$arFields['ID'].'<br />';
                    foreach ($arProductsGroup as $el_id => $ar_el) {
                        if ($ar_el['ID'] != $arFields['ID']) {
                            if ($ar_el['MAIN'] == 'Y') {
                                $bSetMainToCurProduct = false;
                            }
                        }
                    }
                    //echo 'bSetMainToCurProduct = ' . $bSetMainToCurProduct . '<br />';
                    //die();
                    if ($bSetMainToCurProduct == true) {
                        CIBlockElement::SetPropertyValuesEx(
                            $arFields['ID'],
                            $arFields['IBLOCK_ID'],
                            array('MAIN_PRODUCT_GROUP' => $arMainProductEnumValues['Y']['ID'])
                        );
                    }
                }
                //die();
                // <-- Установка флага "Главный товар" только одному товару
            }
        }

        return $arResult;
    }
    /*
    function OnEpilogHandler()
    {
    }
    */

    /**
     * Делаем валидацию и группировку полей формы заказа
     */
    public static function OnSaleComponentOrderOneStepProcessHandler(&$arResult, &$arUserResult, $arParams)
    {
        global $USER;
        $arResult['IS_AUTHORIZED'] = $USER->IsAuthorized();

        $session = \Bitrix\Main\Application::getInstance()->getSession();

        $arResult['USER'] = [];
        $request = Context::getCurrent()->getRequest();
        $arResult['OPEN_BLOCKS'] = $request->getPost("order_blocks") ?? [
            'person_type',
            'delivery',
            'paysystem'
        ];

        $arResult['ORDER_PROP_GROUPED'] = [];
        foreach ($arResult["ORDER_PROP"] as $arOrderProps)
        {
            foreach ($arOrderProps as &$arOrderProp)
            {
                if (!isset($arOrderProp['GROUP_NAME']))
                    continue;

                if (isset($arResult['USER'][$arOrderProp['CODE']]) && mb_strlen($arResult['USER'][$arOrderProp['CODE']]) > 0)
                {
                    $arOrderProp['VALUE'] = $arResult['USER'][$arOrderProp['CODE']];
                    $arOrderProp['~VALUE'] = $arResult['USER'][$arOrderProp['CODE']];
                    $arOrderProp['VALUE_FORMATED'] = $arResult['USER'][$arOrderProp['CODE']];
                    $arOrderProp['~VALUE_FORMATED'] = $arResult['USER'][$arOrderProp['CODE']];
                }

                $arResult['ORDER_PROP_GROUPED'][$arOrderProp['GROUP_NAME']][] = $arOrderProp;
            }
        }

        $arResult['ERROR_BLOCKS'] = [];

        if ($request->getPost("confirmorder") == 'Y')
        {
            foreach ($arResult['ORDER_PROP_GROUPED'] as $groupName => &$arOrderPropGroup)
            {
                foreach ($arOrderPropGroup as $i => &$arOrderProp)
                {
                    $arOrderProp['VALIDATE'] = [
                        'HAS_ERROR' => 'N'
                    ];

                    $value = trim($arOrderProp['VALUE']);

                    if (in_array('Получатель', $arResult['OPEN_BLOCKS']))
                    {
                        if (strpos($arOrderProp['CODE'], 'RECIPIENT') !== false)
                            $arOrderProp['REQUIRED'] = 'Y';
                    }

                    if ($arOrderProp['REQUIRED'] == 'Y')
                    {
                        $arOrderProp['VALIDATE']['HAS_ERROR'] = (mb_strlen($value) == 0) ? 'Y' : 'N';
                        if ($arOrderProp['VALIDATE']['HAS_ERROR'] == 'Y')
                            $arOrderProp['VALIDATE']['MESSAGE'] = 'Поле не заполнено';
                    }

                    if ($arOrderProp['VALIDATE']['HAS_ERROR'] != 'Y' && $value !== '')
                    {
                        if (strpos($arOrderProp['CODE'], 'EMAIL') !== false)
                        {
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL))
                            {
                                $arOrderProp['VALIDATE']['HAS_ERROR'] = 'Y';
                                $arOrderProp['VALIDATE']['MESSAGE'] = 'Поле заполнено некорректно';
                            }
                        }
                        else if (strpos($arOrderProp['CODE'], 'PHONE') !== false)
                        {
                            $value = preg_replace('/[^0-9]/', '', $value);
                            if (!is_numeric($value) || strlen($value) != 11)
                            {
                                $arOrderProp['VALIDATE']['HAS_ERROR'] = 'Y';
                                $arOrderProp['VALIDATE']['MESSAGE'] = 'Поле заполнено некорректно';
                            }
                        }
                        else if ($arOrderProp['CODE'] == 'INN')
                        {
                            if (!is_numeric($value) || !in_array(strlen($value), [10, 12]))
                            {
                                $arOrderProp['VALIDATE']['HAS_ERROR'] = 'Y';
                                $arOrderProp['VALIDATE']['MESSAGE'] = 'Поле заполнено некорректно';
                            }
                        }
                        else if ($arOrderProp['CODE'] == 'KPP')
                        {
                            if (!is_numeric($value) || strlen($value) != 9)
                            {
                                $arOrderProp['VALIDATE']['HAS_ERROR'] = 'Y';
                                $arOrderProp['VALIDATE']['MESSAGE'] = 'Поле заполнено некорректно';
                            }
                        }

                        if (!$USER->IsAuthorized() && $arOrderProp['IS_EMAIL'] == 'Y')
                        {
                            $rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), array("=EMAIL" => $value));
                            if ($rsUsers->SelectedRowsCount() > 0)
                            {
                                $arOrderProp['VALIDATE']['HAS_ERROR'] = 'Y';
                                $arOrderProp['VALIDATE']['MESSAGE'] = '';
                                $arResult['HAS_USER'] = 'Y';
                            }
                        }
                    }

                    if ($arOrderProp['VALIDATE']['HAS_ERROR'] == 'Y' && !in_array($groupName, $arResult['ERROR_BLOCKS']))
                    {
                        $arResult['ERROR_BLOCKS'][] = $groupName;
                    }

                    if ($arOrderProp['VALIDATE']['HAS_ERROR'] == 'Y' && count($arResult['ERROR']) == 0)
                    {
                        $arResult['ERROR'][] = 'Форма заполнена некорректно';
                    }
                }
            }
        }
    }

    /**
     * Зачисляем бонусы после оплаты заказа
     */
    public static function OnSalePaymentEntitySavedHandler(\Bitrix\Main\Event $event)
    {
        $oldValues = $event->getParameter("VALUES");
        $payment = $event->getParameter("ENTITY");

        if ($oldValues["PAID"] == 'N' && $payment->getField('PAID') == 'Y') {
            if ($payment->getField('IS_RETURN') == 'N') {
                $order = \Bitrix\Sale\Order::load($payment->getField('ORDER_ID'));
                if ($order->getPersonTypeId() == 2) { // Бонусы зачисляем только для юр. лиц

                    // Проверяем, есть ли у текущего пользователя внутренний счет
                    $dbAccountCurrency = CSaleUserAccount::GetList(
                        array(),
                        array("USER_ID" => $order->getUserId(), "CURRENCY" => "RUB"),
                        false,
                        false,
                        array("CURRENT_BUDGET", "CURRENCY")
                    );
                    if ($dbAccountCurrency->SelectedRowsCount() == 0) {
                        // Если нет, то создаем внутренний счет
                        CSaleUserAccount::Add([
                            "USER_ID" => $order->getUserId(),
                            "CURRENCY" => "RUB",
                            "CURRENT_BUDGET" => 0
                        ]);
                    }

                    // Зачисляем бонусы на счет
                    $bonusSum = Indexis::getBonusValueByPrice($order->getPrice() - $order->getDeliveryPrice());
                    CSaleUserAccount::UpdateAccount(
                        $order->getUserId(),
                        $bonusSum,
                        "RUB",
                        "Начисление бонусов по заказу №" . $order->getId(),
                        $order->getId()
                    );

                    // Отправляем уведомление на почту о зачислении бонусов
                    $dbAccountCurrency = CSaleUserAccount::GetList(
                        array(),
                        array("USER_ID" => $order->getUserId(), "CURRENCY" => "RUB"),
                        false,
                        false,
                        array("CURRENT_BUDGET", "CURRENCY")
                    );

                    if ($arAccountCurrency = $dbAccountCurrency->Fetch()) {

                        $bonusResidual = ($GLOBALS['arSiteConfig']['BONUS_MIN_WITHDRAW'] - $arAccountCurrency["CURRENT_BUDGET"]);
                        $userEmail = '';
                        $propertyCollection = $order->getPropertyCollection();
                        if ($propUserEmail = $propertyCollection->getUserEmail()) {
                            $userEmail = $propUserEmail->getValue();
                        } else {
                            foreach ($propertyCollection as $orderProperty) {
                                if ($orderProperty->getField('CODE') == 'EMAIL') {
                                    $userEmail = $orderProperty->getValue();
                                    break;
                                }
                            }
                        }

                        $arEventFields = array(
                            'BONUS_SUM' => $bonusSum,
                            'BONUS_BALANCE' => round($arAccountCurrency["CURRENT_BUDGET"]),
                            'BONUS_RESIDUAL' => ($bonusResidual > 0 ? $bonusResidual : 0),
                            'EMAIL' => $userEmail,
                            'ORDER_ID' => $order->getId(),
                            'ACTION_TEXT' => ($bonusResidual > 0 ? 'Вам осталось накопить ' . $bonusResidual . ' бонусов, чтобы обменять их на карту OZON.' : 'Вы накопили достаточно бонусов, чтобы обменять их на карту OZON. Сделать это можно в личном кабинете на странице "Бонусы и скидки".'),
                            'BONUS_MIN_WITHDRAW' => $GLOBALS['arSiteConfig']['BONUS_MIN_WITHDRAW']
                        );

                        CEvent::Send("ADD_BONUS", "s1", $arEventFields);
                    }
                }
            }
        }
    }

    /**
     * Сохраняем в поисковом индексе только нужные поля
     */
    public static function BeforeIndexHandler($arFields)
    {
        if ($arFields['MODULE_ID'] == 'iblock' && $arFields['PARAM2'] == Indexis::getIblockId('catalog', 'catalog')) {
            $res = CIBlockElement::GetList(
                Array(),
                Array("IBLOCK_ID" => $arFields["PARAM2"], "ID" => $arFields["ITEM_ID"], "ACTIVE" => "Y"),
                false,
                false,
                array(
                    "ID",
                    "PROPERTY_CML2_ARTICLE",
                    "PROPERTY_PROIZVODITEL_EL",
                    "PROPERTY_PROIZVODITEL_EL.PROPERTY_SEARCH_NAME",
                    "PROPERTY_RUS_NAZVANIE",
                )
            );

            $arFields["BODY"] = '';

            if ($ob = $res->GetNextElement()) {
                $arElement = $ob->GetFields();

                $arPropToIndex = array_filter([
                    $arElement['PROPERTY_CML2_ARTICLE_VALUE'],
                    $arElement['PROPERTY_RUS_NAZVANIE_VALUE'],
                    $arElement['PROPERTY_PROIZVODITEL_EL_PROPERTY_SEARCH_NAME_VALUE']
                ]);

                $arFields["TITLE"] .= implode(' ', $arPropToIndex);
            }
        }

        return $arFields;
    }

    /**
     * Отправляем в Roistat данные пользователя
     */
    public static function onAfterResultAddHandler($WEB_FORM_ID, $RESULT_ID)
    {
        CFormResult::GetDataByID(
            $RESULT_ID,
            array(),
            $arForm,
            $arAnswer
        );

        $arAnswerTotal = [];
        foreach ($arAnswer as $answer) {
            $answer = reset($answer);
            $arAnswerTotal[$answer['SID']] = $answer;
        }

        $roistatData = [
            'roistat' => isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : 'nocookie',
            'title' => $arForm['NAME'],
            'name' => isset($arAnswerTotal['NAME']['USER_TEXT']) ? $arAnswerTotal['NAME']['USER_TEXT'] : '',
            'email' => isset($arAnswerTotal['EMAIL']['USER_TEXT']) ? $arAnswerTotal['EMAIL']['USER_TEXT'] : '',
            'phone' => isset($arAnswerTotal['PHONE']['USER_TEXT']) ? $arAnswerTotal['PHONE']['USER_TEXT'] : '',
            'key' => $GLOBALS['arSiteConfig']['ROISTAT']['KEY']
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://cloud.roistat.com/api/proxy/1.0/leads/add?' . http_build_query($roistatData));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $roistatResult = json_decode(curl_exec($ch), true);
        curl_close($ch);

//        file_put_contents(
//            $_SERVER['DOCUMENT_ROOT'] . '/upload/roistat_log.txt',
//            print_r([$roistatData, $roistatResult], true),
//            FILE_APPEND
//        );
    }

    /**
     * В письмо о заказе добавляем данные пользователя
     */
    public static function OnOrderNewSendEmailHandler($orderID, &$eventName, &$arFields)
    {
        $order = Sale\Order::load($orderID);
        $propertyCollection = $order->getPropertyCollection();

        foreach ($propertyCollection as $prop) {
            $data = $prop->getFieldValues();
            $arFields[$data['CODE']] = $data['VALUE'];
        }
    }
}
