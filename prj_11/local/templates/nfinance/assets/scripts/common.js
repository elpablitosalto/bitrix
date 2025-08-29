console.log('common.js is ready!');

(function advertisementCarousel() {
	callOnWindowLoad(function () {
		const carouselSelector = '.js-advertisement-carousel';

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

			return '<button class="' + className + '" type="button">'
				+ labelText
				+ '</button>';
		}

		var options = {
			loop: true,
			speed: 1000,
			slidesPerView: 1,
			slidesPerGroup: 1,
			spaceBetween: 100,
			touchReleaseOnEdges: false,
			autoplay: {
				delay: 15000
			},
			pagination: {
				el: '.bullet-pagination_role_advertisement',
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
		}

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

(function activityCarousel() {
	callOnWindowLoad(function () {
		const carouselSelector = '.js-activity-carousel';

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
					navOffGroup.push({
						el: carousel,
						swiper: carousel.swiper,
						containerSelector: '.activity-carousel',
						containerClass: 'activity-carousel_navigation_hidden',
						breakpoints: [
							{
								value: 0,
								limit: 1,
							},
							{
								value: 1281,
								limit: 2,
							},
						]
					});

					if (carousel.ftSwiperNav) {
						carousel.ftSwiperNav.init();
					}
				});
			}
		}

		function renderOneBullet(swiper, index, className) {
			var slide = swiper.slides[index],
				labelText = slide.dataset['paginationLabel'] || 'Слайд №' + (index + 1);

			return '<button class="' + className + '" type="button">'
				+ labelText
				+ '</button>';
		}

		function updateNavVisibility() {
			navOffGroup.forEach(function (item) {
				if (!item.el || !item.swiper || !item.breakpoints.length) {
					return;
				}

				let parent = null,
					container = null,
					matchedBreakpoint = false,
					limitApplied = false;

				if (item.parentSelector && item.parentClass) {
					parent = item.el.closest(item.parentSelector);
				}

				if (item.containerSelector && item.containerClass) {
					container = item.el.closest(item.containerSelector);
				}

				item.breakpoints.forEach(function (bp) {
					matchedBreakpoint = window.innerWidth >= bp.value;

					if (matchedBreakpoint) {
						limitApplied = bp.limit >= item.swiper.slidesEl.querySelectorAll('.swiper-slide:not(.swiper-slide-blank)').length;

						if (limitApplied) {
							if (parent) {
								parent.classList.add(item.parentClass);
							}

							if (container) {
								container.classList.add(item.containerClass);
							}
						}
					}
				});

				if (!limitApplied) {
					if (parent) {
						parent.classList.remove(item.parentClass);
					}

					if (container) {
						container.classList.remove(item.containerClass);
					}
				}
			});
		}

		var options = {
				loop: true,
				speed: 1000,
				slidesPerView: 1,
				slidesPerGroup: 1,
				spaceBetween: 24,
				touchReleaseOnEdges: true,
				pagination: {
					el: '.bullet-pagination_role_activity',
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
				// autoplay: {
				// 	delay: 5000
				// },
				breakpoints: {
					768: {
						slidesPerView: 1.2,
						slidesPerGroup: 1,
						spaceBetween: 40
					},
					1280: {
						slidesPerView: 2,
						slidesPerGroup: 2,
						spaceBetween: 40
					}
				}
			},
			navOffGroup = [];

		if (typeof Swiper !== 'undefined') {
			initCarousel(carouselSelector, options);

			updateNavVisibility();
			window.addEventListener('resize', function () {
				updateNavVisibility();
			});
		} else if (window.resourceLoader) {
			document.body.addEventListener('swiper-bundle-js-load', function () {
				initCarousel(carouselSelector, options);

				updateNavVisibility();
				window.addEventListener('resize', function () {
					updateNavVisibility();
				});
			});

			window.resourceLoader.load('swiper');
		}
	});
})();

(function accordion() {
	callOnWindowLoad(function () {
		function toggleAccordion(trigger) {
			var item = trigger.closest(itemSelector);

			if (!item) {
				return;
			}

			if (!item.classList.contains(accordionOpenClass)) {
				var list = item.closest(listSelector),
					activeItems = list ? list.querySelectorAll('.' + accordionOpenClass) : [];

				if (activeItems.length) {
					activeItems.forEach(function(el) {
						el.classList.remove(accordionOpenClass);
					});
				}
			}

			item.classList.toggle(accordionOpenClass);
		}

		var listSelector = '.js-accordion-list',
			itemSelector = '.js-accordion',
			triggerSelector = '.js-accordion-trigger',
			accordionOpenClass = 'accordion_state_open';

		document.body.addEventListener('click', function (e) {
			var trigger = e.target.closest(triggerSelector);

			if (trigger) {
				toggleAccordion(trigger);
			}
		});
	}, 0);
})();


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

			return '<button class="' + className + '" type="button">'
				+ labelText
				+ '</button>';
		}

		var options = {
				loop: true,
				speed: 1000,
				slidesPerView: 1,
				slidesPerGroup: 1,
				spaceBetween: 100,
				touchReleaseOnEdges: false,
				autoplay: {
					delay: 15000
				},
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

(function carouselNav() {
	window.addEventListener('load', function () {
		var navSelector = '.js-carousel-nav',
			navs = document.querySelectorAll(navSelector);


		var prevSelector = '.js-carousel-nav-prev',
			nextSelector = '.js-carousel-nav-next',
			paginationSelector = '.js-carousel-nav-pagination',
			currentSelector = '.js-carousel-nav-current',
			totalSelector = '.js-carousel-nav-total';

		window.addFTSwiperNav = function (nav) {
			var navScope = nav.dataset.navScope,
				navTarget = nav.dataset.navTarget,
				targetScope = null,
				target = null;

			if (navScope) {
				targetScope = nav.closest(navScope);
			};

			if (!targetScope) {
				targetScope = document;
			};

			if (navTarget) {
				target = targetScope.querySelector(navTarget);
			};

			if (!target) {
				target = targetScope;
			};

			if (target === document) {
				return;
			};

			var prevTrigger = nav.querySelector(prevSelector),
				nextTrigger = nav.querySelector(nextSelector),
				pagination = nav.querySelector(paginationSelector),
				current = nav.querySelector(currentSelector),
				total = nav.querySelector(totalSelector);

			target.ftSwiperNav = {
				initialized: false,
				target,
				swiper: null,
				nav,
				triggers: {
					prev: prevTrigger,
					next: nextTrigger
				},
				pagination: {
					container: pagination,
					current,
					total
				},
				selectors: {
					nav: navSelector,
					prev: prevSelector,
					next: nextSelector,
					pagination: paginationSelector,
					current: currentSelector,
					total: totalSelector
				},
				init() {
					if (!this.target.swiper || this.initialized) {
						return;
					};

					var ftNav = this;
					ftNav.swiper = ftNav.target.swiper;
					ftNav.slidePrev = ftNav.slidePrev.bind(ftNav);
					ftNav.slideNext = ftNav.slideNext.bind(ftNav);

					if (ftNav.triggers.prev) {
						ftNav.triggers.prev.addEventListener('click', ftNav.slidePrev);
					};

					if (ftNav.triggers.next) {
						ftNav.triggers.next.addEventListener('click', ftNav.slideNext);
					};


					if (ftNav.triggers.prev || ftNav.triggers.next) {
						// ftNav.updateArrows();
						ftNav.swiper.on('transitionStart', function () {
							// ftNav.updateArrows();
						});
					};

					if (ftNav.pagination.container) {
						ftNav.updatePagination();
						ftNav.swiper.on('transitionStart', function () {
							ftNav.updatePagination();
						});
					};

					ftNav.initialized = true;
				},
				destroy(hard = false) {
					var ftNav = this;

					if (ftNav.triggers.prev) {
						ftNav.triggers.prev.removeEventListener('click', ftNav.slidePrev);
					};

					if (ftNav.triggers.next) {
						ftNav.triggers.next.removeEventListener('click', ftNav.slideNext);
					};

					ftNav.initialized = false;

					if (hard) {
						delete this;
					};
				},
				slidePrev() {
					this.swiper.slidePrev();
				},
				slideNext() {
					this.swiper.slideNext();
				},
				updatePagination() {
					if (this.swiper.params.loop) {
						this.pagination.current.innerText = (this.swiper.realIndex + 1);
						this.pagination.total.innerText = this.swiper.slides.length - this.swiper.loopedSlides*2;
					} else {
						this.pagination.current.innerText = (this.swiper.snapIndex + 1);
						this.pagination.total.innerText = this.swiper.snapGrid.length;
					}
				},
			};
			target.ftSwiperNav.init();
		};
		if (navs.length) {
			navs.forEach(function (nav) {
				window.addFTSwiperNav(nav);
			});
		};
	});
})();

(function choicesSelect() {
	function init() {

		const selector = '.js-select',
			selects = document.querySelectorAll(selector);

		if (!selects.length) {
			return;
		}

		const selectSettings = {
			searchEnabled: false,
			shouldSort: false,
			itemSelectText: '',
			placeholder: true,
			placeholderValue: null
		};

		selects.forEach(function (select) {
			const currentSettings = JSON.parse(JSON.stringify(selectSettings));

			select.choiceInstance = new Choices(select, currentSettings);
		});

		// selects inside fancybox
		document.body.addEventListener('click', function (e) {
			if (e.target.matches('.fancybox__container .choices__item--choice')) {
				var choices = e.target.closest('.choices'),
					select = choices.querySelector('select'),
					instance = select.choiceInstance;

				instance.setChoiceByValue(e.target.dataset.value);
			}
		});
	}

	callOnWindowLoad(function () {
		if (!document.querySelector('.js-select')) {
			return;
		}

		if (typeof Choices !== 'undefined') {
			init();
		} else if (window.resourceLoader) {
			document.body.addEventListener('choices-js-load', function () {
				init();
			});

			window.resourceLoader.load('choices');
		}
	});
})();


(function followingCarousel() {
	callOnWindowLoad(function () {
		const carouselSelector = '.js-following-carousel';

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
					};
				});
			};
		}

		var options = {
				speed: 10000,
				updateOnWindowResize: true,
				slidesPerView: 'auto',
				loop: true,
				spaceBetween: 1,
				allowTouchMove: false,
				autoplay: {
					delay: 0,
					disableOnInteraction: false
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


(function partnersCarousel() {
	callOnWindowLoad(function () {
		const carouselSelector = '.js-partners-carousel';
		const reverseCarouselSelector = '.js-partners-carousel-reverse';

		if (!document.querySelector(carouselSelector) && !document.querySelector(carouselSelector)) {
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
					};
				});
			};
		}

		var options = {
				speed: 6000,
				loop: true,
				spaceBetween: 33,
				slidesPerView: 'auto',
				updateOnWindowResize: true,
				allowTouchMove: false,
				autoplay: {
					delay: 0,
					disableOnInteraction: true
				},
			};

		var reverseOptions = {
				speed: 6000,
				loop: true,
				spaceBetween: 33,
				slidesPerView: 'auto',
				updateOnWindowResize: true,
				allowTouchMove: false,
				autoplay: {
					delay: 0,
					reverseDirection: true,
					disableOnInteraction: true
				},
			};

		if (typeof Swiper !== 'undefined') {
			initCarousel(carouselSelector, options);
			initCarousel(reverseCarouselSelector, reverseOptions);
		} else if (window.resourceLoader) {
			document.body.addEventListener('swiper-bundle-js-load', function () {
				initCarousel(carouselSelector, options);
				initCarousel(reverseCarouselSelector, reverseOptions);
			});

			window.resourceLoader.load('swiper');
		}

	});
})();

