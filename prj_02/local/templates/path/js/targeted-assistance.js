$('[data-modal-book]').click(function(event) {
    $('#modal-book').modal();
    return false;
});

$(".text-expand-controller").on('click', (event) => {
    $(event.currentTarget).siblings('.text-expand-content').toggleClass('open')
    $(event.currentTarget).text() === 'Читать полностью' ? $(event.currentTarget).text('Скрыть') : $(event.currentTarget).text('Читать полностью')
})

new Swiper(".targeted-assistance-how-help__category", {
    slidesPerView: 2,
    spaceBetween: 30,
    breakpoints: {
        374: {
            slidesPerView: 1,
        },
        590: {
            slidesPerView: 1.4,
        },
        767: {
            slidesPerView: 2,
            spaceBetween: 20,
        }
    }
});