<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

require_once(__DIR__ . "/classes.php");
// инициализация -->
{
    if (!isset($arParams["CACHE_TYPE"])) {
        $arParams["CACHE_TYPE"] = "A";
    }
    if (!isset($arParams["CACHE_TIME"])) {
        $arParams["CACHE_TIME"] = (86400 * 7);
    }
    if (!isset($arParams["WINNERS"])) {
        $arParams["WINNERS"] = "N";
    }
    /*
    if (!isset($arParams["MODE"])) {
    $arParams["MODE"] = "PARTICIPANTS";
    }
    */
}
// <-- инициализация

//vardump( $arParams );

// Валидация параметров -->
$bError = false;
if (strlen($arParams["CONTEST_WORKS_IBLOCK_CODE"]) <= 0) {
    $bError = true;
}
if (
    strlen($arParams["CONTEST_ELEMENT_ID"]) <= 0
    && ($arParams["MODE"] == "WINNERS" || $arParams["MODE"] == "PARTICIPANTS")
) {
    $bError = true;
}
if ($arParams["MODE"] == "ALL_WINNERS" && $arParams["SHOW_ALL_WINNERS"] != "Y") {
    $bError = true;
}
if ($arParams["MODE"] == "CURRENT_USER") {
    if ($arParams["SHOW_WORKS_CURRENT_USER"] != "Y" || intval($arParams["USER_ID"]) <= 0) {
        $bError = true;
    }
}
if ($bError) {
    return;
}
// <-- Валидация параметров



// Кеш -->
{
    // CACHE_ID -->
    {
        $arParamsCacheId = array(
            "COMPONENT_NAME" => $this->GetName(),
            "TEMPLATE_NAME" => $this->GetTemplateName(),
            "SITE_ID" => SITE_ID,
            "CONTEST_WORKS_IBLOCK_CODE" => $arParams["CONTEST_WORKS_IBLOCK_CODE"],
            "CONTESTS_IBLOCK_CODE" => $arParams["CONTESTS_IBLOCK_CODE"],
            "CONTEST_ELEMENT_ID" => $arParams["CONTEST_ELEMENT_ID"],
            "WINNERS" => $arParams["WINNERS"],
            "MODE" => $arParams["MODE"],
            "SHOW_ALL_WINNERS" => $arParams["SHOW_ALL_WINNERS"],
            "SHOW_WORKS_CURRENT_USER" => $arParams["SHOW_WORKS_CURRENT_USER"],
        );
        $ar_res = CModalContestWorksSlidesComponent::GetCacheId(
            array(
                "arParams" => $arParamsCacheId,
            )
        );
        $CACHE_ID = $ar_res["CACHE_ID"];
    }
    // <-- CACHE_ID


    // CACHE_PATH -->
    $CACHE_PATH = SITE_ID . $this->GetRelativePath();
    // <-- CACHE_PATH


    $obCache = new CPHPCache;
    $bInitCache = $obCache->InitCache($arParams["CACHE_TIME"], $CACHE_ID, $CACHE_PATH);
}
// <-- Кеш

