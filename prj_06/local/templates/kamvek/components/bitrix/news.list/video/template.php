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
	<div id="MediaTeaserList" class="responsiveBlock">
		<section class="mediaType">
			<?/*?>
			<h2 class="sectionTitle open"><?= $arResult['NAME'] ?></h2>
			<?*/ ?>
			<?
			$sectionName = '';
			foreach ($arResult["ITEMS"] as $arItem) { ?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<?/*?>
					<? if ($sectionName != $arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE'] && strlen($arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE']) > 0) { ?>
						<h2 class="headline"><?= $arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE']; ?></h2>
					<? } ?>
					<?*/ ?>
				<a class="mediaTeaser" href="<?= $arItem['DISPLAY_PROPERTIES']['VIDEO_LINK']['VALUE'] ?>" data-fancybox title="<?= $arItem['NAME']; ?>" itemscope itemtype="https://schema.org/VideoObject" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<meta itemprop="thumbnailUrl" content="<?= $arItem['PICTURE']['FILE_VALUE_SOURCE']['SRC']; ?>" />
					<meta itemprop="uploadDate" content="<?= date('Y-m-d H:m:s', MakeTimeStamp($arItem['DATE_CREATE'])) ?>" />
					<?
					$arYouTubeUrlParts = parse_url($arItem['DISPLAY_PROPERTIES']['VIDEO_LINK']['VALUE']);
					?>
					<img class="videoTeaserImage" src="<?if (!empty($arItem['PREVIEW_PICTURE'])):?><?= $arItem['PICTURE']['SRC']; ?><?else:?>https://img.youtube.com/vi/<?=substr($arYouTubeUrlParts['path'], 1)?>/maxresdefault.jpg<?endif;?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
					<div class="mediaTeaserTitle" itemprop="name"><?= $arItem['NAME']; ?></div>
					<? if (!empty($arItem['PREVIEW_TEXT'])) { ?>
						<div class="mediaTeaserText" itemprop="description">
							<p><?= $arItem['PREVIEW_TEXT']; ?></p>
						</div>
					<? } ?>
				</a>
			<?
				$sectionName = $arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE'];
			}
			?>
		</section>
	</div>
<? } ?>