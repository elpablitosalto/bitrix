<?php

namespace Waim\Components;

use Bitrix\Crm\Integrity\ActualEntitySelector;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Mail\Event;
use Bitrix\Main\Application;
use CBitrixComponent;

class ContentFormsComponent extends CBitrixComponent implements Controllerable, Errorable
{
    protected ErrorCollection $errorCollection;

    private $arFormData = [];

    private $repairServicesTypeId = 107;
    private $transportServicesTypeId = 106;
    private $crmFieldsMatrix = [
        "vendingType" => "UF_CRM_1693915053005",
        "ownDesign" => "UF_CRM_1693915070564",
        "transportFrom" => "UF_CRM_1693915090537",
        "transportTo" => "UF_CRM_1693915120762",
        "contactRequired_plan" => "UF_CRM_3807394363806",
        "contactRequired_planDouble" => "UF_CRM_CONTACT_3830371268186",
    ];

    public function onPrepareComponentParams($arParams)
    {
        $this->errorCollection = new ErrorCollection();
        return $arParams;
    }

    public function executeComponent()
    {
        $this->arResult = [
            "user" => $this->getUserData(),
            "vendingTypes" => $this->getVendingTypes(),
            "repairServices" => $this->getRepairServices(),
            "transportServices" => $this->getTransportServices()
        ];
        $this->includeComponentTemplate();
    }

    public function getErrors(): array
    {
        return $this->errorCollection->toArray();
    }

    public function getErrorByCode($code): Error
    {
        return $this->errorCollection->getErrorByCode($code);
    }

