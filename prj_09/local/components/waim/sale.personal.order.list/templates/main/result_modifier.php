<?
foreach($arResult['ORDERS'] as &$order) {
	$order['ORDER']['STATUS_NAME'] = '-';
	if(!empty($order['ORDER']['STATUS_ID'])) {
		$arStatus = CSaleStatus::GetByID($order['ORDER']['STATUS_ID']);
		if(!empty($arStatus['NAME'])) $order['ORDER']['STATUS_NAME'] = $arStatus['NAME'];
	}
    foreach ($order['BASKET_ITEMS'] as &$basketItem) {
        // 41707
        $arCatalogData = \Mirvendinga\Catalog::getProductCatalogData($basketItem["PRODUCT_ID"]);
        if (!empty($arCatalogData["PRICE"]["VALUE"])) {
            $basketItem["PRICE"] = $arCatalogData["PRICE"]["VALUE"];
        }
        if (
            $arCatalogData["PACKAGE_AMOUNT"]["IS_SOLD_IN_PACKS"] &&
            $arCatalogData["PACKAGE_AMOUNT"]["PACKAGE_AMOUNT"] > 1
        ) {
            $basketItem["QUANTITY"] = round($basketItem["QUANTITY"] / intval($arCatalogData["PACKAGE_AMOUNT"]["PACKAGE_AMOUNT"]));
            $basketItem["MEASURE_NAME"] = $arCatalogData["PACKAGE_AMOUNT"]["MEASURE"];
        }
    }
}