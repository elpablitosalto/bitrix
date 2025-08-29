<?
use Bitrix\Main\Context;

define('SHOW_TELEGRAM_SUBSCRIBE', 'N');
define('SHOW_CONTACT_US_BUTTON', 'N');
define('LEFT_MENU_TYPE', 'leftside_profile');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/classes/SimpleXLSXGen.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/classes/tfpdf/tfpdf.php");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-account');
$APPLICATION->SetTitle("Моя ведомость");
$APPLICATION->SetPageProperty("PAGE_H3", 'Моя ведомость');
$template = "main";

$request = Context::getCurrent()->getRequest();
if ($request->get("download") == "xls" || $request->get("download") == "pdf") {
    $GLOBALS['APPLICATION']->RestartBuffer();
    $template = $request->get("download") ;
}
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket",
    $template,
    Array(
        "ACTION_VARIABLE" => "action",
        "AUTO_CALCULATION" => "Y",
        "TEMPLATE_THEME" => "blue",
        "COLUMNS_LIST" => array("NAME","DISCOUNT","WEIGHT","DELETE","DELAY","PRICE","SUM","QUANTITY","PROPS"),
        "COMPONENT_TEMPLATE" => ".default",
        "GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
        "GIFTS_CONVERT_CURRENCY" => "Y",
        "GIFTS_HIDE_BLOCK_TITLE" => "N",
        "GIFTS_HIDE_NOT_AVAILABLE" => "N",
        "GIFTS_MESS_BTN_BUY" => "Выбрать",
        "GIFTS_MESS_BTN_DETAIL" => "Подробнее",
        "GIFTS_PAGE_ELEMENT_COUNT" => "4",
        "GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
        "GIFTS_PRODUCT_QUANTITY_VARIABLE" => "",
        "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
        "GIFTS_SHOW_IMAGE" => "Y",
        "GIFTS_SHOW_NAME" => "Y",
        "GIFTS_SHOW_OLD_PRICE" => "Y",
        "GIFTS_TEXT_LABEL_GIFT" => "Подарок",
        "GIFTS_PLACE" => "BOTTOM",
        "HIDE_COUPON" => "Y",
        "OFFERS_PROPS" => array(),
        "PATH_TO_ORDER" => "/personal/order.php",
        "PRICE_VAT_SHOW_VALUE" => "N",
        "QUANTITY_FLOAT" => "N",
        "SET_TITLE" => "Y",
        "USE_GIFTS" => "Y",
        "USE_PREPAYMENT" => "N"
    )
);?>

<?
if ($request->get("download") == "xls" || $request->get("download") == "pdf") {
    die();
}
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>