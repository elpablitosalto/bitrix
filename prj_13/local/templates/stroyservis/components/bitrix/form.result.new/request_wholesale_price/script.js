$(document).ready(function () {
});

function initRequestWholesalePricePopupForm() {
    $('.order-wholesale .js_phone_class').inputmask("+7-999-999-99-99");

    $('.order-wholesale form').each(function () {
        $(this).validate({
            errorClass: 'form__error',
            focusInvalid: false,
            ignore: [],
            submitHandler: function (form) {
                var $form = $(form);
                var formData = new FormData($form[0]);

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

                $.ajax({
                    type: 'POST',
                    url: $form.attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'html',
                    success: function (result) {
                        $('.js_request_wholesale_price_form_container').html($(result).find('.js_request_wholesale_price_form_container').html());

                        ym(16721107,'reachGoal','optovaya pokupka');
                        ym(16721107,'reachGoal','find_cost_send_form')
                        gtag('event', 'otpravit', {
                            'event_category': 'forma',
                            'event_label': 'optovaya_pokupka'
                        });
                    },
                    error: function (xhr, str) {
                        console.error(xhr.responseText);
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