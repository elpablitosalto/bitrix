(function searchForm() {
	window.addEventListener('load', function () {
		var searchSelector = '.js-search-with-results',
			searchFormSelector = '.search-panel',
			searchResultsSelector = '.search-results',
			searchClearSelector = '.js-search-clear',
			searchFormOpenClass = 'search-panel_results_shown',
			searchFormFilledClass = 'search-panel_state_filled',
			searchResultsFilledClass = 'search-results_state_filled',
			searchResultsNoResultsClass = 'search-results_state_no-results';

		var searches = document.querySelectorAll(searchSelector);

		function searchFocusHandler(e) {
			if (e.target.matches(searchSelector)) {
				var search = e.target,
					form = search.closest(searchFormSelector);

				form.classList.add(searchFormOpenClass);
			}
		}

		function searchBlurHandler(e) {
			if (e.target.matches(searchSelector)) {
				var search = e.target,
					form = search.closest(searchFormSelector);

				form.classList.remove(searchFormOpenClass);
			}
		}

		function updateForm(search) {
			var form = search.closest(searchFormSelector),
				results = form.querySelector(searchResultsSelector);

			form.classList.toggle(searchFormFilledClass, !!search.value);
			results.classList.toggle(searchResultsFilledClass, !!search.value);
			results.classList.toggle(searchResultsNoResultsClass, !!(search.value.length > 3));
		}

		function searchInputHandler(e) {
			if (e.target.matches(searchSelector)) {
				updateForm(e.target);
			}
		}

		function clearClickHandler(e) {
			var form = e.target.closest(searchFormSelector),
				search = form.querySelector(searchSelector);

			search.value = '';
			updateForm(search);
		}

		if (searches.length) {
			searches.forEach(function (search) {
				var form = search.closest(searchFormSelector);
				clear = form.querySelector(searchClearSelector);
				search.addEventListener('focus', searchFocusHandler);
				search.addEventListener('blur', searchBlurHandler);
				search.addEventListener('input', searchInputHandler);
				if (clear) {
					clear.addEventListener('click', clearClickHandler);
				}
			});
		}
	});
})();