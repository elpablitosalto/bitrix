(function filter() {
	callOnWindowLoad(function () {
		function toggle(trigger) {
			var scope = trigger.closest(scopeSelector);

			if (!scope) {
				return;
			}

			if (!scope.classList.contains(openClass)) {
				let scope = trigger.closest(scopeSelector),
					parentScope = scope.parentElement.closest(scopeSelector);

				if (!parentScope) {
					closeAll();
					allowClosure = false;
				}
			}

			scope.classList.toggle(openClass);
			allowClosure = true;
		}

		function closeAll() {
			allowClosure = false;

			if (window.innerWidth < 768) return;

			var openScopes = document.querySelectorAll('.' + openClass);

			if (openScopes.length) {
				openScopes.forEach(function (el) {
					el.classList.remove(openClass);
				});
			}
		}

		const triggerSelector = '.js-filter-trigger',
			scopeSelector = '.check-filter',
			openClass = 'check-filter_state_open';

		let allowClosure = false;

		document.body.addEventListener('click', function (e) {
			let trigger = e.target.closest(triggerSelector),
				scope = e.target.closest(scopeSelector);

			if (trigger) {
				toggle(trigger);
			} else if (!scope && allowClosure) {
				closeAll();
			}
		});
	}, 0);
})();