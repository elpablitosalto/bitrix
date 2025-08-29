<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $USER;
$arResultFunc = CMaterials::getSavedMaterials(array(
    "USER_ID" => $USER->GetID(),
    'MATERIAL_IBLOCK_ID' => [
        Indexis::getIblockId("articles", "content"),
        Indexis::getIblockId("webinars", "content"),
        Indexis::getIblockId("master-class", "content")
    ],
));

if(isset($arResultFunc["iblocks"]) && !empty($arResultFunc["iblocks"])){
    switch ($arResultFunc["iblocks"][0]){
        case Indexis::getIblockId("articles", "content"):
            LocalRedirect("/favorites/blog/");
            break;
        case Indexis::getIblockId("webinars", "content"):
            LocalRedirect("/favorites/webinars/");
            break;
        case Indexis::getIblockId("master-class", "content"):
            LocalRedirect("/favorites/master_classes/");
            break;
    }
} else {
    include('webinars/index.php');
}


?>