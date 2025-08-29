<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="form">
    <form action="/local/ajax/forms/writeToUs.php" data-form-ajax>
        <div class="form-container">
            <div class="form-wrapper form-wrapper__mobile-order-2">
                <div class="form-wrapper__item">
                    <label>Как к вам обращаться?*</label>
                    <input type="text" placeholder="Ваше имя" name="NAME" required />
                </div>
            </div>
            <div class="form-wrapper">
                <div class="form-wrapper__item">
                    <label>Телефон*</label>
                    <input type="phone" placeholder="+7 (_ _ _) _ _ _-_ _-_ _" name="PHONE" required />
                    <span class="error">Телефон введен не корректно</span>
                </div>
                <div class="form-wrapper__item">
                    <label>E-mail*</label>
                    <input type="email" placeholder="pochta@mail.ru" name="EMAIL" required />
                    <span class="error">E-mail введен не корректно</span>
                </div>
                <!--<div class="form-wrapper__item">
                    <label>Город*</label>
                    <input type="text" data-forimcity-init placeholder="" name="CITY" required />
                    <span class="error">Не указан город</span>
                </div>-->
            </div>
            <!--<div class="form-wrapper">
                <div class="form-wrapper__item">
                    <label>Выберите</label>
                    <select name="DIVISION" required>
                        <option disabled value="" selected>Выберите...</option>
                        <?/*foreach($arResult['PROPERTY_LIST_FULL'][60]['ENUM'] as $k => $option):*/ ?>
                            <option value="<?/*=$k*/ ?>"><?/*=$option['VALUE']*/ ?></option>
                        <?/*endforeach;*/ ?>
                    </select>
                    <span class="error"></span>
                </div>
            </div>-->
            <div class="form-wrapper form-wrapper__column">
                <div class="form-wrapper__item">
                    <label>Ваше сообщение*</label>
                    <textarea name="MESSAGE" required></textarea>
                    <span class="error"></span>
                </div>
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
        <div class="form-finally">
            <div class="form-wrapper">
                <div class="form-wrapper__item form-wrapper__item-checkbox">
                    <input id="suggestion" type="checkbox" value="Y" name="suggestion" />
                    <label for="suggestion">Нажимая на кнопку, вы соглашаетесь с <a href="/include/licenses_detail.php" target="_blank">условиями обработки персональных данных.</a></label>
                    <span class="error">Вы не согласились с условиями обработки персональных данных</span>
                </div>
                <div class="form-wrapper__item  ">
                    <button type="submit" class="button _small">Написать</button>
                </div>
            </div>
    </form>
    </form>
</div>