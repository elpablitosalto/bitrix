<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="container">
    <div class="form-wrapper form-wrapper_type_enhanced panel-form">
        <div class="panel-form__inputs">
            <form id="orderRequest" action="/local/ajax/forms/orderRequest.php" data-form-ajax>
                <div class="form-wrapper__header">
                    <h3 class="form-wrapper__heading">ОСТАВИТЬ ЗАЯВКУ</h3>
                    <p class="form-wrapper__description">Заполните форму, и наши специалисты ответят вам в течение 48 часов</p>
                </div>
                <div class="form-wrapper__inputs">
                    <div class="form-wrapper__item">
                        <label>Ваше имя*</label>
                        <input type="text" placeholder="Ваше имя" name="NAME" required />
                        <span class="error"></span>
                    </div>
                    <div class="form-wrapper__item">
                        <label>Телефон*</label>
                        <input type="phone" placeholder="+7 (_ _ _) _ _ _-_ _-_ _" name="PHONE" required />
                        <span class="error">Телефон введен не корректно</span>
                    </div>
                    <div class="form-wrapper__item">
                        <label>Город*</label>
                        <input type="text" data-forimcity-init placeholder="" name="CITY" required />
                        <span class="error">Не указан город</span>
                    </div>
                    <div class="form-wrapper__item">
                        <label>Адрес салона*</label>
                        <input type="text" data-forimadress-init placeholder="" name="ADDRESS" required />
                        <span class="error">Не указан адрес салона</span>
                    </div>
                    <!-- <div class="form-wrapper__item">
                        <label>Выберите</label>
                        <select name="PACKAGE" required>
                            <option disabled value="" selected>Выберите...</option>
                            <? foreach ($arResult['PROPERTY_LIST_FULL'][120]['ENUM'] as $k => $option) : ?>
                                <option value="<?= $k ?>"><?= $option['VALUE'] ?></option>
                            <? endforeach; ?>
                        </select>
                        <span class="error"></span>
                    </div> -->
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
                    <div class="form-wrapper__item form-wrapper__item-checkbox">
                        <input id="suggestion" type="checkbox" value="Y" name="suggestion" required />
                        <label for="suggestion">Нажимая на кнопку, вы соглашаетесь с условиями обработки персональных данных.</label>
                        <span class="error">Вы не согласились с условиями обработки персональных данных</span>
                    </div>
                </div>
                <div class="form-wrapper__submit">
                    <div class="form-wrapper__item _align-center">
                        <button type="submit" class="button button_type_enhanced button_caps_normal">Отправить заявку</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-form__illustration">
            <img src="/images/dev/form_sotrud.jpg" alt="image" class="panel-form__image">
            <!-- <div class="panel-form__label">Насыщенный цвет <br>без вреда для волос</div> -->
        </div>
    </div>
</div>