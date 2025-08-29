// SELECTS
$(InitSelects);
$(document).on("reload", InitSelects);
function InitSelects() {
	if (typeof $.fn.selectric == "function") {
		var $customSelects = $('select.form-control:not(.no-js):not(.js-select-initialized)');
		if ($customSelects.length > 0) {
			$customSelects.each(function () {
				var $this = $(this);
				if ($this.attr('multiple')) $this.addClass('select-multiple')
			});
			$customSelects.selectric({
				disableOnMobile: true,
				nativeOnMobile: true,
				onInit: function (elem) {
					DefinePlaceholder(elem);
				},
				onChange: function (elem) {
					$(elem).trigger("change");
					ValidateSelectric($(elem));
					DefinePlaceholder(elem);
				}
			});
			$customSelects.on('validate', function () {
				ValidateSelectric($(this))
			});
			$customSelects.addClass('js-select-initialized');
			$customSelects.on('customchange', function () {
				if ($(this).closest('.selectric-wrapper').length > 0) {
					$(this).data('selectric').refresh();
				}
			});
		}

		var $nativeSelects = $('select.form-control.no-js:not(.js-select-initialized)');
		if ($nativeSelects.length > 0) {
			$nativeSelects.each(function () {
				var $cSelect = $(this);
				DefinePlaceholder(this);
				$cSelect.on('change', function () {
					DefinePlaceholder(this);
				});
				$cSelect.addClass('js-select-initialized');
			});
		}
	}
	else {
		var $selects = $('select.form-control:not(.js-select-initialized)');
		if ($selects.length > 0) {
			$selects.each(function () {
				var $cSelect = $(this);
				DefinePlaceholder(this);
				$cSelect.on('change', function () {
					DefinePlaceholder(this);
				});
				$cSelect.addClass('js-select-initialized');
			});
		}
	}
}
function DefinePlaceholder(selectElement) {
	var $select = $(selectElement);
	var $selectricLabel = $select.closest(".selectric-wrapper").find(".selectric > .label");
	var $placeholderOption = $select.find("option.placeholder-option");
	if ($placeholderOption.length == 1 &&
		($select.find("option:selected").length < 1 ||
			($placeholderOption.is(":selected") && $select.find("option:selected").length == 1))
	) {
		$selectricLabel.addClass("placeholder-active");
		$(selectElement).addClass('placeholder-active');
	}
	else {
		$selectricLabel.removeClass("placeholder-active");
		$(selectElement).removeClass('placeholder-active')
	}
}
function ValidateSelectric($select) {
	if (typeof $select.valid == "function") {
		$select.valid();
		if ($select.is('.error')) $select.closest('.selectric-wrapper').addClass('selectric--error');
		else $select.closest('.selectric-wrapper').removeClass('selectric--error');
	}
}