(function form() {
	window.addEventListener('load', function () {

		function updateSubmit(check) {
			var form = check.closest('form');
			if (form) {
				var submits = form.querySelectorAll('[type="submit"], [data-type="submit"]');

				submits.forEach(function (submit) {
					submit.disabled = !check.checked;
				});
			}
		}

		function updateTextareaHeight(textarea) {
			textarea.style.height = '';

			textarea.style.height =
				textarea.scrollHeight
				+ textarea.offsetHeight
				- textarea.clientHeight
				+ 'px';
		}


		window.updateFormFields = function () {
			var phoneInputs = document.getElementsByClassName('js-phone-input'),
				emailInputs = document.getElementsByClassName('js-email-input'),
				disablingCheckbox = document.getElementsByClassName('js-disabling-checkbox'),
				expandingTextareaSelector = '.js-expanding-textarea';

			if (phoneInputs.length) {
				[].slice.call(phoneInputs).forEach(function (el) {
					Inputmask('+7 (999) 999-99-99').mask(el);
				});
			}

			if (emailInputs.length) {
				[].slice.call(emailInputs).forEach(function (el) {
					Inputmask('email').mask(el);
				});
			}

			if (disablingCheckbox.length) {
				[].slice.call(disablingCheckbox).forEach(function (el) {
					updateSubmit(el);

					el.addEventListener('change', function () {
						updateSubmit(el);
					});
				});
			}

			document.querySelectorAll(expandingTextareaSelector).forEach(function (textarea) {
				updateTextareaHeight(textarea);
			});
			document.body.addEventListener('input', function (e) {
				if (e.target.matches(expandingTextareaSelector)) {
					updateTextareaHeight(e.target);
				}
			});
		};

		window.updateFormFields();

	}, false);
})();


