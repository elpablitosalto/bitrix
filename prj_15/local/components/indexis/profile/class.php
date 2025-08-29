<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

error_reporting(E_ERROR);

use Bitrix\Main,
    Bitrix\Main\Loader,
    Bitrix\Main\Context,
    Bitrix\Main\Engine\Contract\Controllerable;


class PersonalProfile extends \CBitrixComponent implements Controllerable
{
    protected $arErrors = [];

    public function configureActions()
    {
        return [
            'profileSave' => [
                'prefilters' => [

                ],
            ],
            'passwordSave' => [
                'prefilters' => [

                ],
            ],
            'confirmEmail' => [
                'prefilters' => [

                ],
            ],
        ];
    }

    public function passwordSaveAction()
    {
        $this->GetUserData();
        $status = "";
        $this->arErrors = [];
        $request = Context::getCurrent()->getRequest();
        $arPost = $request->getPostList()->toArray();

        if (mb_strlen($arPost["old_pas"]) == 0)
            $this->arErrors["old_pas"][] = "Введите старый пароль";
        elseif (mb_strlen($arPost["new_pas"]) == 0)
            $this->arErrors["new_pas"][] = "Введите новый пароль";
        elseif ($arPost["new_pas"] != $arPost["new_pas_confirm"])
            $this->arErrors["new_pas_confirm"][] = "Повторённый пароль не совпадает";
        elseif (!\Bitrix\Main\Security\Password::equals($this->arResult["USER"]['PASSWORD'], $arPost["old_pas"]))
            $this->arErrors["old_pas"][] = "Неправильный старый пароль";

        if (empty($this->arErrors)) {
            $user = new CUser;
            $fields = array(
                "PASSWORD" => $arPost["new_pas"],
            );
            if ($user->Update($this->arParams["USER_ID"], $fields)) {
                $status = "ok";
            } else $this->arErrors["MAIN"][] = $user->LAST_ERROR;
        }

        return [
            "ERRORS" => $this->arErrors,
            "STATUS" => $status
            //"fields" => $fields,
        ];
    }

    public function confirmEmailAction()
    {
        Loader::includeModule('mindbox.marketing');
        $params["OPTIONS"] = \Mindbox\Options::getSDKOptions();
        $params["OPTIONS"]["PREFIX"] = \Mindbox\Options::getPrefix();
        $logger = new \Mindbox\Loggers\MindboxFileLogger($_SERVER["DOCUMENT_ROOT"] . "/upload/logs/");

        $mindbox = new \Mindbox\Mindbox([
            'endpointId' => $params["OPTIONS"]["endpointId"],
            'secretKey' => $params["OPTIONS"]["secretKey"],
            'domain' => $params["OPTIONS"]["domain"],
        ], $logger);

        $operation = new \Mindbox\DTO\V3\OperationDTO(
            [
                "customer" => [
                    "ids" => [
                        "websiteID" => $this->arParams["USER_ID"]
                    ]
                ]
            ]
        );

        $response = $mindbox->getClientV3()
            ->prepareRequest('POST', 'Website.ConfirmEmail', $operation, '', [], true, false)
            ->sendRequest();
        $requestBody = $response->getBody();

        if (isset($requestBody["status"]) && $requestBody["status"] == "Success") {
            $user = new CUser;
            $fields = array(
                "UF_EMAIL_CONFIRMED" => "Y",
            );
            $user->Update($this->arParams["USER_ID"], $fields);
            return "ok";
        }
        return "n";
    }

