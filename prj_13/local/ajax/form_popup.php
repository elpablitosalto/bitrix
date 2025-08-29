<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>

<?
$template = '';
$WEB_FORM_ID = 0;

switch ($_GET['TYPE_FORM']) {
    case 'order':
        $template = 'product_on_order';
        $WEB_FORM_ID = $GLOBALS["arSiteConfig"]["WEB_FORM_ID_PRODUCT_ON_ORDER"];
        break;
    case 'analogue':
        $template = 'choose_analogue';
        $WEB_FORM_ID = $GLOBALS["arSiteConfig"]["WEB_FORM_ID_CHOOSE_ANALOGUE"];
        break;
    case 'wholesale':
    case 'know':
        $template = 'request_wholesale_price';
        $WEB_FORM_ID = $GLOBALS["arSiteConfig"]["WEB_FORM_ID_REQUEST_WHOLESALE_PRICE"];
        break;
}
?>

<? if (strlen($template) > 0 && intval($WEB_FORM_ID) > 0) { ?>
<? $APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        $template,
        array(
            "SEF_MODE" => "N",
            "WEB_FORM_ID" => $WEB_FORM_ID,
            "LIST_URL" => "",
            "EDIT_URL" => "",
            "SUCCESS_URL" => "",
            "CHAIN_ITEM_TEXT" => "",
            "CHAIN_ITEM_LINK" => "",
            "IGNORE_CUSTOM_TEMPLATE" => "Y",
            "USE_EXTENDED_ERRORS" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "SEF_FOLDER" => "/",
            "VARIABLE_ALIASES" => array(),
            'PRODUCT_NAME' => array(
                'VALUE' => 'NAME',
                'AUTOCOMPLETE' => 'Y'
            ),
            "AJAX_MODE" => "N",
        )
    ); ?>
<? } ?>

<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>