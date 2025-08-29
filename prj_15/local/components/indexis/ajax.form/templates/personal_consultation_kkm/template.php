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

<div class="dp-personal-consultation-section">
    <div class="dp-personal-consultation">
        <div class="container">
            <p class="dp-personal-consultation__title">Хотите узнать о программе курса больше — получите персональную консультацию от автора курса</p>
            <form class="dp-form dp-personal-consultation-form ajax-form" action="">
                <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
                <?= bitrix_sessid_post() ?>
                <div class="dp-form__body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="dp-field">
                                <input type="text" name="NAME" placeholder="Имя" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="dp-field">
                                <input type="email" name="PROPERTY_EMAIL" placeholder="E-mail" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="dp-field">
                                <input class="iti-input js-iti-input" type="tel" name="PROPERTY_PHONE">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <button class="dp-btn dp-form__submit" type="submit">Получить консультацию</button>
                        </div>
                    </div>
                </div>
                <div class="dp-form__footer">
                    <p>Нажимая на кнопку, я принимаю <a href="/licence/" target="_blank">Лицензионное соглашение</a>, подтверждаю, что ознакомлен с <a href="/privacy/" target="_blank">Политикой ООО ГЕРОФАРМ в отношении обработки персональных данных</a>, и даю <a href="/privacy/">Согласие</a> на их обработку. Согласен с использованием файлов cookie и могу отключить их в настройках браузера.
                    </p>
                </div>
                <div class="main_error"></div>
                <div class="msg"></div>
            </form>
        </div>
    </div>
</div>
