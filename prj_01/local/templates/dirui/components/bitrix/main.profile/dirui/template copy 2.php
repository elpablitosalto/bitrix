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

<div class="container">
	<div class="dp-account-profile">
		<div class="dp-account-profile-block">
			<p class="dp-account-profile-block__tile">Данные профиля</p>
			<? ShowError($arResult["strProfileError"]); ?>
			<?
			if ($arResult['DATA_SAVED'] == 'Y')
				ShowNote(GetMessage('PROFILE_DATA_SAVED'));
			?>
			<form class="dp-form dp-form-account dp-form-profile js_validate_reload" name="form1" id="form-profile" method="post" action="<?= $arResult["FORM_TARGET"] ?>">
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
						$arValidateAttrs[] = 'required';
						if (count($arValidateAttrs) > 0) {
							$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
						}
						?>
						<input <?= $strValidateAttrs; ?> type="text" name="LAST_NAME" placeholder="Фамилия" value="<?= $arResult['arUser']['LAST_NAME'] ?>" disabled>
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
						<input <?= $strValidateAttrs; ?> type="email" name="LOGIN" placeholder="E-mail" value="<?= $arResult['arUser']['LOGIN'] ?>" disabled>
					</div>
				</div>
				<div class="dp-form__footer">
					<button class="dp-btn dp-form__submit dp-form-profile__btn-edit" type="button">Изменить</button>
					<button class="dp-btn dp-form__submit dp-form-profile__btn-save" type="submit">Сохранить</button>
				</div>
			</form>
		</div>
		<div class="dp-account-profile-block">
			<p class="dp-account-profile-block__tile">Пароль</p>
			<form class="dp-form dp-form-account dp-form-change-password js_validate_reload" id="form-change-password" method="post" action="<?= $arResult["FORM_TARGET"] ?>">
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
						$arValidateAttrs[] = 'data-rule-minlength="6"';
						$arValidateAttrs[] = 'data-msg-minlength="Пароль должен быть не менее 6 символов"';
						$arValidateAttrs[] = 'data-rule-newpassword="true"';
						$arValidateAttrs[] = 'required';
						if (count($arValidateAttrs) > 0) {
							$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
						}
						?>
						<input <?= $strValidateAttrs; ?> type="password" id="newpassword" name="NEW_PASSWORD" placeholder="Новый пароль" value="" disabled data-new-password>
					</div>
					<div class="dp-form-field dp-form-field_text">
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
						<input <?= $strValidateAttrs; ?> type="password" id="newpasswordconfirm" name="NEW_PASSWORD_CONFIRM" placeholder="Повторить пароль" disabled data-repeat-password>
					</div>
				</div>
				<div class="dp-form__footer">
					<button class="dp-btn dp-form__submit dp-form-change-password__btn-save" type="submit">Сохранить пароль</button>
					<button class="dp-btn dp-form__submit dp-form-change-password__btn-cancel" type="button">Отменить</button>
					<button class="dp-btn dp-form__submit dp-form-change-password__btn-toggle" type="button">Изменить пароль</button>
				</div>
			</form>
		</div>
		<div class="dp-account-profile-block">
			<a class="dp-account-remove-link" href="#" data-modal="#modal-account-delete">Удалить аккаунт</a>
		</div>
		<div class="dp-modals">
			<div class="dp-modal dp-modal-account-delete" id="modal-account-delete">
				<div class="dp-modal__overlay"></div>
				<div class="dp-modal__dialog">
					<button class="dp-modal__close" type="button">
						<svg class="icon icon-cross ">
							<use xlink:href="#cross"></use>
						</svg>
					</button>
					<div class="dp-modal__header">
						<h3 class="dp-modal__title">Вы уверены что хотите удалить аккаунт?</h3>
					</div>
					<div class="dp-modal__body">
						<form class="dp-form dp-form-account-delete" id="form-account-delete" method="post" action="#">
							<div class="dp-form__body">
								<p class="color_red font-weight_bold">Вы потеряете все данные о своих заказах!</p>
								<p>Удаление аккаунта невозможно, пока у вас есть активные оплаченные заказы.</p>
							</div>
							<div class="dp-form__footer">
								<div class="dp-form__actions">
									<button class="dp-btn dp-btn_red dp-form__submit" type="button" data-modal="#modal-account-delete-confirm">Удалить аккаунт</button>
									<button class="dp-btn dp-btn_white js_dp_modal_close" type="button">Отмена</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="dp-modal dp-modal-account-delete-confirm" id="modal-account-delete-confirm">
				<div class="dp-modal__overlay"></div>
				<div class="dp-modal__dialog">
					<button class="dp-modal__close" type="button">
						<svg class="icon icon-cross ">
							<use xlink:href="#cross"></use>
						</svg>
					</button>
					<div class="dp-modal__body">
						<form class="dp-form dp-form-account-delete-confirm js_validate_reload" id="form-account-delete-confirm" method="post" action="<?= $arResult["FORM_TARGET"] ?>">
							<?= $arResult["BX_SESSION_CHECK"] ?>
							<input type="hidden" name="lang" value="<?= LANG ?>" />
							<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />
							<input type="hidden" name="delete" value="Y" />
							<div class="dp-form__body">
								<p>Подтвердите удаление аккаунта - введите слово <span class="font-weight_bold">“удалить”.</span>
								</p>
								<div class="dp-form-field dp-form-field_text">
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
									<input <?= $strValidateAttrs; ?> type="text" name="word_for_del" placeholder="" />
								</div>
								<p class="font-weight_bold">Вы потеряете все данные о своих заказах!</p>
							</div>
							<div class="dp-form__footer">
								<div class="dp-form__actions">
									<button class="dp-btn dp-btn_red dp-form__submit" type="submit">Удалить аккаунт</button>
									<button class="dp-btn dp-btn_white js_dp_modal_close" type="button">Отмена</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>