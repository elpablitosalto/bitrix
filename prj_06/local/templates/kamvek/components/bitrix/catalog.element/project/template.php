<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

// Слайдшоу -->
if (is_array($arResult['PROPERTIES']['IMAGES']['VALUE']) && count($arResult['PROPERTIES']['IMAGES']['VALUE']) > 0) {
	$this->SetViewTarget('slideShow');
?>
	<?
	$this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div id="<?= $this->GetEditAreaId($arResult['ID']); ?>">
		<? foreach ($arResult['PROPERTIES']['IMAGES']['VALUE'] as $fileId) {
			$arFileCustom = CFile::GetFileArray($fileId);
		?>
			<div class="slide" itemscope="" itemtype="https://schema.org/ImageObject">
				<meta itemprop="contentUrl" content="">
				<meta itemprop="thumbnailUrl" content="">
				<img class="bbimg" src="<?= $arFileCustom['SRC'] ?>" sizes="100vw" style="object-position:50% 50%;" width="1920" height="750" alt="<?= $arResult['NAME'] ?>" title="<?= $arResult['NAME'] ?>" />
				<? if (strlen($arFileCustom['DESCRIPTION']) > 0) { ?>
					<div class="subtitle">
						<div class="description" itemprop="description"><?= $arFileCustom['DESCRIPTION']; ?></div>
					</div>
				<? } ?>
			</div>
		<? } ?>
	</div>
<?
	$this->EndViewTarget();
}
// <-- Слайдшоу
?>

