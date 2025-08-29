const queryMobile1199 = window.matchMedia('(max-width: 1199px)');
const queryMobile767 = window.matchMedia('(max-width: 767px)');
const body = document.querySelector('body');

function touchScreenDetect() {
	return ( 'ontouchstart' in window ) || ( navigator.maxTouchPoints > 0 ) || ( navigator.msMaxTouchPoints > 0 );
}
var isTouch = touchScreenDetect();

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

	var $inputTel = $('.dp-input-tel');
	if ($inputTel.length) {
		$inputTel.inputmask({"mask": "+7 (999) 999-99-99"});
	}

	modals();
	categoriesSlider();
	topPageAncorSlider();
	servicesSlider();
	aboutSlider();
	catalogSlider();
	seriesGallery();

	var $select = $('.dp-select');
	if ($select.length) {
		$select.selectric({
			disableOnMobile: true,
			nativeOnMobile: true
		});
	}

	sticky();
	$(window).on('load resize scroll', sticky);

	$('[data-anchor]').on('click', function (e) {
		e.preventDefault();
		var id = $(this).attr('data-anchor');
		scrollToTarget(id);
	});

	$('.dp-catalog-menu-mobile-toggler .dp-btn, .dp-catalog-menu-mobile__close').on('click', function (e) {
		e.preventDefault();
		var $target = $('#dp-catalog-menu-mobile');
		var $b = $('body');
		if ($target.is('.active')) {
			$target.removeClass('active');
			$b.removeClass('dp-catalog-menu-mobile-open');
		}
		else {
			$target.addClass('active');
			$b.addClass('dp-catalog-menu-mobile-open');
		}
	});

	rangeSliders();

	// SERIES ASIDE FILTER
	$('.dp-series-models-aside-filter-toggler').click(function (e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$('.dp-series-models-aside-filter').toggleClass('active');
	});
	$('.dp-series-models-aside-filter__close').click(function (e) {
		e.preventDefault();
		$('.dp-series-models-aside-filter-toggler').removeClass('active');
		$('.dp-series-models-aside-filter').removeClass('active');
	});

	// SERIES MODEL CARD GALLERY
	modelCardSlider();

	// SERIES CHARS TOGGLING
	$('.dp-model-card__chars .dp-model-card__block-link').click(function (e) {
		e.preventDefault();
		var $toggler = $(this);
		$toggler.toggleClass('active');
		$toggler.closest('.dp-model-card__chars').find('.dp-model-card__chars-list').toggleClass('active');
	});

	// MODEL CARD BLOCKS TOGGLING
	$('.dp-model-card__block-head').click(function (e) {
		e.preventDefault();
		$(this).closest('.dp-model-card__block').toggleClass('active');
	});

	// MODEL CARD CONFIG TOGGLING
	$('.dp-model-card__config-toggler').click(function (e) {
		e.preventDefault();
		$(this).closest('.dp-model-card').find('.dp-model-card-config').toggleClass('active');
	});
	$('.dp-model-card-config__close').click(function (e) {
		e.preventDefault();
		$(this).closest('.dp-model-card-config').removeClass('active');
	});

	// HEADER DROPDOWNS TGGLING
	$('.dp-header-personal-menu__link:not(:only-child)').click(function (e) {
		e.preventDefault();
		var $item = $(this).closest('.dp-header-personal-menu__item');
		var $dropdown = $item.find('.dropdown');

		if (!$item.is('.active')) {
			$item.addClass('active');
			$dropdown.addClass('active');
			var hasclick = false;
			$("body").on("click.hpmi", function(evt) {
				if ($(evt.target) != $item && $(evt.target).closest($item).length < 1) {
					$item.removeClass('active');
					$dropdown.removeClass('active');
					$("body").off("click.hpmi");
				}
				hasclick = true;
			});
		}
		else {
			$item.removeClass('active');
			$dropdown.removeClass('active');
			$("body").off("click.hmi");
		}
	});
	$('.dp-header-menu__link:not(:only-child)').click(function (e) {
		e.preventDefault();
		var $item = $(this).closest('.dp-header-menu__item');
		var $dropdown = $item.find('.dropdown');

		if (!$item.is('.active')) {
			$item.addClass('active');
			$dropdown.addClass('active');
			var hasclick = false;
			$("body").on("click.hmi", function(evt) {
				if ($(evt.target) != $item && $(evt.target).closest($item).length < 1) {
					$item.removeClass('active');
					$dropdown.removeClass('active');
					$("body").off("click.hmi");
				}
				hasclick = true;
			});
		}
		else {
			$item.removeClass('active');
			$dropdown.removeClass('active');
			$("body").off("click.hmi");
		}
	});

	// SERIES MOBILE FILTER TOGGLING
	$('.dp-series-mobile-filter__item-head').click(function (e) {
		e.preventDefault();
		var $parent = $(this).closest('.dp-series-mobile-filter__item');
		if ($parent.is('.collapsed')) $parent.toggleClass('active');
	});


	// ACCOUNT CHANGE PASSWORD FORM TOGGLE EVENT
	$body.on('click', '.dp-form-change-password-toggle-btn', function (e) {
		e.preventDefault();
		$formChangePassword = $('#form-change-password');
		if ($formChangePassword.length) {
			$(this).hide();
			$formChangePassword.show();
		}
	});

	// ACCOUNT CHANGE PASSWORD CANCEL EVENT
	$body.on('click', '#form-change-password .dp-form__cancel', function (e) {
		e.preventDefault();
		$formChangePassword = $('#form-change-password');
		$formChangePasswordToggleBtn = $('.dp-form-change-password-toggle-btn');
		if ($formChangePasswordToggleBtn.length) {
			$formChangePassword.hide();
			$formChangePasswordToggleBtn.show();
		}
	});

	// ACCOUNT CHANGE PASSWORD CANCEL EVENT
	$body.on('click', '.dp-form-account-subscribe__change-email-btn', function (e) {
		e.preventDefault();
		var $this = $(this);
		$form = $this.closest('form');
		// $actions = $this.next('.dp-form-subscribe__change-email-actions');
		$input = $form.find('input[type="email"]');
		if ($input.length) {
			$input.removeAttr('disabled');
			$form.addClass('dp-form-account-subscribe_changed');
			// $actions.show();
			// $this.hide();
		}
	});
	$body.on('click', '.dp-form-account-subscribe__change-email-cancel', function (e) {
		e.preventDefault();
		var $this = $(this);
		$form = $this.closest('form');
		// $actions = $this.closest('.dp-form-subscribe__change-email-actions');
		$input = $form.find('input[type="email"]');
		// $changeEmailBtn = $form.find('.dp-form-subscribe__change-email-btn');
		if ($input.length) {
			$input.attr('disabled', 'disabled');
			// $actions.hide();
			// $changeEmailBtn.show();
			$form.removeClass('dp-form-account-subscribe_changed');
		}
	});

	// PORTFOLIO ASIDE TAGS
	$('.dp-tags .js-toggle-all-checkboxes').on('click', function (e) {
		e.preventDefault();
		var $t = $(this);
		var $cb = $t.closest('.dp-tags').find('input[type="checkbox"]');
		if ($t.is('.selected')) {
			$t.removeClass('selected');
			$cb.each(function () {
				this.checked = false;
			});
		}
		else {
			$t.addClass('selected');
			$cb.each(function () {
				this.checked = true;
			});
		}
	});

	$('.dp-tags input[type="checkbox"]').on('change', function (e) {
		var $p = $(this).closest('.dp-tags');
		var $t = $p.find('.js-toggle-all-checkboxes');
		var $ccb = $p.find('input[type="checkbox"]:not(:checked)');
		if ($ccb.length > 0) {
			$t.removeClass('selected');
		}
		else {
			$t.addClass('selected');
		}
	});

	MainPageCategoriesButtons();
	
	// SERIES MODAL MODELS ANCHORS
	$(document).on('click', '#modal-series-models [data-anchor]', function (e) {
		var targetModalId = $(this).attr('data-anchor');
		if (targetModalId.length > 0) {
			$('#modal-series-models').removeClass("dp-modal_active").fadeOut(300, function () {
				$body.removeClass("overflow-hidden");
				$body.css("padding-right", 0);
			});
		}
	});

	// DROPDOWN MENU EVENTS

	// $body.on('click', '.dp-dropdown__header', function () {
	// 	var $this = $(this);
	// 	var $dropdown = $this.closest('.dp-dropdown');
	// 	var $dropdownBody = $dropdown.find('.dp-dropdown__body');
	// 	if ($dropdown.hasClass('dp-dropdown_opened')) {
	// 		$dropdown.removeClass('dp-dropdown_opened');
	// 		$dropdownBody.slideUp(300, function () {
	// 			$(this).removeAttr('style');
	// 		});
	// 	}
	// 	else {
	// 		$dropdown.addClass('dp-dropdown_opened');
	// 		$dropdownBody.slideDown(300);
	// 	}
	// });
	// $body.on('change', '.dp-dropdown__input', function () {
	// 	var $this = $(this);
	// 	var $dropdown = $this.closest('.dp-dropdown');
	// 	var $dropdownBody = $dropdown.find('.dp-dropdown__body');
	// 	var $dropdownLabel = $this.next('.dp-dropdown__label');
	// 	var $dropdownTitle = $dropdown.find('.dp-dropdown__title');
	// 	$dropdownTitle.text($dropdownLabel.text());
	// 	if ($dropdown.hasClass('dp-dropdown_opened')) {
	// 		$dropdown.removeClass('dp-dropdown_opened');
	// 		$dropdownBody.hide(0, function () {
	// 			$(this).removeAttr('style');
	// 		});
	// 	}
	// });

	// $('.dp-ancor-menu__link').on('click', function () {
	// 	var id = $(this).attr('href');
	// 	scrollToTarget(id);
	// });
	//
	// $body.on('click', '.dp-review__more', function () {
	// 	var $this = $(this);
	// 	var $desc = $this.siblings('.dp-review__desc');
	// 	if (!$this.hasClass('dp-review__more_opened')) {
	// 		$desc.css({
	// 			// height: '5.6em',
	// 			maxHeight: 'none'
	// 		});
	// 		// $desc.slideDown(300, function () {
	// 			$this.addClass('dp-review__more_opened')
	// 		// });
	// 	}
	// 	else {
	// 		// $desc.slideUp(300, function () {
	// 		$desc.css({
	// 			// height: '5.6em',
	// 			maxHeight: '5.6em'
	// 		});
	// 		$this.removeClass('dp-review__more_opened')
	// 		// });
	// 	}
	// });

	$('.dp-qnt-field__input').on('keypress', function (e) {
		if ( e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57) ) {
			return false;
		}
	});
	$('.dp-qnt-field__btn_plus').on('click', function (e) {
		e.preventDefault();
		var $this = $(this);
		var $input = $this.siblings('.dp-qnt-field__input');
		$input.val(+$input.val() + 1);
	});
	$('.dp-qnt-field__btn_minus').on('click', function (e) {
		e.preventDefault();
		var $this = $(this);
		var $input = $this.siblings('.dp-qnt-field__input');
		var inputValue = +$input.val();
		if (inputValue > 1) {
			$input.val(inputValue - 1);
		}
		else {
			$input.val(1);
		}
	});

	$('.dp-account-order__props-toggle').on('click', function (e) {
		e.preventDefault();
		var $btn= $(this);
		var $props = $btn.siblings('.dp-account-order__props');
		if ($btn.hasClass('dp-btn_toggle_active')) {
			$btn.removeClass('dp-btn_toggle_active');
			if ($props.hasClass('dp-account-order__props_show')) {
				$props.show().slideUp(300, function () {
					$btn.children('span').text('Смотреть подробнее');
					$(this).removeClass('dp-account-order__props_show').removeAttr('style');
				})
			}
		}
		else {
			$btn.addClass('dp-btn_toggle_active');
			if (!$props.hasClass('dp-account-order__props_show')) {
				$props.hide().slideDown(300, function () {
					$btn.children('span').text('Скрыть');
					$(this).addClass('dp-account-order__props_show').removeAttr('style');
				})
			}
		}
	});

	$('.dp-account-order__remove').on('click', function (e) {
		e.preventDefault();
		$(this).closest('.dp-account-order').remove();
		var $selectedGoodsQnt = $('.dp-account-order-selected__goods-value');
		var $checkboxes = $('.dp-account-order__checkbox input:checked');
		var $removeLink = $('.dp-account-order-selected__remove');
		$selectedGoodsQnt.text($checkboxes.length);
		if ($checkboxes.length < 1) {
			$removeLink.hide();
		}
		else {
			$removeLink.show();
		}
	});

	$('.dp-account-order__checkbox input').on('change', function () {
		var $selectedGoodsQnt = $('.dp-account-order-selected__goods-value');
		var $checkboxes = $('.dp-account-order__checkbox input:checked');
		var $removeLink = $('.dp-account-order-selected__remove');
		$selectedGoodsQnt.text($checkboxes.length);
		if ($checkboxes.length < 1) {
			$removeLink.hide();
		}
		else {
			$removeLink.show();
		}
	});

	$('.dp-account-order-selected__remove').on('click', function (e) {
		e.preventDefault();
		var $selectedGoodsQnt = $('.dp-account-order-selected__goods-value');
		var $checkboxes = $('.dp-account-order__checkbox input:checked');
		var $selectedGoods = $checkboxes.closest('.dp-account-order');
		$selectedGoods.remove();
		$selectedGoodsQnt.text('0');
		$(this).hide();
	});

	$('.dp-account-order-submit').on('click', function () {

		var $checkboxes = $('.dp-account-order__checkbox input:checked');
		var $selectedGoods = $checkboxes.closest('.dp-account-order');
		var $modalSummaryList = $('.dp-form-commercial-offer-summary-list');
		var $modalGoodsList = $('.dp-form-commercial-offer-details-list');

		$modalSummaryList.empty();
		$modalGoodsList.empty();

		var totalModelQnt = $selectedGoods.length;
		var totalGoodsQnt = 0;

		$selectedGoods.each(function(i) {
			var $this = $(this);
			var title = $this.find('.dp-account-order__title').text();
			var code = $this.find('.dp-account-order__code').text();
			var qnt = +$this.find('.dp-qnt-field__input').val();
			$modalGoodsList.append('<li class="dp-form-commercial-offer-details-list__item"><span class="dp-form-commercial-offer-details-list__title">' + title + '</span><span class="dp-form-commercial-offer-details-list__code">' + code + '</span><span class="dp-form-commercial-offer-details-list__qnt">' + qnt + ' шт</span></li>');
			totalGoodsQnt += qnt;
		});

		$modalSummaryList.append('<li class="dp-form-commercial-offer-summary-list__item"><span class="dp-form-commercial-offer-summary-list__title">Количество моделей в&nbsp;ведомости</span><span class="dp-form-commercial-offer-summary-list__qnt">' + totalModelQnt + ' шт</span></li>');
		$modalSummaryList.append('<li class="dp-form-commercial-offer-summary-list__item"><span class="dp-form-commercial-offer-summary-list__title">Количество изделей в&nbsp;ведомости</span><span class="dp-form-commercial-offer-summary-list__qnt">' + totalGoodsQnt + ' шт</span></li>');
	});


	$('.dp-form-field-files')
	.on('change', '.dp-form-field-files-item__input', function () {
		var $this = $(this);
		if ($this.val() !== '') {
			var $item = $this.closest('.dp-form-field-files-item');
			$item.append('<span class="dp-form-field-files-item__info"><span class="dp-form-field-files-item__info-label">' + this.files[0].name + '</span><button class="dp-form-field-files-item__delete"><svg class="icon icon-trash "><use xlink:href="#trash"></use></svg></button></span>');
			$item.addClass('dp-form-field-files-item_added');
			$item.closest('.dp-form-field-files').prepend('<div class="dp-form-field-files-item"><div class="dp-form-field-files-item__main"><input class="dp-form-field-files-item__input" type="file" name="file[]"><span class="dp-form-field-files-item__btn"><span class="dp-form-field-files-item__btn-label">Прикрепить файл</span><span class="dp-form-field-files-item__btn-icon"></span></span></div></div>');
		}
	})
	.on('click', '.dp-form-field-files-item__delete', function () {
		var $this = $(this);
		var $item = $this.closest('.dp-form-field-files-item');
		$item.remove();
	});

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

