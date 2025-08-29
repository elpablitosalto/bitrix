"use strict";

window.addEventListener('load', function () {
	function initFormValidation(form) {
		var formValidation = StandardForm();

		formValidation.init(loginForm);

		formValidation.onSuccess(function(e, form, validation) {
			form.submit();
		});
	}

	var loginForm = document.getElementById('loginForm');

	if (loginForm) {
		initFormValidation(loginForm);
	}
});