<?
$arFormParams = array(
	'QUESTIONS' => array(
		'NAME' => array(
			'REQUERED' => 'Y',
			'arValidateAttrs' => array(
				'data-rule-required="true"',
				'data-msg-required="Введите Ваше имя"',
				'data-rule-minlength="2"',
				'data-msg-minlength="Имя должно содержать не менее 2 символов"'
			)
		),
		'PHONE' => array(
			'REQUERED' => 'Y',
			'arValidateAttrs' => array(
				'data-rule-required="true"',
				'data-msg-required="Введите Ваш телефон"',
				'data-rule-phone="true"',
				'data-msg-phone="Введите верный номер телефона"'
			)
		),
		'INN' => array(
			'REQUERED' => 'N',
			'arValidateAttrs' => array(
				'data-rule-minlength="10"',
				'data-msg-minlength="Введите 10 цифр"',
				'data-rule-digits="true"',
				'data-msg-digits="Введите толькой цифры"',
			)
		),
		'EMAIL' => array(
			'REQUERED' => 'Y',
			'arValidateAttrs' => array(
				'data-rule-required="true"',
				'data-msg-required="Введите Ваш E-mail"',
				'data-rule-email="true"',
				'data-msg-email="Введите корректный e-mail"'
			)
		),
	),
);
?>

<div class="popup order-card">
	<div class="js_quick_order_container">
		<form class="popup-form" id="order-card">
			<? if (intval($arParams['PRODUCT_ID']) > 0) { ?>
				<input type="hidden" value="<?= $arParams['PRODUCT_ID']; ?>" name="PRODUCT_ID" />
				<h2>Быстрый заказ товара</h2>
				<? $APPLICATION->IncludeComponent(
					"bitrix:sale.basket.basket.small",
					"quick_order",
					array(
						"PATH_TO_BASKET" => "/personal/cart/",
						"PATH_TO_ORDER" => "/personal/order/make/",
						"SHOW_DELAY" => "Y",
						"SHOW_NOTAVAIL" => "Y",
						"SHOW_SUBSCRIBE" => "Y",

						//'ADD_PRODUCT_ID' => $arFields['PRODUCT_ID'],
						'PRODUCT_ID' => $arParams['PRODUCT_ID'],
					),
					false
				); ?>
			<? } else { ?>
				<h2>Быстрый заказ</h2>
			<? } ?>
			<div class="order-card__form">
				<h3>Информация о покупателе</h3>
				<div class="order-card__form-wrapper">
					<input class="visually-hidden" type="radio" id="order-card-individual" name="PERSON_TYPE_ID" value="1" checked>
					<label for="order-card-individual">Физическое лицо</label>
					<input class="visually-hidden" type="radio" id="order-card-entity" name="PERSON_TYPE_ID" value="2">
					<label for="order-card-entity">Юридическое лицо</label>
				</div>

				<div class="order-card__form-type">
					<?
					$arValidateAttrs = $arFormParams['QUESTIONS']['NAME']['arValidateAttrs'];
					$strValidateAttrs = '';
					if (count($arValidateAttrs) > 0) {
						$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
					}
					?>
					<div class="form__input order-individual__name">
						<label class="visually-hidden" for="order-entity__name">Ваше имя*</label>
						<input <?= $strValidateAttrs; ?> class="order__input" id="order-entity__name" type="text" name="NAME" placeholder="Ваше имя*" required>
					</div>
					<?
					/**/
					$arValidateAttrs = $arFormParams['QUESTIONS']['INN']['arValidateAttrs'];
					$strValidateAttrs = '';
					if (count($arValidateAttrs) > 0) {
						$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
					}
					/**/
					?>
					<div class="form__input display-none">
						<label class="visually-hidden" for="order-entity__inn">ИНН</label>
						<input <?= $strValidateAttrs; ?> class="order__input" id="order-entity__inn" type="text" name="INN" placeholder="ИНН" maxlength="10">
					</div>
					<?
					$arValidateAttrs = $arFormParams['QUESTIONS']['PHONE']['arValidateAttrs'];
					$strValidateAttrs = '';
					if (count($arValidateAttrs) > 0) {
						$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
					}
					?>
					<div class="form__input">
						<label class="visually-hidden" for="order-entity__phone">Телефон*</label>
						<input <?= $strValidateAttrs; ?> class="order__input js_phone_class" id="order-entity__phone" type="text" name="PHONE" placeholder="Телефон*" required>
					</div>
					<?
					$arValidateAttrs = $arFormParams['QUESTIONS']['EMAIL']['arValidateAttrs'];
					$strValidateAttrs = '';
					if (count($arValidateAttrs) > 0) {
						$strValidateAttrs = ' ' . implode(' ', $arValidateAttrs);
					}
					?>
					<div class="form__input">
						<label class="visually-hidden" for="order-entity__email">E-mail*</label>
						<input <?= $strValidateAttrs; ?> class="order__input" id="order-entity__email" type="email" name="EMAIL" placeholder="E-mail*" required>
					</div>
				</div>
			</div>
			<p class="popup-form__policy">Нажимая кнопку «Отправить», вы даете согласие на <a href="<?= $GLOBALS["arSiteConfig"]["PRIVACY_LINK"]; ?>">обработку персональных данных</a>
			</p>
			<button class="button-orange" type="submit">Отправить</button>
		</form>
	</div>
	<button class="popup-form__popup_close"></button>
</div>