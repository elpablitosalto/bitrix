<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>


<?php

$printProps = [
    "OKRAS_BRUSKA", "METALL", "VID_DREVESINY_BRUSKA_DOSKI", "TSVET_METALLICHESKOGO_POKRYTIYA"
];
$itemsList = [
    ["Название", "Кол-во", "Характеристики"]
];
foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arItem){
    $propsArray = [];
    foreach($arItem["PROPS"] as $arProp){
        if(in_array($arProp["CODE"], $printProps)){
            $propsArray[] = $arProp["VALUE"];
        }
    }
    $itemsList[] = [
        $arItem["NAME"],
        $arItem["QUANTITY"],
        implode(" / ", $propsArray)
    ];
}

$xlsx = Shuchkin\SimpleXLSXGen::fromArray( $itemsList );
$xlsx->downloadAs('order.xlsx');

?>