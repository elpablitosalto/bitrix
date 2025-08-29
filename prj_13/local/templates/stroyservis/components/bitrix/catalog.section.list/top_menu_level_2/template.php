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
//vardump($arResult['SECTIONS']);
if (!empty($arResult['SECTIONS'])) {
	$intCurrentDepth = 1;
	$boolFirst = true;
	$i = 0;
	foreach ($arResult['SECTIONS'] as &$arSection) {
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

		$i++;
		$div_style = '';
		if ($i == 1) {
			$div_style = 'style="display:block"';
		}

		if ($arSection['DEPTH_LEVEL'] == 1) {
			if ($boolFirst == false) {
?>
				</ul>
				</div>
			<?
			}
			?>
			<div class="catalogs<?/*if (is_array($arResult['HAS_CHILD'][$arSection['ID']]) && count($arResult['HAS_CHILD'][$arSection['ID']]) == 0):?> display-none<?endif;*/?>" <?= $div_style; ?>>
				<a class="catalogs__title" href="<?= $arSection['SECTION_PAGE_URL'] ?>" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
					<img src="<?= (!empty($arSection['DETAIL_PICTURE']) ? CFile::GetPath($arSection['DETAIL_PICTURE']) : SITE_TEMPLATE_PATH . '/img/content/megamenu/1.jpg') ?>" alt="">
					<span><? echo $arSection["NAME"]; ?></span>
				</a>
				<ul class="catalogs__list">
				<? } else { ?>
					<li class="catalogs__item" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
						<a target="_self" href="<? echo $arSection["SECTION_PAGE_URL"]; ?>">
							<span><? echo $arSection["NAME"]; ?></span>
						</a>
					</li>
		<? } ?>
	<?
		//$intCurrentDepth = $arSection['DEPTH_LEVEL'];
		$boolFirst = false;
	}
	?></ul>
	</div>
<?
}
?>