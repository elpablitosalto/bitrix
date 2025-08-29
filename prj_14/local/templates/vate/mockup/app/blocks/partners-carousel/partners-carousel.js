(function partnersCarousel() {
	callOnWindowLoad(function () {
		const carouselSelector = '.js-partners-carousel';

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
			spaceBetween: 15,
			speed: 2000,
			autoplay: {
				delay: 1500
			},
			slidesPerView: 2,
			slidesPerGroup: 1,
			allowTouch: true,
			touchReleaseOnEdges: true,
			navigation: {
				nextEl: '.partners-carousel__arrows .js-carousel-nav-next',
				prevEl: '.partners-carousel__arrows .js-carousel-nav-prev',
			},

			pagination: {
				el: '.bullet-pagination_role_partners',
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
					slidesPerView: 4,
					spaceBetween: 36
				},
				1281: {
					slidesPerView: 5,
					spaceBetween: 40
				}
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
