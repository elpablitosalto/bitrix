<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="order__total-price">
	<dl class="order__total-products">
		<dt><?=GetMessage("SOA_TEMPL_SUM_SUMMARY")?></dt>
		<dd><?=$arResult["ORDER_PRICE_FORMATED"]?></dd>
	</dl>
	<dl class="order__total-weight">
		<dt><?=GetMessage("SOA_TEMPL_SUM_WEIGHT_SUM")?></dt>
		<dd><?=$arResult["ORDER_WEIGHT_FORMATED"]?></dd>
	</dl>
	<?if (doubleval($arResult["DELIVERY_PRICE"]) > 0):?>
		<dl class="order__total-delivery">
			<dt><?=GetMessage("SOA_TEMPL_SUM_DELIVERY")?></dt>
			<dd><?=$arResult["DELIVERY_PRICE_FORMATED"]?></dd>
		</dl>
	<?endif;?>
	<dl class="order__total-total">
		<dt><?=GetMessage("SOA_TEMPL_SUM_IT")?></dt>
		<dd><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></dd>
	</dl>
</div>
<div class="order__error" >Дайте согласие на обработку персональных данных</div>
<button id="ORDER_CONFIRM_BUTTON" class="button-orange order__total-button" onclick="submitForm('Y'); return false;"><?=GetMessage("SOA_TEMPL_BUTTON")?></button>
<?/**/?><button type="button" class="button-white order__total-button" id="js_quick_order" data-product-id="-1">Быстрый заказ</button><?/**/?>
<?/*?><a class="button-white order__total-button" id="js_quick_order" data-product-id="-1">Быстрый заказ</a><?*/?>
<dl class="order__total-points">
	<dt><span>Количество баллов за покупку</span></dt>
	<dd><?=Indexis::getBonusValueByPrice($arResult["ORDER_PRICE"])?></dd>
</dl>
