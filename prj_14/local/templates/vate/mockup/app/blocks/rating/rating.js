(function rating() {
	window.addEventListener('load', function () {
		var triggerSelector = '.js-rating-trigger',
			inputSelector = '.js-rating-input',
			containerSelector = '.rating',
			marksModifier = 'rating_marks_',
			currentModifier = 'rating__item_type_current';

		document.body.addEventListener('click', function (e) {
			var trigger = e.target.closest(triggerSelector);

			if (trigger) {
				var scope = trigger.closest(containerSelector),
					children = scope ? scope.querySelectorAll(triggerSelector) : [],
					activeChild = scope ? scope.querySelector('.' + currentModifier) : null,
					input = scope ? scope.querySelector(inputSelector) : null;

				if (children.length) {
					scope.classList.remove(marksModifier + '0');
					children.forEach(function (child, index) {
						if (child === trigger) {
							scope.classList.add(marksModifier + (index + 1));

							if (input) {
								input.value = (index + 1);
							}
						} else {
							scope.classList.remove(marksModifier + (index + 1));
						}
					});
				}

				if (activeChild) {
					activeChild.classList.remove(currentModifier);
				}

				trigger.classList.add(currentModifier);
			}
		});
	}, false);
})();
