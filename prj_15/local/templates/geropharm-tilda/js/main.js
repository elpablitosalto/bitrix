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

	homeTopAboutSlider();
	var $img = $('.dp-home-top__img img');
	var templatePath = '/local/templates/geropharm-main/';
	if (window.location.hostname === 'gerofarm.indadev.ru' || window.location.hostname === 'localhost') {
		templatePath = '/';
	}
	if ($img.length) {
		var homeTopImgArr = [
			'img/content/home-top/doc1.png',
			'img/content/home-top/doc2.png',
			'img/content/home-top/doc3.png',
			'img/content/home-top/doc4.png'
		];
		$img.attr('src', templatePath + homeTopImgArr[getRandomNumber(0, 3)]);
		$img.on('load', function () {
			$img.css('opacity', 1);
		});
	}

	header();
	modals();
	scrollToTop();
	faq();
	speakersSlider();
	blogSliderAutoplay();
	blogSlider();
	homeEventSlider();
	coursesSlider();
	actualSlider();

	var $select = $('.dp-form-select');
	if ($select.length) {
		$select.selectric({
			nativeOnMobile: false,
			onInit: function (element, selectric) {
				if ($(element).val() === 'default') {
					selectric.elements.label.css('color', '#999999');
				}
			},
			onChange: function (element, selectric) {
				$(element).change();
				if ($(element).val() === 'default') {
					selectric.elements.label.css('color', '#999999');
				}
				else {
					selectric.elements.label.removeAttr('style');
				}
			}
		});
	}

	var $range = $('.dp-form-range');
	if ($range.length) {
		$range.ionRangeSlider({
			skin: 'gerofarm',
			hide_min_max: true
		});
	}

	$body.on('click', '.dp-filter__title', function () {
		var $this = $(this);
		if ($(window).width() < 768) {
			var $filterModal = $(this).next('.dp-filter__modal');
			if ($filterModal.length) {
				$body.addClass('overflow-hidden');
				$('.dp-page').css('z-index', 100);
				$this.closest('.dp-section').css('z-index', 101);
				$filterModal.fadeIn(300, function () {

				});
			}
		}
	});

	$body.on('click', '.dp-filter__modal .dp-modal__overlay, .dp-filter__modal .dp-modal__close', function () {
		var $this = $(this);
		$('.dp-page').css('z-index', 3);
		$this.closest('.dp-section').removeAttr('style');
		$this.next('.dp-filter__modal').removeAttr('style');
	});

	$('.dp-bookmark-btn').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
		var $this = $(this);
		if (!$this.hasClass('dp-bookmark-btn_active')) {
			$this.addClass('dp-bookmark-btn_active');
		} else {
			$this.removeClass('dp-bookmark-btn_active');
		}
	});

	$('.dp-video__play').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
		var $this = $(this);
		var $videoContainer = $this.closest('.dp-video');
		var video = $videoContainer.find('video')[0];
		// var $poster = $videoContainer.find('.dp-video__poster');
		$videoContainer.addClass('dp-video_playing');
		video.play();
	});

	filterSlider();

	authFormProccess();
	questionnaireFormProccess();


	eventSlider();
	webinarSlider();
	articlesSlider();
	masterclassSlider();
	dashCoursesSlider();


	$body.on('click', '.dp-form-change-password-toggle-btn', function (e) {
		e.preventDefault();
		$formChangePassword = $('#form-change-password');
		if ($formChangePassword.length) {
			$(this).hide();
			$formChangePassword.show();
		}
	});

	$body.on('click', '#form-change-password .dp-form__cancel', function (e) {
		e.preventDefault();
		$formChangePassword = $('#form-change-password');
		$formChangePasswordToggleBtn = $('.dp-form-change-password-toggle-btn');
		if ($formChangePasswordToggleBtn.length) {
			$formChangePassword.hide();
			$formChangePasswordToggleBtn.show();
		}
	});

	$body.on('click', '.dp-field-confirm__btn', function (e) {
		e.preventDefault();
		$btn = $(this);
		$btnWrapper = $btn.parent();
		$input = $btnWrapper.prev('input');
		if ($input.attr('type') === 'email') {
			$btn.hide();
			$btnWrapper.append('<span class="dp-field-confirm__msg">Ссылка на подтверждение отправлена на почту ' + $input.val() + '</span>');
		}
	});

	var $homeTitleSpec = $('.dp-home-top__specialization');
	if ($homeTitleSpec.length) {
		var arSpecs = [
			'неврологов',
			'гинекологов',
			'урологов',
			'офтальмологов',
			'эндокринологов'
		];
		// if (arGlobalSpecs) {
		// 	arSpecs = arGlobalSpecs;
		// }
		var typed = new Typed('.dp-home-top__specialization', {
			strings: arSpecs,
			typeSpeed: 80,
			backDelay: 3000,
			// startDelay: 1000,
			loop: true
		});
	}


	var $searchResultForm = $('.dp-search-result-form');
	var $searchResultFormInput = $('.dp-search-result-form input[name="q"]');
	if ($searchResultFormInput.length && $searchResultFormInput.val().length > 0) {
		if (!$searchResultForm.hasClass('dp-search-result-form_active')) {
			$searchResultForm.addClass('dp-search-result-form_active');
		}
	}

	$searchResultForm
		.on('input change', 'input[name="q"]', function (e) {
			e.preventDefault();
			e.stopPropagation();
			var $input = $(this);
			if ($input.val().length > 0) {
				if (!$searchResultForm.hasClass('dp-search-result-form_active')) {
					$searchResultForm.addClass('dp-search-result-form_active');
				}
			}
			else {
				if ($searchResultForm.hasClass('dp-search-result-form_active')) {
					$searchResultForm.removeClass('dp-search-result-form_active');
				}
			}
		})
		.on('click', '.dp-search-result-form__clear', function (e) {
			e.preventDefault();
			e.stopPropagation();
			var $input = $searchResultForm.find('input[name="q"]');
			$input.val('');
			if (window.location.hostname === 'gerofarm.indadev.ru' || window.location.hostname === 'localhost') {
				window.location.pathname = '/search-start.html';
			}
			else {
				$searchResultForm.submit();
			}
		});

	var $searchArticleInput = $('.dp-form-search-items input[name="q"]');
	var isSearchArticleVal = false;
	if ($searchArticleInput.length) {
		var $closeBtn = $searchArticleInput.closest('form').find('.dp-form__close');
		if ($searchArticleInput.val().length > 0) {
			$closeBtn.show();
			isSearchArticleVal = true;
		}
		else {
			$closeBtn.hide();
		}
	}

	$('.dp-form-search-items')
		.on('input', 'input[name="q"]', function (e) {
			e.preventDefault();
			e.stopPropagation();
			var $input = $(this);
			var $closeBtn = $input.closest('form').find('.dp-form__close');
			if ($input.val().length > 0) {
				$closeBtn.show();
			}
			else {
				$closeBtn.hide();
			}
		})
		.on('change', 'input[name="q"]', function (e) {
			e.preventDefault();
			e.stopPropagation();
			var $input = $(this);
			var $form = $input.closest('form');
			var $closeBtn = $form.find('.dp-form__close');
			if ($input.val().length > 0) {
				$closeBtn.show();
			}
			else {
				$closeBtn.hide();
				if (isSearchArticleVal) {
					isSearchArticleVal = false;
					$form.submit();
				}
			}
		})
		.on('click', '.dp-form__close', function (e) {
			e.preventDefault();
			e.stopPropagation();
			var $closeBtn = $(this);
			var $form = $closeBtn.closest('form');
			var $input = $closeBtn.closest('form').find('input[name="q"]');
			$input.val('');
			if (isSearchArticleVal) {
				isSearchArticleVal = false;
				$form.submit();
			}
		});

	$('[data-mb-block]').on('click', function () {

		var $mbCalledPlace = $('.dp-mb-called-place');
		var $mbCalledUrl = $('.dp-mb-called-url');
		var index = +$(this).data('mb-block');
		var mbCalledPlaceDescArr = [
			'Кнопка [Вход и регистрация] в шапке сайта',
			'Кнопка [Получить подборку] блок [Вебинары и курсы для врачей] на главной странице',
			'Кнопка [Зарегистрироваться] детальная страница статьи',
			'Кнопка [Зарегистрироваться] блок [Еще 50+ материалов] на главной странице',
			'Кнопка [Зарегистрироваться] блок [Получите доступ к&nbsp;закрытым материалам Академии] на главной странице'
		];
		if ($mbCalledPlace.length) {
			$mbCalledPlace.val(mbCalledPlaceDescArr[index]);
		}
		if ($mbCalledUrl.length) {
			$mbCalledUrl.val(window.location.href);
		}
	});

	$('.dp-field-password-toggle-btn').on('click', function () {

		var $btn = $(this);
		var $input = $btn.siblings('input');

		if ($input.length) {
			if (!$btn.hasClass('dp-field-password-toggle-btn_active')) {
				$btn.addClass('dp-field-password-toggle-btn_active');
				$input.attr('type', 'text');
			}
			else {
				$btn.removeClass('dp-field-password-toggle-btn_active');
				$input.attr('type', 'password');
			}
		}

	});

	$('.dp-field-tooltip__btn')
		.on('mouseenter', function () {
			var $btn = $(this);
			var $container = $btn.closest('.dp-field-tooltip');
			if ($container.length) {
				$container.addClass('dp-field-tooltip_active');
			}
		})
		.on('mouseleave', function () {
			var $btn = $(this);
			var $container = $btn.closest('.dp-field-tooltip');
			if ($container.length) {
				$container.removeClass('dp-field-tooltip_active');
			}
		});

	initTelInput('.js-iti-input');
});

