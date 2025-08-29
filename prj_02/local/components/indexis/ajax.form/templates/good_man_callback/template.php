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

<section class="projects-subscribe">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="section__content">
                    <h3 class="section__title">Как вырастить хорошего человека. <span class="text-color-orange">Подписка для осознанных родителей</span>
                    </h3>
                    <form ethod="post" action="/index.php" autocomplete="off" class="site-form projects-subscribe-form ajax-form">
                        <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
                        <?= bitrix_sessid_post() ?>
                        <div class="row">
                            <div class="col-sm col-lg-7">
                                <div class="form-group">
                                    <input id="ps-1" type="text" placeholder="E-mail" name="NAME" class="form-control">
                                </div>
                                <div class="form-personal-agreement">
                                    <input id="mhi-5" type="checkbox" name="AGREEMENT" value="y" class="custom-checkbox">
                                    <label for="mhi-5" class="custom-checkbox-label">
                                        Соглашаюсь с <a href="/docs/oferta.pdf" class="text-color-orange" target="_blank"><u>офертой</u></a> и на обработку моих <a href="/docs/politika_v_otnoshenii_obrabotki_pd.pdf" class="text-color-orange" target="_blank"><u>персональных данных</u></a>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-auto col-lg-5">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-submit">Подписаться
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                                            <use xlink:href="#arrow"></use>
                                        </svg>
                                    </button>
                                </div>
                                <? if ($arParams["CHECK_CAPTCHA"] != "N") { ?>
                                    <div class="form-group">
                                        <div id="captcha-container" class="smart-captcha" data-sitekey="ysc1_3HownHMivHE7ga7XeWijoILxy71c0NKd5LXUqdvM2bfcee0d">
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <div class="main_error"></div>
                        <div class="msg"></div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5">
                <picture class="section__image"><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/projects-subscribe-image.png" loading="lazy" alt="" title="" />
                </picture>
            </div>
        </div>
    </div>
</section>