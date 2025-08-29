<?
    //d($arResult['ITEMS']);
    $arSections = [];
    foreach($arResult['ITEMS'] as &$arItem):
        $arSection = CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID'])->GetNext();
        $arSections[$arItem['IBLOCK_SECTION_ID']]['NAME'] = $arSection['NAME'];
        $arSections[$arItem['IBLOCK_SECTION_ID']]['CODE'] = $arSection['CODE'];
        $arItem['SECTION_CODE'] = $arSection['CODE'];
    endforeach;
?>
<div class="container">
    <?$i = 0;?>
    <div class="filter" data-filter="commandSlider">
        <?foreach($arSections as $arItem):?>
            <?if($i == 0):?>
                <button class="filter__button _active" data-filter-type="all">Все</button>
            <?else:?>
                <button class="filter__button" data-filter-type="<?=$arItem['CODE']?>"><?=$arItem['NAME']?></button>
            <?endif;?>
            <?$i++;?>
        <?endforeach;?>
    </div>
</div>
<div class="container">
    <div class="default-slider-wrapper">
        <div id="commandSlider" data-default-slider class="command-slider swiper-container">
            <div class="swiper-wrapper">
                <?foreach($arResult['ITEMS'] as $arItem):?>
                    <?$arName = explode(' ',$arItem['NAME'])?>
                    <?$pic = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'], array('width'=>285, 'height'=>332), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                    <div class="command-slider__slide swiper-slide" data-filter-type="<?=$arItem['SECTION_CODE']?>">
                        <div class="command-slider__slide-image">
                            <a href="#"><img src="<?=$pic['src']?>" alt="<?=$pic['ALT']?>" title="<?=$pic['TITLE']?>" /></a>
                        </div>
                        <div class="command-slider__slide-description">
                            <p class="command-slider__slide-description--link"><?=$arName[1]?><br/><?=$arName[0]?></p>
                            <span class="command-slider__slide-description--post"><?=$arItem['DISPLAY_PROPERTIES']['POSITION']['VALUE']?></span>
                            <span class="command-slider__slide-description--date"><?=strip_tags($arItem['DISPLAY_PROPERTIES']['LOCATION']['DISPLAY_VALUE'])?></span>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
</div>