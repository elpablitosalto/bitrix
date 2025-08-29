(function navCarousel() {
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
			speed: 500,
			slidesPerView: 3.5,
			slidesPerGroup: 1,
			centeredSlidesBounds: true,
			spaceBetween: 10,
			touchReleaseOnEdges: true,
			navigation: {
				nextEl: '.nav-carousel__arrows .js-carousel-nav-next',
				prevEl: '.nav-carousel__arrows .js-carousel-nav-prev',
			},
			breakpoints: {
				744: {
					slidesPerView: 5,
					spaceBetween: 15
				},
				1440: {
					slidesPerView: 5,
					spaceBetween: 25
				}
			}
		}
		initCarousel('.js-nav-carousel', options);
	});
})();
