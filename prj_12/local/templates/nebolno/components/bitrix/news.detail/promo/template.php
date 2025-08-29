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
<div class="nb-top-banner" id="<?= $arParams['EDIT_AREA_ID'] ?>">
	<div class="nb-top-banner__caption" style="--color: <?= $arResult["code_color"]; ?>">
		<h1 class="nb-top-banner__title">
			<?= $arResult["NAME"] ?>
			<?
			if (strlen($arResult["PROPERTIES"]["NAME_PART_2"]["VALUE"]) > 0) {
			?>
				<span><?= $arResult["PROPERTIES"]["NAME_PART_2"]["VALUE"]; ?></span>
			<?
			}
			?>
		</h1>
		<? if (mb_strlen($arResult["price_after_format"]) > 0 || mb_strlen($arResult["price_before_format"]) > 0) { ?>
			<div class="nb-stock__price">
				<? if (mb_strlen($arResult["price_after_format"]) > 0) { ?>
					<?= $arResult["price_after_format"]; ?>
				<? } ?>
				<? if (mb_strlen($arResult["price_before_format"]) > 0) { ?>
					<span class="nb-stock__price-old">
						<?= $arResult["price_before_format"]; ?>
					</span>
				<? } ?>
			</div>
		<? } ?>
		<div class="nb-top-banner__desc">
			<p>
				<?= $arResult['PREVIEW_TEXT']; ?>
			</p>
		</div>
		<div class="nb-features nb-top-banner__features">
			<ul class="nb-features__list">
				<li class="nb-features__item nb-features__item-time">
					<span class="nb-features__icon"><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/timer.svg" alt=""></span>
					<span class="nb-features__desc">Акция действует <br>до <?= $arResult["before_date"]; ?></span>
				</li>
				<?
				if (!empty($arResult["arClinics"])) {
				?>
					<li class="nb-features__item nb-features__item-clinics">
						<span class="nb-features__icon"><img src="<?= SITE_TEMPLATE_PATH; ?>/img/design/mark.svg" alt=""></span>
						<span class="nb-features__desc">Акция проводится в клиниках:
							<ul class="nb-features__desc-ul">
								<?
								$i = 0;
								foreach ($arResult["arClinics"] as $item_id => $ar_item) {
									$i++;
									if ($i > 2) {
										break;
									}
								?>
									<li class="nb-features__desc-li">• <?= $ar_item["SCD_NAME"]; ?></li>
								<?
								}
								?>
							</ul>
							<?
							if (count($arResult["arClinics"]) > 2) {
							?>
								<span class="nb-features__desc-more">+ <?= Indexis::num2word((count($arResult["arClinics"]) - 2), array("клиника", "клиники", "клиник")) ?></span>
							<?
							}
							?>
						</span>
					</li>
				<?
				}
				?>
				<? if ($arParams['HIDE_TOP_BANNER_ON_MOBILE'] == 'Y') : ?>
					<li class="nb-features__item nb-features__item-btn">
						<a href="<?= $arResult['DETAIL_PAGE_URL'] ?>" class="nb-btn nb-btn_alyy">подробнее об акции</a>
					</li>
				<? endif; ?>
			</ul>
		</div>
	</div>
	<div class="nb-top-banner__img">
		<div class="nb-top-banner-slider">
			<div class="nb-top-banner-slider-container">
				<div class="nb-top-banner-slider-list">
					<div class="nb-top-banner-slider-item">
						<picture class="nb-top-banner-slider-item__img">
							<source media="(max-width: 480px)" srcset="<?= $arResult["img_src"]; ?>">
							<source media="(max-width: 991px)" srcset="<?= $arResult["img_src"]; ?>">
							<img src="<?= $arResult["img_src"]; ?>" alt="">
						</picture>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>