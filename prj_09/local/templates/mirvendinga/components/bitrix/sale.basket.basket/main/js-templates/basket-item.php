<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */

$usePriceInAdditionalColumn = in_array('PRICE', $arParams['COLUMNS_LIST']) && $arParams['PRICE_DISPLAY_MODE'] === 'Y';
$useSumColumn = in_array('SUM', $arParams['COLUMNS_LIST']);
$useActionColumn = in_array('DELETE', $arParams['COLUMNS_LIST']);

$restoreColSpan = 2 + $usePriceInAdditionalColumn + $useSumColumn + $useActionColumn;

$positionClassMap = array(
	'left' => 'basket-item-label-left',
	'center' => 'basket-item-label-center',
	'right' => 'basket-item-label-right',
	'bottom' => 'basket-item-label-bottom',
	'middle' => 'basket-item-label-middle',
	'top' => 'basket-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$shortProperties = [];
foreach($arParams['SHORT_PROPERTIES'] as $line) {
	$arLine = explode('|', $line);

	$label = !empty($arLine[0]) ? trim($arLine[0]) : '';
	$propKey = !empty($arLine[1]) ? trim($arLine[1]) : '';
	$shortProperties['SHORT_PROPERTY_'.$propKey] = $label;
}
?>
<script id="basket-item-template" type="text/html">
	<div class="cart__product"
		id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}"
	>
	{{#SHOW_RESTORE}}
		<div class="cart__message">
			<?=Loc::getMessage('SBB_GOOD_CAP')?> <strong>{{NAME}}</strong> <?=Loc::getMessage('SBB_BASKET_ITEM_DELETED')?>.
			<a class="link" href="javascript:void(0)" data-entity="basket-item-restore-button">
				<?=Loc::getMessage('SBB_BASKET_ITEM_RESTORE')?>
			</a>
		</div>
	{{/SHOW_RESTORE}}
	{{^SHOW_RESTORE}}
		<div class="cart-product">
			<div class="cart-product__main">
				<?
				if (in_array('PREVIEW_PICTURE', $arParams['COLUMNS_LIST']))
					{
				?>
					{{#DETAIL_PAGE_URL}}
						<a href="{{DETAIL_PAGE_URL}}" class="cart-product__illustration">
							<picture class="cart-product__picture">
								<img alt="{{NAME}}" src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?=SITE_TEMPLATE_PATH?><?=IMAGE_NOT_FOUND?>{{/IMAGE_URL}}" class="cart-product__image lazyload lazyload_entered lazyload_loaded">
							</picture>
						</a>
					{{/DETAIL_PAGE_URL}}
				<?}?>

				<div class="cart-product__info">
					<div class="cart-product__price-group cart-product__price-group_type_mobile">
							<!-- begin .price-group-->
							<div class="price-group price-group_size_s price-group_order_reversed price-group_order_m-normal">
									<div class="price-group__extra">
											{{#SHOW_DISCOUNT_PRICE}}
												<div class="price-group__price price-group__price_type_old">
														<span class="price-group__value">{{{SUM_FULL_PRICE_FORMATED}}}</span>
												</div>
											{{/SHOW_DISCOUNT_PRICE}}
									</div>
									<div class="price-group__main">
											<div class="price-group__price">
													<span class="price-group__value">
															{{{SUM_PRICE_FORMATED}}}
													</span>
											</div>
									</div>
							</div>
							<!-- end .price-group-->
					</div>

					<div class="cart-product__title">
							<a href="{{DETAIL_PAGE_URL}}" class="cart-product__link">{{NAME}}</a>
					</div>

					<?if(count($shortProperties) > 0):?>
						<div class="cart-product__props">
								<!-- begin .props-->
								<div class="props">
										<?foreach($shortProperties as $propKey=>$propLabel):?>
										<?='{{#'.$propKey.'}}'?>
											<div class="props__prop">
													<div class="props__label"><?=$propLabel?></div>
													<div class="props__value"><?='{{{'.$propKey.'}}}'?></div>
											</div>
										<?='{{/'.$propKey.'}}'?>
										<?endforeach?>
								</div>
								<!-- end .props-->
						</div>
					<?endif;?>
				</div>
			</div>

			<div class="cart-product__price-group">
					<!-- begin .price-group-->
					<div class="price-group price-group_size_s">
							<div class="price-group__extra">
									{{#SHOW_DISCOUNT_PRICE}}
										<div class="price-group__price price-group__price_type_old">
												<span class="price-group__value">{{{FULL_PRICE_FORMATED}}}/{{{MEASURE_TEXT}}}</span>
										</div>
									{{/SHOW_DISCOUNT_PRICE}}
							</div>
							<div class="price-group__main">
									<div class="price-group__price">
											<span class="price-group__value">{{{PRICE_FORMATED}}}/{{{MEASURE_TEXT}}}</span>
									</div>
							</div>
					</div>
					<!-- end .price-group-->
			</div>
			<div class="cart-product__sum">
					<div class="cart-product__price hide-up-m">{{{PRICE_FORMATED}}}/{{{MEASURE_TEXT}}}</div>
					<div class="cart-product__price hide-m">{{{SUM_PRICE_FORMATED}}}</div>
			</div>
			<div class="cart-product__quantity" data-entity="basket-item-quantity-block">
					<!-- begin .quantity-input-->
					<div class="quantity-input quantity-input_width_standard">
							<div class="quantity-input__wrapper">
									<div class="quantity-input__control">
											<button
												data-entity="basket-item-quantity-minus"
												type="button"
												class="quantity-input__button quantity-input__button_type_decrease"
											>
													Убавить
											</button>
									</div>
									<div class="quantity-input__field">
											<input
											id="basket-item-quantity-{{ID}}"
												type="number"
												value="{{QUANTITY}}"
												min="1"
												max="{{{AVAILABLE_QUANTITY}}}"
												data-min="1"
												data-max="{{{AVAILABLE_QUANTITY}}}"
												data-value="{{QUANTITY}}"
												data-entity="basket-item-quantity-field"
												class="quantity-input__input"
											>
									</div>
									<div class="quantity-input__control">
											<button
												data-entity="basket-item-quantity-plus"
												type="button"
												class="quantity-input__button quantity-input__button_type_increase"
											>
													Добавить
											</button>
									</div>
							</div>
							{{#CHECK_MAX_QUANTITY_BOOL}}
								<div class="quantity-input__note">
									Доступное количество – {{{AVAILABLE_QUANTITY}}} шт.
								</div>
							{{/CHECK_MAX_QUANTITY_BOOL}}
					</div>
					<!-- end .quantity-input-->
			</div>
			<button class="cart-product__remove-control" data-entity="basket-item-delete">Удалить товар</button>
		</div>
	{{/SHOW_RESTORE}}
</script>