<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<style>
    #ltBlock1671799174 .f-text {
        font-style: normal;
        font-weight: 600;
        font-size: 24px;
        line-height: 165%;
        color: #FFF;

    }

    #ltBlock1671799174
    .f-header {
        font-style: normal;
        font-weight: 700;
        font-size: 48px;
        line-height: 130%;
        text-transform: uppercase;
        color: #FFF;
    }

    #ltBlock1671799174
        /* поле для ввода данных пользователя */
    .f-input {
        border-radius: 9px !important;
        border: 2px solid #D1D1D1;
        background: #FFF;
        font-size: 16px;
        /* для смягчения анимации при наведении */
        transition: all 0.2s ease;
    }

    #ltBlock1671799174
        /* поле для ввода данных пользователя в разных статусах -
убираем обводку, #ltBlock1671799174 прорисовываем границу */
    .f-input:hover, #ltBlock1671799174 .f-input:active, #ltBlock1671799174 .f-input:focus {
        outline: 0;
        outline-offset: 0;
        border: 2px solid #e3b558;
    }

    #ltBlock1671799174
        /* оформляем текст, #ltBlock1671799174 введённый в поля пользователя */
    .part-userField input {
        color: #000;
    }

    #ltBlock1671799174
        /* оформляем текст подсказки к полям пользователя */
    .part-userField input::placeholder {
        color: #777777;
    }

    #ltBlock1671799174
        /* заголовок дополнительного поля */
    .field-label {
        font-size: 15px !important;
        color: #FFF;
    }

    #ltBlock1671799174
    .field-label::placeholder {
        color: #777777;
    }

    #ltBlock1671799174
        /* оформляем введённый текст в допполе */
    .form-control.f-input {
        color: #000;
    }

    #ltBlock1671799174
    .form-control.f-input:focus {
        box-shadow: none;
        -webkit-box-shadow: none;
    }

    #ltBlock1671799174
        /* оформляем подсказку допполя */
    .form-control.f-input::placeholder {
        color: #D1D1D1;
    }

    #ltBlock1671799174
    .f-btn {
        background: linear-gradient(180deg, #FFEABE 0%, #F0B73D 100%) !important;
        border-radius: 15px;
        width: 100%;
        height: 102px;
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 600;
        font-size: 14px;
        line-height: 150%;
        /* or 21px */

        text-align: center;
        letter-spacing: 0.1em;
        text-transform: uppercase;

        color: #000000;
    }

    #ltBlock1671799174
    .custom-field-value {
        border-radius: 9px !important;
        border: 2px solid #D1D1D1;
        background: #FFF;
        font-size: 16px;
        color: #000
        /* для смягчения анимации при наведении */
        transition: all 0.2s ease;

    }

    #ltBlock1671799174
    .builder-item part-separator setting-editable {
        width: 2px;
        height: 153px;
        background: #F7CF7A;
        transform: rotate(90deg);
    }

    #ltBlock1671799174
    hr {
        /* определяем толщину, вид разделителя - прямая, и цвет */
        border-top: 2px solid #F7CF7A !important;
        /* определяем длину разделителя */
        max-width: 150px !important;
        /* убираем обводки */
        border: 0;
        margin-left: 0px !important;
    }

    #ltBlock1671799174
    .lt-form::before {
        content: '';
        position: absolute;
        top: -156px;
        left: -693px;
        width: 870px;
        height: 845px;
        background: url(<?=SITE_TEMPLATE_PATH?>/images/5457.png) no-repeat;
        z-index: -1;
        background-size: cover;
    }    </style>

<style>
    #ltBlock1671799174 .lt-block-wrapper {
        padding-top: 45px;
        padding-bottom: 45px
    }

    @media (max-width: 760px) {
        #ltBlock1671799174 {
            display: none;
        }
    }

</style>


<div id="ltBlock1671799174" data-block-id="1671802482"
     data-has-css="true" class="lt-block lt-view fcb-01 lt-formcolumn lt-formcolumn-standard"
     data-code="b-06fd7"
