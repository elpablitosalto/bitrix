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
?>
<div id="ContentSections-BigTeaser" class="contentSectionArea">
	<div id="cs-411" class="contentSection editionenTeaser noparallax ">
		<div class="csContent responsiveBlock">
			<div class="blockContent"></div>
		</div>
		<div id="EditionenTeaserWrap">
			<h2 class="centered">Tools</h2>
			<div id="EditionenTeaser">
				<? foreach ($arResult["ITEMS"] as $arItem) { ?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="editionenTeaser" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<a href="<?= $arItem["DISPLAY_PROPERTIES"]['URL']['VALUE'] ?>" title="<?= $arItem['NAME']; ?>" target="_blank" rel="noopener">
							<img class="image" loading="lazy" src="<?= $arItem['PICTURE']['SRC']; ?>" width="<?= $arItem['PICTURE']['WIDTH']; ?>" height="<?= $arItem['PICTURE']['HEIGHT']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?> " title="<?= $arItem['PICTURE']['TITLE']; ?>" style="object-position: 50% 50%;" />
							<div class="titleBlock">
								<div class="title "><?= $arItem['NAME']; ?></div>
							</div>
						</a>
					</div>
				<? } ?>
			</div>
		</div>
	</div>
</div>