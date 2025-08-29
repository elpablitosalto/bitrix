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
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}
?>


<script id="basket-item-template" type="text/html">
    <div class="dp-account-order{{#SHOW_RESTORE}} basket-items-list-item-container-expend{{/SHOW_RESTORE}}"
         id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
        {{#SHOW_RESTORE}}
        <div class="basket-items-list-item-notification" colspan="<?= $restoreColSpan ?>">
            <div class="basket-items-list-item-notification-inner basket-items-list-item-notification-removed"
                 id="basket-item-height-aligner-{{ID}}">
                {{#SHOW_LOADING}}
                <div class="basket-items-list-item-overlay"></div>
                {{/SHOW_LOADING}}
                <div class="basket-items-list-item-removed-container">
                    <div>
                        <?= Loc::getMessage('SBB_GOOD_CAP') ?>
                        <strong>{{NAME}}</strong> <?= Loc::getMessage('SBB_BASKET_ITEM_DELETED') ?>.
                    </div>
                    <div class="basket-items-list-item-removed-block">
                        <a href="javascript:void(0)" data-entity="basket-item-restore-button">
                            <?= Loc::getMessage('SBB_BASKET_ITEM_RESTORE') ?>
                        </a>
                        <span class="basket-items-list-item-clear-btn"
                              data-entity="basket-item-close-restore-button"></span>
                    </div>
                </div>
            </div>
        </div>
        {{/SHOW_RESTORE}}
        {{^SHOW_RESTORE}}

        <div class="dp-account-order__main">
            <div class="dp-account-order__col dp-account-order__col-checkbox">
                <div class="dp-account-order__checkbox">
                    <input id="order-{{ID}}" type="checkbox">
                    <label for="order-{{ID}}"></label>
                </div>
            </div>
            <div class="dp-account-order__head">
                <div class="dp-account-order__col dp-account-order__col-img">
                    <div class="dp-account-order__img" id="basket-item-height-aligner-{{ID}}">
                        {{#DETAIL_PAGE_URL}}
                        <a class="dp-account-order__img-link" href="{{DETAIL_PAGE_URL}}">
                            {{/DETAIL_PAGE_URL}}
                            <?
                            if (in_array('PREVIEW_PICTURE', $arParams['COLUMNS_LIST'])) {
                                ?>
                                <img alt="{{NAME}}"
                                     src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?= $templateFolder ?>/images/empty_cart.svg{{/IMAGE_URL}}">
                                <?
                            }
                            ?>
                            {{#DETAIL_PAGE_URL}}
                        </a>
                        {{/DETAIL_PAGE_URL}}
                    </div>
                </div>
                <div class="dp-account-order__col dp-account-order__col-title">
                    {{#DETAIL_PAGE_URL}}
                    <a class="dp-account-order__title-link" href="{{DETAIL_PAGE_URL}}">
                        {{/DETAIL_PAGE_URL}}
                        <p class="dp-account-order__title">{{NAME}}</p>
                        <p class="dp-account-order__code">{{PREVIEW_TEXT}}</p>
                        {{#DETAIL_PAGE_URL}}
                    </a>
                    {{/DETAIL_PAGE_URL}}
                </div>
                <div class="dp-account-order__col dp-account-order__col-materials">
                    <ul class="dp-account-order__materials">
                        {{#VID_DREVESINY_BRUSKA_DOSKI}}
                        <li class="dp-account-order__material"><span class="dp-account-order__material-img"><img
                                        src="{{VID_DREVESINY_BRUSKA_DOSKI_IMAGE}}"></span><span
                                    class="dp-account-order__material-label">{{VID_DREVESINY_BRUSKA_DOSKI}}</span></li>
                        {{/VID_DREVESINY_BRUSKA_DOSKI}}
                        {{#METALL}}
                        <li class="dp-account-order__material"><span class="dp-account-order__material-img"><img
                                        src="{{METALL_IMAGE}}"></span><span
                                    class="dp-account-order__material-label">{{METALL}}</span></li>
                        {{/METALL}}
                        {{#OKRAS_BRUSKA}}
                        <li class="dp-account-order__material"><span class="dp-account-order__material-img"><img
                                        src="{{OKRAS_BRUSKA_IMAGE}}"></span><span
                                    class="dp-account-order__material-label">{{OKRAS_BRUSKA}}</span></li>
                        {{/OKRAS_BRUSKA}}
                        {{#TSVET_METALLICHESKOGO_POKRYTIYA}}
                        <li class="dp-account-order__material"><span class="dp-account-order__material-img"><img
                                        src="{{TSVET_METALLICHESKOGO_POKRYTIYA_IMAGE}}"></span><span
                                    class="dp-account-order__material-label">{{TSVET_METALLICHESKOGO_POKRYTIYA}}</span></li>
                        {{/TSVET_METALLICHESKOGO_POKRYTIYA}}
                    </ul>
                </div>
            </div>

            <div class="dp-account-order__col dp-account-order__col-qnt{{#NOT_AVAILABLE}} disabled{{/NOT_AVAILABLE}}">
                <div class="dp-account-order__qnt" data-entity="basket-item-quantity-block">
                    <div class="dp-qnt-field">
                        <button class="dp-qnt-field__btn dp-qnt-field__btn_minus bitrix-event" type="button"
                                data-entity="basket-item-quantity-minus"></button>
                        <input type="text" class="dp-qnt-field__input bitrix-event" value="{{QUANTITY}}"
                               {{#NOT_AVAILABLE}} disabled="disabled" {{/NOT_AVAILABLE}}
                        data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
                        id="basket-item-quantity-{{ID}}">
                        <button class="dp-qnt-field__btn dp-qnt-field__btn_plus bitrix-event" type="button"
                                data-entity="basket-item-quantity-plus"></button>
                    </div>
                </div>
            </div>

            <? if ($useActionColumn) {
                ?>
                <div class="dp-account-order__col dp-account-order__col-remove">
                    <button class="dp-account-order__remove" type="button" data-entity="basket-item-delete">
                        <svg class="icon icon-trash ">
                            <use xlink:href="#trash"></use>
                        </svg>
                    </button>
                    {{#SHOW_LOADING}}
                    <div class="basket-items-list-item-overlay"></div>
                    {{/SHOW_LOADING}}
                </div>
                <?
            }
            ?>

        </div>
        <div class="dp-account-order__desc">
            <div class="dp-account-order__props">
                <p class="dp-account-order__props-title">Характеристики</p>
                <ul class="dp-account-order__props-list">
                    <li class="dp-account-order__props-item"><span class="dp-account-order__props-label">Длина:</span>
                        <span class="dp-account-order__props-value">3000 мм</span>
                    </li>
                </ul>
                <div class="dp-account-order__props-more"><a class="dp-account-order__props-more-link" href="#">Больше
                        характеристик</a></div>
            </div>
            <button class="dp-btn dp-btn_toggle dp-account-order__props-toggle"><span>Смотреть подробнее</span></button>
        </div>

        {{/SHOW_RESTORE}}
    </div>
</script>

<?/*
<script id="basket-item-template" type="text/html">

    <div class="cart-item{{#SHOW_RESTORE}} basket-items-list-item-container-expend{{/SHOW_RESTORE}}"
         id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
        {{#SHOW_RESTORE}}
        <div class="basket-items-list-item-notification" colspan="<?= $restoreColSpan ?>">
            <div class="basket-items-list-item-notification-inner basket-items-list-item-notification-removed"
                 id="basket-item-height-aligner-{{ID}}">
                {{#SHOW_LOADING}}
                <div class="basket-items-list-item-overlay"></div>
                {{/SHOW_LOADING}}
                <div class="basket-items-list-item-removed-container">
                    <div>
                        <?= Loc::getMessage('SBB_GOOD_CAP') ?>
                        <strong>{{NAME}}</strong> <?= Loc::getMessage('SBB_BASKET_ITEM_DELETED') ?>.
                    </div>
                    <div class="basket-items-list-item-removed-block">
                        <a href="javascript:void(0)" data-entity="basket-item-restore-button">
                            <?= Loc::getMessage('SBB_BASKET_ITEM_RESTORE') ?>
                        </a>
                        <span class="basket-items-list-item-clear-btn"
                              data-entity="basket-item-close-restore-button"></span>
                    </div>
                </div>
            </div>
        </div>
        {{/SHOW_RESTORE}}
        {{^SHOW_RESTORE}}

        <div class="cart-item__img" id="basket-item-height-aligner-{{ID}}">
            {{#DETAIL_PAGE_URL}}
            <a href="{{DETAIL_PAGE_URL}}" class="cart-item__img-link">
                {{/DETAIL_PAGE_URL}}
                <?
if (in_array('PREVIEW_PICTURE', $arParams['COLUMNS_LIST'])) {
    ?>
                    <img alt="{{NAME}}"
                         src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?= $templateFolder ?>/images/no_photo.png{{/IMAGE_URL}}">
                    <?
}
?>
                {{#DETAIL_PAGE_URL}}
            </a>
            {{/DETAIL_PAGE_URL}}
        </div>
        <div class="cart-item__caption">
            {{#DETAIL_PAGE_URL}}
            <a href="{{DETAIL_PAGE_URL}}" class="cart-item__caption-link">
                {{/DETAIL_PAGE_URL}}
                <p class="cart-item__title" data-entity="basket-item-name">{{NAME}}</p>
                {{#DETAIL_PAGE_URL}}
            </a>
            {{/DETAIL_PAGE_URL}}

            {{#ARTICLE}}
            <p class="cart-item__code">
                <span class="cart-item__code-title">Артикул</span>
                <span class="cart-item__code-value">{{ARTICLE}}</span>
            </p>
            {{/ARTICLE}}

            <?

if (!empty($arParams['PRODUCT_BLOCKS_ORDER'])) {
    foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName) {
        switch (trim((string)$blockName)) {
            case 'props':
                if (in_array('PROPS', $arParams['COLUMNS_LIST'])) {
                    ?>
                    {{#PROPS}}
                    <p class="cart-item__code"><span class="cart-item__code-title">{{{NAME}}}</span> <span
                                class="cart-item__code-value" data-entity="basket-item-property-value"
                                data-property-code="{{CODE}}">{{{VALUE}}}</span>
                    </p>
                    {{/PROPS}}
                    <?
                }

                break;
        }
    }


            {{#NOT_AVAILABLE}}
            <div class="basket-items-list-item-warning-container">
                <div class="alert alert-warning text-center">
                    <?= Loc::getMessage('SBB_BASKET_ITEM_NOT_AVAILABLE') ?>.
                </div>
            </div>
            {{/NOT_AVAILABLE}}
            {{#DELAYED}}
            <div class="basket-items-list-item-warning-container">
                <div class="alert alert-warning text-center">
                    <?= Loc::getMessage('SBB_BASKET_ITEM_DELAYED') ?>.
                    <a href="javascript:void(0)" data-entity="basket-item-remove-delayed">
                        <?= Loc::getMessage('SBB_BASKET_ITEM_REMOVE_DELAYED') ?>
                    </a>
                </div>
            </div>
            {{/DELAYED}}
            {{#WARNINGS.length}}
            <div class="basket-items-list-item-warning-container">
                <div class="alert alert-warning alert-dismissable" data-entity="basket-item-warning-node">
                    <span class="close" data-entity="basket-item-warning-close">&times;</span>
                    {{#WARNINGS}}
                    <div data-entity="basket-item-warning-text">{{{.}}}</div>
                    {{/WARNINGS}}
                </div>
            </div>
            {{/WARNINGS.length}}

        </div>
        <div class="cart-item__volume">
            {{{VOLUME_VAL}}}
        </div>

        <div class="cart-item__qnt{{#NOT_AVAILABLE}} disabled{{/NOT_AVAILABLE}}">
            <div class="quantity-panel" data-entity="basket-item-quantity-block">
                <button class="quantity-panel__btn quantity-panel__btn_down bitrix-event" type="button"
                        data-entity="basket-item-quantity-minus"></button>
                <input type="text" class="quantity-panel__input bitrix-event" value="{{QUANTITY}}"
                       {{#NOT_AVAILABLE}} disabled="disabled" {{/NOT_AVAILABLE}}
                data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
                id="basket-item-quantity-{{ID}}">
                <button class="quantity-panel__btn quantity-panel__btn_up bitrix-event" type="button"
                        data-entity="basket-item-quantity-plus"></button>
            </div>
        </div>

        <?
if ($usePriceInAdditionalColumn) {
    ?>
            <div class="cart-item__price">
                <span class="cart-item__price-current" id="basket-item-price-{{ID}}">{{{PRICE_FORMATED}}}</span>
                {{#SHOW_DISCOUNT_PRICE}}
                <span class="cart-item__price-old">{{{FULL_PRICE_FORMATED}}}</span>
                {{/SHOW_DISCOUNT_PRICE}}
            </div>
            <?
    if ($useSumColumn) {
        ?>
                <div class="cart-item__price-total" id="basket-item-sum-price-{{ID}}">{{{SUM_PRICE_FORMATED}}}</div>
                <?
    }
    ?>
        <? } ?>

        <? if ($useActionColumn) {
    ?>
            <div class="cart-item__remove">
                <button class="cart-item__remove-btn" type="button" data-entity="basket-item-delete">
                    <svg class="icon icon-delete ">
                        <use xlink:href="#delete"></use>
                    </svg>
                </button>
                {{#SHOW_LOADING}}
                <div class="basket-items-list-item-overlay"></div>
                {{/SHOW_LOADING}}
            </div>
            <?
}
?>

        {{/SHOW_RESTORE}}
    </div>
</script>
*/?>