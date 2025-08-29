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
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/colors.css',
	'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME']))
{
	$this->addExternalCss($templateData['TEMPLATE_THEME']);
}
?>
<div class="catalog-filters catalog__filters">
	<div class="catalog-filters__wrapper">
		<div class="catalog-filters__header">
			<button type="button" data-toggle-scope=".catalog, .page__body" data-toggle-class="catalog_filters_open, frozen-scroll" class="catalog-filters__close js-toggle">
				Закрыть фильтр
			</button>
			<div class="catalog-filters__title">
				<!-- begin .title-->
				<h2 class="title title_size_h1">Фильтры</h2>
				<!-- end .title-->
			</div>
			<div class="catalog-filters__subtitle">Выберите параметры:</div>
		</div>
		<div class="bx-filter catalog-filters__list">
			<div class="bx-filter-section">


				<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
					<?foreach($arResult["HIDDEN"] as $arItem):?>
					<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
					<?endforeach;?>
					<?$controlsShouldBeShown = false;?>
					<div class="catalog-filters__list">
						<?foreach($arResult["ITEMS"] as $key=>$arItem)//prices
						{
							$key = $arItem["ENCODED_ID"];
							if(isset($arItem["PRICE"])):
								if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
									continue;

								$step_num = 4;
								$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
								$prices = array();
								if (Bitrix\Main\Loader::includeModule("currency"))
								{
									for ($i = 0; $i < $step_num; $i++)
									{
										$prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
									}
									$prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
								}
								else
								{
									$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
									for ($i = 0; $i < $step_num; $i++)
									{
										$prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $precision, ".", "");
									}
									$prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
								}
								$controlsShouldBeShown = true;
								?>
								<div class="bx-filter-parameters-box catalog-filters__item catalog-filters__item_type_<?=(strtolower($arItem['CODE']))?>">
									<span class="bx-filter-container-modef"></span>

									<div class="catalog-filter catalog-filter_state_open">
										<div class="catalog-filter__header">
												<button
														type="button"
														data-toggle-scope=".catalog-filter"
														data-toggle-class="catalog-filter_state_open"
														class="catalog-filter__trigger js-toggle"
												>Цена</button>
										</div>
										<div class="catalog-filter__body">
												<div class="catalog-filter__range">
														<!-- begin .range-->
														<div
																class="range js-range"
																data-start="<?=(floatval(($arItem["VALUES"]["MIN"]["HTML_VALUE"] ? $arItem["VALUES"]["MIN"]["HTML_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"])))?>"
																data-stop="<?=(floatval(($arItem["VALUES"]["MAX"]["HTML_VALUE"] ? $arItem["VALUES"]["MAX"]["HTML_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"])))?>"
																data-min="<?=(floatval($arItem["VALUES"]["MIN"]["VALUE"]))?>"
																data-max="<?=(floatval($arItem["VALUES"]["MAX"]["VALUE"]))?>"
														>
																<div class="range__fields">
																	<label class="range__field">
																		<span class="range__label">От</span>
																		<input
																			class="range__input range__input_type_from min-price"
																			type="text"
																			name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
																			id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
																			value="<?=(floatval(($arItem["VALUES"]["MIN"]["HTML_VALUE"] ? $arItem["VALUES"]["MIN"]["HTML_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"])))?>"
																			size="5"
																			onkeyup="smartFilter.keyup(this)"
																		/>
																		<input
																			class="range__input range__input_type_visual-from"
																			type="text"
																			value="<?=(floatval(($arItem["VALUES"]["MIN"]["HTML_VALUE"] ? $arItem["VALUES"]["MIN"]["HTML_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"])))?>"
																			size="5"
																			onkeyup="smartFilter.keyup(this)"
																		/>
																	</label>
																	<div class="range__separator">-</div>
																	<label class="range__field">
																		<span class="range__label">До</span>
																		<input
																			class="range__input range__input_type_to max-price"
																			type="text"
																			name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
																			id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
																			value="<?=(floatval(($arItem["VALUES"]["MAX"]["HTML_VALUE"] ? $arItem["VALUES"]["MAX"]["HTML_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"])))?>"
																			size="5"
																			onkeyup="smartFilter.keyup(this)"
																		/>
																		<input
																			class="range__input range__input_type_visual-to"
																			type="text"
																			value="<?=(floatval(($arItem["VALUES"]["MAX"]["HTML_VALUE"] ? $arItem["VALUES"]["MAX"]["HTML_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"])))?>"
																			size="5"
																			onkeyup="smartFilter.keyup(this)"
																		/>
																	</label>
																</div>

																<div class="range__slider"></div>
															</div>
														<!-- end .range-->
												</div>
											</div>
										</div>
								</div>
								<?
								$arJsParams = array(
									"leftSlider" => 'left_slider_'.$key,
									"rightSlider" => 'right_slider_'.$key,
									"tracker" => "drag_tracker_".$key,
									"trackerWrap" => "drag_track_".$key,
									"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
									"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
									"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
									"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
									"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
									"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
									"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
									"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
									"precision" => $precision,
									"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
									"colorAvailableActive" => 'colorAvailableActive_'.$key,
									"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
								);
								?>
								<script type="text/javascript">
									BX.ready(function(){
										window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
									});
								</script>
							<?endif;
						}

						//not prices
						foreach($arResult["ITEMS"] as $key=>$arItem)
						{
							if(
								empty($arItem["VALUES"])
								|| isset($arItem["PRICE"])
							)
								continue;

							if (
								$arItem["DISPLAY_TYPE"] == "A"
								&& (
									$arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
								)
							)
								continue;
							$controlsShouldBeShown = true;
							?>
							<div class="bx-filter-parameters-box catalog-filters__item catalog-filters__item_type_<?=(strtolower($arItem['CODE']))?>">

								<div class="catalog-filter catalog-filter_state_open">
									<div class="catalog-filter__header">
										<button type="button" data-toggle-scope=".catalog-filter" data-toggle-class="catalog-filter_state_open" class="catalog-filter__trigger js-toggle">
												<?=$arItem["NAME"]?>
										</button>
									</div>
									<div class="catalog-filter__body">
										<div class="catalog-filter__check-group">
											<?foreach($arItem["VALUES"] as $val => $ar):?>
												<div class="catalog-filter__check-item">
													<div class="check-elem">
														<input
															type="checkbox"
															value="<? echo $ar["HTML_VALUE"] ?>"
															name="<? echo $ar["CONTROL_NAME"] ?>"
															id="<? echo $ar["CONTROL_ID"] ?>"
															<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
															onclick="smartFilter.click(this)"
															class="check-elem__input"
														/>
														<label for="<? echo $ar["CONTROL_ID"] ?>" class="check-elem__label"><?=$ar["VALUE"];?></label>

													</div>
												</div>
											<?endforeach;?>
										</div>
									</div>
								</div>
							</div>
						<?
						}
						?>
					</div><!--//row-->
					<?if($controlsShouldBeShown):?>
						<div class="catalog-filters__controls">
							<div class="catalog-filters__numbers" id="modef" style="display: none">
								Показать&nbsp;<span id="modef_num"><?=intval($arResult["ELEMENT_COUNT"])?></span>
							</div>
							<?/*?>
							<div class="catalog-filters__control" id="modef">
								<a href="<?echo $arResult["FILTER_URL"]?>" class="button button_width_full">
									<span class="button__holder">
										Показать&nbsp;(<span id="modef_num"><?=intval($arResult["ELEMENT_COUNT"])?></span>)
									</span>
								</a>
							</div>
							<?*/?>
							<div class="catalog-filters__control">
								<button
									id="filter_submit_button"
									class="button button_width_full button_size_s button_style_outline"
									type="submit"
									name="set_filter"
									disabled
								>
									<span class="button__holder">Применить</span>
								</button>
							</div>
							<div class="catalog-filters__control">
								<a
									href="<?=parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)?>"
									class="button button_width_full button_size_s button_style_light"
									type="submit"
								>
									<span class="button__holder">Сбросить</span>
								</a>
							</div>
						</div>
					<?endif;?>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>