"use strict";

const justValidateErrorMessages = {
	required: 'Поле обязательно',
	email: 'Введите корректный email',
	phone: 'Введте корректный номер телефона',
	min: 'Минимальное значение: %val%',
	max: 'Максимальное значение: %val%',
	minLength: 'Минимальное количество знаков: %val%',
	maxLength: 'Максимальное количество знаков: %val%',
	pattern: 'Неверный формат',
}

const StandardForm = function () {
	let latestFormSource = null,
		form = null,
		validation,
		validationRules = [],
		customOnFailCallback = null,
		customOnSuccessCallback = null;

	const init = function () {
		if (!form) {
			getElements();
		}

		if (!form) {
			throw new Error('Provided form not found on page');
		}

		initValidation();
		getValidationRules();

		if (validationRules.length) {
			setValidation();
		}
	}

	const getElements = function () {
		if (typeof latestFormSource === 'string') {
			form = document.getElementById(latestFormSource);
		} else if (latestFormSource) {
			form = latestFormSource;
		}
	};

	const initValidation = function () {
		window.formValidationArray = [];
		validation = new JustValidate(form, {
			errorFieldCssClass: 'form-control__input_state_invalid',
			errorLabelCssClass: 'form-control__message form-control__message_style_error'
		});
		window.formValidationArray.push(validation);

		validation.onFail(onFail);
		validation.onSuccess(onSuccess);
	}

	const onSuccess = function (evt) {
		if (customOnSuccessCallback) {
			customOnSuccessCallback(evt, form, validation);
		} else {
			console.log('Form sent successfully, POSTing. You can overwrite this function by calling .onSuccess() method with your custom callback');
			form.submit();
		}
	}

	const onFail = function (evt) {
		if (customOnFailCallback) {
			customOnFailCallback(evt, form, validation);
		} else {
			console.log('Form not sent. You can overwrite this function by calling .onFail() method with your custom callback');
		}
	}

	const destroy = function (hardReset) {
		validation.destroy();
		form.noValidate = false;
		validation = null;
		validationRules = [];

		if (hardReset) {
			form = null;
			customOnFailCallback = null;
			customOnSuccessCallback = null;
		}
	}

	const getValidationRules = function () {
		if (form) {
			const elements = form.querySelectorAll('input, textarea, select');

			if (elements.length) {
				for (let i = 0; i < elements.length; i++) {
					const element = elements[i],
						rules = [];

					if (element.required) rules.push({
						rule: 'required',
						errorMessage: justValidateErrorMessages['required']
					});

					if (element.type === 'email') rules.push({
						rule: 'email',
						errorMessage: justValidateErrorMessages['email']
					});

					if (element.type === 'tel') rules.push({
						rule: 'customRegexp',
						value: '^\\+7 \\(\\d\\d\\d\\) \\d\\d\\d-\\d\\d-\\d\\d',
						errorMessage: justValidateErrorMessages['phone']
					});

					if (typeof element.min !== 'undefined' && element.min !== '') rules.push({
						rule: 'minNumber',
						value: Number(element.min),
						errorMessage: justValidateErrorMessages['min'].replace('%val%', element.min)
					});

					if (typeof element.max !== 'undefined' && element.max !== '') rules.push({
						rule: 'maxNumber',
						value: Number(element.max),
						errorMessage: justValidateErrorMessages['max'].replace('%val%', element.max)
					});

					if (typeof element.minLength !== 'undefined' && element.minLength >= 0) rules.push({
						rule: 'minLength',
						value: Number(element.minLength),
						errorMessage: justValidateErrorMessages['minLength'].replace('%val%', element.minLength)
					});

					if (typeof element.maxLength !== 'undefined' && element.maxLength >= 0) rules.push({
						rule: 'maxLength',
						value: Number(element.maxLength),
						errorMessage: justValidateErrorMessages['maxLength'].replace('%val%', element.maxLength)
					});

					if (typeof element.pattern !== 'undefined' && element.pattern !== '') rules.push({
						rule: 'customRegexp',
						value: new RegExp(element.pattern),
						errorMessage: justValidateErrorMessages['pattern'].replace('%val%', element.pattern)
					});

					if (rules.length) {
						setValidationRule({
							element: element,
							rules: rules
						});
					}
				}
			}
		}
	}

	const setValidationRule = function (rule) {
		validationRules.push(rule);
	}

	const setValidation = function () {
		for (let i = 0; i < validationRules.length; i++) {
			const field = validationRules[i];
			validation.addField(field.element, field.rules);
		}
	}

	return {
		init: function (formIdOrEl) {
			if (formIdOrEl) {
				latestFormSource = formIdOrEl;
			}

			if (latestFormSource) {
				init();
				return validation;
			} else {
				throw new Error('Id or form element required as argument');
			}
		},

		refresh: function () {
			validation.refresh();
		},

		reInit: function (formIdOrEl) {
			destroy(!!formIdOrEl);

			if (formIdOrEl) {
				latestFormSource = formIdOrEl;
			}
			init();
		},

		revalidate: function () {
			validation.revalidate();
		},

		onSuccess: function (callback) {
			customOnSuccessCallback = callback;
		},

		onFail: function (callback) {
			customOnFailCallback = callback;
		},

		destroy: function () {
			destroy(true);
		}
	}
};

