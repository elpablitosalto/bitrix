<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!function_exists('getChainHours')) {
    function getChainHours($hourStart, $hourEnd) {
        $arHours = [];
        if ($hourStart > $hourEnd) {
            for ($i = $hourStart; $i <= 23; $i++)
                $arHours[] = $i;

            for ($i = 0; $i <= $hourEnd; $i++)
                $arHours[] = $i;
        } else {
            for ($i = $hourStart; $i <= $hourEnd; $i++)
                $arHours[] = $i;
        }

        return $arHours;
    }
}

$arMovieIds = [];
$arResult['MOVIES'] = [];

if (isset($arParams['TIME_NAME'])) {
    $arTimeName = $arParams['TIME_NAME'];
}  else {
    $arTimeName = [
        'MORNING' => [
            'HOUR_START' => 6,
            'HOUR_END' => 11,
        ],
        'NOON' => [
            'HOUR_START' => 12,
            'HOUR_END' => 17,
        ],
        'EVENING' => [
            'HOUR_START' => 18,
            'HOUR_END' => 23,
        ],
        'NIGHT' => [
            'HOUR_START' => 0,
            'HOUR_END' => 5,
        ]
    ];
}

$arResult['GROUP_ITEMS'] = [];
$prevMovieSign = null;

foreach ($arResult['ITEMS'] as $arItem) {

    if (!empty($arItem['PROPERTIES']['MOVIE_ID']['VALUE']))
        $arMovieIds[$arItem['PROPERTIES']['MOVIE_ID']['VALUE']] = $arItem['PROPERTIES']['MOVIE_ID']['VALUE'];

    $movieHour = FormatDate("G", strtotime($arItem['PROPERTIES']['DATE_START']['VALUE']));

    foreach ($arTimeName as $timeCode => $timeRange) {
        if (/*$movieHour >= $timeRange['HOUR_START'] && $movieHour <= $timeRange['HOUR_END'] && */in_array($movieHour, getChainHours($timeRange['HOUR_START'], $timeRange['HOUR_END']))) {

            if ($prevMovieSign != $arItem['PROPERTIES']['MOVIE_ID']['VALUE'] . $timeCode) {
                $arResult['GROUP_ITEMS'][$timeCode][] = $arItem;
                $prevMovieSign = $arItem['PROPERTIES']['MOVIE_ID']['VALUE'] . $timeCode;
            }

            break;
        }
    }
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

    while($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arResult['MOVIES'][$arFields['ID']] = $arFields;
    }
}
?>
