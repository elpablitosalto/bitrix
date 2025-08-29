<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

use \Bitrix\Main\Loader;

if (\Bitrix\Main\Loader::IncludeModule("highloadblock")) {

	// Thcategory
	$result = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('=NAME'=>"Thcategory")));
	if($row = $result->fetch())
		{
    			$HLBLOCK_ID = $row["ID"];
				$hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($HLBLOCK_ID)->fetch();
				$entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
				$entityDataClass = $entity->getDataClass();
				$result = $entityDataClass::getList(array(
					"select" => ["ID","UF_NAME","UF_XML_ID","UF_DESCRIPTION"],
					"order" => []
				));
				while ($arRow = $result->Fetch())
				{
					if(strlen($arRow["UF_DESCRIPTION"])<1) { $arRow["UF_DESCRIPTION"] = 'plus';}
					$arResult['THCATEGORY']['LEGEND'][$arRow["UF_XML_ID"]] = ["ID" => $arRow["ID"], "NAME" => $arRow["UF_NAME"], "ICON" => $arRow["UF_DESCRIPTION"]];
				}
		}

}

if ($arResult['DISPLAY_PROPERTIES']['CURATOR']['VALUE']) {
	$arFilter = [
    	"IBLOCK_ID" => Indexis::getIblockId("specialists", "content"),
		"ID" => $arResult['DISPLAY_PROPERTIES']['CURATOR']['VALUE']
	];
	$arSelect = [
		"IBLOCK_ID", "ID", "NAME", "PREVIEW_PICTURE", 'DETAIL_PICTURE',
		"PROPERTY_POSITION", "PROPERTY_PHONE"
		
	];
	$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
	if ($curator = $res->Fetch()) {
        $arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['NAME'] = $curator['NAME'];
        $arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['POSITION'] = $curator['PROPERTY_POSITION_VALUE'];

		$pictureID = 0;
		if($curator["PREVIEW_PICTURE"] > 0){
			$pictureID = $curator["PREVIEW_PICTURE"];
		} elseif ($curator["DETAIL_PICTURE"] > 0) {
			$pictureID = $curator["DETAIL_PICTURE"];
		}
		if($pictureID > 0){
			$file = CFile::ResizeImageGet($pictureID, array('width'=>163, 'height'=>136), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    		$arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['PICTURE'] = $file['src'];
		}
		if (strlen($curator['PROPERTY_PHONE_VALUE'])>0) {
    		$arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['PHONE']['SRC'] = $curator['PROPERTY_PHONE_VALUE'];
    		$arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['PHONE']['TRIM'] = preg_replace(
				array(
					'/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{3})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
					'/[\+]?([7|8])[-|\s]?(\d{3})[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
					'/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
					'/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',	
					'/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{3})/',
					'/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{3})[-|\s]?(\d{3})/',					
				), 
				array(
					'7$2$3$4$5', 
					'7$2$3$4$5', 
					'7$2$3$4$5', 
					'7$2$3$4$5', 	
					'7$2$3$4', 
					'7$2$3$4', 
				), 
				$curator['PROPERTY_PHONE_VALUE']
			);

		}
}


	
}
