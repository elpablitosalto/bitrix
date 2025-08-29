<?

//echo "ITEMS1:";
//vardump($arResult["ITEMS"]);
//vardump($arResult);

foreach ($arResult["ELEMENTS"] as $el_id) {
    //echo "el_id = " . $el_id . "<br />";
    if (!is_array($_SESSION["NOT_DOUBLE_DOCTOR_ID"])) {
        $_SESSION["NOT_DOUBLE_DOCTOR_ID"] = array();
    }
    if (intval($el_id) > 0) {
        array_push($_SESSION["NOT_DOUBLE_DOCTOR_ID"], $el_id);
    }
}
if (count($_SESSION["NOT_DOUBLE_DOCTOR_ID"]) > 4) {
    $_SESSION["NOT_DOUBLE_DOCTOR_ID"] = array_slice($_SESSION["NOT_DOUBLE_DOCTOR_ID"], 1, 4);
}

/*
foreach ($arResult["ITEMS"] as $arItem) {
    array_push($_SESSION["NOT_DOUBLE_DOCTOR_ID"], $arItem['ID']);
    if (count($_SESSION["NOT_DOUBLE_DOCTOR_ID"]) > 5) {
        array_slice($_SESSION["NOT_DOUBLE_DOCTOR_ID"], 1, 5);
    }
}
*/
