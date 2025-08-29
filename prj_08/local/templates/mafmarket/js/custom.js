$(document).ready(function () {
    initMapContacts();
    //initAccordion();
    initMaskPhoneFormContacts();
    initRequestFormContacts();
    initClickShowMore();
    readMoreMaterals();
    initSelectInFilter();
    initValidateAjaxForm();
    initMaskPhone();
    showModalChangePassword();
    initOpenLoginPopup();
    initFilterCollections();
    initClickShowMoreColls();
    initValidateReloadPageForm();
    initMaskPhoneFormContacts();
    initEditProfile();
    initCheckPhone();
    initCheckLetters();

    BX.addCustomEvent('onAjaxSuccess', function () {
        initOnAjaxSuccess();
    });
});

function initOnAjaxSuccess() {
    initSelectInFilter();
    initClickShowMore();
}

function initAuthRegForgotModals() {
    showModalLogin();
    showModalAuthorization();
    showModalForgotPassword();
}

function initMaskPhoneFormContacts() {
    $('.js_phone_class').inputmask("+7-999-999-99-99");
}

function initEditProfile() {
    /* ACCOUNT PROFILE EDIT */
    $(document).on('click', '.dp-form-profile__btn-edit', function (e) {
        e.preventDefault();
        var $form = $(this).closest('.dp-form-profile');
        $form.addClass('dp-form-profile__allow-edit');
        $form.find('.dp-form-field.dp-form-field_text input[disabled]').removeAttr('disabled')
    });
}

function initCheckPhone() {
    //alert('!');
    // add a method. calls one built-in method, too.
    jQuery.validator.addMethod("phone", function (value, element) {
        var phone = 1;
        let numbers = value.replace(/\D/g, '');
        let length = numbers.length;

        return length == 11;
    }, "Phone length must be 11 digits"
    );

    // connect it to a css class
    jQuery.validator.addClassRules({
        phone: { phone: true }
    });
}

function initCheckLetters() {
    //alert('!');
    jQuery.validator.addMethod("letters", function (value, element) {
        let letters = value.replace(/[a-zA-Zа-яА-я]+/g, '');
        let length = letters.length;
        //alert(length);

        return length <= 0;
    }, "The string must contain only letters."
    );

    // connect it to a css class
    jQuery.validator.addClassRules({
        letters: { letters: true }
    });
}