// VALIDATE FORMS
if (typeof $.validator == "function") {
	// SET DEFAULTS VALIDATION FORMS
	$(SetDefaultsValidationOptions);
	function SetDefaultsValidationOptions() {
		$.validator.setDefaults({
			onsubmit: true,
			debug: false,
			errorClass: "error",
			errorElement: 'label',
			ignore: [],
			errorPlacement: function ($error, $element) {
				$element.closest('.form-group').append($error);
			}
		});
		$.validator.addMethod(
			"pattern",
			function (value, element, regexp) {
				switch (regexp) {
					case ('phone'):
						regexp = '^((8|\\+7)[\\- ]?)?(\\(?\\d{3}\\)?[\\- ]?)?[\\d\\- ]{7,10}$';
						break;
					case ('email'):
						regexp = '^([a-zA-Z0-9_-]+\\.)*[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\\.[a-zA-Z0-9_-]+)*\\.[a-zA-Z]{2,6}$';
						break;
					case ('inn'):
						regexp = '^[\\d\\- ]{10,12}$';
						break;
					default:
						regexp = regexp;
						break;
				}
				var re = new RegExp(regexp);
				return this.optional(element) || re.test(value);
			},
			"Поле заполнено некорректно"
		);
		$.validator.addMethod(
			"min",
			function (value, element, minValue) {
				return StringToNumber(value) >= minValue;
			},
			"Поле заполнено некорректно"
		);
		$.validator.addMethod(
			"max",
			function (value, element, maxValue) {
				return StringToNumber(value) <= maxValue;
			},
			"Поле заполнено некорректно"
		);
		$.validator.addMethod(
			"requiredSelect",
			function (value, select, a) {
				return ($(select).find(':not(.placeholder-option):selected').length > 0);
			},
			"Не выбран ни один из вариантов"
		);
	}

	// INIT VALIDATION FORMS
	$(InitValidationForms);
	$(document).on("reload", InitValidationForms);
	function InitValidationForms() {
		var $forms = $('form.js-validate:not(.js-validation-initialized)');
		if ($forms.length > 0) {
			$forms.each(function () {
				var $form = $(this);
				var validationOptions = {
					"rules": {},
					"messages": {},
					submitHandler: function (f, e) {
						OnValidFormSubmit(f, e);
					}
				};

				$form.find('input,textarea,select').each(function () {
					var $cField = $(this);
					var cFieldKey = $cField.attr('name');

					validationOptions.rules[cFieldKey] = {
						requiredSelect: ($(this).is('select') && this.hasAttribute('required')) || false,
						required: (!$(this).is('select') && this.hasAttribute('required')) || false,
						pattern: $cField.attr('pattern') || false,
						minlength: $cField.attr('minlength') || false,
						min: $cField.attr('data-min') || false,
						max: $cField.attr('data-max') || false,
					};

					validationOptions.messages[cFieldKey] = {
						required: $cField.attr('data-message-required') || 'Поле не заполнено',
						pattern: $cField.attr('data-message-pattern') || 'Поле заполнено некорректно',
						minlength: $cField.attr('data-message-minlength') || "Минимум " + $cField.attr('minlength') + " символов",
						maxlength: $cField.attr('data-message-maxlength') || "Максимум " + $cField.attr('maxlength') + " символов",
						min: $cField.attr('data-message-min') || "Минимально допустимое значение: " + $cField.attr('data-min'),
						max: $cField.attr('data-message-max') || "Максимально допустимое значение: " + $cField.attr('data-max'),
					};
				});
				$form.validate(validationOptions);

				$form.addClass('js-validation-initialized');
			});
		}
	}

	// SUBMIT FORM
	$(document).on('click', 'form.js-validate [type="submit"]', function (evt) {
		ManualValidate($(this).closest('form'))
	});
	$(document).on('keydown touchstart', 'form.js-validate input, form.js-validate textarea', function (evt) {
		if (evt.keyCode === 13) ManualValidate($(this).closest('form'))
	});
	function ManualValidate($form) {
		$form.valid();
		$form.find('input,textarea,select').trigger('validate');
	}
	function OnValidFormSubmit(formElement, event) {
		// if ($(formElement).is('#feedback_form') || $(formElement).closest('#feedback_form').length > 0) {
		// 	$(formElement).validate().settings.ignore = "*";
		// 	$(formElement).submit();
		// }
		ShowModal('#modal-success')
	}

	// DEFAULT DISABLED SUBMIT BUTTON
	$(CheckDefaultDisabledButtonAbility);
	$(document).on("reload", CheckDefaultDisabledButtonAbility);
	function CheckDefaultDisabledButtonAbility() {
		var $ddbtns = $('.site-form.js-validate button[type="submit"][data-disabled-if-form-is-not-valid]:not(.js-initialized)');
		if ($ddbtns.length > 0) {
			$ddbtns.each(function () {
				var $cBtn = $(this);
				var $cForm = $cBtn.closest('.site-form');
				SetSubmitAbility($cForm, $cBtn);
				$cForm.on('change', function () {
					setTimeout(function () {
						SetSubmitAbility($cForm, $cBtn);
					}, 200)
				});
				$cBtn.addClass('js-initialized')
			});
		}
	}
	function SetSubmitAbility($form, $submitBtn) {
		if ($form.validate().checkForm()) $submitBtn.removeAttr('disabled');
		else $submitBtn.attr('disabled', 'disabled');
	}
}

