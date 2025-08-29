<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

if (count($arResult['FIELDS']) == 0)
	return;

$this->addExternalJs(SITE_TEMPLATE_PATH . '/js/libs/inputmask/jquery.inputmask.min.js');
$this->addExternalJs($templateFolder . '/js/jquery.validate.min.js');

$upperFormCode = strtoupper($arParams['FORM_CODE']);
$arValidateAttrs[] = 'data-rule-required="true"';
$arValidateAttrs[] = 'data-msg-required="' . Loc::getMessage('FS_FIELD_ERROR_REQUIRED_PHONE') . '"';
$arValidateAttrs[] = 'data-rule-phone="true"';
$arValidateAttrs[] = 'data-msg-phone="' . Loc::getMessage('FS_PHONE_ERROR_INCORRECT') . '"';
$strValidateAttrs = '';
if (count($arValidateAttrs) > 0) {
	$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
}
?>
<section class="nb-diagnostics-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
	<div class="nb-diagnostics-section__inner" id="<?= $arParams['EDIT_AREA_ID'] ?>">
		<div class="nb-diagnostics-section__main">
			<div class="nb-diagnostics-block">
				<div class="nb-diagnostics-block__header">
					<h2 class="nb-diagnostics-block__title">
						Пройдите высокоточное <span class="color_light-pink">диагностическое исследование</span>
					</h2>
				</div>
				<div class="nb-diagnostics-block__features">
					<ol class="nb-diagnostics-block__list">
						<li class="nb-diagnostics-block__list-item">
							<p class="nb-diagnostics-block__list-text"><span>Технологичное оборудование ведущих мировых производителей</span></p>
						</li>
						<li class="nb-diagnostics-block__list-item">
							<p class="nb-diagnostics-block__list-text"><span>Высочайшее качество снимков при минимальной лучевой нагрузке</span></p>
						</li>
						<li class="nb-diagnostics-block__list-item">
							<p class="nb-diagnostics-block__list-text"><span>Индивидуальный подход и результат в течение 5 минут</span></p>
						</li>
					</ol>
				</div>
				<div class="nb-diagnostics-block__form">
					<div class="nb-diagnostics-block__call">
						<p>Получить <span class="hide-mobile">более</span> подробную информацию: <span class="nb-diagnostics-block__phone-wrapper"><span class="nb-diagnostics-block__phone-icon">
									<svg class="icon icon-call ">
										<use xlink:href="#call"></use>
									</svg></span><a class="nb-diagnostics-block__phone" href="tel:+74957836606">+7 (495) 783-66-06</a></span>
						</p>
					</div>
					<form data-form-name="<?=htmlspecialchars($arResult['IBLOCK']['NAME'])?>" class="nb-form nb-diagnostic-form" action="<?= $arResult['ACTION'] ?>" method="POST" <? if (!empty($arParams['FORM_CODE'])) : ?> data-form-code="<?= $arParams['FORM_CODE'] ?>" <? endif; ?>>
						<input type="hidden" name="HIDDEN_PAGE" value="<? if (isset($arParams['DEFAULT_' . 'HIDDEN_PAGE'])) : ?><?= $arParams['DEFAULT_' . 'HIDDEN_PAGE'] ?><? endif; ?>">
						<div class="nb-form__body">
							<div class="nb-form__fields">
								<div class="nb-form-field">
									<input id="<?=toLower($arParams['FORM_CODE'] . '_' . $arField['CODE'])?>" type="tel" name="PHONE" <?=$strValidateAttrs;?> placeholder="+7 (999) 999-99-99">
									<label for="<?=toLower($arParams['FORM_CODE'] . '_' . $arField['CODE'])?>">Укажите ваш номер</label>
								</div>
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
			<div class="nb-diagnostics-section__img-inner"><img src="<?=SITE_TEMPLATE_PATH?>/img/content/diagnostics/diagnostics-img-1.png" alt=""></div>
		</div>
	</div>
</section>