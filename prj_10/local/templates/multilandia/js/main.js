function touchScreenDetect() {
	return ('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0);
}
var isTouch = touchScreenDetect();

$(document).ready(function () {

	var $body = $('body');

	$.get($body.data('svg-sprite'), function (data) {

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
					for (var i = 0; i < iconList.length; i++) {
						$sprite.append($spriteFiltered.find('#' + iconList[i])[0]);
					}
				}
			}
			spriteWrapper.append($sprite[0]);
			$body.prepend(spriteWrapper);
		}

	});

	header();
	footer();
	tabBtnNav();
	pageMenu();
	mlSlider();
	dateSlider();
	sheduleSection();
	homeTopSlider();
	modalWorksSlider();
	modals();

	// var $inputTel = $('input[type="tel"]');
	// if ($inputTel.length) {
	// 	$inputTel.inputmask({"mask": "+7 (999) 999-9999"});
	// }

	// var $select = $('.js-select');
	// if ( $select.length) {
	// 	$select.selectric();
	// }

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

		if ($(window).width() < 992) {
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
		var $this = $(this);
		var $section = $this.closest('.filter-section-checked');
		var $checkedList = $section.children('.filter-checked-list');
		var $checkedItems = $checkedList.children('.filter-checked-item');
		$checkedItems.each(function () {
			var $this = $(this);
			$('#' + $this.data('filter-item')).prop('checked', false).removeAttr('checked');
			$this.remove();
		});
		$section.removeClass('filter-section-checked_active');
	});

	/*$('.filter-checked-item__clear').on('click', function () {
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
	});*/

	$('.ml-btn-filter').on('click', function (e) {
		e.preventDefault();
		showMobileFilter();
	});

	$body.on('click', '.ml-filter-overlay, .filter-close', function (e) {
		e.preventDefault();
		hideMobileFilter();
	});

	$body.on('click', '.filter-form__submit', function (e) {
		e.preventDefault();
		hideMobileFilter();
	});

	function showMobileFilter() {
		var $sidebar = $('.col-sidebar');
		var $filterOverlay = $('<div class="ml-filter-overlay"></div>');
		$body.addClass('overflow-hidden');
		$filterOverlay.appendTo('body');
		$sidebar.css('display', 'none').show(0, function () {
			$filterOverlay.fadeIn(300);
			$sidebar.addClass('col-sidebar_mobile-show').removeAttr('style');
		});
	}
	function hideMobileFilter(ms) {
		var time = (typeof ms !== "undefined") ? ms : 300;
		var $sidebar = $('.col-sidebar');
		var $filterOverlay = $('.ml-filter-overlay');
		$sidebar.css('display', 'block').removeClass('col-sidebar_mobile-show');
		$filterOverlay.fadeOut(time, function () {
			$filterOverlay.remove();
			$sidebar.removeAttr('style');
			$body.removeClass('overflow-hidden');
		});
	}

	$(window).on('resize', function () {
		if ($(window).width() >= 992 && $('.col-sidebar_mobile-show').length) {
			hideMobileFilter(0);
		}
	});

	var $sortSelect = $('.js-ml-form-sort select, #sort-works');
	if ($sortSelect.length) {
		$sortSelect.selectric();
	}

	var $formUploadWorkDropzone = $('.js-ml-dropzone');
	if ($formUploadWorkDropzone.length) {
		$formUploadWorkDropzone.dropzone({
			url: '/upload/temp/',
			thumbnailWidth: 780,
			thumbnailHeight: 780,
			thumbnailMethod: 'contain',
			maxFiles: 1,
			acceptedFiles: 'image/jpg, image/png, image/jpeg',
			// maxFilesize: 10485760,
			maxFilesize: 10,
			autoProcessQueue: false,
			// addRemoveLinks: '<button class="ml-dropzone-remove" type="button"><svg class="icon icon-close"><use xlink:href="#close"></use></svg></button>',
			previewTemplate: '<div class="dz-preview dz-image-preview ml-dropzone-preview">' +
				'<div class="dz-image ml-dropzone-image"><img data-dz-thumbnail></div>' +
				/*'<div class="dz-details">' +
				'<div class="dz-size"><span data-dz-size></span></div>' +
				'<div class="dz-filename"><span data-dz-name></span></div>' +
				'</div>' +*/
				//'<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>' +
				//'<div class="dz-success-mark"><svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <title>Check</title><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF"></path></g></svg></div>' +
				//'<div class="dz-error-mark"><svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <title>Error</title><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475"> <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"></path></g></g></svg></div>' +
				//'<div class="dz-error-message"><span data-dz-errormessage></span></div>' +
				'<button class="ml-dropzone-remove" type="button" title="Удалить изображение" data-dz-remove><svg class="icon icon-close"><use xlink:href="#close"></use></svg></button>' +
				'</div>',
			dictDefaultMessage: 'Перетащите файл сюда для загрузки',
			dictFallbackMessage: 'Ваш браузер не поддерживает загрузку файлов перетаскиванием',
			dictFallbackText: 'Пожалуйста, используйте поле для загрузки фалов',
			dictFileTooBig: 'Файл слишком большой ({{filesize}} mb). Максимальный размер файла: {{maxFilesize}} mb.',
			// dictInvalidFileType: 'Вы не можете загрузить файл данного типа',
			dictInvalidFileType: 'Вы не можете загрузить данный файл. Допустимый формат JPEG, JPG, PNG',
			dictResponseError: 'Сервер ответил с кодом {{statusCode}}.',
			dictCancelUpload: 'Отмена загрузки',
			dictCancelUploadConfirmation: 'Вы уверены, что хотите отменить загрузку?',
			dictRemoveFile: 'Удалить файл',
			dictMaxFilesExceeded: 'Загружено максимально возможное количество файлов',
			init: function () {
				this.on("addedfile", function (file) {
					var $el = $(this.element);
					var $parent = $el.parent('.ml-form-field');
					if ($parent.hasClass('ml-form-field_error')) {
						$parent.removeClass('ml-form-field_error');
					}
					var $error = $parent.find('.ml-form-error');
					if ($error.length) {
						$error.remove();
					}
				});
				this.on("removedfile", function (file) {
					// if (file.previewElement == null) {
					// 	var $el = $(this.element);
					// 	if ($el.hasClass('ml-dropzone_error')) {
					// 		$el.removeClass('ml-dropzone_error');
					// 	}
					// 	var $error = $el.parent('.ml-form-field').find('.ml-form-error');
					// 	if ($error.length) {
					// 		$error.remove();
					// 	}
					// }
				});
				this.on("error", function (file, message, xhr) {
					var $el = $(this.element);
					var $parent = $el.parent('.ml-form-field');
					$parent.addClass('ml-form-field_error');
					$el.after('<div class="ml-form-error">' + message + '</div>');
					if (xhr == null) {
						this.removeFile(file)
					}
				});
			}
		});
	}

	var $reviewTextarea = $('.ml-form-review textarea');
	if ($reviewTextarea.length) {
		$reviewTextarea.litesmileys({
			smileys: ["🙂", "😉", "😋", "🤩", "😄", "😥", "😞", "😤", "😳", "🐵", "💗", "😘", "👍", "👎"]
		});
	}

	changeCharacter404();
	changeCharacterModal();
	timer();
});


