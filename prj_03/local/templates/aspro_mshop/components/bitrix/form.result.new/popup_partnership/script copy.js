$(document).ready(function () {
});

function initPartnershipPopupForm() {
    partnershipPopupFormValidate();
}

function partnershipPopupFormValidate() {
    $('.order-card form').each(function () {
        $(this).validate({
            errorClass: 'form__error',
            focusInvalid: false,
            ignore: [],
            submitHandler: function (form) {
                //alert('!');
                return sendAjaxQuickOrder(form);
            }
        });
    });
}

function sendAjaxQuickOrder(form) {
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

    var url = $('#jsOrderAjaxUrl').val();
    formData.append('action', 'add');

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'html',
        success: function (result) {
            if (location.path == "/personal/cart/") {
                ym(16721107, 'reachGoal', 'buy_1_send_form_cart');
            } else {
                ym(16721107, 'reachGoal', 'buy_1_send_form');
            }
            $('.js_quick_order_container').html(result);
            reloadPageAfterAddOrder();
            return false;
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
            $formButtonSubmit.removeClass('btn--loading').prop('disabled', false);
            $formButtonSubmit.html(formButtonSubmitHtml);
        }
    });

    return false;
}