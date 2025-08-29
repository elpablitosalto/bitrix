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
	<section id="MediaTeaserList" class="bgGrau">
		<div class="pb2020 wide">
			<div class="mediaType">
				<?
				$h2 = $arResult['NAME'];
				if (strlen($arParams['SECTION_HEADER']) > 0) {
					$h2 = $arParams['SECTION_HEADER'];
				}
				?>
				<h2 class="headline"><?= $h2; ?></h2>
				<?
				$sectionName = '';
				foreach ($arResult["ITEMS"] as $arItem) { ?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>

					<? if ($sectionName != $arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE'] && strlen($arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE']) > 0) { ?>
						<h2 class="headline"><?= $arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE']; ?></h2>
					<? } ?>

					<?
					$data_fancybox = '';
					if ($arItem['TYPE'] == 'FILE') {
					} else if ($arItem['TYPE'] == 'IMAGE') {
						$data_fancybox = 'data-fancybox';
					}
					?>
					<div class="mediaTeaser katalogTeaser" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<a href="<?= $arItem['FILE']['SRC']; ?>" <?= $data_fancybox ?> title="<?= $arItem['HEADER']; ?>" target="_blank">
							<img class="katalogThumb" src="<?= $arItem['PICTURE']['SRC']; ?>" width="<?= $arItem['PICTURE']['WIDTH']; ?>" height="<?= $arItem['PICTURE']['HEIGHT']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />

							<div class="katalogTitle"><?= $arItem['HEADER']; ?></div>
						</a>

						<? if ($arItem['TYPE'] == 'FILE') { ?>
							<a class="desc" href="<?= $arItem['FILE']['SRC']; ?>" <?= $data_fancybox ?> title="<?= $arItem['HEADER']; ?>" target="_blank"><span class="filetype"><?= $arItem['FILE']['TYPE_FORMAT']; ?></span> (<?= $arItem['FILE']['SIZE_FORMAT']; ?>)</a>
						<? } ?>
					</div>

					<?
					//echo 'sectionName = ' . $sectionName . '<br />';
					//echo 'SECTION = ' . $arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE'] . '<br />';
					?>


					<?/*?>
					<a class="bigBlock bigBlock<?= $arItem['PICTURE']['SIZE']; ?>" href="<?= $arItem["DISPLAY_PROPERTIES"]['URL']['VALUE'] ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<img class="bbimg" loading="lazy" data-size="<?= $arItem['PICTURE']['SIZE']; ?>" src="<?= $arItem['PICTURE']['SRC']; ?>" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="<?= $arItem['PICTURE']['WIDTH']; ?>" height="<?= $arItem['PICTURE']['HEIGHT']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?> " title="<?= $arItem['PICTURE']['TITLE']; ?>" />
						<div class="content">
							<div class="title "><?= $arItem['NAME']; ?></div>
							<p class="text d"><?= $arItem['PREVIEW_TEXT']; ?></p>
						</div>
					</a>
					<?*/ ?>
				<?
					$sectionName = $arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE'];
				}
				?>
			</div>
		</div>
	</section>
<? } ?>