<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="page-body">
    <div class="page-body__wrapper">
        <h1>Заявка на коммерческое предложение</h1>
        <div id="js_offer_container">
            <? if ($arResult['RESULT'] == 'SUCCESS') { ?>
                Ваша заявка успешно отправлена. В ближайшее время с вами свяжется наш менеджер для уточнения деталей.
                <input type="hidden" name="REG_SUCCESS" value="Y" />
            <? } else { ?>
                <? if (!empty($arResult['ERROR'])) { ?>
                    <? ShowMessage(implode('<br />', $arResult['ERROR'])); ?>
                <? } ?>
                <section class="c-form c-form--search">
                    <form class="c-form__wrapper c-form--select js_validate_ajax" data-type-form="OFFER" data-scroll-to="js_offer_container" data-container-id="js_offer_container" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
                        <input type="hidden" name="SEND" value="Y" />
                        <div class="c-form__group-input">
                            <label class="c-form--label c-form--label__search">
                                <div class="js_validate_field_container" style="width: 100%;">
                                    <?
                                    $strValidateAttrs = '';
                                    $arValidateAttrs = [];
                                    $arValidateAttrs[] = 'data-rule-required="true"';
                                    $arValidateAttrs[] = 'data-msg-required="Заполните поле"';
                                    $arValidateAttrs[] = 'data-rule-notonlyspaces="true"';
                                    $arValidateAttrs[] = 'data-msg-notonlyspaces="В тексте не должны быть только пробелы"';
                                    $arValidateAttrs[] = 'required';
                                    if (count($arValidateAttrs) > 0) {
                                        $strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
                                    }
                                    ?>
                                    <input <?= $strValidateAttrs; ?> class="c-form--input js_buyer_legal_entity" type="text" name="BUYER_LEGAL_ENTITY" placeholder="Найти по ИНН">
                                </div>
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
                                    </a><a href="#">
                                        <p>ООО «Вектор»</p>
                                        <p>ИНН: 507802816978</p>
                                    </a>
                                    <?/**/ ?>
                                </div>
                            </label>
                        </div>
                        <? if (!empty($arResult['PRODUCTS'])) { ?>
                            <div class="c-form__selectric js_validate_field_container">
                                <input type="hidden" name="PRODUCT" class="js_offer_product_name" value="" />
                                <select class="js_offer_product_select">
                                    <? foreach ($arResult['PRODUCTS'] as $item) { ?>
                                        <option value="<?= $item['NAME']; ?>"><?= $item['NAME']; ?></option>
                                    <? } ?>
                                </select>
                            </div>
                        <? } ?>
                        <button class="link-button_rose" type="submit">Отправить заявку</button>
                    </form>
                </section>
            <? } ?>
        </div>
    </div>
</div>