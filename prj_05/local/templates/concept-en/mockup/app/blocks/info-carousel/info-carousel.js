(function infoCarousel() {
  callOnWindowLoad(function () {
    if (!window.swiperCarousel) return;
    // selector, breakpoint, destroyAboveBreakpoint, rules
    window.swiperCarousel.add(".js-info-carousel", {
      speed: 600,
      slidesPerView: "auto",
      slidesPerGroup: 1,
      allowTouch: true,
      spaceBetween: 0,
      slidesPerView: 1,
      loop: true,
      touchReleaseOnEdges: true,
      navigation: {
        nextEl: ".js-info-carousel-next",
        prevEl: ".js-info-carousel-prev",
      },
    });
  });
})();
