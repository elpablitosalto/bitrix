<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Context;

//CModule::IncludeModule('sale');
\Bitrix\Main\Loader::IncludeModule("sale");

$context = Context::getCurrent();
$request = $context->getRequest();

$filterHistory = htmlspecialcharsbx($request->getQuery("filter_history"));
if (!in_array($filterHistory, ['Y', 'N']))
	$filterHistory = 'N';

$filterStatus = htmlspecialcharsbx($request->getQuery("filter_status"));
?>

<?
// Статусы -->
$statusResult = \Bitrix\Sale\Internals\StatusLangTable::getList(array(
	'order' => array('STATUS.SORT' => 'ASC'),
	'filter' => array('STATUS.TYPE' => 'O', 'LID' => LANGUAGE_ID),
	//'filter' => array('LID' => LANGUAGE_ID),
	//'select' => array('STATUS_ID', 'NAME', 'DESCRIPTION'),
	'select' => array('*'),
));
while ($status = $statusResult->fetch()) {
	//print_r($status);
	$arStatuses[] = $status;
}
/**/
$arStatusesAll = array();
$arSelect = array();
$arFilter = array();
$res = CSaleStatus::GetList(array(), $arFilter, false, false, $arSelect);
//while ($ob = $res->GetNextElement()) {
while ($arFields = $res->Fetch()) {
	//$arFields = $ob->GetFields();

	$arStatusesAll[$arFields['ID']] = $arFields;
}
/**/
//vardump($arStatuses);
// <-- Статусы
?>

<h2 class="lk__title lk__title--orders">Заказы</h2>
<div class="orders">
	<form class="orders__head-line" action="<?= $APPLICATION->GetCurDir() ?>" method="get">
		<input type="hidden" name="filter_status" value="<?= $filter_status ?>">
		<div class="orders__sort">
			<span>Статус</span>
			<select data-entity="filter-order-status">
				<option value="">Все заказы</option>
				<? foreach ($arStatuses as $key => $val) { ?>
					<option value="<?= $val['STATUS_ID']; ?>" <? if ($filterStatus == $val['STATUS_ID']) : ?> selected<? endif; ?>><?= $val['NAME']; ?></option>
				<? } ?>
			</select>
		</div>
		<?/*?>
		<input type="hidden" name="filter_history" value="<?= $filterHistory ?>">
		<div class="orders__sort">
			<span>Статус</span>
			<select data-entity="filter-order-type">
				<option value="N" <? if ($filterHistory == 'N') : ?> selected<? endif; ?>>Все активные заказы</option>
				<option value="Y" <? if ($filterHistory == 'Y') : ?> selected<? endif; ?>>Завершенные заказы</option>
			</select>
		</div>
		<?*/ ?>
		<div class="orders__search">
			<input data-entity="filter-order-id" placeholder="Номер заказа" name="filter_id" value="<?= htmlspecialcharsbx($request->getQuery("filter_id")) ?>">
			<svg width="19" height="19" fill="#8D8D8D">
				<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#search"></use>
			</svg>
		</div>
	</form>
	<?php
	$arChildParams = array(
		"PATH_TO_DETAIL" => $arResult["PATH_TO_DETAIL"],
		"PATH_TO_CANCEL" => $arResult["PATH_TO_CANCEL"],
		"PATH_TO_COPY" => $arResult["PATH_TO_LIST"] . '?ID=#ID#',
		"PATH_TO_BASKET" => $arParams["PATH_TO_BASKET"],
		"PATH_TO_PAYMENT" => $arParams["PATH_TO_PAYMENT"],
		"SAVE_IN_SESSION" => $arParams["SAVE_IN_SESSION"],
		"ORDERS_PER_PAGE" => $arParams["ORDERS_PER_PAGE"],
		"PATH_TO_CATALOG" => $arParams["PATH_TO_CATALOG"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"ID" => $arResult["VARIABLES"]["ID"],
		"NAV_TEMPLATE" => $arParams["NAV_TEMPLATE"],
		"ACTIVE_DATE_FORMAT" => $arParams["ACTIVE_DATE_FORMAT"],
		"HISTORIC_STATUSES" => $arParams["HISTORIC_STATUSES"],
		"ALLOW_INNER" => $arParams["ALLOW_INNER"],
		"ONLY_INNER_FULL" => $arParams["ONLY_INNER_FULL"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DEFAULT_SORT" => $arParams["ORDER_DEFAULT_SORT"],
		"DISALLOW_CANCEL" => $arParams["DISALLOW_CANCEL"],
		"RESTRICT_CHANGE_PAYSYSTEM" => $arParams["RESTRICT_CHANGE_PAYSYSTEM"],
		"REFRESH_PRICES" => $arParams["REFRESH_PRICES"],
		'STATUS_LIST' => $arStatusesAll,
	);

	foreach ($arParams as $key => $val)
		if (mb_strpos($key, "STATUS_COLOR_") !== false && mb_strpos($key, "~") !== 0)
			$arChildParams[$key] = $val;

	$APPLICATION->IncludeComponent(
		"bitrix:sale.personal.order.list",
		"",
		$arChildParams,
		$component
	);
	?>
</div>