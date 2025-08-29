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
?>
<?/* $this->SetViewTarget("doctor_picture"); ?>
<? //if (isset($arResult['PREVIEW_PICTURE']['SRC'])) : ?>
<? if (isset($arResult["DOCTOR_PHOTO"]['src'])) : ?>
	<div class="nb-top-banner-doctors__photo-mobile content-doctors-mobile">
		<img src="<?= $arResult["DOCTOR_PHOTO"]['src'] ?>" alt="<?= $arResult['PREVIEW_PICTURE']['ALT'] ?>" />
	</div>
<? endif; ?>
<? $this->EndViewTarget(); */ ?>

<? $this->SetViewTarget("doctor_banner"); ?>
<div class="nb-top-banner nb-top-banner-doctors">
	<div class="nb-top-banner__caption nb-top-banner-doctors__doctor">
		<?
		$arPartName = array_filter(array_map('trim', explode(' ', $arResult['NAME'])));
		$arClassName = [
			'nb-top-banner-doctors__last-name',
			'nb-top-banner-doctors__first-name font-weight_normal',
			'nb-top-banner-doctors__middle-name font-weight_normal',
		];
		if (FALSE) {
			$bShowMobile = false;
			$ext_class = "";
			if (strlen($arResult['DISPLAY_PROPERTIES']["H_2_MOB"]['DISPLAY_VALUE']) > 0) {
				$bShowMobile = true;
				$ext_class = "desktop";
			}
		}
		?>
		<h1 class="nb-top-banner-doctors__title <?= $ext_class; ?>">
			<? foreach ($arPartName as $index => $partName) : ?>
				<? if (!isset($arClassName[$index])) break; ?>
				<span class="<?= $arClassName[$index] ?>"><?= $partName ?></span>
			<? endforeach; ?>
		</h1>
		<? if (FALSE) { ?>
			<? if ($bShowMobile) { ?>
				<h1 class="nb-top-banner-doctors__title mobile">
					<?
					echo $arResult['DISPLAY_PROPERTIES']["H_2_MOB"]['DISPLAY_VALUE'];
					?>
				</h1>
			<? } ?>
		<? } ?>
		<div class="nb-top-banner-doctors__wrapper">
			<ul class="nb-top-banner-doctors__list">
				<? foreach (['POSITION', 'SPECIALIZATIONS'] as $code) : ?>
					<?
					if (is_array($arResult['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE'])) {
						$hasValue = count($arResult['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE']) > 0;
						$displayValue = implode(', ', $arResult['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE']);
					} else {
						$hasValue = mb_strlen($arResult['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE']) > 0;
						$displayValue = $arResult['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE'];
					}
					?>
					<? if ($hasValue) : ?>
						<li class="nb-top-banner-doctors__item"><?= $displayValue ?></li>
					<? endif; ?>
				<? endforeach; ?>
				<? foreach (['ACADEMIC_DEGREE'] as $code) : ?>
					<?
					if (is_array($arResult['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE'])) {
						$hasValue = count($arResult['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE']) > 0;
						$displayValue = implode(', ', $arResult['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE']);
					} else {
						$hasValue = mb_strlen($arResult['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE']) > 0;
						$displayValue = $arResult['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE'];
					}
					?>
					<? if ($hasValue) : ?>
						<li class="nb-top-banner-doctors__item font-weight_bold"><?= $displayValue ?></li>
					<? endif; ?>
				<? endforeach; ?>
			</ul>
			<? if (!empty($arResult['DISPLAY_PROPERTIES']['RATING_SBERHEALTH']['VALUE']) || !empty($arResult['DISPLAY_PROPERTIES']['RATING_PRODOCTOROV']['VALUE'])) : ?>
				<table class="nb-top-banner-doctors__table">
					<tbody>
						<tr>
							<th>Независимые рейтинги</th>
							<th>(5 баллов)</th>
						</tr>
						<? if (!empty($arResult['DISPLAY_PROPERTIES']['RATING_SBERHEALTH']['VALUE'])) : ?>
							<tr>
								<td><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/sber-health.png" alt="" /></td>
								<td><img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/star.svg" alt="" /><?= number_format($arResult['DISPLAY_PROPERTIES']['RATING_SBERHEALTH']['VALUE'], 1, ',',  ' ') ?></td>
							</tr>
						<? endif; ?>
						<? if (!empty($arResult['DISPLAY_PROPERTIES']['RATING_PRODOCTOROV']['VALUE'])) : ?>
							<tr>
								<td><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/prodoctorov.png" alt="" /></td>
								<td><img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/star.svg" alt="" /><?= number_format($arResult['DISPLAY_PROPERTIES']['RATING_PRODOCTOROV']['VALUE'], 1, ',',  ' ') ?></td>
							</tr>
						<? endif; ?>
					</tbody>
				</table>
			<? endif; ?>
			<? if (count($arResult['DOCTOR_METRO']) > 0) : ?>
				<div class="nb-top-banner-doctors__address">
					<p>Ведет прием в клиниках «Белый кролик»:</p>
					<ul class="nb-top-banner-doctors__address-list">
						<? foreach ($arResult['DOCTOR_METRO'] as $metro) : ?>
							<li class="nb-top-banner-doctors__address-item">М. <?= $metro ?></li>
						<? endforeach; ?>
					</ul>
				</div>
			<? endif; ?>
			<button class="nb-btn nb-btn-arrow nb-top-banner-doctors__button nb-top-banner-doctors__button js_popup_doctor" type="button" data-modal="#modal-call" data-doctor-id="<?=$arResult["ID"];?>">
				<svg class="icon icon-btn-arrow">
					<use xlink:href="#btn-arrow"></use>
				</svg>
				<span>Записаться к врачу</span>
			</button>
		</div>
	</div>
	<? // if (isset($arResult['PREVIEW_PICTURE']['SRC'])) : 
	?>
	<? if (isset($arResult["DOCTOR_PHOTO"]['src'])) : ?>
		
		<div class="nb-top-banner-doctors__photo">
			<div class="nb-top-banner-doctors__photo-container" itemscope itemtype="http://schema.org/ImageObject">
			<meta itemprop="width" content="<?=$arResult["DOCTOR_PHOTO"]["width"]?>">
									<meta itemprop="height" content="<?=$arResult["DOCTOR_PHOTO"]["height"]?>">
				<img src="<?= $arResult["DOCTOR_PHOTO"]['src'] ?>" alt="<?= $arResult['PREVIEW_PICTURE']['ALT'] ?>" itemprop="contentUrl"/>
			</div>
		</div>
	<? endif; ?>
	<? if (mb_strlen($arResult['PROPERTIES']['QUOTE']['~VALUE']['TEXT']) > 0) : ?>
		<div class="nb-top-banner__caption nb-top-banner-doctors__quote">
			<div class="nb-top-banner-doctors__quote-wrapper">
				<div class="nb-top-banner-doctors__quote-image">
					<img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/quote.svg" alt="" />
				</div>
				<p><?= $arResult['PROPERTIES']['QUOTE']['~VALUE']['TEXT'] ?></p>
				<div class="nb-top-banner-doctors__quote-image">
					<img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/quote.svg" alt="" />
				</div>
			</div>
		</div>
	<? endif; ?>
