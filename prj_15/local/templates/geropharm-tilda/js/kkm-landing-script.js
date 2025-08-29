/* KKM REVIEWS SLIDER */
$(InitKKMReviewsSlider);
function InitKKMReviewsSlider() {
    var $slider = $('.dp-kkm-reviews-section');
    if ($slider.length > 0) {
        $slider.each(function (i) {
            var $sliderBlock = $(this);
            var $sliderContainer = $sliderBlock.find('.dp-kkm-reviews-list');
            $sliderContainer.removeClass('dp-kkm-reviews-list').addClass('swiper-container');
            $sliderContainer.html('<div class="swiper-wrapper">' + $sliderContainer.html() + '</div>');
            $sliderContainer.find('.dp-kkm-reviews-item').removeClass('dp-kkm-reviews-item').addClass('swiper-slide');
            $sliderBlock.find('.dp-section__header').append(
                '<div class="dp-slider-arrows">' +
                '<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
                '<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-left"></use></svg>' +
                '</button>' +
                '<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
                '<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-right"></use></svg>' +
                '</button>' +
                '</div>'
            );
            var sw = new Swiper($sliderContainer[0], {
                spaceBetween: 8,
                speed: 300,
                slidesPerView: 1,
                slidesPerGroup: 1,
                navigation: {
                    nextEl: $sliderBlock.find(".dp-slider-arrow_next")[0],
                    prevEl: $sliderBlock.find(".dp-slider-arrow_prev")[0],
                },
                breakpoints: {
                    768: {
                        slidesPerView: 'auto'
                    },
                    1201: {
                        slidesPerView: 3,
                        spaceBetween: 12,
                    }
                }
            })
        });
    }
}

/* KKM FAQ */
$(document).on('click', '.dp-faq-item__head', function (e) {
    e.preventDefault();
    $(this).closest('.dp-faq-item').toggleClass('active')
});

/* ANCHORS */
$(document).on('click', '[data-scroll-to]', function () {
    scrollToTarget($(this).attr('data-scroll-to'));
});

/* REVIEWS MODALS */
$(document).on('click', '.dp-kkm-review__btn[data-modal]', function (e) {
    e.preventDefault();

    var id = $(this).data('id');
    if (Number( id ) > 0) {
        $('.js_review_full_name').html($('#js_review_full_name_' + id).html());
        $('.js_review_full_about').html($('#js_review_full_about_' + id).html());
        $('.js_review_full_text').html($('#js_review_full_text_' + id).html());
    }

    var $body = $("body");

    var _ = this;
    var $_ = $(this);
    var modalSelector;

    if ($_.is("a")) {
        if ($_.data("modal").length > 1) {
            modalSelector = $_.data("modal");
        }
        else {
            modalSelector = $_.attr("href");
        }
    }
    else {
        modalSelector = $_.data("modal");
    }

    if (typeof modalSelector === "undefined"
        || modalSelector === ""
        || modalSelector === "#"
        || modalSelector === "javascript:;"
        || modalSelector === "javascript:void(0);"
    ) {
        return false;
    }

    var paddingRight = window.innerWidth - document.body.clientWidth;

    $modal = $(modalSelector);
    if ($modal.length) {
        var $activeModals = $('.dp-modal_active');
        if ($activeModals.length) {
            $activeModals.fadeOut(0, function () {
                // $modal.addClass("dp-modal_active").fadeIn(300);
                if ($modal.hasClass('dp-modal-main-menu-simple')) {
                    $modal.removeClass('.dp-modal-main-menu-simple');
                }
                $modal.addClass("dp-modal_active").show();
            });
        }
        else {
            $body.addClass("overflow-hidden");
            $body.css("padding-right", paddingRight + "px");
            $modal.addClass("dp-modal_active").fadeIn(300);
        }
    }
    else {

        var request = $.ajax({
            url: "/ajax/modals/" + modalSelector.replace('#', '') + '.html',
            type: "POST",
            data: {
                id: modalSelector.replace('#', '')
            },
            dataType: "html"
        });
        request.fail(function (jqXHR, textStatus) {
            // console.log('Форма не найдена');
        });
        request.statusCode(function (errorCode) {
            // console.log('Произошла ошибка');
        });
        request.done(function (msg) {
            // console.log(msg);

            $('.dp-modals').append(msg);
            $modal = $(modalSelector);
            $body.addClass("overflow-hidden");
            $body.css("padding-right", paddingRight + "px");
            var $activeModals = $('.dp-modal_active');
            if ($activeModals.length) {
                $activeModals.fadeOut(0, function () {
                    if ($modal.hasClass('dp-modal-main-menu-simple')) {
                        $modal.removeClass('.dp-modal-main-menu-simple');
                    }
                    $modal.addClass("dp-modal_active").fadeIn(300);
                });
            }
            else {
                $modal.addClass("dp-modal_active").fadeIn(300);
            }

        });

    }
});

/* MASK EMAIL */
/*$(function () {
    $('input.js-email').each(function () {
        $(this).inputmask({
            "mask": "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
            showMaskOnHover: false,
            showMaskOnFocus: true,
        });
    });
});*/

/* AUTHORS */
$(function () {
   var $authorsSections = $('.dp-kkm-authors-section');
   if ($authorsSections.length > 0) {
       
       $authorsSections.each(function () {
           var $cs = $(this);
           var $csTitle = $cs.find('.dp-section__title');
           var $csDesc = $cs.find('.dp-section__desc');
           var $csMainItem = $cs.find('.dp-kkm-authors-item_main');
           
           if ($csTitle.length === 1 && $csDesc.length === 1 && $csMainItem.length > 0) {
               
               if (window.matchMedia('(max-width: 767px)').matches) {
                   $csMainItem.eq(0).prepend($csDesc);
                   $csMainItem.eq(0).prepend($csTitle);
               }
               
           }
       });
   }
});

/* CONSULTING APPLICATION FORM */
$(function () {
	var $consultForm = $('.dp-consulting-application-form');
	if ($consultForm.length > 0) {
		$consultForm.each(function () {
			var $cForm = $(this);
			formProccessRealtime($cForm[0]);
			var $submitBtn = $cForm.find('.dp-form__submit');
			$submitBtn.on('click', function (e) {
				if (!validateForm($cForm[0], true)) {
					e.preventDefault();
				} else {
					if (window.location.hostname === 'gerofarm.indadev.ru' || window.location.hostname === 'localhost') {
						alert('Отправка формы через ajax на сервер после успешной валидации на фронте. На сервере значения полей дополнительно проверяем. Если все хорошо, то выполняем определенные действия. Если нужно очистить все поля формы, то используем функцию clearFormFields(form).');
					}
					else {
						$form.find("[name='USER_LOGIN']").removeAttr('disabled');
					}
				}
			});
		});
	}
});