    public function profileSaveAction()
    {
        $this->GetUserData();
        $status = "";
        $this->arErrors = [];
        $request = Context::getCurrent()->getRequest();
        $arPost = $request->getPostList()->toArray();
        $validateFields = [
            "NAME" => ["REQUIRED", "CLEAR"],
            "LAST_NAME" => ["REQUIRED", "CLEAR"],
            //"SECOND_NAME" => ["REQUIRED","CLEAR"],
            "EMAIL" => ["REQUIRED", "NOT_EMPTY", "EMAIL"],
            "PERSONAL_PHONE" => ["REQUIRED", "PHONE"],
            "UF_SPECIALITY" => ["REQUIRED", "SPECIALITY"]
        ];
        foreach ($validateFields as $fieldCode => $fieldTypes) {
            if (isset($arPost[$fieldCode])) {
                $this->ValidateField($fieldTypes, $fieldCode, $arPost[$fieldCode]);
            } elseif (in_array("REQUIRED", $fieldTypes)) {
                $this->arErrors[$fieldCode][] = "Поле не должно быть пустым";
            }
        }

        if (empty($this->arErrors)) {
            $user = new CUser;
            $fields = array(
                "NAME" => $arPost["NAME"],
                "LAST_NAME" => $arPost["LAST_NAME"],
                //"SECOND_NAME" => $arPost["SECOND_NAME"],
                "EMAIL" => $arPost["EMAIL"],
                "LOGIN" => $arPost["EMAIL"],
                "PERSONAL_PHONE" => '+'.$arPost["PERSONAL_PHONE"],
                //"PERSONAL_PHONE" => str_replace( " ", "", $_POST["PERSONAL_PHONE"] ),
                //"PERSONAL_PHONE" => $_POST["PERSONAL_PHONE"],
                "UF_SPECIALITY" => $arPost["UF_SPECIALITY"],
                "UF_EMAIL_CONFIRMED" => ($arPost["EMAIL"] == $this->arResult["USER"]["EMAIL"] && $this->arResult["USER"]["UF_EMAIL_CONFIRMED"]) ? "Y" : false
            );
            if ($user->Update($this->arParams["USER_ID"], $fields)) {
                $status = "ok";

                Loader::includeModule('mindbox.marketing');
                $params["OPTIONS"] = \Mindbox\Options::getSDKOptions();
                $params["OPTIONS"]["PREFIX"] = \Mindbox\Options::getPrefix();
                $logger = new \Mindbox\Loggers\MindboxFileLogger($_SERVER["DOCUMENT_ROOT"] . "/upload/logs/");

                $mindbox = new \Mindbox\Mindbox([
                    'endpointId' => $params["OPTIONS"]["endpointId"],
                    'secretKey' => $params["OPTIONS"]["secretKey"],
                    'domain' => $params["OPTIONS"]["domain"],
                ], $logger);

                $operationData = [
                    "customer" => [
                        "ids" => [
                            "websiteID" => $this->arParams["USER_ID"]
                        ],
                        "lastName" => $arPost["LAST_NAME"],
                        "firstName" => $arPost["NAME"],
                        "email" => $arPost["EMAIL"],
                        "mobilePhone" => $arPost["PERSONAL_PHONE"],
                        "customFields" => ['specialty' => [$this->arResult["ENUMS"]["SPECIALITY"][$arPost["UF_SPECIALITY"]]["VALUE"]]]
                    ],
                ];
                if($arPost["EMAIL"] != $this->arResult["USER"]["EMAIL"] || $arPost["PERSONAL_PHONE"] != $this->arResult["USER"]["PERSONAL_PHONE"]){
                    $operationData["customer"]["ids"]["SFID"] = "%CLEAR%";
                }
                $operation = new \Mindbox\DTO\V3\OperationDTO($operationData);

                $response = $mindbox->getClientV3()
                    ->prepareRequest('POST', 'Website.EditCustomer', $operation, '', [], false)
                    ->sendRequest();

            } else $this->arErrors["MAIN"][] = $user->LAST_ERROR;
        }

        return [
            "ERRORS" => $this->arErrors,
            "STATUS" => $status,
            //"fields" => $fields,
            //"arPost" => $arPost,
            //"_POST  " => $_POST,
        ];
    }

    public function ValidateField(array $arFieldType, string $fieldCode, &$fieldVal)
    {
        foreach ($arFieldType as $fieldType) {
            switch ($fieldType) {
                case "NOT_EMPTY":
                    if (!$fieldVal) {
                        $this->arErrors[$fieldCode][] = "Поле не должно быть пустым";
                    }
                    break;
                case "CLEAR":
                    $fieldVal = trim(strip_tags($fieldVal));
                    break;
                case "EMAIL":
                    if (mb_strlen($fieldVal) > 0) {
                        if (!filter_var($fieldVal, FILTER_VALIDATE_EMAIL) || !preg_match('/@.+\./', $fieldVal)) {
                            $this->arErrors[$fieldCode][] = "Некорректный email";
                        }
                    }
                    break;
                case "PHONE":
                    if (mb_strlen($fieldVal) > 0) {
                        $fieldVal = preg_replace('/\D/', '', $fieldVal);
                        if (mb_strlen($fieldVal) < 11) {
                            $this->arErrors[$fieldCode][] = "Некорректный телефон";
                        }
                    }
                    break;
                case "SPECIALITY":
                    if (!is_string($fieldVal) || !isset($this->arResult["ENUMS"]["SPECIALITY"][$fieldVal])) {
                        $this->arErrors[$fieldCode][] = "Необходимо указать специальность";
                    }
                    break;
            }
        }
    }

    protected function GetUserData()
    {
        $this->arResult["USER"] = \CUser::GetByID($this->arParams["USER_ID"])->Fetch();
        if (!is_array($this->arResult["USER"]) || empty($this->arResult["USER"]) || $this->arResult["USER"]["ACTIVE"] != "Y")
            throw new Main\LoaderException("Wrong user");

        $obEnum = new \CUserFieldEnum;
        $rsEnum = $obEnum->GetList(array(), array("USER_FIELD_ID" => 1));
        $this->arResult["ENUMS"] = array();
        while ($arEnum = $rsEnum->Fetch()) {
            $this->arResult["ENUMS"]["SPECIALITY"][$arEnum["ID"]] = $arEnum;
        }
    }

    public function executeComponent()
    {
        try {

            $this->GetUserData();
            $this->includeComponentTemplate();

        } catch (Exception $e) {
            ShowError($e->getMessage());
        }
    }

    public function onPrepareComponentParams($arParams)
    {
        global $USER;
        $arParams["USER_ID"] = $USER->GetID();
        if ($arParams["USER_ID"] <= 0)
            throw new Main\LoaderException("Wrong user [0]");

        return $arParams;
    }
}