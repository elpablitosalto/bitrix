(function photoCarousel() {
	callOnWindowLoad(function () {
		const carouselSelector = '.js-photo-carousel';

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
			speed: 800,
			// autoplay: {
			// 	delay: 3000
			// },
			observer: true,
			loop: true,
			slidesPerView: 1.5,
			spaceBetween: 10,
			slidesPerGroup: 1,
			centeredSlides: true,
			touchReleaseOnEdges: true,
			navigation: {
				nextEl: '.photo-carousel__arrows .js-carousel-nav-next',
				prevEl: '.photo-carousel__arrows .js-carousel-nav-prev',
			},
			pagination: {
				el: '.bullet-pagination_role_photo',
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
			breakpoints: {
				744: {
					slidesPerView: 2.25,
					spaceBetween: 30,
				},
				1024: {
					slidesPerView: 3,
					spaceBetween: 30,
				},
				1280: {
					slidesPerView: 3.5,
					spaceBetween: 30,
				},
			}

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