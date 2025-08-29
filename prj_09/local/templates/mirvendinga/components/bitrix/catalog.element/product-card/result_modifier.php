<?php
$arResult['FILES'] = [];
$arResult['PRICE_GROUP'] = [
	'CAN_BUY' => 'N',
	'VALUE' => null,
	'DISCOUNT_VALUE' => null,
	'DIFF_VALUE' => 0,
	'DIFF_PERCENT' => 0,
	'UNIT_VALUE' => null,
	'HAS_DISCOUNT' => false
];
$arResult['BASE_PROPS'] = [];
$arResult['GALLERY'] = [];
$arResult['EXTRA_PROPS'] = [];
$arResult['ARTICLE'] = null;
$arResult['BASE_UNIT'] = 'Штука';
$arResult['LIST_OF_DRINK'] = [];

if($arResult['PROPERTIES']['CML2_BASE_UNIT']['VALUE']) {
	$arResult['BASE_UNIT'] = $arResult['PROPERTIES']['CML2_BASE_UNIT']['VALUE'];
}

if($arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']) {
	$arResult['ARTICLE'] = $arResult['PROPERTIES']['CML2_ARTICLE']['VALUE'];
}

if($arResult['PROPERTIES']['FILES']['VALUE']) {
	foreach($arResult['PROPERTIES']['FILES']['VALUE'] as $documentID) {
		$arResult['FILES'][] = CFile::GetFileArray($documentID);
	}
}

if(!empty($arResult['PRICES']['STANDARTPRICE'])) {
	$arPrice = $arResult['PRICES']['STANDARTPRICE'];
	$currency = !empty($arPrice['CURRENCY']) ? $arPrice['CURRENCY'] : 'RUB';

	if(!empty($arPrice['CAN_BUY'])) {
		$arResult['PRICE_GROUP']['CAN_BUY'] = $arPrice['CAN_BUY'];
	}

	if(!empty($arPrice['PRINT_VALUE'])) {
		$arResult['PRICE_GROUP']['VALUE'] = $arPrice['PRINT_VALUE'];
	}

	if(!empty($arPrice['PRINT_DISCOUNT_VALUE'])) {
		$arResult['PRICE_GROUP']['DISCOUNT_VALUE'] = $arPrice['PRINT_DISCOUNT_VALUE'];
	}

	if(!empty($arPrice['PRINT_DISCOUNT_DIFF'])) {
		$arResult['PRICE_GROUP']['DIFF_VALUE'] = $arPrice['PRINT_DISCOUNT_DIFF'];
	}
	if(!empty($arPrice['DISCOUNT_DIFF_PERCENT'])) {
		$arResult['PRICE_GROUP']['DIFF_PERCENT'] = $arPrice['DISCOUNT_DIFF_PERCENT'] . '%';
		$arResult['PRICE_GROUP']['HAS_DISCOUNT'] = true;
	}

	if(!empty($arResult['PROPERTIES']['QUANTITY_PER_PACKAGE']['VALUE']) && !empty($arPrice['VALUE'])) {
		$unitPrice = $arPrice['VALUE'] / $arResult['PROPERTIES']['QUANTITY_PER_PACKAGE']['VALUE'];
		$arResult['PRICE_GROUP']['UNIT_VALUE'] = CurrencyFormat($unitPrice, $currency);
	}
}

if (!function_exists('getResizeProductGalleryImage')) {
	function getResizeProductGalleryImage($imageID, $arSizes = ['width' => 570, 'height' => 380]) {
		$arImageResult = [];

		if($imageID) {
			$arResize = CFile::ResizeImageGet($imageID,
			$arSizes,
			BX_RESIZE_IMAGE_PROPORTIONAL, false);

			if(!empty($arResize['src'])) {
				$arImageResult['SRC'] = $arResize['src'];
			}
		}

		return $arImageResult;
	}
}

if (!function_exists('getProductGalleryImage')) {
	function getProductGalleryImage($imageID) {
		$arImage = [];
		if(!empty($imageID) ) {
			$arOriginal = CFile::GetFileArray($imageID);
			$arResizeImage = getResizeProductGalleryImage($imageID);
			$arResizeThumbImage = getResizeProductGalleryImage($imageID, ['width' => 252, 'height' => 152]);

			if(!empty($arOriginal['SRC'])) {
				$arImageResult['SRC'] = $arOriginal['SRC'];
			}

			if(!empty($arResizeImage['SRC']) && !empty($arResizeThumbImage['SRC'] && $arOriginal['SRC'])) {
				$arImage = [
					'SRC' => $arOriginal['SRC'],
					'CAROUSEL_SRC' => $arResizeImage['SRC'],
					'THUMB_SRC' => $arResizeThumbImage['SRC']
				];
			}
		}

		return $arImage;
	}
}

