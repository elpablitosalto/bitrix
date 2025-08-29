<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Type\DateTime;

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$obNewsDate = !empty($arResult["ACTIVE_FROM"]) ? (new DateTime($arResult["ACTIVE_FROM"], 'd.m.Y H:i:s')) : (new DateTime($arResult["DATE_CREATE"], 'd.m.Y H:i:s'));
?>

<?
$pathToImage = '';
$arAuthors = array();
$siteName = SITE_SERVER_NAME;
$ogImageContent = '';

if(!empty($arResult['DISPLAY_PROPERTIES']['POST_IMG']['FILE_VALUE']['SRC'])){
    $pathToImage = "https://{$siteName}{$arResult['DISPLAY_PROPERTIES']['POST_IMG']['FILE_VALUE']['SRC']}";
    $arFile = $arResult['DISPLAY_PROPERTIES']['POST_IMG']['FILE_VALUE'];

    $resizeImage = CFile::ResizeImageGet(
        $arFile,
        Array("width" => 1024, "height" => 1024),
        BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
    );

    if(!empty($resizeImage['src'])) {
        ob_start();
        ?>
        <meta property="og:image" content="//<?=$_SERVER["SERVER_NAME"].$resizeImage['src']?>" />
        <meta property="og:image:secure_url" content="<?=(CMain::IsHTTPS()) ? "https://" : "http://"?><?=$_SERVER["SERVER_NAME"].$resizeImage['src']?>" />
        <meta property="og:image:type" content="<?=$arFile['CONTENT_TYPE']?>" />
        <meta property="og:image:width" content="<?=$resizeImage['width']?>" />
        <meta property="og:image:height" content="<?=$resizeImage['height']?>" />
        <?
        $ogImageContent = ob_get_contents();
        ob_end_clean();
    }
};
$datailUrl = '';
if(!empty($arResult['DETAIL_PAGE_URL'])){
  $datailUrl = $arResult['DETAIL_PAGE_URL'];
};

$descripton = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_META_DESCRIPTION']) ? $arResult['IPROPERTY_VALUES']['ELEMENT_META_DESCRIPTION'] : null;
$descripton = empty($descripton) ? TruncateText($arResult['DETAIL_TEXT'], 200) : $descripton;

ob_start();
?>
    <meta property="og:title" content="<?=(!empty($arResult['NAME']) ? $arResult['NAME'] : $APPLICATION->GetTitle())?>" />
    <meta property="og:description" content="<?=htmlspecialchars($descripton)?>" />
<?
$ogTextContent = ob_get_contents();
ob_end_clean();

$APPLICATION->AddViewContent('og', $ogImageContent . $ogTextContent);
?>

<?foreach ($arResult["AUTHORS"] as $arAuthor):?>
  <?$arAuthors[] = array(
    "@type" => "Person",
    "name" => $arAuthor["NAME"]
  );?>
<?endforeach?>

<script type='application/ld+json'>
<?
$arr = array(
  "@context" => "https://schema.org",
  "@type" => "Article",
  "headline" => !empty($arResult['NAME']) ? $arResult['NAME'] : null,
  "datePublished" => !empty($arResult['DATE_CREATE']) ? $arResult['DATE_CREATE'] : null,
  "dateModified" => !empty($arResult['DATE_CREATE']) ? $arResult['DATE_CREATE'] : null,
  "image" => $pathToImage,
  "keywords" => !empty($arResult['IPROPERTY_VALUES']['ELEMENT_META_KEYWORDS'] ) ? $arResult['IPROPERTY_VALUES']['ELEMENT_META_KEYWORDS']  : null,
  "description" => !empty($arResult['IPROPERTY_VALUES']['ELEMENT_META_DESCRIPTION']) ? $arResult['IPROPERTY_VALUES']['ELEMENT_META_DESCRIPTION'] : null,
  "articleSection" => !empty($arResult['SECTION']['PATH'][0]['NAME']) ? $arResult['SECTION']['PATH'][0]['NAME'] : null,
  "author" => $arAuthors,
  "mainEntityOfPage" => "https://{$siteName}{$datailUrl}",
  "publisher" =>
    [
      "@type" => "Organization",
      "name" => "Нескучные финансы",
    ],
);

echo json_encode($arr, JSON_UNESCAPED_UNICODE);
?>

