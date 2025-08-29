<?php
use Bitrix\Sale;
use Bitrix\Main\Loader;
use Bitrix\Main\Application,
    Bitrix\Main\Context;
use Bitrix\Main\Mail\Event;

Loader::includeModule('iblock');

class IndexisEvents
{
    function OnEndBufferContentHandler(&$content)
    {
        global $APPLICATION;
        // Вырезаем onclick="BX.ajax.insertToNode();", чтобы в каталоге AJAX_MODE работал только для фильтра, а не для всего каталога
        if($APPLICATION->GetPageProperty("remove_ajax_attributes"))
            $content = preg_replace("/onclick\=\"BX\.ajax\.insertToNode.*?\"/", "", $content);
    }

    function OnAfterGuideChangeHandler(&$arGuide)
    {
        if ($arGuide['IBLOCK_ID'] == Indexis::getIblockId('guide', 'guide') && isset($arGuide['NAME'])) {

            $arName = array_values(array_filter(explode('.', $arGuide['NAME'])));
            $queryName = trim(toLower($arName[0]));

            $arNameReplace = [
                'пин-код' => 'смешарики',
                'смешарики: пинкод' => 'смешарики'
            ];

            if (isset($arNameReplace[$queryName]))
                $queryName = $arNameReplace[$queryName];

            $res = CIBlockElement::GetList(['NAME' => 'ASC'], [
                'IBLOCK_ID' => Indexis::getIblockId('movies', 'movies'),
                'ACTIVE_DATE' => 'Y',
                'ACTIVE' => 'Y',
                'NAME' => $queryName . '%',
            ], false, ['nPageSize' => 1], [
                'ID', 'NAME'
            ]);

            $movieId = false;
            if ($ob = $res->GetNextElement()) {
                $arMovie = $ob->GetFields();
                $movieId = $arMovie['ID'];
            }

            CIBlockElement::SetPropertyValuesEx($arGuide['ID'], $arGuide['IBLOCK_ID'], array('MOVIE_ID' => $movieId));
        }
    }

