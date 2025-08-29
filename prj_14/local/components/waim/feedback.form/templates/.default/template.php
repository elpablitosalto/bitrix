<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;
?>

<? if (!empty($arResult['GROUPS'])) : ?>
	<form class="form form_style_primary form_width_full" id="<?= $arResult['FORM_ID'] ?>">
		<?= $arResult['FORM_META'] ?>
		<div class="form__main">
			<? if (!empty($arParams['TITLE'])) : ?>
				<div class="form__title form__title_align_center">
					<!-- begin .title-->
					<h4 class="title title_size_h4"><?= $arParams['TITLE'] ?></h4>
					<!-- end .title-->
				</div>
			<? endif; ?>

			<? if (!empty($arParams['DESCRIPTION'])) : ?>
				<div class="form__description">
					<?= $arParams['DESCRIPTION'] ?>
				</div>
			<? endif; ?>

			<div class="form__inputs">
				<? foreach ($arResult['GROUPS'] as $SID => $arGroup) : ?>
					<? foreach ($arGroup['ITEMS'] as $name => $arItem) : ?>
						<? if ($SID === 'NAME'): ?>
							<div class="form__lines">
							<? endif; ?>
							<div class="form__line">
								<!-- begin .form-control-->
								<div class="form-control form-control_width_full">
									<label class="form-control__holder">
										<? if (in_array($arItem['TYPE'], ['text', 'email', 'tel'])) : ?>
											<span class="form-control__field">
												<input
													placeholder="<?= $arGroup['TITLE'] ?>"
													type="<?= $arItem['TYPE'] ?>"
													value="<?= $arItem['VALUE'] ?>"
													<? if ($arGroup['REQUIRED'] === 'Y'): ?>required<? endif; ?>
													class="form-control__input <? if ($arItem['TYPE'] === 'tel'): ?>js-phone-input<? endif; ?>"
													name="<?= $name ?>">
												<svg class="form-control__icon form-control__icon_success" width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M1.91284 3.30769L5.72237 7L11.9128 1" stroke="black" stroke-width="2" stroke-linecap="round"></path>
												</svg>
												<svg class="form-control__icon form-control__icon_error" width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M1.91284 1L7.91284 7" stroke="#FF0000" stroke-width="2" stroke-linecap="round"></path>
													<path d="M7.91284 1L1.91284 7" stroke="#FF0000" stroke-width="2" stroke-linecap="round"></path>
												</svg>
											</span>
										<? else: ?>
											<?= $arItem['TYPE'] ?> еще не поддерживается
										<? endif; ?>
									</label>
								</div>
								<!-- end .form-control-->
							</div>
							<? if ($SID === 'PHONE'): ?>
							</div>
						<? endif; ?>
					<? endforeach; ?>
				<? endforeach; ?>
			</div>
			<div class="form__message"></div>

			<div class="form__confirmation-check">
				<!-- begin .check-elem-->
				<label class="check-elem">
					<input class="check-elem__input js-disabling-checkbox" type="checkbox" name="agreement" required="required" /><span class="check-elem__label">Согласен с<a class="link" href="/privacy/" target="_blank"> политикой конфиденциальности</a></span>
				</label>
				<!-- end .check-elem-->
			</div>

			<div class="form__controls form__controls_style_primary">
				<div class="form__control">
					<!-- begin .button-->
					<button class="button button_style_dark button_size_l button_width_full button_text-size_l button_style_dark button_size_l button_width_full button_text-size_l" type="submit">
						<span class="button__holder"><?= $arParams['BUTTON_TEXT'] ?></span>
					</button>
					<!-- end .button-->
					<input type="hidden" name="web_form_submit" value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>" />
				</div>
			</div>
		</div>
		<div class="form__final">
			<div class="form__message-wrapper">
				<div class="form__title">
					<!-- begin .title-->
					<h3 class="title title_size_h4"><?= $arParams['SUCCESS_TITLE'] ?></h3>
					<!-- end .title-->
				</div>
				<div class="form__text"><?= $arParams['SUCCESS_DESCRIPTION'] ?></div>
			</div>
		</div>
	</form>

	<script>
		window.addEventListener('DOMContentLoaded', function() {
			if (typeof window.feedbackFormHandler !== 'undefined') {
				window.feedbackFormHandler('<?= $arResult['FORM_ID'] ?>')
			}
		})
	</script>
<? endif; ?>