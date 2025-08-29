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
<div id="js_reg_modal_container">
	<? if (($USER->IsAuthorized()) || intval($arResult['VALUES']['USER_ID']) > 0) { ?>
		<?
		$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_TEMPLATE_PATH . "/include/blocks/static/success_reg.php"
			)
		);
		?>
		<input type="hidden" name="REG_SUCCESS" value="Y" />
	<? } else { ?>
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
		<form class="registration-form js_validate_ajax" data-container-id="js_reg_modal_container" method="post" action="<?= POST_FORM_ACTION_URI ?>">
			<input type="hidden" name="REG_FORM" value="Y" />
			<input type="hidden" name="register_submit_button" value="Y" />
			<input type="hidden" name="REGISTER[LOGIN]" value="YYYY" />

			<div class="registration-form__wrapper">
				<h2>Регистрация</h2><a href="/auth/">У меня уже есть аккаунт</a>
			</div>
			<?
			//vardump($arResult["SHOW_FIELDS"]);
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
					case "WORK_COMPANY":
						$type = 'text';
						$add_attr .= '';
						$placeholder = 'Название организации';
						$star = '';
						$required = '';
						break;
					case "WORK_POSITION":
						$type = 'text';
						$add_attr .= '';
						$placeholder = 'Должность';
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
						$arValidateAttrs[] = 'data-rule-phone="true"';
						$arValidateAttrs[] = 'data-msg-phone="Длина телефона должна быть 11 цифр"';
						$star = '*';
						$required = 'required';
						$add_class = 'js_phone_class';
						break;
					case "PASSWORD":
						$type = 'password';
						$add_attr .= ' autocomplete="off" id="newpassword"';
						$placeholder = 'Пароль';
						$star = '*';
						$required = 'required';
						$arValidateAttrs[] = 'data-rule-minlength="8"';
						$arValidateAttrs[] = 'data-msg-minlength="Пароль должен быть не менее 8 символов"';
						$arValidateAttrs[] = 'data-rule-newpassword="true"';
						$arValidateAttrs[] = 'data-rule-stength="true"';
						$arValidateAttrs[] = 'data-msg-stength="Пароль должен содержать цифры и латинские символы нижнего (a-z) и верхнего регистров (A-Z)"';
						//$arValidateAttrs[] = 'data-rule-stength="true"';
						//$arValidateAttrs[] = 'data-msg-stength="Пароль должен содержать цифры и буквы"';
						$arValidateAttrs[] = 'required';
						break;
					case "CONFIRM_PASSWORD":
						$type = 'password';
						$add_attr .= ' autocomplete="off" id="newpasswordconfirm"';
						$placeholder = 'Повторите пароль';
						$star = '*';
						$required = 'required';
						//$arValidateAttrs[] = 'data-rule-minlength="8"';
						//$arValidateAttrs[] = 'data-msg-minlength="Пароль должен быть не менее 8 символов"';
						$arValidateAttrs[] = 'data-rule-newpassword="true"';
						$arValidateAttrs[] = 'data-rule-equalTo="#newpassword"';
						$arValidateAttrs[] = 'data-msg-equalTo="Пожалуйста, введите то же значение еще раз"';
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
				<div class="registration-form__group-item">
					<label class="registration-label <?/*?>c-form__verified<?*/ ?> js_validate_field_container">
						<input <?= $strValidateAttrs; ?> class="registration-input <?= $add_class; ?>" type="<?= $type; ?>" name="REGISTER[<?= $FIELD ?>]" value="<?= $arResult["VALUES"][$FIELD] ?>" placeholder="<?= $placeholder; ?> <?= $star; ?>" <?= $add_attr; ?> />
					</label>
				</div>
			<? } ?>

			<div class="registration-form__policy">Нажимая на кнопку «Зарегистрироваться», вы соглашаетесь с <a href="<?= $GLOBALS["arSiteConfig"]["LINKS"]['PERSONAL_DATA_AGREEMENT'] ?>">политикой обработки персональных данных</a>
			</div>
			<button class="link-button_rose js_link_button_registration" type="submit">Зарегистрироваться</button>
		</form>
	<? } ?>
</div>