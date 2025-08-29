<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
//vardump($arResult);
//$this->addExternalJs(SITE_TEMPLATE_PATH . '/libs/jquery.validate/jquery.validate.min.js');
?>
<div class="contacts-form">

	<? if ($arResult["isFormNote"] != "Y") { ?>
		<?
		$arResult['FORM_HEADER'] = str_replace('<form', '<form target="_self" ', $arResult['FORM_HEADER']);
		?>
		<?= $arResult["FORM_HEADER"] ?>
	<? } ?>
	<div class="js_request_container_contacts">
		<?
		if ($arResult["isFormErrors"] == "Y") : ?><?= $arResult["FORM_ERRORS_TEXT"]; ?><? endif; ?>
		<? if ($arResult["isFormNote"] == "Y") {
			ShowMessage(array("TYPE" => "OK", "MESSAGE" => "Спасибо! Ваш вопрос успешно отправлен. Мы ответим Вам в ближайшее время."));
		?>
		<? } ?>
		<? if ($arResult["isFormNote"] != "Y") { ?>
			<p class="contacts-form__title">Мы на связи! Задайте свой вопрос</p>
			<div class="contacts-form__wrapper">
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

						switch ($FIELD_SID) {
							case 'NAME':
								$add_class = '';
								$form__input_class = 'contacts-form__name';
								$valid_type = 'NAME';
								break;
							case 'PHONE':
								$phone_class = 'js_phone_class';
								$valid_type = 'PHONE';
								break;
							case 'EMAIL':
								$valid_type = 'EMAIL';
								break;
							case 'QUESTIONS':
								$valid_type = 'QUESTION';
								$form__input_class = 'contacts-form__textarea';
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
								case 'QUESTION':
									$arValidateAttrs[] = 'data-rule-minlength="1"';
									$arValidateAttrs[] = 'data-msg-minlength="' . Loc::getMessage('FS_ENTER_QUESTION_TEXT') . '"';
									break;
							}
						} else {
							switch ($valid_type) {
								case 'EMAIL':
									$arValidateAttrs[] = 'data-rule-email="true"';
									$arValidateAttrs[] = 'data-msg-email="' . Loc::getMessage('FS_EMAIL_ERROR_INCORRECT') . '"';
									break;
							}
						}
						if ($type == 'text' || $type == 'textarea') {
							$arValidateAttrs[] = 'data-rule-notonlyspaces="true"';
							$arValidateAttrs[] = 'data-msg-notonlyspaces="В тексте не должны быть только пробелы"';
						}
						if (count($arValidateAttrs) > 0) {
							$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
						}
						// <-- Для валидации	
				?>
						<div class="form__input <?= $form__input_class; ?>">
							<?
							if ($type == "textarea") { ?>
								<label class="visually-hidden" for="contacts-form__textarea"><?= $arQuestion["CAPTION"]; ?><?= $star ?></label>
								<textarea id="contacts-form__textarea" <?= $strValidateAttrs; ?> <?= $add_class; ?>" name="<?= $name ?>" placeholder="<?= $arQuestion["CAPTION"]; ?><?= $star ?>" <?= $required; ?>></textarea>
							<? } else { ?>
								<label class="visually-hidden" for="<?= $name ?>"><?= $arQuestion["CAPTION"]; ?><?= $star ?></label>
								<input <?= $strValidateAttrs; ?> class="contacts-form__input <?= $phone_class; ?> <?= $add_class; ?>" id="<?= $name ?>" type="<?= $type; ?>" name="<?= $name ?>" placeholder="<?= $arQuestion["CAPTION"]; ?><?= $star ?>" <?= $required; ?>>
							<?
							}
							?>
						</div>
				<?
					}
				}
				?>
				<?
				/*
				if ($arResult["isUseCaptcha"] == "Y") { ?>
					<table>
						<tr>
							<th colspan="2"><b><?= GetMessage("FORM_CAPTCHA_TABLE_TITLE") ?></b></th>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><input type="hidden" name="captcha_sid" value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>" width="180" height="40" /></td>
						</tr>
						<tr>
							<td><?= GetMessage("FORM_CAPTCHA_FIELD_TITLE") ?><?= $arResult["REQUIRED_SIGN"]; ?></td>
							<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
						</tr>
					</table>
				<?
				} // isUseCaptcha
				*/
				?>
			</div>
			<p class="popup-form__policy">Нажимая кнопку «Отправить», вы даете согласие на <a href="<?= $GLOBALS["arSiteConfig"]["PRIVACY_LINK"]; ?>">обработку персональных данных</a></p>
			<button class="button-orange" type="submit" name="web_form_submit_button">Отправить</button>
		<?
		} //endif (isFormNote)
		?>
	</div>
	<? if ($arResult["isFormNote"] != "Y") { ?>
		<input type="hidden" name="web_form_submit" value="Y" />
		<?= $arResult["FORM_FOOTER"] ?>
		<?/*?><button class="popup-form__popup_close"></button><?*/ ?>
	<? } ?>
</div>