const StandardModalForm = function () {
	let latestFormSource = null,
		form = null,
		validation,
		validationRules = [],
		customOnFailCallback = null,
		customOnSuccessCallback = null;

	const init = function () {
		if (!form) {
			getElements();
		}

		if (!form) {
			throw new Error('Provided form not found on page');
		}

		initValidation();
		getValidationRules();

		if (validationRules.length) {
			setValidation();
		}
	}

	const getElements = function () {
		if (typeof latestFormSource === 'string') {
			form = document.getElementById(latestFormSource);
		} else if (latestFormSource) {
			form = latestFormSource;
		}
	};

	const initValidation = function () {
		validation = new JustValidate(form, {
			errorFieldCssClass: 'form-control__input_state_invalid',
			errorLabelCssClass: 'form-control__message form-control__message_style_error'
		});

		validation.onFail(onFail);
		validation.onSuccess(onSuccess);
	}

	const onSuccess = function (evt) {
		if (customOnSuccessCallback) {
			customOnSuccessCallback(evt, form, validation);
		} else {
			console.log('Form sent successfully. You can overwrite this function by calling .onSuccess() method with your custom callback');
		}
	}

	const onFail = function (evt) {
		if (customOnFailCallback) {
			customOnFailCallback(evt, form, validation);
		} else {
			console.log('Form not sent. You can overwrite this function by calling .onFail() method with your custom callback');
		}
	}

	const destroy = function (hardReset) {
		validation.destroy();
		form.noValidate = false;
		validation = null;
		validationRules = [];

		if (hardReset) {
			form = null;
			customOnFailCallback = null;
			customOnSuccessCallback = null;
		}
	}

	const getValidationRules = function () {
		if (form) {
			const elements = form.querySelectorAll('input, textarea, select');

			if (elements.length) {
				for (let i = 0; i < elements.length; i++) {
					const element = elements[i],
						rules = [];

					if (element.required) rules.push({
						rule: 'required',
						errorMessage: justValidateErrorMessages['required']
					});

					if (element.type === 'email') rules.push({
						rule: 'email',
						errorMessage: justValidateErrorMessages['email']
					});

					if (element.type === 'tel') rules.push({
						rule: 'customRegexp',
						value: '^\\+7 \\(\\d\\d\\d\\) \\d\\d\\d-\\d\\d-\\d\\d',
						errorMessage: justValidateErrorMessages['phone']
					});

					if (typeof element.min !== 'undefined' && element.min !== '') rules.push({
						rule: 'minNumber',
						value: Number(element.min),
						errorMessage: justValidateErrorMessages['min'].replace('%val%', element.min)
					});

					if (typeof element.max !== 'undefined' && element.max !== '') rules.push({
						rule: 'maxNumber',
						value: Number(element.max),
						errorMessage: justValidateErrorMessages['max'].replace('%val%', element.max)
					});

					if (typeof element.minLength !== 'undefined' && element.minLength >= 0) rules.push({
						rule: 'minLength',
						value: Number(element.minLength),
						errorMessage: justValidateErrorMessages['minLength'].replace('%val%', element.minLength)
					});

					if (typeof element.maxLength !== 'undefined' && element.maxLength >= 0) rules.push({
						rule: 'maxLength',
						value: Number(element.maxLength),
						errorMessage: justValidateErrorMessages['maxLength'].replace('%val%', element.maxLength)
					});

					if (typeof element.pattern !== 'undefined' && element.pattern !== '') rules.push({
						rule: 'customRegexp',
						value: new RegExp(element.pattern),
						errorMessage: justValidateErrorMessages['pattern'].replace('%val%', element.pattern)
					});

					if (rules.length) {
						setValidationRule({
							element: element,
							rules: rules
						});
					}
				}
			}
		}
	}

	const setValidationRule = function (rule) {
		validationRules.push(rule);
	}

	const setValidation = function () {
		for (let i = 0; i < validationRules.length; i++) {
			const field = validationRules[i];
			validation.addField(field.element, field.rules);
		}
	}

	return {
		init: function (formIdOrEl) {
			if (formIdOrEl) {
				latestFormSource = formIdOrEl;
			}

			if (latestFormSource) {
				init();
				return validation;
			} else {
				throw new Error('Id or form element required as argument');
			}
		},

		refresh: function () {
			validation.refresh();
		},

		reInit: function (formIdOrEl) {
			destroy(!!formIdOrEl);
			init();
		},

		revalidate: function () {
			validation.revalidate();
		},

		onSuccess: function (callback) {
			customOnSuccessCallback = callback;
		},

		onFail: function (callback) {
			customOnFailCallback = callback;
		},

		destroy: function () {
			destroy(true);
		}
	}
};

window.addEventListener('load', function () {
	window.formValidationArray = [];
	window.resetForm = function (form, preserveValueAttributes) {
		if (!form) return;

		for (var i = 0; i < form.length; i++) {
			var input = form[i];

			if (input.tagName !== 'TEXTAREA' && input.tagName !== 'INPUT') {
				continue;
			}

			if (input.type === 'hidden') {
				continue;
			}

			if (input.classList.contains('js-image-input') || input.classList.contains('js-file-input')) {
				window.resetFileInput(input);
				continue;
			}

			if (input.classList.contains('js-rating-input')) {
				window.updateRating(input, 0);
				continue;
			}

			if (preserveValueAttributes && input.attributes.value) {
				input.value = input.attributes.value.value;
				continue;
			}

			input.value = '';
		}

		window.formValidationArray.forEach(function (validation) {
			try {
				validation.refresh();
			} catch {
				console.log('validation no longer exists');
			}
		});

		form.classList.remove('form_state_sent');
	};
	document.body.addEventListener('click', function (e) {
		var resetTrigger = e.target.closest('.js-form-reset');
		if (resetTrigger) {
			var form = resetTrigger.closest('form');
			window.resetForm(form);
		}
	});
});