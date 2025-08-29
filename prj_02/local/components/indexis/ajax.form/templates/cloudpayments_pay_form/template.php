<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>

<form class="ajax-form-pay">
    <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
    <?= bitrix_sessid_post() ?>
    <div class="amount">
        <button class="sum-button" data-sum="300">300 ₽</button>
        <button class="sum-button active" data-sum="500">500 ₽</button>
        <button class="sum-button" data-sum="1500">1500 ₽</button>
        <input type="text" id="amount-num" name="amount" placeholder="Другая сумма" data-mask="number">
        <input type="hidden" name="PROPERTY_SUM" value="500">
    </div>
    <div class="kind">
        <? $selected = false; ?>
        <? foreach ($arResult["ENUMS"]["TYPE"] as $arEnum) { ?>
            <input id="ui-cr-<?= $arEnum["ID"] ?>" type="radio" name="PROPERTY_TYPE" value="<?= $arEnum["ID"] ?>" <? if ($arEnum["ID"] == 29) {
                                                                                                                        echo " checked";
                                                                                                                        $selected = true;
                                                                                                                    } ?> class="custom-radio">
            <label for="ui-cr-<?= $arEnum["ID"] ?>" class="custom-radio-label"><?= $arEnum["VALUE"] ?></label>
        <? } ?>
    </div>
    <div class="purpose">
        <select id="scf-1" name="PROPERTY_CATEGORY" class="form-control">
            <? $selected = false; ?>
            <? foreach ($arResult["ENUMS"]["CATEGORY"] as $arEnum) { ?>
                <option value="<?= $arEnum["ID"] ?>" <? if (!$selected) {
                                                            echo " selected";
                                                            $selected = true;
                                                        } ?>><?= $arEnum["VALUE"] ?></option>
            <? } ?>
        </select>
    </div>
    <div class="customer">
        <input type="text" placeholder="Имя*" name="NAME">
    </div>
    <?/*<div class="customer">
        <input type="text" placeholder="Телефон*" name="PROPERTY_PHONE" data-mask="phone">
    </div>
    <div class="customer">
        <input type="text" placeholder="Email*" name="PROPERTY_EMAIL" >
    </div>*/ ?>
    <div class="message">
        <input type="text" placeholder="Ваше сообщение" name="PREVIEW_TEXT">
    </div>
    <div class="agreement">
        <input id="agreement" type="checkbox" value="y" name="AGREEMENT" class="custom-checkbox">
        <label for="agreement" class="custom-checkbox-label">Соглашаюсь с <a href="/docs/oferta.pdf" class="" target="_blank"><u>офертой</u></a> и на обработку моих <a href="/docs/politika_v_otnoshenii_obrabotki_pd.pdf" class="" target="_blank"><u>персональных данных</u></a></label>
    </div>
    <div class="bottom-line">
        <button class="btn sumbit-pay-form">Хочу помочь сейчас</button>
        <a href="" data-modal="#modal_security_guarantees">Гарантии безопасности</a>
    </div>

    <div class="form-group">
        <div class="captcha-container-hidden" id="captcha-container-hidden">
        </div>
    </div>

    <div class="main_error"></div>
    <div class="msg"></div>
</form>