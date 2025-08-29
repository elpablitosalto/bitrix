<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
// Изображение -->
if (!empty($arResult["DETAIL_PICTURE"])) {
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arResult["DETAIL_PICTURE"],
        'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $arResult['NAME']
    ));
    $arResult['PICTURE'] = $arResultLocal['PICTURE'];
}
// <-- Изображение

// Показывать или нет -->
if (!empty($arResult["ID"])) {
    $arResult["SHOW"] = array(
        "VIDEO" => array(
            "IBLOCK_ID" => Indexis::getIblockId("video", "knowledge"),
            "SHOW" => "N"
        ),
        "TECHNICAL" => array(
            "IBLOCK_ID" => Indexis::getIblockId("technical", "knowledge"),
            "SHOW" => "N"
        ),
        "CLINICAL" => array(
            "IBLOCK_ID" => Indexis::getIblockId("clinical", "knowledge"),
            "SHOW" => "N"
        ),
        "PERMITS" => array(
            "IBLOCK_ID" => Indexis::getIblockId("permits", "knowledge"),
            "SHOW" => "N"
        ),
    );
    foreach ($arResult["SHOW"] as $key => $val) {
        if (intval($val['IBLOCK_ID']) > 0) {
            $arSelect = array("ID");
            $arFilter = array(
                "IBLOCK_ID" => $val['IBLOCK_ID'],
                "ACTIVE_DATE" => "Y",
                "ACTIVE" => "Y",
                "PROPERTY_EQUIPMENT" => $arResult['ID'],
            );
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            if ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arResult["SHOW"][$key]["SHOW"] = 'Y';
            }
        }
    }
}
// <-- Показывать или нет
?>