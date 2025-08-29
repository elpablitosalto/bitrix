<?
define('REMOVE_H1_TITLE', true);
define('SHOW_MAP_AFTER_CONTENT', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
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
			</div>
			<div class="section__content">
				<div class="section__map">
					<!-- begin .map-->
					<div class="map">
						<div class="delivery_price_map" id="map_delivery_zones" style="height: 679px;background-image: url('<?= SITE_TEMPLATE_PATH ?>/images/loading_maps.gif'); background-repeat: no-repeat; background-position: 50% 50%;"></div>
						<?
						// Подключение Яндекс.Карт -->
						if (true) {
							$asset = \Bitrix\Main\Page\Asset::getInstance();
							$asset->addJs(YA_MAPS_LINK);
						} else if (false) {
							$asset = \Bitrix\Main\Page\Asset::getInstance();
							//$coordorder = 'coordorder=longlat';
							$coordorder = 'coordorder=latlong';
							$asset->addJs(YA_MAPS_LINK . '&' . $coordorder);
						}
						// <-- Подключение Яндекс.Карт
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

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>