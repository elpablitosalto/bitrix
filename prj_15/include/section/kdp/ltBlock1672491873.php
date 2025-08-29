<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>

<style>
    #ltBlock1672491873 .mk {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 17px;

        color: #FFFFFF;

    }

    #ltBlock1672491873
    .f-header {
        font-style: normal;
        font-weight: 700;
        font-size: 32px;
        line-height: 48px;
        color: #FFF;
        text-align: center;
    }

    #ltBlock1672491873
    .f-subheader {
        font-style: normal;
        font-weight: 400;
        font-size: 40px;
        line-height: 110%;
        color: #FFFFFF;

        text-align: center;
    }

    #ltBlock1672491873
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

    #ltBlock1672491873
    .f-text {
        text-align: center !important;
    }

    #ltBlock1672491873
    .cl {
        font-style: normal;
        font-weight: 500;
        font-size: 12px;
        line-height: 150%;
        text-align: center;

        color: #FFFFFF;
    }

    #ltBlock1672491873
    img {
        width: 414px;
        height: 426px;
    }

    #ltBlock1672491873
        /* поле для ввода данных пользователя */
    .f-input {
        border-radius: 9px !important;
        border: 2px solid #D1D1D1;
        background: #FFF;
        font-size: 16px;
        /* для смягчения анимации при наведении */
        transition: all 0.2s ease;
    }

    #ltBlock1672491873
        /* поле для ввода данных пользователя в разных статусах -
убираем обводку, #ltBlock1672491873 прорисовываем границу */
    .f-input:hover, #ltBlock1672491873 .f-input:active, #ltBlock1672491873 .f-input:focus {
        outline: 0;
        outline-offset: 0;
        border: 2px solid #e3b558;
    }

    #ltBlock1672491873
        /* оформляем текст, #ltBlock1672491873 введённый в поля пользователя */
    .part-userField input {
        color: #000;
    }

    #ltBlock1672491873
        /* оформляем текст подсказки к полям пользователя */
    .part-userField input::placeholder {
        color: #777777;
    }

    #ltBlock1672491873
        /* заголовок дополнительного поля */
    .field-label {
        font-size: 15px !important;
        color: #FFF;
    }

    #ltBlock1672491873
    .field-label::placeholder {
        color: #777777;
    }

    #ltBlock1672491873
        /* оформляем введённый текст в допполе */
    .form-control.f-input {
        color: #000;
    }

    #ltBlock1672491873
    .form-control.f-input:focus {
        box-shadow: none;
        -webkit-box-shadow: none;
    }

    #ltBlock1672491873
        /* оформляем подсказку допполя */
    .form-control.f-input::placeholder {
        color: #D1D1D1;
    }

    #ltBlock1672491873
    .lt-form::after {
        bottom: -358px;
        right: 10px;
        content: '';
        position: absolute;
        width: 470px;
        height: 445px;
        background: url(images/5457.png) no-repeat;
        z-index: -1;
        background-size: cover;
    }
</style>

<style>
    #ltBlock1672491873 .lt-block-wrapper {
        padding-top: 15px;
        padding-bottom: 270px
    }


    @media (min-width: 761px) {
        #ltBlock1672491873 {
            display: none;
        }
    }
</style>


<div id="ltBlock1672491873" data-block-id="1672492015"
     data-has-css="true" class="lt-block lt-view form02 lt-form lt-form-normal"
     data-code="b-8b38d"
