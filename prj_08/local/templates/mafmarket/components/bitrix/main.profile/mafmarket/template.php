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

<div class="dp-account-profile">
	<div class="dp-account-profile-block">
		<p class="dp-account-profile-block__tile">Данные профиля</p>
		<? ShowError($arResult["strProfileError"]); ?>
		<?
		if ($_GET['phone_present'] == 'Y') {
			ShowError('Номер телефона ' . '"' . urldecode($_GET['phone']) . '"' . ' уже существует в системе.');
		}
		?>
		<?
		if ($arResult['DATA_SAVED'] == 'Y')
			ShowNote(GetMessage('PROFILE_DATA_SAVED'));
		?>
		<form class="dp-form dp-form-account dp-form-profile js_validate_reload" id="form-profile" method="post" action="<?= $arResult["FORM_TARGET"] ?>">
			<?= $arResult["BX_SESSION_CHECK"] ?>
			<input type="hidden" name="lang" value="<?= LANG ?>" />
			<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />
			<input type="hidden" name="save" value="Y" />
			<div class="dp-form__body">
				<div class="dp-form-field dp-form-field_text">
					<?
					$strValidateAttrs = '';
					$arValidateAttrs = [];
					$arValidateAttrs[] = 'data-rule-required="true"';
					$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
					$arValidateAttrs[] = 'data-rule-letters="true"';
					$arValidateAttrs[] = 'data-msg-letters="Строка должна содержать только буквы."';
					$arValidateAttrs[] = 'required';
					if (count($arValidateAttrs) > 0) {
						$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
					}
					?>
					<input <?= $strValidateAttrs; ?> type="text" name="NAME" placeholder="Имя" value="<?= $arResult['arUser']['NAME'] ?>" disabled>
				</div>
				<div class="dp-form-field dp-form-field_text">
					<?
					$strValidateAttrs = '';
					$arValidateAttrs = [];
					$arValidateAttrs[] = 'data-rule-required="true"';
					$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
					$arValidateAttrs[] = 'data-rule-letters="true"';
					$arValidateAttrs[] = 'data-msg-letters="Строка должна содержать только буквы."';
					$arValidateAttrs[] = 'required';
					if (count($arValidateAttrs) > 0) {
						$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
					}
					?>
					<input <?= $strValidateAttrs; ?> type="text" name="LAST_NAME" placeholder="Фамилия" value="<?= $arResult['arUser']['LAST_NAME'] ?>" disabled />
				</div>
				<div class="dp-form-field dp-form-field_text">
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
					<input <?= $strValidateAttrs; ?> type="email" name="LOGIN" placeholder="E-mail" value="<?= $arResult['arUser']['LOGIN'] ?>" disabled />
				</div>
				<div class="dp-form-field dp-form-field_text">
					<?
					$strValidateAttrs = '';
					$arValidateAttrs = [];
					$arValidateAttrs[] = 'data-rule-required="true"';
					$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
					$arValidateAttrs[] = 'data-rule-phone="true"';
					$arValidateAttrs[] = 'data-msg-phone="Длина телефона должна состоять из 11 цифр."';
					$arValidateAttrs[] = 'required';
					if (count($arValidateAttrs) > 0) {
						$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
					}
					?>
					<input <?= $strValidateAttrs; ?> class="js_phone_class" type="tel" name="PERSONAL_MOBILE" placeholder="Телефон" value="<?= $arResult['arUser']['PERSONAL_MOBILE'] ?>" disabled>
				</div>
			</div>
			<div class="dp-form__footer">
				<?/*?>
				<button class="dp-btn dp-form__submit" type="submit">Изменить</button>
				<?*/ ?>

				<button class="dp-btn dp-form__submit dp-form-profile__btn-edit" type="button">Изменить</button>
				<button class="dp-btn dp-form__submit dp-form-profile__btn-save" type="submit">Сохранить</button>
			</div>
		</form>
	</div>
	<div class="dp-account-profile-block">
		<p class="dp-account-profile-block__tile">Пароль</p>
		<button class="dp-btn dp-form-change-password-toggle-btn" type="button">Изменить пароль</button>
		<form class="dp-form dp-form-account dp-form-change-password js_validate_ajax" id="form-change-password" method="post" data-type-form="PROFILE_CH_PAS" data-scroll-to="js_profile_ch_pas_container" data-container-id="js_profile_ch_pas_container" method="post" action="/local/ajax/change_password.php">
			<div id="js_profile_ch_pas_container">
			</div>
			<?= $arResult["BX_SESSION_CHECK"] ?>
			<input type="hidden" name="lang" value="<?= LANG ?>" />
			<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />
			<input type="hidden" name="save" value="Y" />
			<div class="dp-form__body">
				<div class="dp-form-field dp-form-field_text js_validate_field_container">
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
					<input <?= $strValidateAttrs; ?> type="password" name="OLD_PASSWORD" placeholder="Текущий пароль" />
				</div>
				<div class="dp-form-field dp-form-field_text js_validate_field_container">
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
					<input <?= $strValidateAttrs; ?> id="newpassword" type="text" name="NEW_PASSWORD" placeholder="Новый пароль" />
				</div>
				<div class="dp-form-field dp-form-field_text js_validate_field_container">
					<?
					$strValidateAttrs = '';
					$arValidateAttrs = [];
					$arValidateAttrs[] = 'data-rule-required="true"';
					$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
					$arValidateAttrs[] = 'data-rule-minlength="6"';
					$arValidateAttrs[] = 'data-msg-minlength="Пароль должен быть не менее 6 символов"';
					$arValidateAttrs[] = 'data-rule-newpassword="true"';
					$arValidateAttrs[] = 'data-rule-equalTo="#newpassword"';
					$arValidateAttrs[] = 'data-msg-equalTo="Пожалуйста, введите то же значение еще раз"';
					$arValidateAttrs[] = 'required';
					if (count($arValidateAttrs) > 0) {
						$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
					}
					?>
					<input <?= $strValidateAttrs; ?> type="text" name="NEW_PASSWORD_CONFIRM" placeholder="Повторить пароль" />
				</div>
			</div>
			<div class="dp-form__footer">
				<div class="dp-form__actions">
					<button class="dp-btn dp-form__submit" type="submit">Сохранить пароль</button>
					<button class="dp-btn dp-btn_white dp-form__cancel" type="button">Отмена</button>
				</div>
			</div>
		</form>
	</div>
	<div class="dp-account-profile-block">
		<p class="dp-account-profile-block__tile">Удаление аккаунта</p><a class="dp-btn-link dp-btn-link_remove dp-account-remove-link" href="#modal-account-delete" data-modal><span>Удалить аккаунт</span>
			<svg class="icon icon-close ">
				<use xlink:href="#close"></use>
			</svg></a>
	</div>
</div>
<div class="dp-modal dp-modal-account dp-modal-account-delete" id="modal-account-delete">
	<div class="dp-modal__overlay"></div>
	<div class="dp-modal__dialog">
		<button class="dp-modal__close" type="button">
			<svg class="icon icon-cross ">
				<use xlink:href="#cross"></use>
			</svg>
		</button>
		<div class="dp-modal__body">
			<form class="dp-form dp-form-account-modal dp-form-account-delete" id="form-account-delete" method="post" action="<?= $arResult["FORM_TARGET"] ?>">
				<?= $arResult["BX_SESSION_CHECK"] ?>
				<input type="hidden" name="lang" value="<?= LANG ?>" />
				<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />
				<input type="hidden" name="delete" value="Y" />
				<div class="dp-form__body">
					<h3 class="dp-form__title">Вы уверены, что хотите удалить аккаунт?</h3>
				</div>
				<div class="dp-form__footer">
					<div class="dp-form__actions">
						<button class="dp-btn dp-form__submit" type="submit">Да, удалить аккаунт</button>
						<button class="dp-btn dp-btn_white dp-form__cancel dp-modal__close-btn" type="button">Отмена</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>