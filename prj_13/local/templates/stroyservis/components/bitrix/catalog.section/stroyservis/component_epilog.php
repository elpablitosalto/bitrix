<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $templateData
 * @var string $templateFolder
 * @var CatalogSectionComponent $component
 */

 //404 для несуществующих страниц пагинации
if($arResult["PAGEN"] > $arResult["NavPageCount"]){
	if (Bitrix\Main\Loader::includeModule("iblock"))
	{
			Bitrix\Iblock\Component\Tools::process404(
					 'Страница не существует'
					 ,true
					 ,true
					 ,true
					 ,'/404.php'
				);
	}
	else
	{
			LocalRedirect('/404.php');
	};
	die();
}

// Количество товаров -->
if (intval($arResult['NAV_RESULT']->NavRecordCount) > 0) {
	$APPLICATION->SetPageProperty(
		"H1_ADD", 
		' <span>('.Indexis::num2word($arResult['NAV_RESULT']->NavRecordCount, ['#NUM# товар', '#NUM# товара', '#NUM# товаров']).')</span>'
	);
}
/*
//vardump($arResult);
if (intval($arResult['ID']) > 0) {
	$arFilter = array(
		'ID' => $arResult['ID'],
		'GLOBAL_ACTIVE' => 'Y',
	);
	$db_list = CIBlockSection::GetList(array($by => $order), $arFilter, true);
	if ($ar_result = $db_list->GetNext()) {
		//vardump($ar_result);
		$APPLICATION->SetPageProperty(
			"H1_ADD", 
			' <span>('.Indexis::num2word($ar_result['ELEMENT_CNT'], ['#NUM# товар', '#NUM# товара', '#NUM# товаров']).')</span>'
		);
	}
}
*/
// <-- Количество товаров

global $APPLICATION;

//if (isset($templateData['TEMPLATE_THEME']))
//{
//	$APPLICATION->SetAdditionalCSS($templateFolder.'/themes/'.$templateData['TEMPLATE_THEME'].'/style.css');
//	$APPLICATION->SetAdditionalCSS('/bitrix/css/main/themes/'.$templateData['TEMPLATE_THEME'].'/style.css', true);
//}

if (!empty($templateData['TEMPLATE_LIBRARY']))
{
	$loadCurrency = false;
	if (!empty($templateData['CURRENCIES']))
	{
		$loadCurrency = \Bitrix\Main\Loader::includeModule('currency');
	}

	CJSCore::Init($templateData['TEMPLATE_LIBRARY']);

	if ($loadCurrency)
	{
		?>
		<script>
			BX.Currency.setCurrencies(<?=$templateData['CURRENCIES']?>);
		</script>
		<?
	}
}

//	lazy load and big data json answers
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
if ($request->isAjaxRequest() && ($request->get('action') === 'showMore' || $request->get('action') === 'deferredLoad'))
{
	$content = ob_get_contents();
	ob_end_clean();

	[, $itemsContainer] = explode('<!-- items-container -->', $content);
	$paginationContainer = '';
	if ($templateData['USE_PAGINATION_CONTAINER'])
	{
		[, $paginationContainer] = explode('<!-- pagination-container -->', $content);
	}
	[, $epilogue] = explode('<!-- component-end -->', $content);

	if (isset($arParams['AJAX_MODE']) && $arParams['AJAX_MODE'] === 'Y')
	{
		$component->prepareLinks($paginationContainer);
	}

	$component::sendJsonAnswer(array(
		'items' => $itemsContainer,
		'pagination' => $paginationContainer,
		'epilogue' => $epilogue,
	));
}