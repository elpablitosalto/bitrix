<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<? if (count($arResult['ITEMS']) > 0): ?>
    <div class="home-top-slider-container">
        <div class="home-top-slider-list">

            <? foreach($arResult['ITEMS'] as $arItem): ?>
                <div class="home-top-slider-item">
                    <picture class="home-top-slider-item__img">
                        <source media="(max-width: 480px)" srcset="<?=CFile::GetPath($arItem['PROPERTIES']['BANNER_SMARTPHONE']['VALUE'])?>">
                        <source media="(max-width: 991px)" srcset="<?=CFile::GetPath($arItem['PROPERTIES']['BANNER_TABLET']['VALUE'])?>">
                        <img src="<?=CFile::GetPath($arItem['PROPERTIES']['BANNER_DESKTOP']['VALUE'])?>" alt="">
                    </picture>
                    <div class="home-top-slider-item__caption">
                        <div class="home-top-slider-item__caption-inner">
                            <? if(!empty($arItem['NAME'])) : ?>
                                <p class="home-top-slider-item__title">
                                    <span>
                                        <?=$arItem['NAME']?>
                                    </span>
                                </p>
                            <? endif; ?>

                            <? if( (!empty($arItem['PROPERTIES']['PART_OF_THE_DAY']['VALUE'])) && (!empty($arItem['PROPERTIES']['TIME_OF_THE_DAY']['VALUE'])) ) : ?>
                                <p class="home-top-slider-item__desc">
                                    <span>
                                        <?=$arItem['PROPERTIES']['PART_OF_THE_DAY']['VALUE']?>
                                        <br>
                                        <?=$arItem['PROPERTIES']['TIME_OF_THE_DAY']['VALUE']?>
                                    </span>
                                </p>
                            <? endif; ?>
                            <a class="home-top-slider-item__link" href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>">Подробнее</a>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>

        </div>
    </div>
<?php endif; ?>