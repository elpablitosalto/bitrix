function touchScreenDetect() {
	return ( 'ontouchstart' in window ) || ( navigator.maxTouchPoints > 0 ) || ( navigator.msMaxTouchPoints > 0 );
}
var isTouch = touchScreenDetect();

/**
 * Он устанавливает пользовательскую переменную CSS в значение 1% от высоты окна просмотра.
 *//*
const setViewportProperty = (doc) => {
	const customViewportCorrectionVariable = "vh";
	let prevClientHeight;
	const customVar = "--" + (customViewportCorrectionVariable || "vh");

	const handleResize = () => {
		const clientHeight = doc.clientHeight;
		if (clientHeight === prevClientHeight) return;
		requestAnimationFrame(function updateViewportHeight() {
			doc.style.setProperty(customVar, `${clientHeight * 0.01}px`);
			console.log(`${clientHeight * 0.01}px`);
			console.log(clientHeight);
			prevClientHeight = clientHeight;
		});
	};
	handleResize();
	return handleResize;
};

setTimeout(function() {setViewportProperty(document.documentElement);}, 500);
window.addEventListener("resize load", setViewportProperty(document.documentElement));
 */

$(document).ready(function () {

	var $body = $('body');

	$.get($body.data('svg-sprite'), function(data) {

		var sprite = new XMLSerializer().serializeToString(data.documentElement);
		var $sprite = $(sprite);
		var dataSvgIcons = $body.data('svg-icons');

		if (typeof dataSvgIcons !== 'undefined' && dataSvgIcons !== '') {
			var spriteWrapper = document.createElement('div');
			var $spriteWrapper = $(spriteWrapper);
			$spriteWrapper.css({
				position: 'absolute',
				width: 0,
				height: 0,
				overflow: 'hidden'
			});
			if ($body.data('svg-icons') !== 'all') {
				var iconList = $body.data('svg-icons').split(',');
				if (iconList.length > 0) {
					var $spriteFiltered = $sprite.clone();
					$sprite.empty();
					for(var i = 0; i < iconList.length; i++) {
						$sprite.append($spriteFiltered.find('#' + iconList[i])[0]);
					}
				}
			}
			spriteWrapper.append($sprite[0]);
			$body.prepend(spriteWrapper);
		}

	});

	// tabBtnNav();
	// pageMenu();
	modals();

	// var $inputTel = $('input[type="tel"]');
	// if ($inputTel.length) {
	// 	$inputTel.inputmask({"mask": "+7 (999) 999-9999"});
	// }

	var $select = $('.dp-order-detail-good__prop-select');
	if ( $select.length) {
		$select.selectric();
	}


	$('.ml-btn_submit').on('click', function (e) {
		e.preventDefault();
		var $submit = $(this);
		var $form = $submit.closest('form');
		if (validateForm($form[0])) {
			// $form.find('.syr-form-step__error').empty();
			if ($submit.hasClass('ml-btn_anim-submit')) {
				animSubmitBtn($submit[0], 'proccessing');
				setTimeout(function () {
					animSubmitBtn($submit[0], 'complete');
					setTimeout(function () {
						animSubmitBtn($submit[0], 'start');
						// clearForm($form[0]);
						modalFormProccess();
					}, 2000);
				}, 1500);
			}
			else {
				modalFormProccess();
			}

		}
		function modalFormProccess() {
			var $modal = $form.closest('.ml-modal');
			if ($modal.length) {
				var $modalSuccess = $('#' + $modal[0].id + '-success');
				if ($modalSuccess.length) {
					$modal.fadeOut(200, function () {
						clearForm($form[0]);
						$modalSuccess.fadeIn(300);
					});
				}
			}
			else {
				clearForm($form[0]);
			}
		}
	});

	$('.ml-sidebar-menu__title').on('click', function (e) {

		if ($(window).width() < 768) {
			e.preventDefault();
			var $this = $(this);
			var $sidebarMenu = $this.parent('.ml-sidebar-menu');
			var $sidebarMenuList = $this.next('.ml-sidebar-menu__list');
			if ($sidebarMenu.hasClass('ml-sidebar-menu_open')) {
				$sidebarMenu.removeClass('ml-sidebar-menu_open');
				$sidebarMenuList.slideUp(300, function () {
					$(this).removeAttr('style');
				});
			}
			else {
				$sidebarMenu.addClass('ml-sidebar-menu_open');
				$sidebarMenuList.slideDown(300);
			}
		}

	});

	$('.ml-live__toggle-btn').on('click', function () {
		var $liveContainer = $(this).closest('.ml-live');
		var $liveBody = $liveContainer.children('.ml-live__body');
		if ($liveContainer.hasClass('ml-live_show')) {
			$liveContainer.removeClass('ml-live_show');
			$liveBody.slideUp(300);
		}
		else {
			$liveContainer.addClass('ml-live_show');
			$liveBody.slideDown(300);
		}
	});

	$('.filter-clear-btn').on('click', function () {
		var $this= $(this);
		var $section = $this.closest('.filter-section-checked');
		var $checkedList = $section.children('.filter-checked-list');
		var $checkedItems = $checkedList.children('.filter-checked-item');
		$checkedItems.each(function () {
			var $this =$(this);
			$('#' + $this.data('filter-item')).prop('checked', false).removeAttr('checked');
			$this.remove();
		});
		$section.removeClass('filter-section-checked_active');
	});

	$('.filter-checked-item__clear').on('click', function () {
		var $this = $(this);

		var filterItemId = $this.data('filter-item');
		var $checkedItem = $this.closest('.filter-checked-item');
		$('#' + filterItemId).prop('checked', false).removeAttr('checked');
		$checkedItem.remove();

		var $section = $this.closest('.filter-section-checked');
		var $checkedList = $section.children('.filter-checked-list');
		var $checkedItems = $checkedList.children('.filter-checked-item');

		// $checkedItems.each(function () {
		// 	var $this = $(this);
		// 	$('#' + $this.data('filter-item')).prop('checked', false).removeAttr('checked');
		// 	$this.remove();
		// });
		// $section.removeClass('filter-section-checked_active');
	});

	var $sortSelect = $('.ml-form-sort select');
	if ($sortSelect.length) {
		$sortSelect.selectric();
	}

	// NB

	header();
	topBannerSectionSlider();
	servicesLinksMenu();
	advantagesSection();
	implantologySliders();
	prostheticsSliders();
	doctorsSlider();
	doctorsTwoRowSlider();
	reviews();
	clinicSlider();
	certificatesSlider();
	licensesSlider();
	stagesSection();

	stages();
	stockSlide();
	sectionContact();
	mapMobile();

	// DROPDOWN MENU EVENTS

	$body.on('click', '.dp-dropdown__header', function () {
		var $this = $(this);
		var $dropdown = $this.closest('.dp-dropdown');
		var $dropdownBody = $dropdown.find('.dp-dropdown__body');
		if ($dropdown.hasClass('dp-dropdown_opened')) {
			$dropdown.removeClass('dp-dropdown_opened');
			$dropdownBody.slideUp(300, function () {
				$(this).removeAttr('style');
			});
		}
		else {
			$dropdown.addClass('dp-dropdown_opened');
			$dropdownBody.slideDown(300);
		}
	});
	$body.on('change', '.dp-dropdown__input', function () {
		var $this = $(this);
		var $dropdown = $this.closest('.dp-dropdown');
		var $dropdownBody = $dropdown.find('.dp-dropdown__body');
		var $dropdownLabel = $this.next('.dp-dropdown__label');
		var $dropdownTitle = $dropdown.find('.dp-dropdown__title');
		$dropdownTitle.text($dropdownLabel.text());
		if ($dropdown.hasClass('dp-dropdown_opened')) {
			$dropdown.removeClass('dp-dropdown_opened');
			$dropdownBody.hide(0, function () {
				$(this).removeAttr('style');
			});
		}
	});

	$('.dp-ancor-menu__link').on('click', function () {
		var id = $(this).attr('href');
		scrollToTarget(id);
	});

	var $nbConsultationFormInput = $('.dp-consultation-form input, .dp-modal-call-form input');
	if ($nbConsultationFormInput.length) {
		$nbConsultationFormInput.on('change', function () {
			var $this = $(this);
			$val = $this.val();
			$label = $this.next('label');
			if ($val.length > 0) {
				$label.removeClass('dp-label-mobile-show');
			}
			else {
				$label.addClass('dp-label-mobile-show');
			}
		});
		$nbConsultationFormInput.each(function () {
			var $this = $(this);
			$val = $this.val();
			$label = $this.next('label');
			if ($val.length > 0) {
				$label.removeClass('dp-label-mobile-show');
			}
			else {
				$label.addClass('dp-label-mobile-show');
			}
		});
	}
});

// SCROLL TO ANCHOR SECTION
function scrollToTarget(target) {
	var $target = $(target);
	if ($target.length) {
		var offsetTop = $target.offset().top;
		$('html, body').animate({ scrollTop: offsetTop }, 800, 'swing');
		return true;
	}
	else {
		return false;
	}
}