</div>
<? if (mb_strlen($arResult['DISPLAY_PROPERTIES']['WORK_WITH']['VALUE']) > 0) : ?>
	<div class="nb-top-banner-doctors__experience">
		<p>Стаж</p>
		<?
		$d1 = new DateTime();
		$d2 = new DateTime($arResult['DISPLAY_PROPERTIES']['WORK_WITH']['VALUE']);
		$diff = $d2->diff($d1);
		?>
		<p><?= Indexis::num2word(
				$diff->y,
				[
					'#NUM# <span class="font-weight_normal">год</span>',
					'#NUM# <span class="font-weight_normal">года</span> ',
					'#NUM# <span class="font-weight_normal">лет</span>'
				]
			) ?></p>
	</div>
<? endif; ?>
<? $this->EndViewTarget(); ?>

<?
$hasActivities = !empty($arResult['PROPERTIES']['ACTIVITIES']['VALUE']);
$hasDoctorDescription = (mb_strlen($arResult['DETAIL_TEXT']) > 0);
?>
<? if ($hasActivities || $hasDoctorDescription) : ?>
	<section class="nb-section nb-activities-section">
		<div class="container">
			<div class="nb-section__header">
				<? if ($hasDoctorDescription) : ?>
					<div class="nb-activities-pretitle"><?= $arResult['DETAIL_TEXT'] ?></div>
				<? endif; ?>
				<? if ($hasActivities) : ?>
					<h2 class="nb-section__title">Основные <span class="font-weight_normal">направления деятельности</span></h2>
				<? endif; ?>
			</div>
			<? if ($hasActivities) : ?>
				<div class="nb-section__body">
					<ul class="nb-activities-list nb-activities-list_desktop">
						<? foreach ($arResult['PROPERTIES']['ACTIVITIES']['VALUE'] as $arItem) : ?>
							<?
							$arItemValues = $arItem['SUB_VALUES'];
							if (mb_strlen($arItemValues['NAME_ACTIVITIES']['VALUE']) == 0)
								continue;
							?>
							<li class="nb-activities-item">
								<? if (mb_strlen($arItemValues['LINK_ACTIVITIES']['VALUE']) > 0) : ?>
									<a class="nb-activities-item__link" href="<?= $arItemValues['LINK_ACTIVITIES']['VALUE'] ?>"><?= $arItemValues['NAME_ACTIVITIES']['VALUE'] ?></a>
								<? else: ?>
									<span class="nb-activities-item__link"><?= $arItemValues['NAME_ACTIVITIES']['VALUE'] ?></span>
								<? endif; ?>
							</li>
						<? endforeach; ?>
					</ul>
					<ul class="nb-activities-list nb-activities-list_mobile">
						<? foreach ($arResult['PROPERTIES']['ACTIVITIES']['VALUE'] as $arItem) : ?>
							<?
							$arItemValues = $arItem['SUB_VALUES'];
							if (mb_strlen($arItemValues['NAME_ACTIVITIES_M']['VALUE']) == 0)
								continue;
							?>
							<li class="nb-activities-item">
								<? if (mb_strlen($arItemValues['LINK_ACTIVITIES']['VALUE']) > 0) : ?>
									<a class="nb-activities-item__link" href="<?= $arItemValues['LINK_ACTIVITIES']['VALUE'] ?>"><?= $arItemValues['NAME_ACTIVITIES_M']['VALUE'] ?></a>
								<? else: ?>
									<span class="nb-activities-item__link"><?= $arItemValues['NAME_ACTIVITIES_M']['VALUE'] ?></span>
								<? endif; ?>
							</li>
						<? endforeach; ?>
					</ul>
				</div>
			<? endif; ?>
		</div>
	</section>
