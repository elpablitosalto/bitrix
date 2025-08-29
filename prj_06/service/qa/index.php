<?
define('SUB_MENU_PAGE_TYPE', 2);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle('Вопрос-ответ');
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'Page sect_or bigSlider');
?>
<? $APPLICATION->IncludeComponent(
  "bitrix:news.detail",
  "about",
  array(
    "DISPLAY_DATE" => "N",
    "DISPLAY_NAME" => "N",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "N",
    "USE_SHARE" => "N",
    "SHARE_HIDE" => "Y",
    "SHARE_TEMPLATE" => "",
    "SHARE_HANDLERS" => array("delicious"),
    "SHARE_SHORTEN_URL_LOGIN" => "",
    "SHARE_SHORTEN_URL_KEY" => "",
    "AJAX_MODE" => "N",
    "IBLOCK_TYPE" => 'service',
    "IBLOCK_ID" => Indexis::getIblockId('qa_intro', 'service'),
    "ELEMENT_ID" => "",
    "ELEMENT_CODE" => "qa_intro",
    "CHECK_DATES" => "Y",
    "FIELD_CODE" => array("ID", 'NAME', 'DETAIL_PICTURE', 'DETAIL_TEXT'),
    "PROPERTY_CODE" => array("H_2", 'IMAGES', 'TABLE_HEADER', 'TABLE', 'TABLE_AFTER_TEXT'),
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
    "SET_STATUS_404" => "N",
    "SET_LAST_MODIFIED" => "N",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "ADD_SECTIONS_CHAIN" => "N",
    "ADD_ELEMENT_CHAIN" => "N",
    "ACTIVE_DATE_FORMAT" => "d.m.Y",
    "USE_PERMISSIONS" => "N",
    "GROUP_PERMISSIONS" => array("1"),
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
    "CACHE_GROUPS" => "Y",
    "DISPLAY_TOP_PAGER" => "N",
    "DISPLAY_BOTTOM_PAGER" => "N",
    "PAGER_TITLE" => "Страница",
    "PAGER_TEMPLATE" => "",
    "PAGER_SHOW_ALL" => "N",
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

<?
//echo '!';
?>
<? $APPLICATION->IncludeComponent(
  "bitrix:support.faq.section.list",
  "kamvek",
  array(
    "IBLOCK_TYPE" => "service",
    "IBLOCK_ID" => Indexis::getIblockId('qa_list', 'service'),
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
    "CACHE_GROUPS" => "Y",
    "AJAX_MODE" => "N",
    "SECTION" => "-",
    "EXPAND_LIST" => "Y",
    "SECTION_URL" => "faq_detail.php?SECTION_ID=#SECTION_ID#",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N"
  ),
); ?>

<?/*?>
<? $APPLICATION->IncludeComponent(
  "bitrix:support.faq.element.list",
  "kamvek",
  array(
    "IBLOCK_TYPE" => "service",
    "IBLOCK_ID" => Indexis::getIblockId('qa_list', 'service'),
    "SHOW_RATING" => "N",
    "RATING_TYPE" => "like",
    "PATH_TO_USER" => "",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
    "CACHE_GROUPS" => "Y",
    "AJAX_MODE" => "N",
    "SECTION_ID" => $_REQUEST["SECTION_ID"],
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N"
  )
); ?>
<?*/ ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>