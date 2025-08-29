<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
$arResult['bError'] = false;
if (!empty($APPLICATION->arAuthResult['MESSAGE'])) {
	if ($APPLICATION->arAuthResult['TYPE'] == 'ERROR') {
		$arResult['bError'] = true;
	}
}
?>
<div class="dp-modal dp-modal-forgot-password" id="modal-forgot-password">
	<div class="dp-modal__overlay"></div>
	<div class="dp-modal__dialog">
		<button class="dp-modal__close" type="button">
			<svg class="icon icon-close ">
				<use xlink:href="#close"></use>
			</svg>
		</button>
		<div class="dp-modal__header">
			<h3 class="dp-modal__title">Восстановление пароля</h3>
		</div>
		<div class="dp-modal__body">
			<div id="js_forgot_modal_container">
				<?
				//vardump($APPLICATION->arAuthResult);
				if (!empty($APPLICATION->arAuthResult['MESSAGE'])) {
					ShowMessage($APPLICATION->arAuthResult['MESSAGE']);
				}
				//echo 'bErrorr = ' . $arResult['bError'] . '<br />';
				?>
				<? if ($arResult['bError'] == false && $_POST['send_account_info'] == 'Y') { ?>
					<? if ($_SERVER["REQUEST_METHOD"] == "POST" && strlen($_POST['send_account_info']) > 0) { ?>
						<?/*?>
						<script>
							setTimeout("location.reload();", 3000);
						</script>
						<?/**/ ?>
					<? } ?>
				<? } else { ?>
					<?
					//$forgotPasswordUrl = $arResult["AUTH_URL"];
					$forgotPasswordUrl = '/local/ajax/forgot_password.php?forgot_password=yes';
					?>
					<form data-container-id="js_forgot_modal_container" class="modal-form js_validate_ajax" name="bform" method="post" target="_top" action="<?= $forgotPasswordUrl; ?>">
						<?
						if (strlen($arResult["BACKURL"]) > 0) {
						?>
							<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
						<?
						}
						?>
						<input type="hidden" name="AUTH_FORM" value="Y" />
						<input type="hidden" name="TYPE" value="SEND_PWD" />
						<input type="hidden" name="send_account_info" value="Y" />

						<div class="modal-form__input js_validate_field_container">
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
							<input <?= $strValidateAttrs; ?> class="order__input" id="modal-authorization-email_forgot" type="email" name="USER_LOGIN" placeholder="E-mail*">
						</div>
						<button class="dp-btn dp-form__submit" type="submit">Выслать новый пароль</button>
					</form>
				<? } ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	document.getElementById("modal-authorization-email_forgot").focus();
</script>