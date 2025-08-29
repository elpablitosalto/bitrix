<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="order__section">
	<h2> Покупатель</h2>
	<div class="order__buyer">
		<?if (isset($arResult['ORDER_PROP_GROUPED']['Личные данные'])):?>
			<?foreach($arResult['ORDER_PROP_GROUPED']['Личные данные'] as $arProperties): ?>
				<?PrintSinglePropForm($arProperties, $arParams["TEMPLATE_LOCATION"])?>
			<?endforeach;?>
		<?endif;?>
		<div class="order__agreement">
			<input class="visually-hidden" id="order__agreement" type="checkbox" name="agreement" checked>
			<label for="order__agreement"></label>
			<p>Cогласие на <a href="<?= $GLOBALS["arSiteConfig"]["PRIVACY_LINK"]; ?>">обработку персональных данных</a>
			</p>
		</div>
		<label class="visually-hidden" for="order__comment">Комментарий к заказу</label>
		<textarea class="order__textarea" id="order__comment" name="ORDER_DESCRIPTION" placeholder="Комментарий к заказу"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea>
	</div>
</div>

<?if(!CSaleLocation::isLocationProEnabled()):?>
	<div style="display:none;">

		<?$APPLICATION->IncludeComponent(
			"bitrix:sale.ajax.locations",
			$arParams["TEMPLATE_LOCATION"],
			array(
				"AJAX_CALL" => "N",
				"COUNTRY_INPUT_NAME" => "COUNTRY_tmp",
				"REGION_INPUT_NAME" => "REGION_tmp",
				"CITY_INPUT_NAME" => "tmp",
				"CITY_OUT_LOCATION" => "Y",
				"LOCATION_VALUE" => "",
				"ONCITYCHANGE" => "submitForm()",
			),
			null,
			array('HIDE_ICONS' => 'N')
		);?>

	</div>
<?endif?>
