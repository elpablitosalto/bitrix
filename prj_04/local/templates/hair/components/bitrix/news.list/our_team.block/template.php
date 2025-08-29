<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Hair\General;
?>

<div class="representatives">
    <h3>ПРЕДСТАВИТЕЛИ «CONCEPT» В ВАШЕМ РЕГИОНЕ</h3>
    <div class="representatives-wrapper">
        <?foreach($arResult['ITEMS'] as $arItem):?>
            <?$arName = explode(' ',$arItem['NAME'])?>
            <div class="representatives-wrapper__item">
                <p class="representatives-wrapper__item-title"><?=$arName[1]?><br/><?=$arName[0]?></p>
                <?if(!empty($arItem['PROPERTIES']['EMAIL']['VALUE'])):?>
                    <a href="mailto:<?=$arItem['PROPERTIES']['EMAIL']['VALUE']?>" class="email-link"><?=$arItem['PROPERTIES']['EMAIL']['VALUE']?></a>
                <?endif;?>
                <?if(!empty($arItem['PROPERTIES']['PHONE']['VALUE'])):?>
                    <a href="tel:<?=General::formatPhone($arItem['PROPERTIES']['PHONE']['VALUE'])?>" class="phone-link"><?=$arItem['PROPERTIES']['PHONE']['VALUE']?></a>
                <?endif;?>
            </div>
        <?endforeach;?>
    </div>
    <p>Вы также можете ознакомиться с полным <a href="/distributors/">списком дистрибьюторов</a> компании «CONCEPT» </p>
</div>