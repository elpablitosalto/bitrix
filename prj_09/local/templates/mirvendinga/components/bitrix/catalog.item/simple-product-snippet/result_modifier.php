<?php
$arResult['ITEM']['SHORT_PROPERTIES'] = [];

foreach($arParams['SHORT_PROPERTIES'] as $line) {
	$arLine = explode('|', $line);

	$label = !empty($arLine[0]) ? trim($arLine[0]) : '';
	$propKey = !empty($arLine[1]) ? trim($arLine[1]) : '';
	$value = '';

	if(!empty($propKey)) {
		$value = !empty($arResult['ITEM']['PROPERTIES'][$propKey]['VALUE']) ? $arResult['ITEM']['PROPERTIES'][$propKey]['VALUE'] : '';
	}

	if(!empty($label) && !empty($value)) {
		$arResult['ITEM']['SHORT_PROPERTIES'][] = [
			'LABEL' => $label,
			'VALUE' => $value
		];
	}
}

// Наличие на всех складах, используется для показа статуса "В наличии на других складах"
$storeDB = CCatalogStoreProduct::GetList(
    array(),
    array(
        'PRODUCT_ID'=>$arResult['ITEM']['ID']
    ),
    false,
    false,
    array("STORE_ID", 'STORE_NAME', 'AMOUNT'),
    );

while ($store = $storeDB->GetNext()) {
    $arResult['STORES'][$store["STORE_ID"]] = $store;
    $arResult['ANY_STORE_HAS_STOCK'] = $arResult['ANY_STORE_HAS_STOCK'] ? $arResult['ANY_STORE_HAS_STOCK'] : $store['AMOUNT'] > 0;
}

// Товар в корзине или нет -->
$basket = new Mirvendinga\Basket();
$arResult['IN_BASKET'] = $basket->isProductInBasket($arResult['ITEM']['ID']) ? 'Y' : 'N';
// <-- Товар в корзине или нет