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
    <div class="anim-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-content">
                    <div class="row">

                        <? foreach($arResult['ITEMS'] as $arItem): ?>
                            <div class="col-6 col-md-4">
                                <div class="anim-item">
                                    <a class="anim-item__link" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                        <div class="anim-item__img">
                                            <img
                                                class="lazyload"
                                                data-src="<?=CFile::GetPath($arItem['PREVIEW_PICTURE'])?>"
                                                src="<?=CFile::GetPath($arItem['PREVIEW_PICTURE'])?>"
                                                alt=""
                                            />
                                            <? if (mb_strlen($arItem['PROPERTY_VOZRAST_VALUE']) > 0): ?>
                                                <span class="age-limit-label age-limit-label_light">
                                                    <?=$arItem['PROPERTY_VOZRAST_VALUE']?>
                                                </span>
                                            <? endif; ?>
                                        </div>
                                        <div class="anim-item__caption">
                                            <p class="anim-item__title">
                                                <?=$arItem['NAME']?>
                                            </p>
                                            <?/*<span class="anim-item__tag">
                                                <? foreach ($arItem['PROPERTIES']['TEGI']['VALUE_ENUM'] as $keyTag => $valueTag) : ?>
                                                    #<?=$valueTag?>
                                                <? endforeach; ?>
                                            </span>*/?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <? endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>


<?php endif; ?>