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
<section id="site-callback" class="site-callback">
    <div class="container">
        <form method="" action="" autocomplete="off" class="site-form site-callback-form js-validate js-sticky ajax-form">
            <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
            <?= bitrix_sessid_post() ?>
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="section__title">Связаться с фондом</h3>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <input id="NAME" type="text" name="NAME" placeholder="Имя" class="form-control">
                    </div>
                    <div class="form-group">
                        <input id="PROPERTY_EMAIL" type="text" name="PROPERTY_EMAIL" placeholder="Ваш e-mail" class="form-control">
                    </div>
                    <div class="form-group">
                        <input id="PROPERTY_PHONE" type="text" name="PROPERTY_PHONE" placeholder="Номер телефона" class="form-control" data-mask="phone">
                    </div>
                    <div class="form-group">
                        <input id="PREVIEW_TEXT" type="text" name="PREVIEW_TEXT" placeholder="Сообщение" class="form-control">
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
                </div>
            </div>
        </form>
    </div>
</section>


<? /*foreach($arResult["ENUMS"]["SPEC"] as $arEnum){?>
                <div class="form-group">
                    <input id="modal-questions-form-3-<?=$arEnum["ID"]?>" type="radio" name="PROPERTY_SPEC" value="<?=$arEnum["ID"]?>" <?if(!$isChecked){?>checked<?$isChecked=true;}?> class="custom-radio">
                    <label for="modal-questions-form-3-<?=$arEnum["ID"]?>" class="custom-radio-label"><?=$arEnum["VALUE"]?></label>
                </div>


            <?}?>
            <div class="form-group">
                <?$arEnumToEmail = end($arResult["ENUMS"]["TO_EMAIL"]);?>
                <input id="modal-questions-form-4-2" type="radio" name="PROPERTY_TO_EMAIL" value="<?=$arEnumToEmail["ID"] ?>" class="custom-radio">
                <label for="modal-questions-form-4-2" class="custom-radio-label">Хочу получить ответ на e-mail</label>
            </div>
            <div class="buttons-line">
                <button type="submit" class="btn">Задать вопрос</button>
            </div>
            <div class="msg-block">
                <div class="msg">
                </div>
                <div class="main_error">
                </div>
            </div>
            */ ?>