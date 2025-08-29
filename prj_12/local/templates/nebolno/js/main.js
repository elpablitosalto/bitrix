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

if (typeof $.fancybox !== 'undefined') {
	$.fancybox.defaults.backFocus = false;
}

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
	priceMenu();

	stages();
	stockSlide();
	mapMobile();

	modals();

	// DROPDOWN MENU EVENTS

	$body.on('click', '.nb-dropdown__header', function () {
		var $this = $(this);
		var $dropdown = $this.closest('.nb-dropdown');
		var $dropdownBody = $dropdown.find('.nb-dropdown__body');
		if ($dropdown.hasClass('nb-dropdown_opened')) {
			$dropdown.removeClass('nb-dropdown_opened');
			$dropdownBody.slideUp(300, function () {
				$(this).removeAttr('style');
			});
		}
		else {
			$dropdown.addClass('nb-dropdown_opened');
			$dropdownBody.slideDown(300);
		}
	});
	$body.on('change', '.nb-dropdown__input', function () {
		var $this = $(this);
		var $dropdown = $this.closest('.nb-dropdown');
		var $dropdownBody = $dropdown.find('.nb-dropdown__body');
		var $dropdownLabel = $this.next('.nb-dropdown__label');
		var $dropdownTitle = $dropdown.find('.nb-dropdown__title');
		$dropdownTitle.text($dropdownLabel.text());
		if ($dropdown.hasClass('nb-dropdown_opened')) {
			$dropdown.removeClass('nb-dropdown_opened');
			$dropdownBody.hide(0, function () {
				$(this).removeAttr('style');
			});
		}
	});

	$('.nb-ancor-menu__link').on('click', function () {
		var id = $(this).attr('href');
		scrollToTarget(id);
	});

	var $nbConsultationFormInput = $('.nb-form input');
	if ($nbConsultationFormInput.length) {
		$nbConsultationFormInput.on('change input', function () {
			var $this = $(this);
			$val = $this.val();
			$label = $this.next('label');
			if ($val.length > 0) {
				$label.removeClass('nb-label-mobile-show');
				if (typeof $this.data('rule-required') !== 'undefined' && $this.data('rule-required')) {
					if ($this.hasClass('nb-input-error')) {
						$this.removeClass('nb-input-error');
					}
				}
			}
			else {
				$label.addClass('nb-label-mobile-show');
				if (typeof $this.data('rule-required') !== 'undefined' && $this.data('rule-required')) {
					if (!$this.hasClass('nb-input-error')) {
						$this.addClass('nb-input-error');
					}
				}
			}
		});
		$nbConsultationFormInput.each(function () {
			var $this = $(this);
			$val = $this.val();
			$label = $this.next('label');
			if ($val.length > 0) {
				$label.removeClass('nb-label-mobile-show');
			}
			else {
				$label.addClass('nb-label-mobile-show');
			}
		});
	}

	var $comparisonTableWrapper = $('.nb-comparison-table-wrapper');
	if ($comparisonTableWrapper.length) {
		$comparisonTableWrapper.overlayScrollbars({
			className: 'os-theme-nebolno',
			overflowBehavior: {
				y: 'hidden'
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

	$('.nb-header-search-form__submit').on('click', function (e) {
		var $this = $(this);
		var $body = $('body');
		var width = $(window).width();
		if (width < 992 && !$body.hasClass('nb-header-search-show')) {
			e.preventDefault();
			$body.addClass('nb-header-search-show');
			$this.siblings('.nb-header-search-form__input').trigger('focus');
		}

	});

	$('.nb-header-toggle-btn').on('click', function (e) {
		e.preventDefault();
		var $body = $('body');
		var paddingRight = window.innerWidth - document.body.clientWidth;
		var $mobileMenu = $('.nb-header-dropdown');

		var $itemOpened = $('.nb-header-menu__item_submenu-opened');
		var $itemOpened2 = $('.nb-header-menu-level-2__item_submenu-opened');
		var $menuLevel2 = $('.nb-header-menu-level-2');
		var $menuLevel3 = $('.nb-header-menu-level-3');

		if (!$body.hasClass('nb-header-mobile-menu-active')) {
			$body.addClass('nb-header-mobile-menu-active');
			$body.addClass("overflow-hidden");
			$body.css("padding-right", paddingRight + "px");
			$mobileMenu.slideDown(300);
		}
		else {
			$body.removeClass('nb-header-mobile-menu-active');
			if ($itemOpened2.length) {
				$itemOpened2.removeClass('nb-header-menu-level-2__item_submenu-opened');
			}
			$mobileMenu.slideUp(300, function () {
				$body.removeClass("overflow-hidden");
				$body.css("padding-right", 0);
				if($itemOpened.length) {
					$itemOpened.removeClass('nb-header-menu__item_submenu-opened');
				}
				if ($menuLevel2.length && $menuLevel2.css('display') === 'block') {
					$menuLevel2.removeAttr('style');
				}
				if ($menuLevel3.length && $menuLevel3.css('display') === 'block') {
					$menuLevel3.removeAttr('style');
				}
			});
		}
	});

	$body.on('click', function () {
		var width = $(window).width();
		if ($body.hasClass('nb-header-search-show')) {
			$body.removeClass('nb-header-search-show');
		}
		if ($body.hasClass('nb-header-mobile-menu-active')) {
			$body.removeClass('nb-header-mobile-menu-active');
			if (width < 992) {
				var $mobileMenu = $('.nb-header-dropdown');
				$mobileMenu.slideUp(300);
			}
		}
	});

	$('.nb-header, .nb-header-dropdown').on('click', function (e) {
		e.stopPropagation();
	});

	$(window).on('resize', function () {
		var $body = $('body');
		var width = $(window).width();
		if (width >= 992) {
			if ($body.hasClass('nb-header-search-show')) {
				$body.removeClass('nb-header-search-show');
			}
			if ($body.hasClass('nb-header-mobile-menu-active')) {
				$body.removeClass('nb-header-mobile-menu-active');
			}
			var $mobileMenu = $('.nb-header-dropdown');
			if ($mobileMenu.css('display') === 'none') {
				$mobileMenu.removeAttr('style');
			}
		}
	});


	$('.nb-header-menu__item').on('click', function (e) {
		var $this = $(this);
		var $itemOpened = $('.nb-header-menu__item_submenu-opened');
		var $menuLevel2 = $('.nb-header-menu-level-2');
		var $menuLevel3 = $('.nb-header-menu-level-3');
		var $menuLevel2Current = $this.find('.nb-header-menu-level-2');

		if ($menuLevel2Current.length) {
			e.preventDefault();
			if (!$this.hasClass('nb-header-menu__item_submenu-opened')) {
				if ($itemOpened.length) {
					$itemOpened.removeClass('nb-header-menu__item_submenu-opened');
				}
				$this.addClass('nb-header-menu__item_submenu-opened');
				$menuLevel3.hide();
				$menuLevel2.hide();
				if ($(window).width() < 1200) {
					$menuLevel2Current.css('display', 'none').slideDown(300);
				}
				else {
					$menuLevel2Current.show();
				}
			}
			else {
				$this.removeClass('nb-header-menu__item_submenu-opened');
				if ($(window).width() < 1200) {
					$menuLevel2Current.css('display', 'block').slideUp(300, function () {
						$menuLevel2Current.removeAttr('style');
					});
				}
				else {
					$menuLevel2Current.hide();
				}
			}
		}
		else {
			if ($itemOpened.length) {
				$itemOpened.removeClass('nb-header-menu__item_submenu-opened');
			}
			$menuLevel3.hide();
			$menuLevel2.hide();
		}
	});

	$('.nb-header-menu-level-2__item')
		.on('mouseenter', function (e) {
			if ($(window).width() >= 1200) {
				var $this = $(this);
				var $itemOpened = $('.nb-header-menu-level-2__item_submenu-opened');
				var $menuLevel3 = $('.nb-header-menu-level-3');
				var $menuLevel3Current = $this.find('.nb-header-menu-level-3');
				if ($menuLevel3Current.length) {
					e.preventDefault();
					if (!$this.hasClass('nb-header-menu-level-2__item_submenu-opened')) {
						if ($itemOpened.length) {
							$itemOpened.removeClass('nb-header-menu-level-2__item_submenu-opened');
						}
						$this.addClass('nb-header-menu-level-2__item_submenu-opened');
						$menuLevel3.hide();
						$menuLevel3Current.show();
					}
				}
				else {
					if ($itemOpened.length) {
						$itemOpened.removeClass('nb-header-menu-level-2__item_submenu-opened');
					}
					$menuLevel3.hide();
				}
			}
		})
		.on('click', function (e) {
			if ($(window).width() < 1200) {
				var $this = $(this);
				var $headerDropdown = $('.nb-header-dropdown');
				var $itemOpened = $('.nb-header-menu-level-2__item_submenu-opened');
				var $menuLevel3 = $('.nb-header-menu-level-3');
				var $menuLevel3Current = $this.find('.nb-header-menu-level-3');
				if ($menuLevel3Current.length) {
					e.preventDefault();
					if (!$this.hasClass('nb-header-menu-level-2__item_submenu-opened')) {
						if ($itemOpened.length) {
							$itemOpened.removeClass('nb-header-menu-level-2__item_submenu-opened');
						}
						$this.addClass('nb-header-menu-level-2__item_submenu-opened');
						$headerDropdown.css('overflow', 'hidden');
					}
				}
				else {
					if ($itemOpened.length) {
						$itemOpened.removeClass('nb-header-menu-level-2__item_submenu-opened');
					}
					$headerDropdown.css('overflow', 'auto');
					$menuLevel3.hide();
				}
			}
		});

	$('.nb-header-menu-level-2, .nb-header-menu-level-3').on('click', function (e) {
		e.stopPropagation();
	});

	$('body, .nb-header-menu-level-3__close').on('click', function () {
		var $itemOpened = $('.nb-header-menu__item_submenu-opened');
		var $itemOpened2 = $('.nb-header-menu-level-2__item_submenu-opened');
		var $menuLevel2 = $('.nb-header-menu-level-2');
		var $menuLevel3 = $('.nb-header-menu-level-3');
		if($itemOpened.length) {
			$itemOpened.removeClass('nb-header-menu__item_submenu-opened');
		}
		if ($itemOpened2.length) {
			$itemOpened2.removeClass('nb-header-menu-level-2__item_submenu-opened');
		}
		if ($menuLevel2.length && $menuLevel2.css('display') === 'block') {
			$menuLevel2.removeAttr('style');
		}
		if ($menuLevel3.length && $menuLevel3.css('display') === 'block') {
			$menuLevel3.removeAttr('style');
		}
	});

	$('.nb-header-menu-level-3__back').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
		var $headerDropdown = $('.nb-header-dropdown');
		$headerDropdown.css('overflow', 'auto');
		var $itemOpened2 = $('.nb-header-menu-level-2__item_submenu-opened');
		if ($itemOpened2.length) {
			$itemOpened2.removeClass('nb-header-menu-level-2__item_submenu-opened');
		}
	});

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

		var paddingRight = window.innerWidth - document.body.clientWidth;

		$modal = $(modalSelector);
		if ($modal.length) {
			$body.addClass("overflow-hidden");
			$body.css("padding-right", paddingRight + "px");
			var $activeModals = $('.ml-modal_active');
			if ($activeModals.length) {
				$activeModals.fadeOut(0, function () {
					$modal.addClass("nb-modal_active").fadeIn(300);
				});
			}
			else {
				$modal.addClass("nb-modal_active").fadeIn(300);
			}
			$modal.trigger('modalShow');
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

				$('.nb-modals').append(msg);
				$modal = $(modalSelector);
				$body.addClass("overflow-hidden");
				$body.css("padding-right", paddingRight + "px");
				var $activeModals = $('.nb-modal_active');
				if ($activeModals.length) {
					$activeModals.fadeOut(0, function () {
						$modal.addClass("nb-modal_active").fadeIn(300);
					});
				}
				else {
					$modal.addClass("nb-modal_active").fadeIn(300);
				}

			});

		}

	});

	$body.on("click", ".nb-modal__close, .nb-modal__close-btn, .nb-modal__overlay", function (e) {
		e.preventDefault();
		$(this).closest(".nb-modal").removeClass("nb-modal_active").fadeOut(300, function () {
			$body.removeClass("overflow-hidden");
			$body.css("padding-right", 0);
		});
	});
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