function clearFormFields(form) {

	var $form = $(form);
	var $input = $form.find('input');
	var $textarea = $form.find('textarea');
	var $select = $form.find('select');

	if ($section.hasClass('dp-field-error')) {
		$section.removeClass('dp-field-error');
	}

	var $error = $section.find('.dp-field-error-desc');
	if ($error.length) {
		$error.remove();
	}

	if ($textarea.length) {
		$textarea.each(function () {
			$(this).text('');
		});
	}

	if ($select.length) {
		$select.each(function () {
			this.selectedIndex = 0;
			$(this).trigger('change');
		});
	}

	if ($input.length) {
		$input.each(function () {
			var $this = $(this);
			var type = $this.attr('type');
			switch (type) {
				case 'radio':
					if ($this.prop('checked')) {
						$this.prop('checked', false).removeAttr('checked');
					}
					break;
				case 'checkbox':
					if ($this.prop('checked')) {
						$this.prop('checked', false).removeAttr('checked');
					}
					break;
				default:
					$this.val('');
			}
		});
	}

}

function validateForm(form, showErrorDesc) {

	var valid = true;
	var $form = $(form);
	var $reqFields = $form.find('[required]');

	for (var i = 0; i < $reqFields.length; i++) {
		if (!validateFormField($reqFields[i], showErrorDesc)) {
			valid = false;
		}
	}

	return valid;
}

function validateFormField(el, showErrorDesc) {

	var valid = true;
	var $field = $(el);
	// var fieldType = (el.nodeName === 'TEXTAREA') ? 'textarea' : $field.attr('type');
	var fieldType = $field.attr('type');
	var $fieldSection = $field.closest('.dp-field');

	$fieldSection.removeClass('.dp-field-error');
	var $error = $fieldSection.find('.dp-field-error-desc');
	if ($error.length) {
		$error.remove();
	}

	var errorDescArr = {
		text: 'Поле не должно быть пустым',
		email: 'Указан некорректный email',
		tel: 'Указан некорректный номер телефона',
		checkbox: 'Выберите один или несколько вариантов',
		radio: 'Выберите один из вариантов'
	};

	switch (fieldType) {
		case 'email':
			if ($field.val().length < 1) {
				valid = false;
				$fieldSection.addClass('dp-field-error');
				if (showErrorDesc) {
					$fieldSection.append('<div class="dp-field-error-desc">' + ($field.data('error') ? $field.data('error') : errorDescArr.text) + '</div>');
				}
			}
			else {
				if (!validateFormEmail($field.val())) {
					valid = false;
					$fieldSection.addClass('dp-field-error');
					if (showErrorDesc) {
						$fieldSection.append('<div class="dp-field-error-desc">' + ($field.data('error') ? $field.data('error') : errorDescArr.email) + '</div>');
					}
				}
			}
			break;
		case 'tel':
			if ($field.val().length < 1) {
				valid = false;
				$fieldSection.addClass('dp-field-error');
				if (showErrorDesc) {
					$fieldSection.append('<div class="dp-field-error-desc">' + ($field.data('error') ? $field.data('error') : errorDescArr.text) + '</div>');
				}
			}
			else {
				if ($field.siblings('.iti-input-error-message').length) {
					valid = false;
					$fieldSection.addClass('dp-field-error');
					if (showErrorDesc) {
						$fieldSection.append('<div class="dp-field-error-desc">' + ($field.data('error') ? $field.data('error') : errorDescArr.tel) + '</div>');
					}
				}
			}
			break;
		case 'hidden':
			if ($field.siblings('input[type="tel"]').length) {
				if ($field.siblings('input[type="tel"]').val().length < 1) {
					valid = false;
					$fieldSection.addClass('dp-field-error');
					if (showErrorDesc) {
						$fieldSection.append('<div class="dp-field-error-desc">' + ($field.data('error') ? $field.data('error') : errorDescArr.text) + '</div>');
					}
				}
				else {
					if ($field.siblings('.iti-input-error-message').length) {
						valid = false;
						$fieldSection.addClass('dp-field-error');
						if (showErrorDesc) {
							$fieldSection.append('<div class="dp-field-error-desc">' + ($field.data('error') ? $field.data('error') : errorDescArr.tel) + '</div>');
						}
					}
				}
			}
			break;
		case 'checkbox':
			if (!$field.prop('checked')) {
				valid = false;
				$fieldSection.addClass('dp-field-error');
				if (showErrorDesc) {
					$fieldSection.append('<div class="dp-field-error-desc">' + ($field.data('error') ? $field.data('error') : errorDescArr.checkbox) + '</div>');
				}
			}
			break;
		case 'radio':
			valid = false;
			$fieldSection.find('input').each(function (i) {
				var $this = $(this);
				if ($this.prop('checked')) {
					valid = true;
				}
			});
			if (!valid) {
				$fieldSection.addClass('dp-field-error');
				if (showErrorDesc) {
					$fieldSection.append('<div class="dp-field-error-desc">' + ($field.data('error') ? $field.data('error') : errorDescArr.radio) + '</div>');
				}
			}
			break;
		default:
			if ($field.val().length < 1) {
				valid = false;
				$fieldSection.addClass('dp-field-error');
				if (showErrorDesc) {
					$fieldSection.append('<div class="dp-field-error-desc">' + ($field.data('error') ? $field.data('error') : errorDescArr.text) + '</div>');
				}
			}
	}

	return valid;
}

function validateFormEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function formProccessRealtime(form) {
	if (typeof form !== 'undefined') {
		var $form = $(form);
		$form.on('input change', 'input[type="text"], input[type="email"], input[type="tel"], input[type="password"], textarea', function (e) {
			var $this = $(this);
			if (validateFormField(this, true)) {
				var $section = $this.closest('.dp-field');
				var $fieldError = $section.find('.dp-field-error-desc');
				if ($section.hasClass('dp-field-error')) {
					$section.removeClass('dp-field-error');
				}
				if ($fieldError.length) {
					$fieldError.remove();
				}
			}
		});

		$form.on('change', 'input[type="radio"]', function (e) {
			var $this = $(this);
			if (validateFormField(this)) {
				var $section = $this.closest('.dp-field');
				var $fieldError = $section.find('.dp-field-error-desc');
				if ($section.hasClass('dp-field-error')) {
					$section.removeClass('dp-field-error');
				}
				if ($fieldError.length) {
					$fieldError.remove();
				}
			}
		});

		$form.on('keypress', 'input[data-validate-type="number"]', function (e) {
			if (e.which !== 8 && e.which !== 0 && e.which !== 46 && (e.which < 48 || e.which > 57)) {
				return false;
			}
			else if (e.which === 46) {
				if (e.target.value.indexOf('.') !== -1) {
					return false;
				}
			}
		});

		$form.on('keypress', 'input[data-validate-type="year"]', function (e) {
			if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});
	}
}