// Фильтр коллекций -->
function initFilterCollections() {
    $('.js_colls_checkbox').on("click", function (e) {

        $('.js_colls_select').prop('selectedIndex', 0).selectric('refresh');

        doFilterCollections($(this));
    });

    var $select = $('.js_colls_select');
    if ($select.length > 0) {
        $select.selectric({
            disableOnMobile: false,
            nativeOnMobile: false,
            onOpen: function () {
            },
            onChange: function (event, element, selectric) {
                $('.js_colls_checkbox').prop('checked', false);

                doFilterCollections($(this));
            },
            onClose: function () {
            }
        });
    }
}
function doFilterCollections($element) {
    var $form = $element.closest('form');
    var formData = $form.serialize();
    var container_id = $form.data('container-id');

    var ajaxTimerId_FilterCollections = 0;
    var url = $form.attr('action');
    var ajaxData = formData;
    var params = {
        url: url,
        container_id: container_id,
        ajaxData: ajaxData
    };
    console.log(params);
    if (Number(ajaxTimerId_FilterCollections) > 0) {
        clearTimeout(ajaxTimerId_FilterCollections);
    }
    ajaxTimerId_FilterCollections = setTimeout(function () {
        ajaxFilterCollections(params)
    }, 500);
}
function ajaxFilterCollections(params) {
    //console.log(params);
    $.ajax({
        type: 'POST',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'html',
        success: function (result) {
            $('#' + params.container_id).html($('<div>' + result + '</div>').find('#' + params.container_id).html());
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
            initClickShowMoreColls();
            //initFilterCollections();
        }
    });
}
function initClickShowMoreColls() {
    $('.js_more_items_colls').on('click', function (e) {
        e.preventDefault();
        var idNav = $(this).data('id-nav');
        var NavNum = $(this).data('nav-num');
        var NavPageNomer = $(this).data('page-nomer');
        var NavPageCount = $(this).data('max-page');

        //alert(NavNum);

        var btn = $('#' + idNav);
        var content = $('.js_nav_result_' + NavNum);
        var nav = {
            this_page: NavPageNomer,
            max_page: NavPageCount
        };

        if (!btn.hasClass('loading') && content.length > 0) {

            btn.addClass('loading');
            if (nav.this_page < nav.max_page) {
                nav.this_page++;
                var url = window.location.pathname + window.location.search;
                //alert(url);
                var data = new Object();
                data['PAGEN_' + NavNum] = nav.this_page;
                data['AJAX_LOAD'] = 'Y';
                //alert(url);

                // Обработка формы фильтра -->
                let formId = '';
                if ($('#IS_FILTER').val() == 'Y') {
                    if ($('#FILTER_TYPE').val() == 'COLLS') {
                        formId = 'FORM_FILTER_COLLS';
                    } else if ($('#FILTER_TYPE').val() == 'PRODUCTS') {
                        formId = 'FORM_FILTER_PRODUCTS';
                    }
                    if (formId.length > 0) {
                        var $form = $('#' + formId);
                        var formData = $form.serializeArray();
                        for (var key in formData) {
                            data[formData[key].name] = formData[key].value;
                        }
                    }
                }
                // <-- Обработка формы фильтра

                //console.log(data);

                $.ajax({
                    type: 'POST',
                    dataType: 'html',
                    url: url,
                    data: data,
                    success: function (r) {
                        //alert('.js_nav_result_' + NavNum);
                        var append = $(r).find('.js_nav_result_' + NavNum).html();
                        //alert(append);
                        $('.js_nav_result_' + NavNum).append(append);
                        $('.js_nav_string_' + NavNum).html($(r).find('.js_nav_string_' + NavNum).html());
                        btn.removeClass('loading');
                        initClickShowMoreColls();
                    }
                });
            }
        }
    });
}
// <-- Фильтр коллекций

function initOpenLoginPopup() {
    $('.js_open_login_popup').on('click', function (e) {
        const modalLogin = document.getElementById('modal-login');
        if (modalLogin) {
            modalLogin.style.display = 'block';
            $('.mega__close').click();
        }
        return false;
    });
}

function showModalChangePassword() {
    const modalChangePassword = document.getElementById('modal-change-password');
    var $modalChangePasswordTogglers = $('[href="#modal-change-password"]');
    if (modalChangePassword && $modalChangePasswordTogglers.length > 0) {
        $modalChangePasswordTogglers.on('click', function (e) {
            e.preventDefault();
            $('.dp-modal').removeClass('dp-modal_active').css('display', 'none');
            $(modalChangePassword).addClass('dp-modal_active').css('display', 'block');
        });

        $modalChangePasswordTogglers.click();
    }
}

