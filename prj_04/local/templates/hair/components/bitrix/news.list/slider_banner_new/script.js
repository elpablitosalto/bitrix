// Загрузка по скроллу -->
var loadScroll_productBanner = true;
$(document).ready(function () {
    $(document).on({
        'scroll touchstart mouseenter click': function () {
            loadOnScroll_productBanner();
        }
    });
});

function loadOnScroll_productBanner() {
    if (loadScroll_productBanner == true) {
        SliderInit_productBanner();
        loadScroll_productBanner = false;
    }
}
// <-- Загрузка по скроллу 

function SliderInit_productBanner() {
    var swiper = new Swiper(".myBannerSwiperSlider", {
        lazy: true,
        speed: 700,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
}