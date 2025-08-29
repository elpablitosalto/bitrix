<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Hair\General;
?>
<section class="downloads">
    <div class="container">
        <div class="downloads-wrapper" data-ajax-container>
            <?
            if(isset($_REQUEST['AJAX_CALL']) && $_REQUEST['AJAX_CALL'] == 'Y'){
                $APPLICATION->RestartBuffer();
            }?>
            <?foreach($arResult['ITEMS'] as $k => $arItem):?>
                <?$iconType = $arItem['PROPERTIES']['MATERIAL_FORMAT']['VALUE']?>
                <?$pic = (!empty($arItem['PREVIEW_PICTURE'])) ? CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>196, 'height'=>240), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src'] : '/images/no-photo.jpg'?>
                <div class="downloads-item" data-id="<?=$arItem['ID']?>">
                    <div class="form-wrapper__item form-wrapper__item-checkbox">
                        <input id="file-id-<?=$arItem['ID']?>" data-dowloaded-file type="checkbox" name="fileID[]" value="<?=$arItem['ID']?>">
                        <label for="file-id-<?=$arItem['ID']?>"></label>
                    </div>
                    <div class="downloads-item__icon">
                        <?=General::returnIcon($iconType)?>                                              
                    </div>
                    <a href="#downloadsPopup" data-downloads-popup class="downloads-item__link">
                        <div class="downloads-item__image">
                            <img src="<?=$pic?>" alt="" title="" />
                        </div>
                        <p class="downloads-item__title"><?=$arItem['NAME']?></p>
                        <?if(!empty($arItem['PREVIEW_TEXT'])):?>
                            <p class="downloads-item__subtitle"><?=$arItem['PREVIEW_TEXT']?></p>
                        <?endif;?>
                    </a>
                </div>
            <?endforeach;?> 
            <?
            if(isset($_REQUEST['AJAX_CALL']) && $_REQUEST['AJAX_CALL'] == 'Y')
                die();
            ?>
        </div>
    </div>
</section>