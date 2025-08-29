<?

namespace Mirvendinga;

use \Bitrix\Main\Loader;
use \Bitrix\Sale\PriceMaths;
use \Bitrix\Catalog as BCatalog;
use BitrixTools;
use CCurrencyLang;

class Catalog
{

    private const CATALOG_PROPERTIES_IB_ID = 49;

    public static function getProductCatalogData(int $productId, $arRegion = []): array
    {
        global $USER;
        if (
            !Loader::includeModule("iblock") ||
            !Loader::includeModule("catalog") ||
            !Loader::includeModule("sale")
        ) {
            throw new \Exception("Не подключены необходимые модули!");
        }
        //
        if (!empty($arRegion)) {
            $currentRegion = $arRegion;
        } else {
            $currentRegion = \Mirvendinga\Geo::getCurrentRegion();
        }
        $arPackageAmount = self::getProductPackageAmount($productId);
        // 41707 - если продаем упаковками
        if (!empty($arPackageAmount["IS_SOLD_IN_PACKS"]) && $arPackageAmount["PACKAGE_AMOUNT"] > 1) {
            $arPrice = self::getProductPrice($productId, $currentRegion, $arPackageAmount["PACKAGE_AMOUNT"]);
            $arUnitPrice = self::getProductPrice($productId, $currentRegion, 1);
            /*
            if ($USER->IsAdmin()) {
                echo '1';
                vardump($arUnitPrice);
                vardump($currentRegion);
            }
            */
        } else {
            $arPrice = self::getProductPrice($productId, $currentRegion, 1);
            $arUnitPrice = $arPrice;
            /*
            if ($USER->IsAdmin()) {
                echo '2';
                vardump($arUnitPrice);
            }
            */
        }
        //
        $arQuantity = self::getProductQuantity($productId, $currentRegion);
        $arCatalogData = [
            "PRICE" => $arPrice,
            "UNIT_PRICE" => $arUnitPrice,
            "QUANTITY" => $arQuantity,
            "PACKAGE_AMOUNT" => $arPackageAmount
        ];
        return $arCatalogData;
    }

    private static function getProductPrice(int $productId, array $arRegion, int $packageAmount): array
    {
        $arPrice = [
            "VALUE" => 0,
            "BASE_VALUE" => 0,
            "PRINT_BASE_VALUE" => "",
            "PRINT_VALUE" => "",
            "DISCOUNT_DIFF" => 0,
            "DISCOUNT_DIFF_PERCENT" => 0,
            "PRINT_DISCOUNT_VALUE" => "",
            "CURRENCY" => "",
        ];
        if ($packageAmount < 1) {
            $packageAmount = 1;
        }
        $priceGroupId = $arRegion["PRICE_ID"];
        if (!empty($priceGroupId)) {
            $rsPrice = BCatalog\PriceTable::getList([
                "filter" => [
                    "PRODUCT_ID" => $productId,
                    "CATALOG_GROUP_ID" => $priceGroupId
                ]
            ]);
            if ($price = $rsPrice->fetch()) {
                $arPriceResult = \CCatalogProduct::GetOptimalPrice(
                    $productId,
                    $packageAmount,
                    $arUserGroups = array(),
                    $renewal = "N",
                    $priceList = array($price)
                );
                $arPrice = [
                    "VALUE" => PriceMaths::roundPrecision($arPriceResult["RESULT_PRICE"]["DISCOUNT_PRICE"]) * $packageAmount,
                    "BASE_VALUE" => PriceMaths::roundPrecision($arPriceResult["RESULT_PRICE"]["BASE_PRICE"]) * $packageAmount,
                    "DISCOUNT_DIFF" => PriceMaths::roundPrecision($arPriceResult["RESULT_PRICE"]["DISCOUNT"]) * $packageAmount,
                    "DISCOUNT_DIFF_PERCENT" => $arPriceResult["RESULT_PRICE"]["PERCENT"],
                    "PRINT_DISCOUNT_VALUE" => CCurrencyLang::CurrencyFormat(PriceMaths::roundPrecision($arPriceResult["RESULT_PRICE"]["DISCOUNT"]) * $packageAmount, $arPriceResult["RESULT_PRICE"]['CURRENCY'], true),
                    "PRINT_BASE_VALUE" => CCurrencyLang::CurrencyFormat(PriceMaths::roundPrecision($arPriceResult["RESULT_PRICE"]["BASE_PRICE"]) * $packageAmount, $arPriceResult["RESULT_PRICE"]['CURRENCY'], true),
                    "PRINT_VALUE" => CCurrencyLang::CurrencyFormat(PriceMaths::roundPrecision($arPriceResult["RESULT_PRICE"]["DISCOUNT_PRICE"]) * $packageAmount, $arPriceResult["RESULT_PRICE"]['CURRENCY'], true),
                    "CURRENCY" => $arPriceResult["RESULT_PRICE"]['CURRENCY'],
                ];
            }
        }
        return $arPrice;
    }

