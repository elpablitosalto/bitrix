<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Hair\General;

global $USER;
?>

<div class="get-order">
    <form id="getOrder" data-order-form action="/local/ajax/personal/order.php">
        <input type="hidden" name="UID" value="<?=$USER->GetID()?>" />
        <div class="slide-toggle-container">
            <?    
                foreach($arResult['SORTED_ITEMS'] as $arTopSection):
            ?>
                    <div class="slide-toggle-content__item slide-toggle-content__item--level-1">
                        <div class="slide-toggle-content__item-button"><?=$arTopSection['NAME']?></div>
                        <div class="slide-toggle-content__item-content">
            <?
                            foreach($arTopSection['SECTIONS'] as $arParentSection):
            ?>                                        
                                <div class="slide-toggle-content__item slide-toggle-content__item--level-2">
                                    <div class="slide-toggle-content__item-button"><?=$arParentSection['NAME']?></div>
                                    <div class="slide-toggle-content__item-content">
                                        <div class="slide-toggle-content__item-content--products">
            <?
                                            foreach($arParentSection['ITEMS'] as $arItem):
                                                $pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>40, 'height'=>40), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            ?>
                                                
                                                <div class="slide-toggle-content__item-content--products-item order-product">
                                                    <div class="order-product__pic"><img src="<?=$pic['src']?>" alt="<?=$pic['ALT']?>" title="<?=$pic['TITLE']?>" /></div>
                                                    <div class="order-product__title"><?=$arItem['NAME']?></div>
                                                    <div class="order-product__cnt">
                                                        <div class="minus"></div>
                                                        <input type="number" name="products[<?=$arItem['ID']?>]" value="0" min="0" pattern="[^0-9]" />
                                                        <div class="plus _active"></div>
                                                    </div>
                                                </div>
            <?
                                            endforeach;
            ?>                            
                                        </div>
                                    </div>
                                </div>
            <?
                            endforeach;
            ?>                
                        </div>
                    </div>
            <?
                endforeach;
            ?>           
        </div>
        <div class="_align-right">
            <button type="submit" class="button _small">Сделать заказ</button>
        </div>
    </form>
    <div class="order-success">
        <p class="title">СПАСИБО!<br/>ВАШ ЗАКАЗ ОТПРАВЛЕН.</h2>
        <p>Менеджер свяжется с вами в течение 24 часов</p>
    </div>
</div>