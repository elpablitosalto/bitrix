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

<div class="dp-kodjizni-subscribe-section">
    <div class="dp-kodjizni-subscribe">
        <div class="container">
            <p class="dp-kodjizni-subscribe__title">Подпишитесь на рассылку</p>
            <p class="dp-kodjizni-subscribe__desc">У нас есть много полезных материалов и мы постоянно выпускаем
                новые</p>
            <form class="dp-form dp-kodjizni-subscribe-form ajax-form" action="" id="subscribe_kd_1">
            <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
            <?= bitrix_sessid_post() ?>
            <div class="dp-form__body">
                <div class="row">
                    <div class="col-sm-8 col-lg-8">
                        <div class="dp-field">
                            <input type="email" name="NAME" placeholder="E-mail" required="">
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-4">
                        <button class="dp-btn dp-form__submit" type="submit">ПОДПИСАТЬСЯ</button>
                    </div>
                </div>
            </div>
            <div class="dp-form__footer">
                <p>Нажимая на кнопку «Подписаться», вы соглашаетесь с <a href="/privacy/" target="_blank">Политикой
                        обработки персональных данных</a>
                </p>
            </div>
            <div class="main_error"></div>
            <div class="msg"></div>
            </form>
        </div>
    </div>
</div>
