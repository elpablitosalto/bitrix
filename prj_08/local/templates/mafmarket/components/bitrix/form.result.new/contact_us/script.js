/*
$(document).ready(function () {
    initMaskPhoneFormContacts();
    initRequestFormContacts();
});

function initMaskPhoneFormContacts() {
    $('.js_feedback_section .js_phone_class').inputmask("+7-999-999-99-99");
}

function initRequestFormContacts() {
    $('.js_feedback_section form').each(function () {
        $(this).validate({
            errorClass: 'form__error',
            errorElement: 'span',
            focusInvalid: false,
            ignore: [],
            errorPlacement: function(error, element) {
                element.addClass('dp-input-error');
                element.closest('.dp-form-field').append(error);
            },
            submitHandler: function (form) {
                alert('!');
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
*/