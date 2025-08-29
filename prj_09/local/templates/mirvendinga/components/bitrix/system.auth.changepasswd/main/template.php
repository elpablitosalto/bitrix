<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(empty($APPLICATION->arAuthResult["TYPE"]) || $APPLICATION->arAuthResult["TYPE"] != "OK"):?>
<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform">
    <?if ($arResult["BACKURL"] <> ''): ?>
    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    <? endif ?>
    <input type="hidden" name="AUTH_FORM" value="Y">
    <input type="hidden" name="TYPE" value="CHANGE_PWD">
    <input type="hidden" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" />
    <input type="hidden" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" />

    <div class="section__content-panel">
        <!-- begin .content-panel-->
        <div class="content-panel">
            <div class="content-panel__main">
                <div class="content-panel__header">
                    <div class="content-panel__title">
                        <!-- begin .title-->
                        <h1 class="title title_size_h1">Восстановление пароля</h1>
                        <!-- end .title-->
                    </div>
                </div>
                <div class="content-panel__form">
                    <!-- begin .form-->
                    <!-- Modifiers-->
                    <!-- form_messages_shown - display the messages element. this will automatically display all the .form__message elements-->
                    <form class="form form_type_centered" id="formNewPassword">
                        <!-- messages can be placed before or after the form-->
                        <!-- Modifiers-->
                        <!-- form__message_style_error - red color-->
                        <?
                        if (!empty($APPLICATION->arAuthResult["MESSAGE"]))
                        {
                            if($APPLICATION->arAuthResult["TYPE"] == "ERROR")
                            {
                                ?>
                                <div class="form_messages_shown">
                                    <div class="form__messages">
                                        <div class="form__message form__message_style_error">
                                            <?
                                            ShowMessage($APPLICATION->arAuthResult["MESSAGE"]); ?>
                                        </div>
                                    </div>
                                </div>
                                <?
                            }
                        }
                        ?>
                        <div class="form__main">
                            <div class="form__inputs">
                                <div class="form__line">
                                    <!-- begin .form-control-->
                                    <div class="form-control">
                                        <label class="form-control__holder">
                                            <span class="form-control__label">
                                                Новый пароль
                                            </span>
                                            <span class="form-control__field">
                                                <!-- Modifiers-->
                                                <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
                                                <input
                                                    type="password"
                                                    class="form-control__input"
                                                    required="required"
                                                    name="USER_PASSWORD"
                                                    placeholder="Придумайте пароль"
                                                />
                                                <button
                                                    type="button"
                                                    class="form-control__trigger form-control__trigger_type_password js-show-password"
                                                >
                                                    Показать / скрыть пароль
                                                </button>
                                            </span>
                                            <span class="form-control__messages">
                                                <span
                                                    style="display: none"
                                                    class="form-control__message form-control__message_style_error"
                                                >
                                                    Ошибка поля
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <!-- end .form-control-->
                                </div>
                                <div class="form__line">
                                    <!-- begin .form-control-->
                                    <div class="form-control">
                                        <label class="form-control__holder">
                                            <span class="form-control__label">
                                                Подтвердите пароль
                                            </span>
                                            <span class="form-control__field">
                                                <!-- Modifiers-->
                                                <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
                                                <input
                                                    type="password"
                                                    class="form-control__input"
                                                    required="required"
                                                    name="USER_CONFIRM_PASSWORD"
                                                    placeholder="Введите пароль еще раз"
                                                />
                                                <button
                                                    type="button"
                                                    class="form-control__trigger form-control__trigger_type_password js-show-password"
                                                >
                                                    Показать / скрыть пароль
                                                </button>
                                            </span>
                                            <span class="form-control__messages">
                                                <span
                                                    style="display: none"
                                                    class="form-control__message form-control__message_style_error"
                                                >
                                                    Ошибка поля
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <!-- end .form-control-->
                                </div>
                            </div>
                            <div class="form__controls form__controls_type_secondary">
                                <div class="form__submit form__submit_width_s">
                                    <!-- begin .button-->
                                    <button
                                        class="button button_width_full button_size_s"
                                        type="submit"
                                    >
                                        <span class="button__holder">Подтвердить</span>
                                    </button>
                                    <!-- end .button-->
                                </div>
                                <div class="form___width form___width_s">
                                    <!-- begin .button-->
                                    <a
                                        class="button button_width_m button_size_s button_style_light button_color_black"
                                        href="/auth/"
                                    >
                                        <span class="button__holder">Отмена</span>
                                    </a>
                                    <!-- end .button-->
                                </div>
                            </div>
                        </div>
                        <div class="form__final">
                            <div class="form__illustration">
                                <img
                                    src="<?=SITE_TEMPLATE_PATH?>/assets/blocks/form/images/check.svg"
                                    alt="Успех!"
                                    class="form__image"
                                    title=""
                                />
                            </div>
                            <div class="form__message-wrapper">
                                <div class="form__title">
                                    <!-- begin .title-->
                                    <h3 class="title title_size_h4">
                                        Ваша заявка успешно отправлена
                                    </h3>
                                    <!-- end .title-->
                                </div>
                                <div class="form__text">Форма успешно отправлена</div>
                                <div class="form__controls">
                                    <div class="form__control">
                                        <!-- begin .button-->
                                        <a class="button button_width_full" href="#">
                                            <span class="button__holder">Понятно</span>
                                        </a>
                                        <!-- end .button-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end .form-->
                </div>
            </div>
        </div>
        <!-- end .content-panel-->
    </div>
</form>
<?else:?>
    <div class="section__content-panel">
        <!-- begin .content-panel-->
        <div class="content-panel">
            <div class="content-panel__result content-panel__result_type_status-message" style="display: block;">
                <div class="content-panel__header">
                    <div class="content-panel__title">
                        <!-- begin .title-->
                        <h1 class="title title_size_h1">Готово!</h1>
                        <!-- end .title-->
                    </div>
                </div>
                <div class="content-panel__section">
                    <div class="content-panel__status-illust">
                        <picture class="content-panel__picture">
                            <img
                                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                    data-src="<?=SITE_TEMPLATE_PATH?>/mockup/dist/assets/blocks/content-panel/images/check.svg"
                                    width="100"
                                    height="100"
                                    alt="Готово!"
                                    class="content-panel__image lazyload"
                                    title=""
                            />
                        </picture>
                    </div>
                    <div class="content-panel__text"><p>Пароль успешно изменен!</p></div>
                </div>
                <div class="content-panel__controls">
                    <div class="content-panel__control">
                        <!-- begin .button-->
                        <a class="button button_width_full button_size_s" href="/auth/">
                            <span class="button__holder">Вернуться ко входу</span>
                        </a>
                        <!-- end .button-->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?endif;?>