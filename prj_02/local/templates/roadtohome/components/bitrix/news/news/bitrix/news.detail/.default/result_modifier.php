<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

\Bitrix\Main\Loader::includeModule('dev2fun.opengraph');
\Dev2fun\Module\OpenGraph::Show($arResult['ID'],'element');

// Фильм по типу публикации -->
$key = $arResult["PROPERTIES"]["PUBLICATION_TYPE"]["VALUE_ENUM_ID"];
$htmlKey = htmlspecialcharsbx($key);
$keyCrc = abs(crc32($htmlKey));
$data = array(
    "set_filter" => "y",
    $arParams["FILTER_NAME"] . "_" . $arResult["PROPERTIES"]["PUBLICATION_TYPE"]["ID"] . "_" . $keyCrc => "Y",
);
$query = http_build_query($data);
$arResult["FILTER_PUBLICATION_TYPE"] = $arParams["FOLDER"] . "?" . $query;
// <--Фильм по типу публикации

// Ссылки на теги -->
//echo "TAGS = ".$arResult["TAGS"]."<br>";
$arResult["arTagsLinks"] = array();
$ar_tags = explode(", ", $arResult["TAGS"]);
foreach ($ar_tags as $tag) {
    //$link = $arParams["SEARCH_PAGE"] . "?tags=" . $tag;
    $link = $arParams["SEARCH_PAGE"] . "?artags[]=" . $tag;
    $arResult["arTagsLinks"][] = array("link" => $link, "tag" => $tag);
}
// <-- Ссылки на теги

// Массив тегов -->
$ar_tags = explode(",", $arResult["TAGS"]);
foreach( $ar_tags AS $key => $val )
{
    $arResult["TAGS_THIS_ELEMENT"][] = trim($val); 
}
// <--

// Программа -->
//vardump($arResult["DISPLAY_PROPERTIES"]);
//$arElement = 
// <-- Программа

if ($arResult["DETAIL_PICTURE"]["ID"] > 0) {
    $file = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width' => 642, 'height' => 540), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["DETAIL_PICTURE"]["DETAIL_PICTURE_RESIZED"] = $file['src'];
}

foreach ($arResult["DISPLAY_PROPERTIES"]["DOCS"]["VALUE"] as $fileId) {
    $arResult["DISPLAY_PROPERTIES"]["DOCS"]["FULL_FILES"][] = CFile::GetFileArray($fileId);
}

$cp = $this->__component;
if (is_object($cp)) {
    $cacheKeys = [
        'ID',
        'NAME',
        'DISPLAY_PROPERTIES',
    ];
    foreach ($cacheKeys as $key) {
        $cp->arResult[$key] = $arResult[$key];
    }
    $cp->SetResultCacheKeys($cacheKeys);
}


