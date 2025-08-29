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

// Адрес -->
$city = $arResult['DISPLAY_PROPERTIES']['CITY']['DISPLAY_VALUE'];
$addressShort = $arResult['DISPLAY_PROPERTIES']['ADDRESS']['DISPLAY_VALUE'];
$address = $city;
if (strlen($city) > 0 && strlen($addressShort) > 0) {
	$address .= ', ';
}
$address .= $addressShort;
// <-- Адрес

// Месяц, год -->
$month = $arResult['DISPLAY_PROPERTIES']['MONTH']['DISPLAY_VALUE'];
$year = $arResult['DISPLAY_PROPERTIES']['YEAR']['DISPLAY_VALUE'];
$date = $month;
$datetime = $year;
if (strlen($month) > 0 && strlen($year) > 0) {
	$date .= ' ';
	$datetime .= '-' . $month;
}
$date .= $year;
// <-- Месяц, год

?>
<section class="dp-section dp-project-details">
	<div class="container">
		<div class="dp-project-details-main">
			<picture class="dp-project-details-main__img">
				<img src="<?= $arResult['DETAIL_PICTURE']['SRC']; ?>" alt="<?= $arResult['DETAIL_PICTURE']['ALT']; ?>" title="<?= $arResult['DETAIL_PICTURE']['TITLE']; ?>" />
			</picture>
			<div class="row dp-project-details-main__desc">
				<div class="col-lg-23 col-xl-19">
					<div class="dp-project-details-meta">
						<div class="dp-project-details-address"><?= $address; ?></div>
						<time class="dp-project-details-date" datetime="<?= $datetime; ?>"><?= $date; ?></time>
					</div>
					<p><?= $arResult['DETAIL_TEXT']; ?></p>
				</div>
			</div>
		</div>

		<? if (!empty($arResult['DISPLAY_PROPERTIES']['DIGITS']['DISPLAY_VALUE'])) { ?>
			<div class="dp-project-details-summary">
				<div class="row">
					<div class="col-sm-19">
						<div class="row">
							<?
							$i = 0;
							foreach ($arResult['DISPLAY_PROPERTIES']['DIGITS']['DISPLAY_VALUE'] as $key => $val) { ?>
								<? if ($i == 3) { ?>
						</div>
						<div class="row">
						<? } ?>
						<div class="col-sm-12">
							<p class="dp-project-details-summary__title"><?= $val; ?></p>
							<p class="dp-project-details-summary__desc"><?= $arResult['DISPLAY_PROPERTIES']['DIGITS']['DESCRIPTION'][$key]; ?></p>
						</div>

					<?
								$i++;
							}
					?>

						</div>
					</div>
				</div>
			</div>
		<? } ?>

		<? if (!empty($arResult['arDesigner'])) { ?>
			<div class="dp-project-details-design">
				<p class="dp-project-details-design-title"></p>
				<div class="dp-project-details-designer">
					<div class="dp-project-details-designer__photo">
						<img src="<?= $arResult['arDesigner']['PICTURE']['SRC']; ?>" alt="<?= $arResult['arDesigner']['PICTURE']['ALT']; ?>" title="<?= $arResult['arDesigner']['PICTURE']['TITLE']; ?>" />
					</div>
					<div class="dp-project-details-designer__caption">
						<p class="dp-project-details-designer__company"><?= $arResult['arDesigner']['POSITION_COMPANY']; ?></p>
						<p class="dp-project-details-designer__name"><?= $arResult['arDesigner']['NAME']; ?></p>
					</div>
				</div>
				<blockquote class="dp-project-details-design-blockquote">
					<p><?= $arResult['arDesigner']['DESIGNER_QUOTE']; ?></p>
				</blockquote>
			</div>
		<? } ?>

		<div class="dp-project-details-additional">
			<? if (!empty($arResult['PICTURE_1'])) { ?>
				<picture>
					<img src="<?= $arResult['PICTURE_1']['SRC']; ?>" alt="<?= $arResult['PICTURE_1']['ALT']; ?>" title="<?= $arResult['PICTURE_1']['TITLE']; ?>" />
				</picture>
			<? } ?>
			<? if (!empty($arResult['PICTURE_2'])) { ?>
				<div class="row align-items-sm-end">
					<? if (!empty($arResult['PICTURE_2'])) { ?>
						<div class="col-sm-12">
							<picture>
								<img src="<?= $arResult['PICTURE_2']['SRC']; ?>" alt="<?= $arResult['PICTURE_2']['ALT']; ?>" title="<?= $arResult['PICTURE_2']['TITLE']; ?>" />
							</picture>
						</div>
					<? } ?>
					<? if (!empty($arResult['DISPLAY_PROPERTIES']['TEXT_2']['DISPLAY_VALUE'])) { ?>
						<div class="col-sm-12">
							<?= $arResult['DISPLAY_PROPERTIES']['TEXT_2']['DISPLAY_VALUE']; ?>
						</div>
					<? } ?>
				</div>
			<? } ?>
			<? if (!empty($arResult['PICTURE_3']) || !empty($arResult['PICTURE_4'])) { ?>
				<div class="row">
					<? if (!empty($arResult['PICTURE_3'])) { ?>
						<div class="col-sm-12">
							<picture>
								<img src="<?= $arResult['PICTURE_3']['SRC']; ?>" alt="<?= $arResult['PICTURE_3']['ALT']; ?>" title="<?= $arResult['PICTURE_3']['TITLE']; ?>" />
							</picture>
						</div>
					<? } ?>
					<? if (!empty($arResult['PICTURE_4'])) { ?>
						<div class="col-sm-12">
							<picture>
								<img src="<?= $arResult['PICTURE_4']['SRC']; ?>" alt="<?= $arResult['PICTURE_4']['ALT']; ?>" title="<?= $arResult['PICTURE_4']['TITLE']; ?>" />
							</picture>
						</div>
					<? } ?>
				</div>
			<? } ?>
			<? if (!empty($arResult['PICTURE_5'])) { ?>
				<figure>
					<picture>
						<img src="<?= $arResult['PICTURE_5']['SRC']; ?>" alt="<?= $arResult['PICTURE_5']['ALT']; ?>" title="<?= $arResult['PICTURE_5']['TITLE']; ?>" />
					</picture>
					<? if (!empty($arResult['DISPLAY_PROPERTIES']['TEXT_5']['DISPLAY_VALUE'])) { ?>
						<figcaption><?= $arResult['DISPLAY_PROPERTIES']['TEXT_5']['DISPLAY_VALUE']; ?></figcaption>
					<? } ?>
				</figure>
			<? } ?>
			<? if (!empty($arResult['PICTURE_6'])) { ?>
				<picture>
					<img src="<?= $arResult['PICTURE_6']['SRC']; ?>" alt="<?= $arResult['PICTURE_6']['ALT']; ?>" title="<?= $arResult['PICTURE_6']['TITLE']; ?>" />
				</picture>
			<? } ?>
			<? if (!empty($arResult['PICTURE_7'])) { ?>
				<picture>
					<img src="<?= $arResult['PICTURE_7']['SRC']; ?>" alt="<?= $arResult['PICTURE_7']['ALT']; ?>" title="<?= $arResult['PICTURE_7']['TITLE']; ?>" />
				</picture>
			<? } ?>
		</div>
	</div>
</section>