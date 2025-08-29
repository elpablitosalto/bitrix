<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="page-body js_basket_wrapper">
    <?
    //vardump($arResult['arFilter']);
    ?>
    <form class="page-body__wrapper c-form--order">
        <?
        $extStr = 'Вы еще не добавили позиции в заказ';
        if (intval($arResult['COUNT_NUMBERS']) > 0) {
            $extStr = Indexis::num2word($arResult['COUNT_NUMBERS'], ['наименование в заказе', 'наименования в заказе', 'наименований в заказе']);
        }
        ?>
        <h1>Сделать заказ <span>(<?= $extStr; ?>)</span>
        </h1>
        <div class="lk__section c-form--select">
            <? if (!empty($arResult['ITEMS'])) { ?>
                <div class="c-form__wrapper">
                    <? if (!empty($arResult['DIRECTIONS'])) { ?>
                        <div class="c-form__selectric">
                            <select class="js_filter_order js_direction">
                                <option value="">Все направления</option>
                                <? foreach ($arResult['DIRECTIONS'] as $key => $val) { ?>
                                    <option value="<?= $val['ID']; ?>" <? if ($arParams['CUR_DIRECTION'] == $val['ID']) { ?> selected<? } ?>><?= $val['NAME']; ?></option>
                                <? } ?>
                            </select>
                        </div>
                    <? } ?>
                    <? if (!empty($arResult['PRODUCT_TYPES'])) { ?>
                        <div class="c-form__selectric">
                            <select class="js_filter_order js_product_type">
                                <option value="">Все типы</option>
                                <? foreach ($arResult['PRODUCT_TYPES'] as $key => $val) { ?>
                                    <option value="<?= $val['ID']; ?>" <? if ($arParams['CUR_PRODUCT_TYPE'] == $val['ID']) { ?> selected<? } ?>><?= $val['NAME']; ?></option>
                                <? } ?>
                            </select>
                        </div>
                    <? } ?>
                </div>
            <? } ?>
            <div class="c-form__wrapper">
                <label class="c-form--label c-form--label__search">
                    <button class="c-form--label__search_search js_open_order_popup" type="button">
                        <svg width="18" height="18">
                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#search"></use>
                        </svg>
                    </button>
                    <input class="c-form--input js_order_search_query" type="text" name="name" placeholder="Найти и добавить позицию в заказ">
                    <button class="c-form--label__search_clear display-none" type="button">
                        <svg width="14" height="14">
                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#close2"></use>
                        </svg>
                    </button>
                </label>
                <? if (!empty($arResult['ITEMS'])) { ?>
                    <button class="link-button_rose lk-order__add_ js_go_to" data-anchor="js_make_order" type="button">К оформлению заказа</button>
                <? } ?>
            </div>
            <? if (!empty($arResult['ITEMS'])) { ?>
                <? foreach ($arResult['ITEMS'] as $idDirect => $arDirection) { ?>
                    <h3><?= $arResult['DIRECTIONS'][$idDirect]['NAME'] ?></h3>
                    <? foreach ($arDirection as $idType => $arType) { ?>
                        <h4><?= $arResult['PRODUCT_TYPES'][$idType]['NAME'] ?></h4>
                        <div class="table">
                            <div class="table__title">
                                <div class="table__title-item">Тип системы</div>
                                <div class="table__title-item">Номер в каталоге</div>
                                <div class="table__title-item">Количество</div>
                                <div class="table__title-item"></div>
                            </div>
                            <? foreach ($arType as $arItem) { ?>
                                <div class="table__row">
                                    <div class="table__item"><?= $arItem['NAME']; ?></div>
                                    <div class="table__item"><?= $arItem['NUMBER']; ?></div>
                                    <div class="table__item">
                                        <button class="table__button js_list_minus_quantity" type="button" data-el-id="<?= $arItem['ID']; ?>" data-action="minus" data-inputidprefix="js_list_input_quantity_basket_">-</button>
                                        <label>
                                            <input class="table__input js_list_input_quantity_basket" type="number" value="<?= $arItem['COUNT']; ?>" placeholder="<?= $arItem['COUNT']; ?>" required="required" id="js_list_input_quantity_basket_<?= $arItem['ID']; ?>" data-el-id="<?= $arItem['ID']; ?>" />
                                        </label>
                                        <button class="table__button js_list_plus_quantity" type="button" data-el-id="<?= $arItem['ID']; ?>" data-action="plus" data-inputidprefix="js_list_input_quantity_basket_">+</button>
                                    </div>
                                    <div class="table__item">
                                        <button class="table__button-trash js_del_item_from_basket" type="button" data-element="<?= $arItem['ID']; ?>">
                                            <svg width="18" height="18">
                                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#trash"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                    <? } ?>
                <? } ?>
            <? } else { ?>
                <?
                ShowError('Добавьте позиции в заказ, чтобы оформить его через сайт');
                ?>
            <? } ?>
        </div>
    </form>



    <? if (!empty($arResult['ITEMS'])) { ?>
        <div class="lk__section lk__order-total" id="js_make_order">
            <div class="lk__section-wrapper">Итого:<span class="lk__order-total_coast"><?= Indexis::num2word($arResult['COUNT_NUMBERS'], ['товар', 'товара', 'товаров']); ?><?/*?>600000 ₽<?*/ ?></span></div>
            <p>Юридическое лицо партнера:</p>
            <p class="lk__order-text"><?= $arResult['USER']['WORK_COMPANY'] ?></p>
            <p>Юридическое лицо конечного заказчика:</p>
            <label class="c-form--label c-form--label__search">
                <input class="c-form--input js_buyer_legal_entity" id="js_buyer_legal_entity" type="text" name="name" placeholder="Найти по ИНН">
                <button class="c-form--label__search_clear display-none" type="button">
                    <svg width="14" height="14">
                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#close2"></use>
                    </svg>
                </button>
                <button class="c-form--label__search_search" type="button">
                    <svg width="18" height="18">
                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#search"></use>
                    </svg>
                </button>
                <div class="c-form--label__result display-none js_suggestions_container">
                    <?/*?>
                    <a href="#">
                        <p>ООО «Вектор»</p>
                        <p>ИНН: 507802816978</p>
                    </a>
                    <a href="#">
                        <p>ООО «Вектор»</p>
                        <p>ИНН: 507802816978</p>
                    </a>
                    <?*/?>
                </div>
            </label>
            <button class="link-button_rose js_send_order_request link-button_password" type="button" disabled <?/*?>disabled="disabled"<?/**/ ?>>Оформить заказ</button>
        </div>

        <?/*?>
        <input id="party" name="party" type="text" />
        <?*/?>
    <? } ?>
</div>