function initValidateAjaxForm() {
    $('form.js_validate_ajax:not(.validate-installed)').each(function () {

        //$('form.js_validate_ajax').validate({
        $(this).validate({
            errorClass: 'form__error',
            errorElement: 'span',
            focusInvalid: false,
            ignore: [],
            errorPlacement: function (error, element) {
                element.addClass('dp-input-error');
                element.closest('.js_validate_field_container').append(error);
            },
            submitHandler: function (form) {
                var $form = $(form);
                var formData = new FormData($form[0]);
                var container_id = $(form).data('container-id');
                var scroll_to = $(form).data('scroll-to');
                var typeForm = $(form).data('type-form');

                $form.find('input,textarea,select,button').attr('disabled', 'disabled');

                // Лоадер -->    
                var $formButtonSubmit = $form.find('[type="submit"]');
                var formButtonSubmitHtml = $formButtonSubmit.html();
                var str = ''.repeat(formButtonSubmitHtml.length);
                var width = $formButtonSubmit.width();
                var height = $formButtonSubmit.height();
                $formButtonSubmit.width(width);
                $formButtonSubmit.height(height);
                $formButtonSubmit.addClass('btn--loading').prop('disabled', true);
                $formButtonSubmit.html(str);
                // <-- Лоадер

                $.ajax({
                    type: 'POST',
                    url: $form.attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'html',
                    success: function (result) {
                        //$('#' + container_id).html($('<div>' + result + '</div>').find('#' + container_id).html());

                        if (scroll_to) {
                            scrollTo(scroll_to);
                        }
                        let funcParams = new Object();
                        funcParams['typeForm'] = typeForm;
                        funcParams['result'] = result;
                        funcParams['container_id'] = container_id;
                        afterSendValidateForm(funcParams);

                        //console.log($(result).find('#' + container_id).html());
                        initValidateAjaxForm();
                        initMaskPhone();
                        initAuthRegForgotModals();

                        $form.find('input,textarea,select,button').attr('disabled', false);
                    },
                    error: function (xhr, str) {
                        console.error(xhr.responseText);
                        initValidateAjaxForm();
                        initMaskPhone();

                        $form.find('input,textarea,select,button').attr('disabled', false);
                    },
                    complete: function () {
                        //$form.trigger('reset');
                        $formButtonSubmit.removeClass('btn--loading').prop('disabled', false);
                        $formButtonSubmit.html(formButtonSubmitHtml);

                        $form.find('input,textarea,select,button').attr('disabled', false);
                    }
                });

                return false;
            }
        });

        $(this).addClass('validate-installed');

    });
}
function afterSendValidateForm(params) {
    //console.log(params.container_id);
    //console.log(params);

    switch (params.typeForm) {
        case 'PROFILE_CH_PAS':
            $('#' + params.container_id).html($('<div>' + params.result + '</div>').find('#' + params.container_id).html());
            break;
        default:
            $('#' + params.container_id).html($('<div>' + params.result + '</div>').find('#' + params.container_id).html());

    }
}

function scrollTo(hash) {
    //location.hash = "#" + hash;
    //alert('!');
    //document.getElementById(hash).scrollIntoView();
    $('html, body').animate({
        scrollTop: $("#" + hash).offset().top
    }, 100);
}

