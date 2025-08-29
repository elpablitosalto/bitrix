(function validationAsk() {
    // Demonstration for form validation using a class
    (function formValidationAsk() {
        console.log('Form validation ask ready');

        const formSelector = '#js_ask_modal_form';

        const validateForm = function (form, onSuccess, onFail) {
            var formValidation = StandardForm();

            formValidation.init(form);

            if (onSuccess) {
                formValidation.onSuccess(onSuccess.bind(formValidation));

            }

            if (onFail) {
                formValidation.onFail(onFail.bind(formValidation));
            }
        }

        const validateFormGroup = function (selector, onSuccess, onFail) {
            var forms = document.querySelectorAll(selector);

            if (forms.length) {
                forms.forEach(function (form) {
                    validateForm(form, onSuccess, onFail);
                });
            }
        }

        function init() {
            validateFormGroup(
                formSelector,
                // onSuccess
                function (e, form, validation) {
                    const formObject = this;
                    formObject.toggleLoadingState(true);

                    // Imitating ajax request
                    setTimeout(function () {
                        sendFormAjax_ask(formObject);
                    }, 500);
                },
            );
        }

        callOnWindowLoad(function () {
            if (typeof SubscribeForm !== 'undefined') {
                init();
            }
        });
    })();
})();

function sendFormAjax_ask(formObject) {
    const form = document.getElementById('js_ask_modal_form'); // id формы
    //let url = form.getAttribute("action");
    let url = document.getElementById('js_template_path').value;
    let data = new FormData(form);
    BX.ajax({
        url: url, // адрес на который передаются данные с формы
        data: data, // данные формы
        method: 'POST', // метод передачи данных POST или GET
        dataType: 'html', // тип передаваемых данных
        processData: false, //
        preparePost: false, // предобработка передаваемых данных
        onsuccess: function (data) { // в случаи успеха, выполняем действия
            var jsonObject = JSON.parse(data);
            if (jsonObject.SUCCESS == 'Y') {
                //document.getElementById('js_ask_modal_form_fields_container').style.display = "hidden";
                //document.getElementById('js_ask_modal_form_success_message').style.display = "block";

                console.log('Form submitted successfully');
                formObject.toggleLoadingState(false);

                const modal = form.closest('.modal');

                form.classList.add('form_state_sent');

                if (modal) {
                    modal.classList.add('modal_form-state_sent');
                }

                document.getElementById('js_ask_modal_form_messages').style.display = "none";
            } else if (jsonObject.ERROR == 'Y') {
                showError_ask(jsonObject.ERROR_MESSAGE);
            }
        },
        onfailure: function (data) { // действия в случаи ошибки
            //console.error(data) // выводим в результате ошибки, сообщение об ошибки
            showError_ask('Error');
        }
    });
}

function showError_ask(error) {
    document.getElementById('js_ask_modal_form_messages').style.display = "block";
    document.getElementById('js_ask_modal_form_error_message').style.display = "block";
    document.getElementById('js_ask_modal_form_error_message').innerHTML = error;
    document.getElementById('js_ask_modal_form_send_button').classList.remove("button_state_loading");
    document.getElementById('js_ask_modal_form_send_button').removeAttribute("disabled");
}
