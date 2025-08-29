(function setCarousel () {
    var mySwiper = new Swiper('.js-set-carousel', {
        loop: false,
        speed: 600,
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 24,
        autoHeight: true,
        navigation: {
            enabled: true,
            prevEl: '.set-carousel__prev',
            nextEl: '.set-carousel__next',
            disabledClass: 'carousel-navigation__arrow_state_disabled'
        },
        pagination: {
            enabled: true,
            clickable: true,
            el: '.set-carousel__pagination',
            type: 'bullets',
            bulletElement: 'button',
            bulletClass: 'bullet-pagination__bullet',
            bulletActiveClass: 'bullet-pagination__bullet_state_active'
        }
    });
})();