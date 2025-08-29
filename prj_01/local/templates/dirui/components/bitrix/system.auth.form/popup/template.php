<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init();


?>

<div id="js_auth_popup_container">
	<form class="authorization-form js_validate_ajax" data-type-form="AUTH_POPUP" <?/*?>data-scroll-to="js_auth_popup_container"<?*/ ?> data-container-id="js_auth_popup_container" method="post" action="<?= $arResult["AUTH_URL"] ?>">
		<?
		/*
		if ($arResult['bSendForm']) {
			vardump($arResult);
		}
		*/
		?>
		<?
		if ($arResult['SUCCESS_AUTH'] == 'Y') {
			ShowMessage(array('MESSAGE' => 'Вы успешно авторизовались на сайте.', 'TYPE' => 'OK'));
		} else {
		?>
			<input type="hidden" name="AUTH_FORM" value="Y" />
			<input type="hidden" name="TYPE" value="AUTH" />
			<input type="hidden" name="AUTH_TYPE" class="js_auth_type" value="" />
			<?
			if ($arResult['$bShowError']) {
				ShowMessage($arResult['ERROR_MESSAGE']);
			}
			?>
			<h2>Войти</h2>
			<div class="registration-form__group-item">
				<label class="registration-label js_validate_field_container">
					<?
					$strValidateAttrs = '';
					$arValidateAttrs = [];
					$arValidateAttrs[] = 'data-rule-required="true"';
					$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
					$arValidateAttrs[] = 'data-rule-email="true"';
					$arValidateAttrs[] = 'data-msg-email="Укажите верный e-mail"';
					$arValidateAttrs[] = 'required';
					if (count($arValidateAttrs) > 0) {
						$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
					}
					?>
					<input <?= $strValidateAttrs; ?> class="registration-input" type="text" name="USER_LOGIN" placeholder="Логин" />
				</label>
			</div>
			<div class="registration-form__group-item">
				<label class="registration-label js_validate_field_container">
					<?
					$strValidateAttrs = '';
					$arValidateAttrs = [];
					$arValidateAttrs[] = 'data-rule-required="true"';
					$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
					$arValidateAttrs[] = 'data-rule-minlength="8"';
					$arValidateAttrs[] = 'data-msg-minlength="Пароль должен быть не менее 8 символов"';
					$arValidateAttrs[] = 'data-rule-newpassword="true"';
					$arValidateAttrs[] = 'data-rule-stength="true"';
					$arValidateAttrs[] = 'data-msg-stength="Пароль должен содержать цифры и латинские символы нижнего (a-z) и верхнего регистров (A-Z)"';
					$arValidateAttrs[] = 'required';
					if (count($arValidateAttrs) > 0) {
						$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
					}
					?>
					<input <?= $strValidateAttrs; ?> class="registration-input" type="password" name="USER_PASSWORD" placeholder="Пароль" />
					<span class="registration-form__show-password">
						<svg width="22" height="16">
							<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#eye"></use>
						</svg></span><span class="registration-form__hide-password display-none">
						<svg width="22" height="16">
							<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#eye2"></use>
						</svg>
					</span>
				</label>
			</div>
			<button class="link-button_rose" type="submit">Войти</button>
			<div class="authorization-form__text"><span>Нет аккаунта?</span></div>
			<div class="authorization-buttons__wrapper">
				<a class="link-button_grey" href="/registration/" target="_blank">Зарегистрироваться</a>
				<a class="link-button_grey" href="/registration/partner/" target="_blank">Стать партнером</a>
			</div>

		<? } ?>
	</form>
</div>