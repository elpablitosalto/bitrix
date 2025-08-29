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
$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

if (!empty($arResult['SECTIONS'])) {
?>
	<div class="dp-section__body">
		<div class="dp-item-list">
			<? foreach ($arResult['SECTIONS'] as $sectId => $arSection) { ?>
				<?
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
				?>
				<a class="dp-categories-item" href="<?= $arSection['SECTION_PAGE_URL']; ?>" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
					<img class="dp-categories-item__image" src="<?= $arSection['DETAIL_PICTURE']['SRC']; ?>" alt="<?= $arSection['DETAIL_PICTURE']['ALT']; ?>" title="<?= $arSection['DETAIL_PICTURE']['TITLE']; ?>" />
					<div class="dp-categories-item__header">
						<h3 class="dp-categories-item__title"><?= $arSection['NAME'] ?></h3>
					</div>
					<div class="dp-categories-item__footer">
					</div>
				</a>
			<? } ?>
		</div>
		<div class="dp-categories-buttons">
			<ul class="dp-categories-buttons__list">
				<? foreach ($arResult['SECTIONS'] as $sectId => $arSection) { ?>
					<?
					$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
					$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
					?>
					<li class="dp-categories-buttons__item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
						<a class="dp-categories-buttons__link" href="#">
							<img class="dp-categories-buttons__icon" src="<?= $arSection['PICTURE']['SRC']; ?>" alt="<?= $arSection['PICTURE']['ALT']; ?>" title="<?= $arSection['PICTURE']['TITLE']; ?>" />
							<?= $arSection['NAME'] ?>
						</a>
					</li>
				<? } ?>
			</ul>
		</div>
	</div>
<? } ?>