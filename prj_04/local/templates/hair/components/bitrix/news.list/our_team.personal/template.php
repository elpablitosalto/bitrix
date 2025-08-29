<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Hair\General;
?>
<?foreach($arResult['ITEMS'] as $k => $arItem):?>
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