>


    <div class="lazyload lt-block-wrapper block-cover " id="blockCover1671802482"
         style="position: relative; "
         data-bg="<?=SITE_TEMPLATE_PATH?>/images/398.png">
        <div class="cover-filter"></div>
        <div class="cover-wrapper flex-container height-fixed" data-main-class="cover-wrapper">


            <div class="my-container flex-container wrap-col">
                <div
                    id="builder3917706"
                    class="builder  flex-column col-md-7 col-md-offset-0"
                    data-path="column2"
                >
                    <div class="common-setting-link box-setting-link" data-icon-class="fa fa-adjust"
                         data-param="column2/box" data-title="Стиль блока"
                         data-setting-editable="true"></div>

                    <div
                        data-param="column2/parts/field22838"
                        data-item-name="field22838"
                        data-title="Элемент"
                        data-animation-mode="no"
                        style="margin-bottom: 0px; border-radius: ; "
                        data-setting-editable="true"
                        class="builder-item part-header "
                    >
                        <div data-editable=true data-param='column2/parts/field22838/inner/text'
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
                        data-param="column2/parts/text1"
                        data-item-name="text1"
                        data-title="Элемент"
                        data-animation-mode="no"
                        style="margin-bottom: 25px; margin-top: 170px; border-radius: ; "
                        data-setting-editable="true"
                        class="builder-item part-text  text-left"
                    >
                        <div style='font-size: 24; ' class='text-accurate f-text'
                             data-param='column2/parts/text1/inner/text' data-editable='true'>
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
                    <style>
                    </style>
                    <div
                        data-param="column2/parts/field46672"
                        data-item-name="field46672"
                        data-title="Элемент"
                        data-animation-mode="no"
                        style="margin-bottom: 25px; border-radius: ; "
                        data-setting-editable="true"
                        class="builder-item part-separator "
                    >
                        <hr/>
                    </div>
                    <style>
                    </style>
                </div>

                <style>
                    #builder3917706 {;
                    }
                </style>


                <script>
                    $(function () {

                        if ($('#builder3917706 input[type="radio"]').length == 1 && $('#builder3917706 input[type="radio"]').prop('checked')) {
                            $('#builder3917706 input[type="radio"]').hide();
                        }

                        if ($('.animated-block').animatedBlock) {
                            $('.animated-block').animatedBlock();
                        }
                    });
                </script>

                <form
                    id="ltForm5826176"
                    class="
		lt-normal-form
		lt-form-inner
		lt-form
						flex-column col-md-5 col-md-offset-0	"
                    action="https://school.vrachbudushego.ru/pl/lite/block-public/process?id=1671802482"
                    method="post"
                    data-open-new-window="0"
                >
                    <input type="hidden" name="formParams[setted_offer_id]" class="external-value offer_id">

                    <div class="form-result-block"></div>

                    <div class="form-content">
                        <div
                            id="builder3351425"
                            class="builder "
                            data-path="form/items"
                        >

							<?/*
                            <div
                                data-param="form/items/parts/field12654"
                                data-item-name="field12654"
                                data-title="Элемент"
                                data-animation-mode="no"
                                style="margin-bottom: 23px; border-radius: ; "
                                data-setting-editable="true"
                                class="builder-item part-text "
                            >
                                <div style='font-size: 16px; ' class='text-accurate f-text'
                                     data-param='form/items/parts/field12654/inner/text'
                                     data-editable='true'>
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        Array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_reg_time.php",
                                        )
                                    );?>
                                </div>
                            </div>
							*/?>

                            <style>
                                [data-param="form/items/parts/field12654"] div.f-header, [data-param="form/items/parts/field12654"] div.f-text {
                                    line-height: 10.4px;
                                }
                            </style>
                            <div
                                data-param="form/items/parts/field96913"
                                data-item-name="field96913"
                                data-title="Элемент"
                                data-animation-mode="no"
                                style="margin-bottom: 25px; border-radius: ; "
                                data-setting-editable="true"
                                class="builder-item part-userField "
                            >
                                <div id="fieldStandard8925370" data-hide-filled="0"
                                >

                                    <div class="field-content">


                                        <div id="fieldWidget3467026" class="f-input-wrapper">

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
                                                    var $el = $('#fieldWidget3467026')
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
                                <div id="fieldStandard5847417" data-hide-filled="0"
                                >

                                    <div class="field-content">


                                        <input type="text" maxlength="60" class="f-input"
                                               placeholder="E-mail"
                                               name="formParams[email]" value="">
                                    </div>
                                </div>
                            </div>
                            <style>
                            </style>
                            <div
                                data-param="form/items/parts/field11788"
                                data-item-name="field11788"
                                data-title="Элемент"
                                data-animation-mode="no"
                                style="margin-bottom: 25px; border-radius: ; "
                                data-setting-editable="true"
                                class="builder-item part-userField "
                            >
                                <div id="fieldStandard430912" data-hide-filled="0"
                                >

                                    <div class="field-content">


                                        <input type="text" maxlength="60" class="f-input" placeholder="Имя"
                                               name="formParams[first_name]" value="">
                                    </div>
                                </div>
                            </div>
                            <style>
                            </style>
                            <div
                                data-param="form/items/parts/field14405"
                                data-item-name="field14405"
                                data-title="Элемент"
                                data-animation-mode="no"
                                style="margin-bottom: 25px; border-radius: ; "
                                data-setting-editable="true"
                                class="builder-item part-userField "
                            >
                                <div id="fieldStandard6441095" data-hide-filled="0"
                                >

                                    <div class="field-content">


                                        <div id="fieldWidget2456914" class="f-input-wrapper">
                                            <div class="custom-field type-select">
                                                <div class="custom-field-input">
                                                    <label class="field-label">
							<span class="label-value">
								Специальность							</span>
                                                    </label>
                                                    <div class="field-input-block"><select
                                                            class="custom-field-value"
                                                            class="form-control"
                                                            name="formParams[userCustomFields][1538152]">
                                                            <option value="Терапевт/ВОП  ">Терапевт/ВОП
                                                            </option>
                                                            <option value="Гинеколог ">Гинеколог</option>
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
                                data-param="form/items/parts/field31257"
                                data-item-name="field31257"
                                data-title="Элемент"
                                data-animation-mode="no"
                                style="margin-bottom: 25px; border-radius: ; "
                                data-setting-editable="true"
                                class="builder-item part-userField  phone-mask-active"
                            >
                                <div id="fieldStandard8550234" data-hide-filled="0"
                                >

                                    <div class="field-content">


                                        <input type="text" maxlength="60" class="f-input"
                                               placeholder=" ваш телефон" name="formParams[phone]" value="">
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
                                style="margin-bottom: 25px; border-radius: ; "
                                data-setting-editable="true"
                                class="builder-item part-button  text-left"
                            >


                                <button type="submit"
                                        id="button5997173"
                                        class="btn f-btn  button-md btn-success"
                                        style="color: ; background-color: ; ">
                                    Зарегистрироваться
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
                                            if (window['prsbutton5997173']) {
                                                e.preventDefault();
                                                return false;
                                            } else {
                                                $('#button5997173').addClass('disabled');
                                                window['prsbutton5997173'] = true;
                                                setTimeout(function () {
                                                    window['prsbutton5997173'] = false;
                                                    $('#button5997173').removeClass('disabled');
                                                }, 6000);
                                            }
                                            return true;
                                        };
                                        $('#button5997173').click(function (e) {
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

                                if ($('#builder3351425 input[type="radio"]').length == 1 && $('#builder3351425 input[type="radio"]').prop('checked')) {
                                    $('#builder3351425 input[type="radio"]').hide();
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
                        $('#ltForm5826176').liteForm();
                    });
                </script>


                <style>
                    #ltForm5826176 {;
                    }
                </style>

            </div>
        </div>
    </div>

    <style media="screen">
        #blockCover1671802482 {
            min-height: 100vh;
            background-attachment: scroll
        }

        @media (max-width: 768px) {
            #blockCover1671802482 {
                background-attachment: scroll;
            }
        }

        .cover-blockCover1671802482 .cover-wrapper {
            height: 100vh;
        }


        #blockCover1671802482 .cover-filter {
            background-image: -moz-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -o-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -ms-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
        }

    </style>


</div>

