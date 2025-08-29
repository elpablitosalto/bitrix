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
<img class="bbimg" loading="lazy" data-size="M"
	 src="<?=$item['PREVIEW_PICTURE']['SRC']?>"
	 sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw"
	 style="object-position:50% 50%;"
	 width="570" height="255" alt="<?=$imgAlt?>" title="<?=$imgTitle?>"
/>
<div class="content">
	<div class="title "><?=$productTitle?></div>
	<?if($item["PREVIEW_TEXT"]):?>
		<div class="text d"><?=$item["PREVIEW_TEXT"];?></div>
		<?/*?>
		<p class="text d"><?=$item["PREVIEW_TEXT"];?></p>
		<?*/?>
	<?endif;?>
</div>