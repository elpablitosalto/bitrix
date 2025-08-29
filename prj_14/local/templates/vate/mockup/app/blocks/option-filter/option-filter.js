(function optionFilter() {
	window.addEventListener('load', function () {
		var containerSelector = '.js-option-filter',
			triggerSelector = '.js-option-filter-trigger',
			openModifier = 'option-filter_state_open';

		function closeIfClickedOutside(e) {
			var target = e.target;
			if (!target.closest('.' + openModifier)) {
				var openFilters = document.querySelectorAll('.' + openModifier);
				if (openFilters.length) {
					openFilters.forEach(function (item) {
						item.classList.remove(openModifier);
					});
				}
				document.body.removeEventListener('click', closeIfClickedOutside);
			}
		}

		function operateFilter(e) {
			var trigger = e.target.closest(triggerSelector);

			if (trigger) {
				toggleFilter(trigger);
			}
		}

		function toggleFilter(trigger) {
			var filter = trigger.closest(containerSelector);

			filter.classList.toggle(openModifier);

			if (filter.classList.contains(openModifier)) {
				document.body.addEventListener('click', closeIfClickedOutside);
			} else {
				document.body.removeEventListener('click', closeIfClickedOutside);
			}
		}

		window.updateOptionFilters = function () {
			document.body.removeEventListener('click', operateFilter);
			document.body.addEventListener('click', operateFilter);
		};

		window.updateOptionFilters();


	}, false);
})();