function header() {

	var $body = $('body');

	$('.dp-header-search-form__submit').on('click', function (e) {
		var $this = $(this);
		var $body = $('body');
		var width = $(window).width();
		if (width < 992 && !$body.hasClass('dp-header-search-show')) {
			e.preventDefault();
			$body.addClass('dp-header-search-show');
			$this.siblings('.dp-header-search-form__input').trigger('focus');
		}

	});

	$('.dp-header-toggle-btn').on('click', function (e) {
		e.preventDefault();
		var $body = $('body');
		var $mobileMenu = $('.dp-header-dropdown');
		if (!$body.hasClass('dp-header-mobile-menu-active')) {
			$body.addClass('dp-header-mobile-menu-active');
			$mobileMenu.slideDown(300);
		}
		else {
			$body.removeClass('dp-header-mobile-menu-active');
			$mobileMenu.slideUp(300);
		}
	});

	$body.on('click', function () {
		var width = $(window).width();
		if ($body.hasClass('dp-header-search-show')) {
			$body.removeClass('dp-header-search-show');
		}
		if ($body.hasClass('dp-header-mobile-menu-active')) {
			$body.removeClass('dp-header-mobile-menu-active');
			if (width < 992) {
				var $mobileMenu = $('.dp-header-dropdown');
				$mobileMenu.slideUp(300);
			}
		}
	});

	$('.dp-header, .dp-header-dropdown').on('click', function (e) {
		e.stopPropagation();
	});

	$(window).on('resize', function () {
		var $body = $('body');
		var width = $(window).width();
		if (width >= 992) {
			if ($body.hasClass('dp-header-search-show')) {
				$body.removeClass('dp-header-search-show');
			}
			if ($body.hasClass('dp-header-mobile-menu-active')) {
				$body.removeClass('dp-header-mobile-menu-active');
			}
			var $mobileMenu = $('.dp-header-dropdown');
			if ($mobileMenu.css('display') === 'none') {
				$mobileMenu.removeAttr('style');
			}
		}
	});
}

function tabBtnNav() {

	var $tabBtnNav = $('.ml-tab-btn-nav');
	var tabBtnNavSliderArr = [];
	if ($tabBtnNav.length) {
		$tabBtnNav.each(function (i) {
			var $this = $(this);
			$this.addClass('swiper');
			var $tabBtnNavContainer = $this.find('.ml-tab-btn-nav__container');
			$tabBtnNavContainer.addClass('swiper-container');
			$this.find('.ml-tab-btn-nav__list').addClass('swiper-wrapper');
			$this.find('.ml-tab-btn-nav__item').addClass('swiper-slide');
			// tabBtnNavSliderArr[i] = new Swiper($tabBtnNav[i], {
			tabBtnNavSliderArr[i] = new Swiper($tabBtnNavContainer[0], {
				spaceBetween: 0,
				slidesPerView: 'auto',
				freeMode: true
			});

		});
	}

}

function pageMenu() {

	var $sectionMenu = $('.ml-page-menu');
	var sectionMenuSliderArr = [];
	if ($sectionMenu.length) {
		$sectionMenu.each(function (i) {
			var $this = $(this);
			$this.addClass('swiper');
			$this.find('.ml-page-menu__list').addClass('swiper-wrapper');
			$this.find('.ml-page-menu__item').addClass('swiper-slide');
			// $this.append(
			// 	'<div class="page-menu-slider-arrows">' +
			// 	'<button type="button" class="page-menu-slider-arrow page-menu-slider-arrow_prev"></button>' +
			// 	'<button type="button" class="page-menu-slider-arrow page-menu-slider-arrow_next"></button>' +
			// 	'</div>'
			// );
			sectionMenuSliderArr[i] = new Swiper($sectionMenu[i], {
				spaceBetween: 0,
				slidesPerView: 'auto',
				freeMode: true,
				// navigation: {
				// 	nextEl: $($sectionMenu[i]).find(".page-menu-slider-arrow_next")[0],
				// 	prevEl: $($sectionMenu[i]).find(".page-menu-slider-arrow_prev")[0],
				// }
			});

		});
	}

}

function modals() {

	var $body = $("body");

	//$body.on("click", "[data-modal]", function (e) {
	$("[data-modal]").on("click", function (e) {
		e.preventDefault();

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

		$modal = $(modalSelector);
		if ($modal.length) {
			$body.addClass("overflow-hidden");
			var $activeModals = $('.ml-modal_active');
			if ($activeModals.length) {
				$activeModals.fadeOut(0, function () {
					$modal.addClass("dp-modal_active").fadeIn(300);
				});
			}
			else {
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
			request.fail(function(jqXHR, textStatus) {
				// console.log('Форма не найдена');
			});
			request.statusCode(function(errorCode) {
				// console.log('Произошла ошибка');
			});
			request.done(function(msg) {
				// console.log(msg);

				$('.dp-modals').append(msg);
				$modal = $(modalSelector);
				$body.addClass("overflow-hidden");
				var $activeModals = $('.dp-modal_active');
				if ($activeModals.length) {
					$activeModals.fadeOut(0, function () {
						$modal.addClass("dp-modal_active").fadeIn(300);
					});
				}
				else {
					$modal.addClass("dp-modal_active").fadeIn(300);
				}

			});

		}

	});

	$body.on("click", ".dp-modal__close, .dp-modal__close-btn, .dp-modal__overlay", function (e) {
		e.preventDefault();
		$(this).closest(".dp-modal").removeClass("dp-modal_active").fadeOut(300, function () {
			$body.removeClass("overflow-hidden");
		});
	});
}

function getRandomInt(max) {
	return Math.floor(Math.random() * max);
}

function getRandomIntInclusive(max) {
	return Math.floor(Math.random() * (max + 1));
}

function animSubmitBtn(button, state) {
	var $button = $(button);
	switch (state) {
		case 'proccessing':
			$button.removeClass('ml-btn_complete').addClass('ml-btn_proccessing');
			$button.text($button.data('proccessing-text'));
			break;
		case 'complete':
			$button.removeClass('ml-btn_proccessing').addClass('ml-btn_complete');
			$button.text($button.data('complete-text'));
			break;
		default:
			$button.removeClass('ml-btn_proccessing').removeClass('ml-btn_complete');
			$button.text($button.data('start-text'));
			break;
	}
}

function clearForm(form) {
	var $form = $(form);
	var $errors = $form.find('.ml-form-error');
	var $fields = $form.find('input, textarea');
	if ($errors.length) {
		$errors.remove();
	}
	$fields.closest('.ml-form-field').removeClass('ml-form-field_error');
	// $(form).find('.ml-form-step__error').empty();
	for(var i = 0; i < $fields.length; i++) {
		var $currentField = $($fields[i]);
		switch ($currentField.attr('type')) {
			case 'checkbox':
				if ($currentField.prop('checked') && !$currentField.closest('.ml-form-field').hasClass('ml-agreement-checkbox')) {
					$currentField.prop('checked', false).removeAttr('checked');
				}
				break;
			default:
				$currentField.val('');
		}
	}
	// var myDropzone = Dropzone.forElement("#mydropzone");
	var $dropzone = $form.find('.ml-dropzone');
	if ($dropzone.length) {
		$dropzone.each(function () {
			dropzone = this.dropzone;
			dropzone.removeAllFiles();
			// console.log(dropzone);
		});
	}

	var $btnSubmit = $form.find('.ml-btn_anim-submit');
	if ($btnSubmit.length) {
		animSubmitBtn($btnSubmit[0], 'start');
	}

}

function validateForm(form) {

	var valid = true;
	var $form = $(form);
	var $reqFields = $form.find('[required]');
	$reqFields.closest('.ml-form-field').removeClass('ml-form-field_error');
	var $errors = $form.find('.ml-form-error');
	// var $fields = $form.find('input, textarea');
	if ($errors.length) {
		$errors.remove();
	}
	// $(form).find('.syr-form-step__error').empty();
	for(var i = 0; i < $reqFields.length; i++) {
		var $currentField = $($reqFields[i]);
		var $fieldWrapper = $currentField.closest('.ml-form-field');
		switch ($currentField.attr('type')) {
			case 'email':
				if ($currentField.val().length < 1) {
					valid = false;
					$fieldWrapper.addClass('ml-form-field_error');
					$fieldWrapper.append('<div class="ml-form-error">Это поле обязательное для заполнения</div>');
				}
				else {
					if (!validateFormEmail($currentField.val())) {
						valid = false;
						if ($currentField.data('error')) {
							$fieldWrapper.append('<div class="ml-form-error">' + $currentField.data('error') + '</div>');
						}
						else {
							$fieldWrapper.append('<div class="ml-form-error">Указан некорректный email</div>');
						}
					}
				}
				break;
			case 'checkbox':
				if (!$currentField.prop('checked')) {
					valid = false;
					$fieldWrapper.addClass('ml-form-field_error');
					if ($currentField.data('error')) {
						$fieldWrapper.append('<div class="ml-form-error">' + $currentField.data('error') + '</div>');
					}
					else {
						$fieldWrapper.append('<div class="ml-form-error">Это поле обязательное для заполнения</div>');
					}
				}
				break;
			default:
				if ($currentField.val().length < 1) {
					valid = false;
					$fieldWrapper.addClass('ml-form-field_error');
					if ($currentField.data('error')) {
						$fieldWrapper.append('<div class="ml-form-error">' + $currentField.data('error') + '</div>');
					}
					else {
						$fieldWrapper.append('<div class="ml-form-error">Это поле обязательное для заполнения</div>');
					}
				}
		}

	}
	var $dropzone = $form.find('.ml-dropzone_required');
	if ($dropzone.length && !$dropzone.hasClass('dz-started')) {
		valid = false;
		$dropzoneParent = $dropzone.parent('.ml-form-field');
		$dropzoneParent.addClass('ml-form-field_error');
		if ($dropzone.data('error')) {
			$dropzoneParent.append('<div class="ml-form-error">' + $dropzone.data('error') + '</div>');
		}
		else {
			$dropzoneParent.append('<div class="ml-form-error">Загрузите изображения</div>');
		}
	}

	if (!valid) {
		// $(form).find('.syr-form-step__error').append('<p>Заполните обязательные поля</p>');
		var $btnSubmit = $form.find('.ml-btn_anim-submit');
		if ($btnSubmit.length) {
			animSubmitBtn($btnSubmit[0], 'start');
		}
	}

	return valid;
}

function validateFormEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}




// NB

