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
<div class="dp-modal dp-consulting-application-modal" id="<?= $arParams['MODAL_ID']; ?>">
    <div class="dp-modal__overlay"></div>
    <div class="dp-modal__dialog">
        <button class="dp-modal__close" type="button">
            <svg class="icon icon-cross" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.1003 10.1006L29.8993 29.8996" />
                <path d="M10.1003 29.8994L29.8993 10.1004" />
            </svg>
        </button>
        <div class="dp-modal__header">
            <p class="dp-modal__title">Оставьте заявку на получение консультации</p>
        </div>
        <div class="dp-modal__body">
            <form class="dp-form dp-consulting-application-form ajax-form" id="form-consulting-application" method="post" action="#">
                <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
                <?= bitrix_sessid_post() ?>
                <div class="dp-form__body">
                    <div class="dp-field dp-form-field">
                        <input type="text" name="NAME" placeholder="Ваше Имя" required>
                    </div>
                    <div class="dp-field dp-form-field js_phone_mask_container" id="<?= $arParams['PHONE_MASK_INPUT_CLASS'] ?>">
                        <input class="iti-input <?= $arParams['PHONE_MASK_INPUT_CLASS'] ?>" type="tel" name="PROPERTY_PHONE" placeholder="Номер телефона" required>
                    </div>
                    <div class="dp-field dp-form-field">
                        <?/*<input class="js-email" type="text" name="PROPERTY_EMAIL" placeholder="E-mail" required>*/?>
                        <input type="email" name="PROPERTY_EMAIL" placeholder="E-mail" required>
                    </div>
                </div>
                <div class="dp-form__footer">
                    <div class="dp-field dp-field_agreement dp-form-field">
                        <input id="ftbp-agreement" type="checkbox" class="js_agree_checkbox" name="AGREE" value="y" checked>
                        <label for="ftbp-agreement"></label><span class="dp-form__agreement-text">
                            Даю согласие на обработку персональных данных в соответствии c <a href="/privacy/" target="_blank">политикой конфиденциальности</a> и <a href="/licence/" target="_blank">лицензионным соглашением</a>
                        </span>
                    </div>
                    <div class="dp-form__actions">
                        <div class="main_error" id="<?= $arParams['MODAL_ID']; ?>_error"></div>
                        <div class="msg" id="<?= $arParams['MODAL_ID']; ?>_msg"></div>
                        <button class="dp-btn dp-form__submit js_send_form_button" type="submit">Оставить заявку</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>