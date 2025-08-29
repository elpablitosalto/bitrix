<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>

<style>
    #ltBlock1718449792 .mk {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 17px;

        color: #FFFFFF;

    }

    #ltBlock1718449792
    .f-header {
        font-style: normal;
        font-weight: 700;
        font-size: 32px;
        line-height: 48px;
        color: #FFF;
        text-align: center;
    }

    #ltBlock1718449792
    .f-subheader {
        font-style: normal;
        font-weight: 400;
        font-size: 40px;
        line-height: 110%;
        color: #FFFFFF;

        text-align: center;
    }

    #ltBlock1718449792
    .f-btn {
        background: linear-gradient(180deg, #FFEABE 0%, #F0B73D 100%);
        border-radius: 15px;
        width: 290px;
        height: 72px;
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 600;
        font-size: 10px;
        line-height: 150%;
        text-align: center;

        text-transform: uppercase;
        color: #000000 !important;
    }

    #ltBlock1718449792
    .f-text {
        text-align: center !important;
    }

    #ltBlock1718449792
    .cl {
        font-style: normal;
        font-weight: 500;
        font-size: 12px;
        line-height: 150%;
        text-align: center;

        color: #FFFFFF;
    }

    #ltBlock1718449792
    img {
        width: 414px;
        height: 426px;
    }

    #ltBlock1718449792
        /* поле для ввода данных пользователя */
    .f-input {
        border-radius: 9px !important;
        border: 2px solid #D1D1D1;
        background: #FFF;
        font-size: 16px;
        /* для смягчения анимации при наведении */
        transition: all 0.2s ease;
    }

    #ltBlock1718449792
        /* поле для ввода данных пользователя в разных статусах -
убираем обводку, #ltBlock1718449792 прорисовываем границу */
    .f-input:hover, #ltBlock1718449792 .f-input:active, #ltBlock1718449792 .f-input:focus {
        outline: 0;
        outline-offset: 0;
        border: 2px solid #e3b558;
    }

    #ltBlock1718449792
        /* оформляем текст, #ltBlock1718449792 введённый в поля пользователя */
    .part-userField input {
        color: #000;
    }

    #ltBlock1718449792
        /* оформляем текст подсказки к полям пользователя */
    .part-userField input::placeholder {
        color: #777777;
    }

    #ltBlock1718449792
        /* заголовок дополнительного поля */
    .field-label {
        font-size: 15px !important;
        color: #FFF;
    }

    #ltBlock1718449792
    .field-label::placeholder {
        color: #777777;
    }

    #ltBlock1718449792
        /* оформляем введённый текст в допполе */
    .form-control.f-input {
        color: #000;
    }

    #ltBlock1718449792
    .form-control.f-input:focus {
        box-shadow: none;
        -webkit-box-shadow: none;
    }

    #ltBlock1718449792
        /* оформляем подсказку допполя */
    .form-control.f-input::placeholder {
        color: #D1D1D1;
    }

    #ltBlock1718449792
    .lt-normal-form.lt-form-inner.lt-form {

        background: linear-gradient(180deg, #9C201F 0%, #C54F4D 97.4%);
        border-radius: 10px;


    }
</style>

<style>
    #ltBlock1718449792 .lt-block-wrapper {
        padding-top: 0px;
        padding-bottom: 45px
    }


    @media (min-width: 761px) {
        #ltBlock1718449792 {
            display: none;
        }
    }
</style>


<div id="ltBlock1718449792" data-block-id="1718450106"
     data-has-css="true" class="lt-block lt-view form02 lt-form lt-form-normal"
     data-code="b-51331"
