(function searchPanel() {
	window.addEventListener('load', function () {
		console.log('search-results script');
		function clear(trigger) {
			const scope = trigger.closest(scopeSelector),
				input = scope ? scope.querySelector(inputSelector) : null;

			if (!input) return;

			input.value = '';
		}

		const clearSelector = '.js-search-clear',
			scopeSelector = '.search-panel',
			inputSelector = '.search-panel__input',
			header = '.page__header';


		document.body.addEventListener('click', function (e) {
			const trigger = e.target.closest(clearSelector);
			if (trigger) {
				document.querySelector(header).classList.remove('header_search_open')
				clear(trigger);
			}
		});
	});
})();