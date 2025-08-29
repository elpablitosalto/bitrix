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

(function carouselNav() {
	window.addEventListener('load', function () {
		var navSelector = '.js-carousel-nav',
			navs = document.querySelectorAll(navSelector);


		if (navs.length) {
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
				}

				if (!targetScope) {
					targetScope = document;
				}

				if (navTarget) {
					target = targetScope.querySelector(navTarget);
				}

				if (!target) {
					target = targetScope;
				}

				if (target === document) {
					return;
				}

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
						}

						var ftNav = this;
						ftNav.swiper = ftNav.target.swiper;
						ftNav.slidePrev = ftNav.slidePrev.bind(ftNav);
						ftNav.slideNext = ftNav.slideNext.bind(ftNav);

						if (ftNav.triggers.prev) {
							ftNav.triggers.prev.addEventListener('click', ftNav.slidePrev);
						}

						if (ftNav.triggers.next) {
							ftNav.triggers.next.addEventListener('click', ftNav.slideNext);
						}


						if (ftNav.triggers.prev || ftNav.triggers.next) {
							ftNav.updateArrows();
							ftNav.swiper.on('transitionStart', function () {
								ftNav.updateArrows();
							});
						}

						if (ftNav.pagination.container) {
							ftNav.updatePagination();
							ftNav.swiper.on('transitionStart', function () {
								ftNav.updatePagination();
							});
						}

						ftNav.initialized = true;
					},
					destroy(hard = false) {
						var ftNav = this;

						if (ftNav.triggers.prev) {
							ftNav.triggers.prev.removeEventListener('click', ftNav.slidePrev);
						}

						if (ftNav.triggers.next) {
							ftNav.triggers.next.removeEventListener('click', ftNav.slideNext);
						}

						ftNav.initialized = false;

						if (hard) {
							delete this;
						}
					},
					slidePrev() {
						this.swiper.slidePrev();
					},
					slideNext() {
						this.swiper.slideNext();
					},
					updateArrows() {
						if (this.swiper.isBeginning) {
							this.triggers.prev.disabled = true;
						} else {
							this.triggers.prev.disabled = false;
						}

						if (this.swiper.isEnd) {
							this.triggers.next.disabled = true;
						} else {
							this.triggers.next.disabled = false;
						}
					},
					updatePagination() {
						if (this.swiper.params.loop) {
							this.pagination.current.innerText = (this.swiper.realIndex + 1);
							this.pagination.total.innerText = this.swiper.slides.length - this.swiper.loopedSlides*2;
						} else {
							this.pagination.current.innerText = (this.swiper.snapIndex + 1);
							this.pagination.total.innerText = this.swiper.snapGrid.length;
						}
					}
				};

				target.ftSwiperNav.init();
			};

			navs.forEach(function (nav) {
				window.addFTSwiperNav(nav);
			});
		}
	});
})();

(function entryGrid() {
	window.addEventListener('load', function () {
		var scopeSelector = '.js-entry-grid',
			triggerLineSelector = '.js-entry-grid-trigger-line';

		function dispatchCustomEvent(eventName, target, data) {
			var evt = document.createEvent('HTMLEvents');

			if (target) {
				evt.initEvent(eventName, true, true);
				evt.data = data;
				target.dispatchEvent(evt);
			}
		}

		function checkTriggersInView() {
			var windowHeight = window.innerHeight,
				lines = document.querySelectorAll(triggerLineSelector);

			lines.forEach(function (line) {

				var offset = typeof line.dataset.offset === 'number' ? line.dataset.offset : 0,
					topComparison = offset,
					bottomComparison = windowHeight - offset,
					rect = line.getBoundingClientRect(),
					rectTop = rect.y;

				if (rectTop > topComparison && rectTop < bottomComparison) {
					if (line.dataset.reached === "Y") {
						return;
					}

					line.dataset.reached = "Y";
					var scope = line.closest(scopeSelector);

					dispatchCustomEvent(
						'entryGrid:loadTriggerOnScreen',
						scope, {
							grid: scope,
							trigger: line
						}
					);
				}
			});
		}

		function windowScrollHandler(e) {
			checkTriggersInView();
		}

		checkTriggersInView();
		window.addEventListener('scroll', windowScrollHandler);
	}, false);
})();

