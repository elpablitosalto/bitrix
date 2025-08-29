"use strict";

if (typeof callOnWindowLoad === 'undefined') {
	var callOnWindowLoad = function(callback) {
		if (document.readyState === 'complete') {
			setTimeout(function () {
				callback();
			}, 300);
		} else {
			window.addEventListener('load', function () {
				callback();
			});
		}
	}
}

const justValidateErrorMessages = {
	required: 'Required field',
	email: 'Input a valid email',
	tel: 'Input a valid phone number',
	min: 'Minimal value: %val%',
	max: 'Maximum value: %val%',
	minLength: 'Minimum characters: %val%',
	maxLength: 'Maximum characters: %val%',
	pattern: 'Incorrect format',
	url: 'Input a valid url',
	tin: 'Input a valid TIN',
}

const justValidateCustomTypes = {
	requiredCheckbox: {
		mask: /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
		errorMessage: 'One or multiple options required',
		validator: function (value, inputs) {
			const el = this;
			const name = el.name;

			if (value || !name) return value;

			const inputKeys = Object.keys(inputs);
			let result = false;
			let currentElIsLast = false;

			for (let i = 0; i < inputKeys.length; i++) {
				const key = inputKeys[i];
				const input = inputs[key].elem;

				if (input.name === name) {
					currentElIsLast = input === el;
					result = result || input.checked;
				}
			}
			return result || !currentElIsLast;
		},
	},
	email: {
		mask: /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
		errorMessage: justValidateErrorMessages.email || 'Input a valid email',
		validator: function (value) {
			return justValidateUniversalCustomTypeValidator('email', value)
		},
	},
	tel: {
		mask: /^\+\d{1,3}\s?\(?\d\d\d\)?\s?\d\d\d(-|\s)?\d\d(-|\s)?\d\d$/,
		errorMessage: justValidateErrorMessages.tel || 'Input a valid phone number',
		validator: function (value) {
			return justValidateUniversalCustomTypeValidator('tel', value)
		},
	},
	url: {
		mask: /^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)$/,
		errorMessage: justValidateErrorMessages.url || 'Input a valid url',
		validator: function (value) {
			return justValidateUniversalCustomTypeValidator('url', value)
		},
	},
	tin: {
		mask: /^\d{12}$/,
		errorMessage: justValidateErrorMessages.tin || 'Input a valid TIN',
		validator: function (value) {
			// converting to string
			value = '' + value;
			if (!(/^\d{10}$/.test(value)) && !(/^\d{12}$/.test(value))) {
				return false;
			}

			// converting to array
			value = value.split('');

			// for TIN of lenth 10
			if ((value.length === 10) && (+value[9] === ((2 * value[0] + 4 * value[1] + 10 * value[2] + 3 * value[3] + 5 * value[4] + 9 * value[5] + 4 * value[6] + 6 * value[7] + 8 * value[8]) % 11) % 10)) {
				return true;
			}

			// for TIN of lenth 12
			return (value.length === 12) && ((+value[10] === ((7 * value[0] + 2 * value[1] + 4 * value[2] + 10 * value[3] + 3 * value[4] + 5 * value[5] + 9 * value[6] + 4 * value[7] + 6 * value[8] + 8 * value[9]) % 11) % 10) && (+value[11] === ((3 * value[0] + 7 * value[1] + 2 * value[2] + 4 * value[3] + 10 * value[4] + 3 * value[5] + 5 * value[6] + 9 * value[7] + 4 * value[8] + 6 * value[9] + 8 * value[10]) % 11) % 10));
		},
	},
}

function justValidateUniversalCustomTypeValidator(type, value) {
	return value !== '' ? justValidateCustomTypes[type].mask.test(value) : true;
}

