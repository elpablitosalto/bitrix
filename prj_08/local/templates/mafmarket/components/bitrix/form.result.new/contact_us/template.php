<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
//vardump($arResult);
//$this->addExternalJs(SITE_TEMPLATE_PATH . '/libs/jquery.validate/jquery.validate.min.js');
?>
<section class="dp-section js_feedback_section" id="contact_us">
	<div class="container">
		<? if ($arResult["isFormNote"] != "Y") { ?>
			<?
			$arResult['FORM_HEADER'] = str_replace('<form', '<form target="_self" class="constact-form" id="form-feedback" ', $arResult['FORM_HEADER']);
			?>
			<?= $arResult["FORM_HEADER"] ?>
		<? } ?>
		<div class="js_request_container_contact_us">
			<?
			if ($arResult["isFormErrors"] == "Y") { ?>
				<?= $arResult["FORM_ERRORS_TEXT"]; ?>
			<? } ?>
			<? if ($arResult["isFormNote"] == "Y") {
			?>
				<font style="color: white;">
					<?
					ShowMessage(array("TYPE" => "OK", "MESSAGE" => "Спасибо! Ваш вопрос успешно отправлен. Мы ответим Вам в ближайшее время."));
					?>
				</font>
				<?
				?>
			<? } ?>

			<? if ($arResult["isFormNote"] != "Y") { ?>
				<p class="constact-form__title">Связаться с нами</p>
				<?
				foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
					if (isset($arParams[$FIELD_SID]) && $arParams[$FIELD_SID]['VALUE'] && $arParams[$FIELD_SID]['AUTOCOMPLETE'] == 'Y') {
						$arQuestion['HTML_CODE'] = str_replace('name=', 'value="' . $arParams[$FIELD_SID]['VALUE'] . '" name=', $arQuestion['HTML_CODE']);
					}
					//vardump($arQuestion);
					if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
						echo $arQuestion["HTML_CODE"];
					} else {
						$valid_type = '';
						$type = $arQuestion["STRUCTURE"][0]["FIELD_TYPE"];
						$field_id = $arQuestion["STRUCTURE"][0]["ID"];
						$star = '';
						$required = '';
						$add_class = '';
						$form__input_class = '';
						$name = 'form_' . $type . '_' . $field_id;
						if ($arQuestion["REQUIRED"] == 'Y') {
							$star = '*';
							$required = 'required';
						}
						$phone_class = '';
						$col_class = '';
						$form__input_class = 'dp-form-field_text';

						switch ($FIELD_SID) {
							case 'NAME':
								$add_class = '';
								$valid_type = 'NAME';
								break;
							case 'PHONE':
								$phone_class = 'js_phone_class';
								$valid_type = 'PHONE';
								break;
							case 'EMAIL':
								$valid_type = 'EMAIL';
								break;
							case 'MESSAGE':
								$valid_type = 'MESSAGE';
								$input_class = 'constact-form__textarea';
								$col_class = '';
								break;
						}

						// Для валидации -->
						$strValidateAttrs = '';
						$arValidateAttrs = [];
						if ($arQuestion["REQUIRED"] == 'Y') {
							$arValidateAttrs[] = 'data-rule-required="true"';
							$requiredTextError =  ($valid_type == 'PHONE') ? 'FS_FIELD_ERROR_REQUIRED_PHONE' : 'FS_FIELD_ERROR_REQUIRED';
							$arValidateAttrs[] = 'data-msg-required="' . Loc::getMessage($requiredTextError) . '"';

							switch ($valid_type) {
								case 'NAME':
									$arValidateAttrs[] = 'data-rule-minlength="2"';
									$arValidateAttrs[] = 'data-msg-minlength="' . Loc::getMessage('FS_NAME_ERROR_MINLEN') . '"';
									break;
								case 'EMAIL':
									$arValidateAttrs[] = 'data-rule-email="true"';
									$arValidateAttrs[] = 'data-msg-email="' . Loc::getMessage('FS_EMAIL_ERROR_INCORRECT') . '"';
									break;
								case 'PHONE':
									$arValidateAttrs[] = 'data-rule-phone="true"';
									$arValidateAttrs[] = 'data-msg-phone="' . Loc::getMessage('FS_PHONE_ERROR_INCORRECT') . '"';
									break;
								case 'MESSAGE':
									$arValidateAttrs[] = 'data-rule-minlength="1"';
									$arValidateAttrs[] = 'data-msg-minlength="' . Loc::getMessage('FS_ENTER_QUESTION_TEXT') . '"';
									break;
							}
							if (count($arValidateAttrs) > 0) {
								$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
							}
						}
						// <-- Для валидации	
				?>
						<div class="constact-form__input js_input_wrapper <?= $col_class; ?>">
							<label class="visually-hidden" for="<?= $name ?>"><?= $arQuestion["CAPTION"]; ?><?= $star ?></label>
							<?/*?><div class="dp-form-field <?= $form__input_class; ?>"><?*/ ?>
							<? if ($type == "textarea") { ?>
								<textarea class="<?= $input_class; ?>" <?= $strValidateAttrs; ?> id="<?= $name ?>" name="<?= $name ?>" placeholder="<?= $arQuestion["CAPTION"]; ?><?= $star ?>" <?= $required; ?>></textarea>
							<? } else { ?>
								<input <?= $strValidateAttrs; ?> class="<?= $phone_class; ?> <?= $add_class; ?>" id="<?= $name ?>" type="<?= $type; ?>" name="<?= $name ?>" placeholder="<?= $arQuestion["CAPTION"]; ?><?= $star ?>" <?= $required; ?> />
							<? } ?>
							<?/*?></div><?*/ ?>
						</div>
				<?
					}
				}
				?>
				<div class="constact__agreement js_input_wrapper">
					<input class="constact__agreement_input visually-hidden" type="checkbox" name="constact-agreement" checked id="constact-agreement" data-rule-required="true" data-msg-required="<br />Необходимо дать согласие на обработку персональных данных" required />
					<label class="constact__agreement_checkbox" for="constact-agreement">Соглашаюсь на обработку моих <a href="<?= $GLOBALS["arSiteConfig"]["LINKS"]['PERSONAL_DATA_AGREEMENT'] ?>">персональных данных</a>
					</label>
				</div>

				<button class="dp-btn constact-form__submit" type="submit">Отправить</button>

			<? } ?>

			<? if ($arResult["isFormNote"] != "Y") { ?>
				<input type="hidden" name="web_form_submit" value="Y" />
				<?= $arResult["FORM_FOOTER"] ?>
				<?/*?><button class="popup-form__popup_close"></button><?*/ ?>
			<? } ?>
		</div>
	</div>
</section>