(function form() {
	callOnWindowLoad(function () {
		function visualPassword(trigger, hide) {
			if (trigger) {
				const input = trigger.closest('.form-control').querySelector('input');

				if (input) {
					var text = trigger.innerText,
						altText = trigger.dataset.textAlt;

					trigger.classList.toggle('form-control__trigger_state_active');

					if (input.type === 'password' && (typeof hide === 'undefined' || hide === true)) {
						input.type = 'text';
					} else {
						input.type = 'password';
					}

					trigger.innerText = altText;
					trigger.dataset.textAlt = text;
				}
			}
		}

		function updateSubmit(check) {
			var form = check.closest('form');
			if (form) {
				var submits = form.querySelectorAll('[type="submit"], [data-type="submit"]');

				submits.forEach(function (submit) {
					submit.disabled = !check.checked;
				});
			}
		}

		document.body.addEventListener('click', function (e) {
			var trigger = e.target.matches('.js-show-password') ? e.target : null;
			if (trigger) {
				visualPassword(trigger);
			}
		});

		document.body.addEventListener('mouseup', function (e) {
			if (
				!e.target.matches('.js-show-password')
				&& e.target.closest('.js-show-password') === null
			) {
				const activeTriggers = document.querySelectorAll('.js-show-password.form__trigger_state_active');
				if (activeTriggers.length) {
					activeTriggers.forEach(function (item) {
						visualPassword(item, true);
					});
				}
			}
		});

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
					Inputmask('+7(999) 999-99-99').mask(el);
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

	}, 0);
})();

(function setInputValue() {
	callOnWindowLoad(function () {
		function update(trigger) {
			const value = trigger.dataset.inputValue,
				inputSelector = trigger.dataset.inputSelector,
				inputs = inputSelector ? document.querySelectorAll(inputSelector) : [];

			inputs.forEach(function (input) {
				input.value = value;
			});
		}

		const triggerSelector = '.js-set-input-value';
		document.body.addEventListener('click', function (e) {
			const trigger = e.target.closest(triggerSelector);

			if (trigger) {
				update(trigger);
			}
		});
	}, 0);
})();

(function header () {
	callOnWindowLoad(function () {
		const headerSelector = '.header',
			headerWrapperSelector = '.page__header',
			offsetElementSelector = '.js-header-offset',
			headerFixedClass = 'header_position_fixed',
			headerWrapperFixedClass = 'page__header_position_fixed',
			bodyFixedHeaderClass = 'page__body_header_fixed';

		const header = document.querySelector(headerSelector),
			headerWrapper = document.querySelector(headerWrapperSelector),
			offsetElements = document.querySelectorAll(offsetElementSelector),
			fixBreakpoint = 0; // vertical page scroll for header to get fixed

		let isFixed = false;

		function updateOffsetElements(elements) {
			if (elements.length) {
				const headerHeight = header.offsetHeight + header.offsetTop;

				elements.forEach(function (element) {
					const propertyName = element.dataset.headerOffsetProperty || 'top';
					element.style[propertyName] = headerHeight + 'px';
				});
			}
		}

		function resetOffsetElements(elements) {
			if (elements.length) {
				elements.forEach(function (element) {
					const propertyName = element.dataset.headerOffsetProperty || 'top';
					element.style[propertyName] = '';
				});
			}
		}

		function update() {
			if (isFixed) {
				header.classList.remove(headerFixedClass);
				headerWrapper.classList.remove(headerWrapperFixedClass);
			}

			headerWrapper.style.minHeight = header.clientHeight + 'px';

			if (isFixed) {
				header.classList.add(headerFixedClass);
				headerWrapper.classList.add(headerWrapperFixedClass);
			}
		}

		function fix() {
			if (
				(window.scrollY > fixBreakpoint && !isFixed)
				|| (window.scrollY <= fixBreakpoint && isFixed)
			) {
				header.classList.toggle(headerFixedClass);
				headerWrapper.classList.toggle(headerWrapperFixedClass);
				document.body.classList.toggle(bodyFixedHeaderClass);
				isFixed = !isFixed;
			}

		}

		if (header && headerWrapper) {
			update();
			fix();
			updateOffsetElements(offsetElements);

			window.addEventListener('resize', function () {
				update();
				fix();
				updateOffsetElements(offsetElements);
			});

			window.addEventListener('scroll', function () {
				fix();
				updateOffsetElements(offsetElements);
			});
		}
	}, 0)
})();

(function modal() {
	callOnWindowLoad(function () {
		window.fancyboxSettings = {
			dragToClose: false,
			autoFocus: false,
			touch: false,
			trapFocus: false,
			on: {
				init: function () {
					Fancybox.close();
				},
				done: function () {
					if (typeof initCaptcha !== 'undefined') {
						initCaptcha();
					}
				},
				reveal: function () {
					var container = this.$container,
						modal = container.querySelector('.modal'),
						form = container.querySelector('form');

					if (modal) {
						modal.classList.remove('modal_form-state_sent');
					}

					if (form) {
						form.classList.remove('form_state_sent');
					}
				}
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
			var trigger = e.target.matches('.js-fancybox-close')
				? e.target
				: e.target.closest('.js-fancybox-close');

			if (trigger) {
				Fancybox.close();
			}
		});
	}, 0);
})();

