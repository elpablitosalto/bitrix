<?
define('MENU_TYPE', 5);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контент");
$APPLICATION->SetPageProperty("PAGE_H3", 'Контент');
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-content');
?>

<?/*?>
<?
if (strlen($_GET['ELEMENT_CODE']) > 0) {
  $arSelect = array("ID", "NAME", "PROPERTY_CONSTRUCTOR");
  $arFilter = array(
    "IBLOCK_ID" => Indexis::getIblockId('content', 'content'),
    "ACTIVE_DATE" => "Y",
    "ACTIVE" => "Y",
    "CODE" => $_GET['ELEMENT_CODE']
  );
  $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
  while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arResult["CONSTRUCTOR"] = $arFields['PROPERTY_CONSTRUCTOR_VALUE'];
  }
}
?>
<? if (!empty($arResult["CONSTRUCTOR"])) { ?>
  <section class="dp-section">
    <div class="container">
      <div class="dp-section__body">

        <? if (intval($arResult["CONSTRUCTOR"]) > 0) { ?>
          <? $APPLICATION->IncludeComponent(
            "indexis:page.constructor",
            "",
            array(
              "CACHE_TIME" => "36000000",
              "CACHE_TYPE" => "A",
              "SECTION_ID" => $arResult["CONSTRUCTOR"]
            )
          ); ?>
        <? } else {
        } ?>

      </div>
    </div>
  </section>
<? } ?>
<?*/?>

<?/**/?>
<? $APPLICATION->IncludeComponent(
  "bitrix:news.detail",
  "content",
  array(
    "ACTIVE_DATE_FORMAT" => "d.m.Y",
    "ADD_ELEMENT_CHAIN" => "N",
    "ADD_SECTIONS_CHAIN" => "N",
    "AJAX_MODE" => "N",
    "AJAX_OPTION_ADDITIONAL" => "",
    "AJAX_OPTION_HISTORY" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "BROWSER_TITLE" => "-",
    "CACHE_GROUPS" => "Y",
    "CACHE_TIME" => "36000000",
    "CACHE_TYPE" => "A",
    "CHECK_DATES" => "Y",
    "DETAIL_URL" => "",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "DISPLAY_DATE" => "Y",
    "DISPLAY_NAME" => "Y",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "DISPLAY_TOP_PAGER" => "N",
    "ELEMENT_CODE" => $_GET['ELEMENT_CODE'],
    "ELEMENT_ID" => "",
    "FIELD_CODE" => array("", ""),
    "FILE_404" => "",
    "IBLOCK_ID" => Indexis::getIblockId('content', 'content'),
    "IBLOCK_TYPE" => "content",
    "IBLOCK_URL" => "",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "MESSAGE_404" => "",
    "META_DESCRIPTION" => "-",
    "META_KEYWORDS" => "-",
    "PAGER_BASE_LINK_ENABLE" => "N",
    "PAGER_SHOW_ALL" => "N",
    "PAGER_TEMPLATE" => ".default",
    "PAGER_TITLE" => "Страница",
    "PROPERTY_CODE" => array(
      'CONSTRUCTOR'
    ),
    "SET_BROWSER_TITLE" => "N",
    "SET_CANONICAL_URL" => "N",
    "SET_LAST_MODIFIED" => "N",
    "SET_META_DESCRIPTION" => "N",
    "SET_META_KEYWORDS" => "Y",
    "SET_STATUS_404" => "N",
    "SET_TITLE" => "N",
    "SHOW_404" => "Y",
    "STRICT_SECTION_CHECK" => "N",
    "USE_PERMISSIONS" => "N",
    "USE_SHARE" => "N"
  )
); ?>
<?/**/ ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>