(function reviewsCarousel() {
	callOnWindowLoad(function () {
		const carouselSelector = '.js-gallery-carousel';

		if (!document.querySelector(carouselSelector)) {
			return;
		}

		function initCarousel(selector, options) {
			var carouselSet = document.querySelectorAll(selector),
				// eslint-disable-next-line no-unused-vars
				myCarousel;

			if (carouselSet.length) {
				carouselSet.forEach(function (carousel) {
					navOffGroup.push({
						el: carousel,
						swiper: null,
						swiperOptions: options,
						parentSelector: '.section',
						parentClass: 'section_carousel-nav_hidden',
						containerSelector: '.gallery',
						containerClass: 'gallery_state_uninitialized',
						breakpoints: [
							{
								value: 1,
								limit: 1,
							},
							{
								value: 768,
								limit: 2,
							},
							{
								value: 1025,
								limit: 3,
							},
							{
								value: 1281,
								limit: 4,
							},
						]
					});

					if (carousel.ftSwiperNav) {
						carousel.ftSwiperNav.init();
					};
				});
			};
		};

		function renderOneBullet(swiper, index, className) {
			var slide = swiper.slides[index],
				labelText = slide.dataset['paginationLabel'] || 'Слайд №' + (index + 1);

			return '<button class="' + className + '" type="button">'
				+ labelText
				+ '</button>';
		};

		function updateNavVisibility() {
			navOffGroup.forEach(function (item) {
				if (!item.el || !item.swiperOptions || !item.breakpoints.length) {
					return;
				}

				let parent = null,
					container = null,
					matchedBreakpoint = false,
					limitApplied = false;

				if (item.parentSelector && item.parentClass) {
					parent = item.el.closest(item.parentSelector);
				}

				if (item.containerSelector && item.containerClass) {
					container = item.el.closest(item.containerSelector);
				}

				item.breakpoints.forEach(function (bp) {
					matchedBreakpoint = window.innerWidth >= bp.value;

					if (matchedBreakpoint) {
						limitApplied = bp.limit >= item.el.querySelectorAll('.swiper-slide:not(.swiper-slide-blank)').length;

						if (limitApplied) {
							if (item.swiper) {
								item.swiper.destroy(true, true);
								item.swiper = null;

								if (item.el.ftSwiperNav) {
									item.el.ftSwiperNav.destroy();
								};
							}

							if (parent) {
								parent.classList.add(item.parentClass);
							}

							if (container) {
								container.classList.add(item.containerClass);
							}
						}
					}
				});

				if (!limitApplied) {
					if (!item.swiper) {
						item.swiper = new Swiper(item.el, item.swiperOptions);

						if (item.el.ftSwiperNav && !item.el.ftSwiperNav.initialized) {
							item.el.ftSwiperNav.init();
						};
					}

					if (parent) {
						parent.classList.remove(item.parentClass);
					}

					if (container) {
						container.classList.remove(item.containerClass);
					}
				}
			});
		}

		const options = {
				loop: false,
				speed: 600,
				slidesPerView: 'auto',
				slidesPerGroup: 1,
				spaceBetween: 0,
				touchReleaseOnEdges: false,
				pagination: {
					el: '.bullet-pagination_role_gallery',
					type: 'bullets',
					clickable: true,
					bulletEl: 'button',
					modifierClass: 'bullet-pagination_',
					bulletClass: 'bullet-pagination__button',
					bulletActiveClass: 'bullet-pagination__button_state_active',
					renderBullet: function (index, className) {
						return renderOneBullet(this, index, className);
					},
				},
				breakpoints: {
					768: {
						slidesPerView: 'auto',
						slidesPerGroup: 1,
						spaceBetween: 0,
					},
					1281: {
						slidesPerView: 4,
						slidesPerGroup: 2,
						spaceBetween: 40,
					},
				},
			},
			navOffGroup = [];

		if (typeof Swiper !== 'undefined') {
			initCarousel(carouselSelector, options);

			updateNavVisibility();
			window.addEventListener('resize', function () {
				updateNavVisibility();
			});
		} else if (window.resourceLoader) {
			document.body.addEventListener('swiper-bundle-js-load', function () {
				initCarousel(carouselSelector, options);

				updateNavVisibility();
				window.addEventListener('resize', function () {
					updateNavVisibility();
				});
			});

			window.resourceLoader.load('swiper');
		}
	});
})();


