<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */


$arItemsTmp = array();
foreach ($arResult["ITEMS"] as $arItem) {
	if ($arItem['PRODUCT_ID'] == $arParams['ADD_PRODUCT_ID']) {

		// Свойства корзины -->
		$db_res = CSaleBasket::GetPropsList(
			array(
				"SORT" => "ASC",
				"NAME" => "ASC"
			),
			array("BASKET_ID" => $arItem['ID'])
		);
		while ($ar_res = $db_res->Fetch()) {
			//echo $ar_res["NAME"] . "=" . $ar_res["VALUE"] . "<br>";
			$arItem['PROPS'][$ar_res['CODE']] = $ar_res;
		}
		// <-- Свойства корзины

		// Картинка -->
		$width = $GLOBALS["arSiteConfig"]['CATALOG_LIST']['IMG_WIDTH'];
		$height = $GLOBALS["arSiteConfig"]['CATALOG_LIST']['IMG_HEIGHT'];

		$arSelect = array("ID", "NAME", "DETAIL_PICTURE", "PREVIEW_PICTURE");
		$arFilter = array("ID" => $arItem['PRODUCT_ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		if ($ob = $res->GetNextElement()) {
			$arFields = $ob->GetFields();

			$arFields["PREVIEW_PICTURE"] = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
			$arFields["DETAIL_PICTURE"] = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);


			if ($arFields["PREVIEW_PICTURE"]["ID"] > 0 && is_file($_SERVER["DOCUMENT_ROOT"] . $arFields["PREVIEW_PICTURE"]["SRC"])) {
				$file = CFile::ResizeImageGet(
					$arFields["PREVIEW_PICTURE"]["ID"],
					array('width' => $width, 'height' => $height),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					true
				);

				$arFields['PICTURE'] = array(
					'SRC' => $file['src'],
					'ALT' => ('' != $arFields["PREVIEW_PICTURE"]["ALT"]
						? $arFields["PREVIEW_PICTURE"]["ALT"]
						: $arFields["NAME"]
					),
					'TITLE' => ('' != $arFields["PREVIEW_PICTURE"]["TITLE"]
						? $arFields["PREVIEW_PICTURE"]["TITLE"]
						: $arFields["NAME"]
					),
				);
			} else if ($arFields["DETAIL_PICTURE"]["ID"] > 0 && is_file($_SERVER["DOCUMENT_ROOT"] . $arFields["DETAIL_PICTURE"]["SRC"])) {
				$file = CFile::ResizeImageGet(
					$arFields["DETAIL_PICTURE"]["ID"],
					array('width' => $width, 'height' => $height),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					true
				);
				//$arFields["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] = $file['src'];

				$arFields['PICTURE'] = array(
					'SRC' => $file['src'],
					'ALT' => ('' != $arFields["DETAIL_PICTURE"]["ALT"]
						? $arFields["DETAIL_PICTURE"]["ALT"]
						: $arFields["NAME"]
					),
					'TITLE' => ('' != $arFields["DETAIL_PICTURE"]["TITLE"]
						? $arFields["DETAIL_PICTURE"]["TITLE"]
						: $arFields["NAME"]
					),
				);
			} else {
				$file_path = $this->GetFolder() . '/images/no_photo.png';

				$arFields['PICTURE'] = array(
					'SRC' => $file_path,
					'ALT' => $arFields["NAME"],
					'TITLE' => $arFields["NAME"],
					"WIDTH" => $width,
					"HEIGHT" => $height,
				);
			}

			$arItem['PICTURE'] = $arFields['PICTURE'];
		}
		// <-- Картинка

		$arItemsTmp[] = $arItem;
	}
}
$arResult["ITEMS"] = $arItemsTmp;

// Сопутствующие товары -->
$arProductsIds = array();
$arResult['arRelatedProductsIds'] = array();
foreach ($arResult["ITEMS"] as $arItem) {
	$productId = $arItem['PRODUCT_ID'];
	if (intval($productId) > 0) {
		$arProductsIds[] = $productId;
	}
}
if (!empty($arProductsIds)) {
	//$arSelect = array("ID", "NAME", "PROPERTY_RELATED_PRODUCTS");
	$arSelect = false;
	$arFilter = array(
		//"IBLOCK_ID" => Indexis::getIblockId('catalog', 'catalog'),
		'ID' => $arProductsIds,
		"ACTIVE_DATE" => "Y",
		"ACTIVE" => "Y"
	);
	$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	while ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		$arFields['PROPERTIES'] = $ob->GetProperties();

		$arResult['WEGHT'] = $arFields['PROPERTIES']['VES_ATTR_S']['VALUE'];
		$arResult['ARTICLE'] = $arFields['PROPERTIES']['CML2_ARTICLE']['VALUE'];
		//$arResult['arElement'] = $arFields;
		if( !empty($arFields['PROPERTIES']['RELATED_PRODUCTS']['VALUE']) )
		{
			$arResult['arRelatedProductsIds'] = $arFields['PROPERTIES']['RELATED_PRODUCTS']['VALUE'];
		}
	}
}
// <-- Сопутствующие товары


