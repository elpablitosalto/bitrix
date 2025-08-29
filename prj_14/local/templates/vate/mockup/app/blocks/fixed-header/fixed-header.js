(function fixedHeader() {
	callOnWindowLoad(function () {
		var header = document.querySelector('.header'),
			fixedHeader = document.querySelector('.fixed-header'),
			headerHeight = header.clientHeight,
			headerWrapper = document.querySelector('.page__header'),

			isFixed = false;

		function update() {
			if (isFixed) {
				fixedHeader.classList.remove('fixed-header_state_active');
			}

			headerWrapper.style.minHeight = header.clientHeight + 'px';

			if (isFixed) {
				fixedHeader.classList.add('fixed-header_state_active');
			}
		}

		function fix() {
			if (
				(window.scrollY > headerHeight && !isFixed) ||
				(window.scrollY < headerHeight && isFixed)
			) {
				fixedHeader.classList.toggle('fixed-header_state_active');
				document.body.classList.toggle('page__body_header_fixed');
				isFixed = !isFixed;
			}

		}

		if (header && headerWrapper) {
			update();
			fix();

			window.addEventListener('resize', function () {
				update();
				fix();
			});

			window.addEventListener('scroll', function () {
				fix();
			});
		}
	}, 0)
})();
