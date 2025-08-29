<?php

namespace Waim\Components;

use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;
use CBitrixComponent;

class GeoSearchComponent extends CBitrixComponent implements Controllerable, Errorable
{
    protected ErrorCollection $errorCollection;

    public function onPrepareComponentParams($arParams)
    {
        $this->errorCollection = new ErrorCollection();

        return $arParams;
    }

    public function executeComponent()
    {
        if (!empty($GLOBALS["arRegion"])) {
            $this->arResult["CURRENT_REGION"] = $GLOBALS["arRegion"];
        } else {
            $this->arResult["CURRENT_REGION"] = \Mirvendinga\Geo::getCurrentRegion();
        }
        $this->arResult["SHOW_POPUP"] = \Mirvendinga\Geo::showPopUp();
        $this->arResult["TOP_REGIONS"] = $this->getTopRegions();
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

    // Actions
    public function configureActions(): array
    {
        return [
            'selectCity' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod([ActionFilter\HttpMethod::METHOD_POST])
                ]
            ],
            'searchCity' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod([ActionFilter\HttpMethod::METHOD_POST])
                ]
            ],
            'confirmCity' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod([ActionFilter\HttpMethod::METHOD_POST])
                ]
            ],
        ];
    }

    public function selectCityAction(int $cityId): array
    {
        if (!empty($cityId)) {
            $arRegion = \Mirvendinga\Geo::getRegionById($cityId);
            if (!empty($arRegion)) {
                $cookie = new \Bitrix\Main\Web\Cookie(\Mirvendinga\Geo::COOKIE_NAME, $cityId);
                $cookie->setPath("/");
                \Bitrix\Main\Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
                \Bitrix\Main\Application::getInstance()->getContext()->getResponse()->writeHeaders("");
                // Пересобираем корзину
                $obBasket = new \Mirvendinga\Basket();
                $recalculateResult = $obBasket->recalculateBasketForRegion($arRegion);
                //
                return [
                    "status" => $recalculateResult["status"] && true,
                    "cityId" => $arRegion["ID"],
                    "cityName" => $arRegion["NAME"],
                    "deletedProducts" => $recalculateResult["deletedProducts"]
                ];
            }
        }
        return [
            "status" => false,
            "cityName" => false,
        ];
    }

    public function searchCityAction(string $searchQuery): array
    {
        if (!empty($searchQuery) && mb_strlen($searchQuery) > 2) {
            $arCities = \Mirvendinga\Geo::getRegionByName($searchQuery);
            return [
                "status" => true,
                "cities" => $arCities,
            ];
        } else {
            return [
                "status" => true,
                "cities" => $this->getTopRegions(),
            ];
        }
    }

    public function confirmCityAction(int $currentCityId): array
    {
        if (!empty($currentCityId)) {
            $cookie = new \Bitrix\Main\Web\Cookie(\Mirvendinga\Geo::COOKIE_NAME, $currentCityId);
            $cookie->setPath("/");
            \Bitrix\Main\Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
            \Bitrix\Main\Application::getInstance()->getContext()->getResponse()->writeHeaders("");
        }
        return [
            "status" => true,
        ];
    }

    private function getTopRegions(): array
    {
        $arRegions = \Mirvendinga\Geo::getAllRegions();
        return array_slice($arRegions, 0, 8);
    }
}
