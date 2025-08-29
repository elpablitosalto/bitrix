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

//vardump($arResult);

if (!empty($arResult["ITEMS"])) {
?>
	<section class="dp-section">
		<div class="container">
			<div class="dp-section__body">
				<div class="dp-sort">
					<select class="dp-sort-select js_sort_list" name="sort">
						<option value="DATE_CREATE:DESC" <? if ($arParams['SORT_BY1'] == 'DATE_CREATE') {
																echo 'selected';
															} ?>>Новые</option>
						<option value="PROPERTY_POPULARITY:DESC" <? if ($arParams['SORT_BY1'] == 'PROPERTY_POPULARITY') {
																		echo 'selected';
																	} ?>>Популярные</option>
						<option value="PROPERTY_RAITING:DESC" <? if ($arParams['SORT_BY1'] == 'PROPERTY_RAITING') {
																	echo 'selected';
																} ?>>С высоким рейтингом</option>
					</select>
				</div>
				<div class="dp-item-list dp-item-list-reviews">
					<div class="row js_list_wrapper js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>" id="">
						<?
						//echo 'SORT_BY1 = '.$arParams['SORT_BY1'].'<br />';
						//echo 'SORT_ORDER1 = '.$arParams['SORT_ORDER1'].'<br />';
						?>
						<?
						foreach ($arResult["ITEMS"] as $arItem) { ?>
							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<div class="col-md-6 nb-col-review" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<div class="dp-review">
									<div class="dp-review__inner">
										<div class="dp-review__img">
											<img class="videoTeaserImage" src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
										</div>
										<div class="dp-review__caption">
											<p class="dp-review__name"><?= $arItem['NAME']; ?></p>
											<p class="dp-review__city"><?= $arItem['DISPLAY_PROPERTIES']['CITY']['VALUE']; ?></p>
											<div class="dp-review__desc"><?= $arItem['PREVIEW_TEXT']; ?></div>
											<button class="dp-review__more" type="button"></button>
										</div>
									</div>
								</div>
							</div>
						<?
						}
						?>
					</div>
				</div>
			</div>
			<?
			//vardump($arResult['NAV_RESULT']);
			//$navNum = $arResult["NavNum"];
			$navNum = $arResult['NAV_RESULT']->NavNum;
			//vardump($arResult);
			?>
			<div class="dp-section__footer js_nav_string <?= "js_nav_string_" . $navNum; ?>">
				<?
				echo $arResult["NAV_STRING"];
				?>
			</div>
		</div>
	</section>
<? } ?>