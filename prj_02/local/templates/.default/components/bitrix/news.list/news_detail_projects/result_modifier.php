<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$arParntersId = [];
foreach($arResult["ITEMS"] as &$item){
    //ссылки должны формироваться через текущий раздел, т.к. может принадлежать нескольким раздклам
    if(mb_strlen($arParams["PARENT_SECTION_CODE"])){
        $item["DETAIL_PAGE_URL"] = str_replace(["#SECTION_CODE#","#ELEMENT_CODE#"],[$arParams["PARENT_SECTION_CODE"], $item["CODE"]], $arParams["DETAIL_URL"]);
    }
    if($item["PREVIEW_PICTURE"]["ID"] > 0){
        $file = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], array('width'=>550, 'height'=>360), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] = $file['src'];
    }
    foreach($item["PROPERTIES"]["PARTNERS"]["VALUE"] as $partnerId){
        if($partnerId > 0 && !in_array($partnerId, $arParntersId))
            $arParntersId[] = $partnerId;
    }
}

if(!empty($arParntersId)){
    $arResult["PARTNERS"] = [];
    $res = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => Indexis::getIblockId("partners", "content", "s1"), 'ACTIVE' => 'Y', "!PREVIEW_PICTURE" => false, "ID" => $arParntersId],
        false,
        ['nTopCount' => count($arParntersId)],
        ['ID', 'PREVIEW_PICTURE', 'NAME']
    );
    while ($row = $res->GetNext())
    {
        $partnerImage = CFile::ResizeImageGet($row["PREVIEW_PICTURE"], array('width'=>90, 'height'=>30), BX_RESIZE_IMAGE_PROPORTIONAL);
        $row["PREVIEW_PICTURE_RESIZED"] = $partnerImage["src"];
        $arResult["PARTNERS"][$row["ID"]] = $row;
    }
}
?>