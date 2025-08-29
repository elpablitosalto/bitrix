<?
//define('SHOW_CONTACT_US_BUTTON', 'N');
//define('SHOW_TAGS_MENU', 'Y');
define('PAGE_COLUMNS_COUNT', 1);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
//$APPLICATION->SetPageProperty("PAGE_H3", 'Производство');
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-search');
?>

<?
$APPLICATION->IncludeComponent(
  "bitrix:search.page",
  "products",
  array(
    "CHECK_DATES" => "Y",
    "arrWHERE" => array("iblock_1c_catalog"),
    "arrFILTER" => array("iblock_1c_catalog"),
    "SHOW_WHERE" => "N",
    "CACHE_TYPE" => 'A',
    "CACHE_TIME" => '3600',
    "SET_TITLE" => 'Y',
    "arrFILTER_iblock_1c_catalog" => Indexis::getIblockId('1c_catalog', '1c_catalog'),
    "PAGE" => $_SERVER['REQUEST_URI'],
    'USE_TITLE_RANK' => 'Y',
    'PAGE_RESULT_COUNT' => 2000,
    'PRODUCTS_IBLOCK_ID' => Indexis::getIblockId('1c_catalog', '1c_catalog'),
    'PRODUCTS_IBLOCK_TYPE' => '1c_catalog',
    "USE_LANGUAGE_GUESS" => "N",
  )
);
?>

<?/*?>
<? if (mb_strlen($_GET["q"]) > 0) { ?>
    <?
    $arSearchParams = array(
      '~FILTER_NAME' => 'arrFilterReagents',
      'CHECK_DATES' => 'N',
      'IBLOCK_TYPE' => 'reagents',
      'CACHE_TYPE' => 'N',
      'CACHE_TIME' => '3600',
      'SET_TITLE' => 'N',
      'IBLOCK_ID' => $IBLOCK_ID,
    );
    $GLOBALS[$arSearchParams["~FILTER_NAME"]]["=ID"] = $APPLICATION->IncludeComponent(
      "bitrix:search.page",
      "products",
      array(
        "CHECK_DATES" => $arSearchParams["CHECK_DATES"] !== "N" ? "Y" : "N",
        "arrWHERE" => array("iblock_" . $arSearchParams["IBLOCK_TYPE"]),
        "arrFILTER" => array("iblock_" . $arSearchParams["IBLOCK_TYPE"]),
        "SHOW_WHERE" => "N",
        "CACHE_TYPE" => $arSearchParams["CACHE_TYPE"],
        "CACHE_TIME" => $arSearchParams["CACHE_TIME"],
        "SET_TITLE" => $arSearchParams["SET_TITLE"],
        "arrFILTER_iblock_" . $arSearchParams["IBLOCK_TYPE"] => array($arSearchParams["IBLOCK_ID"]),
        "PAGE" => $_SERVER['REQUEST_URI'],
        'USE_TITLE_RANK' => 'Y',
        'PAGE_RESULT_COUNT' => 5000,
      ),
      $component
    );
    if (empty($GLOBALS[$arSearchParams["~FILTER_NAME"]]["=ID"])) {
      $bShowComponent = false;
    }
    ?>
<? } else { ?>

<? } ?>
<? $APPLICATION->IncludeComponent(
  "bitrix:search.form",
  "products",
  array(
    //"PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],
    //"PAGE" => $arResult["FOLDER"],
    "PAGE" => $_SERVER['REQUEST_URI'],
  ),
  $component
); ?>

<? if ($bShowComponent == false) { ?>
    <? ShowError('Ничего не найдено'); ?>
<? } else { ?>
    <? $APPLICATION->IncludeComponent(
      "bitrix:news.list",
      $template,
      array(
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "reagents",
        "IBLOCK_ID" => $IBLOCK_ID,
        "IBLOCK_CODE" => $IBLOCK_CODE,
        "NEWS_COUNT" => "2000",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "arrFilterReagents",
        "FIELD_CODE" => array('ID', 'NAME', 'IBLOCK_SECTION_ID'),
        "PROPERTY_CODE" => $PROPERTY_CODE,
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "Y",
        "SET_BROWSER_TITLE" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_META_DESCRIPTION" => "Y",
        "SET_LAST_MODIFIED" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "Y",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "Y",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "arrPager",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",

        // Мои параметры -->
        'CUSTOM_SECTION_SORT' => $CUSTOM_SECTION_SORT,
        // <-- Мои параметры 
      )
    ); ?>
<? } ?>
<?*/?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>