(function header () {
  callOnWindowLoad(function () {
    var header = document.querySelector('.header'),
			headerWrapper = document.querySelector('.page__header'),
			isFixed = false;

		function update() {
			if (isFixed) {
				header.classList.remove('header_state_fixed');
			}

			headerWrapper.style.minHeight = header.clientHeight + 'px';

			if (isFixed) {
				header.classList.add('header_state_fixed');
			}
		}

		function fix() {
			if (
				(window.scrollY > 500 && !isFixed)
				|| (window.scrollY < 500 && isFixed)
			) {
				header.classList.toggle('header_state_fixed');
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


(function mediaCarousel() {
	callOnWindowLoad(function () {
		const carouselSelector = '.js-media-carousel';

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
					navOffGroup.push({
						el: carousel,
						swiper: carousel.swiper,
						parentSelector: '.section',
						parentClass: 'section_carousel-nav_hidden',
						containerSelector: '.mass-media-carousel',
						containerClass: 'mass-media-carousel_navigation_hidden',
						breakpoints: [
							{
								value: 0,
								limit: 1,
							},
							{
								value: 768,
								limit: 2,
							},
							{
								value: 1281,
								limit: 3,
							},
						]
					});

					if (carousel.ftSwiperNav) {
						carousel.ftSwiperNav.init();
					}
				});
			};
		}

		function renderOneBullet(swiper, index, className) {
			var slide = swiper.slides[index],
				labelText = slide.dataset['paginationLabel'] || 'Слайд №' + (index + 1);

			return '<button class="' + className + '" type="button">'
				+ labelText
				+ '</button>';
		}

		function updateNavVisibility() {
			navOffGroup.forEach(function (item) {
				if (!item.el || !item.swiper || !item.breakpoints.length) {
					return;
				}

				let parent = null,
					container = null,
					matchedBreakpoint = false,
					limitApplied = false;

				if (item.parentSelector && item.parentClass) {
					parent = item.el.closest(item.parentSelector);
				}

				if (item.containerSelector && item.containerClass) {
					container = item.el.closest(item.containerSelector);
				}

				item.breakpoints.forEach(function (bp) {
					matchedBreakpoint = window.innerWidth >= bp.value;

					if (matchedBreakpoint) {
						limitApplied = bp.limit >= item.swiper.slidesEl.querySelectorAll('.swiper-slide:not(.swiper-slide-blank)').length;

						if (limitApplied) {
							if (parent) {
								parent.classList.add(item.parentClass);
							}

							if (container) {
								container.classList.add(item.containerClass);
							}
						}
					}
				});

				if (!limitApplied) {
					if (parent) {
						parent.classList.remove(item.parentClass);
					}

					if (container) {
						container.classList.remove(item.containerClass);
					}
				}
			});
		}

		var options = {
				loop: true,
				speed: 600,
				slidesPerView: 1,
				slidesPerGroup: 1,
				spaceBetween: 24,
				touchReleaseOnEdges: true,
				pagination: {
					el: '.bullet-pagination_role_media',
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
				breakpoints: {
					768: {
						slidesPerView: 2,
						slidesPerGroup: 1,
						spaceBetween: 20
					},
					1280: {
						slidesPerView: 3,
						slidesPerGroup: 1,
						spaceBetween: 40
					}
				},
			},
			navOffGroup = [];

		if (typeof Swiper !== 'undefined') {
			initCarousel(carouselSelector, options);

			updateNavVisibility();
			window.addEventListener('resize', function () {
				updateNavVisibility();
			});
		} else if (window.resourceLoader) {
			document.body.addEventListener('swiper-bundle-js-load', function () {
				initCarousel(carouselSelector, options);

				updateNavVisibility();
				window.addEventListener('resize', function () {
					updateNavVisibility();
				});
			});

			window.resourceLoader.load('swiper');
		}
	});
})();

(function modal() {
	function init() {
		window.fancyboxSettings = {
			dragToClose: false,
			autoFocus: false,
			touch: false,
			trapFocus: false,
			on: {
				init: function (fb) {
					Fancybox.close();

					const trigger = fb.options.target,
						callbackName = trigger ? trigger.dataset.modalCallback : null;

					if (callbackName && typeof window[callbackName] === 'function') {
						try {
							const modalEl = trigger.attributes.href.value ? document.querySelector(trigger.attributes.href.value) : null;
							const formEl = modalEl ? modalEl.querySelector('form') : null;

							window[callbackName](fb, modalEl, formEl);
						} catch(err) {
							console.warn("Couldn't call custom modal callback");
							console.warn(err);
						}
					}
				},
				"Carousel.ready Carousel.change": (fancybox) => {
					let players = document.querySelectorAll('.has-iframe .fancybox__iframe');
					if (players) {
						Array.from(players).forEach(player => {
							function doCommand(command) {
								player.contentWindow.postMessage(JSON.stringify(command), '*');
							}
							(function do_pause() {
								doCommand({
									type: 'player:pause',
									data: {}
								})
							})();
						})
					};
				},
			}
		};

		window.openModal = function (id) {
			if (!id) {
				console.log('No id provided for modal to open');
				return;
			}

			Fancybox.show([
				{
					src: '#' + id
				}
			],
			window.fancyboxSettings
			);
		};

		Fancybox.bind('.js-modal', window.fancyboxSettings);

		document.body.addEventListener('click', function (e) {
			var closeTrigger = e.target.closest('.js-fancybox-close');

			if (closeTrigger) {
				Fancybox.close();
			}
		});
	}

	callOnWindowLoad(function () {
		if (!document.querySelector('.js-modal')) {
			return;
		}

		if (typeof Fancybox !== 'undefined') {
			init();
		} else if (window.resourceLoader) {
			document.body.addEventListener('fancybox-js-load', function () {
				init();
			});

			window.resourceLoader.load('fancybox');
		}
	});
})();


(function quoteList () {
	callOnWindowLoad(function () {
		function reposition(el, parent) {
			const parentBR = parent.getBoundingClientRect(),
				offsetLowerLimit = 0,
				offset = Math.max(offsetLowerLimit, parentBR.y - window.innerHeight + el.offsetHeight),
				shouldBeShown = 0 <= parentBR.y + parentBR.height - window.innerHeight;

			el.classList.toggle(gradientVisibleClass, shouldBeShown);
			el.style.transform = 'translate(0, ' + offset + 'px)';
		}

		const listSelector = '.js-quote-list',
			gradientSelector = '.js-quote-list-gradient',
			gradientVisibleClass = 'quote-list__gradient_state_visible';

		const list = document.querySelector(listSelector),
			gradient = document.querySelector(gradientSelector);

		if (!list || !gradient) {
			return;
		}

		reposition(gradient, list);
		window.addEventListener('scroll', function () {
			reposition(gradient, list);
		});
		window.addEventListener('resize', function () {
			reposition(gradient, list);
		});
	}, 0)
})();


(function reviewsCarousel() {
	callOnWindowLoad(function () {
		const carouselSelector = '.js-reviews-carousel';

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
					navOffGroup.push({
						el: carousel,
						swiper: carousel.swiper,
						parentSelector: '.section',
						parentClass: 'section_carousel-nav_hidden',
						containerSelector: '.reviews-carousel',
						containerClass: 'reviews-carousel_pagination_hidden',
						breakpoints: [
							{
								value: 1025,
								limit: 3,
							},
							{
								value: 1281,
								limit: 4,
							},
						]
					});

					if (carousel.ftSwiperNav) {
						carousel.ftSwiperNav.init();
					};
				});
			};
		}

		function renderOneBullet(swiper, index, className) {
			var slide = swiper.slides[index],
				labelText = slide.dataset['paginationLabel'] || 'Слайд №' + (index + 1);

			return '<button class="' + className + '" type="button">'
				+ labelText
				+ '</button>';
		}

		function updateNavVisibility() {
			navOffGroup.forEach(function (item) {
				if (!item.el || !item.swiper || !item.breakpoints.length) {
					return;
				}

				let parent = null,
					container = null,
					matchedBreakpoint = false,
					limitApplied = false;

				if (item.parentSelector && item.parentClass) {
					parent = item.el.closest(item.parentSelector);
				}

				if (item.containerSelector && item.containerClass) {
					container = item.el.closest(item.containerSelector);
				}

				item.breakpoints.forEach(function (bp) {
					matchedBreakpoint = window.innerWidth >= bp.value;

					if (matchedBreakpoint) {
						limitApplied = bp.limit >= item.swiper.slidesEl.querySelectorAll('.swiper-slide:not(.swiper-slide-blank)').length;

						if (limitApplied) {
							if (parent) {
								parent.classList.add(item.parentClass);
							}

							if (container) {
								container.classList.add(item.containerClass);
							}
						}
					}
				});

				if (!limitApplied) {
					if (parent) {
						parent.classList.remove(item.parentClass);
					}

					if (container) {
						container.classList.remove(item.containerClass);
					}
				}
			});
		}

		const options = {
				loop: true,
				speed: 600,
				slidesPerView: 'auto',
				slidesPerGroup: 1,
				touchReleaseOnEdges: true,
				pagination: {
					el: '.bullet-pagination_role_reviews',
					type: 'bullets',
					clickable: true,
					bulletEl: 'button',
					modifierClass: 'bullet-pagination_',
					bulletClass: 'bullet-pagination__button',
					bulletActiveClass: 'bullet-pagination__button_state_active',
					renderBullet: function (index, className) {
						return renderOneBullet(this, index, className);
					},
				},
				breakpoints: {
					768: {
						slidesPerGroup: 2,
					},
					1281: {
						slidesPerView: 4,
						slidesPerGroup: 2,
					},
				},
			},
			navOffGroup = [];

		if (typeof Swiper !== 'undefined') {
			initCarousel(carouselSelector, options);

			updateNavVisibility();
			window.addEventListener('resize', function () {
				updateNavVisibility();
			});
		} else if (window.resourceLoader) {
			document.body.addEventListener('swiper-bundle-js-load', function () {
				initCarousel(carouselSelector, options);

				updateNavVisibility();
				window.addEventListener('resize', function () {
					updateNavVisibility();
				});
			});

			window.resourceLoader.load('swiper');
		}
	});
})();


