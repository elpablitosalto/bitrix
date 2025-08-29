<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>

<?
//CModule::IncludeModule("sale");
\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('sale');
\Bitrix\Main\Loader::includeModule('catalog');

$action = $_REQUEST['action'];

if ($action == 'show_popup_form') {
    $productId = $_POST['productId'];
    if (intval($productId) > 0) {
        Add2BasketByProductID($productId);
    } ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => "/include/forms/quick_order.php",
            "PRODUCT_ID" => $productId,
        )
    ); ?>
    <?
} else if ($action == 'add') {
    $productId = $_REQUEST['PRODUCT_ID'];
    $ar_result = quickOrder(
        array(
            "PRODUCT_ID" => $productId,
            "NAME" => $_REQUEST['NAME'],
            "PHONE" => $_REQUEST['PHONE'],
            "EMAIL" => $_REQUEST['EMAIL'],
            "INN" => $_REQUEST['INN'],
            "QUANTITY" => $_REQUEST['QUANTITY'],
            'PERSON_TYPE_ID' => $_REQUEST['PERSON_TYPE_ID'],
            'DEFAULT_PAY_SYSTEM_ID' => $GLOBALS["arSiteConfig"]['ORDER']['DEFAULT']['PAY_SYSTEM'], // Наличные
            'DEFAULT_LOCATION_ID' => $GLOBALS["arSiteConfig"]['ORDER']['DEFAULT']['LOCATION'], // Москва
            'DEFAULT_PRICE_TYPE' => $GLOBALS["arSiteConfig"]['ORDER']['DEFAULT']['PRICE_TYPE'],
        )
    );
    //vardump($ar_result);
    if (intval($ar_result['NEW_ORDER_ID']) > 0) {
        $str = 'Успешно создан заказ №' . $ar_result['NEW_ORDER_ID'];
        ShowMessage(array('MESSAGE' => $str, 'TYPE' => 'OK'));
    ?>
        <? if (intval($productId) <= 0) { ?>
            <input type="hidden" id="order_add" value="SUCCESS" />
        <? } ?>
<?
    } else if (strlen($arResult['ERROR'])) {
        ShowMessage($arResult['ERROR']);
    } else {
        ShowMessage('Не удалось создать заказ');
    }
}

