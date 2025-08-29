(function validation() {
    window.addEventListener('load', function () {
        //форма контактов
        var contactsForm = document.getElementById('contactsForm');
        if (contactsForm) {
            var contactsFormValidation = StandardModalForm();
            contactsFormValidation.init(contactsForm);
            contactsFormValidation.onSuccess(function(e, form, validation) {
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
                        let successModalId = 'modalSubmitSuccess';
                        let $olderSuccessModal = $('#' + successModalId);
                        let $formWrapper = $(contactsForm).parents('.panel-form');

                        if ($olderSuccessModal) {
                            $olderSuccessModal.remove();
                        }

                        $formWrapper.after(data);
                        window.openModal('modalSubmitSuccess');
                        window.resetForm(contactsForm);
                    },
                    onfailure: function(data) {
                        console.error(data)
                    }
                });
            });
        }
    });
})();
