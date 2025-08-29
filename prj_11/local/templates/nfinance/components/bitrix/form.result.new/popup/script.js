(function validation() {
    window.addEventListener('load', function () {
        //форма в модальном окне консультации
        var formCounseling = document.getElementById('formCounseling');
        if (formCounseling) {
            var formCounselingValidation = StandardModalForm();
            formCounselingValidation.init(formCounseling);
            formCounselingValidation.onSuccess(function(e, form, validation) {
                let url = form.getAttribute("action"),
                    data = new FormData(form);
                BX.ajax({
                    url: url,
                    data: data,
                    method: 'POST',
                    dataType: 'html',
                    processData: false,
                    preparePost: false,
                    onsuccess: function(data) {
                        let successModalId = 'modalCounselingSuccess';
                        let $olderSuccessModal = $('#' + successModalId);

                        if ($olderSuccessModal) {
                            $olderSuccessModal.remove();
                        }

                        $('body').append(data);
                        window.openModal(successModalId);
                        window.resetForm(contactsForm);
                    },
                    onfailure: function(data) {
                        console.error(data)
                    }
                });
            });
        }
        //форма в модальном окне запись на мероприятие
        var formEvents = document.getElementById('formEvents');
        if (formEvents) {
            var formEventsValidation = StandardModalForm();
            formEventsValidation.init(formEvents);
            formEventsValidation.onSuccess(function(e, form, validation) {
                let url = form.getAttribute("action"),
                    data = new FormData(form);
                BX.ajax({
                    url: url,
                    data: data,
                    method: 'POST',
                    dataType: 'html',
                    processData: false,
                    preparePost: false,
                    onsuccess: function(data) {
                        let $fancyWrapper = $(formEvents).parents('.fancybox__content');
                        $fancyWrapper.find('.modal__header').remove();
                        $fancyWrapper.find('.modal__content') .html(data);
                    },
                    onfailure: function(data) {
                        console.error(data)
                    }
                });
            });
        }
        //форма в форме подписки на рассылку
        var formSubscribe = document.getElementById('formSubscribe');
        if (formSubscribe) {
            var formSubscribeValidation = StandardModalForm();
            formSubscribeValidation.init(formSubscribe);
            formSubscribeValidation.onSuccess(function(e, form, validation) {
                let url = form.getAttribute("action"),
                    data = new FormData(form);
                BX.ajax({
                    url: url,
                    data: data,
                    method: 'POST',
                    dataType: 'html',
                    processData: false,
                    preparePost: false,
                    onsuccess: function(data) {
                        let $fancyWrapper = $(formSubscribe).parents('.fancybox__content');
                        $fancyWrapper.find('.modal__header').remove();
                        $fancyWrapper.find('.modal__content') .html(data);
                    },
                    onfailure: function(data) {
                        console.error(data)
                    }
                });
            });
        }
        //форма в модальном окне запись на тур
        var formTour = document.getElementById('formTour');
        if (formTour) {
            var formTourValidation = StandardModalForm();
            formTourValidation.init(formTour);
            formTourValidation.onSuccess(function(e, form, validation) {
                let url = form.getAttribute("action"),
                    data = new FormData(form);
                BX.ajax({
                    url: url,
                    data: data,
                    method: 'POST',
                    dataType: 'html',
                    processData: false,
                    preparePost: false,
                    onsuccess: function(data) {
                        let $fancyWrapper = $(formTour).parents('.fancybox__content');
                        $fancyWrapper.find('.modal__header').remove();
                        $fancyWrapper.find('.modal__content') .html(data);
                    },
                    onfailure: function(data) {
                        console.error(data)
                    }
                });
            });
        }
    });
})();