    private static function getProductQuantity(int $productId, array $arRegion): array
    {
        $arQuantity = [
            //"STORAGE_ID" => 0,
            "STORAGES_IDS" => array(),
            "REGION_QUANTITY" => 0,
            "TOTAL_QUANTITY" => 0,
            "STATUS" => [
                "TEXT" => "Нет в наличии",
                "CLASS" => "product-snippet__availability_status_unavailable"
            ]
        ];
        if (!empty($arRegion["WAREHOUSE_IDS"])) {
            //$arQuantity["STORAGE_ID"] = $arRegion["STORAGE_ID"];
            $arQuantity["STORAGES_IDS"] = $arRegion["WAREHOUSE_IDS"];
            $rsStoreProduct = BCatalog\StoreProductTable::getList(array(
                'filter' => [
                    '=PRODUCT_ID' => $productId,
                    '=STORE_ID' => $arQuantity["STORAGES_IDS"],
                    'STORE.ACTIVE' => 'Y'
                ],
                'select' => array('*', 'UF_*'),
            ));
            while ($productQty = $rsStoreProduct->fetch()) {
                $amount = (intval($productQty["AMOUNT"]) > 0) ? intval($productQty["AMOUNT"]) : 0;
                $arQuantity["REGION_QUANTITY"] += $amount;
            }
            $rsCatalogProduct = BCatalog\ProductTable::getById($productId);
            if ($productCatalog = $rsCatalogProduct->fetch()) {
                $arQuantity["TOTAL_QUANTITY"] = (intval($productCatalog["QUANTITY"]) > 0) ? intval($productCatalog["QUANTITY"]) : 0;
            }
        }
        //vardump($arQuantity);
        // Выясняем статсуы
        if (!empty($arQuantity["REGION_QUANTITY"])) {
            $arQuantity["STATUS"] = [
                "TEXT" => "В наличии",
                "CLASS" => "snippet__availability_status_available"
            ];
        } elseif (empty($arQuantity["REGION_QUANTITY"]) && !empty($arQuantity["TOTAL_QUANTITY"])) {
            $arQuantity["STATUS"] = [
                "TEXT" => "В наличии на других складах",
                "CLASS" => "snippet__availability_status_available"
            ];
        }
        return $arQuantity;
    }
    
    /*
    private static function getProductQuantity_old(int $productId, array $arRegion): array
    {
        $arQuantity = [
            "STORAGE_ID" => 0,
            "REGION_QUANTITY" => 0,
            "TOTAL_QUANTITY" => 0,
            "STATUS" => [
                "TEXT" => "Нет в наличии",
                "CLASS" => "product-snippet__availability_status_unavailable"
            ]
        ];
        if (!empty($arRegion["STORAGE_ID"])) {
            $arQuantity["STORAGE_ID"] = $arRegion["STORAGE_ID"];
            $rsStoreProduct = BCatalog\StoreProductTable::getList(array(
                'filter' => [
                    '=PRODUCT_ID' => $productId,
                    '=STORE_ID' => $arQuantity["STORAGE_ID"],
                    'STORE.ACTIVE' => 'Y'
                ],
                'select' => array('*', 'UF_*'),
            ));
            if ($productQty = $rsStoreProduct->fetch()) {
                $arQuantity["REGION_QUANTITY"] = (intval($productQty["AMOUNT"]) > 0) ? intval($productQty["AMOUNT"]) : 0;
            }
            $rsCatalogProduct = BCatalog\ProductTable::getById($productId);
            if ($productCatalog = $rsCatalogProduct->fetch()) {
                $arQuantity["TOTAL_QUANTITY"] = (intval($productCatalog["QUANTITY"]) > 0) ? intval($productCatalog["QUANTITY"]) : 0;
            }
        }
        // Выясняем статсуы
        if (!empty($arQuantity["REGION_QUANTITY"])) {
            $arQuantity["STATUS"] = [
                "TEXT" => "В наличии",
                "CLASS" => "snippet__availability_status_available"
            ];
        } elseif (empty($arQuantity["REGION_QUANTITY"]) && !empty($arQuantity["TOTAL_QUANTITY"])) {
            $arQuantity["STATUS"] = [
                "TEXT" => "В наличии на других складах",
                "CLASS" => "snippet__availability_status_available"
            ];
        }
        return $arQuantity;
    }
    */

