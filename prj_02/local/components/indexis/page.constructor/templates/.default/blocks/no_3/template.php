<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
//$arImages = $item['DISPLAY_PROPERTIES']['NO_3_IMAGES']['VALUE'];
$arImages = $item['DISPLAY_PROPERTIES']['NO_3_IMAGES']['FILE_VALUE'];
if( intval( $arImages["ID"] ) > 0 )
{
    $arImages = array( $arImages ); 
}
//vardump($arImages);
//echo "count = " . count($arImages) . "<br/>";
if (!empty($arImages)) {
?>
    <div class="news-detail-gallery">
        <div class="news-detail-gallery__main-slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?
                    foreach ($arImages as $key => $val) {
                    ?>
                        <div class="swiper-slide">
                            <a href="<?= $val["SRC"]; ?>" data-fancybox="news-detail-gallery" class="news-detail-gallery__main-slider__item">
                                <picture>
                                    <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $val["SRC"]; ?>" loading="lazy" alt="" title="" />
                                </picture>
                            </a>
                        </div>
                    <?
                    }
                    ?>
                </div>
            </div>
            <? if (count($arImages) > 1) { ?>
            <div class="swiper-nav lg mobile-hidden">
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
            <? } ?>
        </div>
        <? if (count($arImages) > 1) { ?>
        <div class="news-detail-gallery__nav-slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?
                    foreach ($arImages as $key => $val) {
                    ?>
                        <div class="swiper-slide">
                            <div class="news-detail-gallery__nav-slider__item">
                                <picture>
                                    <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $val["SRC"]; ?>" loading="lazy" alt="" title="" />
                                </picture>
                            </div>
                        </div>
                    <?
                    }
                    ?>
                </div>
            </div>
        </div>
        <? } ?>
    </div>
<?
}
?>