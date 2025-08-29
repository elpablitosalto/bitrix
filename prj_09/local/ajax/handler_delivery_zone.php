<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Loader::includeModule('sale');

// Доставки -->
$arDeliveries = array();
$db_dtype = CSaleDelivery::GetList(
  array(
    "SORT" => "ASC",
    "NAME" => "ASC"
  ),
  array(
    "ACTIVE" => "Y",
  ),
  false,
  false,
  array()
);
while ($ar_dtype = $db_dtype->Fetch()) {
  $arDeliveries[$ar_dtype['ID']] = $ar_dtype;
  $arDeliveryParams = \Bitrix\Sale\Delivery\Services\Manager::getById($ar_dtype['ID']);

  $arDeliveries[$ar_dtype['ID']]['PRICE'] = $arDeliveryParams['CONFIG']['MAIN']['PRICE'];
}
// <-- Доставки

// Правила работы с корзиной -->
$db_res = CSaleDiscount::GetList(
  array("SORT" => "ASC"),
  array(
    "LID" => SITE_ID,
    "ACTIVE" => "Y",
    //">=PRICE_TO" => $ORDER_PRICE,
    //"<=PRICE_FROM" => $ORDER_PRICE
  ),
  false,
  false,
  array()
);
while ($ar_res = $db_res->Fetch()) {
  //vardump($ar_res);
  $ar = CSaleDiscount::GetByID($ar_res['ID']);
  //vardump($ar);
  $arConditions = unserialize($ar['CONDITIONS']);
  $arActions = unserialize($ar['ACTIONS']);
  //vardump($arActions);
  //vardump($arConditions);

  foreach ($arDeliveries as $key => $val) {
    // Выясним, есть ли правило для службы доставки -->
    $bRulePresent = false;
    foreach ($arConditions['CHILDREN'] as $k => $v) {
      if (
        ($v['CLASS_ID'] == 'PastCondSaleDelivery' || $v['CLASS_ID'] == 'CondSaleDelivery')
        //&& $v['DATA']['value'][0] == $val['ID']
        && in_array($val['ID'], $v['DATA']['value'])
      ) {
        $bRulePresent = true;
        break;
      }
    }
    // <-- 

    // Выясним сумму покупки -->
    $sum = 0;
    if ($bRulePresent) {
      foreach ($arConditions['CHILDREN'] as $k => $v) {
        if ($v['CLASS_ID'] == 'CondBsktAmtGroup' && !empty($v['DATA']['Value'])) {
          $sum = $v['DATA']['Value'];
          break;
        }
      }
    }
    // <-- 

    if (intval($sum) > 0) {
      $arDeliveries[$key]['PRODUCTS_COST'] = $sum;
    }
  }
}
// <-- Правила работы с корзиной

//$IBLOCK_ID = BitrixTools::getIblockId('DELIVERY_ZONE_ON_MAP');
$IBLOCK_ID = BitrixTools::getIblockId('delivery_map');
$arSelect = array("ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT", "DATE_ACTIVE_FROM", "PROPERTY_*"); // IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
$arFilter = array(
  "IBLOCK_ID" => $IBLOCK_ID,
  "ACTIVE_DATE" => "Y",
  "ACTIVE" => "Y",
  "!PROPERTY_COORD_POLYGON_FILE" => false
);
$res = CIBlockElement::GetList(array('sort' => 'asc'), $arFilter, false, array("nPageSize" => 150), $arSelect);

$VALUES = [];
$count = 0;

while ($ob = $res->GetNextElement()) {
  $arFields = $ob->GetFields();

  $VALUES['ZONES'][$count] = $arFields;

  $arProps = $ob->GetProperties();

  $VALUES['PROPS'][$count] = $arProps;

  // Доставка -->
  if (!empty($arProps['DELIVERY_ID']['VALUE']) && !empty($arDeliveries[$arProps['DELIVERY_ID']['VALUE']])) {
    $VALUES['PROPS'][$count]['DELIVERY'] = $arDeliveries[$arProps['DELIVERY_ID']['VALUE']];
  }

  // <-- Доставка

  $count += 1;
}