function authFormProccess() {

	var $formAuth = $('#form-auth');
	var $formReg = $('#form-registration');
	if ($formAuth.length) {

		formProccessRealtime($formAuth[0]);

		var $nextBtn = $formAuth.find('.dp-form__next');
		var $submitBtn = $formAuth.find('.dp-form__submit');
		var $emailField = $formAuth.find('.dp-form-auth-field-email');
		var $emailFieldInput = $emailField.find('input');
		var $emailFieldEditBtn = $emailField.find('.dp-field-editable__btn');
		var $passwordField = $formAuth.find('.dp-form-auth-field-password');
		var $rememberField = $formAuth.find('.dp-form-auth-field-remember');

		$nextBtn.on('click', function (e) {

			e.preventDefault();

			if (validateFormField($emailFieldInput[0], true)) {
				if (window.location.hostname === 'gerofarm.indadev.ru' || window.location.hostname === 'localhost') {
					var isExistEmail = ($emailFieldInput.val() === 'test@test.ru') ? 'Y' : 'N';
					checkEmail(isExistEmail);
				}
				else {
					$.post("/core/ajax/checkEmail.php", { "email": $emailFieldInput.val() }).done(checkEmail);
				}

				function checkEmail(existEmail) {
					if (existEmail !== "Y") {
						$formAuth.closest('.dp-modal').hide(0, function () {
							$formReg.closest('.dp-modal').show();
							$formReg.find('input[type="email"]').val($emailFieldInput.val());
						});
					} else {
						$emailFieldInput.attr('disabled', 'disabled');
						$nextBtn.hide();
						$passwordField.show();
						$rememberField.show();
						$submitBtn.show();
					}
				}
			}

		});

		$emailFieldEditBtn.on('click', function () {
			$emailFieldInput.removeAttr('disabled');
		});

		$submitBtn.on('click', function (e) {
			var $form = $(this).closest('form');
			if (!validateForm($form[0], true)) {
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

	}
}

function questionnaireFormProccess() {

	var $modal = $('#modal-questionnaire');
	var $form = $('#form-questionnaire');
	var $progress = $modal.find('.dp-form-questionnaire-progress');
	var $progressScale = $progress.find('.dp-form-questionnaire-progress__scale');
	var $progressPercent = $progressScale.find('.dp-form-questionnaire-progress__percent');
	var $nextStepBtn = $form.find('.dp-form-questionnaire__next');
	var $skipStepBtn = $form.find('.dp-form-questionnaire__skip');
	var $backStepBtn = $modal.find('.dp-form-questionnaire-back');
	var $submitBtn = $form.find('.dp-form-questionnaire__submit');
	var $masterSteps = $form.find('[data-step]');
	var totalSteps = $masterSteps.length - 1;
	var stepPercents = 100 / totalSteps;
	var stepIndex = 0;
	var relatedstepIndex = '';
	var isStepRelated = false;

	$nextStepBtn.on('click', function (e) {
		e.preventDefault();
		nextStep(this);
	});

	$skipStepBtn.on('click', function (e) {
		e.preventDefault();
		nextStep(this);
	});

	function nextStep(el) {
		var $this = $(el);
		isStepRelated = false;
		if (typeof $this.data('related-step') !== 'undefined') {
			isStepRelated = true;
			relatedstepIndex = $this.data('related-step');
		}
		var $currentStep = $this.closest('.dp-form-questionnaire-step');
		var $nextStep = (isStepRelated) ? $form.find('.dp-form-questionnaire-step[data-related-step="' + $this.data('related-step') + '"]') : $form.find('.dp-form-questionnaire-step[data-step="' + (stepIndex + 1) + '"]');
		if ($nextStep.length) {
			var nextStepIndex = (isStepRelated) ? stepIndex : (stepIndex + 1);
			$currentStep.hide(0, function () {
				var percentCurrent = Math.round(stepIndex * stepPercents);
				var percentNext = Math.round(nextStepIndex * stepPercents);
				$nextStep.show(0, function () {
					$backStepBtn.data('step', stepIndex);
					stepIndex = nextStepIndex;
					if (nextStepIndex > 0) {
						$progress.show(0, function () {
							if (!isStepRelated) {
								$progressScale.css('width', percentNext + '%');
								textPercent();
							}
						});
						$backStepBtn.css({
							opacity: 1,
							visibility: 'visible'
						});
					}
				});

				function textPercent() {
					percentCurrent++;
					if (percentCurrent <= percentNext) {
						$progressPercent.text(percentCurrent + '%');
						setTimeout(textPercent, 50);
					}
				}

			});
		}
	}

	$backStepBtn.on('click', function (e) {
		e.preventDefault();
		var $currentStep = (isStepRelated) ? $form.find('.dp-form-questionnaire-step[data-related-step="' + relatedstepIndex + '"]') : $form.find('.dp-form-questionnaire-step[data-step="' + stepIndex + '"]');
		var $prevStep = (isStepRelated) ? $form.find('.dp-form-questionnaire-step[data-step="' + stepIndex + '"]') : $form.find('.dp-form-questionnaire-step[data-step="' + (stepIndex - 1) + '"]');
		if ($prevStep.length) {
			var prevStepIndex = (isStepRelated) ? stepIndex : (stepIndex - 1);
			$currentStep.hide(0, function () {
				var percentCurrent = Math.round(stepIndex * stepPercents);
				var percentPrev = Math.round(prevStepIndex * stepPercents);
				$prevStep.show(0, function () {
					stepIndex = prevStepIndex;
					if (prevStepIndex > 0) {
						$progress.show(0, function () {
							if (!isStepRelated) {
								$progressScale.css('width', percentPrev + '%');
								textPercent();
							}
							isStepRelated = false;
							relatedstepIndex = '';
						});
					}
					else {
						$progress.hide(0, function () {
							if (!isStepRelated) {
								$progressScale.css('width', percentPrev + '%');
								textPercent();
							}
							$backStepBtn.removeAttr('style').removeAttr('data');
							isStepRelated = false;
							relatedstepIndex = '';
						});
					}
				});

				function textPercent() {
					percentCurrent--;
					if (percentCurrent >= percentPrev) {
						$progressPercent.text(percentCurrent + '%');
						setTimeout(textPercent, 50);
					}
				}

			});
		}
	});


	$form.on('change', '.dp-field input[type="checkbox"], .dp-field input[type="radio"]', function () {
		var $this = $(this);
		var $step = $this.closest('.dp-form-questionnaire-step');
		if ($step.hasClass('dp-form-questionnaire-step_required')) {
			var $inputChecked = $step.find('input:checked');
			var $btnNext = $step.find('.dp-form-questionnaire__next');
			if ($inputChecked.length) {
				$btnNext.removeAttr('disabled');
			}
			else {
				$btnNext.attr('disabled', 'disabled');
			}
		}
	});

	$submitBtn.on('click', function (e) {
		e.preventDefault();
		if (validateForm($form[0], true)) {
			if (window.location.hostname === 'gerofarm.indadev.ru' || window.location.hostname === 'localhost') {
				alert('Отправка формы через ajax на сервер после успешной валидации на фронте. На сервере значения полей дополнительно проверяем. Если все хорошо, то выполняем определенные действия. Если нужно очистить все поля формы, то используем функцию clearFormFields(form).');
			}
			else {
				ajaxForm($form);
			}
		}
	});

}

function header() {

	var $body = $('body');

	$('.dp-header-search-btn').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
		// var $this = $(this);
		var $body = $('body');
		var width = $(window).width();
		if (width >= 768 && !$body.hasClass('dp-header-search-show')) {
			$body.addClass('dp-header-search-show');
			$('.dp-header-search-form__input').trigger('focus');
		}
	});

	$('.dp-header-search-form__close').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).siblings('.dp-header-search-form__input').val('');
		if ($body.hasClass('dp-header-search-show')) {
			$body.removeClass('dp-header-search-show');
		}
	});

	$('.dp-header-toggle-btn').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
		// var $header = $('.dp-header');
		// var $mobileMenu = $('.dp-header-dropdown');
		if ($body.hasClass('dp-header-mobile-menu-active')) {
			$body.removeClass('dp-header-mobile-menu-active');
			// $mobileMenu.show().fadeOut(300, function () {
			// 	$(this).removeAttr('style');
			// });
		}
		else {
			$body.addClass('dp-header-mobile-menu-active');
			// $mobileMenu.hide().fadeIn(300, function () {
			// 	$(this).removeAttr('style');
			// });
		}
	});

	$('.dp-header-menu__item_dropdown .dp-header-menu__link').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
		var $this = $(this);
		var $item = $this.parent();
		var $submenu = $this.next('.dp-header-submenu');
		var $submenuAllDropdownActive = $item.siblings('.dp-header-menu__item_dropdown-active');
		var $moreTabletActive = $('.dp-header-menu-tablet_active');
		var width = $(window).width();
		if (!$item.hasClass('dp-header-menu__item_dropdown-active')) {
			if (width < 992) {
				$submenu.hide().slideDown(300, function () {
					$(this).removeAttr('style');
				});
			}
			else {
				if ($submenuAllDropdownActive.length) {
					$submenuAllDropdownActive.show().find('.dp-header-submenu').fadeOut(100, function () {
						$(this).removeAttr('style');
					});
					$submenuAllDropdownActive.removeClass('dp-header-menu__item_dropdown-active');
				}
				if ($moreTabletActive.length) {
					$moreTabletActive.show().find('.dp-header-menu__list').fadeOut(100, function () {
						$(this).removeAttr('style');
					});
					$moreTabletActive.removeClass('dp-header-menu-tablet_active');
				}
				$submenu.hide().fadeIn(300, function () {
					$(this).removeAttr('style');
				});
			}
			$item.addClass('dp-header-menu__item_dropdown-active');
		}
		else {
			$item.removeClass('dp-header-menu__item_dropdown-active');
			if (width < 992) {
				$submenu.show().slideUp(300, function () {
					$(this).removeAttr('style');
				});
			}
			else {
				$submenu.show().fadeOut(300, function () {
					$(this).removeAttr('style');
				});
			}
		}
	});

	$('.dp-header-menu__more').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
		var width = $(window).width();
		if (width >= 992) {
			var $this = $(this);
			var $item = $this.parent();
			var $submenu = $this.next('.dp-header-menu__list');
			var $submenuAllDropdownActive = $('.dp-header-menu__item_dropdown-active');
			if (!$item.hasClass('dp-header-menu-tablet_active')) {
				if ($submenuAllDropdownActive.length) {
					$submenuAllDropdownActive.find('.dp-header-submenu').show().fadeOut(100, function () {
						$(this).removeAttr('style');
					});
					$submenuAllDropdownActive.removeClass('dp-header-menu__item_dropdown-active');
				}
				$item.addClass('dp-header-menu-tablet_active');
				$submenu.hide().fadeIn(300, function () {
					$(this).removeAttr('style');
				});
			}
			else {
				$item.removeClass('dp-header-menu-tablet_active');
				$submenu.hide().fadeOut(300, function () {
					$(this).removeAttr('style');
				});
			}
		}
	});

	$body.on('click', function () {
		if ($body.hasClass('dp-header-search-show')) {
			$body.removeClass('dp-header-search-show');
		}
		if ($body.hasClass('dp-header-mobile-menu-active')) {
			$body.removeClass('dp-header-mobile-menu-active');
		}

		var $menuTabletActive = $('.dp-header-menu-tablet_active');
		if ($menuTabletActive.length) {
			$menuTabletActive.removeClass('dp-header-menu-tablet_active');
		}

		var $menuItemDropdownActive = $('.dp-header-menu__item_dropdown-active');
		if ($menuItemDropdownActive.length) {
			$menuItemDropdownActive.removeClass('dp-header-menu__item_dropdown-active');
		}
	});

	$('.dp-header').on('click', function (e) {
		// e.stopPropagation();
		// var width = $(window).width();
		// if (width >= 992) {
		// 	e.stopPropagation();
		// }
	});

	$('.dp-header-search').on('click', function (e) {
		e.stopPropagation();
	});

	$('.dp-header-dropdown__inner').on('click', function (e) {
		var width = $(window).width();
		if (width >= 768) {
			e.stopPropagation();
		}
	});

	$('.dp-header-dropdown').on('click', function (e) {
		var width = $(window).width();
		if (width < 768) {
			e.stopPropagation();
		}
	});

	// $('.dp-header-dropdown').on('click', function (e) {
	// 	var width = $(window).width();
	// 	if (width < 992) {
	// 		e.stopPropagation();
	// 	}
	// });

	function changeSearchInputPlaceholder() {
		var width = $(window).width();
		var $headerSearchInput = $('.dp-header-search-form__input, .dp-search-result-form__input');
		if ($headerSearchInput.length) {
			if (width > 1200) {
				$headerSearchInput.attr('placeholder', 'Введите ключевые слова, например, “трудный пациент”');
			}
			else if (width < 768) {
				$headerSearchInput.attr('placeholder', 'Поиск');
			}
			else {
				$headerSearchInput.attr('placeholder', 'Введите ключевые слова');
			}
		}
	}

	changeSearchInputPlaceholder();

	$(window).on('resize', function () {
		var $body = $('body');
		var width = $(window).width();
		if (width < 768) {
			if ($body.hasClass('dp-header-search-show')) {
				$body.removeClass('dp-header-search-show');
			}
		}
		if (width >= 992) {
			if ($body.hasClass('dp-header-mobile-menu-active')) {
				$body.removeClass('dp-header-mobile-menu-active');
			}
		}
		changeSearchInputPlaceholder();
	});
}

