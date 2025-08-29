<?

namespace First;

\Bitrix\Main\Loader::includeModule("catalog");
\Bitrix\Main\Loader::includeModule("iblock");
\Bitrix\Main\Loader::includeModule("sale");


class Catalog
{
    public static function setNewBreadcrumbsInProductDetail($elementCode, $sectionCodeInput)
    {
        global $APPLICATION;

        $arResult = array();

        // Определить предыдущую страницу -->
        $prevPageUrl = $_SERVER['HTTP_REFERER'];
        //echo 'prevPageUrl = ' . $prevPageUrl . '<br />';
        //echo 'elementCode = '.$elementCode.'<br />';
        //echo 'sectionCodeInput = '.$sectionCodeInput.'<br />';
        $arUrlParts = explode('/', $prevPageUrl);
        //vardump($arUrlParts);
        // <--

        if (!empty($elementCode) && !empty($sectionCodeInput) && !empty($prevPageUrl)) {

            // Параметры кеширования -->
            $cacheParams = array('ELEMENT_CODE' => $elementCode);

            $cacheTime = 86400;
            //$cacheTime = 0;
            $cacheId = serialize($cacheParams);
            $cacheFolder = "/iblock/catalog";
            // <-- 

            $obCache = new \CPHPCache();
            if ($obCache->InitCache($cacheTime, $cacheId, $cacheFolder)) {
                $arResultCache = $obCache->GetVars();
            } elseif ($obCache->StartDataCache()) {
                $arResultCache = array();

                // Параметры товара -->
                $arElement = array();
                $arSelect = array('ID', 'IBLOCK_SECTION_ID', 'SECTION_ID');
                $arFilter = array(
                    "IBLOCK_ID" => IBLOCK_ID_CATALOG,
                    "CODE" => $elementCode,
                );
                $res = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                if ($ob = $res->GetNextElement()) {
                    //while($arFields = $res->GetNext()){
                    $arFields = $ob->GetFields();
                    //$arFields['PROPERTIES'] = $ob->GetProperties();

                    $arElement = array(
                        'ID' => $arFields['ID'],
                        //'SECTION_ID' => $arFields['IBLOCK_SECTION_ID'],
                    );

                    $db_groups = \CIBlockElement::GetElementGroups($arFields['ID'], true);
                    while ($ar_group = $db_groups->Fetch()) {
                        $arElement['IBLOCK_SECTION_ID'][] = $ar_group['ID'];
                    }
                }
                // <-- 


                // Определить, предыдущая страница раздел или нет -->
                $arSection = array();
                if (!empty($prevPageUrl) && !empty($arElement) && !empty($arUrlParts) && $arUrlParts[3] == 'katalog') {
                    $sectionCode = $arUrlParts[(count($arUrlParts) - 2)];

                    if ($sectionCode != 'katalog' && !empty($sectionCode)) {
                        $arFilter = array(
                            'IBLOCK_ID' => IBLOCK_ID_CATALOG,
                            'CODE' => $sectionCode,
                        );
                        $db_list = \CIBlockSection::GetList(array($by => $order), $arFilter, true);
                        if ($ar_result = $db_list->GetNext()) {
                            // Проверка -->
                            $bSet = false;
                            if (in_array($ar_result['ID'], $arElement['IBLOCK_SECTION_ID'])) {
                                $bSet = true;
                            }
                            if ($bSet == false) {
                                // Родительские разделы -->
                                //$arParentSectionsIds = array();
                                $list = \CIBlockSection::GetNavChain(false, $ar_result['ID'], ['ID'], true);
                                foreach ($list as $arSectionPath) {
                                    if (in_array($arSectionPath['ID'], $arElement['IBLOCK_SECTION_ID'])) {
                                        $bSet = true;
                                    }
                                    //$arParentSectionsIds[] = $arSectionPath['ID'];
                                }
                                // <--
                            }
                            // <--

                            if ($bSet == true) {
                                //echo 'В разделе!';
                                $arSection = array(
                                    'ID' => $ar_result['ID'],
                                    'CODE' => $ar_result['CODE'],
                                );
                            }
                        }
                    }
                }
                // <--



                // Если предыдущая страница - раздел и он отличается от основного, то сформировать новые ХК, если не отличается - оставить как есть -->
                $arSectionsChain = array();
                if (!empty($arSection) && $sectionCodeInput != $arSection['CODE']) {
                    $list = \CIBlockSection::GetNavChain(false, $arSection['ID'], ['ID', 'NAME', 'DEPTH_LEVEL', 'SECTION_PAGE_URL'], true);
                    foreach ($list as $arSectionPath) {
                        $rsSection = \CIBlockSection::GetByID($arSectionPath['ID']);
                        if ($arSection = $rsSection->GetNext()) {
                            $arSectionsChain[] = array(
                                'NAME' => $arSectionPath['NAME'],
                                //'SECTION_PAGE_URL' => $arSectionPath['SECTION_PAGE_URL'],
                                'SECTION_PAGE_URL' => $arSection['SECTION_PAGE_URL'],
                            );
                        }
                    }
                }
                // <--

                //vardump($arSection);
                //vardump($arElement);
                //vardump($arSectionsChain);

                if (!empty($arSection)) {
                    $arResultCache['arSection'] = $arSection;
                }
                if (!empty($arElement)) {
                    $arResultCache['arElement'] = $arElement;
                }
                if (!empty($arSectionsChain)) {
                    $arResultCache['arSectionsChain'] = $arSectionsChain;
                }

                $obCache->EndDataCache($arResultCache);
            }

            //vardump($arResultCache);

            if (!empty($arResultCache['arSectionsChain'])) {
                $arResult['SET_NEW_CHAIN'] = 'Y';
                foreach ($arResultCache['arSectionsChain'] as $arChain) {
                    $APPLICATION->AddChainItem($arChain['NAME'], $arChain['SECTION_PAGE_URL']);
                }
            }
        }

        return $arResult;
    }

