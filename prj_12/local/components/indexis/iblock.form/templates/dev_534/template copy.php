<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

if (count($arResult['FIELDS']) == 0)
	return;

$this->addExternalJs(SITE_TEMPLATE_PATH . '/js/libs/inputmask/jquery.inputmask.min.js');
$this->addExternalJs($templateFolder . '/js/jquery.validate.min.js');

$upperFormCode = strtoupper($arParams['FORM_CODE']);
?>
<section class="nb-consultation-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
	<div class="nb-consultation" id="<?= $arParams['EDIT_AREA_ID'] ?>">
		<div class="container">
			<h2 class="nb-consultation__title">
				Записаться <span class="color_green">на&nbsp;бесплатную консультацию</span>
			</h2>
			<div class="nb-consultation__desc nb-consultation__desc_desktop">
				<p>Позвоните, или воспользуйтесь формой для обратной связи – мы перезвоним и подберем для вас удобное время приема</p>
			</div><span class="nb-consultation__phone-wrapper"><span class="nb-consultation__phone-icon">
					<svg class="icon icon-call ">
						<use xlink:href="#call"></use>
					</svg></span><a class="nb-consultation__phone" href="tel:+74957836606">+7 (495) 783-66-06</a></span>
			<div class="nb-consultation__desc nb-consultation__desc_mobile">
				<p>или закажите <span class="color_green">обратный звонок:</span>
				</p>
			</div>
			<form class="nb-form nb-consultation-form" action="<?= $arResult['ACTION'] ?>" method="POST" <? if (!empty($arParams['FORM_CODE'])) : ?> data-form-code="<?= $arParams['FORM_CODE'] ?>" <? endif; ?>>
				<div class="nb-form__body">
					<div class="nb-form__fields">
						<? foreach ($arResult['FIELDS'] as $arField) : ?>
							<?
							$arValidateAttrs = [];

							if ($arField['IS_REQUIRED'] == 'Y') {
								$arValidateAttrs[] = 'data-rule-required="true"';
								$arValidateAttrs[] = 'data-msg-required="' . Loc::getMessage('FS_FIELD_ERROR_REQUIRED') . '"';
							}

							switch ($arField['PROPERTY_TYPE']) {
								case 'L':
									break;
								case 'F':
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
											$fieldType = 'tel';
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
									} else if (substr($arField['CODE'], 0, 7) == 'HIDDEN_') {
									?>
										<input type="hidden" name="<?= $arField['CODE'] ?>" value="<? if (isset($arParams['DEFAULT_' . $arField['CODE']])) : ?><?= $arParams['DEFAULT_' . $arField['CODE']] ?><? endif; ?>">
									<?
									} else {
										$placeholder = $arField['CODE'] == 'PHONE' ? Loc::getMessage('FS_FIELD_PHONE_PLACEHOLDER') : $arField['NAME'];
									?>
										<div class="nb-form-field">
											<input id="<?= $arField['CODE']; ?>" type="<?=$fieldType;?>" name="<?= $arField['CODE']; ?>" placeholder="<?=$placeholder;?>" <?= $strValidateAttrs ?> />
											<label for="<?= $arField['CODE']; ?>"><?= $arField['NAME']; ?></label>
										</div>
									<?
									}
									break;
							}
							?>
						<? endforeach; ?>
					</div>
					<div class="nb-form__actions">
						<button class="nb-btn nb-form__submit" type="submit">Записаться</button>
					</div>
				</div>
				<div class="nb-form__footer">
					<p class="nb-form__agreement"><?=Loc::getMessage('FS_FORM_AGREEMENT')?></p>
				</div>
			</form>
		</div>
	</div>
</section>