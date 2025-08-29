<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;

if ($arParams['SHOW_ORDER_PAGE'] !== 'Y')
{
	LocalRedirect($arParams['SEF_FOLDER']);
}

if ($arParams["MAIN_CHAIN_NAME"] <> '')
{
	$APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}

$APPLICATION->AddChainItem(Loc::getMessage("SPS_CHAIN_ORDERS"), $arResult['PATH_TO_ORDERS']);
?>
<div class="profile__header">
		<div class="profile__title">
				<!-- begin .title-->
				<h2 class="title title_size_h3">История заказов</h2>
				<!-- end .title-->
		</div>
</div>
<div class="profile__content">
	<?
	$APPLICATION->IncludeComponent(
		"waim:sale.personal.order.list",
		"main",
		array(
            'AJAX_MODE' => 'Y',
            'AJAX_OPTION_JUMP' => 'N',
            'AJAX_OPTION_STYLE' => 'Y',
            'AJAX_OPTION_HISTORY' => 'N',
			"PATH_TO_DETAIL" => $arResult["PATH_TO_ORDER_DETAIL"],
			"PATH_TO_CANCEL" => $arResult["PATH_TO_ORDER_CANCEL"],
			"PATH_TO_CATALOG" => $arParams["PATH_TO_CATALOG"],
			"PATH_TO_COPY" => $arResult["PATH_TO_ORDER_COPY"],
			"PATH_TO_BASKET" => $arParams["PATH_TO_BASKET"],
			"PATH_TO_PAYMENT" => $arParams["PATH_TO_PAYMENT"],
			"SAVE_IN_SESSION" => $arParams["SAVE_IN_SESSION"],
			"ORDERS_PER_PAGE" => $arParams["ORDERS_PER_PAGE"],
			"SET_TITLE" => 'N',
			"ID" => $arResult["VARIABLES"]["ID"],
			"NAV_TEMPLATE" => "main",
			"ACTIVE_DATE_FORMAT" => $arParams["ACTIVE_DATE_FORMAT"],
			"HISTORIC_STATUSES" => $arParams["ORDER_HISTORIC_STATUSES"],
			"ALLOW_INNER" => $arParams["ALLOW_INNER"],
			"ONLY_INNER_FULL" => $arParams["ONLY_INNER_FULL"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISALLOW_CANCEL" => $arParams["ORDER_DISALLOW_CANCEL"],
			"DEFAULT_SORT" => "ID",
			"RESTRICT_CHANGE_PAYSYSTEM" => $arParams["ORDER_RESTRICT_CHANGE_PAYSYSTEM"],
			"REFRESH_PRICES" => $arParams["ORDER_REFRESH_PRICES"],
		),
		$component
	);
	?>
</div>
