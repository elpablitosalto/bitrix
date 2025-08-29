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

<? if (count($arResult['ITEMS']) > 0):?>
    <div class="anim-list">
        <div class="row">

            <? foreach($arResult['ITEMS'] as $arItem): ?>

                <?
                $arMovie = $arResult['MOVIES'][$arItem['PROPERTIES']['MOVIE_ID']['VALUE']];
                $movieTime = FormatDate("H:i", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                $movieDate = FormatDate("Y-m-d H:i:s", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                ?>

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="anim-item">
                        <a class="anim-item__link" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <div class="anim-item__img">
                                <img class="lazyloaded"
                                     data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
                                     src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
                                     alt="<?=$arItem['NAME']?>"
                                />
                                <time class="anim-item__time" datetime="<?=$movieDate?>">
                                    <span class="time_js_change_timezone">
                                        <?=$movieDate?>
                                    </span>
                                </time>

                                <? if (mb_strlen($arMovie['PROPERTY_VOZRAST_VALUE']) > 0): ?>
                                    <span class="age-limit-label age-limit-label_light">
                                        <?=$arMovie['PROPERTY_VOZRAST_VALUE']?>
                                    </span>
                                <? endif; ?>
                            </div>
                            <div class="anim-item__caption">
                                <p class="anim-item__title">
                                    <?=$arItem['NAME']?>
                                </p>
                                <? if( (!empty($arItem['PROPERTIES']['PART_OF_THE_DAY']['VALUE'])) && (!empty($arItem['PROPERTIES']['TIME_OF_THE_DAY']['VALUE'])) ) : ?>
									<div class="anim-item__action">
										<span class="anim-item__btn anim-item__btn_orange">
											<?=$arItem['PROPERTIES']['PART_OF_THE_DAY']['VALUE']?>
											в
											<?=$arItem['PROPERTIES']['TIME_OF_THE_DAY']['VALUE']?>
										</span>
									</div>
                                <? endif; ?>
                            </div>
                        </a>
                    </div>
                </div>
            <? endforeach; ?>

        </div>
    </div>
<?php endif; ?>