function topBannerSectionSlider() {

	var $slider = $('.dp-top-b-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.dp-top-b-slider-container');
			$sliderContainer.addClass('swiper');
			$this.find('.dp-top-b-slider-list').addClass('swiper-wrapper');
			$this.find('.dp-top-b-slider-item').addClass('swiper-slide');
			$this.append("<div class='dp-slider-pagination'></div>");
			$this.append(
				'<div class="dp-slider-arrows">' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'</div>'
			);

			sliderArr[i] = new Swiper($sliderContainer[0], {
				spaceBetween: 0,
				speed: 800,
				slidesPerView: 1,
				effect: 'fade',
				fadeEffect: {
					crossFade: true
				},
				navigation: {
					nextEl: $this.find(".dp-slider-arrow_next")[0],
					prevEl: $this.find(".dp-slider-arrow_prev")[0],
				},
				pagination: {
					el: $this.find('.dp-slider-pagination')[0],
					clickable: true,
				}
			});

		});
	}

}

function reviews(el) {

	var $slider = (typeof el !== 'undefined') ? $(el) : $('.dp-reviews');
	var sliderMainArr = [];
	var sliderThumbsArr = [];
	if ($slider.length) {
		$slider.each(function (i) {

			var $wrapper = $(this);

			var $thumbsSlider = $wrapper.find('.dp-reviews-thumbs');
			var $thumbsSliderContainer = $thumbsSlider.find('.dp-reviews-thumbs__container');
			var $thumbsSliderList = $thumbsSlider.find('.dp-reviews-thumbs__list');

			var $pagination = $wrapper.find('.dp-pagination');
			var $paginationBtn = $pagination.find('.dp-pagination__btn');
			var $paginationCounter = $pagination.find('.dp-pagination__counter');

			$thumbsSliderContainer.addClass('swiper').attr('data-slider-index', i);
			$thumbsSliderList.addClass('swiper-wrapper');
			$thumbsSlider.append("<div class='dp-slider-pagination'></div>");
			// $thumbsSlider.append(
			// 	'<div class="dp-slider-arrows">' +
			// 	'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
			// 	'<svg class="icon icon-slider-arrow">' +
			// 	'<use xlink:href="#slider-arrow"></use>' +
			// 	'</svg>' +
			// 	'</button>' +
			// 	'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
			// 	'<svg class="icon icon-slider-arrow">' +
			// 	'<use xlink:href="#slider-arrow"></use>' +
			// 	'</svg>' +
			// 	'</button>' +
			// 	'</div>'
			// );
			sliderThumbsArr[i] = new Swiper($thumbsSliderContainer[0], {
				spaceBetween: 0,
				speed: 800,
				slidesPerView: 2,
				// initialSlide: 1,
				// autoHeight: true,
				slideClass: 'dp-reviews-thumbs__col',
				loop: true,
				// loopPreventsSliding: false,
				// navigation: {
				// 	nextEl: $thumbsSlider.find(".dp-slider-arrow_next")[0],
				// 	prevEl: $thumbsSlider.find(".dp-slider-arrow_prev")[0],
				// },
				pagination: {
					el: $thumbsSlider.find('.dp-slider-pagination')[0],
					clickable: true,
				}
			});


			var $mainSlider = $wrapper.find('.dp-reviews-main');
			var $mainSliderContainer = $mainSlider.find('.dp-reviews-main__container');
			var $mainSliderList = $mainSlider.find('.dp-reviews-main__list');

			$mainSliderContainer.addClass('swiper').attr('data-slider-index', i);
			$mainSliderList.addClass('swiper-wrapper');
			$mainSliderContainer.append("<div class='dp-slider-pagination'></div>");
			$mainSlider.append(
				'<div class="dp-slider-arrows">' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'</div>'
			);
			sliderMainArr[i] = new Swiper($mainSliderContainer[0], {
				spaceBetween: 0,
				speed: 800,
				slidesPerView: 1,
				autoHeight: false,
				slideClass: 'dp-reviews-main__col',
				// loop: true,
				navigation: {
					nextEl: $mainSlider.find(".dp-slider-arrow_next")[0],
					prevEl: $mainSlider.find(".dp-slider-arrow_prev")[0],
				},
				pagination: {
					el: $mainSliderContainer.find('.dp-slider-pagination')[0],
					type: 'fraction',
					renderFraction: function (currentClass, totalClass) {
						return '<span class="' + currentClass + '"></span>&nbsp;из&nbsp;<span class="' + totalClass + '"></span>';
					}
				},
				breakpoints: {
					1: {
						autoHeight: true
					},
					992: {
						autoHeight: false
					}
				},
				// thumbs: {
				// 	swiper: sliderThumbsArr[i],
				// 	// autoScrollOffset: 1
				// }
			});

			var $clickedSliderThumb = $mainSlider.find('.dp-review-main-slider__thumb');
			$clickedSliderThumb.on('click', function () {
				var $this = $(this);
				var $parent = $this.closest('.dp-review-main');
				var $thumbsContainer = $this.parent('.dp-review-main-slider__thumbs-list');
				var $thumbs = $thumbsContainer.children('.dp-review-main-slider__thumb');
				var $desc = $parent.find('.dp-review-main__desc');

				$thumbs.removeClass('dp-review-main-slider__thumb_active');
				$this.addClass('dp-review-main-slider__thumb_active');

				var $thumbActive = $thumbsContainer.children('.dp-review-main-slider__thumb_active');
				var ind = $thumbsContainer.children('.dp-review-main-slider__thumb_active').index();

				var $clickedSlider = $parent.find('.dp-review-main-slider__img');
				var $clickedSliderImg = $clickedSlider.children('img');

				// if (ind === 3) {
				if ($thumbActive.hasClass('dp-review-main-slider__thumb-text')) {
					if ($clickedSliderImg.length && typeof $clickedSliderImg[ind] !== "undefined") {
						$clickedSliderImg.removeClass('active');
					}
					$clickedSlider.hide();
					if ($thumbActive.siblings('.dp-review-main-slider__thumb-before').length || $thumbActive.siblings('.dp-review-main-slider__thumb-after').length) {
						$desc.fadeIn(300, function () {
							sliderMainArr[i].update();
						});
					}
					else {
						$desc.fadeToggle(300, function () {
							sliderMainArr[i].update();
						});
					}
				}
				else {
					if ($clickedSliderImg.length && typeof $clickedSliderImg[ind] !== "undefined") {
						$clickedSliderImg.removeClass('active');
						$($clickedSliderImg[ind]).addClass('active');
					}
					if ($(window).width() < 992) {
						$desc.hide(0, function () {
							sliderMainArr[i].update();
						});
					}
					$clickedSlider.fadeIn(300, function () {
						sliderMainArr[i].update();
					});
				}

				sliderMainArr[i].update();

			});

			sliderMainArr[i].on('slideChange', function (swiper) {
				if (swiper.slides.length <= 3) {
					$paginationCounter.find('span').text(swiper.slides.length);
					$paginationBtn.addClass('dp-btn_disabled');
				}
				else {
					if (swiper.realIndex < (swiper.slides.length - 3)) {
						$paginationCounter.find('span').text(swiper.realIndex + 3);
						if ($paginationBtn.hasClass('dp-btn_disabled')) {
							$paginationBtn.removeClass('dp-btn_disabled');
						}
					}
					else {
						$paginationCounter.find('span').text(swiper.slides.length);
						$paginationBtn.addClass('dp-btn_disabled');
					}
				}
			});
			$paginationBtn.on('click', function (e) {
				e.preventDefault();
				//if (sliderMainArr[i].realIndex < (sliderMainArr[i].slides.length - 3)) {
					sliderMainArr[i].slideNext();
				//}
			});

			rebuildInsideSlider();

			$(window).on('resize', function () {
				rebuildInsideSlider();
			});

			function rebuildInsideSlider() {
				if ($(window).width() < 992) {
					if (!$wrapper.hasClass('dp-reviews_mobile')) {
						$wrapper.addClass('dp-reviews_mobile');
						$clickedSliderThumb.removeClass('dp-review-main-slider__thumb_active');
						$('.dp-review-main-slider__thumb:last-child').addClass('dp-review-main-slider__thumb_active');
						$('.dp-review-main-slider__img').hide().children().removeClass('active');
						// $('.dp-review-main-slider__img img:first-child').addClass('active');
						$('.dp-review-main__desc').show();
					}
				}
				else {
					if ($wrapper.hasClass('dp-reviews_mobile')) {
						$wrapper.removeClass('dp-reviews_mobile');
						$clickedSliderThumb.removeClass('dp-review-main-slider__thumb_active');
						$('.dp-review-main-slider__thumb:first-child').addClass('dp-review-main-slider__thumb_active');
						$('.dp-review-main-slider__img').show().children().removeClass('active');
						$('.dp-review-main-slider__img img:first-child').addClass('active');
						$('.dp-review-main__desc').show();
					}
				}
			}

			sliderMainArr[i].on('realIndexChange', function (swiper) {
				var $thumbsCol = $thumbsSlider.find('.dp-reviews-thumbs__col');
				$thumbsCol.removeClass('dp-reviews-thumbs__col_hide');
				$thumbsCol.eq(swiper.activeIndex).addClass('dp-reviews-thumbs__col_hide');
				// sliderThumbsArr[i].slideTo(swiper.activeIndex);
				sliderThumbsArr[i].slideToLoop(swiper.realIndex);
			});

			$thumbsSlider.find('.dp-reviews-thumbs__col').on('click', function () {
				var ind = +$(this).data('swiper-slide-index');
				sliderMainArr[i].slideTo(ind);
			});

			// $thumbsSlider.on('click', '.dp-slider-arrow_prev', function (e) {
			// 	e.preventDefault();
			// 	$mainSlider.find('.dp-slider-arrow_prev').trigger('click');
			// });
			// $thumbsSlider.on('click', '.dp-slider-arrow_next', function (e) {
			// 	e.preventDefault();
			// 	$mainSlider.find('.dp-slider-arrow_next').trigger('click');
			// });
		});

	}

}

