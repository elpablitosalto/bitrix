(function modal() {
	callOnWindowLoad(function () {
		window.fancyboxSettings = {
			dragToClose: false,
			autoFocus: false,
			touch: false,
			trapFocus: false,
			on: {
				init: function () {
					Fancybox.close();
				},
				done: function () {
					if (typeof initCaptcha !== 'undefined') {
						initCaptcha();
					}
				},
				reveal: function () {
					var container = this.$container,
						modal = container.querySelector('.modal'),
						form = container.querySelector('form');

					if (modal) {
						modal.classList.remove('modal_form-state_sent');
					}

					if (form) {
						form.classList.remove('form_state_sent');
					}
				}
			}
		};

		window.openModal = function (id) {
			if (!id) {
				console.log('No id provided for modal to open');
				return;
			}

			Fancybox.show([
				{
					src: '#' + id
				}
			],
			window.fancyboxSettings
			);
		};

		Fancybox.bind('.js-modal', window.fancyboxSettings);

		document.body.addEventListener('click', function (e) {
			var trigger = e.target.matches('.js-fancybox-close')
				? e.target
				: e.target.closest('.js-fancybox-close');

			if (trigger) {
				Fancybox.close();
			}
		});
	}, 0);
})();
