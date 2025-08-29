<?
define('SHOW_COLUMNS_IN_HEADER', 'N');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Коллекции");
//$APPLICATION->SetPageProperty("PAGE_H3", 'Коллекции');
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-default');
?>
<?
// Фильтр -->
$GLOBALS['arrFilterCollections'] = array();
$isFilter = 'N';
$filterType = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['TYPE_FORM'])) {
  if ($_POST['TYPE_FORM'] == 'COLLS') {
    foreach ($_POST as $key => $val) {
      if (strpos($key, 'colls_') !== false && $val == 'on') {
        $id = str_replace('colls_', '', $key);
        if (intval($id) > 0) {
          $GLOBALS['arrFilterCollections']['ID'][] = $id;
        }
      }
    }
  } else if ($_POST['TYPE_FORM'] == 'PRODUCTS') {
    if ($_POST['PRODUCT'] !== 'ALL') {
      $arColls = unserialize(urldecode($_POST['PRODUCT']));
      $GLOBALS['arrFilterCollections']['ID'] = $arColls;
    }
  }
  if (!empty($GLOBALS['arrFilterCollections'])) {
    $isFilter = 'Y';
    $filterType = $_POST['TYPE_FORM'];
  }
}
// <-- Фильтр
?>
<? $APPLICATION->IncludeComponent(
  "bitrix:news.list",
  "collections",
  array(
    "DISPLAY_DATE" => "N",
    "DISPLAY_NAME" => "N",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "AJAX_MODE" => "N",
    "IBLOCK_TYPE" => "store",
    "IBLOCK_ID" => Indexis::getIblockId('collections', 'store'),
    "NEWS_COUNT" => "9",
    "SORT_BY1" => 'SORT',
    "SORT_ORDER1" => 'ASC',
    "SORT_BY2" => "NAME",
    "SORT_ORDER2" => "ASC",
    "FILTER_NAME" => "arrFilterCollections",
    "FIELD_CODE" => array("ID", 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'CODE'),
    "PROPERTY_CODE" => array('NEW', 'YEAR'),
    "CHECK_DATES" => "N",
    "DETAIL_URL" => "",
    "PREVIEW_TRUNCATE_LEN" => "",
    "ACTIVE_DATE_FORMAT" => "d.m.Y",
    "SET_TITLE" => "N",
    "SET_BROWSER_TITLE" => "N",
    "SET_META_KEYWORDS" => "N",
    "SET_META_DESCRIPTION" => "N",
    "SET_LAST_MODIFIED" => "N",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "ADD_SECTIONS_CHAIN" => "N",
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
    "PARENT_SECTION" => "",
    "PARENT_SECTION_CODE" => "",
    "INCLUDE_SUBSECTIONS" => "Y",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
    "CACHE_FILTER" => "Y",
    "CACHE_GROUPS" => "Y",
    "DISPLAY_TOP_PAGER" => "N",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "PAGER_TITLE" => "Подразделы",
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_TEMPLATE" => "show_more_colls",
    //"PAGER_TEMPLATE" => "",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    "PAGER_SHOW_ALL" => "N",
    "PAGER_BASE_LINK_ENABLE" => "N",
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
    "PRODUCTS_IBLOCK_ID" => Indexis::getIblockId('1c_catalog', '1c_catalog'),
    'IS_FILTER' => $isFilter,
    'FILTER_TYPE' => $filterType,
    // <-- Мои параметры
  )
); ?>

<br />
<br />

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>