function showModal(el) {
	if (typeof el !== 'undefined') {
		var paddingRight = window.innerWidth - document.body.clientWidth;
		var $body = $('body');
		var $header = $('.dp-header');
		var $modal = $(el);
		if ($modal.length) {
			$body.addClass("overflow-hidden");
			$body.css("padding-right", paddingRight + "px");
			$header.css("padding-right", paddingRight + "px");
			var $activeModals = $('.dp-modal_active');
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
			if (typeof $modal.attr('id') !== 'undefined') {
				var request = $.ajax({
					url: "/ajax/modals/" + $modal.attr('id').replace('#', '') + '.html',
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
					$body.css("padding-right", paddingRight + "px");
					$header.css("padding-right", paddingRight + "px");
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
		}
	}
}

function hideModal(el, speed) {
	if (typeof el !== 'undefined') {
		var $body = $('body');
		var $header = $('.dp-header');
		var spd = 300;
		if (typeof speed !== 'undefined') {
			spd = speed;
		}
		$(el).removeClass("dp-modal_active").fadeOut(spd, function () {
			$body.removeClass("overflow-hidden");
			$body.css("padding-right", 0);
			$header.css("padding-right", 0);
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

		showModal(modalSelector);

	});

	$body.on("click", ".dp-modal__close, .dp-modal__close-btn, .dp-modal__overlay", function (e) {
		e.preventDefault();
		hideModal($(this).closest(".dp-modal")[0]);
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

function topPageAncorSlider() {

	var $slider = $('.dp-tags-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $sliderContainer = $(this);
			var $sliderWrapper = $sliderContainer.find('.dp-tags__list');
			var $sliderItems = $sliderContainer.find('.dp-tags__item');
			$sliderContainer.addClass('swiper-container');
			$sliderWrapper.addClass('swiper-wrapper');
			$sliderItems.addClass('swiper-slide');
			if ($sliderItems.length > 0) {
				sliderArr[i] = new Swiper($sliderContainer[0], {
					spaceBetween: 0,
					speed: 400,
					slidesPerView: 'auto',
					navigation: false,
					pagination: false,
					// slidesPerGroup: 1,
					freeMode: true,
					// freeMode: {
					// 	enabled: true,
					// 	sticky: true,
					// }
				});

			}
		});
	}

}

function categoriesSlider() {

	var $slider = $('.dp-categories-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.dp-item-list').addClass('swiper-container');
			var $sliderWrapper = $('<div class="swiper-wrapper"></div>').appendTo($sliderContainer);

			var $sliderNav = $this.find('.dp-slider-arrows');
			if ($sliderNav.length > 0) {
				var $sliderArrowPrev = $('<div class="dp-slider-arrow prev"><svg class="icon icon-drop-right"><use xlink:href="#drop-right"></use></svg></div>').appendTo($sliderNav);
				var $sliderArrowNext = $('<div class="dp-slider-arrow next"><svg class="icon icon-drop-right"><use xlink:href="#drop-right"></use></svg></div>').appendTo($sliderNav);
			}

			var $sliderPagination = $this.find('.dp-categories-buttons');
			if ($sliderPagination.length > 0) {
				$sliderPagination.find('a').on('click', function (e) {
					e.preventDefault();
					var targetIndex = $(this).closest('li').index();
					sliderArr[i].slideTo(targetIndex);
				});
			}

			var $items = $this.find('.dp-categories-item');
			if ($items.length > 0) {
				$items.each(function () {
					$(this).wrap('<div class="swiper-slide"></div>');
				});
				var $slides = $this.find('.swiper-slide');
				$slides.appendTo($sliderWrapper)


				sliderArr[i] = new Swiper($sliderContainer[0], {
					spaceBetween: 20,
					speed: 300,
					slidesPerView: 'auto',
					slidesPerGroup: 1,
					navigation: {
						nextEl: $sliderArrowNext[0],
						prevEl: $sliderArrowPrev[0],
					},
					pagination: false
				});
			}

		});
	}

}
function servicesSlider() {

	var $slider = $('.dp-services-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.dp-item-list').addClass('swiper-container');
			var $sliderWrapper = $('<div class="swiper-wrapper"></div>').appendTo($sliderContainer);
			var $items = $this.find('.dp-services-item');
			if ($items.length > 0) {
				$items.each(function () {
					$(this).wrap('<div class="swiper-slide"></div>');
				});
				var $slides = $this.find('.swiper-slide');
				$slides.appendTo($sliderWrapper);

				$slides.on('mouseenter', function () {
					var $this = $(this);
					$this.addClass('hover');
					$this.siblings('.swiper-slide').removeClass('hover');
					$this.closest('.dp-services-slider').addClass('has-hover-slide');
					sliderArr[i].update();
				});
				$slides.on('mouseleave', function () {
					var $this = $(this);
					$this.removeClass('hover');
					$this.siblings('.swiper-slide').removeClass('hover');
					$this.closest('.dp-services-slider').removeClass('has-hover-slide');
					sliderArr[i].update();
				});

				// sliderArr[i] = new Swiper($sliderContainer[0], {
				// 	spaceBetween: 20,
				// 	speed: 300,
				// 	slidesPerView: 'auto',
				// 	navigation: false,
				// 	pagination: false,
				// 	slidesPerGroup: 1
				// });

			}

		});
	}

}
function MainPageCategoriesButtons() {

	var $slider = $('.dp-categories-slider .dp-categories-buttons');
	var sliderArr = [];
	if ($slider.length && window.matchMedia('(max-width: 767px)').matches) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.addClass('swiper-container');
			var $sliderWrapper = $this.find('.dp-categories-buttons__list').addClass('swiper-wrapper');
			var $items = $this.find('.dp-categories-buttons__item').addClass('swiper-slide');
			if ($items.length > 0) {

				sliderArr[i] = new Swiper($sliderContainer[0], {
					spaceBetween: 20,
					speed: 300,
					slidesPerView: 'auto',
					navigation: false,
					pagination: false,
					slidesPerGroup: 1
				});

			}

		});
	}

}
function aboutSlider() {

	var $slider = $('.dp-about-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderContainer = $this.find('.dp-item-list').addClass('swiper-container');
			var $sliderWrapper = $('<div class="swiper-wrapper"></div>').appendTo($sliderContainer);

			var $sliderNav = $this.find('.dp-slider-arrows');
			if ($sliderNav.length > 0) {
				var $sliderArrowPrev = $('<div class="dp-slider-arrow prev"><svg class="icon icon-drop-right"><use xlink:href="#drop-right"></use></svg></div>').appendTo($sliderNav);
				var $sliderArrowNext = $('<div class="dp-slider-arrow next"><svg class="icon icon-drop-right"><use xlink:href="#drop-right"></use></svg></div>').appendTo($sliderNav);
			}

			var $items = $this.find('.dp-about-item');
			if ($items.length > 0) {
				$items.each(function () {
					$(this).wrap('<div class="swiper-slide"></div>');
				});
				var $slides = $this.find('.swiper-slide');
				$slides.appendTo($sliderWrapper);

				sliderArr[i] = new Swiper($sliderContainer[0], {
					spaceBetween: 20,
					speed: 300,
					slidesPerView: 1,
					slidesPerGroup: 1,
					navigation: {
						nextEl: $sliderArrowNext[0],
						prevEl: $sliderArrowPrev[0],
					},
					pagination: false,
					breakpoints: {
						768: {
							slidesPerView: 2
						},
						992: {
							slidesPerView: 3
						},
						1200: {
							slidesPerView: 2
						}
					}
				});
			}

		});
	}

}
function catalogSlider() {

	var $slider = $('.dp-catalog-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $sliderContainer = $(this).addClass('swiper-container');
			var $sliderWrapper = $('<div class="swiper-wrapper"></div>').appendTo($sliderContainer);

			var $items = $sliderContainer.find('.dp-catalog-item');
			if ($items.length > 0) {
				$items.each(function () {
					$(this).wrap('<div class="swiper-slide"></div>');
				});
				var $slides = $sliderContainer.find('.swiper-slide');
				$slides.appendTo($sliderWrapper);

				sliderArr[i] = new Swiper($sliderContainer[0], {
					spaceBetween: 20,
					speed: 300,
					slidesPerView: 'auto',
					slidesPerGroup: 1,
					navigation: false,
					pagination: false
				});
			}

		});
	}

}

