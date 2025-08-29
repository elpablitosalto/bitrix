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
	<ul class="category-list">
		<?
		$i = 0;
		foreach ($arResult['SECTIONS'] as &$arSection) {
			$i++;
			$active = '';
			if ($i == 1) {
				$active = 'category-item_active';
			}
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
		?>
			<li class="category-item <?= $active; ?>" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
				<a class="category-link" href="<?= $arSection['SECTION_PAGE_URL'] ?>">
					<div class="category-image">
						<img loading="lazy" src="<?= (!empty($arSection['UF_MENU_ICON']) ? CFile::GetPath($arSection['UF_MENU_ICON']) : $arSection['PICTURE']['SRC']) ?>" alt="<?= $arSection['PICTURE']['ALT'] ?>" title="<?= $arSection['PICTURE']['TITLE'] ?>" />
					</div><?= $arSection["NAME"]; ?>
				</a>
			</li>
		<?
		}
		?>
		<li class="category-item">
			<a class="category-link" href="<?=SITE_DIR?>promos/">
				<div class="category-image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/category/sale.png" alt=""></div>Акции
			</a>
		</li>
	</ul>
<? } ?>