function initValidateReloadPageForm() {
    $('form.js_validate_reload:not(.validate-installed)').each(function () {
        $(this).validate({
            errorClass: 'form__error',
            errorElement: 'span',
            focusInvalid: false,
            ignore: [],
            errorPlacement: function (error, element) {
                element.addClass('dp-input-error');
                element.closest('.dp-form-field').append(error);
                //element.closest('.js_validate_field_container').append(error);
            },
            submitHandler: function (form) {
                //var $form = $(form);
                var reload = $(form).data('reload');

                if (!$(form).hasClass('sent')) {
                    $(form).addClass('sent');
                    $(form).trigger("submit");
                }
                else {
                    if (reload == 'N') {
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        });

        $(this).addClass('validate-installed');
    });
}

function initRequestFormContacts() {
    $('.js_feedback_section form').each(function () {
        $(this).validate({
            errorClass: 'form__error',
            errorElement: 'span',
            focusInvalid: false,
            ignore: [],
            errorPlacement: function (error, element) {
                element.addClass('dp-input-error');
                element.closest('.js_input_wrapper').append(error);
            },
            submitHandler: function (form) {
                var $form = $(form);
                var formData = new FormData($form[0]);

                $form.find('input,textarea,select,button').attr('disabled', 'disabled');

                // Лоадер -->    
                var $formButtonSubmit = $form.find('[type="submit"]');
                var formButtonSubmitHtml = $formButtonSubmit.html();
                var str = ''.repeat(formButtonSubmitHtml.length);
                var width = $formButtonSubmit.width();
                var height = $formButtonSubmit.height();
                $formButtonSubmit.width(width);
                $formButtonSubmit.height(height);
                $formButtonSubmit.addClass('btn--loading').prop('disabled', true);
                $formButtonSubmit.html(str);
                // <-- Лоадер

                $.ajax({
                    type: 'POST',
                    url: $form.attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'html',
                    success: function (result) {
                        $('.js_request_container_contact_us').html($(result).find('.js_request_container_contact_us').html());
                        initMaskPhoneFormContacts();
                    },
                    error: function (xhr, str) {
                        console.error(xhr.responseText);
                        initMaskPhoneFormContacts();
                    },
                    complete: function () {
                        //$form.trigger('reset');
                        $formButtonSubmit.removeClass('btn--loading').prop('disabled', false);
                        $formButtonSubmit.html(formButtonSubmitHtml);
                    }
                });

                return false;
            }
        });
    });
}

/*
function initValidateReloadPageForm() {
    $('form.js_validate_reload').validate({
        errorClass: 'form__error',
        errorElement: 'span',
        focusInvalid: false,
        ignore: [],
        errorPlacement: function (error, element) {
            element.addClass('dp-input-error');
            element.closest('.dp-form-field').append(error);
        },
        submitHandler: function (form) {
            if (!$(form).hasClass('sent')) {
                $(form).addClass('sent');
                $(form).trigger("submit");
            }
            else {
                return true;
            }
        }
    });
}
*/

function initSelectInFilter() {
    /*
    $('.js_select_filter').on('click', function (e) {
        alert('!');
    });
    */

    var $checkbox = $('.js_checkbox_filter');
    if ($checkbox.length > 0) {
        $checkbox.on('change', function (e) {
            //alert('!');
            if ($(this).hasClass('click') == false) {
                $(this).addClass('click');
                var $this = this;
                var id = $(this).data('id');
                var flag = $(this).prop('checked');
                //alert(flag);

                $('#' + id).prop('checked', flag);
                runFilter();
                setTimeout(function () {
                    $this.removeClass('click');
                }, 1000);
            }

            //alert(id);
        });
    }

    var $select = $('.js_select_filter');
    if ($select.length > 0) {
        $select.selectric({
            onOpen: function (event, element, selectric) {
                console.log(element);
                var $data = element.$li;
                $data.each(function () {
                    if ($(this).hasClass('default')) {
                        //$(this).addClass('display-none');
                        //alert($(this).data('title'));
                        $(this).html('Все');
                    }
                });
            },
            onChange: function (event, element, selectric) {
                var str = $(this).val();
                str = String(str);
                if (str == '0') {
                    $(this).find('option').each(function () {
                        var id = $(this).attr('value');
                        if (id != 'undefined') {
                            $('#' + id).prop('checked', false);
                        }
                    });
                }
                else {
                    $('#' + str).prop('checked', true);
                }
                //alert(str);
                runFilter();
            },
            onClose: function () {
            }
        });
    }

    var $selectMultiple = $('.js_select_filter_multiple');
    if ($selectMultiple.length > 0) {
        $selectMultiple.selectric({
            onOpen: function (event, element, selectric) {
                //console.log(element);
                var $data = element.$li;
                $data.each(function () {
                    if ($(this).hasClass('default')) {
                        $(this).addClass('display-none');
                    }
                });
            },
            onChange: function (event, element, selectric) {
                //alert('!');
                //runFilter();
                /* */
                var str = $(this).val();
                str = String(str);
                //alert(str);
                var arr = str.split(',');
                //console.log(arr);
                arr.forEach(function (element, key) {
                    //console.log(key + ': ' + element);
                    //alert(element);
                });

                /**/
                $(this).find('option').each(function () {
                    var id = $(this).attr('value');
                    if (id != 'undefined') {
                        var flag = true;
                        if (arr.indexOf(id) != -1) {
                            flag = true;
                        }
                        else {
                            flag = false;
                        }
                        $('#' + id).prop('checked', flag);
                        //alert(id + ':' + flag);
                    }
                    runFilter();
                    /*
                    alert($(this).attr('value'));
                    if ($(this).attr('selected') == 'selected') {
                        alert($(this).text());
                    }
                    */
                });
                /**/
            },
            onClose: function () {
                $(this).find('option.default').each(function () {
                    $(this).display(true);
                });
            }
        });
    }
}
function runFilter() {
    $('#js_run_filter').val('Y');
    $('#checkbox_start_filter').click();
}

function readMoreMaterals() {
    $('.materials-item__description').each(function () {
        var materialsItemText = $(this).find('.materials-item__text_hide');
        var materialsItemLink = $(this).find('.materials-item__more');
        if (materialsItemText && materialsItemLink) {
            $(materialsItemLink).on('click', function (e) {
                $(materialsItemLink).addClass('display-none');
                $(materialsItemText).removeClass('display-none');
                return false;
            });
        }
    });
}

// Показать еще -->
function initClickShowMore() {
    $('.js_more_items').on('click', function (e) {
        e.preventDefault();
        var idNav = $(this).data('id-nav');
        var NavNum = $(this).data('nav-num');
        var NavPageNomer = $(this).data('page-nomer');
        var NavPageCount = $(this).data('max-page');

        //alert(NavNum);

        var btn = $('#' + idNav);
        var content = $('.js_nav_result_' + NavNum);
        var nav = {
            this_page: NavPageNomer,
            max_page: NavPageCount
        };

        if (!btn.hasClass('loading') && content.length > 0) {

            btn.addClass('loading');
            if (nav.this_page < nav.max_page) {
                nav.this_page++;
                var url = window.location.pathname + window.location.search;
                //alert(url);
                var data = new Object();
                data['PAGEN_' + NavNum] = nav.this_page;
                data['AJAX_LOAD'] = 'Y';
                //alert(url);
                $.ajax({
                    dataType: 'html',
                    url: url,
                    data: data,
                    success: function (r) {
                        //alert('.js_nav_result_' + NavNum);
                        var append = $(r).find('.js_nav_result_' + NavNum).html();
                        //alert(append);
                        $('.js_nav_result_' + NavNum).append(append);
                        $('.js_nav_string_' + NavNum).html($(r).find('.js_nav_string_' + NavNum).html());
                        btn.removeClass('loading');
                        initClickShowMore();
                    }
                });
            }
        }
    });
}
// <-- Показать еще

function initMaskPhoneFormContacts() {
    $('.js_feedback_section .js_phone_class').inputmask("+7-999-999-99-99");
}

function initMaskPhone() {
    $('.js_phone_class').inputmask("+7-999-999-99-99");
}

function initMapContacts() {
    var yMapsBlockId_2;
    yMapsBlockId_2 = document.querySelector('#map-mafmarket-2');
    var lat = $('#map-mafmarket-2').data('lat');
    var lng = $('#map-mafmarket-2').data('lng');
    //alert(lat);
    if (yMapsBlockId_2) {
        ymaps.ready(function () {
            var myMap = new ymaps.Map('map-mafmarket-2', {
                center: [Number(lng), Number(lat)],
                zoom: 16,
            }, {
                searchControlProvider: 'yandex#search'
            });

            myPlacemarkFirst = new ymaps.Placemark(myMap.getCenter(), {
                hintContent: 'МАФ Маркет'
            }, {
                iconLayout: 'default#image',
                iconImageHref: '/local/templates/mafmarket/img/design/icon-map.svg',
                iconImageSize: [40, 40],
                iconImageOffset: [-20, -50]
            });

            myPlacemarkFirst.events.add('click', function () {
                myMap.setCenter([Number(lng), Number(lat)], 16, {
                    checkZoomRange: true
                });
            });

            myMap.geoObjects
                .add(myPlacemarkFirst);
        });
    }
}

function initAccordion() {
    const contactsWay = document.querySelector('.contacts-way');
    const contentFaq = document.querySelector('.content__faq');
    if (contactsWay) {
        accordion('.contacts-way', '.contacts-way-title', '.contacts-way-toggle', 'contacts-way-title_open');
    }
    if (contentFaq) {
        accordion('.content__faq', '.content__faq-question', '.content__faq-answer', 'content__faq-question_open');
    }
}