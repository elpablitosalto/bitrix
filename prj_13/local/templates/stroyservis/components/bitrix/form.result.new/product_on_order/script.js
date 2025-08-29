$(document).ready(function () {
});

function initProductOnOrderPopupForm() {
    $('.order-order .js_phone_class').inputmask("+7-999-999-99-99");

    $('.order-order form').each(function () {
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
                        ym(16721107,'reachGoal','order_1');
                        $('.js_product_on_order_form_container').html($(result).find('.js_product_on_order_form_container').html());
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