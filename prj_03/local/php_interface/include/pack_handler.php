<?

use \Bitrix\Main\Loader;
use \Bitrix\Iblock;
use Bitrix\Sale\PriceMaths;

class packHandler
{
    private static $catalogIblockId = 34;
    private static $packProductId = 155985;

    public static function getPackData(int $productId, int $amount = 0) : array
    {
        $arResult = [
            "MIN_QUANTITY_BUY" => 1,
            "MIN_PACK_VALUE" => 0,
            "MIN_PACK_VALUE_PRICE" => 0,
            "MIN_PACK_VALUE_MESSAGE" => "",
            "DEFAULT_PACK_VALUE" => 1
        ];
        if(!Loader::includeModule("iblock") || !Loader::includeModule("catalog")){
            return $arResult;
        }
        $minPackValue = self::getMinPackValue($productId);
        if(!empty($minPackValue)) {
            $arResult["MIN_PACK_VALUE"] = intval($minPackValue);
            if(empty($amount)){
                $amount = intval($minPackValue);
            }
            $rsProduct = Iblock\ElementTable::getList([
                "filter" => [
                    "ACTIVE" => "Y",
                    "IBLOCK_ID" => self::$catalogIblockId,
                    "ID" => $productId,
                ],
                "select" => ["ID", "SORT", "NAME", "IBLOCK_ID"],
            ]);
            if ($arProduct = $rsProduct->fetch()) {
                $arOffers = CCatalogSKU::getOffersList($arProduct, self::$catalogIblockId);
                if ($arOffers) {
                    $arProduct["OFFERS"] = $arOffers;
                }
                $productQty = getProductQty($arProduct);
                //
                $shopAvailableAmount = $productQty["AVAILABLE"];
                $storeAvailableAmount = $productQty["ORDER"];
                $amountToOrder = $amount - $shopAvailableAmount;
                /*
                 - если товар есть на складе клиента, никакие дополнительные цены не начисляются
                 - если товар находится на складе поставщика, и в корзине товара МЕНЬШЕ, чем задано в значении "Минимальная упаковка", то в корзине необходимо автоматически добавлять к сумме заказа 50 руб. и выводить сообщение, что это "мелкооптовая упаковка":
                 - если товар на складе поставщика и в корзине товара сколько и в минимальной упаковке или больше - доплата не требуется.
                 - если товара нет на складе поставщика (статус "под заказ"), то заказать можно минимум кол-во равное "минимальной упаковке"
                 */
                if($amount > $shopAvailableAmount && $amountToOrder > 0){
                    if($amountToOrder <= $storeAvailableAmount){ // есть кол-во под заказ
                        if($amountToOrder < $minPackValue){
                            // доплата
                            $arResult["MIN_QUANTITY_BUY"] = $amount;
                            $arResult["MIN_PACK_VALUE_PRICE"] = self::getMinPackPrice();
                            $arResult["MIN_PACK_VALUE_MESSAGE"] = "Мелкооптовая упаковка";
                        }else{
                            $arResult["MIN_QUANTITY_BUY"] = $amount;
                        }
                    }
                    else{ // нет кол-ва на складе
                        $packsCount = ceil(($amountToOrder - $storeAvailableAmount) / $minPackValue);
                        // заказать можно только все что есть + еще упаковки
                        $arResult["MIN_QUANTITY_BUY"] = ($shopAvailableAmount + $storeAvailableAmount) + ($packsCount * $minPackValue);
                    }
                    $arResult["DEFAULT_PACK_VALUE"] = $minPackValue;
                }else{
                    $arResult["MIN_QUANTITY_BUY"] = $amount;
                }
            }
        }
        return $arResult;
    }

    private static function getMinPackValue(int $productId) : int
    {
        $result = 0;
        $rsTraitsMinPack = \Bitrix\Iblock\ElementPropertyTable::getList([
            "select" => ["*"],
            "filter" => [
                "PROP.ACTIVE" => "Y",
                "PROP.IBLOCK_ID" => self::$catalogIblockId,
                "PROP.CODE" => "CML2_TRAITS",
                "IBLOCK_ELEMENT_ID" => $productId,
                "DESCRIPTION" => "Минимальная упаковка"
            ],
            'runtime' => array(
                'PROP' => array(
                    'data_type' => \Bitrix\Iblock\PropertyTable::class,
                    'reference' => array(
                        '=this.IBLOCK_PROPERTY_ID' => 'ref.ID'
                    ),
                    'join_type' => 'left'
                )
            )
        ]);
        if($arTraitsMinPack = $rsTraitsMinPack->fetch()){
            $result = intval($arTraitsMinPack["VALUE"]);
        }
        return $result;
    }

