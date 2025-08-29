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
<?php if (count($arResult["ITEMS"]) > 0): ?>
	<div class="ml-section-body">
		<div class="ml-slider" data-desktop-items="1" data-theme="green">
			<div class="ml-slider__container">
				<div class="ml-slider__wrapper">
					<?foreach($arResult["ITEMS"] as $arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						$arUser = isset($arResult['USER'][$arItem['PROPERTIES']['USER_ID']['VALUE']]) ? $arResult['USER'][$arItem['PROPERTIES']['USER_ID']['VALUE']] : [];
						$arFullName = array_filter([$arUser['NAME'], $arUser['LAST_NAME']]);
						if (count($arFullName) == 0)
							$arFullName = [$arUser['LOGIN']];
						?>
						<div class="ml-slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<div class="ml-review">
								<div class="ml-review__img">
									<img src="<?if (!empty($arUser['PERSONAL_PHOTO'])):?><?=CFile::GetPath($arUser['PERSONAL_PHOTO'])?><?else:?><?=$templateFolder?>/images/no-personal-photo.png<?endif;?>" alt="<?=implode(' ', $arFullName)?>" />
								</div>

								<div class="ml-review__caption">
									<div class="ml-review__header">
										<h3 class="ml-review__title"><span><?=implode('</span> <span>', $arFullName)?></span></h3>
										<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
											<time class="ml-review__date" datetime="<?echo $arItem["DISPLAY_ACTIVE_FROM"]?>"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></time>
										<?endif?>
									</div>
									<div class="ml-review__desc">
										<?echo $arItem["PREVIEW_TEXT"];?>
									</div>
								</div>
							</div>
						</div>
					<?endforeach;?>
				</div>
			</div>
		</div>
	</div>
<?php else: ?>
	<p><?=Loc::getMessage('NO_REVIEWS')?></p>
<?php endif; ?>
