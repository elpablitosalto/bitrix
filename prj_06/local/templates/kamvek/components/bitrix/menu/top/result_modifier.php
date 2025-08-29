<?
$previousLevel = 0;
$curFirstLevel = 0;
//vardump($arResult);
foreach ($arResult as $key => $arItem) {
    $previousLevel = 0;
    if ($arItem["DEPTH_LEVEL"] == 1) {
        $curFirstLevel = $key;
    }
    if ($arItem["DEPTH_LEVEL"] == 2 && $arItem["IS_PARENT"] && $curFirstLevel > 0) {
        $arResult[$curFirstLevel]['NUM_COLS'] = 2;
        $curFirstLevel = 0;
    }
}

$cur_index_level_1 = 0;
foreach ($arResult as $key => $arItem) {
    if ($arItem["IS_PARENT"]) {
        if ($arItem["DEPTH_LEVEL"] == 1) {
            $cur_index_level_1 = $key;
        }
    } else {
        if ($arItem["DEPTH_LEVEL"] == 2) {
            $arResult[$cur_index_level_1]['CHILDS_LVL_2'][] = $arItem;
        }
    }
}
