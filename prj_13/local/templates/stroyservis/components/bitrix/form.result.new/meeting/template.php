<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>
<?$this->SetViewTarget("form_intro_" . $arParams["WEB_FORM_ID"]);?>
	<h2><?=$arResult['arForm']['NAME']?></h2>
	<?=$arResult['arForm']['DESCRIPTION']?>
<?$this->EndViewTarget();?>

<? if ($arResult["isFormNote"] != "Y") { ?>
	<?= $arResult["FORM_HEADER"] ?>
<? } ?>
<div class="total-message">
	<?
	if ($arResult["isFormErrors"] == "Y") : ?><?= $arResult["FORM_ERRORS_TEXT"]; ?><? endif; ?>
	<? if ($arResult["isFormNote"] == "Y") {
		ShowMessage(array("TYPE" => "OK", "MESSAGE" => "Спасибо! Ваш запрос успешно отправлен. <br>Мы ответим Вам в ближайшее время."));
	?>
	<? } ?>
</div>
<? if ($arResult["isFormNote"] != "Y") { ?>
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
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
			//if ($arQuestion["CAPTION"] == 'Телефон') {
			if (strpos(toLower($arQuestion["CAPTION"]), 'телефон') !== false) {
				$phone_class = 'js_phone_class';
				$valid_type = 'PHONE';
			}
			if (strpos(toLower($arQuestion["CAPTION"]), 'имя') !== false) {
				$valid_type = 'NAME';
				?><div class="meeting-form__contact"><?php
			}
			if ($type == "email") {
				$valid_type = 'EMAIL';
			}
			if ($type == "textarea" && strpos(toLower($arQuestion["CAPTION"]), 'сообщение') !== false) {
				//$valid_type = 'QUESTION';
			}

			// Для валидации -->
			$strValidateAttrs = '';
			$arValidateAttrs = [];
			if ($arQuestion["REQUIRED"] == 'Y') {
				$arValidateAttrs[] = 'data-rule-required="true"';
				$requiredTextError =  ($valid_type == 'PHONE') ? 'FS_FIELD_ERROR_REQUIRED_PHONE' : 'FS_FIELD_ERROR_REQUIRED';
				$arValidateAttrs[] = 'data-msg-required="' . Loc::getMessage($type == "file" ? 'FS_FIELD_ERROR_REQUIRED_FILE' : $requiredTextError) . '"';

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
						/*
					case 'QUESTION':
					$arValidateAttrs[] = 'data-rule-minlength="1"';
					$arValidateAttrs[] = 'data-msg-minlength="' . Loc::getMessage('FS_ENTER_QUESTION_TEXT') . '"';
					break;
				*/
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
			<div class="form__input<?if ($type == "textarea"):?> mb-15<?endif;?>">
				<?
				if ($type == "textarea") { ?>
					<label class="visually-hidden" for="<?= $name ?>"><?= $arQuestion["CAPTION"]; ?><?= $star ?></label>
					<textarea <?= $strValidateAttrs; ?> class="meeting-form__textarea <?= $add_class; ?>" id="<?= $name ?>" name="<?= $name ?>" placeholder="<?= $arQuestion["CAPTION"]; ?><?= $star ?>" <?= $required; ?>></textarea>
				<?
				} else if ($type == "file") {
					?>
					<label class="meeting-form__file" for="<?= $name ?>">
						<div class="meeting-form__placeholder"><?= $arQuestion["CAPTION"]; ?><?= $star ?></div>
						<input style="display: none;" <?= $strValidateAttrs; ?> class="meeting-form__input" id="<?= $name ?>" type="<?= $type; ?>" name="<?= $name ?>" placeholder="<?= $arQuestion["CAPTION"]; ?><?= $star ?>" onchange="processSelectedFiles(this, '.' + $(this).closest('section').attr('class'), '.meeting-form__file')">
						<button class="delete-file display-none" type="button"></button>
					</label>
					<?
				} else {
				?>
					<label class="visually-hidden" for="<?= $name ?>"><?= $arQuestion["CAPTION"]; ?><?= $star ?></label>
					<input <?= $strValidateAttrs; ?> class="faq-form__input <?= $phone_class; ?> <?= $add_class; ?>" id="<?= $name ?>" type="text" name="<?= $name ?>" placeholder="<?= $arQuestion["CAPTION"]; ?><?= $star ?>" <?= $required; ?>>
				<?
				}
				?>
			</div>
			<?
			if ($type == "email") {
				?></div><? // .meeting-form__contact
			}
		}
	}
	?>
	<?
	if ($arResult["isUseCaptcha"] == "Y") {
	?>
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
	?>
	<p class="meeting-form__policy">
		Нажимая кнопку Отправить, вы даете согласие на <a href="<?= $GLOBALS["arSiteConfig"]["PRIVACY_LINK"]; ?>">обработку персональных данных</a>
	</p>
	<input type="hidden" name="web_form_submit" value="Y" />
	<button class="meeting-form__submit" name="web_form_submit_button" type="submit"><span class="btn-text"><?=$arResult['arForm']['BUTTON']?></span></button>
<?
} //endif (isFormNote)
?>
<? if ($arResult["isFormNote"] != "Y") { ?>
	<?= $arResult["FORM_FOOTER"] ?>
<? } ?>