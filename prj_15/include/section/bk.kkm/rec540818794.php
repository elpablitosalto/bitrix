<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<div id="rec540818794" class="r t-rec t-rec_pt_135 t-rec_pb_150"
     style="padding-top:135px;padding-bottom:150px;background-color:#1f0c2e; " data-animationappear="off"
     data-record-type="704" data-bg-color="#1f0c2e"><!-- T704 -->
    <div class="t704">
        <div class="t-container">
            <div class="t-col t-col_12 t-align_center">
                <div class="t704__text-wrapper">
                    <div class="t704__title t-title t-title_sm t-margin_auto" style="" field="title"><span
                                style="color: rgb(255, 255, 255);">
                                                 <? $APPLICATION->IncludeComponent(
                                                     "bitrix:main.include",
                                                     "",
                                                     array(
                                                         "AREA_FILE_SHOW" => "file",
                                                         "PATH" => SITE_DIR . "include/content/kkm/" . basename(__FILE__, '.php') . "_title.php",
                                                     )
                                                 ); ?>
                        </span>
                    </div>
                </div>
                <div>
                    <form id="form540818794" name='form540818794' role="form" action='' method='POST'
                          data-formactiontype="2" data-inputbox=".t-input-group"
                          class="t-form js-form-proccess t-form_inputs-total_3 "
                          data-success-callback="t704_onSuccess"><input type="hidden" name="formservices[]"
                                                                        value="92ae1cda4ad3aa9366df1f514978c520"
                                                                        class="js-formaction-services"><input
                                type="hidden" name="formservices[]" value="a91c04d50b60086c7d02a5940fa7b750"
                                class="js-formaction-services">
                        <div class="js-successbox t-form__successbox t-text t-text_md"
                             aria-live="polite"
                             style="display:none;"
                             data-success-message="Спасибо! Скоро с вами свяжется сотрудник Цифровой Академии &quot;Врач будущего&quot;"></div>
                        <div class="t-form__inputsbox">
                            <div class="t-input-group t-input-group_nm" data-input-lid="1496321990615"
                            >
                                <div class="t-input-block"><input type="text"
                                                                  autocomplete="name"
                                                                  name="Name"
                                                                  id="input_1496321990615"
                                                                  class="t-input js-tilda-rule "
                                                                  value=""
                                                                  placeholder="Имя" data-tilda-req="1"
                                                                  aria-required="true" data-tilda-rule="name"
                                                                  aria-describedby="error_1496321990615"
                                                                  style="color:#000000;background-color:#ffffff;">
                                    <div class="t-input-error" aria-live="polite"
                                         id="error_1496321990615"></div>
                                </div>
                            </div>
                            <div class="t-input-group t-input-group_em" data-input-lid="1686757872455"
                            >
                                <div class="t-input-block"><input type="text"
                                                                  autocomplete="email"
                                                                  name="Email"
                                                                  id="input_1686757872455"
                                                                  class="t-input js-tilda-rule "
                                                                  value=""
                                                                  placeholder="Ваш Email" data-tilda-req="1"
                                                                  aria-required="true" data-tilda-rule="email"
                                                                  aria-describedby="error_1686757872455"
                                                                  style="color:#000000;background-color:#ffffff;">
                                    <div class="t-input-error" aria-live="polite"
                                         id="error_1686757872455"></div>
                                </div>
                            </div>
                            <div class="t-input-group t-input-group_ph" data-input-lid="1674479077277"
                            >
                                <div class="t-input-block"><input type="tel"
                                                                  autocomplete="tel"
                                                                  name="Phone"
                                                                  id="input_1674479077277"
                                                                  data-phonemask-init="no"
                                                                  data-phonemask-id="540818794"
                                                                  data-phonemask-lid="1674479077277"
                                                                  data-phonemask-maskcountry="RU"
                                                                  class="t-input js-phonemask-input js-tilda-rule "
                                                                  value=""
                                                                  placeholder="+7(999)999-9999"
                                                                  aria-describedby="error_1674479077277"
                                                                  style="color:#000000;background-color:#ffffff;">
                                    <div class="t-input-error" aria-live="polite"
                                         id="error_1674479077277"></div>
                                </div>
                            </div>
                            <div class="t-form__errorbox-middle">
                                <div class="js-errorbox-all t-form__errorbox-wrapper" style="display:none;">
                                    <div class="t-form__errorbox-text t-text t-text_md"><p
                                                class="t-form__errorbox-item js-rule-error js-rule-error-all"></p>
                                        <p class="t-form__errorbox-item js-rule-error js-rule-error-req">Не
                                            внесли
                                            данные в обязательное поле </p>
                                        <p class="t-form__errorbox-item js-rule-error js-rule-error-email">Email
                                            написан с ошибкой</p>
                                        <p class="t-form__errorbox-item js-rule-error js-rule-error-name">
                                            Допустили
                                            ошибку </p>
                                        <p class="t-form__errorbox-item js-rule-error js-rule-error-phone">Номер
                                            телефона указан с ошибкой</p>
                                        <p class="t-form__errorbox-item js-rule-error js-rule-error-minlength">
                                            Значение слишком короткое</p>
                                        <p class="t-form__errorbox-item js-rule-error js-rule-error-string"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="t-form__submit">
                                <button type="submit" class="t-submit"
                                        style="color:#000000;background-color:#ffcc00;border-radius:30px; -moz-border-radius:30px; -webkit-border-radius:30px;">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/content/kkm/" . basename(__FILE__, '.php') . "_button.php",
                                        )
                                    ); ?>
                                </button>
                            </div>
                        </div>
                        <div class="t-form__errorbox-bottom">
                            <div class="js-errorbox-all t-form__errorbox-wrapper" style="display:none;">
                                <div class="t-form__errorbox-text t-text t-text_md"><p
                                            class="t-form__errorbox-item js-rule-error js-rule-error-all"></p>
                                    <p class="t-form__errorbox-item js-rule-error js-rule-error-req">Не внесли
                                        данные в обязательное поле </p>
                                    <p class="t-form__errorbox-item js-rule-error js-rule-error-email">Email
                                        написан
                                        с ошибкой</p>
                                    <p class="t-form__errorbox-item js-rule-error js-rule-error-name">Допустили
                                        ошибку </p>
                                    <p class="t-form__errorbox-item js-rule-error js-rule-error-phone">Номер
                                        телефона указан с ошибкой</p>
                                    <p class="t-form__errorbox-item js-rule-error js-rule-error-minlength">
                                        Значение
                                        слишком короткое</p>
                                    <p class="t-form__errorbox-item js-rule-error js-rule-error-string"></p>
                                </div>
                            </div>
                        </div>
                    </form>
                    <style>#rec540818794 input::-webkit-input-placeholder {
                            color: #000000;
                            opacity: 0.5;
                        }

                        #rec540818794 input::-moz-placeholder {
                            color: #000000;
                            opacity: 0.5;
                        }

                        #rec540818794 input:-moz-placeholder {
                            color: #000000;
                            opacity: 0.5;
                        }

                        #rec540818794 input:-ms-input-placeholder {
                            color: #000000;
                            opacity: 0.5;
                        }

                        #rec540818794 textarea::-webkit-input-placeholder {
                            color: #000000;
                            opacity: 0.5;
                        }

                        #rec540818794 textarea::-moz-placeholder {
                            color: #000000;
                            opacity: 0.5;
                        }

                        #rec540818794 textarea:-moz-placeholder {
                            color: #000000;
                            opacity: 0.5;
                        }

                        #rec540818794 textarea:-ms-input-placeholder {
                            color: #000000;
                            opacity: 0.5;
                        }</style>
                </div>
                <div class="t704__form-bottom-text t-text t-text_xs" field="text">
                    <div style="font-size: 16px;" data-customstyle="yes"><span
                                style="color: rgb(255, 255, 255); font-family: Montserrat;">Нажимая на кнопку, я принимаю </span><a
                                href="https://vrachbudushego.ru/politik" target="_blank"
                                rel="noreferrer noopener"
                                style="color: rgb(255, 255, 255); font-family: Montserrat;">Лицензионное
                            соглашение</a><span
                                style="color: rgb(255, 255, 255); font-family: Montserrat;">, подтверждаю, что ознакомлен с </span><a
                                href="https://vrachbudushego.ru/politik" target="_blank"
                                rel="noreferrer noopener"
                                style="color: rgb(255, 255, 255); font-family: Montserrat;">Политикой ООО
                            ГЕРОФАРМ </a><span
                                style="color: rgb(255, 255, 255); font-family: Montserrat;">в отношении обработки персональных данных, и даю </span><a
                                href="https://vrachbudushego.ru/politik"
                                style="color: rgb(255, 255, 255); font-family: Montserrat;">Согласие </a><span
                                style="color: rgb(255, 255, 255); font-family: Montserrat;">на их обработку. Согласен с использованием файлов cookie и могу отключить их в настройках браузера.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>