function quickOrder($arParams)
{
    $arResult = array();
    global $USER;

    $personTypeId = $arParams["PERSON_TYPE_ID"]; // Тип плательщика
    if (intval($personTypeId) <= 0) {
        $personTypeId = 1;
    }

    $defaultPaySystemId = $arParams["DEFAULT_PAY_SYSTEM_ID"]; // Платежная система

    $priceTypeId = $arParams["DEFAULT_PRICE_TYPE"]; // Тип цены

    $quantity = $arParams["QUANTITY"]; // Количество
    if (intval($quantity) <= 0) {
        $quantity = 1;
    }

    // ID товаров -->
    $arProductsIds = array();
    if (intval($arParams["PRODUCT_ID"]) > 0) {
        $arProductsIds[] = $arParams["PRODUCT_ID"];
    } else {
        $dbBasketItems = CSaleBasket::GetList(
            array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
            array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL"
            ),
            false,
            false,
            array(
                "ID", "CALLBACK_FUNC", "MODULE",
                "PRODUCT_ID", "QUANTITY", "DELAY",
                "CAN_BUY", "PRICE", "WEIGHT"
            )
        );
        while ($arItems = $dbBasketItems->Fetch()) {
            $arProductsIds[] = $arItems["PRODUCT_ID"];
        }
    }
    // <-- ID товаров

    // Получаем данные о товаре по его ID
    if (!empty($arProductsIds)) {
        $basket = \Bitrix\Sale\Basket::create(SITE_ID);

        $dbItems = CIBlockElement::GetList(
            array(),
            array('ID' => $arProductsIds),
            false,
            false,
            array('ID', 'IBLOCK_ID', 'NAME')
        );
        while ($arItem = $dbItems->GetNext()) {

            $arItem['PRICE'] = CCatalogProduct::GetOptimalPrice($arItem['ID'], $priceTypeId);

            // Создаем корзину и добавляем туда товар
            $basketItem = $basket->createItem("catalog", $arItem['ID']);
            $basketItem->setFields(
                array(
                    'PRODUCT_ID' => $arItem['ID'],
                    'NAME' => $arItem['NAME'],
                    // "BASE_PRICE" =>$arItem['PRICE']['RESULT_PRICE']["BASE_PRICE"],
                    // 'PRICE' => $arItem['PRICE']['RESULT_PRICE']["DISCOUNT_PRICE"],
                    'CURRENCY' => $arItem['PRICE']['RESULT_PRICE']['CURRENCY'],
                    'QUANTITY' => $quantity,
                    'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
                )
            );
        }

        // Создаем заказ и привязываем корзину, перерасчет происходит автоматически
        $user_id = ($USER->IsAuthorized()) ? $USER->GetID() : \CSaleUser::GetAnonymousUserID();
        $order = \Bitrix\Sale\Order::create(SITE_ID, $user_id);
        $order->setPersonTypeId($personTypeId); // Тип плательщика
        $order->setBasket($basket);

        // Создаём одну отгрузку и устанавливаем способ доставки - "Без доставки" (он служебный)
        $shipmentCollection = $order->getShipmentCollection();
        $shipment = $shipmentCollection->createItem();
        $service = \Bitrix\Sale\Delivery\Services\Manager::getById(\Bitrix\Sale\Delivery\Services\EmptyDeliveryService::getEmptyDeliveryServiceId());
        $shipment->setFields(array(
            'DELIVERY_ID' => $service['ID'],
            'DELIVERY_NAME' => $service['NAME'],
        ));
        $shipmentItemCollection = $shipment->getShipmentItemCollection();
        //$arResult['basket'] = $basket;
        foreach ($basket as $item) {
            $shipmentItem = $shipmentItemCollection->createItem($item);
            $shipmentItem->setQuantity($item->getQuantity());
        }

        // Создаём оплату
        $paymentCollection = $order->getPaymentCollection();
        $payment = $paymentCollection->createItem();
        $paySystemService = \Bitrix\Sale\PaySystem\Manager::getObjectById($defaultPaySystemId);
        $payment->setFields(array(
            'PAY_SYSTEM_ID' => $paySystemService->getField("PAY_SYSTEM_ID"),
            'PAY_SYSTEM_NAME' => $paySystemService->getField("NAME"),
        ));

        // Устанавливаем свойства -->
        $propertyCollection = $order->getPropertyCollection();
        $nameProp = $propertyCollection->getPayerName();
        $nameProp->setValue(htmlspecialcharsbx($arParams['NAME']));
        $phoneProp = $propertyCollection->getPhone();
        $phoneProp->setValue(htmlspecialcharsbx($arParams['PHONE']));
        $emailProp = $propertyCollection->getUserEmail();
        $emailProp->setValue(htmlspecialcharsbx($arParams['EMAIL']));
        $locProp = $propertyCollection->getDeliveryLocation();
        $locProp->setValue($arParams["DEFAULT_LOCATION_ID"]);
        // ИНН -->
        $propCode = 'INN';
        if ($propertyCollection->getItemByOrderPropertyCode($propCode) === null) {
            $property = $propertyCollection->createItem(
                [
                    'NAME' => 'ИНН',
                    'CODE' => $propCode,
                    'TYPE' => 'STRING',
                ]
            );
        } else {
            $property = $propertyCollection->getItemByOrderPropertyCode($propCode);
        }
        if ($property && $property->getValue() !== $propCode) {
            $property->setField('VALUE', $arParams["INN"]);
            //$order->save();
        }
        // <-- ИНН
        // <-- Устанавливаем свойства


        // Сохраняем
        $order->doFinalAction(true);
        $r = $order->save();
        if (!$r->isSuccess()) {
            $arResult['ERROR'] = $r->getErrorMessages();
        } else {
            $arResult['NEW_ORDER_ID'] = $order->getId();
        }

        // Удаляем из корзины товар 
        //echo 'NEW_ORDER_ID = '.$arResult['NEW_ORDER_ID'].'<br />';
        if (intval($arResult['NEW_ORDER_ID']) > 0) {
            $arFilter = array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL"
            );
            if (intval($arParams["PRODUCT_ID"]) > 0) {
                $arFilter['PRODUCT_ID'] = $arParams["PRODUCT_ID"];
            }
            $dbBasketItems = CSaleBasket::GetList(
                array(
                    "NAME" => "ASC",
                    "ID" => "ASC"
                ),
                $arFilter,
                false,
                false,
                array(
                    "ID", "CALLBACK_FUNC", "MODULE",
                    "PRODUCT_ID", "QUANTITY", "DELAY",
                    "CAN_BUY", "PRICE", "WEIGHT"
                )
            );
            while ($arItems = $dbBasketItems->Fetch()) {
                //echo 'ID = '.$arItems['ID'].'<br />';
                CSaleBasket::Delete($arItems['ID']);
            }
        }
    }

    return $arResult;
}
?>

<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>