    function OnBeforeParticipantsChangeHandler(&$arParticipants)
    {
        if ($arParticipants['IBLOCK_ID'] == Indexis::getIblockId('participants', 'contests') && isset($arParticipants['NAME'])) {

            $resStatus = CIBlockProperty::GetByID("STATUS", false, "participants");
            if($status = $resStatus->GetNext()) {
                $idStatus = $status['ID'];
            }

            $propertyStatus = CIBlockPropertyEnum::GetList(
                ["DEF"=>"DESC", "SORT"=>"ASC"],
                ["IBLOCK_ID" => Indexis::getIblockId('participants', 'contests'), "CODE"=>"STATUS"]
            );
            while($fieldsStatus = $propertyStatus->GetNext())
            {
                $arStatus[$fieldsStatus["ID"]] = $fieldsStatus["XML_ID"];
                $arStatusName[$fieldsStatus["ID"]] = $fieldsStatus["VALUE"];
            }

            $resStatusElement = CIBlockElement::GetProperty(
                Indexis::getIblockId('participants', 'contests'),
                $arParticipants["ID"],
                ["sort" => "asc"],
                ["CODE"=>"STATUS"]
            );
            while ($obStatusElement = $resStatusElement->GetNext()) {
                $statusIdElementValue = $obStatusElement['VALUE'];
                $statusNameElementValue = $obStatusElement['VALUE_ENUM'];
                $statusCodeElementValue = $obStatusElement['VALUE_XML_ID'];
            }

            $resReasonsRefusal = CIBlockProperty::GetByID("REASONS_REFUSAL", false, "participants");
            if($reasonsRefusal = $resReasonsRefusal->GetNext()) {
                $idReasonsRefusal = $reasonsRefusal['ID'];
            }

            $propertyReasonsRefusal = CIBlockPropertyEnum::GetList(
                ["DEF"=>"DESC", "SORT"=>"ASC"],
                ["IBLOCK_ID" => Indexis::getIblockId('participants', 'contests'), "CODE"=>"REASONS_REFUSAL"]
            );
            while($fieldsReasonsRefusal = $propertyReasonsRefusal->GetNext())
            {
                $arReasonsRefusal[$fieldsReasonsRefusal["ID"]] = $fieldsReasonsRefusal["XML_ID"];
                $arReasonsRefusalName[$fieldsReasonsRefusal["ID"]] = $fieldsReasonsRefusal["VALUE"];
            }

            $resReasonsRefusalElement = CIBlockElement::GetProperty(
                Indexis::getIblockId('participants', 'contests'),
                $arParticipants["ID"],
                ["sort" => "asc"],
                ["CODE"=>"REASONS_REFUSAL"]
            );
            while ($obReasonsRefusalElement = $resReasonsRefusalElement->GetNext()) {
                $reasonsRefusalNameElementValue = $obReasonsRefusalElement['VALUE_ENUM'];
            }

            $resWinner = CIBlockProperty::GetByID("WINNER", false, "participants");
            if($winner = $resWinner->GetNext()) {
                $idWinner = $winner['ID'];
            }

            $propertyWinner = CIBlockPropertyEnum::GetList(
                ["DEF"=>"DESC", "SORT"=>"ASC"],
                ["IBLOCK_ID" => Indexis::getIblockId('participants', 'contests'), "CODE"=>"WINNER"]
            );
            while($fieldsWinner = $propertyWinner->GetNext())
            {
                $arWinner[$fieldsWinner["ID"]] = $fieldsWinner["XML_ID"];
                $arWinnerName[$fieldsWinner["ID"]] = $fieldsWinner["VALUE"];
            }

            $resWinnerElement = CIBlockElement::GetProperty(
                Indexis::getIblockId('participants', 'contests'),
                $arParticipants["ID"],
                ["sort" => "asc"],
                ["CODE"=>"WINNER"]
            );
            while ($obWinnerElement = $resWinnerElement->GetNext()) {
                $winnerIdElementValue = $obWinnerElement['VALUE'];
                $winnerNameElementValue = $obWinnerElement['VALUE_ENUM'];
                $winnerCodeElementValue = $obWinnerElement['VALUE_XML_ID'];
            }

            if($arParticipants["ID"] > 0) {
                $resEl = CIBlockElement::GetList(
                    [],
                    ["IBLOCK_ID" => Indexis::getIblockId('participants', 'contests'), "ID" => $arParticipants["ID"]],
                    false,
                    [],
                    ["ID", "IBLOCK_ID", "NAME"]
                );
                while($obEl = $resEl->GetNextElement()) {
                    $arProps = $obEl->GetProperties();
                    $props["PARTICIPANT_LAST_NAME"] = $arProps["PARTICIPANT_LAST_NAME"]["VALUE"];
                    $props["PARTICIPANT_FIRST_NAME"] = $arProps["PARTICIPANT_FIRST_NAME"]["VALUE"];
                    $props["REPRESENTATIVE_LAST_NAME"] = $arProps["REPRESENTATIVE_LAST_NAME"]["VALUE"];
                    $props["REPRESENTATIVE_FIRST_NAME"] = $arProps["REPRESENTATIVE_FIRST_NAME"]["VALUE"];
                    $props["REPRESENTATIVE_MIDDLE_NAME"] = $arProps["REPRESENTATIVE_MIDDLE_NAME"]["VALUE"];
                    $props["PARTICIPANT_AGE"] = $arProps["PARTICIPANT_AGE"]["VALUE"];
                    $props["PHONE"] = $arProps["PHONE"]["VALUE"];
                    $props["EMAIL"] = $arProps["EMAIL"]["VALUE"];
                    $props["CITY"] = $arProps["CITY"]["VALUE"];
                }
            }

            if(($statusIdElementValue != $arParticipants["PROPERTY_VALUES"][$idStatus][0]["VALUE"]) && ($arParticipants["PROPERTY_VALUES"][$idStatus][0]["VALUE"] > 0)) {

                if($arStatus[$arParticipants["PROPERTY_VALUES"][$idStatus][0]["VALUE"]] == "refusal") {
                    $reasonsRefusalNameElementValue = $reasonsRefusalNameElementValue ? : "не указана";

                    Event::send(array(
                        "EVENT_NAME" => "EVENT_PARTICIPANTS_REFUSAL",
                        "LID" => "s1",
                        "C_FIELDS" => array(
                            "PARTICIPANTLASTNAME" => $props["PARTICIPANT_LAST_NAME"],
                            "PARTICIPANTFIRSTNAME" => $props["PARTICIPANT_FIRST_NAME"],
                            "REPRESENTATIVELASTNAME" => $props["REPRESENTATIVE_LAST_NAME"],
                            "REPRESENTATIVEFIRSTNAME" => $props["REPRESENTATIVE_FIRST_NAME"],
                            "REPRESENTATIVEMIDDLENAME" => $props["REPRESENTATIVE_MIDDLE_NAME"],
                            "PARTICIPANTAGE" => $props["PARTICIPANT_AGE"],
                            "PHONE" => $props["PHONE"],
                            "EMAIL" => $props["EMAIL"],
                            "CITY" => $props["CITY"],
                            "DESC" => $arParticipants["PREVIEW_TEXT"],
                            "STATUS" => $arStatusName[$arParticipants["PROPERTY_VALUES"][$idStatus][0]["VALUE"]],
                            "REASONS_REFUSAL" => $arReasonsRefusalName[$arParticipants["PROPERTY_VALUES"][$idReasonsRefusal][0]["VALUE"]],
                        ),
                    ));
                } elseif($arStatus[$arParticipants["PROPERTY_VALUES"][$idStatus][0]["VALUE"]] == "accepted") {

                    Event::send(array(
                        "EVENT_NAME" => "EVENT_ACCEPTED",
                        "LID" => "s1",
                        "C_FIELDS" => array(
                            "PARTICIPANTLASTNAME" => $props["PARTICIPANT_LAST_NAME"],
                            "PARTICIPANTFIRSTNAME" => $props["PARTICIPANT_FIRST_NAME"],
                            "REPRESENTATIVELASTNAME" => $props["REPRESENTATIVE_LAST_NAME"],
                            "REPRESENTATIVEFIRSTNAME" => $props["REPRESENTATIVE_FIRST_NAME"],
                            "REPRESENTATIVEMIDDLENAME" => $props["REPRESENTATIVE_MIDDLE_NAME"],
                            "PARTICIPANTAGE" => $props["PARTICIPANT_AGE"],
                            "PHONE" => $props["PHONE"],
                            "EMAIL" => $props["EMAIL"],
                            "CITY" => $props["CITY"],
                            "DESC" => $arParticipants["PREVIEW_TEXT"],
                            "STATUS" => $arStatusName[$arParticipants["PROPERTY_VALUES"][$idStatus][0]["VALUE"]],
                        ),
                    ));
                }
            }

            if(($winnerIdElementValue != $arParticipants["PROPERTY_VALUES"][$idWinner][0]["VALUE"]) && ($arParticipants["PROPERTY_VALUES"][$idWinner][0]["VALUE"] > 0) && ($arStatus[$arParticipants["PROPERTY_VALUES"][$idStatus][0]["VALUE"]] == "accepted")) {

                Event::send(array(
                    "EVENT_NAME" => "EVENT_PARTICIPANTS_WINNER",
                    "LID" => "s1",
                    "C_FIELDS" => array(
                        "PARTICIPANTLASTNAME" => $props["PARTICIPANT_LAST_NAME"],
                        "PARTICIPANTFIRSTNAME" => $props["PARTICIPANT_FIRST_NAME"],
                        "REPRESENTATIVELASTNAME" => $props["REPRESENTATIVE_LAST_NAME"],
                        "REPRESENTATIVEFIRSTNAME" => $props["REPRESENTATIVE_FIRST_NAME"],
                        "REPRESENTATIVEMIDDLENAME" => $props["REPRESENTATIVE_MIDDLE_NAME"],
                        "PARTICIPANTAGE" => $props["PARTICIPANT_AGE"],
                        "PHONE" => $props["PHONE"],
                        "EMAIL" => $props["EMAIL"],
                        "CITY" => $props["CITY"],
                        "DESC" => $arParticipants["PREVIEW_TEXT"],
                        "STATUS" => $arStatusName[$arParticipants["PROPERTY_VALUES"][$idStatus][0]["VALUE"]],
                    ),
                ));
            }
        }
    }

