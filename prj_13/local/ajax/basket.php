<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>

<?
CModule::IncludeModule("sale");
//$action = $_POST['action'];
$action = $_REQUEST['action'];
//echo '!!!';
//vardump($_POST);

if ($action == 'add') {
    //$productId = $_REQUEST['productId'];
    $productId = $_POST['productId'];
    $add = $_POST['add'];
    $setQuantity = $_POST['setQuantity'];
    $quantity = $_POST['quantity'];

    // Добавление в корзину -->
    if (intval($productId) > 0 && $add != 'N') {
        Add2BasketByProductID($productId);
    }

    // Установка количества -->
    else if (intval($productId) > 0 && $setQuantity == 'Y' && intval($quantity > 1)) {
        Add2BasketByProductID($productId, ($quantity - 1));
    }
    /*
    $add2BasketParams = $_POST['add2BasketParams'];
    if (!empty($add2BasketParams)) {
        $add2BasketParams = json_decode(base64_decode($_POST['add2BasketParams']), true);
        $arFields = $add2BasketParams['arFields'];
        $arProps = $add2BasketParams['arProps'];
        $arFields["PROPS"] = $arProps;
        CSaleBasket::Add($arFields); 
    }    
    */
    if (intval($productId) > 0) {
        $APPLICATION->IncludeComponent(
            "bitrix:sale.basket.basket.small",
            "popup_basket",
            array(
                "PATH_TO_BASKET" => "/personal/cart/",
                "PATH_TO_ORDER" => "/personal/order/make/",
                "SHOW_DELAY" => "Y",
                "SHOW_NOTAVAIL" => "Y",
                "SHOW_SUBSCRIBE" => "Y",

                //'ADD_PRODUCT_ID' => $arFields['PRODUCT_ID'],
                'ADD_PRODUCT_ID' => $productId,
            ),
            false
        );
    }
} else if ($action == 'change_quantity') {
    $basketElId = $_POST['basketElId'];
    $quantity = $_POST['quantity'];

    if (intval($basketElId) > 0 && intval($quantity) > 0) {
        $arFields = array(
            "QUANTITY" => $quantity
        );
        $result = CSaleBasket::Update($basketElId, $arFields);
    }
    //vardump($arFields);
    //vardump(array( 'basketElId' => $basketElId, 'quantity' => $quantity, 'result' => $result ));
} else if ($action == 'clearAll') {
    CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
}
?>

<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>