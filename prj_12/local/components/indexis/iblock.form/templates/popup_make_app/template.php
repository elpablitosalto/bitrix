<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

if (count($arResult['FIELDS']) == 0)
	return;

$this->addExternalJs(SITE_TEMPLATE_PATH . '/js/libs/inputmask/jquery.inputmask.min.js');
$this->addExternalJs($templateFolder . '/js/jquery.validate.min.js');

$upperFormCode = strtoupper($arParams['FORM_CODE']);
?>
<div class="nb-modal nb-modal_bg nb-modal-call" id="modal-call-makeup">
	<div class="nb-modal__overlay"></div>
	<div class="nb-modal__dialog" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
		<button class="nb-modal__close" type="button">
			<svg class="icon icon-cross ">
				<use xlink:href="#cross"></use>
			</svg>
		</button>
		<div class="nb-modal__body" id="<?= $arParams['EDIT_AREA_ID'] ?>">
			<div class="nb-modal-call__img">
				<div class="nb-modal-call__img-wrapper"><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/modal-operator-1.jpg" alt=""></div>
			</div>
			<div class="nb-modal-call__form">
				<form data-form-name="<?=htmlspecialchars($arResult['IBLOCK']['NAME'])?>" class="nb-form nb-modal-call-form" action="<?= $arResult['ACTION'] ?>" method="POST" <? if (!empty($arParams['FORM_CODE'])) : ?> data-form-code-makeup-popup="<?= $arParams['FORM_CODE'] ?>" <? endif; ?>>
					<div class="nb-form__body">
						<div class="form-content"></div>
						<div class="nb-form__fields">
							<?
							foreach ($arResult['FIELDS'] as $arField) : ?>
								<?
								$arValidateAttrs = [];

								if ($arField['IS_REQUIRED'] == 'Y') {
									$arValidateAttrs[] = 'data-rule-required="true"';
									$requiredTextError =  ($arField['CODE'] == 'PHONE') ? 'FS_FIELD_ERROR_REQUIRED_PHONE' : 'FS_FIELD_ERROR_REQUIRED';
									$arValidateAttrs[] = 'data-msg-required="' . Loc::getMessage($requiredTextError) . '"';
								}

								switch ($arField['PROPERTY_TYPE']) {
									case 'L': ?>
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
										} ?>
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
										//echo "CODE = ".$arField['CODE']."<br />";
										$placeholder = $arField['CODE'] == 'PHONE' ? Loc::getMessage('FS_FIELD_PHONE_PLACEHOLDER') : $arField['NAME'];
										$labelTitle = $arField['CODE'] == 'PHONE' ? Loc::getMessage('FS_LABEL_PHONE') : Loc::getMessage('FS_LABEL_NAME');
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
											<div class="nb-form-field">
												<input id="<?=toLower($arParams['FORM_CODE'] . '_' . $arField['CODE'])?>" type="<?= $fieldType; ?>" name="<?= $arField['CODE']; ?>" placeholder="<?= $placeholder; ?>" <?= $strValidateAttrs ?>>
												<label for="<?=toLower($arParams['FORM_CODE'] . '_' . $arField['CODE'])?>"><?= $labelTitle ?></label>
											</div>
								<?
										}

										break;
								}
								?>
							<? endforeach; ?>

							<?/*?>
							<div class="nb-form-field">
								<input id="cf-2-name" type="text" name="name" placeholder="Как к вам обращаться">
								<label for="cf-2-name">Как к Вам обращаться</label>
							</div>
							<div class="nb-form-field">
								<input id="cf-2-phone" type="tel" name="tel" placeholder="+7 (999) 999-99-99">
								<label for="cf-2-phone">Укажите ваш номер</label>
							</div>
							<?*/ ?>
						</div>
						<div class="nb-form__actions">
							<button class="nb-btn nb-form__submit" type="submit">Записаться</button>
						</div>
					</div>
				</form>
				<div class="nb-modal-call__desc">
					<p>Вы также можете позвонить по телефону и уточнить любую интересующую вас информацию</p>
				</div>
				<div class="nb-modal-call__phone"><a href="tel:+74957836606">+7 (495) 783-66-06</a></div>
				<p class="nb-modal-call__agreement">Нажимая на&nbsp;кнопку «Записаться» вы соглашаетесь на&nbsp;обработку персональных данных</p>
			</div>
		</div>
	</div>
</div>