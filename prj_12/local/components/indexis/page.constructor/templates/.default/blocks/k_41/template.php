<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$item = $arParams['ITEM'];
?>
<?if (is_array($item['DISPLAY_PROPERTIES']['K_41_PICTURE']['FILE_VALUE']) && count($item['DISPLAY_PROPERTIES']['K_41_PICTURE']['FILE_VALUE']) > 0): ?>
    <section class="nb-grid-gallery-section" id="<?=$arParams['BLOCK_AREA_ID']?>">
        <div class="nb-grid-gallery" id="<?=$arParams['EDIT_AREA_ID']?>">
            <?foreach($item['DISPLAY_PROPERTIES']['K_41_PICTURE']['FILE_VALUE'] as $arPicture):?>
                <div class="nb-grid-gallery__item">
                    <img src="<?=$arPicture['SRC']?>" alt="" />
                </div>
            <?endforeach;?>
        </div>
    </section>
<?endif;?>