    // 41872 - Превью свойств в карточках товара
    private static function getCatalogProperties(): array
    {
        $arResult = [];
        if (Loader::includeModule("iblock")) {
            $iblockEntityClass = \Bitrix\Iblock\Iblock::wakeUp(self::CATALOG_PROPERTIES_IB_ID)->getEntityDataClass();
            $rsProperties = $iblockEntityClass::getList([
                'select' => ['ID', 'NAME', 'CODE', 'SORT', 'SHORT_PROPERTY_' => 'SHORT_PROPERTY'],
                'filter' => [
                    "!NAME" => false,
                    "!CODE" => false,
                    "ACTIVE" => "Y"
                ],
                'order' => ["SORT" => "ASC"]
            ]);
            while ($arProperty = $rsProperties->fetch()) {
                $arResult[] = [
                    "ID" => $arProperty["ID"],
                    "NAME" => $arProperty["NAME"],
                    "CODE" => $arProperty["CODE"],
                    "SORT" => $arProperty["SORT"],
                    "IS_SHORT" => !empty($arProperty["SHORT_PROPERTY_VALUE"]),
                ];
            }
        }
        return $arResult;
    }

    public static function getCatalogShortProperties(): array
    {
        $arResult = [];
        $arAllProperties = self::getCatalogProperties();
        if (!empty($arAllProperties)) {
            $arResult = array_filter($arAllProperties, function ($element) {
                return $element["IS_SHORT"];
            });
        }
        if (!empty($arResult)) {
            $arResult = array_map(function ($element) {
                return $element["NAME"] . " | " . $element["CODE"];
            }, $arResult);
        }
        return $arResult;
    }

    public static function getCatalogDetailShortProperties(): array
    {
        $arResult = self::getCatalogShortProperties();
        return $arResult;
    }

    public static function getCatalogDetailFullProperties(): array
    {
        $arResult = [];
        $arAllProperties = self::getCatalogProperties();
        if (!empty($arAllProperties)) {
            $arResult = array_map(function ($element) {
                return $element["NAME"] . " | " . $element["CODE"];
            }, $arAllProperties);
        }
        return $arResult;
    }
    // 41872 - END

    // 41707
    public static function getProductPackageAmount(int $productId): array
    {
        $arResult = [
            "MEASURE" => "шт",
            "PACKAGE_AMOUNT" => 0,
            "IS_SOLD_IN_PACKS" => false,
        ];
        $iblock = \Bitrix\Iblock\Iblock::wakeUp(CATALOG_IB_ID);
        $entityDataClass = $iblock->getEntityDataClass();
        $rsPackageAmount = $entityDataClass::getList([
            'select' => [
                'ID',
                'NAME',
                'CODE',
                'KOLICHESTVO_V_UPAKOVKE_' => 'KOLICHESTVO_V_UPAKOVKE_SHT',
            ],
            'filter' => [
                "IBLOCK_ID" => CATALOG_IB_ID,
                "ID" => $productId,
            ],
        ]);
        if ($arPackageAmount = $rsPackageAmount->fetch()) {
            $packageAmount = intval($arPackageAmount["KOLICHESTVO_V_UPAKOVKE_VALUE"]);
            if ($packageAmount > 1) {
                $arResult["MEASURE"] = "уп";
                $arResult["PACKAGE_AMOUNT"] = intval($packageAmount);
                $arResult["IS_SOLD_IN_PACKS"] = true;
            }
        }
        return $arResult;
    }

