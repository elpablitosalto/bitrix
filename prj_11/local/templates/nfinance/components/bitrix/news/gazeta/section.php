<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
if (!empty($arResult["VARIABLES"]["SECTION_ID"])) {
  $rsSection = \Bitrix\Iblock\SectionTable::getById($arResult["VARIABLES"]["SECTION_ID"]);
  if ($rsSection) {
    $arSection = $rsSection->fetch();
    $APPLICATION->SetTitle($arSection["NAME"]);
    $APPLICATION->AddChainItem($arSection["NAME"]);
  }
} else {
  // TODO: 404
}
?>
<div class="page__content-top">
  <div class="page__holder">
    <div class="page__top-wrapper">
      <div class="page__breadcrumbs">
        <!-- begin .breadcrumbs-->
        <? $APPLICATION->IncludeComponent(
          "bitrix:breadcrumb",
          "main",
          array(
            "START_FROM" => "0",
            "SITE_ID" => "s1"
          )
        ); ?>
        <!-- end .breadcrumbs-->
      </div>
      <div class="page__search">
        <!-- begin .search-panel-->
        <? $APPLICATION->IncludeComponent(
          "bitrix:search.title",
          "gazeta",
          array(
            "SHOW_INPUT" => "Y",
            "SHOW_OTHERS" => "N",
            "INPUT_ID" => "gazeta-body-search-input",
            "CONTAINER_ID" => "gazeta-body-search",
            "PRICE_VAT_INCLUDE" => "Y",
            "PREVIEW_TRUNCATE_LEN" => "150",
            "SHOW_PREVIEW" => "Y",
            "PREVIEW_WIDTH" => "75",
            "PREVIEW_HEIGHT" => "75",
            "CONVERT_CURRENCY" => "Y",
            "CURRENCY_ID" => "RUB",
            "PAGE" => "#SITE_DIR#search/",
            "NUM_CATEGORIES" => "1",
            "TOP_COUNT" => "10",
            "ORDER" => "date",
            "USE_LANGUAGE_GUESS" => "Y",
            "CHECK_DATES" => "Y",
            "SHOW_OTHERS" => "Y",
            "CATEGORY_0_TITLE" => "Новости",
            "CATEGORY_0" => array(
              0 => "iblock_newspaper",
            ),
            "CATEGORY_0_iblock_news" => array(
              0 => "all",
            ),
            "CATEGORY_1_TITLE" => "Форумы",
            "CATEGORY_1" => array(
              0 => "forum",
            ),
            "CATEGORY_1_forum" => array(
              0 => "all",
            ),
            "CATEGORY_2_TITLE" => "Каталоги",
            "CATEGORY_2" => array(
              0 => "iblock_books",
            ),
            "CATEGORY_2_iblock_books" => "all",
            "CATEGORY_OTHERS_TITLE" => "Прочее",
            "COMPONENT_TEMPLATE" => "gazeta",
            "CATEGORY_0_iblock_content" => array(
              0 => "all",
            ),
            "CATEGORY_0_iblock_newspaper" => array(
              0 => "4",
              1 => "5",
              2 => "6",
            )
          ),
          false
        ); ?>
        <!-- end .search-panel-->
      </div>
    </div>
  </div>
