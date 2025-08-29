<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

// Параметры -->
$arParams = array(
    "action" => $_POST["action"],
    "movie_id" => $_POST["movie_id"],
    "iblock_code" => $GLOBALS["arSiteConfig"]["arIblockCodes"]["MOVIES_FAVORITES"],
    "user_id" => $USER->GetID(),
);
// <-- Параметры

// Результат -->
$arResult = array();
$arResult["iblock_id"] = Indexis::getIblockId($arParams['iblock_code']);
$arResult["arParams"] = $arParams;
// <-- Результат

// Валидация параметров -->
if (
    ($arParams['action'] != "add" && $arParams['action'] != "remove")
    || intval($arParams['movie_id']) <= 0
    || strlen($arParams['iblock_code']) <= 0
    || intval($arParams['user_id']) <= 0
    || intval($arResult["iblock_id"]) <= 0
) {
    $arResult["arErrors"][] = "Недостаточно параметров";
}
// <-- Валидация параметров

// Добавление/удаление -->
if (empty($arResult["arErrors"])) {
    $arSelect = false;
    $arFilter = array(
        //"ID" => $arParams['movie_id'],
        //"IBLOCK_CODE" => $arParams['iblock_code'],
        "IBLOCK_ID" => $arResult["iblock_id"],
        "PROPERTY_USER" => $arParams['user_id'],
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    if ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arFields["PROPERTIES"] = $ob->GetProperties();

        $arMovies = $arFields["PROPERTIES"]["MOVIES"]["VALUE"];
        if (!is_array($arMovies)) {
            $arMovies = array();
        }
        if ($arParams['action'] == 'add') {
            if (!in_array($arParams['movie_id'], $arMovies)) {
                $arMovies[] = $arParams['movie_id'];
            }
        } else if ($arParams['action'] == 'remove') {
            foreach (array_keys($arMovies, $arParams['movie_id']) as $key) {
                unset($arMovies[$key]);
            }
            //$arResult["MOVIES"] = $arMovies;
        }
        if (empty($arMovies)) {
            $arMovies = false;
        }
        CIBlockElement::SetPropertyValuesEx($arFields["ID"], $arResult["iblock_id"], array("MOVIES" => $arMovies));
    } else {
        if ($arParams['action'] == 'add') {
            $el = new CIBlockElement;
            $PROPERTY_VALUES = array(
                "MOVIES" => array($arParams['movie_id']),
                "USER" => $arParams['user_id'],
            );
            $arLoadProductArray = array(
                "IBLOCK_ID" => $arResult["iblock_id"],
                "NAME" => $arParams['user_id'],
                "ACTIVE" => "Y",
                "PROPERTY_VALUES" => $PROPERTY_VALUES,
            );
            if ($NEW_ELEMENT_ID = $el->Add($arLoadProductArray)) {
                $arResult["NEW_ELEMENT_ID"] = $NEW_ELEMENT_ID;
            } else {
                $arResult["arErrors"][] = $el->LAST_ERROR;
            }
        }
    }
}
// <-- Добавление/удаление

// Обработка результата -->
if (empty($arResult["arErrors"])) {
    $arResult["RESULT"] = "SUCCESS";
} else {
    $arResult["RESULT"] = "ERROR";
}
// <-- Обработка результата

// Вывод результата -->
{
    $json_str = json_encode($arResult, JSON_UNESCAPED_UNICODE);
    //ob_end_clean(); // Очистка буфера
    //header('Content-Type: application/json');
    echo $json_str;
    //exit();
}
// <-- Вывод результата 

require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
?>