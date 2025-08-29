<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */


$arResult["SECTIONS"] = [];
$SectList = CIBlockSection::GetList( ["SORT" => "ASC", "ID" => "ASC"], array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"ACTIVE"=>"Y") ,false, array("ID","NAME"));
while ($SectListGet = $SectList->GetNext())
{
    $arResult["SECTIONS"][$SectListGet["ID"]]=$SectListGet;
}

foreach($arResult["ITEMS"] as $item){
    if($item["IBLOCK_SECTION_ID"] > 0){
        $arResult["SECTIONS"][$item["IBLOCK_SECTION_ID"]]["ITEMS"][] = $item;
    }
}
unset($arResult["ITEMS"]);

?>