function servicesLinksMenu() {
	$('.dp-services-links-menu__title').on('click', function (e) {
		var $this = $(this);
		if ($(window).width() < 992) {
			e.preventDefault();
			var $openedMenu = $('.dp-services-links-menu_opened');
			var $wrapper = $this.closest('.dp-services-links-menu');
			var $list = $this.next('.dp-services-links-menu__dropdown');
			if (!$wrapper.hasClass('dp-services-links-menu_opened')) {
				if ($openedMenu.length) {
					$openedMenu.removeClass('dp-services-links-menu_opened');
					$openedMenu.find('.dp-services-links-menu__dropdown').css('display', 'block').slideUp(300, function () {
						$list.removeAttr('style');
					});
				}
				$wrapper.addClass('dp-services-links-menu_opened');
				if ($list.length) {
					$list.css('display', 'none').slideDown(300, function () {
						$list.removeAttr('style');
					});
				}
			}
			else {
				$wrapper.removeClass('dp-services-links-menu_opened');
				$list.css('display', 'block').slideUp(300, function () {
					$list.removeAttr('style');
				});
			}
		}
	});
	$(window).on('resize', function () {
		var $servicesLinksDesktop = $('.dp-services-links-menu_desktop');
		var $servicesLinksMenu = $('.dp-services-links-menu');
		var $servicesMenuDropdown = $('.dp-services-links-menu__dropdown');
		if ($(window).width() >= 992) {
			if (!$servicesLinksDesktop.length) {
				if ($servicesLinksMenu.length) {
					$servicesLinksMenu.removeClass('dp-services-links-menu_opened');
					$servicesLinksMenu.addClass('dp-services-links-menu_desktop');
				}
				if ($servicesMenuDropdown.length) {
					$servicesMenuDropdown.removeAttr('style');
				}
			}
		}
		else {
			if ($servicesLinksDesktop.length) {
				$servicesLinksDesktop.removeClass('dp-services-links-menu_desktop');
				if ($servicesLinksMenu.length) {
					$servicesLinksMenu.first().addClass('dp-services-links-menu_opened');
				}
			}
		}
	});
}

function doctorsSlider(el) {

	var $slider = (typeof el !== 'undefined') ? $(el) : $('.dp-doctors-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.dp-doctors__container');

			$sliderContainer.addClass('swiper').attr('data-slider-index', i);
			$this.find('.dp-doctors__list').addClass('swiper-wrapper');
			// $this.find('.dp-doctors__col').addClass('swiper-slide');
			// $this.append("<div class='dp-slider-pagination'></div>");
			$this.append(
				'<div class="dp-slider-arrows">' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'</div>'
			);
			sliderArr[i] = new Swiper($sliderContainer[i], {
				spaceBetween: 0,
				speed: 800,
				slidesPerView: 3,
				// autoHeight: true,
				slideClass: 'dp-doctors__col',
				navigation: {
					nextEl: $this.find(".dp-slider-arrow_next")[0],
					prevEl: $this.find(".dp-slider-arrow_prev")[0],
				},
				pagination: {
					el: $this.find('.dp-slider-pagination')[0],
					clickable: true,
				},
				breakpoints: {
					1: {
						slidesPerView: 1
					},
					576: {
						slidesPerView: 2
					},
					992: {
						slidesPerView: 3
					}
				}
			});

			var slidesCount = $this.find('.dp-doctors__col').length;

			$this.append(
				'<div class="dp-pagination">' +
				'<div class="dp-pagination__inner">' +
				'<div class="dp-pagination__counter"><span class="font-weight_bold">' + sliderArr[i].params.slidesPerView + '</span> из ' + slidesCount + '</div>' +
				'<button class="dp-btn dp-btn_light dp-btn_shadow dp-pagination__btn" type="button">Показать еще</button>' +
				'</div>' +
				'</div>'
			);

			var $paginationBtn = $this.find('.dp-pagination__btn');
			var $paginationCounter = $this.find('.dp-pagination__counter');

			$this.append("<div class='dp-slider-fraction'></div>");
			var $fraction = $this.find('.dp-slider-fraction');
			$fraction.html('<span>1</span> из ' + slidesCount);

			sliderArr[i].on('slideChange', function (swiper) {
				$fraction.html('<span>' + (swiper.realIndex + 1) + '</span> из ' + slidesCount);

				if (swiper.slides.length <= swiper.params.slidesPerView) {
					$paginationCounter.find('span').text(swiper.slides.length);
					$paginationBtn.addClass('dp-btn_disabled');
				}
				else {
					if ((swiper.realIndex + swiper.params.slidesPerView - 1) < (swiper.slides.length - 1)) {
						$paginationCounter.find('span').text(swiper.realIndex + swiper.params.slidesPerView);
						if ($paginationBtn.hasClass('dp-btn_disabled')) {
							$paginationBtn.removeClass('dp-btn_disabled');
						}
					}
					else {
						$paginationCounter.find('span').text(swiper.slides.length);
						$paginationBtn.addClass('dp-btn_disabled');
					}
				}
			});

			$(window).on('resize', function () {
				if (sliderArr[i].slides.length <= sliderArr[i].params.slidesPerView) {
					$paginationCounter.find('span').text(sliderArr[i].slides.length);
					$paginationBtn.addClass('dp-btn_disabled');
				}
				else {
					if ((sliderArr[i].realIndex + sliderArr[i].params.slidesPerView - 1) < (sliderArr[i].slides.length - 1)) {
						$paginationCounter.find('span').text(sliderArr[i].realIndex + sliderArr[i].params.slidesPerView);
						if ($paginationBtn.hasClass('dp-btn_disabled')) {
							$paginationBtn.removeClass('dp-btn_disabled');
						}
					}
					else {
						$paginationCounter.find('span').text(sliderArr[i].slides.length);
						$paginationBtn.addClass('dp-btn_disabled');
					}
				}
			});

			$paginationBtn.on('click', function (e) {
				e.preventDefault();
				sliderArr[i].slideNext();
			});

			window.doctorSlidersMobile = sliderArr;

		});
	}

}

function doctorsTwoRowSlider(slider, thumbs) {

	var $slider = (typeof slider !== 'undefined') ? $(slider) : $('.dp-doctors-main-slider');
	var $thumbs = (typeof thumbs !== 'undefined') ? $(thumbs) : $('.dp-doctors-thumbs-slider');
	var sliderMainArr = [];
	var sliderThumbsArr = [];

	if ($slider.length) {
		$slider.each(function (i) {

			var $mainSlider = $(this);
			var $mainSliderContainer = $mainSlider.find('.dp-doctors__container');
			var $mainSliderList = $mainSlider.find('.dp-doctors__list');

			var $pagination = $mainSlider.closest('.dp-section__body').find('.dp-pagination');
			var $paginationBtn = $pagination.find('.dp-pagination__btn');
			var $paginationCounter = $pagination.find('.dp-pagination__counter');

			$mainSliderContainer.addClass('swiper').attr('data-slider-index', i);
			$mainSliderList.addClass('swiper-wrapper');
			$mainSliderContainer.append("<div class='dp-slider-pagination'></div>");
			$mainSlider.append(
				'<div class="dp-slider-arrows">' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'</div>'
			);
			sliderMainArr[i] = new Swiper($mainSliderContainer[0], {
				spaceBetween: 0,
				speed: 1200,
				slidesPerView: 1,
				// autoHeight: true,
				slideClass: 'dp-doctors__col',
				navigation: {
					nextEl: $mainSlider.find(".dp-slider-arrow_next")[0],
					prevEl: $mainSlider.find(".dp-slider-arrow_prev")[0],
				},
				pagination: {
					el: $mainSliderContainer.find('.dp-slider-pagination')[0],
					type: 'fraction',
					renderFraction: function (currentClass, totalClass) {
						return '<span class="' + currentClass + '"></span>&nbsp;из&nbsp;<span class="' + totalClass + '"></span>';
					}
				},
				// thumbs: {
				// 	swiper: (typeof sliderThumbsArr[i] !== 'undefined') ? sliderThumbsArr[i] : null,
				// 	// autoScrollOffset: 1
				// }
			});

			sliderMainArr[i].on('slideChange', function (swiper) {
				if (swiper.slides.length <= 3) {
					$paginationCounter.find('span').text(swiper.slides.length);
					$paginationBtn.addClass('dp-btn_disabled');
				}
				else {
					if (swiper.realIndex < (swiper.slides.length - 3)) {
						$paginationCounter.find('span').text(swiper.realIndex + 3);
						if ($paginationBtn.hasClass('dp-btn_disabled')) {
							$paginationBtn.removeClass('dp-btn_disabled');
						}
					}
					else {
						$paginationCounter.find('span').text(swiper.slides.length);
						$paginationBtn.addClass('dp-btn_disabled');
					}
				}
			});
			$paginationBtn.on('click', function (e) {
				e.preventDefault();
				sliderMainArr[i].slideNext();
			});
		});
	}

	if ($thumbs.length) {
		$thumbs.each(function (i) {

			var $thumbsSlider = $(this);
			var $thumbsSliderContainer = $thumbsSlider.find('.dp-doctors__container');
			var $thumbsSliderList = $thumbsSlider.find('.dp-doctors__list');

			$thumbsSliderContainer.addClass('swiper').attr('data-slider-index', i);
			$thumbsSliderList.addClass('swiper-wrapper');
			$thumbsSlider.append("<div class='dp-slider-pagination'></div>");
			// $thumbsSlider.append(
			// 	'<div class="dp-slider-arrows">' +
			// 	'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
			// 	'<svg class="icon icon-slider-arrow">' +
			// 	'<use xlink:href="#slider-arrow"></use>' +
			// 	'</svg>' +
			// 	'</button>' +
			// 	'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
			// 	'<svg class="icon icon-slider-arrow">' +
			// 	'<use xlink:href="#slider-arrow"></use>' +
			// 	'</svg>' +
			// 	'</button>' +
			// 	'</div>'
			// );
			sliderThumbsArr[i] = new Swiper($thumbsSliderContainer[0], {
				spaceBetween: 0,
				speed: 1200,
				slidesPerView: 2,
				// autoHeight: true,
				slideClass: 'dp-doctors__col',
				loop: true,
				// navigation: {
				// 	nextEl: $thumbsSlider.find(".dp-slider-arrow_next")[0],
				// 	prevEl: $thumbsSlider.find(".dp-slider-arrow_prev")[0],
				// },
				pagination: {
					el: $thumbsSlider.find('.dp-slider-pagination')[0],
					clickable: true,
				}
			});

			sliderMainArr[i].on('realIndexChange', function (swiper) {
				var $thumbsCol = $thumbsSlider.find('.dp-doctors__col');
				// $thumbsCol.removeClass('dp-doctors__col_hide');
				// $thumbsCol.eq(swiper.activeIndex).addClass('dp-doctors__col_hide');
				// sliderThumbsArr[i].slideTo(swiper.activeIndex);
				sliderThumbsArr[i].slideToLoop(swiper.realIndex);
			});

			$thumbsSlider.find('.dp-doctors__col').on('click', function () {
				var ind = +$(this).data('swiper-slide-index');
				sliderMainArr[i].slideTo(ind);
			});

		});
	}

}

