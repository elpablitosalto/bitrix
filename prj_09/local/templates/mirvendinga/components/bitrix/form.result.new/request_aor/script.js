"use strict";
function ajaxFeedbackForm(link, formId, eventName = 'form_success') {
	var contactsForm = document.getElementById(formId);

	if (contactsForm) {
		var form = StandardForm();
		form.init(contactsForm);

		form.onSuccess(function (e) {
			e.preventDefault();

			let xhr = new XMLHttpRequest();
			xhr.open('POST', link);

			xhr.onload = function () {
				if (xhr.status != 200) {
					alert(`Ошибка ${xhr.status}: ${xhr.statusText}`);
				} else {
					var json = JSON.parse(xhr.responseText)

					if (!json.success) {
						let errorStr = '';

						if (typeof json.errors === 'Object') {
							for (let fieldKey in json.errors) {
								errorStr += json.errors[fieldKey] + '<br>';
							}
						} else {
							errorStr += json.errors;
						}

						// Ошибки вывести в элемент с классом error-msg
						contactsForm.getElementsByClassName('form__message')[0].innerHTML = errorStr;
					} else {
						// Показываем сообщение об успешной отправке
						contactsForm.classList.add('form_state_sent');
						var modal = contactsForm.closest('.modal');
						if (modal) {
							modal.classList.add('modal_type_form-sent');
						}
						var evt = new CustomEvent(eventName, { detail: {} });
						document.dispatchEvent(evt);
					}
				}
			};

			xhr.onerror = function () {
				console.log("Запрос не удался");
			};

			xhr.send(new FormData(contactsForm));

		});
	}
}
$(function() {
    /**
     * @see https://www.daterangepicker.com
     */
    $('input.js-date-period').daterangepicker({
        opens: 'center',
        timePicker: false,
        startDate: moment().subtract(1, 'months'),
        endDate: moment(),
        maxDate: moment(),
        locale: {
            format: 'DD.MM.YYYY',
            applyLabel: 'Применить',
            cancelLabel: 'Отменить',
        }
    }, function(start, end, label) {
        var $input = $(this.element);
        $input.val(start.format('DD.MM.YYYY') + " - " + end.format('DD.MM.YYYY'));
    });
});