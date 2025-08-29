$('.pay__item').click(
    ({currentTarget}) => {
        if (!currentTarget.classList.contains('pay__active')) {
            currentTarget.classList.add('pay__active')
            $(currentTarget).siblings().removeClass('pay__active')
        }
        if (currentTarget.classList.contains('pay__sbp')) {
            $('.pay-sbp').siblings().removeClass('active')
            $('.pay-sbp').addClass('active')
        }
        if (currentTarget.classList.contains('pay__card')) {
            $('.pay-card').siblings().removeClass('active')
            $('.pay-card').addClass('active')
        }
        if (currentTarget.classList.contains('pay__bank')) {
            $('.pay-bank').siblings().removeClass('active')
            $('.pay-bank').addClass('active')
        }
    }
);

let swiper = new Swiper(".swiper-how-help-reviews", {
    slidesPerView: 3,
    spaceBetween: 30,
    // loop: true,
    navigation: {
        nextEl: ".arrow-left-btn",
        prevEl: ".arrow-right-btn",
    },
    breakpoints: {
        550: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 24,
        },
        // 1024: {
        //     slidesPerView: 5,
        //     spaceBetween: 50,
        // },
    },
});

$(".other-help__item ").hover(
    ({currentTarget}) => {
        $(currentTarget).siblings().removeClass('other-help--active')
        $(currentTarget).addClass('other-help--active')
        let elem = $(`img[data-img=${currentTarget.dataset.img}]`)
        elem.siblings().removeClass("active")
        elem.addClass('active')
    }
)