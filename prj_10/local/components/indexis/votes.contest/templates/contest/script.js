BX.ready(function () {
    var form_dom_class = 'js--send_vote__for_contest';

    BX.ready(function () {
        BX.bindDelegate(
            document.body, 'submit', { className: form_dom_class },
            function (e) {
                sendFormCallback(e, $(this));
                return BX.PreventDefault(e);
            }
        );
    });

    function sendFormCallback(e, dataThis) {
        var dataForm = dataThis.serializeArray();

        var request = BX.ajax.runComponentAction('indexis:votes.contest', 'executionSendFormAddVote', {
            mode: 'class',
            cache: false,
            data: {
                'data': {
                    dataForm,
                },
            },
        });

        request.then(function (response) {
            if (response['data']['status'] !== 'error') {
                if (response['data']['action_vote'] === 'true') {
                    dataThis.find('.ml-btn.anim-item__voting-btn').addClass('active_button_for_vote');

                    if (response['data']['no_auth'] === 'true') {
                        $.cookie('USER_VOTED_FOR_PARTICIPANT_ID_' + response['data']['participantsId'] + '', 'true', { expires: 365, path: '/' });
                    }
                } else {
                    dataThis.find('.ml-btn.anim-item__voting-btn').removeClass('active_button_for_vote');

                    if (response['data']['no_auth'] === 'true') {
                        $.cookie('USER_VOTED_FOR_PARTICIPANT_ID_' + response['data']['participantsId'] + '', 'false', { expires: -1, path: '/' });
                    }
                }

                /* Изменение отображения количества голосов --> */
                var $votes = dataThis.closest('.anim-item__caption').find('.votes');
                var intUpdateOverallVoted = response['data']['intUpdateOverallVoted'];
                if ($votes.length) {
                    $('#' + $votes[0].id).html(intUpdateOverallVoted);
                }
                /* <-- */
            }


        }, function (response) {

        });

        return BX.PreventDefault(e);
    }

});