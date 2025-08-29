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
	<section class="supplies">
		<div class="title-section">
			<h2>Мы специализируемся на <span>объектных поставках</span> материалов
			</h2>
		</div>
		<div class="supplies__wrapper">
			<div class="supplies__slider">
				<div class="supplies__slider_wrapper">
					<?foreach($arResult["ITEMS"] as $arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<div class="supplies__slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<?if (isset($arItem["PREVIEW_PICTURE"]["SRC"])):?>
								<div class="supplies__image">
									<img loading="lazy" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
								</div>
							<?endif;?>
							<div class="supplies__examples">
								<p class="supplies__title"><?=$arItem["NAME"]?></p>
								<?if (
									is_array($arItem['DISPLAY_PROPERTIES']['MATERIALS']['LINK_ELEMENT_VALUE'])
									&& count($arItem['DISPLAY_PROPERTIES']['MATERIALS']['LINK_ELEMENT_VALUE']) > 0
								):?>
									<div class="supplies__content">
										<p>Материалы:</p>
										<ul class="supplies__list">
											<?foreach($arItem['DISPLAY_PROPERTIES']['MATERIALS']['LINK_ELEMENT_VALUE'] as $arMaterial):?>
												<li class="supplies__item"><a href="<?=$arMaterial['DETAIL_PAGE_URL']?>"><?=$arMaterial['NAME']?></a></li>
											<?endforeach;?>
										</ul>
									</div>
								<?endif;?>
								<?if (mb_strlen($arItem["PREVIEW_TEXT"]) > 0):?>
									<div class="supplies__content">
										<p>Работы:</p>
										<ul class="supplies__list">
											<li class="supplies__item"><?=$arItem["PREVIEW_TEXT"]?></li>
										</ul>
									</div>
								<?endif;?>
							</div>
						</div>
					<?endforeach;?>
				</div>
				<div class="supplies__control">
					<div class="button-arrow button-arrow_left supplies__prev"></div>
					<div class="button-arrow button-arrow_right supplies__next"></div>
				</div>
			</div>
		</div>
	</section>
<?endif;?>