(function scrollProgress () {
	callOnWindowLoad(function () {
		function reposition(el, parent) {
			const parentBR = parent.getBoundingClientRect(),
				lowerLimit = 0,
				higherLimit = parent.offsetHeight - el.offsetHeight - 8,
				offset = Math.min(higherLimit, Math.max(lowerLimit, -parentBR.y - el.offsetHeight + window.innerHeight / 2));

			el.style.transform = 'translate(-50%, ' + offset + 'px)'
		}

		const containerSelector = '.js-scroll-progress',
			scrollerSelector = '.js-scroll-progress-scroller';

		const container = document.querySelector(containerSelector),
			scroller = document.querySelector(scrollerSelector);

		if (!container || !scroller) {
			return;
		}

		reposition(scroller, container);
		window.addEventListener('scroll', function () {
			reposition(scroller, container);
		});
		window.addEventListener('resize', function () {
			reposition(scroller, container);
		});
	}, 0)
})();

(function searchPanel () {
	window.addEventListener('load', function () {
		function clear(trigger) {
			const scope = trigger.closest(scopeSelector),
				input = scope ? scope.querySelector(inputSelector) : null;

			if (!input) return;

			input.value = '';
		}

		const clearSelector = '.js-search-clear',
			scopeSelector = '.search-panel',
			inputSelector = '.search-panel__input';

		document.body.addEventListener('click', function (e) {
			const trigger = e.target.closest(clearSelector);
			if (trigger) {
				clear(trigger);
			}
		});
	});
})();
(function sectionNav() {
	function getSection(link) {
		const href = link.attributes.href.value;
		const id = href ? href.replace('#', '') : null;

		return id ? document.getElementById(id) : null;
	}
	function update(nav, static, links) {
		const navHiddenClass = 'section-nav_state_hidden',
			linkActiveClass= 'section-nav__link_state_active',
			threshold = window.innerHeight / 10;

		if (!static) {
			const lastLink = links[links.length - 1],
				lastLinkHref = lastLink.attributes.href.value,
				lastAnchors = document.body.querySelectorAll('[href="' + lastLinkHref + '"]');

			lastAnchors.forEach(function (anchor) {
				if (anchor !== lastLink) {
					static = anchor;
				}
			});
		}

		const staticBR = static.getBoundingClientRect(),
			hideNav = staticBR.y + staticBR.height > 0;

		nav.classList.toggle(navHiddenClass, hideNav);

		if (hideNav) return;

		links.forEach(function (link, i) {
			const section = getSection(link),
				lastSection = i === links.length - 1,
				nextSection = lastSection ? null : getSection(links[i + 1]);

			const sectionBR = section.getBoundingClientRect(),
				nextSectionBR = lastSection ? null : nextSection.getBoundingClientRect(),
				isActive = sectionBR.y < threshold && (lastSection || nextSectionBR.y >= threshold);

			link.classList.toggle(linkActiveClass, isActive);
		});
	}

	callOnWindowLoad(function () {
		const navSelector = '.js-section-nav',
			staticNavSelector = '.js-static-section-nav',
			linkSelector = '.js-section-nav-link';

		const nav = document.querySelector(navSelector),
			static = document.querySelector(staticNavSelector),
			links = document.querySelectorAll(linkSelector);

		if (!nav || !links.length) return;

		update(nav, static, links);
		window.addEventListener('scroll', function () {
			update(nav, static, links);
		});
	});
})();


