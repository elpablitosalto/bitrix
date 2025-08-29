<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("sale");
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$arPost = $request->getPostList()->toArray(); // массив post параметров

$action = $request->get("action");

if ($action == 'change_quantity') {
    $productId = $arPost['productId'];
    $quantity = $arPost['quantity'];
    $basketElId = 0;

    if (!empty($productId)) {

        $dbBasketItems = CSaleBasket::GetList(
            array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
            array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL",
                "PRODUCT_ID" => $productId
            ),
            false,
            false,
            array(
                "ID", "CALLBACK_FUNC", "MODULE",
                "PRODUCT_ID", "QUANTITY", "DELAY",
                "CAN_BUY", "PRICE", "WEIGHT"
            )
        );
        if ($arItems = $dbBasketItems->Fetch()) {
            $basketElId = $arItems['ID'];
        }

        if (intval($basketElId) > 0 && intval($quantity) > 0) {
            $arFields = array(
                "QUANTITY" => $quantity
            );
            $result = CSaleBasket::Update($basketElId, $arFields);
        }
    }
    //vardump($arFields);
    //vardump(array( 'basketElId' => $basketElId, 'quantity' => $quantity, 'result' => $result ));
} else if ($action == 'del_product_from_basket') {
    $productId = $arPost['productId'];
    $basketElId = 0;

    if (!empty($productId)) {

        $dbBasketItems = CSaleBasket::GetList(
            array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
            array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL",
                "PRODUCT_ID" => $productId
            ),
            false,
            false,
            array(
                "ID", "CALLBACK_FUNC", "MODULE",
                "PRODUCT_ID", "QUANTITY", "DELAY",
                "CAN_BUY", "PRICE", "WEIGHT"
            )
        );
        if ($arItems = $dbBasketItems->Fetch()) {
            $basketElId = $arItems['ID'];
        }

        //echo 'basketElId = '.$basketElId.'<br />';

        if (intval($basketElId) > 0 && true) {
            CSaleBasket::Delete($basketElId);
        }
    }
}
?>

<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>