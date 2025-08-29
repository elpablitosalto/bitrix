<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */
?>
<a class="nb-doctor__link" href="<?= $item['DETAIL_PAGE_URL'] ?>">
	<div class="nb-doctor__main">
		<div class="nb-doctor__img">
			<?
			if ($arParams['TEMPLATE'] == 'slider' && !empty($item['PROPERTIES']['ALT_PICTURE_3']['VALUE']))
				$item['PREVIEW_PICTURE']['SRC'] = CFile::GetPath($item['PROPERTIES']['ALT_PICTURE_3']['VALUE']);
			?>
			<div class="nb-doctor__img-container">
				<img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $imgAlt ?>" />
			</div>
			<span class="nb-doctor__more">
				<svg class="icon icon-btn-arrow">
					<use xlink:href="#btn-arrow"></use>
				</svg>
				<span>Больше о докторе</span>
			</span>
		</div>
		<div class="nb-doctor__caption">
			<div class="nb-doctor__name">
				<?
				$arPartName = array_filter(array_map('trim', explode(' ', $item['NAME'])));
				$arClassName = [
					'nb-doctor__second-name',
					'nb-doctor__first-name',
					'nb-doctor__middle-name',
				];
				?>
				<? foreach ($arPartName as $index => $partName) : ?>
					<? if (!isset($arClassName[$index])) break; ?>
					<span class="<?= $arClassName[$index] ?>"><?= $partName ?></span>
				<? endforeach; ?>
			</div>
			<div class="nb-doctor__desc">
				<ul>
					<? foreach (['POSITION', 'SPECIALIZATIONS', 'ACADEMIC_DEGREE'] as $code) : ?>
						<?
						if (is_array($item['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE'])) {
							$hasValue = count($item['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE']) > 0;
							$displayValue = implode(', ', $item['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE']);
						} else {
							$hasValue = mb_strlen($item['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE']) > 0;
							$displayValue = $item['DISPLAY_PROPERTIES'][$code]['DISPLAY_VALUE'];
						}
						?>
						<? if ($hasValue) : ?>
							<li<? if ($code == 'ACADEMIC_DEGREE') : ?> class="font-weight_bold" <? endif; ?>><?= $displayValue ?></li>
							<? endif; ?>
						<? endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="nb-doctor__footer">
		<? if (mb_strlen($item['DISPLAY_PROPERTIES']['WORK_WITH']['VALUE']) > 0) : ?>
			<?
			$d1 = new DateTime();
			$d2 = new DateTime($item['DISPLAY_PROPERTIES']['WORK_WITH']['VALUE']);
			$diff = $d2->diff($d1);
			?>
			<div class="nb-doctor__experience">
				<span class="nb-doctor__experience-title"><span>СТАЖ РАБОТЫ:</span></span>
				<span class="nb-doctor__experience-value"><?= Indexis::num2word($diff->y, ['<span>#NUM#</span> год', '<span>#NUM#</span> года', '<span>#NUM#</span> лет']) ?></span>
			</div>
		<? endif; ?>
		<? if (!empty($item['DISPLAY_PROPERTIES']['RATING_SBERHEALTH']['VALUE']) || !empty($item['DISPLAY_PROPERTIES']['RATING_PRODOCTOROV']['VALUE'])) : ?>
			<div class="nb-doctor__meta nb-doctor__rating">
				<span class="nb-doctor__meta-title">Рейтинги:</span>
				<ul class="nb-doctor__meta-list">
					<? if (!empty($item['DISPLAY_PROPERTIES']['RATING_SBERHEALTH']['VALUE'])) : ?>
						<li class="nb-doctor__meta-item">
							<span class="nb-doctor__meta-item-title">СБЕРЗДОРОВЬЕ</span>
							<span class="nb-doctor__meta-item-value">
								<svg class="icon icon-star">
									<use xlink:href="#star"></use>
								</svg>
								<span><?= number_format($item['DISPLAY_PROPERTIES']['RATING_SBERHEALTH']['VALUE'], 1, ',',  ' ') ?></span>
							</span>
						</li>
					<? endif; ?>
					<? if (!empty($item['DISPLAY_PROPERTIES']['RATING_PRODOCTOROV']['VALUE'])) : ?>
						<li class="nb-doctor__meta-item">
							<span class="nb-doctor__meta-item-title">ПРОДОКТОРОВ</span>
							<span class="nb-doctor__meta-item-value">
								<svg class="icon icon-star">
									<use xlink:href="#star"></use>
								</svg>
								<span><?= number_format($item['DISPLAY_PROPERTIES']['RATING_PRODOCTOROV']['VALUE'], 1, ',',  ' ') ?></span>
							</span>
						</li>
					<? endif; ?>
				</ul>
			</div>
		<? endif; ?>
		<? if (is_array($item['DISPLAY_PROPERTIES']['CLINICS']['LINK_ELEMENT_VALUE']) && count($item['DISPLAY_PROPERTIES']['CLINICS']['LINK_ELEMENT_VALUE']) > 0) : ?>
			<div class="nb-doctor__meta nb-doctor__appointment">
				<span class="nb-doctor__meta-title">Прием:</span>
				<ul class="nb-doctor__meta-list">
					<? foreach ($item['DISPLAY_PROPERTIES']['CLINICS']['CUSTOM_DISPLAY_VALUE'] as $metroName) : ?>
						<li class="nb-doctor__meta-item"><span class="nb-doctor__meta-item-title"><?= $metroName ?></span></li>
					<? endforeach; ?>

					<?/*?>
					<? foreach ($item['DISPLAY_PROPERTIES']['CLINICS']['LINK_ELEMENT_VALUE'] as $arClinic) : ?>
						<li class="nb-doctor__meta-item"><span class="nb-doctor__meta-item-title"><?= $arClinic['NAME'] ?></span></li>
					<? endforeach; ?>
					<?*/?>
				</ul>
			</div>
		<? endif; ?>
	</div>
</a>
<button class="nb-btn nb-btn-arrow nb-doctor__btn js_popup_doctor" type="button" data-modal="#modal-call" data-doctor-id="<?= $item["ID"]; ?>">
	<svg class="icon icon-btn-arrow">
		<use xlink:href="#btn-arrow"></use>
	</svg>
	<span>Запись на прием</span>
</button>