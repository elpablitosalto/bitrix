<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main,
    \Bitrix\Main\Loader,
    \Bitrix\Main\Web\HttpClient,
    \Bitrix\Highloadblock as HL,
    \Bitrix\Main\Context;

class AjaxForm extends CBitrixComponent
{

    protected $postData = [];

    /**
     * @brief Перезаписать параметры
     * @return array $arParams
     **/
    public function onPrepareComponentParams($arParams)
    {
        $arParams["IBLOCK_ID"] = IntVal($arParams["IBLOCK_ID"]);

        $arParams["FORM_ID"] = (strlen($arParams["FORM_ID"])) ? $arParams["FORM_ID"] : "form_" . $arParams["IBLOCK_ID"];

        return $arParams;
    }

    /**
     * @brief Проверка подключаемых модулей
     **/
    protected function checkModules()
    {
        if (!Loader::includeModule('iblock'))
            throw new Main\LoaderException("Ошибка подключения инфоблока");
    }

    /**
     * @brief Установка поля
     * @param mixed $fieldVal новое значение
     * @param string $fieldCode код свойства
     **/
    protected function setField($fieldCode, $fieldVal)
    {
        if (mb_substr($fieldCode, 0, 9) == "PROPERTY_") {
            $code = mb_substr($fieldCode, 9);
            $this->arResult["DATA"]["PROPERTY_VALUES"][$code] = $fieldVal;
        } else {
            $this->arResult["DATA"][$fieldCode] = $fieldVal;
        }
    }

    /**
     * @brief Метод проверяет поле из post на статическое значение
     * @param string $fieldCode код свойства
     * @param array $params array
     * $params = [
     *   'VALUE' => (mixed) проверяемое значение
     *   'TO' => (string) свойство в которое уходит ошибка. По умолчанию родитель
     *   'ERROR' => (string) текст ошибки
     * ]
     **/
    protected function check_value($fieldCode, $params)
    {
        if ($this->postData[$fieldCode] != $params['VALUE']) {
            $error = ($params["ERROR"]) ? $params["ERROR"] : "Необходимо заполнить поле";
            $to = ($params["TO"]) ? $params["TO"] : $fieldCode;
            $this->arResult['ERRORS'][$to][] = $error;
        }
    }

    /**
     * @brief Метод ставит статическое значение поле из параметров
     * @param string $fieldCode код свойства
     **/
    protected function set_value($fieldCode, $params)
    {
        $this->setField($fieldCode, $params);
    }

