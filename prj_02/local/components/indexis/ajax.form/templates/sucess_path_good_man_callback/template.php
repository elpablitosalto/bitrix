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



<section class="wrapper wrapper--bg rs__subscribe">
    <div class="container">
        <div class="rs__content">
            <div class="rs__subscribe--box">
                <picture class="rs__subscribe--pic">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/svg/p.svg" class="rs__subscribe--img">
                </picture>
                <div class="rs__subscribe--form">
                    <div class="rs__subscribe--title">Как вырастить хорошего человека. Подписка для осознанных
                        родителей:
                    </div>
                    <form action="/" class="ajax-form">
                        <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
                        <?= bitrix_sessid_post() ?>
                        <div class="rs__form rs__form--line">
                            <div class="rs__form--item">
                                <label class="rs__input--label">
                                    <div class="rs__input--block">
                                        <div class="rs__input--group">
                                            <input class="rs__input" type="email" placeholder="Оставьте ваш e-mail"
                                                   required name="NAME">
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="rs__form--item rs__form--buttons">
                                <div class="rs__button__group">
                                    <button class="rs__button__default rs__button--icon ico-arrow-main rs__button--icon-right rs__button--yellow"
                                            type="submit">Подписаться
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="rs__form--checkbox-block">
                            <label class="rs__form--checkbox-label" aria-describedby="parsley-id-multiple-AGREEMENT">
                                <input class="rs__form--checkbox" type="checkbox" name="AGREEMENT" value="y">
                                <span class="rs__form--checkbox-text">Соглашаюсь на обработку моих <a class="rs__link rs__form--checkbox-link" href="/docs/politika_v_otnoshenii_obrabotki_pd.pdf" target="_blank">персональных данных</a>
                                    </span>
                            </label>
                        </div>
                        <? if ($arParams["CHECK_CAPTCHA"] != "N") { ?>
                            <div class="rs__form--item">
                                <div id="captcha-container" class="smart-captcha" data-sitekey="ysc1_3HownHMivHE7ga7XeWijoILxy71c0NKd5LXUqdvM2bfcee0d">
                                </div>
                            </div>
                        <? } ?>
                        <div class="main_error"></div>
                        <div class="msg"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