function advantagesSection() {

	var $slider = $('.dp-advantages');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.dp-advantages__container');
			if ($(window).width() < 768) {
				$sliderContainer.addClass('swiper');
				$this.find('.dp-advantages__list').addClass('swiper-wrapper');
				$this.find('.dp-advantages__col').addClass('swiper-slide');
				$this.append("<div class='dp-slider-pagination'></div>");
				$this.append(
					'<div class="dp-slider-arrows">' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow">' +
					'<use xlink:href="#slider-arrow"></use>' +
					'</svg>' +
					'</button>' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
					'<svg class="icon icon-slider-arrow">' +
					'<use xlink:href="#slider-arrow"></use>' +
					'</svg>' +
					'</button>' +
					'</div>'
				);
				sliderArr[i] = new Swiper($sliderContainer[i], {
					spaceBetween: 0,
					speed: 800,
					slidesPerView: 1,
					// autoHeight: true,
					navigation: {
						nextEl: $this.find(".dp-slider-arrow_next")[0],
						prevEl: $this.find(".dp-slider-arrow_prev")[0],
					},
					pagination: {
						el: $this.find('.dp-slider-pagination')[0],
						clickable: true,
					},
					breakpoints: {
						1: {
							slidesPerView: 1
						},
						576: {
							slidesPerView: 2
						}
					}
				});
				$this.append("<div class='dp-slider-fraction'></div>");
				var $fraction = $this.find('.dp-slider-fraction');
				var slidesCount = $this.find('.swiper-slide').length;
				$fraction.html('<span>1</span> из ' + slidesCount);
				sliderArr[i].on('slideChange', function (swiper) {
					$fraction.html('<span>' + (swiper.realIndex + 1) + '</span> из ' + slidesCount);
				});
			}

			$(window).on('resize', function () {
				if ($(window).width() < 768) {
					if (!$sliderContainer.hasClass('swiper-initialized')) {
						$sliderContainer.addClass('swiper');
						$this.find('.dp-advantages__list').addClass('swiper-wrapper');
						$this.find('.dp-advantages__col').addClass('swiper-slide');
						$this.append("<div class='dp-slider-pagination'></div>");
						$this.append(
							'<div class="dp-slider-arrows">' +
							'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
							'<svg class="icon icon-slider-arrow">' +
							'<use xlink:href="#slider-arrow"></use>' +
							'</svg>' +
							'</button>' +
							'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
							'<svg class="icon icon-slider-arrow">' +
							'<use xlink:href="#slider-arrow"></use>' +
							'</svg>' +
							'</button>' +
							'</div>'
						);
						sliderArr[i] = new Swiper($sliderContainer[i], {
							spaceBetween: 0,
							speed: 800,
							slidesPerView: 1,
							// autoHeight: true,
							navigation: {
								nextEl: $this.find('.dp-slider-arrow_next')[0],
								prevEl: $this.find('.dp-slider-arrow_prev')[0],
							},
							pagination: {
								el: $this.find('.dp-slider-pagination')[0],
								clickable: true,
							},
							breakpoints: {
								1: {
									slidesPerView: 1
								},
								576: {
									slidesPerView: 2
								}
							}
						});
						$this.append("<div class='dp-slider-fraction'></div>");
						var $fraction = $this.find('.dp-slider-fraction');
						var slidesCount =  $this.find('.swiper-slide').length;
						$fraction.html('<span>1</span> из ' + slidesCount);
						sliderArr[i].on('slideChange', function (swiper) {
							$fraction.html('<span>' + (swiper.realIndex + 1) + '</span> из ' + slidesCount);
						});
					}
				}
				else{
					if (typeof sliderArr[i] !== 'undefined' && $sliderContainer.hasClass('swiper-initialized')) {

						sliderArr[i].destroy();
						$sliderContainer.removeClass('swiper');
						$this.find('.dp-advantages__list').removeClass('swiper-wrapper');
						$this.find('.dp-advantages__col').removeClass('swiper-slide');
						$this.find('.dp-slider-pagination').remove();
						$this.find('.dp-slider-fraction').remove();
						$this.find('.dp-slider-arrows').remove();
					}
				}
			});

		});
	}

}

function clinicSlider() {

	var $slider = $('.dp-clinic-gallery');
	var sliderMainArr = [];
	var sliderThumbsArr = [];
	if ($slider.length) {
		$slider.each(function (i) {

			var $wrapper = $(this);

			var $thumbsSlider = $wrapper.find('.dp-clinic-gallery-desc');
			var $thumbsSliderContainer = $thumbsSlider.find('.dp-clinic-gallery-desc__container');
			var $thumbsSliderList = $thumbsSlider.find('.dp-clinic-gallery-desc__list');

			$thumbsSliderContainer.addClass('swiper').attr('data-slider-index', i);
			$thumbsSliderList.addClass('swiper-wrapper');
			$thumbsSlider.append("<div class='dp-slider-pagination'></div>");
			// $thumbsSlider.append(
			// 	'<div class="dp-slider-arrows">' +
			// 	'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
			// 	'<svg class="icon icon-slider-arrow">' +
			// 	'<use xlink:href="#slider-arrow"></use>' +
			// 	'</svg>' +
			// 	'</button>' +
			// 	'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
			// 	'<svg class="icon icon-slider-arrow">' +
			// 	'<use xlink:href="#slider-arrow"></use>' +
			// 	'</svg>' +
			// 	'</button>' +
			// 	'</div>'
			// );
			sliderThumbsArr[i] = new Swiper($thumbsSliderContainer[0], {
				spaceBetween: 0,
				speed: 400,
				slidesPerView: 1,
				// autoHeight: true,
				slideClass: 'dp-clinic-gallery-desc__item',
				autoHeight: true,
				effect: 'fade',
				fadeEffect: {
					crossFade: true
				},
				allowTouchMove: false,
				// loop: true,
				// navigation: {
				// 	nextEl: $thumbsSlider.find(".dp-slider-arrow_next")[0],
				// 	prevEl: $thumbsSlider.find(".dp-slider-arrow_prev")[0],
				// },
				pagination: {
					el: $thumbsSlider.find('.dp-slider-pagination')[0],
					clickable: true,
				}
			});

			var $mainSlider = $wrapper.find('.dp-clinic-gallery-slider');
			var $mainSliderContainer = $mainSlider.find('.dp-clinic-gallery-slider__container');
			var $mainSliderList = $mainSlider.find('.dp-clinic-gallery-slider__list');

			$mainSliderContainer.addClass('swiper').attr('data-slider-index', i);
			$mainSliderList.addClass('swiper-wrapper');
			$mainSliderContainer.append("<div class='dp-slider-pagination'></div>");
			$mainSlider.append(
				'<div class="dp-slider-arrows">' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'</div>'
			);
			sliderMainArr[i] = new Swiper($mainSliderContainer[0], {
				spaceBetween: 0,
				speed: 800,
				slidesPerView: 3,
				centeredSlides: true,
				loop: true,
				// autoHeight: true,
				slideClass: 'dp-clinic-gallery-slider__col',
				navigation: {
					nextEl: $mainSlider.find(".dp-slider-arrow_next")[0],
					prevEl: $mainSlider.find(".dp-slider-arrow_prev")[0],
				},
				pagination: {
					el: $mainSliderContainer.find('.dp-slider-pagination')[0],
					// type: 'bullets',
					clickable: true,
					// type: 'fraction',
					// renderFraction: function (currentClass, totalClass) {
					// 	return '<span class="' + currentClass + '"></span>&nbsp;из&nbsp;<span class="' + totalClass + '"></span>';
					// }
				},
				breakpoints: {
					1: {
						slidesPerView: 1
					},
					768: {
						slidesPerView: 3
					}
				},
				thumbs: {
					swiper: sliderThumbsArr[i],
					// autoScrollOffset: 1
				}
			});

		});
	}

}

