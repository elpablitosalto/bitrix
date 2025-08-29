<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

use Bitrix\Iblock\SectionPropertyTable;

$this->setFrameMode(true);

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/colors.css',
	'TEMPLATE_CLASS' => 'bx-' . $arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME'])) {
	$this->addExternalCss($templateData['TEMPLATE_THEME']);
}
//$this->addExternalCss("/bitrix/css/main/bootstrap.css");
//$this->addExternalCss("/bitrix/css/main/font-awesome.css");
?>
<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get" class="smartfilter">
	<? foreach ($arResult["HIDDEN"] as $arItem) : ?>
		<input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>" value="<? echo $arItem["HTML_VALUE"] ?>" />
	<? endforeach; ?>
	<ul class="dp-tags__list">
		<?/*?>
		<li class="dp-tags__item">
			<label class="dp-btn dp-btn_xs dp-btn_white js-toggle-all-checkboxes"><span>Все</span></label>
		</li>
		<?*/?>
		<?
		//not prices
		foreach ($arResult["ITEMS"] as $key => $arItem) {
			if (
				empty($arItem["VALUES"])
				|| isset($arItem["PRICE"])
				//|| !in_array($arItem['CODE'], $arParams['SHOW_CODES'])
			)
				continue;

			if (
				$arItem["DISPLAY_TYPE"] === SectionPropertyTable::NUMBERS_WITH_SLIDER
				&& ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
			)
				continue;
		?>
			<?
			$arCur = current($arItem["VALUES"]);
			switch ($arItem["DISPLAY_TYPE"]) {
				
				default: //CHECKBOXES
					$display = false;
					if (is_array($arParams['SHOW_CODES'])) {
						if (in_array($arItem["CODE"], $arParams['SHOW_CODES'])) {
							$display = true;
						}
					}
					$style = '';
					if ($display == false) {
						$style = ' style="display: none;"';
					}
				?>
					<? /*if ($display == false) { ?>
						<div>
						<? } */?>
						<? foreach ($arItem["VALUES"] as $val => $ar) { ?>
							<li class="dp-tags__item" <?=$style?>>
								<input type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>" name="<? echo $ar["CONTROL_NAME"] ?>" id="<? echo $ar["CONTROL_ID"] ?>" <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?> onclick="smartFilter.click(this)" />
								<label class="dp-btn dp-btn_xs dp-btn_white" for="<? echo $ar["CONTROL_ID"] ?>"><span><?= $ar["VALUE"]; ?></span></label>
							</li>
						<? } ?>
						<?/* if ($display == false) { ?>
						</div>
					<? } */?>


					<?/*?>
					<? foreach ($arItem["VALUES"] as $val => $ar) : ?>
						<div class="checkbox">
							<label data-role="label_<?= $ar["CONTROL_ID"] ?>" class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled' : '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">
								<span class="bx-filter-input-checkbox">
									<input type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>" name="<? echo $ar["CONTROL_NAME"] ?>" id="<? echo $ar["CONTROL_ID"] ?>" <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?> onclick="smartFilter.click(this)" />
									<span class="bx-filter-param-text" title="<?= $ar["VALUE"]; ?>"><?= $ar["VALUE"]; ?><?
																														if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])) :
																														?>&nbsp;(<span data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
																																																						endif; ?></span>
								</span>
							</label>
						</div>
					<? endforeach; ?>
					<?*/ ?>

					<?/*?>
					<div class="col-xs-12">
						<? foreach ($arItem["VALUES"] as $val => $ar) : ?>
							<div class="checkbox">
								<label data-role="label_<?= $ar["CONTROL_ID"] ?>" class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled' : '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">
									<span class="bx-filter-input-checkbox">
										<input type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>" name="<? echo $ar["CONTROL_NAME"] ?>" id="<? echo $ar["CONTROL_ID"] ?>" <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?> onclick="smartFilter.click(this)" />
										<span class="bx-filter-param-text" title="<?= $ar["VALUE"]; ?>"><?= $ar["VALUE"]; ?><?
																															if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])) :
																															?>&nbsp;(<span data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
																																																							endif; ?></span>
									</span>
								</label>
							</div>
						<? endforeach; ?>
					</div>
					<?*/ ?>
			<?
			}
			?>
		<?
		}
		?>
	</ul>

	<div class="row" style="display: none;">
		<div class="col-xs-12 bx-filter-button-box">
			<div class="bx-filter-block">
				<div class="bx-filter-parameters-box-container">
					<input class="btn btn-themes" type="submit" id="set_filter" name="set_filter" value="<?= GetMessage("CT_BCSF_SET_FILTER") ?>" />
					<input class="btn btn-link" type="submit" id="del_filter" name="del_filter" value="<?= GetMessage("CT_BCSF_DEL_FILTER") ?>" />
					<div class="bx-filter-popup-result <? if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"] ?>" id="modef" <? if (!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"'; ?> style="display: inline-block;">
						<? echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">' . (int)($arResult["ELEMENT_COUNT"] ?? 0) . '</span>')); ?>
						<span class="arrow"></span>
						<br />
						<a href="<? echo $arResult["FILTER_URL"] ?>" target=""><? echo GetMessage("CT_BCSF_FILTER_SHOW") ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?/**/ ?>
	<div class="clb"></div>
	<?
	$ar_params = array(
		'VALUE' => 'Y',
		'NAME' => 'NAME',
		'ID' => 'checkbox_start_filter',
		'CHECKED' => 'CHECKED',
	);
	?>
	<input style="display: none;" type="checkbox" value="<? echo $ar_params["VALUE"] ?>" name="<? echo $ar_params["NAME"] ?>" id="<? echo $ar_params["ID"] ?>" <? echo $ar_params["CHECKED"] ? 'checked="checked"' : '' ?> onclick="smartFilter.click(this)" />
	<input type="hidden" id="js_run_filter" value="N" />
