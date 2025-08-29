<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!CModule::IncludeModule("iblock")||!CModule::IncludeModule("catalog")) return;?>
<?
	if(!empty($arResult))	
	{
		global $compare_items;
		foreach($arResult as $key=>$arItem){ $compare_items[] = $key; }		
	}
?>

<?=json_encode(array("COMPARE_COUNT"=>!empty($compare_items) ? count($compare_items) : 0, "ITEMS"=>$compare_items));?>