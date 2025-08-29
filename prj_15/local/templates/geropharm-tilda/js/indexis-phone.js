String.prototype.replaceAt = function(index, replacement) {
	return this.substring(0, index) + replacement + this.substring(index + replacement.length);
};
function initTelInput(selector) {
	var $verificationFormTel = $(selector);
	if ($verificationFormTel.length) {
		var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
		var verificationTelArr = [];
		$verificationFormTel.each(function (i) {
			var _this = this;
			var $this = $(this);
			var fieldNameMain = $this.attr('name');
			var fieldNameFull = fieldNameMain.replace('main', 'fullNumber');
			var fieldNameCountry = fieldNameMain.replace('main', 'countryCode');
			verificationTelArr[i] = window.intlTelInput(_this, {
				preferredCountries: ["ru", "by", "kz", "ua"],
				autoPlaceholder: 'aggressive',
				initialCountry: (typeof $this.data('country') !== 'undefined' && $this.data('country').length > 1) ? $this.data('country').toUpperCase() : "RU",
				placeholderNumberType: 'FIXED_LINE',
				separateDialCode: true,
				formatOnDisplay: true,
				hiddenInput: 'fullNumber',
				customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
					selectedCountryPlaceholder.replaceAt(0, '+' + selectedCountryData.dialCode);
					if (selectedCountryData.iso2 === 'ru') {
						return '+' + selectedCountryData.dialCode + ' (___) ___-__-__';
					}
					else {
						return '+' + selectedCountryData.dialCode + ' ' + selectedCountryPlaceholder.replace(/[0-9]/g,'_');
					}
				},
				utilsScript: "/libs/intl-tel-input/js/utils.js",
			});
			$this.after('<input name="' + fieldNameCountry + '" type="hidden"/>');
			if (typeof $this.data('saved-number') !== 'undefined' && $this.data('saved-number').length > 7) {
				setTimeout(function () {
					var activePlaceholder = $this.attr('placeholder');
					var newMask = activePlaceholder.replace(/_/g, '9');
					$this.inputmask({"mask": newMask});
					$this.val($this.data('saved-number'));
					$this.siblings('input[name="' + fieldNameCountry + '"]').val(verificationTelArr[i].getSelectedCountryData().iso2);
					$this.siblings('input[name="' + fieldNameFull + '"]').val($this.data('saved-number'));
				}, 1000);
			}

			$this.on('keyup', function () {
				var _this = this;
				var value = this.value;
				var num = verificationTelArr[i].getNumber();
				var isValid = verificationTelArr[i].isValidNumber();
				var errorCode = verificationTelArr[i].getValidationError();
				var phoneData = JSON.stringify({
					value,
					num,
					isValid,
					errorCode: errorCode || undefined,
					errorText: errorCode ? errorMap[errorCode] : undefined,
					now: Date.now(),
				}, 1, '  ');
				if (isValid) {
					_this.classList.remove('__error');
				} else {
					_this.classList.add('__error');
				}
			});
			$this.on('focus input', function () {
				var $this = $(this);
				var activePlaceholder = $this.attr('placeholder');
				var newMask = activePlaceholder.replace(/_/g, '9');
				$this.inputmask({"mask": newMask});
				$this.siblings('input[name="' + fieldNameCountry + '"]').val(verificationTelArr[i].getSelectedCountryData().iso2);
				$this.siblings('input[name="' + fieldNameFull + '"]').val(verificationTelArr[i].getNumber());
			});
			$this.on('countrychange', function () {
				var $this = $(this);
				var $container = $this.closest('.iti');
				var charArr = $this.val().split('');
				var countryCode = verificationTelArr[i].getSelectedCountryData().iso2;
				var messageArr = [
					'Поле может содержать телефон в формате <span style="white-space: nowrap;">+7 (XXX) XXX-XX-XX.</span><br> Вторая цифра не может быть 0, 7 и 8',
					'Проверьте правильность ввода. Если вы хотели указать российский номер, то вторая цифра не может быть 0, 7 и 8. Если у вас казахстанский номер, то продолжайте ввод'
				];
				$this.removeClass('iti-input-error');
				$container.find('.iti-input-error-message').remove();
				if (countryCode === 'kz' && charArr[4] === '7' && charArr[5] === '_') {
					$this.addClass('iti-input-error');
					$container.append('<div class="iti-input-error-message"><div class="iti-input-error-message__inner">' + messageArr[1] + '</div></div>');
				}
				else {
					$this.val('');
				}
				var activePlaceholder = $this.attr('placeholder');
				var newMask = activePlaceholder.replace(/_/g, '9');
				$this.inputmask({"mask": newMask});
				$this.siblings('input[name="' + fieldNameCountry + '"]').val(verificationTelArr[i].getSelectedCountryData().iso2);
				$this.siblings('input[name="' + fieldNameFull + '"]').val(verificationTelArr[i].getNumber());
			});
			$this.on('input', function () {
				var $this = $(this);
				var $container = $this.closest('.iti');
				var charArr = $this.val().split('');
				var countryCode = verificationTelArr[i].getSelectedCountryData().iso2;
				var messageArr = [
					'Поле может содержать телефон в формате <span style="white-space: nowrap;">+7 (XXX) XXX-XX-XX.</span><br> Вторая цифра не может быть 0, 7 и 8',
					'Проверьте правильность ввода. Если вы хотели указать российский номер, то вторая цифра не может быть 0, 7 и 8. Если у вас казахстанский номер, то продолжайте ввод'
				];
				$this.removeClass('iti-input-error');
				$container.find('.iti-input-error-message').remove();
				if (countryCode === 'ru') {
					if (charArr[4] === '8' || charArr[4] === '0' || charArr[4] === '7') {
						$this.addClass('iti-input-error');
						$container.append('<div class="iti-input-error-message"><div class="iti-input-error-message__inner">' + messageArr[0] + '</div></div>');
					}
					else {
						$this.removeClass('iti-input-error');
						$container.find('.iti-input-error-message').remove();
					}
				}
				if (countryCode === 'kz') {
					if (charArr[4] === '7' && charArr[5] === '_') {
						$this.addClass('iti-input-error');
						$container.append('<div class="iti-input-error-message"><div class="iti-input-error-message__inner">' + messageArr[1] + '</div></div>');
					}
					else {
						$this.removeClass('iti-input-error');
						$container.find('.iti-input-error-message').remove();
					}
				}
			});
			$this.on('blur', function () {
				var $this = $(this);
				var $container = $this.closest('.iti');
				var countryCode = verificationTelArr[i].getSelectedCountryData().iso2;
				var messageArr = [
					'Поле может содержать телефон в формате <span style="white-space: nowrap;">+7 (XXX) XXX-XX-XX.</span><br> Проверьте правильность ввода',
					'Некорректный номер. Проверьте правильность ввода.'
				];
				$this.removeClass('iti-input-error');
				$container.find('.iti-input-error-message').remove();
				if ($this.val().indexOf('_') > -1) {
					$this.addClass('iti-input-error');
					if (countryCode === 'ru') {
						$container.append('<div class="iti-input-error-message"><div class="iti-input-error-message__inner">' + messageArr[0] + '</div></div>');
					}
					else {
						$container.append('<div class="iti-input-error-message"><div class="iti-input-error-message__inner">' + messageArr[1] + '</div></div>');
					}
				}
				else {
					$this.removeClass('iti-input-error');
					$container.find('.iti-input-error-message').remove();
				}
			});
		});
	}
}