<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

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
