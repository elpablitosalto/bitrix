<?

use \Bitrix\Main,
    \Bitrix\Main\Loader,
    \Bitrix\Main\Web\HttpClient,
    \Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem;

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
Loader::includeModule('iblock');
Loader::includeModule('sale');

//создадим заказ
global $USER;
if (!$USER->IsAuthorized()){
    echo json_encode(["type" => "err", "err" => "auth"]);
} else {

    $userID = $USER->GetID();
    $basket = Bitrix\Sale\Basket::loadItemsForFUser( Bitrix\Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
    $countItems = 0;
    foreach ($basket as $basketItem) {
        $countItems++;
    }
    if($countItems > 0){

        $order = Order::create(SITE_ID, $userID );
        $order->setPersonTypeId(3);
        $order->setField('CURRENCY', "RUB");

        $order->setBasket($basket);

        //отгрузки
        $shipmentCollection = $order->getShipmentCollection();
        $shipment = $shipmentCollection->createItem();
        $service = Delivery\Services\Manager::getById(Delivery\Services\EmptyDeliveryService::getEmptyDeliveryServiceId());
        $shipment->setFields(array(
            'DELIVERY_ID' => $service['ID'],
            'DELIVERY_NAME' => $service['NAME'],
        ));
        $shipmentItemCollection = $shipment->getShipmentItemCollection();

        //платёжки
        $paymentCollection = $order->getPaymentCollection();
        $payment = $paymentCollection->createItem();
        $paySystemService = PaySystem\Manager::getObjectById(5);
        $payment->setFields(array(
            'PAY_SYSTEM_ID' => $paySystemService->getField("PAY_SYSTEM_ID"),
            'PAY_SYSTEM_NAME' => $paySystemService->getField("NAME"),
            "SUM" => $order->getPrice(),
            "CURRENCY" => $order->getCurrency()
        ));

        // Сохраняем
        $order->doFinalAction(true);
        if($result = $order->save()){
            $orderId = $order->getId();
            echo json_encode(["type" => "ok", "id" => $orderId]);
        } else {
            echo json_encode(["type" => "err", "err" => $result->getErrorMessages()]);
        }


    } else {
        echo json_encode(["type" => "err", "err" => "В корзине отсутсвуют товары"]);
    }
}

 require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>