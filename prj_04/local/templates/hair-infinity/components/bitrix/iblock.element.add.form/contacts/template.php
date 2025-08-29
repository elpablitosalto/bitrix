<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<!-- form_messages_shown - display the messages element. this will automatically display all the .form__message elements-->
<form class="form" action="/infinity/ajax/writeToUs.php" data-form-ajax>
    <!-- messages can be placed before or after the form-->
    <div class="form__messages">

        <!-- form__message_style_error - red color-->
        <div class="form__message"></div>
    </div>
    <div class="form__main">
        <div class="form__inputs">
            <div class="form__line">
                <!-- begin .form-control-->
                <div class="form-control">
                    <label class="form-control__holder">
                        <span class="form-control__label">
                            Как к вам обращаться?*
                        </span>
                        <span class="form-control__field">
                            <input name="NAME" type="text" class="form-control__input" placeholder="Ваше имя" required="required" />
                        </span>
                        <span class="form-control__messages">
                            <span style="display: none" class="form-control__message form-control__message_style_error">
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
                            Телефон*
                        </span>
                        <span class="form-control__field">
                            <input placeholder="+7 (___) ___-__-__" name="PHONE" type="tel" class="form-control__input js-inputmask-phone" required="required" />
                        </span>
                        <span class="form-control__messages">
                            <span style="display: none" class="form-control__message form-control__message_style_error">
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
                        <span class="form-control__label">E-mail*</span>
                        <span class="form-control__field">
                            <input type="email" class="form-control__input" placeholder="pochta@mail.ru" name="EMAIL" required="required" />
                        </span>
                        <span class="form-control__messages">
                            <span style="display: none" class="form-control__message form-control__message_style_error">
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
                            Ваше сообщение*
                        </span>
                        <span class="form-control__field">
                            <textarea name="MESSAGE" class="form-control__textarea" required="required"></textarea>
                        </span>
                        <span class="form-control__messages">
                            <span style="display: none" class="form-control__message form-control__message_style_error">
                                Ошибка поля
                            </span>
                        </span>
                    </label>
                </div>
                <!-- end .form-control-->
            </div>
        </div>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => "/local/include/capcha.php",
                "AREA_FILE_RECURSIVE" => "N",
                "EDIT_MODE" => "html",
            ),
            false,
            array('HIDE_ICONS' => 'Y')
        );
        ?>
        <div class="form__footer">
            <div class="form__confirmation-check">
                <!-- begin .check-elem-->
                <div class="check-elem">
                    <input value="Y" name="suggestion" class="check-elem__input" type="checkbox" />
                    <div class="check-elem__label">
                        Нажимая на кнопку, вы соглашаетесь с <a href="/include/licenses_detail.php" target="_blank">условиями
                            обработки персональных данных.</a>
                    </div>
                </div>
                <!-- end .ckeck-elem-->
            </div>
            <div class="form__controls">
                <div class="form__control">
                    <!-- begin .button-->
                    <button class="button button_width_full button_size_l button_weight_light" type="submit">
                        <span class="button__holder">Написать</span>
                    </button>
                    <!-- end .button-->
                </div>
            </div>
        </div>
    </div>
    <div class="form__final">
        <!-- begin .result-panel-->
        <div class="result-panel">
            <div class="result-panel__illustration">
                <img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assetsblocks/result-panel/images/check.svg" alt="Успех!" class="result-panel__image" title="" />
            </div>
            <div class="result-panel__content"></div>
        </div>
        <!-- end .result-panel-->
    </div>
</form>