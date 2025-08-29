<?
$GLOBALS['arSiteConfig'] = array(
    "PRIVACY_LINK" => "/privacy/",
    "OFFER_LINK" => "/offer/",
    "WEB_FORM_ID_QUESTION" => 1,
    "WEB_FORM_ID_QUESTION_TO_TECHNOLOGIST" => 2,
    "WEB_FORM_ID_PRODUCT_ON_ORDER" => 3,
    "WEB_FORM_ID_REQUEST_WHOLESALE_PRICE" => 4,
    "WEB_FORM_ID_CHOOSE_ANALOGUE" => 5,
    "WEB_FORM_ID_OBJECT_EXIST" => 6,
    "WEB_FORM_ID_WHOLESALE_PURCHASE" => 7,
    "WEB_FORM_ID_CONTACTS" => 8,

    'CATALOG_LIST' => array(
        'IMG_WIDTH' => 240,
        'IMG_HEIGHT' => 240,
    ),
    'CATALOG_ELEMENT' => array(
        'IMG_WIDTH' => 440,
        'IMG_HEIGHT' => 440,
        'IMG_WIDTH_SLIDE' => 44,
        'IMG_HEIGHT_SLIDE' => 34,
    ),
    'REVIEWS_PRODUCT_DETAIL' => array(
        'IMG_WIDTH' => 80,
        'IMG_HEIGHT' => 80,
    ),

    'HL' => array(
        'COLORS' => array(
            'ID' => 5
        )
    ),

    'IBLOCK' => array(
        'CATALOG' => array(
            'ID' => 7
        )
    ),

    'ORDER' => array(
        'DEFAULT' => array(
            'PAY_SYSTEM' => 12, // Наличные
            'LOCATION' => '0000073738', // Москва
            'PRICE_TYPE' => 1, // Базовая цена
        )
    ),

    'AJAX' => array(
        'BASKET_URL' => "/local/ajax/basket.php",
        'ORDER_URL' => "/local/ajax/order.php",
    ),

    'BONUS_PERCENT' => 1.5,
    'BONUS_MIN_WITHDRAW' => 1500,
    'ROISTAT' => [
        'KEY' => 'ZjIwNWZkZGEzMTIyOTJkY2FmNGFkNmQ5ZGRmZDc1OTM6MTcxNTM5'
    ],
);
?>