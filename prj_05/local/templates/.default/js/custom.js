$(document).ready(function () {
    initLazyLoad();
});

function loadImagesOnScreen(selector) {
    const images = document.querySelectorAll(selector);

    images.forEach(function (el) {
        const br = el.getBoundingClientRect();
        const top = br.top || br.y;
        const height = el.offsetHeight;
        const bottom = top + height;

        if (
            top > 0 && top < window.innerHeight
            || bottom > 0 && bottom < window.innerHeight
        ) {
            $(el).lazy({
                bind: "event"
            });
        }
    });
}

function initLazyLoad() {
    loadImagesOnScreen('.js_lazy');
    console.log('initLazyLoad');

    /*
    $(window).scroll(function () {
        $('.js_lazy').lazy({
            bind: "event"
        });
    });
    */

    $(document).on('scroll touchstart mouseenter click', function () {
        $('.js_lazy').lazy({
            bind: "event"
        });
    });
}