(function linkFilter() {
	window.addEventListener('load', function () {
		var containerSelector = '.js-link-filter',
			triggerSelector = '.js-link-filter-trigger',
			openModifier = 'link-filter_state_open';

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

		document.body.addEventListener('click', function (e) {
			var trigger = e.target.closest(triggerSelector),
				filter;

			if (trigger) {
				filter = trigger.closest(containerSelector);

				filter.classList.toggle(openModifier);

				if (filter.classList.contains(openModifier)) {
					document.body.addEventListener('click', closeIfClickedOutside);
				} else {
					document.body.removeEventListener('click', closeIfClickedOutside);
				}
			}
		});
	});
})();
