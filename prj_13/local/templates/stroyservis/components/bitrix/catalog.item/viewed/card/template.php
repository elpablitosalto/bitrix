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
<div class="viewed__image">
	<?/*?>
	<img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $imgAlt ?>" title="<?= $imgTitle ?>">
	<?*/ ?>
	<img loading="lazy" width="176" height="136" src="<?= $item['PICTURE']['SRC'] ?>" alt="<?= $imgAlt ?>" title="<?= $imgTitle ?>" />
</div>
<p class="viewed__title"><?= $productTitle ?></p>
<?
//vardump($item);
?>

<?
// Скрывать цену -->
if (intval($item['ID']) > 0) {
	$arSelect = false;
	$arFilter = array("ID" => $item['ID']);
	$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	if ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		$arFields['PROPERTIES'] = $ob->GetProperties();

		$item['HIDE_PRICE'] = $arFields['PROPERTIES']['PRICE_HIDE']['VALUE'];

		//echo ' = ' . $arFields['ID'] . '<br />';
		//echo ' = ' . $arFields['PROPERTIES']['PRICE_HIDE']['VALUE'] . '<br />';
	}
}
//echo 'HIDE_PRICE = '.$item['HIDE_PRICE'].'<br />';
// <-- Скрывать цену

if ($item['HIDE_PRICE'] != 'Y') { ?>
	<?
	if ($arParams['SHOW_OLD_PRICE'] === 'Y') {
	?>
		<div class="product-item-price-old" id="<?= $itemIds['PRICE_OLD'] ?>" <?= ($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '') ?>>
			<?= $price['PRINT_RATIO_BASE_PRICE'] ?>
		</div>&nbsp;
	<?
	}
	?>
	<div class="viewed__price" id="<?= $itemIds['PRICE'] ?>">
		<?
		if (!empty($price)) {
			if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers) {
				echo Loc::getMessage(
					'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
					array(
						'#PRICE#' => $price['PRINT_RATIO_PRICE'],
						'#VALUE#' => $measureRatio,
						'#UNIT#' => $minOffer['ITEM_MEASURE']['TITLE']
					)
				);
			} else {
				echo $price['PRINT_RATIO_PRICE'];
			}
		}
		?>
	</div>
<? } ?>