<?
$GLOBALS['PAGE_H1'] = $arResult['NAME'];
$GLOBALS['PAGE_H2'] = $arResult['DISPLAY_PROPERTIES']['H_2']['VALUE'];
$GLOBALS['PAGE_DESCRIPTION'] = $arResult['~DETAIL_TEXT'];
include($_SERVER["DOCUMENT_ROOT"] . "/include/header_first_content.php");
?>
<? if (
	mb_strlen($arResult['PROPERTIES']['COLLECTION']['VALUE']) > 0
	|| mb_strlen($arResult['PROPERTIES']['PROJECT']['VALUE']) > 0
	|| (is_array($arResult['PROPERTIES']['COLOR_AND_FORMAT']['VALUE']) && count($arResult['PROPERTIES']['COLOR_AND_FORMAT']['VALUE']) > 0)
	|| (is_array($arResult['PROPERTIES']['OPTIONS']['VALUE']) && count($arResult['PROPERTIES']['OPTIONS']['VALUE']) > 0)
) : ?>
	<div id="Bautafel" class="pb2020 bgGrau <?/**/ ?>akkSection<?/**/ ?>" data-minhig="10" data-hig="45">
		<div id="ReferenzContent" class="responsiveBlock">
			<div class="cbb content2 bautafel">
				<div class=" productSection">
					<h2 class="sectionTitle open"><?= $arParams['SECTION_PROJECT_TITLE'] ?></h2>
					<div class="sectionContent">
						<?/*if (mb_strlen($arResult['PROPERTIES']['COLLECTION']['VALUE']) > 0):?>
							<div id="ProductLogo">
								<?if (mb_strlen($arResult['PROPERTIES']['COLLECTION']['DESCRIPTION']) > 0):?>
									<a href="<?=$arResult['PROPERTIES']['COLLECTION']['DESCRIPTION']?>" title="<?=$arResult['PROPERTIES']['COLLECTION']['VALUE']?>">
								<?endif;?>
									<div class="productLogo"><h2 class="mettenProductLogo rInLogo"><?=$arResult['PROPERTIES']['COLLECTION']['VALUE']?></h2></div>
								<?if (mb_strlen($arResult['PROPERTIES']['COLLECTION']['DESCRIPTION']) > 0):?>
									</a>
								<?endif;?>
							</div>
						<?endif;*/ ?>
						<?/*?>
						<?if (
							is_array($arResult['DISPLAY_PROPERTIES']['PRODUCTS']['LINK_ELEMENT_VALUE'])
							&& count($arResult['DISPLAY_PROPERTIES']['PRODUCTS']['LINK_ELEMENT_VALUE']) > 0
						):?>
							<div id="ProductLogo">
								<?foreach($arResult['DISPLAY_PROPERTIES']['PRODUCTS']['LINK_ELEMENT_VALUE'] as $arProduct):?>
									<a href="<?=$arProduct['DETAIL_PAGE_URL']?>" title="<?=$arProduct['NAME']?>">
										<div class="productLogo">
											<h2 class="mettenProductLogo rInLogo"><?=$arProduct['NAME']?></h2>
										</div>
									</a>
								<?endforeach;?>
							</div>
						<?endif;?>
						<?*/ ?>

						<? if (mb_strlen($arResult['PROPERTIES']['PROJECT']['VALUE']) > 0) : ?>
							<div class="referenceSidebarBlock">
								<h3><?= $arResult['PROPERTIES']['PROJECT']['NAME'] ?>:</h3>
								<p><?= $arResult['PROPERTIES']['PROJECT']['VALUE'] ?></p>
							</div>
						<? endif; ?>
						<? if (
							is_array($arResult['DISPLAY_PROPERTIES']['PRODUCTS']['LINK_ELEMENT_VALUE'])
							&& count($arResult['DISPLAY_PROPERTIES']['PRODUCTS']['LINK_ELEMENT_VALUE']) > 0
						) : ?>
							<div class="referenceSidebarBlock">
								<h3><?= $arResult['PROPERTIES']['PRODUCTS']['NAME'] ?>:</h3>
								<? foreach ($arResult['DISPLAY_PROPERTIES']['PRODUCTS']['LINK_ELEMENT_VALUE'] as $arProduct) : ?>
									<a href="<?= $arProduct['DETAIL_PAGE_URL'] ?>" title="<?= $arProduct['NAME'] ?>">
										<?= $arProduct['NAME'] ?>
									</a><br />
								<? endforeach; ?>
							</div>
						<? endif; ?>
						<? if (is_array($arResult['PROPERTIES']['COLOR_AND_FORMAT']['VALUE']) && count($arResult['PROPERTIES']['COLOR_AND_FORMAT']['VALUE']) > 0) : ?>
							<div class="referenceSidebarBlock" id="RefStoneBlock1">
								<h3><?= $arResult['PROPERTIES']['COLOR_AND_FORMAT']['NAME'] ?>:</h3>
								<div class="refStones">
									<? foreach ($arResult['PROPERTIES']['COLOR_AND_FORMAT']['VALUE'] as $arItem) : ?>
										<div class="refStoneBlock">
											<div class="refStoneBlockImg">
												<? if (!empty($arItem['SUB_VALUES']['COLOR_AND_FORMAT_PHOTO']['VALUE'])) : ?>
													<?
													$arPhoto = CFile::ResizeImageGet($arItem['SUB_VALUES']['COLOR_AND_FORMAT_PHOTO']['VALUE'], array('width' => 180, 'height' => 120), BX_RESIZE_IMAGE_EXACT, true);
													?>
													<img loading="lazy" src="<?= $arPhoto['src'] ?>" alt="<?= htmlspecialchars($arItem['SUB_VALUES']['COLOR_AND_FORMAT_TITLE']['VALUE']) ?>" />
												<? endif; ?>
											</div>
											<div class="refStoneBlockText">
												<? if (mb_strlen($arItem['SUB_VALUES']['COLOR_AND_FORMAT_TITLE']['VALUE']) > 0) : ?>
													<div class="title"><?= $arItem['SUB_VALUES']['COLOR_AND_FORMAT_TITLE']['VALUE'] ?></div>
												<? endif; ?>
												<?= $arItem['SUB_VALUES']['COLOR_AND_FORMAT_DESC']['~VALUE']['TEXT'] ?>
											</div>
										</div>
									<? endforeach; ?>
								</div>
							</div>
						<? endif; ?>
						<? if (is_array($arResult['PROPERTIES']['OPTIONS']['VALUE']) && count($arResult['PROPERTIES']['OPTIONS']['VALUE']) > 0) : ?>
							<? foreach ($arResult['PROPERTIES']['OPTIONS']['VALUE'] as $index => $arOptionName) : ?>
								<div class="referenceSidebarBlock">
									<h3><?= $arOptionName ?>:</h3>
									<? if (isset($arResult['PROPERTIES']['OPTIONS']['~DESCRIPTION'][$index])) : ?>
										<p><?= $arResult['PROPERTIES']['OPTIONS']['~DESCRIPTION'][$index] ?></p>
									<? endif; ?>
								</div>
							<? endforeach; ?>
						<? endif; ?>
						<? if (is_array($arResult['GROUPS']) && count($arResult['GROUPS']) > 0) : ?>
							<div class="referenceSidebarBlock">
								<h3>Категории:</h3>
								<? foreach ($arResult['GROUPS'] as $arGroup) : ?>
									<p><a href="<?= $arGroup['SECTION_PAGE_URL'] ?>"><?= $arGroup['NAME'] ?></a></p>
								<? endforeach; ?>
							</div>
						<? endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<? endif; ?>
