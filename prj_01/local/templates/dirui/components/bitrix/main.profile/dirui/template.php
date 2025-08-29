<?

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<?
//vardump($arResult);
?>



<div class="page-body">
	<div class="page-body__wrapper">
		<h1>Профиль</h1>
		<form class="profile-form js_validate_ajax" data-type-form="PROFILE_PERSONAL" data-scroll-to="js_profile_personal_container" data-container-id="js_profile_personal_container" method="post" action="<?= $arResult['FORM_ACTION']; ?>">
			<?= $arResult["BX_SESSION_CHECK"] ?>
			<input type="hidden" name="lang" value="<?= LANG ?>" />
			<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />
			<input type="hidden" name="save" value="Y" />

			<div id="js_profile_personal_container">
				<?
				if ($arResult['DATA_SAVED'] == 'Y') {
					ShowNote(GetMessage('PROFILE_DATA_SAVED'));
				} else {
					if (strlen($arResult["strProfileError"]) > 0) {
						ShowError($arResult["strProfileError"]);
					}
				}
				?>
			</div>

			<h2>Данные профиля</h2>
			<div class="registration-form__group-item">
				<div class="registration-form__group-wrapper">
					<label class="registration-label <?/*?>c-form__verified<?*/ ?>">
						<input value="<? echo $arResult["arUser"]["NAME"] ?>" class="registration-input" type="text" name="_NAME" placeholder="Ваше имя" disabled />
					</label>
				</div>
				<div class="registration-callback"><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/exclamation.svg" alt="">
					<div class="registration-callback__wrapper">Для изменения обратитесь к менеджеру. <a href="/contacts/#callback">Обратиться</a>
					</div>
				</div>
			</div>
			<div class="registration-form__group-item">
				<div class="registration-form__group-wrapper">
					<label class="registration-label">
						<input value="<? echo $arResult["arUser"]["LAST_NAME"] ?>" class="registration-input" type="text" name="_LAST_NAME" placeholder="Ваша фамилия" disabled>
					</label>
					<?/*?><div class="c-form__error">Сообщение ошибки</div><?*/ ?>
				</div>
				<div class="registration-callback"><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/exclamation.svg" alt="">
					<div class="registration-callback__wrapper">Для изменения обратитесь к менеджеру. <a href="/contacts/#callback">Обратиться</a>
					</div>
				</div>
			</div>
			<div class="registration-form__group-item">
				<div class="registration-form__group-wrapper">
					<label class="registration-label">
						<input value="<? echo $arResult["arUser"]["WORK_COMPANY"] ?>" class="registration-input" type="text" name="_WORK_COMPANY" placeholder="Название организации" disabled>
					</label>
				</div>
				<div class="registration-callback"><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/exclamation.svg" alt="">
					<div class="registration-callback__wrapper">Для изменения обратитесь к менеджеру. <a href="/contacts/#callback">Обратиться</a>
					</div>
				</div>
			</div>
			<div class="registration-form__group-item">
				<div class="registration-form__group-wrapper">
					<label class="registration-label">
						<input value="<? echo $arResult["arUser"]["WORK_POSITION"] ?>" class="registration-input" type="text" name="_WORK_POSITION" placeholder="Должность" disabled>
					</label>
				</div>
				<div class="registration-callback"><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/exclamation.svg" alt="">
					<div class="registration-callback__wrapper">Для изменения обратитесь к менеджеру. <a href="/contacts/#callback">Обратиться</a>
					</div>
				</div>
			</div>
			<div class="registration-form__group-item">
				<div class="registration-form__group-wrapper">
					<label class="registration-label js_validate_field_container">
						<?
						$strValidateAttrs = '';
						$arValidateAttrs = [];
						$arValidateAttrs[] = 'data-rule-required="true"';
						$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
						$arValidateAttrs[] = 'data-rule-phone="true"';
						$arValidateAttrs[] = 'data-msg-phone="Длина телефона должна быть 11 цифр"';
						$arValidateAttrs[] = 'data-rule-newpassword="true"';
						$arValidateAttrs[] = 'required';
						if (count($arValidateAttrs) > 0) {
							$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
						}
						?>
						<input <?= $strValidateAttrs; ?> class="registration-input js_phone_class" type="tel" value="<? echo $arResult["arUser"]["PERSONAL_MOBILE"] ?>" name="PERSONAL_MOBILE" placeholder="Телефон*" required>
					</label>
				</div>
			</div>
			<div class="registration-form__group-item">
				<div class="registration-form__group-wrapper">
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
						<input value="<? echo $arResult["arUser"]["EMAIL"] ?>" <?= $strValidateAttrs; ?> class="registration-input" type="email" name="EMAIL" placeholder="Почта*" required>
					</label>
					<?/*?><div class="c-form__error">Сообщение ошибки</div><?*/ ?>
				</div>
			</div>
			<button class="link-button_rose profile-form__change" type="submit">Изменить</button>
		</form>

		<br />

		<form class="profile-form js_validate_ajax" data-type-form="PROFILE_CH_PAS" data-scroll-to="js_profile_ch_pas_container" data-container-id="js_profile_ch_pas_container" method="post" action="/local/ajax/change_password.php">
			<div id="js_profile_ch_pas_container">
			</div>
			<h2>Пароль</h2>
			<div class="profile-form__passwords display-none">
				<div class="registration-form__group-item">
					<div class="registration-form__group-wrapper">
						<label class="registration-label js_validate_field_container">
							<?
							$strValidateAttrs = '';
							$arValidateAttrs = [];
							$arValidateAttrs[] = 'data-rule-required="true"';
							$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
							$arValidateAttrs[] = 'data-rule-minlength="6"';
							$arValidateAttrs[] = 'data-msg-minlength="Пароль должен быть не менее 6 символов"';
							$arValidateAttrs[] = 'data-rule-newpassword="true"';
							$arValidateAttrs[] = 'required';
							if (count($arValidateAttrs) > 0) {
								$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
							}
							?>
							<input <?= $strValidateAttrs; ?> class="registration-input" type="password" name="OLD_PASSWORD" placeholder="Старый пароль*" required>
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
				</div>
				<div class="registration-form__group-item">
					<div class="registration-form__group-wrapper">
						<label class="registration-label js_validate_field_container">
							<?
							$strValidateAttrs = '';
							$arValidateAttrs = [];
							$arValidateAttrs[] = 'data-rule-required="true"';
							$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
							$arValidateAttrs[] = 'data-rule-minlength="6"';
							$arValidateAttrs[] = 'data-msg-minlength="Пароль должен быть не менее 6 символов"';
							$arValidateAttrs[] = 'data-rule-newpassword="true"';
							$arValidateAttrs[] = 'required';
							if (count($arValidateAttrs) > 0) {
								$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
							}
							?>
							<input <?= $strValidateAttrs; ?> id="newpassword" class="registration-input" type="password" name="NEW_PASSWORD" placeholder="Новый пароль*" required>
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
				</div>
				<div class="registration-form__group-item">
					<div class="registration-form__group-wrapper">
						<label class="registration-label js_validate_field_container">
							<?
							$strValidateAttrs = '';
							$arValidateAttrs = [];
							$arValidateAttrs[] = 'data-rule-required="true"';
							$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
							$arValidateAttrs[] = 'data-rule-minlength="6"';
							$arValidateAttrs[] = 'data-msg-minlength="Пароль должен быть не менее 6 символов"';
							$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
							$arValidateAttrs[] = 'data-rule-newpassword="true"';
							$arValidateAttrs[] = 'data-rule-equalTo="#newpassword"';
							$arValidateAttrs[] = 'data-msg-equalTo="Пожалуйста, введите то же значение еще раз"';
							$arValidateAttrs[] = 'required';
							if (count($arValidateAttrs) > 0) {
								$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
							}
							?>
							<input <?= $strValidateAttrs; ?> class="registration-input" type="password" name="NEW_PASSWORD_CONFIRM" placeholder="Подтверждение пароля*" required>
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
				</div>
			</div>
			<button class="link-button_rose profile-form__password js_change_password_button" type="button">Изменить пароль</button>
			<button class="link-button_rose profile-form__password-save display-none" type="submit">Сохранить изменения</button>
		</form>

		<br />

		<form class="profile-form">
			<h2>Удаление аккаунта</h2>
			<a class="profile-form__delete js_delete_account" href="#">Удалить аккаунт</a>
		</form>
	</div>

</div>

<div class="display-none js_change_password_block">

</div>