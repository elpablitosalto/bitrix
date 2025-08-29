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
        ];
    }

    public function profileSaveAction()
    {
        $this->GetUserData();
        $status = "";
        $this->arErrors = [];
        $request = Context::getCurrent()->getRequest();
        $arPost = $request->getPostList()->toArray();
        $validateFields = [
            "NAME" => ["CLEAR"],
            "LAST_NAME" => ["CLEAR"],
            "EMAIL" => ["EMAIL"],
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
                "EMAIL" => $arPost["EMAIL"],
                "UF_SOC_COMPLETE" => "Y"
            );
            if ($user->Update($this->arParams["USER_ID"], $fields)) {
                $status = "ok";

            } else $this->arErrors["MAIN"][] = $user->LAST_ERROR;
        }

        return [
            "ERRORS" => $this->arErrors,
            "STATUS" => $status
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
            if($this->arResult["USER"]["EXTERNAL_AUTH_ID"] == "socservices" && $this->arResult["USER"]["UF_SOC_COMPLETE"] == false){
                $this->arResult['SHOW_WINDOW'] = "Y";
            }
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