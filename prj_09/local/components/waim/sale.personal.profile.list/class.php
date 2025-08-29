<?php

/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage sale
 * @copyright 2001-2016 Bitrix
 */

use Bitrix\Main,
    Bitrix\Sale,
	Bitrix\Main\Localization\Loc,
    Bitrix\Sale\Internals,
	Bitrix\Main\Loader;
use Bitrix\Main\Errorable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class CustomPersonalProfileList extends CBitrixComponent implements Controllerable, Errorable
{
	const E_SALE_MODULE_NOT_INSTALLED 		= 10000;
	const E_NOT_AUTHORIZED					= 10001;

	/** @var  Main\ErrorCollection $errorCollection*/
	protected $errorCollection;

    public function getErrors(): array
    {
        return $this->errorCollection->toArray();
    }

    public function getErrorByCode($code): Error
    {
        return $this->errorCollection->getErrorByCode($code);
    }

    /**
     * Конфигуратор действий
     * @return array
     */
    public function configureActions(): array
    {
        return [
            'updateProfile' => [
                'prefilters' => [
                    new ActionFilter\Authentication(), // проверяет авторизован ли пользователь
                ]
            ],
            'deleteProfile' => [
                'prefilters' => [
                    new ActionFilter\Authentication(), // проверяет авторизован ли пользователь
                ]
            ],
        ];
    }

	/**
	 * Function checks and prepares all the parameters passed. Everything about $arParam modification is here.
	 * @param mixed[] $params List of unchecked parameters
	 * @return mixed[] Checked and valid parameters
	 */
	public function onPrepareComponentParams($params)
	{
		$this->errorCollection = new Main\ErrorCollection();

		if(!Main\Loader::includeModule("sale")){
            throw new \Exception("Не установлены необходимые модули!");
        }

		$params["PATH_TO_DETAIL"] = trim($params["PATH_TO_DETAIL"]);

		if ($params["PATH_TO_DETAIL"] == '')
		{
			$params["PATH_TO_DETAIL"] = htmlspecialcharsbx(Main\Context::getCurrent()->getRequest()->getRequestedPage()."?ID=#ID#");
		}

		$params["PER_PAGE"] = ((int)($params["PER_PAGE"]) <= 0 ? 20 : (int)($params["PER_PAGE"]));

		return $params;
	}

	public function executeComponent()
	{
		global $APPLICATION, $USER;

		Loc::loadMessages(__FILE__);

		$this->setFrameMode(false);

		$this->checkRequiredModules();

		$this->arResult['ERRORS'] = array();
		if (!$USER->IsAuthorized())
		{
			if(!$this->arParams['AUTH_FORM_IN_TEMPLATE'])
			{
				$this->arResult['USER_IS_NOT_AUTHORIZED'] = 'Y';
				$APPLICATION->AuthForm(GetMessage("SALE_ACCESS_DENIED"), false, false, 'N', false);
			}
			else
			{
				$this->arResult['ERRORS'][self::E_NOT_AUTHORIZED] = GetMessage("SALE_ACCESS_DENIED");
			}
		}

		if($this->arParams["SET_TITLE"] == 'Y')
			$APPLICATION->SetTitle(GetMessage("SPPL_DEFAULT_TITLE"));

		$request = Main\Context::getCurrent()->getRequest();

		$errorMessage = "";
		$deleteElementId = (int)($request->get("del_id"));
		if ($deleteElementId > 0 && check_bitrix_sessid())
		{
			$dbUserProps = CSaleOrderUserProps::GetList(
				array(),
				array(
					"ID" => $deleteElementId,
					"USER_ID" => (int)($USER->GetID())
				)
			);
			if ($arUserProps = $dbUserProps->Fetch())
			{
				if (!CSaleOrderUserProps::Delete($arUserProps["ID"]))
				{
					$errorMessage = GetMessage("SALE_DEL_PROFILE");
				}
			}
			else
			{
				$errorMessage = GetMessage("SALE_NO_PROFILE");
			}
			if($errorMessage <> '')
				LocalRedirect($APPLICATION->GetCurPageParam("del_id=".$deleteElementId, Array("del_id", "sessid")));
			else
				LocalRedirect($APPLICATION->GetCurPageParam("success_del_id=".$deleteElementId, Array("del_id", "sessid")));
		}

		if((int)($_REQUEST["del_id"]) > 0)
			$errorMessage = GetMessage("SALE_DEL_PROFILE", array("#ID#" => (int)($_REQUEST["del_id"])));
		elseif((int)($_REQUEST["success_del_id"]) > 0)
			$errorMessage = GetMessage("SALE_DEL_PROFILE_SUC", array("#ID#" => (int)($_REQUEST["success_del_id"])));

		if($errorMessage <> '')
		{
			$this->arResult["ERROR_MESSAGE"] = $errorMessage;
			$this->arResult['ERRORS'][] = $errorMessage;
		}

		$by = ($_REQUEST["by"] <> '' ? $_REQUEST["by"]: "DATE_UPDATE");
		$order = ($_REQUEST["order"] <> '' ? $_REQUEST["order"]: "DESC");

		$dbUserProps = CSaleOrderUserProps::GetList(
			array($by => $order),
			array("USER_ID" => (int)($GLOBALS["USER"]->GetID()))
		);
		$dbUserProps->NavStart($this->arParams["PER_PAGE"]);
		$this->arResult["NAV_STRING"] = $dbUserProps->GetPageNavString(GetMessage("SPPL_PAGES"));
		$this->arResult["PROFILES"] = Array();
		while($arUserProps = $dbUserProps->GetNext())
		{
			$arResultTmp = $arUserProps;
            $saleOrderUserPropertiesValue = new CSaleOrderUserPropsValue;
            $userPropertiesList = $saleOrderUserPropertiesValue::GetList(
                array("SORT" => "ASC"),
                array("USER_PROPS_ID" => $arUserProps["ID"]),
                false,
                false
            );

            while ($propertyValues = $userPropertiesList->Fetch())
            {
                $arResultTmp["PROPS"][$propertyValues["ORDER_PROPS_ID"]] = [
                    "ID" => $propertyValues["ORDER_PROPS_ID"],
                    "NAME" => $propertyValues["NAME"],
                    "VALUE" => $propertyValues["VALUE"]
                ];
            }
			$personTypeList = Bitrix\Sale\PersonType::load(SITE_ID, $arUserProps["PERSON_TYPE_ID"]);
			$arResultTmp["PERSON_TYPE"] = $personTypeList[$arUserProps["PERSON_TYPE_ID"]];
			$arResultTmp["PERSON_TYPE"]["NAME"] = htmlspecialcharsEx($arResultTmp["PERSON_TYPE"]["NAME"]);

			$arResultTmp["URL_TO_DETAIL"] = CComponentEngine::MakePathFromTemplate($this->arParams["PATH_TO_DETAIL"], Array("ID" => $arUserProps["ID"]));
			if (empty($this->arParams['PATH_TO_DELETE']))
			{
				$arResultTmp["URL_TO_DETELE"] = htmlspecialcharsbx($APPLICATION->GetCurPage()."?del_id=".$arUserProps["ID"]."&".bitrix_sessid_get());
			}
			else
			{
				$arResultTmp["URL_TO_DETELE"] = CComponentEngine::MakePathFromTemplate($this->arParams["PATH_TO_DELETE"], Array("ID" => $arUserProps["ID"]))."&".bitrix_sessid_get();
			}
			$this->arResult["PROFILES"][] = $arResultTmp;
		}

		if ($request->get('SECTION'))
		{
			$this->arResult["URL"] = htmlspecialcharsbx($request->getRequestedPage()."?SECTION=".$request->get('SECTION')."&");
		}
		else
		{
			$this->arResult["URL"] = htmlspecialcharsbx($request->getRequestedPage()."?");
		}
        $this->arResult["PROPERTY_MAP"] = $this->getOrderProperties();
		$this->includeComponentTemplate();
	}

    /**
     * Обноывление профиля
     * @param $profileId
     * @param $profileData
     * @return bool|void
     */
	public function updateProfileAction($profileId, $profileData){
        try {
            if(empty($profileId) || empty($profileData)){
                throw new \Exception("Переданны не верные данные!");
            }
            $propertyMap = $this->getOrderProperties();
            $dbUserProfile = CSaleOrderUserProps::GetList(
                ['DATE_UPDATE' => 'DESC'],
                [
                    'ID' => $profileId,
                    'USER_ID' => $GLOBALS["USER"]->GetId(),
                ]
            );
            if ($userProfile = $dbUserProfile->GetNext()){
                $arUpdateProfile = [];
                foreach ($profileData as $profileField){
                    $fieldId = intval(str_replace("PROPERTY_", "", $profileField["name"]));
                    $arUpdateProfile[$fieldId] = trim($profileField["value"]);
                }
                // Обновляем название профиля по имени
                $profileName = $arUpdateProfile[$propertyMap[$userProfile["PERSON_TYPE_ID"]]["customer"]["fullName"]];
                if(!empty($profileName)) {
                    $saleProps = new \CSaleOrderUserProps;
                    if (!$saleProps->Update($userProfile["ID"], array("NAME" => trim($profileName)))) {
                        $this->errorCollection->setError(new Main\Error("Не удалось обновить профиль!" . "<br />"));
                        return;
                    }
                }
                // Обновляем данные профиля
                $this->updateProfileProperties($userProfile["ID"], $arUpdateProfile);
            }
            return true;
        } catch (\Exception $exception) {
            $this->errorCollection[] = new \Bitrix\Main\Error($exception->getMessage(), $exception->getCode());
            return;
        }
    }

    /**
     * Удаление профиля
     * @param $profileId
     * @return bool|void
     */
    public function deleteProfileAction($profileId){
        try {
            if(empty($profileId)){
                throw new \Exception("Переданны не верные данные!");
            }
            $dbUserProfile = CSaleOrderUserProps::GetList(
                ['DATE_UPDATE' => 'DESC'],
                [
                    'ID' => $profileId,
                    'USER_ID' => $GLOBALS["USER"]->GetId(),
                ]
            );
            if ($userProfile = $dbUserProfile->GetNext()){
                $deleteResult = CSaleOrderUserProps::Delete($userProfile["ID"]);
                return boolval($deleteResult);
            }
            return false;
        } catch (\Exception $exception) {
            $this->errorCollection[] = new \Bitrix\Main\Error($exception->getMessage(), $exception->getCode());
            return;
        }
    }

	/**
	 * Function checks if required modules installed. If not, throws an exception
	 * @throws Main\SystemException
	 * @return void
	 */
	protected function checkRequiredModules()
	{
		if (!Loader::includeModule('sale'))
		{
			throw new Main\SystemException(Loc::getMessage("SALE_MODULE_NOT_INSTALL"), self::E_SALE_MODULE_NOT_INSTALLED);
		}
	}

    /**
     * Получение списка полей профиля во внутреннем формате
     * @return array
     * @throws Main\ArgumentException
     * @throws Main\SystemException
     */
    private function getOrderProperties(){
        $arProperties = [];
        $registry = Sale\Registry::getInstance(Sale\Registry::REGISTRY_TYPE_ORDER);
        $propertyClassName = $registry->getPropertyClassName();
        $obPropResult = $propertyClassName::getList([
            'select' => ['ID', 'CODE', 'NAME', 'PERSON_TYPE_ID', 'REQUIRED'],
            'order' => ['SORT' => 'ASC'],
        ]);
        while($property = $obPropResult->fetch()){
            switch ($property["CODE"]){
                case "NAME": case "FIO":
                    $arProperties[$property["PERSON_TYPE_ID"]]["customer"]["fullName"] = $property["ID"];
                    break;
                case "EMAIL":
                    $arProperties[$property["PERSON_TYPE_ID"]]["customer"]["email"] = $property["ID"];
                    break;
                case "PHONE":
                    $arProperties[$property["PERSON_TYPE_ID"]]["customer"]["phone"] = $property["ID"];
                    break;
                case "INN":
                    $arProperties[$property["PERSON_TYPE_ID"]]["company"]["inn"] = $property["ID"];
                    break;
                case "KPP":
                    $arProperties[$property["PERSON_TYPE_ID"]]["company"]["kpp"] = $property["ID"];
                    break;
                case "COMPANY":
                    $arProperties[$property["PERSON_TYPE_ID"]]["company"]["name"] = $property["ID"];
                    break;
                case "COMPANY_ADR":
                    $arProperties[$property["PERSON_TYPE_ID"]]["company"]["legalAdress"] = $property["ID"];
                    break;
                case "CITY":
                    $arProperties[$property["PERSON_TYPE_ID"]]["address"]["city"] = $property["ID"];
                    break;
                case "STREET":
                    $arProperties[$property["PERSON_TYPE_ID"]]["address"]["street"] = $property["ID"];
                    break;
                case "HOUSE":
                    $arProperties[$property["PERSON_TYPE_ID"]]["address"]["houseNumber"] = $property["ID"];
                    break;
                case "BUILDING":
                    $arProperties[$property["PERSON_TYPE_ID"]]["address"]["building"] = $property["ID"];
                    break;
                case "FLOOR":
                    $arProperties[$property["PERSON_TYPE_ID"]]["address"]["floor"] = $property["ID"];
                    break;
                case "PVZ":
                    $arProperties[$property["PERSON_TYPE_ID"]]["delivery"]["pvzId"] = $property["ID"];
                    break;
                case "PVZ_ADDRESS":
                    $arProperties[$property["PERSON_TYPE_ID"]]["delivery"]["pvzName"] = $property["ID"];
                    break;
            }
        }
        return $arProperties;
    }

    /**
     * Обновление свойств профиля
     * @param $profileId
     * @param $arProfileData
     * @return bool
     * @throws Exception
     */
    protected function updateProfileProperties($profileId, $arProfileData)
    {
        $updatedValues = array();
        $saleOrderUserPropertiesValue = new CSaleOrderUserPropsValue;
        $userPropertiesList = $saleOrderUserPropertiesValue::GetList(
            array("SORT" => "ASC"),
            array("USER_PROPS_ID" => $profileId),
            false,
            false,
            array("ID", "ORDER_PROPS_ID", "VALUE", "SORT", "PROP_TYPE")
        );

        while ($propertyValues = $userPropertiesList->Fetch())
        {
            if (isset($arProfileData[$propertyValues["ORDER_PROPS_ID"]]))
            {
                Sale\Internals\UserPropsValueTable::update(
                    $propertyValues["ID"],
                    array("VALUE" => $arProfileData[$propertyValues["ORDER_PROPS_ID"]])
                );
            }
            $updatedValues[$propertyValues["ORDER_PROPS_ID"]] = $arProfileData[$propertyValues["ORDER_PROPS_ID"]];
        }
        return true;
    }
}