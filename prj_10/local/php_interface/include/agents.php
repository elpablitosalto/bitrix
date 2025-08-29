<?php

/**
 * Агент меняет даты в разделе программы, чтобы всегда были актуальные данные
 */
function guideProlong() {

    Bitrix\Main\Loader::includeModule('iblock');

    $arMovies = [];
    $res = CIBlockElement::GetList(['PROPERTY_DATE_START' => 'DESC'], [
        'IBLOCK_ID' => Indexis::getIblockId('movies'),
        'ACTIVE' => 'Y',
    ], false, false, [
        'ID',
    ]);

    while ($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $arMovies[] = $arFields['ID'];
    }

    $arWords = [
        'Балет',
        'Боулинг',
        'Игра',
        'Елка',
        'Терасса',
        'Поезд',
        'Деталька',
        'Винтики',
        'Каникулы',
        'Стул',
        'Зарядка',
        'Кофеварка',
        'Ссора',
        'Ремонт',
        'Ветер',
        'Зима',
        'Снег',
        'Офис',
        'Мыло',
        'Кофеварка'
    ];

    $res = CIBlockElement::GetList(['PROPERTY_DATE_START' => 'DESC'], [
        'IBLOCK_ID' => Indexis::getIblockId('guide'),
        'ACTIVE' => 'Y',
    ], false, false, [
        'ID', 'PROPERTY_DATE_START'
    ]);

    $startUnixTime = 0;
    if ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $startUnixTime = strtotime($arFields['PROPERTY_DATE_START_VALUE']);
    }

    if ($startUnixTime > 0) {
        $el = new CIBlockElement;
        for ($i = 0; $i <= 48; $i++) {

            $startUnixTime = strtotime('+1 hour', $startUnixTime);

            $arGuideItem = Array(
                "IBLOCK_ID"      => Indexis::getIblockId('guide'),
                "PROPERTY_VALUES"=> [
                    "DATE_START" => date('d.m.Y H:i:s', $startUnixTime),
                    "MOVIE_ID" => $arMovies[rand(0, count($arMovies)-1)]
                ],
                "NAME" => $arWords[rand(0, count($arWords)-1)],
                "ACTIVE" => "Y",
            );

            $el->Add($arGuideItem);
        }
    }


    return 'guideProlong();';
}
?>