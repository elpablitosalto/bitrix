(function validation() {
	window.addEventListener('load', function () {
		//форма блоке для партнеров
		var partnershipForm = document.getElementById('partnership');
		if (partnershipForm) {
			var partnershipFormValidation = StandardModalForm();
			partnershipFormValidation.init(partnershipForm);
			partnershipFormValidation.onSuccess(function (e, form, validation) {
				console.log('Form submitted. form.submit() if wish to do a normal POST')
			});
		}
		//форма в модальном окне консультации
		var modalCallbackForm = document.getElementById('modalFooter');
		if (modalCallbackForm) {
			var partnershipFormValidation = StandardModalForm();
			partnershipFormValidation.init(modalCallbackForm);
			partnershipFormValidation.onSuccess(function (e, form, validation) {
				console.log('Form submitted. form.submit() if wish to do a normal POST')
			});
		}
	});

	// Демонстрация универсальной валидации набора форм через класс вместо id
	(function formValidationDemo() {
		const formSelector = '.js-validated-form-demo';

		const validateForm = function (form, onSuccess, onFail) {
			var formValidation = StandardForm();

			formValidation.init(form);

			if (onSuccess) {
				formValidation.onSuccess(onSuccess);
			}

			if (onFail) {
				formValidation.onFail(onFail);
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
					window.openModal('modalSubmitSuccess');
				},
			);
		}

		callOnWindowLoad(function () {
			if (typeof StandardForm !== 'undefined') {
				init();
			}
		});
	})();
})();
