<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

// Проверка параметров -->
if
(
    intval($arParams["CONTEST_ELEMENT_ID"]) <= 0
    || strlen($arParams["CONTEST_REG_IBLOCK_CODE"]) <= 0
    || strlen($arParams["MODAL_DIV_ID"]) <= 0
) {
    return;
}
// <-- 

require_once(__DIR__ . "/classes.php");

// инициализация -->
{
    if (!isset($arParams["CACHE_TYPE"])) {
        $arParams["CACHE_TYPE"] = "A";
    }
    if (!isset($arParams["CACHE_TIME"])) {
        $arParams["CACHE_TIME"] = (86400 * 7);
    }
}
// <-- инициализация


// Кеш -->
{
    // CACHE_ID -->
    if (TRUE) {
        $arParamsCacheId = array(
            "COMPONENT_NAME" => $this->GetName(),
            "TEMPLATE_NAME" => $this->GetTemplateName(),
            "SITE_ID" => SITE_ID,
            "CONTEST_ELEMENT_ID" => $arParams["CONTEST_ELEMENT_ID"],
        );
        $ar_res = CPopupContestReg::GetCacheId(
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
    $arResult["arErrors"] = array();

    // Параметры компонента -->
    {
        $arResult["COMPONENT_NAME"] = $this->GetName();
        $arResult["TEMPLATE_NAME"] = $this->GetTemplateName();
        $arResult["MODAL_DIV_ID"] = $arParams["MODAL_DIV_ID"];
        $arResult["CONTEST_REG_IBLOCK_CODE"] = $arParams["CONTEST_REG_IBLOCK_CODE"];
        $arResult["URL_PRIVACY_POLICY"] = $arParams["URL_PRIVACY_POLICY"];
        $arResult["ANCHOR_TO_CONTEST_RULES"] = $arParams["ANCHOR_TO_CONTEST_RULES"];
    }
    // <-- Параметры компонента


    // Получение данных -->
    {
        // URL текущей страницы
        $arResult["SEND_FORM_URL"] = GetPagePath();

        //echo "arParams:";echo "<pre>";print_r($arParams);echo "</pre>";
        //echo "arContestParams:";echo "<pre>";print_r($GLOBALS["arSiteConfig"]["arContestParams"]);echo "</pre>";

        // Данные конкурса -->
        if (intval($arParams["CONTEST_ELEMENT_ID"]) > 0) {
            $arSelect = false;
            $arFilter = array(
                "ID" => $arParams["CONTEST_ELEMENT_ID"],
                //"IBLOCK_CODE" => $arParams["PROFILE_INFO_IBLOCK_CODE"],
                //"ACTIVE_DATE" => "Y",
                //"ACTIVE" => "Y",
                //"PROPERTY_USER_ID" => $USER_ID,
            );
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            if ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arFields["PROPERTIES"] = $ob->GetProperties();

                //echo "arFields:";echo "<pre>";print_r($arFields);echo "</pre>";

                // Проверка конкурса на даты -->
                {
                    $ar_result = CPopupContestReg::ContestCheckDates(
                        array(
                            "DATE_START" => $arFields["PROPERTIES"]["DATE_START"]["VALUE"],
                            "DATE_END" => $arFields["PROPERTIES"]["DATE_END"]["VALUE"],
                        )
                    );
                    if ($ar_result["RESULT"] == "SUCCESS") {
                    } else if ($ar_result["RESULT"] == "ERROR") {
                        foreach ($ar_result["arErrors"] as $key => $val) {
                            $arResult["arErrors"][] = $val;
                        }
                    }

                }
                // <-- Проверка конкурса на даты

                if (empty($arResult["arErrors"])) {
                    $arResult["arContest"] = array(
                        "ELEMENT_ID" => $arFields["ID"],
                        "DETAIL_PAGE_URL" => $arFields["DETAIL_PAGE_URL"],
                        "URL_TO_CONDITIONS" => $arFields["DETAIL_PAGE_URL"] . "#" . $arResult["ANCHOR_TO_CONTEST_RULES"],
                    );
                }
            }
        }
        // <-- Данные конкурса 
    }
    // <-- Получение данных

    // Сохранение данных в кеш, если кеш уже истек -->
    if ($obCache->StartDataCache()) {
        $obCache->EndDataCache(
            array(
                "arResult" => $arResult
            )
        );
    }
    // <-- Сохранение данных в кеш, если кеш уже истек
}

// Есть ли у текущего пользователя работа в этом конкурсе? -->
$ar_result = CPopupContestReg::CurUserContestRegExists(
    array(
        "USER_ID" => $USER->GetID(),
        "IBLOCK_CODE" => $GLOBALS["arSiteConfig"]["arIblockCodes"]["PARTICIPANTS_WORKS"],
        "CONTEST" => $arResult["arContest"]["ELEMENT_ID"],
    )
);
$arResult["REG_EXIST"] = $ar_result["REG_EXIST"];
// <--

// Что показывать, а что нет -->
$arResult["SHOW"]["JS"] = "Y";
if ($arResult["REG_EXIST"] == "Y") {
    $arResult["SHOW"]["JS"] = "N";
}
// <-- Что показывать, а что нет

if (empty($arResult["arErrors"]) && $arParams["AJAX"] != "Y") {

    $arResult["USER_ID"] = $USER->GetID();

    $this->IncludeComponentTemplate();
} else {
    //echo "arErrors:";echo "<pre>";print_r($arResult["arErrors"]);echo "</pre>";   
}
?>