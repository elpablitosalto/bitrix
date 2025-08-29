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
	<section class="dp-section dp-designers-persons">
		<div class="container">
			<div class="dp-section__body">
				<div class="dp-item-list">
					<div class="row">
						<?
						$i = 0;
						foreach ($arResult["ITEMS"] as $arItem) {
							$i++;
						?>
							<?
							$bShowTextBlock = false;
							if ($i == 2) {
								$bShowTextBlock = true;
							}
							if ($bShowTextBlock) {
							?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<? $APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/own_design_studio.php"
									)
								); ?>
	<section class="dp-section dp-designers-persons">
		<div class="container">
			<div class="dp-section__body">
				<div class="dp-item-list">
					<div class="row">
					<?
							}
					?>
					<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="col-24" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<div class="dp-designer-item">
							<div class="row">
								<div class="col-sm">
									<div class="dp-designer-item__content">
										<h3 class="dp-designer-item__title"><?= $arItem['NAME']; ?></h3>
										<div class="dp-designer-item__desc">
											<?= $arItem['PREVIEW_TEXT']; ?>
										</div>
										<? if (!empty($arItem['DISPLAY_PROPERTIES']['SERIES']['LINK_ELEMENT_VALUE'])) { ?>
											<div class="dp-designer-item__links">
												<ul class="dp-designer-item__links-list">
													<? foreach ($arItem['DISPLAY_PROPERTIES']['SERIES']['LINK_ELEMENT_VALUE'] as $key => $ar) { ?>
														<li class="dp-designer-item__links-item"><a class="dp-designer-item__link" href="<?=$ar['DETAIL_PAGE_URL'];?>"><?=$ar['NAME'];?></a></li>
													<? } ?>
												</ul>
											</div>
										<? } ?>
									</div>
								</div>
								<div class="col-sm-auto">
									<div class="dp-designer-item__image">
										<picture>
											<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
										</picture>
									</div>
								</div>
							</div>
						</div>
					</div>
				<? } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<? } ?>