function seriesGallery() {
	var $slider = $('.dp-series-gallery');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {

			var $slider = $(this);
			sliderArr[i] = {};

			var $sliderMain = $slider.find('.dp-series-gallery__main');
			var $sliderMainContainer = false;
			var $sliderMainWrapper = false;
			var $sliderMainItems = [];
			var $sliderMainSlides = [];
			var $sliderMainArrows = false;

			if ($sliderMain.length === 1) {
				// $sliderMainContainer = $('<div class="swiper-container"></div>').appendTo($sliderMain);
				// $sliderMainWrapper = $('<div class="swiper-wrapper"></div>').appendTo($sliderMainContainer);
				$sliderMainContainer = $sliderMain.find('.dp-series-gallery__main-container');
				$sliderMainWrapper = $sliderMain.find('.dp-series-gallery__main-wrapper');
				
				$sliderMainContainer.addClass('swiper-container');
				$sliderMainWrapper.addClass('swiper-wrapper');
				
				var offsetRight = document.body.clientWidth - $sliderMain.offset().left - $sliderMain.width();
				$sliderMainContainer.css({
					'margin-right': -offsetRight,
					'padding-right': offsetRight
				});

				$sliderMainArrows = $sliderMain.find('.dp-slider-arrows');
				var $sliderArrowPrev = false;
				var $sliderArrowNext = false;
				if ($sliderMainArrows.length > 0) {
					$sliderArrowPrev = $('<div class="dp-slider-arrow prev"><svg class="icon icon-drop-right"><use xlink:href="#drop-right"></use></svg></div>').appendTo($sliderMainArrows);
					$sliderArrowNext = $('<div class="dp-slider-arrow next"><svg class="icon icon-drop-right"><use xlink:href="#drop-right"></use></svg></div>').appendTo($sliderMainArrows);
				}

				$sliderMainItems = $sliderMain.find('.dp-series-gallery__main-item');
				if ($sliderMainItems.length > 0) {
					$sliderMainItems.each(function () {
						$(this).wrap('<div class="swiper-slide"></div>');
					});
					$sliderMainSlides = $sliderMain.find('.swiper-slide');
					$sliderMainSlides.appendTo($sliderMainWrapper);

					sliderArr[i]['main'] = new Swiper($sliderMainContainer[0], {
						init: false,
						spaceBetween: 10,
						speed: 300,
						slidesPerView: 'auto',
						slidesPerGroup: 1,
						loop: false,
						// effect: 'fade',
						// fadeEffect: {
						// 	crossFade: true
						// },
						navigation: $sliderMainArrows ? {
							nextEl: $sliderArrowNext[0],
							prevEl: $sliderArrowPrev[0],
						} : false,
						pagination: false,
						breakpoints: {
							1200: {
								spaceBetween: 20,
							}
						}
					})
				}
			}

			var $sliderNav = $slider.find('.dp-series-gallery__nav');
			var $sliderNavContainer = false;
			var $sliderNavWrapper = false;
			var $sliderNavItems = [];
			var $sliderNavSlides = [];
			//var $sliderNavArrows = $sliderNav.find('.dp-slider-arrows');

			if ($sliderNav.length === 1) {
				// $sliderNavContainer = $('<div class="swiper-container"></div>').appendTo($sliderNav);
				// $sliderNavWrapper = $('<div class="swiper-wrapper"></div>').appendTo($sliderNavContainer);
				$sliderNavContainer = $sliderNav.find('.dp-series-gallery__nav-container');
				$sliderNavWrapper = $sliderNav.find('.dp-series-gallery__nav-wrapper');
				$sliderNavContainer.addClass('swiper-container');
				$sliderNavWrapper.addClass('swiper-wrapper');
				// $sliderMainNav = $sliderMain.find('.dp-slider-arrows');
				// var $sliderArrowPrev = false;
				// var $sliderArrowNext = false;
				// if ($sliderMainNav.length > 0) {
				// 	$sliderArrowPrev = $('<div class="dp-slider-arrow prev"><svg class="icon icon-drop-right"><use xlink:href="#drop-right"></use></svg></div>').appendTo($sliderMainNav);
				// 	$sliderArrowNext = $('<div class="dp-slider-arrow next"><svg class="icon icon-drop-right"><use xlink:href="#drop-right"></use></svg></div>').appendTo($sliderMainNav);
				// }

				$sliderNavItems = $sliderNav.find('.dp-series-gallery__nav-item');
				if ($sliderNavItems.length > 0) {
					$sliderNavItems.each(function () {
						$(this).wrap('<div class="swiper-slide"></div>');
					});
					$sliderNavSlides = $sliderNav.find('.swiper-slide');
					$sliderNavSlides.appendTo($sliderNavWrapper);

					sliderArr[i]['nav'] = new Swiper($sliderNavContainer[0], {
						init: false,
						// spaceBetween: 10,
						spaceBetween: 0,
						speed: 300,
						slidesPerView: 'auto',
						slidesPerGroup: 1,
						loop: false,
						navigation: false,
						pagination: false,
						// breakpoints: {
						// 	1200: {
						// 		spaceBetween: 20
						// 	}
						// }
					})
				}
			}

			if (sliderArr[i].main !== undefined) {

				if (sliderArr[i].nav !== undefined) {

					$sliderNavItems.on('click', function (e) {
						e.preventDefault();
						var tIndex = $(this).closest('.swiper-slide').index();
						sliderArr[i].main.slideTo(tIndex);
					});

					// sliderArr[i].main.on('slideChange', function (e) {
					// 	var tIndex = sliderArr[i].main.realIndex;
					// 	sliderArr[i].nav.slideTo(tIndex);
					// });

					sliderArr[i].nav.init();
				}

				sliderArr[i].main.init();

			}

		});
	}
}

