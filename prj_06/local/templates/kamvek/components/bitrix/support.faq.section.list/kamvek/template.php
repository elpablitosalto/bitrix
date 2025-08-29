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

<div id="ContentSections-Content" class="contentSectionArea">
	<? foreach ($arResult['SECTIONS'] as $val) { ?>
		<div id="cs-445" class="contentSection  noparallax faq " data-minhig='100' data-hig='100'>
			<div class="csContent responsiveBlock">
				<h2 class="sectionTitle smallTitle checkR"><?= $val["NAME"]; ?></h2>
				<div class="blockContent">
					<? foreach ($arResult['arElements'][$val['ID']] as $arItem) { ?>
						<h3 class="frage"><?= $arItem['NAME']; ?></h3>
						<div class="antwort">
							<p><?= $arItem['DETAIL_TEXT']; ?></p>
						</div>
					<? } ?>
				</div>
			</div>
		</div>
	<? } ?>
</div>