function getRandomNumber(min, max) {
	return Math.floor(Math.random() * (max - min + 1)) + min;
}

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
			if ($(modalSelector + '_error').length) {
				$(modalSelector + '_error').html('');
			}
			if ($(modalSelector + '_msg').length) {
				$(modalSelector + '_msg').html('');
			}

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

	$body.on("click", ".dp-modal__close, .dp-modal__close-btn, .dp-modal__overlay", function (e) {
		e.preventDefault();
		var $modal = $(this).closest(".dp-modal");
		$modal.removeClass("dp-modal_active").fadeOut(300, function () {
			$body.removeClass("overflow-hidden");
			$body.css("padding-right", 0);
		});
	});

	$body.on("click", ".dp-modal-required__confirm-btn", function (e) {
		e.preventDefault();
		var $modal = $(this).closest(".dp-modal");
		$modal.removeClass("dp-modal_active").fadeOut(300, function () {
			$body.removeClass("overflow-hidden");
			$body.css("padding-right", 0);
		});
	});
}

function scrollToTop() {

	let _isScrolling = false;
	let $scrolltotop;

	$("body").append(($scrolltotop = $("<a />").addClass("scroll-to-top").attr({ href: "#", id: "scrollToTop" })));

	$(document).on("click", "#scrollToTop", function (e) {
		e.preventDefault();
		$("body, html").animate({ scrollTop: 0 }, 500);

		return false;
	});

	$(window).scroll(function () {
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

}

function filterSlider() {

	var $slider = $('.dp-filter-slider .dp-filter-form__body');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $sliderContainer = $(this);
			function initSlider() {
				$sliderContainer.addClass('swiper');
				$sliderContainer.find('.dp-filter-form__list').addClass('swiper-wrapper');
				$sliderContainer.find('.dp-filter-form__item').addClass('swiper-slide');
				$sliderContainer.closest('.dp-filter-form').append(
					'<div class="dp-slider-arrows">' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-left"></use></svg>' +
					'</button>' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-right"></use></svg>' +
					'</button>' +
					'<div class="dp-slider-arrows__grad"></div>' +
					'</div>'
				);
				sliderArr[i] = new Swiper($sliderContainer[0], {
					spaceBetween: 0,
					speed: 600,
					slidesPerView: 'auto',
					slidesPerGroup: 1,
					slidesPerGroupAuto: true,
					freeMode: true,
					navigation: {
						nextEl: $sliderContainer.closest('.dp-filter-form').find(".dp-slider-arrow_next")[0],
						prevEl: $sliderContainer.closest('.dp-filter-form').find(".dp-slider-arrow_prev")[0],
					},
					on: {
						slideChange: function (swiper) {
							// console.log(swiper);
							// var isBeginning = swiper.isBeginning;
							// var isEnd = swiper.isEnd;
							var $grad = $sliderContainer.closest('.dp-filter-form').find(".dp-slider-arrows__grad");
							if (swiper.isEnd) {
								$grad.hide();
							}
							else {
								$grad.show();
							}
						}
					},
				});
			}
			function destroySlider() {
				if (typeof sliderArr[i] !== 'undefined' && $sliderContainer.hasClass('swiper-initialized')) {
					sliderArr[i].destroy();
					$sliderContainer.removeClass('swiper');
					$sliderContainer.find('.dp-filter-form__list').removeClass('swiper-wrapper');
					$sliderContainer.find('.dp-filter-form__item').removeClass('swiper-slide');
					$sliderContainer.closest('.dp-filter-form').find('.dp-slider-arrows').remove();
				}
			}

			if ($(window).width() >= 1200) {
				initSlider();
			}

			$(window).on('resize', function () {
				if ($(window).width() >= 1200) {
					if (!$sliderContainer.hasClass('swiper-initialized')) {
						initSlider();
					}
				} else {
					if ($sliderContainer.hasClass('swiper-initialized')) {
						destroySlider();
					}
				}
			});

		});
	}

}

