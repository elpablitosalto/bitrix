<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
?>
<section class="nb-section nb-stages-and-terms-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
            <div class="nb-section__header">
                <?require __DIR__ . "/../../title.php";?>
            </div>
        <?endif;?>
        <div class="nb-section__body">
            <div class="nb-stages-and-terms">
                <div class="nb-stages-and-terms--container">
                    <div class="nb-stages-and-terms--menu-box">
                        <div class="nb-stages-and-terms--menu-top">
                            <div class="nb-stages-and-terms--label">КАК МЫ ЭТО ДЕЛАЕМ:</div>
                        </div>
                        <div class="nb-stages-and-terms--menu">
                            <?foreach ($item['DISPLAY_PROPERTIES']['K_9_STAGE']['VALUE'] as $index => $arItem):?>
                                <?
                                $arItemValues = $arItem['SUB_VALUES'];
                                ?>
                                <div class="nb-stages-and-terms--menu-item" style="--qut:'<?=($index+1)?>'"><span class="nb-stages-and-terms--menu-text"><?=$arItemValues['K_9_STAGE_NAME']['VALUE']?></span></div>
                            <?endforeach;?>
                            <?if (mb_strlen($item['DISPLAY_PROPERTIES']['K_9_RECOMMENDATION_NAME']['VALUE']) > 0):?>
                                <div class="nb-stages-and-terms--menu-item" style="--qut:'!'"><span class="nb-stages-and-terms--menu-text"><?=$item['DISPLAY_PROPERTIES']['K_9_RECOMMENDATION_NAME']['VALUE']?></span></div>
                            <?endif;?>
                        </div>
                    </div>
                    <div class="swiper-container nb-stages-and-terms--slider">
                        <div class="swiper-wrapper nb-stages-and-terms--box">
                            <?foreach ($item['DISPLAY_PROPERTIES']['K_9_STAGE']['VALUE'] as $index => $arItem):?>
                                <?
                                $arItemValues = $arItem['SUB_VALUES'];
                                ?>
                                <div class="swiper-slide nb-stages-and-terms--slide">
                                    <div class="nb-stages-and-terms--title" style="--qut:'<?=($index+1)?>'"><?=$arItemValues['K_9_STAGE_NAME']['VALUE']?></div>
                                    <?if (mb_strlen($arItemValues['K_9_STAGE_DESCRIPTION']['~VALUE']['TEXT']) > 0):?>
                                        <div class="nb-stages-and-terms--text"><?=$arItemValues['K_9_STAGE_DESCRIPTION']['~VALUE']['TEXT']?></div>
                                    <?endif;?>
                                    <?if (!empty($arItemValues['K_9_STAGE_PICTURE']['VALUE'])):?>
                                        <div class="nb-stages-and-terms--img">
                                            <img src="<?=CFile::GetPath($arItemValues['K_9_STAGE_PICTURE']['VALUE'])?>" alt="">
                                        </div>
                                    <?endif;?>
                                </div>
                            <?endforeach;?>
                            <?if (mb_strlen($item['DISPLAY_PROPERTIES']['K_9_RECOMMENDATION_NAME']['VALUE']) > 0):?>
                                <div class="swiper-slide nb-stages-and-terms--slide">
                                    <div class="nb-stages-and-terms--title" style="--qut:'!'"><?=$item['DISPLAY_PROPERTIES']['K_9_RECOMMENDATION_NAME']['VALUE']?></div>
                                    <?if (mb_strlen($item['DISPLAY_PROPERTIES']['K_9_RECOMMENDATION_DESCRIPTION']['~VALUE']['TEXT']) > 0):?>
                                        <div class="nb-stages-and-terms--text"><?=$item['DISPLAY_PROPERTIES']['K_9_RECOMMENDATION_DESCRIPTION']['~VALUE']['TEXT']?></div>
                                    <?endif;?>
                                    <?if (!empty($item['DISPLAY_PROPERTIES']['K_9_RECOMMENDATION_PICTURE']['VALUE'])):?>
                                        <div class="nb-stages-and-terms--img">
                                            <img src="<?=CFile::GetPath($item['DISPLAY_PROPERTIES']['K_9_RECOMMENDATION_PICTURE']['VALUE'])?>" alt="">
                                        </div>
                                    <?endif;?>
                                </div>
                            <?endif;?>

                        </div>
                    </div>
                    <div class="nb-stages-and-terms--controle nb-stages-and-terms--prev">
                        <button class="nb-slider-arrow nb-slider-arrow_prev" type="button" tabindex="0" aria-label="Previous slide" aria-controls="swiper-wrapper-6e69f2108163101eab">
                            <svg class="icon icon-slider-arrow">
                                <use xlink:href="#slider-arrow"></use>
                            </svg>
                        </button>
                    </div>
                    <div class="nb-stages-and-terms--controle nb-stages-and-terms--next">
                        <button class="nb-slider-arrow nb-slider-arrow_next" type="button" tabindex="0" aria-label="Next slide" aria-controls="swiper-wrapper-6e69f2108163101eab">
                            <svg class="icon icon-slider-arrow">
                                <use xlink:href="#slider-arrow"></use>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="nb-stages-and-terms--pagination"></div>
            </div>
        </div>
    </div>
</section>