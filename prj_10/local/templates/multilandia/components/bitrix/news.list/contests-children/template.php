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

use Bitrix\Main\Localization\Loc;

$mlTheme = "green";
if ($arParams["ML_THEME"]) {
	$mlTheme = $arParams["ML_THEME"];
}
?>

<? if (count($arResult['ITEMS']) > 0): ?>
    <section class="ml-section ml-section_bg">
        <div class="container">
            <div class="ml-section-header">
                <h2 class="ml-section-title">Конкурсы</h2>
                <a class="ml-btn ml-btn_round ml-btn_<?=$mlTheme?> ml-section-btn" href="/contests/">Все конкурсы</a>
            </div>
            <div class="ml-section-body">
                <div class="ml-slider" data-desktop-items="4" data-theme="<?=$mlTheme?>">
                    <div class="ml-slider__container">
                        <div class="ml-slider__wrapper">

                            <? foreach($arResult['ITEMS'] as $arItem):
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                                $startDateContest = FormatDate("d.m", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                                $finishDateContest = FormatDate("d.m.Y", strtotime($arItem['PROPERTIES']['DATE_END']['VALUE']));
                                ?>

                                <div class="ml-slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                    <div class="anim-item anim-item_contest anim-item_dark">
                                        <a class="anim-item__link" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                            <div class="anim-item__img">
                                                <img class="lazyload" data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt=""/>
                                            </div>
                                            <div class="anim-item__caption">
                                                <p class="anim-item__title">
                                                    <?=$arItem['NAME']?>
                                                </p>
												<? if (mb_strlen($arItem['PREVIEW_TEXT']) > 0): ?>
													<p class="anim-item__desc">
														<?=$arItem['PREVIEW_TEXT']?>
													</p>
												<? endif; ?>
												<div class="anim-item__action">
													<? if(time() > MakeTimeStamp($finishDateContest, "DD.MM.YYYY HH:MI:SS")) :?>
													<span class="anim-item__dates">
														<?=Loc::GetMessage("FINISH_CONTEST"); ?>
													</span>
													<? else: ?>
													<span class="anim-item__dates anim-item__dates_active">
														с <?=$startDateContest?> по <?=$finishDateContest?>
													</span>
													<? endif; ?>
												</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <? endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="ml-section-footer"><a class="ml-btn ml-btn_round ml-btn_<?=$mlTheme?> ml-section-btn" href="/contests/">Все конкурсы</a></div>
        </div>
    </section>
<? endif; ?>