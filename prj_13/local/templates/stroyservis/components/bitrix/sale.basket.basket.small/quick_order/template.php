<? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
    <?
    // Цена за кг -->
    $weight = $arResult['WEGHT'];
    $price = $arItem['PRICE'];
    if ($weight > 0 && $price > 0) {
        $price_for_kg = ceil($price / $weight);
    }
    // <-- Цена за кг

    $bShowPriceBeforeDiscount = false;
    $showBasePrice = "";
    if (
        !empty($arItem['PRICE'])
        && !empty($arItem['BASE_PRICE'])
        && $arItem['PRICE'] != $arItem['BASE_PRICE']
        && strlen($arItem['DISCOUNT_PRICE_PERCENT_FORMATED']) > 0
    ) {
        $bShowPriceBeforeDiscount = true;
        $showBasePrice = intval($arItem['BASE_PRICE']);
    }
    ?>
    <div class="order-card__item">
        <div class="order-card__image">
            <img src="<?= $arItem['PICTURE']['SRC'] ?>" alt="<?= $arItem['PICTURE']['ALT'] ?>" title="<?= $arItem['PICTURE']['TITLE'] ?>" />
        </div>
        <div class="order-card__item-wrapper">
            <div class="order-card__item-main">
                <div class="order-card__title"><?= $arItem['NAME']; ?></div>
                <? if (strlen($arResult['ARTICLE']) > 0) { ?>
                    <div class="order-card__code">Артикул: <?= $arResult['ARTICLE']; ?></div>
                <? } ?>
                <div class="order-card__item-price">
                    <div class="order-card__item-sum">
                        <span class="prices"><?= $arItem['PRICE']; ?></span> <span class="order-card__price_ruble">&#8381;</span>
                    </div>
                    <?
                    if (strlen($price_for_kg) > 0) { ?>
                        <div class="order-card__item-sumfor">
                            <span class="prices"><?= $price_for_kg; ?></span> <span>&#8381;/кг.</span>
                        </div>
                    <? } ?>
                </div>
                <? if ($bShowPriceBeforeDiscount) { ?>
                    <div class="order-card__discount">
                        <span class="order-card__discount-old"><span class="prices"><?= $showBasePrice; ?></span> ₽/шт.</span>
                        <span class="order-card__discount-percent"><?= $arItem['DISCOUNT_PRICE_PERCENT_FORMATED']; ?></span>
                    </div>
                <? } ?>
            </div>
            <div class="order-card__item-add">
                <button type="button" class="order-card__add_control order-card__add_control_minus js_popup_basket_minus_quantity" id="" data-id-item-input-qt="<?= $arItem['ID']; ?>_quick_order" data-el-basket-id="<?= $arItem['ID']; ?>" data-action="minus">-</button>
                <input class="popup__input-quantity js_popup_input_quantity" id="js_popup_input_quantity_<?= $arItem['ID']; ?>_quick_order" type="number" name="QUANTITY" placeholder="1" value="<?= $arItem['QUANTITY']; ?>" data-el-basket-id="<?= $arItem['ID']; ?>" required>
                <button type="button" class="order-card__add_control order-card__add_control_plus js_popup_basket_plus_quantity" id="" data-id-item-input-qt="<?= $arItem['ID']; ?>_quick_order" data-el-basket-id="<?= $arItem['ID']; ?>" data-action="plus">+</button>
            </div>
        </div>
    </div>
<? } ?>