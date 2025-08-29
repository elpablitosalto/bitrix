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


<form id="footer-from-feedback" class="dp-footer-from-feedback ajax-form" action="#">
    <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
    <?= bitrix_sessid_post() ?>
    <div class="dp-footer-from-feedback__inner">
        <input name="NAME" class="dp-footer-from-feedback__input" type="email" placeholder="Ваш e-mail">
        <button class="dp-btn dp-btn_orange dp-btn_m dp-footer-from-feedback__submit" type="submit">
            Подписаться
        </button>
        <div class="main_error"></div>
        <div class="msg"></div>
    </div>
</form>