if ($bInitCache) // если кеш есть и он ещё не истек то получаем закешированные переменные
{
    $vars = $obCache->GetVars();
    $arResult = $vars["arResult"];
} else // иначе обращаемся к базе
{
    $arResult = array();
    $arResult["arError"] = array();

    // Параметры компонента -->
    {
        $arResult["COMPONENT_NAME"] = $this->GetName();
        $arResult["TEMPLATE_NAME"] = $this->GetTemplateName();
        $arResult["CONTEST_WORKS_IBLOCK_CODE"] = $arParams["CONTEST_WORKS_IBLOCK_CODE"];
        $arResult["CONTESTS_IBLOCK_CODE"] = $arParams["CONTESTS_IBLOCK_CODE"];
        $arResult["WINNERS"] = $arParams["WINNERS"];
        $arResult["MODE"] = $arParams["MODE"];
    }
    // <-- Параметры компонента

    // Получение данных -->
    {
        // Данные конкурса -->
        if (intval($arParams["CONTEST_ELEMENT_ID"]) > 0) {
            $arSelect = false;
            $arFilter = array(
                "ID" => $arParams["CONTEST_ELEMENT_ID"],
            );
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            if ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arFields["PROPERTIES"] = $ob->GetProperties();

                //echo "arFields:";echo "<pre>";print_r($arFields);echo "</pre>";

                $arResult["arContest"] = array(
                    "ELEMENT_ID" => $arFields["ID"],
                    "NAME" => $arFields["NAME"],
                    "DATE_START" => $arFields["PROPERTIES"]["DATE_START"]["VALUE"],
                    "DATE_END" => $arFields["PROPERTIES"]["DATE_END"]["VALUE"],
                    //"DETAIL_PAGE_URL" => $arFields["DETAIL_PAGE_URL"],
                    //"URL_TO_CONDITIONS" => $arFields["DETAIL_PAGE_URL"] . "#" . $arResult["ANCHOR_TO_CONTEST_RULES"],
                );

                // Активность конкурса -->
                {
                    $ar_result = CModalContestWorksSlidesComponent::ContestCheckDates(
                        array(
                            "DATE_START" => $arResult["arContest"]["DATE_START"],
                            "DATE_END" => $arResult["arContest"]["DATE_END"],
                        )
                    );
                    $arResult["CONTEST_START"] = $ar_result["CONTEST_START"];
                    $arResult["CONTEST_END"] = $ar_result["CONTEST_END"];
                }
                // <-- Активность конкурса
            }
        }
        // <-- Данные конкурса 

        // Работы участников -->
        if (
            strlen($arResult["CONTEST_WORKS_IBLOCK_CODE"]) > 0
            //&& intval($arResult["arContest"]["ELEMENT_ID"]) > 0
        ) {
            $ar_params = array(
                "CONTEST_WORKS_IBLOCK_CODE" => $arResult["CONTEST_WORKS_IBLOCK_CODE"],
                "CONTESTS_IBLOCK_CODE" => $arResult["CONTESTS_IBLOCK_CODE"],
                "WINNERS" => $arResult["WINNERS"],
                "MODE" => $arResult["MODE"],
            );
            if ($arResult["MODE"] == "WINNERS" || $arResult["MODE"] == "PARTICIPANTS") {
                $ar_params["CONTEST_ELEMENT_ID"] = $arResult["arContest"]["ELEMENT_ID"];
                $ar_params["CONTEST_END"] = $arResult["CONTEST_END"];
            } else if ($arResult["MODE"] == "CURRENT_USER")
            {
                $ar_params["USER_ID"] = $arParams["USER_ID"];
            }
            $ar_result = CModalContestWorksSlidesComponent::GetContestWorks($ar_params);
            $arResult["arContestWorks"] = $ar_result["arContestWorks"];
        }
        // <-- Работы участников
    }
    // <-- Получение данных
}
//echo "arResult:";echo "<pre>";print_r($arResult);echo "</pre>";

// Проверка, нашлись ли работы участников -->
if (empty($arResult["arError"])) {
    if (empty($arResult["arContestWorks"])) {
        $arResult["arError"][] = "Работы участников не найдены";
    }
}
// <--  


// Дополнительные параметры -->
if (empty($arResult["arError"])) {
    $arResult["USER_ID"] = $USER->GetID();

    // id блока cо слайдшоу -->
    if ($arResult["WINNERS"] == "Y") {
        $slideshowBlockId = $GLOBALS["arSiteConfig"]["arModalsParams"]["contest_works_winner_slides_modal_id"];
        if (strlen($slideshowBlockId) <= 0) {
            $slideshowBlockId = "modal-work-winner";
        }
    } else {
        $slideshowBlockId = $GLOBALS["arSiteConfig"]["arModalsParams"]["contest_works_slides_modal_id"];
        if (strlen($slideshowBlockId) <= 0) {
            $slideshowBlockId = "modal-work";
        }
    }
    $arResult["slideshowBlockId"] = $slideshowBlockId;
    // <-- id блока cо слайдшоу 

    // id блока загрузки фото -->
    $arResult["uploadPhotoBlockId"] = $arResult["slideshowBlockId"] . "-upload-photo";
    // <-- id блока загрузки фото

    // id блока для выводом ошибок серверной валидации -->
    $arResult["uploadPhotoErrorBlockId"] = $arResult["uploadPhotoBlockId"] . "-error";
    // <--  

    // id блока с сообщением об успешной загрузке -->
    $arResult["uploadPhotoSuccessBlockId"] = $arResult["uploadPhotoBlockId"] . "-success";
    // <--
}
// <--

// Обработка данных перед выводом -->
if (empty($arResult["arError"])) {
    // Определим, показывать ли кнопку Загрузить фото с призом -->
    foreach ($arResult["arContestWorks"] as $key => $ar_work) {
        if (
            $arResult["USER_ID"] == $ar_work["USER_ID"]
            && intval($arResult["USER_ID"]) > 0
            && intval($ar_work["USER_ID"])
            && $ar_work["CONTEST_END"] == "Y"
        ) {
            $arResult["arContestWorks"][$key]["SHOW_B_UPLOAD_WITH_PRIZE"] = "Y";
        }
    }
    // <--
}
// <-- Обработка данных перед выводом

if (empty($arResult["arError"])) {
    $this->IncludeComponentTemplate();
}
?>