if(!empty($arResult['DETAIL_PICTURE']['SRC'])) {
	$arResult['GALLERY'][] = getProductGalleryImage($arResult['DETAIL_PICTURE']['ID']);
} elseif(!empty($arResult['PREVIEW_PICTURE']['SRC'])) {
	$arResult['GALLERY'][] = getProductGalleryImage($arResult['PREVIEW_PICTURE']['ID']);
}

if(!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])) {
	foreach($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $imageID) {
		$arResult['GALLERY'][] = getProductGalleryImage($imageID);
	}
}

$arResult['SHORT_PROPERTIES'] = [];
foreach($arParams['SHORT_PROPERTIES'] as $line) {
	$arLine = explode('|', $line);

	$label = !empty($arLine[0]) ? trim($arLine[0]) : '';
	$propKey = !empty($arLine[1]) ? trim($arLine[1]) : '';
	$value = '';

	if(!empty($propKey)) {
		$value = !empty($arResult['PROPERTIES'][$propKey]['VALUE']) ? $arResult['PROPERTIES'][$propKey]['VALUE'] : '';
	}

	if(!empty($label) && !empty($value)) {
		$arResult['SHORT_PROPERTIES'][] = [
			'LABEL' => $label,
			'VALUE' => $value
		];
	}
}

$arResult['DETAIL_PROPERTIES'] = [];
foreach($arParams['DETAIL_PROPERTIES'] as $line) {
	$arLine = explode('|', $line);

	$label = !empty($arLine[0]) ? trim($arLine[0]) : '';
	$propKey = !empty($arLine[1]) ? trim($arLine[1]) : '';
	$value = '';

	if(!empty($propKey)) {
		$value = !empty($arResult['PROPERTIES'][$propKey]['VALUE']) ? $arResult['PROPERTIES'][$propKey]['VALUE'] : '';
	}

	if(!empty($label) && !empty($value)) {
		$arResult['DETAIL_PROPERTIES'][] = [
			'LABEL' => $label,
			'VALUE' => $value
		];
	}
}

if(!empty($arResult['PROPERTIES']['CML2_ATTRIBUTES']['VALUE'])) {
	foreach($arResult['PROPERTIES']['CML2_ATTRIBUTES']['VALUE'] as $key => $label) {
		$arResult['EXTRA_PROPS'][] = [
			'LABEL' => $label,
			'VALUE' => $arResult['PROPERTIES']['CML2_ATTRIBUTES']['DESCRIPTION'][$key]
		];
	}
}

if(!empty($arResult['PROPERTIES']['LIST_OF_DRINK']['VALUE'])) {
	foreach($arResult['PROPERTIES']['LIST_OF_DRINK']['VALUE'] as $key => $value) {
		$arResult['LIST_OF_DRINK'][] = $value;
	}
}

if(!empty($arResult['PROPERTIES']['BRAND']['VALUE'])) {
	$arResult['BRAND'] = CIBlockElement::GetList([], ["ID" => $arResult['PROPERTIES']['BRAND']['VALUE']])->GetNext();

	if (!empty($arResult['BRAND'])) {
		$arResult['BRAND']['BADGE_IMAGE'] = CFile::ResizeImageGet($arResult['BRAND']['PREVIEW_PICTURE'], ['width' => 54, 'height' => 100], BX_RESIZE_IMAGE_PROPORTIONAL, false);
	}
}

// Наличие на всех складах, используется для показа статуса "В наличии на других складах"
$storeDB = CCatalogStoreProduct::GetList(
	array(),
	array(
		'PRODUCT_ID'=>$arResult['ID']
	),
	false,
	false,
	array("STORE_ID", 'STORE_NAME', 'AMOUNT'),
);

while ($store = $storeDB->GetNext()) {
	$arResult['STORES'][$store["STORE_ID"]] = $store;
	$arResult['ANY_STORE_HAS_STOCK'] = $arResult['ANY_STORE_HAS_STOCK'] ? $arResult['ANY_STORE_HAS_STOCK'] : $store['AMOUNT'] > 0;
}

// Высота
// 1830 мл
// Ширина
// 666 мм
// Глубина
// 980 мм
// Вес (нетто)
// 214 кг

// Объем/вес
// 330 мл
// Количество в упаковке
// 12 шт/уп
// Цена за 1 штуку
// 44,55 р

// Товар в корзине или нет -->
$basket = new Mirvendinga\Basket();
$arResult['IN_BASKET'] = $basket->isProductInBasket($arResult['ID']) ? 'Y' : 'N';
// <-- Товар в корзине или нет