<? endif; ?>

<? if (!empty($arResult['PROPERTIES']['EDUCATION']['VALUE'])) : ?>
	<section class="nb-section nb-education-section">
		<div class="container">
			<div class="nb-section__header">
				<h2 class="nb-section__title">Образование</h2>
			</div>
			<div class="nb-section__body">
				<ul class="nb-education-list">
					<?
					usort($arResult['PROPERTIES']['EDUCATION']['VALUE'], function ($a, $b) {
						if ($a['SUB_VALUES']['EDUCATION_YEAR']['VALUE'] == $b['SUB_VALUES']['EDUCATION_YEAR']['VALUE']) {
							return 0;
						}
						return ($a['SUB_VALUES']['EDUCATION_YEAR']['VALUE'] < $b['SUB_VALUES']['EDUCATION_YEAR']['VALUE']) ? -1 : 1;
					});
					?>
					<? foreach ($arResult['PROPERTIES']['EDUCATION']['VALUE'] as $arItem) : ?>
						<?
						$arItemValues = $arItem['SUB_VALUES'];
						?>
						<li class="nb-education-item">
							<? if (mb_strlen($arItemValues['EDUCATION_YEAR']['VALUE']) > 0) : ?>
								<p class="nb-education-year"><?= $arItemValues['EDUCATION_YEAR']['VALUE'] ?></p>
							<? endif; ?>
							<? if (mb_strlen($arItemValues['EDUCATION_TEXT']['~VALUE']['TEXT']) > 0) : ?>
								<p class="nb-education-text"><?= $arItemValues['EDUCATION_TEXT']['~VALUE']['TEXT'] ?></p>
							<? endif; ?>
						</li>
					<? endforeach; ?>
				</ul>
			</div>
		</div>
	</section>
<? endif; ?>