function implantologySliders() {

	var $slider = $('.dp-implantology-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderMenu = $this.find('.dp-implantology-menu');
			var $sliderMenuItem = $sliderMenu.find('.dp-implantology-menu__item');
			var $sliderContainer = $this.find('.dp-implantology-slider__container');
			$sliderContainer.addClass('swiper');
			$this.find('.dp-implantology-slider__list').addClass('swiper-wrapper');
			$this.find('.dp-implantology-slider__item').addClass('swiper-slide');
			$this.append("<div class='dp-slider-pagination'></div>");
			$this.append(
				'<div class="dp-slider-arrows">' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'</div>'
			);

			sliderArr[i] = new Swiper($sliderContainer[0], {
				spaceBetween: 20,
				speed: 800,
				slidesPerView: 3,
				navigation: {
					nextEl: $this.find(".dp-slider-arrow_next")[0],
					prevEl: $this.find(".dp-slider-arrow_prev")[0],
				},
				pagination: {
					el: $this.find('.dp-slider-pagination')[0],
					clickable: true,
				},
				breakpoints: {
					1: {
						slidesPerView: 1,
						spaceBetween: 0
					},
					576: {
						slidesPerView: 2,
						spaceBetween: 0
					},
					768: {
						slidesPerView: 2,
						spaceBetween: 0
					},
					992: {
						slidesPerView: 3,
						spaceBetween: 0
					},
					1581: {
						slidesPerView: 3,
						spaceBetween: 20
					}
				}
			});

			$sliderMenuItem.on('click', function () {
				var $this = $(this);
				var index = $this.index();
				$this.siblings().removeClass('dp-implantology-menu__item_active');
				$this.addClass('dp-implantology-menu__item_active');
				sliderArr[i].slideTo(index);
			});

		});
	}

}

function prostheticsSliders() {

	var $slider = $('.dp-prosthetics-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderMenu = $this.find('.dp-prosthetics-menu');
			var $sliderMenuItem = $sliderMenu.find('.dp-prosthetics-menu__item');
			var $sliderContainer = $this.find('.dp-prosthetics-slider__container');
			$sliderContainer.addClass('swiper');
			$this.find('.dp-prosthetics-slider__list').addClass('swiper-wrapper');
			$this.find('.dp-prosthetics-slider__item').addClass('swiper-slide');
			$this.append("<div class='dp-slider-pagination'></div>");
			$this.append(
				'<div class="dp-slider-arrows">' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'</div>'
			);

			sliderArr[i] = new Swiper($sliderContainer[0], {
				spaceBetween: 20,
				speed: 800,
				slidesPerView: 3,
				navigation: {
					nextEl: $this.find(".dp-slider-arrow_next")[0],
					prevEl: $this.find(".dp-slider-arrow_prev")[0],
				},
				pagination: {
					el: $this.find('.dp-slider-pagination')[0],
					clickable: true,
				},
				breakpoints: {
					1: {
						slidesPerView: 1,
						spaceBetween: 0
					},
					576: {
						slidesPerView: 2,
						spaceBetween: 0
					},
					768: {
						slidesPerView: 2,
						spaceBetween: 0
					},
					992: {
						slidesPerView: 3,
						spaceBetween: 0
					},
					1581: {
						slidesPerView: 3,
						spaceBetween: 20
					}
				}
			});

			$sliderMenuItem.on('click', function () {
				var $this = $(this);
				var index = $this.index();
				$this.siblings().removeClass('dp-prosthetics-menu__item_active');
				$this.addClass('dp-prosthetics-menu__item_active');
				sliderArr[i].slideTo(index);
			});

		});
	}

}

function certificatesSlider() {

	var $slider = $('.dp-certificates');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.dp-certificates__container');
			$sliderContainer.addClass('swiper');
			$this.find('.dp-certificates__list').addClass('swiper-wrapper');
			$this.find('.dp-certificates__col').addClass('swiper-slide');
			$this.append("<div class='dp-slider-pagination'></div>");
			$this.append(
				'<div class="dp-slider-arrows">' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'</div>'
			);

			sliderArr[i] = new Swiper($sliderContainer[0], {
				spaceBetween: 20,
				speed: 800,
				slidesPerView: 4,
				navigation: {
					nextEl: $this.find(".dp-slider-arrow_next")[0],
					prevEl: $this.find(".dp-slider-arrow_prev")[0],
				},
				// pagination: {
				// 	el: $this.find('.dp-slider-pagination')[0],
				// 	clickable: true,
				// },
				pagination: {
					el: $this.find('.dp-slider-pagination')[0],
					type: 'fraction',
					renderFraction: function (currentClass, totalClass) {
						return '<span class="' + currentClass + '"></span>&nbsp;из&nbsp;<span class="' + totalClass + '"></span>';
					}
				},
				breakpoints: {
					1: {
						slidesPerView: 1,
						spaceBetween: 0
					},
					480: {
						slidesPerView: 2,
						spaceBetween: 20
					},
					768: {
						slidesPerView: 3,
						spaceBetween: 20
					},
					992: {
						slidesPerView: 4,
						spaceBetween: 20
					}
				}
			});

		});
	}

}

function licensesSlider() {

	var $slider = $('.dp-licenses');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.dp-licenses__container');
			$sliderContainer.addClass('swiper');
			$this.find('.dp-licenses__list').addClass('swiper-wrapper');
			$this.find('.dp-licenses__col').addClass('swiper-slide');
			$this.append("<div class='dp-slider-pagination'></div>");
			$this.append(
				'<div class="dp-slider-arrows">' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'</div>'
			);

			sliderArr[i] = new Swiper($sliderContainer[0], {
				spaceBetween: 30,
				speed: 800,
				slidesPerView: 4,
				navigation: {
					nextEl: $this.find(".dp-slider-arrow_next")[0],
					prevEl: $this.find(".dp-slider-arrow_prev")[0],
				},
				pagination: {
					el: $this.find('.dp-slider-pagination')[0],
					type: 'fraction',
					renderFraction: function (currentClass, totalClass) {
						return '<span class="' + currentClass + '"></span>&nbsp;из&nbsp;<span class="' + totalClass + '"></span>';
					}
				},
				breakpoints: {
					1: {
						slidesPerView: 1,
						spaceBetween: 5
					},
					576: {
						slidesPerView: 2,
						spaceBetween: 24
					},
					768: {
						slidesPerView: 2,
						spaceBetween: 24
					},
					992: {
						slidesPerView: 3,
						spaceBetween: 24
					},
					1367: {
						slidesPerView: 4,
						spaceBetween: 30
					}
				}
			});

		});
	}

}

function stages() {
	var $stagesSlider = $('.dp-stages-and-terms--slider');
	var $stagesSliderBox = $('.dp-stages-and-terms--box');


	function updateSlider() {
		var $stagesSliderMenu = $('.dp-stages-and-terms--menu-box');
		if ($stagesSliderMenu.length) {
			var $stagesSlideMenu = $('.dp-stages-and-terms--slide-menu');
			if ($(window).width() < 1024) {
				if (!$stagesSlideMenu.length) {
					var $menuSlide = $('<div data-slide="menu" class="swiper-slide dp-stages-and-terms--slide dp-stages-and-terms--slide-menu"></div>');
					$menuSlide.prependTo($stagesSliderBox);
					$stagesSliderMenu.clone().appendTo($menuSlide);
				}
			}
			else {
				if ($stagesSlideMenu.length) {
					$stagesSlideMenu.remove();
					if (typeof stageSlider !== "undefined") {
						stageSlider.update();
					}
				}
			}
		}
	}
	updateSlider();

	if ($stagesSlider.length) {
		var stageSlider = new Swiper ('.dp-stages-and-terms--slider', {
			speed: 800,
			slidesPerView: 1,
			spaceBetween: 10,
			pagination: {
				el: '.dp-stages-and-terms--pagination',
				clickable: true,
			},
			navigation: {
				nextEl: '.dp-stages-and-terms--next',
				prevEl: '.dp-stages-and-terms--prev',
			},
		});
		$(document).on('click',  '.dp-stages-and-terms--menu .dp-stages-and-terms--menu-item', function() {
			var index = $(this).index();
			$('.dp-stages-and-terms--menu-item').removeClass('is-active');
			$(this).addClass('is-active');
			stageSlider.slideTo(index);
			if ($(window).width() < 1024 && !$('.dp-stages-and-terms--container').hasClass('is-menu-hide')) {
				stageSlider.slideTo(index+1);
			}
			// if ($(window).width() < 1024 && !$('.dp-stages-and-terms--container').hasClass('is-menu-hide')) {
			// 	$('.dp-stages-and-terms--container').addClass('is-menu-hide')
			// }
		});
		stageSlider.on('slideChange ', function (e) {
			// console.log(stageSlider.activeIndex)
			$('.dp-stages-and-terms--menu-item').removeClass('is-active');
			$('.dp-stages-and-terms--menu-item').eq(stageSlider.activeIndex).addClass('is-active');
			// if ($(window).width() < 1024 && !$('.dp-stages-and-terms--container').hasClass('is-menu-hide')) {
			//   if ((stageSlider.activeIndex - stageSlider.previousIndex) == 1 || (stageSlider.activeIndex - stageSlider.previousIndex) ===-1   ) {
			// 	  // предотвращает перелистывание до исчезновения меню, но при этом учитывает использования точек
			// 	  stageSlider.slideTo(stageSlider.activeIndex - 1);
			//   }
			//   $('.dp-stages-and-terms--container').addClass('is-menu-hide')
			// }
		});
	}
	$(window).on('resize', function () {
		updateSlider();
	});
}

function stockSlide() {
	var $stagesSlider = $('.dp-stocks--slider');
	if ($stagesSlider.length) {
		var stageSlider = new Swiper ('.dp-stocks--slider', {
			speed: 800,
			slidesPerView: 2,
			spaceBetween: 10,
			pagination: {
				el: '.dp-stocks--pagination',
				clickable: true,
			},
			navigation: {
				nextEl: '.dp-stocks--next',
				prevEl: '.dp-stocks--prev',
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
				},
				769: {
					slidesPerView: 2,
					spaceBetween: 18,
				},
				1280: {
					slidesPerView: 2,
					spaceBetween: 18,
				},
			},
		});
	}
}

