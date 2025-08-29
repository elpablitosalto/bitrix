<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ELEMENTS"] as $el_id) {
    if (!is_array($_SESSION["NOT_DOUBLE_DOCTOR_ID"])) {
        $_SESSION["NOT_DOUBLE_DOCTOR_ID"] = array();
    }
    if (intval($el_id) > 0) {
        if ($arResult['NAV_RESULT']->NavPageCount == 1) {
            $_SESSION["NOT_DOUBLE_DOCTOR_ID"] = [$el_id];
        } else {
            array_push($_SESSION["NOT_DOUBLE_DOCTOR_ID"], $el_id);
        }
    }
}

/*if (count($_SESSION["NOT_DOUBLE_DOCTOR_ID"]) > 4) {
    $_SESSION["NOT_DOUBLE_DOCTOR_ID"] = array_slice($_SESSION["NOT_DOUBLE_DOCTOR_ID"], 1, 4);
}*/