// Обработка координат -->
foreach ($VALUES['PROPS'] as $key => $arProps) {
  //vardump($prop);
  foreach ($arProps as $prop) {
    if ($prop['CODE'] == 'COORD_POLYGON_FILE') {
      $filePath = CFile::GetPath($prop['VALUE']);
      $polygon = file_get_contents($_SERVER["DOCUMENT_ROOT"] . $filePath);
      //echo 'filePath = '.$_SERVER["DOCUMENT_ROOT"] . $filePath.'<br />';

      //echo 'polygon = ' . $polygon . '<br />';

      // Если тип - Долгота, Широта -->
      if ($VALUES['PROPS'][$key]['COORD_POLYGON_TYPE']['VALUE_XML_ID'] == 'LNGLTD') {
        $ar = json_decode($polygon);
        $arTmp = array();
        foreach ($ar[0] as $k => $v) {
          $arTmp[0][$k] = array(0 => $v[1], 1 => $v[0]);
        }
        $polygon = json_encode($arTmp);
      }

      $VALUES['PROPS'][$key]['POLYGON'] = $polygon;

      //echo 'polygon = ' . $polygon . '<br />';
    }
  }
}
// <-- 

$metaData = [
  "type" => "FeatureCollection",
  "metadata" => [
    "name" => "delivery",
    "creator" => "Yandex Map Constructor"
  ],
  "features" => []
];

foreach ($VALUES['PROPS'] as $key => $prop) {
  $coordinates = "";
  if (!empty($prop['POPUP_COORD_POINT']['VALUE']['TEXT'])) {
    $coordinates = $prop['POPUP_COORD_POINT']['VALUE']['TEXT'];
  }
  $description = "";
  if (!empty($prop['POPUP_TITLE']['~VALUE']['TEXT'])) {
    $description = $prop['POPUP_TITLE']['~VALUE']['TEXT'];
  }
  $title_polygon = $description;
  if( !empty( $title_polygon ) )
  {
    $title_polygon = "{$title_polygon}" . '<br />';
  }
  $polygon = $prop['POLYGON'];
  /*
  $polygon = "";
  if (!empty($prop['POPUP_COORD_POLYGON']['VALUE']['TEXT'])) {
    $polygon = $prop['POPUP_COORD_POLYGON']['VALUE']['TEXT'];
  }
  */
  $strDelivery = '';
  if (intval($VALUES['PROPS'][$key]['DELIVERY']['PRICE']) > 0) {
    $strDelivery = "<strong>Стоимость доставки: {$VALUES['PROPS'][$key]['DELIVERY']['PRICE']}р.</strong></br>";
  }
  $strProductsCost = '';
  if (intval($VALUES['PROPS'][$key]['DELIVERY']['PRODUCTS_COST']) > 0)
  {
    $strProductsCost = "<strong>Сумма покупки для бесплатной доставки: {$VALUES['PROPS'][$key]['DELIVERY']['PRODUCTS_COST']}р.</strong></br>";
  }

  $data = [
    [
      "type" => "Feature",
      "id" => $key,
      "geometry" => [
        "type" => "Point",
        "coordinates" => json_decode($coordinates, true)
      ],
      "properties" => [
        "description" => "{$description}" . '<br />' .
          $strDelivery .
          $strProductsCost .
          //"<strong>Стоимость доставки: {$prop['POPUP_PRICE_DELIVERY']['VALUE']}р.</strong></br>" .
          //"<strong>Стоимость срочной доставки: {$prop['POPUP_PRICE_EXPRESS_DELIVERY']['VALUE']}р.</strong></br>" .
          //html_entity_decode($VALUES['ZONES'][$key]['DETAIL_TEXT'], ENT_HTML5),
          $VALUES['PROPS'][$key]['DELIVERY']['DESCRIPTION'],
        "iconCaption" => $VALUES['ZONES'][$key]['NAME'],
        "zIndex" => intval("300" . $key),
        "iconContent" => $key + 1
      ],
      "options" => [
        "iconColor" => strval($prop['POPUP_COLOR_POINT']['VALUE']),
        "visible" => false
      ],
    ],
    [
      "type" => "Feature",
      "id" => $key + 1,
      "geometry" => [
        "type" => "Polygon",
        "coordinates" => json_decode($polygon, true)
      ],
      "properties" => [
        //"description" => "{$description}" . '<br />' .
        "description" => $title_polygon .
          //"{$VALUES['PROPS'][$key]['DELIVERY']['NAME']}" . '<br />' .
          $strDelivery .
          $strProductsCost .
          //"<strong>Стоимость срочной доставки: {$prop['POPUP_PRICE_EXPRESS_DELIVERY']['VALUE']}р.</strong></br>" .
          //html_entity_decode($VALUES['ZONES'][$key]['DETAIL_TEXT'], ENT_HTML5),
          $VALUES['PROPS'][$key]['DELIVERY']['DESCRIPTION'],
        "fill" => $prop['POPUP_COLOR_ZONE']['VALUE'],
        "fill-opacity" => 0.6,
        //"stroke" => $prop['POPUP_COLOR_BORDER']['VALUE'],
        "stroke" => '#cf006f',
        "stroke-width" => "2",
        "stroke-opacity" => 0.6
      ]
    ],
  ];

  array_push($metaData['features'], $data[0]);
  array_push($metaData['features'], $data[1]);
}

