<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arMovieIds = [];
$arResult['MOVIES'] = [];
$arResult['CURRENT_MOVIE'] = [];

foreach ($arResult['ITEMS'] as $arItem) {
    if (!empty($arItem['PROPERTIES']['MOVIE_ID']['VALUE']))
        $arMovieIds[$arItem['PROPERTIES']['MOVIE_ID']['VALUE']] = $arItem['PROPERTIES']['MOVIE_ID']['VALUE'];
}

if (count($arMovieIds) > 0) {
    $res = CIBlockElement::GetList(['SORT' => 'ASC'], [
        'IBLOCK_ID' => Indexis::getIblockId('movies'),
        'ACTIVE_DATE' => 'Y',
        'ACTIVE' => 'Y',
        'ID' => array_values($arMovieIds),
    ], false, false, [
        'ID', 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL', 'PROPERTY_VOZRAST'
    ]);

    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arResult['MOVIES'][$arFields['ID']] = $arFields;
    }
}


$res = CIBlockElement::GetList(['PROPERTY_DATE_START' => 'DESC'], [
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'ACTIVE_DATE' => 'Y',
    'ACTIVE' => 'Y',
    '<PROPERTY_DATE_START' => FormatDate('Y-m-d H:i:s')
], false, ['nPageSize' => 1], [
    'ID', 'NAME', 'PROPERTY_MOVIE_ID.NAME'
]);

if ($ob = $res->GetNextElement())
    $arResult['CURRENT_MOVIE'] = $ob->GetFields();
?>
