BX.ready(function() {
    var form_dom_class = 'js--form_modal_add_review';

    BX.ready(function() {
        BX.bindDelegate(
            document.body, 'submit', { className: form_dom_class },
            function(e) {
                sendFormCallback(e, $(this));
                return BX.PreventDefault(e);
            }
        );
    });

    function sendFormCallback(e, dataThis) {
        var dataForm = dataThis.serializeArray();

        var request = BX.ajax.runComponentAction('indexis:add.reviews.modal', 'executionSendFormReviewIblock', {
            mode: 'class',
            cache: false,
            data: {
                'data': {
                    dataForm,
                },
            },
        });

        request.then(function (response) {
            $( "div" ).remove( ".ml-form-error" );

            //alert(response['data']['status']);

            if (response['data']['status'] === 'error') {
                $('.ml-form-field').addClass('ml-form-field_error');
                $('<div class="ml-form-error">' + response['data']['error_message'] + '</div>').insertAfter('.ml-form-field > textarea');
            }

            if (response['data']['status'] !== 'error') {
                $('#text_area_review_text').val('').text('');
                $('#modal-review').hide();
                $('#modal-review-success').show();
                $('.ml-form-field').removeClass('ml-form-field_error');
            }


        }, function (response) {

        });

        return BX.PreventDefault(e);
    }

});