<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<div class="dp-modal dp-clinic-request-modal" id="clinic-request-modal">
    <div class="dp-modal__overlay"></div>
    <div class="dp-modal__dialog">
        <button class="dp-modal__close" type="button">
            <svg class="icon icon-cross ">
                <use xlink:href="#cross"></use>
            </svg>
        </button>
        <div class="dp-modal__body">
            <form class="dp-form dp-form-clinic-request" id="form-clinic-request" method="post" action="#">
                <div class="dp-form__body">
                    <div class="dp-field">
                        <input type="text" name="name" placeholder="Имя" required>
                    </div>
                    <div class="dp-field">
                        <input type="email" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="dp-field">
                        <input class="iti-input js-iti-input" type="tel" name="tel">
                    </div>
                </div>
                <div class="dp-form__footer">
                    <div class="dp-form__actions">
                        <button class="dp-btn dp-form__submit" type="submit">Оставить заявку</button>
                    </div>
                    <p class="dp-form__agreement-text">Нажимая на кнопку, я принимаю <a href="/licence/" target="_blank">Лицензионное соглашение</a>, подтверждаю, что ознакомлен с <a href="/privacy/" target="_blank">Политикой ООО ГЕРОФАРМ в отношении обработки персональных данных</a>, и даю <a href="/privacy/">Согласие</a> на их обработку. Согласен с использованием файлов cookie и могу отключить их в настройках браузера.
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>