    public static function setSortRegion()
    {
        $arResult = [];

        if (Loader::includeModule("iblock")) {
            $arRegions = self::getPriceStorageMatrix();

            $rsIblock = \CIBlock::GetList([], ["CODE" => "catalog_main"]);
            if ($arIblock = $rsIblock->Fetch()) {
                //$arNavStartParams = array("nPageSize" => 5);
                $arNavStartParams = false;
                $rsItems = \CIBlockElement::GetList(
                    ["ID" => "ASC"],
                    [
                        "IBLOCK_ID" => $arIblock["ID"],
                        "ACTIVE" => "Y",
                        //'ID' => 26486
                    ],
                    false,
                    $arNavStartParams,
                    array(
                        "ID", "NAME", "CODE", "IBLOCK_ID",
                    )
                );
                while ($arItem = $rsItems->GetNext()) {

                    // Наличие на всех складах, используется для показа статуса "В наличии на других складах" -->
                    $ANY_STORE_HAS_STOCK = false;
                    $storeDB = \CCatalogStoreProduct::GetList(
                        array(),
                        array(
                            'PRODUCT_ID' => $arItem['ID']
                        ),
                        false,
                        false,
                        array("STORE_ID", 'STORE_NAME', 'AMOUNT'),
                    );

                    while ($store = $storeDB->GetNext()) {
                        $ANY_STORE_HAS_STOCK = $ANY_STORE_HAS_STOCK ? $ANY_STORE_HAS_STOCK : $store['AMOUNT'] > 0;
                    }
                    // <--

                    $PROPERTY_VALUES = array();
                    foreach ($arRegions as $code => $arRegion) {
                        //$arRegion["STORAGE_ID"] = $arRegion["STORE_ID"];
                        $arCatalogData = \Mirvendinga\Catalog::getProductCatalogData($arItem['ID'], $arRegion);

                        // Есть цена, есть в наличии в выбранном регионе
                        $itemStatusAvailable = !empty($arCatalogData["PRICE"]["VALUE"]) && !empty($arCatalogData["QUANTITY"]['REGION_QUANTITY']);
                        // Есть цена, нет в наличии
                        $itemStatusAvailableSomewhere = !$itemStatusAvailable && !empty($arCatalogData["PRICE"]["VALUE"]) && (!empty($arCatalogData["QUANTITY"]['TOTAL_QUANTITY']) || $ANY_STORE_HAS_STOCK);
                        // Нет цены, наличие не влияет
                        $itemStatusUnavailable = !$itemStatusAvailable && !$itemStatusAvailableSomewhere && !empty($arCatalogData["PRICE"]["VALUE"]);

                        /*
                        // Есть цена, есть в наличии в других регионах
                        $itemStatusCantBeBought = empty($arCatalogData["PRICE"]["VALUE"]);

                        // Показываем выбор количества и кнопку добавки в корзину только если у товара есть цена и он в наличии в нужном регионе
                        $showCart = $itemStatusAvailable;
                        // Сообщение доступности товара показывается только если его нет в наличии в нужном регионе (или совсем) или если товар недоступен к покупке
                        $showStatus = !$showCart;
                        // Показываем кнопку заказа товара только если у товара есть цена, но он не в наличии в нужном регионе
                        $showOrder = $itemStatusAvailableSomewhere || $itemStatusUnavailable;
                        */

                        // Сортировки -->
                        $val = '';
                        if ($itemStatusAvailable) {
                            $val = '10';
                        } else if ($itemStatusAvailableSomewhere) {
                            $val = '20';
                            //} else if ($itemStatusUnavailable) {
                        } else {
                            $val = '30';
                        }
                        if (!empty($val)) {
                            $PROPERTY_VALUES['SORT_' . $code] = $val;
                        }
                        // <-- Сортировки
                        //vardump($arRegion);
                        //vardump($arCatalogData);
                    }
                    if (!empty($PROPERTY_VALUES)) {
                        \CIBlockElement::SetPropertyValuesEx(
                            $arItem['ID'],
                            $arItem['IBLOCK_ID'],
                            $PROPERTY_VALUES
                        );
                    }
                }
            }
        }

        return $arResult;
    }