function homeTopAboutSlider() {

	var $slider = $('.dp-home-top-about');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $sliderContainer = $(this);
			function initSlider() {
				$sliderContainer.addClass('swiper');
				$sliderContainer.find('.dp-home-top-about__list').addClass('swiper-wrapper');
				$sliderContainer.find('.dp-home-top-about__col').addClass('swiper-slide');
				$sliderContainer.append("<div class='dp-slider-pagination'></div>");

				sliderArr[i] = new Swiper($sliderContainer[0], {
					spaceBetween: 20,
					speed: 600,
					slidesPerView: 1,
					// freeMode: true,
					pagination: {
						el: $sliderContainer.find('.dp-slider-pagination')[0],
						clickable: true
					}
				});
			}
			function destroySlider() {
				if (typeof sliderArr[i] !== 'undefined' && $sliderContainer.hasClass('swiper-initialized')) {
					sliderArr[i].destroy();
					$sliderContainer.removeClass('swiper');
					$sliderContainer.find('.dp-home-top-about__list').removeClass('swiper-wrapper');
					$sliderContainer.find('.dp-home-top-about__col').removeClass('swiper-slide');
					$sliderContainer.find('.dp-slider-pagination').remove();
				}
			}

			if ($(window).width() < 576) {
				initSlider();
			}

			$(window).on('resize', function () {
				if ($(window).width() < 576) {
					if (!$sliderContainer.hasClass('swiper-initialized')) {
						initSlider();
					}
				} else {
					if ($sliderContainer.hasClass('swiper-initialized')) {
						destroySlider();
					}
				}
			});

		});
	}

}

function speakersSlider(el) {

	var $slider = (typeof el !== 'undefined') ? $(el) : $('.dp-speakers-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderItems = $this.find('.dp-slider__item');
			if ($sliderItems.length > 0) {
				var $sliderWrapper = $this.find('.dp-slider__list');
				$this.addClass('swiper');
				$sliderWrapper.addClass('swiper-wrapper');
				$sliderItems.addClass('swiper-slide');
				$this.closest('.dp-section').find('.dp-section__header').append(
					'<div class="dp-slider-arrows">' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-left"></use></svg>' +
					'</button>' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-right"></use></svg>' +
					'</button>' +
					'</div>'
				);
				$this.append("<div class='dp-slider-pagination'></div>");

				function getSpeed() {
					var w = $(window).width();
					var s = 0;
					if (w > 1200) {
						s = 1600;
					}
					else if (w < 576) {
						s = 800;
					}
					else {
						s = 1200;
					}
					return s;
				}

				var speed = getSpeed();

				sliderArr[i] = new Swiper($slider[i], {
					spaceBetween: 40,
					speed: speed,
					slidesPerView: 4,
					slidesPerGroup: 4,
					navigation: {
						nextEl: $this.closest('.dp-section').find(".dp-slider-arrow_next")[0],
						prevEl: $this.closest('.dp-section').find(".dp-slider-arrow_prev")[0],
					},
					pagination: {
						el: $this.find('.dp-slider-pagination')[0],
						clickable: true,
					},
					breakpoints: {
						1: {
							slidesPerView: 1,
							slidesPerGroup: 1,
							spaceBetween: 20,
							speed: 800
						},
						576: {
							slidesPerView: 2,
							slidesPerGroup: 2,
							spaceBetween: 20,
							speed: 1200
						},
						768: {
							slidesPerView: 3,
							slidesPerGroup: 3,
							spaceBetween: 20,
							speed: 1200
						},
						1201: {
							slidesPerView: 3,
							slidesPerGroup: 3,
							spaceBetween: 30,
							speed: 1600
						},
						1441: {
							slidesPerView: 4,
							slidesPerGroup: 4,
							spaceBetween: 40,
							speed: 1600
						}
					}
				});

			}
		});
	}

}

