<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
		<?
		if ($arParams['HIDE_COUPON'] !== 'Y')
		{
			?>
			<div class="cart__promocode-form">
				<!-- begin .promocode-form-->
				<div class="promocode-form">
						<div class="promocode-form__info">
								<div class="promocode-form__title">Промокод</div>
								<div class="basket-coupon-alert-section">
									<div class="basket-coupon-alert-inner">
										{{#COUPON_LIST}}
										<div class="basket-coupon-alert text-{{CLASS}}">
											<span class="basket-coupon-text">
												<strong>{{COUPON}}</strong> - <?=Loc::getMessage('SBB_COUPON')?> {{JS_CHECK_CODE}}
												{{#DISCOUNT_NAME}}({{DISCOUNT_NAME}}){{/DISCOUNT_NAME}}
											</span>
											<span class="close-link" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}">
												<?=Loc::getMessage('SBB_DELETE')?>
											</span>
										</div>
										{{/COUPON_LIST}}
									</div>
								</div>
								<div class="promocode-form__text">
										Если у вас есть промокод, введите его
								</div>
						</div>
						<div class="promocode-form__main">
								<div class="promocode-form__line">
										<div class="promocode-form__field">
												<input type="text" class="promocode-form__input id="" placeholder="" data-entity="basket-coupon-input" class="promocode-form__input">
										</div>
										<div class="promocode-form__control">
												<!-- begin .button-->
												<button
														class="button button_width_full button_style_outline"
														type="button"
												>
														<span class="button__holder">Применить</span>
												</button>
												<!-- end .button-->
										</div>
								</div>
						</div>
				</div>
				<!-- end .promocode-form-->
			</div>
			<?
		}
		?>

		<div class="cart__summary">
				<div class="cart__subtitle">Итого:</div>
				<div class="cart__props">
						<!-- begin .props-->
						<div class="props props_size_l props_type_dotted props_layout_spread">
								{{#DISCOUNT_PRICE_FORMATED}}
									<div class="props__prop">
											<div class="props__label">Скидка</div>
											<div class="props__value">{{{DISCOUNT_PRICE_FORMATED}}}</div>
									</div>
								{{/DISCOUNT_PRICE_FORMATED}}

								<div class="props__prop" style="display: none">
										<div class="props__label">Скидка по промокоду</div>
										<div class="props__value">-49 р</div>
								</div>

								<div class="props__prop props__prop_type_important">
										<div class="props__label">Сумма</div>
										<div class="props__value" data-entity="basket-total-price">{{{PRICE_FORMATED}}}</div>
								</div>
						</div>
						<!-- end .props-->
				</div>
		</div>

		<div class="cart__controls">
			<div class="cart__control cart__control_type_back-link">
					<!-- begin .link-item-->
					<a
							class="link-item link-item_text-size_l link-item_icon-size_l link-item_font-weight_medium link-item_style_primary"
							href="/catalog"
					>
							<span class="link-item__icon-wrapper">
									<svg
											class="link-item__icon"
											width="24"
											height="24"
											viewBox="0 0 24 24"
											fill="none"
											xmlns="http://www.w3.org/2000/svg"
									>
											<path
													d="M14.6 6L16 7.4L11.4 12L16 16.6L14.6 18L8.6 12L14.6 6Z"
											/>
									</svg>
							</span>
							<span class="link-item__label">Вернуться к покупкам</span>
					</a>
					<!-- end .link-item-->
			</div>
			<div class="cart__control">
					<!-- begin .button-->
					<button
							class="button button_width_full button_size_l button_text-size_l"
							data-entity="basket-checkout-button"
					>
							<span class="button__holder">Оформить заказ</span>
					</button>
					<!-- end .button-->
			</div>
	</div>
</script>