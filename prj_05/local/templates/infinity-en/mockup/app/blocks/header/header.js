(function header () {
	callOnWindowLoad(function () {
		const headerSelector = '.header',
			headerWrapperSelector = '.page__header',
			offsetElementSelector = '.js-header-offset',
			headerFixedClass = 'header_position_fixed',
			headerWrapperFixedClass = 'page__header_position_fixed',
			bodyFixedHeaderClass = 'page__body_header_fixed';

		const header = document.querySelector(headerSelector),
			headerWrapper = document.querySelector(headerWrapperSelector),
			offsetElements = document.querySelectorAll(offsetElementSelector),
			fixBreakpoint = 0; // vertical page scroll for header to get fixed

		let isFixed = false;

		function updateOffsetElements(elements) {
			if (elements.length) {
				const headerHeight = header.offsetHeight + header.offsetTop;

				elements.forEach(function (element) {
					const propertyName = element.dataset.headerOffsetProperty || 'top';
					element.style[propertyName] = headerHeight + 'px';
				});
			}
		}

		function resetOffsetElements(elements) {
			if (elements.length) {
				elements.forEach(function (element) {
					const propertyName = element.dataset.headerOffsetProperty || 'top';
					element.style[propertyName] = '';
				});
			}
		}

		function update() {
			if (isFixed) {
				header.classList.remove(headerFixedClass);
				headerWrapper.classList.remove(headerWrapperFixedClass);
			}

			headerWrapper.style.minHeight = header.clientHeight + 'px';

			if (isFixed) {
				header.classList.add(headerFixedClass);
				headerWrapper.classList.add(headerWrapperFixedClass);
			}
		}

		function fix() {
			if (
				(window.scrollY > fixBreakpoint && !isFixed)
				|| (window.scrollY <= fixBreakpoint && isFixed)
			) {
				header.classList.toggle(headerFixedClass);
				headerWrapper.classList.toggle(headerWrapperFixedClass);
				document.body.classList.toggle(bodyFixedHeaderClass);
				isFixed = !isFixed;
			}

		}

		if (header && headerWrapper) {
			update();
			fix();
			updateOffsetElements(offsetElements);

			window.addEventListener('resize', function () {
				update();
				fix();
				updateOffsetElements(offsetElements);
			});

			window.addEventListener('scroll', function () {
				fix();
				updateOffsetElements(offsetElements);
			});
		}
	}, 0)
})();
