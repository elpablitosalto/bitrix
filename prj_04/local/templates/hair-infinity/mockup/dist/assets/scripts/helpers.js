function callOnWindowLoad(callback, delay) {
	delay = typeof delay === 'number' && !Number.isNaN(delay) ? delay : 0;

	if (document.readyState === 'complete') {
		setTimeout(function () {
			callback();
		}, delay);
	} else {
		window.addEventListener('load', function () {
			callback();
		});
	}
}

(function () {
	'use strict';
	console.log('helpers.js is ready');



	(function toggle() {
		function parseAtribute(str) {
			if (typeof str === 'undefined') {
				return null;
			}

			if (str) {
				var arrayItems = str.split(',');
				var clearArrayItems = arrayItems.map(function (classString) {
					return classString.trim();
				});

				return clearArrayItems;
			}
		}

		callOnWindowLoad(function () {
			var triggerSelector = '.js-toggle',
				triggers = document.querySelectorAll(triggerSelector);

			triggers.forEach(function (trigger, index) {
				trigger.addEventListener('click', function (e) {
					var toggleScope = this.dataset['toggleScope'],
						toggleTarget = this.dataset['toggleTarget'],
						toggleClass = this.dataset['toggleClass'],
						togglePreventDefault = this.dataset['togglePreventDefault'] || 'false',
						scopeList = false,
						targetList = false,
						classList = false,
						preventDefault = Boolean(JSON.parse(togglePreventDefault));
						trigger = this;

					if (preventDefault) {
						e.preventDefault();
					}

					// Scoped and targeted
					if (toggleScope && toggleTarget && toggleClass) {
						scopeList = parseAtribute(toggleScope);
						targetList = parseAtribute(toggleTarget);
						classList = parseAtribute(toggleClass);

						if (scopeList.length && targetList.length && classList.length) {
							targetList.forEach(function (item, i) {
								if (typeof classList[i] !== 'undefined') {
									var scope = trigger.closest(scopeList[i]),
										targets = scope.querySelectorAll(targetList[i]);

									targets.forEach(function (target, targetIndex) {
										target.classList.toggle(classList[i]);
									});
								}
							});
						}
					// Targeted at parent
					} else if (toggleScope && toggleClass) {
						scopeList = parseAtribute(toggleScope);
						classList = parseAtribute(toggleClass);

						if (scopeList.length && classList.length) {
							scopeList.forEach(function (item, i) {
								if (typeof classList[i] !== 'undefined') {
									trigger.closest(scopeList[i]).classList.toggle(classList[i]);
								}
							});
						}
					// Not scoped
					} else if (toggleTarget && toggleClass) {
						targetList = parseAtribute(toggleTarget);
						classList = parseAtribute(toggleClass);

						if (targetList.length && classList.length) {
							targetList.forEach(function (item, i) {
								if (typeof classList[i] !== 'undefined') {
									var targets = document.querySelectorAll(targetList[i]);
									targets.forEach(function (target, targetIndex) {
										target.classList.toggle(classList[i]);
									});
								}
							});
						}
					}
				});
			});
		});
	})();



	(function extend() {
		var targets = document.querySelectorAll('.js-extend-left, .js-extend-right');

		function update() {
			var sizer = document.querySelector('.page__sizer');
			targets.forEach(function (item) {
				var margin = -Math.floor(sizer.getBoundingClientRect().x) - Number(window.getComputedStyle(sizer).paddingLeft.replace('px', ''));

				if (item.className.match('js-extend-left')) {
					item.style.setProperty('margin-left', margin + 'px');
				}
				if (item.className.match('js-extend-right')) {
					item.style.setProperty('margin-right', margin + 'px');
				}
			});
		}

		update();
		window.addEventListener('resize', function () {
			update();
		});
	})();
})();
