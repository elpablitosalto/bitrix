<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Hair\General;
?>
<?if(empty($_REQUEST["AJAX_CALL"]) || $_REQUEST["AJAX_CALL"] != "Y"):?>
<ul class="entity-grid__list" data-ajax-container>
<?endif;?>
    <?foreach($arResult['ITEMS'] as $k => $arItem):?>
        <?$iconType = $arItem['PROPERTIES']['MATERIAL_FORMAT']['VALUE']?>
        <?$pic = (!empty($arItem['PREVIEW_PICTURE'])) ? CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>196, 'height'=>240), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src'] : '/images/no-photo.jpg'?>
        <li class="entity-grid__item">
            <!-- begin .entity-snippet-->
            <div class="entity-snippet entity-grid__snippet" data-id="<?=$arItem['ID']?>">
                <span class="entity-snippet__panel downloads-item">
                    <div class="form-wrapper__item form-wrapper__item-checkbox">
                        <input id="file-id-<?=$arItem['ID']?>" data-dowloaded-file type="checkbox" name="fileID[]" value="<?=$arItem['ID']?>">
                        <label for="file-id-<?=$arItem['ID']?>"></label>
                    </div>
                     <div class="downloads-item__icon">
                        <?=General::returnIcon($iconType)?>
                    </div>
                    <span class="entity-snippet__illustration">
                        <picture class="entity-snippet__picture">
                            <img
                                src="<?=$pic?>"
                                alt="image <?=$k?>"
                                class="entity-snippet__image"
                                title=""
                            />
                        </picture>
                    </span>
                    <span class="entity-snippet__wrapper">
                        <span class="entity-snippet__content">
                            <span class="entity-snippet__main">
                                <span class="entity-snippet__title">
                                   <?=$arItem['NAME']?>
                                </span>
                            </span>
                        </span>
                    </span>
                </span>
            </div>
            <!-- end .entity-snippet-->
        </li>
    <?endforeach;?>
<?if(empty($_REQUEST["AJAX_CALL"]) || $_REQUEST["AJAX_CALL"] != "Y"):?>
</ul>
<div class="entity-grid__controls">
<?endif;?>
<?if(!empty($arResult["NAV_RESULT"]) && $arResult["NAV_RESULT"]->NavPageCount > 1 && $arResult["NAV_RESULT"]->NavPageNomer < $arResult["NAV_RESULT"]->NavPageCount):?>
    <div class="entity-grid__control">
        <!-- begin .button-->
        <button class="button button_width_full button_type_skewed js-show-more" type="button" data-page-num="<?=($arResult["NAV_RESULT"]->NavPageNomer + 1)?>">
            <span class="button__holder">
                <svg class="button__icon">
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/images/icon.svg#icon_infinity"></use>
                </svg>
                <span class="button__text">Показать ещё</span>
            </span>
        </button>
        <!-- end .button-->
    </div>
<?endif;?>
<?if(empty($_REQUEST["AJAX_CALL"]) || $_REQUEST["AJAX_CALL"] != "Y"):?>
</div>
<?endif;?>