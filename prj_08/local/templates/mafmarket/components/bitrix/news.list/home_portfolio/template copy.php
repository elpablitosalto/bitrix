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
	<? $APPLICATION->ShowViewContent('SMART_FILTER_PART_2'); ?>
	<section class="dp-section dp-collections">
		<div class="container">
			<div class="dp-item-list">
				<div class="row js_list_wrapper js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
					<?
					foreach ($arResult["ITEMS"] as $arItem) {
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
						<div class="col-24" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<a class="dp-categories-item" href="<?= $arItem['DETAIL_PAGE_URL']; ?>" id="">
								<img class="dp-categories-item__image" src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
								<div class="dp-categories-item__header">
									<h3 class="dp-categories-item__title" style="color: black;"><?= $arItem['NAME']; ?></h3>
								</div>
								<? if (
									!empty($arItem['DISPLAY_PROPERTIES']['OBJECT_TYPE']['DISPLAY_VALUE'])
									|| !empty($arItem['DISPLAY_PROPERTIES']['YEAR']['DISPLAY_VALUE'])
									|| !empty($arItem['DISPLAY_PROPERTIES']['CITY']['DISPLAY_VALUE'])
								) { ?>
									<div class="dp-categories-item__footer">
										<div class="dp-tags">
											<ul class="dp-tags__list dp-tags__list_">
												<?
												if (!empty($arItem['DISPLAY_PROPERTIES']['OBJECT_TYPE']['DISPLAY_VALUE'])) {
													foreach ($arItem['DISPLAY_PROPERTIES']['OBJECT_TYPE']['DISPLAY_VALUE'] as $key => $val) { ?>
														<li class="dp-tags__item">
															<span class="dp-btn dp-btn_xs">
																<span><?= $val; ?></span>
															</span>
														</li>
												<? }
												} ?>
												<? if (!empty($arItem['DISPLAY_PROPERTIES']['YEAR']['DISPLAY_VALUE'])) { ?>
													<li class="dp-tags__item">
														<span class="dp-btn dp-btn_xs"> <span><?= $arItem['DISPLAY_PROPERTIES']['YEAR']['DISPLAY_VALUE']; ?></span></span>
													</li>
												<? } ?>
												<? if (!empty($arItem['DISPLAY_PROPERTIES']['CITY']['DISPLAY_VALUE'])) { ?>
													<li class="dp-tags__item"><span class="dp-btn dp-btn_xs"> <span><?= $arItem['DISPLAY_PROPERTIES']['CITY']['DISPLAY_VALUE']; ?></span></span>
													</li>
												<? } ?>
											</ul>
										</div>
									</div>
								<? } ?>
							</a>
						</div>
					<?
					}
					?>
				</div>
			</div>
			<div class="js_nav_string <?= "js_nav_string_" . $arResult['NAV_RESULT']->NavNum; ?>">
				<?
				echo $arResult["NAV_STRING"];
				?>
				<?/*?>
			<a class="dp-btn dp-section__link" href="#"><span>Показать еще</span></a>
			<?*/ ?>
			</div>
		</div>
	</section>
<? } ?>