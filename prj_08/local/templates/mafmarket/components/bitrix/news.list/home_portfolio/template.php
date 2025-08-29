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
	<div class="col-lg-16">
		<div class="dp-section__body">
			<div class="dp-item-list">
				<div class="row">
					<?
					foreach ($arResult["ITEMS"] as $arItem) {
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
						<div class="col-24" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<a class="dp-categories-item mobile-lg" href="<?= $arItem['DETAIL_PAGE_URL']; ?>" id="">
								<img class="dp-categories-item__image" src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
								<div class="dp-categories-item__header">
									<h3 class="dp-categories-item__title"><?= $arItem['NAME']; ?></h3>
								</div>
								<div class="dp-categories-item__footer">
								</div>
							</a>
						</div>
					<? } ?>

				</div>
			</div>
			<a class="dp-btn dp-section__link" href="/portfolio/">
				<span>Все проекты</span>
				<svg class="icon icon-drop-right ">
					<use xlink:href="#drop-right"></use>
				</svg>
			</a>
		</div>
	</div>
<? } ?>