// INIT MASKS
if (typeof $.fn.inputmask == "function") {
	$(InitInputMasks);
	$(document).on("reload", InitInputMasks);
	function InitInputMasks() {
		var $inputs = $('input[data-mask]:not(.js-mask-initialized)');
		if ($inputs.length > 0) {

			$inputs.each(function () {
				var $input = $(this);
				var mask = $input.data('mask');
				var maskOpts = {
					showMaskOnFocus: true,
					showMaskOnHover: false,
					definitions: {
						'9': {
							validator: "[0-9]"
						},
						'a': {
							validator: "[A-Za-zА-Яа-я]"
						},
						'?': {
							validator: "[!#$%&'*+/=?^_`{|}~-]"
						},
						'*': {
							validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]"
						}
					}
				};

				switch (mask) {
					case ('phone'):
						mask = '+7 (999) 999-99-99';
						break;
					case ('email'):
						mask = '*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]';
						break;
					case ('inn'):
						mask = '9{10,12}';
						break;
					case ('number'):
						mask = '9{1,20}';
						break;
					default:
						mask = mask;
						break;
				}

				$input.inputmask(mask, maskOpts);
				$input.addClass('js-mask-initialized');
			});
		}
	}
}

// UPLOAD FILES
$(document).on('change', '.upload-file-label input[type="file"]', function () {
	var input = this;
	var $input = $(input);
	var $item = $input.closest('.upload-file-label');

	if ($input.is('[multiple]')) {
		var $wrapper = GetUploadFilesWrapper($item);

		for (var i = 0; i < input.files.length; i++) {
			var $previewItem = CreateFilePreview(input.files.item(i));
			$wrapper.append($previewItem);
			AddInputToFilePreview(input.files.item(i), $input.attr('id'), $previewItem);
		}
		AggregateValues($input.attr('id'));
	}
	else {
		if (input.files.length > 0) {
			ChangeUploadFilePreview($item);
		}
		else {
			ResetUploadFilePreview($item);
		}
	}
});
function ResetUploadFilePreview($cPreviewItem) {
	// get input
	var $cInput = $cPreviewItem.find('input');

	// reset file name
	$cPreviewItem.find('span.value').html($cInput.attr('data-placeholder') || '');

	// remove btn
	var $removeBtn = $cPreviewItem.find('.upload-file-label__btn-remove');
	if ($removeBtn.length > 0) $removeBtn.remove();

	// uncheck as loaded
	$cPreviewItem.removeClass('loaded');

	return $cPreviewItem;
}
function ChangeUploadFilePreview($cPreviewItem) {

	// add controls
	if ($cPreviewItem.find('.upload-file-label__btn-remove').length < 1) {
		$cPreviewItem.append('<button class="upload-file-label__btn-remove"><svg class="icon icon-close"><use xlink:href="#close"></use></svg></button>');
	}

	// get file
	var cFile = $cPreviewItem.find('input')[0].files.item(0);

	// add file name
	$cPreviewItem.find('span.value').html(cFile.name);

	// check as loaded
	$cPreviewItem.addClass('loaded');

	return $cPreviewItem;
}
function ClearFileValues(inputId) {
	var $input = $('#' + inputId);
	$input[0].files = new DataTransfer().files;
	$input.trigger('input.clear');
}
function GetUploadFilesWrapper($originalLabel) {
	var $parentGroup = $originalLabel.parent('.form-group');
	var $siblingContainer = $originalLabel.siblings('.uploaded-files-container');
	var $wrapper = $siblingContainer.length > 0 ? $siblingContainer : $parentGroup.siblings('.uploaded-files-container');
	if ($wrapper.length < 1) {
		$wrapper = $('<div class="uploaded-files-container"></div>');
		$parentGroup.prepend($wrapper);
	}
	return $wrapper;
}
function CreateFilePreview(cFile) {
	// create wrapper
	var $cPreview = $('<div class="upload-file-label loaded"></div>');

	// add controls
	$cPreview.append('<button class="upload-file-label__btn-remove"><svg class="icon icon-close"><use xlink:href="#close"></use></svg></button>');

	// add file name
	$cPreview.prepend('<span class="value">' + cFile.name + '</span>');

	return $cPreview;
}
function AddInputToFilePreview(cFile, oInputId, $cPreviewItem) {
	var cInput = document.createElement('input');

	cInput.type = "file";
	cInput.accept = $(oInputId).attr('accept');
	$(cInput).attr('data-related-file-input', oInputId);

	var cdt = new DataTransfer();
	cdt.items.add(cFile);
	cInput.files = cdt.files;

	$cPreviewItem.prepend($(cInput))
}
function AggregateValues(inputId) {
	var cdt = new DataTransfer();
	var $tempInputs = $('input[data-related-file-input="' + inputId + '"]');
	$tempInputs.each(function () {
		cdt.items.add(this.files.item(0));
	});
	$('#' + inputId)[0].files = cdt.files;
}
$(document).on('click', '.upload-file-label__btn-remove', function (evt) {
	evt.preventDefault();
	var $cItem = $(this).closest('.upload-file-label');
	var $cInput = $cItem.find('input[type="file"]');
	if ($cItem.is('label')) {
		ResetUploadFilePreview($cItem);
		ClearFileValues($cInput.attr('id'))
	}
	else {
		$cItem.remove();
		AggregateValues($cInput.attr('data-related-file-input'));
	}
});