/*
 [ITEMS] => Array
        (
            [0] => Array
                (
                    [ID] => 12
                    [~ID] => 12
                    [NAME] => Лента гидроизоляционная MAPEI Mapeband, 10м x 12см
                    [~NAME] => Лента гидроизоляционная MAPEI Mapeband, 10м x 12см
                    [CALLBACK_FUNC] => 
                    [~CALLBACK_FUNC] => 
                    [MODULE] => my_module
                    [~MODULE] => my_module
                    [PRODUCT_ID] => 3562
                    [~PRODUCT_ID] => 3562
                    [QUANTITY] => 5
                    [~QUANTITY] => 5
                    [DELAY] => N
                    [~DELAY] => N
                    [CAN_BUY] => Y
                    [~CAN_BUY] => Y
                    [PRICE] => 3757
                    [~PRICE] => 3757
                    [WEIGHT] => 2.10
                    [~WEIGHT] => 2.10
                    [DETAIL_PAGE_URL] => /catalog/gidroizolyatsionnye-lenty/mapeband-10m-12cm/
                    [~DETAIL_PAGE_URL] => /catalog/gidroizolyatsionnye-lenty/mapeband-10m-12cm/
                    [NOTES] => 
                    [~NOTES] => 
                    [CURRENCY] => RUB
                    [~CURRENCY] => RUB
                    [VAT_RATE] => 
                    [~VAT_RATE] => 
                    [CATALOG_XML_ID] => 
                    [~CATALOG_XML_ID] => 
                    [PRODUCT_XML_ID] => 
                    [~PRODUCT_XML_ID] => 
                    [SUBSCRIBE] => N
                    [~SUBSCRIBE] => N
                    [DISCOUNT_PRICE] => 0
                    [~DISCOUNT_PRICE] => 0
                    [PRODUCT_PROVIDER_CLASS] => 
                    [~PRODUCT_PROVIDER_CLASS] => 
                    [TYPE] => 
                    [~TYPE] => 
                    [SET_PARENT_ID] => 
                    [~SET_PARENT_ID] => 
                    [PRODUCT_PRICE_ID] => 1564
                    [~PRODUCT_PRICE_ID] => 1564
                    [CUSTOM_PRICE] => N
                    [~CUSTOM_PRICE] => N
                    [BASE_PRICE] => 3757
                    [~BASE_PRICE] => 3757.0000
                    [PRICE_TYPE_ID] => 
                    [ACTION_APPLIED] => N
                    [PRICE_FORMATED] => 3 757 ₽
                    [DISCOUNT_PRICE_PERCENT] => 0
                    [DISCOUNT_PRICE_PERCENT_FORMATED] => 0%
                    [DISCOUNTS_APPLY] => 
                )

        )

)
*/

/*
$width = 80;
$height = 81;
foreach($arResult["ITEMS"] as &$arItem){
	if ($arItem["DETAIL_PICTURE"]["ID"] > 0) {
		$file = CFile::ResizeImageGet(
			$arItem["DETAIL_PICTURE"]["ID"],
			array('width' => $width, 'height' => $height),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);
		//$arItem["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] = $file['src'];

		$arItem['PICTURE'] = array(
			'SRC' => $file['src'],
			'ALT' => ('' != $arItem["DETAIL_PICTURE"]["ALT"]
				? $arItem["DETAIL_PICTURE"]["ALT"]
				: $arItem["NAME"]
			),
			'TITLE' => ('' != $arItem["DETAIL_PICTURE"]["TITLE"]
				? $arItem["DETAIL_PICTURE"]["TITLE"]
				: $arItem["NAME"]
			),
		);
	} else if ($arItem["PREVIEW_PICTURE"]["ID"] > 0) {
		$file = CFile::ResizeImageGet(
			$arItem["PREVIEW_PICTURE"]["ID"],
			array('width' => $width, 'height' => $height),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);
		//$arItem["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] = $file['src'];

		$arItem['PICTURE'] = array(
			'SRC' => $file['src'],
			'ALT' => ('' != $arItem["DETAIL_PICTURE"]["ALT"]
				? $arItem["DETAIL_PICTURE"]["ALT"]
				: $arItem["NAME"]
			),
			'TITLE' => ('' != $arItem["DETAIL_PICTURE"]["TITLE"]
				? $arItem["DETAIL_PICTURE"]["TITLE"]
				: $arItem["NAME"]
			),
		);
	} else {
		$file_path = $this->GetFolder().'/images/tile-empty.png';

		$arItem['PICTURE'] = array(
			'SRC' => $file_path,
			'ALT' => $arItem["NAME"],
			'TITLE' => $arItem["NAME"],
			"WIDTH" => $width,
			"HEIGHT" => $height,
		);
	}
}
*/