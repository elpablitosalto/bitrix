<?
define('MENU_TYPE', 3);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Индивидуальный заказ");
$APPLICATION->SetPageProperty("PAGE_H3", 'Индивидуальный заказ');
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'dp-page-individual');
?>

<section class="dp-section">
  <div class="container">
    <div class="dp-section__body">
      <div class="individual__slider">
        <div class="individual__slide individual__slide-active">
          <picture>
            <source media="(max-width: 767px)" srcset="<?=SITE_TEMPLATE_PATH?>/img/content/individual/1-mob.png">
            <source media="(max-width: 1199px)" srcset="<?=SITE_TEMPLATE_PATH?>/img/content/individual/1-lap.png">
            <img src="<?=SITE_TEMPLATE_PATH?>/img/content/individual/1.png" alt="">
          </picture>
        </div>
        <div class="individual__slide">
          <picture>
            <source media="(max-width: 767px)" srcset="<?=SITE_TEMPLATE_PATH?>/img/content/individual/1.jpg">
            <source media="(max-width: 1199px)" srcset="<?=SITE_TEMPLATE_PATH?>/img/content/individual/1.jpg">
            <img src="<?=SITE_TEMPLATE_PATH?>/img/content/individual/1.jpg" alt="">
          </picture>
        </div>
        <div class="individual__slide">
          <picture>
            <source media="(max-width: 767px)" srcset="<?=SITE_TEMPLATE_PATH?>/img/content/individual/2.jpg">
            <source media="(max-width: 1199px)" srcset="<?=SITE_TEMPLATE_PATH?>/img/content/individual/2.jpg">
            <img src="<?=SITE_TEMPLATE_PATH?>/img/content/individual/2.jpg" alt="">
          </picture>
        </div>
      </div>
    </div>
  </div>
</section>


<? $APPLICATION->IncludeComponent(
  "bitrix:news.list",
  "portfolio_inc",
  array(
    "DISPLAY_DATE" => "N",
    "DISPLAY_NAME" => "N",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "AJAX_MODE" => "N",
    "IBLOCK_TYPE" => "content",
    "IBLOCK_ID" => Indexis::getIblockId('portfolio', 'content'),
    "NEWS_COUNT" => "3",
    "SORT_BY1" => 'SORT',
    "SORT_ORDER1" => 'ASC',
    "SORT_BY2" => "SORT",
    "SORT_ORDER2" => "ASC",
    "FILTER_NAME" => "arrFilterReviews",
    "FIELD_CODE" => array("ID", 'NAME', 'DETAIL_PAGE_URL', 'DETAIL_TEXT', 'DETAIL_PICTURE', 'PREVIEW_TEXT', 'PREVIEW_PICTURE'),
    "PROPERTY_CODE" => array('PICTURE_CUSTOM_ORDER'),
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
    "PAGER_SHOW_ALWAYS" => "Y",
    "PAGER_TEMPLATE" => "show_more",
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
    // <-- Мои параметры
  )
); ?>

<? $APPLICATION->IncludeComponent(
  "bitrix:news.list",
  "individual_order",
  array(
    "DISPLAY_DATE" => "N",
    "DISPLAY_NAME" => "N",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "AJAX_MODE" => "N",
    "IBLOCK_TYPE" => "content",
    "IBLOCK_ID" => Indexis::getIblockId('individual_order', 'content'),
    "NEWS_COUNT" => "200",
    "SORT_BY1" => 'SORT',
    "SORT_ORDER1" => 'ASC',
    "SORT_BY2" => "SORT",
    "SORT_ORDER2" => "ASC",
    "FILTER_NAME" => "arrFilterReviews",
    "FIELD_CODE" => array("ID", 'NAME', 'DETAIL_PAGE_URL', 'DETAIL_TEXT', 'DETAIL_PICTURE', 'PREVIEW_TEXT', 'PREVIEW_PICTURE'),
    "PROPERTY_CODE" => array('IMAGES', 'LINK', 'LINK_TEXT'),
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
    "PAGER_TEMPLATE" => "show_more",
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
    // <-- Мои параметры
  )
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>