    public static function useFilter()
    {
        global $APPLICATION;

        $USE_FILTER = "Y";
        $page = $APPLICATION->GetCurPage();
        //echo 'page = '.$page.'<br />';
        $arUrlsNotShowFilter = array(
            "/katalog/spetsodezhda/",
            "/katalog/obuv/",
            "/katalog/siz/",
            "/katalog/zashchita_ruk/",
            "/katalog/bezopasnost_rabochego_mesta/",
            "/katalog/soputstvuyushchie_tovary/",
            "/katalog/soputstvuyushchie_tovary/myagkiy_inventar_tekstil/",
            "/katalog/soputstvuyushchie_tovary/bytovaya_tekhnika/",
            "/katalog/soputstvuyushchie_tovary/bytovaya_khimiya/",
            "/katalog/soputstvuyushchie_tovary/avtotovary/",
            "/katalog/soputstvuyushchie_tovary/khoztovary/",
            "/katalog/soputstvuyushchie_tovary/instrumenty_i_remont/",
            "/katalog/soputstvuyushchie_tovary/demooborudovanie/",
            "/katalog/soputstvuyushchie_tovary/kantstovary_i_ofis/",
            "/katalog/soputstvuyushchie_tovary/upakovka/",
            "/katalog/soputstvuyushchie_tovary/posuda/",
            "/katalog/soputstvuyushchie_tovary/mebel/",
            "/katalog/soputstvuyushchie_tovary/elektrotovary_i_osveshchenie/",
        );
        if (in_array($page, $arUrlsNotShowFilter)) {
            $USE_FILTER = "N";
        }

        return $USE_FILTER;
    }