</div>
<div class="page__section">
  <div class="page__holder">
    <!-- begin .section-->
    <div class="section section_space_top-close">
      <? $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "gazeta",
        array(
          "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "",
          "VIEW_MODE" => "TEXT",
          "SHOW_PARENT_NAME" => "N",
          "IBLOCK_TYPE" => "newspaper",
          "IBLOCK_ID" => "4",
          "SECTION_ID" => "",
          "SECTION_CODE" => "",
          "SECTION_URL" => "",
          "COUNT_ELEMENTS" => "Y",
          "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
          "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
          "TOP_DEPTH" => "1",
          "SECTION_FIELDS" => array(
            0 => "",
            1 => "",
          ),
          "SECTION_USER_FIELDS" => array(
            0 => "UF_ICON",
            1 => "UF_BACKGROUND",
            2 => "",
          ),
          "ADD_SECTIONS_CHAIN" => "Y",
          "CACHE_TYPE" => "N",
          "CACHE_TIME" => "36000000",
          "CACHE_NOTES" => "",
          "CACHE_GROUPS" => "Y",
          "COMPONENT_TEMPLATE" => "gazeta",
          "FILTER_NAME" => "sectionsFilter",
          "CACHE_FILTER" => "N"
        ),
        false
      ); ?>
      <div class="section__filter">
        <!-- begin .link-group-->
        <div class="link-group link-group_layout_horizontal link-group_style_secondary">
          <div class="link-group__title">
            <!-- begin .title-->
            <h4 class="title title_size_sh4"><? $APPLICATION->ShowTitle() ?>
            </h4>
            <!-- end .title-->
          </div><span class="link-group__subtitle"><?= htmlspecialchars_decode($arSection["DESCRIPTION"]) ?></span>
          <? if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '/gazeta/cases/'): ?>
            <ul class="link-group__list">
              <li class="link-group__item">
                <div class="link-group__wrapper">
                  <a class="link-item link-item_status_active" href="#"><span class="link-item__label">Все индустрии</span></a>
                </div>
              </li>
              <li class="link-group__item">
                <div class="link-group__wrapper">
                  <a class="link-item link-item_style_transparent" href="#"><span class="link-item__label">Торговля</span></a>
                </div>
              </li>
              <li class="link-group__item">
                <div class="link-group__wrapper">
                  <a class="link-item link-item_style_transparent" href="#"><span class="link-item__label">Услуги</span></a>
                </div>
              </li>
              <li class="link-group__item">
                <div class="link-group__wrapper">
                  <a class="link-item link-item_style_transparent" href="#"><span class="link-item__label">Маркетплейсы</span></a>
                </div>
              </li>
              <li class="link-group__item">
                <div class="link-group__wrapper">
                  <a class="link-item link-item_style_transparent" href="#"><span class="link-item__label">Реклама</span></a>
                </div>
              </li>
              <li class="link-group__item">
                <div class="link-group__wrapper">
                  <a class="link-item link-item_style_transparent" href="#"><span class="link-item__label">Стоматология</span></a>
                </div>
              </li>
              <li class="link-group__item">
                <div class="link-group__wrapper">
                  <a class="link-item link-item_style_transparent" href="#"><span class="link-item__label">Строительство</span></a>
                </div>
              </li>
              <li class="link-group__item">
                <div class="link-group__wrapper">
                  <a class="link-item link-item_style_transparent" href="#"><span class="link-item__label">IT</span></a>
                </div>
              </li>
              <li class="link-group__item">
                <div class="link-group__wrapper">
                  <a class="link-item link-item_style_transparent" href="#"><span class="link-item__label">Производство</span></a>
                </div>
              </li>
              <li class="link-group__item">
                <div class="link-group__wrapper">
                  <a class="link-item link-item_style_transparent" href="#"><span class="link-item__label">Образование</span></a>
                </div>
              </li>
              <li class="link-group__item">
                <div class="link-group__wrapper">
                  <a class="link-item link-item_style_transparent" href="#"><span class="link-item__label">Медицина</span></a>
                </div>
              </li>
              <li class="link-group__item">
                <div class="link-group__wrapper">
                  <a class="link-item link-item_style_transparent" href="#"><span class="link-item__label">Транспорт</span></a>
                </div>
              </li>
            </ul>
          <? endif; ?>
        </div>
        <!-- end .link-group-->
      </div>
    </div>
    <div class="section__content">
      <div class="section__cards-panel">
        <!-- no modifiers - panels take all available width, divinging equally up to three in one row-->
        <!-- promo-group_layout_l - one panel per row-->
        <!-- promo-group_layout_m - two panels per row-->
        <!-- promo-group_layout_s - three panels per row-->
        <!-- promo-group_layout_mixed - three panels every odd row, two panels every even row-->
        <!-- begin .cards-panel-->
        <?
        $GLOBALS["PAGEN_LM_DEFAULT_COUNT_1"] = !empty($arParams["NEWS_COUNT"]) ? intval($arParams["NEWS_COUNT"]) : 20;
        $newsDefaultCount = $GLOBALS["PAGEN_LM_DEFAULT_COUNT_1"];
        if ($request->isAjaxRequest() && !empty($request->get("PAGEN_LM_1"))) {
          $newsDefaultCount *= intval($request->get("PAGEN_LM_1"));
        }
        $APPLICATION->IncludeComponent(
          "bitrix:news.list",
          "gazeta_section",
          array(
            "IBLOCK_TYPE" => "newspaper",
            "IBLOCK_ID" => "4",
            "PARENT_SECTION" => intval($arResult["VARIABLES"]["SECTION_ID"]),
            "NEWS_COUNT" => $newsDefaultCount,
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "TIMESTAMP_X",
            "SORT_ORDER2" => "DESC",
            "FILTER_NAME" => "",
            "FIELD_CODE" => array(
              "NAME",
              "PREVIEW_PICTURE",
              "PREVIEW_TEXT",
            ),
            "PROPERTY_CODE" => array(
              "FORMAT",
              "FAVORITE_IMAGE",
              "POST_IMG",
            ),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "AJAX_MODE" => "Y",
            "AJAX_OPTION_SHADOW" => "Y",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "ACTIVE_DATE_FORMAT" => "M j, Y",
            "DISPLAY_PANEL" => "N",
            "SET_TITLE" => "N",
            "SET_STATUS_404" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "News",
            "PAGER_SHOW_ALWAYS" => "N",
            //"PAGER_TEMPLATE" => "load_more",
            "PAGER_TEMPLATE" => "show_more",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
            "PAGER_SHOW_ALL" => "N",
            "AJAX_OPTION_ADDITIONAL" => ""
          ),
          false
        );
        ?>
        <!-- end .cards-panel-->
      </div>
    </div>
  </div>
  <!-- end .section-->
