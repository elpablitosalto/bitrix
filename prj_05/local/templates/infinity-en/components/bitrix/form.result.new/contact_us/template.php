<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
?>

<input type="hidden" id="js_template_path_contact_us" value="<?= $this->getFolder(); ?>/ajaxSendForm.php" />

<div class="contacts__form-panel js_contact_us_container">
	<div class="contacts__subtitle">
		<!-- begin .title-->
		<h2 class="title title_size_h5 title_font_secondary">
			<?= GetMessage('FORM_CONTACT_US'); ?>
		</h2>
		<!-- end .title-->
	</div>
	<div class="contacts__form">
		<!-- begin .form-->
		<!-- Modifiers-->
		<!-- form_messages_shown - display the messages element. this will automatically display all the .form__message elements-->
		<? if ($arResult["isFormNote"] != "Y") { ?>
			<?
			$arResult['FORM_HEADER'] = str_replace('<form', '<form class="form js-demo-validated-form_" id="js_contact_us_form" target="_self" ', $arResult['FORM_HEADER']);
			?>
			<?= $arResult["FORM_HEADER"] ?>
		<? } ?>
		<!-- messages can be placed before or after the form-->
		<div class="form__messages" id="js_contact_us_form_messages">
			<div class="form__message form__message_style_error" id="js_contact_us_form_error_message">

			</div>
			<!-- Modifiers-->
			<!-- form__message_style_error - red color-->
			<div class="form__message">
			</div>
		</div>
		<div class="form__main">
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
								$inputClass = 'js-phone-input_ js_phone_countrymask';
								break;
							case 'EMAIL':
								//$inputType = 'email';
								$inputClass = 'js-email-input';
								break;
							case 'MESSAGE':
								$inputType = 'textarea';
								break;
						}
				?>
						<div class="form__line">
							<!-- begin .form-control-->
							<div class="form-control">
								<label class="form-control__holder">
									<span class="form-control__label"><?= $arQuestion["CAPTION"]; ?><?= $star ?></span>
									<span class="form-control__field">
										<!-- Modifiers-->
										<!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
										<? if ($inputType == 'textarea') { ?>
											<textarea name="<?= $name ?>" class="form-control__textarea <?= $inputClass; ?>" <?= $required; ?>><?= $value; ?></textarea>
										<? } else { ?>
											<input name="<?= $name ?>" value="<?= $value; ?>" class="form-control__input <?= $inputClass; ?>" type="<?= $inputType; ?>" <?= $required; ?> />
										<? } ?>
									</span>
									<span class="form-control__messages">
										<span class="form-control__message form-control__message_style_error" style="display: none;">
											<?= GetMessage('FORM_FIELD_ERROR'); ?>
										</span>
									</span>
								</label>
							</div>
							<!-- end .form-control-->
						</div>
					<? } ?>
				<? } ?>
			</div>
			<div class="form__confirmation-check">
				<!-- begin .check-elem-->
				<label class="check-elem">
					<input class="check-elem__input js-disabling-checkbox" type="checkbox" name="confirm" />
					<span class="check-elem__visual">&nbsp;</span><span class="check-elem__label">
						<?= GetMessage('FORM_BY_PRESSING'); ?>
					</span>
				</label>
				<!-- end .ckeck-elem-->
			</div>
			<div class="form__controls">
				<div class="form__control">
					<!-- begin .button-->
					<button class="button button_width_full button_size_l button_text_size-l" type="submit" id="js_contact_us_form_send_button">
						<span class="button__holder"><?= GetMessage('FORM_SEND'); ?></span>
					</button>
					<!-- end .button-->
				</div>
			</div>
		</div>
		<div class="form__final" id="js_contact_us_form_success_message">
			<!-- begin .result-panel-->
			<div class="result-panel">
				<div class="result-panel__content">
					<div class="result-panel__title">
						<!-- begin .title-->
						<h3 class="title title_size_h4 title_style_primary">
							<?= GetMessage('FORM_FORM_SUCCESSFULLY_SENT'); ?>
						</h3>
						<!-- end .title-->
					</div>
					<div class="result-panel__text">
						<?= GetMessage('FORM_OUR_MANAGERS'); ?>
					</div>
					<div class="result-panel__controls">
						<div class="result-panel__control">
							<!-- begin .button-->
							<a class="button" href="front-page.html">
								<span class="button__holder"><?= GetMessage('FORM_MAIN_PAGE'); ?></span>
							</a>
							<!-- end .button-->
						</div>
					</div>
				</div>
			</div>
			<!-- end .result-panel-->
		</div>

		<?
		$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/local/include/capcha.php",
				"AREA_FILE_RECURSIVE" => "N",
				"EDIT_MODE" => "html",
			),
			false,
			array('HIDE_ICONS' => 'Y')
		);
		?>

		<? if ($arResult["isFormNote"] != "Y") { ?>
			<input type="hidden" name="WEB_FORM_ID" value="<?= $arParams['WEB_FORM_ID']; ?>" />
			<input type="hidden" name="web_form_submit" value="Y" />
			<?= $arResult["FORM_FOOTER"] ?>
		<? } ?>
		<!-- end .form-->
	</div>
</div>