function header() {

	var $body = $('body');

	$('.ml-header-search-form__submit').on('click', function (e) {
		if ($(window).width() > 767) {
			var $body = $('body');
			var $headerSearch = $(this).closest('.ml-header-search');
			var $headerInput = $headerSearch.find('.ml-header-search-form__input');
			if (!$body.hasClass('ml-header-search-show')) {
				e.preventDefault();
				$body.addClass('ml-header-search-show');
				$headerInput.trigger('focus');
			}
			else {
				$body.removeClass('ml-header-search-show');
			}
		}
	});

	$('.ml-header-menu-dropdown__btn').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
		var $headerMenuDropdown = $('.ml-header-menu-dropdown');
		var $headerMenuDropdownList = $headerMenuDropdown.children('.ml-header-menu-dropdown__list');
		if ($headerMenuDropdown.hasClass('ml-header-menu-dropdown_active')) {
			$headerMenuDropdown.removeClass('ml-header-menu-dropdown_active');
			$headerMenuDropdownList.fadeOut(300);
		}
		else {
			$headerMenuDropdown.addClass('ml-header-menu-dropdown_active');
			$headerMenuDropdownList.fadeIn(300);
		}
	});
	$('.ml-header-menu-dropdown').on('click', function (e) {
		e.stopPropagation();
	});
	$body.on('click.dropdownMenuClick', function () {
		var $headerMenuDropdown = $('.ml-header-menu-dropdown');
		var $headerMenuDropdownList = $headerMenuDropdown.children('.ml-header-menu-dropdown__list');
		if ($headerMenuDropdown.hasClass('ml-header-menu-dropdown_active')) {
			$headerMenuDropdown.removeClass('ml-header-menu-dropdown_active');
			$headerMenuDropdownList.fadeOut(300);
		}
	});

	$('.ml-header-menu-toggle-btn').on('click', function (e) {
		e.preventDefault();
		var $body = $('body');
		var $mobileMenu = $('.ml-header-content');
		if (!$body.hasClass('ml-header-mobile-menu-active')) {
			$body.addClass('ml-header-mobile-menu-active');
			$mobileMenu.fadeIn(300);
		}
		else {
			$body.removeClass('ml-header-mobile-menu-active');
			$mobileMenu.fadeOut(300);
		}
	});

	$('.ml-header-menu-close-btn').on('click', function (e) {
		e.preventDefault();
		var $body = $('body');
		var $mobileMenu = $('.ml-header-content');
		if ($body.hasClass('ml-header-mobile-menu-active')) {
			$body.removeClass('ml-header-mobile-menu-active');
			$mobileMenu.fadeOut(300);
		}
	});

	$(window).on('resize', function () {
		var $body = $('body');
		var width = $(window).width();
		if (width > 767) {
			if ($body.hasClass('ml-header-mobile-menu-active')) {
				$body.removeClass('ml-header-mobile-menu-active');
			}
			var $headerContent = $('.ml-header-content');
			if ($headerContent.css('display') === 'none' || $headerContent.css('display') === 'block') {
				$headerContent.removeAttr('style');
			}
		}
		else {
			if ($body.hasClass('ml-header-search-show')) {
				$body.removeClass('ml-header-search-show');
			}
		}
	});
}