>

    <div class="lazyload lt-block-wrapper block-cover " id="blockCover1672492015"
         style="position: relative; "
         data-bg="//fs-thb02.getcourse.ru/fileservice/file/thumbnail/h/63d5f275384f681852300a7ef0eca79e.png/s/s2000x/a/561799/sc/109">
        <div class="cover-filter"></div>
        <div class="cover-wrapper flex-container height-fixed" data-main-class="cover-wrapper">
            <div class="container">
                <div class="row">
                    <div class="modal-block-content block-box col-md-8 col-md-offset-2" style="">

                        <form
                            id="ltForm2333559"
                            class="
		lt-normal-form
		lt-form-inner
		lt-form
							"
                            action="https://school.vrachbudushego.ru/pl/lite/block-public/process?id=1672492015"
                            method="post"
                            data-open-new-window="0"
                        >
                            <input type="hidden" name="formParams[setted_offer_id]"
                                   class="external-value offer_id">

                            <div class="form-result-block"></div>

                            <div class="form-content">
                                <div
                                    id="builder2475312"
                                    class="builder "
                                    data-path="form/items"
                                >

                                    <div
                                        data-param="form/items/parts/header1"
                                        data-item-name="header1"
                                        data-title="Элемент"
                                        data-animation-mode="no"
                                        style="margin-bottom: 25px; border-radius: ; "
                                        data-setting-editable="true"
                                        class="builder-item part-header  text-center"
                                    >
                                        <div data-editable=true
                                             data-param='form/items/parts/header1/inner/text'
                                             class='f-header f-header-36'>
                                            <?$APPLICATION->IncludeComponent(
                                                "bitrix:main.include",
                                                "",
                                                Array(
                                                    "AREA_FILE_SHOW" => "file",
                                                    "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_title.php",
                                                )
                                            );?>
                                        </div>
                                    </div>
                                    <style>
                                    </style>
                                    <div
                                        data-param="form/items/parts/field20914"
                                        data-item-name="field20914"
                                        data-title="Элемент"
                                        data-animation-mode="no"
                                        style="margin-bottom: 25px; border-radius: ; "
                                        data-setting-editable="true"
                                        class="builder-item part-text  text-center"
                                    >
                                        <div style='font-size: 12px; ' class='text-accurate f-text'
                                             data-param='form/items/parts/field20914/inner/text'
                                             data-editable='true'>
                                            <?$APPLICATION->IncludeComponent(
                                                "bitrix:main.include",
                                                "",
                                                Array(
                                                    "AREA_FILE_SHOW" => "file",
                                                    "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_desc.php",
                                                )
                                            );?>
                                        </div>
                                    </div>

									<?/*
                                    <div
                                        data-param="form/items/parts/field84577"
                                        data-item-name="field84577"
                                        data-title="Элемент"
                                        data-animation-mode="no"
                                        style="margin-bottom: 25px; border-radius: ; "
                                        data-setting-editable="true"
                                        class="builder-item part-text  text-center"
                                    >
                                        <div style='font-size: 20px; ' class='text-accurate f-text'
                                             data-param='form/items/parts/field84577/inner/text'
                                             data-editable='true'>
                                            <?$APPLICATION->IncludeComponent(
                                                "bitrix:main.include",
                                                "",
                                                Array(
                                                    "AREA_FILE_SHOW" => "file",
                                                    "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_time.php",
                                                )
                                            );?>
                                        </div>
                                    </div>
									*/?>

                                    <div
                                        data-param="form/items/parts/field73620"
                                        data-item-name="field73620"
                                        data-title="Элемент"
                                        data-animation-mode="no"
                                        style="margin-bottom: 25px; border-radius: ; "
                                        data-setting-editable="true"
                                        class="builder-item part-userField  text-center"
                                    >
                                        <div id="fieldStandard8505417" data-hide-filled="0"
                                        >

                                            <div class="field-content">


                                                <div id="fieldWidget9311558" class="f-input-wrapper">

                                                    <div class="custom-field-input"></div>

                                                    <input name="formParams[userCustomFields][1565722]"
                                                           class="custom-field-value" type="hidden">

                                                    <script>
                                                        $(function () {
                                                            var field = {
                                                                "id": 1565722,
                                                                "label": "\u0412\u044b\u0431\u0435\u0440\u0438\u0442\u0435 \u0443\u0434\u043e\u0431\u043d\u043e\u0435 \u0432\u0440\u0435\u043c\u044f \u043f\u0440\u043e\u0441\u043c\u043e\u0442\u0440\u0430",
                                                                "type": "multi_select",
                                                                "required": false,
                                                                "settings": {"valueList": "15.00\n19.00"},
                                                                "description": "",
                                                                "html_block": "",
                                                                "html_block_position": "",
                                                                "show_in_table": false,
                                                                "hide_filled": false,
                                                                "hide": "1"
                                                            };
                                                            field.label = "\u0412\u044b\u0431\u0435\u0440\u0438\u0442\u0435 \u0443\u0434\u043e\u0431\u043d\u043e\u0435 \u0432\u0440\u0435\u043c\u044f \u043f\u0440\u043e\u0441\u043c\u043e\u0442\u0440\u0430";
                                                            field.settings.placeholder = "";
                                                            var fieldOptions = null
                                                            var $el = $('#fieldWidget9311558')
                                                            var $fieldEl = $el.find('.custom-field-input');
                                                            window.initCustomFormFieldEl(field, $fieldEl, fieldOptions);

                                                            var setValueToInput = function () {
                                                                if ($fieldEl[$fieldEl.data('widgetClass')]) {
                                                                    var value = $fieldEl[$fieldEl.data('widgetClass')]('getValue');
                                                                    $el.find('.custom-field-value').val(JSON.stringify(value));
                                                                }
                                                            };

                                                            $fieldEl.on('change', function () {
                                                                setValueToInput();
                                                            });
                                                            setValueToInput();
                                                            if ($fieldEl[$fieldEl.data('widgetClass')]) {
                                                                $fieldEl[$fieldEl.data('widgetClass')]('setInputClass', 'f-input');
                                                            }
                                                        });
                                                    </script>
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
                                        <div id="fieldStandard76023" data-hide-filled="0"
                                        >

                                            <div class="field-content">


                                                <input type="text" maxlength="60" class="f-input"
                                                       placeholder="Введите ваш эл. адрес"
                                                       name="formParams[email]" value="">
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
                                        <div id="fieldStandard7826989" data-hide-filled="0"
                                        >

                                            <div class="field-content">


                                                <input type="text" maxlength="60" class="f-input"
                                                       placeholder="Введите ваше имя"
                                                       name="formParams[full_name]" value="">
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
                                        <div id="fieldStandard7857768" data-hide-filled="0"
                                        >

                                            <div class="field-content">


                                                <div id="fieldWidget941436" class="f-input-wrapper">
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
                                                                    <option value="Детский невролог ">
                                                                        Детский
                                                                        невролог
                                                                    </option>
                                                                    <option value="Взрослый невролог ">
                                                                        Взрослый
                                                                        невролог
                                                                    </option>
                                                                    <option value="Офтальмолог ">Офтальмолог
                                                                    </option>
                                                                    <option value="Прочие ">Прочие</option>
                                                                    <option value="Провизор/Фармацевт ">
                                                                        Провизор/Фармацевт
                                                                    </option>
                                                                    <option value="Уролог ">Уролог</option>
                                                                    <option value="Эндокринолог ">
                                                                        Эндокринолог
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
                                        <div id="fieldStandard5730041" data-hide-filled="0"
                                        >

                                            <div class="field-content">


                                                <input type="text" maxlength="60" class="f-input"
                                                       placeholder="Введите ваш телефон"
                                                       name="formParams[phone]" value="">
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
                                                id="button4825963"
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
                                                    if (window['prsbutton4825963']) {
                                                        e.preventDefault();
                                                        return false;
                                                    } else {
                                                        $('#button4825963').addClass('disabled');
                                                        window['prsbutton4825963'] = true;
                                                        setTimeout(function () {
                                                            window['prsbutton4825963'] = false;
                                                            $('#button4825963').removeClass('disabled');
                                                        }, 6000);
                                                    }
                                                    return true;
                                                };
                                                $('#button4825963').click(function (e) {
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

                                        if ($('#builder2475312 input[type="radio"]').length == 1 && $('#builder2475312 input[type="radio"]').prop('checked')) {
                                            $('#builder2475312 input[type="radio"]').hide();
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
                                $('#ltForm2333559').liteForm();
                            });
                        </script>


                        <style>
                            #ltForm2333559 {;
                            }
                        </style>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <style media="screen">
        #blockCover1672492015 {
            min-height: 100vh;
            background-attachment: scroll
        }

        @media (max-width: 768px) {
            #blockCover1672492015 {
                background-attachment: scroll;
            }
        }

        .cover-blockCover1672492015 .cover-wrapper {
            height: 100vh;
        }


        #blockCover1672492015 .cover-filter {
            background-image: -moz-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -o-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -ms-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
        }

    </style>


</div>
