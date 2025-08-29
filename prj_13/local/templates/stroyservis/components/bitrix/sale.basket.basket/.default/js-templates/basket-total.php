<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
	<p class="basket__total-title">Ваша корзина</p>
	<div class="basket__total-price">
		<?/*<dl class="basket__total-products">
			<dt>Товары (<span class="basket__total-quantity"><?=(is_array($arResult['BASKET_ITEM_RENDER_DATA']) ? count($arResult['BASKET_ITEM_RENDER_DATA']) : 0)?></span>)</dt>
			<dd data-entity="basket-total-price">
				{{{PRICE_FORMATED}}}
			</dd>
		</dl>*/?>
		{{#WEIGHT_FORMATED}}
			<dl class="basket__total-weight">
				<dt><?=Loc::getMessage('SBB_WEIGHT')?></dt>
				<dd>{{{WEIGHT_FORMATED}}}</dd>
			</dl>
		{{/WEIGHT_FORMATED}}
		<dl class="basket__total-total">
			<dt>Итого</dt>
			<dd data-entity="basket-total-price">{{{PRICE_FORMATED}}}</dd>
		</dl>
	</div>
	<button class="button-orange basket__total-button" {{#DISABLE_CHECKOUT}} disabled{{/DISABLE_CHECKOUT}} data-entity="basket-checkout-button">
		<?=Loc::getMessage('SBB_ORDER')?>
	</button>
	<button type="button" class="button-white basket__total-button basket__button-fast-order" id="js_quick_order" data-product-id="-1">Быстрый заказ</button>
	<dl class="basket__total-points">
		<dt><span>Количество баллов за покупку</span></dt>
		<dd>{{{BONUS}}}</dd>
	</dl>
</script>