function sticky() {
	var $stickyBlocks = $('.dp-sticky');
   	if ($stickyBlocks.length > 0 && !($stickyBlocks.hasClass('dp-sticky-materials') && queryMobile1199.matches)) {
		$stickyBlocks.each(function () {
			var $b = $(this);
			var bH = $b.innerHeight();

			var $c = $b.parent();
			var cH = $c.innerHeight();
			var cW = $c.width();
			var cL = $c.offset().left;
			var cT = $c.offset().top;

			var $w = $(window);
			var wH = $w.height();
			var wT = $w.scrollTop();

			$c.css('padding-top', bH);
			if (bH >= cH) {
				$b
					.removeClass('dp-sticky-fixed')
					.removeClass('dp-sticky-bottom')
					.addClass('dp-sticky-top')
					.css({
						position: 'absolute',
						top: 0,
						left: 0,
						width: cW
					})
			}
			else {
				if (wT < cT) {
					$b
						.removeClass('dp-sticky-fixed')
						.removeClass('dp-sticky-bottom')
						.addClass('dp-sticky-top')
						.css({
							position: 'absolute',
							top: 0,
							left: 0,
							width: cW
						})
				} else if (wT > (cT + cH - bH)) {
					$b
						.removeClass('dp-sticky-fixed')
						.removeClass('dp-sticky-top')
						.addClass('dp-sticky-bottom')
						.css({
							position: 'absolute',
							top: (cH - bH),
							left: 0,
							width: cW
						})
				} else {
					$b
						.addClass('dp-sticky-fixed')
						.removeClass('dp-sticky-top')
						.removeClass('dp-sticky-bottom')
						.css({
							position: 'fixed',
							top: 0,
							left: cL,
							width: cW
						})
				}
			}
		});
	}
}

