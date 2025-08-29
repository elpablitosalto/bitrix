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
<? if (strlen($arParams["ANCHOR"]) > 0) { ?>
    <a id="<?= $arParams["ANCHOR"]; ?>"></a>
<? } ?>
<section class="site-callback">
    <div class="container">
        <form method="post" action="/index.php" autocomplete="off" class="site-form site-callback-form ajax-form">
            <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
            <?= bitrix_sessid_post() ?>
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="section__title">Связаться с нами</h3>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <select id="scf-1" name="PROPERTY_TYPE" class="form-control">
                            <? $selected = false; ?>
                            <? foreach ($arResult["ENUMS"]["TYPE"] as $arEnum) { ?>
                                <option value="<?= $arEnum["ID"] ?>" <? if (!$selected) {
                                                                            echo " selected";
                                                                            $selected = true;
                                                                        } ?>><?= $arEnum["VALUE"] ?></option>
                            <? } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input id="scf-2" type="text" name="NAME" placeholder="Ваши фамилия и имя" class="form-control">
                    </div>
                    <div class="form-group">
                        <input id="scf-3" type="text" name="PROPERTY_EMAIL" placeholder="E-mail" class="form-control">
                    </div>
                    <div class="form-group">
                        <input id="scf-4" type="text" name="PROPERTY_PHONE" placeholder="Номер телефона" data-mask="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea id="scf-5" name="PREVIEW_TEXT" placeholder="Опишите вашу проблему" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-personal-agreement">
                            <input id="scf-6" type="checkbox" value="y" name="AGREEMENT" class="custom-checkbox">
                            <label for="scf-6" class="custom-checkbox-label">Соглашаюсь на обработку моих <a href="/docs/politika_v_otnoshenii_obrabotki_pd.pdf" target="_blank"><u>персональных данных</u></a> и с <a href="/docs/oferta.pdf" target="_blank"><u>офертой</u></a></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="captcha-container" class="smart-captcha" data-sitekey="ysc1_3HownHMivHE7ga7XeWijoILxy71c0NKd5LXUqdvM2bfcee0d">
                        </div>
                    </div>
                    <div class="buttons-line">
                        <button onclick="" value="y" class="btn site-form__submit">Отправить</button>
                    </div>
                    <div class="main_error"></div>
                    <div class="msg"></div>
                </div>
            </div>
        </form>
    </div>
</section>