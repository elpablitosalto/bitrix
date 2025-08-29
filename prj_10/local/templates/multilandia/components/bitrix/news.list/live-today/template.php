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

$mlTheme = "green";
if ($arParams["ML_THEME"]) {
	$mlTheme = $arParams["ML_THEME"];
}
?>

<? if (count($arResult['ITEMS']) > 0):?>
    <section class="ml-section">
        <div class="container">
            <div class="ml-section-header">
                <h2 class="ml-section-title">Сегодня в эфире</h2>
                <a class="ml-btn ml-btn_round ml-btn_<?=$mlTheme?> ml-section-btn" href="/guide/">Телепрограмма</a>
            </div>
            <div class="ml-section-body">
                <div class="ml-slider" data-desktop-items="4" data-theme="<?=$mlTheme?>">

                    <div class="ml-slider__container">
                        <div class="ml-slider__wrapper">

                            <? foreach($arResult['ITEMS'] as $arItem):
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                                $arMovie = isset($arResult['MOVIES'][$arItem['PROPERTIES']['MOVIE_ID']['VALUE']]) ? $arResult['MOVIES'][$arItem['PROPERTIES']['MOVIE_ID']['VALUE']] : [];
                                $movieTime = FormatDate("H:i", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                                $movieDate = FormatDate("Y-m-d H:i:s", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                                ?>

                                <div class="ml-slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                    <div class="anim-item">
                                        <?if (isset($arMovie['DETAIL_PAGE_URL'])):?>
                                            <a class="anim-item__link" href="<?=$arMovie['DETAIL_PAGE_URL']?>">
                                        <?else:?>
                                            <span class="anim-item__link">
                                        <?endif;?>
                                            <div class="anim-item__img">
                                                <?
                                                $moviePictureSrc = (!empty($arMovie['PREVIEW_PICTURE'])) ? CFile::GetPath($arMovie['PREVIEW_PICTURE']) : SITE_TEMPLATE_PATH . '/img/content/cartoons/no_photo.jpg';
                                                ?>
                                                <img class="lazyload"
                                                     data-src="<?=$moviePictureSrc?>"
                                                     src="<?=$moviePictureSrc?>"
                                                     alt=""/>
                                                <time class="anim-item__time" datetime="<?=$movieDate?>">
                                                    <span class="time_js_change_timezone">
                                                        <?=$movieDate?>
                                                    </span>
                                                </time>
                                                <? if (mb_strlen($arMovie['PROPERTY_VOZRAST_VALUE']) > 0): ?>
                                                    <span class="age-limit-label age-limit-label_light"><?=$arMovie['PROPERTY_VOZRAST_VALUE']?></span>
                                                <? endif; ?>
                                                <div class="anim-item__progress">
                                                    <div class="anim-item__scale" style="width: 60%;"></div>
                                                </div>
                                            </div>
                                            <div class="anim-item__caption">
                                                <p class="anim-item__title">
                                                    <?=$arItem['NAME']?>
                                                </p>
                                            </div>
                                        <?if (isset($arMovie['DETAIL_PAGE_URL'])):?>
                                            </a>
                                        <?else:?>
                                            </span>
                                        <?endif;?>
                                    </div>
                                </div>
                            <? endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="ml-section-footer">
                <a class="ml-btn ml-btn_round ml-btn_<?=$mlTheme?> ml-section-btn" href="/guide/">Телепрограмма</a>
            </div>
        </div>
    </section>
<?php endif; ?>