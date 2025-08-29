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
		let toggleLoaded = false;

		callOnWindowLoad(function () {
			if (toggleLoaded) {
				return;
			}

			toggleLoaded = true;

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

			function applyFocus(parent, selector) {
				console.log(parent, selector)
				if (!selector) return;

				var target = parent.matches(selector) ? parent : parent.querySelector(selector);
				console.log(target);
				if (target) {
					target.focus();
				}
			}

			function operateClick(e) {
				var trigger = e.target.closest(triggerSelector);

				if (!trigger) {
					return;
				}

				var toggleScope = trigger.dataset['toggleScope'],
					toggleTarget = trigger.dataset['toggleTarget'],
					toggleClass = trigger.dataset['toggleClass'],
					toggleFocus = trigger.dataset['toggleFocus'],
					togglePreventDefault = trigger.dataset['togglePreventDefault'] || 'false',
					scopeList = false,
					targetList = false,
					classList = false,
					focusList = false,
					preventDefault = Boolean(JSON.parse(togglePreventDefault));

				if (preventDefault) {
					e.preventDefault();
				}


				// Scoped and targeted
				if (toggleScope && toggleTarget && toggleClass) {
					scopeList = parseAtribute(toggleScope);
					targetList = parseAtribute(toggleTarget);
					classList = parseAtribute(toggleClass);
					focusList = parseAtribute(toggleFocus);

					if (scopeList.length && targetList.length && classList.length) {
						targetList.forEach(function (item, i) {
							if (typeof classList[i] !== 'undefined') {
								var scope = trigger.closest(scopeList[i]),
									targets = scope.querySelectorAll(targetList[i]);

								targets.forEach(function (target, targetIndex) {
									target.classList.toggle(classList[i]);

									if (toggleFocus) {
										applyFocus(target, focusList[i]);
									}
								});
							}
						});
					}
					// Targeted at parent
				} else if (toggleScope && toggleClass) {
					scopeList = parseAtribute(toggleScope);
					classList = parseAtribute(toggleClass);
					focusList = parseAtribute(toggleFocus);

					if (scopeList.length && classList.length) {
						scopeList.forEach(function (item, i) {
							if (typeof classList[i] !== 'undefined') {
								var target = trigger.closest(scopeList[i]);
								target.classList.toggle(classList[i]);

								if (toggleFocus) {
									applyFocus(target, focusList[i]);
								}
							}
						});
					}
					// Not scoped
				} else if (toggleTarget && toggleClass) {
					targetList = parseAtribute(toggleTarget);
					classList = parseAtribute(toggleClass);
					focusList = parseAtribute(toggleFocus);

					if (targetList.length && classList.length) {
						targetList.forEach(function (item, i) {
							if (typeof classList[i] !== 'undefined') {
								var targets = document.querySelectorAll(targetList[i]);
								targets.forEach(function (target, targetIndex) {
									target.classList.toggle(classList[i]);

									if (toggleFocus) {
										applyFocus(target, focusList[i]);
									}
								});
							}
						});
					}
				}
			}

			var triggerSelector = '.js-toggle';

			document.body.removeEventListener('click', operateClick);
			document.body.addEventListener('click', operateClick);
		}, 0);
	})();

	(function goTo() {
		callOnWindowLoad(function (){
			const triggerSelector = '.js-go-to',
				fixedHeaderSelector = '.fixed-header';

			document.body.addEventListener('click', function (event) {
				const trigger = event.target.closest(triggerSelector);

				if (!trigger) {
					return;
				}

				const href = trigger.href ? trigger.attributes.href.value : '',
					isAnchor = href.match(/^#/),
					id = isAnchor ? href.replace(/^#/, '') : null,
					header = document.querySelector(fixedHeaderSelector);

				if (id) {
					event.preventDefault();

					let target = document.getElementById(id),
						top = target ? target.getBoundingClientRect().y + window.scrollY : 0,
						offset = header ? header.offsetHeight : 0,
						targetScroll = top - offset;

					window.scrollTo({
						top: targetScroll,
						left: 0,
						behavior: 'smooth'
					});
				}
			});
		}, 0);
	})();

	//Функция по кнопке скролла наверх
	(function scrollTop() {
		callOnWindowLoad(function () {
			function show(el, className) {
				if (el) {
					el.classList.remove(className);
				}
			};

			function hide(el, className) {
				if (el) {
					el.classList.add(className);
				}
			};

			function update() {
				if (window.scrollY > window.innerHeight * 0.5) {
					show(container, containerHiddenClass);
				} else {
					hide(container, containerHiddenClass);
				}

				if (footer) {
					var footerBR = footer.getBoundingClientRect(),
						transform = Math.min(0, footerBR.y - window.innerHeight);

					container.style.transform = 'translateY(' + transform + 'px)';
				} else {
					container.style.tranform = '';
				}
			}

			const containerSelector = '.js-scroller-container',
				footerSelector = '.footer',
				containerHiddenClass = 'page__scroll-top_state_hidden';

			const container = document.querySelector(containerSelector),
				footer = document.querySelector(footerSelector);

			if (!container) {
				return;
			}

			update();
			window.addEventListener('scroll', () => {
				update();
			});
		}, 0);
	})();

	(function charLimit() {
		callOnWindowLoad(function () {
			const containerSelector = '[data-char-limit]',
				items = document.querySelectorAll(containerSelector);

			items.forEach(function (el) {
				const ogText = el.innerText;
				let length = Math.max(3, Number(el.dataset.charLimit));

				if (Number.isNaN(length)) {
					length = 100;
				}

				let newText = ogText.substring(0, length);

				if (newText === ogText) {
					return;
				}

				newText += '...';

				el.innerText = newText;
				el.title = ogText;
			});
		}, 0);
	})();

	(function autoBlankLinks() {
		const linkSelector = 'a:not([data-no-blank]):not(.js-modal)',
			 forcedLinkSelector= '.js-forced-blank-links a';

		callOnWindowLoad(function () {
			const links = document.body.querySelectorAll(linkSelector),
				forcedLinks = document.body.querySelectorAll(forcedLinkSelector);

			links.forEach(function(link) {
				const href = link.href;

				if (!href) {
					return;
				}

				if (href.match(new RegExp('https?\://(www.)?' + location.host))) {
					return;
				}

				if (!href.match('http')) {
					return;
				}

				link.target = '_blank';
			});

			forcedLinks.forEach(function(link) {
				const href = link.href;

				if (!href) {
					return;
				}

				const hrefValue = link.attributes.href.value;

				if (hrefValue[0] === '#') {
					return;
				}

				if (!link.target) {
					link.target = '_blank';
				}
			});
		});
	})();
})();