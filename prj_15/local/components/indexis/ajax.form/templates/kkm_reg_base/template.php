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

<div class="dp-modal dp-get-course-modal" id="kalgari-tariff-base-installment-modal">
    <div class="dp-modal__overlay"></div>
    <div class="dp-modal__dialog">
        <button class="dp-modal__close" type="button">
            <svg class="icon icon-cross ">
                <use xlink:href="#cross"></use>
            </svg>
        </button>
        <div class="dp-modal__header">
            <p class="dp-modal__title">Курс «Эффективное общение с&nbsp;пациентом по Калгари-Кембриджской модели»</p>
            <p class="dp-modal__tariff">Тариф «Базовый» (рассрочка)</p>
            <p class="dp-modal__price">19 990 ₽ <span class="dp-modal__installment">(3 332 ₽ / в 2 недели)</span>
            </p>
        </div>
        <div class="dp-modal__body">
            <form class="dp-form dp-form-get-course ajax-form" id="form-tariff-base-installment" method="post" action="#">
                <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
                <?= bitrix_sessid_post() ?>
                <div class="dp-form__body">
                    <div class="dp-field">
                        <input type="email" name="PROPERTY_EMAIL" placeholder="E-mail" required>
                    </div>
                    <div class="dp-field">
                        <input type="text" name="PROPERTY_NAME" placeholder="Имя" required>
                    </div>
                    <div class="dp-field">
                        <input class="iti-input js-iti-input" type="tel" name="PROPERTY_PHONE">
                    </div>
                </div>
                <div class="dp-form__footer">
                    <div class="dp-form__actions">
                        <button class="dp-btn dp-form__submit" type="submit">Записаться</button>
                    </div>
                    <div class="dp-field dp-field_agreement">
                        <input id="ftbi-agreement" type="checkbox" name="PROPERTY_SOGL" value="Y">
                        <label for="ftbi-agreement"></label><span>Я согласен на&nbsp;обработку моих персональных данных в&nbsp;соответствии с&nbsp;<a href="#" target="_blank">Договором оферты</a> и&nbsp;<a href="/privacy/" target="_blank">Политикой Конфиденциальности</a></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>