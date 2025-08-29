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
<?
//vardump($arResult['SECTIONS']);
if (!empty($arResult['SECTIONS'])) {
?>
	<section class="category-grouts">
		<ul class="category__list">
			<?
			foreach ($arResult['SECTIONS'] as &$arSection) {
				if (intval($arSection['ELEMENT_CNT']) > 0) {
					$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
					$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

			?>
					<li class="category__item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
						<a target="_self" class="category__link" href="<? echo $arSection["SECTION_PAGE_URL"]; ?>">
							<p class="category__title">
								<?= $arSection['NAME']; ?> <span>(<?= $arSection['ELEMENT_CNT']; ?>)</span>
							</p>
							<div class="category__image">
								<img src="<?= $arSection['PICTURE']['SRC'] ?>" alt="<?= $arSection['PICTURE']['ALT'] ?>" title="<?= $arSection['PICTURE']['TITLE'] ?>" />
							</div>
						</a>
					</li>
			<? }
			} ?>
		</ul>
	</section>
<? } ?>