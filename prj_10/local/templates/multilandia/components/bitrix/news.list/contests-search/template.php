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
?>



<? if (count($arResult['ITEMS']) > 0):?>
    <div class="anim-list">
        <div class="row">

            <? foreach($arResult['ITEMS'] as $arItem):
                $startDateContest = FormatDate("d.m", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));
                $finishDateContest = FormatDate("d.m.Y", strtotime($arItem['PROPERTIES']['DATE_END']['VALUE']));
                ?>

                <div class="col-6 col-md-4 col-lg-3 contest_list_search">
                    <div class="anim-item anim-item_contest">
                        <a class="anim-item__link" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <div class="anim-item__img">
                                <img class="lazyload" data-src="<?=CFile::GetPath($arItem['PREVIEW_PICTURE'])?>" src="<?=CFile::GetPath($arItem['PREVIEW_PICTURE'])?>" alt=""/>
                            </div>
                            <div class="anim-item__caption">
                                <p class="anim-item__title"><?=$arItem['NAME']?></p>
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
<?php endif; ?>