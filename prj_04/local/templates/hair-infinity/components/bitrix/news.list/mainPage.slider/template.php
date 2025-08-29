<?

use Hair\General;
?>
<div class="image-carousel">
    <div class="image-carousel__container swiper js-image-carousel">
        <div class="image-carousel__wrapper swiper-wrapper">
            <? foreach ($arResult['ITEMS'] as $k => $arItem) : ?>
                <div class="image-carousel__slide swiper-slide">
                    <? if (!empty($arItem['PROPERTIES']['LINK']['VALUE'])) : ?><a href="<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>"><? endif ?>
                        <? if (!empty($arItem['PROPERTIES']['VIDEO_FILE']['VALUE'])) : ?>
                            <? $arFile = CFIle::GetFileArray($arItem['PROPERTIES']['VIDEO_FILE']['VALUE']); ?>
                            <video autoplay loop muted width="100%" height="100%" id="main-page-slide-<?= $k ?>">
                                <source src="<?= $arFile['SRC'] ?>" type="<?= $arFile['CONTENT_TYPE'] ?>"><!-- MP4 длѝ Safari, IE9, iPhone, iPad, Android, и Windows Phone 7 -->
                            </video>
                        <? elseif (!empty($arItem['PROPERTIES']['VIDEO_URL']['VALUE'])) : ?>
                            <?
                            $url = General::ParseShortYouTubeLink($arItem['PROPERTIES']['VIDEO_URL']['VALUE']);
                            $duration = General::GetYouTubeVideoDuration($url);
                            ?>
                            <iframe width="100%" height="100%" src="<?= $url . '?mute=1&showinfo=0&controls=0' ?>" data-duration="<?= $duration ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <?
                        else :
                            $desktopImg = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'], array('width' => 1920, 'height' => 464), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                            $mobileImgSource = $arItem['PREVIEW_PICTURE'];
                            if (empty($mobileImgSource)) {
                                $mobileImgSource = $arItem['DETAIL_PICTURE'];
                            }
                            $mobileImg = CFile::ResizeImageGet($mobileImgSource, array('width' => 768, 'height' => 190), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        ?>
                            <div class="image-carousel__illustration">
                                <picture>
                                    <source srcset="<?= $mobileImg['src'] ?>" type="image/jpeg" media="(max-width: 767px)" />
                                    <img src="<?= $desktopImg['src'] ?>" alt="<?= $arItem["NAME"] ?>" class="image-carousel__image" title="" />
                                </picture>
                            </div>
                        <? endif; ?>
                        <? if (!empty($arItem['PROPERTIES']['LINK']['VALUE'])) : ?>
                        </a><? endif ?>
                </div>
            <? endforeach; ?>
        </div>
        <div class="image-carousel__navigation">
            <div class="page__container">
                <div class="image-carousel__arrows">
                    <!-- begin .carousel-nav-->
                    <div class="carousel-nav carousel-nav_position_sides js-carousel-nav" data-nav-scope=".image-carousel" data-nav-target=".swiper">
                        <div class="carousel-nav__control">
                            <button type="button" class="carousel-nav__arrow carousel-nav__arrow_type_prev js-carousel-nav-prev">
                                <span class="carousel-nav__arrow-label">Предыдущий слайд</span>
                            </button>
                        </div>
                        <div class="carousel-nav__control">
                            <button type="button" class="carousel-nav__arrow carousel-nav__arrow_type_next js-carousel-nav-next">
                                <span class="carousel-nav__arrow-label">Следующий слайд</span>
                            </button>
                        </div>
                    </div>
                    <!-- end .carousel-nav-->
                </div>
            </div>
        </div>
    </div>
</div>