let bigMap;
function initBigMap(lng, lat, title) {

	$('#map').removeClass('dp-general-map').addClass('dp-affiliated-map');

	bigMap = new ymaps.Map("map", {
		center: [lng,lat],
		zoom: 16,
		controls: []
	});

	bigMap.behaviors.disable('scrollZoom');

	var containerId = 'map';

	var ZoomLayout = ymaps.templateLayoutFactory.createClass('<div class="dp-general-map-zoom">' +
		'<div id="' + containerId + '--zoom-in" class="dp-general-map-zoom__btn dp-general-map-zoom__up"></div>' +
		'<div id="' + containerId + '--zoom-out" class="dp-general-map-zoom__btn dp-general-map-zoom__down"></div>' +
		'</div>', {
		build: function () {
			ZoomLayout.superclass.build.call(this);
			this.zoomInCallback = ymaps.util.bind(this.zoomIn, this);
			this.zoomOutCallback = ymaps.util.bind(this.zoomOut, this);
			$('#' + containerId + '--zoom-in').bind('click', this.zoomInCallback);
			$('#' + containerId + '--zoom-out').bind('click', this.zoomOutCallback);
		},
		clear: function () {
			$('#' + containerId + '--zoom-in').unbind('click', this.zoomInCallback);
			$('#' + containerId + '--zoom-out').unbind('click', this.zoomOutCallback);
			ZoomLayout.superclass.clear.call(this);
		},
		zoomIn: function () {
			var map = this.getData().control.getMap();
			map.setZoom(map.getZoom() + 1, {checkZoomRange: true});
		},
		zoomOut: function () {
			var map = this.getData().control.getMap();
			map.setZoom(map.getZoom() - 1, {checkZoomRange: true});
		}
	});

	var mapHeight = bigMap.container.getSize()[1];

	var zoomControl = new ymaps.control.ZoomControl({
		options: {
			layout: ZoomLayout,
			position: {
				right: '12px',
				top: mapHeight / 2 - 36 + 'px',
			}
		}
	});
	bigMap.controls.add(zoomControl);

	bigMap.events.add('sizechange', function (e) {
		mapHeight = e.get('newSize')[1];
		zoomControl.options.set({position: {right: '12px', top: mapHeight / 2 - 36 + 'px'}});
	});

	myPlacemark1 = new ymaps.Placemark(
		[lng,lat],
		{
			hintContent: title,
		},
		{
			iconLayout: 'default#imageWithContent',
			iconImageHref: '/img/design/placemark.svg',
			iconImageSize: [46, 46],
			iconImageOffset: [-23, -23]
		}
	);

	// Добавляем все метки на карту.
	bigMap.geoObjects.add(myPlacemark1);

	$('.dp-map--info-box').show();
	$('.dp-map--title').show();
}
function initBigMapList(placemarks) {

	$('#map').addClass('dp-general-map');

	bigMap = new ymaps.Map("map", {
		center: [55.76, 37.64], // Координаты центра карты
		zoom: 11,
		controls: []
	});

	bigMap.behaviors.disable('scrollZoom');

	var containerId = 'map';

	var ZoomLayout = ymaps.templateLayoutFactory.createClass('<div class="dp-general-map-zoom">' +
		'<div id="' + containerId + '--zoom-in" class="dp-general-map-zoom__btn dp-general-map-zoom__up"></div>' +
		'<div id="' + containerId + '--zoom-out" class="dp-general-map-zoom__btn dp-general-map-zoom__down"></div>' +
		'</div>', {
		build: function () {
			ZoomLayout.superclass.build.call(this);
			this.zoomInCallback = ymaps.util.bind(this.zoomIn, this);
			this.zoomOutCallback = ymaps.util.bind(this.zoomOut, this);
			$('#' + containerId + '--zoom-in').bind('click', this.zoomInCallback);
			$('#' + containerId + '--zoom-out').bind('click', this.zoomOutCallback);
		},
		clear: function () {
			$('#' + containerId + '--zoom-in').unbind('click', this.zoomInCallback);
			$('#' + containerId + '--zoom-out').unbind('click', this.zoomOutCallback);
			ZoomLayout.superclass.clear.call(this);
		},
		zoomIn: function () {
			var map = this.getData().control.getMap();
			map.setZoom(map.getZoom() + 1, {checkZoomRange: true});
		},
		zoomOut: function () {
			var map = this.getData().control.getMap();
			map.setZoom(map.getZoom() - 1, {checkZoomRange: true});
		}
	});

	var mapHeight = bigMap.container.getSize()[1];

	var zoomControl = new ymaps.control.ZoomControl({
		options: {
			layout: ZoomLayout,
			position: {
				right: '12px',
				top: mapHeight / 2 - 36 + 'px'
			}
		}
	});

	bigMap.controls.add(zoomControl);

	bigMap.events.add('sizechange', function (e) {
		mapHeight = e.get('newSize')[1];
		zoomControl.options.set({position: {right: '12px', top: mapHeight / 2 - 36 + 'px'}});
	});

	placemarks.map(function(placemark) {
		var marker = new ymaps.Placemark(
			placemark.coordinates,
			{
				hintContent: placemark.content,
				//iconContent: '<span data-btn-id="' + placemark.affiliatedId + '" class="dp-placemark-btn"></span>'
			},
			{
				iconLayout: 'default#imageWithContent',
				iconImageHref: '/img/design/placemark.svg',
				iconImageSize: [46, 46],
				iconImageOffset: [-23, -23]
			}
		);
		bigMap.geoObjects.add(marker);
		marker.events.add('click', function (e) {
			$('.dp-affiliated[data-id="' + placemark.affiliatedId + '"] .dp-affiliated--button').trigger('click');
		});
	});

	$('.dp-map--info-box').hide();
	$('.dp-map--title').text('КЛИНИКИ «НЕ•БОЛЬНО» В МОСКВЕ');
}

function sectionContact() {
	// $(window).on("load", function() {
	// 	if ($(".dp-map").length && $('.dp-affiliated.is-active').length) {
	// 		let getActiveMap = $('.dp-affiliated.is-active');
	// 		mapGeneration(getActiveMap);
	// 	}
	// });
	// $(window).on("load", function() {
	// 	if ($(".dp-map").length && $('.dp-affiliated').length) {
	// 		let getGpsMap = $('.dp-affiliated');
	// 		mapGenerationList(getGpsMap);
	// 	}
	// });
}
$(window).on("load", function() {
	if ($(".dp-map").length && $('.dp-affiliated').length) {
		let getGpsMap = $('.dp-affiliated');
		mapGenerationList(getGpsMap);
	}
});
function mapMobile() {
	var mapGPS = $('.dp-affiliated--gps');
	// (data-longitude="55.79708856893388" data-latitude="37.58087599999998")
	var mapCar = [];
	var mapTransport = [];
	var MatkNav = [];
	var MatkTran = [];
	function initMap(){
		mapGPS.map(function (index, el) {
			var gpsLong = $(el).data('longitude');
			var gpsLat = $(el).data('latitude');
			var getBox = $(el).closest('.dp-affiliated--item').find('.dp-affiliated--map-content');
			$(el).closest('.dp-affiliated--item').find('.dp-affiliated--map-content').find('.dp-affiliated--map-car .dp-affiliated--map').attr('id', 'mapCar' + index);
			$(el).closest('.dp-affiliated--item').find('.dp-affiliated--map-content').find('.dp-affiliated--map-transport .dp-affiliated--map').attr('id', 'mapTransport' + index);
			mapCar[index] = new ymaps.Map('mapCar' + index, {
				center: [gpsLong, gpsLat],
				zoom: 12,
			});
			mapTransport[index] = new ymaps.Map('mapTransport' + index, {
				center: [gpsLong, gpsLat],
				zoom: 12,
			});
			// Создаем метку с помощью вспомогательного класса.
			MatkNav[index] = new ymaps.Placemark(
				[gpsLong,gpsLat],
			);
			MatkTran[index] = new ymaps.Placemark(
				[gpsLong,gpsLat],
			);
			// Добавляем все метки на карту.
			mapCar[index].geoObjects.add(MatkNav[index]);
			mapTransport[index].geoObjects.add(MatkTran[index]);
		});

	}
	$(window).on("load", function() {
		if (mapGPS.length) {
			ymaps.ready(function () {
				initMap()
			});
		}
	});
}

function mapGeneration(el) {
	var getContainer = $(el).closest(".dp-affiliated--item");
	var getTitle = getContainer.find(".dp-affiliated").data('title');
	var getGps = getContainer.find(".dp-affiliated--gps");
	var gpsLng = getGps.data('longitude');
	var gpsLat = getGps.data('latitude');
	if (bigMap !== undefined) {
		bigMap.destroy();
	}
	var getTextCar = getContainer.find('.dp-affiliated--map-car .dp-affiliated--map-text').clone();
	var getTextTransport=  getContainer.find('.dp-affiliated--map-transport .dp-affiliated--map-text').clone();
	if (!$('.dp-map--section').hasClass('is-scrolling')) {
		$('.dp-map--section').attr('id', 'mapScroll').addClass('is-scrolling');
	}
	$('.dp-map--title').text(getTitle);
	$('.dp-map--info-car').find('.dp-map--info-text').html(getTextCar);
	$('.dp-map--info-transport').find('.dp-map--info-text').html(getTextTransport);

	setTimeout(function () {
		ymaps.ready(function () {initBigMap(gpsLng, gpsLat, getTitle);});
	}, 100);
}
function mapGenerationList(getGpsMap) {
	var placemarks = [];
	getGpsMap.map(function (index, el) {
		var getTitle = $(el).data('title');
		var getGps = $(el).find('.dp-affiliated--gps');
		var gpsLng = getGps.data('longitude');
		var gpsLat = getGps.data('latitude');
		var affId = $(el).data('id');
		placemarks.push(
			{
				coordinates: [gpsLng, gpsLat], // Координаты первой точки
				content: getTitle, // Содержимое балуна для первой точки
				affiliatedId: affId
			},
		)
	});
	setTimeout(function () {
		ymaps.ready(function() {initBigMapList(placemarks);});
	}, 100);
}
$(document).on("click", ".dp-affiliated--button", function () {
	var $this = $(this);
	var dW = $(window).width();
	if ($this.closest('.dp-affiliated').hasClass('is-active')) {
		if (dW > 769) {
			document.getElementById('mapScroll').scrollIntoView({
				behavior: 'smooth'
			});
		}

		$('.dp-affiliated').removeClass('is-active');
	} else {
		if (dW > 769) {
			mapGeneration($this);
		} else {
			mapMobile();
		}
		$('.dp-affiliated').removeClass('is-active');
		$this.closest('.dp-affiliated').addClass('is-active');
	}

});

