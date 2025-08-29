$(document).ready(function () {

    $('.meeting-form .js_phone_class').inputmask("+7-999-999-99-99");

    $.validator.addMethod(
        'phone',
        function (value, element) {
            return (value.replace(/\D/g, '').length == 11) || value == '';
        },
        'Phone number is incorrect'
    );

    $.validator.addMethod("customemail",
        function (value, element) {
            return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value) || value == '';
        },
        "Sorry, I've enabled very strict email validation"
    );

    $('.meeting-form').each(function () {
        $(this).validate({
            errorClass: 'form__error',
            focusInvalid: false,
            ignore: [],
            submitHandler: function (form) {
                var $form = $(form);
                var $formButtonSubmit = $form.find('[type="submit"]');
                var formData = new FormData($form[0]);

                var formExternalParams = $form.data('external-params');
                if (typeof formExternalParams == 'object') {
                    $.each(formExternalParams, function (key, item) {
                        formData.append(item.name, item.value);
                    });
                }

                $formButtonSubmit.addClass('btn--loading').prop('disabled', true);

                $.ajax({
                    type: 'POST',
                    url: $form.attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    //dataType: 'json',
                    dataType: 'html',
                    success: function (result) {
                        var sectionId = $form.closest('section').attr('id');
                        $('#' + sectionId + ' .total-message').html($('<div>' + result + '</div>').find('#' + sectionId + ' .total-message').html());

                        $form.find('.delete-file').click();

                        ym(16721107, 'reachGoal', 'yest obyekt');
                        gtag('event', 'otpravit', {
                            'event_category': 'forma',
                            'event_label': 'yest_obyekt'
                        });
                    },
                    error: function (xhr, str) {
                        console.error(xhr.responseText);
                    },
                    complete: function () {
                        $form.trigger('reset');
                        $formButtonSubmit.removeClass('btn--loading').prop('disabled', false);
                    }
                });

                //alert('!');
                return false;
            }
        });
    });
});