const StandardForm = function() {
	let latestFormSource = null,
		form = null,
		validation,
		validationRules = [],
		customOnFailCallback = null,
		customOnSuccessCallback = null,
		customOnSubmitCallback = null,
		lastLoadState = false;

	const init = function() {
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
		if (typeof window.formValidationArray === 'undefined') {
			window.formValidationArray = [];
		}

		form.dataset.passedValidation = "false";
		validation = new JustValidate(form, {
			errorFieldCssClass: 'form-control__input_state_invalid',
			errorLabelCssClass: 'form-control__message form-control__message_style_error'
		});
		window.formValidationArray.push(validation);

		validation.onFail(onFail);
		validation.onSuccess(onSuccess);
		form.addEventListener('submit', onSubmit);
	}

	const onSuccess = function(evt) {
		form.dataset.passedValidation = "true";
		if (customOnSuccessCallback) {
			customOnSuccessCallback(evt, form, validation);
		} else {
			console.log('Form sent successfully, POSTing. You can overwrite this function by calling .onSuccess() method with your custom callback');
			// toggleLoadingState(false);
			form.submit();
		}
	}

	const onFail = function(evt) {
		form.dataset.passedValidation = "false";
		if (customOnFailCallback) {
			customOnFailCallback(evt, form, validation);
		} else {
			console.log('Form not sent. You can overwrite this function by calling .onFail() method with your custom callback');
			// toggleLoadingState(false);
		}
	}

	const onSubmit = function(evt) {
		if (customOnSubmitCallback) {
			customOnSubmitCallback(evt, form, validation);
		} else {
			// toggleLoadingState(true);
		}
	}

	const toggleLoadingState = function(forced) {
		if (typeof forced === 'boolean') {
			lastLoadState = forced;
		} else {
			lastLoadState = !lastLoadState;
			forced = lastLoadState;
		}

		const submit = form.querySelectorAll('[type="submit"], [data-type="submit"]');
		form.classList.toggle('form_state_loading', forced);

		submit.forEach(function (el) {
			el.disabled = forced;
			if (el.classList.contains('button')) {
				el.classList.toggle('button_state_loading', forced);
			}
		});
	}

	const destroy = function(hardReset) {
		validation.destroy();
		form.noValidate = false;
		form.dataset.passedValidation = '';
		validation = null;
		validationRules = [];

		if (hardReset) {
			form = null;
			customOnFailCallback = null;
			customOnSuccessCallback = null;
			customOnSubmitCallback = null;
		}
	}

	const getValidationRules = function () {
		if (form) {
			const elements = form.querySelectorAll('input, textarea, select');

			if (elements.length) {
				for (let i = 0; i < elements.length; i++) {
					const element = elements[i],
						rules = [];

					if (element.required) {
						if (element.type !== 'checkbox') {
							rules.push({
								rule: 'required',
								errorMessage: justValidateErrorMessages['required']
							});
						} else {
							rules.push({
								validator: justValidateCustomTypes.requiredCheckbox.validator.bind(element),
								errorMessage: justValidateCustomTypes.requiredCheckbox.errorMessage
							});
						}
					}

					if (element.type === 'email' || element.classList.contains('js-email-input')) rules.push({
						validator: justValidateCustomTypes.email.validator,
						errorMessage: justValidateCustomTypes.email.errorMessage
					});

					if (element.type === 'tel') rules.push({
						validator: justValidateCustomTypes.tel.validator,
						errorMessage: justValidateCustomTypes.tel.errorMessage
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

					if (typeof element.dataset.maskType !== 'undefined' && element.dataset.maskType !== '') {
						const typeName = element.dataset.maskType,
							typeData = justValidateCustomTypes[typeName];

						if (typeData) {
							rules.push({
								validator: typeData.validator,
								errorMessage: typeData.errorMessage
							});
						}
					}

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
			return validation;
		},

		revalidate: function() {
			validation.revalidate();
		},

		toggleLoadingState: function(forced) {
			toggleLoadingState(forced);
		},

		forceHighlightFields: function(obj) {
			if (typeof obj !== 'object') {
				throw new Error('Expected object of <field id>: <error message> pairs');
			}

			const ids = Object.keys(obj);
			ids.forEach(function (id) {
				const fieldIndexes = Object.keys(validation.fields);
				const errorMessage = obj[id];

				for (var i = 0; i < fieldIndexes.length; i++) {
					const fieldIndex = fieldIndexes[i],
						field = validation.fields[fieldIndex],
						input = field.elem;

					if (input.id === id) {
						if (!field.isValid) {
							validation.clearFieldLabel(fieldIndex);
						}

						validation.setFieldInvalid(fieldIndex, {errorMessage});
						validation.renderFieldError(fieldIndex);
						break;
					}
				}
			});
		},

		onSuccess: function (callback) {
			customOnSuccessCallback = callback;
		},

		onFail: function (callback) {
			customOnFailCallback = callback;
		},

		onSubmit: function (callback) {
			customOnSubmitCallback = callback;
		},

		destroy: function () {
			destroy(true);
		}
	}
};

const SubscribeForm = function() {
	let latestFormSource = null,
		form = null,
		validation,
		validationRules = [],
		customOnFailCallback = null,
		customOnSuccessCallback = null,
		customOnSubmitCallback = null,
		lastLoadState = false;

	const init = function() {
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
		if (typeof window.formValidationArray === 'undefined') {
			window.formValidationArray = [];
		}

		form.dataset.passedValidation = "false";
		validation = new JustValidate(form, {
			errorFieldCssClass: 'subscribe-form__input_state_invalid',
			errorLabelCssClass: 'subscribe-form__message subscribe-form__message_style_error'
		});
		window.formValidationArray.push(validation);

		validation.onFail(onFail);
		validation.onSuccess(onSuccess);
		form.addEventListener('submit', onSubmit);
	}

	const onSuccess = function(evt) {
		form.dataset.passedValidation = "true";
		if (customOnSuccessCallback) {
			customOnSuccessCallback(evt, form, validation);
		} else {
			console.log('Form sent successfully, POSTing. You can overwrite this function by calling .onSuccess() method with your custom callback');
			// toggleLoadingState(false);
			form.submit();
		}
	}

	const onFail = function(evt) {
		form.dataset.passedValidation = "false";
		if (customOnFailCallback) {
			customOnFailCallback(evt, form, validation);
		} else {
			console.log('Form not sent. You can overwrite this function by calling .onFail() method with your custom callback');
			// toggleLoadingState(false);
		}
	}

	const onSubmit = function(evt) {
		if (customOnSubmitCallback) {
			customOnSubmitCallback(evt, form, validation);
		} else {
			// toggleLoadingState(true);
		}
	}

	const toggleLoadingState = function(forced) {
		if (typeof forced === 'boolean') {
			lastLoadState = forced;
		} else {
			lastLoadState = !lastLoadState;
			forced = lastLoadState;
		}

		const submit = form.querySelectorAll('[type="submit"], [data-type="submit"]');
		form.classList.toggle('form_state_loading', forced);

		submit.forEach(function (el) {
			el.disabled = forced;
			if (el.classList.contains('button')) {
				el.classList.toggle('button_state_loading', forced);
			}
		});
	}

	const destroy = function(hardReset) {
		validation.destroy();
		form.noValidate = false;
		form.dataset.passedValidation = '';
		validation = null;
		validationRules = [];

		if (hardReset) {
			form = null;
			customOnFailCallback = null;
			customOnSuccessCallback = null;
			customOnSubmitCallback = null;
		}
	}

	const getValidationRules = function () {
		if (form) {
			const elements = form.querySelectorAll('input, textarea, select');

			if (elements.length) {
				for (let i = 0; i < elements.length; i++) {
					const element = elements[i],
						rules = [];

					if (element.required) {
						if (element.type !== 'checkbox') {
							rules.push({
								rule: 'required',
								errorMessage: justValidateErrorMessages['required']
							});
						} else {
							rules.push({
								validator: justValidateCustomTypes.requiredCheckbox.validator.bind(element),
								errorMessage: justValidateCustomTypes.requiredCheckbox.errorMessage
							});
						}
					}

					if (element.type === 'email' || element.classList.contains('js-email-input')) rules.push({
						validator: justValidateCustomTypes.email.validator,
						errorMessage: justValidateCustomTypes.email.errorMessage
					});

					if (element.type === 'tel') rules.push({
						validator: justValidateCustomTypes.tel.validator,
						errorMessage: justValidateCustomTypes.tel.errorMessage
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

					if (typeof element.dataset.maskType !== 'undefined' && element.dataset.maskType !== '') {
						const typeName = element.dataset.maskType,
							typeData = justValidateCustomTypes[typeName];

						if (typeData) {
							rules.push({
								validator: typeData.validator,
								errorMessage: typeData.errorMessage
							});
						}
					}

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
			return validation;
		},

		revalidate: function() {
			validation.revalidate();
		},

		toggleLoadingState: function(forced) {
			toggleLoadingState(forced);
		},

		forceHighlightFields: function(obj) {
			if (typeof obj !== 'object') {
				throw new Error('Expected object of <field id>: <error message> pairs');
			}

			const ids = Object.keys(obj);
			ids.forEach(function (id) {
				const fieldIndexes = Object.keys(validation.fields);
				const errorMessage = obj[id];

				for (var i = 0; i < fieldIndexes.length; i++) {
					const fieldIndex = fieldIndexes[i],
						field = validation.fields[fieldIndex],
						input = field.elem;

					if (input.id === id) {
						if (!field.isValid) {
							validation.clearFieldLabel(fieldIndex);
						}

						validation.setFieldInvalid(fieldIndex, {errorMessage});
						validation.renderFieldError(fieldIndex);
						break;
					}
				}
			});
		},

		onSuccess: function (callback) {
			customOnSuccessCallback = callback;
		},

		onFail: function (callback) {
			customOnFailCallback = callback;
		},

		onSubmit: function (callback) {
			customOnSubmitCallback = callback;
		},

		destroy: function () {
			destroy(true);
		}
	}
};

callOnWindowLoad(function () {
	window.formValidationArray = [];
	window.resetForm = function (form) {
		if (!form) return;

		for (var i = 0; i < form.length; i++) {
			var input = form[i];

			if (input.tagName !== 'TEXTAREA' && input.tagName !== 'INPUT') {
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

			input.value = '';
		}

		window.formValidationArray.forEach(function(validation) {
			try {
				validation.refresh();
			} catch {
				console.log('validation no longer exists');
			}
		});
	};

	window.addJustValidateCustomType = function (type, pattern, message) {
		if (typeof type !== 'string') {
			throw new Error('Expected string as first argument');
		} else if (justValidateCustomTypes[type]) {
			throw new Error('Provided validation type already exists');
		}

		try {
			pattern.test('');
		} catch (err) {
			throw new Error('Expected regular expression in // formmat as second argument');
		}

		justValidateCustomTypes[type] = {
			mask: pattern,
			errorMessage: message || 'Incorrect format',
			validator: function (value) {
				return justValidateUniversalCustomTypeValidator(type, value)
			}
		};
	};

	window.updateJustValidateCustomType = function (type, settings) {
		if (typeof type !== 'string') {
			throw new Error('Expected string as first argument');
		} else if (!justValidateCustomTypes[type]) {
			throw new Error('Provided validation type doesn\'t exists');
		} else if (typeof settings !== 'object') {
			throw new Error('Expected object as second argument');
		}

		if (settings.mask) {
			justValidateCustomTypes[type].mask = settings.mask;
		}
		if (settings.errorMessage) {
			justValidateCustomTypes[type].errorMessage = settings.errorMessage;
		}
	}

	document.body.addEventListener('click', function(e) {
		var resetTrigger = e.target.closest('.js-form-reset');
		if (resetTrigger) {
			var form = resetTrigger.closest('form');
			window.resetForm(form);
		}
	});
}, 0);