function topBannerSectionSlider() {

	var $slider = $('.nb-top-b-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.nb-top-b-slider-container');
			$sliderContainer.addClass('swiper');
			$this.find('.nb-top-b-slider-list').addClass('swiper-wrapper');
			$this.find('.nb-top-b-slider-item').addClass('swiper-slide');
			$this.append("<div class='nb-slider-pagination'></div>");
			$this.append(
				'<div class="nb-slider-arrows">' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
					nextEl: $this.find(".nb-slider-arrow_next")[0],
					prevEl: $this.find(".nb-slider-arrow_prev")[0],
				},
				pagination: {
					el: $this.find('.nb-slider-pagination')[0],
					clickable: true,
				}
			});

		});
	}

}

function reviews(el) {

	var $slider = (typeof el !== 'undefined') ? $(el) : $('.nb-reviews');
	var sliderMainArr = [];
	var sliderThumbsArr = [];
	if ($slider.length) {
		$slider.each(function (i) {

			var $wrapper = $(this);

			var $thumbsSlider = $wrapper.find('.nb-reviews-thumbs');
			var $thumbsSliderContainer = $thumbsSlider.find('.nb-reviews-thumbs__container');
			var $thumbsSliderList = $thumbsSlider.find('.nb-reviews-thumbs__list');

			var $pagination = $wrapper.find('.nb-pagination');
			var $paginationBtn = $pagination.find('.nb-pagination__btn');
			var $paginationCounter = $pagination.find('.nb-pagination__counter');

			$thumbsSliderContainer.addClass('swiper').attr('data-slider-index', i);
			$thumbsSliderList.addClass('swiper-wrapper');
			$thumbsSlider.append("<div class='nb-slider-pagination'></div>");
			// $thumbsSlider.append(
			// 	'<div class="nb-slider-arrows">' +
			// 	'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
			// 	'<svg class="icon icon-slider-arrow">' +
			// 	'<use xlink:href="#slider-arrow"></use>' +
			// 	'</svg>' +
			// 	'</button>' +
			// 	'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
				slideClass: 'nb-reviews-thumbs__col',
				loop: true,
				// loopPreventsSliding: false,
				// navigation: {
				// 	nextEl: $thumbsSlider.find(".nb-slider-arrow_next")[0],
				// 	prevEl: $thumbsSlider.find(".nb-slider-arrow_prev")[0],
				// },
				pagination: {
					el: $thumbsSlider.find('.nb-slider-pagination')[0],
					clickable: true,
				}
			});


			var $mainSlider = $wrapper.find('.nb-reviews-main');
			var $mainSliderContainer = $mainSlider.find('.nb-reviews-main__container');
			var $mainSliderList = $mainSlider.find('.nb-reviews-main__list');

			$mainSliderContainer.addClass('swiper').attr('data-slider-index', i);
			$mainSliderList.addClass('swiper-wrapper');
			$mainSliderContainer.append("<div class='nb-slider-pagination'></div>");
			$mainSlider.append(
				'<div class="nb-slider-arrows">' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
				// autoHeight: true,
				slideClass: 'nb-reviews-main__col',
				// loop: true,
				navigation: {
					nextEl: $mainSlider.find(".nb-slider-arrow_next")[0],
					prevEl: $mainSlider.find(".nb-slider-arrow_prev")[0],
				},
				pagination: {
					el: $mainSliderContainer.find('.nb-slider-pagination')[0],
					type: 'fraction',
					renderFraction: function (currentClass, totalClass) {
						return '<span class="' + currentClass + '"></span>&nbsp;из&nbsp;<span class="' + totalClass + '"></span>';
					}
				},
				// breakpoints: {
				// 	1: {
				// 		autoHeight: true
				// 	},
				// 	992: {
				// 		autoHeight: false
				// 	}
				// },
				// thumbs: {
				// 	swiper: sliderThumbsArr[i],
				// 	// autoScrollOffset: 1
				// }
			});

			var $clickedSliderThumb = $mainSlider.find('.nb-review-main-slider__thumb');
			$clickedSliderThumb.on('click', function () {
				var $this = $(this);
				var $parent = $this.closest('.nb-review-main');
				var $thumbsContainer = $this.parent('.nb-review-main-slider__thumbs-list');
				var $thumbs = $thumbsContainer.children('.nb-review-main-slider__thumb');
				var $desc = $parent.find('.nb-review-main__desc');

				$thumbs.removeClass('nb-review-main-slider__thumb_active');
				$this.addClass('nb-review-main-slider__thumb_active');

				var $thumbActive = $thumbsContainer.children('.nb-review-main-slider__thumb_active');
				var ind = $thumbsContainer.children('.nb-review-main-slider__thumb_active').index();

				var $clickedSlider = $parent.find('.nb-review-main-slider__img');
				var $clickedSliderImg = $clickedSlider.children('img');

				// if (ind === 3) {
				if ($thumbActive.hasClass('nb-review-main-slider__thumb-text')) {
					if ($clickedSliderImg.length && typeof $clickedSliderImg[ind] !== "undefined") {
						$clickedSliderImg.removeClass('active');
					}
					$clickedSlider.hide();
					if ($thumbActive.siblings('.nb-review-main-slider__thumb-before').length || $thumbActive.siblings('.nb-review-main-slider__thumb-after').length) {
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
					$paginationBtn.addClass('nb-btn_disabled');
				}
				else {
					if (swiper.realIndex < (swiper.slides.length - 3)) {
						$paginationCounter.find('span').text(swiper.realIndex + 3);
						if ($paginationBtn.hasClass('nb-btn_disabled')) {
							$paginationBtn.removeClass('nb-btn_disabled');
						}
					}
					else {
						$paginationCounter.find('span').text(swiper.slides.length);
						$paginationBtn.addClass('nb-btn_disabled');
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
					if (!$wrapper.hasClass('nb-reviews_mobile')) {
						$wrapper.addClass('nb-reviews_mobile');
						$clickedSliderThumb.removeClass('nb-review-main-slider__thumb_active');
						$('.nb-review-main-slider__thumb:last-child').addClass('nb-review-main-slider__thumb_active');
						$('.nb-review-main-slider__img').hide().children().removeClass('active');
						// $('.nb-review-main-slider__img img:first-child').addClass('active');
						$('.nb-review-main__desc').show();
					}
				}
				else {
					if ($wrapper.hasClass('nb-reviews_mobile')) {
						$wrapper.removeClass('nb-reviews_mobile');
						$clickedSliderThumb.removeClass('nb-review-main-slider__thumb_active');
						$('.nb-review-main-slider__thumb:first-child').addClass('nb-review-main-slider__thumb_active');
						$('.nb-review-main-slider__img').show().children().removeClass('active');
						$('.nb-review-main-slider__img img:first-child').addClass('active');
						$('.nb-review-main__desc').show();
					}
				}
			}

			sliderMainArr[i].on('realIndexChange', function (swiper) {
				var $thumbsCol = $thumbsSlider.find('.nb-reviews-thumbs__col');
				$thumbsCol.removeClass('nb-reviews-thumbs__col_hide');
				$thumbsCol.eq(swiper.activeIndex).addClass('nb-reviews-thumbs__col_hide');
				// sliderThumbsArr[i].slideTo(swiper.activeIndex);
				sliderThumbsArr[i].slideToLoop(swiper.realIndex);
			});

			$thumbsSlider.find('.nb-reviews-thumbs__col').on('click', function () {
				var ind = +$(this).data('swiper-slide-index');
				sliderMainArr[i].slideTo(ind);
			});

			var $stub = $thumbsSlider.find('.nb-thumb');
			$stub.on('click', function (e) {
				e.preventDefault();
				e.stopPropagation();
			});

			// $thumbsSlider.on('click', '.nb-slider-arrow_prev', function (e) {
			// 	e.preventDefault();
			// 	$mainSlider.find('.nb-slider-arrow_prev').trigger('click');
			// });
			// $thumbsSlider.on('click', '.nb-slider-arrow_next', function (e) {
			// 	e.preventDefault();
			// 	$mainSlider.find('.nb-slider-arrow_next').trigger('click');
			// });
		});

	}

}

