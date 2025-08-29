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
<? if (!empty($arResult["ITEMS"])) { ?>
	<section id="cs-ProduktLinks" class="pb2020 contentSection ">
		<div class="csContent responsiveBlock">
			<h2 class="csHeadline"><?= $arParams['HEADER'] ?></h2>
			<ul class="centered pfeil nodots ccb checkR">
				<? foreach ($arResult["ITEMS"] as $arItem) {
					if ($arItem['SHOW'] != 'N') {
				?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<li id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<a href="<?= $arItem['URL'] ?>" title="<?= $arItem['TITLE'] ?>" target="<?= $arItem['TARGET'] ?>">
								<?= $arItem['TITLE'] ?>
							</a>
						</li>
				<? }
				} ?>
			</ul>
		</div>
	</section>
<? } ?>