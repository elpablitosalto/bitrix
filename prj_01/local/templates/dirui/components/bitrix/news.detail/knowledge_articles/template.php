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

<? if (!empty($arResult["ACTIVE_FROM"])) { ?>
	<div class="card__date">
		<? echo FormatDate("j F Y", MakeTimeStamp($arResult["ACTIVE_FROM"])); ?>
	</div>
<? } ?>
<div class="card__wrapper">
	<? if (!empty($arResult["DETAIL_PICTURE"])) { ?>
		<div class="card__image">
			<img src="<?= $arResult['PICTURE']['SRC']; ?>" alt="<?= $arResult['PICTURE']['ALT']; ?>" title="<?= $arResult['PICTURE']['TITLE']; ?>" />
		</div>
	<? } ?>
	<? if (!empty($arResult["DISPLAY_PROPERTIES"]["SUB_HEADER"]["DISPLAY_VALUE"])) { ?>
		<h3><?= $arResult["DISPLAY_PROPERTIES"]["SUB_HEADER"]["DISPLAY_VALUE"]; ?></h3>
	<? } ?>
	<div class="card__text">
		<?= $arResult["DETAIL_TEXT"]; ?>
	</div>
</div>