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
//vardump($arResult['arSections']);
?>

<? if (count($arResult['ITEMS']) > 0) : ?>

	<div class="ml-videoservices">

		<ul class="ml-videoservices-list">

			<? foreach ($arResult['ITEMS'] as $arItem) : ?>

				<? if ($arItem['PREVIEW_PICTURE']['SRC']) : ?>
					<li>
						<? if ($arItem['PROPERTIES']['LINK']['VALUE']) : ?>
							<a href="<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>" target="_blank">
								<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>" width="<?= $arItem['PREVIEW_PICTURE']['WIDTH'] ?>" height="<?= $arItem['PREVIEW_PICTURE']['HEIGHT'] ?>">
							</a>
						<? else : ?>
							<span>
								<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>" width="<?= $arItem['PREVIEW_PICTURE']['WIDTH'] ?>" height="<?= $arItem['PREVIEW_PICTURE']['HEIGHT'] ?>">
							</span>
						<? endif; ?>
					</li>
				<? endif; ?>

			<? endforeach; ?>

		</ul>
	</div>

<?php endif; ?>