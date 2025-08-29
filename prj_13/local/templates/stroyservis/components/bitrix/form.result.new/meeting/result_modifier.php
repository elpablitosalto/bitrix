<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arExternalFormParams = [];

if (preg_match_all("|<[^>]+>|U", $arResult["FORM_HEADER"], $arTags, PREG_PATTERN_ORDER)) {
    $arTags = $arTags[0];

    foreach ($arTags as $index => $htmlTag) {
        if ($index == 0) {
            $arResult["FORM_HEADER"] = $htmlTag;
        } else {
            preg_match( '/name="([^"]*)"/i', $htmlTag, $arName);
            preg_match( '/value="([^"]*)"/i', $htmlTag, $arValue);
            $arExternalFormParams[] = ['name' => $arName[1], 'value' => $arValue[1]];
        }
    }
}

$arResult["FORM_HEADER"] = '<form novalidate="true" autocomplete="off" class="meeting-form" data-external-params=\'' . json_encode($arExternalFormParams) . '\' name="' . $arResult["WEB_FORM_NAME"] . '" action="' . $APPLICATION->GetCurDir() . '" method="POST" enctype="multipart/form-data">';