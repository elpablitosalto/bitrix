<?

namespace First;

class Agents
{
    public static function reIndexSearch()
    {
        \First\Seo::reIndexSearch();
        return "\First\Agents::reIndexSearch();";
    }

    // 39495
    public static function agent__sendChangePasswordMessageToOptUsers()
    {
        $usersCount = 3;
        $arFilter = [
            'ACTIVE' => 'Y',
            'GROUPS_ID' => [12],
            'UF_CHANGE_PASSWORD_MSG_SEND' => false
        ];
        $obUser = new \CUser();
        $rsUser = \CUser::GetList($by = 'id', $order = 'asc', $arFilter, ["NAV_PARAMS" => ["nTopCount" => $usersCount]]);
        while ($arUser = $rsUser->Fetch()) {
            $updateResult = $obUser->Update($arUser["ID"], ["UF_CHANGE_PASSWORD_MSG_SEND" => 1]);
            if ($updateResult) {
                \CUser::SendUserInfo($arUser["ID"], "s1", "");
            }
        }
        return "\First\Agents::agent__sendChangePasswordMessageToOptUsers();";
    }

    // 35705 - Отображение товаров на странице результатов поиска
    public static function agent__updateProductsSortParameters()
    {
        $catalogIblockId = 34;
        if (\Bitrix\Main\Loader::includeModule("iblock") && \Bitrix\Main\Loader::includeModule("catalog")) {
            // выбираем товары
            $arProducts = \Bitrix\Iblock\ElementTable::getList([
                "filter" => [
                    "ACTIVE" => "Y",
                    "IBLOCK_ID" => $catalogIblockId
                ],
            ])->fetchAll();
            // выбираем предложения
            $arOffers = \CCatalogSKU::getOffersList(array_column($arProducts, "ID"), $catalogIblockId);
            // выбираем свойства
            $arProperties = [];
            $rsProperties = \Bitrix\Iblock\ElementPropertyTable::getList([
                "filter" => [
                    "IBLOCK_ELEMENT_ID" => array_column($arProducts, "ID"),
                    "IBLOCK_PROPERTY_ID" => 1071,  // 1071 - HIT
                    "VALUE" => [
                        10950, //	Советуем RECOMMEND
                        54732, //	Хит	SPETSPREDLOZHENIE_HIT
                        54733 //	Новинка	SPETSPREDLOZHENIE_NEW
                    ]
                ],
            ]);
            while ($propValue = $rsProperties->fetch()) {
                switch ($propValue["VALUE"]) {
                    case 10950:
                        $propValue["SORT_PROP_NAME"] = "SORT_RECOMMEND";
                        break;
                    case 54732:
                        $propValue["SORT_PROP_NAME"] = "SORT_HIT";
                        break;
                    case 54733:
                        $propValue["SORT_PROP_NAME"] = "SORT_NEW";
                        break;
                }
                if ($propValue["SORT_PROP_NAME"]) {
                    $arProperties[$propValue["IBLOCK_ELEMENT_ID"]] = $propValue;
                }
            }
            // основной цикл
            foreach ($arProducts as $product) {
                if (!empty($arOffers[$product["ID"]])) {
                    $product["OFFERS"] = $arOffers[$product["ID"]];
                }
                $availableData =  getProductQty($product);
                if ($availableData["AVAILABLE"] > 0) {
                    \CIBlockElement::SetPropertyValuesEx($product["ID"], $product["IBLOCK_ID"], array("SORT_AVAILABLE" => 1));
                } else {
                    \CIBlockElement::SetPropertyValuesEx($product["ID"], $product["IBLOCK_ID"], array("SORT_AVAILABLE" => 0));
                }
                // свойства
                \CIBlockElement::SetPropertyValuesEx($product["ID"], $product["IBLOCK_ID"], array(
                    "SORT_RECOMMEND" => 0,
                    "SORT_HIT" => 0,
                    "SORT_NEW" => 0,
                ));
                if (!empty($arProperties[$product["ID"]]["SORT_PROP_NAME"])) {
                    \CIBlockElement::SetPropertyValuesEx($product["ID"], $product["IBLOCK_ID"], array($arProperties[$product["ID"]]["SORT_PROP_NAME"] => 1));
                }
            }
        }
        return "\First\Agents::agent__updateProductsSortParameters();";
    }

