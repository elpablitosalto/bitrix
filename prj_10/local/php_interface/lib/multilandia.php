<?
class Multilandia
{
    static function GetUserFavoritesMovies($arParams)
    {
        $arResult = array();
        $iblock_id = Indexis::getIblockId($arParams['iblock_code']);

        // Валидация параметров -->
        if (
            strlen($arParams['iblock_code']) <= 0
            || intval($arParams['user_id']) <= 0
            || intval($iblock_id) <= 0
        ) {
            $arResult["arErrors"][] = "Недостаточно параметров";
        }
        // <-- Валидация параметров

        if(empty($arResult["arErrors"]))
        {
            $arSelect = false;
            $arFilter = array(
                "IBLOCK_ID" => $iblock_id,
                "PROPERTY_USER" => $arParams['user_id'],
            );
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            if ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arFields["PROPERTIES"] = $ob->GetProperties();

                $arMovies = $arFields["PROPERTIES"]["MOVIES"]["VALUE"];

                $arResult["arMoviesIds"] = $arMovies;
            }
        }

        return $arResult;
    }

    static function GetListContests($arParams)
    {
        $arResult = array();
        $arContestsEndIds = array();
        $arContests = array();

        if (strlen($arParams["IBLOCK_CODE"]) > 0) {
            $arSelect = false;
            $arFilter = array(
                "IBLOCK_CODE" => $arParams["IBLOCK_CODE"],
            );
            $arOrder = array("id" => "desc");
            $res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arFields["PROPERTIES"] = $ob->GetProperties();

                // Активность конкурса -->
                {
                    $ar_result = Multilandia::ContestCheckDates(
                        array(
                            "DATE_START" => $arFields["PROPERTIES"]["DATE_START"]["VALUE"],
                            "DATE_END" => $arFields["PROPERTIES"]["DATE_END"]["VALUE"],
                        )
                    );
                    //$arResult["CONTEST_START"] = $ar_result["CONTEST_START"];
                    //$arResult["CONTEST_END"] = $ar_result["CONTEST_END"];
                }
                // <-- Активность конкурса
                if ($ar_result["CONTEST_END"] == "Y") {
                    $arContestsEndIds[] = $arFields["ID"];
                }

                $arContests[$arFields["ID"]] = array(
                    "ID" => $arFields["ID"],
                    "NAME" => $arFields["NAME"],
                );
            }
        }

        $arResult["arContestsEndIds"] = $arContestsEndIds;
        $arResult["arContests"] = $arContests;


        return $arResult;
    }

    static function ContestCheckDates($arParams)
    {
        $arResult = array();


        $date_start_s = $arParams["DATE_START"];
        $date_end_s = $arParams["DATE_END"];
        $now_ts = time();

        //echo "date_start_s = ".$date_start_s."<br />";
        //echo "date_end_s = ".$date_end_s."<br />";

        // -->
        if (strlen($date_start_s) > 0) {
            $date_start_ts = strtotime($date_start_s);
            if (intval($date_start_ts) > 0 && intval($now_ts) > 0) {
                if ($date_start_ts > $now_ts) {
                    $arResult["arErrors"][] = "Конкурс еще не начался";
                    $arResult["CONTEST_START"] = "N";
                } else {
                    $arResult["CONTEST_START"] = "Y";
                }
            }
        }
        // <--

        // -->
        if (strlen($date_end_s) > 0) {
            $date_end_ts = strtotime($date_end_s);
            if (intval($date_end_ts) > 0 && intval($now_ts) > 0) {
                if ($date_end_ts <= $now_ts) {
                    $arResult["arErrors"][] = "Конкурс закончился";
                    $arResult["CONTEST_END"] = "Y";
                } else {
                    $arResult["CONTEST_END"] = "N";
                }
            }
        }
        // <--


        // -->
        if (empty($arResult["arErrors"])) {
            $arResult["RESULT"] = "SUCCESS";
        } else {
            $arResult["RESULT"] = "ERROR";
        }
        // <--

        return $arResult;
    }
}
?>