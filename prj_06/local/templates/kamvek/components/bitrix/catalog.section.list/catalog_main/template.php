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
if (!empty($arResult['SECTIONS'])) {
?>
	<div class="respBlock">
		<div id="BigBlocks" class="bigBlocks">
			<?
			foreach ($arResult['SECTIONS'] as &$arSection) {
				if (!empty($arSection['EDIT_ID'])) {
					$editId = $arSection['EDIT_ID'];
					$arItem = $arSection['EDIT_ITEM'];
					//$this->AddAddAction($arItem['ID'], $arItem['ADD_LINK'], $arItem["ADD_LINK_TEXT"]);
					$this->AddEditAction($editId, $arItem['EDIT_LINK'], $arItem["EDIT_LINK_TEXT"]);
					$this->AddDeleteAction($editId, $arItem['DELETE_LINK'], $arItem["DELETE_LINK_TEXT"], array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				} else {
					$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
					$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
					$editId = $arSection['ID'];
				}
			?>
				<?
				?>
				<a class="bigBlock bigBlock<?= $arSection['PICTURE']['SIZE']; ?>" href="<?= $arSection["SECTION_PAGE_URL"]; ?>" id="<? echo $this->GetEditAreaId($editId); ?>">
					<img class="bbimg" loading="lazy" data-size="<?= $arSection['PICTURE']['SIZE']; ?>" src="<?= $arSection['PICTURE']['SRC'] ?>" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="<?= $arSection['PICTURE']['WIDTH'] ?>" height="<?= $arSection['PICTURE']['HEIGHT'] ?>" alt="<?= $arSection['PICTURE']['ALT'] ?> " title="<?= $arSection['PICTURE']['TITLE'] ?>" />
					<div class="content">
						<div class="title "><?= $arSection["NAME"]; ?> </div>
						<div class="text d"><?= $arSection["DESCRIPTION"]; ?></div>
						<?/*?>
						<p class="text d"><?= $arSection["DESCRIPTION"]; ?></p>
						<?*/ ?>
					</div>
				</a>
			<?
			}
			?>
		</div>
	</div>
<? } ?>