function footer() {
	$('.ml-footer-menu__title').on('click', function (e) {
		var $this = $(this);

		if ($(window).width() < 768) {
			var $menuContainer = $this.parent('.ml-footer-menu');
			var $submenu = $menuContainer.children('.ml-footer-menu__list');
			// if (!$submenu.length) {
			// 	e.preventDefault();
			// }
			// else {
			if ($submenu.length) {
				e.preventDefault();
				if ($menuContainer.hasClass('ml-footer-menu_opened')) {
					$menuContainer.removeClass('ml-footer-menu_opened');
					$submenu.slideUp(300, function () {
						$(this).removeAttr('style');
					});
				} else {
					var $openedMenu = $('.ml-footer-menu_opened');
					if ($openedMenu.length) {
						$openedMenu.removeClass('ml-footer-menu_opened');
						$openedMenu.find('.ml-footer-menu__list').slideUp(300, function () {
							$menuContainer.addClass('ml-footer-menu_opened');
							$submenu.slideDown(300);
						});
					}
					else {
						$menuContainer.addClass('ml-footer-menu_opened');
						$submenu.slideDown(300);
					}
				}
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

/* Функция с определением показывать или нет кнопки перелистывания слайдера --> */
function mlSlider() {

	var $mlSlider = $('.ml-slider');
	var mlSliderArr = [];
	if ($mlSlider.length) {
		$mlSlider.each(function (i) {
			var $this = $(this);
			var slideDesktopCount = +$(this).data('desktop-items');
			var themeColor = (typeof $(this).data('theme')) ? ' ml-slider-arrow_' + $(this).data('theme') : '';
			var $sliderContainer = $this.find('.ml-slider__container');
			$sliderContainer.addClass('swiper');
			$this.find('.ml-slider__wrapper').addClass('swiper-wrapper');
			$this.find('.ml-slider__item').addClass('swiper-slide');
			$this.append("<div class='ml-slider-pagination'></div>");

			// Определим, нужно ли показывать кнопки для листания слайдера -->
			var bShowArrows = true;
			var hideArrows = $(this).data('mode-slider');
			if (hideArrows == 'Y') {
				const windowInnerWidth = document.documentElement.clientWidth;
				var count_items = $this.find('.ml-slider__item').length;
				var _slidesPerView = 3;
				if (Number(windowInnerWidth) <= 768) {
					_slidesPerView = 3;
				}
				else if (Number(windowInnerWidth) < 1200) {
					_slidesPerView = 4;
				}
				else if (Number(windowInnerWidth) >= 1200) {
					_slidesPerView = 6;
				}
				if (
					Number(count_items) <= Number(_slidesPerView)
					&& Number(count_items) > 0
					&& Number(_slidesPerView) > 0
				) {
					bShowArrows = false;
				}
			}
			// <--

			if (bShowArrows == true) {
				$this.append(
					'<div class="ml-slider-arrows">' +
					'<button type="button" class="ml-slider-arrow' + themeColor + ' ml-slider-arrow_prev">' +
					'<svg class="icon icon-arrowLeft">' +
					'<use xlink:href="#arrowLeft"></use>' +
					'</svg>' +
					'</button>' +
					'<button type="button" class="ml-slider-arrow' + themeColor + ' ml-slider-arrow_next">' +
					'<svg class="icon icon-arrowRight">' +
					'<use xlink:href="#arrowRight"></use>' +
					'</svg>' +
					'</button>' +
					'</div>'
				);
			}
			var breakpoints = {
				1: {
					slidesPerView: 'auto',
					spaceBetween: 15
				},
				480: {
					slidesPerView: 'auto',
					spaceBetween: 20
				},
				768: {
					slidesPerView: 3,
					spaceBetween: 30
				},
				1201: {
					slidesPerView: (typeof slideDesktopCount !== 'undefined') ? slideDesktopCount : 4,
					spaceBetween: 28
				},
				1367: {
					slidesPerView: (typeof slideDesktopCount !== 'undefined') ? slideDesktopCount : 4,
					spaceBetween: 40
				}
			};
			if (typeof slideDesktopCount !== 'undefined' && slideDesktopCount === 1) {
				breakpoints = {};
			}
			mlSliderArr[i] = new Swiper($sliderContainer[0], {
				spaceBetween: 40,
				speed: 1000,
				freeMode: true,
				slidesPerView: (typeof slideDesktopCount !== 'undefined') ? slideDesktopCount : 4,
				navigation: {
					nextEl: $this.find(".ml-slider-arrow_next")[0],
					prevEl: $this.find(".ml-slider-arrow_prev")[0],
				},
				pagination: {
					el: $this.find('.ml-slider-pagination')[0],
					clickable: true,
				},
				breakpoints: breakpoints,
				watchSlidesProgress: true
			});
			//mlSliderArr[i].watchSlidesProgress = true;

		});
	}
}
/* <-- Функция с определением показывать или нет кнопки перелистывания слайдера */

/* Исходная функция -->
function mlSlider() {

	var $mlSlider = $('.ml-slider');
	var mlSliderArr = [];
	if ($mlSlider.length) {
		$mlSlider.each(function (i) {
			var $this = $(this);
			var slideDesktopCount = +$(this).data('desktop-items');
			var themeColor = (typeof $(this).data('theme')) ? ' ml-slider-arrow_' + $(this).data('theme') : '';
			var $sliderContainer = $this.find('.ml-slider__container');
			$sliderContainer.addClass('swiper');
			$this.find('.ml-slider__wrapper').addClass('swiper-wrapper');
			$this.find('.ml-slider__item').addClass('swiper-slide');
			$this.append("<div class='ml-slider-pagination'></div>");

			$this.append(
				'<div class="ml-slider-arrows">' +
				'<button type="button" class="ml-slider-arrow' + themeColor + ' ml-slider-arrow_prev">' +
				'<svg class="icon icon-arrowLeft">' +
				'<use xlink:href="#arrowLeft"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="ml-slider-arrow' + themeColor + ' ml-slider-arrow_next">' +
				'<svg class="icon icon-arrowRight">' +
				'<use xlink:href="#arrowRight"></use>' +
				'</svg>' +
				'</button>' +
				'</div>'
			);
			var breakpoints = {
				1: {
					slidesPerView: 'auto',
					spaceBetween: 15
				},
				480: {
					slidesPerView: 'auto',
					spaceBetween: 20
				},
				768: {
					slidesPerView: 3,
					spaceBetween: 30,
				},
				1201: {
					slidesPerView: (typeof slideDesktopCount !== 'undefined') ? slideDesktopCount : 4,
					spaceBetween: 28,
				},
				1367: {
					slidesPerView: (typeof slideDesktopCount !== 'undefined') ? slideDesktopCount : 4,
					spaceBetween: 40,
				}
			};
			if (typeof slideDesktopCount !== 'undefined' && slideDesktopCount === 1) {
				breakpoints = {};
			}
			mlSliderArr[i] = new Swiper($sliderContainer[0], {
				spaceBetween: 40,
				speed: 1000,
				slidesPerView: (typeof slideDesktopCount !== 'undefined') ? slideDesktopCount : 4,
				navigation: {
					nextEl: $this.find(".ml-slider-arrow_next")[0],
					prevEl: $this.find(".ml-slider-arrow_prev")[0],
				},
				pagination: {
					el: $this.find('.ml-slider-pagination')[0],
					clickable: true,
				},
				breakpoints: breakpoints
			});

		});
	}

}
/**/


function modalWorksSlider() {

	var $modalWorksSlider = $('.ml-works-slider');
	var modalWorksSliderArr = [];
	if ($modalWorksSlider.length) {
		$modalWorksSlider.each(function (i) {
			var $this = $(this);
			var $modalWorksSliderContainer = $this.find('.ml-works-slider__container');
			$modalWorksSliderContainer.addClass('swiper');
			$this.find('.ml-works-slider__list').addClass('swiper-wrapper');
			$this.find('.ml-works-slider__item').addClass('swiper-slide');
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

		});
	}

}

function dateSlider() {

	var $dateSlider = $('.date-slider');
	var dateSliderArr = [];
	if ($dateSlider.length) {
		$dateSlider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.date-slider__container');
			$sliderContainer.addClass('swiper');
			$this.find('.date-slider__wrapper').addClass('swiper-wrapper');
			$this.find('.date-slider__item').addClass('swiper-slide');
			// $this.append("<div class='date-slider-pagination'></div>");
			$this.append(
				'<div class="date-slider-arrows">' +
				'<button type="button" class="date-slider-arrow date-slider-arrow_prev">' +
				'<svg class="icon icon-arrowLeft">' +
				'<use xlink:href="#arrowLeft"></use>' +
				'</svg>' +
				'</button>' +
				'<button type="button" class="date-slider-arrow date-slider-arrow_next">' +
				'<svg class="icon icon-arrowRight">' +
				'<use xlink:href="#arrowRight"></use>' +
				'</svg>' +
				'</button>' +
				'</div>'
			);

			dateSliderArr[i] = new Swiper($sliderContainer[0], {
				// spaceBetween: 40,
				spaceBetween: 28,
				speed: 600,
				// slidesPerView: 'auto',
				slidesPerView: 6,
				navigation: {
					nextEl: $this.find(".date-slider-arrow_next")[0],
					prevEl: $this.find(".date-slider-arrow_prev")[0],
				},
				breakpoints: {
					1: {
						slidesPerView: 1,
						// slidesPerView: 2,
						spaceBetween: 0
					},
					481: {
						// slidesPerView: 'auto',
						slidesPerView: 2,
						spaceBetween: 20
					},
					660: {
						slidesPerView: 3,
						spaceBetween: 20
					},
					768: {
						// slidesPerView: 'auto',
						slidesPerView: 4,
						spaceBetween: 14
						// spaceBetween: 24
					},
					992: {
						slidesPerView: 4,
						spaceBetween: 24
					},
					1200: {
						// slidesPerView: 'auto',
						slidesPerView: 4,
						spaceBetween: 28
					},
					1367: {
						slidesPerView: 5,
						spaceBetween: 28
					},
					1681: {
						// slidesPerView: 'auto',
						slidesPerView: 6,
						spaceBetween: 28
						// spaceBetween: 40
					},
				}
			});

			var $activeDate = $this.find('.date-item_active');
			if ($activeDate.length) {
				dateSliderArr[i].slideTo($activeDate.parent().index());
			}
		});
	}

}

function sheduleSection() {

	$('.shedule__collapse-btn').on('click', function () {
		$this = $(this);
		$shedule = $this.closest('.shedule');
		$sheduleBody = $shedule.find('.shedule__body');
		if ($shedule.hasClass('shedule_active')) {
			$shedule.removeClass('shedule_active');
			$sheduleBody.slideUp(500);
		}
		else {
			var $sheduleActive = $shedule.siblings('.shedule_active');
			if ($sheduleActive.length) {
				var $sheduleActiveBody = $sheduleActive.find('.shedule__body');
				$sheduleActive.removeClass('shedule_active');
				$sheduleActiveBody.slideUp(500, function () {
					$shedule.addClass('shedule_active');
					$sheduleBody.slideDown(500);
				});
			}
			else {
				$shedule.addClass('shedule_active');
				$sheduleBody.slideDown(500);
			}
		}
	});

	$('.shedule-item__series-toggle').on('click', function () {
		var $this = $(this);
		var $seriesList = $this.next('.shedule-item__series');
		if ($this.hasClass('shedule-item__series-toggle_open')) {
			$this.removeClass('shedule-item__series-toggle_open');
			$seriesList.slideUp(300, function () {
				$seriesList.removeAttr('style');
			});
		}
		else {
			$this.addClass('shedule-item__series-toggle_open');
			$seriesList.slideDown(300);
		}
	});

}

function homeTopSlider() {

	var $homeTopSlider = $('.home-top-slider');
	var homeTopSliderArr = [];
	if ($homeTopSlider.length) {
		$homeTopSlider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.home-top-slider-container');
			$sliderContainer.addClass('swiper');
			$this.find('.home-top-slider-list').addClass('swiper-wrapper');
			$this.find('.home-top-slider-item').addClass('swiper-slide');
			$this.append("<div class='ml-slider-pagination'></div>");
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

			homeTopSliderArr[i] = new Swiper($sliderContainer[0], {
				spaceBetween: 40,
				speed: 1000,
				slidesPerView: 1,
				autoplay: {
					delay: 5000,
					disableOnInteraction: false
					// autoplayTimeLeft: function (swiper, timeLeft, percentage) {
					// 	console.log(timeLeft);
					// 	console.log(percentage);
					// },
				},
				loop: true,
				navigation: {
					nextEl: $this.find(".ml-slider-arrow_next")[0],
					prevEl: $this.find(".ml-slider-arrow_prev")[0],
				},
				pagination: {
					el: $this.find('.ml-slider-pagination')[0],
					clickable: true,
					renderBullet: function (index, className) {
						return `<span class="animated-bullet swiper-pagination-bullet"><span class="animated-bullet__half animated-bullet__half-1"></span><span class="animated-bullet__half animated-bullet__half-2"></span></span>`;
					},
				}
			});

			// homeTopSliderArr[i].on('autoplayTimeLeft', function (swiper, timeLeft, percentage) {
			// 	console.log(timeLeft);
			// 	console.log(percentage);
			// });

		});
	}

}

function modals() {

	var $body = $("body");

	$body.on("click", "[data-modal]", function (e) {
		//$("[data-modal]").on("click", function (e) {
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
					$modal.addClass("ml-modal_active").fadeIn(300);
				});
			}
			else {
				$modal.addClass("ml-modal_active").fadeIn(300);
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

				$('.ml-modals').append(msg);
				$modal = $(modalSelector);
				$body.addClass("overflow-hidden");
				var $activeModals = $('.ml-modal_active');
				if ($activeModals.length) {
					$activeModals.fadeOut(0, function () {
						$modal.addClass("ml-modal_active").fadeIn(300);
					});
				}
				else {
					$modal.addClass("ml-modal_active").fadeIn(300);
				}

			});

		}

	});

	$body.on('click', '.ml-modal__close, .ml-modal__overlay', function (e) {
		e.preventDefault();
		$(this).closest('.ml-modal').removeClass('ml-modal_active').fadeOut(300, function () {
			$body.removeClass('overflow-hidden');
		});
	});

	$body.on('click', '[data-entity="show-movie-detail-text"]', function (e) {
		e.preventDefault();
		var $this = $(this);
		var $modal = $this.closest('.ml-modal');
		if ($modal.length) {
			$modal.removeClass("ml-modal_active").fadeOut(300, function () {
				$body.removeClass("overflow-hidden");
			});
		}
		else {
			$this.remove();
			$('.ml-section-preview-text').remove();
			$('.ml-section-detail-text').css({ display: 'block' })
		}
	});

	$body.on('click', '[data-entity="show-contest-detail-text-conditions"]', function (e) {
		e.preventDefault();
		var $this = $(this);
		var $modal = $this.closest('.ml-modal');
		if ($modal.length) {
			$modal.removeClass("ml-modal_active").fadeOut(300, function () {
				$body.removeClass("overflow-hidden");
			});
		}
		else {
			$this.remove();
			$('.ml-section-preview-text-conditions').remove();
			$('.ml-section-detail-text-conditions').css({ display: 'block' })
		}
	});

}