</script>
<div class="page__content-top">
    <div class="page__holder">
        <div class="page__top-wrapper">
            <div class="page__breadcrumbs">
                <!-- begin .breadcrumbs-->
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main",
                    Array(
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
        <!-- begin .article-->
        <div class="article page__article">
            <div class="article__card">
                <!-- begin .article-card-->
                <div class="article-card">
                    <div class="article-card__main">
                        <div class="article-card__meta">
                            <div class="article-card__date">
                                <!-- begin .date-->
                                <div class="date date_size_s date_style_grey">
                                    <?=$obNewsDate->format("d.m.Y")?>
                                </div>
                                <!-- end .date-->
                            </div>
                            <div class="article-card__controls">
                                <?if(!empty($arResult["SECTION"]["PATH"][0]["NAME"])):?>
                                    <div class="article-card__control">
                                        <!-- begin .button-->
                                        <a class="button button_size_label button_style_dashed" href="<?=$arResult["SECTION"]["PATH"][0]["SECTION_PAGE_URL"]?>">
                                            <span class="button__holder">
                                                <span class="button__text"><?=$arResult["SECTION"]["PATH"][0]["NAME"]?></span>
                                            </span>
                                        </a>
                                        <!-- end .button-->
                                    </div>
                                <?endif;?>
                                <div class="article-card__control">
                                    <!-- begin .button-->
                                    <a class="button button_size_label button_style_dashed" href="/gazeta">
                                        <span class="button__holder">
                                            <span class="button__text">Все статьи</span>
                                        </span>
                                    </a>
                                    <!-- end .button-->
                                </div>
                            </div>
                        </div>
                        <h1 class="article-card__title">
                            <?=$arResult["NAME"]?>
                        </h1>
                        <div class="article-card__entities">
                            <?if(!empty($arResult["AUTHORS"]) && is_array($arResult["AUTHORS"])):?>
                                <?foreach ($arResult["AUTHORS"] as $arAuthor):?>
                                    <div class="article-card__entity">
                                        <!-- begin .entity-->
                                        <div class="entity">
                                            <a href="/gazeta/authors/<?=$arAuthor["CODE"]?>" class="entity__illustration">
                                                <?if(!empty($arAuthor["DETAIL_PICTURE"])):?>
                                                    <picture class="entity__picture">
                                                        <?$renderImage = CFile::ResizeImageGet(
                                                            $arAuthor["DETAIL_PICTURE"],
                                                            Array("width" => 160, "height" => 158),
                                                            BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
                                                        );?>
                                                        <img
                                                            src="<?=$renderImage["src"] ?>"
                                                            alt="<?= $arAuthor["NAME"] ?>"
                                                            class="entity__image"
                                                        />
                                                    </picture>
                                                <?endif;?>
                                            </a>
                                            <div class="entity__main">
                                                <div class="entity__title">
                                                    <?if(!empty($arAuthor["CODE"])):?>
                                                        <a class="entity__link" href="/gazeta/authors/<?=$arAuthor["CODE"]?>"><?=$arAuthor["NAME"]?></a>
                                                    <?else:?>
                                                        <span class="entity__link"><?=$arAuthor["NAME"]?></span>
                                                    <?endif;?>
                                                </div>
                                                <div class="entity__text">
                                                    <?=htmlspecialchars_decode($arAuthor["PREVIEW_TEXT"])?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end .entity-->
                                    </div>
                                <?endforeach?>
                            <?endif;?>
                            <?if(!empty($arResult["EDITOR"])):?>
                                <div class="article-card__entity">
                                    <!-- begin .entity-->
                                    <div class="entity">
                                        <div class="entity__illustration entity__illustration_state_placeholder">
                                            <?if(!empty($arResult["EDITOR"]["DETAIL_PICTURE"])):?>
                                                <picture class="entity__picture">
                                                    <?$renderImage = CFile::ResizeImageGet(
                                                        $arResult["EDITOR"]["DETAIL_PICTURE"],
                                                        Array("width" => 160, "height" => 158),
                                                        BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
                                                    );?>
                                                    <img
                                                        src="<?=$renderImage["src"]?>"
                                                        alt="<?=$arAuthor["NAME"]?>"
                                                        class="entity__image"
                                                    />
                                                </picture>
                                            <?endif;?>
                                        </div>
                                        <div class="entity__main">
                                            <div class="entity__title">
                                                <!--TODO: ссылка на страницу-->
                                                <!-- <span class="entity__link"><?=$arResult["EDITOR"]["NAME"]?></span> -->
                                                <?=$arResult["EDITOR"]["NAME"]?>
                                            </div>
                                            <div class="entity__text">
                                                Редактор
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end .entity-->
                                </div>
                            <?endif;?>
                        </div>
                    </div>
                    <div class="article-card__aside">
                        <div class="article-card__illustration">
                            <?$picturePath = \CFile::GetPath($arResult["PROPERTIES"]["POST_IMG"]["VALUE"]);?>
                            <?if(!empty($picturePath)):?>
                                <picture class="article-card__picture">
                                    <img src="<?=$picturePath?>" alt="<?=$arResult["NAME"]?>" class="article-card__image"/>
                                </picture>
                            <?endif;?>
                        </div>
                        <div class="article-card__social-nav">
                            <!-- begin .social-nav-->
                            <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/gazeta/share_buttons.php",
                                Array(),
                                Array("MODE" => "html", "NAME" => "SHARE_BUTTONS")
                            ); ?>
                            <!-- end .social-nav-->
                        </div>
                        <div class="article-card__stats">
                            <!-- begin .stat-group-->
                            <ul class="stat-group">
                                <li class="stat-group__item">
                                    <!-- begin .stat-->
                                    <div class="stat">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.122 9.88C15.293 11.051 15.293 12.952 14.122 14.125C12.951 15.296 11.05 15.296 9.877 14.125C8.706 12.954 8.706 11.053 9.877 9.88C11.05 8.707 12.95 8.707 14.122 9.88Z" fill="transparent" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M3 12C3 11.341 3.152 10.689 3.446 10.088C4.961 6.991 8.309 5 12 5C15.691 5 19.039 6.991 20.554 10.088C20.848 10.689 21 11.341 21 12C21 12.659 20.848 13.311 20.554 13.912C19.039 17.009 15.691 19 12 19C8.309 19 4.961 17.009 3.446 13.912C3.152 13.311 3 12.659 3 12Z" fill="transparent" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <div class="stat__text">
                                            <?=(intval($arResult["PROPERTIES"]["VIEWS"]["VALUE"]) + intval($arResult["FIELDS"]["SHOW_COUNTER"]))?>
                                        </div>
                                    </div>
                                    <!-- end .stat-->
                                </li>
                            </ul>
                            <!-- end .stat-group-->
                        </div>
                    </div>
                </div>
                <!-- end .article-card-->
            </div>
            <div class="article__content">
                <div class="article__aside">
                    <!-- begin .section-nav-->
                    <div class="section-nav section-nav_state_hidden js-section-nav article__nav">
                        <?if(!empty($arResult["PROPERTIES"]["INDEX"]["VALUE"]) && is_array($arResult["PROPERTIES"]["INDEX"]["VALUE"])):?>
                        <ul class="section-nav__list">
                            <?foreach ($arResult["PROPERTIES"]["INDEX"]["VALUE"] as $indexValue => $indexName):?>
                                <li class="section-nav__item">
                                    <a class="section-nav__link js-section-nav-link" href="#<?=($indexValue + 1)?>"><?=$indexName?></a>
                                </li>
                            <?endforeach;?>
                        </ul>
                        <?endif;?>
                    </div>
                    <!-- end .section-nav-->
                </div>
                <div class="article__main plain-text js-forced-blank-links">
                    <?=htmlspecialchars_decode($arResult["DETAIL_TEXT"])?>
                </div>
                <div class="article__banners">
                    <?if(!empty($arResult["PROPERTIES"]["VERTICAL_BG"]["VALUE"])):?>
                        <?
                            $bannerPath = \CFile::GetPath($arResult["PROPERTIES"]["VERTICAL_BG"]["VALUE"]);
                            $bannerLink = !empty($arResult["PROPERTIES"]["BANNER_LINK"]["VALUE"]) ? $arResult["PROPERTIES"]["BANNER_LINK"]["VALUE"] : '';
                            $bannerTag = !empty($bannerLink) ? 'a' : 'div';
                        ?>
                        <<?=$bannerTag?> class="article__banner article__banner_state_placeholder" <?=(!empty($bannerLink) ? 'href="'.$bannerLink.'"' : '')?>>
                            <picture class="article__picture">
                                <img src="<?=$bannerPath?>" alt="Картинка" class="article__image"/>
                            </picture>
                        </<?=$bannerTag?>>
                    <?endif;?>
                </div>
            </div>
            <div class="article__interactive-banner">
              <?
                $GLOBALS["excursionBannersFilter"] = [
                    "PROPERTY_TYPE_VALUE" => "Баннер-панель с заливкой"
                ];
                $APPLICATION->IncludeComponent("bitrix:news.list", "excursion_banners-float", array(
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => "27",
                    "NEWS_COUNT" => "1",
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
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "SECTION_MODIF_CLASS" => ""
                ),
                    false
                );
                ?>
            </div>
            <div class="article__footer">
              <div class="article__hashtag-group">
                  <!-- begin .hashtag-group-->
                  <?if(!empty($arResult['TAGS'])):?>
                      <div class="hashtag-group">
                          <?
                          $arTagsHtml = [];
                          $arTags = array_map("trim", explode(',', $arResult['TAGS']));
                          foreach($arTags as $value)
                          {
                              $arTagsHtml[] = '<a class="hashtag-group__link" href="/search/?tags=' . str_replace(' ', '+', $value) . '">#' . $value . '</a>';
                          }
                          echo implode(PHP_EOL, $arTagsHtml);
                          ?>
                      </div>
                  <?endif;?>
                  <!-- end .hashtag-group-->
              </div>
              <div class="article__info">
                  <div class="article__date">
                      <!-- begin .date-->
                      <div class="date date_size_s date_style_grey">
                          <?=$obNewsDate->format("d.m.Y")?>
                      </div>
                      <!-- end .date-->
                  </div>
                  <div class="article__controls">
                      <?if(!empty($arResult["SECTION"]["PATH"][0]["NAME"])):?>
                          <div class="article-card__control">
                              <!-- begin .button-->
                              <a class="button button_size_label button_style_dashed" href="<?=$arResult["SECTION"]["PATH"][0]["SECTION_PAGE_URL"]?>">
                                  <span class="button__holder">
                                      <span class="button__text"><?=$arResult["SECTION"]["PATH"][0]["NAME"]?></span>
                                  </span>
                              </a>
                              <!-- end .button-->
                          </div>
                      <?endif;?>
                      <div class="article-card__control">
                          <!-- begin .button-->
                          <a class="button button_size_label button_style_dashed" href="/gazeta">
                              <span class="button__holder">
                                  <span class="button__text">все статьи</span>
                              </span>
                          </a>
                          <!-- end .button-->
                      </div>
                  </div>
                  <div class="article__social-nav">
                      <!-- begin .social-nav-->
                      <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/gazeta/share_buttons.php",
                          Array(),
                          Array("MODE" => "html", "NAME" => "SHARE_BUTTONS")
                      ); ?>
                      <!-- end .social-nav-->
                  </div>
              </div>
          </div>
        </div>
        <!-- end .article-->
    </div>
</div>
<div class="page__section">
    <div class="page__holder">
        <!-- begin .section-->
        <div class="section">
            <div class="section__content">
                <!-- begin .subscribe-panel-->
                <div class="subscribe-panel">
                    <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/form/subscribe.php",
                        Array(),
                        Array("MODE" => "html", "NAME" => "SUBSCRIBE")
                    ); ?>
                    <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/gazeta/telegram.php",
                        Array(),
                        Array("MODE" => "html", "NAME" => "TELEGRAM")
                    ); ?>
                <!-- end .subscribe-panel-->
            </div>
        </div>
        <!-- end .section-->
    </div>
</div>
<div class="page__section">
    <div class="page__holder">
        <!-- begin .section-->
        <?
        $GLOBALS["freeServices"] = [
            "PROPERTY_CATEGORY_VALUE" => "Бесплатно"
        ];
        $APPLICATION->IncludeComponent("bitrix:news.list", "free_services_gazeta", array(
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
                            <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/text_carousel/gazeta.php",
                                Array(),
                                Array("MODE" => "html", "NAME" => "TEXT_CAROUSEL")
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