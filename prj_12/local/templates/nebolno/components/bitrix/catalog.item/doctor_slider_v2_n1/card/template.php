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
<?/*?><div class="nb-doctor"><?*/ ?>
<div class="nb-doctor__main">
	<div class="nb-doctor__img">
		<div class="nb-doctor__img-container">
			<img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $item['NAME']; ?>">
		</div>
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
						<li<? if ($code == "ACADEMIC_DEGREE") { ?> class="font-weight_bold" <? } ?>><?= $displayValue ?></li>
						<? endif; ?>
					<? endforeach; ?>
			</ul>
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
				<div class="nb-doctor-rating-table">
					<div class="nb-doctor-rating-table__header">
						<span class="nb-doctor-rating-table__title">Независимые рейтинги</span>
						<span class="nb-doctor-rating-table__scale">(5 баллов)</span>
					</div>
					<div class="nb-doctor-rating-table__body">
						<ul class="nb-doctor-rating-table__list">
							<? if (!empty($item['DISPLAY_PROPERTIES']['RATING_SBERHEALTH']['VALUE'])) : ?>
								<li class="nb-doctor-rating-table__item">
									<div class="nb-doctor-rating-table__logo">
										<img src="<?= SITE_TEMPLATE_PATH ?>/img/design/sber-health.png" alt="Сбер Здоровье">
										<span>Сберздоровье</span>
									</div>
									<span class="nb-doctor-rating-table__value">
										<svg class="icon icon-star ">
											<use xlink:href="#star"></use>
										</svg>
										<span><?= number_format($item['DISPLAY_PROPERTIES']['RATING_SBERHEALTH']['VALUE'], 1, ',',  ' ') ?></span>
									</span>
								</li>
							<? endif; ?>
							<? if (!empty($item['DISPLAY_PROPERTIES']['RATING_PRODOCTOROV']['VALUE'])) : ?>
								<li class="nb-doctor-rating-table__item">
									<div class="nb-doctor-rating-table__logo">
										<img src="<?= SITE_TEMPLATE_PATH ?>/img/design/prodoctorov.png" alt="Продокторов">
										<span>Продокторов</span>
									</div>
									<span class="nb-doctor-rating-table__value">
										<svg class="icon icon-star ">
											<use xlink:href="#star"></use>
										</svg>
										<span><?= number_format($item['DISPLAY_PROPERTIES']['RATING_PRODOCTOROV']['VALUE'], 1, ',',  ' ') ?></span>
									</span>
								</li>
							<? endif; ?>
						</ul>
					</div>
				</div>
			<? endif; ?>
			<? if (is_array($item['DISPLAY_PROPERTIES']['CLINICS']['LINK_ELEMENT_VALUE']) && count($item['DISPLAY_PROPERTIES']['CLINICS']['LINK_ELEMENT_VALUE']) > 0) : ?>
				<div class="nb-doctor-clinics">
					<div class="nb-doctor-clinics__icon">
						<svg class="icon icon-mark-stroke ">
							<use xlink:href="#mark-stroke"></use>
						</svg>
					</div>
					<?if (is_array($item['DISPLAY_PROPERTIES']['CLINICS']['CUSTOM_DISPLAY_VALUE']) && count($item['DISPLAY_PROPERTIES']['CLINICS']['CUSTOM_DISPLAY_VALUE']) > 0):?>
						<div class="nb-doctor-clinics__caption">
							<span class="nb-doctor-clinics__title">
								<span>Ведет прием в клиниках «Белый кролик»:</span>
							</span>
							<ul class="nb-doctor-clinics__list">
								<? foreach ($item['DISPLAY_PROPERTIES']['CLINICS']['CUSTOM_DISPLAY_VALUE'] as $metroName) : ?>
									<li class="nb-doctor-clinics__item"><?= $metroName ?></li>
								<? endforeach; ?>
							</ul>
						</div>
					<?endif;?>
				</div>
			<? endif; ?>
			<button class="nb-btn nb-btn-arrow nb-doctor__btn js_popup_doctor" type="button" data-modal="#modal-call" data-doctor-id="<?=$item["ID"];?>">
				<svg class="icon icon-btn-arrow ">
					<use xlink:href="#btn-arrow"></use>
				</svg>
				<span>Запись на прием</span>
			</button>
			<a class="nb-doctor__more" href="<?= $item['DETAIL_PAGE_URL'] ?>">
				<svg class="icon icon-btn-arrow ">
					<use xlink:href="#btn-arrow"></use>
				</svg>
				<span>Узнать больше о докторе</span>
			</a>
		</div>
	</div>
	<div class="nb-doctor__bg" style="background-image:url(<?= SITE_TEMPLATE_PATH ?>/img/content/doctors/doctor-big-slide-bg.jpg)"></div>
</div>
<?/*?></div><?*/ ?>