<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>


<?php

$printProps = [
    "OKRAS_BRUSKA", "METALL", "VID_DREVESINY_BRUSKA_DOSKI", "TSVET_METALLICHESKOGO_POKRYTIYA"
];
$header = [
    "Название", "Кол-во", "Характеристики"
];
$itemsList = [];
foreach ($arResult["ITEMS"]["AnDelCanBuy"] as $arItem) {
    $propsArray = [];
    foreach ($arItem["PROPS"] as $arProp) {
        if (in_array($arProp["CODE"], $printProps)) {
            $propsArray[] = $arProp["VALUE"];
        }
    }
    $itemsList[] = [
        $arItem["NAME"],
        "Кол-во: ".$arItem["QUANTITY"],
        "Хар-ки: ".implode(" / ", $propsArray)
    ];
}


$pdf = new tFPDF();
$pdf->AddPage();
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',10);

foreach ($itemsList as $row) {
    $pdf->Ln();
    foreach ($row as $col){
        $pdf->Cell(190, 6, $col, 1);
        $pdf->Ln();
    }
}

$pdf->Output();

?>