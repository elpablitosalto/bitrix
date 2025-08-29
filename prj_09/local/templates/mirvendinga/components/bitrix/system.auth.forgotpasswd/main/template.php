<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

ShowMessage($arParams["~AUTH_RESULT"]);

?>

<form class="form" id="formForgotPassword" name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
	<?=bitrix_sessid_post()?>
	<?if($arResult["BACKURL"] <> ''):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?endif;?>

	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="SEND_PWD">

	<!-- messages can be placed before or after the form-->
	<div class="form__messages">
		<!-- Modifiers-->
		<!-- form__message_style_error - red color-->
		<div class="form__message">Сообщение формы</div>
	</div>
	<div class="form__message"></div>

	<div class="form__main">
		<div class="form__inputs">
			<div class="form__line">
				<!-- begin .form-control-->
				<div class="form-control form-control_style_outline">
					<label class="form-control__holder">
						<span class="form-control__label">E-mail</span>
						<span class="form-control__field">
							<input type="email" class="form-control__input" required="required" placeholder="Введите свой e-mail" name="USER_LOGIN" value="<?=$arResult["USER_LOGIN"]?>">
							<input type="hidden" name="USER_EMAIL" />
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

			<?if($arResult["PHONE_REGISTRATION"]):?>
				<div class="form__line" style="display: none">>
					<!-- begin .form-control-->
					<div class="form-control form-control_style_outline">
						<label class="form-control__holder">
							<span class="form-control__label">Номер телефона</span>
							<span class="form-control__field">
								<input type="text" class="form-control__input" placeholder="Введите свой e-mail" name="USER_PHONE_NUMBER" value="<?=$arResult["USER_PHONE_NUMBER"]?>">
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
			<?endif;?>
		</div>
		<div class="form__controls">
				<div class="form__submit">
						<!-- begin .button-->
						<button
								class="button button_width_full button_size_s"
								type="submit"
								name="send_account_info"
						>
								<span class="button__holder">Продолжить</span>
						</button>
						<!-- end .button-->
				</div>
		</div>
	</div>
	<div class="form__final">
		<div class="form__illustration">
			<img src="<?=SITE_TEMPLATE_PATH?>/mockup/dist/assets/blocks/form/images/check.svg" alt="Успех!" class="form__image" title="">
		</div>
		<div class="form__message-wrapper">
			<div class="form__title">
				<!-- begin .title-->
				<h3 class="title title_size_h4">Пароль успешно изменен</h3>
				<!-- end .title-->
			</div>
			<div class="form__text">Используйте новый пароль при авторизации</div>
		</div>
	</div>
	 <?
		$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => SITE_TEMPLATE_PATH."/include/forms/capcha.php",
			"AREA_FILE_RECURSIVE" => "N",
			"EDIT_MODE" => "html",
		),
			false,
			array('HIDE_ICONS' => 'Y')
		);
	?>
</form>

<script>
(function() {
	window.addEventListener('load', function () {
		ajaxForgotPasswordModalForm('<?=$templateFolder?>/ajax.php', '<?=$arParams['SUCCESS_URL']?>');
	});

	document.bform.onkeyup = function(){document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;};
	document.bform.USER_LOGIN.focus();
})();
</script>