    public static function OnBeforeBasketUpdateHandler(\Bitrix\Sale\BasketItem $item) : bool
    {
        $productId = $item->getField('PRODUCT_ID');
        if(!empty($productId)) {
            $arPackData = self::getPackData($productId, intval($item->getQuantity()));
            if(!empty($arPackData) && !empty($arPackData["MIN_PACK_VALUE"])){
                $arProps = [];
                if(!empty($arPackData["MIN_PACK_VALUE"])) {
                    $arProps[] = [
                        'NAME' => 'Минимальная упаковка',
                        'CODE' => 'MIN_PACK_VALUE',
                        'VALUE' => $arPackData["MIN_PACK_VALUE"]." шт.",
                        'SORT' => 100,
                    ];
                }
                if(!empty($arPackData["MIN_PACK_VALUE_PRICE"]) && !empty($arPackData["MIN_PACK_VALUE_MESSAGE"])) {
                    $arProps[] = [
                        'NAME' => $arPackData["MIN_PACK_VALUE_MESSAGE"],
                        'CODE' => 'MIN_PACK_VALUE_PRICE',
                        'VALUE' => $arPackData["MIN_PACK_VALUE_PRICE"]." руб.",
                        'SORT' => 200,
                    ];
                }
                if(!empty($arProps)){
                    $basketPropertyCollection = $item->getPropertyCollection();
                    $basketPropertyCollection->redefine($arProps);
                    $basketPropertyCollection->save();
                }
                if(!empty($arPackData["MIN_QUANTITY_BUY"])) {
                    $item->setField("QUANTITY", intval($arPackData["MIN_QUANTITY_BUY"]));
                }
            }
        }
        return true;
    }

    public static function OnSaleComponentOrderJsDataHandler(&$arResult, &$arParams) : bool
    {
        foreach ($arResult["GRID"]["ROWS"] as $rowId => &$arBasketItem){
            if(!empty($arBasketItem['data']["PROPS"])){
                foreach ($arBasketItem['data']["PROPS"] as $arProperty) {
                    if($arProperty["CODE"] == "MIN_PACK_VALUE_PRICE" && !empty($arProperty["VALUE"])) {
                        $propValue = preg_replace('/[^\d]+/i', '', $arProperty["VALUE"]);
                        if(!empty($propValue)) {
                            $arBasketItem['data']['SUM_NUM'] = PriceMaths::roundPrecision($arBasketItem['data']['SUM_NUM'] + intval($propValue));
                            $arBasketItem['data']['SUM'] = CCurrencyLang::CurrencyFormat($arBasketItem['data']['SUM_NUM'], $arBasketItem['data']['CURRENCY'], true);
                            //
                            $arResult["ORDER_TOTAL_PRICE"] = PriceMaths::roundPrecision($arResult["ORDER_TOTAL_PRICE"] + intval($propValue));
                            $arResult["ORDER_TOTAL_PRICE_FORMATED"] = CCurrencyLang::CurrencyFormat($arResult["ORDER_TOTAL_PRICE"], $arBasketItem['data']['CURRENCY'], true);
                            $arResult["ORDER_PRICE"] = PriceMaths::roundPrecision($arResult["ORDER_PRICE"] + intval($propValue));
                            $arResult["ORDER_PRICE_FORMATED"] = CCurrencyLang::CurrencyFormat($arResult["ORDER_PRICE"], $arBasketItem['data']['CURRENCY'], true);
                        }
                    }
                }
            }
        }
        return true;
    }

    public static function OnSaleOrderBeforeSavedHandler(\Bitrix\Sale\Order $order) : \Bitrix\Main\EventResult
    {
        $basket = $order->getBasket();
        $basketItems = $basket->getBasketItems();
        $minPacksCount = 0;
        foreach ($basketItems as $basketItem) {
            $basketPropertyCollection = $basketItem->getPropertyCollection();
            foreach($basketPropertyCollection as $propertyItem){
                if($propertyItem->getField("CODE") == "MIN_PACK_VALUE_PRICE" && !empty($propertyItem->getField("VALUE"))) {
                    $minPacksCount++;
                }
            }
        }
        if(!empty($minPacksCount)){
            $newBasketItem = $basket->createItem('catalog', self::$packProductId);
            $newBasketItem->setFields(array(
                'QUANTITY' => $minPacksCount,
                'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
                'LID' => SITE_ID,
                'PRODUCT_PROVIDER_CLASS' => '\CCatalogProductProvider',
            ));

            $basket->save();
        }
        return new \Bitrix\Main\EventResult(
            \Bitrix\Main\EventResult::SUCCESS
        );
    }

    private static function getMinPackPrice() : int
    {
        $result = 0;
        if(\Bitrix\Main\Loader::includeModule("catalog")) {
            $arPackProductPrice = \CCatalogProduct::GetOptimalPrice(self::$packProductId, 1);
            if(!empty($arPackProductPrice)){
                $result = floatval($arPackProductPrice["RESULT_PRICE"]["DISCOUNT_PRICE"]);
            }
        }
        return $result;
    }
}

// events

AddEventHandler( "sale", "OnSaleBasketItemBeforeSaved", array( "packHandler", "OnBeforeBasketUpdateHandler" ) );
AddEventHandler( "sale", "OnSaleComponentOrderJsData", array( "packHandler", "OnSaleComponentOrderJsDataHandler" ) );
AddEventHandler( "sale", "OnSaleOrderBeforeSaved", array( "packHandler", "OnSaleOrderBeforeSavedHandler" ) );