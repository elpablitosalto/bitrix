(function () {
	'use strict';

	(function nav() {
		callOnWindowLoad(function () {
			const selector = '.js-overflowing-nav',
				navs = document.querySelectorAll(selector);

			navs.forEach(function (nav) {
				WAOverflowingNav(nav, {
					selectors: {
						root: '.nav',
						list: '.nav__list',
						item: '.nav__item',
						link: '.nav__link',
						burgerItem: '.nav__item_type_burger',
						burger: '.burger',
					},
					burgerText: 'Больше элементов',
					rebuildOnResize: true
				});
			});
		});
	})();
})();