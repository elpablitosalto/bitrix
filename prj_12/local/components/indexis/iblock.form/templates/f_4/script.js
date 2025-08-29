$(function(){

	$('input[name="PHONE"]').inputmask('+7 (999) 999-99-99');

	$.validator.addMethod(
	    'phone', 
	    function(value, element) {
	        return (value.replace(/\D/g, '').length == 11) || value == '';
	    },
	    'Phone number is incorrect'
	);

	$.validator.addMethod("customemail", 
	    function(value, element) {
	        return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value) || value == '';
	    }, 
	    "Sorry, I've enabled very strict email validation"
	);

	var showError = function($form, message) {
		var $formContent = $form.find('.form-content');
		$formContent.find(".form-error-message").remove();
		$formContent.prepend('<div class="form-error-message"><p>' + message + '</p></div>');
	};

	$('form[data-form-code]:not(.validate-installed)')
	.on('submit', function (e) {
		e.preventDefault();
	})
	.each(function() {

		$(this).validate({
			errorClass: 'error',
			focusInvalid: false,
			ignore: [],
			errorPlacement: function(error, element) {
				if (element.is('[name="AGREE"]')) {
					element.closest('.personal-agree').find('p').append(error);
				} else if (element.is('[type="file"]')) {
					element.closest('label').after(error);
				} else {
					// error.insertAfter(element);
					// element.siblings('label').after(error);
					element.addClass('nb-input-error');
				}
			},
			submitHandler: function(form) {

				var $form = $(form),
					formData = new FormData($form[0]),
					formCode = $form.data('form-code');

				if (typeof formCode !== 'undefined') {
					formData.append('SUBMIT_FORM', formCode);
				}

				if (typeof Comagic !== 'undefined' && typeof Comagic.addOfflineRequest !== 'undefined') {
					Comagic.addOfflineRequest({
						name: ($form.find('input[name="NAME"]').length) ? $form.find('input[name="NAME"]').val() : '',
						email: ($form.find('input[name="EMAIL"]').length) ? $form.find('input[name="EMAIL"]').val() : '',
						phone: ($form.find('input[name="PHONE"]').length) ? $form.find('input[name="PHONE"]').val() : '',
						message: ($form.find('input[name="MESSAGE"]').length) ? $form.find('input[name="MESSAGE"]').val() : '',
					});
				}

				$form.find('input,textarea,select,button').attr('disabled', 'disabled');
				$form.addClass('form-waiting');

				$.ajax({
					type: 'POST',
					url: $form.attr('action'),
					data: formData,
					contentType: false,
					processData: false,
					dataType: 'json',
					success: function(result) {
						if (typeof result.SUCCESS !== 'undefined') {
							//alert('Форма успешно отправлена');
							$('#modal-call-success').fadeIn(300);
							$form.trigger('reset');
							$form.trigger('submitSuccess'); // используется в target.js для фиксации события в GTM
						} else if (typeof result.ERROR !== 'undefined') {
							showError($form, Object.values(result.ERROR).join('<br>'));
						}

						$form.removeClass('loading');
						$form.find('input,textarea,select,button').removeAttr('disabled').trigger('state.change');
						$form.removeClass('form-waiting');
					},
					error: function(xhr, str){
						console.error(xhr.responseText);
						$form.removeClass('loading');
					}
				});

			}

		});

		$(this).addClass('validate-installed');

		$(this).on('reset', function() {
			$(this).find('.form-error-message, .uploaded-files-container').remove();
		});

	});

});