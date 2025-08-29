(function form() {
	callOnWindowLoad(function () {
		function visualPassword(trigger, hide) {
			if (trigger) {
				const input = trigger.closest('.form-control').querySelector('input');

				if (input) {
					var text = trigger.innerText,
						altText = trigger.dataset.textAlt;

					trigger.classList.toggle('form-control__trigger_state_active');

					if (input.type === 'password' && (typeof hide === 'undefined' || hide === true)) {
						input.type = 'text';
					} else {
						input.type = 'password';
					}

					trigger.innerText = altText;
					trigger.dataset.textAlt = text;
				}
			}
		}

		function updateSubmit(check) {
			var form = check.closest('form');
			if (form) {
				var submits = form.querySelectorAll('[type="submit"], [data-type="submit"]');

				submits.forEach(function (submit) {
					submit.disabled = !check.checked;
				});
			}
		}

		document.body.addEventListener('click', function (e) {
			var trigger = e.target.matches('.js-show-password') ? e.target : null;
			if (trigger) {
				visualPassword(trigger);
			}
		});

		document.body.addEventListener('mouseup', function (e) {
			if (
				!e.target.matches('.js-show-password')
				&& e.target.closest('.js-show-password') === null
			) {
				const activeTriggers = document.querySelectorAll('.js-show-password.form__trigger_state_active');
				if (activeTriggers.length) {
					activeTriggers.forEach(function (item) {
						visualPassword(item, true);
					});
				}
			}
		});

		function updateTextareaHeight(textarea) {
			textarea.style.height = '';

			textarea.style.height =
				textarea.scrollHeight
				+ textarea.offsetHeight
				- textarea.clientHeight
				+ 'px';
		}


		window.updateFormFields = function () {
			var phoneInputs = document.getElementsByClassName('js-phone-input'),
				emailInputs = document.getElementsByClassName('js-email-input'),
				disablingCheckbox = document.getElementsByClassName('js-disabling-checkbox'),
				expandingTextareaSelector = '.js-expanding-textarea';

			if (phoneInputs.length) {
				[].slice.call(phoneInputs).forEach(function (el) {
					Inputmask('+7(999) 999-99-99').mask(el);
				});
			}

			if (emailInputs.length) {
				[].slice.call(emailInputs).forEach(function (el) {
					Inputmask('email').mask(el);
				});
			}

			if (disablingCheckbox.length) {
				[].slice.call(disablingCheckbox).forEach(function (el) {
					updateSubmit(el);

					el.addEventListener('change', function () {
						updateSubmit(el);
					});
				});
			}

			document.querySelectorAll(expandingTextareaSelector).forEach(function (textarea) {
				updateTextareaHeight(textarea);
			});
			document.body.addEventListener('input', function (e) {
				if (e.target.matches(expandingTextareaSelector)) {
					updateTextareaHeight(e.target);
				}
			});
		};

		window.updateFormFields();

	}, 0);
})();

(function setInputValue() {
	callOnWindowLoad(function () {
		function update(trigger) {
			const value = trigger.dataset.inputValue,
				inputSelector = trigger.dataset.inputSelector,
				inputs = inputSelector ? document.querySelectorAll(inputSelector) : [];

			inputs.forEach(function (input) {
				input.value = value;
			});
		}

		const triggerSelector = '.js-set-input-value';
		document.body.addEventListener('click', function (e) {
			const trigger = e.target.closest(triggerSelector);

			if (trigger) {
				update(trigger);
			}
		});
	}, 0);
})();
