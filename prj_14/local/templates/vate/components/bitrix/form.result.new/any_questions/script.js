(function validation() {
    window.addEventListener('load', function () {
        //форма блоке для партнеров
        var partnershipForm = document.getElementById('js_modal_footer_any_questions');
        if (partnershipForm) {
            var partnershipFormValidation = StandardModalForm();
            partnershipFormValidation.init(partnershipForm);
            partnershipFormValidation.onSuccess(function (e, form, validation) {
                //console.log('Form submitted. form.submit() if wish to do a normal POST')
                sendFormAjax_any_questions();
            });
        }
    });
})();


function sendFormAjax_any_questions() {
    const form = document.getElementById('js_modal_footer_any_questions'); // id формы
    let url = form.getAttribute("action"),
        data = new FormData(form);
    BX.ajax({
        url: url, // адрес на который передаются данные с формы
        data: data, // данные формы
        method: 'POST', // метод передачи данных POST или GET
        dataType: 'html', // тип передаваемых данных
        processData: false, //
        preparePost: false, // предобработка передаваемых данных
        onsuccess: function (data) { // в случаи успеха, выполняем действия
            console.log(data); //выводим полученные данные в результате успеха.
            $('.js_any_questions_form_container').html($('<div>'+data+'</div>').find('.js_any_questions_form_container').html());
            $('.js_any_questions_form_container').find('.form__message').show();
        },
        onfailure: function (data) { // действия в случаи ошибки
            //console.error(data) // выводим в результате ошибки, сообщение об ошибки
        }
    });
}