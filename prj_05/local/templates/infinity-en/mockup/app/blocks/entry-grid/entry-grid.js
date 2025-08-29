(function entryGrid() {
	window.addEventListener('load', function () {
		var scopeSelector = '.js-entry-grid',
			triggerLineSelector = '.js-entry-grid-trigger-line';

		function dispatchCustomEvent(eventName, target, data) {
			var evt = document.createEvent('HTMLEvents');

			if (target) {
				evt.initEvent(eventName, true, true);
				evt.data = data;
				target.dispatchEvent(evt);
			}
		}

		function checkTriggersInView() {
			var windowHeight = window.innerHeight,
				lines = document.querySelectorAll(triggerLineSelector);

			lines.forEach(function (line) {

				var offset = typeof line.dataset.offset === 'number' ? line.dataset.offset : 0,
					topComparison = offset,
					bottomComparison = windowHeight - offset,
					rect = line.getBoundingClientRect(),
					rectTop = rect.y;

				if (rectTop > topComparison && rectTop < bottomComparison) {
					if (line.dataset.reached === "Y") {
						return;
					}

					line.dataset.reached = "Y";
					var scope = line.closest(scopeSelector);

					dispatchCustomEvent(
						'entryGrid:loadTriggerOnScreen',
						scope, {
							grid: scope,
							trigger: line
						}
					);
				}
			});
		}

		function windowScrollHandler(e) {
			checkTriggersInView();
		}

		checkTriggersInView();
		window.addEventListener('scroll', windowScrollHandler);
	}, false);
})();
