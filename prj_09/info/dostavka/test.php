<?
define('REMOVE_H1_TITLE', true);
//define('SHOW_MAP_AFTER_CONTENT', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
if ($USER->IsAdmin()) {

	$APPLICATION->SetPageProperty("description", "Самостоятельно доставляем заказы до двери по Москве и ближайшему Подмосковью. А также по всей территории России через транспортные компании.");
	$APPLICATION->SetPageProperty("title", "Условия доставки");
	$APPLICATION->SetTitle("Доставка");
?>
	<?
	$APPLICATION->IncludeFile(
		SITE_DIR . '/include/delivery.php',
		array(),
		array('SHOW_BORDER' => false)
	);
	?>

	<? if ($USER->IsAdmin()) { ?>
		<?
		//$IBLOCK_ID = BitrixTools::getIblockId('DELIVERY_ZONE_ON_MAP');	
		//echo 'IBLOCK_ID = '.$IBLOCK_ID.'<br />';
		?>
		<div class="page__section">
			<div class="page__container">
				<!-- begin .section-->
				<div class="section">
					<div class="section__header section__header_type_l-inline">
						<div class="section__title">
							<!-- begin .title-->
							<div class="title title_size_h1">Зоны доставки</div>
							<!-- end .title-->
						</div>
						<?/*?>
				<div class="section__extra">
					<div class="section__nav">
						<!-- begin .nav-->
						<nav class="nav nav_type_secondary" data-for-map="mainMap">
							<ul class="nav__list">
								<?php foreach ($arResult['SECTIONS'] as &$arSection) : ?>
									<?php if (!empty($arSection['ITEMS'])) : ?>
										<li class="nav__item">
											<button class="nav__link js-map-filter" type="button" data-map-region-code="map-region-<?= $arSection['ID'] ?>" data-active-class="nav__link_state_active"><?= $arSection['NAME'] ?></button>
										</li>
									<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</nav>
						<!-- end .nav-->
					</div>
				</div>
				<?*/ ?>
					</div>
					<div class="section__content">
						<div class="section__map">
							<!-- begin .map-->
							<div class="map">
								<div class="delivery_price_map" id="map_delivery_zones" style="height: 679px;background-image: url('<?= SITE_TEMPLATE_PATH ?>/images/loading_maps.gif'); background-repeat: no-repeat; background-position: 50% 50%;"></div>
								<?
								$asset = \Bitrix\Main\Page\Asset::getInstance();
								?>
								<?
								//$coordorder = 'longlat';
								$coordorder = 'latlong';
								$asset->addJs("https://api-maps.yandex.ru/2.1/?coordorder=" . $coordorder . "&apikey=e0711a3e-e4c8-4a95-9aea-f3ced170b65d&lang=ru_RU");
								?>
								<script src="<?= SITE_TEMPLATE_PATH ?>/js/delivery_zones.js" type="text/javascript"></script>
								<?/*?>
						<div data-region="" data-center="<?= $arParams['MAP_CENTER'] ?>" data-zoom="<?= $arParams['MAP_ZOOM'] ?>" data-map-id="mainMap" class="map__panel js-map"></div>
						<?*/ ?>
							</div>
							<!-- end .map-->
						</div>
					</div>
				</div>
				<!-- end .section-->
			</div>
		</div>
	<? } ?>

<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>