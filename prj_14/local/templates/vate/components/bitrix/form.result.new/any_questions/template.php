<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
?>
<div class="js_any_questions_form_container">

	<? if ($arResult["isFormNote"] != "Y") { ?>
		<?
		$arResult['FORM_HEADER'] = str_replace('<form', '<form class="form form_style_outline form_size_s" id="js_modal_footer_any_questions" target="_self" ', $arResult['FORM_HEADER']);
		?>
		<?= $arResult["FORM_HEADER"] ?>
	<? } ?>
	<!-- messages can be placed before or after the form-->
	<div class="form__messages">
		<? if ($arResult["isFormErrors"] == "Y") { ?>
			<!-- Modifiers-->
			<!-- form__message_style_error - red color-->
			<div class="form__message">
				<?= $arResult["FORM_ERRORS_TEXT"]; ?>
			</div>
		<? } ?>
		<? if ($arResult["isFormNote"] == "Y") { ?>
			<!-- Modifiers-->
			<!-- form__message_style_error - red color-->
			<div class="form__message">
				<? ShowMessage(array("TYPE" => "OK", "MESSAGE" => $arParams['OK_MESSAGE'])); ?>
			</div>
		<? } ?>
	</div>
	<? if ($arResult["isFormNote"] != "Y") { ?>
		<div class="form__main">
			<div class="form__title form__title_align_center">
				<!-- begin .title-->
				<h4 class="title title_size_h4">У вас остались вопросы?
				</h4>
				<!-- end .title-->
			</div>
			<div class="form__inputs">

				<?
				foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
					if (isset($arParams[$FIELD_SID]) && $arParams[$FIELD_SID]['AUTOCOMPLETE'] == 'Y') {
						$arQuestion['HTML_CODE'] = str_replace('name=', 'class="js_become_partner" value="' . $arParams[$FIELD_SID]['VALUE'] . '" name=', $arQuestion['HTML_CODE']);
					}
					if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
						echo $arQuestion["HTML_CODE"];
					} else {
						$star = '';
						$required = '';
						$inputClass = '';
						$inputType = 'text';
						$type = $arQuestion["STRUCTURE"][0]["FIELD_TYPE"];
						$field_id = $arQuestion["STRUCTURE"][0]["ID"];
						$value = $arQuestion["STRUCTURE"][0]["VALUE"];
						$name = 'form_' . $type . '_' . $field_id;
						if ($arQuestion["REQUIRED"] == 'Y') {
							$star = '*';
							$required = 'required="required"';
						}
						switch ($FIELD_SID) {
							case 'PHONE':
								$inputClass = 'js-phone-input';
								break;
							case 'EMAIL':
								$inputType = 'email';
								$inputClass = 'js-email-input';
								break;
						}
				?>
						<? if ($FIELD_SID == 'NAME') { ?>
							<div class="form__lines">
							<? } ?>
							<div class="form__line">
								<!-- begin .form-control-->
								<div class="form-control">
									<label class="form-control__holder"><span class="form-control__field">
											<!-- Modifiers-->
											<!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
											<input name="<?= $name ?>" value="<?= $value; ?>" class="form-control__input form-control__input_style_transparent form-control__input form-control__input_size_s <?= $inputClass; ?>" type="<?= $inputType; ?>" placeholder="<?= $arQuestion["CAPTION"]; ?><?= $star ?>" <?= $required; ?> />
											<!-- Иконка показывается, когда поле прошло валидацию и инпут имеет класс form-control__input_state_success-->
											<svg class="form-control__icon form-control__icon_success" width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M1.91284 3.30769L5.72237 7L11.9128 1" stroke="black" stroke-width="2" stroke-linecap="round"></path>
											</svg>
											<!-- Иконка показывается, когда поле не прошло валидацию и инпут имеет класс form-control__input_state_error-->
											<svg class="form-control__icon form-control__icon_error" width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M1.91284 1L7.91284 7" stroke="#FF0000" stroke-width="2" stroke-linecap="round"></path>
												<path d="M7.91284 1L1.91284 7" stroke="#FF0000" stroke-width="2" stroke-linecap="round"></path>
											</svg></span><span class="form-control__messages"><span class="form-control__message form-control__message_style_error" style="display: none;">Ошибка поля</span></span>
									</label>
								</div>
								<!-- end .form-control-->
							</div>
							<? if ($FIELD_SID == 'PHONE') { ?>
							</div>
						<? } ?>
					<? } ?>
				<? } ?>
			</div>
			<div class="form__confirmation-check">
				<!-- begin .check-elem-->
				<label class="check-elem check-elem_style_muted check-elem_size_s"><input class="check-elem__input js-disabling-checkbox" type="checkbox" name="agreement" required="required" /><span class="check-elem__label">Согласен с<a class="link" href="policy.html" target="_blank"> политикой конфиденциальности</a></span>
				</label>
				<!-- end .check-elem-->
			</div>
			<div class="form__controls">
				<div class="form__control">
					<!-- begin .button-->
					<button class="button button_size_xxs button_width_full button_size_xxs button_width_full" type="submit"><span class="button__holder">Отправить</span>
					</button>
					<!-- end .button-->
				</div>
			</div>
		</div>
	<? } ?>
	<? if ($arResult["isFormNote"] != "Y") { ?>
		<input type="hidden" name="web_form_submit" value="Y" />
		<?= $arResult["FORM_FOOTER"] ?>
	<? } ?>

</div>