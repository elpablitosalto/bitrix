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
	<section class="story">
		<div class="title-section">
			<h2><?=$arResult['NAME']?></h2>
			<div class="story__navigation">
				<div class="button-arrow button-arrow_left story__prev"></div>
				<div class="button-arrow button-arrow_right story__next"></div>
			</div>
		</div>
		<div class="story__slider">
			<div class="story__wrapper">
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="story__slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<?if (mb_strlen($arItem["PREVIEW_TEXT"]) > 0):?>
							<div class="story__text"><?=$arItem["PREVIEW_TEXT"]?></div>
						<?endif;?>
						<div class="story__author">
							<?if (isset($arItem["PREVIEW_PICTURE"]["SRC"])):?>
								<div class="story__author_photo">
									<img loading="lazy" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
								</div>
							<?endif;?>
							<div class="story__author_biography">
								<p class="story__author_name"><?=$arItem["NAME"]?></p>
								<?if (mb_strlen($arItem["PROPERTIES"]["POSITION"]["VALUE"]) > 0):?>
									<p class="story__author_position"><?=$arItem["PROPERTIES"]["POSITION"]["VALUE"]?></p>
								<?endif;?>
							</div>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
	</section>
<?endif;?>