</div>
</div>
<div class="page__section">
  <div class="page__holder page__holder_mobile-gutter_s">
    <!-- begin .section-->
    <?
    $GLOBALS["excursionBannersFilter"] = [
      "PROPERTY_TYPE_VALUE" => "Баннер-панель с заливкой"
    ];
    $APPLICATION->IncludeComponent(
      "bitrix:news.list",
      "excursion_banners",
      array(
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => "27",
        "NEWS_COUNT" => "10",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ID",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "excursionBannersFilter",
        "FIELD_CODE" => array(),
        "PROPERTY_CODE" => array(
          0 => "TYPE",
        ),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_SHADOW" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "ACTIVE_DATE_FORMAT" => "M j, Y",
        "DISPLAY_PANEL" => "N",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "News",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
        "PAGER_SHOW_ALL" => "N",
        "AJAX_OPTION_ADDITIONAL" => ""
      ),
      false
    );
    ?>
    <!-- end .section-->
  </div>
</div>
<div class="page__section">
  <div class="page__holder">
    <!-- begin .section-->
    <div class="section section_space_close">
      <div class="section__content">
        <!-- begin .subscribe-panel-->
        <div class="subscribe-panel">
          <? $APPLICATION->IncludeFile(
            SITE_TEMPLATE_PATH . "/include/form/subscribe.php",
            array(),
            array("MODE" => "html", "NAME" => "SUBSCRIBE")
          ); ?>
          <? $APPLICATION->IncludeFile(
            SITE_TEMPLATE_PATH . "/include/gazeta/telegram.php",
            array(),
            array("MODE" => "html", "NAME" => "TELEGRAM")
          ); ?>
        </div>
        <!-- end .subscribe-panel-->
      </div>
    </div>
    <!-- end .section-->
  </div>
</div>
<div class="page__section">
  <div class="page__holder">
    <div class="section section_space_top-close"></div>
    <!-- begin .section-->
    <?
    $GLOBALS["freeServices"] = [
      "PROPERTY_CATEGORY_VALUE" => "Бесплатно"
    ];
    $APPLICATION->IncludeComponent(
      "bitrix:news.list",
      "free_services_gazeta",
      array(
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => "12",
        "NEWS_COUNT" => "4",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ID",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "freeServices",
        "FIELD_CODE" => array(
          "NAME",
          "PREVIEW_PICTURE",
        ),
        "PROPERTY_CODE" => array(
          "ICON",
          "LINK",
        ),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_SHADOW" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "ACTIVE_DATE_FORMAT" => "M j, Y",
        "DISPLAY_PANEL" => "N",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "News",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
        "PAGER_SHOW_ALL" => "N",
        "AJAX_OPTION_ADDITIONAL" => ""
      ),
      false
    );
    ?>
    <!-- end .section-->
  </div>
</div>
<div class="page__section page__section_decoration_bottom">
  <!-- begin .section-->
  <div class="section section_space_close">
    <div class="section__content">
      <div class="section__following">
        <!-- begin .following-->
        <div class="following">
          <div class="following__container swiper js-following-carousel">
            <div class="following__wrapper swiper-wrapper">
              <? $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . "/include/text_carousel/gazeta.php",
                array(),
                array("MODE" => "html", "NAME" => "TEXT_CAROUSEL")
              ); ?>
            </div>
          </div>
        </div>
        <!-- end .following-->
      </div>
    </div>
  </div>
  <!-- end .section-->
</div>