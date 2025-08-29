<?php

namespace Waim\Components;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Error;
use Bitrix\Main;
use Bitrix\Sale;
use Bitrix\Main\IO;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;

Loc::loadMessages(__FILE__);
Loader::registerAutoLoadClasses(null, [
    '\SaleOrderAjax'   => '/local/components/waim/order/soa_class.php',
]);

class OrderComponent extends \SaleOrderAjax implements Controllerable, Errorable
{
    protected ErrorCollection $errorCollection;
    protected $currentCityId;
    protected $legalProfileId = 1;
    protected $individualProfileId = 5;
    protected $pickUpDeliveryId = 2;


    public function onPrepareComponentParams($arParams)
    {
        global $APPLICATION;
        if(!Loader::includeModule("sale") || !Loader::includeModule("catalog") || !Loader::includeModule("iblock")){
            throw new \Exception(Loc::getMessage("OC_MODULES_NOT_INSTALL"));
        }
        $arParams = array(
            "ADDITIONAL_PICT_PROP_1" => "-",
            "ADDITIONAL_PICT_PROP_2" => "-",
            "ALLOW_AUTO_REGISTER" => "Y",
            "ALLOW_NEW_PROFILE" => "Y",
            "ALLOW_USER_PROFILES" => "Y",
            "BASKET_IMAGES_SCALING" => "standard",
            "BASKET_POSITION" => "after",
            "COMPATIBLE_MODE" => "Y",
            "DELIVERIES_PER_PAGE" => "8",
            "DELIVERY_FADE_EXTRA_SERVICES" => "N",
            "DELIVERY_NO_AJAX" => "N",
            "DELIVERY_NO_SESSION" => "Y",
            "DELIVERY_TO_PAYSYSTEM" => "d2p",
            "DISABLE_BASKET_REDIRECT" => "N",
            "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
            "PATH_TO_AUTH" => "/auth/",
            "PATH_TO_BASKET" => "/personal/cart/",
            "PATH_TO_PAYMENT" => "payment.php",
            "PATH_TO_PERSONAL" => "index.php",
            "PAY_FROM_ACCOUNT" => "N",
            "PAY_SYSTEMS_PER_PAGE" => "8",
            "PICKUPS_PER_PAGE" => "5",
            "PRODUCT_COLUMNS_HIDDEN" => array(
            ),
            "PRODUCT_COLUMNS_VISIBLE" => array(
                0 => "PREVIEW_PICTURE",
                1 => "PROPS",
            ),
            "SEND_NEW_USER_NOTIFY" => "Y",
            "SERVICES_IMAGES_SCALING" => "standard",
            "SET_TITLE" => "Y",
            "SHOW_BASKET_HEADERS" => "N",
            "SHOW_COUPONS_BASKET" => "N",
            "SHOW_COUPONS_DELIVERY" => "N",
            "SHOW_COUPONS_PAY_SYSTEM" => "N",
            "SHOW_DELIVERY_INFO_NAME" => "Y",
            "SHOW_DELIVERY_LIST_NAMES" => "Y",
            "SHOW_DELIVERY_PARENT_NAMES" => "Y",
            "SHOW_MAP_IN_PROPS" => "N",
            "SHOW_NEAREST_PICKUP" => "N",
            "SHOW_NOT_CALCULATED_DELIVERIES" => "L",
            "SHOW_ORDER_BUTTON" => "final_step",
            "SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
            "SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
            "SHOW_STORES_IMAGES" => "Y",
            "SHOW_TOTAL_ORDER_BUTTON" => "N",
            "SKIP_USELESS_BLOCK" => "Y",
            "TEMPLATE_LOCATION" => "popup",
            "TEMPLATE_THEME" => "site",
            "USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
            "USE_CUSTOM_ERROR_MESSAGES" => "N",
            "USE_CUSTOM_MAIN_MESSAGES" => "N",
            "USE_PRELOAD" => "Y",
            "USE_PREPAYMENT" => "N",
            "USE_YM_GOALS" => "N",
            "COMPONENT_TEMPLATE" => ".default",
            "ALLOW_APPEND_ORDER" => "Y",
            "SPOT_LOCATION_BY_GEOIP" => "Y",
            "SHOW_VAT_PRICE" => "Y",
            "SHOW_PICKUP_MAP" => "Y",
            "PICKUP_MAP_TYPE" => "yandex",
            "PROPS_FADE_LIST_1" => array(
            ),
            "USER_CONSENT" => "Y",
            "USER_CONSENT_ID" => "1",
            "USER_CONSENT_IS_CHECKED" => "N",
            "USER_CONSENT_IS_LOADED" => "Y",
            "ACTION_VARIABLE" => "soa-action",
            "USE_PHONE_NORMALIZATION" => "Y",
            "ADDITIONAL_PICT_PROP_5" => "-",
            "ADDITIONAL_PICT_PROP_10" => "-",
            "ADDITIONAL_PICT_PROP_11" => "-",
            "ADDITIONAL_PICT_PROP_12" => "-",
            "USE_ENHANCED_ECOMMERCE" => "N"
        );
        $this->errorCollection = new ErrorCollection();
        $this->currentCityId = $this->getCurrentCityId();
        parent::onPrepareComponentParams($arParams);
        return $arParams;
    }

