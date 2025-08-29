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
<?/**/ ?>
<div id="modal-event-registration" class="modal modal-event-registration">
    <?/**/ ?>
    <button type="button" data-fancybox-close class="modal-close">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-close">
            <use xlink:href="#close"></use>
        </svg>
    </button>
    <h3 class="modal-title">Записаться</h3>
    <form method="post" action="/index.php" autocomplete="off" class="site-form ajax-form">
        <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>" />
        <input type="hidden" id="PROPERTY_EVENT" name="PROPERTY_EVENT" value="" />
        <input type="hidden" id="PROPERTY_EVENT_NAME" name="PROPERTY_EVENT_NAME" value="" />
        <?= bitrix_sessid_post() ?>
        <div class="form-group">
            <input id="mer-1" type="text" name="NAME" placeholder="Ваше имя" class="form-control">
        </div>
        <div class="form-group">
            <input id="mer-2" type="text" name="PROPERTY_EMAIL" placeholder="E-mail" class="form-control">
        </div>
        <div class="form-group">
            <input id="mer-3" type="text" name="PROPERTY_PHONE" placeholder="Номер телефона" data-mask="phone" class="form-control">
        </div>
        <div class="form-group">
            <div class="form-personal-agreement">
                <input id="mer-4" type="checkbox" name="AGREEMENT" value="y" class="custom-checkbox">
                <label for="mer-4" class="custom-checkbox-label">Соглашаюсь на обработку моих <a href="/docs/politika_v_otnoshenii_obrabotki_pd.pdf" target="_blank"><u>персональных данных</u></a></label>
            </div>
        </div>
        <div class="form-group">
            <div id="captcha-container" class="smart-captcha" data-sitekey="ysc1_3HownHMivHE7ga7XeWijoILxy71c0NKd5LXUqdvM2bfcee0d">
            </div>
        </div>
        <div class="buttons-line">
            <button type="submit" value="y" class="btn btn-submit">Отправить</button>
        </div>
        <div class="main_error"></div>
        <div class="msg"></div>
    </form>
    <?/**/ ?>
</div>
<?/**/ ?>