function rangeSliders() {
	var $rangeSliders = $('.dp-ui-slider');
	if ($rangeSliders.length > 0) {
		$rangeSliders.each(function () {
			var $slider = $(this);
			var sliderLimits = (typeof $slider.data('limits') !== undefined ? ('' + $slider.data('limits')).split(',') : [0,100]);
			var sliderValues = (typeof $slider.data('values') !== undefined ? ('' + $slider.data('values')).split(',') : sliderLimits[1]);
			var isRange = (sliderValues.length > 1);
			var $inputs = $slider.closest('.dp-range-block').find('.dp-input');

			var sliderOpts = {
				step: 1,
				range: isRange,
				min: +sliderLimits[0],
				max: +sliderLimits[1]
			}

			if (isRange) sliderOpts['values'] = sliderValues;
			else sliderOpts['value'] = sliderValues[0];

			if ($inputs.length > 0) {
				SetPlaceholderToInputs((isRange ? sliderLimits : sliderLimits[1]), $inputs);
				SetValuesToInputs(sliderValues, $inputs);
				sliderOpts['slide'] = function(event, ui) {
					SetValuesToInputs((isRange ? ui.values : ui.value), $inputs);
				}
				$inputs.on('keyup', function () {
					//var $cInput = $(this);
					//if ($cInput.val() < sliderLimits[0]) $cInput.val(sliderLimits[0]);
					//if ($cInput.val() > sliderLimits[1]) $cInput.val(sliderLimits[1]);
					if (isRange) {
						$slider.slider("values", [+$inputs.eq(0).val(), +$inputs.eq(1).val()]);
					}
					else {
						$slider.slider("value", +$inputs.eq(0).val());
					}
				});
			}

			$slider.slider(sliderOpts)
		});
	}

	function SetPlaceholderToInputs(values, $inputs) {
		if ($inputs.length === 2) {
			$inputs.eq(0).attr('placeholder', +values[0]);
			$inputs.eq(1).attr('placeholder', +values[1])
		}
		else if ($inputs.length === 1) {
			$inputs.eq(0).attr('placeholder', values)
		}
	}
	function SetValuesToInputs(values, $inputs) {
		if ($inputs.length === 2) {
			$inputs.eq(0).val(values[0]);
			$inputs.eq(1).val(values[1])
		}
		else if ($inputs.length === 1) {
			$inputs.eq(0).val(values)
		}
	}
}

