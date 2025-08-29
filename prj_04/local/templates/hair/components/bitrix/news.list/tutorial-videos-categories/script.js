(function() {
    $('.js-tutorial-videos-carousel').each(function(i, el) {
        var arrowSelector = el.dataset.arrows ? '#' + el.dataset.arrows : '.swiper-';

        var mySwiper = new Swiper(el, {
            speed: 300,
            loop: false,
            slidesPerView: 'auto',
            slidesPerGroup: 1,
            spaceBetween: 16,
            navigation: {
                prevEl: arrowSelector + 'prev',
                nextEl: arrowSelector + 'next',
                disabledClass: 'carousel-navigation__arrow_state_disabled'
            },
            breakpoints: {
                992: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                }
            }
        });

        if (mySwiper.slides.length <= 3) {
            $(arrowSelector + 'prev').parent().hide();
        }
    });

    (function eventCarousel() {
        var swiper = new Swiper(".js-event-carousel", {
            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                576: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 3
                }
            }
        });
    })();
})();
