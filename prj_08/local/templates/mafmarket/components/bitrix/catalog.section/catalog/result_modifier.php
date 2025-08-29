<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

if ($arParams["SECTION_ID"]) {
    $arResult["PARENT"] = CIBlockSection::GetByID($arParams["SECTION_ID"])->Fetch();
}

//справочники
$arResult["REFERENCE"] = [];
$iblocksReference = [
    Indexis::getIblockId("colors", "directory") => "colors",
    Indexis::getIblockId("metal_types", "directory") => "metal_types",
    Indexis::getIblockId("tree_types", "directory") => "tree_types",
    Indexis::getIblockId("color_options", "directory") => "color_options",
];
$arSelect = array("ID", "NAME", "PREVIEW_PICTURE", "IBLOCK_ID");
$arFilter = array("IBLOCK_ID" => array_keys($iblocksReference), "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "!PREVIEW_PICTURE" => false);
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while ($ob = $res->GetNext()) {
    $ob["NAME"] = mb_strtolower($ob["NAME"]);
    $ob["PREVIEW_PICTURE_SRC"] = CFile::GetPath($ob['PREVIEW_PICTURE']);
    $arResult["REFERENCE"][$iblocksReference[$ob["IBLOCK_ID"]]][$ob["NAME"]] = $ob;
}

if ($arParams["SECTION_ID"] > 0) {
    $arResult["SECTION_DATA"] =  CIBlockSection::GetList(
        array(),
        ["IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arParams["SECTION_ID"]],
        false,
        ["ID", "NAME", "DESCRIPTION", "PICTURE", "UF_SLIDER", "UF_VIDEO_SLIDER", "UF_VIDEO_SLIDER_POSTER", "UF_DISAIGNER", "UF_MANUFACTER"],
        ["nTopCount" => 1]
    )->Fetch();
    if ($arResult["SECTION_DATA"]["UF_DISAIGNER"] > 0) {
        $arResult["SECTION_DATA"]["UF_DISAIGNER"] = CIBlockElement::GetByID($arResult["SECTION_DATA"]["UF_DISAIGNER"])->Fetch();
    }
    if ($arResult["SECTION_DATA"]["UF_MANUFACTER"] > 0) {
        $arResult["SECTION_DATA"]["UF_MANUFACTER"] = CIBlockElement::GetByID($arResult["SECTION_DATA"]["UF_MANUFACTER"])->Fetch();
        $arResultLocal = Indexis::getImageFormatted(array(
            'RESIZE' => 'N',
            'FILE_VALUE' => ($arResult["SECTION_DATA"]["UF_MANUFACTER"]["PREVIEW_PICTURE"]) ? CFile::GetFileArray($arResult["SECTION_DATA"]["UF_MANUFACTER"]["PREVIEW_PICTURE"]) : [],
            'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/line-empty.png',
            //'WIDTH' => 205,
            //'HEIGHT' => 116,
            'DEFAULT_ALT_TITLE' => $arResult["SECTION_DATA"]['NAME']
        ));
        $arResult["SECTION_DATA"]["UF_MANUFACTER"]["PICTURE"] = $arResultLocal["PICTURE"];
    }
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => ($arResult["SECTION_DATA"]['PICTURE']) ? CFile::GetFileArray($arResult["SECTION_DATA"]['PICTURE']) : [],
        'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/line-empty.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $arResult["SECTION_DATA"]['NAME']
    ));
    $arResult["SECTION_DATA"]['PICTURE'] = $arResultLocal['PICTURE'];
    //$arResult["SECTION_DATA"]["SLIDER"][] = $arResult["SECTION_DATA"]['PICTURE']['SRC'];

    // Слайдер -->
    if (!empty($arResult["SECTION_DATA"]["UF_SLIDER"])) {
        foreach ($arResult["SECTION_DATA"]["UF_SLIDER"] as $slideId) {
            $arResult["SECTION_DATA"]["SLIDER"][] = CFile::GetPath($slideId);
        }
    }
    // <-- Слайдер

    // Видео в слайдере -->
    if (!empty($arResult["SECTION_DATA"]["UF_VIDEO_SLIDER"])) {
        $arResult["SECTION_DATA"]["VIDEO_SLIDER"] = CFile::GetPath($arResult["SECTION_DATA"]["UF_VIDEO_SLIDER"]);
    }
    if (!empty($arResult["SECTION_DATA"]["UF_VIDEO_SLIDER_POSTER"])) {
        $arResult["SECTION_DATA"]["VIDEO_SLIDER_POSTER"] = CFile::GetPath($arResult["SECTION_DATA"]["UF_VIDEO_SLIDER_POSTER"]);
    }
    // <-- Видео в слайдере

    // Показывать ли слайдер -->
    $arResult['SHOW_SLIDER'] = 'N';
    if (!empty($arResult["SECTION_DATA"]["VIDEO_SLIDER"]) || !empty($arResult["SECTION_DATA"]["SLIDER"])) {
        $arResult['SHOW_SLIDER'] = 'Y';
    }
    // <-- Показывать ли слайдер

    $OffersProps = [
        "VID_DREVESINY_BRUSKA_DOSKI",
        "METALL",
        "OKRAS_BRUSKA",
        "TSVET_METALLICHESKOGO_POKRYTIYA"
    ];

    foreach ($arResult["ITEMS"] as &$arItem) {
        $arItem["OFFERS_PROPS_VARIANTS"] = [];
        $arItem["GALLERY"] = [];
        if ($arItem["PREVIEW_PICTURE"]["ID"] > 0) {
            $arItem["GALLERY"][] = $arItem["PREVIEW_PICTURE"]['SRC'];
        }
        if (!empty($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"])) {
            foreach ($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $photoId) {
                $arItem["GALLERY"][] = CFile::GetPath($photoId);
            }
        }
        if (empty($arItem["GALLERY"]))
            $arItem["GALLERY"][] = $this->GetFolder() . '/images/line-empty.png';

        foreach ($arItem["OFFERS"] as $offer) {
            foreach ($OffersProps as $propCode) {
                if (isset($offer["PROPERTIES"][$propCode]["VALUE"]) && !empty($offer["PROPERTIES"][$propCode]["VALUE"])) {
                    $arItem["OFFERS_PROPS_VARIANTS"][$propCode][$offer["PROPERTIES"][$propCode]["VALUE"]] = $offer["PROPERTIES"][$propCode]["VALUE"];
                }
            }
        }
    }
}
