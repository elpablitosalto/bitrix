(function bannerCarousel() {
	callOnWindowLoad(function () {
		const carouselSelector = '.js-banner-carousel';

		if (!document.querySelector(carouselSelector)) {
			return;
		}

		function initCarousel(selector, options) {
			var carouselSet = document.querySelectorAll(selector),
				// eslint-disable-next-line no-unused-vars
				myCarousel;

			if (carouselSet.length) {
				myCarousel = new Swiper(selector, options);

				carouselSet.forEach(function (carousel) {
					if (carousel.ftSwiperNav) {
						carousel.ftSwiperNav.init();
					}
				});
			};
		}

		function renderOneBullet(swiper, index, className) {
			var slide = swiper.slides[index],
				labelText = slide.dataset['paginationLabel'] || 'Слайд №' + (index + 1);

			return '<button class="' + className + '" type="button">' +
				labelText +
				'</button>';
		}

		var options = {
			effect: 'fade',
			speed: 1500,
			autoplay: {
				delay: 2500
			},
			slidesPerView: 1,
			slidesPerGroup: 1,
			allowTouch: true,
			touchReleaseOnEdges: true,
			pagination: {
				el: '.bullet-pagination_role_banner',
				type: 'bullets',
				clickable: true,
				bulletEl: 'button',
				modifierClass: 'bullet-pagination_',
				bulletClass: 'bullet-pagination__button',
				bulletActiveClass: 'bullet-pagination__button_state_active',
				renderBullet: function (index, className) {
					return renderOneBullet(this, index, className);
				}
			},
		};


		if (typeof Swiper !== 'undefined') {
			initCarousel(carouselSelector, options);
		} else if (window.resourceLoader) {
			document.body.addEventListener('swiper-bundle-js-load', function () {
				initCarousel(carouselSelector, options);
			});

			window.resourceLoader.load('swiper');
		}
	});

})();
