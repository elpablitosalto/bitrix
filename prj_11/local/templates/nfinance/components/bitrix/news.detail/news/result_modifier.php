<?
$arResult["TEXT_ARRAY"] = preg_split("/(\[(.*)+\/])/", $arResult["DETAIL_TEXT"], -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
$arToken = [];
$matches = [];
preg_match_all('/\[(.*)+\/]/', $arResult["DETAIL_TEXT"], $matches);

if(!empty($matches[0])) {
    $arToken = array_map(function($s) {
        $s = preg_replace("/NEWS/", "", $s);
        return preg_replace("/[^a-zA-Z0-9]+/", "", $s);
    }, $matches[0]);
}

foreach($arResult["TEXT_ARRAY"] as &$group) {
    if(preg_match("/(\[(.*)+\/])/", $group)) {
        $group = preg_replace("/NEWS/", "", $group);
        $group = preg_replace("/[^a-zA-Z0-9]+/", "", $group);
    }
    $group = str_replace(array("\r", "\n"), '', $group);
}

if(!empty($arResult["TEXT_ARRAY"])) {
    $arResult["TEXT_ARRAY"] = array_filter($arResult["TEXT_ARRAY"]);
} else {
    $arResult["TEXT_ARRAY"] = Array($arResult["DETAIL_TEXT"]);
}

if(count($arResult["TEXT_ARRAY"]) === 1) {
    $arResult["TEXT_ARRAY"][] = "GALLERY";
    $arResult["TEXT_ARRAY"][] = "VIDEO";
}

