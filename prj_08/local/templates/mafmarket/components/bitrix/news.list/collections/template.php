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
	<div class="row">
		<div class="col-lg-5">
			<aside class="dp-page__aside">
				<div class="dp-aside dp-sticky">
					<div class="h3 dp-aside__title">Коллекции</div>
					<div class="dp-tags">
						<form id="FORM_FILTER_COLLS" action="<?= $arResult['FORM_ACTION']; ?>" method="post" data-container-id="js_list_wrapper">
							<input type="hidden" name="TYPE_FORM" value="COLLS" />
							<ul class="dp-tags__list">
								<?
								foreach ($arResult['ITEMS_ALL'] as $arItem) {
								?>
									<li class="dp-tags__item">
										<input class="js_colls_checkbox" name="colls_<?= $arItem['ID']; ?>" type="checkbox" id="filter_<?= $arItem['ID']; ?>">
										<label class="dp-tag" for="filter_<?= $arItem['ID']; ?>"><span><?= $arItem['NAME']; ?></span></label>
									</li>
								<? } ?>
							</ul>
						</form>
					</div>
				</div>
			</aside>
		</div>
		<div class="col-lg-19">
			<div class="dp-page__body">
				<?/*?>
				<? if (!empty($arResult['PRODUCTS'])) { ?>
					<form id="FORM_FILTER_PRODUCTS" action="<?= $arResult['FORM_ACTION']; ?>" method="post" data-container-id="js_list_wrapper">
						<input type="hidden" name="TYPE_FORM" value="PRODUCTS" />
						<div class="dp-catalog-filter">
							<div class="row">
								<div class="col-sm-12 col-lg-auto">
									<select class="dp-select js_colls_select" name="PRODUCT">
										<?
										$defaultVal = urlencode(serialize(array(false)));
										$defaultVal = 'ALL';
										?>
										<option value="<?= $defaultVal; ?>" selected>Все изделия</option>
										<?
										foreach ($arResult['PRODUCTS'] as $arItem) {
										?>
											<option value="<?= urlencode($arItem['COLLECTIONS']); ?>" data-colls="<?= $arItem['COLLECTIONS']; ?>"><?= $arItem['NAME']; ?></option>
										<? } ?>
									</select>
								</div>
							</div>
						</div>
					</form>
				<? } ?>
				<?*/?>
				<? if (!empty($arResult['SECTIONS'])) { ?>
					<form id="FORM_FILTER_PRODUCTS" action="<?= $arResult['FORM_ACTION']; ?>" method="post" data-container-id="js_list_wrapper">
						<input type="hidden" name="TYPE_FORM" value="PRODUCTS" />
						<div class="dp-catalog-filter">
							<div class="row">
								<div class="col-sm-12 col-lg-auto">
									<select class="dp-select js_colls_select" name="PRODUCT">
										<?
										$defaultVal = urlencode(serialize(array(false)));
										$defaultVal = 'ALL';
										?>
										<option value="<?= $defaultVal; ?>" selected>Все изделия</option>
										<?
										foreach ($arResult['SECTIONS'] as $sId => $arS) {
										?>
											<option value="<?= urlencode($arS['ELS_IDS']); ?>"><?= $arS['NAME']; ?></option>
										<? } ?>
									</select>
								</div>
							</div>
						</div>
					</form>
				<? } ?>

				<section class="dp-section dp-collections" id="js_list_wrapper">
					<input type="hidden" id="IS_FILTER" value="<?= $arParams['IS_FILTER'] ?>" />
					<input type="hidden" id="FILTER_TYPE" value="<?= $arParams['FILTER_TYPE'] ?>" />
					<div class="container">
						<div class="dp-item-list">
							<div class="row js_list_wrapper js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
								<?
								//vardump($_POST);
								//vardump($arResult);
								//vardump($GLOBALS['arrFilterCollections']);
								?>
								<?
								foreach ($arResult["ITEMS"] as $arItem) {
									$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
									$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
								?>
									<div class="col-24" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
										<a class="dp-categories-item" href="<?= $arItem['DETAIL_PAGE_URL']; ?>" id="list_<?= $arItem['ID']; ?>">
											<img class="dp-categories-item__image" src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
											<div class="dp-categories-item__header">
												<h3 class="dp-categories-item__title"><?= $arItem['NAME']; ?></h3>
											</div>
											<? if (
												!empty($arItem['DISPLAY_PROPERTIES']['NEW']['DISPLAY_VALUE'])
												|| !empty($arItem['DISPLAY_PROPERTIES']['YEAR']['DISPLAY_VALUE'])
											) { ?>
												<div class="dp-categories-item__footer">
													<div class="dp-tags">
														<ul class="dp-tags__list dp-tags__list_">
															<? if (!empty($arItem['DISPLAY_PROPERTIES']['NEW']['DISPLAY_VALUE'])) { ?>
																<li class="dp-tags__item">
																	<span class="dp-btn dp-btn_xs"> <span>new</span></span>
																</li>
															<? } ?>
															<? if (!empty($arItem['DISPLAY_PROPERTIES']['YEAR']['DISPLAY_VALUE'])) { ?>
																<li class="dp-tags__item">
																	<span class="dp-btn dp-btn_xs"> <span><?= $arItem['DISPLAY_PROPERTIES']['YEAR']['DISPLAY_VALUE']; ?></span></span>
																</li>
															<? } ?>
														</ul>
													</div>
												</div>
											<? } ?>
										</a>
									</div>
								<? } ?>
							</div>
						</div>
						<?
						//$flag = !empty($arResult["ITEMS"]) && count($arResult["ITEMS"]) > $arParams['NEWS_COUNT'];
						$flag = true;
						?>
						<? if ($flag) { ?>
							<div class="js_more_items <?= "js_nav_string_" . $arResult['NAV_RESULT']->NavNum; ?>">
								<?
								echo $arResult["NAV_STRING"];
								?>
								<?/*?>
								<a class="dp-btn dp-section__link" href="#"><span>Показать еще</span></a>
								<?*/ ?>
							</div>
						<? } ?>
					</div>
				</section>

			</div>
		</div>
	</div>
<? } ?>