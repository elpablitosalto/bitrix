"use strict";
function ajaxForgotPasswordModalForm(link, successURL) {
	var forgotPasswordForm = document.getElementById('formForgotPassword'),
		forgotPasswordFormPanel = document.getElementById('forgotPasswordFormPanel');

	if (forgotPasswordForm) {
		initFormValidation(forgotPasswordForm);
	}

	function initFormValidation(form) {
		var modal = forgotPasswordForm.closest('.modal'),
			forgotPasswordValidation = StandardForm();
		forgotPasswordValidation.init(form);

		forgotPasswordValidation.onSuccess(function (e, form, validation) {
			e.preventDefault();

			let xhr = new XMLHttpRequest();
			xhr.open('POST', link);

			xhr.onload = function () {
				if (xhr.status != 200) {
					console.log(`Ошибка ${xhr.status}: ${xhr.statusText}`);
				} else {
					var json = JSON.parse(xhr.responseText);
					var messageContainer = forgotPasswordForm.getElementsByClassName('form__message')[0];

					console.log(json, json.MESSAGE);

					if (typeof json.TYPE !== 'undefined') {
						if (json.TYPE === 'ERROR') {
							messageContainer.classList.remove('form__message_style_success');
							messageContainer.classList.add('form__message_style_error');

							if (typeof json.MESSAGE !== 'undefined') {
								messageContainer.innerHTML = json.MESSAGE;
								forgotPasswordForm.classList.add('form_messages_shown');
							}
						} else if (json.TYPE === 'OK') {
							forgotPasswordForm.classList.remove('form_messages_shown');
							messageContainer.classList.remove('form__message_style_error');
							messageContainer.classList.add('form__message_style_success');
							forgotPasswordFormPanel.classList.add('content-panel_state_result');
						} else {
							forgotPasswordForm.classList.remove('form_messages_shown');
						}
					}
				}
			};

			xhr.onerror = function () {
				console.log("Запрос не удался");
			};

			xhr.send(new FormData(forgotPasswordForm));
		});
	}
}