<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$arResult['arShedule'] = [];
//vardump($arResult["ITEMS"]);
foreach ($arResult["ITEMS"] as $key => $arItem) {
    $arEvent = array(
        'TIME_START_H' => $arItem['DISPLAY_PROPERTIES']['TIME_START_H']['VALUE'],
        'TIME_START_M' => $arItem['DISPLAY_PROPERTIES']['TIME_START_M']['VALUE'],
        'TIME_END_H' => $arItem['DISPLAY_PROPERTIES']['TIME_END_H']['VALUE'],
        'TIME_END_M' => $arItem['DISPLAY_PROPERTIES']['TIME_END_M']['VALUE'],
        'THEME' => $arItem['DISPLAY_PROPERTIES']['THEME']['VALUE'],
        'SHOW_THEME' => $arItem['DISPLAY_PROPERTIES']['SHOW_THEME']['VALUE_XML_ID'],
        'ID' => $arItem['ID'],
        'NAME' => $arItem['NAME'],
        'PREVIEW_TEXT' => $arItem['PREVIEW_TEXT'],
        'DETAIL_TEXT' => $arItem['DETAIL_TEXT'],
        'SORT' => $arItem['SORT'],
    );

    $activeFromFormat = FormatDate("j F Y", MakeTimeStamp($arItem['ACTIVE_FROM']));
    $arResult['arShedule'][$activeFromFormat][] = $arEvent;

    //vardump($arEvent);
}

foreach ($arResult['arShedule'] as $date => $arEvents) {
    $arResult['arShedule'][$date] = Indexis::sort_nested_arrays(
        $arResult['arShedule'][$date],
        array('TIME_START_H' => 'asc', 'TIME_START_M' => 'asc', "SORT" => "asc")
    );
}

foreach ($arResult['arShedule'] as $date => $arEvents) {
    foreach ($arEvents as $key => $arEvent) {
        if (strlen($arEvent['TIME_START_H']) == 1) {
            $arEvent['TIME_START_H'] = '0' . $arEvent['TIME_START_H'];
        }
        if (strlen($arEvent['TIME_START_M']) == 1) {
            $arEvent['TIME_START_M'] = '0' . $arEvent['TIME_START_M'];
        }
        if (strlen($arEvent['TIME_END_H']) == 1) {
            $arEvent['TIME_END_H'] = '0' . $arEvent['TIME_END_H'];
        }
        if (strlen($arEvent['TIME_END_M']) == 1) {
            $arEvent['TIME_END_M'] = '0' . $arEvent['TIME_END_M'];
        }
        $arEvent['TIME'] = $arEvent['TIME_START_H'] . '.' . $arEvent['TIME_START_M'] . ' - ' . $arEvent['TIME_END_H'] . '.' . $arEvent['TIME_END_M'];

        $arResult['arShedule'][$date][$key] = $arEvent;
    }
}

//vardump($arResult['arShedule']);