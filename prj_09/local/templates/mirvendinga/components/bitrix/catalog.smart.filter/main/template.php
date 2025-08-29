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



<form
	name="<?echo $arResult["FILTER_NAME"]."_form"?>"
	action="<?echo $arResult["FORM_ACTION"]?>"
	method="get"
	data-dim-name="catalog-filters"
	data-dim-scope=".catalog"
	data-dim-class="catalog_filters_open"
	data-dim-status="inactive"
	class="catalog__filters"
>
	<div class="catalog__filter">
		<!-- begin .select-->
		<label class="select">
			<select class="select__input" name="sort" onchange="smartFilter.sort(this)">
				<?
					$sortValue = 'NAME_ASC';
					if(isset($_GET["sort"])) {
						$sortValue = $_GET["sort"];
					}
				?>
				<!-- <option value="" disabled>Сортировка</option> -->
				<option value="NAME_ASC" <?if ($sortValue == "NAME_ASC"):?> selected <?endif;?>>По названию</option>
				<option value="PRICE_ASC" <?if ($sortValue == "PRICE_ASC"):?> selected <?endif;?>>Сначала дешевые</option>
				<option value="PRICE_DESC" <?if ($sortValue == "PRICE_DESC"):?> selected <?endif;?>>Сначала дорогие</option>
			</select>
		</label>
		<!-- end .select-->
	</div>

	<?foreach($arResult["HIDDEN"] as $arItem):?>
		<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
	<?endforeach;?>

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
				?>
					<div class="catalog__filter">
						<div class="filter-panel js-filter-panel">
							<div class="filter-panel__title"><?=$arItem["NAME"]?></div>

							<div class="filter-panel__container">
								<div class="filter-panel__group">
									<div class="filter-panel__item">
										<input
											class="filter-panel__input"
											placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM")?>"
											type="text"
											name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
											size="5"
											onkeyup="smartFilter.keyup(this)"
										/>
									</div>

									<div class="filter-panel__item">
										<input
											class="filter-panel__input"
											placeholder="<?=GetMessage("CT_BCSF_FILTER_TO")?>"
											type="text"
											name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
											size="5"
											onkeyup="smartFilter.keyup(this)"
										/>
									</div>
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
				<!-- <script type="text/javascript">
					BX.ready(function(){
						window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
					});
				</script> -->
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
			?>
			<div class="catalog__filter" data-role="bx_filter_block">
				<?
				$arCur = current($arItem["VALUES"]);
				$checkedItemExist = false;
				?>
				<!-- begin .select-->
				<label class="select js-select">
					<select class="select__input" onchange="smartFilter.change(this)">
						<option value="" selected><? echo $arItem["NAME"]?></option>
						<?foreach ($arItem["VALUES"] as $val => $ar):?>
							<option value="<? echo $ar["HTML_VALUE"] ?>" data-name="<? echo $ar["CONTROL_NAME"] ?>" <? echo $ar["CHECKED"]? 'selected': '' ?>><?=$ar["VALUE"]?></option>
						<?endforeach?>
					</select>
				</label>
				<!-- end .select-->
			</div>
		<?
		}
		?>
</form>

<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>