(function video() {
	var triggerSelector = '.js-video-trigger',
		scopeSelector = '.js-video-scope',
		contentSelector = '.js-video-content',
		loadingClass = 'video_state_loading',
		loadedClass = 'video_state_loaded';

	function beginVideoOnCanplay(e) {
		var scope = e.target.closest(scopeSelector);

		scope.classList.add(loadedClass);
		scope.classList.remove(loadingClass);

		e.target.play();
	}

	function loadVideoFromSourceTags(scope, video, sources) {
		scope.classList.add(loadingClass);
		video.addEventListener('canplay', beginVideoOnCanplay, { once: true });

		sources.forEach(function (source) {
			source.setAttribute('src', source.dataset.src);
		});
		video.load();
	}

	function beginIframeOnLoad(e) {
		var scope = e.target.closest(scopeSelector);

		scope.classList.add(loadedClass);
		scope.classList.remove(loadingClass);
	}

	function loadIframe(scope, iframe) {
		// scope.classList.add(loadingClass);
		// iframe.addEventListener('load', beginIframeOnLoad, { once: true });

		iframe.setAttribute('src', iframe.dataset.src);
		scope.classList.add(loadedClass);
	}

	function initVideo(video, scope) {
		if (video && scope) {
			var sources = video.querySelectorAll('source');

			if (sources.length) {
				loadVideoFromSourceTags(scope, video, sources);
			} else if (video.tagName === 'IFRAME') {
				loadIframe(scope, video);
			}
		}
	}

	function initVideoFromTrigger(obj, objIsTrigger = false) {
		// objIstrigger: false - first argument is click event
		// objIsTrigger: true - first argument is trigger element
		var trigger = objIsTrigger ? obj : obj.target.closest(triggerSelector);

		if (trigger) {
			var scope = trigger.closest(scopeSelector) || null,
				target = scope ? scope.querySelector(contentSelector) : null;

			initVideo(target, scope);
		}
	}


	callOnWindowLoad(function () {
		window.autoplayVideoInContainer = function (container) {
			if (!container) {
				return;
			}

			var videos = container.querySelectorAll(contentSelector);

			videos.forEach(function (video) {
				var scope = video.closest(scopeSelector);
				initVideo(video, scope);
			});
		};

		document.body.addEventListener('click', initVideoFromTrigger);

		var videos = document.querySelectorAll(contentSelector);

		if (videos.length) {
			videos.forEach(function (video) {
				if (video.autoplay || video.attributes.autoplay) {
					var scope = video.closest(scopeSelector);

					initVideo(video, scope);
				}
			});
		}

		if (window.autoplayContainerBuffer && window.autoplayContainerBuffer.length) {
			window.autoplayContainerBuffer.forEach(function (container) {
				window.autoplayVideoInContainer(container);
			});
		}
	});
})();
