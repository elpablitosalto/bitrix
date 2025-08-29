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
$this->setFrameMode(true);
$templateData = array(
	'TEMPLATE_CLASS' => 'bx-' . $arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME'])) {
	$this->addExternalCss($templateData['TEMPLATE_THEME']);
}
?>
<? if (!empty($arResult["ITEMS"])) { ?>
	<div class="catalog__filters" id="catalogFilters">
		<!-- begin .filter-group-->
		<?
		$action = $APPLICATION->GetCurPage();
		?>
		<form class="filter-group js-smart-filter-form" id="catalog-filter-form" name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<?= $action; ?>" method="get">
			<? foreach ($arResult["HIDDEN"] as $arItem) { ?>
				<input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>" value="<? echo $arItem["HTML_VALUE"] ?>" />
			<? } ?>
			<div class="filter-group__main">
				<ul class="filter-group__list">
					<?
					foreach ($arResult["ITEMS"] as $key => $arItem) {
						if (empty($arItem["VALUES"]) || isset($arItem["PRICE"]))
							continue;

						if ($arItem["DISPLAY_TYPE"] == "A" && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0))
							continue;



						//vardump($arItem["VALUES"]);

						if (!empty($arItem["VALUES"])) { ?>
							<li class="filter-group__item">
								<!-- begin .check-filter-->
								<?
								$arCur = current($arItem["VALUES"]);
								?>
								<div class="check-filter">
									<button class="check-filter__trigger js-filter-trigger" type="button"><?= $arItem['NAME'] ?>
									</button>
									<div class="check-filter__dropdown">
										<ul class="check-filter__list">
											<? foreach ($arItem["VALUES"] as $val => $ar) { ?>
												<?
												/*
												if (
													strpos($ar['CONTROL_ID'], "_MIN") !== false
													||
													strpos($ar['CONTROL_ID'], "_MAX") !== false
												) {
													continue;
												}
												*/
												$displayValue = $ar["VALUE"];
												if (substr($displayValue, 0, 1) == '.') {
													$displayValue = substr($displayValue, 1);
												}

												?>
												<li class="check-filter__item">
													<!-- begin .check-elem-->
													<label class="check-elem check-elem_color_neutral">
														<input
															type="checkbox"
															value="<?= $val ?>"
															name="<?= $ar["CONTROL_NAME"] ?>"
															id="<?= $ar["CONTROL_ID"] ?>"
															class="check-elem__input"
															<?= $ar["CHECKED"] ? 'checked="checked"' : '' ?>
															<?= $ar["DISABLED"] ? 'disabled' : '' ?> />
														<span class="check-elem__visual">&nbsp;</span><span class="check-elem__label"><?= $displayValue; ?></span>
													</label>
													<!-- end .ckeck-elem-->
												</li>
											<? } ?>
										</ul>
									</div>
								</div>
								<!-- end .check-filter-->
							</li>
						<? } ?>
					<? } ?>
				</ul>
			</div>
		</form>
		<!-- end .filter-group-->
	</div>
<? } ?>