</form>
<?
$this->SetViewTarget('SMART_FILTER_PART_2');
?>
<div class="dp-catalog-filter">
	<div class="row">
		<?
		//vardump($arResult);
		foreach ($arResult["ITEMS"] as $key => $arItem) {
			if (
				empty($arItem["VALUES"])
				|| isset($arItem["PRICE"])
				//|| !in_array($arItem['CODE'], $arParams['SHOW_CODES'])
			)
				continue;

			if (
				$arItem["DISPLAY_TYPE"] === SectionPropertyTable::NUMBERS_WITH_SLIDER
				&& ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
			)
				continue;
		?>
			<?
			$arCur = current($arItem["VALUES"]);
			switch ($arItem["DISPLAY_TYPE"]) {
				case SectionPropertyTable::DROPDOWN: //DROPDOWN
			?>
					<? if (!empty($arItem["VALUES"])) { ?>
						<?
						//vardump($arResult['IBLOCK_PROPS'][$arItem['ID']]);	
						$multiple_class = '';
						$multiple = '';
						$js_class = 'js_select_filter';
						$str = '';
						$default_option_class = 'not_multiple';
						$all_title = 'Все';
						if ($arResult['IBLOCK_PROPS'][$arItem['ID']]['MULTIPLE'] == 'Y') {
							$multiple_class = 'dp-select-multiple';
							$multiple = 'multiple';
							$js_class = 'js_select_filter_multiple';
							$str = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							$default_option_class = 'multiple';
							$all_title = 'Все';
						}
						?>
						<div class="col-sm-auto">
							<select class="dp-select <?= $multiple_class; ?> <?= $js_class; ?>" <?= $multiple; ?>>
								<option data-title="<?=$all_title?>" class="default <?=$default_option_class?>" value="0"><?= $arItem['NAME'] ?><?= $str; ?></option>
								<? foreach ($arItem["VALUES"] as $val => $ar) { ?>
									<option value="<? echo $ar["CONTROL_ID"] ?>" <? echo $ar["CHECKED"] ? 'selected="selected"' : '' ?>><?= $ar["VALUE"]; ?></option>
								<? } ?>
							</select>
						</div>
					<? } ?>
					<?
					break;
				default: //CHECKBOXES
					if (is_array($arItem["VALUES"])) {
						if (count($arItem["VALUES"]) == 1) { ?>
							<div class="col-sm-24 col-lg-auto"><!-- С индивидуальными решениями -->
								<? foreach ($arItem["VALUES"] as $val => $ar) { ?>
									<label class="dp-switch">
										<input data-id="<? echo $ar["CONTROL_ID"] ?>" type="checkbox" class="dp-switch__input js_checkbox_filter" value="<? echo $ar["HTML_VALUE"] ?>" <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?> />
										<div class="dp-switch__icon"></div>
										<div class="dp-switch__value"><?= $arItem['NAME'] ?></div>
									</label>
								<? } ?>
							</div>
						<? } ?>
					<? } ?>
			<?
			}
			?>
		<?
		}
		?>
	</div>
</div>
<?
$this->EndViewTarget();
?>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<? echo CUtil::JSEscape($arResult["FORM_ACTION"]) ?>', '<?= CUtil::JSEscape($arParams["FILTER_VIEW_MODE"]) ?>', <?= CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"]) ?>);
</script>