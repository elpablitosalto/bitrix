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
