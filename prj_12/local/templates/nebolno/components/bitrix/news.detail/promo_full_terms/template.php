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

?>
<section class="nb-section nb-licenses-promotion-rules" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
	<div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
		<div class="nb-section__header">
			<h2 class="nb-section__title">Полные условия акции</h2>
		</div>
		<div class="nb-section__body">
			<div class="nb-promotion-rules">
				<div class="nb-promotion-rules__item">
					<h3 class="nb-promotion-rules__item-title">Описание акции:</h3>
					<div class="nb-promotion-rules__item-desc">
						<p><?= $arResult["DISPLAY_PROPERTIES"]["DESC"]["DISPLAY_VALUE"]; ?></p>
					</div>
				</div>
				<div class="nb-promotion-rules__item">
					<h3 class="nb-promotion-rules__item-title">Время проведения:</h3>
					<div class="nb-promotion-rules__item-desc">
						<p>Акция действует до <? echo FormatDate("j F Y", MakeTimeStamp($arResult["ACTIVE_TO"])); ?></p>
					</div>
				</div>
				<div class="nb-promotion-rules__item">
					<h3 class="nb-promotion-rules__item-title">Проводится в клиниках "Белый кролик":</h3>
					<div class="nb-promotion-rules__item-desc">
						<p><? echo implode(", ", $arResult["arClinicsNames"]); ?></p>
					</div>
				</div>
				<div class="nb-promotion-rules__item">
					<h3 class="nb-promotion-rules__item-title">Юридическая информация:</h3>
					<div class="nb-promotion-rules__item-desc">
						<p><?= $arResult["DISPLAY_PROPERTIES"]["LOW_INFO"]["DISPLAY_VALUE"]; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>