    /**
     * @brief Валидация формы
     * @param array $arFieldType массив методов обработки
     * @param string $fieldCode код свойства
     * @param mixed $fieldVal значение свойства
     */
    protected function ValidateField($arFieldType = [], string $fieldCode, &$fieldVal)
    {
        global $DB;
        foreach ($arFieldType as $fieldType) {
            switch ($fieldType) {
                case "CLEAR":
                    $fieldVal = trim(strip_tags($fieldVal));
                    break;
                case "NOT_EMPTY":
                    if (!$fieldVal) {
                        $this->arResult['ERRORS'][$fieldCode][] = "Поле не должно быть пустым";
                    }
                    break;
                case "NOT_EMPTY_FILE":

                    if (mb_substr($fieldCode, 0, 9) == "PROPERTY_") {
                        $currentVal = $this->arResult["ELEMENT"]["PROPERTIES"][mb_substr($fieldCode, 9)]["VALUE"];
                    } else $currentVal = $this->arResult["ELEMENT"][$fieldCode];

                    if (!$fieldVal || $fieldVal != $currentVal) {
                        if (empty($_FILES[$fieldCode]) || $_FILES[$fieldCode]["size"] == 0) {
                            $this->arResult['ERRORS'][$fieldCode][] = "Поле не должно быть пустым";
                        }
                    }
                    break;
                case "FILE":

                    if (mb_substr($fieldCode, 0, 9) == "PROPERTY_") {
                        $currentVal = $this->arResult["ELEMENT"]["PROPERTIES"][mb_substr($fieldCode, 9)]["VALUE"];
                    } else $currentVal = $this->arResult["ELEMENT"][$fieldCode];

                    if ($_FILES[$fieldCode]["error"] == 0 && $_FILES[$fieldCode]["size"] > 0) {
                        $fieldVal = $_FILES[$fieldCode];
                        //не изменилось
                    } elseif ($fieldVal > 0 && $fieldVal == $currentVal) {
                        $fieldVal = false;
                    } else $fieldVal = ["del" => "y"];
                    break;
                case "ADRESS":
                    if (mb_strlen($fieldVal) > 0) {
                        $httpClient = new HttpClient(
                            ["waitResponse" => true]
                        );

                        $httpClient->setHeader('Content-Type', 'application/json', true);
                        $httpClient->setHeader('Authorization', "Token " . $this->dadata['TOKEN'], true);
                        $httpClient->setHeader('X-Secret', $this->dadata['SECRET'], true);

                        $query = \Bitrix\Main\Web\Json::encode([
                            $fieldVal
                        ]);
                        $response = $httpClient->post(
                            "https://cleaner.dadata.ru/api/v1/clean/address",
                            $query
                        );

                        $result = \Bitrix\Main\Web\Json::decode($response);
                        if (!is_set($result[0]['qc_geo']) || $result[0]['qc_geo'] > 2) {
                            $this->arResult['ERRORS'][$fieldCode][] = "Некорректный адрес";
                        }
                    }
                    break;
                case "CITY":
                    if (mb_strlen($fieldVal) > 0) {
                        $httpClient = new HttpClient(
                            ["waitResponse" => true]
                        );

                        $httpClient->setHeader('Content-Type', 'application/json', true);
                        $httpClient->setHeader('Authorization', "Token " . $this->dadata['TOKEN'], true);
                        $httpClient->setHeader('X-Secret', $this->dadata['SECRET'], true);

                        $query = \Bitrix\Main\Web\Json::encode([
                            $fieldVal
                        ]);
                        $response = $httpClient->post(
                            "https://cleaner.dadata.ru/api/v1/clean/address",
                            $query
                        );

                        $result = \Bitrix\Main\Web\Json::decode($response);
                        if ($result[0]['qc_geo'] != 4 && $result[0]['qc_geo'] != 3) {
                            $this->arResult['ERRORS'][$fieldCode][] = "Некорректный город";
                        }
                    }
                    break;
                case "TEXT":
                    if ($fieldVal) {
                        if (mb_strlen($fieldVal) == 0) {
                            $this->arResult['ERRORS'][$fieldCode][] = "Поле не должно быть пустым";
                        }
                    }
                    break;
                case "NUMBER":
                    if ($fieldVal) {
                        if (mb_strlen($fieldVal) == 0 || !is_numeric($fieldVal)) {
                            $this->arResult['ERRORS'][$fieldCode][] = "Поле не является числом";
                        }
                    }
                    break;
                case "EMAIL":
                    if ($fieldVal) {
                        if (!filter_var($fieldVal, FILTER_VALIDATE_EMAIL) || !preg_match('/@.+\./', $fieldVal)) {
                            $this->arResult['ERRORS'][$fieldCode][] = "Пример: example@domain.ru";
                        }
                    }
                    break;
                case "PHONE":
                    if ($fieldVal) {
                        $fieldVal = preg_replace('/\D/', '', $fieldVal);
                        if (mb_strlen($fieldVal) != 11) {
                            $this->arResult['ERRORS'][$fieldCode][] = "Некорректный телефон";
                        }
                    }
                    break;
                case "DATE":
                    if ($fieldVal) {
                        if (!$DB->IsDate($fieldVal, "DD.MM.YYYY HH:MI:SS")) {
                            $this->arResult['ERRORS'][$fieldCode][] = "Некорректная дата";
                        }
                    }
                    break;
                case "LIST":
                case "HL_LIST":
                    if ($fieldVal) {
                        $propOrigCode = mb_substr($fieldCode, 9);
                        if (empty($this->arResult["ENUMS"][$propOrigCode][$fieldVal])) {
                            $this->arResult['ERRORS'][$fieldCode][] = "Не указано значение";
                        }
                    }
                    break;
                case "USER_MULTIPLE":
                    if ($fieldVal && !is_array($fieldVal)) {
                        $this->arResult['ERRORS'][$fieldCode][] = "Неправильный формат пользователя";
                    } else {
                        foreach ($fieldVal as $userId) {
                            if (empty($this->arResult["USERS"][$userId])) {
                                $this->arResult['ERRORS'][$fieldCode][] = "Ошибка нахождения пользователя " . htmlspecialcharsbx($userId);
                            }
                        }
                    }
                    break;
                case "LINK_ELEMENT_MULTIPLE":
                    if ($fieldVal && !is_array($fieldVal)) {
                        $this->arResult['ERRORS'][$fieldCode][] = "Неправильный формат пользователя";
                    } else {
                        foreach ($fieldVal as $elID) {
                            if (empty($this->arResult["IBLOCK_ELEMENTS"][$this->arResult["PROPS_LINK_IBLOCK_ID"][$fieldCode]][$elID])) {
                                $this->arResult['ERRORS'][$fieldCode][] = "Ошибка нахождения элемента " . htmlspecialcharsbx($elID);
                            }
                        }
                    }
                    break;
                case "IBLOCK_SECTION_ID":
                    if ($fieldVal) {
                        if (empty($this->arResult["SECTIONS"][$fieldVal])) {
                            $this->arResult['ERRORS'][$fieldCode][] = "Неправильный раздел " . htmlspecialcharsbx($fieldVal);
                        }
                    }
                    break;
            }
        }
    }