function modelCardSlider() {
	var $slider = $('.dp-model-card__gallery');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $sliderBlock = $(this);
			var $sliderContainer = $('<div class="swiper-container"></div>').appendTo($sliderBlock);
			var $sliderWrapper = $('<div class="swiper-wrapper"></div>').appendTo($sliderContainer);

			var $items = $sliderBlock.find('.dp-model-card__gallery-item');
			if ($items.length > 0) {
				$items.each(function () {
					$(this).wrap('<div class="swiper-slide"></div>');
				});
				var $slides = $sliderBlock.find('.swiper-slide');
				$slides.appendTo($sliderWrapper);

				sliderArr[i] = new Swiper($sliderContainer[0], {
					spaceBetween: 20,
					speed: 300,
					slidesPerView: 'auto',
					slidesPerGroup: 1,
					navigation: false,
					pagination: false
				});
			}

		});
	}

}

var $existTooltip = false;
if (window.matchMedia('(hover:none)').matches) {
	$(document).on('click', '[data-tooltip]', function(evt) {
		if (!!$existTooltip) {
			HideTooltip($existTooltip);
			$existTooltip = false;
			$(document).unbind('click.tooltip');
		}
		$existTooltip = ShowTooltip($(this));

		$(document).on('click.tooltip', function(clickOutside) {
			//clickOutside.preventDefault();
			HideTooltip($existTooltip);
			$existTooltip = false;
			$(document).off('click.tooltip');
		});
	});
}
else {
	var hideTooltipTimeout = false;

	$(document).on('mouseenter', '[data-tooltip]', function(evt) {
		clearTimeout(hideTooltipTimeout);
		if (!!$existTooltip) {
			HideTooltip($existTooltip);
			$existTooltip = false;
			$(document).unbind('click.tooltip');
		}
		$existTooltip = ShowTooltip($(this));
	});
	$(document).on('mouseleave', '[data-tooltip]', function() {
		if (!!$existTooltip) {
			hideTooltipTimeout = setTimeout(function () {
				HideTooltip($existTooltip);
				$existTooltip = false;
				clearTimeout(hideTooltipTimeout);
			}, 200)
		}
	});
	$(document).on('mouseenter', '.tooltip', function(evt) {
		clearTimeout(hideTooltipTimeout);
	});
	$(document).on('mouseleave', '.tooltip', function() {
		hideTooltipTimeout = setTimeout(function () {
			HideTooltip($existTooltip);
			$existTooltip = false;
			clearTimeout(hideTooltipTimeout);
		}, 200)
	});
}
function ShowTooltip($el) {
	var $w = $(window);
	var wT = $w.scrollTop();
	var wL = $w.scrollLeft();
	var wW = $w.innerWidth();
	var wH = $w.innerHeight();

	var elT = $el.offset().top;
	var elL = $el.offset().left;
	var elH = $el.outerHeight();
	var elW = $el.outerWidth();

	var $tooltip = $('<div class="tooltip"><div class="tooltip-inner"></div></div>');
	$tooltip.find('.tooltip-inner').html($el.attr('data-tooltip'));
	$tooltip.appendTo('body');

	var tH = $tooltip.outerHeight();
	var tW = $tooltip.outerWidth();

	var tolerance = 10;

	var forcePosition = $el.attr('data-tooltip-position');
	if (!!forcePosition || false) {
		$tooltip.addClass(forcePosition);

		if (forcePosition.indexOf('top') > -1) {
			$tooltip.css({
				'top': elT - tH - tolerance
			});
		}
		else if (forcePosition.indexOf('bottom') > -1) {
			$tooltip.css({
				'top': elT + elH + tolerance
			});
		}

		if (forcePosition.indexOf('left') > -1) {
			$tooltip.css({
				'left': elL + elW/2 - tW
			});
		}
		else if (forcePosition.indexOf('right') > -1) {
			$tooltip.css({
				'left': elL + elW/2
			});
		}
	}
	else {

		if (elT - wT > tH + tolerance) {
			$tooltip.addClass('top').css({
				'top': elT - tH - tolerance
			});
		}
		else {
			$tooltip.addClass('bottom').css({
				'top': elT + elH + tolerance
			});
		}

		if (wL + wW - elL - elW > tW + tolerance) {
			$tooltip.addClass('right').css({
				'left': elL + elW/2
			});
		} else {
			$tooltip.addClass('left').css({
				'left': elL + elW/2 - tW
			})
		}
	}

	$tooltip.addClass('open');
	return $tooltip;
}
function HideTooltip($t) {
	$t.removeClass('open');
	$t.remove();
}


