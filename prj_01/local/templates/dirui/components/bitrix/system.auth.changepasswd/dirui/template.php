<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arResult["PHONE_REGISTRATION"]) {
	CJSCore::Init('phone_auth');
}
?>

<form class="password-form js_validate_ajax" data-type-form="CHANGE_PASSWORD" data-scroll-to="js_change_password_container" data-container-id="js_change_password_container" method="post" action="<?= $arResult["AUTH_URL"] ?>" name="bform">
	<div id="js_change_password_container">
		<? if ($arResult['bNoError'] == true) { ?>
			<? ShowMessage($APPLICATION->arAuthResult['MESSAGE']);	?>
			<input type="hidden" name="SUCCESS" value="Y" />
		<? } else { ?>
			<?
			if (!empty($APPLICATION->arAuthResult['MESSAGE'])) {
				ShowMessage($APPLICATION->arAuthResult['MESSAGE']);
			}
			?>
			<? if ($arResult["BACKURL"] <> '') : ?>
				<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
			<? endif ?>
			<input type="hidden" name="AUTH_FORM" value="Y">
			<input type="hidden" name="TYPE" value="CHANGE_PWD">
			<div class="password-form__wrapper_">
				<h2>Изменение пароля</h2>
				<div class="password-form__group-item">
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
						<input <?= $strValidateAttrs; ?> class="registration-input" type="email" name="USER_LOGIN" maxlength="50" value="<?= $arResult["LAST_LOGIN"] ?>" placeholder="E-mail*" required>
					</label>
				</div>
				<div class="password-form__group-item">
					<label class="registration-label js_validate_field_container">
						<?
						$strValidateAttrs = '';
						$arValidateAttrs = [];
						$arValidateAttrs[] = 'data-rule-required="true"';
						$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
						$arValidateAttrs[] = 'required';
						if (count($arValidateAttrs) > 0) {
							$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
						}
						?>
						<input <?= $strValidateAttrs; ?> class="registration-input" type="text" name="USER_CHECKWORD" maxlength="50" value="<?= $arResult["USER_CHECKWORD"] ?>" placeholder="<? echo GetMessage("sys_auth_chpass_code") ?>*" required>
					</label>
				</div>
				<div class="password-form__group-item">
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
						<input <?= $strValidateAttrs; ?> class="registration-input" autocomplete="off" id="newpassword" type="password" name="USER_PASSWORD" maxlength="255" value="<?= $arResult["USER_PASSWORD"] ?>" placeholder="<?= GetMessage("AUTH_NEW_PASSWORD_REQ") ?>" required>
						<span class="registration-form__show-password">
							<svg width="22" height="16">
								<use xlink:href="/img/icons/sprite/svg-sprite.svg#eye"></use>
							</svg></span><span class="registration-form__hide-password display-none">
							<svg width="22" height="16">
								<use xlink:href="/img/icons/sprite/svg-sprite.svg#eye2"></use>
							</svg>
						</span>
					</label>
				</div>
				<div class="password-form__group-item">
					<label class="registration-label js_validate_field_container">
						<?
						$strValidateAttrs = '';
						$arValidateAttrs = [];
						$arValidateAttrs[] = 'data-rule-required="true"';
						$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
						$arValidateAttrs[] = 'data-rule-newpassword="true"';
						$arValidateAttrs[] = 'data-rule-equalTo="#newpassword"';
						$arValidateAttrs[] = 'data-msg-equalTo="Пожалуйста, введите то же значение еще раз"';
						$arValidateAttrs[] = 'required';
						if (count($arValidateAttrs) > 0) {
							$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
						}
						?>
						<input <?= $strValidateAttrs; ?> autocomplete="off" id="newpasswordconfirm" class="registration-input" type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?= $arResult["USER_CONFIRM_PASSWORD"] ?>" placeholder="<?= GetMessage("AUTH_NEW_PASSWORD_CONFIRM") ?>" required>
						<span class="registration-form__show-password">
							<svg width="22" height="16">
								<use xlink:href="/img/icons/sprite/svg-sprite.svg#eye"></use>
							</svg></span><span class="registration-form__hide-password display-none">
							<svg width="22" height="16">
								<use xlink:href="/img/icons/sprite/svg-sprite.svg#eye2"></use>
							</svg>
						</span>
					</label>
				</div>
				<button class="link-button_rose" type="submit">Изменить пароль</button>
				<p>Пароль должен быть не менее 8 символов длиной, содержать латинские символы верхнего регистра (A-Z), содержать латинские символы нижнего регистра (a-z), содержать цифры (0-9).</p>
			</div>
		<? } ?>
	</div>
</form>
<div class="popup popup-password js_popup_change_password">
	Пароль успешно изменен. На ваш email высланы новые регистрационные данные.
	<div class="popup-password__wrapper">
		<a class="link-button_rose" href="/auth/">Войти</a>
	</div>
	<button class="popup_close js_popup_change_password_close" type="button"></button>
</div>