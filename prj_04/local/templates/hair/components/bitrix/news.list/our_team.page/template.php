<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Hair\General;
?>
<?foreach($arResult['DEPARTMENTS'] as $k => $arDepartment):?>
    <div class="department">
        <h3><?=$arDepartment['SECTION']['NAME']?></h3>
        <div class="content-text"><?=$arDepartment['SECTION']['~DESCRIPTION']?></div>
        <div class="department-list">
            <?foreach($arDepartment['ITEMS'] as $j => $arItem):?>
                <?$pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>256, 'height'=>256), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                <div class="department-list__item">
                    <div class="department-list__item--photo">
                        <img src="<?=$pic['src']?>" alt="<?=$pic['ALT']?>" title="<?=$pic['TITLE']?>" />
                    </div>
                    <p class="department-list__item--name"><?=$arItem['NAME'][1]?><br/><?=$arItem['NAME'][0]?></p>
                    <p class="department-list__item--position"><?=$arItem['PROPERTIES']['POSITION']['VALUE_ENUM']?></p>
                    <?if(!empty($arItem['PROPERTIES']['EMAIL']['VALUE'])):?>
                        <a href="mailto:<?=$arItem['PROPERTIES']['EMAIL']['VALUE']?>" class="email-link"><?=$arItem['PROPERTIES']['EMAIL']['VALUE']?></a>
                    <?endif;?>
                    <?if(!empty($arItem['PROPERTIES']['PHONE']['VALUE'])):?>
                        <a href="tel:<?=General::formatPhone($arItem['PROPERTIES']['PHONE']['VALUE'])?>" class="phone-link"><?=$arItem['PROPERTIES']['PHONE']['VALUE']?></a>
                    <?endif;?>
                </div>
            <?endforeach;?>
        </div>
    </div>
<?endforeach;?>