    private static function getPriceStorageMatrix(): array
    {
        $arResult = [];
        if (Loader::includeModule("iblock")) {
            $rsIblock = \CIBlock::GetList([], ["CODE" => "regions"]);
            if ($arIblock = $rsIblock->Fetch()) {
                //$arSelect = ["ID", "NAME", "CODE", "PROPERTY_PRICE_ID", "PROPERTY_STORE_ID"];
                $arSelect = false;
                $rsRegions = \CIBlockElement::GetList(
                    ["ID" => "ASC"],
                    [
                        "IBLOCK_ID" => $arIblock["ID"],
                        "ACTIVE" => "Y"
                    ],
                    false,
                    false,
                    $arSelect
                );
                while ($ob = $rsRegions->GetNextElement()) {
                    $arRegion = $ob->GetFields();
                    $arRegion['PROPERTIES'] = $ob->GetProperties();
                    
                    $arResult[$arRegion["CODE"]] = [
                        "PRICE_ID" => intval($arRegion['PROPERTIES']['PRICE_ID']['VALUE']),
                        //"STORE_ID" => intval($arRegion['PROPERTIES']["STORE_ID"]['VALUE']),
                        //"STORAGE_ID" => intval($arRegion['PROPERTIES']["STORE_ID"]['VALUE']),
                        "WAREHOUSE_IDS" => $arRegion['PROPERTIES']['WAREHOUSE_IDS']['VALUE']
                    ];
                }
                /*
                $rsRegions = \CIBlockElement::GetList(
                    ["ID" => "ASC"],
                    [
                        "IBLOCK_ID" => $arIblock["ID"],
                        "ACTIVE" => "Y"
                    ],
                    false,
                    false,
                    ["ID", "NAME", "CODE", "PROPERTY_PRICE_ID", "PROPERTY_STORE_ID"]
                );
                while ($arRegion = $rsRegions->GetNext()) {
                    $arResult[$arRegion["CODE"]] = [
                        "PRICE_ID" => intval($arRegion["PROPERTY_PRICE_ID_VALUE"]),
                        "STORE_ID" => intval($arRegion["PROPERTY_STORE_ID_VALUE"])
                    ];
                }
                */
            }
        }
        return $arResult;
    }

    /**
     * Метод, который проходится по всем элементам ИБ Каталог и проставляет в свойство Привязка к разделам значения, все уровни вложенности
     */
    public static function setSectionsLinks()
    {
        $IBLOCK_ID = BitrixTools::getIblockId('catalog_main', '1c_goods');
        if (!empty($IBLOCK_ID)) {

            // Выборка разделов -->
            $arSections = array();
            $arFilter = array('IBLOCK_ID' => $IBLOCK_ID, 'GLOBAL_ACTIVE' => 'Y', 'PROPERTY' => array('SRC' => 'https://%'));
            $db_list = \CIBlockSection::GetList(array($by => $order), $arFilter, true);
            while ($ar_result = $db_list->GetNext()) {
                $list = \CIBlockSection::GetNavChain(false, $ar_result['ID'], array(), true);
                $arSections[$ar_result['ID']][] = $ar_result['ID'];
                foreach ($list as $arSectionPath) {
                    $arSections[$ar_result['ID']][] = $arSectionPath['ID'];
                }
            }
            // <-- Выборка разделов

            $arSelect = array("ID", "NAME", "IBLOCK_SECTION_ID", "IBLOCK_SECTION");
            //$arSelect = false;
            $arFilter = array("IBLOCK_ID" => $IBLOCK_ID, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
            $res = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();

                $arElementSections = [];

                $arGroups = BitrixTools::getAllGroupsOfElement($arFields['ID']);

                foreach ($arGroups as $sectionId) {
                    $arElementSections[] = $sectionId;
                    foreach ($arSections[$sectionId] as $sId) {
                        $arElementSections[] = $sId;
                    }
                }

                if (!empty($arElementSections)) {
                    $arElementSections = array_unique($arElementSections);
                }

                /*
                if ($arFields['ID'] == 28115) {
                    vardump($arFields);
                    vardump($arGroups);
                    vardump($arElementSections);
                }
                */

                if (!empty($arElementSections)) {
                    \CIBlockElement::SetPropertyValuesEx(
                        $arFields['ID'],
                        $IBLOCK_ID,
                        array('SECTIONS_LINK' => $arElementSections)
                    );
                }

                //if( !empty( $arSections ) )
            }
        }
    }
}
