<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Hair\General;
?>
<div class="catalog" data-mobile-tab="2">
	<div class="catalog-middle-text__mobile"><p>Весь ассортимент продукции российского бренда профессиональной косметики для волос</p></div>
    <div class="catalog-list">
        <div class="product-list_wrapper" data-ajax-container>
            <?
            if(isset($_REQUEST['AJAX_CALL']) && $_REQUEST['AJAX_CALL'] == 'Y'){
                $APPLICATION->RestartBuffer();
            }?>
            <?foreach($arResult['ITEMS'] as $k => $arItem):?>
                <?$pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>9999, 'height'=>550), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="product-list_item">
                    <div class="product-list_item-image">
                        <img class="js_lazy" data-src="<?=$pic['src']?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" />
                    </div>
                    <p class="product-list_item-link"><?=$arItem['PREVIEW_TEXT']?></p>
                    <span class="product-list_item-subtext"><?=$arItem['NAME']?></span>
                    <div class="product-list_item-description">
                        <?if(isset($arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE'])):?>
                            <div class="product-list_item-description__item">
                                <div class="product-list_item-description__item-icon">
                                    <img class="js_lazy" data-src="<?=General::getProductPropertycon('PRODUCT_TYPE')?>" />
                                </div>
                                <div class="product-list_item-description__item-text">
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
                            <div class="product-list_item-description__item">
                                <div class="product-list_item-description__item-icon">
                                    <img class="js_lazy" data-src="<?=General::getProductPropertycon('PRODUCT_FEATURE')?>" />
                                </div>
                                <div class="product-list_item-description__item-text">
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
                            <div class="product-list_item-description__item">
                                <div class="product-list_item-description__item-icon">
                                    <img class="js_lazy" data-src="<?=General::getProductPropertycon('PRODUCT_PROPS')?>" />
                                </div>
                                <div class="product-list_item-description__item-text">
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
                            <div class="product-list_item-description__item">
                                <div class="product-list_item-description__item-icon">
                                    <img class="js_lazy" data-src="<?=General::getProductPropertycon('PRODUCT_COMPOSITION')?>" />
                                </div>
                                <div class="product-list_item-description__item-text">
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
                        <div class="blur-block"></div>
                        <div class="blur-block-2"></div>
                    </div>
                </a>
            <?endforeach;?>
            <?
            if(isset($_REQUEST['AJAX_CALL']) && $_REQUEST['AJAX_CALL'] == 'Y')
                die();
            ?>
        </div>
    </div>
</div>