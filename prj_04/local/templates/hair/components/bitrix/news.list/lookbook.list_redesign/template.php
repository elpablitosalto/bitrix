<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="container _inside-page">
<h1>Look Book</h1>
    <div class="lookbook-rd">
        <ul class="lookbook-rd__list">
            <?foreach($arResult['ITEMS'] as $k => $arItem):?>
                <li class="lookbook-rd__item">
                    <?$pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>486, 'height'=>624), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                    <div class="lookbook-rd-panel">
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="lookbook-rd-panel__wrapper" <?if (!empty($arItem['PROPERTIES']['HEX_COLOR'])):?>style="color: <?=$arItem['PROPERTIES']['HEX_COLOR']['VALUE']?>;"<?endif;?>>
                            <div class="lookbook-rd-panel__header">
                                <h2 class="lookbook-rd-panel__title">
                                    <span><?=$arItem['NAME']?></span>
                                </h2>
                                <div class="lookbook-rd-panel__description">
                                    <?=$arItem['PREVIEW_TEXT']?>
                                </div>
                            </div>
                            <div class="lookbook-rd-panel__illustration">
                                <img src="<?=$pic['src']?>" alt="<?=$arItem['NAME']?>" class="lookbook-rd-panel__image">
                            </div>
                            <?if(count($arItem['DISPLAY_PROPERTIES']['SECTION_PRODUCTS_NAMES']['VALUE'])):?>
                                <div class="lookbook-rd-panel__content">
                                    <div class="lookbook-rd-panel__description">
                                        Ключевые продукты <br>для создания образа:
                                    </div>
                                    <div class="lookbook-rd-panel__fields">
                                        <?foreach($arItem['DISPLAY_PROPERTIES']['SECTION_PRODUCTS_NAMES']['VALUE'] as $arProduct):?>
                                            <p><?=$arProduct?></p>
                                        <?endforeach;?>
                                    </div>
                                </div>
                            <?endif;?>
                        </a>
                    </div>
                </li>
            <?endforeach;?>
        </ul>
    </div>
    <?if(!empty($arResult["NAV_STRING"])):?>
        <div class="lookbook-rd__pagination">
            <?=$arResult["NAV_STRING"]?>
        </div>
    <?endif;?>
</div>
