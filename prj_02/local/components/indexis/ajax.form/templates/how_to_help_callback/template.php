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
<h3>Спасибо, что откликнулись!</h3>
<p>Оставьте контактную информацию, чтобы мы с вами связались.</p>

<form method="" action="" autocomplete="off" class="site-form js-validate js-sticky ajax-form">
    <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
    <?= bitrix_sessid_post() ?>
    <div class="form-group">
        <input id="NAME" type="text" name="NAME" placeholder="Ваше имя" class="form-control">
    </div>
    <div class="form-group">
        <input id="PROPERTY_EMAIL" type="text" name="PROPERTY_EMAIL" placeholder="Ваш e-mail" class="form-control">
    </div>
    <div class="form-group">
        <input id="PROPERTY_PHONE" type="text" name="PROPERTY_PHONE" placeholder="Номер телефона" class="form-control" data-mask="phone">
    </div>
    <div class="form-group">
        <input id="PREVIEW_TEXT" type="hidden" name="PREVIEW_TEXT" placeholder="Сообщение" value="_" class="form-control">
    </div>
    <div class="form-group">
        <div class="form-personal-agreement">
            <input id="scf-6" type="checkbox" name="AGREE" value="y" class="custom-checkbox">
            <label for="scf-6" class="custom-checkbox-label">Соглашаюсь на обработку моих <a href="/docs/politika_v_otnoshenii_obrabotki_pd.pdf" target="_blank"><u>персональных данных</u></a></label>
        </div>
    </div>
    <div class="form-group">
        <div id="captcha-container" class="smart-captcha" data-sitekey="ysc1_3HownHMivHE7ga7XeWijoILxy71c0NKd5LXUqdvM2bfcee0d">
        </div>
    </div>
    <div class="form-group">
        <div class="msg msg-block">
        </div>
        <div class="main_error msg-block">
        </div>
    </div>
    <div class="buttons-line">
        <button type="submit" value="y" class="btn site-form__submit">Отправить</button>
    </div>
</form>