    function OnAfterParticipantsChangeHandler(&$arParticipants)
    {
        if ($arParticipants['IBLOCK_ID'] == Indexis::getIblockId('participants', 'contests') && isset($arParticipants['NAME']) && ($arParticipants['ID'] > 0)) {

            Event::send(array(
                "EVENT_NAME" => "EVENT_PARTICIPANTS_ADD",
                "LID" => "s1",
                "C_FIELDS" => array(
                    "PARTICIPANTLASTNAME" => $arParticipants["PROPERTY_VALUES"]["PARTICIPANT_LAST_NAME"],
                    "PARTICIPANTFIRSTNAME" => $arParticipants["PROPERTY_VALUES"]["PARTICIPANT_FIRST_NAME"],
                    "REPRESENTATIVELASTNAME" => $arParticipants["PROPERTY_VALUES"]["REPRESENTATIVE_LAST_NAME"],
                    "REPRESENTATIVEFIRSTNAME" => $arParticipants["PROPERTY_VALUES"]["REPRESENTATIVE_FIRST_NAME"],
                    "REPRESENTATIVEMIDDLENAME" => $arParticipants["PROPERTY_VALUES"]["REPRESENTATIVE_MIDDLE_NAME"],
                    "PARTICIPANTAGE" => $arParticipants["PROPERTY_VALUES"]["PARTICIPANT_AGE"],
                    "PHONE" => $arParticipants["PROPERTY_VALUES"]["PHONE"],
                    "EMAIL" => $arParticipants["PROPERTY_VALUES"]["EMAIL"],
                    "CITY" => $arParticipants["PROPERTY_VALUES"]["CITY"],
                    "DESC" => $arParticipants["PREVIEW_TEXT"],
                ),
            ));
        }
    }