function blogSliderAutoplay(el) {

	var $slider = (typeof el !== 'undefined') ? $(el) : $('.dp-compilation-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderItems = $this.find('.dp-slider__item');
			if ($sliderItems.length > 0) {
				// var $sliderContainer = $this.find('.dp-product-detail-gallery__container');
				var $sliderWrapper = $this.find('.dp-slider__list');
				$this.addClass('swiper');
				$sliderWrapper.addClass('swiper-wrapper');
				$sliderItems.addClass('swiper-slide');
				$this.closest('.dp-section').find('.dp-section__header').append(
					'<div class="dp-slider-arrows">' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-left"></use></svg>' +
					'</button>' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_next">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-right"></use></svg>' +
					'</button>' +
					'</div>'
				);
				$this.append("<div class='dp-slider-pagination'></div>");
				var $progress = $("<div class='dp-slider-progress'><div class='dp-slider-progress__scale'></div></div>");
				$progress.prependTo($slider[i]);
				var $progressScale = $progress.find('.dp-slider-progress__scale');
				var startTrigger = false;

				function getSpeed() {
					var w = $(window).width();
					var s = 0;
					if (w > 1200) {
						s = 1600;
					}
					else if (w < 576) {
						s = 800;
					}
					else {
						s = 1200;
					}
					return s;
				}

				function getDelay() {
					var w = $(window).width();
					var d = 5000;
					if (w > 1200) {
						d = 7000;
					}
					if (w < 576) {
						d = 4000;
					}
					if (w > 1200) {
						d = 7000;
					}
					return d;
				}

				var speed = getSpeed();

				sliderArr[i] = new Swiper($slider[i], {
					spaceBetween: 40,
					speed: speed,
					slidesPerView: 3,
					slidesPerGroup: 3,
					navigation: {
						nextEl: $this.closest('.dp-section').find(".dp-slider-arrow_next")[0],
						prevEl: $this.closest('.dp-section').find(".dp-slider-arrow_prev")[0],
					},
					pagination: {
						el: $this.find('.dp-slider-pagination')[0],
						clickable: true,
					},
					breakpoints: {
						1: {
							slidesPerView: 1,
							slidesPerGroup: 1,
							spaceBetween: 20,
							speed: 800
						},
						576: {
							slidesPerView: 2,
							slidesPerGroup: 2,
							spaceBetween: 20,
							speed: 1200
						},
						992: {
							slidesPerView: 3,
							slidesPerGroup: 3,
							spaceBetween: 20,
							speed: 1200
						},
						1201: {
							slidesPerView: 3,
							slidesPerGroup: 3,
							spaceBetween: 30,
							speed: 1600
						},
						1441: {
							slidesPerView: 3,
							slidesPerGroup: 3,
							spaceBetween: 40,
							speed: 1600
						}
					},
					on: {
						init: function () {
							animateProgress();
						}
					}
				});

				sliderArr[i].on('reachEnd', function () {
					startTrigger = true;
				});

				sliderArr[i].on('slideChange', function () {
					if (startTrigger) {
						animateProgress(0);
						startTrigger = false;
					}
					else {
						animateProgress();
					}
				});

				function animateProgress(index) {
					$progress.addClass('dp-slider-progress_active');
					$progressScale.css('width', 0);
					$progressScale.stop().animate({ width: '100%' }, getDelay(), 'linear', function () {
						$progress.removeClass('dp-slider-progress_active');
						$progressScale.css('width', 0);
						speed = getSpeed();
						if (typeof index !== 'undefined') {
							sliderArr[i].slideTo(index, speed);
						}
						else {
							sliderArr[i].slideNext(speed);
						}
					});
				}

			}
		});
	}

}

function blogSlider(el) {

	var $slider = (typeof el !== 'undefined') ? $(el) : $('.dp-effectiveness-slider, .dp-new-blog-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderItems = $this.find('.dp-slider__item');
			if ($sliderItems.length > 0) {
				var $sliderWrapper = $this.find('.dp-slider__list');
				$this.addClass('swiper');
				$sliderWrapper.addClass('swiper-wrapper');
				$sliderItems.addClass('swiper-slide');
				$this.closest('.dp-section').find('.dp-section__header').append(
					'<div class="dp-slider-arrows">' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-left"></use></svg>' +
					'</button>' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_next">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-right"></use></svg>' +
					'</button>' +
					'</div>'
				);
				$this.append("<div class='dp-slider-pagination'></div>");

				function getSpeed() {
					var w = $(window).width();
					var s = 0;
					if (w > 1200) {
						s = 1600;
					}
					else if (w < 576) {
						s = 800;
					}
					else {
						s = 1200;
					}
					return s;
				}

				var speed = getSpeed();

				sliderArr[i] = new Swiper($slider[i], {
					spaceBetween: 40,
					speed: speed,
					slidesPerView: 3,
					slidesPerGroup: 3,
					navigation: {
						nextEl: $this.closest('.dp-section').find(".dp-slider-arrow_next")[0],
						prevEl: $this.closest('.dp-section').find(".dp-slider-arrow_prev")[0],
					},
					pagination: {
						el: $this.find('.dp-slider-pagination')[0],
						clickable: true,
					},
					breakpoints: {
						1: {
							slidesPerView: 1,
							slidesPerGroup: 1,
							spaceBetween: 20,
							speed: 800
						},
						576: {
							slidesPerView: 2,
							slidesPerGroup: 2,
							spaceBetween: 20,
							speed: 1200
						},
						992: {
							slidesPerView: 3,
							slidesPerGroup: 3,
							spaceBetween: 20,
							speed: 1200
						},
						1201: {
							slidesPerView: 3,
							slidesPerGroup: 3,
							spaceBetween: 30,
							speed: 1600
						},
						1441: {
							slidesPerView: 3,
							slidesPerGroup: 3,
							spaceBetween: 40,
							speed: 1600
						}
					}
				});

			}
		});
	}

}

function homeEventSlider(el) {

	var $slider = (typeof el !== 'undefined') ? $(el) : $('.dp-home-events-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $sliderContainer = $(this);
			$sliderContainer.addClass('swiper');
			$sliderContainer.find('.dp-slider__list').addClass('swiper-wrapper');
			$sliderContainer.find('.dp-item-col').addClass('swiper-slide');
			$sliderContainer.append("<div class='dp-slider-pagination'></div>");
			$sliderContainer.closest('.dp-section').find('.dp-section__header').append(
				'<div class="dp-slider-arrows">' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_prev">' +
				'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-left"></use></svg>' +
				'</button>' +
				'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_next">' +
				'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-right"></use></svg>' +
				'</button>' +
				'</div>'
			);

			function getSpeed() {
				var w = $(window).width();
				var s = 0;
				if (w > 1200) {
					s = 1600;
				}
				else if (w < 576) {
					s = 800;
				}
				else {
					s = 1200;
				}
				return s;
			}

			var speed = getSpeed();

			sliderArr[i] = new Swiper($sliderContainer[0], {
				spaceBetween: 20,
				speed: speed,
				slidesPerView: 2,
				slidesPerGroup: 2,
				// freeMode: true,
				navigation: {
					nextEl: $sliderContainer.closest('.dp-section').find(".dp-slider-arrow_next")[0],
					prevEl: $sliderContainer.closest('.dp-section').find(".dp-slider-arrow_prev")[0],
				},
				pagination: {
					el: $sliderContainer.find('.dp-slider-pagination')[0],
					clickable: true
				},
				breakpoints: {
					1: {
						slidesPerView: 1,
						slidesPerGroup: 1,
						spaceBetween: 20,
						speed: 800
					},
					576: {
						slidesPerView: 1,
						slidesPerGroup: 1,
						spaceBetween: 20,
						speed: 1200
					},
					992: {
						slidesPerView: 2,
						slidesPerGroup: 2,
						spaceBetween: 20,
						speed: 1200
					},
					1201: {
						slidesPerView: 2,
						slidesPerGroup: 2,
						spaceBetween: 30,
						speed: 1600
					},
					1441: {
						slidesPerView: 2,
						slidesPerGroup: 2,
						spaceBetween: 40,
						speed: 1600
					}
				}
			});

		});
	}

}

function coursesSlider(el) {

	var $slider = (typeof el !== 'undefined') ? $(el) : $('.dp-courses-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderItems = $this.find('.dp-slider__item');
			if ($sliderItems.length > 0) {
				var $sliderWrapper = $this.find('.dp-slider__list');
				$slider.addClass('swiper');
				$sliderWrapper.addClass('swiper-wrapper');
				$sliderItems.addClass('swiper-slide');
				$this.closest('.dp-section').find('.dp-section__header').append(
					'<div class="dp-slider-arrows">' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-left"></use></svg>' +
					'</button>' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-right"></use></svg>' +
					'</button>' +
					'</div>'
				);
				$this.append("<div class='dp-slider-pagination'></div>");

				sliderArr[i] = new Swiper($slider[0], {
					spaceBetween: 40,
					speed: 1000,
					slidesPerView: 1,
					navigation: {
						nextEl: $this.closest('.dp-section').find(".dp-slider-arrow_next")[0],
						prevEl: $this.closest('.dp-section').find(".dp-slider-arrow_prev")[0],
					},
					pagination: {
						el: $this.find('.dp-slider-pagination')[0],
						clickable: true,
					},
					breakpoints: {
						1: {
							spaceBetween: 20
						},
						1201: {
							spaceBetween: 30
						},
						1441: {
							spaceBetween: 40
						}
					}
				});

			}
		});
	}

}