    /**
     * @brief данные предыдущегго элемента
     **/
    protected function getElement($id)
    {
        $arFilter = array(
            "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
            "ID" => $id
        );
        $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 1));
        if ($ob = $res->GetNextElement()) {
            $this->arResult["ELEMENT"] = $ob->GetFields();
            $this->arResult["ELEMENT"]["PROPERTIES"] = $ob->GetProperties();
        }
    }

    /**
     * @brief Значения для свойств Список
     **/
    protected function getListProps()
    {
        $arListProps = [];
        foreach ($this->arParams["FIELDS"] as $fieldCode => $arFieldType) {
            if (in_array("LIST", $arFieldType)) {
                $arListProps[] = mb_substr($fieldCode, 9);
            }
        }

        if (!empty($arListProps)) {
            $rsEnums = \CIBlockPropertyEnum::GetList(["SORT" => "ASC", "VALUE" => "ASC"], [
                "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
                "CODE" => $arListProps
            ]);
            while ($enum_fields = $rsEnums->Fetch()) {
                $this->arResult["ENUMS"][$enum_fields["PROPERTY_CODE"]][$enum_fields["ID"]] = $enum_fields;
            }
        }

        $arHlListProps = [];
        foreach ($this->arParams["FIELDS"] as $fieldCode => $arFieldType) {
            if (in_array("HL_LIST", $arFieldType)) {
                $arHlListProps[] = mb_substr($fieldCode, 9);
            }
        }
        foreach ($arHlListProps as $propCode) {
            $properties = CIBlockProperty::GetList(array(), array("CODE" => $propCode, "IBLOCK_ID" => $this->arParams["IBLOCK_ID"]));
            if ($prop_fields = $properties->GetNext()) {
                if ($prop_fields["USER_TYPE_SETTINGS"]["TABLE_NAME"]) {
                    $obHighloadList = HL\HighloadBlockTable::getList(['filter' => ['=TABLE_NAME' => $prop_fields["USER_TYPE_SETTINGS"]["TABLE_NAME"]]])->fetch();
                    $obHighloadEntity = HL\HighloadBlockTable::compileEntity($obHighloadList);
                    $obHighloadClass = $obHighloadEntity->getDataClass();
                    $obHighloadClassList = $obHighloadClass::getList(array('select' => array('*')));
                    while ($arHighloadList = $obHighloadClassList->Fetch())
                        $this->arResult["ENUMS"][$propCode][$arHighloadList["UF_XML_ID"]] = $arHighloadList;
                }
            }
        }
    }

    /**
     * @brief Значения для свойств привязка к пользователю
     **/
    protected function getUserProps()
    {
        $getUserProps = false;
        foreach ($this->arParams["FIELDS"] as $fieldCode => $arFieldType) {
            if (in_array("USER", $arFieldType) || in_array("USER_MULTIPLE", $arFieldType)) {
                $getUserProps = true;
                break;
            }
        }

        if ($getUserProps) {
            $rsUsers = CUser::GetList(($by = "personal_country"), ($order = "desc"), ["ACTIVE" => "Y"], ["FIELDS" => ["ID", "NAME", "LAST_NAME", "EMAIL"]]);
            while ($arUser = $rsUsers->Fetch()) {
                $this->arResult["USERS"][$arUser["ID"]] = $arUser;
            }
        }
    }

    /**
     * @brief Значения для свойств привязка к элементам
     **/
    protected function getLinkElementsProps()
    {
        $linkElements = [];
        foreach ($this->arParams["FIELDS"] as $fieldCode => $arFieldType) {
            if (in_array("LINK_ELEMENT_MULTIPLE", $arFieldType)) {
                $linkElements[] = $fieldCode;
            }
        }

        if (!empty($linkElements)) {

            $this->arResult["PROPS_LINK_IBLOCK_ID"] = $this->arResult["IBLOCK_ELEMENTS"] = $filterIblock = [];
            $obProperty = CIBlockProperty::GetList(
                array("sort" => "asc"),
                array("ACTIVE" => "Y", "!LINK_IBLOCK_ID" => false, "PROPERTY_TYPE" => "E", "IBLOCK_ID" => $this->arParams['IBLOCK_ID'])
            );
            while ($arProperty = $obProperty->fetch()) {
                $this->arResult["PROPS_LINK_IBLOCK_ID"]["PROPERTY_" . $arProperty["CODE"]] = $arProperty["LINK_IBLOCK_ID"];
            }

            foreach ($linkElements as $linkProp) {
                if (isset($this->arResult["PROPS_LINK_IBLOCK_ID"][$linkProp]) && !in_array($this->arResult["PROPS_LINK_IBLOCK_ID"][$linkProp], $filterIblock)) {
                    $filterIblock[] = $this->arResult["PROPS_LINK_IBLOCK_ID"][$linkProp];
                }
            }

            if (!empty($filterIblock)) {
                $arSelect = array("ID", "IBLOCK_ID", "NAME");
                $arFilter = array("IBLOCK_ID" => $filterIblock, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
                $res = CIblockElement::GetList(array("NAME" => "ASC"), $arFilter, false, false, $arSelect);
                while ($ob = $res->Fetch()) {
                    $this->arResult["IBLOCK_ELEMENTS"][$ob["IBLOCK_ID"]][$ob["ID"]] = $ob;
                }
            }
        }
    }

    /**
     * @brief Значения разделов
     **/
    protected function getSections()
    {
        $getSections = false;
        foreach ($this->arParams["FIELDS"] as $fieldCode => $arFieldType) {
            if (in_array("SECTION", $arFieldType)) {
                $getSections = true;
                break;
            }
        }

        if ($getSections == true) {
            $rsSections = CIBlockSection::GetList(array('NAME' => 'ASC'), ["IBLOCK_ID" => $this->arParams["IBLOCK_ID"], "ACTIVE" => "Y", "ACTIVE_DATE" => "Y"], false, ["ID", "NAME"]);
            while ($arSection = $rsSections->Fetch()) {
                $this->arResult["SECTIONS"][$arSection["ID"]] = $arSection;
            }
        }
    }

    /**
     * @brief Создание лида в битрикс 24
     **/
    protected function createLead($mergedData = [], $formName = "Без названия")
    {

        if (empty($mergedData))
            return false;

        $arProps = [];
        $properties = CIBlockProperty::GetList(array("sort" => "asc", "name" => "asc"), array("ACTIVE" => "Y", "IBLOCK_ID" => $this->arParams["IBLOCK_ID"]));
        while ($prop_fields = $properties->GetNext()) {
            $arProps[$prop_fields["CODE"]] = $prop_fields;
        }
        $arProps["PREVIEW_TEXT"] = ["PREVIEW_TEXT" => "Сообщение"];
        $fullMessage = [
            $mergedData["NAME"]
        ];
        foreach ($arProps as $code => $arProp) {
            if (isset($mergedData[$code . "_ENUM"])) {
                $fullMessage[] = $arProp["NAME"] . " : " . $mergedData[$code . "_ENUM"];
            } elseif (isset($mergedData[$code])) {
                $fullMessage[] = $arProp["NAME"] . " : " . $mergedData[$code];
            }
        }

        if (!empty($fullMessage)) {
            $queryUrl = 'https://dorogakdomu.bitrix24.ru/rest/385/f4ltbogo4u7v91fs/crm.lead.add.json';
            $queryData = http_build_query(array(
                'fields' => array(
                    'TITLE' => 'Форма "' . $formName . '" сайта "Дорога к дому"',
                    'NAME' => 'Форма "' . $formName . '" сайта "Дорога к дому"',
                    "OPENED" => "Y",
                    "ASSIGNED_BY_ID" => 385,
                    "COMMENTS" => implode("<br>", $fullMessage)
                ),
                'params' => array("REGISTER_SONET_EVENT" => "N")
            ));
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_POST => 1,
                CURLOPT_HEADER => 0,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $queryUrl,
                CURLOPT_POSTFIELDS => $queryData,
            ));
            $result = curl_exec($curl);
        }
    }

    /**
     * @brief Капча
     **/
    protected function checkCaptcha()
    {
        $request = Context::getCurrent()->getRequest();
        $token = $request->get("smart-token");
        if (mb_strlen($token) > 0) {
            $ch = curl_init();
            $args = http_build_query([
                "secret" => "ysc2_dPA7yYYE1zOuLu20Zk5S9KqSyCjLeHulRPcLIvCWafdd3258",
                "token" => $token,
                "ip" => $_SERVER['REMOTE_ADDR'],
            ]);
            curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate?$args");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 1);

            $server_output = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpcode !== 200) {
                echo "Allow access due to an error: code=$httpcode; message=$server_output\n";
                $this->arResult['ERRORS']['MAIN'][] = "Allow access due to an error: code=$httpcode; message=$server_output";
            }

            $resp = json_decode($server_output);
            if ($resp->status != "ok") {
                $this->arResult['ERRORS']['MAIN'][] = "Ошибка прохождения капчи [1]";
            }
        } else {
            $this->arResult['ERRORS']['MAIN'][] = "Ошибка прохождения капчи";
        }
    }

    /**
     * @brief Основная логика
     **/
    protected function getResult()
    {
        //данные предыдущего элемента
        if ($this->arParams["ID"] > 0) {
            $this->getElement($this->arParams["ID"]);
        }

        //валидация
        $request = Context::getCurrent()->getRequest();
        if ($request->get("form_id") == $this->arParams["FORM_ID"]) {
            $this->arResult['ERRORS'] = [];
            $this->arResult["SUBMIT"] = true;

            if (check_bitrix_sessid()) {

                $this->postData = $request->getPostList()->toArray();

                foreach ($this->arParams["FIELDS"] as $fieldCode => $arFieldType) {
                    $this->ValidateField(
                        $arFieldType,
                        $fieldCode,
                        $this->postData[$fieldCode]
                    );
                }
            } else $this->arResult['ERRORS']['MAIN'][] = "Ошибка сессии. Обновите страницу и повторите попытку";

            if (isset($this->arParams["CHECK_CAPTCHA"]) && $this->arParams["CHECK_CAPTCHA"] == "Y") {
                $this->checkCaptcha();
            }

            if (empty($this->arResult['ERRORS'])) {

                //собираем данные для обновления/добавления
                $this->arResult["DATA"] = [
                    "IBLOCK_ID" => $this->arParams["IBLOCK_ID"]
                ];
                foreach ($this->arParams["FIELDS"] as $fieldCode => $arFieldType) {
                    if ($arFieldType[2] == "FILE") {
                        $this->setField($fieldCode, $_FILES[$fieldCode]);
                    } else {
                        $this->setField($fieldCode, $this->postData[$fieldCode]);
                    }
                }

                //дополнительные обработчики
                foreach ($this->arParams["HANDLERS"] as $fieldCode => $paramLogic) {
                    $bFlag = false;
                    if (is_array($paramLogic)) {
                        if (is_string($paramLogic["method_name"])) {
                            if (method_exists($this, $paramLogic["method_name"])) {
                                $bFlag = true;
                            }
                        }
                    }
                    if ($bFlag) {
                        $this->{$paramLogic["method_name"]}($fieldCode, $paramLogic["method_params"]);
                    } else {
                        $this->set_value($fieldCode, $paramLogic);
                    }
                }

                //символьный
                $code = Cutil::translit($this->arResult["DATA"]["NAME"], "ru", array("replace_space" => "-", "replace_other" => "-"));
                if ($this->arResult["ELEMENT"]["ID"]) {
                    $code .= "-" . $this->arResult["ELEMENT"]["ID"];
                } else {
                    $arFilter = array(
                        "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
                    );
                    $arSelect = [
                        "ID",
                    ];
                    $rsElements = CIBlockElement::GetList(array("ID" => "DESC"), $arFilter, false, ["nTopCount" => 1], $arSelect);
                    if ($arElement = $rsElements->GetNext()) {
                        $code .= "-" . ($arElement["ID"] + 1);
                    }
                }
                $this->arResult["DATA"]["CODE"] = $code;

                if (empty($this->arResult['ERRORS'])) {
                    $el = new \CIBlockElement;

                    //обновление
                    if ($this->arParams["ID"] > 0 && !empty($this->arResult["ELEMENT"])) {
                        if ($el->Update($this->arParams["ID"], $this->arResult["DATA"])) {
                            $this->arResult["ID"] = $this->arParams["ID"];
                        } else
                            $this->arResult['ERRORS']['MAIN'][] = $el->LAST_ERROR;
                        //новый
                    } else {
                        if ($PRODUCT_ID = $el->Add($this->arResult["DATA"])) {
                            $this->arResult["ID"] = $PRODUCT_ID;
                            //прокинем enum-ы в свойства, для дальнейших обработчиков
                            if (!empty($this->arResult["ENUMS"])) {
                                foreach ($this->arResult["ENUMS"] as $enumCode => $enumData) {
                                    if (!empty($this->arResult["DATA"]["PROPERTY_VALUES"][$enumCode])) {
                                        $this->arResult["DATA"]["PROPERTY_VALUES"][$enumCode . "_ENUM"] = $enumData[$this->arResult["DATA"]["PROPERTY_VALUES"][$enumCode]]["VALUE"];
                                        $this->arResult["DATA"]["PROPERTY_VALUES"][$enumCode . "_XML_ID"] = $enumData[$this->arResult["DATA"]["PROPERTY_VALUES"][$enumCode]]["XML_ID"];
                                    }
                                }
                            }
                            //если необходимо вернуть какие-то поля обратно в js, после обработки
                            $this->arResult["RETURN_FIELDS"] = [
                                'sessid' => bitrix_sessid()
                            ];
                            if (isset($this->arParams["RETURN_FIELDS"]) && !empty($this->arParams["RETURN_FIELDS"])) {
                                foreach ($this->arParams["RETURN_FIELDS"] as $fieldCode) {
                                    if (mb_substr($fieldCode, 0, 9) == "PROPERTY_") {
                                        $propCode = mb_substr($fieldCode, 9);
                                        $this->arResult["RETURN_FIELDS"][$fieldCode] = $this->arResult["DATA"]["PROPERTY_VALUES"][$propCode];
                                        if (isset($this->arResult["DATA"]["PROPERTY_VALUES"][$propCode . "_ENUM"])) {
                                            $this->arResult["RETURN_FIELDS"][$fieldCode . "_ENUM"] = $this->arResult["DATA"]["PROPERTY_VALUES"][$propCode . "_ENUM"];
                                            $this->arResult["RETURN_FIELDS"][$fieldCode . "_XML_ID"] = $this->arResult["DATA"]["PROPERTY_VALUES"][$propCode . "_XML_ID"];
                                        }
                                    } else $this->arResult["RETURN_FIELDS"][$fieldCode] = $this->arResult["DATA"][$fieldCode];
                                }
                            }

                            /*
                            $mergedData = array_merge([
                                "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
                                "ID" => $this->arResult["DATA"]["ID"],
                                "NAME" => $this->arResult["DATA"]["NAME"],
                                "PREVIEW_TEXT" => $this->arResult["DATA"]["PREVIEW_TEXT"],
                            ], $this->arResult["DATA"]["PROPERTY_VALUES"]);
                            */
                            $mergedData = [
                                "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
                                "ID" => $this->arResult["DATA"]["ID"],
                                "NAME" => $this->arResult["DATA"]["NAME"],
                                "PREVIEW_TEXT" => $this->arResult["DATA"]["PREVIEW_TEXT"],
                            ];
                            foreach ($this->arResult["DATA"]["PROPERTY_VALUES"] as $k => $v) {
                                if (empty($mergedData[$k])) {
                                    $mergedData[$k] = $v;
                                }
                            }

                            /*
                            //vardump($mergedData);
                            $this->arResult["RETURN_FIELDS"]["TEST_NAME"] = $mergedData["NAME"];
                            $this->arResult["RETURN_FIELDS"]["TEST"] = "TEST";
                            $this->arResult["RETURN_FIELDS"]["TEST_NAME_POST"] = $this->postData["NAME"];
                            $this->arResult["RETURN_FIELDS"]["TEST_NAME_DATA"] = $this->arResult["DATA"]["NAME"];
                            */

                            // Если отправка заявки на конкурс -->
                            $arMessageParams = $mergedData;
                            if ($this->arParams["SEND_MESSAGE"] == "REG_COMPETITION") {
                                $res = CIBlockElement::GetList(array(), array("ID" => $this->arResult["ID"]), false, false, false);
                                if ($ob = $res->GetNextElement()) {
                                    $arFields = $ob->GetFields();
                                    $arFields["PROPERTIES"] = $ob->GetProperties();
                                    foreach ($arFields['PROPERTIES'] as $prop) {
                                        if (
                                            (is_array($prop["VALUE"]) && count($prop["VALUE"]) > 0)
                                            || (!is_array($prop["VALUE"]) && $prop["VALUE"] <> '')
                                        ) {
                                            $arFields["DISPLAY_PROPERTIES"][$prop['CODE']] = CIBlockFormatProperties::GetDisplayValue($arFields, $prop);
                                        }
                                    }
                                    $arMessageParams["FILE_URL_APPL"] = "https://" . SITE_SERVER_NAME . $arFields["DISPLAY_PROPERTIES"]["APPL"]["FILE_VALUE"]["SRC"];
                                    $arMessageParams["FILE_URL_APPL_CONFIRM"] = "https://" . SITE_SERVER_NAME . $arFields["DISPLAY_PROPERTIES"]["APPL_CONFIRM"]["FILE_VALUE"]["SRC"];
                                    $arMessageParams["FILE_URL_BUDGET"] = "https://" . SITE_SERVER_NAME . $arFields["DISPLAY_PROPERTIES"]["BUDGET"]["FILE_VALUE"]["SRC"];
                                    $arMessageParams["FILE_URL_ART_ASSOC"] = "https://" . SITE_SERVER_NAME . $arFields["DISPLAY_PROPERTIES"]["ART_ASSOC"]["FILE_VALUE"]["SRC"];
                                }
                            }
                            //$this->arResult["RETURN_FIELDS"]["TEST"] = json_encode($arMessageParams);
                            // <-- 


                            //отправка сообщения
                            if ($this->arParams["SEND_MESSAGE"]) {
                                //добавим списковые значения
                                CEvent::Send($this->arParams["SEND_MESSAGE"], SITE_ID, $arMessageParams);
                            }

                            //создаём лид
                            /*if (isset($this->arParams["CREATE_LEAD"])) {
                                $this->createLead($mergedData, $this->arParams["CREATE_LEAD"]);
                            }*/
                        } else
                            $this->arResult['ERRORS']['MAIN'][] = $el->LAST_ERROR;
                    }

                    //получим текущий url
                    if ($this->arResult["ID"] > 0 && empty($this->arResult['ERRORS'])) {
                        $rsElements = CIBlockElement::GetList(array("ID" => "DESC"), ["IBLOCK_ID" => $this->arParams["IBLOCK_ID"], "ID" => $this->arResult["ID"]], false, ["nTopCount" => 1], ["ID", "DETAIL_PAGE_URL"]);
                        if ($arElement = $rsElements->GetNext()) {
                            $this->arResult["URL"] = $arElement["DETAIL_PAGE_URL"];
                        }
                    }
                }
            }
        }
    }


    public function executeComponent()
    {
        try {

            $this->checkModules();
            $this->getListProps();
            $this->getUserProps();
            $this->getLinkElementsProps();
            $this->getSections();
            $this->getResult();

            if ($this->arResult["SUBMIT"] == true) {
                $GLOBALS['APPLICATION']->RestartBuffer();
                header('Content-Type: application/json; charset=utf-8');
                echo \Bitrix\Main\Web\Json::encode([
                    "RESULT" => ($this->arParams["DEBUG"] == "Y") ? $this->arResult : false,
                    "ID" => intval($this->arResult["ID"]),
                    "URL" => $this->arResult["URL"],
                    "ERRORS" => $this->arResult['ERRORS'],
                    "CODE" => $this->arResult["DATA"]["CODE"],
                    "RETURN_FIELDS" => (isset($this->arResult["RETURN_FIELDS"])) ? $this->arResult["RETURN_FIELDS"] : [],
                ]);
                die();
            } else $this->includeComponentTemplate();
        } catch (Exception $e) {
            ShowError($e->getMessage());
        }
    }
};