function servicesLinksMenu() {
	$('.nb-services-links-menu__title').on('click', function (e) {
		var $this = $(this);
		if ($(window).width() < 992) {
			e.preventDefault();
			var $openedMenu = $('.nb-services-links-menu_opened');
			var $wrapper = $this.closest('.nb-services-links-menu');
			var $list = $this.next('.nb-services-links-menu__dropdown');
			if (!$wrapper.hasClass('nb-services-links-menu_opened')) {
				if ($openedMenu.length) {
					$openedMenu.removeClass('nb-services-links-menu_opened');
					$openedMenu.find('.nb-services-links-menu__dropdown').css('display', 'block').slideUp(300, function () {
						$list.removeAttr('style');
					});
				}
				$wrapper.addClass('nb-services-links-menu_opened');
				if ($list.length) {
					$list.css('display', 'none').slideDown(300, function () {
						$list.removeAttr('style');
					});
				}
			}
			else {
				$wrapper.removeClass('nb-services-links-menu_opened');
				$list.css('display', 'block').slideUp(300, function () {
					$list.removeAttr('style');
				});
			}
		}
	});
	$(window).on('resize', function () {
		var $servicesLinksDesktop = $('.nb-services-links-menu_desktop');
		var $servicesLinksMenu = $('.nb-services-links-menu');
		var $servicesMenuDropdown = $('.nb-services-links-menu__dropdown');
		if ($(window).width() >= 992) {
			if (!$servicesLinksDesktop.length) {
				if ($servicesLinksMenu.length) {
					$servicesLinksMenu.removeClass('nb-services-links-menu_opened');
					$servicesLinksMenu.addClass('nb-services-links-menu_desktop');
				}
				if ($servicesMenuDropdown.length) {
					$servicesMenuDropdown.removeAttr('style');
				}
			}
		}
		else {
			if ($servicesLinksDesktop.length) {
				$servicesLinksDesktop.removeClass('nb-services-links-menu_desktop');
				if ($servicesLinksMenu.length) {
					$servicesLinksMenu.first().addClass('nb-services-links-menu_opened');
				}
			}
		}
	});
}

