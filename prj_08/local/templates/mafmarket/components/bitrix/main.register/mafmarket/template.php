<?

/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if ($arResult["SHOW_SMS_FIELD"] == true) {
	CJSCore::Init('phone_auth');
}
?>
<div class="dp-modal dp-modal-authorization" id="modal-reg">
	<div class="dp-modal__overlay"></div>
	<div class="dp-modal__dialog">
		<div id="js_reg_modal_container">
			<? if (!($USER->IsAuthorized())) { ?>
				<a class="modal-authorization__enter" href="#modal-login" data-modal id="modal-authorization__ent">Способы входа</a>
			<? } ?>
			<div class="modal-authorization__wrapper">
				<h3>Регистрация</h3>
				<? if (!($USER->IsAuthorized())) { ?>
					<a class="modal-authorization__reg" href="#modal-authorization" data-modal id="modal-authorization__reg">Авторизация</a>
				<? } ?>
			</div>
			<?
			//vardump($arResult);
			//vardump($arResult["ERRORS"]);
			//echo '!';
			if (!empty($arResult["ERRORS"])) {
				foreach ($arResult["ERRORS"] as $key => $error)
					if (intval($key) == 0 && $key !== 0)
						$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);

				ShowError(implode("<br />", $arResult["ERRORS"]));
			}
			?>
			<? if (!($USER->IsAuthorized())) { ?>
				<form class="modal-form js_validate_ajax" data-container-id="js_reg_modal_container" method="post" action="<?= POST_FORM_ACTION_URI ?>">
					<input type="hidden" name="REG_FORM" value="Y" />
					<input type="hidden" name="register_submit_button" value="Y" />
					<input type="hidden" name="REGISTER[LOGIN]" value="YYYY" />
					<?
					foreach ($arResult["SHOW_FIELDS"] as $FIELD) {
						if ($FIELD == 'LOGIN') {
							continue;
						}

						$type = 'text';
						$add_attr = '';
						$placeholder = '';
						$star = '';
						$required = '';
						$add_class = '';
						$strValidateAttrs = '';
						$arValidateAttrs = [];

						switch ($FIELD) {
							case "NAME":
								$type = 'text';
								$add_attr .= '';
								$placeholder = 'Имя';
								$star = '*';
								$required = 'required';
								break;
							case "LAST_NAME":
								$type = 'text';
								$add_attr .= '';
								$placeholder = 'Фамилия';
								$star = '';
								$required = '';
								break;
							case "EMAIL":
								$type = 'email';
								$add_attr .= '';
								$placeholder = 'E-mail';
								$star = '*';
								$required = 'required';
								$arValidateAttrs[] = 'data-rule-email="true"';
								$arValidateAttrs[] = 'data-msg-email="Укажите верный e-mail"';
								break;
							case "PERSONAL_MOBILE":
								$type = 'tel';
								$add_attr .= '';
								$placeholder = 'Телефон';
								$star = '';
								$required = '';
								$add_class = 'js_phone_class';
								break;
							case "PASSWORD":
								$type = 'password';
								$add_attr .= ' autocomplete="off"';
								$placeholder = 'Пароль';
								$star = '*';
								$required = 'required';
								break;
							case "CONFIRM_PASSWORD":
								$type = 'password';
								$add_attr .= ' autocomplete="off"';
								$placeholder = 'Повторите пароль';
								$star = '*';
								$required = 'required';
								break;
						}
						if ($required == 'required') {
							$arValidateAttrs[] = 'data-rule-required="true"';
							$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
							$arValidateAttrs[] = 'required';
							if (count($arValidateAttrs) > 0) {
								$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
							}
						}

					?>
						<div class="modal-form__input js_validate_field_container">
							<input <?= $strValidateAttrs; ?> class="order__input <?=$add_class;?>" type="<?= $type; ?>" name="REGISTER[<?= $FIELD ?>]" value="<?= $arResult["VALUES"][$FIELD] ?>" placeholder="<?= $placeholder; ?><?= $star; ?>" <?= $add_attr; ?> />
						</div>
					<? } ?>
					<div class="modal-form__policy js_validate_field_container">
						<input class="modal-form__policy-input" type="checkbox" name="registration-policy" checked id="modal-form-policy" data-rule-required="true" data-msg-required="<br />Необходимо дать согласие на обработку персональных данных" required />
						<label class="modal-form__policy-checkbox" for="modal-form-policy">Соглашаюсь на обработку моих <a class="modal-form__policy-link" href="<?= $GLOBALS["arSiteConfig"]["LINKS"]['PERSONAL_DATA_AGREEMENT'] ?>">персональных данных</a>
						</label>
					</div>
					<button class="dp-btn dp-form__submit" type="submit">Зарегистрироваться</button>
				</form>
			<? } else { ?>
				Вы успешно зарегистрировались на сайте!
				<? if ($_SERVER["REQUEST_METHOD"] == "POST" && strlen($_POST['REG_FORM']) > 0) { ?>
					<script>
						setTimeout("location.reload();", 3000);
					</script>
				<? } ?>
			<? } ?>
			<button class="dp-modal__close" type="button">
				<svg class="icon icon-cross ">
					<use xlink:href="#cross"></use>
				</svg>
			</button>
		</div>
	</div>
</div>