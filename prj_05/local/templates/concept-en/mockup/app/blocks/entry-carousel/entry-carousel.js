(function entryCarousel() {
	callOnWindowLoad(function () {
		if (!window.swiperCarousel) return;
		// selector, breakpoint, destroyAboveBreakpoint, rules
		window.swiperCarousel.add(".js-entry-carousel", {
      speed: 600,
      slidesPerView: "auto",
      slidesPerGroup: 1,
      allowTouch: true,
      spaceBetween: 0,
      touchReleaseOnEdges: true,
      navigation: {
        nextEl: ".js-entry-carousel-next",
        prevEl: ".js-entry-carousel-prev",
      },
      pagination: {
        el: ".js-entry-carousel .bullet-pagination",
        type: "bullets",
        clickable: true,
        bulletEl: "button",
        modifierClass: "bullet-pagination_",
        bulletClass: "bullet-pagination__button",
        bulletActiveClass: "bullet-pagination__button_state_active",
        renderBullet: function renderBullet(index, className) {
          return window.swiperCarousel.renderOneBullet(this, index, className);
        },
      },
      freeMode: {
        enabled: true,
        sticky: false,
      },
      breakpoints: {
        1025: {
          slidesPerView: 4,
          spaceBetween: 20,
          freeMode: {
            enabled: false,
            sticky: false,
          },
        },
      },
    });
	});
})();
