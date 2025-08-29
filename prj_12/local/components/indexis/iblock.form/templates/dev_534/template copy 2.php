<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

if (count($arResult['FIELDS']) == 0)
	return;

$this->addExternalJs(SITE_TEMPLATE_PATH . '/js/libs/inputmask/jquery.inputmask.min.js');
$this->addExternalJs($templateFolder . '/js/jquery.validate.min.js');

$upperFormCode = strtoupper($arParams['FORM_CODE']);
?>
<section class="nb-diagnostics-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
	<div class="nb-diagnostics-section__inner" id="<?= $arParams['EDIT_AREA_ID'] ?>">
		<div class="nb-diagnostics-section__main">
			<div class="nb-diagnostics-block">
				<div class="nb-diagnostics-block__header">
					<?
					// Вывод заголовка для десктопа -->
					if (strlen($arParams['arHeaders']["H_FST_PART_D"]) > 0) {
					?>
						<h2 class="nb-diagnostics-block__title desktop">
							<?
							echo $arParams['arHeaders']["H_FST_PART_D"];
							if (strlen($arParams['arHeaders']["H_SEC_PART_D"]) > 0) {
							?> <span class="color_light-pink">
									<?= $arParams['arHeaders']["H_SEC_PART_D"]; ?>
								</span>
							<?
							}
							?>
						</h2>
					<?
					}
					// <-- Вывод заголовка для десктопа

					// Вывод заголовка для мобильного -->
					if (strlen($arParams['arHeaders']["H_FST_PART_M"]) > 0) {
					?>
						<h2 class="nb-diagnostics-block__title mobile">
							<?
							echo $arParams['arHeaders']["H_FST_PART_M"];
							if (strlen($arParams['arHeaders']["H_SEC_PART_M"]) > 0) {
							?> <span class="color_light-pink">
									<?= $arParams['arHeaders']["H_SEC_PART_M"]; ?>
								</span>
							<?
							}
							?>
						</h2>
					<?
					}
					// <-- Вывод заголовка для мобильного
					?>
				</div>
				<? if (!empty($arParams['ITEMS'])) { ?>
					<div class="nb-diagnostics-block__features">
						<ol class="nb-diagnostics-block__list">
							<? foreach ($arParams['ITEMS'] as $key => $val) { ?>
								<li class="nb-diagnostics-block__list-item">
									<p class="nb-diagnostics-block__list-text"><span><?= $val; ?></span></p>
								</li>
							<? } ?>
						</ol>
					</div>
				<? } ?>
				<div class="nb-diagnostics-block__form">
					<div class="nb-diagnostics-block__call">
						<p>Получить <span class="hide-mobile">более</span> подробную информацию: <span class="nb-diagnostics-block__phone-wrapper"><span class="nb-diagnostics-block__phone-icon">
									<svg class="icon icon-call ">
										<use xlink:href="#call"></use>
									</svg></span><a class="nb-diagnostics-block__phone" href="tel:<?= $arParams['CLINIC_PHONE']; ?>"><?= $arParams['CLINIC_PHONE']; ?></a></span>
						</p>
					</div>
					<form class="nb-form nb-diagnostic-form" action="<?= $arResult['ACTION'] ?>" method="POST" <? if (!empty($arParams['FORM_CODE'])) : ?> data-form-code="<?= $arParams['FORM_CODE'] ?>" <? endif; ?>>
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
													<input id="<?= $arField['CODE']; ?>" type="<?= $fieldType; ?>" name="<?= $arField['CODE']; ?>" placeholder="<?= $placeholder; ?>" <?= $strValidateAttrs ?> />
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
								<button class="nb-btn nb-btn_light-pink nb-form__submit" type="submit">Записаться</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="nb-diagnostics-section__img">
			<div class="nb-diagnostics-section__img-inner">
				<? if (strlen($arParams['PICTURE']["SRC"]) > 0) { ?>
					<img src="<?=$arParams['PICTURE']["SRC"];?>" alt="">
				<? } ?>
			</div>
		</div>
	</div>
</section>