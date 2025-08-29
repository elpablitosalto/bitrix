(function modal() {
	console.log('modal is ready');
	function init() {
		window.fancyboxSettings = {
			dragToClose: false,
			autoFocus: false,
			touch: false,
			trapFocus: false,
			on: {
				init: function (fb) {
					Fancybox.close();

					const trigger = fb.options.target,
						callbackName = trigger ? trigger.dataset.modalCallback : null;

					if (callbackName && typeof window[callbackName] === 'function') {
						try {
							const modalEl = trigger.attributes.href.value ? document.querySelector(trigger.attributes.href.value) : null;
							const formEl = modalEl ? modalEl.querySelector('form') : null;

							window[callbackName](fb, modalEl, formEl);
						} catch (err) {
							console.warn("Couldn't call custom modal callback");
							console.warn(err);
						}
					}
				},
			}
		};

		window.openModal = function (id) {
			if (!id) {
				console.log('No id provided for modal to open');
				return;
			}

			Fancybox.show([{
					src: '#' + id
				}],
				window.fancyboxSettings
			);
		};

		Fancybox.bind('.js-modal', window.fancyboxSettings);

		document.body.addEventListener('click', function (e) {
			var closeTrigger = e.target.closest('.js-fancybox-close');

			if (closeTrigger) {
				Fancybox.close();
			}
		});
	}

	callOnWindowLoad(function () {
		if (!document.querySelector('.js-modal')) {
			return;
		}

		if (typeof Fancybox !== 'undefined') {
			init();
		} else if (window.resourceLoader) {
			document.body.addEventListener('fancybox-js-load', function () {
				init();
			});

			window.resourceLoader.load('fancybox');
		}
	});
})();