//  p($VALUES);
//  exit;

//  $metaData = [
//    "type" => "FeatureCollection",
//    "metadata" => [
//      "name" => "delivery",
//      "creator" => "Yandex Map Constructor"
//    ],
//    "features" => [
//      [
//        "type" => "Feature",
//        "id" => 0,
//        "geometry" => [
//            "type" => "Point",
//            "coordinates" => json_decode($VALUES['PROPS'][1]['POPUP_COORD_POINT']['VALUE']['TEXT'], true)
//        ],
//        "properties" => [
//          "description" => "{$VALUES['PROPS'][1]['POPUP_TITLE']['~VALUE']['TEXT']}" .
//            "<strong>Стоимость доставки: {$VALUES['PROPS'][1]['POPUP_PRICE_DELIVERY']['VALUE']}р.</strong></br>" .
//            "<strong>Стоимость срочной доставки: {$VALUES['PROPS'][1]['POPUP_PRICE_EXPRESS_DELIVERY']['VALUE']}р.</strong></br>" .
//            html_entity_decode($VALUES['ZONES'][1]['DETAIL_TEXT'],ENT_HTML5),
//          "iconCaption" => $VALUES['ZONES'][1]['NAME'],
//          "zIndex" => 3000,
//          "iconContent" => "1"
//        ],
//        "options" => ["iconColor" => "#1e98ff"],
//      ],
//      [
//        "type" => "Feature",
//        "id" => 1,
//        "geometry" => [
//          "type" => "Point",
//          "coordinates" => json_decode($VALUES['PROPS'][2]['POPUP_COORD_POINT']['VALUE']['TEXT'], true)
//        ],
//        "properties" => [
//          "description" => "{$VALUES['PROPS'][2]['POPUP_TITLE']['~VALUE']['TEXT']}" .
//            "<strong>Стоимость доставки: {$VALUES['PROPS'][2]['POPUP_PRICE_DELIVERY']['VALUE']}р.</strong></br>" .
//            "<strong>Стоимость срочной доставки: {$VALUES['PROPS'][2]['POPUP_PRICE_EXPRESS_DELIVERY']['VALUE']}р.</strong></br>" .
//            html_entity_decode($VALUES['ZONES'][2]['DETAIL_TEXT'],ENT_HTML5),
//          "iconCaption" => $VALUES['ZONES'][2]['NAME'],
//          "zIndex" => 3001,
//          "iconContent" => "2"
//        ],
//        "options" => ["iconColor" => "#1bad03"],
//      ],
//      [
//        "type" => "Feature",
//        "id" => 2,
//        "geometry" => [
//          "type" => "Point",
//          "coordinates" => json_decode($VALUES['PROPS'][3]['POPUP_COORD_POINT']['VALUE']['TEXT'], true)
//        ],
//        "properties" => [
//          "description" => "{$VALUES['PROPS'][3]['POPUP_TITLE']['~VALUE']['TEXT']}" .
//            "<strong>Стоимость доставки: {$VALUES['PROPS'][3]['POPUP_PRICE_DELIVERY']['VALUE']}р.</strong></br>" .
//            "<strong>Стоимость срочной доставки: {$VALUES['PROPS'][3]['POPUP_PRICE_EXPRESS_DELIVERY']['VALUE']}р.</strong></br>" .
//            html_entity_decode($VALUES['ZONES'][3]['DETAIL_TEXT'],ENT_HTML5),
//          "iconCaption" => $VALUES['ZONES'][3]['NAME'],
//          "zIndex" => 3002,
//          "iconContent" => "3"
//        ],
//        "options" => ["iconColor" => "#e6761b"],
//      ],
//      [
//        "type" => "Feature",
//        "id" => 3,
//        "geometry" => [
//          "type" => "Point",
//          "coordinates" => json_decode($VALUES['PROPS'][4]['POPUP_COORD_POINT']['VALUE']['TEXT'], true)
//        ],
//        "properties" => [
//          "description" => "{$VALUES['PROPS'][4]['POPUP_TITLE']['~VALUE']['TEXT']}" .
//        "<strong>Стоимость доставки: {$VALUES['PROPS'][4]['POPUP_PRICE_DELIVERY']['VALUE']}р.</strong></br>" .
//        "<strong>Стоимость срочной доставки: {$VALUES['PROPS'][4]['POPUP_PRICE_EXPRESS_DELIVERY']['VALUE']}р.</strong></br>" .
//        html_entity_decode($VALUES['ZONES'][4]['DETAIL_TEXT'],ENT_HTML5),
//          "iconCaption" => $VALUES['ZONES'][4]['NAME'],
//          "zIndex" => 3003,
//          "iconContent" => "4"
//        ],
//        "options" => ["iconColor" => "#793d0e"],
//      ],
//      [
//        "type" => "Feature",
//        "id" => 4,
//        "geometry" => [
//          "type" => "Point",
//          "coordinates" => json_decode($VALUES['PROPS'][5]['POPUP_COORD_POINT']['VALUE']['TEXT'], true)
//        ],
//        "properties" => [
//          "description" => html_entity_decode($VALUES['ZONES'][5]['DETAIL_TEXT'],ENT_HTML5),
//          "iconCaption" => $VALUES['ZONES'][5]['NAME'],
//          "zIndex" => 3004,
//          "iconContent" => "5"
//        ],
//        "options" => ["iconColor" => "#ed4543"],
//      ],
//      [
//        "type" => "Feature",
//        "id" => 5,
//        "geometry" => [
//          "type" => "Polygon",
//          "coordinates" => json_decode($VALUES['PROPS'][4]['POPUP_COORD_POLYGON']['VALUE']['TEXT'], true)
//        ],
//        "properties" => [
//          "description" => "{$VALUES['PROPS'][4]['POPUP_TITLE']['~VALUE']['TEXT']}" .
//            "<strong>Стоимость доставки: {$VALUES['PROPS'][4]['POPUP_PRICE_DELIVERY']['VALUE']}р.</strong></br>" .
//            "<strong>Стоимость срочной доставки: {$VALUES['PROPS'][4]['POPUP_PRICE_EXPRESS_DELIVERY']['VALUE']}р.</strong></br>" .
//            html_entity_decode($VALUES['ZONES'][4]['DETAIL_TEXT'],ENT_HTML5),
//          "fill" => "#b3b3b3",
//          "fill-opacity" => 0.6,
//          "stroke" => "#793d0e",
//          "stroke-width" => "5",
//          "stroke-opacity" => 0.9
//        ]
//      ],
//      [
//        "type" => "Feature",
//        "id" => 6,
//        "geometry" => [
//          "type" => "Polygon",
//          "coordinates" => json_decode($VALUES['PROPS'][3]['POPUP_COORD_POLYGON']['VALUE']['TEXT'], true)
//        ],
//        "properties" => [
//          "description" => "{$VALUES['PROPS'][3]['POPUP_TITLE']['~VALUE']['TEXT']}" .
//            "<strong>Стоимость доставки: {$VALUES['PROPS'][3]['POPUP_PRICE_DELIVERY']['VALUE']}р.</strong></br>" .
//            "<strong>Стоимость срочной доставки: {$VALUES['PROPS'][3]['POPUP_PRICE_EXPRESS_DELIVERY']['VALUE']}р.</strong></br>" .
//            html_entity_decode($VALUES['ZONES'][3]['DETAIL_TEXT'],ENT_HTML5),
//          "fill" => "#ff931e",
//          "fill-opacity" => 0.6,
//          "stroke" => "#e6761b",
//          "stroke-width" => "5",
//          "stroke-opacity" => 0.9
//        ]
//      ],
//      [
//        "type" => "Feature",
//        "id" => 7,
//        "geometry" => [
//          "type" => "Polygon",
//          "coordinates" => json_decode($VALUES['PROPS'][2]['POPUP_COORD_POLYGON']['VALUE']['TEXT'], true)
//        ],
//        "properties" => [
//          "description" => "{$VALUES['PROPS'][2]['POPUP_TITLE']['~VALUE']['TEXT']}" .
//            "<strong>Стоимость доставки: {$VALUES['PROPS'][2]['POPUP_PRICE_DELIVERY']['VALUE']}р.</strong></br>" .
//            "<strong>Стоимость срочной доставки: {$VALUES['PROPS'][2]['POPUP_PRICE_EXPRESS_DELIVERY']['VALUE']}р.</strong></br>" .
//            html_entity_decode($VALUES['ZONES'][2]['DETAIL_TEXT'],ENT_HTML5),
//          "fill" => "#56db40",
//          "fill-opacity" => 0.6,
//          "stroke" => "#1bad03",
//          "stroke-width" => "5",
//          "stroke-opacity" => 0.9
//        ]
//      ],
//      [
//        "type" => "Feature",
//        "id" => 8,
//        "geometry" => [
//          "type" => "Polygon",
//          "coordinates" => json_decode($VALUES['PROPS'][1]['POPUP_COORD_POLYGON']['VALUE']['TEXT'], true)
//        ],
//        "properties" => [
//          "description" => "{$VALUES['PROPS'][1]['POPUP_TITLE']['~VALUE']['TEXT']}" .
//            "<strong>Стоимость доставки: {$VALUES['PROPS'][1]['POPUP_PRICE_DELIVERY']['VALUE']}р.</strong></br>" .
//            "<strong>Стоимость срочной доставки: {$VALUES['PROPS'][1]['POPUP_PRICE_EXPRESS_DELIVERY']['VALUE']}р.</strong></br>" .
//            html_entity_decode($VALUES['ZONES'][1]['DETAIL_TEXT'],ENT_HTML5),
//          "fill" => "#82cdff",
//          "fill-opacity" => 0.6,
//          "stroke" => "#1e98ff",
//          "stroke-width" => "5",
//          "stroke-opacity" => 0.9
//        ]
//      ],
//    ]
//  ];

header("Content-Type: application/json");

echo json_encode($metaData);