function actualSlider(el) {

	var $slider = (typeof el !== 'undefined') ? $(el) : $('.dp-actual-slider');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $this = $(this);
			var $sliderItems = $this.find('.dp-actual-slider__item');
			if ($sliderItems.length > 1) {
				var $sliderWrapper = $this.find('.dp-actual-slider__list');
				$slider.addClass('swiper');
				$sliderWrapper.addClass('swiper-wrapper');
				$sliderItems.addClass('swiper-slide');
				$this.closest('.dp-section').find('.dp-section__header').append(
					'<div class="dp-slider-arrows">' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-left"></use></svg>' +
					'</button>' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_next">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-right"></use></svg>' +
					'</button>' +
					'</div>'
				);
				$this.append("<div class='dp-slider-pagination'></div>");

				sliderArr[i] = new Swiper($slider[0], {
					spaceBetween: 20,
					speed: 600,
					slidesPerView: 1,
					navigation: {
						nextEl: $this.closest('.dp-section').find(".dp-slider-arrow_next")[0],
						prevEl: $this.closest('.dp-section').find(".dp-slider-arrow_prev")[0],
					},
					pagination: {
						el: $this.find('.dp-slider-pagination')[0],
						clickable: true,
					},
					// breakpoints: {
					// 	1: {
					// 		spaceBetween: 20
					// 	},
					// 	1201: {
					// 		spaceBetween: 30
					// 	},
					// 	1441: {
					// 		spaceBetween: 40
					// 	}
					// }
				});

			}
		});
	}

}

function faq() {
	$('.dp-faq-item__header').on('click', function (e) {
		var $this = $(this);
		e.preventDefault();
		var $openedFaqItem = $('.dp-faq-item_active');
		var $faqItem = $this.closest('.dp-faq-item');
		var $faqItemBody = $this.next('.dp-faq-item__body');
		if (!$faqItem.hasClass('dp-faq-item_active')) {
			if ($openedFaqItem.length) {
				$openedFaqItem.removeClass('dp-faq-item_active');
				$openedFaqItem.find('.dp-faq-item__body').css('display', 'block').slideUp(300, function () {
					$(this).removeAttr('style');
				});
			}
			$faqItem.addClass('dp-faq-item_active');
			if ($faqItemBody.length) {
				$faqItemBody.css('display', 'none').slideDown(300, function () {
					$(this).removeAttr('style');
				});
			}
		}
		else {
			$faqItem.removeClass('dp-faq-item_active');
			$faqItemBody.css('display', 'block').slideUp(300, function () {
				$(this).removeAttr('style');
			});
		}
	});
}


function eventSlider() {

	var $slider = $('.dp-slider.dp-events');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $sliderContainer = $(this);
			function initSlider() {
				$sliderContainer.addClass('swiper');
				$sliderContainer.find('.dp-item-list').addClass('swiper-wrapper');
				$sliderContainer.find('.dp-item-col').addClass('swiper-slide');
				$sliderContainer.append("<div class='dp-slider-pagination'></div>");
				$sliderContainer.closest('.dp-section').find('.dp-section__header').append(
					'<div class="dp-slider-arrows">' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-left"></use></svg>' +
					'</button>' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_next">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-right"></use></svg>' +
					'</button>' +
					'</div>'
				);

				function getSpeed() {
					var w = $(window).width();
					var s = 0;
					if (w > 1200) {
						s = 1600;
					}
					else if (w < 576) {
						s = 800;
					}
					else {
						s = 1200;
					}
					return s;
				}

				var speed = getSpeed();

				sliderArr[i] = new Swiper($sliderContainer[0], {
					spaceBetween: 20,
					speed: speed,
					slidesPerView: 1,
					slidesPerGroup: 1,
					// freeMode: true,
					navigation: {
						nextEl: $sliderContainer.closest('.dp-section').find(".dp-slider-arrow_next")[0],
						prevEl: $sliderContainer.closest('.dp-section').find(".dp-slider-arrow_prev")[0],
					},
					pagination: {
						el: $sliderContainer.find('.dp-slider-pagination')[0],
						clickable: true
					},
					breakpoints: {
						1: {
							slidesPerView: 1,
							slidesPerGroup: 1,
							spaceBetween: 20,
							speed: 800
						},
						576: {
							slidesPerView: 1,
							slidesPerGroup: 1,
							spaceBetween: 20,
							speed: 1200
						},
						992: {
							slidesPerView: 2,
							slidesPerGroup: 2,
							spaceBetween: 20,
							speed: 1200
						},
						1201: {
							spaceBetween: 30,
							speed: 1600
						},
						1441: {
							spaceBetween: 40,
							speed: 1600
						}
					}
				});
			}
			function destroySlider() {
				if (typeof sliderArr[i] !== 'undefined' && $sliderContainer.hasClass('swiper-initialized')) {
					sliderArr[i].destroy();
					$sliderContainer.removeClass('swiper');
					$sliderContainer.find('.dp-item-list').removeClass('swiper-wrapper');
					$sliderContainer.find('.dp-item-col').removeClass('swiper-slide');
					$sliderContainer.find('.dp-slider-pagination').remove();
					$sliderContainer.closest('.dp-section').find('.dp-slider-arrows').remove();
				}
			}

			if ($(window).width() <= 1200) {
				initSlider();
			}

			$(window).on('resize', function () {
				if ($(window).width() <= 1200) {
					if (!$sliderContainer.hasClass('swiper-initialized')) {
						initSlider();
					}
				} else {
					if ($sliderContainer.hasClass('swiper-initialized')) {
						destroySlider();
					}
				}
			});

		});
	}

}

function dashCoursesSlider() {

	var $slider = $('.dp-slider.dp-courses');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $sliderContainer = $(this);
			function initSlider() {
				$sliderContainer.addClass('swiper');
				$sliderContainer.find('.dp-item-list').addClass('swiper-wrapper');
				$sliderContainer.find('.dp-item-col').addClass('swiper-slide');
				$sliderContainer.append("<div class='dp-slider-pagination'></div>");
				$sliderContainer.closest('.dp-section').find('.dp-section__header').append(
					'<div class="dp-slider-arrows">' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-left"></use></svg>' +
					'</button>' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_next">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-right"></use></svg>' +
					'</button>' +
					'</div>'
				);

				function getSpeed() {
					var w = $(window).width();
					var s = 0;
					if (w > 1200) {
						s = 1600;
					}
					else if (w < 576) {
						s = 800;
					}
					else {
						s = 1200;
					}
					return s;
				}

				var speed = getSpeed();

				sliderArr[i] = new Swiper($sliderContainer[0], {
					spaceBetween: 20,
					speed: speed,
					slidesPerView: 1,
					slidesPerGroup: 1,
					// freeMode: true,
					navigation: {
						nextEl: $sliderContainer.closest('.dp-section').find(".dp-slider-arrow_next")[0],
						prevEl: $sliderContainer.closest('.dp-section').find(".dp-slider-arrow_prev")[0],
					},
					pagination: {
						el: $sliderContainer.find('.dp-slider-pagination')[0],
						clickable: true
					},
					breakpoints: {
						1: {
							slidesPerView: 1,
							slidesPerGroup: 1,
							spaceBetween: 20,
							speed: 800
						},
						576: {
							slidesPerView: 1,
							slidesPerGroup: 1,
							spaceBetween: 20,
							speed: 1200
						},
						992: {
							slidesPerView: 2,
							slidesPerGroup: 2,
							spaceBetween: 20,
							speed: 1200
						},
						1201: {
							spaceBetween: 30,
							speed: 1600
						},
						1441: {
							spaceBetween: 40,
							speed: 1600
						}
					}
				});
			}
			function destroySlider() {
				if (typeof sliderArr[i] !== 'undefined' && $sliderContainer.hasClass('swiper-initialized')) {
					sliderArr[i].destroy();
					$sliderContainer.removeClass('swiper');
					$sliderContainer.find('.dp-item-list').removeClass('swiper-wrapper');
					$sliderContainer.find('.dp-item-col').removeClass('swiper-slide');
					$sliderContainer.find('.dp-slider-pagination').remove();
					$sliderContainer.closest('.dp-section').find('.dp-slider-arrows').remove();
				}
			}

			var isEdu = !!($sliderContainer.closest('.dp-account-education').length);

			if (isEdu) {
				if ($(window).width() < 768) {
					initSlider();
				}
				$(window).on('resize', function () {
					if ($(window).width() < 768) {
						if (!$sliderContainer.hasClass('swiper-initialized')) {
							initSlider();
						}
					} else {
						if ($sliderContainer.hasClass('swiper-initialized')) {
							destroySlider();
						}
					}
				});
			}
			else {
				if ($(window).width() <= 1200) {
					initSlider();
				}
				$(window).on('resize', function () {
					if ($(window).width() <= 1200) {
						if (!$sliderContainer.hasClass('swiper-initialized')) {
							initSlider();
						}
					} else {
						if ($sliderContainer.hasClass('swiper-initialized')) {
							destroySlider();
						}
					}
				});
			}

		});
	}

}

