(function logoCarousel() {
	window.addEventListener('load', function () {
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
			}
		}

		var options = {
			speed: 2000,
			autoplay: {
				delay: 1500
			},
			slidesPerView: 1,
			slidesPerGroup: 1,
			centeredSlidesBounds: true,
			spaceBetween: 20,
			touchReleaseOnEdges: true,
			navigation: {
				nextEl: '.logo-carousel__arrows .js-carousel-nav-next',
				prevEl: '.logo-carousel__arrows .js-carousel-nav-prev',
			},
			breakpoints: {
				744: {
					slidesPerView: 2,
					spaceBetween: 0
				},
				1024: {
					slidesPerView: 3,
					spaceBetween: 80
				},
				1281: {
					slidesPerView: 5,
					spaceBetween: 20
				}
			}
		}
		initCarousel('.js-logo-carousel', options);
	});
})();
