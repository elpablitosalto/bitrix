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
<?if (is_array($arResult["ITEMS"]) && count($arResult["ITEMS"]) > 0):?>
	<section class="top-banner">
		<div class="top-banner__slider">
			<div class="top-banner__wrapper">
				<?foreach($arResult["ITEMS"] as $key => $arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="top-banner__slide<?if ($arItem['DISPLAY_PROPERTIES']['TYPE']['VALUE_XML_ID'] == 'blue'):?> top-banner__slide_blue<?endif;?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="top-banner__title">
							<h2><?=$arItem["NAME"]?></h2>
							<?if (mb_strlen($arItem["PREVIEW_TEXT"]) > 0):?>
								<div class="top-banner__text"><?=$arItem["PREVIEW_TEXT"]?></div>
							<?endif;?>
							<?if (mb_strlen($arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']) > 0):?>
								<a class="top-banner__button" href="<?=$arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']?>">Подробнее</a>
							<?endif;?>
						</div>
						<div class="top-banner__image">
							<picture class="nb-top-banner-slider-item__img">
								<?if ($arItem['DISPLAY_PROPERTIES']['TYPE']['VALUE_XML_ID'] == 'orange'):?>
									<?if (!empty($arItem['DISPLAY_PROPERTIES']['PICTURE_MOBILE']['FILE_VALUE']['SRC'])):?>
										<source <?=(($key > 0) ? 'loading="lazy"' : '')?> media="(max-width: 480px)" srcset="<?=$arItem['DISPLAY_PROPERTIES']['PICTURE_MOBILE']['FILE_VALUE']['SRC']?>">
									<?endif;?>
									<?if (!empty($arItem['DISPLAY_PROPERTIES']['PICTURE_TABLET']['FILE_VALUE']['SRC'])):?>
										<source <?=(($key > 0) ? 'loading="lazy"' : '')?> media="(max-width: 1200px)" srcset="<?=$arItem['DISPLAY_PROPERTIES']['PICTURE_TABLET']['FILE_VALUE']['SRC']?>">
									<?endif;?>
									<?if (!empty($arItem['DISPLAY_PROPERTIES']['PICTURE_DESKTOP']['FILE_VALUE']['SRC'])):?>
										<img <?=(($key > 0) ? 'loading="lazy"' : '')?> src="<?=$arItem['DISPLAY_PROPERTIES']['PICTURE_DESKTOP']['FILE_VALUE']['SRC']?>" alt="">
									<?endif;?>
								<?else:?>
									<img src="<?=$arItem['DISPLAY_PROPERTIES']['PICTURE_DESKTOP']['FILE_VALUE']['SRC']?>" alt=""<?=(($key > 0) ? ' loading="lazy"' : '')?>>
								<?endif;?>
							</picture>
						</div>
					</div>
				<?endforeach;?>
			</div>
			<div class="top-banner__control">
				<div class="button-arrow button-arrow_left top-banner__control_left"></div>
				<div class="button-arrow button-arrow_right top-banner__control_right"></div>
			</div>
		</div>
	</section>
<?endif;?>