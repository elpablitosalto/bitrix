<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

Bitrix\Main\Loader::includeModule("catalog");

if (!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog") || !CModule::IncludeModule("iblock")) {
    echo "failure";
    return;
}
if (!empty($_REQUEST["data"])) {
    $successfulAdd = true;
    $strErrorExt = '';
    foreach ($_REQUEST["data"] as $item) {
        if (!empty($item["quantity"])) {
            $item["quantity"] = floatval($item["quantity"]);
        }
        $dbBasketItems = CSaleBasket::GetList(
            array("NAME" => "ASC", "ID" => "ASC"),
            array("PRODUCT_ID" => $item["item"], "FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
            false,
            false,
            array("ID", "DELAY")
        )->Fetch();
        if (!empty($dbBasketItems) && $dbBasketItems["DELAY"] == "Y") {
            $arFields = array("DELAY" => "N", "SUBSCRIBE" => "N");
            if ($item["quantity"]) {
                $arFields['QUANTITY'] = $item["quantity"];
            }
            CSaleBasket::Update($dbBasketItems["ID"], $arFields);
        } else {
            $fields = [
                'PRODUCT_ID' => $item["item"], // ID товара, обязательно
                'QUANTITY' => $item["quantity"], // количество, обязательно
                /*'PROPS' => [
                    ['NAME' => 'Test prop', 'CODE' => 'TEST_PROP', 'VALUE' => 'test value'],
                ],
                */
            ];
            $r = Bitrix\Catalog\Product\Basket::addProduct($fields);
            if (!$r->isSuccess()) {
                //var_dump($r->getErrorMessages());
                $strError = "ERROR_ADD2BASKET";
                $successfulAdd = false;
                $strErrorExt .= implode("<br />", $r->getErrorMessages());
                $strErrorExt .= '!';
            }
            /*
            if (!Add2BasketByProductID($item["item"], $item["quantity"])) {
                if ($ex = $APPLICATION->GetException())
                    $strErrorExt .= $ex->GetString();

                $strError = "ERROR_ADD2BASKET";
                $successfulAdd = false;
            }
            */
        }
    }
    if ($successfulAdd) {
        $addResult = array('STATUS' => 'OK', 'MESSAGE' => 'CATALOG_SUCCESSFUL_ADD_TO_BASKET', 'MESSAGE_EXT' => $strErrorExt);
    } else {
        $addResult = array('STATUS' => 'ERROR', 'MESSAGE' => $strError, 'MESSAGE_EXT' => $strErrorExt, 'REQ_DATA' => $_REQUEST["data"]);
    }
    echo json_encode($addResult);
    die();
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