    public static function getPropsForProductDetail($flag = 'all')
    {
        $arExcludeCodes = array();
        if ($flag == 'exclude') {
            $filename = $_SERVER["DOCUMENT_ROOT"] . '/local/tools/exclude_props_product_detail.txt';
            if (is_file($filename)) {
                $arExcludeCodesTmp = file($filename);
                if (is_array($arExcludeCodesTmp) && !empty($arExcludeCodesTmp)) {
                    foreach ($arExcludeCodesTmp as $val) {
                        if (!empty($val)) {
                            $arExcludeCodes[] = $val;
                        }
                    }
                }
            }
        }

        $DETAIL_PROPERTY_CODE = array();
        $IBLOCK_ID = \BitrixTools::getIblockId('catalog', 'aspro_mshop_catalog');
        if (empty($IBLOCK_ID)) {
            $IBLOCK_ID = 34;
        }
        if (!empty($IBLOCK_ID)) {
            $properties = \CIBlockProperty::GetList(
                array("sort" => "asc", "name" => "asc"),
                array("ACTIVE" => "Y", "IBLOCK_ID" => $IBLOCK_ID)
            );
            while ($prop_fields = $properties->GetNext()) {
                if (!in_array($prop_fields['ID'], $arExcludeCodes)) {
                    $DETAIL_PROPERTY_CODE[] = $prop_fields['CODE'];
                }
                //echo $prop_fields["ID"] . " - " . $prop_fields["NAME"] . "<br>";
            }
        }
        //vardump($DETAIL_PROPERTY_CODE);

        return $DETAIL_PROPERTY_CODE;
    }

    public static function getSwpPrice()
    {
        $ar_res = \CPrice::GetBasePrice(SWP_PRODUCT_ID);
        return $ar_res["PRICE"];
        /*
        $allProductPrices = \Bitrix\Catalog\PriceTable::getList([
            "filter" => [
                "PRODUCT_ID" => SWP_PRODUCT_ID,
            ]
        ])->fetchAll();
        */
    }

