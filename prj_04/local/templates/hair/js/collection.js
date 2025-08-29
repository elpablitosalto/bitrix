$(function() {
    // accordion
    $('.js-toggle').click(function(event) {
        event.preventDefault();
        let parents = $(this).parents('.accordion__item');

        $('.js-toggle').not(this).parents('.accordion__item').removeClass('accordion__item_state_open');

        $('.js-toggle').not(this).next().slideUp(400);

        parents.toggleClass('accordion__item_state_open');
        $(this).next().slideToggle(400);
    });


    //carousel
    const swiper = new Swiper('.swiper_js', {
        loop: true,
        slidesPerView: 1,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

    });

});