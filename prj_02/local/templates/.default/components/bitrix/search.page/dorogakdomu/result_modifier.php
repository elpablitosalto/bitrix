<?
$arResult["COUNT_RESULTS"] = intval($arResult["NAV_RESULT"]->result->num_rows);

// Инфоблоки -->
$arIblocks = array();
$res = CIBlock::GetList(
    array(),
    array(
        'SITE_ID' => SITE_ID,
        'ACTIVE' => 'Y',
        "CNT_ACTIVE" => "Y",
    ),
    false
);
while ($ar_res = $res->Fetch()) {
    //echo $ar_res['NAME'] . ': ' . $ar_res['ELEMENT_CNT'];
    if (strlen($ar_res["CODE"]) > 0) {
        $arIblocks[$ar_res["CODE"]] = $ar_res["ID"];
    }
}
// <-- Инфоблоки

// Элементы инфоблоков -->
$arElements = array();
$arElementsIds = array();
foreach ($arResult["SEARCH"] as $key => $arItem) {
    if (intval($arItem["ITEM_ID"]) > 0) {
        $arElementsIds[] = $arItem["ITEM_ID"];
    }
}
if (!empty($arElementsIds)) {
    //$arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM");
    $arSelect = false;
    $arFilter = array(
        "ID" => $arElementsIds,
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y"
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arFields["PROPERTIES"] = $ob->GetProperties();

        //vardump($arFields["PROPERTIES"]["PUBLICATION_TYPE"]);
        //vardump($arFields);

        // Документы -->
        $FILES = array();
        $arFiles = $arFields["PROPERTIES"]["FILE"]["VALUE"];
        if (!is_array($arFiles)) {
            $arFiles = array($arFiles);
        }
        foreach ($arFiles as $key => $val) {
            $FILES[] = CFile::GetFileArray($val);
        }
        // <--

        $arElements[$arFields["ID"]] = array(
            "ACTIVE_FROM" => $arFields["ACTIVE_FROM"],
            "DETAIL_PAGE_URL" => $arFields["DETAIL_PAGE_URL"],
            "PREVIEW_TEXT" => $arFields["PREVIEW_TEXT"],
            "PREVIEW_PICTURE" => CFile::GetFileArray($arFields["PREVIEW_PICTURE"]),
            "PUBLICATION_TYPE" => $arFields["PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"],
            "FILES" => $FILES,
        );
    }
}
// <-- Элементы инфоблоков

// Обработка результатов поиска -->
foreach ($arResult["SEARCH"] as $key => $arItem) {
    //vardump($arItem);

    // Типы сущностей -->
    if ($arItem["PARAM1"] == "content") {
        if ($arItem["PARAM2"] == $arIblocks["programs"]) {
            $arResult["SEARCH"][$key]["ENTITY_TYPE"] = "Программа";
        }
        if ($arItem["PARAM2"] == $arIblocks["projects"]) {
            $arResult["SEARCH"][$key]["ENTITY_TYPE"] = "Проект";
        }
        if ($arItem["PARAM2"] == $arIblocks["materials"] || $arItem["PARAM2"] == $arIblocks["news"]) {
            $PUBLICATION_TYPE = $arElements[$arItem["ITEM_ID"]]["PUBLICATION_TYPE"];
            if (strlen($PUBLICATION_TYPE) > 0) {
                $arResult["SEARCH"][$key]["ENTITY_TYPE"] = $PUBLICATION_TYPE;
            }
        }
        if ($arItem["PARAM2"] == $arIblocks["documents"]) {
            $arResult["SEARCH"][$key]["ENTITY_TYPE"] = "Документ";
        }
        if ($arItem["PARAM2"] == $arIblocks["annual_public_reports"]) {
            $arResult["SEARCH"][$key]["ENTITY_TYPE"] = "Годовой публичный отчёт";
        }
    } elseif ($arItem["PARAM1"] == "pages") {
        $arResult["SEARCH"][$key]["ENTITY_TYPE"] = "Страница сайта";
    }
    // <-- Типы сущностей

    // Картинки -->
    $arResult["SEARCH"][$key]["PICTURE_SRC"] = $arElements[$arItem["ITEM_ID"]]["PREVIEW_PICTURE"]["SRC"];
    // <-- Картинки

    // Описания для анонса -->
    if (strlen($arItem["BODY_FORMATED"]) <= 0 && strlen($arElements[$arItem["ITEM_ID"]]["PREVIEW_TEXT"]) > 0) {
        $arResult["SEARCH"][$key]["BODY_FORMATED"] = $arElements[$arItem["ITEM_ID"]]["PREVIEW_TEXT"];
    }
    // <-- Описания для анонса

    // Ссылки на результаты поиска -->
    if (
        $arItem["PARAM2"] == $arIblocks["documents"]
        || $arItem["PARAM2"] == $arIblocks["annual_public_reports"]
    ) {
        $arFiles = $arElements[$arItem["ITEM_ID"]]["FILES"];
        $s = "";
        foreach ($arFiles as $k => $v) {
            $name = $v["ORIGINAL_NAME"];
            if (strlen($v["DESCRIPTION"]) > 0) {
                $name = $v["DESCRIPTION"];
                $path_parts = pathinfo($_SERVER["DOCUMENT_ROOT"] . $v["SRC"]);
                $name .= "&emsp;" . strtoupper($path_parts["extension"]);
            }
            $name .= "&emsp;" . Indexis::FileSizeConvert($v["FILE_SIZE"]);
            $name .= "&emsp;" . "Скачать";
            $s .= '<a href="' . $v["SRC"] . '">' . $name . '</a><br /><br />';
            $arResult["SEARCH"][$key]["URL"] = $v["SRC"];
        }
        $arResult["SEARCH"][$key]["BODY_FORMATED"] = $s . $arResult["SEARCH"][$key]["BODY_FORMATED"];
    }
    // <-- Ссылки на результаты поиска

    // Дата -->
    if (
        $arItem["PARAM2"] == $arIblocks["news"]
        || $arItem["PARAM2"] == $arIblocks["materials"]
        || $arItem["PARAM2"] == $arIblocks["annual_public_reports"]
    ) {
        if (strlen($arElements[$arItem["ITEM_ID"]]["ACTIVE_FROM"]) > 0) {
            $arResult["SEARCH"][$key]["DATE"] = FormatDate(
                "j F Y",
                MakeTimeStamp($arElements[$arItem["ITEM_ID"]]["ACTIVE_FROM"])
            );
        }
    }
    // <-- Дата
}
// <-- Обработка результатов поиска
