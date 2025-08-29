<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Hair\General;
?>
<div class="vacancies">
    <div class="slide-toggle-container">
        <div class="slide-toggle-content">
            <?foreach($arResult['ITEMS'] as $k => $arItem):?>
                <div class="slide-toggle-content__item slide-toggle-content__item--default">
                    <div class="slide-toggle-content__item-button"><?=$arItem['NAME']?></div>
                    <div class="slide-toggle-content__item-content">
                        <div class="slide-toggle-content__item-content--text">    
                            <section class="content-text">
                                <p>Обязанности:</p>
                                <?=$arItem['DISPLAY_PROPERTIES']['RESPONSIBILITIES']['DISPLAY_VALUE']?>
                                <p>Требования:</p>
                                <?=$arItem['DISPLAY_PROPERTIES']['REQUIREMENTS']['DISPLAY_VALUE']?>
                                <?=$arItem['PREVIEW_TEXT']?>    
                                <div class="buttons-wrapper">
                                    <a href="#vacanciesPopup" data-popup="rezume" data-id="<?=$arItem['ID']?>" class="button _small _text-small">Отправить резюме</a>
                                    <a href="<?=$arItem['DISPLAY_PROPERTIES']['HH_LINK']['VALUE']?>" target="_blank" class="button _empty _small _text-small">Перейти на hh.ru</a>
                                </div>          
                            </section>                           
                        </div>
                    </div>                            
                </div>  
            <?endforeach;?>
        </div>
    </div>
</div>