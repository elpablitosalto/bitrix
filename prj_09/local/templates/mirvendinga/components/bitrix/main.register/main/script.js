"use strict";
function ajaxRegisterForm(link, successURL) {
	var registrationForm = document.getElementById('formRegistration'),
	registrationPanel = document.getElementById('formRegistrationPanel');

	if (registrationForm) {
		initFormValidation(registrationForm);
	}

	function initFormValidation(form) {
		var registrationValidation = StandardForm();

		registrationValidation.init(form);

		registrationValidation.onSuccess(function (e, form, validation) {
			e.preventDefault();

			let xhr = new XMLHttpRequest();
			xhr.open('POST', link);

			xhr.onload = function () {
				if (xhr.status != 200) {
					console.log(`Ошибка ${xhr.status}: ${xhr.statusText}`);
				} else {
					var json = JSON.parse(xhr.responseText);
					var messageContainer = registrationForm.getElementsByClassName('form__message')[0];

					console.log(json.MESSAGE);

					if (typeof json.TYPE !== 'undefined') {
						if (json.TYPE === 'ERROR') {
							messageContainer.classList.remove('form__message_style_success');
							messageContainer.classList.add('form__message_style_error');

							if (typeof json.MESSAGE !== 'undefined') {
								messageContainer.innerHTML = json.MESSAGE;
								registrationForm.classList.add('form_messages_shown');
							}
						} else if (json.TYPE === 'OK') {
							messageContainer.classList.remove('form__message_style_error');
							messageContainer.classList.add('form__message_style_success');
							registrationPanel.classList.add('content-panel_state_result');
						} else {
							messageContainer.innerHTML = '';
							registrationForm.classList.remove('form_messages_shown');
						}
					} else {
						messageContainer.classList.remove('form__message_style_success');
						messageContainer.classList.add('form__message_style_error');
						messageContainer.innerHTML = 'Произошла ошибка. Попробуйте отправить форму позднее.';
						registrationForm.classList.add('form_messages_shown');
					}
				}
			};

			xhr.onerror = function () {
				console.log("Запрос не удался");
			};

			xhr.send(new FormData(registrationForm));
		});
	}
}