function doctorsSlider(el) {

	var $slider = (typeof el !== 'undefined') ? $(el) : $('.nb-doctors-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.nb-doctors__container');

			$sliderContainer.addClass('swiper').attr('data-slider-index', i);
			$this.find('.nb-doctors__list').addClass('swiper-wrapper');
			// $this.find('.nb-doctors__col').addClass('swiper-slide');
			// $this.append("<div class='nb-slider-pagination'></div>");
			$this.append(
				'<div class="nb-slider-arrows">' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
				slideClass: 'nb-doctors__col',
				navigation: {
					nextEl: $this.find(".nb-slider-arrow_next")[0],
					prevEl: $this.find(".nb-slider-arrow_prev")[0],
				},
				pagination: {
					el: $this.find('.nb-slider-pagination')[0],
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

			var slidesCount = $this.find('.nb-doctors__col').length;

			$this.append(
				'<div class="nb-pagination">' +
				'<div class="nb-pagination__inner">' +
				'<div class="nb-pagination__counter"><span class="font-weight_bold">' + sliderArr[i].params.slidesPerView + '</span> из ' + slidesCount + '</div>' +
				'<button class="nb-btn nb-btn_light nb-btn_shadow nb-pagination__btn" type="button">Показать еще</button>' +
				'</div>' +
				'</div>'
			);

			var $paginationBtn = $this.find('.nb-pagination__btn');
			var $paginationCounter = $this.find('.nb-pagination__counter');

			$this.append("<div class='nb-slider-fraction'></div>");
			var $fraction = $this.find('.nb-slider-fraction');
			$fraction.html('<span>1</span> из ' + slidesCount);

			sliderArr[i].on('slideChange', function (swiper) {
				$fraction.html('<span>' + (swiper.realIndex + 1) + '</span> из ' + slidesCount);

				if (swiper.slides.length <= swiper.params.slidesPerView) {
					$paginationCounter.find('span').text(swiper.slides.length);
					$paginationBtn.addClass('nb-btn_disabled');
				}
				else {
					if ((swiper.realIndex + swiper.params.slidesPerView - 1) < (swiper.slides.length - 1)) {
						$paginationCounter.find('span').text(swiper.realIndex + swiper.params.slidesPerView);
						if ($paginationBtn.hasClass('nb-btn_disabled')) {
							$paginationBtn.removeClass('nb-btn_disabled');
						}
					}
					else {
						$paginationCounter.find('span').text(swiper.slides.length);
						$paginationBtn.addClass('nb-btn_disabled');
					}
				}
			});

			$(window).on('resize', function () {
				if (sliderArr[i].slides.length <= sliderArr[i].params.slidesPerView) {
					$paginationCounter.find('span').text(sliderArr[i].slides.length);
					$paginationBtn.addClass('nb-btn_disabled');
				}
				else {
					if ((sliderArr[i].realIndex + sliderArr[i].params.slidesPerView - 1) < (sliderArr[i].slides.length - 1)) {
						$paginationCounter.find('span').text(sliderArr[i].realIndex + sliderArr[i].params.slidesPerView);
						if ($paginationBtn.hasClass('nb-btn_disabled')) {
							$paginationBtn.removeClass('nb-btn_disabled');
						}
					}
					else {
						$paginationCounter.find('span').text(sliderArr[i].slides.length);
						$paginationBtn.addClass('nb-btn_disabled');
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

	var $slider = (typeof slider !== 'undefined') ? $(slider) : $('.nb-doctors-main-slider');
	var $thumbs = (typeof thumbs !== 'undefined') ? $(thumbs) : $('.nb-doctors-thumbs-slider');
	var sliderMainArr = [];
	var sliderThumbsArr = [];

	if ($slider.length) {
		$slider.each(function (i) {

			var $mainSlider = $(this);
			var $mainSliderContainer = $mainSlider.find('.nb-doctors__container');
			var $mainSliderList = $mainSlider.find('.nb-doctors__list');

			var $pagination = $mainSlider.closest('.nb-section__body').find('.nb-pagination');
			var $paginationBtn = $pagination.find('.nb-pagination__btn');
			var $paginationCounter = $pagination.find('.nb-pagination__counter');

			$mainSliderContainer.addClass('swiper').attr('data-slider-index', i);
			$mainSliderList.addClass('swiper-wrapper');
			$mainSliderContainer.append("<div class='nb-slider-pagination'></div>");
			$mainSlider.append(
				'<div class="nb-slider-arrows">' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
				slideClass: 'nb-doctors__col',
				navigation: {
					nextEl: $mainSlider.find(".nb-slider-arrow_next")[0],
					prevEl: $mainSlider.find(".nb-slider-arrow_prev")[0],
				},
				pagination: {
					el: $mainSliderContainer.find('.nb-slider-pagination')[0],
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
					$paginationBtn.addClass('nb-btn_disabled');
				}
				else {
					if (swiper.realIndex < (swiper.slides.length - 3)) {
						$paginationCounter.find('span').text(swiper.realIndex + 3);
						if ($paginationBtn.hasClass('nb-btn_disabled')) {
							$paginationBtn.removeClass('nb-btn_disabled');
						}
					}
					else {
						$paginationCounter.find('span').text(swiper.slides.length);
						$paginationBtn.addClass('nb-btn_disabled');
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
			var $thumbsSliderContainer = $thumbsSlider.find('.nb-doctors__container');
			var $thumbsSliderList = $thumbsSlider.find('.nb-doctors__list');

			$thumbsSliderContainer.addClass('swiper').attr('data-slider-index', i);
			$thumbsSliderList.addClass('swiper-wrapper');
			$thumbsSlider.append("<div class='nb-slider-pagination'></div>");
			// $thumbsSlider.append(
			// 	'<div class="nb-slider-arrows">' +
			// 	'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
			// 	'<svg class="icon icon-slider-arrow">' +
			// 	'<use xlink:href="#slider-arrow"></use>' +
			// 	'</svg>' +
			// 	'</button>' +
			// 	'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
				slideClass: 'nb-doctors__col',
				loop: true,
				// navigation: {
				// 	nextEl: $thumbsSlider.find(".nb-slider-arrow_next")[0],
				// 	prevEl: $thumbsSlider.find(".nb-slider-arrow_prev")[0],
				// },
				pagination: {
					el: $thumbsSlider.find('.nb-slider-pagination')[0],
					clickable: true,
				}
			});

			sliderMainArr[i].on('realIndexChange', function (swiper) {
				var $thumbsCol = $thumbsSlider.find('.nb-doctors__col');
				// $thumbsCol.removeClass('nb-doctors__col_hide');
				// $thumbsCol.eq(swiper.activeIndex).addClass('nb-doctors__col_hide');
				// sliderThumbsArr[i].slideTo(swiper.activeIndex);
				sliderThumbsArr[i].slideToLoop(swiper.realIndex);
			});

			$thumbsSlider.find('.nb-doctors__col').on('click', function () {
				var ind = +$(this).data('swiper-slide-index');
				sliderMainArr[i].slideTo(ind);
			});

			var $stub = $thumbsSlider.find('.nb-thumb');
			$stub.on('click', function (e) {
				e.preventDefault();
				e.stopPropagation();
			});

		});
	}

}

function advantagesSection() {

	var $slider = $('.nb-advantages');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.nb-advantages__container');
			if ($(window).width() < 768) {
				$sliderContainer.addClass('swiper');
				$this.find('.nb-advantages__list').addClass('swiper-wrapper');
				$this.find('.nb-advantages__col').addClass('swiper-slide');
				$this.append("<div class='nb-slider-pagination'></div>");
				$this.append(
					'<div class="nb-slider-arrows">' +
					'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow">' +
					'<use xlink:href="#slider-arrow"></use>' +
					'</svg>' +
					'</button>' +
					'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
						nextEl: $this.find(".nb-slider-arrow_next")[0],
						prevEl: $this.find(".nb-slider-arrow_prev")[0],
					},
					pagination: {
						el: $this.find('.nb-slider-pagination')[0],
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
				$this.append("<div class='nb-slider-fraction'></div>");
				var $fraction = $this.find('.nb-slider-fraction');
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
						$this.find('.nb-advantages__list').addClass('swiper-wrapper');
						$this.find('.nb-advantages__col').addClass('swiper-slide');
						$this.append("<div class='nb-slider-pagination'></div>");
						$this.append(
							'<div class="nb-slider-arrows">' +
							'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
							'<svg class="icon icon-slider-arrow">' +
							'<use xlink:href="#slider-arrow"></use>' +
							'</svg>' +
							'</button>' +
							'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
								nextEl: $this.find('.nb-slider-arrow_next')[0],
								prevEl: $this.find('.nb-slider-arrow_prev')[0],
							},
							pagination: {
								el: $this.find('.nb-slider-pagination')[0],
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
						$this.append("<div class='nb-slider-fraction'></div>");
						var $fraction = $this.find('.nb-slider-fraction');
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
						$this.find('.nb-advantages__list').removeClass('swiper-wrapper');
						$this.find('.nb-advantages__col').removeClass('swiper-slide');
						$this.find('.nb-slider-pagination').remove();
						$this.find('.nb-slider-fraction').remove();
						$this.find('.nb-slider-arrows').remove();
					}
				}
			});

		});
	}

}

function clinicSlider($element) {

	var $slider = (typeof $element !== "undefined") ? $element : $('.nb-clinic-gallery');
	var sliderMainArr = [];
	var sliderThumbsArr = [];
	if ($slider.length) {
		$slider.each(function (i) {

			var $wrapper = $(this);

			var $thumbsSlider = $wrapper.find('.nb-clinic-gallery-desc');
			var $thumbsSliderContainer = $thumbsSlider.find('.nb-clinic-gallery-desc__container');
			var $thumbsSliderList = $thumbsSlider.find('.nb-clinic-gallery-desc__list');

			$thumbsSliderContainer.addClass('swiper').attr('data-slider-index', i);
			$thumbsSliderList.addClass('swiper-wrapper');
			$thumbsSlider.append("<div class='nb-slider-pagination'></div>");
			// $thumbsSlider.append(
			// 	'<div class="nb-slider-arrows">' +
			// 	'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
			// 	'<svg class="icon icon-slider-arrow">' +
			// 	'<use xlink:href="#slider-arrow"></use>' +
			// 	'</svg>' +
			// 	'</button>' +
			// 	'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
				slideClass: 'nb-clinic-gallery-desc__item',
				autoHeight: true,
				effect: 'fade',
				fadeEffect: {
					crossFade: true
				},
				allowTouchMove: false,
				// loop: true,
				// navigation: {
				// 	nextEl: $thumbsSlider.find(".nb-slider-arrow_next")[0],
				// 	prevEl: $thumbsSlider.find(".nb-slider-arrow_prev")[0],
				// },
				pagination: {
					el: $thumbsSlider.find('.nb-slider-pagination')[0],
					clickable: true,
				}
			});

			var $mainSlider = $wrapper.find('.nb-clinic-gallery-slider');
			var $mainSliderContainer = $mainSlider.find('.nb-clinic-gallery-slider__container');
			var $mainSliderList = $mainSlider.find('.nb-clinic-gallery-slider__list');

			$mainSliderContainer.addClass('swiper').attr('data-slider-index', i);
			$mainSliderList.addClass('swiper-wrapper');
			$mainSliderContainer.append("<div class='nb-slider-pagination'></div>");
			$mainSlider.append(
				'<div class="nb-slider-arrows">' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
				slideClass: 'nb-clinic-gallery-slider__col',
				navigation: {
					nextEl: $mainSlider.find(".nb-slider-arrow_next")[0],
					prevEl: $mainSlider.find(".nb-slider-arrow_prev")[0],
				},
				pagination: {
					el: $mainSliderContainer.find('.nb-slider-pagination')[0],
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

			$thumbsSlider.on('click', '.swiper-pagination-bullet', function () {
				sliderMainArr[i].slideToLoop($(this).index());
			});

		});
	}

}

function implantologySliders() {

	var $slider = $('.nb-implantology-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderMenu = $this.find('.nb-implantology-menu');
			var $sliderMenuItem = $sliderMenu.find('.nb-implantology-menu__item');
			var $sliderContainer = $this.find('.nb-implantology-slider__container');
			$sliderContainer.addClass('swiper');
			$this.find('.nb-implantology-slider__list').addClass('swiper-wrapper');
			$this.find('.nb-implantology-slider__item').addClass('swiper-slide');
			$this.append("<div class='nb-slider-pagination'></div>");
			$this.append(
				'<div class="nb-slider-arrows">' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
					nextEl: $this.find(".nb-slider-arrow_next")[0],
					prevEl: $this.find(".nb-slider-arrow_prev")[0],
				},
				pagination: {
					el: $this.find('.nb-slider-pagination')[0],
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
				$this.siblings().removeClass('nb-implantology-menu__item_active');
				$this.addClass('nb-implantology-menu__item_active');
				sliderArr[i].slideTo(index);
			});

		});
	}

}

