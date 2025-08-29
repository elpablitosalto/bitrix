<?php
$MAIN_CHILD_ITEMS = array();

$children = array();
$curr_index = null;

foreach($arResult as $k=>$arItem){
    if($arItem['DEPTH_LEVEL'] == 1){
        if($curr_index !== null){
            $MAIN_CHILD_ITEMS[$curr_index]['CHILDREN'] = $children;
            $MAIN_CHILD_ITEMS[] = $arItem;
            $curr_index++;
            $children = array();
        } else {
            $MAIN_CHILD_ITEMS[] = $arItem;
            $curr_index = 0;
        }
    } else {
        $children[] = $arItem;
    }
}
$MAIN_CHILD_ITEMS[$curr_index]['CHILDREN'] = $children;

$arResult = $MAIN_CHILD_ITEMS;
//echo '<pre>' . print_r($MAIN_CHILD_ITEMS, true) . '</pre>';


