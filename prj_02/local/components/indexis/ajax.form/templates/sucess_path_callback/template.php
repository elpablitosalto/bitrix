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


<section class="wrapper wrapper--bg rs__feedback">
    <div class="container">
        <div class="rs__content">
            <div class="rs__content--top rs__content--top-colm">
                <h3 class="rs__section--title">Связаться с нами и получить ответы на интересующие вопросы!</h3>
            </div>
            <div class="rs__feedback--form">
                <form action="/" class="ajax-form" data-parsley-validate enctype="multipart/form-data" method="POST"
                      id="feedbackForm">
                    <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
                    <?= bitrix_sessid_post() ?>
                    <div class="rs__form">
                        <div class="rs__form--item">
                            <label class="rs__input--label">
                                <div class="rs__input--block">
                                    <div class="rs__input--group">
                                        <input class="rs__input" type="text" required name="NAME"
                                               placeholder="Ваши фамилия и имя">
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="rs__form--item rs__form--item-50">
                            <label class="rs__input--label">
                                <div class="rs__input--block">
                                    <div class="rs__input--group">
                                        <input class="rs__input js-phonemask-input" type="phone" required
                                               name="PROPERTY_PHONE" placeholder="Номер телефона"
                                               data-parsley-required-message="Мобильный телефон"
                                               data-phonemask-init="no">
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="rs__form--item rs__form--item-50">
                            <label class="rs__input--label">
                                <div class="rs__input--block">
                                    <div class="rs__input--group">
                                        <input class="rs__input" type="email" required name="PROPERTY_EMAIL"
                                               placeholder="E-mail">
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="rs__form--item">
                            <label class="rs__input--label">
                                <div class="rs__input--block">
                                    <div class="rs__input--group">
                                            <textarea class="rs__input rs__textarea" maxlength="400" name="PREVIEW_TEXT"
                                                      placeholder="Ваше сообщение" required></textarea>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="rs__form--item">
                            <div class="rs__form--checkbox-block">
                                <label class="rs__form--checkbox-label">
                                    <input class="rs__form--checkbox" type="checkbox" name="AGREEMENT" value="y"
                                           autocomplete="off" checked="checked">
                                    <span class="rs__form--checkbox-text">Соглашаюсь на обработку моих <a
                                                class="rs__link rs__form--checkbox-link"
                                                href="/docs/politika_v_otnoshenii_obrabotki_pd.pdf" target="_blank">персональных данных</a>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="rs__form--item rs__form--buttons">
                            <div class="rs__button__group">
                                <button class="rs__button__default rs__button--icon ico-arrow-main rs__button--icon-right"
                                        type="submit">Отправить сообщение
                                </button>
                            </div>
                        </div>
                        <div class="main_error"></div>
                        <div class="msg"></div>
                        <? if ($arParams["CHECK_CAPTCHA"] != "N") { ?>
                            <div class="rs__form--item">
                                <div id="captcha-container" class="smart-captcha" data-sitekey="ysc1_3HownHMivHE7ga7XeWijoILxy71c0NKd5LXUqdvM2bfcee0d">
                                </div>
                            </div>
                        <? } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
