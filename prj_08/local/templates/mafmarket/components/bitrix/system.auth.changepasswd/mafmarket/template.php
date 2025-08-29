<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
$formActionUrl = $arResult["AUTH_URL"];

$arResult['bError'] = false;
if (!empty($APPLICATION->arAuthResult['MESSAGE'])) {
	if ($APPLICATION->arAuthResult['TYPE'] == 'ERROR') {
		$arResult['bError'] = true;
	}
}
?>

<?
if (!($USER->IsAuthorized()) && $_GET['change_password'] == 'yes' && strlen($_GET['USER_CHECKWORD']) > 0 && strlen($_GET['USER_LOGIN']) > 0) {
?>
	<a class="modal-authorization__forgot js_link_show_change_password_modal" href="#modal-change-password" style="display: block;">Сменить пароль</a>
<?
}
?>

<? if ($arResult["SHOW_FORM"]) { ?>
	<div class="dp-modal dp-modal-forgot-password" id="modal-change-password">
		<div class="dp-modal__overlay"></div>
		<div class="dp-modal__dialog">
			<button class="dp-modal__close" type="button">
				<svg class="icon icon-close ">
					<use xlink:href="#close"></use>
				</svg>
			</button>
			<div class="dp-modal__header">
				<h3 class="dp-modal__title">Смена пароля</h3>
			</div>
			<div class="dp-modal__body">
				<div id="js_change_modal_container">
					<?
					if (!empty($APPLICATION->arAuthResult['MESSAGE'])) {
						ShowMessage($APPLICATION->arAuthResult['MESSAGE']);
					}
					?>
					<? if ($arResult['bError'] == false && $_POST['change_pwd'] == 'Y') { ?>
						<? if ($_SERVER["REQUEST_METHOD"] == "POST" && strlen($_POST['change_pwd']) > 0) { ?>
							<?/*?>
						<script>
							setTimeout("location.reload();", 3000);
						</script>
						<?/**/ ?>
						<? } ?>
					<? } else { ?>
						<form data-container-id="js_change_modal_container" class="modal-form js_validate_ajax" name="bform" method="post" target="_top" action="<?= $formActionUrl; ?>">
							<?
							if (strlen($arResult["BACKURL"]) > 0) {
							?>
								<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
							<?
							}
							?>
							<input type="hidden" name="AUTH_FORM" value="Y">
							<input type="hidden" name="TYPE" value="CHANGE_PWD">
							<input type="hidden" name="change_pwd" value="Y" />

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
								<input <?= $strValidateAttrs; ?> class="order__input" id="modal-authorization-email_change" type="email" name="USER_LOGIN" placeholder="E-mail*" value="<?= $arResult["LAST_LOGIN"] ?>">
							</div>
							<div class="modal-form__input js_validate_field_container">
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
								<input <?= $strValidateAttrs; ?> type="text" name="USER_CHECKWORD" maxlength="50" value="<?= $arResult["USER_CHECKWORD"] ?>" class="order__input" autocomplete="off" placeholder="<?= GetMessage("AUTH_CHECKWORD") ?>*" />
							</div>
							<div class="modal-form__input js_validate_field_container">
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
								<input <?= $strValidateAttrs; ?> type="password" name="USER_PASSWORD" maxlength="50" value="<?= $arResult["USER_PASSWORD"] ?>" class="order__input" autocomplete="off" placeholder="<?= GetMessage("AUTH_NEW_PASSWORD_REQ") ?>*" />
							</div>
							<div class="modal-form__input js_validate_field_container">
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
								<input <?= $strValidateAttrs; ?> type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?= $arResult["USER_CONFIRM_PASSWORD"] ?>" class="order__input" autocomplete="off" placeholder="<?= GetMessage("AUTH_NEW_PASSWORD_CONFIRM") ?>*" />
							</div>
							<button class="dp-btn dp-form__submit" type="submit">Сменить пароль</button>
						</form>
					<? } ?>
				</div>
			</div>
		</div>
	</div>
<? } ?>