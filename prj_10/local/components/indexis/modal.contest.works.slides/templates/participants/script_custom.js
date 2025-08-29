$(document).ready(function () {
    /* Слайдер --> */
    modalWorksSlider_Custom();
    /* <-- Слайдер */
});

/* Слайдер --> */
function modalWorksSlider_Custom() {

    var $modalWorksSlider = $('.js-ml-works-slider-custom');
    var modalWorksSliderArr = [];
    if ($modalWorksSlider.length) {
        $modalWorksSlider.each(function (i) {
            var $this = $(this);
            var $modalWorksSliderContainer = $this.find('.ml-works-slider__container');
            $modalWorksSliderContainer.addClass('swiper');
            $this.find('.ml-works-slider__list').addClass('swiper-wrapper');
            //$this.find('.ml-works-slider__item').addClass('swiper-slide');            
            $items = $this.find('.ml-works-slider__item');
            $items.addClass('swiper-slide');
            // $this.append("<div class='ml-slider-pagination'></div>");
            $this.append(
                '<div class="ml-slider-arrows">' +
                '<button type="button" class="ml-slider-arrow ml-slider-arrow_prev">' +
                '<svg class="icon icon-arrowLeft">' +
                '<use xlink:href="#arrowLeft"></use>' +
                '</svg>' +
                '</button>' +
                '<button type="button" class="ml-slider-arrow ml-slider-arrow_next">' +
                '<svg class="icon icon-arrowRight">' +
                '<use xlink:href="#arrowRight"></use>' +
                '</svg>' +
                '</button>' +
                '</div>'
            );

            modalWorksSliderArr[i] = new Swiper($modalWorksSliderContainer[0], {
                spaceBetween: 40,
                speed: 800,
                slidesPerView: 1,
                autoHeight: true,
                navigation: {
                    nextEl: $this.find(".ml-slider-arrow_next")[0],
                    prevEl: $this.find(".ml-slider-arrow_prev")[0],
                },
                // pagination: {
                // 	el: $this.find('.ml-slider-pagination')[0],
                // 	clickable: true,
                // }
            });

            /* Прокрутка слайдера --> */
            modalWorksSliderArr[i].on('slideChange', function () {
                //console.log('slide changed');
                const index_currentSlide = modalWorksSliderArr[i].realIndex;
                const currentSlide = modalWorksSliderArr[i].slides[index_currentSlide];
                const id = $(currentSlide).attr('data-elid');
                //const id = $item.attr('data-elid');    
                //alert(id);
                //$('#CUR_WORK_ELEMENT_ID').val(id);
            });
            /* <-- Прокрутка слайдера */

            /* Нажатие на работу --> */
            $items.each(function (j) {
                var id = $(this).attr('data-elid');
                var slide_ind_str = $(this).attr('data-slideind');
                var slide_ind = Number(slide_ind_str) - 1;

                $('#work_tile_' + id).on('click', function () {
                    //alert(slide_ind);
                    modalWorksSliderArr[i].slideTo(slide_ind, 0, false);
                    //$('#CUR_WORK_ELEMENT_ID').val(id);
                });
            });
            /* <-- Нажатие на работу */
        });
    }
}
/* <-- Слайдер */