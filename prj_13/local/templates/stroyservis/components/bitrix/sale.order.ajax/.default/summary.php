<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$index = 0;
$maxProductCountToShow = 13;
$allProductCount = count($arResult["GRID"]["ROWS"]);
?>
<div class="order__section">
	<div class="order__section-wrapper">
		<div class="order__title-wrapper">
			<h2> Товары в заказе</h2><span>Сумма <span class="order__sum"><?=str_replace('&#8381;', '<span>&#8381;</span>', $arResult["ORDER_PRICE_FORMATED"])?></span></span>
		</div>
		<p class="order__quantity">
			<?=Indexis::num2word(
				$allProductCount,
				['#NUM# товар в заказе', '#NUM# товара в заказе', '#NUM# товаров в заказе']
			)?>
		</p>
	</div>
	<ul class="order__product-list">
		<?foreach($arResult["GRID"]["ROWS"] as $arRow):?>
			<li>
				<a href="<?=$arRow['data']['DETAIL_PAGE_URL']?>">
					<img src="<?=(!empty($arRow['data']['PREVIEW_PICTURE_SRC']) ? $arRow['data']['PREVIEW_PICTURE_SRC'] : $arRow['data']['DETAIL_PICTURE_SRC'])?>" alt="<?=$arRow['data']['NAME']?>" title="<?=$arRow['data']['NAME']?>">
				</a>
			</li>
			<?
			$index++;
			if ($index == $maxProductCountToShow)
				break;
			?>
		<?endforeach;?>
		<?if ($index == $maxProductCountToShow):?>
			<li><a href="javascript:void(0);"><?=($allProductCount - $maxProductCountToShow)?>+</a></li>
		<?endif;?>
	</ul>
	<a class="order__link" href="<?=$arParams['PATH_TO_BASKET']?>">Изменить</a>
</div>