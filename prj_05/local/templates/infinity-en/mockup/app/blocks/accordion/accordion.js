(function accordion() {
	callOnWindowLoad(function () {
		function toggleAccordion(trigger) {
			var item = trigger.closest(itemSelector);

			if (!item) {
				return;
			}

			if (!item.classList.contains(accordionOpenClass)) {
				var list = item.closest(listSelector),
					activeItems = list ? list.querySelectorAll('.' + accordionOpenClass) : [];

				if (activeItems.length) {
					activeItems.forEach(function(el) {
						el.classList.remove(accordionOpenClass);
					});
				}
			}

			item.classList.toggle(accordionOpenClass);
		}

		var listSelector = '.js-accordion-list',
			itemSelector = '.js-accordion',
			triggerSelector = '.js-accordion-trigger',
			accordionOpenClass = 'accordion_state_open';

		document.body.addEventListener('click', function (e) {
			var trigger = e.target.closest(triggerSelector);

			if (trigger) {
				toggleAccordion(trigger);
			}
		});
	}, 0);
})();