(function page() {
	function debounce(func, wait, immediate) {
		var timeout;

		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		}
	}
	window.addEventListener('scroll', debounce(function (e) {
		var hash = location.hash;
		var target = hash ? document.getElementById(hash.replace('#', '')) : null;
		var cr = target ? target.getBoundingClientRect() : null;

		if (!cr || Math.floor(cr.y) !== 0) {
			return;
		}

		var header = document.querySelector('.header');
		var headerCR = header ? header.getBoundingClientRect() : null;

		if (!headerCR || !headerCR.y === 0) {
			return;
		}

		window.scrollTo(0, window.scrollY - header.offsetHeight);
	}, 50));
})();
WAOverflowingNav = (function overflowingNav () {
	const gl = {};

	function getSetting(type, val, fallback) {
		return typeof val === type ? val : fallback;
	}

	function getSettings(_st) {
		_st = _st || {};
		_st.selectors = _st.selectors || {};
		_st.templates = _st.templates || {};

		return {
			selectors: {
				root: getSetting('string', _st.selectors.root, '.nav'),
				list: getSetting('string', _st.selectors.list, '.nav__list'),
				item: getSetting('string', _st.selectors.item, '.nav__item'),
				link: getSetting('string', _st.selectors.link, '.nav__link'),
				burgerItem: getSetting('string', _st.selectors.burgerItem, '.nav__item_type_burger'),
				burger: getSetting('string', _st.selectors.burger, '.burger'),
			},
			templates: {
				item: getSetting('string', _st.templates.item, '<li class="nav__item nav__item_type_burger">%ITEM_LINK%%ITEM_SUB%</li>'),
				sub: getSetting('string', _st.templates.item, '<div class="nav__sub"><ul class="nav__list"></ul></div>'),
				burger: getSetting('string', _st.templates.burger, '<!-- begin .burger--><div class="nav__link nav__burger"><div class="burger"><div class="burger__bars">%BURGER_TEXT%</div></div></div><!-- end .burger-->'),
			},
			burgerText: getSetting('string', _st.burgerText, 'Больше элементов'),
			rebuildOnResize: getSetting('boolean', _st.rebuildOnResize, true),
		}
	}

	function getElements() {
		const list = gl.root.querySelector(gl.settings.selectors.list),
			items = list.children;

		return {
			root: gl.root,
			list: list,
			items: items,
		}
	}

	function reset() {
		const burgerItem = gl.elements.list.querySelector(gl.settings.selectors.burgerItem);

		if (!burgerItem) {
			return;
		}

		const burgerList = burgerItem.querySelector(gl.settings.selectors.list),
			burgerItems = burgerList.children;

		Array.from(burgerItems).forEach(function(item) {
			gl.elements.list.appendChild(item);
		});

		burgerItem.remove();
	}

	function update() {
		reset();

		const listWidth = gl.elements.list.offsetWidth,
			listScrollWidth = gl.elements.list.scrollWidth;

		if (listWidth >= listScrollWidth) {
			return;
		}

		const fragment = document.createDocumentFragment();
		let template = gl.settings.templates.item;

		template = template
			.replace('%ITEM_LINK%', gl.settings.templates.burger)
			.replace('%ITEM_SUB%', gl.settings.templates.sub)
			.replace('%BURGER_TEXT%', gl.settings.burgerText);

		fragment.append(stringToNode(template));
		gl.elements.list.appendChild(fragment);

		const burgerItem = gl.elements.list.querySelector(gl.settings.selectors.burgerItem),
			burgerList = burgerItem.querySelector(gl.settings.selectors.list),
			burgerItemWidth = burgerItem.offsetWidth;

		let itemWidthSum = burgerItem.offsetWidth;

		Array.from(gl.elements.items).forEach(function (item, i) {
			itemWidthSum += item.offsetWidth;

			if (itemWidthSum > listWidth && item !== burgerItem) {
				burgerList.appendChild(item);
			}
		});
	}

	function init() {
		update();

		if (gl.settings.rebuildOnResize) {
			window.addEventListener('resize', function () {
				update();
			});
		}
	}

	const OverflowingNav = function (root, _settings) {
		gl.root = root;
		gl.settings = getSettings(_settings);
		gl.elements = getElements();

		init();
	};

	OverflowingNav.prototype.disable = function () {
		Object.values(gl.data.flat).forEach(function (itemData) {
			itemData.els.input.disabled = true;
		});
	}

	return OverflowingNav;
})();