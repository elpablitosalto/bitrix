<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['ITEMS'] as $key => $item) {

	/** собираем все секции элемента **/
	$db_groups = CIBlockElement::GetElementGroups($item['ID'], true);
	while($ar_group = $db_groups->Fetch()) {
		$arResult['ITEMS'][$key]['SECTION_ID'][] = $ar_group["ID"];
	}

	/** собираем изображение и артикул элемента **/
	$arFilter = Array("IBLOCK_ID"=>1, "ID"=>$item['ID']);
	$res = CIBlockElement::GetList(Array(), $arFilter);
	if ($ob = $res->GetNextElement()){
		$arFields = $ob->GetFields();
		$arProps = $ob->GetProperties();

		//print_r ($arFields);
		//print_r ($arProps);

		/** Основные свойства **/
		$arResult['ITEMS'][$key]['IMG']     = CFile::GetPath($arFields['PREVIEW_PICTURE']);
		$arResult['ITEMS'][$key]['ARTICLE'] = $arProps['ARTICLE']['VALUE'];
		$arResult['ITEMS'][$key]['VENDOR']  = $arProps['VENDOR']['VALUE'];


		//$arResult['ITEMS'][$key]['MODEL']  = $arProps['VENDOR']['VALUE'];


		/** Дополнительные свойства params **/

		/** Материал **/
		$arResult['ITEMS'][$key]['PARAMS']['MAT_T']['NAME']    = $arProps['MAT_T']['NAME'];
		$arResult['ITEMS'][$key]['PARAMS']['MAT_T']['VALUE']   = $arProps['MAT_T']['VALUE'][0];
		$arResult['ITEMS'][$key]['PARAMS']['MAT_T']['UNIT']    = "";

		/** Цвет **/
		$arResult['ITEMS'][$key]['PARAMS']['COLOR_R']['NAME']  = $arProps['COLOR_R']['NAME'];
		$arResult['ITEMS'][$key]['PARAMS']['COLOR_R']['VALUE'] = $arProps['COLOR_R']['VALUE'][0];
		$arResult['ITEMS'][$key]['PARAMS']['COLOR_R']['UNIT']  = "";

		/** Длина **/
		$arResult['ITEMS'][$key]['PARAMS']['DLINA']['NAME']    = $arProps['DLINA']['NAME'];
		$arResult['ITEMS'][$key]['PARAMS']['DLINA']['VALUE']   = $arProps['DLINA']['VALUE'];
		$arResult['ITEMS'][$key]['PARAMS']['DLINA']['UNIT']    = "см";

		/** Ширина **/
		$arResult['ITEMS'][$key]['PARAMS']['SHIRINA']['NAME']  = $arProps['SHIRINA']['NAME'];
		$arResult['ITEMS'][$key]['PARAMS']['SHIRINA']['VALUE'] = $arProps['SHIRINA']['VALUE'];
		$arResult['ITEMS'][$key]['PARAMS']['SHIRINA']['UNIT']  = "см";

		/** Высота **/
		$arResult['ITEMS'][$key]['PARAMS']['HEIGHT']['NAME']   = $arProps['HEIGHT']['NAME'];
		$arResult['ITEMS'][$key]['PARAMS']['HEIGHT']['VALUE']  = $arProps['HEIGHT']['VALUE'];
		$arResult['ITEMS'][$key]['PARAMS']['HEIGHT']['UNIT']   = "см";
	}
} ?>