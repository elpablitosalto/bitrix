<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

if($arResult["DETAIL_PICTURE"]["ID"] > 0){
    $file = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>376, 'height'=>320), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED_SMALL"] = $file['src'];

    $file = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>769, 'height'=>600), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED_BIG"] = $file['src'];

    $file = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>646, 'height'=>650), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED_MEDIUM"] = $file['src'];
}

foreach($arResult["DISPLAY_PROPERTIES"]["DOCS"]["VALUE"] as $fileId){
    $arResult["DISPLAY_PROPERTIES"]["DOCS"]["FULL_FILES"][] = CFile::GetFileArray($fileId);
}

//тег для новостей
$newsIb = Indexis::getIblockId("programs", "content", "s1");
$rsEnums = CIBlockPropertyEnum::GetList(
    array(
        "SORT" => "ASC",
    ),
    array(
        "IBLOCK_ID" => $newsIb,
        "CODE" => ["PUBLICATION_TYPE"]
    )
);
while ($arEnums = $rsEnums->Fetch()){
    if($arEnums["XML_ID"] == "ANNOUNCEMENTS"){
        $arResult["ID_ANNOUNCEMENTS"] = $arEnums["ID"];
        break;
    }
}

\Bitrix\Main\Loader::includeModule('dev2fun.opengraph');
\Dev2fun\Module\OpenGraph::Show($arResult['ID'],'element');

$cp = $this->__component;
if (is_object($cp)) {
    $cacheKeys = [
        'ID',
        'DISPLAY_PROPERTIES',
        'ID_ANNOUNCEMENTS'
    ];
    foreach($cacheKeys as $key){
        $cp->arResult[$key] = $arResult[$key];
    }
    $cp->SetResultCacheKeys($cacheKeys);
}
?>