>
    <div class="lt-block-wrapper">
        <div class="container">
            <div class="row">
                <div class="modal-block-content block-box col-md-6 col-md-offset-3" style="">

                    <form
                        id="ltForm9513096"
                        class="
		lt-normal-form
		lt-form-inner
		lt-form
							"
                        action="https://school.vrachbudushego.ru/pl/lite/block-public/process?id=1718450106"
                        method="post"
                        data-open-new-window="0"
                    >
                        <input type="hidden" name="formParams[setted_offer_id]"
                               class="external-value offer_id">

                        <div class="form-result-block"></div>

                        <div class="form-content">
                            <div
                                id="builder2167585"
                                class="builder "
                                data-path="form/items"
                            >

                                <div
                                    data-param="form/items/parts/field22118"
                                    data-item-name="field22118"
                                    data-title="Элемент"
                                    data-animation-mode="no"
                                    style="margin-bottom: 25px; color: #fff; border-radius: ; "
                                    data-setting-editable="true"
                                    class="builder-item part-userField "
                                >
                                    <div id="fieldStandard3778488" data-hide-filled="0"
                                    >

                                        <div class="field-content">


                                            <div id="fieldWidget8588093" class="f-input-wrapper">
                                                <div class="custom-field type-select">
                                                    <div class="custom-field-input">
                                                        <label class="field-label">
							<span class="label-value">
								Выберите удобное время просмотра							</span>
                                                        </label>
                                                        <div class="field-input-block"><input
                                                                id="field-input-1648162"
                                                                name="formParams[userCustomFields][1648162]"
                                                                class="custom-field-877588-value"
                                                                type="hidden"
                                                                value="">

                                                            <div><label><input type="radio"
                                                                               class="custom-field-877588"
                                                                               name="userCustomFieldscustom-field-877588"
                                                                               value="12.00"> 12.00</label>
                                                                <label><input type="radio"
                                                                              class="custom-field-877588"
                                                                              name="userCustomFieldscustom-field-877588"
                                                                              value="20.00"> 20.00</label>
                                                            </div>
                                                            <script>
                                                                $(function () {
                                                                    $('.custom-field-877588').click(function () {
                                                                        $('.custom-field-877588-value').val($(this).val());
                                                                    })
                                                                })
                                                            </script>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <style>
                                </style>
                                <div
                                    data-param="form/items/parts/emailField"
                                    data-item-name="emailField"
                                    data-title="Элемент"
                                    data-animation-mode="no"
                                    style="margin-bottom: 25px; border-radius: ; "
                                    data-setting-editable="true"
                                    class="builder-item part-userField "
                                >
                                    <div id="fieldStandard4185047" data-hide-filled="0"
                                    >

                                        <div class="field-content">


                                            <input type="text" maxlength="60" class="f-input"
                                                   placeholder="Введите ваш эл. адрес"
                                                   name="formParams[email]"
                                                   value="">
                                        </div>
                                    </div>
                                </div>
                                <style>
                                </style>
                                <div
                                    data-param="form/items/parts/nameField"
                                    data-item-name="nameField"
                                    data-title="Элемент"
                                    data-animation-mode="no"
                                    style="margin-bottom: 25px; border-radius: ; "
                                    data-setting-editable="true"
                                    class="builder-item part-userField "
                                >
                                    <div id="fieldStandard9422681" data-hide-filled="0"
                                    >

                                        <div class="field-content">


                                            <input type="text" maxlength="60" class="f-input"
                                                   placeholder="Введите ваше имя"
                                                   name="formParams[full_name]"
                                                   value="">
                                        </div>
                                    </div>
                                </div>
                                <style>
                                </style>
                                <div
                                    data-param="form/items/parts/field83893"
                                    data-item-name="field83893"
                                    data-title="Элемент"
                                    data-animation-mode="no"
                                    style="margin-bottom: 25px; border-radius: ; "
                                    data-setting-editable="true"
                                    class="builder-item part-userField "
                                >
                                    <div id="fieldStandard2555127" data-hide-filled="0"
                                    >

                                        <div class="field-content">


                                            <div id="fieldWidget8661748" class="f-input-wrapper">
                                                <div class="custom-field type-select">
                                                    <div class="custom-field-input">
                                                        <label class="field-label">
							<span class="label-value">
								Унифицированная специальность							</span>
                                                        </label>
                                                        <div class="field-input-block"><select
                                                                class="custom-field-value"
                                                                class="form-control"
                                                                name="formParams[userCustomFields][1538152]">
                                                                <option value="Терапевт/ВОП  ">
                                                                    Терапевт/ВОП
                                                                </option>
                                                                <option value="Гинеколог ">Гинеколог
                                                                </option>
                                                                <option value="Детский невролог ">Детский
                                                                    невролог
                                                                </option>
                                                                <option value="Взрослый невролог ">Взрослый
                                                                    невролог
                                                                </option>
                                                                <option value="Офтальмолог ">Офтальмолог
                                                                </option>
                                                                <option value="Прочие ">Прочие</option>
                                                                <option value="Провизор/Фармацевт ">
                                                                    Провизор/Фармацевт
                                                                </option>
                                                                <option value="Уролог ">Уролог</option>
                                                                <option value="Эндокринолог ">Эндокринолог
                                                                </option>
                                                                <option value="Детский психиатр">Детский
                                                                    психиатр
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <style>
                                </style>
                                <div
                                    data-param="form/items/parts/phoneField"
                                    data-item-name="phoneField"
                                    data-title="Элемент"
                                    data-animation-mode="no"
                                    style="margin-bottom: 25px; border-radius: ; "
                                    data-setting-editable="true"
                                    class="builder-item part-userField  phone-mask-active"
                                >
                                    <div id="fieldStandard6857973" data-hide-filled="0"
                                    >

                                        <div class="field-content">


                                            <input type="text" maxlength="60" class="f-input"
                                                   placeholder="Введите ваш телефон"
                                                   name="formParams[phone]"
                                                   value="">
                                        </div>
                                    </div>
                                </div>
                                <style>
                                </style>
                                <div
                                    data-param="form/items/parts/submitButton"
                                    data-item-name="submitButton"
                                    data-title="Элемент"
                                    data-animation-mode="no"
                                    style="margin-bottom: 0px; border-radius: ; "
                                    data-setting-editable="true"
                                    class="builder-item part-button  text-center"
                                >


                                    <button type="submit"
                                            id="button7993140" data-btn-locked disabled="disabled"
                                            class="btn f-btn  button-md btn-success"
                                            style="color: ; background-color: ; ">
                                        Зарегистрироваться бесплатно
                                    </button>

                                    <style>
                                        .btn.f-btn.button-sm {
                                            padding-left: 35px;
                                            padding-right: 35px;
                                            font-size: 14px;
                                            min-height: 46px;
                                        }

                                        .btn.f-btn.button-lg {
                                            padding-left: 70px;
                                            padding-right: 70px;
                                            min-height: 74px;
                                            font-size: 20px;
                                        }

                                        .btn.f-btn.button-md {
                                            padding-left: 60px;
                                            padding-right: 60px;
                                            min-height: 60px;
                                            font-size: 16px;
                                        }

                                        .lt-menu .btn.f-btn.button-md {
                                            padding-left: 10px;
                                            padding-right: 10px;
                                            min-height: 20px;
                                            font-size: 14px;
                                        }

                                        .lt-menu .btn.f-btn.button-sm {
                                            padding-left: 8px;
                                            padding-right: 8px;
                                            font-size: 12px;
                                            min-height: 18px;
                                        }

                                        .lt-menu .btn.f-btn.button-lg {
                                            padding-left: 40px;
                                            padding-right: 40px;
                                            min-height: 47px;
                                            font-size: 18px;
                                        }

                                        .btn.f-btn:disabled,
                                        .btn.f-btn[disabled] {
                                            cursor: not-allowed;
                                            color: transparent;
                                            filter: alpha(opacity=65);
                                            opacity: .65;
                                            -webkit-box-shadow: none;
                                            box-shadow: none;
                                        }

                                        .btn.f-btn {
                                            position: relative;
                                        }

                                        @keyframes rotation-btn {
                                            0% {
                                                transform: rotate(0deg);
                                            }
                                            100% {
                                                transform: rotate(360deg);
                                            }
                                        }

                                        .btn.f-btn[disabled]:after, .btn.f-btn:disabled:after {
                                            display: block;
                                            content: "";
                                            position: absolute;
                                            top: 0;
                                            left: 0;
                                            right: 0;
                                            bottom: 0;
                                            margin: auto;
                                            border-radius: 50%;
                                            animation: rotation-btn 1s linear infinite;
                                            border-style: solid;
                                            border-width: 3px;
                                            border-color: ;
                                        }

                                        .btn.f-btn[disabled]:after, .btn.f-btn:disabled:after {
                                            border-bottom-color: transparent;
                                        }

                                        .btn.f-btn.button-sm[disabled]:after, .btn.f-btn.button-sm:disabled:after {
                                            width: 25px;
                                            height: 25px;
                                            border-width: 3px;
                                        }

                                        .btn.f-btn.button-lg[disabled]:after, .btn.f-btn.button-lg:disabled:after {
                                            width: 40px;
                                            height: 40px;
                                            border-width: 4px;
                                        }

                                        .btn.f-btn.button-md[disabled]:after, .btn.f-btn.button-md:disabled:after {
                                            width: 30px;
                                            height: 30px;
                                            border-width: 4px;
                                        }
                                    </style>

                                    <script>
                                        $(function () {
                                            var disableButton = function (e) {
                                                if (window['prsbutton7993140']) {
                                                    e.preventDefault();
                                                    return false;
                                                } else {
                                                    $('#button7993140').addClass('disabled');
                                                    window['prsbutton7993140'] = true;
                                                    setTimeout(function () {
                                                        window['prsbutton7993140'] = false;
                                                        $('#button7993140').removeClass('disabled');
                                                    }, 6000);
                                                }
                                                return true;
                                            };
                                            $('#button7993140').click(function (e) {
                                                //disableButton(e);
                                            });
                                        });
                                    </script>
                                </div>
                                <style>
                                </style>
                            </div>


                            <script>
                                $(function () {

                                    if ($('#builder2167585 input[type="radio"]').length == 1 && $('#builder2167585 input[type="radio"]').prop('checked')) {
                                        $('#builder2167585 input[type="radio"]').hide();
                                    }

                                    if ($('.animated-block').animatedBlock) {
                                        $('.animated-block').animatedBlock();
                                    }
                                });
                            </script>
                        </div>

                        <div class="common-setting-link box-setting-link" data-icon-class="fa fa-adjust"
                             data-param="form/formBox" data-title="Стиль блока"
                             data-setting-editable="true"></div>
                        <div class="common-setting-link form-setting-link"
                             data-icon-class="fa fa-wpforms"
                             data-param="form/handler"
                             data-title="Что делать после заполнения"
                             data-setting-editable="true"
                        ></div>
                    </form>
                    <script>
                        $(function () {
                            $('#ltForm9513096').liteForm();
                        });
                    </script>


                    <style>
                        #ltForm9513096 {
                            background-color: #F0F0F0;
                            padding-left: 40px;
                            padding-right: 40px;
                            padding-top: 30px;
                            padding-bottom: 30px;
                            border: 0px solid #999999;
                        }
                    </style>

                </div>
            </div>
        </div>

    </div>
</div>
