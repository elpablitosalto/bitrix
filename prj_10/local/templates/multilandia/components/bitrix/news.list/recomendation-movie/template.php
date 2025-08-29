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

<? if (count($arResult['ITEMS']) > 0): ?>
    <section class="ml-section">
        <div class="container">
            <div class="ml-section-header">
                <h2 class="ml-section-title">Рекомендуем</h2>
                <a class="ml-btn ml-btn_round ml-btn_<?=$mlTheme?> ml-section-btn" href="/movies/filter/vozrastnoy_reyting-is-dlya_semeynogo_prosmotra/apply/">Все рекомендации</a>
            </div>
            <div class="ml-section-body">
                <div class="ml-slider" data-desktop-items="3" data-theme="<?=$mlTheme?>">
                    <div class="ml-slider__container">
                        <div class="ml-slider__wrapper">

                            <? foreach($arResult['ITEMS'] as $arItem):
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                ?>
                                <div class="ml-slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                    <div class="anim-item">
                                        <a onclick="" class="anim-item__link" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                            <div class="anim-item__img">
                                                <img class="lazyload" data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt=""/>
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
                </div>
            </div>
            <div class="ml-section-footer"><a class="ml-btn ml-btn_round ml-btn_<?=$mlTheme?> ml-section-btn" href="/movies/filter/vozrastnoy_reyting-is-dlya_semeynogo_prosmotra/apply/">Все рекомендации</a></div>
        </div>
    </section>
<? endif; ?>