(function entryCarousel() {
	callOnWindowLoad(function () {
		if (!window.swiperCarousel) return;
		// selector, breakpoint, destroyAboveBreakpoint, rules
		const set = window.swiperCarousel.add('.js-banner-carousel', {
			init: false,
			speed: 600,
			slidesPerView: 'auto',
			slidesPerGroup: 1,
			allowTouch: true,
			spaceBetween: 0,
			slidesPerView: 1,
			loop: true,
			touchReleaseOnEdges: true,
			navigation: {
				nextEl: '.js-banner-carousel-next',
				prevEl: '.js-banner-carousel-prev',
			},
			pagination: {
				el: '.js-banner-carousel .bullet-pagination',
				type: 'bullets',
				clickable: true,
				bulletEl: 'button',
				modifierClass: 'bullet-pagination_',
				bulletClass: 'bullet-pagination__button',
				bulletActiveClass: 'bullet-pagination__button_state_active',
				renderBullet: function renderBullet(index, className) {
					return window.swiperCarousel.renderOneBullet(this, index, className);
				},
			},
		},
		{
			checkIfSlideable: true,
			scopeSelector: '.banner-carousel',
			scopeInactiveClass: 'banner-carousel_state_inactive'
		});
	});
})();
