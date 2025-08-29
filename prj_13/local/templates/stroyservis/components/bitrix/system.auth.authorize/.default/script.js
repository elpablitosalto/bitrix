(function( $, window, document, undefined) {

	$(function() {

		var showError = function($elem, message) {
			$elem.find('.alert').remove();
			$elem.find('.popup-authorization__form-wrapper').after('<div class="alert alert-danger">' + message + '</div>');
		};

		$('[name="form_auth"]').submit(function(e) {

			e.preventDefault();

			var $this = $(this),
				$btn = $this.find('[type="submit"]');

			var $form = {
				action: $this.attr('action'),
				post: {'action':'login'}
			};

			$.each($('input', $this), function(){
				if ($(this).attr('name').length) {
					if ($(this).is('input[type=checkbox]') && $(this).attr('name') != 'USER_REMEMBER') {
						return;
					}

					$form.post[$(this).attr('name')] = $(this).val();
				}
			});

			$btn.addClass('btn--loading');
			$.post($form.action, $form.post, function(data){

				$btn.removeClass("btn--loading");
				if (data.type == 'error') {
					showError($this, data.message);

					if (typeof data.captcha != 'undefined') {
						console.log(data.captcha);
					}
				} else {
					var redirectTo = ($this.find('[name="backurl"]').length == 1) ? $this.find('[name="backurl"]').val() : window.location;
					window.location = redirectTo;
				}

			}, 'json').fail(function(err) {
				var redirectTo = ($this.find('[name="backurl"]').length == 1) ? $this.find('[name="backurl"]').val() : window.location;
				window.location = redirectTo;
			});
		});
	});

})( jQuery, window, document);