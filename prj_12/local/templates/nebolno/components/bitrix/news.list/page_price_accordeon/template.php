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
<?if (count($arResult['ITEMS']) > 0):?>
	<section class="nb-section nb-price-table-section">
		<div class="container">
			<div class="nb-section__header">
				<h2 class="nb-section__title">Цены на услуги <span class="font-weight_normal">В КЛИНИКЕ «БЕЛЫЙ КРОЛИК»</span>
				</h2>
			</div>
			<div class="nb-section__body">
				<ul class="nb-price-list">
					<?
					$index = 0;
					?>
					<?foreach($arResult['ACCORDEON_DATA'] as $arAccordeonData):?>
						<li class="nb-price-item<?if ($index == 0):?> nb-price-item_opened<?endif;?>">
							<div class="nb-price-item__header">
								<p class="nb-price-item__title"><?=$arAccordeonData['NAME']?></p>
							</div>
							<div class="nb-price-item__body">
								<div class="nb-price-table">
									<?foreach($arResult['ITEMS'][$arAccordeonData['ID']] as $key => $arItem):?>
										<?
										$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
										$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

										$rowColorCode = '';
										if ((mb_strlen($arItem['PROPERTIES']['PRICE_OLD']['VALUE']) > 0))
											$rowColorCode = 'pink';

										if ($arItem['PROPERTIES']['SHOW_PRICE_FROM']['VALUE_XML_ID'] == "Y")
											$rowColorCode = 'green';
										?>
										<div class="nb-price-table__row<?if (mb_strlen($rowColorCode) > 0):?> nb-price-table__row_<?=$rowColorCode?><?endif;?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
											<div class="nb-price-table__icon">
												<?if ($rowColorCode == 'green'):?>
													<svg class="icon icon-right-arrow">
														<use xlink:href="#right-arrow"></use>
													</svg>
												<?elseif ($rowColorCode == 'pink'):?>
													<svg class="icon icon-thumbs-up ">
														<use xlink:href="#thumbs-up"></use>
													</svg>
												<?endif;?>
											</div>
											<div class="nb-price-table__service">
												<p class="nb-price-table__title">
													<?if (mb_strlen($arItem['PROPERTIES']['NAME_ALT']['VALUE']) > 0):?>
														<?=$arItem['PROPERTIES']['NAME_ALT']['VALUE']?>
													<?else:?>
														<?=$arItem['NAME']?>
													<?endif;?>
												</p>
												<?if (mb_strlen($arItem['PREVIEW_TEXT']) > 0):?>
													<p class="nb-price-table__details"><?=$arItem['PREVIEW_TEXT']?></p>
												<?endif;?>
											</div>
											<div class="nb-price-table__price">
												<?if (mb_strlen($arItem['PROPERTIES']['PRICE_OLD']['VALUE']) > 0):?>
													<span class="nb-price-table__price-old"><?=Indexis::getPriceFormatted($arItem['PROPERTIES']['PRICE_OLD']['VALUE'], 'RUB', $arItem['PROPERTIES']['SHOW_PRICE_FROM']['VALUE_XML_ID'])?></span>
												<?endif;?>
												<span class="nb-price-table__price-current"><?=Indexis::getPriceFormatted($arItem['PROPERTIES']['PRICE']['VALUE'], 'RUB', $arItem['PROPERTIES']['SHOW_PRICE_FROM']['VALUE_XML_ID'])?></span>
											</div>
										</div>
									<?endforeach;?>
								</div>
							</div>
						</li>
						<?
						$index++;
						?>
					<?endforeach;?>
				</ul>
				<div class="nb-price-note">
					<p class="nb-price-note__text">Цены на услуги носят информационный характер. Получить точную стоимость, учитывая весь необходимый план работ вы сможете только на консультации.</p>
				</div>
			</div>
		</div>
	</section>
<?endif;?>