function stagesSection() {
	var $slider = $('.dp-stages-slider-wrapper');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderMenu = $this.find('.dp-stages-slider');
			var $sliderMenuItem = $sliderMenu.find('.dp-stages-slider__item');
			var $sliderContainer = $this.find('.dp-stages__container');
			if ($(window).width() < 576) {
				$sliderContainer.addClass('swiper');
				$this.find('.dp-stages-list').addClass('swiper-wrapper');
				$this.find('.dp-stages-item').addClass('swiper-slide');
				$this.append("<div class='dp-slider-pagination'></div>");
				$this.append(
					'<div class="dp-slider-arrows">' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow">' +
					'<use xlink:href="#slider-arrow"></use>' +
					'</svg>' +
					'</button>' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
					'<svg class="icon icon-slider-arrow">' +
					'<use xlink:href="#slider-arrow"></use>' +
					'</svg>' +
					'</button>' +
					'</div>'
				);

				sliderArr[i] = new Swiper($sliderContainer[0], {
					spaceBetween: 0,
					speed: 800,
					slidesPerView: 1,
					navigation: {
						nextEl: $this.find(".dp-slider-arrow_next")[0],

						prevEl: $this.find(".dp-slider-arrow_prev")[0],
					},
					pagination: {
						el: $this.find('.dp-slider-pagination')[0],
						clickable: true,
					}
				});

				sliderArr[i].on('slideChange', function () {
					var index = sliderArr[i].activeIndex;
					$($sliderMenuItem[index]).siblings().removeClass('dp-stages-slider__item_active');
					$($sliderMenuItem[index]).addClass('dp-stages-slider__item_active');
				});

				$sliderMenuItem.on('click', function () {
					var $this = $(this);
					var index = $this.index();
					$this.siblings().removeClass('dp-stages-slider__item_active');
					$this.addClass('dp-stages-slider__item_active');
					sliderArr[i].slideTo(index);
				});
			}

			$(window).on('resize', function () {
				if ($(window).width() < 576) {
					if (!$sliderContainer.hasClass('swiper-initialized')) {
						$sliderContainer.addClass('swiper');
						$this.find('.dp-stages-list').addClass('swiper-wrapper');
						$this.find('.dp-stages-item').addClass('swiper-slide');
						$this.append("<div class='dp-slider-pagination'></div>");
						$this.append(
							'<div class="dp-slider-arrows">' +
							'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
							'<svg class="icon icon-slider-arrow">' +
							'<use xlink:href="#slider-arrow"></use>' +
							'</svg>' +
							'</button>' +
							'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
							'<svg class="icon icon-slider-arrow">' +
							'<use xlink:href="#slider-arrow"></use>' +
							'</svg>' +
							'</button>' +
							'</div>'
						);

						sliderArr[i] = new Swiper($sliderContainer[0], {
							spaceBetween: 0,
							speed: 800,
							slidesPerView: 1,
							navigation: {
								nextEl: $this.find(".dp-slider-arrow_next")[0],

								prevEl: $this.find(".dp-slider-arrow_prev")[0],
							},
							pagination: {
								el: $this.find('.dp-slider-pagination')[0],
								clickable: true,
							}
						});

						sliderArr[i].on('slideChange', function () {
							var index = sliderArr[i].activeIndex;
							$($sliderMenuItem[index]).siblings().removeClass('dp-stages-slider__item_active');
							$($sliderMenuItem[index]).addClass('dp-stages-slider__item_active');
							// console.log($($sliderMenuItem[index]))
						});

						$sliderMenuItem.on('click', function () {
							var $this = $(this);
							var index = $this.index();
							$this.siblings().removeClass('dp-stages-slider__item_active');
							$this.addClass('dp-stages-slider__item_active');
							sliderArr[i].slideTo(index);
						});
					}
				} else {
					if (typeof sliderArr[i] !== 'undefined' && $sliderContainer.hasClass('swiper-initialized')) {
						sliderArr[i].destroy();
						$sliderContainer.removeClass('swiper');
						$this.find('.dp-stages-list').removeClass('swiper-wrapper');
						$this.find('.dp-stages-item').removeClass('swiper-slide');
						$this.find('.dp-slider-pagination').remove();
						$this.find('.dp-slider-fraction').remove();
						$this.find('.dp-slider-arrows').remove();
					}
				}
			});
		});
	}
}

priceMenu();
function priceMenu() {
	$('.dp-price-item__header').on('click', function (e) {
		var $this = $(this);
		e.preventDefault();
		var $openedMenu = $('.dp-price-item_opened');
		var $wrapper = $this.closest('.dp-price-item');
		var $list = $this.next('.dp-price-item__body');
		if (!$wrapper.hasClass('dp-price-item_opened')) {
			if ($openedMenu.length) {
				$openedMenu.removeClass('dp-price-item_opened');
				$openedMenu.find('.dp-price-item__body').css('display', 'block').slideUp(300, function () {
					$(this).removeAttr('style');
				});
			}
			$wrapper.addClass('dp-price-item_opened');
			if ($list.length) {
				$list.css('display', 'none').slideDown(300, function () {
					$(this).removeAttr('style');
				});
			}
		}
		else {
			$wrapper.removeClass('dp-price-item_opened');
			$list.css('display', 'block').slideUp(300, function () {
				$(this).removeAttr('style');
			});
		}
	});

	/*
	$('.dp-price-note button').on('click', function (e) {
		e.preventDefault();
		var $closePrice = $('.dp-price-table__dropdown');
		var $wrappers = $('.dp-price-item');
		if ($closePrice.length) {
			$wrappers.addClass('dp-price-item_opened');
			$closePrice.slideDown(300);
		}
	});
	 */
}

let _isScrolling = false;
let $scrolltotop;
// Append Button
$("body").append(($scrolltotop = $("<a />").addClass("scroll-to-top").attr({href: "#", id: "scrollToTop"})));

$(document).on("click", "#scrollToTop", function(e) {
	e.preventDefault();
	$("body, html").animate({scrollTop: 0}, 500);

	return false;
});

// Show/Hide Button on Window Scroll event.
$(window).scroll(function() {
	if (!_isScrolling) {
		_isScrolling = true;

		if ($(window).scrollTop() > 150) {
			$scrolltotop.stop(true, true).addClass("visible");
			_isScrolling = false;
		} else {
			$scrolltotop.stop(true, true).removeClass("visible");
			_isScrolling = false;
		}
	}
});


const doctorAppointmentPhone = document.getElementById('dp-doctor-appointment-form-phone');
const queryMobile = window.matchMedia('(max-width: 767px)');

if (doctorAppointmentPhone) {
	queryMobile.onchange= () => {
		if (queryMobile.matches) {
			doctorAppointmentPhone.placeholder = 'Укажите ваш номер'
		} else {
			doctorAppointmentPhone.placeholder = '+7 (999) 999-99-99'
		}
	};
	queryMobile.onchange();
}

baOne();
function baOne() {
	var $slider = $('.dp-ba-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {

			var $this = $(this);
			var $sliderContainer = $this.find('.dp-ba-slider__container');
			var $sliderWrapper = $this.find('.dp-ba-slider__wrapper');
			var $sliderSlide = $this.find('.dp-ba-slider__slide');

			$sliderContainer.addClass('swiper');
			$sliderWrapper.addClass('swiper-wrapper');
			$sliderSlide.addClass('swiper-slide');
			// $this.append("<div class='dp-slider-pagination'></div>");
			$this.append(
				'<div class="dp-slider-arrows">' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'</div>'
			);

			sliderArr[i] = new Swiper($sliderContainer[0], {
				spaceBetween: 0,
				speed: 800,
				slidesPerView: 1,
				navigation: {
					nextEl: $this.find(".dp-slider-arrow_next")[0],
					prevEl: $this.find(".dp-slider-arrow_prev")[0],
				},
			});

			sliderArr[i].on('slideChange', function(swiper) {
				arrowsCalcPos();
			});

			var resizeTimeout;
			$(window).on('resize', function () {
				clearTimeout(resizeTimeout);
				resizeTimeout = setTimeout(arrowsCalcPos, 200);
			});

			arrowsCalcPos();

			function arrowsCalcPos() {
				var w = $(window).width();
				var $arrows = $this.find('.dp-slider-arrows');
				if (w < 992) {
					var $currentSlide = $(sliderArr[i].slides[sliderArr[i].activeIndex]);
					var $title = $currentSlide.find('h3');
					var $img = $currentSlide.find('.dp-ba__image');
					var titleHeight = $title.outerHeight(true);
					var imgHeight = $img.outerHeight();
					$arrows.css('top', titleHeight + imgHeight / 2 + 'px');
				}
				else {
					$arrows.css('top', '50%');
				}
			}

		});
	}
}
