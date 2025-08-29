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
	<ul class="dp-aside-menu__list">
		<? foreach ($arResult['SECTIONS'] as $sectId => $arSection) { ?>
			<?
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
			?>
			<li class="dp-aside-menu__item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
				<a class="dp-aside-menu__link" href="#<?= $arSection['ID']; ?>" data-anchor="#<?= $arSection['ID']; ?>">
					<span class="dp-aside-menu__text"><?= $arSection['NAME'] ?></span>
				</a>
				<? if (!empty($arSection['ELEMENTS'])) { ?>
					<? if (count($arSection['ELEMENTS']) > 1) { ?>
						<ul class="dp-aside-menu__sublist">
							<? foreach ($arSection['ELEMENTS'] as $elId => $arItem) { ?>
								<?
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
								?>
								<?
								$selected = '';
								if ($arParams['CUR_ELEMENT_CODE'] == $arItem['CODE']) {
									$selected = 'selected';
								}
								?>
								<li class="dp-aside-menu__subitem <?= $selected; ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
									<a class="dp-aside-menu__sublink" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
										<?= $arItem['NAME']; ?>
									</a>
								</li>
							<? } ?>
						</ul>
					<? } ?>
				<? } ?>
			</li>
		<? } ?>
	</ul>
<? } ?>