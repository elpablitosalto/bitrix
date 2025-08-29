<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (empty($arResult["SUBSCRIPTION"]["ID"])) { ?>
	<div class="dp-account-profile">
		<div class="dp-account-profile-block dp-account-subscribe-block">
			<?
			if ($_GET['mess_code'] != 'SENT') {
				foreach ($arResult["MESSAGE"] as $itemID => $itemValue)
					echo ShowMessage(array("MESSAGE" => $itemValue, "TYPE" => "OK"));
			} else if (!empty($_GET['ID']) && $_GET['mess_code'] == 'SENT') {
				echo ShowMessage(array("MESSAGE" => 'Вы успешно подписались на рассылку', "TYPE" => "OK"));
			}
			foreach ($arResult["ERROR"] as $itemID => $itemValue)
				echo ShowMessage(array("MESSAGE" => $itemValue, "TYPE" => "ERROR"));
			?>
			<p class="dp-account-subscribe-block__message font-weight_bold">Вы не подписаны на e-mail рассылку maf-market</p>
			<p class="dp-account-subscribe-block__message">Подпишитесь на e-mail рассылку и получайте новости о новинках ассортимента, новых каталогах, событиях и реализованных проектах.</p>
			<form class="dp-form dp-form-account dp-form-subscribe js_validate_reload" id="form-subscribe" method="post" action="<?= $arResult["FORM_ACTION"] ?>">
				<? echo bitrix_sessid_post(); ?>
				<input type="hidden" name="PostAction" value="<? echo ($arResult["ID"] > 0 ? "Update" : "Add") ?>" />
				<input type="hidden" name="ID" value="<? echo $arResult["SUBSCRIPTION"]["ID"]; ?>" />
				<input type="hidden" name="FORMAT" value="html" />
				<input type="hidden" name="RUB_ID[]" value="0" />
				<? foreach ($arResult["RUBRICS"] as $itemID => $itemValue) { ?>
					<input type="hidden" name="RUB_ID[]" value="<?= $itemValue["ID"] ?>" />
				<? } ?>
				<div class="dp-form__body">
					<div class="dp-form-field dp-form-field_text">
						<?
						$strValidateAttrs = '';
						$arValidateAttrs = [];
						$arValidateAttrs[] = 'data-rule-required="true"';
						$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
						$arValidateAttrs[] = 'data-rule-email="true"';
						$arValidateAttrs[] = 'data-msg-email="Укажите верный e-mail"';
						if (count($arValidateAttrs) > 0) {
							$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
						}
						?>
						<input <?= $strValidateAttrs; ?> type="email" name="EMAIL" placeholder="E-mail" value="<? echo $arResult["SUBSCRIPTION"]["EMAIL"] != "" ? $arResult["SUBSCRIPTION"]["EMAIL"] : $arResult["REQUEST"]["EMAIL"]; ?>" />
					</div>
				</div>
				<div class="dp-form__footer">
					<button class="dp-btn dp-form__submit" type="submit">Подписаться</button>
				</div>
			</form>
		</div>
	</div>
<? } else { ?>
	<div class="dp-account-profile">
		<div class="dp-account-profile-block">
			<?
			if ($_GET['mess_code'] != 'SENT') {
				foreach ($arResult["MESSAGE"] as $itemID => $itemValue)
					echo ShowMessage(array("MESSAGE" => $itemValue, "TYPE" => "OK"));
			} else if (!empty($_GET['ID']) && $_GET['mess_code'] == 'SENT') {
				echo ShowMessage(array("MESSAGE" => 'Вы успешно подписались на рассылку', "TYPE" => "OK"));
			}
			foreach ($arResult["ERROR"] as $itemID => $itemValue)
				echo ShowMessage(array("MESSAGE" => $itemValue, "TYPE" => "ERROR"));
			?>
			<form class="dp-form dp-form-account dp-form-account-subscribe js_validate_reload" id="form-subscribe" method="post" action="<?= $arResult["FORM_ACTION"] ?>">
				<? echo bitrix_sessid_post(); ?>
				<input type="hidden" name="PostAction" value="<? echo ($arResult["ID"] > 0 ? "Update" : "Add") ?>" />
				<input type="hidden" name="ID" value="<? echo $arResult["SUBSCRIPTION"]["ID"]; ?>" />
				<input type="hidden" name="FORMAT" value="html" />
				<input type="hidden" name="RUB_ID[]" value="0" />
				<? foreach ($arResult["RUBRICS"] as $itemID => $itemValue) { ?>
					<input type="hidden" name="RUB_ID[]" value="<?= $itemValue["ID"] ?>" />
				<? } ?>
				<div class="dp-form__body">
					<div class="dp-form-field dp-form-field_text">
						<?
						$strValidateAttrs = '';
						$arValidateAttrs = [];
						$arValidateAttrs[] = 'data-rule-required="true"';
						$arValidateAttrs[] = 'data-msg-required="Заполните поле"';
						$arValidateAttrs[] = 'data-rule-email="true"';
						$arValidateAttrs[] = 'data-msg-email="Укажите верный e-mail"';
						if (count($arValidateAttrs) > 0) {
							$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
						}
						?>
						<input <?=$strValidateAttrs;?> type="email" name="EMAIL" placeholder="E-mail" value="<? echo $arResult["SUBSCRIPTION"]["EMAIL"] != "" ? $arResult["SUBSCRIPTION"]["EMAIL"] : $arResult["REQUEST"]["EMAIL"]; ?>" disabled>
					</div>
				</div>
				<div class="dp-form__footer">
					<button class="dp-btn dp-form-account-subscribe__change-email-btn" type="button">Изменить почту</button>
					<div class="dp-form__actions">
						<button class="dp-btn dp-form__submit" type="submit">Сохранить</button>
						<button class="dp-btn dp-btn_white dp-form__cancel dp-form-account-subscribe__change-email-cancel" type="button">Отмена</button>
					</div>
				</div>
			</form>
		</div>
		<div class="dp-account-profile-block dp-account-profile-block-unsubscribe">
			<button class="dp-btn-link dp-btn-link_remove dp-account-unsubscribe-link" type="button" data-modal="#modal-account-unsubscribe"><span>Отписаться от рассылки</span>
				<svg class="icon icon-close ">
					<use xlink:href="#close"></use>
				</svg>
			</button>
		</div>
	</div>
	<?
	if ($arResult["ID"] > 0) {
		$dir = $APPLICATION->GetCurDir();
		$page = $APPLICATION->GetCurPageParam("ID=" . $arResult["ID"] . '&mess_code=UNSUBSCRIBE&_back_url=' . urlencode($dir), array("ID", "mess_code", "back_url", "_back_url"));
	?>
		<div class="dp-modal dp-modal-account dp-modal-account-unsubscribe" id="modal-account-unsubscribe">
			<div class="dp-modal__overlay"></div>
			<div class="dp-modal__dialog">
				<button class="dp-modal__close" type="button">
					<svg class="icon icon-close ">
						<use xlink:href="#close"></use>
					</svg>
				</button>
				<div class="dp-modal__body">
					<form class="dp-form dp-form-account-modal dp-form-account-unsubscribe" id="form-account-delete" method="get" action="<?= $dir; ?>">
						<input type="hidden" name="mess_code" value="UNSUBSCRIBE" />
						<input type="hidden" name="ID" value="<?= $arResult["ID"]; ?>" />
						<input type="hidden" name="_back_url" value="<?= urlencode($dir); ?>" />
						<div class="dp-form__body">
							<h3 class="dp-form__title">Вы больше не хотите получать новости о новинках ассортимента, новых каталогах, событиях и реализованных проектах?</h3>
						</div>
						<div class="dp-form__footer">
							<div class="dp-form__actions">
								<button class="dp-btn dp-form__submit" type="submit">Да, отписаться</button>
								<button class="dp-btn dp-btn_white dp-form__cancel dp-modal__close-btn" type="button">Отмена</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?
	}
	?>
<? } ?>