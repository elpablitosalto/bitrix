<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

if (count($arResult['FIELDS']) == 0)
	return;

$this->addExternalJs($templateFolder . '/js/jquery.mask.min.js');
$this->addExternalJs($templateFolder . '/js/jquery.validate.min.js');

$upperFormCode = strtoupper($arParams['FORM_CODE']);
$formFieldsTagClosed = false;
?>
<form data-form-name="<?=htmlspecialchars($arResult['IBLOCK']['NAME'])?>" class="site-form col-md-6" action="<?= $arResult['ACTION'] ?>" method="POST" <? if (!empty($arParams['FORM_CODE'])) : ?> data-form-code="<?= $arParams['FORM_CODE'] ?>" <? endif; ?>>
	<h3>
		<?= $arResult['IBLOCK']['NAME'] ?>
		<span><?= $arResult['IBLOCK']['PHONE'] ?></span>
	</h3>
	<p><?= $arResult['IBLOCK']['DESCRIPTION'] ?></p>
	<div class="form-content">
		<div class="form-fields">
			<? foreach ($arResult['FIELDS'] as $arField) : ?>
				<?
				$arValidateAttrs = [];

				if ($arField['IS_REQUIRED'] == 'Y') {
					$arValidateAttrs[] = 'data-rule-required="true"';
					$requiredTextError =  ($arField['CODE'] == 'PHONE') ? 'FS_FIELD_ERROR_REQUIRED_PHONE' : 'FS_FIELD_ERROR_REQUIRED';
					$arValidateAttrs[] = 'data-msg-required="' . Loc::getMessage($requiredTextError) . '"';
				}

				if ($arField['CODE'] == 'CALL_ME_ON_WHATSAPP') {
					$formFieldsTagClosed = true;
				?>
		</div><? // .form-fields 
				?>
		<?
				}

				switch ($arField['PROPERTY_TYPE']) {
					case 'L':
		?>
			<div class="form-group">
				<?
						$strValidateAttrs = '';
						if (count($arValidateAttrs) > 0) {
							$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
						}
				?>
				<? if ($arField['LIST_TYPE'] == 'L') : ?>
					<select name="<?= $arField['CODE']; ?>" <?= $strValidateAttrs ?>>
						<option value=""><?= $arField['NAME'] ?></option>
						<? foreach ($arField['VALUES'] as $arValue) : ?>
							<option value="<?= $arValue['ID'] ?>"><?= $arValue['VALUE'] ?></option>
						<? endforeach; ?>
					</select>
				<? else : ?>
					<? if (count($arField['VALUES']) == 1) : ?>
						<? foreach ($arField['VALUES'] as $arValue) : ?>
							<div class="personal-agree">
								<input id="modal-<?= toLower($arField['CODE']) ?>-<?= $arValue['ID'] ?>" type="checkbox" name="<?= $arField['CODE']; ?>" value="<?= $arValue['ID'] ?>" <?= $strValidateAttrs ?>>
								<label for="modal-<?= toLower($arField['CODE']) ?>-<?= $arValue['ID'] ?>" class="label-checkbox"><?= $arField['NAME'] ?></label>
							</div>
						<? endforeach; ?>
					<? else : ?>
						<? foreach ($arField['VALUES'] as $arValue) : ?>
							<input type="radio" name="<?= $arField['CODE']; ?>" value="<?= $arValue['ID'] ?>" <?= $strValidateAttrs ?>> <?= $arValue['VALUE'] ?>
						<? endforeach; ?>
					<? endif; ?>

				<? endif; ?>
			</div>
		<?
						break;
					case 'F':

						$strValidateAttrs = '';
						if (count($arValidateAttrs) > 0) {
							$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
						}

						$arFileTypes = explode(',', $arField['FILE_TYPE']);
						foreach ($arFileTypes as &$fileType) {
							$fileType = '.' . trim($fileType);
						}
		?>
			<div class="form-group">
				<p class="h4 form-note-add"><?= $arField['NAME'] ?><? if ($arField['IS_REQUIRED'] == 'Y') : ?>*<? endif; ?></p>
				<label for="modal-upload-field-<?= toLower($arField['CODE']) ?>" class="btn btn-outlined upload-files-label">
					<input id="modal-upload-field-<?= toLower($arField['CODE']) ?>" type="file" name="<?= $arField['CODE']; ?><? if ($arField['MULTIPLE'] == 'Y') : ?>[]<? endif; ?>" <? if ($arField['MULTIPLE'] == 'Y') : ?> multiple="true" <? endif; ?> <?= $strValidateAttrs ?> class="upload-files-input" accept="<?= implode(', ', $arFileTypes) ?>">
					<span><?= Loc::getMessage('FS_ATTACH_FILE') ?></span>
					<svg class="icon icon-plus">
						<use xlink:href="#plus"></use>
					</svg>
				</label>
			</div>
			<?
						break;
					default:

						switch ($arField['CODE']) {
							case 'NAME':
								$fieldType = 'text';
								$arValidateAttrs[] = 'data-rule-minlength="2"';
								$arValidateAttrs[] = 'data-msg-minlength="' . Loc::getMessage('FS_NAME_ERROR_MINLEN') . '"';
								break;
							case 'EMAIL':
								$fieldType = 'text';
								$arValidateAttrs[] = 'data-rule-customemail="true"';
								$arValidateAttrs[] = 'data-msg-customemail="' . Loc::getMessage('FS_EMAIL_ERROR_INCORRECT') . '"';
								break;
							case 'PHONE':
								$fieldType = 'text';
								$arValidateAttrs[] = 'data-rule-phone="true"';
								$arValidateAttrs[] = 'data-msg-phone="' . Loc::getMessage('FS_PHONE_ERROR_INCORRECT') . '"';
								break;
							default:
								$fieldType = 'text';
								break;
						}

						$strValidateAttrs = '';
						if (count($arValidateAttrs) > 0) {
							$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
						}

						if ($arField['USER_TYPE'] == 'HTML') {
			?>
				<div class="form-group">
					<textarea class="form-control simple" name="<?= $arField['CODE']; ?>" placeholder="<?= $arField['NAME'] ?><? if ($arField['IS_REQUIRED'] == 'Y') : ?>*<? endif; ?>" <?= $strValidateAttrs ?>></textarea>
				</div>
			<?
						} else if (substr($arField['CODE'], 0, 7) == 'HIDDEN_') {
			?>
				<input type="hidden" name="<?= $arField['CODE'] ?>" value="<? if (isset($arParams['DEFAULT_' . $arField['CODE']])) : ?><?= $arParams['DEFAULT_' . $arField['CODE']] ?><? endif; ?>">
			<?
						} else {
			?>
				<div class="form-group">
					<input class="form-control simple" placeholder="<?= $arField['NAME'] ?><? if ($arField['IS_REQUIRED'] == 'Y') : ?>*<? endif; ?>" type="<?= $fieldType ?>" name="<?= $arField['CODE']; ?>" <?= $strValidateAttrs ?>>
				</div>
	<?
						}

						break;
				}
	?>
