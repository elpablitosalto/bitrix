<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult["arMediaThemes"] = array();
$arSelect = false;
$arFilter = array(
    "IBLOCK_ID" => Indexis::getIblockId("materials", "content"),
    "ACTIVE_DATE" => "Y",
    "ACTIVE" => "Y",
    "SECTION_CODE" => "parents",
);
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arFields["PROPERTIES"] = $ob->GetProperties();

    $name = $arFields["PROPERTIES"]["THEME"]["VALUE"];
    //vardump($arFields["PROPERTIES"]);
    //echo "name = ".$name."<br />";

    if (strlen($name) > 0) {
        $key = $arFields["PROPERTIES"]["THEME"]["VALUE_ENUM_ID"];
        $htmlKey = htmlspecialcharsbx($key);
        $keyCrc = abs(crc32($htmlKey));
        $data = array(
            "set_filter" => "y",
            "newsFilter" . "_" . $arFields["PROPERTIES"]["THEME"]["ID"] . "_" . $keyCrc => "Y",
        );
        $query = http_build_query($data);
        $link = "/media/parents/?".$query;

        $arTheme = array(
            "LINK" => $link,
            "NAME" => $name,
        );

        $arResult["arMediaThemes"][$name] = $arTheme;
    }
}

\Bitrix\Main\Loader::includeModule('dev2fun.opengraph');
\Dev2fun\Module\OpenGraph::Show($arResult['ID'],'element');