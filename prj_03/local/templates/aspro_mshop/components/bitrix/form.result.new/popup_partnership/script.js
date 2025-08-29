$(document).ready(function () {
    initMaskPhoneForm_Partnership();
    initRequestForm_Partnership();
    initValidateNotOnlySpaces();
});

function initMaskPhoneForm_Partnership() {
    $('.js_partnership_form .js_phone_class').inputmask("+7-999-999-99-99");
}

function initRequestForm_Partnership() {
    $('.js_partnership_form form').each(function () {
        $(this).validate({
            errorClass: 'form__error',
            focusInvalid: false,
            ignore: [],
            submitHandler: function (form) {

                var captcha = checkRecaptchav3();

                if (captcha.length) {
                    var $form = $(form);
                    var formData = new FormData($form[0]);

                    // добавить в formData значение 'g-recaptcha-response'=значение_recaptcha
                    formData.append('g-recaptcha-response', captcha);

                    var formExternalParams = $form.data('external-params');
                    if (typeof formExternalParams == 'object') {
                        $.each(formExternalParams, function (key, item) {
                            formData.append(item.name, item.value);
                        });
                    }

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
                    //console.log($form);

                    $.ajax({
                        type: 'POST',
                        url: $form.attr('action'),
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'html',
                        success: function (result) {
                            let str = $('<div>' + result + '</div>').find('.js_partnership_form').html();
                            $('.js_partnership_form').html(str);
                            initMaskPhoneForm_Partnership();
                            initValidateNotOnlySpaces();
                            //console.log(str);
                        },
                        error: function (xhr, str) {
                            console.error(xhr.responseText);
                            initMaskPhoneForm_Partnership();
                            initValidateNotOnlySpaces();
                        },
                        complete: function () {
                            //$form.trigger('reset');
                            $formButtonSubmit.removeClass('btn--loading').prop('disabled', false);
                            $formButtonSubmit.html(formButtonSubmitHtml);
                        }
                    });

                }

                return false;
            }
        });
    });
}

// Валидация форм -->
function initValidateNotOnlySpaces() {
    //alert('!!');
    // add a method. calls one built-in method, too.
    jQuery.validator.addMethod("notonlyspaces", function (value, element) {
        let result = true;
        if (value.length) {
            let str = value.split(' ').join('');
            let length = str.length;
            result = length > 0;
        }

        return result;
    }, "The text should not contain only spaces"
    );

    jQuery.validator.addMethod(
        'phone',
        function (value, element) {
            return (value.replace(/\D/g, '').length == 11) || value == '';
        },
        'Phone number is incorrect'
    );

    // connect it to a css class
    jQuery.validator.addClassRules({
        notonlyspaces: { notonlyspaces: true }
    });
}
// <-- Валидация форм

// Google Recaptcha v.3 -->

function checkRecaptchav3() {
    //проверяем элемент, содержащий код капчи
    //1. Получаем капчу
    var captcha = grecaptcha.getResponse();
    //2. Если длина кода капчи, которой ввёл пользователь не равно 6,
    //   то сразу отмечаем капчу как невалидную (без отправки на сервер)
    if (!captcha.length) {
        // Выводим сообщение об ошибке
        $('#recaptchaError').text('* Вы не прошли проверку "Я не робот"');
    } else {
        // получаем элемент, содержащий капчу
        $('#recaptchaError').text('');
    }

    return captcha.length;
}
function resetRecaptchav3() {
    grecaptcha.reset();
}
// <-- Google Recaptcha v.3