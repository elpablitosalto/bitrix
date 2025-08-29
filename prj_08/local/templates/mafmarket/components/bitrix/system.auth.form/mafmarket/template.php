<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init();
?>
<?
$id = '';
if (!($USER->IsAuthorized())) {
	$id = 'modal-login';
}
?>
<div class="dp-modal dp-modal-login" id="<?= $id; ?>">
	<div class="dp-modal__overlay"></div>
	<div class="dp-modal__dialog">
		<h3>Войти через</h3>
		<ul class="dp-modal-login__list">
			<?
			//vardump($arResult);
			?>
			<? if ($arResult["AUTH_SERVICES"]) : ?>
				<?
				/*
				$APPLICATION->IncludeComponent(
					"bitrix:socserv.auth.form",
					"mafmarket_icons",
					//"mafmarket_default",
					array(
						"AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
						"AUTH_URL" => $arResult["AUTH_URL"],
						"POST" => $arResult["POST"],
						"POPUP" => "N",
						"SUFFIX" => "form",
					),
					$component,
					array("HIDE_ICONS" => "Y")
				);
				*/
				?>
				<?
				$APPLICATION->IncludeComponent(
					"bitrix:socserv.auth.form",
					"mafmarket_flat",
					//"mafmarket_default",
					array(
						"AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
						"AUTH_URL" => $arResult["AUTH_URL"],
						"POST" => $arResult["POST"],
						"POPUP" => "N",
						"SUFFIX" => "form",
					),
					$component,
					array("HIDE_ICONS" => "Y")
				);
				?>
			<? endif ?>
			
			<li class="dp-modal-login__item">
				<a class="dp-modal-login__link dp-modal-login__mail" href="#modal-authorization" data-modal>
					<div class="dp-modal-login__image">
						<svg class="icon icon-mail ">
							<use xlink:href="#mail"></use>
						</svg>
					</div>
					<p>Почта</p>
				</a>
			</li>
		</ul>
		<a class="dp-modal-login__forgot-password" href="#modal-forgot-password">Забыли пароль?</a>
		<button class="dp-modal__close" type="button">
			<svg class="icon icon-cross ">
				<use xlink:href="#cross"></use>
			</svg>
		</button>
	</div>
</div>
<div class="dp-modal dp-modal-authorization" id="modal-authorization">
	<div class="dp-modal__overlay"></div>
	<div class="dp-modal__dialog">
		<div id="js_auth_modal_container">
			<? if (!($USER->IsAuthorized())) { ?>
				<a class="modal-authorization__enter" href="#modal-login" data-modal id="modal-authorization__enter">Способы входа</a>
			<? } ?>
			<div class="modal-authorization__wrapper">
				<h3>Авторизация</h3>
				<? if (!($USER->IsAuthorized())) { ?>
					<a class="modal-authorization__reg" href="#modal-reg" data-modal id="modal-authorization__registration">Регистрация</a>
				<? } ?>
			</div>
			<?
			//vardump($arResult);
			if (/*$arResult['SHOW_ERRORS'] === 'Y' && */$arResult['ERROR'] && !empty($arResult['ERROR_MESSAGE'])) {
				ShowMessage($arResult['ERROR_MESSAGE']);
			}
			?>
			<?
			//echo 'IsAuthorized = ' . $USER->IsAuthorized() . '<br />';
			//ShowMessage($APPLICATION->arAuthResult['MESSAGE']);
			//vardump($APPLICATION->arAuthResult);
			?>
			<? if (!($USER->IsAuthorized())) { ?>
				<form name="system_auth_form<?= $arResult["RND"] ?>" data-container-id="js_auth_modal_container" class="modal-form js_validate_ajax" method="post" action="<?= $arResult["AUTH_URL"] ?>">
					<input type="hidden" name="AUTH_FORM" value="Y" />
					<input type="hidden" name="TYPE" value="AUTH" />
					<input type="hidden" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" />
					<input type="hidden" name="Login" value="Y" />
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
						<input <?= $strValidateAttrs; ?> class="order__input" id="modal-authorization-email_auth" type="email" name="USER_LOGIN" placeholder="E-mail*">
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
						<input <?= $strValidateAttrs; ?> class="order__input" id="modal-authorization-password" type="password" name="USER_PASSWORD" placeholder="Пароль">
					</div>
					<button class="dp-btn dp-form__submit" type="submit">Войти</button>
				</form>
				<a class="modal-authorization__forgot" href="#modal-forgot-password">Забыли пароль?</a>
			<? } else { ?>
				Вы авторизованы на сайте!
				<? if ($_SERVER["REQUEST_METHOD"] == "POST" && strlen($_POST['AUTH_FORM']) > 0) { ?>
					<script>
						setTimeout("location.reload();", 3000);
					</script>
				<? } ?>
			<? } ?>
		</div>
		<button class="dp-modal__close" type="button">
			<svg class="icon icon-cross ">
				<use xlink:href="#cross"></use>
			</svg>
		</button>
	</div>
</div>