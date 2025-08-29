<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$timeZoneId = $request->getCookie("USER_TIMEZONE");

if (!Indexis::isValidTimezoneId($timeZoneId))
    $timeZoneId = 'Europe/Moscow';

$timeZoneUser = new DateTimeZone($timeZoneId);
$timeZoneServer = new DateTimeZone('Europe/Moscow');

$date = new DateTime();
$date->setTimezone($timeZoneUser);

$currentHour = $date->format('G');
$currentTimestamp = strtotime($date->format('d.m.Y'));

if ($currentHour >= 0 && $currentHour <= 5)
    $currentTimestamp = strtotime('yesterday', $currentTimestamp);

$timestamp = $currentTimestamp;
$currentTimestampSection = strtotime($arResult["VARIABLES"]["SECTION_CODE"]);
$currentTimestamp = ($currentTimestampSection === false) ? $currentTimestamp : $currentTimestampSection;

$correctTimestampSection = false;

$dateStart = new DateTime(date('d.m.Y', $currentTimestamp) . ' 06:00:00', $timeZoneUser);
$dateStart->setTimezone($timeZoneServer);

$dateEnd = new DateTime(date('d.m.Y', $currentTimestamp + 86400) . ' 05:59:59', $timeZoneUser);
$dateEnd->setTimezone($timeZoneServer);

$GLOBALS[$arParams['FILTER_NAME']] = [
    '>=PROPERTY_DATE_START' => $dateStart->format('Y-m-d H:i:s'),
    '<=PROPERTY_DATE_START' => $dateEnd->format('Y-m-d H:i:s'),
];

$arParams['TIME_NAME'] = [
    'MORNING' => [
        'HOUR_START' => (int) $dateStart->format('H'),
        'HOUR_END' => (int) $dateStart->modify('+5 hour')->format('H'),
    ],
    'NOON' => [
        'HOUR_START' => (int) $dateStart->modify('+1 hour')->format('H'),
        'HOUR_END' => (int) $dateStart->modify('+5 hour')->format('H'),
    ],
    'EVENING' => [
        'HOUR_START' => (int) $dateStart->modify('+1 hour')->format('H'),
        'HOUR_END' => (int) $dateStart->modify('+5 hour')->format('H'),
    ],
    'NIGHT' => [
        'HOUR_START' => (int) $dateStart->modify('+1 hour')->format('H'),
        'HOUR_END' => (int) $dateStart->modify('+5 hour')->format('H'),
    ]
];
?>
<div class="date-slider">
    <div class="date-slider__container">
        <div class="date-slider__wrapper">
            <?for($i = 1; $i <= 8; $i++):?>
                <?
                $isToday = ($i == 1);
                $isTomorrow = ($i == 2);
                $isAfterTomorrow = ($i == 3);
                $isWide = ($isToday || $isTomorrow || $isAfterTomorrow);
                if ($timestamp == $currentTimestampSection)
                    $correctTimestampSection = true;
                ?>
                <div class="date-slider__item">
                    <a class="date-item<?if ($isWide):?> date-item_wide<?endif;?><?if ((isset($arResult['VARIABLES']['SECTION_CODE']) && FormatDate('d-m-Y', $timestamp) == $arResult['VARIABLES']['SECTION_CODE']) || (!isset($arResult['VARIABLES']['SECTION_CODE']) && $i == 1)):?> date-item_active<?endif;?>" href="<?=$arResult['FOLDER'] . str_replace('#SECTION_CODE#', FormatDate('d-m-Y', $timestamp), $arParams['SEF_URL_TEMPLATES']['section'])?>">
                        <span class="date-item__title">
                            <?if ($isWide):?>
                                <?if ($isToday):?>
                                    Сегодня
                                <?elseif ($isTomorrow):?>
                                    Завтра
                                <?elseif ($isAfterTomorrow):?>
                                    Послезавтра
                                <?endif;?>
                            <?else:?>
                                <?=toUpper(FormatDate('d.m', $timestamp))?>
                            <?endif;?>
                        </span>
                        <span class="date-item__subtitle"><?if ($isWide):?><?=toUpper(FormatDate('d.m', $timestamp))?> <?endif;?><?=toUpper(FormatDate('D', $timestamp))?></span>
                    </a>
                </div>
                <?
                $timestamp += 86400;
                ?>
            <?endfor;?>
        </div>
    </div>
</div>
<?php
if ($correctTimestampSection)
    $arResult["VARIABLES"]["SECTION_CODE"] = "";
?>