    // 36827 - НЕ использовать свойство "Не выгружать на сайт" в отборах, но использовать в качестве триггера для агента на сайте
//    public static function agent__deactivateProducts()
//    {
//
//        return "\First\Agents::agent__deactivateProducts();";
//
//        if (\Bitrix\Main\Loader::includeModule("iblock")) {
//            $connection = \Bitrix\Main\Application::getConnection();
//            $sqlHelper = $connection->getSqlHelper();
//            // выбираем товары
//            $rsProducts = \CIBlockElement::GetList(
//                ["ID" => "ASC"],
//                [
//                    "IBLOCK_ID" => 34,
//                    "DATE_MODIFY_FROM" => new \Bitrix\Main\Type\DateTime(date('d.m.Y H:i:s', strtotime("-15 minutes")))
//                ],
//                false,
//                false,
//                ["ID", "NAME", "IBLOCK_ID", "PROPERTY_VYGRUZHAT_NA_SAYT", "XML_ID"]
//            );
//            while ($arProduct = $rsProducts->GetNext()) {
//                if ($arProduct["PROPERTY_VYGRUZHAT_NA_SAYT_VALUE"] == "Да") {
//
//                    if ($arProduct['ACTIVE'] == 'Y')
//                        continue;
//
//                    $strUpdate = $sqlHelper->PrepareUpdate(\Bitrix\Iblock\ElementTable::getTableName(), ["ACTIVE" => "Y"]);
//                    $strUpdateSku = $sqlHelper->PrepareUpdate(\Bitrix\Iblock\ElementTable::getTableName(), ["ACTIVE" => "Y"]);
//                } else {
//
//                    if ($arProduct['ACTIVE'] == 'N')
//                        continue;
//
//                    $strUpdate = $sqlHelper->PrepareUpdate(\Bitrix\Iblock\ElementTable::getTableName(), ["ACTIVE" => "N"]);
//                    $strUpdateSku = $sqlHelper->PrepareUpdate(\Bitrix\Iblock\ElementTable::getTableName(), ["ACTIVE" => "N"]);
//                }
//                $query = "UPDATE `" . \Bitrix\Iblock\ElementTable::getTableName() . "` SET {$strUpdate[0]} WHERE (`ID` = '" . $sqlHelper->convertToDbInteger($arProduct["ID"]) . "');";
//                $updateResult = $connection->query($query);
//
//                if (strlen($arProduct["XML_ID"])) {
//                    $query = "UPDATE `" . \Bitrix\Iblock\ElementTable::getTableName() . "` SET {$strUpdateSku[0]} WHERE (`XML_ID` LIKE " . $sqlHelper->convertToDbString($arProduct["XML_ID"] . "#%") . ");";
//                    $connection->query($query);
//                }
//            }
//            // Обрабатываем SCU
//            $SCUDeactivatePropertyId = 1511;
//            $SCUDeactivatePropertyValue = 56296;
//            $rsScuProducts = \Bitrix\Iblock\ElementPropertyTable::getList([
//                "filter" => [
//                    "IBLOCK_PROPERTY_ID" => $SCUDeactivatePropertyId,  // 1511 - PRIZNAK_NALICHIYA
//                    "VALUE" => $SCUDeactivatePropertyValue, // Не производится/спецзаказ
//                    "ELEMENT.ACTIVE" => "Y"
//                ],
//            ]);
//            while ($arScu = $rsScuProducts->fetch()) {
//                if (!empty($arScu["IBLOCK_ELEMENT_ID"])) {
//                    $strUpdate = $sqlHelper->PrepareUpdate(\Bitrix\Iblock\ElementTable::getTableName(), ["ACTIVE" => "N"]);
//                    $query = "UPDATE `" . \Bitrix\Iblock\ElementTable::getTableName() . "` SET {$strUpdate[0]} WHERE (`ID` = '" . $sqlHelper->convertToDbInteger($arScu["IBLOCK_ELEMENT_ID"]) . "');";
//                    $scuUpdateResult = $connection->query($query);
//                }
//            }
//        }
//        return "\First\Agents::agent__deactivateProducts();";
//    }
}
