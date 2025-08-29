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

//vardump($item);
$arIBlockElement = GetIBlockElement($item["ID"]);
$item['PROPERTIES'] = $arIBlockElement['PROPERTIES'];

// Цены -->
if (!empty($item['PROPERTIES']['PRICE_BEFORE']['VALUE'])) {
	$price_before_format = Indexis::getPriceFormatted(
		$item['PROPERTIES']['PRICE_BEFORE']['VALUE'],
		'RUB', 'N', 'N'
	);
}
if (!empty($item['PROPERTIES']['PRICE_AFTER']['VALUE'])) {
	$price_after_format = Indexis::getPriceFormatted(
		$item['PROPERTIES']['PRICE_AFTER']['VALUE'],
		'RUB', 'N', 'N'
	);
}
// <-- Цены

// Дата -->
if (!empty($item['ACTIVE_TO'])) {
	//echo 'ACTIVE_TO = '.$item['ACTIVE_TO'].'<br />';
	$before_date = Indexis::getDateFormatted(
		$item['ACTIVE_TO']
	);
}
// <-- Дата

// Картинка -->
$arPicture = CFile::ResizeImageGet(
	$item['PREVIEW_PICTURE']['ID'],
	array('width' => 174, 'height' => 174),
	BX_RESIZE_IMAGE_EXACT,
	true
);
//$arPicture["src"] = "/img/content/affiliate/affiliate1.png";
// <--

// Цвет блока -->
//vardump($arItem);
$code_color = $item['PROPERTIES']['BACKG_CLR']['VALUE_XML_ID'];
// <--
?>
<?/*?><div class="swiper-slide nb-stocks--slide"><?*/ ?>
<div class="nb-stock nb-stock--<?= $code_color; ?>">
	<a class="nb-stock__link" href="<?= $item['DETAIL_PAGE_URL'] ?>">
		<div class="nb-stock__main">
			<?
			//echo 'price_before_format = '.$price_before_format.'<br />';
			//echo 'price_after_format = '.$price_after_format.'<br />';
			?>

			<div class="nb-stock__top">
				<div class="nb-stock__label">Акция</div>
				<? if (!empty($price_before_format) || !empty($price_after_format)) { ?>
					<div class="nb-stock__price">
						<? if (!empty($price_after_format)) { ?>
							<?= $price_after_format ?>
						<? } ?>
						<? if (!empty($price_before_format)) { ?>
							<span class="nb-stock__price-old">
								<?= $price_before_format ?>
							</span>
						<? } ?>
					</div>
				<? } ?>
			</div>

			<div class="nb-stock__content">
				<div class="nb-stock__title">
					<?= $item['NAME']; ?>
					<span class="nb-stock__title-color"><?= $item['PROPERTIES']['NAME_PART_2']['VALUE']; ?></span>
				</div>
				<? if (!empty($before_date)) { ?>
					<div class="nb-stock__limit">Акция действует до <?= $before_date; ?></div>
				<? } ?>
			</div>
			<div class="nb-stock__img"><img src="<?= $arPicture["src"]; ?>" alt=""></div>
		</div>
	</a>
</div>
<?/*?></div><?*/ ?>