    public static function addOrDelSwpInBasket()
    {
        \Bitrix\Main\Loader::includeModule("catalog");
        \Bitrix\Main\Loader::includeModule("iblock");
        \Bitrix\Main\Loader::includeModule("sale");

        // ID товаров в корзине -->
        $arProductsIds = [];
        $arBasketItems = [];
        $arBasketItemsByProductId = [];
        $arBasketQuants = [];
        $dbBasketItems = \CSaleBasket::GetList(
            array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
            array(
                "FUSER_ID" => \CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL"
            ),
            false,
            false,
            array(
                "ID",
                "CALLBACK_FUNC",
                "MODULE",
                "PRODUCT_ID",
                "QUANTITY",
                "DELAY",
                "CAN_BUY",
                "PRICE",
                "WEIGHT"
            )
        );
        while ($arItems = $dbBasketItems->Fetch()) {

            // -->
            $mainProductId = 0;
            $intElementID = $arItems['PRODUCT_ID']; // ID предложения
            $mxResult = \CCatalogSku::GetProductInfo(
                $intElementID
            );
            if (is_array($mxResult)) {
                $mainProductId = $mxResult['ID'];
            }
            if ($mainProductId == 0) {
                $mainProductId = $arItems['PRODUCT_ID'];
            }
            // <--

            // -->
            $arCatalogQty = getProductQty(array('ID' => $arItems['PRODUCT_ID']));
            $arItems['AVAILABLE'] = $arCatalogQty['AVAILABLE'];
            // <--

            $arProductsIds[] = $mainProductId;

            $arBasketItems[$arItems['ID']] = $arItems;
            $arBasketItems[$arItems['ID']]['MAIN_PRODUCT_ID'] = $mainProductId;

            $arBasketQuants[$mainProductId]['QUANTITY'] += $arItems['QUANTITY'];

            $arBasketItemsByProductId[$arItems['PRODUCT_ID']] = $arItems;
        }
        // <-- ID товаров в корзине


        // Параметры -->
        if (!empty($arProductsIds)) {
            $arSelect = false;
            $arFilter = array("ID" => $arProductsIds, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
            $res = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arFields['PROPERTIES'] = $ob->GetProperties();

                // Минимальный размер упаковки -->
                if (!empty($arFields['PROPERTIES']['CML2_TRAITS']['VALUE'])) {
                    foreach ($arFields['PROPERTIES']['CML2_TRAITS']['VALUE'] as $key => $val) {
                        if ($arFields['PROPERTIES']['CML2_TRAITS']['DESCRIPTION'][$key] == 'Минимальная упаковка') {
                            $arFields['MINIMUM_QUANTITY_PER_PACKAGE'] = $val;
                        }
                    }
                }

                if (!empty($arFields['MINIMUM_QUANTITY_PER_PACKAGE'])) {
                    $arBasketQuants[$arFields['ID']]['MINIMUM_QUANTITY_PER_PACKAGE'] = $arFields['MINIMUM_QUANTITY_PER_PACKAGE'];
                }
                // <-- Минимальный размер упаковки


            }
        }
        // <-- Параметры

        // Выясним, сколько должно быть Мелкооптовой упаковки в корзине -->
        $countSwp = 0;
        foreach ($arBasketItems as $basketId => $arItem) {
            if (!empty($arItem['MAIN_PRODUCT_ID']) && !empty($arBasketQuants[$arItem['MAIN_PRODUCT_ID']]['MINIMUM_QUANTITY_PER_PACKAGE'])) {
                $max_qty = $arItem['AVAILABLE'];
                $qty = $arItem['QUANTITY'];
                $needSwp = false;
                $startQuantityNum = $arBasketQuants[$arItem['MAIN_PRODUCT_ID']]['MINIMUM_QUANTITY_PER_PACKAGE'];

                if ($qty > 0) {
                    if ($qty <= $max_qty) {
                        $needSwp = false;
                    } else {
                        if ($qty > $max_qty && $qty < $startQuantityNum) {
                            $needSwp = true;
                        } else if ($qty == $startQuantityNum) {
                            $needSwp = false;
                        } else if ($qty > $startQuantityNum) {
                            if ($qty > $startQuantityNum && $qty <= ($startQuantityNum + $max_qty)) {
                                $needSwp = false;
                            } else if ($qty > ($startQuantityNum + $max_qty)) {
                                $whole_digit = intval($qty / $startQuantityNum);
                                $whole_digit_up = ceil($qty / $startQuantityNum);
                                //console.log((whole_digit_up * startQuantityNum));
                                //console.log((whole_digit_up * startQuantityNum  + max_qty ));
                                if ($qty >= ($whole_digit * $startQuantityNum) && $qty <= ($whole_digit * $startQuantityNum  + $max_qty)) {
                                    $needSwp = false;
                                } else {
                                    if ($qty >= ($whole_digit_up * $startQuantityNum) && $qty <= ($whole_digit_up * $startQuantityNum  + $max_qty)) {
                                        $needSwp = false;
                                    } else {
                                        $needSwp = true;
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if (($qty % $startQuantityNum) != 0) {
                        $needSwp = true;
                    }
                }

                if ($needSwp == true) {
                    $countSwp++;
                }
            }
        }
        // <-- Выясним, сколько должно быть Мелкооптовой упаковки в корзине


        // Удалим Мелкооптовую упаковку из корзины -->
        if ($countSwp <= 0 && !empty($arBasketItemsByProductId[SWP_PRODUCT_ID])) {
            \CSaleBasket::Delete($arBasketItemsByProductId[SWP_PRODUCT_ID]['ID']);
        }
        // <-- Удалим Мелкооптовую упаковку из корзины

        if ($countSwp > 0) {
            if (!empty($arBasketItemsByProductId[SWP_PRODUCT_ID])) {
                $curCountSwp = $arBasketItemsByProductId[SWP_PRODUCT_ID]['QUANTITY'];
                if ($countSwp != $curCountSwp) {
                    $arFields = array(
                        "QUANTITY" => $countSwp,
                    );
                    \CSaleBasket::Update($arBasketItemsByProductId[SWP_PRODUCT_ID]['ID'], $arFields);
                }
            } else {
                //Add2BasketByProductID(SWP_PRODUCT_ID);
                $fields = [
                    'PRODUCT_ID' => SWP_PRODUCT_ID, // ID товара, обязательно
                    'QUANTITY' => $countSwp, // количество, обязательно
                    /*
                    'PROPS' => [
                        ['NAME' => 'Test prop', 'CODE' => 'TEST_PROP', 'VALUE' => 'test value'],
                    ],
                    */

                ];
                $r = \Bitrix\Catalog\Product\Basket::addProduct($fields);
            }
        }
    }

    public static function calcRetailPrices()
    {
        if (\Bitrix\Main\Loader::includeModule("catalog")) {
            $OPT_PRICE_ID = 4;
            $RETAIL_PRICE_ID = 5;
            $EXTRA_ID = 2;
            set_time_limit(0);
            // выбираем цены
            $arRetailPrices = \Bitrix\Catalog\PriceTable::getList([
                "filter" => [
                    "CATALOG_GROUP_ID" => $RETAIL_PRICE_ID
                ]
            ])->fetchAll();
            $arOptPrices = [];
            $rsOptPrices = \Bitrix\Catalog\PriceTable::getList([
                "filter" => [
                    "CATALOG_GROUP_ID" => $OPT_PRICE_ID
                ]
            ]);
            while ($optPrice = $rsOptPrices->fetch()) {
                $arOptPrices[$optPrice["PRODUCT_ID"]] = $optPrice["PRICE"];
            }
            $arProductRetailPricesIds = array_column($arRetailPrices, "PRODUCT_ID");
            // Наценка
            $extraValue = 0;
            $rsExtra = \Bitrix\Catalog\ExtraTable::getById($EXTRA_ID);
            if ($arExtra = $rsExtra->fetch()) {
                $extraValue = floatval($arExtra["PERCENTAGE"]) / 100;
            }
            //echo 'extraValue = '.$extraValue.'<br />';
            //vardump($arOptPrices);
            //die();
            //
            if (!empty($extraValue)) {
                $rsProducts = \Bitrix\Catalog\ProductTable::getList();
                while ($product = $rsProducts->fetch()) {
                    //vardump($product);
                    //die();
                    if (!empty($product["ID"])) {
                        if (floatval($arOptPrices[$product["ID"]]) > 0) {
                            $ar = [
                                "PRODUCT_ID" => $product["ID"],
                                "EXTRA_ID" => $EXTRA_ID,
                                "CATALOG_GROUP_ID" => $RETAIL_PRICE_ID,
                                "CURRENCY" => "RUB",
                                "PRICE" => floatval($arOptPrices[$product["ID"]]) + (floatval($arOptPrices[$product["ID"]]) * $extraValue),
                                "PRICE_SCALE" => floatval($arOptPrices[$product["ID"]]) + (floatval($arOptPrices[$product["ID"]]) * $extraValue),
                            ];
                            if (empty($arProductRetailPricesIds) || !in_array($product["ID"], $arProductRetailPricesIds)) {
                                $addResult = \Bitrix\Catalog\PriceTable::add($ar);
                            }
                            //vardump($ar);
                            //die();
                        }
                        /*
                        else {
                            $ar = [
                                "PRODUCT_ID" => $product["ID"],
                                //"EXTRA_ID" => $EXTRA_ID,
                                "CATALOG_GROUP_ID" => $OPT_PRICE_ID,
                                "CURRENCY" => "RUB",
                                "PRICE" => floatval($arOptPrices[$product["ID"]]),
                                "PRICE_SCALE" => floatval($arOptPrices[$product["ID"]]),
                            ];
                            $addResult = \Bitrix\Catalog\PriceTable::add($ar);
                        }
                        */
                    }
                }
            }
        }
        return true;
    }
}
