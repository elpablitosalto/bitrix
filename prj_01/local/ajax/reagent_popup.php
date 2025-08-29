<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>

<?
$IBLOCK_ID = $_REQUEST["IBLOCK_ID"];
$ELEMENT_ID = $_REQUEST["ELEMENT_ID"];
$IBLOCK_CODE = $_REQUEST["IBLOCK_CODE"];
//vardump($_POST);
switch ($IBLOCK_CODE) {
    case 'hematology':
        $template = 'hematology';
        $PROPERTY_CODE = $GLOBALS['arSiteConfig']['PROPERTY_CODE']['hematology'];
        break;
    case 'biochemistry':
        $template = 'biochemistry';
        $PROPERTY_CODE = $GLOBALS['arSiteConfig']['PROPERTY_CODE']['biochemistry'];
        break;
    case 'analysis':
        $template = 'analysis';
        $PROPERTY_CODE = $GLOBALS['arSiteConfig']['PROPERTY_CODE']['analysis'];
        break;
    case 'veterinary':
        $template = 'veterinary';
        $PROPERTY_CODE = $GLOBALS['arSiteConfig']['PROPERTY_CODE']['veterinary'];
        break;
}
?>
<? if (intval($IBLOCK_ID) > 0 && intval($ELEMENT_ID) > 0) { ?>
<? $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "reagent",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "USE_SHARE" => "Y",
            "SHARE_HIDE" => "N",
            "SHARE_TEMPLATE" => "",
            "SHARE_HANDLERS" => array("delicious"),
            "SHARE_SHORTEN_URL_LOGIN" => "",
            "SHARE_SHORTEN_URL_KEY" => "",
            "AJAX_MODE" => "Y",
            "IBLOCK_TYPE" => "reagents",
            "IBLOCK_ID" => $IBLOCK_ID,
            "ELEMENT_ID" => $ELEMENT_ID,
            "ELEMENT_CODE" => "",
            "CHECK_DATES" => "Y",
            "FIELD_CODE" => array('ID', 'NAME', 'PREVIEW_PICTURE'),
            "PROPERTY_CODE" => $PROPERTY_CODE,
            "IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
            "DETAIL_URL" => "",
            "SET_TITLE" => "Y",
            "SET_CANONICAL_URL" => "Y",
            "SET_BROWSER_TITLE" => "Y",
            "BROWSER_TITLE" => "-",
            "SET_META_KEYWORDS" => "Y",
            "META_KEYWORDS" => "-",
            "SET_META_DESCRIPTION" => "Y",
            "META_DESCRIPTION" => "-",
            "SET_STATUS_404" => "Y",
            "SET_LAST_MODIFIED" => "Y",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "ADD_ELEMENT_CHAIN" => "N",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "USE_PERMISSIONS" => "Y",
            "GROUP_PERMISSIONS" => array("1"),
            "CACHE_TYPE" => "N",
            "CACHE_TIME" => "3600",
            "CACHE_GROUPS" => "Y",
            "DISPLAY_TOP_PAGER" => "Y",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Страница",
            "PAGER_TEMPLATE" => "",
            "PAGER_SHOW_ALL" => "Y",
            "PAGER_BASE_LINK_ENABLE" => "Y",
            "SHOW_404" => "N",
            "MESSAGE_404" => "",
            "STRICT_SECTION_CHECK" => "Y",
            "PAGER_BASE_LINK" => "",
            "PAGER_PARAMS_NAME" => "arrPager",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N"
        )
    ); ?>
<? } ?>

<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>