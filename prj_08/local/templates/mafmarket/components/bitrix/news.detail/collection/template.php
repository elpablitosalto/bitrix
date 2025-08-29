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
<div class="row">
	<div class="col-lg-5">
		<aside class="dp-page__aside">
			<div class="dp-aside dp-sticky">
				<div class="dp-page__back">
					<a href="/collections/">
						<svg class="icon icon-drop-left ">
							<use xlink:href="#drop-left"></use>
						</svg><span>Коллекции</span>
					</a>
				</div>
				<div class="h3 dp-aside__title">Коллекция <?= $arResult['NAME']; ?></div>
				<? if (!empty($arResult["DISPLAY_PROPERTIES"]["FILES"]["VALUE"])) { ?>
					<div class="dp-aside-filter">
						<div class="dp-aside-filter__item">
							<div class="dp-aside-filter__item-head">
								<div class="dp-aside-filter__item-title">Файлы коллекции</div>
							</div>
							<div class="dp-aside-filter__item-body">
								<div class="row">
									<? foreach ($arResult["DISPLAY_PROPERTIES"]["FILES"]["VALUE"] as $key => $val) { ?>
										<?
										$name = $val['SUB_VALUES']['FILES_NAME']['VALUE'];
										$link = $val['SUB_VALUES']['FILES_LINK']['VALUE'];
										?>
										<? if (!empty($name) && !empty($link)) { ?>
											<div class="col-auto">
												<a href="<?= $link; ?>" class="dp-btn dp-btn_xs dp-btn_outlined"><span><?= $name; ?></span>
													<svg class="icon icon-download ">
														<use xlink:href="#download"></use>
													</svg>
												</a>
											</div>
										<? } ?>
									<? } ?>
								</div>
							</div>
						</div>
					</div>
				<? } ?>
				<div class="dp-tags">
					<ul class="dp-tags__list dp-tags__list_column">
						<? if (!empty($arResult['PICTURES_SLIDER'])) { ?>
							<li class="dp-tags__item">
								<a class="dp-btn dp-btn_xs dp-btn_white" href="#collection-desc" data-anchor="#collection-gallery">
									<span>Фотографии и описание</span>
								</a>
							</li>
						<? } ?>
						<? if (!empty($arResult['MATERIALS'])) { ?>
							<li class="dp-tags__item">
								<a class="dp-btn dp-btn_xs dp-btn_white" href="#collection-materials" data-anchor="#collection-materials">
									<span>Материалы</span>
								</a>
							</li>
						<? } ?>
						<? if (!empty($arResult['PRODUCTS'])) { ?>
							<li class="dp-tags__item">
								<a class="dp-btn dp-btn_xs dp-btn_white" href="#collection-goods" data-anchor="#collection-goods">
									<span>Изделия</span>
								</a>
							</li>
						<? } ?>
					</ul>
				</div>
			</div>
		</aside>
	</div>
	<div class="col-lg-19">
		<div class="dp-page__body">
			<section class="dp-section dp-page-top-nav">
				<div class="container">
					<div class="dp-tags dp-tags-slider">
						<ul class="dp-tags__list dp-tags__list_">
							<? if (!empty($arResult["DISPLAY_PROPERTIES"]["FILES"]["VALUE"])) { ?>
								<li class="dp-tags__item"><a class="dp-btn dp-tag" href="#collection-files" data-anchor="#collection-files"><span>Файлы коллекции</span></a>
								</li>
							<? } ?>
							<? if (!empty($arResult["DISPLAY_PROPERTIES"]["H_TEXT_B"]["VALUE"])) { ?>
								<li class="dp-tags__item"><a class="dp-btn dp-tag" href="#collection-desc" data-anchor="#collection-desc"><span>Описание</span></a>
								</li>
							<? } ?>
							<? if (!empty($arResult['MATERIALS'])) { ?>
								<li class="dp-tags__item"><a class="dp-btn dp-tag" href="#collection-materials" data-anchor="#collection-materials"><span>Материалы</span></a>
								</li>
							<? } ?>
							<? if (!empty($arResult['PRODUCTS'])) { ?>
								<li class="dp-tags__item"><a class="dp-btn dp-tag" href="#collection-goods" data-anchor="#collection-goods"><span>Изделия</span></a>
								</li>
							<? } ?>
						</ul>
					</div>
				</div>
			</section>
			<?
			//if (!empty($arResult['PICTURES_SLIDER'])) { 
			if ($arResult['SHOW_SLIDER'] == 'Y') {
			?>
				<section class="dp-section dp-series-gallery" id="collection-gallery">
					<div class="container">
						<div class="dp-section__body">
							<div class="dp-series-gallery__main">
								<div class="dp-series-gallery__main-container">
									<div class="dp-series-gallery__main-wrapper">
										<? if (!empty($arResult['VIDEO_SLIDER'])) { ?>
											<div class="dp-series-gallery__main-item">
												<video poster="<?= $arResult['VIDEO_SLIDER_POSTER']['SRC']; ?>" autoplay muted>
													<source src="<?= $arResult['VIDEO_SLIDER']['SRC']; ?>" type="video/mp4">
												</video>
											</div>
										<? } ?>
										<? foreach ($arResult['PICTURES_SLIDER'] as $key => $val) { ?>
											<div class="dp-series-gallery__main-item">
												<picture>
													<img src="<?= $val['SRC']; ?>" alt="<?= $val['ALT']; ?>" title="<?= $val['TITLE']; ?>" />
												</picture>
											</div>
										<? } ?>
									</div>
								</div>
								<div class="dp-slider-arrows"></div>
							</div>
							<div class="dp-series-gallery__nav">
								<div class="dp-series-gallery__nav-container">
									<div class="dp-series-gallery__nav-wrapper">
										<? if (!empty($arResult['VIDEO_SLIDER'])) { ?>
											<div class="dp-series-gallery__nav-item">
												<picture><img src="<?= $arResult['VIDEO_SLIDER_POSTER']['SRC']; ?>" alt=""></picture>
											</div>
										<? } ?>

										<? foreach ($arResult['PICTURES_SLIDER'] as $key => $val) { ?>
											<div class="dp-series-gallery__nav-item">
												<picture>
													<img src="<?= $val['SRC']; ?>" alt="<?= $val['ALT']; ?>" title="<?= $val['TITLE']; ?>" />
												</picture>
											</div>
										<? } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			<? } ?>

			<? if (!empty($arResult["DISPLAY_PROPERTIES"]["FILES"]["VALUE"])) { ?>
				<section class="dp-section dp-series-mobile-filter">
					<div class="container">
						<div class="dp-series-mobile-filter__item collapsed" id="collection-files">
							<div class="dp-series-mobile-filter__item-head">
								<div class="dp-series-mobile-filter__item__item-title">Файлы коллекции</div>
							</div>
							<div class="dp-series-mobile-filter__item-body">
								<div class="row">
									<? foreach ($arResult["DISPLAY_PROPERTIES"]["FILES"]["VALUE"] as $key => $val) { ?>
										<?
										$name = $val['SUB_VALUES']['FILES_NAME']['VALUE'];
										$link = $val['SUB_VALUES']['FILES_LINK']['VALUE'];
										?>
										<? if (!empty($name) && !empty($link)) { ?>
											<div class="col-auto">
												<a href="<?= $link; ?>" class="dp-btn dp-btn_xs dp-btn_outlined"><span><?= $name; ?></span>
													<svg class="icon icon-download ">
														<use xlink:href="#download"></use>
													</svg>
												</a>
											</div>
										<? } ?>
									<? } ?>
								</div>
							</div>
						</div>
					</div>
				</section>
			<? } ?>

			<? if (!empty($arResult["DISPLAY_PROPERTIES"]["H_TEXT_B"]["VALUE"])) { ?>
				<section class="dp-section dp-section-desc" id="collection-desc">
					<div class="container">
						<div class="dp-section__header">
							<h2 class="h3 dp-section__title"><?= $arResult["DISPLAY_PROPERTIES"]["H_TEXT_B"]["VALUE"]; ?></h2>
						</div>
						<div class="dp-section__body">
							<?= $arResult["DISPLAY_PROPERTIES"]["D_TEXT_B"]["DISPLAY_VALUE"]; ?>
						</div>
					</div>
				</section>
			<? } ?>
			<? if (!empty($arResult['DESIGNERS'])) { ?>
				<section class="dp-section dp-series-info dp-series-designers">
					<div class="container">
						<div class="row">
							<div class="col-sm-auto">
								<div class="dp-section__header">
									<h5 class="dp-section__title">Дизайн:</h5>
								</div>
							</div>
							<div class="col-sm">
								<div class="dp-section__body">
									<ul class="dp-series-designers-list">
										<? foreach ($arResult['DESIGNERS'] as $key => $val) { ?>
											<li><a href="<?= $val['DETAIL_PAGE_URL']; ?>"><?= $val['NAME']; ?></a></li>
										<? } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</section>
			<? } ?>
			<? if (!empty($arResult['MANUFACTER'])) { ?>
				<section class="dp-section dp-series-info dp-series-manufacturer">
					<div class="container">
						<div class="row">
							<div class="col-sm-auto">
								<div class="dp-section__header">
									<h5 class="dp-section__title">Производитель</h5>
								</div>
							</div>
							<div class="col-sm">
								<div class="dp-section__body">
									<div class="dp-series-manufacturer-logo">
										<img src="<?= $arResult['MANUFACTER']['PICTURE']['SRC']; ?>" alt="<?= $arResult['MANUFACTER']['PICTURE']['ALT']; ?>" title="<?= $arResult['MANUFACTER']['PICTURE']['TITLE']; ?>" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			<? } ?>
			<? if (!empty($arResult['MATERIALS'])) { ?>
				<section class="dp-section dp-series-materials" id="collection-materials">
					<div class="container">
						<div class="dp-section__body">
							<? foreach ($arResult['MATERIALS'] as $key => $arMaterials) { ?>
								<div class="dp-section">
									<div class="h5 dp-section__title"><?= $arMaterials['SECTION']['HEADER'] ?>:</div>
									<div class="dp-item-list">
										<div class="row">
											<? foreach ($arMaterials['ITEMS'] as $k => $ar) { ?>
												<div class="col-auto">
													<div class="dp-series-materials__item">
														<img src="<?= $ar['PICTURE']['SRC']; ?>" alt="<?= $ar['PICTURE']['ALT']; ?>" title="<?= $ar['PICTURE']['TITLE']; ?>" />
													</div>
												</div>
											<? } ?>
										</div>
									</div><a class="dp-btn dp-btn_xs dp-section__link" href="<?= $arMaterials['SECTION']['SECTION_PAGE_URL'] ?>"><span><?= $arMaterials['SECTION']['TITLE'] ?></span></a>
								</div>
							<? } ?>
						</div>
					</div>
				</section>
			<? } ?>
			<? if (!empty($arResult['SECTIONS'])) { ?>
				<section class="dp-section dp-catalog-section" id="collection-goods">
					<div class="container">
						<div class="dp-section__header">
							<h2 class="dp-section__title">Изделия коллекции</h2>
						</div>
						<div class="dp-section__body">
							<div class="dp-item-list">
								<div class="row">
									<? foreach ($arResult['SECTIONS'] as $sId => $arS) { ?>
										<div class="col-sm-12 col-md-8">
											<a class="dp-catalog-item" href="<?= $arS['SECTION_PAGE_URL'] ?>" id="">
												<div class="dp-catalog-item__image">
													<picture>
														<img src="<?= $arS['PICTURE']['SRC']; ?>" alt="<?= $arS['PICTURE']['ALT']; ?>" title="<?= $arS['PICTURE']['TITLE']; ?>" />
													</picture>
												</div>
												<h4 class="dp-catalog-item__title"><?= $arS['NAME'] ?></h4>
												<div class="dp-catalog-item__subtitle"><?= Indexis::num2word($arS['CNT'], ['модель', 'модели', 'моделей']); ?></div>
											</a>
										</div>
									<? } ?>
								</div>
							</div>
						</div>
					</div>
				</section>
			<? } ?>
			<?/*?>
			<? if (!empty($arResult['PRODUCTS'])) { ?>
				<section class="dp-section dp-catalog-section" id="collection-goods">
					<div class="container">
						<div class="dp-section__header">
							<h2 class="dp-section__title">Изделия коллекции</h2>
						</div>
						<div class="dp-section__body">
							<div class="dp-item-list">
								<div class="row">
									<? foreach ($arResult['PRODUCTS'] as $key => $arProducts) { ?>
										<div class="col-sm-12 col-md-8">
											<a class="dp-catalog-item" href="<?= $arProducts['SECTION']['SECTION_PAGE_URL'] ?>" id="">
												<div class="dp-catalog-item__image">
													<picture>
														<img src="<?= $arProducts['SECTION']['PICTURE']['SRC']; ?>" alt="<?= $arProducts['SECTION']['PICTURE']['ALT']; ?>" title="<?= $arProducts['SECTION']['PICTURE']['TITLE']; ?>" />
													</picture>
												</div>
												<h4 class="dp-catalog-item__title"><?= $arProducts['SECTION']['NAME'] ?></h4>
												<div class="dp-catalog-item__subtitle"><?= Indexis::num2word(count($arProducts['ITEMS']), ['модель', 'модели', 'моделей']); ?></div>
											</a>
										</div>
									<? } ?>
								</div>
							</div>
						</div>
					</div>
				</section>
			<? } ?>
			<?*/ ?>
		</div>
	</div>
</div>