<? if (is_array($arResult['PROPERTIES']['GALLERY']['VALUE']) && count($arResult['PROPERTIES']['GALLERY']['VALUE']) > 0) : ?>
	<div id="cs-Galerie" class="productSection wideGallery ">
		<h2 class="sectionTitle open responsiveBlock"><?= $arResult['PROPERTIES']['GALLERY']['NAME'] ?></h2>
		<div class="sectionContent gallery">
			<?
			$bCentered = false;
			if (!empty($arResult['PROPERTIES']['CENTERED']['VALUE_XML_ID'])) {
				if ($arResult['PROPERTIES']['CENTERED']['VALUE_XML_ID'] == 'Y') {
					$bCentered = true;
				}
			}
			/*
			if (
				(
					!isset($arResult['PROPERTIES']['CENTERED'])
					|| (
						isset($arResult['PROPERTIES']['CENTERED'])
						&& $arResult['PROPERTIES']['CENTERED']['VALUE_XML_ID'] == 'Y'
					)
				)
				&& $arResult['PROPERTIES']['CENTERED']['VALUE_XML_ID'] != 'N'
			) {
				$bCentered = true;
			}
			*/
			?>
			<div id="JustifiedGallery" class="justified-gallery<? if ($bCentered) { ?> centered<? } ?> <? if (is_array($arResult['PROPERTIES']['GALLERY']['VALUE']) && count($arResult['PROPERTIES']['GALLERY']['VALUE']) == 1) : ?> one-item<? endif; ?>">
				<? foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $fileId) : ?>
					<?
					$arPhoto = CFile::GetFileArray($fileId);
					$arThumb = CFile::ResizeImageGet($fileId, array('width' => 600, 'height' => 600), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					?>
					<div itemscope itemtype="https://schema.org/ImageObject" class="galThumb" data-mfp-src="<?= $arPhoto['SRC'] ?>" title="<?= $arPhoto['DESCRIPTION'] ?>">
						<img loading="lazy" src="<?= $arThumb['src'] ?>" alt="<?= $arPhoto['DESCRIPTION'] ?>" />
						<meta itemprop="contentUrl" content="<?= $arPhoto['SRC'] ?>" />
						<meta itemprop="thumbnailUrl" content="<?= $arPhoto['SRC'] ?>" />
						<meta itemprop="description" content="<?= $arPhoto['DESCRIPTION'] ?>" />
					</div>
				<? endforeach; ?>
			</div>
		</div>
	</div>
<? endif; ?>

<? if (isset($arResult['PROPERTIES']['EPILOG_TEXT']['~VALUE']['TEXT']) && mb_strlen($arResult['PROPERTIES']['EPILOG_TEXT']['~VALUE']['TEXT']) > 0) : ?>
	<div class="respBlock">
		<div class="contentBlock flexBlock">
			<div class="ccb leftalign content1">
				<?= $arResult['PROPERTIES']['EPILOG_TEXT']['~VALUE']['TEXT'] ?>
			</div>
		</div>
	</div>
<? endif; ?>

<? if (is_array($arResult['PROPERTIES']['DOC']['VALUE']) && count($arResult['PROPERTIES']['DOC']['VALUE']) > 0) : ?>
	<div id="ReferenzDownloads" class="responsiveBlock">
		<section id="MediaTeaserList" class="productSection">
			<h2><?= $arResult['PROPERTIES']['DOC']['NAME'] ?></h2>
			<div class="mediaType">
				<? foreach ($arResult['PROPERTIES']['DOC']['VALUE'] as $arItem) : ?>
					<?
					$arFile = !empty($arItem['SUB_VALUES']['DOC_PDF']['VALUE']) ? CFile::GetFileArray($arItem['SUB_VALUES']['DOC_PDF']['VALUE']) : [];
					$fileName = mb_strlen($arItem['SUB_VALUES']['DOC_NAME']['VALUE']) > 0 ? $arItem['SUB_VALUES']['DOC_NAME']['VALUE'] : pathinfo($arFile['ORIGINAL_NAME'], PATHINFO_FILENAME);
					$fileExt = pathinfo($arFile['SRC'], PATHINFO_EXTENSION);
					?>
					<div class="mediaTeaser katalogTeaser">
						<a href="<?= $arFile['SRC'] ?>" title="<?= $fileName ?>" target="_blank">
							<? if (!empty($arItem['SUB_VALUES']['DOC_PREVIEW']['VALUE'])) : ?>
								<?
								$preview = CFile::ResizeImageGet($arItem['SUB_VALUES']['DOC_PREVIEW']['VALUE'], array('width' => 300, 'height' => 400), BX_RESIZE_IMAGE_PROPORTIONAL, true);
								?>
								<img class="katalogThumb" src="<?= $preview['src'] ?>" alt="<?= $fileName ?>" />
							<? endif; ?>
							<div class="katalogTitle"><?= $fileName ?></div>
						</a>
						<a class="desc" href="<?= $arFile['SRC'] ?>" title="Objektbericht Bahn Hoefe Ottensen" target="_blank">
							<span class="filetype"><?= $fileExt ?></span> (<?= CFile::FormatSize($arFile['FILE_SIZE']) ?>)
						</a>
					</div>
				<? endforeach; ?>
			</div>
		</section>
	</div>
<? endif; ?>