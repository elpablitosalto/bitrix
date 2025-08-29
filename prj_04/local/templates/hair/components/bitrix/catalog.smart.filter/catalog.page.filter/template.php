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
$templateData = array(
	'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME']))
{
	$this->addExternalCss($templateData['TEMPLATE_THEME']);
}

?>
<form id="catalog-filter-form" name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="/local/ajax/catalog/catalogFilter.php" method="get" class="smart-filter-form">
	<div class="catalog-filter">
		<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
		<?endforeach;?>
		<?
		foreach($arResult["ITEMS"] as $key=>$arItem):
			if (empty($arItem["VALUES"]) || isset($arItem["PRICE"]))
				continue;

			if ($arItem["DISPLAY_TYPE"] == "A" && ( $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0))
				continue;

			?>
			<div class="catalog-filter__item">
				<div class="catalog-filter__item--selected-value"><?=$arItem['NAME']?></div>
				<?
				$arCur = current($arItem["VALUES"]);
				switch ($arItem["DISPLAY_TYPE"])
				{
					//region RADIO_BUTTONS
					case "K":
						?>
						<div class="col">
							<div class="radio">
								<label class="smart-filter-param-label" for="<? echo "all_".$arCur["CONTROL_ID"] ?>">
									<span class="smart-filter-input-checkbox">
										<input
											type="radio"
											value=""
											name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
											id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
											onclick="smartFilter.click(this)"
										/>
										<span class="smart-filter-param-text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
									</span>
								</label>
							</div>
							<?foreach($arItem["VALUES"] as $val => $ar):?>
								<div class="radio">
									<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="smart-filter-param-label" for="<? echo $ar["CONTROL_ID"] ?>">
										<span class="smart-filter-input-checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
											<input
												type="radio"
												value="<? echo $ar["HTML_VALUE_ALT"] ?>"
												name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
												id="<? echo $ar["CONTROL_ID"] ?>"
												<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
												onclick="smartFilter.click(this)"
											/>
											<span class="smart-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
											if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
												?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
											endif;?></span>
										</span>
									</label>
								</div>
							<?endforeach;?>
						</div>
						<div class="w-100"></div>
						<?
						break;

					//endregion

					//region CHECKBOXES +
					default:
						?>
					<div class="catalog-filter__item-dropdown">
						<div class="catalog-filter__item-dropdown--wrapper">
							<?foreach($arItem["VALUES"] as $val => $ar):?>
								<?if($val == 'MIN' || $val == 'MAX') continue;?>
								<div class="catalog-filter__item--checkbox">
									<input
										type="checkbox"
										value="<?=$val ?>"
										name="<?=$ar["CONTROL_NAME"] ?>"
										id="<?=$ar["CONTROL_ID"] ?>"
										class="form-check-input"
										<?=$ar["CHECKED"]? 'checked="checked"': '' ?>
										<?=$ar["DISABLED"] ? 'disabled': '' ?>
									/>
									<label class="catalog-filter__item--checkbox-value" for="<?=$ar["CONTROL_ID"] ?>"><?=$ar["VALUE"];?></label>
								</div>
							<?endforeach;?>
						</div>
					</div>
				<?
					//endregion
				}
				?>
			</div>
		<?endforeach;?>
	</div>
</form>