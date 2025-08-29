<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Hair\General;
?>
<?php if(!empty($arResult['ITEMS'])): ?>
<h2>Рекомендуем прочитать</h2>
<div class="novelties">
	<?//Закоментил т.к. на странице лукбуков выводится, а там он не нужен?>
    <div class="container">
        <div class="abroad-slider-wrapper">
            <div id="noveltiesSlider" data-abroad-slider class="novelties-slider swiper-container">
                <div class="swiper-wrapper">
                    <?foreach($arResult['ITEMS'] as $k => $arItem):?>
                        <?$pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>9999, 'height'=>237), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="novelties-slider__slide swiper-slide">
                            <div class="novelties-slider__slide-image">
                                <img src="<?=$pic['src']?>" alt="" title="" />
                            </div>
                            <span class="novelties-slider__slide-subtext"><?=$arItem['NAME']?></span>

                        </a>
                    <?endforeach;?>
                </div>
                <? if(count($arResult['ITEMS'])>4):?>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <?endif;?>
            </div>
        </div>
    </div>
</div>
<?endif;?>