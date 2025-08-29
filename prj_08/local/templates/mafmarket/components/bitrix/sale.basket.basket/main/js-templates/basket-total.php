<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>

<script id="basket-total-template" type="text/html">
<div class="cart-sidebar-wrapper" data-entity="basket-checkout-aligner">
    <div class="cart-sidebar">

        <?
        if ($arParams['HIDE_COUPON'] !== 'Y')
        {
            ?>
            <div class="cart-sidebar__row cart-promocode">
                <form class="syr-form cart-promocode-form" id="cart-promocode">
                    <div class="syr-form-field cart-promocode-form__field">
                        <label for="cpf-promocode">Промокод</label>
                        <input id="" type="text" name="promocode" data-entity="basket-coupon-input">
                    </div>
                </form>
            </div>
            <?
        }
        ?>

        <div class="cart-sidebar__row cart-checkout-block">
            <div class="cart-order-summary">
                {{#DISCOUNT_PRICE_FORMATED}}
                <div class="cart-order-summary__row cart-order-price">
                    <span class="cart-order-summary__title">Сумма заказа</span>
                    <span class="cart-order-summary__value">
							{{{PRICE_WITHOUT_DISCOUNT_FORMATED}}}
                    </span>
                </div>
                {{/DISCOUNT_PRICE_FORMATED}}

                {{#DISCOUNT_PRICE_FORMATED}}
                <div class="cart-order-summary__row cart-order-discount">
                    <span class="cart-order-summary__title">Скидка</span>
                    <span class="cart-order-summary__value">{{{DISCOUNT_PRICE_FORMATED}}}</span>
                </div>
                {{/DISCOUNT_PRICE_FORMATED}}
                <div class="cart-order-summary__row cart-order-price-final">
                    <span class="cart-order-summary__title">К оплате</span>
                    <span class="cart-order-summary__value" data-entity="basket-total-price">{{{PRICE_FORMATED}}}</span>
                </div>
                {{#WEIGHT_FORMATED}}
                <div class="cart-order-summary__row cart-order-weight">
                    <span class="cart-order-summary__title">Вес заказа</span>
                    <span class="cart-order-summary__value">
								{{{WEIGHT_FORMATED}}}
								{{#SHOW_VAT}}<br>{{/SHOW_VAT}}
                    </span>
                </div>
                {{/WEIGHT_FORMATED}}
                {{#VOLUME_FORMATED}}
                <div class="cart-order-summary__row cart-order-volume">
                    <span class="cart-order-summary__title">Объем заказа</span>
                    <span class="cart-order-summary__value">{{{VOLUME_FORMATED}}}</span>
                </div>
                {{/VOLUME_FORMATED}}
            </div>
            <a class="syr-btn cart-checkout-order-btn{{#DISABLE_CHECKOUT}} hidden{{/DISABLE_CHECKOUT}}" href="#modal-order" data-modal><span>Оформить заказ</span></a>
            <?/*<button class="cart-quick-order-btn" type="button">Заказ в 1 клик</button>*/?>
        </div>
        {{#BONUSES_SUM}}
        <div class="cart-sidebar__row cart-loyalty">
            <p class="cart-loyalty__desc">Закажите еще на {{{BONUSES_SUM}}} и&nbsp;получите:</p>
            <div class="cart-loyalty-scale">
                <div style="width:{{{BONUSES_PERCENT}}}%" class="cart-loyalty-scale__progress"></div>
            </div>
            {{#BONUSES}}
            <div class="cart-loyalty__list">
                <div class="cart-loyalty__item"><span class="cart-loyalty__item-icon"><span class="icon icon-gift" style="background-image: url('{{{PREVIEW_PICTURE_PATH}}}')"></span></span><span class="cart-loyalty__item-desc">{{{NAME}}}</span></div>
            </div>
            {{/BONUSES}}
        </div>
        {{/BONUSES_SUM}}
        {{#SHOW_OWNED}}
        <div class="cart-sidebar__row cart-loyalty">
            <p class="cart-loyalty__desc">Полученные бонусы:</p>
            {{#BONUSES_OWNED}}
            <div class="cart-loyalty__list">
                <div class="cart-loyalty__item"><span class="cart-loyalty__item-icon"><span class="icon icon-gift" style="background-image: url('{{{PREVIEW_PICTURE_PATH}}}')"></span></span><span class="cart-loyalty__item-desc">{{{NAME}}}</span></div>
            </div>
            {{/BONUSES_OWNED}}
        </div>
        {{/SHOW_OWNED}}
    </div>

    <?
    if ($arParams['HIDE_COUPON'] !== 'Y')
    {
        ?>
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
        <?
    }
    ?>

</div>
</script>