function masterclassSlider() {

	var $slider = $('.dp-slider.dp-masterclasses');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $sliderContainer = $(this);
			function initSlider() {
				$sliderContainer.addClass('swiper');
				$sliderContainer.find('.dp-item-list').addClass('swiper-wrapper');
				$sliderContainer.find('.dp-item-col').addClass('swiper-slide');
				$sliderContainer.append("<div class='dp-slider-pagination'></div>");
				$sliderContainer.closest('.dp-section').find('.dp-section__header').append(
					'<div class="dp-slider-arrows">' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-left"></use></svg>' +
					'</button>' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_next">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-right"></use></svg>' +
					'</button>' +
					'</div>'
				);

				sliderArr[i] = new Swiper($sliderContainer[0], {
					spaceBetween: 20,
					speed: 800,
					slidesPerView: 1,
					slidesPerGroup: 1,
					// freeMode: true,
					navigation: {
						nextEl: $sliderContainer.closest('.dp-section').find(".dp-slider-arrow_next")[0],
						prevEl: $sliderContainer.closest('.dp-section').find(".dp-slider-arrow_prev")[0],
					},
					pagination: {
						el: $sliderContainer.find('.dp-slider-pagination')[0],
						clickable: true
					}
				});
			}
			function destroySlider() {
				if (typeof sliderArr[i] !== 'undefined' && $sliderContainer.hasClass('swiper-initialized')) {
					sliderArr[i].destroy();
					$sliderContainer.removeClass('swiper');
					$sliderContainer.find('.dp-item-list').removeClass('swiper-wrapper');
					$sliderContainer.find('.dp-item-col').removeClass('swiper-slide');
					$sliderContainer.find('.dp-slider-pagination').remove();
					$sliderContainer.closest('.dp-section').find('.dp-slider-arrows').remove();
				}
			}

			if ($(window).width() < 768) {
				initSlider();
			}

			$(window).on('resize', function () {
				if ($(window).width() < 768) {
					if (!$sliderContainer.hasClass('swiper-initialized')) {
						initSlider();
					}
				} else {
					if ($sliderContainer.hasClass('swiper-initialized')) {
						destroySlider();
					}
				}
			});

		});
	}

}

function webinarSlider() {

	var $slider = $('.dp-slider.dp-webinars');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $sliderContainer = $(this);
			function initSlider() {
				$sliderContainer.addClass('swiper');
				$sliderContainer.find('.dp-item-list').addClass('swiper-wrapper');
				$sliderContainer.find('.dp-item-col').addClass('swiper-slide');
				$sliderContainer.append("<div class='dp-slider-pagination'></div>");
				$sliderContainer.closest('.dp-section').find('.dp-section__header').append(
					'<div class="dp-slider-arrows">' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-left"></use></svg>' +
					'</button>' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_next">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-right"></use></svg>' +
					'</button>' +
					'</div>'
				);

				sliderArr[i] = new Swiper($sliderContainer[0], {
					spaceBetween: 20,
					speed: 800,
					slidesPerView: 1,
					slidesPerGroup: 1,
					// freeMode: true,
					navigation: {
						nextEl: $sliderContainer.closest('.dp-section').find(".dp-slider-arrow_next")[0],
						prevEl: $sliderContainer.closest('.dp-section').find(".dp-slider-arrow_prev")[0],
					},
					pagination: {
						el: $sliderContainer.find('.dp-slider-pagination')[0],
						clickable: true
					}
				});
			}
			function destroySlider() {
				if (typeof sliderArr[i] !== 'undefined' && $sliderContainer.hasClass('swiper-initialized')) {
					sliderArr[i].destroy();
					$sliderContainer.removeClass('swiper');
					$sliderContainer.find('.dp-item-list').removeClass('swiper-wrapper');
					$sliderContainer.find('.dp-item-col').removeClass('swiper-slide');
					$sliderContainer.find('.dp-slider-pagination').remove();
					$sliderContainer.closest('.dp-section').find('.dp-slider-arrows').remove();
				}
			}

			if ($(window).width() < 768) {
				initSlider();
			}

			$(window).on('resize', function () {
				if ($(window).width() < 768) {
					if (!$sliderContainer.hasClass('swiper-initialized')) {
						initSlider();
					}
				} else {
					if ($sliderContainer.hasClass('swiper-initialized')) {
						destroySlider();
					}
				}
			});

		});
	}

}

function articlesSlider() {

	var $slider = $('.dp-slider.dp-articles');
	var sliderArr = [];
	if ($slider.length) {
		$slider.each(function (i) {
			var $sliderContainer = $(this);
			function initSlider() {
				$sliderContainer.addClass('swiper');
				$sliderContainer.find('.dp-item-list').addClass('swiper-wrapper');
				$sliderContainer.find('.dp-item-col').addClass('swiper-slide');
				$sliderContainer.append("<div class='dp-slider-pagination'></div>");
				$sliderContainer.closest('.dp-section').find('.dp-section__header').append(
					'<div class="dp-slider-arrows">' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_prev">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-left"></use></svg>' +
					'</button>' +
					'<button type="button" class="dp-slider-arrow dp-slider-arrow_magnolia dp-slider-arrow_next">' +
					'<svg class="icon icon-slider-arrow"><use xlink:href="#slider-arrow-right"></use></svg>' +
					'</button>' +
					'</div>'
				);

				sliderArr[i] = new Swiper($sliderContainer[0], {
					spaceBetween: 20,
					speed: 800,
					slidesPerView: 1,
					slidesPerGroup: 1,
					// freeMode: true,
					navigation: {
						nextEl: $sliderContainer.closest('.dp-section').find(".dp-slider-arrow_next")[0],
						prevEl: $sliderContainer.closest('.dp-section').find(".dp-slider-arrow_prev")[0],
					},
					pagination: {
						el: $sliderContainer.find('.dp-slider-pagination')[0],
						clickable: true
					}
				});
			}
			function destroySlider() {
				if (typeof sliderArr[i] !== 'undefined' && $sliderContainer.hasClass('swiper-initialized')) {
					sliderArr[i].destroy();
					$sliderContainer.removeClass('swiper');
					$sliderContainer.find('.dp-item-list').removeClass('swiper-wrapper');
					$sliderContainer.find('.dp-item-col').removeClass('swiper-slide');
					$sliderContainer.find('.dp-slider-pagination').remove();
					$sliderContainer.closest('.dp-section').find('.dp-slider-arrows').remove();
				}
			}

			if ($(window).width() < 768) {
				initSlider();
			}

			$(window).on('resize', function () {
				if ($(window).width() < 768) {
					if (!$sliderContainer.hasClass('swiper-initialized')) {
						initSlider();
					}
				} else {
					if ($sliderContainer.hasClass('swiper-initialized')) {
						destroySlider();
					}
				}
			});

		});
	}

}