    function OnAfterParticipantsChangeUpdateHandler(&$arParticipants)
    {
        if ($arParticipants['IBLOCK_ID'] == Indexis::getIblockId('participants', 'contests') && isset($arParticipants['NAME']) && ($arParticipants['ID'] > 0) && ($arParticipants["RESULT"] == 1)) {

            $resStatus = CIBlockProperty::GetByID("STATUS", false, "participants");
            if($status = $resStatus->GetNext()) {
                $idStatus = $status['ID'];
            }

            $propertyStatus = CIBlockPropertyEnum::GetList(
                ["DEF"=>"DESC", "SORT"=>"ASC"],
                ["IBLOCK_ID" => Indexis::getIblockId('participants', 'contests'), "CODE"=>"STATUS"]
            );
            while($fieldsStatus = $propertyStatus->GetNext())
            {
                $arStatus[$fieldsStatus["ID"]] = $fieldsStatus["XML_ID"];
                $arStatusName[$fieldsStatus["ID"]] = $fieldsStatus["VALUE"];
            }

            $resStatusElement = CIBlockElement::GetProperty(
                Indexis::getIblockId('participants', 'contests'),
                $arParticipants["ID"],
                ["sort" => "asc"],
                ["CODE"=>"STATUS"]
            );
            while ($obStatusElement = $resStatusElement->GetNext()) {
                $statusIdElementValue = $obStatusElement['VALUE'];
                $statusNameElementValue = $obStatusElement['VALUE_ENUM'];
                $statusCodeElementValue = $obStatusElement['VALUE_XML_ID'];
            }

            if($statusCodeElementValue == "accepted") {
                if($arParticipants["ID"] > 0) {
                    $el = new CIBlockElement;
                    $resElement = $el->Update($arParticipants["ID"], ["ACTIVE" => "Y"]);
                    CIBlockElement::SetPropertyValueCode($arParticipants["ID"], "REASONS_REFUSAL", "");
                }
            } elseif($statusCodeElementValue == "refusal") {
                if($arParticipants["ID"] > 0) {
                    $el = new CIBlockElement;
                    $resElement = $el->Update($arParticipants["ID"], ["ACTIVE" => "N"]);
                }
            }
        }
    }
}