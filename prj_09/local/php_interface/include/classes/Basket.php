<?php

namespace Mirvendinga;

use \Bitrix\Main\Loader;
use \Bitrix\Sale;
use \Bitrix\Sale\PriceMaths;
use \Bitrix\Main\Context;
use \Bitrix\Currency\CurrencyManager;

Loader::includeModule("sale");
Loader::includeModule("catalog");

class Basket
{
    protected $siteId;
    protected $fUserId;

    protected $basket;
    protected $basketItems;

    public function __construct($siteId = 's1', $fUserId = 0)
    {
        if(!Loader::includeModule("sale") || !Loader::includeModule("catalog")) {
            throw new \Exception("Не установлены необходимые модули!");
        }
        $this->siteId = $siteId;
        $this->setFUserId($fUserId);
        $this->setBasket();
        $this->setBasketItems();
    }

    protected function setFUserId($fUserId)
    {
        $this->fUserId = $fUserId ? $fUserId : \Bitrix\Sale\FUser::getId();
    }

    protected function setBasket()
    {
        $this->basket = \Bitrix\Sale\Basket::loadItemsForFUser($this->fUserId, $this->siteId);
    }

    protected function getBasket()
    {
        return $this->basket;
    }

    protected function setBasketItems()
    {
        $this->basketItems = $this->basket->getBasketItems();
    }

    public function isProductInBasket(int $productId)
    {
        $basketItem = $this->getBasketItemByProductId($productId);

        return $basketItem ? true : false;
    }

    public function getBasketItemByProductId(int $productId)
    {

        $basketItem = null;

        if ($this->basketItems) {
            foreach ($this->basketItems as $item) {
                if ($item->getField('PRODUCT_ID') == $productId) {
                    $basketItem = $item;
                    break;
                }
            }
        }
        return $basketItem;
    }

    public function getBasketQuantityByProductId(int $productId)
    {
        $quantity = 0;
        $basketItem = $this->getBasketItemByProductId($productId);

        if ($basketItem) {
            $quantity = intval($basketItem->getField('QUANTITY'));
        }

        return $quantity;
    }

    public function getBasketList()
    {
        $basketList = [];

        foreach ($this->basketItems as $item) {
            $basketList[] = [
                'PRODUCT_ID' => $item->getField('PRODUCT_ID'),
                'QUANTITY' => $item->getField('QUANTITY')
            ];
        }

        return $basketList;
    }

    public function getNumberOfProducts()
    {
        $this->setBasketItems();
        $number = count($this->getBasketList());

        return $number;
    }

    public function setItemField($productId, $key, $value)
    {
        $item = $this->getBasketItemByProductId($productId);

        if ($item) {
            $item->setField($key, $value);
        }

        $this->basket->save();
    }

    public function createItem($productId, $quantity = 1, $arRegion = []) : bool
    {
        $status = false;
        if (!isEmpty($productId)) {
            $arCatalogData = \Mirvendinga\Catalog::getProductCatalogData($productId, $arRegion);
            $item = $this->basket->createItem('catalog', $productId);
            $item->setFields(array(
                'QUANTITY' => $quantity,
                'CURRENCY' => CurrencyManager::getBaseCurrency(),
                'LID' => Context::getCurrent()->getSite(),
                'CUSTOM_PRICE' => "Y",
                'PRICE' => PriceMaths::roundPrecision($arCatalogData["PRICE"]["VALUE"]),
                // Смысла нет - обновление корзины затрет
                /*'BASE_PRICE' => PriceMaths::roundPrecision($arCatalogData["PRICE"]["BASE_VALUE"]),
                'DISCOUNT_PRICE' => PriceMaths::roundPrecision($arCatalogData["PRICE"]["VALUE"]),*/
                'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
            ));
            $this->basket->save();
            $status = true;
        }
        return $status;
    }

    public function removeItem($productId)
    {

        if (!isEmpty($productId)) {
            //$item = $this->basket->createItem('catalog', $productId);
            $item = $this->getBasketItemByProductId($productId);
            if ($item) {
                $index = $item->getInternalIndex();
                $this->basket->deleteItem($index);
                $this->basket->save();
            }
        }
    }

    function recalculateBasketForRegion(array $arRegion) : array
    {
        $arResult = [
            "status" => true,
            "deletedProducts" => []
        ];
        $oldBasket = $this->getBasketList();
        if(count($oldBasket) > 0) {
            $this->basket->clearCollection();
            foreach ($oldBasket as $item) {
                $rsStoreInfo = \Bitrix\Catalog\StoreProductTable::getList([
                    "filter" => [
                        "PRODUCT_ID" => $item["PRODUCT_ID"],
                        "STORE_ID" => $arRegion["WAREHOUSE_IDS"],
                    ]
                ]);
                $flag = false;
                while($arStoreInfo = $rsStoreInfo->fetch()) {
                    if($arStoreInfo["AMOUNT"] >= $item["QUANTITY"]) {
                        $arResult["status"] &= $this->createItem($item["PRODUCT_ID"], $item["QUANTITY"], $arRegion);
                        $flag = true;
                        break;
                    }
                }
                if( $flag == false )
                {
                    $rsProduct = \Bitrix\Iblock\ElementTable::getById($item["PRODUCT_ID"]);
                    if($arProduct = $rsProduct->fetch()) {
                        $arResult["deletedProducts"][$arProduct["ID"]] = $arProduct["NAME"];
                    }
                }
            }
            $this->basket->save();
        }
        return $arResult;
    }

    /*
    function recalculateBasketForRegion_old(array $arRegion) : array
    {
        $arResult = [
            "status" => true,
            "deletedProducts" => []
        ];
        $oldBasket = $this->getBasketList();
        if(count($oldBasket) > 0) {
            $this->basket->clearCollection();
            foreach ($oldBasket as $item) {
                $rsStoreInfo = \Bitrix\Catalog\StoreProductTable::getList([
                    "filter" => [
                        "PRODUCT_ID" => $item["PRODUCT_ID"],
                        "STORE_ID" => $arRegion["STORAGE_ID"],
                    ]
                ]);
                if($arStoreInfo = $rsStoreInfo->fetch()) {
                    if($arStoreInfo["AMOUNT"] >= $item["QUANTITY"]) {
                        $arResult["status"] &= $this->createItem($item["PRODUCT_ID"], $item["QUANTITY"], $arRegion);
                    }else{
                        $rsProduct = \Bitrix\Iblock\ElementTable::getById($item["PRODUCT_ID"]);
                        if($arProduct = $rsProduct->fetch()) {
                            $arResult["deletedProducts"][$arProduct["ID"]] = $arProduct["NAME"];
                        }
                    }
                }
            }
            $this->basket->save();
        }
        return $arResult;
    }
    */
}