// priceMenu();
// function priceMenu() {
// 	$('.dp-price-item__header').on('click', function (e) {
// 		var $this = $(this);
// 		e.preventDefault();
// 		var $openedMenu = $('.dp-price-item_opened');
// 		var $wrapper = $this.closest('.dp-price-item');
// 		var $list = $this.next('.dp-price-item__body');
// 		if (!$wrapper.hasClass('dp-price-item_opened')) {
// 			if ($openedMenu.length) {
// 				$openedMenu.removeClass('dp-price-item_opened');
// 				$openedMenu.find('.dp-price-item__body').css('display', 'block').slideUp(300, function () {
// 					$(this).removeAttr('style');
// 				});
// 			}
// 			$wrapper.addClass('dp-price-item_opened');
// 			if ($list.length) {
// 				$list.css('display', 'none').slideDown(300, function () {
// 					$(this).removeAttr('style');
// 				});
// 			}
// 		}
// 		else {
// 			$wrapper.removeClass('dp-price-item_opened');
// 			$list.css('display', 'block').slideUp(300, function () {
// 				$(this).removeAttr('style');
// 			});
// 		}
// 	});
//
// 	/*
// 	$('.dp-price-note button').on('click', function (e) {
// 		e.preventDefault();
// 		var $closePrice = $('.dp-price-table__dropdown');
// 		var $wrappers = $('.dp-price-item');
// 		if ($closePrice.length) {
// 			$wrappers.addClass('dp-price-item_opened');
// 			$closePrice.slideDown(300);
// 		}
// 	});
// 	 */
// }
//
// let _isScrolling = false;
// let $scrolltotop;
// // Append Button
// $("body").append(($scrolltotop = $("<a />").addClass("scroll-to-top").attr({href: "#", id: "scrollToTop"})));
//
// $(document).on("click", "#scrollToTop", function(e) {
// 	e.preventDefault();
// 	$("body, html").animate({scrollTop: 0}, 500);
//
// 	return false;
// });
//
// // Show/Hide Button on Window Scroll event.
// $(window).scroll(function() {
// 	if (!_isScrolling) {
// 		_isScrolling = true;
//
// 		if ($(window).scrollTop() > 150) {
// 			$scrolltotop.stop(true, true).addClass("visible");
// 			_isScrolling = false;
// 		} else {
// 			$scrolltotop.stop(true, true).removeClass("visible");
// 			_isScrolling = false;
// 		}
// 	}
// });

individualSlider();
function individualSlider() {
	const individualSlider = document.querySelector('.individual__slider')

	if (individualSlider) {
		const individualSlides = individualSlider.querySelectorAll('.individual__slide')

		individualSlides.forEach(function (item) {
			item.addEventListener('mouseenter', (e) => {
				e.preventDefault()
				individualSlides.forEach(function (item) {
					item.classList.remove('individual__slide-active')
				})
				item.classList.add('individual__slide-active')
			})
		})
	}
}

accordion('.contacts-way', '.contacts-way-title', '.contacts-way-toggle', 'contacts-way-title_open');
accordion('.content__faq', '.content__faq-question', '.content__faq-answer', 'content__faq-question_open');
function accordion(main, title, toggle, open) {
	$(title).on("click", function(e) {
		e.preventDefault();
		var $this = $(this);
		if (!$this.hasClass(open)) {
			$(toggle).slideUp(300);
			$(title).removeClass(open);
		}
		$this.toggleClass(open);
		$this.next().slideToggle();
	});
}

var yMapsBlockId;
yMapsBlockId = document.querySelector('#map-mafmarket');
if (yMapsBlockId) {
	ymaps.ready(function () {
		var myMap = new ymaps.Map('map-mafmarket', {
			center: [55.649246, 37.485583],
			zoom: 16,
		}, {
			searchControlProvider: 'yandex#search'
		});

		myPlacemarkFirst = new ymaps.Placemark(myMap.getCenter(), {
			hintContent: 'МАФ Маркет'
		}, {
			iconLayout: 'default#image',
			iconImageHref: '../img/design/icon-map.svg',
			iconImageSize: [40, 40],
			iconImageOffset: [-55, -50]
		});

		myPlacemarkFirst.events.add('click', function () {
			myMap.setCenter([55.649246, 37.485583], 16, {
				checkZoomRange: true
			});
		});

		myMap.geoObjects
			.add(myPlacemarkFirst);
	});
}

const materialsAsideMenu = document.querySelector('.dp-page-materials .dp-sticky-materials');

if (queryMobile1199.matches) {
	reductionColors(25);
	const mobileHideXL = document.querySelectorAll('.mobile-hide-xl');
	cutElement(materialsAsideMenu);
	showAsideMenu();
	removeElement(mobileHideXL);
}
if (queryMobile767.matches) {
	reductionColors(15);
}

function removeElement(element) {
	element.forEach(element => {
		element.remove();
	})
}