// FORM SUBS
$(SetFormSubsStates);
$(document).on("reload", SetFormSubsStates);
$(document).on("change", '.site-form', SetFormSubsStates);
function SetFormSubsStates() {
	var $subs = $('.form-sub-dynamic[data-sub-control]');

	if ($subs.length > 0) {
		$subs.each(function () {
			var $cSub = $(this);
			var $cSubControl = $($cSub.attr('data-sub-control'));
			if ($cSubControl.length > 0) {

				if ($cSubControl.is('option')) {
					if ($cSubControl.is(':selected')) {
						Activate($cSub);
					}
					else {
						Deactivate($cSub);
					}
				}

				else if ($cSubControl.is('input[type="checkbox"]') || $cSubControl.is('input[type="radio"]')) {
					if ($cSubControl.is(':checked')) {
						Activate($cSub);
					}
					else {
						Deactivate($cSub);
					}
				}
			}
		})
	}
}
$(document).on('activate deactivate', '.form-sub-dynamic', function () {
	var $sub = $(this);

	var $innerSelects = $sub.find(".js-select-initialized");
	if ((typeof $.fn.selectric == "function") && $innerSelects.length > 0) {
		$innerSelects.each(function () {
			$(this).selectric('refresh');
		})
	}

	var $innerDynamicActive = $sub.find("[data-required-if-visible]");
	if ($innerDynamicActive.length > 0) {
		if ($sub.hasClass('active')) {
			$innerDynamicActive.each(function () {
				var $cInput = $(this);
				$cInput.rules('add', {
					requiredSelect: ($cInput.is('select')) || false,
					required: (!$cInput.is('select')) || false,
				})
			});
		}
		else {
			$innerDynamicActive.each(function () {
				var $cInput = $(this);
				$cInput.rules('remove');

				//if ($cInput.attr('type') === 'text') $cInput.val('');
				//else if ()
			});
		}
	}
});

// FORM CONTROL BUTTON CLEAR
$(InitFormControlClear);
function InitFormControlClear() {
	var $clearButtons = $('.js-form-control-btn-clear');

	if ($clearButtons.length > 0) {
		$clearButtons.each(function () {
			var $ccb = $(this);
			var $cfc = $ccb.siblings('.form-control');

			if ($cfc.length > 0) {

				CheckFormControlClearVisibility($cfc, $ccb);
				$cfc.on('keyup change focus blur', function () {
					CheckFormControlClearVisibility($cfc, $ccb);
				});

				$ccb.on('click', function () {
					$cfc.val('').trigger('change');
				});
			}
		})
	}
}
function CheckFormControlClearVisibility($input, $button) {
	if ($input.val().length > 0) $button.removeClass('hidden');
	else $button.addClass('hidden');
}