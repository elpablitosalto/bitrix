(function validationDemo() {
	// Demonstration for form validation using a class
	(function formValidationDemo() {
		console.log('Form validation demo ready');

		const formSelector = '.js-demo-validated-form';

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
				forms.forEach(function(form) {
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
						console.log('Form submitted successfully');
						formObject.toggleLoadingState(false);

						const modal = form.closest('.modal');

						form.classList.add('form_state_sent');

						if (modal) {
							modal.classList.add('modal_form-state_sent');
						}
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