function changeCharacter404() {
	var $img404Container = $('.section-404__img');
	if ($img404Container.length) {
		var characterImagesDir = '/img/characters/';
		var characterImagesExt = 'png';
		var characterImages = [
			'character1',
			'character2',
			'character3',
			'character4',
			'character5',
			'character6',
			'character7',
			'character8',
			'character9',
			'character10',
			'character11'
		];
		var randomIndex = getRandomInt(11);
		var $img = $('<img src="' + characterImagesDir + characterImages[randomIndex] + '.' + characterImagesExt + '" alt="404">');
		$img.appendTo($img404Container);
		setTimeout(function () {
			$img.addClass('img-404-animation');
		}, 100);

	}
}

function changeCharacterModal() {
	var $modalSuccess = $('.ml-modal-success-anim');
	if ($modalSuccess.length) {
		var characterImagesDir = '/img/characters/';
		var characterImagesExt = 'png';
		var characterImages = [
			'character1@2x',
			'character2@2x',
			'character3@2x',
			'character4@2x',
			'character5@2x',
			'character6@2x',
			'character7@2x',
			'character8@2x',
			'character9@2x',
			'character10@2x',
			'character11@2x'
		];
		$modalSuccess.each(function () {
			var $character = $(this).find('.ml-modal__character');
			$character.empty();
			var randomIndex = getRandomInt(11);
			var $img = $('<img src="' + characterImagesDir + characterImages[randomIndex] + '.' + characterImagesExt + '" alt="">');
			$img.appendTo($character);
			// setTimeout(function () {
			// 	$img.addClass('img-404-animation');
			// }, 100);
		});
	}
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
	for (var i = 0; i < $fields.length; i++) {
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
	for (var i = 0; i < $reqFields.length; i++) {
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

function timer() {
	var $timer = $('.ml-timer');
	if ($timer.length && typeof $timer.data('end') !== "undefined"/* && typeof $timer.data('start') !== "undefined"*/) {
		$timer.each(function () {
			var _this = this;
			var $this = $(this);
			$this.html(
				'<div class="ml-timer-container">' +
				'<div class="ml-timer-item ml-timer-item-days">' +
				'<div class="ml-timer-item__inner">' +
				'<div class="ml-timer-item__dial">' +
				'<div class="ml-timer-item__dial-left"><div class="ml-timer-item__dial-left-inner"></div></div>' +
				'<div class="ml-timer-item__dial-right"><div class="ml-timer-item__dial-right-inner"></div></div>' +
				'</div>' +
				'<div class="ml-timer-item__number"></div>' +
				'</div>' +
				'</div>' +
				'<div class="ml-timer-item ml-timer-item-hours">' +
				'<div class="ml-timer-item__inner">' +
				'<div class="ml-timer-item__dial">' +
				'<div class="ml-timer-item__dial-left"><div class="ml-timer-item__dial-left-inner"></div></div>' +
				'<div class="ml-timer-item__dial-right"><div class="ml-timer-item__dial-right-inner"></div></div>' +
				'</div>' +
				'<div class="ml-timer-item__number"></div>' +
				'</div>' +
				'</div>' +
				'<div class="ml-timer-item ml-timer-item-minutes">' +
				'<div class="ml-timer-item__inner">' +
				'<div class="ml-timer-item__dial">' +
				'<div class="ml-timer-item__dial-left"><div class="ml-timer-item__dial-left-inner"></div></div>' +
				'<div class="ml-timer-item__dial-right"><div class="ml-timer-item__dial-right-inner"></div></div>' +
				'</div>' +
				'<div class="ml-timer-item__number"></div>' +
				'</div>' +
				'</div>' +
				'<div class="ml-timer-item ml-timer-item-seconds">' +
				'<div class="ml-timer-item__inner">' +
				'<div class="ml-timer-item__dial">' +
				'<div class="ml-timer-item__dial-left"><div class="ml-timer-item__dial-left-inner"></div></div>' +
				'<div class="ml-timer-item__dial-right"><div class="ml-timer-item__dial-right-inner"></div></div>' +
				'</div>' +
				'<div class="ml-timer-item__number"></div>' +
				'</div>' +
				'</div>' +
				'</div>');
			var deadline = $this.data('end');
			var start = (typeof $timer.data('start') !== 'undefined') ? $this.data('start') : '';
			initializeClock(_this, deadline, start);
		});
	}
	function getTimeRemaining(endtime, starttime) {
		var now = Date.parse(new Date());
		var start = (typeof starttime !== 'undefined' && starttime !== '') ? Date.parse(starttime) : now;
		var end = Date.parse(endtime);
		var total = end - now;
		var totalStart = end - start;
		var seconds = Math.floor((total / 1000) % 60);
		var minutes = Math.floor((total / 1000 / 60) % 60);
		var hours = Math.floor((total / (1000 * 60 * 60)) % 24);
		var days = Math.floor(total / (1000 * 60 * 60 * 24));
		var daysStart = Math.floor(totalStart / (1000 * 60 * 60 * 24));

		return {
			total,
			days,
			hours,
			minutes,
			seconds,
			daysStart
		};
	}

	function initializeClock(el, endtime, starttime) {
		var $clock = $(el);
		var $days = $clock.find('.ml-timer-item-days');
		var $daysNumber = $days.find('.ml-timer-item__number');
		var $hours = $clock.find('.ml-timer-item-hours');
		var $hoursNumber = $hours.find('.ml-timer-item__number');
		var $minutes = $clock.find('.ml-timer-item-minutes');
		var $minutesNumber = $minutes.find('.ml-timer-item__number');
		var $seconds = $clock.find('.ml-timer-item-seconds');
		var $secondsNumber = $seconds.find('.ml-timer-item__number');

		function updateClock() {
			var t = getTimeRemaining(endtime, starttime);

			$daysNumber.text(t.days);
			$hoursNumber.text(t.hours);
			$minutesNumber.text(t.minutes);
			$secondsNumber.text(t.seconds);
			// $hoursNumber.text(('0' + t.hours).slice(-2));
			// $minutesNumber.text(('0' + t.minutes).slice(-2));
			// $secondsNumber.text(('0' + t.seconds).slice(-2));

			updateDial($days, t.days, t.daysStart);
			updateDial($hours, t.hours, 24);
			updateDial($minutes, t.minutes, 60);
			updateDial($seconds, t.seconds, 60);

			if (t.total <= 0) {
				clearInterval(timeinterval);
			}
		}

		updateClock();
		var timeinterval = setInterval(updateClock, 1000);
	}

	function updateDial($container, value, scale) {

		var $leftBar = $container.find('.ml-timer-item__dial-left-inner');
		var $rightBar = $container.find('.ml-timer-item__dial-right-inner');
		var step = 360 / scale;
		var leftBarStartAngle = 225;
		var leftBarStopAngle = 45;
		var rightBarStartAngle = 135;
		var rightBarStopAngle = -45;
		var roundedValue = Math.round(+value * step);

		if (roundedValue <= 180 && roundedValue >= 0) {
			var rightBarAngle = rightBarStartAngle - (180 - roundedValue);
			$rightBar.css({
				'-webkit-transform': 'rotate(' + rightBarAngle + 'deg)',
				'-ms-transform': 'rotate(' + rightBarAngle + 'deg)',
				'transform': 'rotate(' + rightBarAngle + 'deg)'
			});
			$leftBar.css({
				'-webkit-transform': 'rotate(' + leftBarStopAngle + 'deg)',
				'-ms-transform': 'rotate(' + leftBarStopAngle + 'deg)',
				'transform': 'rotate(' + leftBarStopAngle + 'deg)'
			});
		}
		else {
			var leftBarAngle = leftBarStartAngle - (360 - roundedValue);
			$leftBar.css({
				'-webkit-transform': 'rotate(' + leftBarAngle + 'deg)',
				'-ms-transform': 'rotate(' + leftBarAngle + 'deg)',
				'transform': 'rotate(' + leftBarAngle + 'deg)'
			});
			$rightBar.css({
				'-webkit-transform': 'rotate(' + rightBarStartAngle + 'deg)',
				'-ms-transform': 'rotate(' + rightBarStartAngle + 'deg)',
				'transform': 'rotate(' + rightBarStartAngle + 'deg)'
			});
		}

	}

}