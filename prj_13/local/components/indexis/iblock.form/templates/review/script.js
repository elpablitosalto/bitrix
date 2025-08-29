$(function () {
	//$('input[name="PHONE"]').inputmask('+7 (999) 999-99-99');

	$.validator.addMethod(
		'phone',
		function (value, element) {
			return (value.replace(/\D/g, '').length == 11) || value == '';
		},
		'Phone number is incorrect'
	);

	$.validator.addMethod("customemail",
		function (value, element) {
			return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value) || value == '';
		},
		"Sorry, I've enabled very strict email validation"
	);

	var showError = function ($form, message) {
		var $formContent = $form.find('.form-content');
		$formContent.find(".form-error-message").remove();
		$formContent.prepend('<div class="form-error-message"><p>' + message + '</p></div>');
	};

	var showMessage = function ($form, message, type) {
		$('.form-message').html('');
		var $messageWrapper = $form.find('.form-content');
		if (type == 'success') {
			$messageWrapper.find('.form-success-message').html(message);
		}
		else if (type == 'error') {
			$messageWrapper.find('.form-error-message').html(message);
		}
	};

	var changeCaptcha = function ($form) {
		var data = new Object();
		$.ajax({
			type: 'POST',
			url: '/local/ajax/get_captcha.php',
			data: data,
			contentType: false,
			processData: false,
			dataType: 'json',
			success: function (result) {
				//alert(result.CAPTCHA_SID);
				if (typeof result.CAPTCHA_SID !== 'undefined') {
					$form.find('.captcha_sid').val(result.CAPTCHA_SID);
					$form.find('.captcha_img').attr('src', result.CAPTCHA_IMG_SRC);
				}
			},
			error: function (xhr, str) {
				//alert(xhr.status);
				//alert(str);
				//alert(errorThrown);
				console.error(xhr.responseText);
			}
		});
	}

	$('form[data-form-code]:not(.validate-installed)').each(function () {
		//alert('!');
		var $form = $(this);
		$(this).find('.c-capcha__link').on("click", function (e) {
			//alert('!');
			changeCaptcha($form);
		});
		$(this).on("submit", function (e) {
			//alert('!');
			//return false;
		});

		$(this).validate({
			errorClass: 'form__error',
			focusInvalid: false,
			ignore: [],
			/*
			errorPlacement: function (error, element) {
				if (element.is('[name="AGREE"]')) {
					element.closest('.personal-agree').find('p').append(error);
				} else if (element.is('[type="file"]')) {
					element.closest('label').after(error);
				} else {
					// error.insertAfter(element);
					element.addClass('nb-input-error');
				}
			},
			*/
			submitHandler: function (form) {
				var $form = $(form),
					formData = new FormData($form[0]),
					formCode = $form.data('form-code');

				formData.append('SUBMIT_FORM', formCode);
				if (typeof formCode !== 'undefined') {
					formData.append('SUBMIT_FORM', formCode);
				}

				$form.find('input,textarea,select,button').attr('disabled', 'disabled');
				$form.addClass('form-waiting');

				// Лоадер -->    
                var $formButtonSubmit = $form.find('[type="submit"]');
                var formButtonSubmitHtml = $formButtonSubmit.html();
                var str = ''.repeat(formButtonSubmitHtml.length);
                var width = $formButtonSubmit.width();
                var height = $formButtonSubmit.height();
                $formButtonSubmit.width(width);
                $formButtonSubmit.height(height);
                $formButtonSubmit.addClass('btn--loading').prop('disabled', true);
                $formButtonSubmit.html(str);
                // <-- Лоадер

				var url = $form.attr('action');

				$.ajax({
					type: 'POST',
					url: url,
					data: formData,
					contentType: false,
					processData: false,
					dataType: 'json',
					success: function (result) {
						if (typeof result.SUCCESS !== 'undefined') {
							var success_message = $form.find('.js_success_message').val();
							showMessage($form, success_message, 'success');
							ym(16721107,'reachGoal','FAQ');
							$form.trigger('reset');
							changeCaptcha($form);

							$form.find('.js_delete_file').click();
							$form.find('.js_stars_container span').removeClass('star-fill');

							scrollTo('js_form_messages');
						} else if (typeof result.ERROR !== 'undefined') {
							showMessage($form, Object.values(result.ERROR).join('<br>'), 'error');

							if (result.CAPTCHA_ERROR == 'Y') {
								changeCaptcha($form);
							}

							scrollTo('js_form_messages');
						}

						$form.removeClass('loading');
						$form.find('input,textarea,select,button').removeAttr('disabled').trigger('state.change');
						$form.removeClass('form-waiting');

						return false;
					},
					error: function (xhr, str, errorThrown) {
						console.error(xhr.responseText);
						$form.removeClass('loading');

						return false;
					},
                    complete: function () {
                        //$form.trigger('reset');
                        $formButtonSubmit.removeClass('btn--loading').prop('disabled', false);
                        $formButtonSubmit.html(formButtonSubmitHtml);
                    }
				});
			}
		});

		$(this).addClass('validate-installed');

		$(this).on('reset', function () {
			$(this).find('.form-error-message, .uploaded-files-container').remove();
		});

	});

});