<? if (!empty($arResult['PROPERTIES']['ADVANCED_TRAINING']['VALUE'])) : ?>
	<section class="nb-section nb-refresher-section">
		<div class="container">
			<div class="nb-section__header">
				<h2 class="nb-section__title">Курсы повышения квалификации,<br> <span class="font-weight_normal">мастер-классы, конгрессы и семинары</span>
				</h2>
			</div>
			<div class="nb-section__body">
				<ul class="nb-refresher-list">
					<?
					usort($arResult['PROPERTIES']['ADVANCED_TRAINING']['VALUE'], function ($a, $b) {
						if ($a['SUB_VALUES']['ADVANCED_TRAINING_YEAR']['VALUE'] == $b['SUB_VALUES']['ADVANCED_TRAINING_YEAR']['VALUE']) {
							return 0;
						}
						return ($a['SUB_VALUES']['ADVANCED_TRAINING_YEAR']['VALUE'] > $b['SUB_VALUES']['ADVANCED_TRAINING_YEAR']['VALUE']) ? -1 : 1;
					});
					?>
					<? foreach ($arResult['PROPERTIES']['ADVANCED_TRAINING']['VALUE'] as $k => $arItem) : ?>
						<?
						$arItemValues = $arItem['SUB_VALUES'];
						?>
						<li class="nb-refresher-item<? if ($k + 1 > 3) : ?> d-none<? endif; ?>">
							<? if (mb_strlen($arItemValues['ADVANCED_TRAINING_YEAR']['VALUE']) > 0) : ?>
								<p class="nb-refresher-year"><?= $arItemValues['ADVANCED_TRAINING_YEAR']['VALUE'] ?></p>
							<? endif; ?>
							<? if (mb_strlen($arItemValues['ADVANCED_TRAINING_TEXT']['~VALUE']['TEXT']) > 0) : ?>
								<?= str_replace('<ul>', '<ul class="nb-course-list">', $arItemValues['ADVANCED_TRAINING_TEXT']['~VALUE']['TEXT']) ?>
							<? endif; ?>
						</li>
					<? endforeach; ?>
				</ul>
				<? if (count($arResult['PROPERTIES']['ADVANCED_TRAINING']['VALUE']) > 3) : ?>
					<div class="nb-refresher-wrapper">
						<button class="nb-btn nb-btn_light nb-btn_shadow nb-pagination__btn" data-entity="more-refresher">Показать еще</button>
					</div>
				<? endif; ?>
			</div>
		</div>
	</section>
<? endif; ?>

<?
if (!empty($arResult["arSertificates"])) {
?>
	<section class="nb-section nb-section_dark nb-certificates-section">
		<div class="container">
			<div class="nb-section__header">
				<h2 class="nb-section__title">Сертификаты, <span class="font-weight_normal">награды и дипломы</span>
				</h2>
			</div>
			<div class="nb-section__body">
				<div class="nb-certificates">
					<div class="nb-certificates__container">
						<div class="nb-certificates__list">
							<?
							foreach ($arResult["arSertificates"] as $key => $val) {
							?>
								<div class="nb-certificates__col">
									<div class="nb-certificate">
										<a class="nb-certificate__link" href="<?= $val["SOURCE_IMG_PATH"]; ?>" data-fancybox="certificates">
											<div class="nb-certificate__img">
												<img src="<?= $val["THUMB_IMG_PATH"]; ?>" alt="<?= $val["DESC"]; ?>">
											</div>
											<div class="nb-certificate__desc">
												<p><?= $val["DESC"]; ?></p>
											</div>
										</a>
									</div>
								</div>
							<?
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<? } ?>

<?/*
//vardump($arResult['PROPERTIES']['SERTIFICATES']);	
if (!empty($arResult['PROPERTIES']['SERTIFICATES']['VALUE'])) :
?>
	<section class="nb-section nb-section_dark nb-certificates-section">
		<div class="container">
			<div class="nb-section__header">
				<h2 class="nb-section__title">Сертификаты, <span class="font-weight_normal">награды и дипломы</span>
				</h2>
			</div>
			<div class="nb-section__body">
				<div class="nb-certificates">
					<div class="nb-certificates__container">
						<div class="nb-certificates__list">
							<?
							foreach ($arResult['PROPERTIES']['SERTIFICATES']['VALUE'] as $key => $val) {
								$source_img_path = CFile::GetPath($val);
								$desc = $arResult['PROPERTIES']['SERTIFICATES']['DESCRIPTION'][$key];
								$arPicture = CFile::ResizeImageGet(
									$val,
									array('width' => 162, 'height' => 266),
									BX_RESIZE_IMAGE_EXACT,
									true
								);
								$thumb_img_path = $arPicture["src"];
							?>
								<div class="nb-certificates__col">
									<div class="nb-certificate">
										<a class="nb-certificate__link" href="<?= $source_img_path; ?>" data-fancybox="certificates">
											<div class="nb-certificate__img">
												<img src="<?= $thumb_img_path; ?>" alt="<?= $desc; ?>">
											</div>
											<div class="nb-certificate__desc">
												<p><?= $desc; ?></p>
											</div>
										</a>
									</div>
								</div>
							<?
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<? endif; */ ?>
<script type='application/ld+json'>
{
"@context": "http://www.schema.org",
"@type": "Physician",
"name": "<?=$arResult['NAME']?>",
"url": "https://rabbitstom.ru<?=$arResult["DETAIL_PAGE_URL"]?>",
"logo": "https://rabbitstom.ru<?= $arResult["DOCTOR_PHOTO"]['src'] ?>",
"image": "https://rabbitstom.ru<?= $arResult["DOCTOR_PHOTO"]['src'] ?>",
"description": "<?=$arResult['DISPLAY_PROPERTIES']["SPECIALIZATIONS"]['DISPLAY_VALUE']?>"
}
</script>