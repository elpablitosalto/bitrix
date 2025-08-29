<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?php if(!empty($arResult['SECTIONS'])): ?>
    <div id="productLinesSlider" <?if(count($arResult['SECTIONS']) > 1):?>data-full-page-slider<?endif;?> class="product-lines-slider swiper-container">
        <div class="swiper-wrapper">
        <?
            foreach($arResult['SECTIONS'] as $k => $arSection):
                $pic = CFile::ResizeImageGet($arSection['DETAIL_PICTURE'], array('width'=>999999, 'height'=>360), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        ?>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="col-lg-6 h-center">
                            <div class="product-lines-slider__image-container">
                                <img src="<?=$pic['src']?>" loading="lazy" alt="" title="" />
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <h3><?=$arSection['NAME']?></h3>
                            <?=$arSection['~UF_SLIDER_TEXT']?>
                            <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="button _small">Подробнее</a>
                        </div>
                    </div>
                </div>
            <?endforeach;?>
        </div>
        <?if(count($arResult['SECTIONS']) > 1):?>
            <div class="container navigation">
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        <?endif;?>
    </div>
<?php endif; ?>