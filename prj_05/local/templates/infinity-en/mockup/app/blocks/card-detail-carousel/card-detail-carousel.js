(function cardDetailCarousel() {
	function initIfSlideable(swiper, carousel, slideSelector, containerSelector, inactiveClass) {
		if (!carousel || !swiper) {
			return;
		}

		var slides = carousel.querySelectorAll(slideSelector);

		if (slides.length > 1) {
			swiper.init();
		} else if (containerSelector && inactiveClass) {
			carousel.closest(containerSelector).classList.add(inactiveClass);
		}

		return slides.length > 1;
	}

	function renderOneBullet(swiper, index, className) {
		var slide = swiper.slides[index],
			labelText = slide.dataset['paginationLabel'] || 'Слайд №' + (index + 1);

		return '<button class="' + className + '" type="button">'
			+ labelText
			+ '</button>';
	}

	function applySlideOpacity(swiper) {
		const slides = swiper.slides,
			progress = swiper.progress,
			progressPerSlide = 1 / (slides.length - 1),
			index = Math.floor(progress / progressPerSlide),
			localProgress = (progress - index * progressPerSlide) / progressPerSlide,
			opacityProgress = localProgress / .2,
			currentSlideOpacity = 1 - opacityProgress;

		slides.forEach(function (slide, i) {
			slide.style.opacity = i === index ? currentSlideOpacity : Number(i > index);
			slide.style.transitionDuration = '';
		});
	}

	function applySlideOpacityTransition(swiper) {
		const activeSlide = swiper.slides[swiper.activeIndex];

		activeSlide.style.transitionDuration = '600ms';

		activeSlide.addEventListener('transitionend', function () {
			activeSlide.style.transitionDuration = '';
		}, {once: true});
	}

	callOnWindowLoad(function () {
		var carouselSelector = '.js-card-detail-carousel',
			carouselSet = document.querySelectorAll(carouselSelector),
			myCarousel;

		if (carouselSet.length) {
			myCarousel = new Swiper(carouselSelector, {
				init: false,
				loop: true,
				speed: 600,
				slidesPerView: 1,
				slidesPerGroup: 1,
				autoHeight: true,
				allowTouch: true,
				shortSwipes: false,
				longSwipesMs: 50,
				spaceBetween: 0,
				touchReleaseOnEdges: true,
				pagination: {
					el: '.js-card-detail-carousel .bullet-pagination',
					type: 'bullets',
					clickable: true,
					bulletEl: 'button',
					modifierClass: 'bullet-pagination_',
					bulletClass: 'bullet-pagination__button',
					bulletActiveClass: 'bullet-pagination__button_state_active',
					renderBullet: function(index, className) {
						return renderOneBullet(this, index, className);
					}
				},
				on: {
					progress(swiper) {
						if (window.innerWidth >= 1025) {
							applySlideOpacity(swiper);
						}
					},
					beforeTransitionStart(swiper) {
						if (window.innerWidth >= 1025) {
							applySlideOpacityTransition(swiper);
						}
					},
				}
			});

			if (!myCarousel.length) {
				myCarousel = [myCarousel];
			}

			var slideSelector = '.swiper-slide';
			var containerSelector = '.card-detail-carousel';
			var inactiveClass = 'card-detail-carousel_state_inactive';
			carouselSet.forEach(function (carousel, i) {
				var slideable = initIfSlideable(myCarousel[i], carousel, slideSelector, containerSelector, inactiveClass);

				if (slideable && carousel.ftSwiperNav) {
					carousel.ftSwiperNav.init();
				}
			});
		}

	}, 0);
})();
