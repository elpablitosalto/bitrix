<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

?>

<div class="bx_profile">
	<?
	ShowError($arResult["strProfileError"]);

	if ($arResult['DATA_SAVED'] == 'Y')
	{
		ShowNote(Loc::getMessage('PROFILE_DATA_SAVED'));
	}

	?>
	<form method="post" name="form1" action="<?=POST_FORM_ACTION_URI?>" enctype="multipart/form-data" role="form" class="profile__form">
		<?=$arResult["BX_SESSION_CHECK"]?>
		<input type="hidden" name="lang" value="<?=LANG?>" />
		<input type="hidden" name="ID" value="<?=$arResult["ID"]?>" />
		<input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>" />
		<div class="main-profile-block-shown" id="user_div_reg">
			<?
			if (!in_array(LANGUAGE_ID,array('ru', 'ua')))
			{
				?>
				<div class="form-group">
					<label class="main-profile-form-label col-sm-12 col-md-3 text-md-right" for="main-profile-title"><?=Loc::getMessage('main_profile_title')?></label>
					<div class="col-sm-12">
						<input class="form-control" type="text" name="TITLE" maxlength="50" id="main-profile-title" value="<?=$arResult["arUser"]["TITLE"]?>" />
					</div>
				</div>
				<?
			}
			?>

			<div class="profile__inputs">
				<div class="profile__line">
						<!-- begin .form-control-->
						<div class="form-control">
								<label class="form-control__holder">
										<span class="form-control__label">ФИО</span>
										<span class="form-control__field">
												<input class="form-control__input" type="text" name="FULL_NAME" maxlength="50" id="main-profile-name" value="<?=$arResult["arUser"]["FULL_NAME"]?>">
										</span>
										<span class="form-control__messages">
												<span style="display: none" class="form-control__message form-control__message_style_error">
														Ошибка поля
												</span>
										</span>
								</label>
						</div>
						<!-- end .form-control-->
				</div>

				<div class="profile__line">
						<!-- begin .form-control-->
						<div class="form-control">
								<label class="form-control__holder">
										<span class="form-control__label">E-mail</span>
										<span class="form-control__field">
												<input class="form-control__input" type="email" name="EMAIL" maxlength="50" id="main-profile-email" value="<?=$arResult["arUser"]["EMAIL"]?>">
										</span>
										<span class="form-control__messages">
												<span style="display: none" class="form-control__message form-control__message_style_error">
														Ошибка поля
												</span>
										</span>
								</label>
						</div>
						<!-- end .form-control-->
				</div>

				<div class="profile__line">
						<!-- begin .form-control-->
						<div class="form-control">
								<label class="form-control__holder">
										<span class="form-control__label">Телефон</span>
										<span class="form-control__field">
												<input class="form-control__input js-phone-input" type="text" name="PERSONAL_PHONE" maxlength="50" id="main-profile-phone" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>">
										</span>
										<span class="form-control__messages">
												<span style="display: none" class="form-control__message form-control__message_style_error">
														Ошибка поля
												</span>
										</span>
								</label>
						</div>
						<!-- end .form-control-->
				</div>

				<?
					if ($arResult['CAN_EDIT_PASSWORD'])
					{
						?>
						<div class="profile__line">
								<!-- begin .form-control-->
								<div class="form-control">
										<label class="form-control__holder">
												<span class="form-control__label">Новый пароль</span>
												<span class="form-control__field">
														<input class=" form-control__input bx-auth-input main-profile-password" type="password" name="NEW_PASSWORD" maxlength="50" id="main-profile-password" value="" autocomplete="off">
														<button type="button" class="form-control__trigger form-control__trigger_type_password js-show-password">
																Показать / скрыть пароль
														</button>
												</span>
												<span class="form-control__messages" style="display: none">
														<span class="form-control__message" title="<?=$arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?>">
																<?=$arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?>
														</span>
												</span>
										</label>
								</div>
								<!-- end .form-control-->
						</div>
				<?
					}
				?>
			</div>

			<div class="profile__controls">
				<div class="profile__control">
						<input type="submit" name="save" class="button button_width_full button_size_s" value="<?=(($arResult["ID"]>0) ? Loc::getMessage("MAIN_SAVE") : Loc::getMessage("MAIN_ADD"))?>">
				</div>
			</div>

		</div>
	</form>
	<script>
		BX.Sale.PrivateProfileComponent.init();
	</script>
</div>