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

//vardump($arResult["ITEMS"]);

if (!empty($arResult["ITEMS"])) {
?>
	<?
	foreach ($arResult["ITEMS"] as $arItem) {
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<section class="dp-section dp-services-slider" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="container">
				<div class="dp-section__header">
					<div class="dp-section__subtitle"><?= $arItem['DISPLAY_PROPERTIES']['SECTION_HEADER']['DISPLAY_VALUE']; ?></div>
					<h2 class="dp-section__title"><?= $arItem['DISPLAY_PROPERTIES']['H_1']['DISPLAY_VALUE']; ?> <span class="color_blue"><?= $arItem['DISPLAY_PROPERTIES']['H_2']['DISPLAY_VALUE']; ?></span></h2>
					<div class="dp-section__desc">
						<?= $arItem['PREVIEW_TEXT']; ?>
					</div>
					<a class="dp-btn dp-section__link" href="<?= $arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']; ?>">
						<span><?= $arItem['DISPLAY_PROPERTIES']['LINK_TEXT']['DISPLAY_VALUE']; ?></span>
						<svg class="icon icon-drop-right ">
							<use xlink:href="#drop-right"></use>
						</svg>
					</a>
				</div>
				<?
				//vardump($arItem["DISPLAY_PROPERTIES"]["BANNERS"]);
				?>
				<? if (!empty($arItem["DISPLAY_PROPERTIES"]["BANNERS"]["VALUE"])) { ?>
					<div class="dp-section__body">
						<div class="dp-item-list">
							<? foreach ($arItem["DISPLAY_PROPERTIES"]["BANNERS"]["VALUE"] as $key => $val) { ?>
								<?
								$backGroundClass = '';
								if (!empty($val['SUB_VALUES']['B_BACKGROUND']['VALUE_XML_ID'])) {
									$str = $val['SUB_VALUES']['B_BACKGROUND']['VALUE_XML_ID'];
									switch ($str) {
										case 'blue':
											$backGroundClass = 'bg-blue';
											break;
										case 'white':
											$backGroundClass = 'bg-white';
											break;
									}
								}
								$imgClass = '';
								if (!empty($val['SUB_VALUES']['TYPE_SHOW']['VALUE_XML_ID'])) {
									$str = $val['SUB_VALUES']['TYPE_SHOW']['VALUE_XML_ID'];
									switch ($str) {
										case 'ALL':
											$imgClass = 'dp-services-item__bgimage';
											break;
										case 'INSIDE':
											$imgClass = '';
											break;
									}
								}
								?>
								<div class="dp-services-item <?= $backGroundClass; ?>">
									<? if (!empty($val['SUB_VALUES']['B_HEADER']['VALUE'])) { ?>
										<div class="dp-services-item__header">
											<h3 class="dp-services-item__title"><?= $val['SUB_VALUES']['B_HEADER']['VALUE']; ?></h3>
											<? if (!empty($val['SUB_VALUES']['B_SUBHEADER']['VALUE'])) { ?>
												<div class="dp-services-item__subtitle"><?= $val['SUB_VALUES']['B_SUBHEADER']['VALUE']; ?></div>
											<? } ?>
										</div>
									<? } ?>
									<picture class="dp-services-item__image">
										<img class="<?=$imgClass;?>" src="<?= $val['PICTURE']['SRC']; ?>" alt="<?= $val['PICTURE']['ALT']; ?>" title="<?= $val['PICTURE']['TITLE']; ?>" />
									</picture>
								</div>
							<? } ?>
							<?/*?>
							<div class="dp-services-item bg-white">
								<picture class="dp-services-item__image">
									<img src="<?= SITE_TEMPLATE_PATH ?>/img/content/home/22.jpg">
								</picture>
							</div>
							<div class="dp-services-item">
								<img class="dp-services-item__bgimage" src="<?= SITE_TEMPLATE_PATH ?>/img/content/home/23.jpg">
							</div>
							<?*/ ?>
						</div>
					</div>
				<? } ?>
			</div>
		</section>
	<? } ?>
<? } ?>