function showAsideMenu () {
	const materialsAsideButton = document.querySelector('.dp-page-materials .dp-aside-materials-button');
	const materialsAsideClose = document.querySelector('.dp-page-materials .aside-menu-close');
	if (materialsAsideButton && materialsAsideClose) {
		materialsAsideButton.addEventListener('click', (event) => {
			event.preventDefault();
			materialsAsideButton.classList.add('mobile-hide-xl');
			materialsAsideMenu.classList.add('visually-block');
			materialsAsideMenu.style.width = '100%';
		});
		materialsAsideClose.addEventListener('click', (event) => {
			event.preventDefault();
			materialsAsideButton.classList.remove('mobile-hide-xl');
			materialsAsideMenu.classList.remove('visually-block');
		});
	}
}

function cutElement(element) {
	if (element) {
		body.append(element);
	}
}

function reductionColors(quantity) {
	const materialsItemColorsAll = document.querySelector('.dp-page-materials .materials-item__colors-all')
	const materialsItemColor = document.querySelectorAll('.dp-page-materials .materials-item__color')
	if (materialsItemColorsAll && materialsItemColor) {
		materialsItemColor.forEach((element, index) => {
			if (index > quantity - 1) {
				element.classList.add('mobile-hide-lg')
				materialsItemColorsAll.classList.add('visually-block')
			}
		})
		materialsItemColorsAll.addEventListener('click', (e) => {
			e.preventDefault()
			materialsItemColorsAll.classList.remove('visually-block')
			materialsItemColor.forEach((element) => {
					element.classList.remove('mobile-hide-lg')
			})
		})
	}
}

searchPage()
function searchPage() {
	const modalSearch = document.getElementById('modal-search')
	const searchWrapperClose = document.querySelector('.search__wrapper_close')
	const headerSearch = document.querySelector('.dp-header-personal-menu__search')

	if (modalSearch && searchWrapperClose && headerSearch) {
		headerSearch.addEventListener('click', (event) => {
			event.preventDefault()
			modalSearch.classList.remove('display-none')
			body.classList.add('overflow-hidden')
		})
		searchWrapperClose.addEventListener('click', (event) => {
			event.preventDefault()
			console.log(modalSearch)
			modalSearch.classList.add('display-none')
			body.classList.remove('overflow-hidden')
		})
	}
}

const contentSliderSecond = new Swiper(".content__slider-second", {
	loop: true,
	spaceBetween: 10,
	slidesPerView: 3,
	freeMode: true,
	watchSlidesProgress: true,
	breakpoints: {
		768: {
			slidesPerView: 6
		},
		992: {
			slidesPerView: 6,
			spaceBetween: 20
		},
		1920: {
			slidesPerView: 9
		}
	}
});
const contentSliderMain = new Swiper(".content__slider-main", {
	loop: true,
	spaceBetween: 20,
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},
	thumbs: {
		swiper: contentSliderSecond
	}
});

const modalLogin = document.getElementById('modal-login')
const modalAuthorization = document.getElementById('modal-authorization')
const modalReg = document.getElementById('modal-reg')
const modalForgotPassword = document.getElementById('modal-forgot-password')

showModalLogin()
function showModalLogin() {
	const login = document.querySelector('.dp-header-personal-menu__account')
	if (modalLogin && login) {
		login.addEventListener('click', (event) => {
			event.preventDefault()
			modalLogin.style.display = 'block'
		})
	}
}
showModalAuthorization()
function showModalAuthorization() {
	const loginMail = document.querySelector('.dp-modal-login__mail')
	const loginRegistration = document.getElementById('modal-authorization__registration')
	const loginAuthorization = document.getElementById('modal-authorization__enter')
	const loginAuthorizationEnter = document.getElementById('modal-authorization__ent')
	const loginReg = document.getElementById('modal-authorization__reg')
	if (modalAuthorization && modalLogin && modalReg && loginMail && loginRegistration && loginAuthorization && loginAuthorizationEnter && loginReg) {
		loginMail.addEventListener('click', (event) => {
			event.preventDefault()
			modalLogin.style.display = 'none'
			modalAuthorization.style.display = 'block'
		})
		loginRegistration.addEventListener('click', (event) => {
			event.preventDefault()
			modalAuthorization.style.display = 'none'
			modalReg.style.display = 'block'
		})
		loginAuthorization.addEventListener('click', (event) => {
			event.preventDefault()
			modalAuthorization.style.display = 'none'
			modalLogin.style.display = 'block'
		})
		loginAuthorizationEnter.addEventListener('click', (event) => {
			event.preventDefault()
			modalReg.style.display = 'none'
			modalLogin.style.display = 'block'
		})
		loginReg.addEventListener('click', (event) => {
			event.preventDefault()
			modalReg.style.display = 'none'
			modalAuthorization.style.display = 'block'
		})
	}
}
showModalForgotPassword()
function showModalForgotPassword() {
	var $modalForgotPasswordTogglers = $('[href="#modal-forgot-password"]');
	if (modalForgotPassword && $modalForgotPasswordTogglers.length > 0) {
		$modalForgotPasswordTogglers.on('click', function (e) {
			e.preventDefault();
			$('.dp-modal').removeClass('dp-modal_active').css('display', 'none');
			$(modalForgotPassword).addClass('dp-modal_active').css('display', 'block');
		});
	}
}

const materialsItem = document.querySelectorAll('.materials-item__description')
hideMaterialsText()
function hideMaterialsText() {
	if (materialsItem) {
		materialsItem.forEach(element => {
			const materialsItemText = element.querySelector('.materials-item__text_hide')
			const materialsItemLink = element.querySelector('.materials-item__more')
			if (materialsItemText && materialsItemLink) {
				materialsItemLink.addEventListener('click', (e) => {
					e.preventDefault()
					materialsItemLink.classList.add('display-none')
					materialsItemText.classList.remove('display-none')
				})
			}
		})
	}
}

const headerPersonalMenu = document.querySelector('.dp-header-personal-menu__menu')
const megaMenu = document.getElementById('modal-mega')
const megaClose = document.querySelector('.mega__close')
showMega()
function showMega() {
	if (headerPersonalMenu && megaMenu && megaClose) {
		headerPersonalMenu.addEventListener('click', (e) => {
			e.preventDefault()
			megaMenu.style.display = 'block'
		})
		megaClose.addEventListener('click', (e) => {
			e.preventDefault()
			megaMenu.style.display = 'none'
		})
	}
}
