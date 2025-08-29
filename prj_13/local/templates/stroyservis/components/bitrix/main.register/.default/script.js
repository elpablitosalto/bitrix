$(function() {

    var showError = function($elem, message) {
        $elem.find('.alert').remove();
        $elem.find('.popup-authorization__form-wrapper').after('<div class="alert alert-danger">' + message + '</div>');
    };

    $('body').on('change', '#register-field-email', function() {
        $('#register-field-login').val($(this).val());
    });

    $('body').on('blur', '.popup-authorization__form[name="regform"] input', function() {
        $(this).next('label.form__error').remove();
        $(this).removeClass('form__error');
    });

    $('body').on('submit', '.popup-authorization__form[name="regform"]', function(e) {
        e.preventDefault();

        var $form = $(this),
            $btn = $form.find('[type="submit"]'),
            data = $form.serializeArray();

        if (!$('#registration-policy').is(':checked')) {
            showError($form, 'Дайте согласие на обработку персональных данных');
            return false;
        }

        $btn.addClass('btn--loading');
        data.push({
            name: 'register_submit_button',
            value: 'y'
        });

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            dataType: "html",
            data: data,
            success: function(res){
                var $html = $('<div>' + res + '</div>');
                var $registerFormResult = $html.find('.popup-authorization__form[name="regform"]');
                $('.popup-authorization__form[name="regform"]').html($registerFormResult.html());

                if ($html.find('[data-entity="register-success"]').length > 0)
                    location.reload();
            },
            complete: function () {
                $btn.removeClass('btn--loading');
            }
        });
    });
});