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
if(!empty($arResult['DISPLAY_PROPERTIES']['POST_IMG']['FILE_VALUE']['SRC'])){
  $pathToImage = "https://{$siteName}{$arResult['DISPLAY_PROPERTIES']['POST_IMG']['FILE_VALUE']['SRC']}";
};
$datailUrl = '';
if(!empty($arResult['DETAIL_PAGE_URL'])){
  $datailUrl = $arResult['DETAIL_PAGE_URL'];
};
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
        </div>
    </div>
</div>

<div class="page__section page__section_no_overflow">
    <div class="page__holder">
        <div class="article article_type_news page__article">
            <div class="article__card">
                <!-- begin .article-card-->
                <div class="article-card article-card_type_news">
                    <div class="article-card__main">
                        <div class="article-card__meta">
                          <div class="article-card__date">
                              <!-- begin .date-->
                              <div class="date date_size_s date_style_grey"><?=$obNewsDate->format("d.m.Y")?></div>
                              <!-- end .date-->
                          </div>
                        </div>
                        <h1 class="article-card__title"><?=$arResult["NAME"]?></h1>
                        <?if(!empty($arResult["PREVIEW_TEXT"])):?>
                            <span class="article-card__text"><?=$arResult["PREVIEW_TEXT"]?></span>
                        <?endif;?>
                    </div>
                    <?if(!empty($arResult["PREVIEW_PICTURE"]["SRC"])):?>
                        <div class="article-card__aside">
                            <!--  article-card__illustration_style_gradient -->
                            <div class="article-card__illustration article-card__illustration_state_placeholder">
                                <img class="article-card__image" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>"/>
                            </div>
                        </div>
                    <?endif;?>
                </div>
                <!-- end .article-card-->
            </div>
            <div class="article__content">
                <div class="article__main plain-text js-forced-blank-links">

                <?foreach($arResult["TEXT_ARRAY"] as $textGroup):?>
                    <?if($textGroup === "VIDEO"):?>
                        <?if(!empty($arResult["PROPERTIES"]["VIDEO_YOUTUBE_LINK"]["VALUE"])):?>
                            <div class="article__section article__section_width_full">
                                <div class="video js-video-scope">
                                    <?
                                        $videoSrc = $arResult["PROPERTIES"]["VIDEO_YOUTUBE_LINK"]["VALUE"];
                                        $videoSrcFormatted;
                                        $codeQuery = '/(watch\?v=|youtu\.be\/|embed\/|live\/)(.+?)(\?|\&|$)/';

                                        preg_match($codeQuery, $videoSrc, $codeMatches);

                                        $videoSrcFormatted = !empty($codeMatches[2]) ? 'https://www.youtube.com/embed/'.$codeMatches[2].'?autoplay=1' : $videoSrc;

                                        if(!empty($arResult["PROPERTIES"]["VIDEO_IMAGE"]["VALUE"])) {
                                            $renderImage = CFile::ResizeImageGet(
                                                $arResult["PROPERTIES"]["VIDEO_IMAGE"]["VALUE"],
                                                Array("width" => 1920, "height" => 1080),
                                                BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
                                            );
                                        }
                                    ?>
                                    <div class="video__panel" <?if(!empty($renderImage["src"])):?>style="background-image: url(<?=$renderImage["src"]?>)"<?endif;?>>
                                        <button class="video__trigger js-video-trigger" type="button" aria-lable="Включить">
                                        <svg class="video__icon" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M39 28.2679C40.3333 29.0377 40.3333 30.9623 39 31.7321L27 38.6603C25.6667 39.4301 24 38.4678 24 36.9282L24 23.0718C24 21.5322 25.6667 20.5699 27 21.3397L39 28.2679Z"></path>
                                        </svg>
                                        </button>
                                        <iframe class="video__content js-video-content" data-src="<?=$videoSrcFormatted?>" frameborder="0" allow="autoplay; fullscreen">
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        <?endif;?>
                    <?elseif($textGroup === 'GALLERY'):?>
                        <?if(!empty($arResult["PROPERTIES"]["GALLERY"]["VALUE"])):?>
                            <div class="article__section article__section_width_full">
                                <div class="gallery gallery_style_shadowless gallery_state_uninitialized">
                                    <div class="gallery__container swiper js-gallery-carousel">
                                        <div class="gallery__arrows">
                                        <!-- begin .carousel-nav-->
                                        <div class="carousel-nav carousel-nav_position_sides js-carousel-nav" data-nav-scope=".gallery-carousel" data-nav-target=".swiper">
                                            <div class="carousel-nav__control">
                                            <!-- begin .button-->
                                            <button class="button button_role_navigation js-carousel-nav-prev" type="button"><span class="button__holder">
                                                <svg class="button__icon" width="10" height="17" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 1L1.33333 8.66667L9 16.3333" fill="transparent" stroke="currentColor"></path>
                                                </svg></span>
                                            </button>
                                            <!-- end .button-->
                                            </div>
                                            <div class="carousel-nav__control">
                                            <!-- begin .button-->
                                            <button class="button button_role_navigation js-carousel-nav-next" type="button"><span class="button__holder">
                                                <svg class="button__icon" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 16L11.6667 8.33333L4 0.666667" fill="transparent" stroke="currentColor"></path>
                                                </svg></span>
                                            </button>
                                            <!-- end .button-->
                                            </div>
                                        </div>
                                        <!-- end .carousel-nav-->
                                        </div>
                                        <div class="gallery__wrapper swiper-wrapper">
                                            <?foreach($arResult["PROPERTIES"]["GALLERY"]["VALUE"] as $imageId):?>
                                                <?
                                                    $preview = CFile::ResizeImageGet(
                                                        $imageId,
                                                        Array("width" =>260, "height" => 260),
                                                        BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
                                                    );
                                                    $detail = CFile::ResizeImageGet(
                                                        $imageId,
                                                        Array("width" => 1920, "height" => 1080),
                                                        BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
                                                    );
                                                ?>
                                                <div class="gallery__slide swiper-slide">
                                                    <a class="gallery__illustration gallery__illustration_style_border js-modal" href="<?= $detail["src"]?>" data-fancybox="gallery-<?=$arResult["ID"]?>">
                                                        <picture class="gallery__picture">
                                                            <img src="<?= $preview["src"]?>" alt="<?= $preview["alt"]?>" class="gallery__image">
                                                        </picture>
                                                    </a>
                                                </div>
                                            <?endforeach?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?endif;?>
                    <?else:?>
                        <div class="article__section"><?=htmlspecialchars_decode($textGroup)?></div>
                    <?endif;?>
                <?endforeach;?>

                <?
                    $primaryButtonDisplay = !empty($arResult["PROPERTIES"]["PRIMARY_BUTTON_DISPLAY"]["VALUE_XML_ID"]) ? $arResult["PROPERTIES"]["PRIMARY_BUTTON_DISPLAY"]["VALUE_XML_ID"] : "Y";
                    $primaryButtonText = !empty($arResult["PROPERTIES"]["PRIMARY_BUTTON_TEXT"]["VALUE"]) ? $arResult["PROPERTIES"]["PRIMARY_BUTTON_TEXT"]["VALUE"] : "Хочу работать с НФ";
                    $primaryButtonHref = !empty($arResult["PROPERTIES"]["PRIMARY_BUTTON_LINK"]["VALUE"]) ? $arResult["PROPERTIES"]["PRIMARY_BUTTON_LINK"]["VALUE"] : "";

                    $secondaryButtonDisplay = !empty($arResult["PROPERTIES"]["SECONDARY_BUTTON_DISPLAY"]["VALUE_XML_ID"]) ? $arResult["PROPERTIES"]["SECONDARY_BUTTON_DISPLAY"]["VALUE_XML_ID"] : "Y";
                    $secondaryButtonText = !empty($arResult["PROPERTIES"]["SECONDARY_BUTTON_TEXT"]["VALUE"]) ? $arResult["PROPERTIES"]["SECONDARY_BUTTON_TEXT"]["VALUE"] : "К другим новостям";
                    $secondaryButtonHref = !empty($arResult["PROPERTIES"]["SECONDARY_BUTTON_LINK"]["VALUE"]) ? $arResult["PROPERTIES"]["SECONDARY_BUTTON_LINK"]["VALUE"] : "/news";
                ?>

                <div class="article__footer">
                    <div class="article__controls">
                        <?if(!empty($primaryButtonHref) && $primaryButtonDisplay !== "N"):?>
                            <div class="article__control">
                                <!-- begin .button-->
                                <a class="button button_width_full" href="<?=$primaryButtonHref?>">
                                    <span class="button__holder">
                                        <span class="button__text"><?=$primaryButtonText?></span>
                                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 14.0835L11.9577 18.0423L20 10" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </a>
                                <!-- end .button-->
                            </div>
                        <?endif;?>
                        <?if($secondaryButtonDisplay !== "N"):?>
                            <div class="article__control">
                                <!-- begin .button-->
                                <a class="button button_width_full button_style_dark" href="<?=$secondaryButtonHref?>">
                                    <span class="button__holder">
                                        <span class="button__text"><?=$secondaryButtonText?></span>
                                    </span>
                                </a>
                                <!-- end .button-->
                            </div>
                        <?endif;?>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