function prostheticsSliders() {

	var $slider = $('.nb-prosthetics-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderMenu = $this.find('.nb-prosthetics-menu');
			var $sliderMenuItem = $sliderMenu.find('.nb-prosthetics-menu__item');
			var $sliderContainer = $this.find('.nb-prosthetics-slider__container');
			$sliderContainer.addClass('swiper');
			$this.find('.nb-prosthetics-slider__list').addClass('swiper-wrapper');
			$this.find('.nb-prosthetics-slider__item').addClass('swiper-slide');
			$this.append("<div class='nb-slider-pagination'></div>");
			$this.append(
				'<div class="nb-slider-arrows">' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
					nextEl: $this.find(".nb-slider-arrow_next")[0],
					prevEl: $this.find(".nb-slider-arrow_prev")[0],
				},
				pagination: {
					el: $this.find('.nb-slider-pagination')[0],
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
				$this.siblings().removeClass('nb-prosthetics-menu__item_active');
				$this.addClass('nb-prosthetics-menu__item_active');
				sliderArr[i].slideTo(index);
			});

		});
	}

}

function certificatesSlider() {

	var $slider = $('.nb-certificates');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.nb-certificates__container');
			$sliderContainer.addClass('swiper');
			$this.find('.nb-certificates__list').addClass('swiper-wrapper');
			$this.find('.nb-certificates__col').addClass('swiper-slide');
			$this.append("<div class='nb-slider-pagination'></div>");
			$this.append(
				'<div class="nb-slider-arrows">' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
				// noSwipingSelector: 'a',
				navigation: {
					nextEl: $this.find(".nb-slider-arrow_next")[0],
					prevEl: $this.find(".nb-slider-arrow_prev")[0],
				},
				// pagination: {
				// 	el: $this.find('.nb-slider-pagination')[0],
				// 	clickable: true,
				// },
				pagination: {
					el: $this.find('.nb-slider-pagination')[0],
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

function licensesSlider($element) {

	var $slider = (typeof $element !== "undefined") ? $element : $('.nb-licenses');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.nb-licenses__container');
			$sliderContainer.addClass('swiper');
			$this.find('.nb-licenses__list').addClass('swiper-wrapper');
			$this.find('.nb-licenses__col').addClass('swiper-slide');
			$this.append("<div class='nb-slider-pagination'></div>");
			$this.append(
				'<div class="nb-slider-arrows">' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
				// noSwipingSelector: 'a',
				navigation: {
					nextEl: $this.find(".nb-slider-arrow_next")[0],
					prevEl: $this.find(".nb-slider-arrow_prev")[0],
				},
				pagination: {
					el: $this.find('.nb-slider-pagination')[0],
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
	var $stagesSlider = $('.nb-stages-and-terms--slider');
	var $stagesSliderBox = $('.nb-stages-and-terms--box');


	function updateSlider() {
		var $stagesSliderMenu = $('.nb-stages-and-terms--menu-box');
		if ($stagesSliderMenu.length) {
			var $stagesSlideMenu = $('.nb-stages-and-terms--slide-menu');
			if ($(window).width() < 1024) {
				if (!$stagesSlideMenu.length) {
					var $menuSlide = $('<div data-slide="menu" class="swiper-slide nb-stages-and-terms--slide nb-stages-and-terms--slide-menu"></div>');
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
		var stageSlider = new Swiper ('.nb-stages-and-terms--slider', {
			speed: 800,
			slidesPerView: 1,
			spaceBetween: 10,
			pagination: {
				el: '.nb-stages-and-terms--pagination',
				clickable: true,
			},
			navigation: {
				nextEl: '.nb-stages-and-terms--next',
				prevEl: '.nb-stages-and-terms--prev',
			},
		});
		$(document).on('click',  '.nb-stages-and-terms--menu .nb-stages-and-terms--menu-item', function() {
			var index = $(this).index();
			$('.nb-stages-and-terms--menu-item').removeClass('is-active');
			$(this).addClass('is-active');
			stageSlider.slideTo(index);
			if ($(window).width() < 1024 && !$('.nb-stages-and-terms--container').hasClass('is-menu-hide')) {
				stageSlider.slideTo(index+1);
			}
			// if ($(window).width() < 1024 && !$('.nb-stages-and-terms--container').hasClass('is-menu-hide')) {
			// 	$('.nb-stages-and-terms--container').addClass('is-menu-hide')
			// }
		});
		stageSlider.on('slideChange ', function (e) {
			// console.log(stageSlider.activeIndex)
			$('.nb-stages-and-terms--menu-item').removeClass('is-active');
			$('.nb-stages-and-terms--menu-item').eq(stageSlider.activeIndex).addClass('is-active');
			// if ($(window).width() < 1024 && !$('.nb-stages-and-terms--container').hasClass('is-menu-hide')) {
			//   if ((stageSlider.activeIndex - stageSlider.previousIndex) == 1 || (stageSlider.activeIndex - stageSlider.previousIndex) ===-1   ) {
			// 	  // предотвращает перелистывание до исчезновения меню, но при этом учитывает использования точек
			// 	  stageSlider.slideTo(stageSlider.activeIndex - 1);
			//   }
			//   $('.nb-stages-and-terms--container').addClass('is-menu-hide')
			// }
		});
	}
	$(window).on('resize', function () {
		updateSlider();
	});
}

function stockSlide() {
	var $stagesSlider = $('.nb-stocks--slider');
	if ($stagesSlider.length) {
		var stageSlider = new Swiper ('.nb-stocks--slider', {
			speed: 800,
			slidesPerView: 2,
			spaceBetween: 10,
			pagination: {
				el: '.nb-stocks--pagination',
				clickable: true,
			},
			navigation: {
				nextEl: '.nb-stocks--next',
				prevEl: '.nb-stocks--prev',
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

		var $thumb = $stagesSlider.find('.nb-thumb');
		if ($thumb.length) {
			$thumb.on('click', function (e) {
				e.preventDefault();
				e.stopPropagation();
			});
		}

	}
}

let bigMap;
function initBigMap(lng, lat, title) {

	$('#map').removeClass('nb-general-map').addClass('nb-affiliated-map');

	bigMap = new ymaps.Map("map", {
		center: [lng,lat],
		zoom: 16,
		controls: []
	});

	bigMap.behaviors.disable('scrollZoom');

	var containerId = 'map';

	var ZoomLayout = ymaps.templateLayoutFactory.createClass('<div class="nb-general-map-zoom">' +
		'<div id="' + containerId + '--zoom-in" class="nb-general-map-zoom__btn nb-general-map-zoom__up"></div>' +
		'<div id="' + containerId + '--zoom-out" class="nb-general-map-zoom__btn nb-general-map-zoom__down"></div>' +
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
			iconImageHref: '/local/templates/nebolno/img/design/placemark.svg',
			iconImageSize: [46, 46],
			iconImageOffset: [-23, -23]
		}
	);

	// Добавляем все метки на карту.
	bigMap.geoObjects.add(myPlacemark1);

	$('.nb-map--info-box').show();
	$('.nb-map--title').show();
}
function initBigMapList(placemarks) {

	$('#map').addClass('nb-general-map');

	bigMap = new ymaps.Map("map", {
		center: [55.76, 37.64], // Координаты центра карты
		zoom: 11,
		controls: []
	});

	bigMap.behaviors.disable('scrollZoom');

	var containerId = 'map';

	var ZoomLayout = ymaps.templateLayoutFactory.createClass('<div class="nb-general-map-zoom">' +
		'<div id="' + containerId + '--zoom-in" class="nb-general-map-zoom__btn nb-general-map-zoom__up"></div>' +
		'<div id="' + containerId + '--zoom-out" class="nb-general-map-zoom__btn nb-general-map-zoom__down"></div>' +
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
				//iconContent: '<span data-btn-id="' + placemark.affiliatedId + '" class="nb-placemark-btn"></span>'
			},
			{
				iconLayout: 'default#imageWithContent',
				iconImageHref: '/local/templates/nebolno/img/design/placemark.svg',
				iconImageSize: [46, 46],
				iconImageOffset: [-23, -23]
			}
		);
		bigMap.geoObjects.add(marker);
		marker.events.add('click', function (e) {
			var $btn = $('.nb-affiliated[data-id="' + placemark.affiliatedId + '"] .nb-affiliated--button');
			$btn.trigger('click');
			var addressId = $btn.data('address-id');
			if (typeof $.cookie !== 'undefined') {
				$.cookie('chosenAddressId', addressId, { path: '/' });
			}
		});
	});

	$('.nb-map--info-box').hide();
	$('.nb-map--title').text('КЛИНИКИ «БЕЛЫЙ КРОЛИК» В МОСКВЕ');
}
$(window).on("load", function() {
	var $affiliated = $('.nb-affiliated');
	if ($(".nb-map").length && $affiliated.length) {
		if ((typeof $.cookie !== 'undefined' && typeof $.cookie('chosenAddressId') !== 'undefined' && $.cookie('chosenAddressId') !== '') || $affiliated.length === 1) {
			mapGeneration($('.nb-affiliated.is-active'));
			// console.log($.cookie('chosenAddressId'));
		}
		else {
			mapGenerationList($affiliated);
		}
	}
});
function mapMobile() {
	var mapGPS = $('.nb-affiliated--gps');
	// (data-longitude="55.79708856893388" data-latitude="37.58087599999998")
	var mapCar = [];
	var mapTransport = [];
	var MatkNav = [];
	var MatkTran = [];
	function initMap(){
		mapGPS.map(function (index, el) {
			var gpsLong = $(el).data('longitude');
			var gpsLat = $(el).data('latitude');
			var getBox = $(el).closest('.nb-affiliated--item').find('.nb-affiliated--map-content');
			$(el).closest('.nb-affiliated--item').find('.nb-affiliated--map-content').find('.nb-affiliated--map-car .nb-affiliated--map').attr('id', 'mapCar' + index);
			$(el).closest('.nb-affiliated--item').find('.nb-affiliated--map-content').find('.nb-affiliated--map-transport .nb-affiliated--map').attr('id', 'mapTransport' + index);
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

function mapGeneration($el) {
	var getContainer = $el.closest(".nb-affiliated--item");
	var getTitle = getContainer.find(".nb-affiliated").data('title');
	var getGps = getContainer.find(".nb-affiliated--gps");
	var gpsLng = getGps.data('longitude');
	var gpsLat = getGps.data('latitude');
	if (bigMap !== undefined) {
		bigMap.destroy();
	}
	var getTextCar = getContainer.find('.nb-affiliated--map-car .nb-affiliated--map-text').clone();
	var getTextTransport=  getContainer.find('.nb-affiliated--map-transport .nb-affiliated--map-text').clone();
	if (!$('.nb-map--section').hasClass('is-scrolling')) {
		$('.nb-map--section').attr('id', 'mapScroll').addClass('is-scrolling');
	}
	$('.nb-map--title').text(getTitle);
	$('.nb-map--info-car').find('.nb-map--info-text').html(getTextCar);
	$('.nb-map--info-transport').find('.nb-map--info-text').html(getTextTransport);

	setTimeout(function () {
		ymaps.ready(function () {initBigMap(gpsLng, gpsLat, getTitle);});
	}, 100);
}
function mapGenerationList($getGpsMap) {
	var placemarks = [];
	$getGpsMap.map(function (index, el) {
		var getTitle = $(el).data('title');
		var getGps = $(el).find('.nb-affiliated--gps');
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
$(document).on("click", ".nb-affiliated--button", function () {
	var $this = $(this);
	var dW = $(window).width();
	var addressId = $(this).data('address-id');

	if (typeof $.cookie !== 'undefined') {
		$.cookie('chosenAddressId', addressId, { path: '/' });
	}

	$('[id^="comp_"]').each(function() {
		var componentAjaxId = $(this).attr('id');
		BX.ajax.insertToNode(location.pathname + '?bxajaxid=' + componentAjaxId.replace('comp_', ''), componentAjaxId);
	});

	if ($this.closest('.nb-affiliated').hasClass('is-active')) {
		if (dW > 769) {
			document.getElementById('mapScroll').scrollIntoView({
				behavior: 'smooth'
			});
		}

		$('.nb-affiliated').removeClass('is-active');
	} else {
		if (dW > 769) {
			mapGeneration($this);
		} else {
			mapMobile();
		}
		$('.nb-affiliated').removeClass('is-active');
		$this.closest('.nb-affiliated').addClass('is-active');
	}

});

function stagesSection() {
	var $slider = $('.nb-stages-slider-wrapper');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderMenu = $this.find('.nb-stages-slider');
			var $sliderMenuItem = $sliderMenu.find('.nb-stages-slider__item');
			var $sliderContainer = $this.find('.nb-stages__container');
			if ($(window).width() < 576) {
				$sliderContainer.addClass('swiper');
				$this.find('.nb-stages-list').addClass('swiper-wrapper');
				$this.find('.nb-stages-item').addClass('swiper-slide');
				$this.append("<div class='nb-slider-pagination'></div>");
				$this.append(
					'<div class="nb-slider-arrows">' +
					'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow">' +
					'<use xlink:href="#slider-arrow"></use>' +
					'</svg>' +
					'</button>' +
					'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
						nextEl: $this.find(".nb-slider-arrow_next")[0],

						prevEl: $this.find(".nb-slider-arrow_prev")[0],
					},
					pagination: {
						el: $this.find('.nb-slider-pagination')[0],
						clickable: true,
					}
				});

				sliderArr[i].on('slideChange', function () {
					var index = sliderArr[i].activeIndex;
					$($sliderMenuItem[index]).siblings().removeClass('nb-stages-slider__item_active');
					$($sliderMenuItem[index]).addClass('nb-stages-slider__item_active');
				});

				$sliderMenuItem.on('click', function () {
					var $this = $(this);
					var index = $this.index();
					$this.siblings().removeClass('nb-stages-slider__item_active');
					$this.addClass('nb-stages-slider__item_active');
					sliderArr[i].slideTo(index);
				});
			}

			$(window).on('resize', function () {
				if ($(window).width() < 576) {
					if (!$sliderContainer.hasClass('swiper-initialized')) {
						$sliderContainer.addClass('swiper');
						$this.find('.nb-stages-list').addClass('swiper-wrapper');
						$this.find('.nb-stages-item').addClass('swiper-slide');
						$this.append("<div class='nb-slider-pagination'></div>");
						$this.append(
							'<div class="nb-slider-arrows">' +
							'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
							'<svg class="icon icon-slider-arrow">' +
							'<use xlink:href="#slider-arrow"></use>' +
							'</svg>' +
							'</button>' +
							'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
								nextEl: $this.find(".nb-slider-arrow_next")[0],

								prevEl: $this.find(".nb-slider-arrow_prev")[0],
							},
							pagination: {
								el: $this.find('.nb-slider-pagination')[0],
								clickable: true,
							}
						});

						sliderArr[i].on('slideChange', function () {
							var index = sliderArr[i].activeIndex;
							$($sliderMenuItem[index]).siblings().removeClass('nb-stages-slider__item_active');
							$($sliderMenuItem[index]).addClass('nb-stages-slider__item_active');
							// console.log($($sliderMenuItem[index]))
						});

						$sliderMenuItem.on('click', function () {
							var $this = $(this);
							var index = $this.index();
							$this.siblings().removeClass('nb-stages-slider__item_active');
							$this.addClass('nb-stages-slider__item_active');
							sliderArr[i].slideTo(index);
						});
					}
				} else {
					if (typeof sliderArr[i] !== 'undefined' && $sliderContainer.hasClass('swiper-initialized')) {
						sliderArr[i].destroy();
						$sliderContainer.removeClass('swiper');
						$this.find('.nb-stages-list').removeClass('swiper-wrapper');
						$this.find('.nb-stages-item').removeClass('swiper-slide');
						$this.find('.nb-slider-pagination').remove();
						$this.find('.nb-slider-fraction').remove();
						$this.find('.nb-slider-arrows').remove();
					}
				}
			});
		});
	}
}

function priceMenu() {
	$('.nb-price-item__header').on('click', function (e) {
		var $this = $(this);
		e.preventDefault();
		// var $openedMenu = $('.nb-price-item_opened');
		var $wrapper = $this.closest('.nb-price-item');
		var $list = $this.next('.nb-price-item__body');
		if (!$wrapper.hasClass('nb-price-item_opened')) {
			// if ($openedMenu.length) {
			// 	$openedMenu.removeClass('nb-price-item_opened');
			// 	$openedMenu.find('.nb-price-item__body').css('display', 'block').slideUp(300, function () {
			// 		$(this).removeAttr('style');
			// 	});
			// }
			$wrapper.addClass('nb-price-item_opened');
			if ($list.length) {
				$list.css('display', 'none').slideDown(300, function () {
					$(this).removeAttr('style');
				});
			}
		}
		else {
			$wrapper.removeClass('nb-price-item_opened');
			$list.css('display', 'block').slideUp(300, function () {
				$(this).removeAttr('style');
			});
		}
	});
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


const doctorAppointmentPhone = document.getElementById('nb-doctor-appointment-form-phone');
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
	var $slider = $('.nb-ba-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {

			var $this = $(this);
			var $sliderContainer = $this.find('.nb-ba-slider__container');
			var $sliderWrapper = $this.find('.nb-ba-slider__wrapper');
			var $sliderSlide = $this.find('.nb-ba-slider__slide');

			$sliderContainer.addClass('swiper');
			$sliderWrapper.addClass('swiper-wrapper');
			$sliderSlide.addClass('swiper-slide');
			// $this.append("<div class='nb-slider-pagination'></div>");
			$this.append(
				'<div class="nb-slider-arrows">' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow">' +
				'<use xlink:href="#slider-arrow"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="nb-slider-arrow nb-slider-arrow_next">' +
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
					nextEl: $this.find(".nb-slider-arrow_next")[0],
					prevEl: $this.find(".nb-slider-arrow_prev")[0],
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
				var $arrows = $this.find('.nb-slider-arrows');
				if (w < 992) {
					var $currentSlide = $(sliderArr[i].slides[sliderArr[i].activeIndex]);
					var $title = $currentSlide.find('h3');
					var $img = $currentSlide.find('.nb-ba__image');
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