    public function configureActions(): array
    {
        return [
            'sendSimpleForm' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod([ActionFilter\HttpMethod::METHOD_POST])
                ]
            ],
            'sendRepairForm' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod([ActionFilter\HttpMethod::METHOD_POST])
                ]
            ],
            'sendTransportForm' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod([ActionFilter\HttpMethod::METHOD_POST])
                ]
            ],
        ];
    }

    public function sendSimpleFormAction(array $arFormData): void
    {
        try
        {
            $this->arFormData = $arFormData;
            $this->arFormData["formName"] = Loc::getMessage("CF_SIMPLE_FORM_NAME");
            //
            if (!empty($this->request->getFile("file")))
            {
                $file = $this->request->getFile("file");
                if (!empty($file["tmp_name"]) && is_file($file["tmp_name"]))
                {
                    $this->arFormData["ownDesign"] = $file;
                }
            }
            if ($this->createDeal())
            {
                if (!$this->sendEmail("SIMPLE_EMAIL_TEMPLATE"))
                { // TODO: шаблон письма
                    throw new \Exception(Loc::getMessage("CF_MESSAGE_SEND_ERROR"));
                }
            }
            else
            {
                throw new \Exception(Loc::getMessage("CF_DEAL_CREATE_ERROR"));
            }
        } catch (\Exception $exception)
        {
            $this->errorCollection->setError(new Error($exception->getMessage()));
        }
    }

    public function sendRepairFormAction(array $arFormData): void
    {
        try
        {
            $this->arFormData = $arFormData;
            $this->arFormData["formName"] = Loc::getMessage("CF_REPAIR_FORM_NAME");
            //
            if (!empty($this->arFormData["repairServices"]))
            {
                $repairServices = explode(",", $this->arFormData["repairServices"]);
                $repairServices = array_filter(array_map("intval", array_map("trim", $repairServices)));
                if (!empty($repairServices))
                {
                    $this->arFormData["formServices"] = [];
                    $arRepairServicesList = $this->getRepairServices();
                    foreach ($repairServices as $serviceId)
                    {
                        if (!empty($arRepairServicesList[$serviceId]["name"]) && !empty($arRepairServicesList[$serviceId]["cost"]))
                        {
                            $this->arFormData["formServices"][$serviceId] = [
                                //'PRODUCT_ID' => intval($arRepairServicesList[$serviceId]['id']),
                                'PRODUCT_NAME' => trim($arRepairServicesList[$serviceId]['name']),
                                'PRICE' => doubleval($arRepairServicesList[$serviceId]['cost']),
                                'QUANTITY' => 1
                            ];
                        }
                    }
                }
            }
            if ($this->createDeal())
            {
                if (!$this->sendEmail("REPAIR_EMAIL_TEMPLATE"))
                { // TODO: шаблон письма
                    throw new \Exception(Loc::getMessage("CF_MESSAGE_SEND_ERROR"));
                }
            }
            else
            {
                throw new \Exception(Loc::getMessage("CF_DEAL_CREATE_ERROR"));
            }
        } catch (\Exception $exception)
        {
            $this->errorCollection->setError(new Error($exception->getMessage()));
        }
    }

    public function sendTransportFormAction(array $arFormData): void
    {
        try
        {
            $this->arFormData = $arFormData;
            $this->arFormData["formName"] = Loc::getMessage("CF_TRANSPORT_FORM_NAME");
            //
            if (!empty($this->arFormData["services"]) && is_array($this->arFormData["services"]))
            {
                $this->arFormData["formServices"] = [];
                $arTransportServicesList = $this->getTransportServices();
                foreach ($this->arFormData["services"] as $service)
                {
                    foreach ($arTransportServicesList as $transportServiceItem)
                    {
                        if ($transportServiceItem["id"] == $service["id"])
                        {
                            if (empty($this->arFormData["formServices"][$transportServiceItem["id"]]))
                            {
                                $this->arFormData["formServices"][$transportServiceItem["id"]] = [
                                    //'PRODUCT_ID' => intval($transportServiceItem['id']),
                                    'PRODUCT_NAME' => trim($transportServiceItem['name']),
                                    'PRICE' => doubleval($transportServiceItem['cost']),
                                    'QUANTITY' => intval($service["quantity"])
                                ];
                            }
                            else
                            {
                                $this->arFormData["formServices"][$transportServiceItem["id"]]['QUANTITY'] += intval($service["quantity"]);
                            }
                            break;
                        }
                    }
                }
            }
            if ($this->createDeal())
            {
                if (!$this->sendEmail("TRANSPORT_EMAIL_TEMPLATE"))
                { // TODO: шаблон письма
                    throw new \Exception(Loc::getMessage("CF_MESSAGE_SEND_ERROR"));
                }
            }
            else
            {
                throw new \Exception(Loc::getMessage("CF_DEAL_CREATE_ERROR"));
            }
        } catch (\Exception $exception)
        {
            $this->errorCollection->setError(new Error($exception->getMessage()));
        }
    }

    private function getUserData(): array
    {
        $arResult = [
            "fio" => "",
            "phone" => "",
            "email" => "",
            "isAuth" => $GLOBALS["USER"]->IsAuthorized()
        ];
        if ($GLOBALS["USER"]->IsAuthorized())
        {
            $rsUser = \CUser::GetByID($GLOBALS["USER"]->GetID());
            if ($arUser = $rsUser->Fetch())
            {
                $arResult["fio"] = \CUser::FormatName(\CSite::GetNameFormat(), $arUser);
                $arResult["phone"] = trim($arUser["PERSONAL_PHONE"]);
                $arResult["email"] = trim($arUser["EMAIL"]);
            }
        }
        return $arResult;
    }

    private function getVendingTypes(): array
    {
        $arResult = [];
        $rsVendingTypesField = \CAllUserTypeEntity::GetList([], ["FIELD_NAME" => $this->crmFieldsMatrix["vendingType"]]);
        if ($arVendingTypesField = $rsVendingTypesField->Fetch())
        {
            $rsVendingTypes = \CUserFieldEnum::GetList(["SORT" => "ASC"], ["USER_FIELD_ID" => $arVendingTypesField["ID"]]);
            while ($arVendingType = $rsVendingTypes->Fetch())
            {
                $arResult[$arVendingType["ID"]] = $arVendingType["VALUE"];
            }
        }
        return $arResult;
    }

    private function getRepairServices(): array
    {
        $arResult = [];
        $arServices = $this->getServices($this->repairServicesTypeId);
        if (!empty($arServices))
        {
            foreach ($arServices as $service)
            {
                $arResult[$service["ID"]] = [
                    "id" => $service["ID"],
                    "name" => $service["UF_NAME"],
                    "cost" => intval($service["UF_PRICE"])
                ];
            }
        }
        return $arResult;
    }

    private function getTransportServices(): array
    {
        $arResult = [];
        $arServices = $this->getServices($this->transportServicesTypeId);
        if (!empty($arServices))
        {
            foreach ($arServices as $service)
            {
                $arResult[$service["UF_CODE"]] = [
                    "id" => $service["ID"],
                    "name" => $service["UF_NAME"],
                    "desc" => $service["UF_DESC"],
                    "cost" => intval($service["UF_PRICE"])
                ];
            }
        }
        return $arResult;
    }

    private function getServices(int $typeId): array
    {
        $arResult = [];
        if (Loader::includeModule("highloadblock"))
        {
            $rsHighload = HL\HighloadBlockTable::getList([
                "filter" => [
                    "NAME" => "ContentForms"
                ]
            ]);
            if ($highload = $rsHighload->fetch())
            {
                $entity = HL\HighloadBlockTable::compileEntity($highload);
                $entityDataClass = $entity->getDataClass();
                $rsServices = $entityDataClass::getList([
                    "filter" => [
                        "UF_TYPE" => $typeId
                    ]
                ]);
                while ($arService = $rsServices->fetch())
                {
                    $arResult[] = $arService;
                }
            }
        }
        return $arResult;
    }

    private function createDeal(): bool
    {
        $result = false;
        if (Loader::includeModule("crm"))
        {
            $obDeal = new \CCrmDeal(false);
            $obContact = new \CCrmContact(false);
            // Ищем контакт с такими же контактами для предотвращения дублей
            if (!empty($this->arFormData["fio"]) && !empty($this->arFormData["email"]) && !empty($this->arFormData["phone"]))
            {
                $contactId = 0;
                $arDuplicates = $this->getDuplicatesList([
                    'FM' => [
                        "PHONE" => ["n0" => ["VALUE" => \Bitrix\Main\UserPhoneAuthTable::normalizePhoneNumber($this->arFormData["phone"])]],
                        "EMAIL" => ["n0" => ["VALUE" => $this->arFormData["email"]]]
                    ]
                ]);
                if (empty($arDuplicates))
                {
                    $arContactFields = [
                        "NAME" => $this->arFormData["fio"],
                        $this->crmFieldsMatrix["contactRequired_plan"] => 0,
                        $this->crmFieldsMatrix["contactRequired_planDouble"] => 0,
                        'FM' => [
                            "PHONE" => ["n0" => ["VALUE" => $this->arFormData["phone"], 'VALUE_TYPE' => 'WORK']],
                            "EMAIL" => ["n0" => ["VALUE" => $this->arFormData["email"], 'VALUE_TYPE' => 'WORK']]
                        ]
                    ];
                    $contactId = $obContact->Add($arContactFields);
                }
                else
                {
                    $contactId = current($arDuplicates);
                }
                if (!empty($contactId))
                {
                    $arDealFields = [
                        "TITLE" => Loc::getMessage("CF_DEAL_TITLE", ["#FORM_NAME#" => $this->arFormData["formName"]]),
                        "CONTACT_ID" => $contactId,
                        "CATEGORY_ID" => $this->getDealCategory($this->arFormData["formName"]),
                        "COMMENTS" => !empty($this->arFormData["message"]) ? $this->arFormData["message"] : null,
                    ];
                    if (!empty($this->arFormData["vendingType"]))
                    {
                        $arDealFields[$this->crmFieldsMatrix["vendingType"]] = $this->arFormData["vendingType"];
                    }
                    if (!empty($this->arFormData["ownDesign"]))
                    {
                        $arDealFields[$this->crmFieldsMatrix["ownDesign"]] = $this->arFormData["ownDesign"];
                    }
                    if (!empty($this->arFormData["fromAddress"]))
                    {
                        $arDealFields[$this->crmFieldsMatrix["transportFrom"]] = $this->arFormData["fromAddress"];
                    }
                    if (!empty($this->arFormData["toAddress"]))
                    {
                        $arDealFields[$this->crmFieldsMatrix["transportTo"]] = $this->arFormData["toAddress"];
                    }
                    if (!empty($this->arFormData["extraAddress"]))
                    {
                        $arDealFields[$this->crmFieldsMatrix["transportTo"]] .= Loc::getMessage(
                            "CF_EXTRA_ADDRESS",
                            ["#ADDRESS#" => $this->arFormData["extraAddress"]]
                        );
                    }
                    // Создаем сделку
                    $dealId = $obDeal->Add($arDealFields);
                    if (!empty($dealId))
                    {
                        // Добавляем товары - услуги, если они есть в форме
                        if (!empty($this->arFormData["formServices"]) && is_array($this->arFormData["formServices"]))
                        {
                            \CCrmDeal::SaveProductRows(
                                $dealId,
                                $this->arFormData["formServices"],
                                $checkPerms = false,
                                $regEvent = false,
                                $syncOwner = true
                            );
                        }
                        $result = true;
                    }
                }
            }
        }
        return $result;
    }

    private function getDuplicatesList(array $arValues): array
    {
        $arDuplicatesList = [];
        $arFields = [
            ActualEntitySelector::SEARCH_PARAM_EMAIL,
            ActualEntitySelector::SEARCH_PARAM_PHONE
        ];
        $duplicateCriteria = ActualEntitySelector::createDuplicateCriteria($arValues, $arFields);
        foreach ($duplicateCriteria as $criterion)
        {
            $duplicate = $criterion->find(\CCrmOwnerType::Contact);
            if (!empty($duplicate))
            {
                $arDuplicatesList = array_merge($arDuplicatesList, $duplicate->getEntityIDs());
            }
        }
        return array_unique($arDuplicatesList);
    }

    private function sendEmail(string $emailTemplate): bool
    {
        // Письмо клиенту
        $arVendingTypes = $this->getVendingTypes();
        // Услуги
        $arServiceNames = [];
        if (!empty($this->arFormData["formServices"]) && is_array($this->arFormData["formServices"]))
        {
            foreach ($this->arFormData["formServices"] as $service)
            {
                $arServiceNames[] = $service["PRODUCT_NAME"];
            }
        }
        $sendResult = Event::send([
            "EVENT_NAME" => $emailTemplate,
            "LID" => Application::getInstance()->getContext()->getSite(),
            "C_FIELDS" => [
                "FIO" => $this->arFormData["fio"],
                "EMAIL" => $this->arFormData["email"],
                "PHONE" => $this->arFormData["phone"],
                "MESSAGE" => $this->arFormData["message"],
                "VENDING_TYPE" => !empty($arVendingTypes[$this->arFormData["vendingType"]]) ? $arVendingTypes[$this->arFormData["vendingType"]] : "",
                "SERVICES" => !empty($arServiceNames) ? implode(", ", $arServiceNames) : "",
                "FORM_NAME" => $this->arFormData["formName"]
            ],
        ]);
        // TODO: менеджеру отдельное письмо?
        return $sendResult->isSuccess();
    }

    private function getDealCategory(string $formName): int
    {
        $categoryId = 0;
        $rsDealCategory = \Bitrix\Crm\Category\DealCategory::getList([
            "filter" => [
                "=NAME" => trim($formName)
            ],
            "limit" => 1
        ]);
        if ($arDealCategory = $rsDealCategory->fetch())
        {
            $categoryId = $arDealCategory["ID"];
        }
        return $categoryId;
    }
}