    public function executeComponent()
    {
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
            'init' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod([ActionFilter\HttpMethod::METHOD_POST])
                ]
            ],
            'refresh' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod([ActionFilter\HttpMethod::METHOD_POST])
                ]
            ],
            'sendOrderRequest' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod([ActionFilter\HttpMethod::METHOD_POST])
                ]
            ],
            'getLocationSuggestions' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod([ActionFilter\HttpMethod::METHOD_POST])
                ]
            ]
        ];
    }

    // Стартовые данные
    public function initAction(): array
    {
        try {
            $this->setFrameMode(false);
            $this->context = Main\Application::getInstance()->getContext();
            $this->checkSession = $this->arParams["DELIVERY_NO_SESSION"] == "N" || check_bitrix_sessid();
            $this->isRequestViaAjax = true;

            $action = "processOrder";
            Sale\Compatible\DiscountCompatibility::stopUsageCompatible();
            $this->doAction($action);
            Sale\Compatible\DiscountCompatibility::revertUsageCompatible();

            $arResult = $this->convertDataToInitAction();

            return $arResult;
        } catch (\Exception $e) {
            $this->errorCollection[] = new Error($e->getMessage());
            return [
                "result" => "Произошла ошибка"
            ];
        }
    }

    // Стартовые данные
    public function refreshAction(): array
    {
        try {
            $this->setFrameMode(false);
            $this->context = Main\Application::getInstance()->getContext();
            $this->checkSession = $this->arParams["DELIVERY_NO_SESSION"] == "N" || check_bitrix_sessid();
            $this->isRequestViaAjax = true;

            $action = "refreshOrderAjax";
            Sale\Compatible\DiscountCompatibility::stopUsageCompatible();
            $this->doAction($action);
            Sale\Compatible\DiscountCompatibility::revertUsageCompatible();

            $arResult = $this->convertDataToInitAction();

            return $arResult;
        } catch (\Exception $e) {
            $this->errorCollection[] = new Error($e->getMessage());
            return [
                "result" => "Произошла ошибка"
            ];
        }
    }

    public function sendOrderRequestAction(): array
    {
        try {
            $this->setFrameMode(false);
            $this->context = Main\Application::getInstance()->getContext();
            $this->checkSession = true;
            $this->isRequestViaAjax = true;
            //
            Sale\Compatible\DiscountCompatibility::stopUsageCompatible();
            $this->doAction("saveOrderAjax");
            if(!empty($this->arResult["ORDER_ID"]) && empty($this->arResult["ERROR"])) {
                $_REQUEST["pdf"] = "Y"; // костыль для оплаты по счету, чтобы генерился сразу pdf
                $this->doAction("showOrder");
            }elseif(!empty($this->arResult["ERROR"]) && is_array($this->arResult["ERROR"])){
                throw new \Exception(implode(PHP_EOL, $this->arResult["ERROR"]));
            }
            Sale\Compatible\DiscountCompatibility::revertUsageCompatible();
            // Сохраняем данные в файл, если в ответе ПС у нас документ, а не ссылка
            if(empty($this->arResult["PAY_SYSTEM"]["PAYMENT_URL"]) && !empty($this->arResult["PAY_SYSTEM"]["BUFFERED_OUTPUT"])){
                $tmpDir = new IO\Directory(\Bitrix\Main\Application::getDocumentRoot() . "/upload/tmp/");
                if(!$tmpDir->isExists()){
                    $tmpDir->create();
                }
                $tmpBillFile = new IO\File($tmpDir->getPhysicalPath() . "/bill__".md5(serialize($this->arResult["ORDER"])).".pdf");
                $tmpBillFile->putContents($this->arResult["PAY_SYSTEM"]["BUFFERED_OUTPUT"]);
                if($tmpBillFile->isExists()){
                    $billFileFields = \CFile::MakeFileArray(
                        $tmpBillFile->getPhysicalPath(),
                        false,
                        false,
                        ''
                    );
                    $billFileId = \CFile::SaveFile(
                        $billFileFields,
                        'bills',
                        false,
                        false
                    );
                    $this->arResult["PAY_SYSTEM"]["PAYMENT_URL"] = \CFile::GetPath($billFileId);
                    $tmpBillFile->delete(); // удаляем временный файл
                }
            }
            //
            $result = [
                'order' => [
                    'id' => $this->arResult["ORDER_ID"],
                    'title' => 'Спасибо за заказ!',
                    'message' => 'Заказ успешно оформлен.<br>Номер вашего заказа '.$this->arResult["ACCOUNT_NUMBER"].'.<br>Все детали заказа были отправлены на ваш e-mail.'
                ],
                'payment' => [
                    'title' => 'Оплата заказа',
                    'info' => $this->arResult["PAY_SYSTEM"]["NAME"],
                    'message' => $this->arResult["PAY_SYSTEM"]["DESCRIPTION"],
                    'check' => [
                        'url' => $this->arResult["PAY_SYSTEM"]["PAYMENT_URL"],
                        'text' => 'Скачать счет'
                    ]
                ],
                'nextLink' => [
                    'url' => '/',
                    'text' => 'На главную'
                ]
            ];
            return $result;
        } catch (\Exception $e) {
            $this->errorCollection[] = new Error($e->getMessage());
            return [
                "result" => "Произошла ошибка"
            ];
        }
    }

    public function getLocationSuggestionsAction(string $query): array
    {
        $result = [
            'list' => []
        ];
        $arCities = \Mirvendinga\Geo::getRegionByName($query);
        if(!empty($arCities)){
            foreach ($arCities as $city){
                $result['list'][] = [
                    "id" => $city["ID"],
                    "name" => $city["NAME"]
                ];
            }
        }
        return $result;
    }

    private function convertDataToInitAction() : array {
        $defaultLocation = $this->getCurrentLocation();
        $result = [
            'profiles' => [],
            "defaultProfile" => 0,
            "defaultLocation" => [
                "id" => $defaultLocation["ID"],
                "name" => $defaultLocation["NAME"],
            ],
            'auth' => $GLOBALS["USER"]->IsAuthorized(),
            'authMessage' => 'Заполните поля ниже или <a href="'.AUTH_URL.'">авторизуйтесь</a> на сайте',
            'payment' => [
                "paySystems" => [],
                "defaultPaySystem" => 0
            ],
            'delivery' => [
                "deliveries" => [],
                "defaultDelivery" => 0
            ],
            'order' => [
                'items' => [],
                'total' => [],
            ],
            'properties' => [],
            'personTypes' => [
                "isCompany" => $this->legalProfileId,
                "isNotCompany" => $this->individualProfileId
            ],
        ];
        // Свойства
        $result['properties'] = $this->getOrderProperties();
        // Оплаты
        if(!empty($this->arResult["PAY_SYSTEM"])){
            foreach ($this->arResult["PAY_SYSTEM"] as $paySystem) {
                if($paySystem["CHECKED"] == "Y"){
                    $result["payment"]["defaultPaySystem"] = $paySystem["ID"];
                }
                $result["payment"]["paySystems"][] = [
                    'id' => $paySystem["ID"],
                    'title' => $paySystem["NAME"]
                ];
            }
        }
        // Профили
        if(!empty($this->arResult['ORDER_PROP']['USER_PROFILES'])){
            foreach ($this->arResult['ORDER_PROP']['USER_PROFILES'] as $profile){
                $profileFields = Sale\OrderUserProperties::getProfileValues((int)$profile["ID"]);
                $arPersonTypePropIds = $result['properties'][$profile["PERSON_TYPE_ID"]];
                if($profile["CHECKED"] == "Y") {
                    $result["defaultProfile"] = $profile["ID"];
                }
                $result['profiles'][] = [
                    'id' => $profile["ID"],
                    'name' => $profile["NAME"],
                    'customer' => [
                        'fullName'      => trim($profileFields[$arPersonTypePropIds["customer"]["fullName"]]),
                        'phone'         => trim($profileFields[$arPersonTypePropIds["customer"]["phone"]]),
                        'email'         => trim($profileFields[$arPersonTypePropIds["customer"]["email"]]),
                    ],
                    'company' => [
                        'name'          => trim($profileFields[$arPersonTypePropIds["company"]["name"]]),
                        'legalAdress'   => trim($profileFields[$arPersonTypePropIds["company"]["legalAdress"]]),
                        'inn'           => trim($profileFields[$arPersonTypePropIds["company"]["inn"]]),
                        'kpp'           => trim($profileFields[$arPersonTypePropIds["company"]["kpp"]]),
                    ],
                    'address' => [
                        'city'          => trim($profileFields[$arPersonTypePropIds["address"]["city"]]),
                        'street'        => trim($profileFields[$arPersonTypePropIds["address"]["street"]]),
                        'houseNumber'   => trim($profileFields[$arPersonTypePropIds["address"]["houseNumber"]]),
                        'building'      => trim($profileFields[$arPersonTypePropIds["address"]["building"]]),
                        'floor'         => trim($profileFields[$arPersonTypePropIds["address"]["floor"]]),
                    ],
                    'delivery' => [
                        'location'      => trim($profileFields[$arPersonTypePropIds["delivery"]["location"]]),
                        'pvzId'         => trim($profileFields[$arPersonTypePropIds["delivery"]["pvzId"]]),
                        'pvzName'       => trim($profileFields[$arPersonTypePropIds["delivery"]["pvzName"]]),
                    ],
                    'isCompany' => $profile["PERSON_TYPE_ID"] == $this->legalProfileId,
                ];
            }
        }
        // Доставка
        if(!empty($this->arResult['DELIVERY'])){
            foreach ($this->arResult['DELIVERY'] as $arDelivery){
                if($arDelivery["CHECKED"] == "Y"){
                    $result["delivery"]["defaultDelivery"] = $arDelivery["ID"];
                }
                $result["delivery"]["deliveries"][] = [
                    "id" => $arDelivery["ID"],
                    "title" => $arDelivery["NAME"],
                    "description" => $arDelivery["DESCRIPTION"],
                    "price" => $arDelivery["PRICE"],
                    "isPickUp" => !empty($arDelivery["STORE"]),
                    "pickUpPoints" => $this->getPickupPoints($arDelivery)
                ];
            }
        }
        // Заказ
        foreach ($this->arResult["BASKET_ITEMS"] as $basketItem){
            $image = \CFile::ResizeImageGet(
                !empty($basketItem['PREVIEW_PICTURE']) ? $basketItem['PREVIEW_PICTURE'] : $basketItem['DETAIL_PICTURE'],
                array('width'=>180, 'height'=>140),
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true
            );
            $packageAmount = \Mirvendinga\Catalog::getProductPackageAmount($basketItem["PRODUCT_ID"]);
            $result["order"]["items"][] = [
                'id' => $basketItem["ID"],
                'imageUrl' => $image["src"], // 180x140
                'title' => $basketItem["NAME"],
                'detailUrl' => $basketItem["DETAIL_PAGE_URL"],
                'props' => [
                    [
                        'label' => 'Количество',
                        'value' => $basketItem["QUANTITY"].' '.$packageAmount["MEASURE"]
                    ],
                    [
                        'label' => 'Сумма',
                        'value' => $basketItem["SUM"]
                    ]
                ]
            ];
        }
        $result["order"]["total"] = [
            [
                'label' => 'Скидка',
                'value' => !empty($this->arResult["BASKET_PRICE_DISCOUNT_DIFF_VALUE"]) ? $this->arResult["DISCOUNT_PRICE_FORMATED"] : "",
            ],
            [
                'label' => 'Доставка (примерный расчет)',
                'value' => $this->arResult["DELIVERY_PRICE_FORMATED"],
            ],
            [
                'label' => 'Сумма',
                'value' =>  $this->arResult["ORDER_PRICE_FORMATED"],
                'main' => true
            ]
        ];
        if(!empty($this->arResult["JS_DATA"]["COUPON_LIST"])){
            foreach ($this->arResult["JS_DATA"]["COUPON_LIST"] as $coupon) {
                $result["order"]["coupons"][] = [
                    'label' => $coupon["COUPON"],
                    'status' => $coupon["STATUS_TEXT"],
                ];
            }
        }
        //
        return $result;
    }

    private function getPickupPoints(array $arDelivery){
        $arPickupPoints = [];
        if(!empty($this->currentCityId) && !empty($arDelivery["STORE"])) {
            $rsStores = \Bitrix\Catalog\StoreTable::getList([
                "filter" => ["=ID" => $arDelivery["STORE"], "ACTIVE" => "Y"],
                "order" => ["SORT" => "ASC"]
            ]);
            while ($arStore = $rsStores->fetch()){
                $arPickupPoints[] = [
                    "id" => $arStore["ID"],
                    "name" => $arStore["TITLE"],
                    "address" => $arStore["ADDRESS"],
                    "description" => $arStore["DESCRIPTION"],
                    "phone" => $arStore["PHONE"],
                    "schedule" => $arStore["SCHEDULE"],
                    "email" => $arStore["EMAIL"],
                    "coordinates" => [$arStore["GPS_N"], $arStore["GPS_S"]],
                ];
            }
        }
        return $arPickupPoints;
    }

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
                case "LOCATION":
                    $arProperties[$property["PERSON_TYPE_ID"]]["delivery"]["location"] = $property["ID"];
                break;
            }
        }
        return $arProperties;
    }

    private function getCurrentLocation(){
        if(!empty($GLOBALS["arRegion"])){
            $arCurrentRegion = $GLOBALS["arRegion"];
        }else{
            $arCurrentRegion = \Mirvendinga\Geo::getCurrentRegion();
        }
        return $arCurrentRegion;
    }
}