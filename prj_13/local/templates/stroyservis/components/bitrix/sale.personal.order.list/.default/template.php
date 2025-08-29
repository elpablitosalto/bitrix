<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");
Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/style.css");

CJSCore::Init(array('clipboard', 'fx'));

Loc::loadMessages(__FILE__);

if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}

}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	if (!count($arResult['ORDERS']))
	{
		if ($_REQUEST["filter_history"] == 'Y')
		{
			if ($_REQUEST["show_canceled"] == 'Y')
			{
				?>
				<p><br><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></p>
				<?
			}
			else
			{
				?>
				<p><br><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></p>
				<?
			}
		}
		else
		{
			?>
			<p><br><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></p>
			<?
		}
	}

	$clearFromLink = array("filter_history","filter_status","show_all", "show_canceled");

	$this->SetViewTarget("order_tabs");
	?>
	<div class="accorders__actions-l">
	    <ul class="tabs__list">
	        <li class="btn tabs__list-item<?if ($_REQUEST["filter_history"] != 'Y'):?> active<?endif;?>" onclick="document.location = '<?=$APPLICATION->GetCurPageParam("", $clearFromLink, false)?>'">Активные</li>
	        <li class="tabs__list-item<?if ($_REQUEST["filter_history"] == 'Y'):?> active<?endif;?>" onclick="document.location = '<?=$APPLICATION->GetCurPageParam("filter_history=Y", $clearFromLink, false)?>'">Архив</li>
	    </ul>
	</div>
	<?
	$this->EndViewTarget("order_tabs");
	?>
	<div class="orders__list">
		<?
		if ($_REQUEST["filter_history"] !== 'Y')
		{
			$paymentChangeData = array();

			foreach ($arResult['ORDERS'] as $key => $order)
			{
				//vardump($arResult['INFO']['STATUS']);
				//vardump($order);
				//$backGroundColor
				?>
				<div class="order__item">
					<div class="order__head">
						<div class="order__info">
							<div class="order__date"><?=Loc::getMessage('SPOL_TPL_ORDER')?> <?=Loc::getMessage('SPOL_TPL_FROM_DATE')?> <?=$order['ORDER']['DATE_INSERT_FORMATED']?></div>
							<div class="order__number"><?=Loc::getMessage('SPOL_TPL_NUMBER_SIGN').$order['ORDER']['ACCOUNT_NUMBER']?></div>
							<div class="order__state"<?if (isset($arParams['STATUS_LIST'][$order['ORDER']['STATUS_ID']]) && !empty($arParams['STATUS_LIST'][$order['ORDER']['STATUS_ID']]['COLOR'])):?> style="background: <?=$arParams['STATUS_LIST'][$order['ORDER']['STATUS_ID']]['COLOR']?>;"<?endif;?>>
								<?=htmlspecialcharsbx($arResult['INFO']['STATUS'][$order['ORDER']['STATUS_ID']]['NAME'])?>
							</div>
						</div>
						<div class="order__payment">
							<div class="order__amount"><?=str_replace('&#8381;', '<span class="rubles">&#8381;</span>', $order['ORDER']['FORMATED_PRICE'])?>,</span>
								<?if ($order['ORDER']['PAYED'] == 'Y'):?>
									<span>оплачен</span>
								<?else:?>
									<span>к оплате</span>
								<?endif;?>
							</div>
							<?foreach ($order['PAYMENT'] as $payment):?>
								<div class="order__pay-type"><?=$payment['PAY_SYSTEM_NAME']?></div>
							<?endforeach;?>
						</div>
						<div class="order__state"<?if (isset($arParams['STATUS_LIST'][$order['ORDER']['STATUS_ID']]) && !empty($arParams['STATUS_LIST'][$order['ORDER']['STATUS_ID']]['COLOR'])):?> style="background: <?=$arParams['STATUS_LIST'][$order['ORDER']['STATUS_ID']]['COLOR']?>;"<?endif;?>>
							<?=htmlspecialcharsbx($arResult['INFO']['STATUS'][$order['ORDER']['STATUS_ID']]['NAME'])?>
						</div>
					</div>
					<ul class="order__products-list">
						<?foreach($order['BASKET_ITEMS'] as $arBasketItem):?>
							<li class="product__item product__item--order">
								<?if (!empty($arResult['PRODUCT_DATA'][$arBasketItem['PRODUCT_ID']]['PICTURE'])):?>
									<div class="product__image">
										<img src="<?=$arResult['PRODUCT_DATA'][$arBasketItem['PRODUCT_ID']]['PICTURE']?>" alt="" />
									</div>
								<?endif;?>
								<a class="product__title" href="<?=$arBasketItem['DETAIL_PAGE_URL']?>"><?=$arBasketItem['NAME']?></a>
								<div class="product__bottom">
									<div class="product__attributes">
										<div class="product__bonus">
											<div class="product__bonus_help">?</div><span class="product__bonus_quantity">69</span>СтройБонусов
										</div>
										<div class="product__bottom-line">
											<div class="product__price">
												<span class="product__price_sum">
													<?=str_replace('&#8381;', '</span> <span class="product__price_ruble">&#8381;', CurrencyFormat($arBasketItem['PRICE'], $arBasketItem['CURRENCY']))?>
												</span>
											</div>
											<?if (
												isset($arResult['PRODUCT_DATA'][$arBasketItem['PRODUCT_ID']]['DISPLAY_PROPERTIES']['VES_ATTR_S']['VALUE']) &&
												$arResult['PRODUCT_DATA'][$arBasketItem['PRODUCT_ID']]['DISPLAY_PROPERTIES']['VES_ATTR_S']['VALUE'] > 0 &&
												$arBasketItem['PRICE'] > 0
											):?>
												<div class="product__price-for">
													<span class="product__price-for_sum"><?=number_format($arBasketItem['PRICE'] / $arResult['PRODUCT_DATA'][$arBasketItem['PRODUCT_ID']]['DISPLAY_PROPERTIES']['VES_ATTR_S']['VALUE'], 0, '.', ' ')?></span> ₽/кг.
												</div>
											<?endif;?>
											<div class="product__amount">x<?=$arBasketItem['QUANTITY']?></div>
										</div>
									</div>
								</div>
							</li>
						<?endforeach;?>
					</ul>

					<div class="order__footer">
						<?if ($order['ORDER']['PAYED'] != 'Y' && $order['ORDER']['IS_ALLOW_PAY'] == 'Y'):?>
							<?
							foreach ($order['PAYMENT'] as $payment)
							{
								if ($order['ORDER']['LOCK_CHANGE_PAYSYSTEM'] !== 'Y')
								{
									$paymentChangeData[$payment['ACCOUNT_NUMBER']] = array(
										"order" => htmlspecialcharsbx($order['ORDER']['ACCOUNT_NUMBER']),
										"payment" => htmlspecialcharsbx($payment['ACCOUNT_NUMBER']),
										"allow_inner" => $arParams['ALLOW_INNER'],
										"refresh_prices" => $arParams['REFRESH_PRICES'],
										"path_to_payment" => $arParams['PATH_TO_PAYMENT'],
										"only_inner_full" => $arParams['ONLY_INNER_FULL'],
										"return_url" => $arResult['RETURN_URL'],
									);
								}
								?>

								<?
								if (!empty($payment['CHECK_DATA']))
								{
									$listCheckLinks = "";
									foreach ($payment['CHECK_DATA'] as $checkInfo)
									{
										$title = Loc::getMessage('SPOL_CHECK_NUM', array('#CHECK_NUMBER#' => $checkInfo['ID']))." - ". htmlspecialcharsbx($checkInfo['TYPE_NAME']);
										if($checkInfo['LINK'] <> '')
										{
											$link = $checkInfo['LINK'];
											$listCheckLinks .= "<div><a href='$link' target='_blank'>$title</a></div>";
										}
									}
									if ($listCheckLinks <> '')
									{
										?>
										<div class="sale-order-list-payment-check">
											<div class="sale-order-list-payment-check-left"><?= Loc::getMessage('SPOL_CHECK_TITLE')?>:</div>
											<div class="sale-order-list-payment-check-left">
												<?=$listCheckLinks?>
											</div>
										</div>
										<?
									}
								}

								if ($order['ORDER']['IS_ALLOW_PAY'] == 'N' && $payment['PAID'] !== 'Y')
								{
									?>
									<div class="sale-order-list-status-restricted-message-block">
										<span class="sale-order-list-status-restricted-message"><?=Loc::getMessage('SOPL_TPL_RESTRICTED_PAID_MESSAGE')?></span>
									</div>
									<?
								}
								?>


								<?
								if ($payment['PAID'] === 'N' && $payment['IS_CASH'] !== 'Y' && $payment['ACTION_FILE'] !== 'cash')
								{
									if ($order['ORDER']['IS_ALLOW_PAY'] == 'N')
									{
										?>
										<a class="sale-order-list-button inactive-button">
											<?=Loc::getMessage('SPOL_TPL_PAY')?>
										</a>
										<?
									}
									elseif ($payment['NEW_WINDOW'] === 'Y')
									{
										?>
										<a class="btn-default" target="_blank" href="<?=htmlspecialcharsbx($payment['PSA_ACTION_FILE'])?>">
											<?=Loc::getMessage('SPOL_TPL_PAY')?>
										</a>
										<?
									}
									else
									{
										?>
										<a class="btn-default" href="<?=htmlspecialcharsbx($payment['PSA_ACTION_FILE'])?>">
											<?=Loc::getMessage('SPOL_TPL_PAY')?>
										</a>
										<?
									}
								}

							}
							?>
						<?endif;?>
						<a class="btn-gray" href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_COPY"])?>">
							<?=Loc::getMessage('SPOL_TPL_REPEAT_ORDER')?>
						</a>
						<a href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_CANCEL"])?>">
							<?=Loc::getMessage('SPOL_TPL_CANCEL_ORDER')?>
						</a>
					</div>
				</div>
				<?
			}
		}
		else
		{

			foreach ($arResult['ORDERS'] as $key => $order)
			{
				?>
				<div class="order__item">
					<div class="order__head">
						<div class="order__info">
							<div class="order__date"><?=Loc::getMessage('SPOL_TPL_ORDER')?> <?=Loc::getMessage('SPOL_TPL_FROM_DATE')?> <?=$order['ORDER']['DATE_INSERT_FORMATED']?></div>
							<div class="order__number"><?=Loc::getMessage('SPOL_TPL_NUMBER_SIGN').$order['ORDER']['ACCOUNT_NUMBER']?></div>
							<div class="order__state"<?if (isset($arParams['STATUS_LIST'][$order['ORDER']['STATUS_ID']]) && !empty($arParams['STATUS_LIST'][$order['ORDER']['STATUS_ID']]['COLOR'])):?> style="background: <?=$arParams['STATUS_LIST'][$order['ORDER']['STATUS_ID']]['COLOR']?>;"<?endif;?>>
								<?=htmlspecialcharsbx($arResult['INFO']['STATUS'][$order['ORDER']['STATUS_ID']]['NAME'])?>
							</div>
						</div>
						<div class="order__payment">
							<div class="order__amount"><?=str_replace('&#8381;', '<span class="rubles">&#8381;</span>', $order['ORDER']['FORMATED_PRICE'])?>,</span>
								<?if ($order['ORDER']['PAYED'] == 'Y'):?>
									<span>оплачен</span>
								<?else:?>
									<span>к оплате</span>
								<?endif;?>
							</div>
							<?foreach ($order['PAYMENT'] as $payment):?>
								<div class="order__pay-type"><?=$payment['PAY_SYSTEM_NAME']?></div>
							<?endforeach;?>
						</div>
						<div class="order__state"<?if (isset($arParams['STATUS_LIST'][$order['ORDER']['STATUS_ID']]) && !empty($arParams['STATUS_LIST'][$order['ORDER']['STATUS_ID']]['COLOR'])):?> style="background: <?=$arParams['STATUS_LIST'][$order['ORDER']['STATUS_ID']]['COLOR']?>;"<?endif;?>>
							<?=htmlspecialcharsbx($arResult['INFO']['STATUS'][$order['ORDER']['STATUS_ID']]['NAME'])?>
						</div>
					</div>
					<ul class="order__products-list">
						<?foreach($order['BASKET_ITEMS'] as $arBasketItem):?>
							<li class="product__item product__item--order">
								<?if (!empty($arResult['PRODUCT_DATA'][$arBasketItem['PRODUCT_ID']]['PICTURE'])):?>
									<div class="product__image">
										<img src="<?=$arResult['PRODUCT_DATA'][$arBasketItem['PRODUCT_ID']]['PICTURE']?>" alt="" />
									</div>
								<?endif;?>
								<a class="product__title" href="<?=$arBasketItem['DETAIL_PAGE_URL']?>"><?=$arBasketItem['NAME']?></a>
								<div class="product__bottom">
									<div class="product__attributes">
										<div class="product__bonus">
											<div class="product__bonus_help">?</div><span class="product__bonus_quantity">69</span>СтройБонусов
										</div>
										<div class="product__bottom-line">
											<div class="product__price">
												<span class="product__price_sum">
													<?=str_replace('&#8381;', '</span> <span class="product__price_ruble">&#8381;', CurrencyFormat($arBasketItem['PRICE'], $arBasketItem['CURRENCY']))?>
												</span>
											</div>
											<?if (
												isset($arResult['PRODUCT_DATA'][$arBasketItem['PRODUCT_ID']]['DISPLAY_PROPERTIES']['VES_ATTR_S']['VALUE']) &&
												$arResult['PRODUCT_DATA'][$arBasketItem['PRODUCT_ID']]['DISPLAY_PROPERTIES']['VES_ATTR_S']['VALUE'] > 0 &&
												$arBasketItem['PRICE'] > 0
											):?>
												<div class="product__price-for">
													<span class="product__price-for_sum"><?=number_format($arBasketItem['PRICE'] / $arResult['PRODUCT_DATA'][$arBasketItem['PRODUCT_ID']]['DISPLAY_PROPERTIES']['VES_ATTR_S']['VALUE'], 0, '.', ' ')?></span> ₽/кг.
												</div>
											<?endif;?>
											<div class="product__amount">x<?=$arBasketItem['QUANTITY']?></div>
										</div>
									</div>
								</div>
							</li>
						<?endforeach;?>
					</ul>
					<div class="order__footer">
						<a class="btn-gray" href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_COPY"])?>">
							<?=Loc::getMessage('SPOL_TPL_REPEAT_ORDER')?>
						</a>
					</div>
				</div>
				<?
			}
		}
		?>
	</div>
	<?
	if (!empty($arResult["NAV_STRING"]))
	{
		?>
		<div class="page__nav accorders__nav">
			<hr>
			<?
			echo $arResult["NAV_STRING"];
			?>
		</div>
		<?
	}

	if ($_REQUEST["filter_history"] !== 'Y')
	{
		$javascriptParams = array(
			"url" => CUtil::JSEscape($this->__component->GetPath().'/ajax.php'),
			"templateFolder" => CUtil::JSEscape($templateFolder),
			"templateName" => $this->__component->GetTemplateName(),
			"paymentList" => $paymentChangeData,
			"returnUrl" => CUtil::JSEscape($arResult["RETURN_URL"]),
		);
		$javascriptParams = CUtil::PhpToJSObject($javascriptParams);
		?>
		<script>
			BX.Sale.PersonalOrderComponent.PersonalOrderList.init(<?=$javascriptParams?>);
		</script>
		<?
	}
}
?>
