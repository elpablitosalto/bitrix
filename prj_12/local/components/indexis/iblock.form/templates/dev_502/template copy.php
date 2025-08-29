<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

if (count($arResult['FIELDS']) == 0)
	return;

$this->addExternalJs(SITE_TEMPLATE_PATH . '/js/libs/inputmask/jquery.inputmask.min.js');
$this->addExternalJs($templateFolder . '/js/jquery.validate.min.js');

$upperFormCode = strtoupper($arParams['FORM_CODE']);
?>
<section class="nb-section nb-comparison-advantage" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
	<div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
		<div class="nb-section__body">
			<form class="nb-comparison-advantage__form" action="<?= $arResult['ACTION'] ?>" method="POST" <? if (!empty($arParams['FORM_CODE'])) : ?> data-form-code="<?= $arParams['FORM_CODE'] ?>" <? endif; ?>>
				<h3 class="nb-comparison-advantage__title">
					<span class="is-desktop">Улыбайтесь чаще</span>
					<span>вместе с нами</span>
				</h3>
				<ul class="nb-comparison-advantage__list is-desktop">
					<li class="nb-comparison-advantage__item">Безопасно и бережно</li>
					<li class="nb-comparison-advantage__item">Инновационные технологии</li>
					<li class="nb-comparison-advantage__item">Премиальный сервис</li>
				</ul>
				<p class="nb-comparison-advantage__text content-comparison-desktop">Получить более подробную информацию:</p>
				<p class="nb-comparison-advantage__text content-comparison-mobile">Получите подробную информацию:
				</p><a class="nb-comparison-advantage__phone" href="tel:+74957836606">+7 (495) 783-66-06</a>
				<div class="nb-comparison-advantage__form-submit">
					<? foreach ($arResult['FIELDS'] as $arField) : ?>
						<?
						$arValidateAttrs = [];

						if ($arField['IS_REQUIRED'] == 'Y') {
							$arValidateAttrs[] = 'data-rule-required="true"';
							$requiredTextError =  ($arField['CODE'] == 'PHONE') ? 'FS_FIELD_ERROR_REQUIRED_PHONE' : 'FS_FIELD_ERROR_REQUIRED';
							$arValidateAttrs[] = 'data-msg-required="' . Loc::getMessage($requiredTextError) . '"';
						}

						switch ($arField['PROPERTY_TYPE']) {
								/*
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
							*/
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
									<div class="nb-form-field">
										<textarea class="form-control simple" name="<?= $arField['CODE']; ?>" placeholder="<?= $arField['NAME'] ?><? if ($arField['IS_REQUIRED'] == 'Y') : ?>*<? endif; ?>" <?= $strValidateAttrs ?>></textarea>
									</div>
								<?
								} else if (substr($arField['CODE'], 0, 7) == 'HIDDEN_') {
								?>
									<input type="hidden" name="<?= $arField['CODE'] ?>" value="<? if (isset($arParams['DEFAULT_' . $arField['CODE']])) : ?><?= $arParams['DEFAULT_' . $arField['CODE']] ?><? endif; ?>">
								<?
								} else {
								?>
									<label class="visually-hidden" for="<?= $arField['CODE']; ?>"><?= $arField['NAME'] ?></label>
									<input class="nb-comparison-advantage__form-input form-control simple" style="display: block;" id="<?= $arField['CODE']; ?>" type="<?= $fieldType ?>" name="<?= $arField['CODE']; ?>" placeholder="<? if ($arField['CODE'] == 'PHONE') : ?><?= Loc::getMessage('FS_FIELD_PHONE_PLACEHOLDER') ?><? else : ?><?= $arField['NAME'] ?><? endif; ?>" <?= $strValidateAttrs ?>>
									<?/*?>
									<input id="phone" type="text" name="<?= $arField['CODE']; ?>" class="nb-comparison-advantage__form-input form-control simple" placeholder="+7 (999) 999-99-99" required="">
									<?*/ ?>
						<?
								}

								break;
						}
						?>
					<? endforeach; ?>
					<button class="nb-btn nb-form__submit nb-advantage__submit" type="submit">Записаться</button>
				</div>
			</form>
		</div>
	</div>
</section>