(function form() {
	window.addEventListener('load', function () {

		function updateSubmit(check) {
			var form = check.closest('form');
			if (form) {
				var submits = form.querySelectorAll('[type="submit"], [data-type="submit"]');

				submits.forEach(function (submit) {
					submit.disabled = !check.checked;
				});
			}
		}

		function updateTextareaHeight(textarea) {
			textarea.style.height = '';

			textarea.style.height =
				textarea.scrollHeight +
				textarea.offsetHeight -
				textarea.clientHeight +
				'px';
		}


		window.updateFormFields = function () {
			var phoneInputs = document.getElementsByClassName('js-phone-input'),
				emailInputs = document.getElementsByClassName('js-email-input'),
				disablingCheckbox = document.getElementsByClassName('js-disabling-checkbox'),
				expandingTextareaSelector = '.js-expanding-textarea';

			if (phoneInputs.length) {
				[].slice.call(phoneInputs).forEach(function (el) {
					Inputmask('+7 (999) 999-99-99').mask(el);
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

	}, false);
})();
