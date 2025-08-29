<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

//vardump($arResult);

if (count($arResult['FIELDS']) == 0)
	return;

//$this->addExternalJs(SITE_TEMPLATE_PATH . '/js/libs/inputmask/jquery.inputmask.min.js');
$this->addExternalJs($templateFolder . '/js/jquery.validate.min.js');
//$upperFormCode = strtoupper($arParams['FORM_CODE']);

//$formAction = $arResult['ACTION'];
$formAction = $arParams['FORM_ACTION'];
?>
<form <?/*?>onsubmit="return false;"<?*/ ?> target="_self" action="<?= $formAction; ?>" method="POST" <? if (!empty($arParams['FORM_CODE'])) : ?> data-form-code="<?= $arParams['FORM_CODE'] ?>" <? endif; ?>>
	<input type="hidden" class="js_success_message" value="<?= Loc::getMessage($arParams['SUCCESS_MESSAGE_CODE']) ?>" />
	<div class="form-content" id="js_form_messages">
		<div class="form-error-message form-message"></div>
		<div class="form-success-message form-message"></div>
	</div>
	<?
	foreach ($arResult['FIELDS'] as $arField) { ?>
		<?
		$arValidateAttrs = [];

		if ($arField['IS_REQUIRED'] == 'Y') {
			$arValidateAttrs[] = 'data-rule-required="true"';
			$requiredTextError =  ($arField['CODE'] == 'PHONE') ? 'FS_FIELD_ERROR_REQUIRED_PHONE' : 'FS_FIELD_ERROR_REQUIRED';
			$arValidateAttrs[] = 'data-msg-required="' . Loc::getMessage($requiredTextError) . '"';
		}
		switch ($arField['PROPERTY_TYPE']) {
			case 'F':

				$strValidateAttrs = '';
				if (count($arValidateAttrs) > 0) {
					$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
				}

				$arFileTypes = explode(',', $arField['FILE_TYPE']);
				foreach ($arFileTypes as &$fileType) {
					$fileType = '.' . trim($fileType);
				}
				$id = 'modal-upload-field-' . toLower($arField['CODE']);
		?>
				<?/*?>
				<label class="order-order__file" for="<?= $id; ?>">Загрузить файлы</label>
				<input onchange="processSelectedFiles(this, '.<?= $arParams['CONTAINER_CLASS'] ?>', '.order-order__file')" class="order__input order__input_file" id="<?= $id; ?>" type="file" name="<?= $arField['CODE']; ?><? if ($arField['MULTIPLE'] == 'Y') : ?>[]<? endif; ?>" placeholder="Прикрепить файл" <? if ($arField['MULTIPLE'] == 'Y') : ?> multiple="true" <? endif; ?> <?= $strValidateAttrs ?> />
				<?*/ ?>

				<label class="order-order__file" for="<?= $id; ?>">
					<svg width="18" height="20">
						<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#camera"></use>
					</svg>
					<div class="meeting-form__placeholder">Загрузить файлы</div>
					<input onchange="processSelectedFiles(this, '.<?= $arParams['CONTAINER_CLASS'] ?>', '.order-order__file')" class="order__input order__input_file" id="<?= $id; ?>" type="file" name="<?= $arField['CODE']; ?><? if ($arField['MULTIPLE'] == 'Y') : ?>[]<? endif; ?>" placeholder="Прикрепить файл" <? if ($arField['MULTIPLE'] == 'Y') : ?> multiple="true" <? endif; ?> <?= $strValidateAttrs ?> accept="image/*" <?/*?>accept="<?= implode(', ', $arFileTypes) ?>"<?*/ ?> />
					<button class="delete-file display-none js_delete_file" type="button"></button>
				</label>
				<?
				break;

			default:

				$ext_class = '';
				$star = '';
				if ($arField['IS_REQUIRED'] == 'Y') {
					$star = '*';
				}

				switch ($arField['CODE']) {
					case 'NAME':
						$fieldType = 'text';

						$arValidateAttrs[] = 'data-rule-minlength="2"';
						$arValidateAttrs[] = 'data-msg-minlength="' . Loc::getMessage('FS_NAME_ERROR_MINLEN') . '"';

						$ext_class = 'order__input-name';
						break;
					case 'HEADER':
						$fieldType = 'text';
						//$arValidateAttrs[] = 'data-rule-minlength="2"';
						//$arValidateAttrs[] = 'data-msg-minlength="' . Loc::getMessage('FS_HEADER_ERROR_MINLEN') . '"';

						$ext_class = 'order__input-name';
						break;
					case 'EMAIL':
						$fieldType = 'text';
						$arValidateAttrs[] = 'data-rule-email="true"';
						$arValidateAttrs[] = 'data-msg-email="' . Loc::getMessage('FS_EMAIL_ERROR_INCORRECT') . '"';
						break;
					case 'PHONE':
						$fieldType = 'text';
						$arValidateAttrs[] = 'data-rule-phone="true"';
						$arValidateAttrs[] = 'data-msg-phone="' . Loc::getMessage('FS_PHONE_ERROR_INCORRECT') . '"';
						break;
					/*
					case 'RATING':
						break;
					*/	
					default:
						$fieldType = 'text';
						break;
				}
				if ($fieldType == 'text' || $arField['USER_TYPE'] == 'HTML') {
					$arValidateAttrs[] = 'data-rule-notonlyspaces="true"';
					$arValidateAttrs[] = 'data-msg-notonlyspaces="В тексте не должны быть только пробелы"';
				}

				$strValidateAttrs = '';
				if (count($arValidateAttrs) > 0) {
					$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
				}
				//echo "CODE = ".$arField['CODE']."<br />";
				$placeholder = $arField['CODE'] == 'PHONE' ? Loc::getMessage('FS_FIELD_PHONE_PLACEHOLDER') : $arField['NAME'];
				$labelTitle = $arField['CODE'] == 'PHONE' ? Loc::getMessage('FS_LABEL_PHONE') : Loc::getMessage('FS_LABEL_NAME');
				if ($arField['IS_REQUIRED'] == 'Y') {
					$placeholder .= '*';
				}

				if ($arField['USER_TYPE'] == 'HTML') {
				?>
					<div class="popup__textarea-wrapper">
						<textarea class="order__textarea " id="order-order__comment" name="<?= $arField['CODE']; ?>" placeholder="<?= $arField['NAME'] ?><? if ($arField['IS_REQUIRED'] == 'Y') : ?>*<? endif; ?>" <?= $strValidateAttrs ?>></textarea>
					</div>
				<?
				} else if (substr($arField['CODE'], 0, 7) == 'HIDDEN_') {
				?>
					<input type="hidden" name="<?= $arField['CODE'] ?>" value="<? if (isset($arParams['DEFAULT_' . $arField['CODE']])) : ?><?= $arParams['DEFAULT_' . $arField['CODE']] ?><? endif; ?>">
				<?
				} else if ($arField['CODE'] == 'RATING') {
				?>
					<div class="review-popup__star-input">
						<input type="hidden" name="<?= $arField['CODE'] ?>" value="" class="js--review-star-rating" data-rule-required="true" data-msg-required="Укажите оценку">
						<span class="star-text">Ваша оценка<?=$star;?>:</span>
						<div class="review-popup__wrapper-stars js_stars_container">
							<span data-rating="1"></span>
							<span data-rating="2"></span>
							<span data-rating="3"></span>
							<span data-rating="4"></span>
							<span data-rating="5"></span>
						</div>
					</div>
				<?
				} else {
				?>
					<div class="review-popup__input-wrapper">
						<input class="order__input <?= $ext_class; ?>" id="<?= toLower($arParams['FORM_CODE'] . '_' . $arField['CODE']) ?>" type="<?= $fieldType; ?>" name="<?= $arField['CODE']; ?>" placeholder="<?= $placeholder; ?>" <?= $strValidateAttrs ?>>
					</div>
	<?
				}

				break;
		}
	}
	?>
	<div class="c-capcha">
		<div class="c-capcha__img">
			<?
			$code = $APPLICATION->CaptchaGetCode();
			?>
			<input class="captcha_sid" type="hidden" name="CAPTCHA_SID" value="<?= $code; ?>" />
			<img class="captcha_img" src="/bitrix/tools/captcha.php?captcha_sid=<?= $code; ?>" alt="CAPTCHA" />
		</div>
		<div class="c-capcha__devider">></div>
		<?
		$arValidateAttrs = [];
		$arValidateAttrs[] = 'data-rule-required="true"';
		$arValidateAttrs[] = 'data-msg-required="' . Loc::getMessage('FS_CAPTCHA') . '"';
		$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
		?>
		<div class="c-capcha__input-wrapper">
			<input name="CAPTCHA_WORD" type="text" <?= $strValidateAttrs ?> />
		</div>
	</div>
	<a class="c-capcha__link">Обновить капчу (CAPTCHA)</a>
	<p class="popup-form__policy">Нажимая кнопку «Отправить», вы даете согласие на <a href="<?= $GLOBALS["arSiteConfig"]["PRIVACY_LINK"]; ?>">обработку персональных данных</a></p>
	<button class="button-orange" type="submit" name="web_form_submit_button">Отправить</button>
</form>