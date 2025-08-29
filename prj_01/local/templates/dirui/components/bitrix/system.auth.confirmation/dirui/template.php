<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div id="js_reg_modal_container">
	<?
	//vardump($arResult);
	?>
	<? echo $arResult["MESSAGE_TEXT"] ?>
	<? //here you can place your own messages
	switch ($arResult["MESSAGE_CODE"]) {
		case "E01":
	?><? //When user not found
			break;
		case "E02":
		?><? //User was successfully authorized after confirmation
			break;
		case "E03":
			?><? //User already confirm his registration
			if (intval($arResult['USER_ID']) > 0) {
				$USER->Authorize($arResult['USER_ID']);
			}
			break;
		case "E04":
			?><? //Missed confirmation code
						break;
					case "E05":
						?><? //Confirmation code provided does not match stored one
						break;
					case "E06":
						if (intval($arResult['USER_ID']) > 0) {
							$USER->Authorize($arResult['USER_ID']);
						}
						?><? //Confirmation was successfull
						break;
					case "E07":
						?><? //Some error occured during confirmation
						break;
				}
						?>
	<? if ($arResult["SHOW_FORM"]) : ?>

		<form class="registration-form" method="post" action="<? echo $arResult["FORM_ACTION"] ?>">
			<div class="registration-form__wrapper">
				<h2>Подтверждение регистрации</h2>
			</div>
			<label class="registration-label">
				<input class="registration-input" type="text" name="<? echo $arParams["LOGIN"] ?>" maxlength="50" value="<? echo $arResult["LOGIN"] ?>" placeholder="<? echo GetMessage("CT_BSAC_LOGIN") ?>" size="17" />
			</label>
			<label class="registration-label">
				<input class="registration-input" type="text" name="<? echo $arParams["CONFIRM_CODE"] ?>" maxlength="50" value="<? echo $arResult["CONFIRM_CODE"] ?>" size="17" placeholder="<? echo GetMessage("CT_BSAC_CONFIRM_CODE") ?>" />
			</label>
			<button class="link-button_rose" type="submit"><? echo GetMessage("CT_BSAC_CONFIRM") ?></button>
			<input type="hidden" name="<? echo $arParams["USER_ID"] ?>" value="<? echo $arResult["USER_ID"] ?>" />
		</form>
	<? elseif (!$USER->IsAuthorized()) : ?>

	<? endif ?>
</div>