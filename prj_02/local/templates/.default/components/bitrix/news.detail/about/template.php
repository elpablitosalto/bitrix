<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

?>
<div class="page-content about-page">
  <section class="about-first">
    <div class="container">
      <div class="section__content">
        <div class="text-size-lg">
          <?= $arResult["DISPLAY_PROPERTIES"]["BLOCK_FIRST"]['~VALUE']["TEXT"] ?>

        </div>
        <div class="section__nav">
          <div class="buttons-line"><a href="/about/team/" class="btn">Команда фонда
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                <use xlink:href="#arrow"></use>
              </svg></a><a href="<?= $arResult["DISPLAY_PROPERTIES"]["VIDEO_LINK"]['VALUE'] ?>" data-fancybox class="btn-play-video">Смотреть видео о фонде
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-triangle">
                <use xlink:href="#triangle"></use>
              </svg></a></div>
        </div>
      </div>
    </div>
    <!--+lazy-image({src: 'images/about-first.png', class: 'about-first__pattern'})-->
    <div class="about-first__pattern animate-svg-image">
      <svg width="1026" height="490" id="about-first" viewBox="0 0 1026 490" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="about-first__ground" d="M1025.07 261.14C913.889 210.185 751.694 187.963 575.175 207.806C385.672 229.108 113.439 352.541 18.2588 434.892M960.175 236.46C725.581 163.13 385.978 377.038 290.798 459.389" stroke="#FF5400" stroke-width="15" />
        <path class="about-first__trees" d="M430.869 356.207L428.2 339.103M428.2 339.103C399.709 321.882 402.723 299.527 422.146 275.87C443.047 295.613 452.33 315.505 428.2 339.103Z" stroke="#FF5400" stroke-width="15" />
        <path class="about-first__home" fill-rule="evenodd" clip-rule="evenodd" d="M806.981 9.84071V2.34071L799.481 2.34071L762.682 2.34071L755.182 2.34071V9.84071V30.8799L722.742 4.06042L717.964 0.109375L713.185 4.06042L593.227 103.237L602.784 114.798L619.4 101.061L619.4 203.502L634.4 203.502L634.4 88.6593L717.964 19.572L757.903 52.5923L794.702 83.0166L801.155 88.3512V95.7633L801.155 128.08V201.662L816.155 201.662L816.155 128.08L816.155 100.753L833.143 114.798L842.701 103.237L806.981 73.7057V9.84071ZM791.981 61.3042L770.182 43.2814V17.3407H791.981V61.3042ZM755.57 108.445V100.945H748.07H687.485H679.985L679.985 108.445L679.985 199.833H694.985V115.945H740.57V199.833L755.57 199.833L755.57 108.445ZM478.201 115.212L472.46 110.913L467.909 116.456C455.427 131.66 447.067 147.75 447.637 163.785C448.194 179.468 457.151 193.038 474.081 204.178L475.6 221.732L490.544 220.439L489.002 202.619C503.402 187.422 508.725 171.31 506.04 155.685C503.276 139.603 492.31 125.779 478.201 115.212ZM491.256 158.225C492.865 167.587 490.357 178.405 480.096 190.13C467.541 181.247 462.941 172.097 462.627 163.253C462.305 154.182 466.379 143.677 474.921 131.895C483.98 140.033 489.686 149.088 491.256 158.225Z" fill="#FF5400" />
      </svg>
    </div>
  </section>


  <section class="about-digits">
    <div class="container">
      <div class="items-list">
        <div class="row">
          <? foreach ($arResult["DISPLAY_PROPERTIES"]["MAIN_DIGITS"]["VALUE"] as $key => $value) { ?>
            <div class="col-sm-6 col-lg-4">
              <div class="list-item main-digits-item">
                <div class="h2 main-digits-item__title"><?= $value ?></div>
                <div class="text-size-lg main-digits-item__text"><?= $arResult["DISPLAY_PROPERTIES"]["MAIN_DIGITS"]['~DESCRIPTION'][$key] ?></div>
              </div>
            </div>
          <? } ?>
        </div>
      </div>
    </div>
  </section>




  <section class="about-what-we-do">
    <div class="container">
      <h3 class="section__title"><?= $arResult["DISPLAY_PROPERTIES"]["WHAT_WE_DO_TITLE"]["VALUE"] ?></h3>
      <div class="section__content">
        <div class="row">
          <div class="col-lg-6">
            <div class="h4 section__desc">
              <p><?= $arResult["DISPLAY_PROPERTIES"]["WHAT_WE_DO_BLOCK1"]["VALUE"] ?></p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="text-size-lg">
              <?= $arResult["DISPLAY_PROPERTIES"]["WHAT_WE_DO_BLOCK2"]['~VALUE']["TEXT"] ?>
              <br>
              <p class="text-color-gray"><?= $arResult["DISPLAY_PROPERTIES"]["WHAT_WE_DO_BLOCK3"]["VALUE"] ?></p>
              <?= $arResult["DISPLAY_PROPERTIES"]["WHAT_WE_DO_BLOCK4"]['~VALUE']["TEXT"] ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <section class="about-history">
    <div class="container">
      <div class="about-history-slider">
        <div class="section__head">
          <h3 class="section__title">История фонда</h3>
          <div class="section__nav">
            <div class="swiper-nav lg">
              <button type="button" class="swiper-button prev">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
                  <use xlink:href="#drop-light"></use>
                </svg>
              </button>
              <button type="button" class="swiper-button next">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
                  <use xlink:href="#drop-light"></use>
                </svg>
              </button>
            </div>
          </div>
        </div>
        <div class="swiper-container">
          <div class="swiper-wrapper align-items-height">

            <? foreach ($arResult["DISPLAY_PROPERTIES"]["HISTORY"]["VALUE"] as $key => $value) { ?>

              <div class="swiper-slide">
                <div class="about-history-item">
                  <div class="h1 about-history-item__year"><span><?= $value ?></span></div>
                  <div class="h5 about-history-item__text"><?= $arResult["DISPLAY_PROPERTIES"]["HISTORY"]['~DESCRIPTION'][$key] ?></div>
                </div>
              </div>
            <? } ?>

          </div>
        </div>
        <picture class="about-history-slider__pattern">
          <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/history-slider-pattern.png" loading="lazy" alt="Дорога к дому" title="Дорога к дому" />
        </picture>
      </div>
    </div>
  </section>

  <section class="volunteerism-gallery">
    <div class="container">
      <div class="section__content">
        <div class="items-list">
          <div class="row">
            <div class="col-6">
              <div class="volunteerism-gallery__left">
                <div class="row">
                  <div class="col-6 align-self-end"><a href="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTO1"]["FILE_VALUE"]["SRC"] ?>" data-fancybox="volunteerism-gallery" class="list-item volunteerism-gallery-item">
                      <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTO1"]["FILE_VALUE"]["SRC"] ?>" loading="lazy" alt="" title="" />
                      </picture>
                    </a></div>
                  <div class="col-6"><a href="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTO2"]["FILE_VALUE"]["SRC"] ?>" data-fancybox="volunteerism-gallery" class="list-item volunteerism-gallery-item">
                      <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTO2"]["FILE_VALUE"]["SRC"] ?>" loading="lazy" alt="" title="" />
                      </picture>
                    </a></div>
                  <div class="col-12"><a href="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTO3"]["FILE_VALUE"]["SRC"] ?>" data-fancybox="volunteerism-gallery" class="list-item volunteerism-gallery-item">
                      <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTO3"]["FILE_VALUE"]["SRC"] ?>" loading="lazy" alt="" title="" />
                      </picture>
                    </a></div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="volunteerism-gallery__right">
                <div class="row">
                  <div class="col-12"><a href="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTO4"]["FILE_VALUE"]["SRC"] ?>" data-fancybox="volunteerism-gallery" class="list-item volunteerism-gallery-item">
                      <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTO4"]["FILE_VALUE"]["SRC"] ?>" loading="lazy" alt="" title="" />
                      </picture>
                    </a></div>
                  <div class="col-9 col-lg-7"><a href="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTO5"]["FILE_VALUE"]["SRC"] ?>" data-fancybox="volunteerism-gallery" class="list-item volunteerism-gallery-item">
                      <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arResult["DISPLAY_PROPERTIES"]["PHOTO5"]["FILE_VALUE"]["SRC"] ?>" loading="lazy" alt="" title="" />
                      </picture>
                    </a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <picture class="volunteerism-gallery__pattern"><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/volunteerism-gallery-pattern.svg" loading="lazy" alt="Дорога к дому" title="Дорога к дому" />
        </picture>
      </div>
    </div>
  </section>




  <section class="about-open">
    <div class="container">
      <div class="section__content">
        <div class="row">
          <div class="col-sm-6">
            <div class="section__head-block">
              <h3 class="section__title">Открытость</h3>
              <picture class="about-open__pattern mobile-hidden"><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/about-open-pattern.png" loading="lazy" alt="" title="" />
              </picture>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="section__desc">
              <p class="text-size-lg"><?= $arResult["DISPLAY_PROPERTIES"]["OPEN_TEXT"]["VALUE"] ?></p><br>
              <picture class="about-open__pattern mobile-visible"><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/about-open-pattern.png" loading="lazy" alt="" title="" />
              </picture>
              <ul class="h5 about-open-list">


                <? foreach ($arResult["DISPLAY_PROPERTIES"]["OPEN_LINKS"]["VALUE"] as $key => $value) { ?>
                  <li><a href="<?= $value ?>" target="_blank">
                      <u><?= $arResult["DISPLAY_PROPERTIES"]["OPEN_LINKS"]['~DESCRIPTION'][$key] ?></u>
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                        <use xlink:href="#arrow"></use>
                      </svg></a></li>

                <? } ?>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="become-partner-partners">
    <div class="container">
      <div class="section__head-block">
        <div class="row">
          <div class="col-lg-6">
            <h2 class="h3 section__title">Наши партнёры</h2>
          </div>
          <div class="col-lg-6">
            <p class="text-size-lg section__desc"><?= $arResult["DISPLAY_PROPERTIES"]["PARTNERS_TEXT"]["VALUE"] ?></p>
            <div class="section__nav"><a href="/how_to_help/partnership/" class="btn">Стать партнёром</a></div>
          </div>
        </div>
      </div>



      <div class="main-partners__logos-block">
        <div class="row align-items-height">


          <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "partnership_partner",
            array(
              "DISPLAY_DATE" => "Y",
              "DISPLAY_NAME" => "Y",
              "DISPLAY_PICTURE" => "Y",
              "DISPLAY_PREVIEW_TEXT" => "Y",
              "AJAX_MODE" => "N",
              "IBLOCK_TYPE" => "content",
              "IBLOCK_ID" => Indexis::getIblockId("partners", "content", "s1"),
              "NEWS_COUNT" => "20",
              "SORT_BY1" => "SORT",
              "SORT_ORDER1" => "ASC",
              "SORT_BY2" => "ACTIVE_FROM",
              "SORT_ORDER2" => "DESC",
              "FILTER_NAME" => "partnersFilter",
              "FIELD_CODE" => array("PREVIEW_PICTURE"),
              "PROPERTY_CODE" => array("LINK"),
              "CHECK_DATES" => "Y",
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
              "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
              "PARENT_SECTION" => "",
              "PARENT_SECTION_CODE" => "",
              "INCLUDE_SUBSECTIONS" => "Y",
              "CACHE_TYPE" => "A",
              "CACHE_TIME" => "360000",
              "CACHE_FILTER" => "Y",
              "CACHE_GROUPS" => "Y",
              "DISPLAY_TOP_PAGER" => "N",
              "DISPLAY_BOTTOM_PAGER" => "N",
              "PAGER_TITLE" => "Новости",
              "PAGER_SHOW_ALWAYS" => "N",
              "PAGER_TEMPLATE" => "",
              "PAGER_DESC_NUMBERING" => "Y",
              "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
              "PAGER_SHOW_ALL" => "N",
              "PAGER_BASE_LINK_ENABLE" => "Y",
              "SET_STATUS_404" => "N",
              "SHOW_404" => "N",
              "MESSAGE_404" => "",
              "PAGER_BASE_LINK" => "",
              "PAGER_PARAMS_NAME" => "",
              "AJAX_OPTION_JUMP" => "N",
              "AJAX_OPTION_STYLE" => "Y",
              "AJAX_OPTION_HISTORY" => "N",
              "AJAX_OPTION_ADDITIONAL" => "",
            )
          ); ?>

        </div>
      </div>
    </div>


    <? $APPLICATION->IncludeComponent(
      "bitrix:news.list",
      "partnership_partner_reviews",
      array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => Indexis::getIblockId("partners_reviews", "content", "s1"),
        "NEWS_COUNT" => "20",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ACTIVE_FROM",
        "SORT_ORDER2" => "DESC",
        "FILTER_NAME" => "partnersFilter",
        "FIELD_CODE" => array("PREVIEW_PICTURE"),
        "PROPERTY_CODE" => array("POSTION"),
        "CHECK_DATES" => "Y",
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
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "360000",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "Y",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
      )
    ); ?>



  </section>

</div>