<? endforeach; ?>
<? if (!$formFieldsTagClosed) : ?>
	</div><? // .form-fields 
			?>
<? endif; ?>

<div class="form-group">
	<div class="personal-agree">
		<input id="modal-<?= $arParams['FORM_CODE'] ?>-agree" type="checkbox" name="AGREE" value="y" checked data-rule-required="true" data-msg-required="<?= Loc::getMessage('FS_AGREE_INCORRECT') ?>">
		<label for="modal-<?= $arParams['FORM_CODE'] ?>-agree" class="label-checkbox"></label>
		<p><?= Loc::getMessage('FS_AGREE_TEXT') ?></a></p>
	</div>
</div>
<div class="form-group">
	<div class="yandex-smart-captcha" id="smart-captcha-<?= md5(serialize($arParams) . serialize($arResult)) ?>" data-sitekey="<?= $arResult['YA_CAPTCHA']['CLIENT_KEY'] ?>"></div>
</div>
<div class="buttons-line submit-row">
	<button type="submit" class="btn btn-primary">
		<? if (mb_strlen($arParams['BUTTON_TEXT']) > 0) : ?><?= $arParams['BUTTON_TEXT'] ?><? else : ?><?= Loc::getMessage('FS_BTN_SUBMIT') ?><? endif; ?>
	</button>
</div>
</div>
</form>