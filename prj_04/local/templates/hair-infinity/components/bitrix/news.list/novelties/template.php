<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Hair\General;
?>
<?php if(!empty($arResult['ITEMS'])): ?>
<section class="novelties">
	<?/*<div class="container">
        <h2>ПРОДУКТЫ ДЛЯ СЕМИНАРА</h2>
</div>*/?>
	<?//Закоментил т.к. на странице лукбуков выводится, а там он не нужен?>
    <div class="container">
        <div class="abroad-slider-wrapper">
            <div id="noveltiesSlider" data-abroad-slider <?/*?>data-lazy="Y"<?*/?> class="novelties-slider swiper-container">
                <div class="swiper-wrapper">
                    <?foreach($arResult['ITEMS'] as $k => $arItem):?>
                        <?$pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>9999, 'height'=>237), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="novelties-slider__slide swiper-slide">
                            <div class="novelties-slider__slide-image">
                                <img class="swiper-lazy_ js_lazy" data-src="<?=$pic['src']?>" width="<?=$pic['width']?>" height="<?=$pic['height']?>" alt="" title="" />
                            </div>
                            <p class="novelties-slider__slide-link"><?=$arItem['PREVIEW_TEXT']?></p>
                            <span class="novelties-slider__slide-subtext"><?=$arItem['NAME']?></span>
                            <div class="novelties-slider__slide-description">
                                <?if(isset($arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE'])):?>
                                    <div class="novelties-slider__slide-description__item">
                                        <div class="novelties-slider__slide-description__item-icon">
                                            <?=file_get_contents($_SERVER["DOCUMENT_ROOT"].General::getProductPropertycon('PRODUCT_TYPE'));?>
                                        </div>
                                        <div class="novelties-slider__slide-description__item-text">
                                            <p>Тип</p>
                                            <?if(is_array($arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE']['DISPLAY_VALUE'])):?>
                                                <?foreach($arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE']['DISPLAY_VALUE'] as $val):?>
                                                    <span><?=$val?></span>
                                                <?endforeach;?>
                                            <?else:?>
                                                <span><?=$arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE']['DISPLAY_VALUE']?></span>
                                            <?endif;?>
                                        </div>
                                    </div>
                                <?endif;?>
                                <?if(isset($arItem['DISPLAY_PROPERTIES']['PRODUCT_FEATURE'])):?>
                                    <div class="novelties-slider__slide-description__item">
                                        <div class="novelties-slider__slide-description__item-icon">
                                            <?=file_get_contents($_SERVER["DOCUMENT_ROOT"].General::getProductPropertycon('PRODUCT_FEATURE'));?>
                                        </div>
                                        <div class="novelties-slider__slide-description__item-text">
                                            <p>Особенность</p>
                                            <?if(is_array($arItem['DISPLAY_PROPERTIES']['PRODUCT_FEATURE']['DISPLAY_VALUE'])):?>
                                                <?foreach($arItem['DISPLAY_PROPERTIES']['PRODUCT_FEATURE']['DISPLAY_VALUE'] as $val):?>
                                                    <span><?=$val?></span>
                                                <?endforeach;?>
                                            <?else:?>
                                                <span><?=$arItem['DISPLAY_PROPERTIES']['PRODUCT_FEATURE']['DISPLAY_VALUE']?></span>
                                            <?endif;?>
                                        </div>
                                    </div>
                                <?endif;?>
                                <?if(isset($arItem['DISPLAY_PROPERTIES']['PRODUCT_PROPS'])):?>
                                    <div class="novelties-slider__slide-description__item">
                                        <div class="novelties-slider__slide-description__item-icon">
                                            <?=file_get_contents($_SERVER["DOCUMENT_ROOT"].General::getProductPropertycon('PRODUCT_PROPS'));?>
                                        </div>
                                        <div class="novelties-slider__slide-description__item-text">
                                            <p>Свойства</p>
                                            <?if(is_array($arItem['DISPLAY_PROPERTIES']['PRODUCT_PROPS']['DISPLAY_VALUE'])):?>
                                                <?foreach($arItem['DISPLAY_PROPERTIES']['PRODUCT_PROPS']['DISPLAY_VALUE'] as $val):?>
                                                    <span><?=$val?></span>
                                                <?endforeach;?>
                                            <?else:?>
                                                <span><?=$arItem['DISPLAY_PROPERTIES']['PRODUCT_PROPS']['DISPLAY_VALUE']?></span>
                                            <?endif;?>
                                        </div>
                                    </div>
                                <?endif;?>
                                <?if(isset($arItem['DISPLAY_PROPERTIES']['PRODUCT_COMPOSITION'])):?>
                                    <div class="novelties-slider__slide-description__item">
                                        <div class="novelties-slider__slide-description__item-icon">
                                            <?=file_get_contents($_SERVER["DOCUMENT_ROOT"].General::getProductPropertycon('PRODUCT_COMPOSITION'));?>
                                        </div>
                                        <div class="novelties-slider__slide-description__item-text">
                                            <p>Состав</p>
                                            <?if(is_array($arItem['DISPLAY_PROPERTIES']['PRODUCT_COMPOSITION']['DISPLAY_VALUE'])):?>
                                                <?foreach($arItem['DISPLAY_PROPERTIES']['PRODUCT_COMPOSITION']['DISPLAY_VALUE'] as $val):?>
                                                    <span><?=$val?></span>
                                                <?endforeach;?>
                                            <?else:?>
                                                <span><?=$arItem['DISPLAY_PROPERTIES']['PRODUCT_COMPOSITION']['DISPLAY_VALUE']?></span>
                                            <?endif;?>
                                        </div>
                                    </div>
                                <?endif;?>
                            </div>
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
</section>
<?endif;?>